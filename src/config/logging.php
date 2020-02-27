<?php

return [
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['syslog', 'slack','single'],
        ],
         'syslog' => [
             'driver' => 'syslog',
         ],
         'single' => [
             'driver' => 'single',
             "path" => "../storage/logs/laravelSingle.log",
             'level' => 'debug'
         ],
        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'api-test',
            'emoji' => ':boom:',
            'level' => 'critical'
        ],
    ],
];
