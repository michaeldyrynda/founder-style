---
extends: _layouts.master
section: content
title: General
---

At the most simple level, each Laravel project must follow the code styles set out in the [PSR-1](http://www.php-fig.org/psr/psr-1/) and [PSR-2](http://www.php-fig.org/psr/psr-2/) recommendations. Project style is maintained by a [`.php_cs`](https://github.com/michaeldyrynda/founder/blob/master/.php_cs) configuration file, in combination with the [friendsofphp/php-cs-fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) project. You can run the fixer manually via Composer using `composer run-script fix-cs`.

Any variables declared within the context of your application must use `camelCase` syntax, except where noted otherwise in this guide.

Always strive to keep your code expressive and human-readable. Make it easy for the next developer that looks at the code to be able to reason about your intent. Realise that that developer could well be you trying to fix an issue at 4pm on a Friday, six months from now.

## Should I rename my application? <a class="text-grey" name="should-i-rename-my-application" href="#should-i-rename-my-application">#</a>

Laravel ships with an `app:name` command. *Never* rename your application. Keeping the `App` namespace reduces cognitive overhead between applications such that you always always import each application's classes from the same namespace when working between different projects.

## Whitespace <a class="text-grey" name="whitespace" href="#whitespace">#</a>

PHP will be interpreted whether you write it with no whitespace or if you write it with double spacing. For readability, it is better to cater to your fellow developers rather than for the PHP interpreter. Don't be afraid to use whitespace.

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

## Exceptions <a class="text-grey" name="exceptions" href="#exceptions">#</a>

Exceptions are a good way to control the flow of your code and provide detailed and descriptive error messages to developers.

When you inline exceptions in your code, it can quickly become difficult to understand all the possible error cases as they may be split across different files, which in turn makes it harder to see why you might be raising exceptions wholistically.

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

Learn more about [formatting exception messages](http://rosstuck.com/formatting-exception-messages) from [Ross Tuck](https://twitter.com/rosstuck).

## Don't talk to strangers <a class="text-grey" name="dont-talk-to-strangers" href="#dont-talk-to-strangers">#</a>

The [Law of Demeter](https://en.wikipedia.org/wiki/Law_of_Demeter) is a particularly useful design guideline that helps you to build more concise APIs. Consider the following Eloquent model.

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

The Law of Demeter helps to decouple your code by encouraging you to ensure that each unit only has limited knowledge of other units. That is to say that your controller should not need to know how specifically a `Comment` is added to a `Post`.

Instead, consider abstract this implementation detail behind a new method. In doing so, your controller needn't know how a `Post` and `Comment` would be related, and if the implementation changes, the call to do so doesn't. SOLID!

```php
// Post.php
public function addComment($author, $comment)
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
