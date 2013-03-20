<?php

/**
 * apDeliveryCacheApc for the OpenX ad server
 *
 * @author Matteo Beccati
 * @license GPLv2
 * @copyright 2011-2013 AdserverPlugins.com - All rights reserved
 * 
 */


require_once LIB_PATH . '/Extension/deliveryCacheStore/DeliveryCacheStore.php';
// Using multi-dirname so tests can be run from either plugins or plugins_repo
require_once dirname(__FILE__) . '/apApc.delivery.php';


class Plugins_DeliveryCacheStore_apApc_apApc extends Plugins_DeliveryCacheStore
{
    function getName()
    {
        return 'APC';
    }

    function getStatus()
    {
        $aErrors = array();
        $aConf = $GLOBALS['_MAX']['CONF'];

        // Check if APC is enabled in php.ini
        if (!extension_loaded('apc')) {
            return array("The APC extension is not available");
        }

        return true;
    }

    function _deleteCacheFile($filename)
    {
        return apc_delete($filename);
    }

    function _deleteAll()
    {
        return apc_clear_cache('user');
    }
}
