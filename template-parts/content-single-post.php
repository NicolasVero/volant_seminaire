<?php
if (! defined('ABSPATH')) {
    exit;
}

$url = get_bloginfo('stylesheet_directory');

include('data/data-news.php');

    if (!empty($url_imgStar)):
?>
<figure id="star-tax-single" class="star-tax star-tax-single star-tax-<?= $id ?>" data-img="<?= $url_imgStar ?>"><?= $imgStar ?>
    <div id="bg-star-tax-single" class="bg-star-tax-single"></div>
</figure>
<?php endif;?>

<div id="container-page-single-post" class="container container-page-single-post container-page-single-post-<?= $ID ?>">

    <?php include('items/items-breadcrumb.php');?>
    <div class="content-news container">
        <figure class="single-feature row"><?= $imgNews ?></figure>
        <time class="news-date" datetime="<?= $datetime ?>">Article publié le <?= $date ?></time>
        <h3 class="entry-news-cat"><?= $term_name ?></h3>
        <h1 class="entry-news-title"><?= $title ?></h1>
        <?php the_content();
        if($tags_terms): echo $tags_terms; endif;
        ?>
        
    </div>

</div>
<?php include('items/items-nav-post.php');?>