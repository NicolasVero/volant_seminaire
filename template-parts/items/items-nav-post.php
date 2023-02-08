<?php if (have_posts()) : while (have_posts()) : the_post();
$next_post = get_next_post();
$previous_post = get_previous_post();
the_post_navigation(
array(
'next_text' => '<div class="meta-nav d-flex justify-content-center align-items-center" aria-hidden="true">
				<i class="ti-arrow-right"><span class="d-block">' . __('Next', 'twentysixteen') . '</span></i>
				</div>
				<div class="featured-nav d-none d-lg-block">
				<figure class="vignette-nav">'. get_the_post_thumbnail($next_post->ID, 'thumbnail') . '</figure>
				<span class="post-title">%title</span></div>',
'prev_text' => ' <div class="featured-nav d-none d-lg-block">
				<figure class="vignette-nav">'. get_the_post_thumbnail($previous_post->ID, 'thumbnail') . '</figure><span class="post-title">%title</span></div>   
				<div class="meta-nav d-flex justify-content-center align-items-center" aria-hidden="true"><i class="ti-arrow-left"><span>' . __('Previous', 'twentysixteen') . '</span></i></div>',
'screen_reader_text' => '',
)
);
endwhile; endif;?>