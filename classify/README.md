# Table of Contents
1. [Classify](#classify)
   1. [Minimal example](#minimal-example)
   2. [Search methods](#search-methods)
   3. [Options](#options)
   4. [Formats](#formats)
   5. [OCLC Response Codes](#oclc-response-codes)

# Classify
[Classify][1] allows you to classify books, videos, CDs and other materials based on identifier: ISBN, OCLC Number, UPC, ISSN, title, author, FAST headings, or FRBR work identifier. One use case is a set of eBooks without a call number. You can use the Classify service to look up the call number for those books. Currently, this is an experimental OCLC service.

## Usage

### Minimal example

```php
<?php

use OCLC\classify\classify;

try {
  $classify = new classify;
  $data     = $classify->stdnbr('785871937');
} catch (Exception $e) {
  echo $e->getMessage();
}

print_r($data);

?>
```

### Search methods

1. `stdnbr` or `standard_number`: The standard number (OCLC, ISBN, ISSN, UPC) number to search for.

   ```php
   $classify = new classify;
   $data1 = $classify->stdnbr('222654874');
   $data2 = $classify->standard_number('222654874');
   ```

2. `oclc`: The OCLC number to search for.

   ```php
   $classify = new classify;
   $data = $classify->oclc('155131850');
   ```

3. `isbn`: The ISBN to search for.

   ```php
   $classify = new classify;
   $data = $classify->isbn('9780545010221');
   ```

4. `issn`: The ISSN to search for.

   ```php
   $classify = new classify;
   $data = $classify->issn('1531-4650');
   ```

5. `upc`: The UPC code to search for.

   ```php
   $classify = new classify;
   $data = $classify->upc('085392246724');
   ```

6. `ident`: The FAST identifier to search for.

   ```php
   $classify = new classify;
   $data = $classify->ident('01394255');
   ```

7. `heading`: The FAST heading to search for.

   ```php
   $classify = new classify;
   $data = $classify->heading("Harry Potter and the philosopher's stone (Rowling, J. K.)");
   ```

8. `lccn`: [Library of Congress Control Number][2] (`2014-05-13`: call fails on OCLCs end)

   ```php
   $classify = new classify;
   $data = $classify->lccn('99023982');
   ```

9. `lccn_pfx`: [Library of Congress Control Number][2]—Prefix (`2014-05-13`: call fails on OCLCs end)

   ```php
   $classify = new classify;
   $data = $classify->lccn_pfx('sh');
   ```

10. `lccn_yr`: [Library of Congress Control Number][2]—Year (`2014-05-13`: call fails on OCLCs end)

   ```php
   $classify = new classify;
   $data = $classify->lccn_yr('2014');
   ```
11. `lccn_sno`: [Library of Congress Control Number][2]—Serial Number (`2014-05-13`: call fails on OCLCs end)

   ```php
   $classify = new classify;
   $data = $classify->lccn_sno('023982');
   ```

12. `swid`: The FRBR work identifier to search for.

   ```php
   $classify = new classify;
   $data = $classify->swid('34195');
   ```

13. `author`: The author name to search for.

   ```php
   $classify = new classify;
   $data = $classify->author('rowling');
   ```
14. `title`: The title to search for.

   ```php
   $classify = new classify;
   $data = $classify->title('Harry Potter and the Chamber of Secrets');
   ```

15. `multi`: Allows any combination of searche methods to be performed. Example:

  ```php
  $classify = new classify;
  $multi    = array('author' => 'rowling', 'title' => 'harry potter');
  $data = $classify->multi($multi);
  ```

OCLC `OR`s all terms together when you include multiple search options.

### Options

Options are included as an array after the search term(s). Example:

```php
$classify = new classify;
$options  = array('summary' => true, 'maxRecs' => 5);
$data = $classify->stdnbr('222654874', $options);
```

1. `summary`: Boolean. Summary or detailed record. Default: FALSE
2. `maxRecs`: Integer. Maximum number of records to be returned. Default: 25
4. `startRec`: Integer. Record to begin with (for pagination of results). Default: 1
4. `orderBy`: String. The desired sort order. Default: `hold desc`
    - `mancount asc` (number of editions, ascending)
    - `mancount desc` (number of editions descending)
    - `hold asc` (holdings, ascending)
    - `hold desc` (holdings, descending)
    - `lyr asc` (date of first edition, ascending)
    - `lyr desc` (date of first edition, descending)
    - `hyr asc` (date of latest edition, ascending)
    - `hyr desc` (date of latest edition, descending)
    - `ln asc` (language, ascending)
    - `ln desc` (language, descending)
    - `sheading asc` (FAST subject heading, ascending)
    - `sheading desc` (FAST subject heading, descending)
    - `works asc` (number of works with this FAST subject heading, ascending)
    - `works desc` (number of works with this FAST subject heading, descending)
    - `type asc` (FAST subject type, ascending)
    - `type desc` (FAST subject type, descending)

### Formats

Normally, `format` would be included in the options array but Classify only returns `XML` so I have created a special call for different formats. If OCLC ever includes different formats as a default option, I will incorporate it into the options.

Multiple output formats are available in this library. If no format is specified, a `PHP` array is returned. Available formats include the following:

1. `xml`
2. `json`
3. `php_object`
4. `php_array` (default)

Formats can be specified in two different ways:

```php
$classify = new classify('json');
$data = $classify->stdnbr('222654874');
```

OR

```php
$classify = new classify;
$classify->set_format('json');
$data = $classify->stdnbr('222654874');
```

### OCLC Response Codes

* `0`: Success. Single-work summary response provided.
* `2`: Success. Single-work detail response provided.
* `4`: Success. Multi-work response provided.
* `100`: No input. The method requires an input argument.
* `101`: Invalid input. The standard number argument is invalid.
* `102`: Not found. No data found for the input argument.
* `200`: Unexpected error.

[1]: http://www.oclc.org/content/developer/worldwide/en_us/develop/web-services/classify.html
[2]: http://www.loc.gov/marc/lccn_structure.html
