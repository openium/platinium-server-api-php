# Platinium API

## Install with composer

~~~
composer require openium/platinium
~~~

## How to use it

When you create your entity, you have to implements `PushEntityInterface` in your entity or use Push entity.

### Push without geolocalization

~~~php
<?php
// Entity to push
$myEntity = new Push("message");

// Vars
$platiniumUrl = '...';
$platiniumServer = '...';
$apiServerId = '...';
$apiServerKey = '...';
$apiServerTokenDev = '...';
$apiServerTokenProd = '...';

// Prepare Push Service
$pushService = new PushService();
$pushService->setServerInfo(
    $platiniumUrl,
    $platiniumServer,
    $apiServerId,
    $apiServerKey,
    $apiServerTokenDev,
    $apiServerTokenProd
);

// Push
$pushGroups = ['myGroups'];
$langs = ['fr'];

$pushService->push($myEntity, $pushGroups, $langs);

~~~

### Push with geolocalization

~~~php
<?php
// Entity to push
$myEntity = new Push("message");

// Vars
$platiniumUrl = '...';
$platiniumServer = '...';
$apiServerId = '...';
$apiServerKey = '...';
$apiServerTokenDev = '...';
$apiServerTokenProd = '...';
$latitude = '...';
$longitude = '...';
$radius = '...';
$tolerance = '...';

// Prepare Push Service
$pushService = new PushService();
$pushService->setServerInfo(
    $platiniumUrl,
    $platiniumServer,
    $apiServerId,
    $apiServerKey,
    $apiServerTokenDev,
    $apiServerTokenProd
);
$pushService->setPushLocation(
    true,
    $latitude,
    $longitude,
    $radius,
    $tolerance
);

// Push
$pushGroups = ['myGroups'];
$langs = ['fr'];

$pushService->push($myEntity, $pushGroups, $langs);
~~~

## Credits

Authors : Thomas LEDUC & Alexandre CAILLOT