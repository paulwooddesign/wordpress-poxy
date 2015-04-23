<?php
//////////////////////////////////////////////////////////////
// Page Redirects
/////////////////////////////////////////////////////////////

//http://wordpress.stackexchange.com/questions/45164/prevent-access-to-single-post-types
add_action( 'template_redirect', 'w45_redirect_service' );
function w45_redirect_service()
{
    is_singular( 'package' )
    and wp_redirect( home_url( '/packages/' ), 301 )
    and exit;

    // is_singular( 'award' )
    // and wp_redirect( home_url( '/awards/' ), 301 )
    // and exit;
}
?>