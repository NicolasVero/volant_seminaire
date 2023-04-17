<?php
	function pagination() {
        global $wp_query, $wp_rewrite;
        
        // Variables
        $pages = '';
        $max = $wp_query->max_num_pages;
        if (!$num_courant = get_query_var('paged')) $num_courant = 1;
        $total = 1;
        
        //Alimentation du tableau d'arguments
        $args['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
        $args['total'] = $max;
        $args['current'] = $num_courant;
        $args['mid_size'] = 5;
        $args['end_size'] = 1;
        $args['prev_text'] = '<i class="ti-arrow-left"></i>';
        $args['next_text'] = '<i class="ti-arrow-right"></i>';
        
        // Ecriture de la pagination
        if ($max > 1) echo '<div class="paginate col-12 d-flex justify-content-center">';
        // if ($total == 1 && $max > 1) $pages = 'Page ' . $num_courant . ' sur ' . $max;
        echo paginate_links($args); // Appel de la fonction native
        if ($max > 1) echo '</div>';
        
        }