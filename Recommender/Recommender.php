<?php
/**
  * Class to search OCLC Recommender Web Service
  *
  * @link http://www.oclc.org/developer/develop/web-services/worldcat-recommender-service/recommender-service-resource.en.html
  * @author Jared Howland <oclc@jaredhowland.com>
  * @version 2014-05-19
  * @since 2014-05-19
  *
  */

namespace OCLC\Recommender;

class Recommender extends \OCLC\OCLC {

  private $format;

  /**
   * Constructor. Sets format if it was given at instantiation of class
   *
   * @access public
   * @param string $format Format type. Valid values are listed in \OCLC\Config::RECOMMENDER_VALID_FORMATS.
   */
  public function __construct($format = null) {
    $this->set_format($format);
  }

  public function get($number, $options = null) {
    return $this->get_recommender_data($number, $options);
  }

  /**
   * Sets the format
   *
   * @access public
   * @param string $format Format type. Valid values are listed in \OCLC\Config::RECOMMENDER_VALID_FORMATS.
   * @throws OCLCException if invalid format is used
   */
  public function set_format($format = null) {
    if(in_array($format, \OCLC\OCLC::constant_to_array(\OCLC\Config::RECOMMENDER_VALID_FORMATS))) {
      $this->format = $format;
    } elseif(is_null($format)) {
      $this->format = 'php_array';
    } else {
      throw new \OCLC\OCLCException('Invalid format. Valid formats include ' . \OCLC\OCLC::constant_to_string(\OCLC\Config::RECOMMENDER_VALID_FORMATS) . '.');
    }
  }

  /**
   * Gets data from Recommender service and returns it in format specified by $this->format()
   *
   * @access private
   * @param string $search Search term to use.
   * @param array $options Options to use in search.
   * @return string|object|array Search result from OCLC formatted per $this->format.
   */
  private function get_recommender_data($search, $options = null) {
    $xml = $this->get_xml($this->get_search_url($search, $options));
    switch ($this->format) {
      case 'xml':
        return $xml; break;
      case 'json':
        return json_encode(simplexml_load_string($xml));
        break;
      case 'php_object':
        return simplexml_load_string($xml); break;
      case 'php_array':
        // Quick and dirty XML to PHP array solution
        // Possible better solution for future: http://www.lalit.org/lab/convert-xml-to-array-in-php-xml2array/
        return json_decode(json_encode(simplexml_load_string($xml)), true); break;
      default:
        return json_decode(json_encode(simplexml_load_string($xml)), true); break;
    }
  }

  /**
   * Gets the XML from OCLC because
   *
   * @access private
   * @param array $search Search options.
   * @return array Validated search options.
   * @throws OCLCException if an invalid search option is attempted.
   */
  private function get_xml($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $return = curl_exec($ch);
    curl_close ($ch);
    return $return;
  }

  /**
   * Creates the correct search URL to be used to query the Recommender service.
   *
   * @access private
   * @param string|array $search Search term(s) to use.
   * @param array $options Options to use in search.
   * @return string Search URL.
   */
  private function get_search_url($search, $options = null) {
    return \OCLC\Config::RECOMMENDER_BASE_URL . $search . $this->set_options($options);
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
      return $this->options_to_url($options);
    } else {
      throw new \OCLC\OCLCException('Recommender options must be passed as an array. Valid options are ' . \OCLC\OCLC::constant_to_string(\OCLC\Config::RECOMMENDER_VALID_OPTIONS) . '.');
    }
  }

  /**
   * Transforms array of options into URL query string
   *
   * @access private
   * @param array $options Search options.
   * @return string Validated search options as URL string.
   */
  private function options_to_url($options) {
    $options = $this->validate_options($options);
    if(array_key_exists('sort', $options)) {
      $options['sort'] = $this->validate_sort($options['sort']);
    }
    return '?' . http_build_query($options);
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
      if(!in_array($key, \OCLC\OCLC::constant_to_array(\OCLC\Config::RECOMMENDER_VALID_OPTIONS))) {
        throw new \OCLC\OCLCException('Invalid search option used. Valid values include ' . \OCLC\OCLC::constant_to_string(\OCLC\Config::RECOMMENDER_VALID_OPTIONS) . '.');
        return false;
      } else {
        switch ($key) {
          case 'inst':
            $options_array['inst'] = $value;
            break;
          case 'count':
            $options_array['count'] = (int) $value;
            break;
          case 'sort':
            if(in_array($value, \OCLC\OCLC::constant_to_array(\OCLC\Config::RECOMMENDER_VALID_SORTS))) {
              $options_array['sort'] = $value;
            } else {
              throw new \OCLC\OCLCException('Invalid `sort` value. Valid values are ' . \OCLC\OCLC::constant_to_string(\OCLC\Config::RECOMMENDER_VALID_SORTS) . '.');
            }
            break;
          case 'format':
            $this->set_format($value);
            break;
        }
      }
    }
    return $options_array;
  }

  /**
   * Validates sort options.
   *
   * @access private
   * @param string $sort Sort option.
   * @return string Returns correctly named sort.
   * @throws OCLCException if an invalid sort option is attempted.
   */
  private function validate_sort($sort) {
    switch ($sort) {
      case 'title':
      case 'title asc':
        $sort = 'Title';
        break;
      case 'title desc':
        $sort = 'Title,,0';
        break;
      case 'author':
      case 'author asc':
        $sort = 'Author';
        break;
      case 'author desc':
        $sort = 'Author,,0';
        break;
      case 'date':
      case 'date asc':
        $sort = 'Date';
        break;
      case 'date desc':
        $sort = 'Date,,0';
        break;
      case 'library':
      case 'library asc':
        $sort = 'Library';
        break;
      case 'library desc':
        $sort = 'Library,,0';
        break;
      case 'count':
      case 'count asc':
        $sort = 'Count';
        break;
      case 'count desc':
        $sort = 'Count,,0';
        break;
      case 'score':
      case 'score asc':
        $sort = 'Score';
        break;
      case 'score desc':
        $sort = 'Score,,0';
        break;
      default:
        throw new \OCLC\OCLCException('Invalid sort option used. Valid values include ' . \OCLC\OCLC::constant_to_string(\OCLC\Config::RECOMMENDER_VALID_SORTS) . '.');
        return false;
        break;
    }
    return $sort;
  }

}
?>
