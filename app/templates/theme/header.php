<?php
/**
 * <%= themeName %> template for displaying the header
 *
 * @package WordPress
 * @subpackage <%= themeName %>
 * @since <%= themeName %> 1.0
 */
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="ie ie-no-support" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title( ); ?></title>
    <meta name="viewport" content="width=device-width" />
    <!--[if lt IE 9]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <!--[if lt IE 10]><p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->
    <div class="page-wrap">

      <header class="site-header">

        <a class="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>">
<?php if ( '' != get_custom_header()->url ) : ?>
          <img src="<?php header_image(); ?>" class="custom-header" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="Site logo" />
<?php else; ?>
          <h1 class="blog-name"><?php bloginfo( 'name' ); ?></h1>
<?php endif; ?>
          <div class="blog-description sr-only"><?php bloginfo( 'description' ); ?></div>
        </a>

        <nav class="navbar" role="navigation">
          <button class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target="#primary-menu">
            Menu
            <div class="icon">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </div>
          </button>
<?php
  wp_nav_menu(
    array(
      'walker'          => new Bootstrap_Walker_Nav_Menu(),
      'menu'            => 'primary-menu',
      'container'       => 'div',
      'menu_class'      => 'nav navbar-nav',
      'container_id'    => 'primary-menu',
      'container_class' => 'navbar-collapse collapse F-sans-pro'
    )
  );
?>
        </nav>


      </header>