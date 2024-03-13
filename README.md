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

## Requirements
This plugin required the Kirby CLI to be installed. It will not be installed automatically, though. Please follow [their installation guide](https://getkirby.com/plugins/getkirby/cli).

## License

MIT License Copyright © 2024 Present Progressive

----

<img src="/logo.svg?raw=true" width="200" height="43">

Made by [Present Progressive](https://www.presentprogressive.de) for the Kirby community.
