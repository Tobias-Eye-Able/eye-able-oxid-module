<?php

/**
 * Copyright © Webinclusion GmbH. All rights reserved.
 * See LICENSE file for license details.
 */

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

/**
 * Module information
 */
$aModule = [
    'id'          => 'eyeable_assist',
    'title'       => 'Eye-Able® Assist',
    'description' =>  'This is the Eye-Able® Assist Module. It helps to improve the accesibility of your shop or website. Eye-Able® Assist allows customers to customize the website to their individual needs.',
    'thumbnail'   => 'pictures/logo.png',
    'version'     => '2.0.0',
    'author'      => 'Webinclusion GmbH',
    'url'         => 'https://eye-able.com/',
    'email'       => 'info@eye-able.com',
    'extend'      => [],
    'blocks'      => [
        [
            //It is possible to replace blocks by theme, to do so add 'theme' => '<theme_name>' key/value in here
            'template' => 'layout/base.tpl',
            'block' => 'base_js',
            'file' => 'views/smarty/blocks/base.tpl'
        ]
    ],
];
