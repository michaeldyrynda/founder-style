<?php

return [
    'baseUrl' => '',
    'production' => false,
    'collections' => [],
    'selected' => function ($page, $path) {
        $pages = collect(array_wrap($page));

        return $pages->contains(function ($page) use ($path) {
            return str_contains($page->getPath(), $path);
        });
    },
    'navigation' => require_once('navigation.php'),
];
