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

namespace OCLC\Xid;

class XStandardNumber extends Xid {

  protected $base_url;

  /**
   * Constructor. Sets WorldCat Affiliate ID if passed when instantiated.
   *
   * @access public
   * @param string $ai WorldCat Affiliate ID.
   */
  public function __construct($ai = null) {
    parent::set_ai($ai);
    $this->base_url = 'http://xisbn' . \OCLC\Config::XID_BASE_URL;
  }

  /**
   * Queries xStandardNumber service using getMetadata
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES.
   * @param string $number Number to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getMetadata($number_type, $number, $options = null) {
    return $this->get_data(__FUNCTION__, $number_type, $number, $options);
  }
  /**
   * @see \OCLC\Xid\XStandardNumber::getMetadata()
   */
  public function get_metadata($number_type, $number, $options = null) {
    return $this->getMetadata($number_type, $number, $options);
  }

  /**
   * Queries xStandardNumber service using getMetadata by LCCN
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES.
   * @param string $number Number to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getMetadataByLccn($number, $options = null) {
    return $this->getMetadata('lccn', $number, $options);
  }
  /**
   * @see \OCLC\Xid\XStandardNumber::getMetadataByLccn()
   */
  public function get_metadata_by_lccn($number, $options = null) {
    return $this->getMetadata('lccn', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getMetadata by OCLC number
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES.
   * @param string $number Number to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getMetadataByOclcNum($number, $options = null) {
    return $this->getMetadata('oclcnum', $number, $options);
  }
  /**
   * @see \OCLC\Xid\XStandardNumber::getMetadataByOclcNum()
   */
  public function get_metadata_by_oclc_num($number, $options = null) {
    return $this->getMetadata('oclcnum', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getMetadata by OCLC Work ID
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES.
   * @param string $number Number to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getMetadataByOwi($number, $options = null) {
    return $this->getMetadata('owi', $number, $options);
  }
  /**
   * @see \OCLC\Xid\XStandardNumber::getMetadataByOwi()
   */
  public function get_metadata_by_owi($number, $options = null) {
    return $this->getMetadata('owi', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getEditions
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES.
   * @param string $number Number to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getEditions($number_type, $number, $options = null) {
    return $this->get_data(__FUNCTION__, $number_type, $number, $options);
  }
  /**
   * @see \OCLC\Xid\XStandardNumber::getEditions()
   */
  public function get_editions($number_type, $number, $options = null) {
    return $this->getEditions($number_type, $number, $options);
  }

  /**
   * Queries xStandardNumber service using getEditions by LCCN
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES.
   * @param string $number Number to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getEditionsByLccn($number, $options = null) {
    return $this->getEditions('lccn', $number, $options);
  }
  /**
   * @see \OCLC\Xid\XStandardNumber::getEditionsByLccn()
   */
  public function get_editions_by_lccn($number, $options = null) {
    return $this->getEditions('lccn', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getEditions by OCLC number
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES.
   * @param string $number Number to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getEditionsByOclcNum($number, $options = null) {
    return $this->getEditions('oclcnum', $number, $options);
  }
  /**
   * @see \OCLC\Xid\XStandardNumber::getEditionsByOclcNum()
   */
  public function get_editions_by_oclc_num($number, $options = null) {
    return $this->getEditions('oclcnum', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getEditions by OCLC Work ID
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES.
   * @param string $number Number to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getEditionsByOwi($number, $options = null) {
    return $this->getEditions('owi', $number, $options);
  }
  /**
   * @see \OCLC\Xid\XStandardNumber::getEditionsByOwi()
   */
  public function get_editions_by_owi($number, $options = null) {
    return $this->getEditions('owi', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getVariants
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES.
   * @param string $number Number to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getVariants($number_type, $number, $options = null) {
    return $this->get_data(__FUNCTION__, $number_type, $number, $options);
  }
  /**
   * @see \OCLC\Xid\XStandardNumber::getVariants()
   */
  public function get_variants($number_type, $number, $options = null) {
    return $this->getVariants($number_type, $number, $options);
  }

  /**
   * Queries xStandardNumber service using getVariants by LCCN
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES.
   * @param string $number Number to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getVariantsByLccn($number, $options = null) {
    return $this->getVariants('lccn', $number, $options);
  }
  /**
   * @see \OCLC\Xid\XStandardNumber::getVariantsByLccn()
   */
  public function get_variants_by_lccn($number, $options = null) {
    return $this->getVariants('lccn', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getVariants by OCLC number
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES.
   * @param string $number Number to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getVariantsByOclcNum($number, $options = null) {
    return $this->getVariants('oclcnum', $number, $options);
  }
  /**
   * @see \OCLC\Xid\XStandardNumber::getVariantsByOclcNum()
   */
  public function get_variants_by_oclc_num($number, $options = null) {
    return $this->getVariants('oclcnum', $number, $options);
  }

  /**
   * Queries xStandardNumber service using getVariants by OCLC Work ID
   *
   * @access public
   * @param string $number_type Number type to search by. Valid options are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES.
   * @param string $number Number to search by.
   * @param array $options Options array. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return string|array Results of query
   */
  public function getVariantsByOwi($number, $options = null) {
    return $this->getVariants('owi', $number, $options);
  }
  /**
   * @see \OCLC\Xid\XStandardNumber::getVariantsByOwi()
   */
  public function get_variants_by_owi($number, $options = null) {
    return $this->getVariants('owi', $number, $options);
  }

  /**
   * Grab the data from OCLC.
   *
   * @access private
   * @param string $type Type of search to run. Valid values are `getMetadata`, `getEditions`, and `getVariants`.
   * @param string $number_type Type of number being searched. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES.
   * @param string $number Number being searched.
   * @param array Options array. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return string|array Results of query.
   */
  private function get_data($type, $number_type, $number, $options = null) {
    $url = return $this->base_url . $number_type . '/' . $number . '?method=' . $type . $this->set_options($options) . $this->ai;
    return file_get_contents($url);
  }

  /**
   * Sets options passed by user.
   *
   * @access private
   * @param array $options Options to use in search. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return string Options formatted as URL parameters.
   * @throws OCLCException if `options` is not an array.
   */
  private function set_options($options = null) {
    if(is_null($options)) {
      return $options;
    } elseif(is_array($options)) {
      return '&' . http_build_query($this->validate_options($options));
    } else {
      throw new \OCLC\OCLCException('xISSN options must be passed as an array. Valid values include ' $this->constant_to_string(\OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS) . '.');
    }
  }

  /**
   * Validates search options.
   *
   * @access private
   * @param array $search Search options. Valid values are listed in \OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS.
   * @return array|bool Validated search options in an array. FALSE if invalid options are used.
   * @throws OCLCException if an invalid search option is attempted.
   */
  private function validate_options($options) {
    $options_array = null;
    foreach($options as $key => $value) {
      if(!in_array($key, $this->constant_to_array(\OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS))) {
        throw new \OCLC\OCLCException('Invalid search option used. Valid values include ' . $this->constant_to_string(\OCLC\Config::XID_STANDARD_NUMBER_VALID_OPTIONS) . '.');
        return false;
      } else {
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
        }
      }
    }
    // Set default `fl` value if not present to be `*`.
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
    if(in_array($number_type, $this->constant_to_array(\OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES))) {
      return true;
    } else {
      throw new \OCLC\OCLCException('Invalid number type. Valid values include ' . $this->constant_to_string(\OCLC\Config::XID_STANDARD_NUMBER_VALID_TYPES) . '.');
      return false;
    }
  }

  /**
   * Validates fields for xStandardNumber service.
   *
   * @access private
   * @param array $fls Fields used in $options array
   * @return bool TRUE if valid, FALSE otherwise.
   * @throws OCLCException if an invalid field type is attempted.
   */
  private function validate_standard_number_fls($fls) {
    $fl = explode(',', $fls);
    foreach($fl as $value) {
      if(!in_array(trim($value), $this->constant_to_array(\OCLC\Config::XID_STANDARD_NUMBER_VALID_FLS))) {
        throw new \OCLC\OCLCException('Invalid `fl`. Valid values include ' . $this->constant_to_string(\OCLC\Config::XID_STANDARD_NUMBER_VALID_FLS) . '.');
        return false;
      }
    }
    return true;
  }

}

?>
