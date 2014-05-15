<?php
/**
  * Class to search OCLC xISSN Web Service
  *
  * @link http://www.oclc.org/developer/develop/web-services/xid-api/xissn-resource.en.html
  * @author Jared Howland <oclc@jaredhowland.com>
  * @version 2014-05-14
  * @since 2014-05-13
  *
  */

namespace OCLC\Xid;

class Xissn extends Xid {

  protected $base_url;

  /**
   * Constructor. Sets WorldCat Affiliate ID if passed when instantiated.
   *
   * @access public
   * @param string $ai WorldCat Affiliate ID.
   */
  public function __construct($ai = null) {
    parent::set_ai($ai);
    $this->base_url = 'http://xissn' . \OCLC\Config::XID_BASE_URL . 'issn/';
  }

  /**
   * Queries xISSN service using fixChecksum
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_XISSN_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function fixChecksum($issn, $options = null) {
    return $this->get_data(__FUNCTION__, $isbn, $options);
  }
    /**
   * @see \OCLC\Xid\Xissn::fixChecksum()
   */
  public function fix_checksum($issn, $options = null) {
    return $this->fixChecksum($issn, $options);
  }

  /**
   * Queries xISSN service using getMetadata
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_XISSN_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getMetadata($issn, $options = null) {
    return $this->get_data(__FUNCTION__, $isbn, $options);
  }
    /**
   * @see \OCLC\Xid\Xissn::getMetadata()
   */
  public function get_metadata($issn, $options = null) {
    return $this->getMetadata($issn, $options);
  }

  /**
   * Queries xISSN service using getEditions
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_XISSN_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getEditions($issn, $options = null) {
    return $this->get_data(__FUNCTION__, $isbn, $options);
  }
    /**
   * @see \OCLC\Xid\Xissn::getEditions()
   */
  public function get_editions($issn, $options = null) {
    return $this->getEditions($issn, $options);
  }

  /**
   * Queries xISSN service using getForms
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_XISSN_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getForms($issn, $options = null) {
    return $this->get_data(__FUNCTION__, $isbn, $options);
  }
    /**
   * @see \OCLC\Xid\Xissn::getForms()
   */
  public function get_forms($issn, $options = null) {
    return $this->getForms($issn, $options);
  }

  /**
   * Queries xISSN service using getHistory
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_XISSN_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getHistory($issn, $options = null) {
    return $this->get_data(__FUNCTION__, $isbn, $options);
  }
    /**
   * @see \OCLC\Xid\Xissn::getHistory()
   */
  public function get_history($issn, $options = null) {
    return $this->getHistory($issn, $options);
  }

  /**
   * Grab the data from OCLC.
   *
   * @access private
   * @param string $type Type of search to run. Valid values are `fixChecksum`, `getMetadata`, `getEditions`, `hyphenate`, `to10`, and `to13`.
   * @param string $issn ISSN being searched.
   * @param array Options array. Valid values are listed in \OCLC\Config::XID_XISSN_VALID_OPTIONS.
   * @return string|array Results of query.
   */
  private function get_data($type, $issn, $options = null) {
    $url = $this->base_url . $issn . '?method=' . $type . $this->set_options($options) . $this->ai;
    return file_get_contents($url);
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
      throw new \OCLC\OCLCException('xISSN options must be passed as an array. Valid values include ' . $this->constant_to_string(\OCLC\Config::XID_XISSN_VALID_OPTIONS) . '.');
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
      if(!in_array($key, $this->constant_to_array(\OCLC\Config::XID_XISSN_VALID_OPTIONS))) {
        throw new \OCLC\OCLCException('Invalid search option used. Valid values include ' . $this->constant_to_string(\OCLC\Config::XID_XISSN_VALID_OPTIONS) . '.');
        return false;
      } else {
        switch ($key) {
          case 'format':
            if($this->validate_format($value)) { $options_array['format'] = $value; }
            break;
          case 'fl':
            if($this->validate_fls($value)) { $options_array['fl'] = $value; }
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

}

?>
