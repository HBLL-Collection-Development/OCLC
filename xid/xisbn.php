<?php
/**
  * Class to search OCLC xISBN Web Service
  *
  * @link http://www.oclc.org/developer/develop/web-services/xid-api/xisbn-resource.en.html
  * @author Jared Howland <oclc@jaredhowland.com>
  * @version 2014-05-14
  * @since 2014-05-12
  *
  */

namespace OCLC\xID;

class xisbn extends xid {

  protected $base_url;

  /**
   * Constructor. Sets WorldCat Affiliate ID if passed when instantiated.
   *
   * @access public
   * @param string $ai WorldCat Affiliate ID.
   */
  public function __construct($ai = null) {
    parent::set_ai($ai);
    $this->base_url = 'http://xisbn' . \OCLC\config::XID_BASE_URL . 'isbn/';
  }

  /**
   * Queries xISBN service using fixChecksum
   *
   * @access public
   * @param string $isbn ISBN to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\config::XID_XISBN_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function fixChecksum($isbn, $options = null) {
    return $this->get_data(__FUNCTION__, $isbn, $options);
  }
  /**
   * @see \OCLC\xid\xstandardnumber::fixChecksum()
   */
  public function fix_checksum($isbn, $options = null) {
    return $this->fixChecksum($isbn, $options);
  }

  /**
   * Queries xISBN service using getMetadata
   *
   * @access public
   * @param string $isbn ISBN to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\config::XID_XISBN_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getMetadata($isbn, $options = null) {
    return $this->get_data(__FUNCTION__, $isbn, $options);
  }
  /**
   * @see \OCLC\xid\xstandardnumber::getMetadata()
   */
  public function get_metadata($isbn, $options = null) {
    return $this->getMetadata($isbn, $options);
  }

  /**
   * Queries xISBN service using getEditions
   *
   * @access public
   * @param string $isbn ISBN to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\config::XID_XISBN_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getEditions($isbn, $options = null) {
    return $this->get_data(__FUNCTION__, $isbn, $options);
  }
  /**
   * @see \OCLC\xid\xstandardnumber::getEditions()
   */
  public function get_editions($isbn, $options = null) {
    return $this->getEditions($isbn, $options);
  }

  /**
   * Queries xISBN service using hyphenate
   *
   * @access public
   * @param string $isbn ISBN to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\config::XID_XISBN_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function hyphenate($isbn, $options = null) {
    return $this->get_data(__FUNCTION__, $isbn, $options);
  }

  /**
   * Queries xISBN service using to10
   *
   * @access public
   * @param string $isbn ISBN to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\config::XID_XISBN_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function to10($isbn, $options = null) {
    return $this->get_data(__FUNCTION__, $isbn, $options);
  }
  /**
   * @see \OCLC\xid\xstandardnumber::to10()
   */
  public function to_10($isbn, $options = null) {
    return $this->to10($isbn, $options);
  }

  /**
   * Queries xISBN service using to13
   *
   * @access public
   * @param string $isbn ISBN to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\config::XID_XISBN_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function to13($isbn, $options = null) {
    return $this->get_data(__FUNCTION__, $isbn, $options);
  }
  /**
   * @see \OCLC\xid\xstandardnumber::to13()
   */
  public function to_13($isbn, $options = null) {
    return $this->to13($isbn, $options);
  }

  /**
   * Grab the data from OCLC.
   *
   * @access private
   * @param string $type Type of search to run. Valid values are `fixChecksum`, `getMetadata`, `getEditions`, `hyphenate`, `to10`, and `to13`.
   * @param string $isbn ISBN being searched.
   * @param array Options array. Valid values are listed in \OCLC\config::XID_XISBN_VALID_OPTIONS.
   * @return string|array Results of query.
   */
  private function get_data($type, $isbn, $options = null) {
    $url = $this->base_url . $isbn . '?method=' . $type . $this->set_options($options) . $this->ai;
    return file_get_contents($url);
  }

  /**
   * Sets options passed by user.
   *
   * @access private
   * @param array $options Options to use in search. Valid values are listed in \OCLC\config::XID_XISBN_VALID_OPTIONS.
   * @return string Options formatted as URL parameters.
   * @throws OCLCException if `options` is not an array.
   */
  private function set_options($options = null) {
    if(is_null($options)) {
      return $options;
    } elseif(is_array($options)) {
      return '&' . http_build_query($this->validate_options($options));
    } else {
      throw new \OCLC\OCLCException('xISBN options must be passed as an array. Valid values include ' . $this->constant_to_string(\OCLC\config::XID_XISBN_VALID_OPTIONS) . '.');
    }
  }

  /**
   * Validates search options.
   *
   * @access private
   * @param array $search Search options.
   * @return array|bool Validated search options in an array. FALSE if invalid options are used.
   * @throws OCLCException if an invalid search option is attempted.
   */
  private function validate_options($options) {
    $options_array = null;
    foreach($options as $key => $value) {
      if(!in_array($key, $this->constant_to_array(\OCLC\config::XID_XISBN_VALID_OPTIONS))) {
        throw new \OCLC\OCLCException('Invalid search option used. Valid values include ' . $this->constant_to_string(\OCLC\config::XID_XISBN_VALID_OPTIONS) . '.');
        return false;
      } else {
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
        }
      }
    }
    // Set default `fl` value if not present to be `*`.
    if(!$options_array['fl']) { $options_array['fl'] = '*'; }
    return $options_array;
  }

  /**
   * Validates library options.
   *
   * @access private
   * @param string $library Library to search. Valid values are listed in \OCLC\config::XID_XISBN_VALID_LIBRARIES.
   * @return bool TRUE if valid, FALSE otherwise
   * @throws OCLCException if an invalid library selection is attempted.
   */
  private function validate_library($library) {
    $valid_libraries = $this->constant_to_array(\OCLC\config::XID_XISBN_VALID_LIBRARIES);
    if(in_array($library, $valid_libraries)) {
      return true;
    } else {
      throw new \OCLC\OCLCException('Invalid `library`. Valid values include ' . $this->constant_to_string(\OCLC\config::XID_XISBN_VALID_LIBRARIES) . '.');
      return false;
    }
  }

}

?>
