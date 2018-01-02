---
extends: _layouts.master
section: content
title: Conditionals
---
Conditionals are a common part of any application, but there are a few simple conventions you can follow which makes them easier to parse when scanning through a file.

## Avoid `if`/`else` chains

It is often clearer to return early from a method, rather than chaining one or more `else` statements. In general, handling error conditions in your `if` statement works best; it allows you to see upfront any conditions that would cause an error.

```php
// Good
public function update($service)
{
    if (Gate::denies('update-service', $service)) {
        abort(403);
    }

    // Handle success condition...
}

// Bad
public function update($service)
{
    if (Gate::allows('update-service', $service)) {
        // Handle success condition...
    } else {
        abort(403);
    }
}
```

## Avoid nested conditionals

Whenever possible, avoid deep-nesting and look for opportunities to either extract complex conditional logic to methods or return early.

## Ternary operations

Unless you are dealing with very short ternary conditions, each expression should be on its own line.

```php
// Good
return $this->type
    ? $this->type->ContactTypeID === ContactType::TYPE_ACCOUNT_OWNER
    : false;

// Bad
return $this->type ? $this->type->ContactTypeID === ContactType::TYPE_ACCOUNT_OWNER : false;
```
