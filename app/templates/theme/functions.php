<?php
/**
 * WP_theme functions file
 *
 * @package WordPress
 * @subpackage WP_theme
 * @since WP_theme 1.0
 */

/******************************************************************************\
  Theme support, standard settings, menus and widgets
\******************************************************************************/

add_theme_support( 'post-formats', array( 'image'/*, 'quote', 'status', 'link'*/) );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );

include_once "includes/theme_general_settings.php";

function register_custom_menus(){
  register_nav_menu( 'primary-menu',   'Primary menu' );
}
add_action( 'init', 'register_custom_menus' );

function theme_editor_style() {
    add_editor_style( 'css/wp-editor-style.css' );
}
add_action( 'init', 'theme_editor_style' );

function remove_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_comments_admin_menu');

/******************************************************************************\
  Scripts and Styles
\******************************************************************************/

function WP_theme_enqueue_scripts() {
  // deregister
  wp_deregister_script('jquery');
  wp_deregister_script('jquery-migrate');
  // head
  wp_enqueue_style( 'custom-styles', get_template_directory_uri() . '/css/style.css', array(), '1.0' );
  wp_enqueue_script( 'default-head-scripts', get_template_directory_uri() . '/js/head.js', array(), '1.0', false );
  // foot
  wp_enqueue_script( 'jquery', "http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js", array(), '1.11.0', !is_admin() );
  wp_enqueue_script( 'default-body-scripts', get_template_directory_uri() . '/js/body.js', array(), '1.0', !is_admin() );
  if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'WP_theme_enqueue_scripts' );


/******************************************************************************\
  Content functions
\******************************************************************************/


include_once "includes/theme_functions.php";
include_once "includes/theme_walkers.php";