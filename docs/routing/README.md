---
title: Routing
---

# Routing

Always try and keep your endpoints RESTful wherever possible, using the seven operations as described in the [RESTful controllers](/controllers/#restful-controllers) documentation.

```php
// http://example.com/articles
Route::get('articles', 'ArticleController@index')->name('articles.index');
```

```html
<a href="{{ route('articles.index') }}">
    Articles
</a>
```

## Route parameters

When specifying parameters, use the singular form of the resource name.

```php
// Good
Route::get('articles/{article}', 'ArticleController@show')->name('articles.show');

// Bad
Route::get('articles/{articles}', 'ArticleController@show')->name('articles.show');
```

When declaring nested route names, use the singular form of the parent resource and plural for the child.

```php
// Good
Route::post('articles/{article}/comments', 'ArticleCommentsController@store')
     ->name('article.comments.store');

// Bad
Route::post('articles/{article}/comments', 'ArticleCommentsController@store')
     ->name('articles.comments.store');
```

## Route declaration

When declaring routes in your application, be sure to always define the HTTP verb first. This makes it much easier to visually scan the routes file.

```php
// Good
Route::get('articles', 'ArticlesController@index')->name('articles.index');
Route::post('articles/{article}/comments', 'ArticleCommentsController@store')
     ->name('article.comments.store');

// Bad
Route::name('articles.index')->get('articles', 'ArticlesController@index');
Route::name('article.comments.store')
     ->post('articles/{article}/comments', 'ArticleCommentsController@store');
```
