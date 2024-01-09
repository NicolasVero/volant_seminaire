<?php
function my_search_filter( $query )
{
    if ( $query->is_search )
    {
        $query->set( 'post_type', 'activites' );
    }
    return $query;
}
add_filter('pre_get_posts','my_search_filter');
?>