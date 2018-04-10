# Platinium API

## Install with composer

`composer require openium/platinium`

## How to use it

When you create your entity, you just have to implements `PushEntityInterface` and define methods.

### Push Without Geo localization

```php
<?php
    // --------------------------------
    // Entity to push
    $myEntity = new Entity();
        
    // --------------------------------
    // Vars
    $platiniumUrl = '...';
    $platiniumServer = '...';
    
    $apiServerId = '...';
    $apiServerKey = '...';
    $apiServerTokenDev = '...';
    $apiServerTokenProd = '...';    
    
    // --------------------------------
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
    
    // --------------------------------
    // Push
    $pushGroups = ['myGroups'];
    $langs = ['fr'];
    
    $pushService->push($myEntity, $pushGroups, $langs);
?>
```

### Push With Geo localization

```php
<?php
    // --------------------------------
    // Entity to push
    $myEntity = new Entity();
        
    // --------------------------------
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
    
    // --------------------------------
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
    
    // --------------------------------
    // Push
    $pushGroups = ['myGroups'];
    $langs = ['fr'];
    
    $pushService->push($myEntity, $pushGroups, $langs);
?>
```

## Credits

Authors : Thomas LEDUC & Alexandre CAILLOT