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

  /**
   * Constructor. Sets the authentication if it is sent when instantiated.
   *
   * @access public
   * @param string $ai WorldCat Affiliate ID
   */
  public function __construct($ai = null) {
    $this->set_ip_auth($ai);
  }

  /**
   * Sets the $ai variable for IP authentication
   *
   * OCLC services use three different kinds of authentication:
   *
   * 1. IP Authentication: requires passing a WorldCat Affiliate ID with search.
   * 2. Token Authentication: requires a token, a secret, and the IP address
   * (along with the search term) to generate a hash to be used with the search.
   * 3. WSKey Authentication: requires the key and the secret to authenticate.
   *
   * xID uses only IP or Token; newer services only use WSKey.
   *
   * @access public
   * @param string $ai WorldCat Affiliate ID
   */
  public function set_ip_auth($ai = null) {
    if(is_null($ai)) {
      $this->ai = null;
    } else {
      $this->ai = '&ai=' . $ai;
    }
  }

  /**
   * Sets the $ip, $token, and $secret variables for token authentication
   *
   * OCLC services use three different kinds of authentication:
   *
   * 1. IP Authentication: requires passing a WorldCat Affiliate ID with search.
   * 2. Token Authentication: requires a token, a secret, and the IP address
   * (along with the search term) to generate a hash to be used with the search.
   * 3. WSKey Authentication: requires the key and the secret to authenticate.
   *
   * xID uses only IP or Token; newer services only use WSKey.
   *
   * @access public
   * @param string $token Authentication token
   * @param string $secret Authentication secret
   * @param string $ip IP of server requesting access
   */
  public function set_token_auth($token, $secret, $ip = null) {
    if(is_null($ip)) { $ip = $_SERVER['SERVER_ADDR']; }
    $this->ip     = $ip;
    $this->token  = $token;
    $this->secret = $secret;
  }

  /**
   *
   *
   * OCLC services use three different kinds of authentication:
   *
   * 1. IP Authentication: requires passing a WorldCat Affiliate ID with search.
   * 2. Token Authentication: requires a token, a secret, and the IP address
   * (along with the search term) to generate a hash to be used with the search.
   * 3. WSKey Authentication: requires the key and the secret to authenticate.
   *
   * xID uses only IP or Token; newer services only use WSKey.
   *
   * @access public
   * @todo Write this function
   */
  public function set_wskey_auth() {
    return null;
  }

  public function batch($service, $method, $search_array, $search_options = null) {
    $class = $this->get_class($service);
    $object = new $class;
    $results_array = null;
    foreach($search_array as $search_term) {
      $auth  = $this->get_auth($search_term);
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

  private function get_auth($search_term) {
    if(!is_null($this->ai)) {
      return $this->ai;
    } elseif (!is_null($this->ip) && !is_null($this->token) && !is_null($this->secret)) {
      return $this->generate_hash($search_term, $this->ip, $this->secret) . '&token=' . $this->token;
    } else {
      throw new \OCLC\OCLCException('Invalid authentication type. Please go back and try again.');
    }
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
