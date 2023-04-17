<?php

if (! defined('ABSPATH')) {
    exit;
}
$ID = get_the_ID();
?>

<div id="container-page-article" class="container container-page-article">
    <div class="row">
        <?php
            get_template_part('template-parts/items/items', 'breadcrumb');
        ?>
    </div>
    <section class="row container-article-page container-article-page-<?= $ID ?>">
        <?php the_title('<h1 class="title-article-page">', '</h1>');
                the_content();
                $args = array(
                    array( 'category_name' => 'evenements,nouveau,news' ),

                );
                $query = new WP_Query($args);
                if ($query->have_posts()) :?>

        <div id="liste-articles-news" class="liste-articles-news">
            <?php while ($query->have_posts()) : $query-> the_post();
                    include('data/data-news.php');
                    if ($sticky) : ?>
            <article id="post-<?= $id ?>" class="d-flex row post-news post-news-sticky">
                <a class="d-flex row" href="<?= $link ?>" title="Voir l'article : <?= $title ?>">
                    <div class="col-12 col-md-5 d-flex flex-column justify-content-end entry-news-content">
                        <header class="news-header">
                            <h3 class="entry-news-cat"><?= $term_name ?></h3>
                            <h2 class="entry-news-title"><?= $title ?></h2>
                        </header>
                        <?php if (function_exists('the_excerpt_news')) {
                        the_excerpt_news(150);
                    }
                                    ?>
                        <time class="news-date d-flex" datetime="<?= $datetime ?>">Article publié le <?= $date ?></time>
                    </div>
                    <figure class="col-12 col-md-7 featured-sticky-news">
                        <?= $img ?>
                    </figure>
                </a>
                </a>
            </article>
            <?php else: ?>
            <div class="post-news-vignette">
                <li class="col-12 col-md-4 post-news item-news-vignette pt-4 pb-4">
                    <article id="post-<?= $id ?>">
                        <a href="<?= $link ?>" title="Voir l'article : <?= $title ?>">
                            <figure class="featured-sticky-news">
                                <?= $img ?>
                                <h3 class="entry-news-cat"><?= $term_name?></h3>
                            </figure>
                            <div class="entry-news-content d-flex flex-column align-items-center">
                                <header class="news-header">
                                    <time class="news-date" datetime="<?= $datetime ?>"><?= $date ?></time>
                                    <h2 class="entry-news-title"><?= $title ?></h2>
                                </header>
                                <?php if (function_exists('the_excerpt_news')) {
                                        the_excerpt_news(100);
                                    }
                                        ?>
                            </div>
                        </a>
                    </article>
                </li>
            </div>
            <?php endif;?>
            <?php endwhile;?>

        </div>
        <?php endif; wp_reset_query();?>
    </section>

</div>