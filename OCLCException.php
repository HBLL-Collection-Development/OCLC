<?php
/**
  * Exception class for OCLC APIs
  *
  * @author Jared Howland <oclc@jaredhowland.com>
  * @version 2014-05-11
  * @since 2014-05-10
  *
  */

namespace OCLC;

class OCLCException extends \Exception {
  /**
   * Constructs verbose message for OCLC library exceptions.
   *
   * @access public
   * @param string $message Message for exception
   * @param int $code Error code number
   * @param array $previous Previous exception
   */
  public function __construct($message, $code = 0, \Exception $previous = null) {
    $message = '<pre>OCLCException: ' . $message . "\n\n" . parent::getFile() . ' on line ' . parent::getLine() . "\n\n" . parent::getTraceAsString() . '</pre>';
    parent::__construct($message, $code, $previous);
  }
}
?>
