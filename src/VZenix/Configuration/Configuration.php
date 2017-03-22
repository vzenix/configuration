<?php

/**
 * @package    VZenix.Configuration
 *
 * @copyright  Copyright (C) 2017. vzenix.es
 * @license    GNU General Public License v3.
 */

namespace VZenix\Configuration;

/**
 * Class for manage basics configuration
 * @author Francisco Muros Espadas <paco@vzenix.es>
 */
class Configuration
{

    /**
     * Alias for configuration properties in SWG CMS
     */
    // BBDD
    const DB_DOCTRINE = "___MDB_DOCTRINE___";
    const DB_PREFIX = "___MDB_PREFIX___";
    // Site class
    const SITE_COMPONENT = "___MSITE_COMPONENT___";
    const SITE_LIBRARY = "___MSITE_LIBRARY___";
    const SITE_CLASS = "___MSITE_CLASS___";
    // Language class
    const LANG_COMPONENT = "___MLANG_COMPONENT___";
    const LANG_LIBRARIE = "___MLANG_LIBRARIE___";
    const LANG_CLASS = "___MLANG_CLASS___";

    /**
     * Store
     * @var array
     */
    private $_data = array();

    /**
     * Default construct, it's preload configuration from const ___MCONSTANTS___
     * if it's defined as array
     */
    public function __construct()
    {
        if (defined("___MCONSTANTS___") && is_array(___MCONSTANTS___))
        {
            foreach (___MCONSTANTS___ as $k => $v)
            {
                $this->_data[$k] = $v;
            }
        }
    }

    /**
     * Get a value of a property stored
     * @param string $p Proerty name
     * @param string $d If property isn't defined, default return, null is default for this
     * @return mixed Value of property store, of null if it doesn't exist
     */
    public function get(string $p, $d = null)
    {
        if (isset($this->_data[$p]))
        {
            return $this->_data[$p];
        }

        return $d;
    }

    /**
     * Set a property value
     * @param string $var Property to set
     * @param mixed $value Value to set
     * @return void
     */
    public function set(string $var, $value)
    {
        $this->_data[$var] = $value;
    }

    /**
     * Delete a property of configuration if it exist
     * @param string $key
     * return void
     */
    public function remove(string $key)
    {
        if (isset($this->_data[$key]))
        {
            unset($this->_data[$key]);
        }
    }

}
