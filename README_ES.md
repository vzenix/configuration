
# Librería "vzenix/configuration"

## Introducción

Esta es una librería para gestionar parámentros de configuración simplificada al 
máximo que almacena propiedades y valores.

Es de uso general para el desarrollo de aplicaciones y scripts sencillos y ligeros.

## Modo de uso (con composer)

Antes de continuar, si no conoces composer, abre este link: https://getcomposer.org/
e infórmate.

Crea el archivo "composer.json" con la siguiente estructura

```
#!json
{"require": {"vzenix/configuration": "1.*"}}
```

A contunuación ejecuta composer con las instrucciones de instalación

```
#!shell
# si estás creando el proyecto
composer install 

# si ya tenías el proyecto creado y estás añadiendo la librería
composer update 
```

Listo, ya puedes usar la librería en tu proyecto.

## Modo de uso (sin composer)

Si no usas composer (algo que desaconsejamos), Solo tienes que descargar 
el código y añadirlo de la siguiente forma:

```
#!php
<?php
require_once "PATH/TO/LIBRARY/custom_loader.php"
$_iMiConf = new \VZenix\Configuration\Configuration();
```

## Ejemplos

Ejemplo 1: Sin precarga de información

```
#!php
<?php
// test.php
$_iMiConf = new \VZenix\Configuration\Configuration();
$_iMiConf->set("conf_01", "TEST CASE");
$_miProperty = $_iMiConf->get("conf_01");
```

Ejemplo 2: Con precarga de información

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
$_miPropertyA = $_iMiConf->get("C03");

$_iMiConf->set("conf_01", "TEST CASE");
$_miPropertyB = $_iMiConf->get("conf_01");
```

## Licencia

GNU General Public License v3.
