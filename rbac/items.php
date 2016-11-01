<?php
return [
    'createWord' => [
        'type' => 2,
        'description' => 'Create Word',
    ],
    'updateWord' => [
        'type' => 2,
        'description' => 'Update Word',
    ],
    'demo' => [
        'type' => 1,
        'children' => [
            'createWord',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'createWord',
            'updateWord',
        ],
    ],
];
