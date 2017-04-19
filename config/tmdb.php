<?php
/**
 * @package php-tmdb\laravel
 * @author Mark Redeman <markredeman@gmail.com>
 * @copyright (c) 2014, Mark Redeman
 */
return [
    /*
     * Api key
     */
    'api_key' => 'da477b9f4f22143fdb28a8742d537ec6',

    /**
     * Client options
     */
    'options' => [
        /**
         * Use https
         */
        'secure' => false,

        /*
         * Cache
         */
        'cache' => [
            'enabled' => true,
            // Keep the path empty or remove it entirely to default to storage/tmdb
            'path' => storage_path('tmdb')
        ],

        /*
         * Log
         */
        'log' => [
            'enabled' => true,
            // Keep the path empty or remove it entirely to default to storage/logs/tmdb.log
            'path' => storage_path('logs/tmdb.log')
        ]
    ],
];
