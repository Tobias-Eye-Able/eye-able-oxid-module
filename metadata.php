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
    'version'     => '3.0.0',
    'author'      => 'Webinclusion GmbH, OXID eSales AG',
    'url'         => 'https://eye-able.com/',
    'email'       => 'info@eye-able.com',
    'extend'      => [
        \OxidEsales\Eshop\Core\ViewConfig::class => \EyeAble\EyeAbleAssist\Shop\ViewConfig::class
    ],
    'blocks'      => [
        [
            'template' => 'layout/base.tpl',
            'block' => 'base_js',
            'file' => 'views/smarty/blocks/base.tpl'
        ]
    ],
    'controllers' => [
        'eyeabletrigger' => \EyeAble\EyeAbleAssist\Shop\Controller\ReportController::class
    ],
    'events' => [
        'onActivate' => '\EyeAble\EyeAbleAssist\Core\ModuleEvents::onActivate',
        'onDeactivate' => '\EyeAble\EyeAbleAssist\Core\ModuleEvents::onDeactivate'
    ],
    'settings' => [
        /** Main */
        [
            'group'       => 'eyeableassist_main',
            'name'        => 'eyeableassist_frequence',
            'type'        => 'select',
            'constraints'  => '1d|7d|14d',
            'value'       => '7d'
        ],
        [
            'group'       => 'eyeableassist_main',
            'name'        => 'eyeableassist_apiurl',
            'type'        => 'str',
            'value'       => 'https://audit-api.eye-able.com/auditStats'
        ],
        [
            'group' => 'eyeableassist_main',
            'name'  => 'eyeableassist_apikey',
            'type'  => 'str',
            'value' => 'VZNJG65cb2fce4q5'
        ],
    ]
];
