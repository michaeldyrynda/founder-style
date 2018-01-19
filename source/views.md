---
extends: _layouts.master
section: content
title: Views
---
Views are a means for displaying your data. You should always strive to keep any logic and calculations out of your views at all times, instead carrying out all of this implementation in your controllers.

Focussing on ensuring your views are responsible for displaying data only, allows them to remain light and simple to reason about.

Although Laravel supports templating with plain PHP files, Laravel's Blade templating engine is simple and powerful. It provides control structures that allow you to iterate over arrays of data that you might return from your database, conditionally display content, inherit from and extend other layouts, and even abstract reusable components.

## Naming and usage

View files must be `camelCase`.

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

Control structures should not be surrounded by, or contain spaces.

```
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

When working HTML elements that have many attributes, align the attributes one under the other for easier readability. Ensure the closing bracket sits on it's own line, underneath the opening tag's opening bracket. This also aims to reduce unnecessary changes in version control if you were to change the last

```html
<a href="/users/1"
   class="no-underline hover:underline text-indigo"
   title="View user Michael Dyrynda"
>
    Michael Dyrynda
</a>
```
