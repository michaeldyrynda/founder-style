---
extends: _layouts.master
section: content
title: Routing
previousLink: /configuration
previous: Configuration
nextLink: /controllers
next: Controllers
---

All application routes must use kebab-case and all route names must use `camelCase`.

```php
// http://example.com/my-endpoint
Route::get('my-endpoint', 'MyEndpointController@index')->name('myEndpoint');
```

```html
<a href="{{ route('myEndpoint') }}">
    My Endpoint
</a>
```

## Route declaration <a class="text-grey" name="route-declaration" href="#route-declaration">#</a>

When declaring routes in your application, be sure to always define the HTTP verb first. This makes it much easier to visually scan the routes file.

```php
// Good
Route::get('my-endpoint', 'MyEndpointController@index')->name('myEndpoint');
Route::post('your-endpoint', 'YourEndpointController@store')->name('yourEndpoint');

// Bad
Route::name('myEndpoint')->get('my-endpoint', 'MyEndpointController@index');
Route::name('yourEndpoint')->post('your-endpoint', 'YourEndpointController@store');
```
