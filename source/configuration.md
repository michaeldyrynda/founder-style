---
extends: _layouts.master
section: content
title: Configuration
previousLink: /conditionals
previous: Conditionals
nextLink: /routing
next: Routing
---

Files that live inside your application's `config/` directory must use kebab-case.

```
config/
  my-config-file.php
```

Within these files, configuration keys must use `snake_case`.

```php
// config/my-config-file.php
return [
    'my_config_key' => env('CONFIG_KEY'),
];
```

You **must not** use the `env()` helper outside of the configuration files. In production deployments, the configuration is cached (using `php artisan config:cache`), and any calls to the `env()` helper outside of your configuration will return `null`.

Create a corresponding configuration value for the `env()` variable, and be sure to include it in the application's `.env.example` file.
