<?php
/**
  * Config class for OCLC library
  *
  * @author Jared Howland <oclc@jaredhowland.com>
  * @version 2014-05-14
  * @since 2014-05-14
  *
  */

namespace OCLC;

class config {
  /****************************************
   *            XID CONSTANTS             *
   ****************************************/
  const XID_BASE_URL      = '.worldcat.org/webservices/xid/';
  const XID_VALID_FLS     = 'author, city, ed, oclcnum, form, lang, publisher, title, url, year, *';
  const XID_VALID_FORMATS = 'csv, json, php, python, ruby, txt, html, xml';
}

?>
