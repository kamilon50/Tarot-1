<?php
// This file generated by Propel 1.6.7 convert-conf target
// from XML runtime conf file /Users/Bilou/Documents/GitHub/Tarot/runtime-conf.xml
$conf = array (
  'datasources' => 
  array (
    'tarot' => 
    array (
      'adapter' => 'mysql',
      'connection' => 
      array (
        'dsn' => 'mysql:host=127.0.0.1;dbname=tarot',
        'user' => 'root',
        'password' => 'root',
      ),
    ),
    'default' => 'tarot',
  ),
  'generator_version' => '1.6.7',
);
$conf['classmap'] = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classmap-tarot-conf.php');
return $conf;