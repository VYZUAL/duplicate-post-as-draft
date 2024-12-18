<?php
/*
Plugin Name: Duplicate Post as Draft
Description: Easily duplicate posts and pages as drafts in WordPress, preserving all Elementor content and templates.
Version: 1.7
Author: Ilona de Haan
Author URI: https://vyzual.nl
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: duplicate-post-as-draft
*/

namespace VYZUAL\DuplicatePostAsDraft;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class DuplicatePostPlugin {

    public function __construct() {
        add_filter( 'post_row_actions', array( $this, 'add_duplicate_link' ), 10, 2 );
        add_filter( 'page_row_actions', array( $this, 'add_duplicate_link' ), 10, 2 );
        add_action( 'admin_action_duplicate_post_as_draft', array( $this, 'duplicate_post' ) );
    }

    public function add_duplicate_link( $actions, $post ) {
        if ( current_user_can( 'edit_posts' ) ) {
            $url = wp_nonce_url(
                admin_url( 'admin.php?action=duplicate_post_as_draft&post=' . $post->ID ),
                basename( __FILE__ ),
                'duplicate_nonce'
            );

            $actions['duplicate'] = '<a href="' . esc_url( $url ) . '" title="' . esc_attr__( 'Duplicate this post', 'duplicate-post-as-draft' ) . '">' . esc_html__( 'Duplicate', 'duplicate-post-as-draft' ) . '</a>';
        }

        return $actions;
    }

    public function duplicate_post() {
        if (
            ! isset( $_GET['post'] ) ||
            ! isset( $_GET['duplicate_nonce'] ) ||
            ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['duplicate_nonce'] ) ), basename( __FILE__ ) )
        ) {
            wp_die( esc_html__( 'Invalid request. Please try again.', 'duplicate-post-as-draft' ) );
        }

        $post_id = absint( $_GET['post'] );
        $post    = get_post( $post_id );

        if ( ! $post || ! current_user_can( 'edit_posts' ) ) {
            wp_die( esc_html__( 'You do not have permission to duplicate this post.', 'duplicate-post-as-draft' ) );
        }

        $new_post = array(
            'post_title'   => $post->post_title . ' (Copy)',
            'post_content' => $post->post_content,
            'post_status'  => 'draft',
            'post_author'  => get_current_user_id(),
            'post_type'    => $post->post_type,
        );

        $new_post_id = wp_insert_post( $new_post );

        // Copy all meta-data.
        $meta_data = get_post_meta( $post_id );
        foreach ( $meta_data as $key => $values ) {
            foreach ( $values as $value ) {
                if ( $key === '_elementor_data' ) {
                    $decoded_data = json_decode( $value, true );
                    if ( $decoded_data ) {
                        update_post_meta( $new_post_id, $key, wp_slash( wp_json_encode( $decoded_data ) ) );
                    }
                } else {
                    add_post_meta( $new_post_id, $key, maybe_unserialize( $value ) );
                }
            }
        }

        // Force Elementor to regenerate CSS for the new post.
        if ( class_exists( '\Elementor\Plugin' ) ) {
            \Elementor\Plugin::$instance->files_manager->clear_cache();
        }

        // Clear cache for caching plugins.
        $this->clear_caching_plugins_cache( $new_post_id );

        wp_safe_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
        exit;
    }

    private function clear_caching_plugins_cache( $new_post_id ) {
        // WP Super Cache
        if ( function_exists( 'wp_cache_clear_cache' ) ) {
            wp_cache_clear_cache();
        }

        // W3 Total Cache
        if ( function_exists( 'w3tc_flush_all' ) ) {
            w3tc_flush_all();
        }

        // LiteSpeed Cache
        if ( class_exists( 'LiteSpeed_Cache_API' ) ) {
            \LiteSpeed_Cache_API::purge_post( $new_post_id );
        }

        // WP Fastest Cache
        if ( function_exists( 'wpfc_clear_all_cache' ) ) {
            wpfc_clear_all_cache( true );
        }

        // Breeze Cache (Cloudways)
        if ( function_exists( 'breeze_clear_cache' ) ) {
            breeze_clear_cache();
        }
    }
}

new DuplicatePostPlugin();
