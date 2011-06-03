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


require_once LIB_PATH . '/Extension/deliveryCacheStore/DeliveryCacheStore.php';
// Using multi-dirname so tests can be run from either plugins or plugins_repo
require_once dirname(__FILE__) . '/apApc.delivery.php';

/**
 * An APC cache store plugin for delivery cache
 *
 * @package    OpenXPlugin
 * @subpackage DeliveryCacheStore
 * @author     Matteo Beccati <matteo@beccati.com>
 * @author     Lukasz Wikierski <lukasz.wikierski@openx.org>
 */
class Plugins_DeliveryCacheStore_apApc_apApc extends Plugins_DeliveryCacheStore
{
    /**
     * Return the name of plugin
     *
     * @return string
     */
    function getName()
    {
        return 'APC';
    }

    /**
     * Return information about cache storage
     *
     * @return bool|array True if there is no problems or array of string with error messages otherwise
     */
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

    /**
     * A function to delete a single cache entry
     *
     * @param string $filename The cache entry filename (hashed name)
     * @return bool True if the entres were succesfully deleted
     */
    function _deleteCacheFile($filename)
    {
        return apc_delete($filename);
    }

    /**
     * A function to delete entire delivery cache
     *
     * @return bool True if the entres were succesfully deleted
     */
    function _deleteAll()
    {
        return apc_clear_cache('user');
    }
}
