<?php
/**
  * Abstract class to search OCLC xID Web Service
  *
  * @link http://www.oclc.org/developer/develop/web-services/xid-api.en.html
  * @author Jared Howland <oclc@jaredhowland.com>
  * @version 2014-05-13
  * @since 2014-05-12
  *
  */

namespace OCLC\xID;

abstract class xid {
  const BASE_URL = '.worldcat.org/webservices/xid/';
  protected $ai;

  abstract function getMetadata($term, $options);
  abstract function get_metadata($term, $options);
  abstract function getEditions($term, $options);
  abstract function get_editions($term, $options);
  abstract function generateHash($term, $ip, $secret);
  abstract function generate_hash($term, $ip, $secret);

  /**
   * Sets the $ai class variable
   *
   * @access public
   * @param string $ai WorldCat Affiliate ID
   */
  public function set_ai($ai = null) {
    if(is_null($ai)) {
      $ai = null;
    } else {
      $this->ai = '&ai=' . $ai;
    }
  }

  protected function create_hash($url, $term, $ip, $secret) {
    return md5($url . $term . '|' . $ip . '|' . $secret);
  }

  protected function validate_format($format) {
    $valid_formats = array('csv', 'json', 'php', 'python', 'ruby', 'txt', 'html', 'xml');
    if(in_array($format, $valid_formats)) {
      return true;
    } else {
      throw new \OCLC\OCLCException("Invalid `format`.\n\nValid values include `csv`, `json`, `php`, `python`, `ruby`, `txt`, `html`, and `xml`.");
      return false;
    }
  }

  protected function validate_fls($fls) {
    $valid_fl = array('author', 'city', 'ed', 'oclcnum', 'form', 'lang', 'publisher', 'title', 'url', 'year', '*');
    $fl       = explode(',', $fls);
    foreach($fl as $value) {
      if(!in_array($value, $valid_fl)) {
        throw new \OCLC\OCLCException("Invalid `fl`. Valid values include `author`, `city`, `ed`, `oclcnum`, `form`, `lang`, `publisher`, `title`, `url`, `year`, and `*`.");
        return false;
      }
    }
    return true;
  }
}

?>
