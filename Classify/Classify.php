<?php
/**
  * Class to search OCLC Classify Web Service
  *
  * @link http://classify.oclc.org/classify2/api_docs/classify.html
  * @author Jared Howland <oclc@jaredhowland.com>
  * @version 2014-05-11
  * @since 2014-05-10
  *
  */

namespace OCLC\Classify;

class classify {

  private $format;

  /**
   * Constructor. Sets format if it was given at instantiation of class
   *
   * @access public
   * @param string $format Format type. Valid values are listed in \OCLC\Config::CLASSIFY_VALID_FORMATS.
   */
  public function __construct($format = null) {
    $this->set_format($format);
  }

  /**
   * Sets the format
   *
   * @access public
   * @param string $format Format type. Valid values are listed in \OCLC\Config::CLASSIFY_VALID_FORMATS.
   * @throws OCLCException if invalid format is used
   */
  public function set_format($format = null) {
    if(in_array($this->constant_to_array(\OCLC\Config::CLASSIFY_VALID_FORMATS))) {
      $this->format = $format;
    } elseif(is_null($format)) {
      $this->format = 'php_array';
    } else {
      throw new \OCLC\OCLCException('Invalid format. Valid formats include ' $this->constant_to_string(\OCLC\Config::CLASSIFY_VALID_FORMATS) . '.');
    }
  }

  /**
   * Runs \OCLC\Classify::get_stdnbr() and retrieves search results
   *
   * @access public
   * @param string $stdnbr Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  public function stdnbr($stdnbr, $options = null) {
    return $this->get_stdnbr($stdnbr, $options);
  }
  /**
   * @see \OCLC\Classify::stdnbr()
   */
  public function standard_number($stdnbr, $options = null) {
    return $this->get_stdnbr($stdnbr, $options);
  }

  /**
   * Runs \OCLC\Classify::get_oclc() and retrieves search results
   *
   * @access public
   * @param string $oclc Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  public function oclc($oclc, $options = null) {
    return $this->get_oclc($oclc, $options);
  }

  /**
   * Runs \OCLC\Classify::get_isbn() and retrieves search results
   *
   * @access public
   * @param string $isbn Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  public function isbn($isbn, $options = null) {
    return $this->get_isbn($isbn, $options);
  }

  /**
   * Runs \OCLC\Classify::get_upc() and retrieves search results
   *
   * @access public
   * @param string $upc Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  public function upc($upc, $options = null) {
    return $this->get_upc($upc, $options);
  }

  /**
   * Runs \OCLC\Classify::get_ident() and retrieves search results
   *
   * @access public
   * @param string $ident Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  public function ident($ident, $options = null) {
    return $this->get_ident($ident, $options);
  }

  /**
   * Runs \OCLC\Classify::get_heading() and retrieves search results
   *
   * @access public
   * @param string $heading Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  public function heading($heading, $options = null) {
    return $this->get_heading($heading, $options);
  }

  /**
   * Runs \OCLC\Classify::get_lccn() and retrieves search results
   *
   * @access public
   * @param string $lccn Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  public function lccn($lccn, $options = null) {
    return $this->get_lccn($lccn, $options);
  }

  /**
   * Runs \OCLC\Classify::get_lccn_pfx() and retrieves search results
   *
   * @access public
   * @param string $lccn_pfx Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  public function lccn_pfx($lccn_pfx, $options = null) {
    return $this->get_lccn_pfx($lccn_pfx, $options);
  }

  /**
   * Runs \OCLC\Classify::get_lccn_yr() and retrieves search results
   *
   * @access public
   * @param string $lccn_yr Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  public function lccn_yr($lccn_yr, $options = null) {
    return $this->get_lccn_yr($lccn_yr, $options);
  }

  /**
   * Runs \OCLC\Classify::get_lccn_sno() and retrieves search results
   *
   * @access public
   * @param string $lccn_sno Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  public function lccn_sno($lccn_sno, $options = null) {
    return $this->get_lccn_sno($lccn_sno, $options);
  }

  /**
   * Runs \OCLC\Classify::get_swid() and retrieves search results
   *
   * @access public
   * @param string $swid Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  public function swid($swid, $options = null) {
    return $this->get_swid($swid, $options);
  }

  /**
   * Runs \OCLC\Classify::get_author() and retrieves search results
   *
   * @access public
   * @param string $author Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  public function author($author, $options = null) {
    return $this->get_author($author, $options);
  }

  /**
   * Runs \OCLC\Classify::get_title() and retrieves search results
   *
   * @access public
   * @param string $title Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  public function title($title, $options = null) {
    return $this->get_title($title, $options);
  }

  /**
   * Runs \OCLC\Classify::get_multi() and retrieves search results
   *
   * @access public
   * @param array $array Search types and terms to use
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  public function multi($array, $options = null) {
    return $this->get_multi($array, $options);
  }

  /**
   * @see \OCLC\Classify::stdnbr()
   */
  private function get_stdnbr($stdnbr, $options) {
    return $this->get_classify_data('stdnbr', $stdnbr, $options);
  }

  /**
   * @see \OCLC\Classify::oclc()
   */
  private function get_oclc($oclc, $options) {
    return $this->get_classify_data('oclc', $oclc, $options);
  }

  /**
   * @see \OCLC\Classify::isbn()
   */
  private function get_isbn($isbn, $options) {
    return $this->get_classify_data('isbn', $isbn, $options);
  }

  /**
   * @see \OCLC\Classify::upc()
   */
  private function get_upc($upc, $options) {
    return $this->get_classify_data('upc', $upc, $options);
  }

  /**
   * @see \OCLC\Classify::ident()
   */
  private function get_ident($ident, $options) {
    return $this->get_classify_data('ident', $ident, $options);
  }

  /**
   * @see \OCLC\Classify::heading()
   */
  private function get_heading($heading, $options) {
    return $this->get_classify_data('heading', $heading, $options);
  }

  /**
   * @see \OCLC\Classify::lccn()
   */
  private function get_lccn($lccn, $options) {
    return $this->get_classify_data('lccn', $lccn, $options);
  }

  /**
   * @see \OCLC\Classify::lccn_pfx()
   */
  private function get_lccn_pfx($lccn_pfx, $options) {
    return $this->get_classify_data('lccn_pfx', $lccn_pfx, $options);
  }

  /**
   * @see \OCLC\Classify::lccn_yr()
   */
  private function get_lccn_yr($lccn_yr, $options) {
    return $this->get_classify_data('lccn_yr', $lccn_yr, $options);
  }

  /**
   * @see \OCLC\Classify::lccn_sno()
   */
  private function get_lccn_sno($lccn_sno, $options) {
    return $this->get_classify_data('lccn_sno', $lccn_sno, $options);
  }

  /**
   * @see \OCLC\Classify::swid()
   */
  private function get_swid($swid, $options) {
    return $this->get_classify_data('swid', $swid, $options);
  }

  /**
   * @see \OCLC\Classify::author()
   */
  private function get_author($author, $options) {
    return $this->get_classify_data('author', $author, $options);
  }

  /**
   * @see \OCLC\Classify::title()
   */
  private function get_title($title, $options) {
    return $this->get_classify_data('title', $title, $options);
  }

  /**
   * @see \OCLC\Classify::multi()
   */
  private function get_multi($search, $options) {
    if(is_array($search)) {
      return $this->get_classify_data('multi', $search, $options);
    } else {
      throw new \OCLC\OCLCException('If you want to search multiple fields at once, the search terms must be placed in an array. Valid search fields include ' . $this->constant_to_string(\OCLC\Config::CLASSIFY_VALID_SEARCHES) . '.');
    }
  }

  /**
   * Gets data from Classify service and returns it in format specified by $this->format()
   *
   * @access private
   * @param string $type Search type. Valid values include are listed in \OCLC\Config::CLASSIFY_VALID_SEARCHES.
   * @param string|array $search Search term(s) to use.
   * @param array $options Options to use in search.
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  private function get_classify_data($type, $search, $options) {
    $url = $this->get_search_url($type, $search, $options);
    switch ($this->format) {
      case 'xml':        return file_get_contents($url); break;
      case 'json':       return json_encode(simplexml_load_file(urlencode($url))); break;
      case 'php_object': return simplexml_load_file(urlencode($url)); break;
      // Quick and dirty XML to PHP array solution
      // Possible better solution for future: http://www.lalit.org/lab/convert-xml-to-array-in-php-xml2array/
      case 'php_array':  return json_decode(json_encode(simplexml_load_file(urlencode($url))), true); break;
      default:           return json_decode(json_encode(simplexml_load_file(urlencode($url))), true); break;
    }
  }

  /**
   * Creates the correct search URL to be used to query the Classify service.
   *
   * @access private
   * @param string $type Search type. Valid values are listed in \OCLC\Config::CLASSIFY_VALID_SEARCHES
   * @param string|array $search Search term(s) to use.
   * @param array $options Options to use in search.
   * @return string Search URL.
   */
  private function get_search_url($type, $search, $options) {
    $exception_message = 'Only `multi` searches should be an array. Please try again using a string.';
    // `multi` searches
    if($type == 'multi') {
      $search = http_build_query($this->validate_search($search));
    // All other searches
    } else {
      // Forgive using an array for a non-`multi` search if it matches the called method
      if(is_array($search) && count($search) == 1) {
        if(key($search) == $type) {
          $search = $type . '=' . reset($search);
        } else {
          throw new \OCLC\OCLCException($exception_message);
        }
      // Construct URL parameters for search
      } elseif (!is_array($search)) {
        $search = $type . '=' . $search;
      // Otherwise, throw an exception
      } else {
        throw new \OCLC\OCLCException($exception_message);
      }
    }
    return \OCLC\Config::CLASSIFY_BASE_URL . $search . $this->set_options($options);
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
      throw new \OCLC\OCLCException('Classify options must be passed as an array. Valid options are ' . $this->constant_to_string(\OCLC\Config::CLASSIFY_VALID_OPTIONS) . '.');
    }
  }

  /**
   * Validates search type when `multi` search is used.
   *
   * @access private
   * @param array $search Search types and terms.
   * @return array Validated search types and terms.
   * @throws OCLCException if an invalid search type is attempted.
   */
  private function validate_search($search) {
    foreach($search as $key => $value) {
      if(!in_array($key, $this->constant_to_array(\OCLC\Config::CLASSIFY_VALID_SEARCHES))) {
        throw new \OCLC\OCLCException('Invalid search attempted. Valid search fields include ' $this->constant_to_string(\OCLC\Config::CLASSIFY_VALID_SEARCHES)'.');
      }
    }
    return $search;
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
      if(!in_array($key, $this->constant_to_array(\OCLC\Config::CLASSIFY_VALID_OPTIONS))) {
        throw new \OCLC\OCLCException('Invalid search option used. Valid values include ' . $this->constant_to_string(\OCLC\Config::CLASSIFY_VALID_OPTIONS) . '.');
        return false;
      switch ($key) {
        case 'summary':
          if((bool) $value) {
            $options_array['summary'] = 'true';
          } else {
            $options_array['summary'] = 'false';
          }
          break;
        case 'maxRecs':
          $options_array['maxRecs'] = (int) $value;
          break;
        case 'orderBy':
          if(in_array($value, $this->constant_to_array(\OCLC\Config::CLASSIFY_VALID_ORDER_BYS))) {
            $options_array['orderBy'] = $value;
          } else {
            throw new \OCLC\OCLCException('Invalid orderBy value. Valid values are ' . $this->constant_to_string(\OCLC\Config::CLASSIFY_VALID_ORDER_BYS) . '.');
          }
          break;
        case 'startRec':
          $options_array['startRec'] = (int) $value;
          break;
      }
    }
    return $options_array;
  }

}
?>
