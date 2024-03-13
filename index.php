<?php declare(strict_types=1);

@include_once __DIR__ . '/vendor/autoload.php';

\Kirby\Cms\App::plugin('presprog/email-check', [
    'commands' => [
        'email' => require __DIR__ . '/extensions/commands/email.php',
    ],
]);
