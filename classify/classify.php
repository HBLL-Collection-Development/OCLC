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

namespace OCLC\classify;

class classify {
  const BASE_URL = 'http://classify.oclc.org/classify2/Classify?';
  private $format;

  /**
   * Constructor. Sets format if it was given at instantiation of class
   *
   * @access public
   * @param string $format Format type. Valid values: `xml`, `json`, `php_object`, `php_array`, `null`
   */
  public function __construct($format = null) {
    $this->set_format($format);
  }

  /**
   * Sets the format
   *
   * @access public
   * @param string $format Format type. Valid values: `xml`, `json`, `php_object`, `php_array`, `null`
   * @throws OCLCException if invalid format is used
   */
  public function set_format($format = null) {
    switch ($format) {
      case 'xml':
      case 'json':
      case 'php_object':
      case 'php_array': $this->format = $format; break;
      case null:        $this->format = 'php_array'; break;
      default:
        throw new \OCLC\OCLCException("Invalid format.\n\nValid formats include `xml`, `json`, `php_object`, and `php_array`.");
        break;
    }
  }

  /**
   * Runs \OCLC\classify::get_stdnbr() and retrieves search results
   *
   * @access public
   * @param string $stdnbr Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
   */
  public function stdnbr($stdnbr, $options = null) {
    return $this->get_stdnbr($stdnbr, $options);
  }

  /**
   * @see \OCLC\classify::stdnbr()
   */
  public function standard_number($stdnbr, $options = null) {
    return $this->get_stdnbr($stdnbr, $options);
  }

  /**
   * Runs \OCLC\classify::get_oclc() and retrieves search results
   *
   * @access public
   * @param string $oclc Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
   */
  public function oclc($oclc, $options = null) {
    return $this->get_oclc($oclc, $options);
  }

  /**
   * Runs \OCLC\classify::get_isbn() and retrieves search results
   *
   * @access public
   * @param string $isbn Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
   */
  public function isbn($isbn, $options = null) {
    return $this->get_isbn($isbn, $options);
  }

  /**
   * Runs \OCLC\classify::get_upc() and retrieves search results
   *
   * @access public
   * @param string $upc Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
   */
  public function upc($upc, $options = null) {
    return $this->get_upc($upc, $options);
  }

  /**
   * Runs \OCLC\classify::get_ident() and retrieves search results
   *
   * @access public
   * @param string $ident Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
   */
  public function ident($ident, $options = null) {
    return $this->get_ident($ident, $options);
  }

  /**
   * Runs \OCLC\classify::get_heading() and retrieves search results
   *
   * @access public
   * @param string $heading Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
   */
  public function heading($heading, $options = null) {
    return $this->get_heading($heading, $options);
  }

  /**
   * Runs \OCLC\classify::get_lccn() and retrieves search results
   *
   * @access public
   * @param string $lccn Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
   */
  public function lccn($lccn, $options = null) {
    return $this->get_lccn($lccn, $options);
  }

  /**
   * Runs \OCLC\classify::get_lccn_pfx() and retrieves search results
   *
   * @access public
   * @param string $lccn_pfx Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
   */
  public function lccn_pfx($lccn_pfx, $options = null) {
    return $this->get_lccn_pfx($lccn_pfx, $options);
  }

  /**
   * Runs \OCLC\classify::get_lccn_yr() and retrieves search results
   *
   * @access public
   * @param string $lccn_yr Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
   */
  public function lccn_yr($lccn_yr, $options = null) {
    return $this->get_lccn_yr($lccn_yr, $options);
  }

  /**
   * Runs \OCLC\classify::get_lccn_sno() and retrieves search results
   *
   * @access public
   * @param string $lccn_sno Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
   */
  public function lccn_sno($lccn_sno, $options = null) {
    return $this->get_lccn_sno($lccn_sno, $options);
  }

  /**
   * Runs \OCLC\classify::get_swid() and retrieves search results
   *
   * @access public
   * @param string $swid Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
   */
  public function swid($swid, $options = null) {
    return $this->get_swid($swid, $options);
  }

  /**
   * Runs \OCLC\classify::get_author() and retrieves search results
   *
   * @access public
   * @param string $author Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
   */
  public function author($author, $options = null) {
    return $this->get_author($author, $options);
  }

  /**
   * Runs \OCLC\classify::get_title() and retrieves search results
   *
   * @access public
   * @param string $title Search term.
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
   */
  public function title($title, $options = null) {
    return $this->get_title($title, $options);
  }

  /**
   * Runs \OCLC\classify::get_multi() and retrieves search results
   *
   * @access public
   * @param array $array Search types and terms to use
   * @param array $options Options to use in search
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
   */
  public function multi($array, $options = null) {
    return $this->get_multi($array, $options);
  }

  /**
   * @see \OCLC\classify::stdnbr()
   */
  private function get_stdnbr($stdnbr, $options) {
    return $this->get_classify_data('stdnbr', $stdnbr, $options);
  }

  /**
   * @see \OCLC\classify::oclc()
   */
  private function get_oclc($oclc, $options) {
    return $this->get_classify_data('oclc', $oclc, $options);
  }

  /**
   * @see \OCLC\classify::isbn()
   */
  private function get_isbn($isbn, $options) {
    return $this->get_classify_data('isbn', $isbn, $options);
  }

  /**
   * @see \OCLC\classify::upc()
   */
  private function get_upc($upc, $options) {
    return $this->get_classify_data('upc', $upc, $options);
  }

  /**
   * @see \OCLC\classify::ident()
   */
  private function get_ident($ident, $options) {
    return $this->get_classify_data('ident', $ident, $options);
  }

  /**
   * @see \OCLC\classify::heading()
   */
  private function get_heading($heading, $options) {
    return $this->get_classify_data('heading', $heading, $options);
  }

  /**
   * @see \OCLC\classify::lccn()
   */
  private function get_lccn($lccn, $options) {
    return $this->get_classify_data('lccn', $lccn, $options);
  }

  /**
   * @see \OCLC\classify::lccn_pfx()
   */
  private function get_lccn_pfx($lccn_pfx, $options) {
    return $this->get_classify_data('lccn_pfx', $lccn_pfx, $options);
  }

  /**
   * @see \OCLC\classify::lccn_yr()
   */
  private function get_lccn_yr($lccn_yr, $options) {
    return $this->get_classify_data('lccn_yr', $lccn_yr, $options);
  }

  /**
   * @see \OCLC\classify::lccn_sno()
   */
  private function get_lccn_sno($lccn_sno, $options) {
    return $this->get_classify_data('lccn_sno', $lccn_sno, $options);
  }

  /**
   * @see \OCLC\classify::swid()
   */
  private function get_swid($swid, $options) {
    return $this->get_classify_data('swid', $swid, $options);
  }

  /**
   * @see \OCLC\classify::author()
   */
  private function get_author($author, $options) {
    return $this->get_classify_data('author', $author, $options);
  }

  /**
   * @see \OCLC\classify::title()
   */
  private function get_title($title, $options) {
    return $this->get_classify_data('title', $title, $options);
  }

  /**
   * @see \OCLC\classify::multi()
   */
  private function get_multi($search, $options) {
    if(is_array($search)) {
      return $this->get_classify_data('multi', $search, $options);
    } else {
      throw new \OCLC\OCLCException("If you want to search multiple fields at once, the search terms must be placed in an array.\n\nValid search fields include `stdnbr` (or `standard_number`), `oclc`, `isbn`, `issn`, `upc`, `ident`, `heading`, `lccn`, `lccn_pfx`, `lccn_yr`, `lccn_sno`, `swid`, `author`, `title`.");
    }
  }

  /**
   * Gets data from Classify service and returns it in format specified by $this->format()
   *
   * @access private
   * @param string $type Search type. Valid values include `stdnbr` (or `standard_number`), `oclc`, `isbn`, `issn`, `upc`, `ident`, `heading`, `lccn`, `lccn_pfx`, `lccn_yr`, `lccn_sno`, `swid`, `author`, `title`, or `multi`.
   * @param string|array $search Search term(s) to use.
   * @param array $options Options to use in search.
   * @return string|object|array Search result from OCLC formatted per $this->format (`xml`, `json`, `php_object`, or `php_array` [default])
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
   * @param string $type Search type. Valid values include `stdnbr` (or `standard_number`), `oclc`, `isbn`, `issn`, `upc`, `ident`, `heading`, `lccn`, `lccn_pfx`, `lccn_yr`, `lccn_sno`, `swid`, `author`, `title`, or `multi`.
   * @param string|array $search Search term(s) to use.
   * @param array $options Options to use in search.
   * @return string Search URL.
   */
  private function get_search_url($type, $search, $options) {
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
          throw new \OCLC\OCLCException('Only `multi` searches should be an array. Please try again using a string.');
        }
      // Construct URL parameters for search
      } elseif (!is_array($search)) {
        $search = $type . '=' . $search;
      // Otherwise, throw an exception
      } else {
        throw new \OCLC\OCLCException('Only `multi` searches should be an array. Please try again using a string.');
      }
    }
    return self::BASE_URL . $search . $this->set_options($options);
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
      throw new \OCLC\OCLCException("Classify options must be passed as an array.\n\nValid options are `summary` (bool), `maxRecs` (int), `orderBy` (string), and `startRec` (int).");
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
    $valid_search_types = array('stdnbr', 'standard_number', 'oclc', 'isbn', 'issn', 'upc', 'ident', 'heading', 'lccn', 'lccn_pfx', 'lccn_yr', 'lccn_sno', 'swid', 'author', 'title');
    foreach($search as $key => $value) {
      if(!in_array($key, $valid_search_types)) {
        throw new \OCLC\OCLCException("Invalid search attempted.\n\nValid search fields include `stdnbr` (or `standard_number`), `oclc`, `isbn`, `issn`, `upc`, `ident`, `heading`, `lccn`, `lccn_pfx`, `lccn_yr`, `lccn_sno`, `swid`, `author`, `title`.");
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
    $options_array       = null;
    $valid_orderBy_types = array('mancount asc', 'mancount desc', 'hold asc', 'hold desc', 'lyr asc', 'lyr desc', 'hyr asc', 'hyr desc', 'ln asc', 'ln desc', 'sheading asc', 'sheading desc', 'works asc', 'works desc', 'type asc', 'type desc');
    foreach($options as $key => $value) {
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
          if(in_array($value, $valid_orderBy_types)) {
            $options_array['orderBy'] = $value;
          } else {
            throw new \OCLC\OCLCException("Invalid orderBy value.\n\nValid values are `mancount asc`, `mancount desc`, `hold asc`, `hold desc`, `lyr asc`, `lyr desc`, `hyr asc`, `hyr desc`, `ln asc`, `ln desc`, `sheading asc`, `sheading desc`, `works asc`, `works desc`, `type asc`, `type desc`.");
          }
          break;
        case 'startRec':
          $options_array['startRec'] = (int) $value;
          break;
        default:
          throw new \OCLC\OCLCException("Invalid option parameter.\n\nValid parameters are `summary` (bool), `maxRecs` (int), `orderBy` (string), and `startRec` (int).");
          break;
      }
    }
    return $options_array;
  }

}
?>
