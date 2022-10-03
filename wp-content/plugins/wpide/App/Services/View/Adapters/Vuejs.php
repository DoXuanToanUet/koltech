<?php

namespace WPIDE\App\Services\View\Adapters;

use  WPIDE\App\App ;
use  WPIDE\App\Classes\Freemius ;
use  WPIDE\App\Classes\Notices ;
use  WPIDE\App\Config\Config ;
use  WPIDE\App\Services\Service ;
use  WPIDE\App\Services\View\ViewInterface ;
use  WPIDE\WPIDE ;
use const  WPIDE\Constants\ASSETS_URL ;
use const  WPIDE\Constants\CONTENT_DIR ;
use const  WPIDE\Constants\IS_DEV ;
use const  WPIDE\Constants\NAME ;
use const  WPIDE\Constants\SLUG ;
use const  WPIDE\Constants\VERSION ;
class Vuejs implements  Service, ViewInterface 
{
    private  $config ;
    public function __construct( Config $config )
    {
        $this->config = $config;
    }
    
    public function init( array $config = array() )
    {
        $assets_url = ( !IS_DEV ? ASSETS_URL : WPIDE_DEV_ASSETS_URL );
        $prod_assets_url = ASSETS_URL;
        $skins_url = $prod_assets_url . 'css/skins/';
        $skin = $this->config->get( 'general.skin' );
        
        if ( !IS_DEV ) {
            wp_enqueue_style(
                SLUG . '-vendors',
                $assets_url . 'css/chunk-vendors.css',
                [],
                VERSION
            );
            wp_enqueue_style(
                SLUG,
                $assets_url . 'css/app.css',
                [],
                VERSION
            );
        }
        
        if ( $skin !== 'default' ) {
            wp_enqueue_style(
                SLUG . '-skin',
                $skins_url . 'theme-' . $skin . '.css',
                [],
                VERSION
            );
        }
        wp_enqueue_script(
            SLUG . '-vendors',
            $assets_url . 'js/chunks/chunk-vendors.js',
            [],
            VERSION,
            true
        );
        wp_enqueue_script(
            SLUG,
            $assets_url . 'js/app.js',
            [ 'jquery' ],
            VERSION,
            true
        );
        wp_localize_script( SLUG, 'WPIDE', [
            'premium'            => Freemius::sdk()->can_use_premium_code__premium_only(),
            'is_premium_version' => Freemius::sdk()->is__premium_only(),
            'is_license_active'  => Freemius::sdk()->is__premium_only() && Freemius::sdk()->can_use_premium_code(),
            'plugin'             => [
            'name' => NAME,
            'slug' => SLUG,
        ],
            'ajax_url'           => App::instance()->getAjaxUrl(),
            'admin_url'          => App::instance()->getAdminUrl(),
            'assets_url'         => $assets_url,
            'prod_assets_url'    => $prod_assets_url,
            'images_url'         => $prod_assets_url . 'img/',
            'skins_url'          => $skins_url,
            'is_dev'             => IS_DEV,
            'config_fields'      => $this->config->getConfigFields(),
            'filter_entries'     => [
            SLUG . '/',
            '/wp-admin/',
            '/wp-includes/',
            CONTENT_DIR . '/fatal-error-handler.php'
        ],
            'notices'            => Notices::all(),
            'account_links'      => self::getAccountLinks(),
        ] );
        $inline_scripts = apply_filters( 'wpide_inline_scripts', '' );
        if ( !empty($inline_scripts) ) {
            wp_add_inline_script( SLUG, $inline_scripts );
        }
        if ( Freemius::sdk()->is__premium_only() && !wp_doing_ajax() ) {
            Freemius::addLicenseActivationDialogBox();
        }
    }
    
    public function getAccountLinks() : array
    {
        $links = [];
        if ( Freemius::sdk()->is_pricing_page_visible() && Freemius::sdk()->is_submenu_item_visible( 'pricing' ) ) {
            $links[] = array(
                'id'    => '_pricing',
                'title' => esc_html__( 'Upgrade', 'wpide' ),
                'url'   => Freemius::sdk()->get_upgrade_url(),
                'icon'  => 'ni-arrow-up',
            );
        }
        
        if ( Freemius::sdk()->is_registered() ) {
            $links[] = array(
                'id'    => 'account',
                'title' => esc_html__( 'Account', 'wpide' ),
                'url'   => Freemius::sdk()->get_account_url(),
                'icon'  => 'ni-user-alt',
            );
        } else {
            if ( Freemius::sdk()->is_tracking_prohibited() ) {
                $links[] = array(
                    'id'    => 'optin',
                    'title' => esc_html__( 'Opt In', 'wpide' ),
                    'url'   => Freemius::sdk()->get_reconnect_url(),
                    'icon'  => 'ni-user-check',
                );
            }
        }
        
        if ( Freemius::sdk()->has_affiliate_program() ) {
            $links[] = array(
                'id'    => 'affiliates',
                'title' => esc_html__( 'Affiliates', 'wpide' ),
                'url'   => Freemius::sdk()->_get_admin_page_url( 'affiliation' ),
                'icon'  => 'ni-money',
            );
        }
        $links[] = array(
            'id'    => 'contact',
            'title' => esc_html__( 'Support', 'wpide' ),
            'url'   => Freemius::sdk()->contact_url(),
            'icon'  => 'ni-help',
        );
        return $links;
    }
    
    public function getIndexPage() : string
    {
        $output = '
        <noscript><strong>Please enable JavaScript to continue.</strong></noscript>
        <div id="' . SLUG . '-app"></div>
        ';
        return $output;
    }

}