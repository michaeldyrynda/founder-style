---
title: Views
---

# Views

Views are a means for displaying your data. You should strive to keep any logic and calculations out of your views at all times, instead carrying out all of this implementation in your controllers. This leaves your views slim and simple to reason about.

Although Laravel supports templating with plain PHP files, Laravel's Blade templating engine is simple and powerful and should be used wherever possible.

Blade provides control structures that allow you to iterate over arrays of data that you might return from your database, conditionally display content, inherit from and extend other layouts, and even abstract reusable components.

## Naming and usage

View filenames must be `camelCase`.

View files should be named alongside your routes, wherever possible. It's easier to locate the view file for the `users.index` route if it is in `resources/views/users/index.blade.php` and not called `accounts.blade.php` or `userIndex.blade.php`.

```php
class UsersController
{
    public function index()
    {
        return view('users.index');
    }
}
```

```
resources/
  views/
    users/
      index.blade.php
```

## Blade Templates

Always use four spaces for indentation.

```html
<ul>
    <li><a href="{{ route('users.show', $user) }}">Michael Dyrynda</a></li>
</ul>
```

Control structures should not be surrounded by, or contain spaces. Whilst this is not necessarily "better" or "worse" than alternatives, it is a stylistic choice of formatting for projects based on [Founder](https://github.com/michaeldyrynda/founder).

```php
// Good
@if($condition)
    Something good
@endif

// Bad
@if ($condition)
    Something bad
@elseif ( $someOtherCondition )
    Also bad
@endif
```

## HTML Attributes

HTML attributes should always be written in the same order as described in [Mark Otto's](https://twitter.com/mdo) [code guide](http://codeguide.co/#html-attribute-order).

When working with HTML elements that have many attributes, align the attributes one under the other for easier readability. Ensure the closing bracket sits on its own line, underneath the opening tag's opening bracket.

This also aims to reduce unnecessary changes in version control, for both individual attributes and for the content that comes after the closing bracket.

```html
<a class="no-underline hover:underline text-indigo"
   href="/users/1"
   title="View user Michael Dyrynda"
>
    Michael Dyrynda
</a>
```

## View composers

<a href="https://laravel.com/docs/views#view-composers">View composers</a> allow you to inject data into each specified view in your application. They are useful, for example, to push the authenticated user into all of your views and indeed whether or not you have an authenticated user at all.

::: warning
**Use View Composers with caution.**

It is not always apparent to a new - or even experienced - developer in your codebase to know where the variables come from and where they are defined. If you do use them, create a specific [service provider](https://laravel.com/docs/providers) and be sure to include `Composer` in the class name to make its purpose clear.
:::
