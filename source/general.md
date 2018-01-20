---
extends: _layouts.master
section: content
title: General
---
At its most simple level, each Laravel project must follow the code styles set out in the [PSR-1](http://www.php-fig.org/psr/psr-1/) and [PSR-2](http://www.php-fig.org/psr/psr-2/) recommendations. Project style is maintained by a [`.php_cs`](https://github.com/michaeldyrynda/founder/blob/master/.php_cs) configuration file, in combination with the [friendsofphp/php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) project. You can run this configuration via Composer using `composer run-script fix-cs`.

Any variables declared within the context of your application should use `camelCase` syntax, except where noted otherwise in this guide.

Always strive to keep your code expressive and human-readable. Make it easy for the next developer that looks at the code to be able to reason about your intent.

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

## Exceptions

Exceptions are a good way to control the flow of your code and provide detailed and descriptive error messages to developers.

When you inline exceptions in your code, it's difficult to see various error cases as they may be split across different files, which in turn makes it harder to see why you're raising exceptions in the first place.

```php
public function index()
{
    if ($this->invalidStep(request('step'))) {
        throw new RuntimeException(
            vsprintf('The step [%s] is invalid. Valid steps are: %s', [
                request('step'),
                $this->validSteps()->implode(', '),
            ])
        );
    }

    // ...
}
```

Placing exception messages behind static methods on custom exception classes allows you to keep your code clear and concise, hiding the implementation detail i.e. the precise message and formatting in a class specifically responsible for that behaviour.

```php
// SignupException.php
class SignupException extends RuntimeException
{
    public static function invalidStep($step, $validSteps)
    {
        return new static(vsprintf('The step [%s] is invalid. Valid steps are: %s', [
            request('step'),
            $this->validSteps()->implode(', '),
        ]));
    }
}

// SignupsController.php
public function index()
{
    if ($this->invalidStep(request('step'))) {
        throw SignupException::invalidStep(request('step'), $this->validSteps());
    }
}
```

Co-locating messages inside your custom exception classes makes it not only easier to track each message and its formatting, but also to determine when an exceptions messages start to drift apart in focus, allowing you to split them up into new exception classes with a narrower focus and more concise API.

## Don't talk to strangers

The [Law of Demeter](https://en.wikipedia.org/wiki/Law_of_Demeter) is a particularly useful design guideline that helps you to design more concise APIs. Consider the following Eloquent model.

```php
class Post extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
```

When a new `Comment` is added to a `Post` you might write something along the following lines in your controller.

```php
// PostCommentsController.php
public function store(Post $post)
{
    $post->comments()->create([
        'author_id' => auth()->id(),
        'comment' => request('comment'),
    ]);

    return redirect()->route('posts.show', $post);
}
```

The Law of Demeter helps to decouple your code by encouraging you to ensure each unit only has limited knowledge of other units. That is to say that your controller should not need to know how to reach through the `Post` model in order to create a new `Comment`. Instead, consider abstracting this functionality behind a new method. Hiding this information helps your controller assume as little as possible about how a `Post` and `Comment` would be related.

```php
// Post.php
public function addComment($comment)
{
    $this->comments()->create([
        'author_id' => $author->id,
        'comment' => $comment,
    ]);
}

// PostCommentsController.php
public function store(Post $post)
{
    $post->addComment(auth()->user(), request('comment'));

    return redirect()->route('posts.show', $post);
}
```
