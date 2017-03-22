
# "vzenix/configuration" Library

## Introduction

This is a library for managing simplified configuration parameters.

It is commonly used for the development of simple and lightweight applications and scripts.

## Mode of use (with composer)

Before continuing, if you do not know the composer, open this link: https://getcomposer.org/
and learn about this.

Create the file "composer.json"

```
#!json
{"require": {"vzenix/configuration": "1.*"}}
```

Launch the composer install

```
#!shell
# If it's a new project
composer install 

# If you add the library in an existing project
composer update 
```

Ready, you can use the library now.

## Mode of use (without composer)

If you do not use composer (not recommended), you just have to download
and add the include, see sample:

```
#!php
<?php
require_once "PATH/TO/LIBRARY/CONFIGURATION/custom_loader.php"
$_iMiConf = new \VZenix\Configuration\Configuration();
```

## Modo de uso

Sample 1: Without configuration preloaded

```
#!php
<?php
// test.php
$_iMiConf = new \VZenix\Configuration\Configuration();
$_iMiConf->set("conf_01", "TEST CASE");
$_miProperty = $_iMiConf->get("conf_01");
```

Sample 2: With configuration preloaded

```
#!php
<?php
// defines.php

$_miProperties = array(
    "C01" => 0,
    "C02" => 1,
    "C03" => "dbg",
    "C04" => array('other case' => 'other')
);

define("___MCONSTANTS___", $_miProperties);
```

```
#!php
<?php
// test.php
$_iMiConf = new \VZenix\Configuration\Configuration();
$_iMiConf->set("conf_01", "TEST CASE");
$_miProperty = $_iMiConf->get("conf_01");
```

## License

GNU General Public License v3.