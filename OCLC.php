<?php
/**
  * Common functions for OCLC library
  *
  * @author Jared Howland <oclc@jaredhowland.com>
  * @version 2014-05-15
  * @since 2014-05-15
  *
  */

namespace OCLC;

class OCLC {
  /**
   * Takes a comma-separated string and converts it to an array.
   *
   * @access public
   * @param string $data Data to convert to an array.
   * @return array $data as an array.
   */
  public static function constant_to_array($data) {
    return array_map('trim', explode(',', $data));
  }

  /**
   * Takes a comma-separated string and converts it to a formatted string.
   *
   * @access public
   * @param string $data Data to convert to a formatted string.
   * @return array $data as a formatted string (`csv, json, php' => `csv`, `json`, `php`)
   */
  public static function constant_to_string($data) {
    $array  = array_map('trim', explode(',', $data));
    $string = null;
    foreach($array as $valid) {
      $string .= '`' . $valid . '`, ';
    }
    return trim($string, ', ');
  }
}

?>
