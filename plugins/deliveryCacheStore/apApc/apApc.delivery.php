<?php

/**
 * apDeliveryCacheStore for the OpenX ad server
 *
 * @author Matteo Beccati
 * @license GPLv2
 * @copyright 2011-2013 AdserverPlugins.com - All rights reserved
 * 
 */


function Plugin_deliveryCacheStore_apApc_apApc_Delivery_cacheRetrieve($filename) 
{
    $success = null;
    $serializedCacheVar = apc_fetch($filename, $success);
    if (!$success) {
        return false;
    }
    return unserialize($serializedCacheVar);
}

function Plugin_deliveryCacheStore_apApc_apApc_Delivery_cacheStore($filename, $cache_contents)
{    
    $serializedCacheExport = serialize($cache_contents); 
    
    if (!empty($cache_contents['cache_expire'])) {
        $result = apc_store($filename, $serializedCacheExport, $cache_contents['cache_expire']);
    } else {
        $result = apc_store($filename, $serializedCacheExport);
    }
    
    return $result;
}
