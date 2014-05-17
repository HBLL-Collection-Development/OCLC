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

class Config {
  // Store constants in Config file so if things change with OCLC's APIs we only
  // have to change one file.

  /****************************************
   *           COMMON CONSTANTS           *
   ****************************************/
   const OCLC_VALID_SERVICES = 'Classify, Xisbn, Xissn, XStandardNumber';

  /****************************************
   *          CLASSIFY CONSTANTS          *
   ****************************************/
   const CLASSIFY_BASE_URL        = 'http://classify.oclc.org/classify2/Classify?';
   const CLASSIFY_VALID_FORMATS   = 'xml, json, php_object, php_array';
   const CLASSIFY_VALID_OPTIONS   = 'summary, maxRecs, orderBy, startRec';
   const CLASSIFY_VALID_SEARCHES  = 'stdnbr, standard_number, oclc, isbn, issn, upc, ident, heading, lccn, lccn_pfx, lccn_yr, lccn_sno, swid, author, title';
   const CLASSIFY_VALID_ORDER_BYS = 'mancount asc, mancount desc, hold asc, hold desc, lyr asc, lyr desc, hyr asc, hyr desc, ln asc, ln desc, sheading asc, sheading desc, works asc, works desc, type asc, type desc';

  /****************************************
   *            XID CONSTANTS             *
   ****************************************/
  const XID_BASE_URL      = '.worldcat.org/webservices/xid/';
  const XID_VALID_FLS     = 'author, city, ed, oclcnum, form, lang, publisher, title, url, year, *';
  const XID_VALID_FORMATS = 'csv, json, php, python, ruby, txt, html, xml';
  /////////////////////////
  // xISBN
  /////////////////////////
  const XID_XISBN_VALID_LIBRARIES = 'ebook, freebook, bookmooch, paperbackswap, wikipedia, oca, hathi';
  const XID_XISBN_VALID_OPTIONS   = 'format, callback, count, fl, hash, library, startIndex, token';
  /////////////////////////
  // xISSN
  /////////////////////////
  const XID_XISSN_VALID_OPTIONS = 'format, callback, fl, hash, token';
  /////////////////////////
  // xStandardNumber
  /////////////////////////
  const XID_XSTANDARD_NUMBER_VALID_OPTIONS      = 'format, callback, fl, hash, token';
  const XID_XSTANDARD_NUMBER_VALID_FLS          = 'lccn, oclcnum, owi, presentOclcnum, url, *';
  const XID_XSTANDARD_NUMBER_VALID_NUMBER_TYPES = 'lccn, oclcnum, owi';
}

?>
