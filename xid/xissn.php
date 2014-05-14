<?php
/**
  * Class to search OCLC xISSN Web Service
  *
  * @link http://www.oclc.org/developer/develop/web-services/xid-api/xissn-resource.en.html
  * @author Jared Howland <oclc@jaredhowland.com>
  * @version 2014-05-13
  * @since 2014-05-13
  *
  */

namespace OCLC\xID;

class xissn extends xid {

  private $base_url;

  /**
   * Constructor. Sets WorldCat Affiliate ID if passed when instantiated.
   *
   * @access public
   * @param string $ai WorldCat Affiliate ID.
   */
  public function __construct($ai = null) {
    parent::set_ai($ai);
    $this->base_url = 'http://xissn' . parent::BASE_URL . 'issn/';
  }

  /**
   * Queries xISSN service using fixChecksum
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values include `format`, `callback`, `fl`, `hash`, and `token`.
   * @return string|array Results of query
   */
  public function fixChecksum($issn, $options = null) {
    return file_get_contents($this->construct_url('fixChecksum', $issn, $options));
  }

  /**
   * Queries xISSN service using fixChecksum
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values include `format`, `callback`, `fl`, `hash`, and `token`.
   * @return string|array Results of query
   */
  public function fix_checksum($issn, $options = null) {
    return $this->fixChecksum($issn, $options);
  }

  /**
   * Queries xISSN service using getMetadata
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values include `format`, `callback`, `fl`, `hash`, and `token`.
   * @return string|array Results of query
   */
  public function getMetadata($issn, $options = null) {
    return file_get_contents($this->construct_url('getMetadata', $issn, $options));
  }

  /**
   * Queries xISSN service using getMetadata
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values include `format`, `callback`, `fl`, `hash`, and `token`.
   * @return string|array Results of query
   */
  public function get_metadata($issn, $options = null) {
    return $this->getMetadata($issn, $options);
  }

  /**
   * Queries xISSN service using getEditions
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values include `format`, `callback`, `fl`, `hash`, and `token`.
   * @return string|array Results of query
   */
  public function getEditions($issn, $options = null) {
    return file_get_contents($this->construct_url('getEditions', $issn, $options));
  }

  /**
   * Queries xISSN service using getEditions
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values include `format`, `callback`, `fl`, `hash`, and `token`.
   * @return string|array Results of query
   */
  public function get_editions($issn, $options = null) {
    return $this->getEditions($issn, $options);
  }

  /**
   * Queries xISSN service using getForms
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values include `format`, `callback`, `fl`, `hash`, and `token`.
   * @return string|array Results of query
   */
  public function getForms($issn, $options = null) {
    return file_get_contents($this->construct_url('getForms', $issn, $options));
  }

  /**
   * Queries xISSN service using getForms
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values include `format`, `callback`, `fl`, `hash`, and `token`.
   * @return string|array Results of query
   */
  public function get_forms($issn, $options = null) {
    return $this->getForms($issn, $options);
  }

  /**
   * Queries xISSN service using getHistory
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values include `format`, `callback`, `fl`, `hash`, and `token`.
   * @return string|array Results of query
   */
  public function getHistory($issn, $options = null) {
    return file_get_contents($this->construct_url('getHistory', $issn, $options));
  }

  /**
   * Queries xISSN service using getHistory
   *
   * @access public
   * @param string $issn ISSN to search by.
   * @param array $options Options array. Valid values include `format`, `callback`, `fl`, `hash`, and `token`.
   * @return string|array Results of query
   */
  public function get_history($issn, $options = null) {
    return $this->getHistory($issn, $options);
  }

  /**
   * Generates hash based on the number being searched, the originating IP address, and the app secret
   *
   * @access public
   * @param string $term ISSN to search by.
   * @param string $ip Originating IP address.
   * @param string $secret App secret.
   * @return string Generated hash that can be used in a query.
   */
  public function generateHash($term, $ip, $secret) {
    return $this->create_hash($this->base_url, $term, $ip, $secret);
  }

  /**
   * Generates hash based on the number being searched, the originating IP address, and the app secret
   *
   * @access public
   * @param string $term ISSN to search by.
   * @param string $ip Originating IP address.
   * @param string $secret App secret.
   * @return string Generated hash that can be used in a query.
   */
  public function generate_hash($term, $ip, $secret) {
    return $this->generateHash($term, $ip, $secret);
  }

  /**
   * Constructs URL
   *
   * @access public
   * @param string $type Type of search to run. Valid values are `getMetadata`, `getEditions`, `fixChecksum`, `getForms`, and `getHistory`.
   * @param string $issn ISSN being searched.
   * @param array Options array. Valid values include `format`, `callback`, `fl`, `hash`, and `token`.
   * @return string Generated URL for query.
   */
  private function construct_url($type, $issn, $options = null) {
    return $this->base_url . $issn . '?method=' . $type . $this->set_options($options) . $this->ai;
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
      throw new \OCLC\OCLCException("xISSN options must be passed as an array.\n\nValid values include `format`, `callback`, `fl`, `hash`, and `token`.");
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
          throw new \OCLC\OCLCException("Invalid search option used.\n\nValid values include `format`, `callback`, `fl`, `hash`, and `token`.");
          break;
      }
    }
    if(!$options_array['fl']) { $options_array['fl'] = '*'; }
    return $options_array;
  }

}

?>
