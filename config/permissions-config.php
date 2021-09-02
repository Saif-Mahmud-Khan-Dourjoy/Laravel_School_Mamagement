<?php 

    return [
        'rolepermission-enable' => env('ROLE_ENABLE',false),
        'do-migration' => true,
        'model' => 'App\User',
        'primary-key' => 'id',
        'name' => 'name',
        'login-route' => 'login'
    ];