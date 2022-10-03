<?php
defined('ABSPATH') || exit;

return apply_filters('wpide_config', [
    'general' => [
        'dark_mode' => [
            'type' => 'bool',
            'label' => __('Dark Mode', 'wpide'),
            'default' => false
        ],
        'skin' => [
            'type' => 'swatches',
            'label' => __('Theme', 'wpide'),
            'options' => [
                'default' => 'Default',
                'blue' => 'Blue',
                'egyptian' => 'Egyptian',
                'green' => 'Green',
                'purple' => 'Purple',
                'red' => 'Red'
            ],
            'default' => 'default'
        ]
    ],
    'file' => [
        'root' => [
            'type' => 'folders',
            'label' => __('Root Path', 'wpide'),
            'default' => '/'
        ],
        'overwrite_on_upload' => [
            'type' => 'bool',
            'label' => __('Override on upload', 'wpide'),
            'default' => false
        ],
        'calc_dir_size' => [
            'type' => 'select',
            'label' => __('Calculate folder size', 'wpide'),
            'desc' => __('Folder size will be cached for faster load on subsequent requests.', 'wpide'),
            'options' => [
                'ondemand' => __('On Demand', 'wpide'),
                'onload' => __('On load', 'wpide'),
                'disabled' => __('Disabled', 'wpide'),
            ],
            'default' => 'ondemand',
        ],
        'backups_max_days' => [
            'type' => 'number',
            'label' => __('Backups max days', 'wpide'),
            'desc' => __('Remove backup folders older than X days', 'wpide'),
            'default' => 5
        ],
        'upload_max_size' => [
            'type' => 'number',
            'label' => __('Max upload size (MB)', 'wpide'),
            'default' => 100 * 1024 * 1024, // 100MB
        ],
        'upload_chunk_size' => [
            'type' => 'number',
            'label' => __('Upload chunk size (MB)', 'wpide'),
            'default' => 1 * 1024 * 1024, // 1MB
        ],
        'upload_simultaneous' => [
            'type' => 'number',
            'label' => __('Simultaneous uploads', 'wpide'),
            'default' => 3,
        ],
        'default_archive_name' => [
            'type' => 'text',
            'label' => __('Default archive name', 'wpide'),
            'default' => 'archive.zip',
        ],
        'editable' => [

            'type' => 'select',
            'multiple' => true,
            'label' => __('Editable files', 'wpide'),
            'options' => [
                '.' => 'File without extension',
                'txt' => '.txt',
                'css' => '.css',
                'scss' => '.scss',
                'less' => '.less',
                'js' => '.js',
                'html' => '.html',
                'php' => '.php',
                'json' => '.json',
                'xml' => '.xml',
                'yml' => '.yml',
                'md' => '.md',
                'log' => '.log',
                'htaccess' => '.htaccess'
            ],
            'default' => ['.', 'txt', 'css', 'scss', 'less', 'js', 'html', 'php', 'json', 'yml', 'xml', 'md', 'log', 'htaccess']
        ],
        'autoplay_media' => [
            'type' => 'bool',
            'label' => __('Auto play media files, when possible.', 'wpide'),
            'desc' => __('Chromium browsers do not allow autoplay, unless user interaction is detected on the page.', 'wpide'),
            'default' => false
        ],
        'search_simultaneous' => [
            'type' => 'number',
            'label' => __('Simultaneous search', 'wpide'),
            'default' => 5,
        ],
        'filter_entries' => [
            'type' => 'text',
            'repeater' => true,
            'label' => __('Entries filter', 'wpide'),
            'desc' => __('Enter partial or full path. To exclude folders, add a trailing slash. Note: WordPress core files as well as important WPide folders and files are hidden automatically.', 'wpide'),
            'default' => [
                '.DS_Store',
                '.tmb/',
                '.idea/',
                '.codekit-cache/',
                '.git/',
                '.sass-cache/',
                'Recycle.bin/',
                '@eaDir/',
                '#recycle/',
                'node_modules/'
            ]
        ]
    ],
    'editor' => [
        'font_size' => [
            'type' => 'range',
            'label' => __('Font Size (px)', 'wpide'),
            'attr' => [
                'min' => 10,
                'max' => 20
            ],
            'default' => 12,
        ],
        'scroll_speed' => [
            'type' => 'range',
            'label' => __('Scroll Speed', 'wpide'),
            'attr' => [
                'min' => 1,
                'max' => 20
            ],
            'default' => 3,
        ],
        'hightlight_active_line' => [
            'type' => 'bool',
            'label' => __('Highlight Active Line', 'wpide'),
            'default' => false
        ],
        'behaviours_enabled' => [
            'type' => 'bool',
            'label' => __('Enable Behaviours', 'wpide'),
            'desc' => __('When enabled, the editor will auto close tags and brackets', 'wpide'),
            'default' => true
        ],
        'use_soft_tabs' => [
            'type' => 'bool',
            'label' => __('Use Soft Tabs', 'wpide'),
            'desc' => __('When enabled, a tab key press will insert spaces instead of the tab character', 'wpide'),
            'default' => false
        ],
        'tab_size' => [
            'type' => 'range',
            'label' => __('Tab Size', 'wpide'),
            'attr' => [
                'min' => 1,
                'max' => 8
            ],
            'default' => 4
        ]
    ],
    'db' => [
        'per_page' => [
            'type' => 'select',
            'label' => __('Items per page default', 'wpide'),
            'options' => [
                '50' => '50',
                '100' => '100',
                '500' => '500',
                '1000' => '1000'
            ],
            'default' => '50',
        ],
    ]
]);
