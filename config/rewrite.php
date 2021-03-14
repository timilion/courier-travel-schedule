<?php

return [
    //route => [class, action]
    '/' =>  [
        'class' => 'controllers\Site',
        'action' => 'index'
    ],
    '/create' => [
        'class' => 'controllers\Site',
        'action' => 'create'
    ]
];
