# HTML Markup Indenter

[![Packagist](https://img.shields.io/packagist/v/joppuyo/html-markup-indenter.svg)](https://packagist.org/packages/joppuyo/html-markup-indenter)

Don't you just hate it when your beautiful HTML markup is mutilated due to a templating language? (I'm looking at you, [Timber](https://www.upstatement.com/timber/))

Use this plugin to indent the HTML markup output by WordPress using the [Dindent](https://github.com/gajus/dindent) library. It only does its thing when you are not logged in.

## Requirements

* PHP 5.3 or greater
* Mbstring extension

## Installation

### Composer (with [Bedrock](https://roots.io/bedrock/))

```sh
composer require joppuyo/html-markup-indenter
```

### Classic

1. Upload the plugin folder to the /wp-content/plugins/ directory
2. Activate the plugin through the **Plugins** menu in WordPress
