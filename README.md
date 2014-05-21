gfycat-php ![Build Status](https://travis-ci.org/nehalvpatel/gfycat-php.svg)
==========

A PHP interface to the Gfycat API.

### Requirements
- PHP 5.4 and up

### Getting Started
1. Install composer
2. Add the [package](https://packagist.org/packages/nehalvpatel/synapse) to your composer.json
3. Run composer

### Example
```php
  require 'vendor/autoload.php';
  
  // convert a gif
  print_r(\Gfycat\Core::convert("http://i.imgur.com/jmLX0nv.gif"));
  
  // query a gfy name for urls and more information
  print_r(\Gfycat\Core::query("InstructiveUnsungBabirusa"));
  
  // check if a URL has already been converted
  print_r(\Gfycat\Core::check("http://i.imgur.com/jmLX0nv.gif"));
```
