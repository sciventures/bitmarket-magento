# Description

Bitcoin is a powerful new peer-to-peer platform for the next generation of financial technology. The decentralized nature of the Bitcoin network allows for a highly resilient value transfer infrastructure, and this allows merchants to gain greater profits.

This is because there are little to no fees for transferring Bitcoins from one person to another. Unlike other payment methods, Bitcoin payments cannot be reversed, so once you are paid you can ship! No waiting days for a payment to clear.


# Requirements

* [Magento CE](http://magento.com/resources/system-requirements) 1.9.0.1 or higher. Older versions might work, however this plugin has been validated to work against the 1.9.0.1 Community Edition release.
* [GMP](http://us2.php.net/gmp) or [BC Math](http://us2.php.net/manual/en/book.bc.php) PHP extensions.  GMP is preferred for performance reasons but you may have to install this as most servers do not come with it installed by default.  BC Math is commonly installed however and the plugin will fall back to this method if GMP is not found.
* [OpenSSL](http://us2.php.net/openssl) Must be compiled with PHP and is used for certain cryptographic operations.
* [PHP](http://us2.php.net/downloads.php) 5.4 or higher. This plugin will not work on PHP 5.3 and below.

# Installation

## Download

Visit the [Releases](https://github.com/sciventures/bitmarket-magento/) page of this repository and download the latest version. Once this is done, you can just unzip the contents and use any method you want to put them on your server. The contents will mirror the Magento directory structure.

***NOTE:*** These files can also up uploaded using the *Magento Connect Manager* that comes with your Magento Store

***WARNING:*** It is good practice to backup your database before installing extensions. Please make sure you Create Backups.
