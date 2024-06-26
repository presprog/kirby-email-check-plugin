<?php declare(strict_types=1);

use Kirby\CLI\CLI;
use PHPMailer\PHPMailer\PHPMailer;

return [
    'name' => 'email',
    'args' => [
        'from' => [
            'prefix'      => 'f',
            'longPrefix'  => 'from',
            'description' => 'The sender address',
        ],
        'to' => [
            'prefix'      => 't',
            'longPrefix'  => 'to',
            'description' => 'The recipient address',
        ],
        'subject' => [
            'prefix'       => 's',
            'longPrefix'   => 'subject',
            'description'  => 'The message subject',
            'defaultValue' => '🎉 Your configured email transport is working!'
        ],
        'body' => [
            'prefix'       => 'b',
            'longPrefix'   => 'body',
            'description'  => 'The message body',
            'defaultValue' => "Congratulations, your configured email transport is working.\n\nNow go send some emails 🚀",
        ],
    ],
    'command' => function (CLI $cli) {
        $props = [
            'from'    => $cli->argOrPrompt('from', 'Please enter the sender address:'),
            'to'      => $cli->argOrPrompt('to', 'Please enter the recipient address:'),
            'subject' => $cli->arg('subject'),
            'body'    => $cli->arg('body'),
        ];

        $kirby = $cli->kirby();

        // Since we are on the command-line, we may not get the right transport here,
        // because host-based config files may not be loaded
        // TODO: Load transport from environment config files
        if ($transport = $kirby->option('email.transport')) {
            $props['transport'] = $transport;
        }

        // TODO: Also run `beforeSend` from local config
        $props['beforeSend'] = function (PHPMailer $mailer) {
            $mailer->SMTPDebug = 3;
            $mailer->Timeout   = 15;
        };

        try {
            $kirby->email($props);
            $cli->climate()->success('Email sent successfully');
        } catch (Exception $exception) {
            $cli->climate()->info('There was an error sending your email');
            $cli->climate()->error($exception->getMessage());
        }

    },
];
