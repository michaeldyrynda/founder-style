---
extends: _layouts.master
section: content
title: Packages
---
Since the arrival of [Composer](https://getcomposer.org), the days of copying and pasting code between projects are long gone.

Not only have Composer and [Packagist](https://packagist.org) made it very simple for you to share your own code between your projects, but also so save yourself time by pulling in packages that other developers have written all over the world, so that you can focus on solving your business-specific goals.

To that end, Founder installs a few packages in addition to the Laravel defaults that solve problems that are encountered in many of the projects that are spun up regularly. The goal of Founder is not, however, to include the kitchen sink. Of course, you are free to add, change, and remove any packages from the [`composer.json` file](https://github.com/michaeldyrynda/founder/blob/master/composer.json) as you see fit.

* [dyrynda/laravel-make-user](https://github.com/michaeldyrynda/laravel-make-user)
  * Many of our apps are internally facing, so there is no public registration. This package makes adding your first - typically admin - user a cinch.
* [laracasts/flash](https://github.com/laracasts/flash)
  * A package to handle displaying notification messages within your application.
* [sentry/sentry-laravel](https://github.com/getsentry/sentry-laravel)
  * Laravel-specific integration for bug tracking platform, [Sentry](https://getsentry.com).
* [friendsofphp/php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)
  * Ensures that the code style and formatting of each project is consistent, using rules defined in the [`.php_cs` file](https://github.com/michaeldyrynda/founder/blog/master/.php_cs).
* [sensiolabs/security-checker](https://github.com/sensiolabs/security-checker)
  * A command line tool that checks your application isn't using dependencies with known security vulnerabilities.
