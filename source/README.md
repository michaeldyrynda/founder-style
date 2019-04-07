---
title: Style Guide
---

## Introduction

This style guide:

* provides a set of styles and conventions to follow for each Laravel project you undertake
* helps to maintain a level of consistency between projects and reduce cognitive overhead needed when switching between them
* serves to make it simpler to onboard new developers into existing projects
* is designed to change over time, as new patterns emerge and teams expand, taking into account new perspectives
* aims to reflect styles and conventions that apply to current version of Laravel at all times

## Why Laravel?

At its core, [Laravel](https://laravel.com) helps you to develop your applications quickly, whilst keeping the syntax simple and readable.

Along with its simple syntax, are a number of conventions and features that really allow you to focus on building your application, without worrying about the boilerplate code you'd ordinarily write when building an application from scratch. This includes things like managing your database schema with [migrations](/migrations-schema/) and working with the database using [Eloquent](/eloquent/).

Simply put, Laravel gives you all of the tools to build a robust, modern web application right from your first `composer install`. Be warned, though: try and follow the framework's conventions wherever possible to save yourself headaches in future.

## A starter application

[Founder](https://github.com/michaeldyrynda/founder) provides you with a Laravel starter application that builds from the one you will find in the Laravel [GitHub repository](https://github.com/laravel/laravel). It takes the base Laravel application, applies the styles and conventions that are explained throughout this style guide, and adds some useful packages you will find yourself otherwise installing manually each time.

Getting started with Founder is simple with [Composer](https://getcomposer.org).

```
composer create-project --prefer-dist dyrynda/founder my-project-name
```

This will fetch a copy of the Founder project, place it on the `my-project-name` directory, and install the project dependencies, ready for you to get started.
