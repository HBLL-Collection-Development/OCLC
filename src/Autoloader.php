<?php
/**
  * Autoloader class for OCLC library
  *
  * @author Jared Howland <oclc@jaredhowland.com>
  * @version 2014-05-15
  * @since 2014-05-15
  *
  */

namespace OCLC;

new Autoloader;

class Autoloader {

  public function __construct() {
    spl_autoload_register('self::autoload_libs');
  }

  private function autoload_libs($class_name) {
    $class_name = ltrim($class_name, '\\');
    $file_name  = '';
    $namespace  = '';
    if ($lastNsPos = strrpos($class_name, '\\')) {
      $namespace   = substr($class_name, 0, $lastNsPos);
      $class_name  = substr($class_name, $lastNsPos + 1);
      $file_name   = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $file_name .= str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';
    if(file_exists($file_name)) {
      include_once($file_name);
    }
  }

}

?>
