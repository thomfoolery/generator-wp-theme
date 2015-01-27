<?php
/**
 * cvp template for displaying the header
 *
 * @package WordPress
 * @subpackage cvp
 * @since cvp 1.0
 */
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="ie ie-no-support lt-ie7 lt-ie8 lt-ie9 lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="ie ie7 lt-ie8 lt-ie9 lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="ie ie8 lt-ie9 lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="ie ie9 lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php if(!is_home()){wp_title('');echo ' &raquo; ';}bloginfo('name');?></title>
    <meta name="viewport" content="width=device-width" />
    <?php wp_head(); ?>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- for detecting screen break points -->
    <div class="visible-xs"></div><div class="visible-sm"></div><div class="visible-md"></div><div class="visible-lg"></div><div class="visible-xl"></div>
  </head>
  <body <?php body_class(); ?>>
    <!--[if lt IE 10]><p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->
    <div class="page-wrap">

      <header class="site-header">

        <a class="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>">
          <img src="<?php echo get_template_directory_uri() ?>/img/header-logo.png" alt="Site logo" />
          <div class="blog--name sr-only"><?php bloginfo( 'name' ); ?></div>
          <div class="blog-description sr-only"><?php bloginfo( 'description' ); ?></div>
        </a>

        <a href="#main-content" class="sr-only">Skip to main content</a>
        <button class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target="#primary-menu">
          <span class="glyphicon glyphicon-menu-hamburger"></span>
          Menu
        </button>

        <nav id="primary-menu" class="navbar navbar-collapse collapse" role="navigation">
<?php

  wp_nav_menu(
    array(
      'walker'          => new Bootstrap_Walker_Nav_Menu(),
      'container'       => 'div',
      'menu_class'      => 'nav navbar-nav',
      'container_class' => 'navbar-nav-container'
    )
  );

?>
            <div class="social-links">
<?php
          if ( isset( $TW_account_url ) && $TW_account_url != false ) : ?>
            <a href="<?php echo $TW_account_url; ?>">
              <i class="socicon socicon-twitter"></i>
              <span class="sr-only">Twitter Account</span>
            </a><?php
          endif;
          if ( isset( $FB_account_url ) && $FB_account_url != false ) : ?>
            <a href="<?php echo $FB_account_url; ?>">
              <i class="socicon socicon-facebook"></i>
              <span class="sr-only">Facebook Account</span>
            </a><?php
          endif;
          if ( isset( $LI_account_url ) && $LI_account_url != false ) : ?>
            <a href="<?php echo $LI_account_url; ?>">
              <i class="socicon socicon-linkedin"></i>
              <span class="sr-only">Linkedin Account</span>
            </a><?php
          endif;
?>
          </div>
        </nav>

      </header>
