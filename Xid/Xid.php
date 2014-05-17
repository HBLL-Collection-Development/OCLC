<?php
/**
  * Abstract class to search OCLC xID Web Service
  *
  * @link http://www.oclc.org/developer/develop/web-services/xid-api.en.html
  * @author Jared Howland <oclc@jaredhowland.com>
  * @version 2014-05-14
  * @since 2014-05-12
  *
  */

namespace OCLC\Xid;

abstract class Xid {

  protected $ai;

  abstract function getMetadata($number, $options);
  abstract function get_metadata($number, $options);
  abstract function getEditions($number, $options);
  abstract function get_editions($number, $options);

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

  /**
   * Validates format options.
   *
   * @access private
   * @param string $format Format to return results in. Valid values are listed in self::VALID_FORMATS.
   * @return bool TRUE if valid, FALSE otherwise
   * @throws OCLCException if an invalid format selection is attempted.
   */
  protected function validate_format($format) {
    if(in_array($format, \OCLC\OCLC::constant_to_array(\OCLC\Config::XID_VALID_FORMATS))) {
      return true;
    } else {
      throw new \OCLC\OCLCException('Invalid `format`. Valid values include ' . \OCLC\OCLC::constant_to_string(\OCLC\Config::XID_VALID_FORMATS) . '.');
      return false;
    }
  }

  /**
   * Validates `fl` options.
   *
   * @access private
   * @param string $fls Fields requested. Valid values are listed in self::VALID_FLS.
   * @return bool TRUE if valid, FALSE otherwise
   * @throws OCLCException if an invalid `fl` selection is attempted.
   */
  protected function validate_fls($fls) {
    $fl = explode(',', $fls);
    foreach($fl as $value) {
      if(!in_array($value, \OCLC\OCLC::constant_to_array(\OCLC\Config::XID_VALID_FLS))) {
        throw new \OCLC\OCLCException('Invalid `fl`. Valid values include ' . \OCLC\OCLC::constant_to_string(\OCLC\Config::XID_VALID_FLS) . '.');
        return false;
      }
    }
    return true;
  }

}

?>
