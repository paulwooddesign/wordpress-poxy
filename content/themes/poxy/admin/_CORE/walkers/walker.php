<?php
/////////////////////////////////
// Navigation Menus
// -Add Menus for the backed-
////////////////////////////////
////////////////////////////////////
// Mobile Menu
////////////////////////////////////

class poxy_mobile_menu_walker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
      $GLOBALS['dd_children'] = ( isset($children_elements[$element->ID]) )? 1:0;
        $GLOBALS['dd_depth'] = (int) $depth;
        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] )) {
            $args[0]->has_children = !empty( $children_elements[$element->$id_field] );
        }

        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

        function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
        if ( $args->has_children & $depth == 0) {
          $item->classes[] = 'has_children';
        } 

        if($depth != 1) {
        parent::start_el($output, $item, $depth, $args);
        }
        
        if($depth == 1){
        $prepend = '<h4>';
        $append = '</h4>';
        $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

        
        $description = $append = $prepend = "";
        
        $item_output = $args->before;
        $item_output .= '<li>';
        $item_output .= '<a href="' . esc_attr( $item->url ) . '">';
        //$item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
        $item_output .= $description.$args->link_after;
        $item_output .= '</a>';
        
        $item_output .= $args->after;
        //$item_output .= '<div class="mp-level"><h2>'.apply_filters( 'the_title', $item->title, $item->ID ).'</h2>';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      }

    }

    function start_lvl(&$output, $depth = 0, $args = array()) {
      $indent = str_repeat("\t", $depth);
      if($depth == 0){
        //$output .= "\n$indent<div class='mp-level'><h2 class=''>menu</h2><a class='mp-back' href='#'>back</a>\n$indent<ul>\n";
        $output .= "\n$indent<div class='mp-level'><a class='mp-back' href='#'>back</a>\n$indent<ul>\n";
      }

      if($depth == 1){
        //$output .= "\n$indent<div class='mp-level'><h2 class=''>Menu</h2><a class='mp-back' href='#'>back</a>\n$indent<ul class=\"level-".$depth."\">\n";
        $output .= "\n$indent<div class='mp-level'><a class='mp-back' href='#'>back</a>\n$indent<ul class=\"level-".$depth."\">\n";
      }

      if($depth == 2){
        $output .= "\n$indent<div class='mp-level'><a class='mp-back' href='#'>back</a>\n$indent<ul class=\"level-".$depth."\">\n";
      }

    }

    function end_lvl(&$output, $depth = 0, $args = array()){
      $indent = str_repeat("\t", $depth);
      if($depth == 0){
        $output .= "$indent</ul>\n$indent</div>\n";
      }

      if($depth == 1){
        $output .= "$indent</ul>\n";
      }
    }

}//End


////////////////////////////////////
// HDD
////////////////////////////////////

class poxy_hdd_menu_walker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
      $GLOBALS['dd_children'] = ( isset($children_elements[$element->ID]) )? 1:0;
        $GLOBALS['dd_depth'] = (int) $depth;
        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] )) {
            $args[0]->has_children = !empty( $children_elements[$element->$id_field] );
        }

        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

        function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {

          if ( $args->has_children & $depth == 0) {
            $item->classes[] = 'has_children';
          } 

          if($depth != 1) {
            parent::start_el($output, $item, $depth, $args);
          }
          
          if($depth == 1){
            $prepend = '<h4>';
            $append = '</h4>';
            $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

            
            $description = $append = $prepend = "";
            
            $item_output = $args->before;
            $item_output .= '<li><h4 class="delta"><a href="'.$item->url.'">';
            //$item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a></h4>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }

      }

    function start_lvl(&$output, $depth = 0, $args = array()) {
      $indent = str_repeat("\t", $depth);
      if($depth == 0){
        $output .= "\n$indent<div class='sub-menu'><div class='copy-width'>\n$indent<ul class='sub-inside POX__ A_5_15-15 B_3_13-13 G_3_13-13'>\n";
      }

      if($depth == 1){
        $output .= "\n$indent<ul class=\"level-".$depth."\">\n";
      }

      if($depth == 2){
        //$output .= "\n$indent<li>\n";
      }

    }

    function end_lvl(&$output, $depth = 0, $args = array()){
      $indent = str_repeat("\t", $depth);
      if($depth == 0){
        $output .= "$indent</ul></div>\n$indent</div>\n";
      }

      if($depth == 1){
        $output .= "$indent</ul>\n";
      }
    }

}//End




////////////////////////////////////
// 3D Menu
////////////////////////////////////

class poxy_block_menu_walker extends Walker_Nav_Menu {
     function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
      $GLOBALS['dd_children'] = ( isset($children_elements[$element->ID]) )? 1:0;
        $GLOBALS['dd_depth'] = (int) $depth;
        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] )) {
            $args[0]->has_children = !empty( $children_elements[$element->$id_field] );
        }

        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

        function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
          global $wp_query;

          // Code to get children count 
          $locations = get_nav_menu_locations();
          $menu = wp_get_nav_menu_object( $locations['main'] );
          $menu_items = wp_get_nav_menu_items($menu->term_id);
          $count = 0;
          foreach( $menu_items as $menu_item ){
              if( $menu_item->menu_item_parent == $item->ID ){
                  $count++;           
              }       
          }

          if ( $args->has_children & $depth == 0) {
            $item->classes[] = 'has_children';
          } 

          if($depth != 1) {
            parent::start_el($output, $item, $depth, $args);
          }
          
          if($depth == 1){
            $prepend = '<h4>';
            $append = '</h4>';
            $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

            
            $description = $append = $prepend = "";
            
            $item_output = $args->before;
            //$item_output .= '<li><h4 class="epsilon"><a href="'.$item->url.'">';
            $item_output .= '<li class="txt-c" style="width:19.2%; float:none; vertical-align: top; display:inline-block;"><h4 class="epsilon"><a href="'.$item->url.'">';
            //$item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a></h4>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }

      }

    function start_lvl(&$output, $depth = 0, $args = array()) {
      $indent = str_repeat("\t", $depth);
      if($depth == 0){
        //$output .= "\n$indent<div class='sub-menu'><div class='copy-width'>\n$indent<ul class='sub-inside POX__ A_6_16-14 B_4_14-14 G_3_13-13' >\n";
        $output .= "\n$indent<div class='sub-menu'><div class='copy-width'>\n$indent<ul style='margin:0 auto; width:100%; display:block; text-align:center;' class='sub-inside'>\n";
      }

      if($depth == 1){
        $output .= "\n$indent<ul class=\"level-".$depth."\">\n";
      }

      if($depth == 2){
        //$output .= "\n$indent<li>\n";
      }

    }

    function end_lvl(&$output, $depth = 0, $args = array()){
      $indent = str_repeat("\t", $depth);
      if($depth == 0){
        $output .= "$indent</ul></div>\n$indent</div>\n";
      }

      if($depth == 1){
        $output .= "$indent</ul>\n";
      }
    }

}//End


////////////////////////////////////
// Add Span Inside top level li tag
////////////////////////////////////
add_filter( 'walker_nav_menu_start_el', 'wpse_add_arrow', 10, 4);
function wpse_add_arrow( $item_output, $item, $depth, $args ){
    //Only add class to 'top level' items on the 'primary' menu.
    if('main' == $args->theme_location && $depth ==0){
        $item_output ='<a href="'.$item->url.'" class="three-d">'.$item->title.'<span class="three-d-box"><span class="front">'.$item->title.'</span><span class="back">'.$item->title.'</span></span></a>';
    }
    return $item_output;
}





////////////////////////////////////
// 3D Menu
////////////////////////////////////

class poxy_block_menu_small_walker extends Walker_Nav_Menu {
     function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
      $GLOBALS['dd_children'] = ( isset($children_elements[$element->ID]) )? 1:0;
        $GLOBALS['dd_depth'] = (int) $depth;
        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] )) {
            $args[0]->has_children = !empty( $children_elements[$element->$id_field] );
        }

        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

        function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
          global $wp_query;

          // Code to get children count 
          $locations = get_nav_menu_locations();
          $menu = wp_get_nav_menu_object( $locations['main'] );
          $menu_items = wp_get_nav_menu_items($menu->term_id);
          $count = 0;
          foreach( $menu_items as $menu_item ){
              if( $menu_item->menu_item_parent == $item->ID ){
                  $count++;           
              }       
          }

          if ( $args->has_children & $depth == 0) {
            $item->classes[] = 'has_children';
          } 

          if($depth != 1) {
            parent::start_el($output, $item, $depth, $args);
          }
          
          if($depth == 1){
            $prepend = '<h4>';
            $append = '</h4>';
            $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

            
            $description = $append = $prepend = "";
            
            $item_output = $args->before;
            //$item_output .= '<li><h4 class="epsilon"><a href="'.$item->url.'">';
            $item_output .= '<li class="txt-c" style="width:19.2%; float:none; vertical-align: top; display:inline-block;"><h4 class="epsilon"><a href="'.$item->url.'">';
            //$item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a></h4>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }

      }

    function start_lvl(&$output, $depth = 0, $args = array()) {
      $indent = str_repeat("\t", $depth);
      if($depth == 0){
        //$output .= "\n$indent<div class='sub-menu'><div class='copy-width'>\n$indent<ul class='sub-inside POX__ A_6_16-14 B_4_14-14 G_3_13-13' >\n";
        $output .= "\n$indent<div class='sub-menu'><div class='copy-width'>\n$indent<ul style='margin:0 auto; width:100%; display:block; text-align:center;' class='sub-inside'>\n";
      }

      if($depth == 1){
        $output .= "\n$indent<ul class=\"level-".$depth."\">\n";
      }

      if($depth == 2){
        //$output .= "\n$indent<li>\n";
      }

    }

    function end_lvl(&$output, $depth = 0, $args = array()){
      $indent = str_repeat("\t", $depth);
      if($depth == 0){
        $output .= "$indent</ul></div>\n$indent</div>\n";
      }

      if($depth == 1){
        $output .= "$indent</ul>\n";
      }
    }

}//End

////////////////////////////////////
// Add Span Inside top level li tag
////////////////////////////////////
add_filter( 'walker_nav_menu_start_el', 'wpse_add_boxes', 10, 4);
function wpse_add_boxes( $item_output, $item, $depth, $args ){
    //Only add class to 'top level' items on the 'primary' menu.
    if('main_small' == $args->theme_location && $depth ==0){
        $item_output ='<a href="'.$item->url.'" class="three-d">'.$item->title.'<span class="three-d-box"><span class="front">'.$item->title.'</span><span class="back">'.$item->title.'</span></span></a>';
    }
    return $item_output;
}
?>
