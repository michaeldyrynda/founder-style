---
title: Controllers
---

# Controllers

Controllers that are responsible for managing a resource must use the **singular** version of the resource in their name, consistent with Laravel's generated classes i.e. `php artisan make:model Service -m -c`

```php
// Good
class ServiceController
{
    // ...
}

// Bad
class ServicesController
{
    // ...
}
```

## RESTful controllers

Always strive to use the seven RESTful actions in your controllers: `index`, `create`, `store`, `show`, `edit`, `update`, and `destroy`. When you keep your controllers to these actions, they're easier to read and more closely adhere to a single responsibility mindset.

Don't be afraid to add a few resource-specific methods to your controller, but if you find yourself adding too many methods that apply to specific resource relationships, for example, then strive to name the relationships you're working with and create a new controller. *Never be afraid to add another controller!*.

[Adam Wathan](https://twitter.com/adamwathan) gave an [excellent talk](https://youtu.be/MF0jFKvS4SI) at Laracon US 2017 that expands on this concept in greater detail.

## Nested controllers

In most situations, seek to maintain a flat resource structure. The `index` may be directly associated with the parent resource.

```php
Route::get('/posts/{post}/comments', 'PostCommentController@index');
```

When showing an individual child resource, create its own controller.

```php
// Good
Route::get('/comments/{comment}', 'CommentController@show');

// Bad
Route::get('/posts/{post}/comments/{comment}', 'PostCommentController@show');
```

When you must create a controller for nested resources, use the singular name for both the parent resource and child resource i.e. `ServiceContactController`.

## Authorisation

When not using a [form request](https://laravel.com/docs/validation#form-request-validation) for validation and authorisation of a request, authorisation for a controller action should be the first action carried out in your controllers.

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

## Validation

When building an application, it is preferable to handle your request validation inside your controller methods until either size or complexity dictates that you extract to a [form request](https://laravel.com/docs/validation#form-request-validation). Practice [YAGNI](https://martinfowler.com/bliki/Yagni.html).

In simple instances, use the `validate` method on the `request` helper. If using form requests, be sure to type hint the form request and leverage Laravel's [Service Container](https://laravel.com/docs/container) to inject it in your method as needed.

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

## Route Model Binding

Using implicit [route model binding](https://laravel.com/docs/routing#route-model-binding) out of the box, it is trivial to load the corresponding model and pass it directly to your controller, without an extra line of code responsible for querying the database.

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

In many cases, the default implicit binding will suffice. If you want to use a column other than the model's `id`, you can set the value using the model's `getRouteKeyName()` method. For more complex lookups, can make use of [explicit binding](https://laravel.com/docs/routing#explicit-binding).
