Google Translate API mock
==========================

Dummy that behaves like the Google Translte API. It checks your request parameters.
The results will always the same, except for translated strings. Translation is always the reverse string of the input.

Requires
--------
Webserver with rewrite capabilities.
A .htaccess file with the according rules is provided.

Setup
------------
Apache: Just change the RewriteBase in .htaccess to your needs.

Other webservers must somehow add the rewrites themselve ;-)

Example calls
-------------

Get supported languages
```
http://127.0.0.1/google-translate-dummy/language/translate/v2/languages?key=API_KEY
```

Get a translation
```
http://127.0.0.1/google-translate-dummy/language/translate/v2?key=API_KEY&target=en&q=Hello&source=de
```
