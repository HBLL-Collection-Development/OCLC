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

abstract class Xid extends \OCLC\OCLC{

  abstract function getMetadata($number, $options);
  abstract function get_metadata($number, $options);
  abstract function getEditions($number, $options);
  abstract function get_editions($number, $options);

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
