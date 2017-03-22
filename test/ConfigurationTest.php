<?php

/**
 * @package    VZenix.Configuration
 *
 * @copyright  Copyright (C) 2017. vzenix.es
 * @license    GNU General Public License v3.
 *
 * Launch sample:
 * 
 * 
 */

/**
 * Class for test "vzenix/configuration" library
 * @author Francisco Muros Espadas <paco@vzenix.es>
 */
class ConfigurationTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var \VZenix\Configuration\Configuration
     */
    private $_iConfig = null;

    /**
     * Get a class file for require, this test is very simple, for this doesn't 
     * use "--bootstrap" and only load the class programmatically
     * @return string
     */
    private function _getPath(): string
    {
        if (defined("___MBASEPATH___"))
        {
            return ___MBASEPATH___ . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'configuration' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'VZenix' . DIRECTORY_SEPARATOR . 'Configuration' . DIRECTORY_SEPARATOR . 'Configuration.php';
        }

        return "./src/VZenix/Configuration/Configuration.php";
    }

    /**
     * Load class file for assertion
     * @return boolean
     */
    private function _initClass(): bool
    {
        // If class isn't loaded by --bootstrap phpunit param
        if (!class_exists("\\VZenix\\Configuration\\Configuration"))
        {
            // Try load programmatically
            if (!file_exists($this->_getPath()))
            {
                $this->assertEquals(1, 0, "Can't load Configuration.php, if is necesary can edit test file, function '_getPath'");
                return false;
            }

            require_once $this->_getPath();
        }

        $this->_iConfig = new \VZenix\Configuration\Configuration();
        return true;
    }

    /**
     * Basic test for get and set methods
     */
    public function testTestTheMethodSetAndGet()
    {
        if (!$this->_initClass())
        {
            return;
        }

        $_iStdClass = new stdClass();
        $_iStdClass->a = 0;
        $_iStdClass->b = 1;

        $this->_iConfig->set("an_int", 5);
        $this->_iConfig->set("an_string", "The String");
        $this->_iConfig->set("an_array", array(5, 7, 9));
        $this->_iConfig->set("an_object", $_iStdClass);

        // Basics
        $this->assertEquals(5, $this->_iConfig->get("an_int", 10));
        $this->assertEquals("The String", $this->_iConfig->get("an_string", "A"));
        $this->assertEquals(array(5, 7, 9), $this->_iConfig->get("an_array", array(1, 9, 7)));
        $this->assertEquals($_iStdClass, $this->_iConfig->get("an_object", new \stdClass()));

        // Defaults values
        $this->assertEquals(5, $this->_iConfig->get("an_int_default", 5));
        $this->assertEquals("The String", $this->_iConfig->get("an_string_default", "The String"));
        $this->assertEquals(array(5, 7, 9), $this->_iConfig->get("an_array_default", array(5, 7, 9)));
        $this->assertEquals($_iStdClass, $this->_iConfig->get("an_object_default", $_iStdClass));

        // Random checks
        $this->assertTrue(5 !== $this->_iConfig->get("an_int_default", 10));
        $this->assertTrue("My String" !== $this->_iConfig->get("an_string_default", "Other string"));
        $this->assertTrue(array(5, 9, 11) !== $this->_iConfig->get("an_array"));
    }

    /**
     * Test for remove method
     * @depends testTestTheMethodSetAndGet
     */
    public function testTestTheMethodRemove()
    {
        if (!$this->_initClass())
        {
            return;
        }

        // Set values to delete
        $this->_iConfig->set("test01", 1);
        $this->_iConfig->set("test02", array(2));
        $this->_iConfig->set("test03", "A String");
        $this->_iConfig->set("test04", new stdClass());

        // Remove values
        $this->_iConfig->remove("test01");
        $this->_iConfig->remove("test02");
        $this->_iConfig->remove("test03");
        $this->_iConfig->remove("test04");

        // Remove an inexistent value
        $this->_iConfig->remove("test05");

        // Check if it's null
        $this->assertEquals(null, $this->_iConfig->get("test01"));
        $this->assertEquals(null, $this->_iConfig->get("test02"));
        $this->assertEquals(null, $this->_iConfig->get("test03"));
        $this->assertEquals(null, $this->_iConfig->get("test04"));
    }

    /**
     * @depends testTestTheMethodSetAndGet
     * @depends testTestTheMethodRemove
     */
    public function testLoadPredefinedConfigurations()
    {
        if (!$this->_initClass())
        {
            return;
        }

        if (!defined("___MCONSTANTS___"))
        {
            $_toDefine = array(
                '__TEST_01__' => 55,
                '__TEST_02__' => "A String",
                '__TEST_03__' => new stdClass(),
                '__TEST_04__' => array('pro' => 'val', 'other' => 9647)
            );

            define(___MCONSTANTS___, $_toDefine);
        }
        else
        {
            if (!is_array(___MCONSTANTS___))
            {
                $this->assertEquals(1, 0, "Const '___MCONSTANTS___' is't an array");
            }

            return;
        }

        $_proertiesToTest = array_keys(___MCONSTANTS___);
        foreach ($_proertiesToTest as $_p)
        {
            $this->assertTrue($this->_iConfig->get($_p) !== null);
        }
    }

}
