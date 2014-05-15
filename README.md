# PHP Library for [OCLC Web Services][1]
The library currently supports the following services:

1. [Classify][2]: classify books, videos, CDs and other materials based on identifier: ISBN, OCLC Number, UPC, ISSN, title, author, FAST headings, or FRBR work identifier.
2. [xID API][13]: submit an identifer such as an ISBN, ISSN, or OCLC Number to this service, and it returns a list of related identifiers and selected metadata.

I hope to include the following services in future updates:

1. [FAST API][3]: access to OCLC's Faceted Application of Subject Terminologies (FAST) subject headings data.
2. [LC Name Authority File (LCNAF)][4]: access to a database of LC Authority records extracted from WorldCat.
3. [QuestionPoint Knowledge Base API][5]: access to QuestionPoint knowledge base Question and Answer (Q&A) pairs that QuestionPoint libraries saved for future re-use, for FAQ pages, for patron searches. The QuestionPoint global knowledge base is a collection of Q&A pairs contributed by nearly 500 libraries worldwide. Local knowledge bases are built and maintained by single libraries or regional library groups and usually contain information more specific to that group.
4. [Terminology Services][6]: access to a suite of seven controlled vocabularies and thesauri.
5. [Virtual International Authority File (VIAF)][7]: authority data from 22 agencies in 19 countries, representing a variety of formats.
6. [WorldCat Identities][8]: service that provides personal, corporate and subject-based identities (writers, authors, characters, corporations, horses, ships, etc.) based on information in WorldCat.
7. [WorldCat knowledge base API][9]: read-only service for e-resource discovery and linking. Provides developer-level access to a library's information in the WorldCat knowledge base. The WorldCat knowledge base combines data about your library's econtent with access to it through linking features.
8. [WorldCat Recommender Service][10]: provides recommendations for books and other materials based on data in WorldCat.
9. [WorldCat Registry][11]: access to information in the Worldcat Registry: a free global directory for libraries, consortia, archives and museums. (http://www.worldcat.org/registry/institutions)
10. [WorldCat Search API][12]: access to WorldCat for bibliographic holdings and location data.

## Installation
1. Download the folder and include it in your application's directory.
2. Include desired classes, `OCLCException.php`, and `Config.php` in any file you want to access the service from.
    - Alternatively, you can use `spl_autoload_register` to automatically load the library into your application. For example, let's say your directory structure looks as follows:

    ```
    .
    +-- Config.php
    +-- index.php
    +-- libs
    |   +-- OCLC
    |   |   +-- classify
    |   |   +-- …
    ```

    - Place the following in your application's Config file to be included in all your application files:

    ```php
    function autoload_libs($class_name) {
      $class_name = ltrim($class_name, '\\');
      $file_name  = '';
      $namespace = '';
      if ($lastNsPos = strrpos($class_name, '\\')) {
        $namespace = substr($class_name, 0, $lastNsPos);
        $class_name = substr($class_name, $lastNsPos + 1);
        $file_name  = __DIR__ . '/libs/' . str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
      }
      $file_name .= str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';
      if(file_exists($file_name)) {
        include_once($file_name);
      }
    }

    spl_autoload_register('autoload_libs');
    ```

## Usage

- [Classify](classify/README.md)
- [xID](xid/README.md)

[1]: http://www.oclc.org/developer/develop/web-services.en.html
[2]: http://www.oclc.org/content/developer/worldwide/en_us/develop/web-services/classify.html
[3]: http://www.oclc.org/developer/develop/web-services/fast-api.en.html
[4]: http://www.oclc.org/developer/develop/web-services/lc-name-authority-file-lcnaf.en.html
[5]: http://www.oclc.org/developer/develop/web-services/questionpoint-knowledge-base-api.en.html
[6]: http://www.oclc.org/developer/develop/web-services/terminology-services.en.html
[7]: http://www.oclc.org/developer/develop/web-services/virtual-international-authority-file-viaf.en.html
[8]: http://www.oclc.org/developer/develop/web-services/worldcat-identities.en.html
[9]: http://www.oclc.org/developer/develop/web-services/worldcat-knowledge-base-api.en.html
[10]: http://www.oclc.org/developer/develop/web-services/worldcat-recommender-service.en.html
[11]: http://www.oclc.org/developer/develop/web-services/worldcat-registry.en.html
[12]: http://www.oclc.org/developer/develop/web-services/worldcat-search-api.en.html
[13]: http://www.oclc.org/developer/develop/web-services/xid-api.en.html
