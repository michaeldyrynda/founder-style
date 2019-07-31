---
title: Conditionals
---

# Conditionals

Conditionals are a common part of any application, but there are a few simple conventions you can follow which makes them easier to parse when scanning through a file.

## Avoid `if`/`elseif`/`else` chains

It is often easier to reason about the execution path of conditional behaviour using [Guard Clauses](https://refactoring.com/catalog/replaceNestedConditionalWithGuardClauses.html), rather than chaining one or more `elseif` or `else` statements, or using compound conditions.

In general, handling error conditions early in your conditional block works best; it allows you to see upfront any conditions that would cause an error.

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

## Compound conditionals

Compound conditional statements - those chained together with `&&` or `||` operators - are typically a good candidate for refactoring to using guard clauses. If the compound statement is required, extract the logic to a readable method name within your application. Readable method names demonstrate clear intent and reduce cognitive overhead parsing complex statements.

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

Avoid nesting ternary operations. They are trickier to reason about and don't necessarily execute in the order you expect.
