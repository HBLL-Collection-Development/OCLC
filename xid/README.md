# Table of Contents
1. [xID Introduction](#xid)
2. [xISBN Usage](#xisbn-usage)
   1. [Minimal example](#minimal-example)
   2. [Search methods](#search-methods)
   3. [Options](#options)
   4. [Known issues](#known-issues)
3. [xISSN Usage](#xissn-usage)
   1. [Minimal example](#minimal-example-1)
   2. [Search methods](#search-methods-1)
   3. [Options](#options-1)
   4. [Known issues](#known-issues-1)
4. [xStandardNumber Usage](#xstandardnumber-usage)
   1. [Minimal example](#minimal-example-2)
   2. [Search methods](#search-methods-2)
   3. [Options](#options-2)
   4. [Known issues](#known-issues-2)
5. [OCLC Response Codes](#oclc-response-codes)

# xID
[xID][1] allows you to submit an identifer, such as an ISBN, ISSN, or OCLC Number, and return a list of related identifiers and selected metadata.

xID is really three different services: [xISBN][2], [xISSN][3], [xStandardNumber][4].

## xISBN Usage

### Minimal example

```php
<?php

use OCLC\Xid\Xisbn;

try {
  $xisbn = new xisbn;
  $data  = $xisbn->getMetadata('9780545010221');
} catch (Exception $e) {
  echo $e->getMessage();
}

print_r($data);

?>
```

### Search methods

1. `fixChecksum` or `fix_checksum`:

   ```php
   $xisbn = new xisbn;
   $data1 = $xisbn->fixChecksum('0-8044-2957');
   $data2 = $xisbn->fix_checksum('0-8044-2957');
   ```

2. `getMetadata` or `get_metadata`:

   ```php
   $xisbn = new xisbn;
   $data1 = $xisbn->getMetadata('0-8044-2957-X');
   $data2 = $xisbn->get_metadata('0-8044-2957-X');
   ```

3. `getEditions` or `get_editions`:

   ```php
   $xisbn = new xisbn;
   $data1 = $xisbn->getEditions('0-8044-2957-X');
   $data2 = $xisbn->get_editions('0-8044-2957-X');
   ```

4. `hyphenate`:

  ```php
   $xisbn = new xisbn;
   $data  = $xisbn->hyphenate('080442957X');
   ```

5. `to10` or `to_10`:

   ```php
   $xisbn = new xisbn;
   $data1 = $xisbn->to10('978-0-8044-2957-3');
   $data2 = $xisbn->to_10('978-0-8044-2957-3');
   ```

6. `to13` or `to_13`:

   ```php
   $xisbn = new xisbn;
   $data1 = $xisbn->to13('0-8044-2957X');
   $data2 = $xisbn->to_13('0-8044-2957X');
   ```

7. `generateHash` or `generate_hash`:

   ```php
   $xisbn = new xisbn;
   $data1 = $xisbn->generateHash('{ ISBN }', '{ REQUEST IP ADDRESS }', '{ MY SECRET }');
   $data2 = $xisbn->generate_hash('{ ISBN }', '{ REQUEST IP ADDRESS }', '{ MY SECRET }');
   ```

### Options

Options are included as an array after the search term. Example:

```php
$xisbn   = new xisbn;
$options = array('format' => 'json', 'fl' => 'oclcnum,author');
$data    = $xisbn->getMetadata('0-8044-2957x', $options);
```

1. `ai`: String. [WorldCat Affiliate ID][12]. Default: `null`
2. `callback`: String. JSON callback. Default: `null`
4. `count`: Integer. Number of desired search results. Default: 1,000
4. `fl`: String. Comma separated list of fields to return. Default: `*`
   - `*`: all fields
   - `author`
   - `city`
   - `ed`
   - `oclcnum`
   - `form`
   - `lang`
   - `publisher`
   - `title`
   - `url`
   - `year`
5. `format`: String. Format to return the response in. Default: `xml`
   - `csv`: Comma separated values
   - `json`: JavaScript Object Notation
   - `php`: PHP
   - `python`: Python
   - `ruby`: Ruby
   - `txt`: Plain text
   - `html`: XHTML
   - `xml`: XML
6. `hash`: String. [Authentication hash][11]. Default: `null`
7. `library`: String. Limit search scope to a particular library's holdings. Default: `null`
   - `ebook`: ebooks based on OCLC NJ's [UHF Holdings Database][5]
   - `freebook`: free ebooks based on OCLC NJ's [UHF Holdings Database][5]
   - `bookmooch`: [Bookmooch's][6] inventory
   - `paperbackswap`: [Paperbackswap's][7] inventory
   - `wikipedia`: works that appear in [Wikipedia][8]
   - `oca`: [Open Content Alliance][9] holdings
   - `hathi`: [Hathi Trust][10] holdings
8. `startIndex`: Integer. The index of the first search result desired. Default: 0
9. `token`: String. [Authentication token][11]. Default: `null`

### Known issues
1. Options can only be set in bulk by passing an array when you call a method. It would be nice to be able to set them individually.

## xISSN Usage

### Minimal example

```php
<?php

use OCLC\Xid\Xissn;

try {
  $xissn = new xissn;
  $data  = $xissn->getMetadata('0036-8075');
} catch (Exception $e) {
  echo $e->getMessage();
}

print_r($data);

?>
```

### Search methods

1. `fixChecksum` or `fix_checksum`:

   ```php
   $xissn = new xissn;
   $data1 = $xissn->fixChecksum('0036-8074');
   $data2 = $xissn->fix_checksum('0036-8074');
   ```

2. `getMetadata` or `get_metadata`:

   ```php
   $xissn = new xissn;
   $data1 = $xissn->getMetadata('0036-8075');
   $data2 = $xissn->get_metadata('0036-8075');
   ```

3. `getEditions` or `get_editions`:

   ```php
   $xissn = new xissn;
   $data1 = $xissn->getEditions('0036-8075');
   $data2 = $xissn->get_editions('0036-8075');
   ```

4. `getForms` or `get_forms`:

  ```php
   $xissn = new xissn;
   $data1 = $xissn->getForms('0036-8075');
   $data2 = $xissn->get_forms('0036-8075');
   ```

5. `getHistory` or `get_history`:

   ```php
   $xissn = new xissn;
   $data1 = $xissn->getHistory('0036-8075');
   $data2 = $xissn->get_history('0036-8075');
   ```

6. `generateHash` or `generate_hash`:

   ```php
   $xissn = new xissn;
   $data1 = $xissn->generateHash('{ ISSN }', '{ REQUEST IP ADDRESS }', '{ MY SECRET }');
   $data2 = $xissn->generate_hash('{ ISSN }', '{ REQUEST IP ADDRESS }', '{ MY SECRET }');
   ```

### Options

Options are included as an array after the search term. Example:

```php
$xissn   = new xissn;
$options = array('format' => 'json', 'fl' => 'oclcnum,title');
$data    = $xissn->getMetadata('0036-8075', $options);
```

1. `ai`: String. [WorldCat Affiliate ID][12]. Default: `null`
2. `callback`: String. JSON callback. Default: `null`
3. `fl`: String. Comma separated list of fields to return. Default: `*`
   - `*`: all fields
   - `author`
   - `city`
   - `ed`
   - `oclcnum`
   - `form`
   - `lang`
   - `publisher`
   - `title`
   - `url`
   - `year`
4. `format`: String. Format to return the response in. Default: `xml`
   - `csv`: Comma separated values
   - `json`: JavaScript Object Notation
   - `php`: PHP
   - `python`: Python
   - `ruby`: Ruby
   - `txt`: Plain text
   - `html`: XHTML
   - `xml`: XML
5. `hash`: String. [Authentication hash][11]. Default: `null`
6. `token`: String. [Authentication token][11]. Default: `null`

### Known issues
1. Options can only be set in bulk by passing an array when you call a method. It would be nice to be able to set them individually.

## xStandardNumber Usage

### Minimal example

```php
<?php

use OCLC\Xid\XStandardNumber;

try {
  $xstandardnumber = new xstandardnumber;
  $data = $xstandardnumber->getMetadata('9780545010221');
} catch (Exception $e) {
  echo $e->getMessage();
}

print_r($data);

?>
```

### Search methods

1. `getEditions` or `get_editions`:

   ```php
   $xstandardnumber = new xstandardnumber;
   $data1 = $xstandardnumber->getEditions('oclcnum', '154684429');
   $data2 = $xstandardnumber->get_editions('oclcnum', '154684429');
   ```

2. `getEditionsByLccn` or `get_editions_by_lccn`

   ```php
   $xstandardnumber = new xstandardnumber;
   $data1 = $xstandardnumber->getEditionsByLccn('2004273129');
   $data2 = $xstandardnumber->get_editions_by_lccn('2004273129');
   ```

3. `getEditionsByOclcNum` or `get_editions_by_oclc_num`

   ```php
   $xstandardnumber = new xstandardnumber;
   $data1 = $xstandardnumber->getEditionsByOclcNum('154684429');
   $data2 = $xstandardnumber->get_editions_by_oclc_num('154684429');
   ```

4. `getEditionsByOwi` or `get_editions_by_owi`

   ```php
   $xstandardnumber = new xstandardnumber;
   $data1 = $xstandardnumber->getEditionsByOwi('owi67201841');
   $data2 = $xstandardnumber->get_editions_by_owi('owi67201841');
   ```

5. `getMetadata` or `get_metadata`:

   ```php
   $xstandardnumber = new xstandardnumber;
   $data1 = $xstandardnumber->getMetadata('owi', 'owi67201841');
   $data2 = $xstandardnumber->get_metadata('owi', 'owi67201841');
   ```

6. `getMetadataByLccn` or `get_metadata_by_lccn`

   ```php
   $xstandardnumber = new xstandardnumber;
   $data1 = $xstandardnumber->getMetadataByLccn('2004273129');
   $data2 = $xstandardnumber->get_metadata_by_lccn('2004273129');
   ```

7. `getMetadataByOclcNum` or `get_metadata_by_oclc_num`

   ```php
   $xstandardnumber = new xstandardnumber;
   $data1 = $xstandardnumber->getMetadataByOclcNum('154684429');
   $data2 = $xstandardnumber->get_metadata_by_oclc_num('154684429');
   ```

8. `getMetadataByOwi` or `get_metadata_by_owi`

   ```php
   $xstandardnumber = new xstandardnumber;
   $data1 = $xstandardnumber->getMetadataByOwi('owi67201841');
   $data2 = $xstandardnumber->get_metadata_by_owi('owi67201841');
   ```

9. `getVariants` or `get_variants`:

  ```php
   $xstandardnumber = new xstandardnumber;
   $data1 = $xstandardnumber->getVariants('owi', 'owi67201841');
   $data2 = $xstandardnumber->get_variants('owi', 'owi67201841');
   ```

10. `getVariantsByLccn` or `get_variants_by_lccn`

   ```php
   $xstandardnumber = new xstandardnumber;
   $data1 = $xstandardnumber->getVariantsByLccn('2004273129');
   $data2 = $xstandardnumber->get_variants_by_lccn('2004273129');
   ```

11. `getVariantsByOclcNum` or `get_variants_by_oclc_num`

   ```php
   $xstandardnumber = new xstandardnumber;
   $data1 = $xstandardnumber->getVariantsByOclcNum('154684429');
   $data2 = $xstandardnumber->get_variants_by_oclc_num('154684429');
   ```

12. `getVariantsByOwi` or `get_variants_by_owi`

   ```php
   $xstandardnumber = new xstandardnumber;
   $data1 = $xstandardnumber->getVariantsByOwi('owi67201841');
   $data2 = $xstandardnumber->get_variants_by_owi('owi67201841');
   ```

13. `generateHash` or `generate_hash`:

   ```php
   $xstandardnumber = new xstandardnumber;
   $data1 = $xstandardnumber->generateHash('{ STANDARD NUMBER }', '{ REQUEST IP ADDRESS }', '{ MY SECRET }');
   $data2 = $xstandardnumber->generate_hash('{ STANDARD NUMBER }', '{ REQUEST IP ADDRESS }', '{ MY SECRET }');
   ```

### Options

Options are included as an array after the search term. Example:

```php
$xstandardnumber = new xstandardnumber;
$options = array('format' => 'json', 'fl' => 'lccn');
$data    = $xstandardnumber->getMetadataByOclcNum('154684429', $options);
```

1. `ai`: String. [WorldCat Affiliate ID][12]. Default: `null`
2. `callback`: String. JSON callback. Default: `null`
3. `fl`: String. Comma separated list of fields to return. Default: `*`
   - `*`: all fields
   - `lccn`
   - `oclcnum`
   - `owi`
   - `presentOclcnum`
   - `url`
4. `format`: String. Format to return the response in. Default: `xml`
   - `csv`: Comma separated values
   - `json`: JavaScript Object Notation
   - `php`: PHP
   - `python`: Python
   - `ruby`: Ruby
   - `txt`: Plain text
   - `html`: XHTML
   - `xml`: XML
5. `hash`: String. [Authentication hash][11]. Default: `null`
6. `token`: String. [Authentication token][11]. Default: `null`

### Known issues
1. Options can only be set in bulk by passing an array when you call a method. It would be nice to be able to set them individually.

## OCLC Response Codes

* `invalidAffiliateId`: Invalid affiliate id.
* `invalidHash`: Invalid hash.
* `invalidId`: The request identifier is not valid.
* `invalidToken`: Invalid token.
* `ok`: A valid request.
* `overlimit`: The quota (daily or cummulative) for the affiliate id or IP address has been exceeded.
* `unknownField`: The request field is not supported.
* `unknownFormat`: The request format is not supported.
* `unknownId`: The request identifier looks like a valid ISBN, ISSN, OCLC Number, LCCN, or OWI (OCLC Work ID) number and unknown to the service.
* `unknownLibrary`: The request library is not supported.
* `unknownMethod`: The request method is not supported.

[1]: http://www.oclc.org/developer/develop/web-services/xid-api.en.html
[2]: http://www.oclc.org/developer/develop/web-services/xid-api/xisbn-resource.en.html
[3]: http://www.oclc.org/developer/develop/web-services/xid-api/xissn-resource.en.html
[4]: http://www.oclc.org/developer/develop/web-services/xid-api/xstandardNumber-resource.en.html
[5]: http://nj.oclc.org/uhf/about.html
[6]: http://www.bookmooch.com/
[7]: http://www.paperbackswap.com/
[8]: https://www.wikipedia.org/
[9]: http://www.archive.org/
[10]: http://www.hathitrust.org/
[11]: http://www.oclc.org/developer/develop/web-services/xid-api/authentication.en.html
[12]: https://www.worldcat.org/wcpa/do/AffiliateLogin
