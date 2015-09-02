Gfycat.php ![Build Status](https://travis-ci.org/nehalvpatel/gfycat-php.svg)
==========

A PHP interface to the Gfycat API.

Installation
----------

Add the package to your composer file:
```bash
composer require nehalvpatel/gfycat-php "2.*"
composer update
```

Example
----------

```php
  require 'vendor/autoload.php';
  
  use nehalvpatel\Gfycat;
  
  // convert a gif from a Url
  print_r(Gfycat::convertUrl("http://i.imgur.com/gTv0isU.gif"));
  
  // convert a gif from a Url and release (async upload, check status using query())
  Gfycat::convertUrlAndRelease("http://i.imgur.com/gTv0isU.gif");
  //// -> returns gfycat key if gif hasn't already been uploaded to gfycat
  //// -> returns array of gfy data if the gif has been converted before
  
  // convert a gif from a file
  $file = // stream of data (fopen() or an instance of a Psr\Http\Message\StreamInterface)
  print_r(Gfycat::convertFile($file);
  
  // query a gfy name for urls and more information
  print_r(Gfycat::query("SpryFixedGnu"));
  
  // check if a URL has already been converted
  print_r(Gfycat::check("http://i.imgur.com/gTv0isU.gif"));
```

Contribution
----------

Run tests before creating a pull request: `vendor/bin/phpunit`.