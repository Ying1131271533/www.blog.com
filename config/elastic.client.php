<?php declare(strict_types=1);

return [
    'hosts' => [
        env('ELASTIC_HOST', 'localhost:9200'),
    ],
    'basicAuthentication' => [
        env('ELASTIC_USERNAME'),
        env('ELASTIC_PASSWORD'),
    ],
];
