---
title: Home
---

# PHP Library for [OCLC Web Services][1]

## Installation
1. Download the folder and place it in a readable location on your web server.
2. Include `Autoloader.php` in your `PHP` files when you need to use the library.

    ```
    #!php
    <?php
      require_once '/path/to/lib/OCLC/Autoloader.php';
    ?>
    ```

## Usage

- [Classify](/classify)
- [xID](/xid)

## About
This library currently supports the following services:

1. [Classify][2]: classify books, videos, CDs and other materials based on identifier: ISBN, OCLC Number, UPC, ISSN, title, author, FAST headings, or FRBR work identifier.
2. [xID API][3]: submit an identifer such as an ISBN, ISSN, or OCLC Number to this service, and it returns a list of related identifiers and selected metadata.

I hope to include the following services in future updates:

1. [QuestionPoint Knowledge Base API][4]: access to QuestionPoint knowledge base Question and Answer (Q&A) pairs that QuestionPoint libraries saved for future re-use, for FAQ pages, for patron searches. The QuestionPoint global knowledge base is a collection of Q&A pairs contributed by nearly 500 libraries worldwide. Local knowledge bases are built and maintained by single libraries or regional library groups and usually contain information more specific to that group.
2. [WorldCat knowledge base API][5]: read-only service for e-resource discovery and linking. Provides developer-level access to a library's information in the WorldCat knowledge base. The WorldCat knowledge base combines data about your library's econtent with access to it through linking features.
3. [WorldCat Recommender Service][6]: provides recommendations for books and other materials based on data in WorldCat.
4. [WorldCat Registry][7]: access to information in the Worldcat Registry: a free global directory for libraries, consortia, archives and museums. (http://www.worldcat.org/registry/institutions)
5. [WorldCat Search API][8]: access to WorldCat for bibliographic holdings and location data.

[1]: http://www.oclc.org/developer/develop/web-services.en.html
[2]: http://www.oclc.org/content/developer/worldwide/en_us/develop/web-services/classify.html
[3]: http://www.oclc.org/developer/develop/web-services/xid-api.en.html
[4]: http://www.oclc.org/developer/develop/web-services/questionpoint-knowledge-base-api.en.html
[5]: http://www.oclc.org/developer/develop/web-services/worldcat-knowledge-base-api.en.html
[6]: http://www.oclc.org/developer/develop/web-services/worldcat-recommender-service.en.html
[7]: http://www.oclc.org/developer/develop/web-services/worldcat-registry.en.html
[8]: http://www.oclc.org/developer/develop/web-services/worldcat-search-api.en.html
