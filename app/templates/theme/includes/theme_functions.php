<?php

function disable_auto_paragraphs($content) {
  if ( strpos($content,'<!--DISABLE AUTO PARAGRAPHS-->') !== false ) {
    remove_filter ('the_content','wpautop');
  } else {
    remove_filter ('the_content','wpautop');
    add_filter ('the_content','wpautop');
  }
  return $content;
}
add_filter('the_content','disable_auto_paragraphs',1);

if ( ! function_exists('the_theme_img_dir') ) :
  function the_theme_img_dir() {
    echo get_template_directory_uri() . "/img";
  }
endif;

if ( ! function_exists('get_the_theme_img_dir') ) :
  function get_the_theme_img_dir() {
    return get_template_directory_uri() . "/img";
  }
endif;
