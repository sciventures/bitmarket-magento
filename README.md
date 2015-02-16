sciventures/bitmarket-magento
=====================

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

# Configuration

Configuration can be done using the Administrator section of your Megento store. Once Logged in, you will find the configuration settings under **System > Configuration > Sales > Payment Methods**.

Here you will need to create an [API token](https://merchants.bitmarket.ph/token) using your Bitmarket merchant account. Once you have a token, put the code in the API Token field. This will take care of the rest for you.

# Usage

Once enabled, your customers will be given the option to pay with Bitcoins. Once they checkout they are redirected to a full screen BitPay invoice to pay for the order.

As a merchant, the orders in your Magento store can be treated as any other order.

# Support

## BitMarket Support

* [GitHub Issues](https://github.com/sciventures/bitmarket-magento/issues)

## Magento Support

* [Homepage](http://magento.com)
* [Documentation](http://docs.magentocommerce.com)
* [Community Edition Support Forums](https://www.magentocommerce.com/support/ce/)

