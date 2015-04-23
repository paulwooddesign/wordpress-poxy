<?php

//////////////////////////////////////////////////////////////
// Theme Header
/////////////////////////////////////////////////////////////
  
add_action('wp_head','poxy_theme_head');

function poxy_theme_head() { 
global $post;
  ?>
<meta name="generator" content="<?php global $poxy_theme, $poxy_version; echo $poxy_theme.' '.$poxy_version; ?>" />

<style type="text/css" media="screen">
<?php $full_width_spacers_enabled = of_get_option('poxy_full_width_spacers_enabled'); ?>
<?php if($full_width_spacers_enabled == true) : ?>
section:before, section:after{width:100% !important;}
<?php endif; ?>


<?php $poxy_dev_styles = of_get_option('poxy_option_styles'); ?>
<?php if($poxy_dev_styles == false) : ?>


<?php $menu_font = of_get_option('poxy_menu_font'); ?>
<?php $heading_font_weight = of_get_option('poxy_heading_weight'); ?>

<?php $sub_heading_font = of_get_option('poxy_sub_heading_font'); ?>
<?php $slideshow_heading_font = of_get_option('poxy_slideshow_heading_font'); ?>
<?php $slideshow_description_font = of_get_option('poxy_slideshow_description_font'); ?>

<?php $body_font = of_get_option('poxy_body_font'); ?>
<?php $paragraph_line_height = of_get_option('poxy_paragraph_line_height'); ?>
<?php $paragraph_letter_spacing = of_get_option('poxy_paragraph_letter_spacing'); ?>

<?php $heading_font = of_get_option('poxy_heading_font'); ?>
<?php $heading_line_height = of_get_option('poxy_heading_line_height'); ?>
<?php $heading_letter_spacing = of_get_option('poxy_heading_letter_spacing'); ?>


<?php if ($menu_font) : ?>
  .main-nav a{ font-family: '<?php echo $menu_font; ?>'; }
<?php endif; ?>


<?php // Heading Styles //////////// ?>
<?php if ($heading_font) : ?>
  h1, h2, h3, h4, h5, h6, .homeSection h3, #page-head h1 { font-family: '<?php echo $heading_font; ?>' !important; font-weight: <?php echo $heading_font_weight; ?> !important; }
<?php endif; ?>

<?php if ($heading_line_height) : ?>
  h1, h2, h3, h4, h5, h6{line-height:<?php echo $heading_line_height; ?>em;}
<?php endif; ?>

<?php if ($heading_letter_spacing) : ?>
  h1, h2, h3, h4, h5, h6{ letter-spacing:<?php echo $heading_letter_spacing; ?>em;}
<?php endif; ?>


<?php if ($sub_heading_font) : ?>
  .sectionHead p{ font-family: '<?php echo $sub_heading_font; ?>'; }
<?php endif; ?>
<?php if ($body_font) : ?>
  body { font-family: '<?php echo $body_font; ?>' !important; }  
<?php endif; ?>



<?php // ODD / EVEN //////////// ?>
<?php if(!of_get_option('poxy_enable_meat_odd_even_background_colors')) : ?>
#meat section:nth-child(odd), #meat section:nth-child(even){background-color:transparent !important;}
<?php endif; ?>

<?php if(!of_get_option('poxy_enable_header_odd_even_background_colors')) : ?>
<?php //header section:nth-child(odd), header section:nth-child(even), .main-nav .front:before {background-color:transparent !important;} ?>
<?php endif; ?>

<?php if(!of_get_option('poxy_enable_footer_odd_even_background_colors')) : ?>
footer section:nth-child(odd), footer section:nth-child(even){background-color:transparent !important;}
<?php endif; ?>



<?php // Paragraph Styles ////////// ?>
<?php if ($paragraph_line_height) : ?>
.custom-bullets li, p{line-height:<?php echo $paragraph_line_height; ?>em;}
<?php endif; ?>

<?php if ($paragraph_letter_spacing) : ?>
.custom-bullets li, p{letter-spacing:<?php echo $paragraph_letter_spacing; ?>em;}
<?php endif; ?>

<?php if ($slideshow_heading_font) : ?>
  .home .slideshow h2 { font-family: '<?php echo $slideshow_heading_font; ?>' !important; }
<?php endif; ?>
<?php if ($slideshow_description_font) : ?>
  .home .slideshow p { font-family: '<?php echo $slideshow_description_font; ?>'; }
<?php endif; ?>





<?php if(of_get_option('poxy_toggle_closed')) : ?>

.accordion > li > .trigger:before {
background-image: url( <?php echo(of_get_option('poxy_toggle_closed')); ?> );
-moz-background-size: contain;
-o-background-size: contain;
-webkit-background-size: contain;
background-size: contain;
}

<?php endif; ?>

<?php if(of_get_option('poxy_toggle_open')) : ?>
.accordion > li.expanded > .trigger:hover:before,
.no-js .accordion > li > .trigger:before,
.accordion > li.cbp-ntopen > .trigger:before,
.accordion > li.expanded > .trigger:before, 
.accordion > li > .trigger:hover:before,
.cbp-ntsubaccordion > li.cbp-ntopen > .trigger:before,
.no-js .cbp-ntsubaccordion > li > .trigger:before {
background-image: url(<?php echo(of_get_option('poxy_toggle_open')); ?>);
-moz-background-size: contain;
-o-background-size: contain;
-webkit-background-size: contain;
background-size: contain;
}
<?php endif; ?>

<?php if(of_get_option('poxy_slideshow_left_arrow')) : ?>
#home-banner .flex-direction-nav li a.flex-prev {
  background-image: url(<?php echo(of_get_option('poxy_slideshow_left_arrow')); ?>);
}
<?php endif; ?>

<?php if(of_get_option('poxy_slideshow_right_arrow')) : ?>
#home-banner .flex-direction-nav li a.flex-next {
  background-image: url(<?php echo(of_get_option('poxy_slideshow_right_arrow')); ?>);
}
<?php endif; ?>

<?php if(of_get_option('poxy_slideshow_left_arrow')) : ?>
#home-banner .flex-direction-nav li a.flex-prev {
  background-image: url(<?php echo(of_get_option('poxy_slideshow_left_arrow')); ?>);
}
<?php endif; ?>

<?php if(of_get_option('poxy_main_nav_color')) : ?>
#main-nav a, .block-menu .front, #top-nav-bar li a {
    color: <?php echo(of_get_option('poxy_main_nav_color')); ?>;
}
<?php endif; ?>

<?php if(of_get_option('poxy_header_menu_background_hover')) : ?>
.main-nav > ul > li:hover .front,
.main-nav > ul > li.active .front,
#top-bar .social-icons li a:hover {
    background-color: <?php echo(of_get_option('poxy_header_menu_background_hover')); ?>;
}
<?php endif; ?>


<?php if(of_get_option('poxy_color_link')) : ?>
#meat a {
    color: <?php echo(of_get_option('poxy_color_link')); ?>;
}
<?php endif; ?>


<?php if(of_get_option('poxy_color_link_hover')) : ?>
#meat a:hover {
    color: <?php echo(of_get_option('poxy_color_link_hover')); ?>;
}
<?php endif; ?>


<?php //*/ ?>
<?php if(of_get_option('poxy_background_body')) : ?>
  body, footer, #wrapper {
    background-color: <?php echo(of_get_option('poxy_background_body')); ?>;
  }
<?php endif; ?>
<?php //*/ ?>

<?php if(of_get_option('poxy_background_meat')) : ?>
#meat {
    background-color: <?php echo(of_get_option('poxy_background_meat')); ?>;
  }
<?php endif; ?>

<?php if(of_get_option('poxy_even_section_background_color')) : ?>
#meat section:nth-child(even) {
    background-color: <?php echo(of_get_option('poxy_even_section_background_color')); ?>;
  }
<?php endif; ?>

<?php if(of_get_option('poxy_odd_section_background_color')) : ?>
#meat section:nth-child(odd) {
    background-color: <?php echo(of_get_option('poxy_odd_section_background_color')); ?>;
  }
<?php endif; ?>

<?php if(of_get_option('poxy_header_background_image')) : ?>
header, header .block-menu .front {
    background-image: url(<?php echo(of_get_option('poxy_header_background_image')); ?>);
    background-repeat:<?php echo(of_get_option('poxy_header_background_repeat')); ?>;
    background-position: <?php echo(of_get_option('poxy_header_background_x_position')); ?> <?php echo(of_get_option('poxy_footer_background_y_position')); ?> ;
  }
<?php endif; ?>

<?php if(of_get_option('poxy_meat_background_image')) : ?>
#meat {
    background-image: url(<?php echo(of_get_option('poxy_meat_background_image')); ?>);
    background-repeat:<?php echo(of_get_option('poxy_meat_background_repeat')); ?>;
    background-position: <?php echo(of_get_option('poxy_meat_background_x_position')); ?> <?php echo(of_get_option('poxy_footer_background_y_position')); ?> ;
  }
<?php endif; ?>

<?php if(of_get_option('poxy_footer_background_image')) : ?>
footer {

    background-image: url(<?php echo(of_get_option('poxy_footer_background_image')); ?>);
    background-repeat:<?php echo(of_get_option('poxy_footer_background_repeat')); ?>;
    background-position: <?php echo(of_get_option('poxy_footer_background_x_position')); ?> <?php echo(of_get_option('poxy_footer_background_y_position')); ?> ;
  }
<?php endif; ?>



<?php if(of_get_option('poxy_color_body')) : ?>
/*p, .custom-bullets li, .nutrition-facts*/
body, .accordion h3, #meat  {
    color: <?php echo(of_get_option('poxy_color_body')); ?> !important;
}
<?php endif; ?>

<?php if(of_get_option('poxy_color_pagehead')) : ?>
#page-head h1, #page-head h1 span  {
    color: <?php echo(of_get_option('poxy_color_pagehead')); ?>;
}
<?php endif; ?>

<?php if(of_get_option('poxy_color_heading')) : ?>
#meat h1, #meat h2, #meat h3, #meat h4, #meat h5,  #meat h6, #meat article.post h1 a   {
    color: <?php echo(of_get_option('poxy_color_heading')); ?>;
}
<?php endif; ?>

<?php // Header ////////// ?>
<?php if(of_get_option('poxy_color_header')) : ?>
  #header, #scroller, .block-menu .front{
    background-color: <?php echo(of_get_option('poxy_color_header')); ?>;
  }
  #mainNav ul ul {
    background-color: <?php echo(of_get_option('poxy_color_header')); ?>;
  }
<?php endif; ?>

<?php if(of_get_option('poxy_header_sub_menu_background_color')) : ?>
  header .main-nav .sub-menu, .block-menu .back{
    background-color: <?php echo(of_get_option('poxy_header_sub_menu_background_color')); ?>;
  }
<?php endif; ?>


<?php if(of_get_option('poxy_header_sub_menu_color')) : ?>
  header .main-nav .sub-menu a, .block-menu .back{
    color: <?php echo(of_get_option('poxy_header_sub_menu_color')); ?>;
  }
<?php endif; ?>


<?php if(of_get_option('poxy_background_copywrite')) : ?>
body, #copywrite {
    background-color: <?php echo(of_get_option('poxy_background_copywrite')); ?>;
  }
<?php endif; ?>

<?php if(of_get_option('poxy_color_accent')) : ?>
  .accent-color, blockquote:before, .accordion > li > .trigger:before, .cbp-ntsubaccordion > li > .trigger:before  {
    color: <?php echo(of_get_option('poxy_color_accent')); ?> !important;
  } 

  .accent-bg, .custom-bullets ul li:before{
    background-color: <?php echo(of_get_option('poxy_color_accent')); ?> !important;
  } 

.has-line:after, .overlay, #scroll-top:hover,  .mp-level,
.ac_over, .post-edit-link
{
    background-color: <?php echo(of_get_option('poxy_color_accent')); ?> !important;
  }
  
<?php endif; ?>


<?php // Spacers ////////// ?>

<?php if(of_get_option('poxy_line_spacer_background_image')) : ?>
.line_spacer, header section:before, #meat section:before, footer section:before, .block-menu li > a:before, .block-menu:after, .menu-footer li a:before {
    background-image: url( <?php echo(of_get_option('poxy_line_spacer_background_image')); ?> ) !important;
}
<?php endif; ?>

<?php if(of_get_option('poxy_line_spacer_top_border_color')) : ?>
.line_spacer {
    border-top: 1px solid <?php echo(of_get_option('poxy_line_spacer_top_border_color')); ?>;
}
<?php endif; ?>



<?php if(of_get_option('poxy_meat_divider_height')) : ?>
#meat section:before {
    height: <?php echo(of_get_option('poxy_meat_divider_height')); ?>;
}
<?php endif; ?>


<?php if(of_get_option('poxy_line_spacer_bottom_border_color')) : ?>
.line_spacer, #meat section:before  {
   background-color: <?php echo(of_get_option('poxy_line_spacer_bottom_border_color')); ?> !important;
}

 .accordion h3{
    border-color: <?php echo(of_get_option('poxy_line_spacer_bottom_border_color')); ?> !important;
  }
<?php endif; ?>


<?php if(of_get_option('poxy_line_spacer_header_border_color')) : ?>
header section:before, .block-menu:before,  .block-menu li > a:before, .block-menu:after, #meat section:nth-child(1):before, .sub-menu:after, .social-icons li > a:before, .ajax_autosuggest_form_wrapper:before{
    background-color: <?php echo(of_get_option('poxy_line_spacer_header_border_color')); ?> !important;
  }
  .ajax_autosuggest_suggestions{
    border-color: <?php echo(of_get_option('poxy_line_spacer_header_border_color')); ?> !important;
  }
<?php endif; ?>


<?php if(of_get_option('poxy_line_spacer_footer_border_color')) : ?>
footer section:before, .menu-footer li a:before {
    background-color: <?php echo(of_get_option('poxy_line_spacer_footer_border_color')); ?> !important;
  }
#small-footer-nav .social-icons li a{
  border-color: <?php echo(of_get_option('poxy_line_spacer_footer_border_color')); ?> !important;
}
<?php endif; ?>



<?php if (of_get_option('poxy_google_map_height')) : ?>
  #googleMap {height: <?php echo of_get_option('poxy_google_map_height');?>px;}
<?php endif; ?>

<?php if(of_get_option('poxy_color_link')) : ?>a { color: <?php echo(of_get_option('poxy_color_link')); ?>;}<?php endif; ?>
<?php if(of_get_option('poxy_color_link')) : ?>section button { background-color: <?php echo(of_get_option('poxy_color_link')); ?>;}<?php endif; ?>


<?php if(of_get_option('poxy_color_link_hover')) : ?>a:hover {color: <?php echo(of_get_option('poxy_color_link_hover')); ?>;}<?php endif; ?>

<?php if(of_get_option('poxy_color_btn')) : ?>.button, #searchsubmit, input[type="submit"] {background-color: <?php echo(of_get_option('poxy_color_btn')); ?> !important;}<?php endif; ?>

<?php if ( is_archive() ): ?> html {height: 101%;} <?php endif; ?>

<?php echo(of_get_option('poxy_custom_css')); ?>

<?php if(of_get_option('poxy_section_overlay')) : ?>
.color-overlay {
    <?php echo(of_get_option('poxy_section_overlay')); ?>
  }
<?php endif; ?>



<?php endif; // End Dev Boolean ?>

</style>

<!--[if IE 7]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie7.css" type="text/css" media="screen" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie8.css" type="text/css" media="screen" />
<![endif]-->
<!--[if IE]>
<script  type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie.css" type="text/css" media="screen" />
<![endif]-->

<?php echo "\n".of_get_option('poxy_analytics')."\n"; ?>

<?php }

add_action('init', 'remheadlink');
function remheadlink() {
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
}

?>