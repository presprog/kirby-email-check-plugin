![Kirby Email Check Plugin](/.github/banner.png)

# Easily check your email transport configuration with one simple command

> ⚡ Ready for Kirby 4!

You just set up the new server and deployed your Kirby application and would like to check whether your application is ready to send emails? Just run one simple command from the CLI and get a detailed log of what is happening (or not).

> [!IMPORTANT]
> Requires at least Kirby 4.0 and PHP 8.0

## 🚀 How to use

Just run this command from the terminal:

```bash
$ kirby email --from me@example.org --to also-me@example.org
# … (SMTP debugging output)
$ Your email was sent successfully!
```

## ⚙️ Config

Every argument has to be passed to the command:

| argument | description                 |
|----------|-----------------------------|
| from*    | The sender email address    |
| to*      | The recipient email address |
| subject  | The email subject           |
| body     | The email body              |

\* required arguments

## 💻 How to install

Install this plugin via **Composer**:

```bash
composer require presprog/kirby-email-check-plugin
```

Or **download the ZIP file** from GitHub and unpack it to `site/plugins/email-check`

> [!IMPORTANT]
> This plugin requires the Kirby CLI to be installed. It will not be installed automatically, though. Please follow [their installation guide](https://getkirby.com/plugins/getkirby/cli).

## 🧱 Current limitations

The Kirby CLI is not aware of your current environment: it loads the host-based config files (e.g. `config.example.org.php`) depending on the current domain. On the CLI there is no such thing. In order to correctly load the right transport settings, you must use Kirbys `env.php` to tell the system, which URL is currently in use. [Follow the guide](https://getkirby.com/docs/guide/configuration#multi-environment-setup__deployment-configuration) to set this up.

```php
// in /site/config/env.php

return [
    'url' => 'https://example.com',
];
```

## ✅ To do
* [ ] Handle presets
* [ ] Improve host-based config file handling

## 📄 License

MIT License Copyright © 2024 Present Progressive

----

<img src="/.github/logo.svg?raw=true" width="200" height="43">

Made by [Present Progressive](https://www.presentprogressive.de) for the Kirby community.
