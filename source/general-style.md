---
extends: _layouts.master
section: content
title: General Style
---
At its most simple level, each Laravel project must follow the code styles set out in the [PSR-1](http://www.php-fig.org/psr/psr-1/) and [PSR-2](http://www.php-fig.org/psr/psr-2/) recommendations.

Any variables declared within the context of your application should use `camelCase` syntax, except where noted otherwise in this guide.

Always strive to keep your code expressive and human-readable.

> Always code as if the person who ends up maintaining your code is a violent psychopath who knows where you live. - [*Code for the maintainer*](http://wiki.c2.com/?CodeForTheMaintainer)

## Should I rename my application?

Laravel ships with a default `app:name` command. This guide recommends *never* renaming your application, further allowing you to reduce cognitive overhead between applications. Your fingers will thank you when you don't have to think about importing a class from the `App` namespace, when the namespace doesn't change when jumping between projects.

## Whitespace

Code should always be allowed to breathe! PHP will be interpreted whether you write it with no whitespace or if you write it with double spacing. For readability, it is better to cater to your fellow developers rather than for the interpreter. Don't be afraid to use whitespace.

```php
// Good
public function normalisePhoneNumber($input)
{
    $input = preg_replace('/[^0-9]+/', '', $input);

    if (trim($input) === '') {
        return '';
    }

    return $input;
}

// Bad: everything is cramped together making it hard to read
public function normalisePhoneNumber($input)
{
    $input = preg_replace('/[^0-9]+/', '', $input);
    if (trim($input) === '') {
        return '';
    }
    return $input;
}
```

Avoid extra whitespace inside conditional braces (`{}`). We want the code to breath, but there's no need to be wasteful.

```php
// Good
if (trim($input) === '') {
    return '';
}

// Bad
if (trim($input) === '') {

    return '';

}
```
