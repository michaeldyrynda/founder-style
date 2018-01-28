---
extends: _layouts.master
section: content
title: Packages
previousLink: /production
previous: Production
nextLink: /docblocks-comments
next: Docblocks & Comments
---

Since the arrival of [Composer](https://getcomposer.org), copying and pasting code between projects is a thing of the past.

Not only have Composer and [Packagist](https://packagist.org) made it very simple for you to share your own code between your projects, they have also help you to save time by pulling in packages that other developers have written, so that you can focus on achieving your application-specific goals.

To that end, [Founder](https://github.com/michaeldyrynda/founder) installs a few packages in addition to the Laravel defaults that solve problems that are encountered in many of the most applications. The goal of Founder is not, however, to include the kitchen sink.

You are of course free to add, change, and remove any packages from the [`composer.json` file](https://github.com/michaeldyrynda/founder/blob/master/composer.json) as you see fit.

* [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar) (*dev only*)
 * A Laravel-specific implementation for DebugBar, which can display profiling data from any part of your application. Installed only with dev dependencies and displayed only when `APP_DEBUG=true`.
* [dyrynda/laravel-make-user](https://github.com/michaeldyrynda/laravel-make-user)
  * Many of our apps are internally facing, so there is no public registration. This package makes adding your first - typically admin - user a cinch.
* [friendsofphp/php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)
  * Ensures that the code style and formatting of each project is consistent, using rules defined in the [`.php_cs` file](https://github.com/michaeldyrynda/founder/blob/master/.php_cs).
* [hemp/presenter](https://github.com/davidhemphill/presenter)
  * When your models start to get filled with accessors, creating a presenter is a good way to separate the logic and clean up your model.
* [laracasts/flash](https://github.com/laracasts/flash)
  * A package to handle displaying notification messages within your application.
* [laravel/horizon](https://github.com/laravel/horizon)
  * Horizon provides a beautiful dashboard and code-driven configuration for your Laravel powered Redis queues. Horizon allows you to easily monitor key metrics of your queue system such as job throughput, runtime, and job failures.
* [sentry/sentry-laravel](https://github.com/getsentry/sentry-laravel)
  * Laravel-specific integration for bug tracking platform, [Sentry](https://getsentry.com).
* [sensiolabs/security-checker](https://github.com/sensiolabs/security-checker)
  * A command line tool that checks your application isn't using dependencies with known security vulnerabilities.
