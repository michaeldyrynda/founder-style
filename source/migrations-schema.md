---
extends: _layouts.master
section: content
title: Migrations & Schema
previousLink: /eloquent
previous: Eloquent
---

## Modifying migrations <a class="text-grey" name="modifying-migrations" href="#modifying-migrations">#</a>

Once a migration file has left your development environment and is in the `master` branch, it must never be modified as the risk that it has been cloned by another developer or deployed to production means changes could break other environments.

Until that time, feel free to modify the migration as much as required.

## Forward-rolling migrations <a class="text-grey" name="forward-rolling-migrations" href="#forward-rolling-migrations">#</a>

When generating migration files, they will contain both an `up` method and a `down` method.

The `down` method must not be used and should be removed. Reversing migrations will lead to data loss and most times this is not desirable, particularly if you have already captured user input.

In the event that a migration must be modified or removed, create a new migration that performs the necessary changes, allowing you to continue rolling forward only.

## `enum` columns <a class="text-grey" name="enum-columns" href="#enum-columns">#</a>

Do not use `enum` columns. Due to a limitation in the underlying `doctrine/dbal` library, it is not possible to modify a table in *any way* if it contains an `enum` column. In part, this is due to the way that an `enum` column maps state, which the underlying library does not support.

If you find yourself reaching for an `enum`, consider doing so in code. As you are likely to map `enum` values to class constants in some way in order to avoid passing strings through your application, you can use the [`myclabs/php-enum`](https://github.com/myclabs/php-enum) package.

Note you should use enumerables only when you have a small number of choices that are not likely to change often.

Should you have many values, or values that need to be modified by your application's users, you must use an appropriate database solution i.e. as has many or many to many relationship.
