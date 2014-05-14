<?php
/**
  * Class to search OCLC xStandardNumber Web Service
  *
  * @link http://www.oclc.org/developer/develop/web-services/xid-api/xstandardNumber-resource.en.html
  * @author Jared Howland <oclc@jaredhowland.com>
  * @version 2014-05-13
  * @since 2014-05-13
  *
  */

namespace OCLC\xID;

class xstandardnumber extends xid {

  private $base_url;

  /**
   * Constructor. Sets WorldCat Affiliate ID if passed when instantiated.
   *
   * @access public
   * @param string $ai WorldCat Affiliate ID.
   */
  public function __construct($ai = null) {
    parent::set_ai($ai);
    $this->base_url = 'http://xisbn' . parent::BASE_URL;
  }

  /**
   * Queries xStandardNumber service using getMetadata
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function getMetadata($number_type, $number, $options = null) {
    return file_get_contents($this->construct_url('getMetadata', $number_type, $number, $options));
  }

  /**
   * Queries xStandardNumber service using getMetadata
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function get_metadata($number_type, $number, $options = null) {
    return $this->getMetadata($number_type, $number, $options);
  }

  /**
   * Queries xStandardNumber service using getMetadata by LCCN
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function getMetadataByLccn($number, $options = null) {
    return $this->getMetadata('lccn', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getMetadata by LCCN
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function get_metadata_by_lccn($number, $options = null) {
    return $this->getMetadata('lccn', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getMetadata by OCLC number
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function getMetadataByOclcNum($number, $options = null) {
    return $this->getMetadata('oclcnum', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getMetadata by OCLC number
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function get_metadata_by_oclc_num($number, $options = null) {
    return $this->getMetadata('oclcnum', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getMetadata by OCLC Work ID
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function getMetadataByOwi($number, $options = null) {
    return $this->getMetadata('owi', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getMetadata by OCLC Work ID
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function get_metadata_by_owi($number, $options = null) {
    return $this->getMetadata('owi', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getEditions
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function getEditions($number_type, $number, $options = null) {
    return file_get_contents($this->construct_url('getEditions', $number_type, $number, $options));
  }

  /**
   * Queries xStandardNumber service using getEditions
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function get_editions($number_type, $number, $options = null) {
    return $this->getEditions($number_type, $number, $options);
  }

  /**
   * Queries xStandardNumber service using getEditions by LCCN
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function getEditionsByLccn($number, $options = null) {
    return $this->getEditions('lccn', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getEditions by LCCN
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function get_editions_by_lccn($number, $options = null) {
    return $this->getEditions('lccn', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getEditions by OCLC number
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function getEditionsByOclcNum($number, $options = null) {
    return $this->getEditions('oclcnum', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getEditions by OCLC number
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function get_editions_by_oclc_num($number, $options = null) {
    return $this->getEditions('oclcnum', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getEditions by OCLC Work ID
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function getEditionsByOwi($number, $options = null) {
    return $this->getEditions('owi', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getEditions by OCLC Work ID
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function get_editions_by_owi($number, $options = null) {
    return $this->getEditions('owi', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getVariants
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function getVariants($number_type, $number, $options = null) {
    return file_get_contents($this->construct_url('getVariants', $number_type, $number, $options));
  }

  /**
   * Queries xStandardNumber service using getVariants
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function get_variants($number_type, $number, $options = null) {
    return $this->getVariants($number_type, $number, $options);
  }

  /**
   * Queries xStandardNumber service using getVariants by LCCN
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function getVariantsByLccn($number, $options = null) {
    return $this->getVariants('lccn', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getVariants by LCCN
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function get_variants_by_lccn($number, $options = null) {
    return $this->getVariants('lccn', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getVariants by OCLC number
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function getVariantsByOclcNum($number, $options = null) {
    return $this->getVariants('oclcnum', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getVariants by OCLC number
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function get_variants_by_oclc_num($number, $options = null) {
    return $this->getVariants('oclcnum', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getVariants by OCLC Work ID
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function getVariantsByOwi($number, $options = null) {
    return $this->getVariants('owi', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getVariants by OCLC Work ID
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are `lccn`, `oclcnum`, `owi`.
   * @param string $number Number to search by.
   * @param array $options Options array.
   * @return string|array Results of query
   */
  public function get_variants_by_owi($number, $options = null) {
    return $this->getVariants('owi', $number, $options);
  }

  /**
   * Generates hash based on the number being searched, the originating IP address, and the app secret
   *
   * @access public
   * @param string $number Number to search by.
   * @param string $ip Originating IP address.
   * @param string $secret App secret.
   * @return string Generated hash that can be used in a query.
   */
  public function generateHash($number, $ip, $secret) {
    return $this->create_hash($this->base_url, $number, $ip, $secret);
  }

  /**
   * Generates hash based on the number being searched, the originating IP address, and the app secret
   *
   * @access public
   * @param string $number Number to search by.
   * @param string $ip Originating IP address.
   * @param string $secret App secret.
   * @return string Generated hash that can be used in a query.
   */
  public function generate_hash($number, $ip, $secret) {
    return $this->generateHash($number, $ip, $secret);
  }

  /**
   * Constructs URL
   *
   * @access public
   * @param string $type Type of search to run. Valid values are `getMetadata`, `getEditions`, and `getVariants`.
   * @param string $number_type Type of number being searched. Valid values are `lccn`, `oclcnum`, and `owi`.
   * @param string $number Number being searched.
   * @param array Options array.
   * @return string Generated URL for query.
   */
  private function construct_url($type, $number_type, $number, $options = null) {
    return $this->base_url . $number_type . '/' . $number . '?method=' . $type . $this->set_options($options) . $this->ai;
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
          if($this->validate_standard_number_fls($value)) { $options_array['fl'] = $value; }
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

  /**
   * Validates number type.
   *
   * @access private
   * @param string $number_type Number type to search by.
   * @return bool TRUE if valid, FALSE otherwise.
   * @throws OCLCException if an invalid number type is attempted.
   */
  private function validate_number_type($number_type) {
    $valid_number_types = array('lccn', 'oclcnum', 'owi');
    if(in_array($number_type, $valid_number_types)) {
      return true;
    } else {
      throw new \OCLC\OCLCException("Invalid number type.\n\nValid values include `lccn`, `oclcnum`, and `owi`");
      return false;
    }
  }

  private function validate_standard_number_fls($fls) {
    $valid_fl = array('lccn', 'oclcnum', 'owi', 'presentOclcnum', 'url', '*');
    $fl       = explode(',', $fls);
    foreach($fl as $value) {
      if(!in_array($value, $valid_fl)) {
        throw new \OCLC\OCLCException("Invalid `fl`. Valid values include `lccn`, `oclcnum`, `owi`, `presentOclcnum`, `url`, and `*`.");
        return false;
      }
    }
    return true;
  }

}

?>
