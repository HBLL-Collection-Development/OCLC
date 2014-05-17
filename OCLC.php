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

  protected $ai;
  protected $ip;
  protected $token;
  protected $secret;

  public function __construct($ai = null) {
    $this->set_ai($ai);
  }

  /**
   * Sets the $ai class variable
   *
   * @access public
   * @param string $ai WorldCat Affiliate ID
   */
  public function set_ai($ai = null) {
    if(is_null($ai)) {
      $this->ai = null;
    } else {
      $this->ai = '&ai=' . $ai;
    }
  }

  public function batch($service, $method, $search_array, $search_options = null) {
    if(!is_null($this->ip) && !is_null($this->secret) && !is_null($this->token)) { $hash = true; }
    $class = $this->get_class($service);
    $object = new $class;
    $results_array = null;
    foreach($search_array as $search_term) {
      if($hash) { $search_options['hash'] = $this->generate_hash($search_term, $this->ip, $this->secret) . '&token=' . $this->token; }
      $search = array($search_term, $search_options);
      $results_array[$search_term] = call_user_func_array(array($object, $method), $search);
    }
    return $results_array;
  }

  /**
   * Generates hash based on the number being searched, the originating IP address, and the app secret
   *
   * @access public
   * @param string $term ISBN to search by.
   * @param string $ip Originating IP address.
   * @param string $secret App secret.
   * @return string Generated hash that can be used in a query.
   */
  public function generateHash($number, $ip, $secret) {
    return md5($this->base_url . $number . '|' . $ip . '|' . $secret);
  }
  /**
   * @see \OCLC\Xid::generateHash()
   */
  public function generate_hash($number, $ip, $secret) {
    return $this->generateHash($number, $ip, $secret);
  }

  public function set_auth($token, $secret, $ip = null) {
    if(is_null($ip)) { $ip = $_SERVER['SERVER_ADDR']; }
    $this->ip     = $ip;
    $this->token  = $token;
    $this->secret = $secret;
  }

  private function get_class($service) {
    if(!in_array($service, \OCLC\OCLC::constant_to_array(\OCLC\Config::OCLC_VALID_SERVICES))) {
      throw new \OCLC\OCLCException('Invalid search option used. Valid values include ' . \OCLC\OCLC::constant_to_string(\OCLC\Config::OCLC_VALID_SERVICES) . '.');
      return false;
    } else {
      switch ($service) {
        case 'Xisbn':
        case 'Xissn':
        case 'XStandardNumber':
          return 'OCLC\\Xid\\' . $service;
          break;
        default:
          return 'OCLC\\' . $service . '\\' . $service;
          break;
      }
    }
  }

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
