# Easily check your email transport configuration with one simple command

You just set up the new server and deployed your Kirby application and would like to check whether your application is ready to send emails? Just run one simple command from the CLI and get a detailed log of what is happening (or not).

```bash
$ kirby email --from me@example.org --to also-me@example.org
# … (SMTP debugging output)
$ Your email was sent successfully!
```

## Installation

Install this plugin via **Composer**:

```bash
composer require presprog/kirby-email-check-plugin
```

Or **download the ZIP file** from GitHub and unpack it to `site/plugins/email-check`

## Limitations

If you have defined your email transport in a per-host config file (e.g. `config.example.com.php`) you MUST define the base URL for your current environment in `env.php`. Follow the guide to set this up.

```php
// in /site/config/env.php

return [
    'url' => 'https://example.com',
];
```

Without this definition, Kirby derives the hostname from the domain name the website has been requested with. On the CLI there is no such thing, which is why Kirby cannot resolve for the right per-host config file and your transport configuration will not be loaded in this case.

Another way is to define your email transport in the global `config.php`. Since your transport config will likely differ between your local, staging and production environment, you would have to resolve the right values otherwise, e.g. with a `.env` file:

```php
// in /site/config/config.php
$transport = [
    'type' => 'mail',
];

if (env('MAILER_HOST') && env('MAILER_PORT')) {
    $transport = [
        'type' => 'smtp',
        'host' => env('MAILER_HOST'),
        'port' => env('MAILER_PORT'),
        'security' => env('MAILER_SECURITY') ?? false,
    ];

    if (env('MAILER_USERNAME') && env('MAILER_PASSWORD')) {
        $transport['email']['transport']['auth']     = true;
        $transport['email']['transport']['username'] = env('MAILER_USERNAME');
        $transport['email']['transport']['password'] = env('MAILER_PASSWORD');
    }
}

return [
    'email' => [
        'transport' => $transport,
    ],
];
```

```dotenv
# in /.env
MAILER_HOST=smtp.example.com
MAILER_PORT=587
MAILER_SECURITY=tls
```

## Requirements
This plugin required the Kirby CLI to be installed. It will not be installed automatically, though. Please follow [their installation guide](https://getkirby.com/plugins/getkirby/cli).

## License

MIT License Copyright © 2024 Present Progressive

----

<img src="/logo.svg?raw=true" width="200" height="43">

Made by [Present Progressive](https://www.presentprogressive.de) for the Kirby community.
