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
          <img src="<?php echo get_template_directory_uri() ?>/img/header-logo.png" alt="Site logo" />
          <div class="blog--name sr-only"><?php bloginfo( 'name' ); ?></div>
          <div class="blog-description sr-only"><?php bloginfo( 'description' ); ?></div>
        </a>

        <nav class="navbar" role="navigation">
          <a href="#main-content" class="sr-only">Skip to main content</a>
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
      'container'       => 'div',
      'menu_class'      => 'nav navbar-nav',
      'container_id'    => 'primary-menu',
      'container_class' => 'navbar-collapse collapse'
    )
  );
?>
        </nav>


      </header>
