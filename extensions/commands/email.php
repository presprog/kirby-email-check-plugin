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
            'prefix'      => 's',
            'longPrefix'  => 'subject',
            'description' => 'The message subject',
            'default'     => '🎉 Your configured Kirby transport is working!'
        ],
        'body' => [
            'prefix'      => 'b',
            'longPrefix'  => 'body',
            'description' => 'The message body',
            'default'     => "Congratulations, your configured Kirby transport is working.\n\nNow go send some emails 🚀",
        ],
        'preset' => [
            'prefix'      => 'p',
            'longPrefix'  => 'preset',
            'description' => 'The email preset',
        ],
    ],
    'command' => function (CLI $cli) {
        $kirby = $cli->kirby();

        $props = [
            'from' => $cli->argOrPrompt('from', 'Please enter the sender address:'),
            'to'   => $cli->argOrPrompt('to', 'Please enter the recipient address:'),
        ];

        $preset = $cli->arg('preset');

        if ($preset) {
            $cli->climate()->out(sprintf('Using preset: %s', $preset));
        }

        if ($transport = $kirby->option('email.transport')) {
            $props['transport'] = $transport;
        }

        $props['beforeSend'] = function (PHPMailer $mailer) use ($cli) {
            $mailer->SMTPDebug = 3;
            $mailer->Timeout   = 15;
        };

        try {
            $kirby->email($preset ?? [], $props);
            $cli->climate()->success('Email sent successfully');
        } catch (Exception $exception) {
            $cli->climate()->info('There was an error sending your email');
            $cli->climate()->error($exception->getMessage());
        }

    },
];
