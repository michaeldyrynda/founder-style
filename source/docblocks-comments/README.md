---
title: Docblocks & Comments
---

# Docblocks & Comments

Whilst docblocks can be useful for introducing new developers in your codebase to your functions, it is much too easy for them to fall out of sync with your actual implementation if you're not careful. Avoid them wherever possible by writing expressive code.

**Never** leave commented out code in your application. Your version control system is responsible for handling code that was - or should be - deleted.

Comments that describe the purpose of some method are usually a good indicator that the method is not clearly named.

```php
// Good
public function recentServiceSignups()
{
    // ...
}

// Bad
// Get services that recently signed up
public function recentServices()
{
    // ...
}
```

Likewise, comments that describe _what_ code is doing are often unnecessary.

```php
// array of services
$return = [];
```

Comments that explain _how_ code functions are often suitable for extraction to their own method.

```php
// Good
return $this->recentResidentialServiceSignups($services);

// Bad
// Loop over recent signups and return those of a specific type
foreach ($services as $service) {
    if ($service->type == 'Residential') {
        $return[] = $service;
    }
}

return $return;
```

If your method is typehinted, or its intent is clear, avoid needless docblocks.

```php
// Good
class Service
{
    public static function createFromDetails(array $details) : Service
    {
        // ...
    }
}

// Bad: The description doesn't add any extra context
class Service
{
    /**
     * Create a signup from the given details.
     *
     * @param  array  $details
     *
     * @return \App\Entities\Service
     */
    public static function createFromDetails(array $details) : Service
    {
        // ...
    }
}
```

When necessary, always use the fully-qualified class name in your docblocks.

```php
// Good

/**
 * @param  array  $details
 *
 * @return \App\Entities\Service
 */

// Bad

/**
 * @param  array  $details
 *
 * @return Service
 */
```
