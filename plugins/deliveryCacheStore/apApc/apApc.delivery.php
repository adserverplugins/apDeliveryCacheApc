<?php

/**
 * apDeliveryCacheStore for the OpenX ad server
 *
 * @author Matteo Beccati
 * @license GPL
 * @copyright 2011 AdserverPlugins.com - All rights reserved
 * 
 * $Id$
 */


/**
 *  An APC cache storage plugin for delivery cache - delivery functions
 *
 * @package    OpenXPlugin
 * @subpackage DeliveryCacheStorage
 * @author     Matteo Beccati <matteo@beccati.com>
 * @author     Lukasz Wikierski <lukasz.wikierski@openx.org>
 */

/**
 * Function to fetch a cache entry
 *
 * @param string $filename The name of file where cache entry is stored
 * @return mixed False on error, or the cache content
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

/**
 * A function to store content a cache entry.
 *
 * @param string $filename The filename where cache entry is stored
 * @param array $cache_contents  The cache content
 * @return bool True if the entry was succesfully stored
 */
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
