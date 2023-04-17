<?php

    $slides = get_field('articles');

    $className = 'slider-home';

    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }

    if ($slides) {
        ?>

<div class="container-slider-home col-12 col-lg-7">
    <ul class="<?= $className ?>">

        <?php foreach ($slides as $slide) {
            setup_postdata($slide);


            $id = $slide->ID;
            $slide_title = $slide->post_title;
            $size='full';
            $slide_image = get_the_post_thumbnail_url($id, $size);
            $slide_alt = get_post_meta($slide_image->ID, '_wp_attachment_image_alt', true);
            $slide_permalink =  get_the_permalink($id);

            $tax_terms = get_the_category($id);

            foreach ($tax_terms as $term) {
                $term_name = $term->name;
            }
            // var_dump($term_name);

            ?>
        <li class="slide">
            <article class="articles-slides-home article-<?= $id ?>">
                <a class="d-block" href="<?= $slide_permalink ?>" title='lire l\' article :"<?= $slide_title ?>"'>
                    <img src="<?= $slide_image ?>" alt="<?= $slide_alt ?>" />
                    <div class="container-title-article-slide d-flex flex-column flex-md-row justify-content-center align-items-center">
                        <header class="title-article">
                            <h3><?= $term_name ?></h3>
                            <h2><?= $slide_title ?></h2>
                        </header>
                        <button class="icon-fleche ti-arrow-right"></button>
                    </div>
                </a>
            </article>
        </li>



        <?php
        } ?>

    </ul>
</div>



<?php
        wp_reset_postdata();
    }
