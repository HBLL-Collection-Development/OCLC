# xID
[xID][1] allows you to submit an identifer, such as an ISBN, ISSN, or OCLC Number, and return a list of related identifiers and selected metadata.

xID is really three different services: [xISBN][2], [xISSN][3], [xStandardNumber][4].

## xISBN Usage

### Minimal example

```php
<?php

use OCLC\xid\xisbn;

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
   $data = $xisbn->hyphenate('080442957X');
   ```

5. `to10`:

   ```php
   $xisbn = new xisbn;
   $data  = $xisbn->to10('978-0-8044-2957-3');
   ```

6. `to13`:

   ```php
   $xisbn = new xisbn;
   $data = $xisbn->to13('0-8044-2957X');
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
1. Options can only be set in bulk by passing an array when you call a method. It would be nice to be able to set them one at a time.

## OCLC Response Codes

* `invalidAffiliateId`: Invalid affiliate id.
* `invalidHash`: Invalid hash.
* `invalidId`: The request identifier is not valid.
* `invalidToken`: Invalid token.
* `ok`: A valid request.
* `overlimit`: The quota (daily or cummulative) for the affiliate id or IP address has been exceeded.
* `unknownField`: The request field is not supported.
* `unknownFormat`: The request format is not supported.
* `unknownId`: The request identifier looks like a valid ISBN, ISSN, OCLCNumber, LCCN, or OWI number and unknown to the service.
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
