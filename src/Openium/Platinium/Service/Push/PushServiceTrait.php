<?php

/**
 * PHP Version 7.1
 *
 * @package  Openium\Platinium\Entity\Push
 * @author   Thomas LEDUC <thomaslmoi15@hotmail.fr>, Alexandre Caillot <a.caillot@openium.fr>
 * @link     https://openium.fr/
 */

namespace Openium\Platinium\Service\Push;

use Openium\Platinium\Entity\Push\PushNotifier;
use Openium\Platinium\Entity\Push\PushResponse;

/**
 * Trait PushServiceTrait
 *
 * @package  Openium\Platinium\Service\Push
 */
trait PushServiceTrait
{
    /**
     * @var PushInformationBuilder
     */
    protected $pushInformationBuilder;

    /**
     * @param string $headers
     *
     * @return array
     */
    public function parseHttpHeaders(string $headers)
    {
        $headers = str_replace("\r", "", $headers);
        $headers = explode("\n", $headers);
        $headerData = [];
        foreach ($headers as $value) {
            $header = explode(": ", $value);
            if ($header[0] && !isset($header[1])) {
                $headerData['status'] = $header[0];
            } elseif ($header[0] && $header[1]) {
                $headerData[$header[0]] = $header[1];
            }
        }
        return $headerData;
    }

    /**
     * @param PushNotifier $pushNotifier
     * @param array $paramsBag
     *
     * @return PushResponse
     */
    public function makePOSTOn(PushNotifier $pushNotifier, array $paramsBag): PushResponse
    {
        $requestHeaders = $this->pushInformationBuilder->createServerSignature(
            'POST',
            $pushNotifier,
            $paramsBag
        );
        $fullURL = $pushNotifier->getServerInfo()->getServer() . $pushNotifier->getServerInfo()->getUrl();
        $params_string = str_replace('+', '%20', http_build_query($paramsBag));
        // Open Connection (Curl)
        $ch = curl_init();
        // Set Options for Curl
        curl_setopt($ch, CURLOPT_URL, $fullURL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // POST data
        $response = curl_exec($ch);
        if ($response) {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $result = null;
            if ($httpStatusCode == 200) {
                $responseHeaderSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                $stringResponseHeader = substr($response, 0, $responseHeaderSize);
                $responseHeaders = $this->parseHttpHeaders($stringResponseHeader);
                if (array_key_exists('x-platinium-status-code', $responseHeaders)) {
                    $httpStatusCode = $responseHeaders['x-platinium-status-code'];
                }
                $result = substr($response, $responseHeaderSize);
            } else {
                $result = "HTTP Code : {$httpStatusCode}";
            }
        } else {
            $result = 'CURL error : ' . curl_error($ch);
            $httpStatusCode = -1;
        }
        // Close Connection
        curl_close($ch);
        return new PushResponse($httpStatusCode, $result);
    }
}
