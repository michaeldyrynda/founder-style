---
extends: _layouts.master
section: content
title: Style Guide
---

## Introduction

This guide provides a set of styles and conventions to follow for each Laravel project you undertake.

It helps to maintain a level of consistency between projects and reduce cognitive overhead needed when switching between projects.

This style guide also serves to make it simpler to onboard new developers into existing projects.

The guide is designed to change over time, as new patterns emerge and teams expand, taking into account new perspectives. This guide aims to reflect styles and conventions for the current version of Laravel at all times.

## Why Laravel?

At its core, Laravel provides a set of conventions that allow you to developer your applications quickly, whilst keeping the syntax simple and readable.

Along with its simple syntax, are a number of conventions and features that really allow you to focus on building your application, without worrying about all of the boilerplate things you'd ordinarily go through when building an application from scratch. This includes things like managing your database schema with [migrations](/migrations-schema) and working with the database using [Eloquent](/eloquent).

Simply put, [Laravel](https://laravel.com) gives you all of the tools to build a modern web application right from your first `composer install`. Be warned, though: try and follow the framework's conventions wherever possible to save yourself headaches in future.

## A starter application

[Founder](https://github.com/michaeldyrynda/founder) provides you with a Laravel starter application that builds from the one you will find in the [Laravel](https://github.com/laravel/laravel) repository. It takes the base Laravel application and applies some of the styles and conventions that are talked about throughout this style guide.

Getting started with Founder is simple with [Composer](https://getcomposer.org).

```
composer create-project --prefer-dist dyrynda/founder my-project-name
```

This will fetch a copy of the Founder project, place it on the `my-project-name` directory, and install the project dependencies, ready for you to get started.
