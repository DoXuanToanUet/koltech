<?php
namespace WPIDE\App\Services\Storage;

use const WPIDE\Constants\CONTENT_DIR;
use const WPIDE\Constants\DIR;
use const WPIDE\Constants\UPLOADS_DIR;

use WPIDE\App\AppConfig;
use WPIDE\App\Services\Storage\Adapters\WPFileSystem;
use League\Flysystem\Adapter\Local;

class LocalFileSystem {

    public static function load($root = null): Filesystem
    {

        $fs = new Filesystem();
        $fs->init(self::getConfig($root));

        return $fs;
    }

    public static function getConfig($root = null, $excluded = []): array
    {
        if(empty($root)) {
            $root = apply_filters('wpide_filesystem_root', AppConfig::get('file.root'));
        }

        $root = wp_normalize_path($root);

        if(!str_contains($root, CONTENT_DIR)) {
            $root = CONTENT_DIR.$root;
        }

        return [
            'root' => $root,
            'separator' => '/',
            'excluded_dirs' => !empty($excluded['dirs']) ? $excluded['dirs'] : [],
            'excluded_files' => !empty($excluded['files']) ? $excluded['files'] : [],
            'config' => [],
            'adapter' => function() use($root){

                $permissions = [
                    'file' => [
                        'public' => defined( 'FS_CHMOD_FILE' ) ? FS_CHMOD_FILE : (fileperms( ABSPATH . 'index.php' ) ? 0644 : 0777),
                        'private' => 0600,
                    ],
                    'dir' => [
                        'public' => defined( 'FS_CHMOD_DIR' ) ? FS_CHMOD_DIR : (fileperms( ABSPATH ) ? 0755 : 0777),
                        'private' => 0700,
                    ],
                ];

                $use_wp_filesystem  = false;
                $credentials = null;

                // Try and use WP filesystem
                if(function_exists('request_filesystem_credentials')) {
                    ob_start();
                    $credentials = request_filesystem_credentials('', '', false, false);
                    ob_end_clean();
                    $use_wp_filesystem = true;
                }

                if ( $use_wp_filesystem && wp_filesystem( $credentials ) ) {
                    global $wp_filesystem;
                    return new WPFileSystem($root, $wp_filesystem, 1, $permissions );
                }else{
                    return new Local($root, LOCK_EX, 1, $permissions );
                }

            }
        ];
    }


    public static function excludedDirs(): array
    {
        $user_excluded_dirs = array_filter(AppConfig::get('file.filter_entries', []), function($entry) {

            return substr($entry , -1) === '/';
        });

        return array_merge(
            [
                DIR,
                rtrim(DIR, '/').'-pro/',
                UPLOADS_DIR,
                wp_normalize_path(ABSPATH . 'wp-admin/'),
                wp_normalize_path(ABSPATH . 'wp-includes/')
            ],
            $user_excluded_dirs
        );
    }

    public static function excludedFiles(): array
    {

        $user_excluded_files = array_filter(AppConfig::get('file.filter_entries', []), function($entry) {

            return substr($entry , -1) !== '/';
        });

        return array_merge(
            [
                wp_normalize_path(ABSPATH . '!wp-config.php'),
                wp_normalize_path(ABSPATH . 'wp-*.php'),
                wp_normalize_path(ABSPATH . 'index.php'),
                wp_normalize_path(ABSPATH . 'xmlrpc.php'),
                CONTENT_DIR.'/fatal-error-handler.php',
            ],
            $user_excluded_files
        );
    }

}