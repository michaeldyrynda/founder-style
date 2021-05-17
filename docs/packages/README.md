---
title: Packages
---

# Packages

Since the arrival of [Composer](https://getcomposer.org), copying and pasting code between projects is a thing of the past.

Not only have Composer and [Packagist](https://packagist.org) made it very simple for you to share your own code between your projects, they have also help you to save time by pulling in packages that other developers have written, so that you can focus on achieving your application-specific goals.

To that end, [Founder](https://github.com/michaeldyrynda/founder) installs a few packages in addition to the Laravel defaults that solve problems that are encountered in many of the most applications. The goal of Founder is not, however, to include the kitchen sink.

You are of course free to add, change, and remove any packages from the [`composer.json` file](https://github.com/michaeldyrynda/founder/blob/master/composer.json) as you see fit.

* [friendsofphp/php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)
  * Ensures that the code style and formatting of each project is consistent, using rules defined in the [`.php_cs` file](https://github.com/michaeldyrynda/founder/blob/master/.php_cs).
* [laravel/horizon](https://github.com/laravel/horizon)
  * Horizon provides a beautiful dashboard and code-driven configuration for your Laravel powered Redis queues. Horizon allows you to easily monitor key metrics of your queue system such as job throughput, runtime, and job failures.
* [laravel/telescope](https://github.com/laravel/telescope) (*dev only*)
  * An elegant debug assistant for the Laravel framework
* [honeybadger-io/honeybadger-laravel](https://github.com/honeybadger-io/honeybadger-laravel)
  * Laravel-specific integration for bug tracking platform, [Honeybadger](https://honeybadger.io).
* [enlightn/enlightn](https://github.com/enlightn/enlightn)
  * A command line tool for performance and security reporting.
