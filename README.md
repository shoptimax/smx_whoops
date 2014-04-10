smx_whoops
==========

Integration of the [whoops](https://github.com/filp/whoops/) error handler base/framework for PHP into the [OXID](http://www.oxid-esales.com) eShop.

-----

![Whoops!](http://i.imgur.com/xiZ1tUU.png)

**whoops** is an error handler base/framework for PHP. Out-of-the-box, it provides a pretty
error interface that helps you debug your web projects, but at heart it's a simple yet
powerful stacked error handling system.

## Installing
Here's a very simple way to install:

1. Download [whoops](https://github.com/filp/whoops/) OR use the provided "src" and "vendor" dirs (see 3.) from this repository.

2. Use [Composer](http://getcomposer.org) to install Whoops:

    Note: the proposed composer command for installing whoops didn't work for me:
    
    ```bash
    composer require filp/whoops:1
    ```
    
    So I had to add the composer lib to the composer.json file ("filp/whoops": "1.*") - see "composer_edited.json" - and do a

    ```bash
    php composer.phar install
    ```

    instead.
    In the end, either of these should create the "src" and "vendor" dirs for you.
    
3. Upload
    modules
    src
    vendor
    to your shop root.

4. Activate the module in the shop backend.

## Authors

This whoops library was primarily developed by [Filipe Dobreira](https://github.com/filp), and is currently maintained by [Denis Sokolov](https://github.com/denis-sokolov). A lot of awesome fixes and enhancements were also sent in by [various contributors](https://github.com/filp/whoops/contributors).
The smx_whoops module for integrating whoops into OXID was developed by shoptimax GmbH, Gernot Payer and Stefan Moises.
