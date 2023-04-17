<?php

$event = get_field('event');

$className = 'event-home';

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

    if ($event) {
        $id = $event->ID;
        $event_title = $event->post_title;
        $event_excerpt = $event->post_excerpt;
        $event_date = get_the_date();
        $size='full';
        $event_image = get_the_post_thumbnail_url($id, $size);
        $event_alt = get_post_meta($event_image->ID, '_wp_attachment_image_alt', true);
        $event_permalink =  get_the_permalink($id);
        $tax_term = get_the_category($id);
        foreach ($tax_term as $term) {
            $term_name = $term->name;
        }
        // var_dump($id);
        // var_dump($event);
        // var_dump($term_name);
?>
<div class="container container-event-home col-12 col-lg-5">
    <h3><?= $term_name ?></h3>
    <article class="article-event-home article-<?= $id ?>">
        <a href="<?= $event_permalink ?>" title="lire l'article :\" <?= $event_title ?>"">
            <div class="container-article-image-title">
                <img src="<?= $event_image ?>" alt="<?= $event_alt ?>" />
                <header class="header-article container d-flex flex-column justify-content-center align-items-center">
                    <aside><?= $event_date ?></aside>
                    <h2><?= $event_title ?></h2>
                    <button>En savoir plus<i class="icon-fleche ti-arrow-right"></i></button>
                </header>
            </div>
            <p><?= $event_excerpt ?><span class="d-block d-flex justify-content-center icon-article-more">[…]</span></p>
        </a>
    </article>
</div>

<?php
    } ?>