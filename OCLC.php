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

  protected $auth_type;
  protected $auth_params;

  // IP Auth
  protected $ai;

  // Token Auth
  protected $ip;
  protected $token;
  protected $secret;

  // WSKey Auth
  protected $wskey;
  protected $wssecret;

  // Authentication URL query string
  protected $auth;

  /**
   * Constructor. Sets the authentication if it is sent when instantiated.
   *
   * @access public
   * @param string $auth_type Type of authentication being used. Valid options are listed in \OCLC\Config::OCLC_VALID_AUTH_TYPES
   */
  public function __construct($auth_type = null, $auth_params = null) {
    $this->set_auth($auth_type, $auth_params);
  }

  public function set_auth($auth_type = null, $auth_params = null) {
    $this->auth_params = $auth_params;
    switch ($auth_type) {
      case 'ip':
        $this->set_ip_auth($auth_params);
        $this->auth_type = $auth_type;
        break;
      case 'token':
        if(is_null($auth_params['token']) || is_null($auth_params['secret'])) {
          throw new \OCLC\OCLCException('Both `token` and `secret` must be set.');
        }
        $ip = isset($auth_params['ip']) ? $auth_params['ip'] : null;
        $this->set_token_auth($auth_params['token'], $auth_params['secret'], $ip);
        $this->auth_type = $auth_type;
        break;
      case 'wskey':
        $this->set_wskey_auth($auth_params);
        $this->auth_type = $auth_type;
        break;
      case null:
        $this->auth_type = null;
        break;
      default:
        throw new \OCLC\OCLCException('Wrong authentication type attempted. Valid values include ' . \OCLC\OCLC::constant_to_string(\OCLC\Config::OCLC_VALID_AUTH_TYPES) . '.');
        break;
    }
  }

  /**
   * Sets the $ai variable for IP authentication
   *
   * OCLC services use three different kinds of authentication:
   *
   * 1. IP Authentication: requires passing a WorldCat Affiliate ID with search.
   * 2. Token Authentication: requires a token, a secret, and the IP address
   *    (along with the search term) to generate a hash to be used with the search.
   * 3. WSKey Authentication: requires the key and the secret to authenticate.
   *
   * xID uses only IP or Token; newer services only use WSKey.
   *
   * @access public
   * @param string $ai WorldCat Affiliate ID
   */
  public function set_ip_auth($ai = null) {
    $this->ai = $ai;
    if(!is_null($ai)) {
      $this->auth = '&ai=' . $ai;
    }
  }

  /**
   * Sets the $ip, $token, and $secret variables for token authentication
   *
   * OCLC services use three different kinds of authentication:
   *
   * 1. IP Authentication: requires passing a WorldCat Affiliate ID with search.
   * 2. Token Authentication: requires a token, a secret, and the IP address
   *    (along with the search term) to generate a hash to be used with the search.
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
    $this->auth   = '&token=' . $token; // Hash must be created at time of search so this is the only auth string that we can generate right now
  }

  /**
   *
   *
   * OCLC services use three different kinds of authentication:
   *
   * 1. IP Authentication: requires passing a WorldCat Affiliate ID with search.
   * 2. Token Authentication: requires a token, a secret, and the IP address
   *    (along with the search term) to generate a hash to be used with the search.
   * 3. WSKey Authentication: requires the key and the secret to authenticate.
   *
   * xID uses only IP or Token; newer services only use WSKey.
   *
   * @access public
   * @param string $wskey OCLC WSKey
   * @param string $secret Secret for WSKey authentication
   * @todo Finish writing this function
   */
  public function set_wskey_auth($wskey, $secret) {
    $this->wskey = $wskey;
    $this->wssecret = $secret;
    $this->auth = 'TODO: Figure this out';
  }

  public function batch($service, $method, $search_array, $search_options = null) {
    $class  = $this->get_class($service);
    $object = new $class($this->auth_type, $this->auth_params);
    $results_array = null;
    // Options must include `type` for these three methods
    if($method == 'getEditions' || $method == 'getMetadata' || $method == 'getVariants') {
      if(!array_key_exists('type', $search_options)) {
        throw new \OCLC\OCLCException('Type must be included if you are trying to call `getEditions`, `getMetadata`, or `getVariants`. Valid `type`s include ' . \OCLC\OCLC::constant_to_string(\OCLC\Config::XID_XSTANDARD_NUMBER_VALID_NUMBER_TYPES) . '.');
      }
    }
    foreach($search_array as $search_term) {
      $function = array($object, $method);
      if($search_options['type']) {
        $params = ($this->valid_standard_number_type($search_options['type'])) ? array($search_options['type'], $search_term, $search_options) : null;
      } else {
        $params = array($search_term, $search_options);
      }
      $results_array[$search_term] = call_user_func_array($function, $params);
    }
    return $results_array;
  }

  private function valid_standard_number_type($type) {
    if(!in_array($type, \OCLC\OCLC::constant_to_array(\OCLC\Config::XID_XSTANDARD_NUMBER_VALID_NUMBER_TYPES))) {
      throw new \OCLC\OCLCException('Invalid `type` used as a search option. Valid values include ' . \OCLC\OCLC::constant_to_string(\OCLC\Config::XID_XSTANDARD_NUMBER_VALID_NUMBER_TYPES) . '.');
      return false;
    } else {
      return true;
    }
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
    $hash = md5($this->base_url . $number . '|' . $ip . '|' . $secret);
    $this->auth = '&token=' . $this->token . '&hash=' . $hash;
    return $hash;
  }
  /**
   * @see \OCLC\Xid::generateHash()
   */
  public function generate_hash($number, $ip, $secret) {
    return $this->generateHash($number, $ip, $secret);
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
