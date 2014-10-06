<?php

add_action( 'after_setup_theme', 'bootstrap_setup' );

if ( ! function_exists( 'bootstrap_setup' ) ):

  function bootstrap_setup(){

    class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {


      function start_lvl( &$output, $depth ) {

        $indent = str_repeat( "\t", $depth );
        $output    .= "\n$indent<ul class=\"dropdown-menu\">\n";

      }

      function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $li_attributes = '';
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = ($args->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
        $classes[] = 'menu-item-' . $item->ID;


        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ($args->has_children)      ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= ($args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      }

      function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

        if ( !$element )
          return;

        $id_field = $this->db_fields['id'];

        //display this element
        if ( is_array( $args[0] ) )
          $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
        else if ( is_object( $args[0] ) )
          $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        $cb_args = array_merge( array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

          foreach( $children_elements[ $id ] as $child ){

            if ( !isset($newlevel) ) {
              $newlevel = true;
              //start the child delimiter
              $cb_args = array_merge( array(&$output, $depth), $args);
              call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
            }
            $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
          }
            unset( $children_elements[ $id ] );
        }

        if ( isset($newlevel) && $newlevel ){
          //end the child delimiter
          $cb_args = array_merge( array(&$output, $depth), $args);
          call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }

        //end this element
        $cb_args = array_merge( array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);

      }

    }

  }

endif;

add_action( 'after_setup_theme', 'comment_walker_setup' );

function comment_walker_setup () {

  class Custom_Walker_Comment extends Walker_Comment {

    // init classwide variables
    var $tree_type = 'comment';
    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;
        echo '<ul class="comment-list">';
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;
        echo '</ul>';
    }

    /** START_EL */
    function start_el( &$output, $comment, $depth, $args, $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;
        $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' );
        $reply_args = array(
          // 'add_below' => $add_below,
          'depth' => $depth,
          'max_depth' => $args['max_depth']
        ); ?>

        <li <?php comment_class( $parent_class ); ?> id="comment-<?php comment_ID() ?>">
          <div id="comment-body-<?php comment_ID() ?>" class="comment-body">
            <div class="comment-avatar">
              <?php echo ( $args['avatar_size'] != 0 ? get_avatar( $comment, $args['avatar_size'] ) :'' ); ?>
            </div>
            <div id="comment-content-<?php comment_ID(); ?>" class="comment-content">
              <cite class="comment-author"><?php echo get_comment_author_link(); ?></cite>
              <div class="comment-timestamp"><?php comment_date(); ?> at <?php comment_time(); ?></div>
              <div class="comment-message"><?php comment_text(); ?></div>
              <?php edit_comment_link('(Edit)'); ?>
              <div class="comment-reply">
                <?php comment_reply_link( array_merge( $args, $reply_args ) ); ?>
              </div>
            </div>
          </div>

    <?php }

    function end_el(&$output, $comment, $depth = 0, $args = array() ) {
        echo '</li><!-- /#comment-' . get_comment_ID() . ' -->';
    }

  }
}