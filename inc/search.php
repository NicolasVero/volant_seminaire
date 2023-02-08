<?php
function my_search_filter( $query )
{
    if ( $query->is_search )
    {
        $query->set( 'post_type', 'destinations' );
    }
    return $query;
}
add_filter('pre_get_posts','my_search_filter');
?>