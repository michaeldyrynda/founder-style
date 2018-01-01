---
extends: _layouts.master
section: content
title: Controllers
---
Controllers that are responsible for managing a resource must use the plural version of the resource in their name.

```php
// Good
class ServicesController
{
    // ...
}

// Bad
class ServiceController
{
    // ...
}
```

## RESTful controllers

Always strive to stick with the seven RESTful actions in your controllers: `index`, `create`, `store`, `show`, `edit`, `update`, and `destroy`. When you keep your controllers to these actions, they're easier to read and more closely adhere to a single responsibility mindset.

Don't be afraid to add a few resource-specific methods to your controller, but if you find yourself adding too many methods that apply to specific resource relationships, for example, then strive to name the relationships you're working with and create a new controller. *Never be afraid to add another controller!*.

[Adam Wathan](https://twitter.com/adamwathan) gave an [excellent talk](https://youtu.be/MF0jFKvS4SI) at Laracon US 2017 that expands on this concept in greater detail.

## Authorisation

In most cases, authorisation for a controller action should be the first action carried out in your controllers, enabling you to return early without processing logic an unauthorised user doesn't have access to.

```php
class ServicesController
{
    public function update(Service $service)
    {
        $this->authorize('update', $service);

        // The current user can update the service...
    }
}
```

## Validation

When building an application, it is preferable to handle your request validation inside your controller methods until either size or complexity dictates that you extract to a [form request](https://laravel.com/docs/5.5/validation#form-request-validation). Practise [YAGNI](https://martinfowler.com/bliki/Yagni.html).

In simple instances, use the `validate` method on the `request` helper. If using form requests, be sure to type hint the form request and leverage Laravel's [Service Container](https://laravel.com/docs/5.5/container) to inject it in your method as needed.

Be sure to declare your request key's validation rules using array syntax. This makes them not only more readable, but also consistent, when using validation `Rule` object variants or [custom validation rules](https://laravel.com/docs/5.5/validation#custom-validation-rules).

```php
class NotesController
{
    public function create()
    {
        request()->validate([
            'body' => ['required'],
        ]);

        Note::create(request('body'));
    }
}
```
