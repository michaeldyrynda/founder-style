---
extends: _layouts.master
section: content
title: Controllers
previousLink: /routing
previous: Routing
nextLink: /views
next: Views
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

The only exception to this rule is for those resources that would be considered "uncountable".

```php
// Bad
class CattlesController
{
    // ...
}

// Good
class CattleController
{
    // ...
}
```

## RESTful controllers <a class="text-grey" name="restful-controllers" href="#restful-controllers">#</a>

Always strive to use the seven RESTful actions in your controllers: `index`, `create`, `store`, `show`, `edit`, `update`, and `destroy`. When you keep your controllers to these actions, they're easier to read and more closely adhere to a single responsibility mindset.

Don't be afraid to add a few resource-specific methods to your controller, but if you find yourself adding too many methods that apply to specific resource relationships, for example, then strive to name the relationships you're working with and create a new controller. *Never be afraid to add another controller!*.

[Adam Wathan](https://twitter.com/adamwathan) gave an [excellent talk](https://youtu.be/MF0jFKvS4SI) at Laracon US 2017 that expands on this concept in greater detail.

## Nested controllers <a class="text-grey" name="nested-controllers" href="#nested-controllers">#</a>

When creating controllers for your nested resources, use the singular name for the parent resource and the plural name for the child resource i.e. `ServiceContactsController` not `ServicesContactsController`.

## Authorisation <a class="text-grey" name="authorisation" href="#authorisation">#</a>

In most cases, authorisation for a controller action should be the first action carried out in your controllers.

Using this as a guard clause enables you to return early without processing logic an unauthorised user doesn't have access to and aids in preventing inadvertently leaking information to unauthorised users.

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

## Validation <a class="text-grey" name="validation" href="#validation">#</a>

When building an application, it is preferable to handle your request validation inside your controller methods until either size or complexity dictates that you extract to a [form request](https://laravel.com/docs/5.5/validation#form-request-validation). Practice [YAGNI](https://martinfowler.com/bliki/Yagni.html).

In simple instances, use the `validate` method on the `request` helper. If using form requests, be sure to type hint the form request and leverage Laravel's [Service Container](https://laravel.com/docs/5.5/container) to inject it in your method as needed.

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

## Route Model Binding <a class="text-grey" name="route-model-binding" href="#route-model-binding">#</a>

Using implicit [route model binding](https://laravel.com/docs/5.5/routing#route-model-binding) out of the box, it is trivial to load the corresponding model and pass it directly to your controller, without an extra line of code responsible for querying the database.

```php
// routes/web.php
Route::get('/services/{service}', 'ServicesController@show')->name('services.show');

// app/Http/Controllers/ServicesController.php
// Without route model binding
public function show($service)
{
    $service = Service::findOrFail($service);

    // Rest of function logic
}

// With route model binding
public function show(Service $service)
{
    // $service will be an Eloquent instance based on the identifier passed
    // in the route's {service} placeholder. If a record cannot be found
    // Laravel will return a ModelNotFoundException and in turn a 404.
}
```

In many cases, the default implicit binding will suffice. If you want to use a column other than the model's `id`, you can set the value using the model's `getRouteKeyName()` method. For more complex lookups, can make use of [explicit binding](https://laravel.com/docs/5.5/routing#explicit-binding).
