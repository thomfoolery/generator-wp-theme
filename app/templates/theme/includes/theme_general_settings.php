<?php

class new_general_setting {
  function new_general_setting() {
     add_filter('admin_init', array( &$this, 'register_facebook'));
     add_filter('admin_init', array( &$this, 'register_twitter'));
  }
  function register_twitter() {
    register_setting('general', 'twitter_account', 'esc_attr');
    add_settings_field('link_account', '<label for="twitter_account">'.__('Twitter Account', 'twitter_account' ).'</label>', array(&$this, 'fields_twitter'), 'general');
  }
  function register_facebook() {
      register_setting('general', 'facebook_account', 'esc_attr');
      add_settings_field('fb_account', '<label for="facebook_account">'.__('Facebook Account', 'facebook_account' ).'</label>', array(&$this, 'fields_facebook'), 'general' );
  }
  function fields_twitter() {
      $value = get_option('twitter_account', '');
      echo '<input type="text" id="twitter_account" name="twitter_account" value="' . $value . '" />';
  }
  function fields_facebook() {
      $value = get_option('facebook_account', '');
      echo '<input type="text" id="facebook_account" name="facebook_account" value="' . $value . '" />';
  }
}
$new_general_setting = new new_general_setting();
