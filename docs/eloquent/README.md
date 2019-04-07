---
title: Eloquent
---

# Eloquent

Founder's base model has one purpose out of the box; it sets the `$guarded` property to an empty array. This helps avoid situations where you forget to update the `$fillable` property and are hit with a `MassAssignmentException`.

You are of course free to modify this base model to encapsulate any funtionality you require in all of your application's models on a per-application basis.

::: warning
It is important that you ***never*** pass `request()->all()` into any of your models' methods that allow mass assignment, such as `create` or `update`.

Always be explicit to ensure only desired input is being passed into your models, irrespective of what was in the request.
:::

Explicit safety, right in your controllers - rather than the implicit and somewhat hidden safety of the `$fillable` property.

## Formatting

The PSR-2 styles that are used with Founder define the order various components should be defined within a class. In the specific case of Eloquent models, the following convention should be used for ordering.

* `use` statements (traits)
* Constants
* `public`, `protected`, then `private` properties
  * `static` properties
  * Framework-defined properties
  * Application-defined ones
* Magic methods
* `boot` method
* Named (static) constructors
* Query scopes
* Mutators and accessors (grouping each mutator / accessor pair)

## Abstracting relationships

As outlined in the [general docs](/general/#don-t-talk-to-strangers), wherever possible encapsulate any relationship methods for create and update operations behind specific methods. Encapsulating this logic prevents the implementation details from leaking into your controllers.

```php
// Good
$post->addComment('This is the comment body', auth()->user());

// Bad
$post->comments()->create([
    'body' => 'This is the comment body',
    'user_id' => auth()->id(),
]);
```
