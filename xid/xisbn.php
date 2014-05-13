<?php
/**
  * Class to search OCLC xISBN Web Service
  *
  * @link http://www.oclc.org/developer/develop/web-services/xid-api.en.html
  * @author Jared Howland <oclc@jaredhowland.com>
  * @version 2014-05-13
  * @since 2014-05-12
  *
  */

namespace OCLC\xID;

class xisbn extends xid {

  private $base_url;

  /**
   * Constructor. Sets WorldCat Affiliate ID if passed when instantiated.
   *
   * @access public
   * @param string $ai WorldCat Affiliate ID.
   */
  public function __construct($ai = null) {
    parent::set_ai($ai);
    $this->base_url = 'http://xisbn' . parent::BASE_URL . 'isbn/';
  }

  public function fixChecksum($isbn, $options = null) {
    return file_get_contents($this->construct_url('fixChecksum', $isbn, $options));
  }

  public function fix_checksum($isbn, $options = null) {
    return $this->fixChecksum($isbn, $options);
  }

  public function getMetadata($isbn, $options = null) {
    return file_get_contents($this->construct_url('getMetadata', $isbn, $options));
  }

  public function get_metadata($isbn, $options = null) {
    return $this->getMetadata($isbn, $options);
  }

  public function getEditions($isbn, $options = null) {
    return file_get_contents($this->construct_url('getEditions', $isbn, $options));
  }

  public function get_editions($isbn, $options = null) {
    return $this->getEditions($isbn, $options);
  }

  public function hyphenate($isbn, $options = null) {
    return file_get_contents($this->construct_url('hyphenate', $isbn, $options));
  }

  public function to10($isbn, $options = null) {
    return file_get_contents($this->construct_url('to10', $isbn, $options));
  }

  public function to13($isbn, $options = null) {
    return file_get_contents($this->construct_url('to13', $isbn, $options));
  }

  public function generateHash($isbn, $ip, $secret) {
    return md5($this->base_url . $isbn . '|' . $ip . '|' . $secret);
  }

  public function generate_hash($isbn, $ip, $secret) {
    return $this->generateHash($isbn, $ip, $secret);
  }

  private function construct_url($type, $isbn, $options = null) {
    return $this->base_url . $isbn . '?method=' . $type . $this->set_options($options) . $this->ai;
  }

  /**
   * Sets options passed by user.
   *
   * @access private
   * @param array $options Options to use in search.
   * @return string Options formatted as URL parameters.
   * @throws OCLCException if `options` is not an array.
   */
  private function set_options($options = null) {
    if(is_null($options)) {
      return $options;
    } elseif(is_array($options)) {
      return '&' . http_build_query($this->validate_options($options));
    } else {
      throw new \OCLC\OCLCException("xISBN options must be passed as an array.\n\nValid values include `format`, `callback`, `count`, `fl`, `hash`, `library`, `startIndex`, and `token`.");
    }
  }

  /**
   * Validates search options.
   *
   * @access private
   * @param array $search Search options.
   * @return array Validated search options.
   * @throws OCLCException if an invalid search option is attempted.
   */
  private function validate_options($options) {
    $options_array = null;
    foreach($options as $key => $value) {
      switch ($key) {
        case 'format':
          if($this->validate_format($value)) { $options_array['format'] = $value; }
          break;
        case 'fl':
          if($this->validate_fls($value)) { $options_array['fl'] = $value; }
          break;
        case 'library':
          if($this->validate_library($value)) { $options_array['library'] = $value; }
          break;
        case 'count':
          $options_array['count'] = (int) $value;
          break;
        case 'startIndex':
          $options_array['startIndex'] = (int) $value;
          break;
        case 'callback':
          $options_array['callback'] = $value;
          break;
        case 'hash':
          $options_array['hash'] = $value;
          break;
        case 'token':
          $options_array['token'] = $value;
          break;
        default:
          throw new \OCLC\OCLCException("Invalid search option used.\n\nValid values include `format`, `callback`, `count`, `fl`, `hash`, `library`, `startIndex`, and `token`.");
          break;
      }
    }
    if(!$options_array['fl']) { $options_array['fl'] = '*'; }
    return $options_array;
  }

  /**
   * Validates library options.
   *
   * @access private
   * @param string $library Library to search. Valid values include `ebook`, `freebook`, `bookmooch`, `paperbackswap`, `wikipedia`, `oca`, and `hathi`.
   * @return bool TRUE if valid, FALSE otherwise
   * @throws OCLCException if an invalid library selection is attempted.
   */
  private function validate_library($library) {
    $valid_library = array('ebook', 'freebook', 'bookmooch', 'paperbackswap', 'wikipedia', 'oca', 'hathi');
    if(in_array($library, $valid_library)) {
      return true;
    } else {
      throw new \OCLC\OCLCException("Invalid `library`. Valid values include `ebook`, `freebook`, `bookmooch`, `paperbackswap`, `wikipedia`, `oca`, and `hathi`.");
      return false;
    }
  }

}

?>
