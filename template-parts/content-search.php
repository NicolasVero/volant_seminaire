<li id="post-<? the_ID(); ?>" class="container-resume container-resume-<? the_ID(); ?>">
		<?php if (has_post_thumbnail() ) :?>
			<a href="<? the_permalink()?>" rel="bookmark" title="Voir l'article : <?php the_title()?>">
				<div class="d-flex">
					<figure class="entry-featured col-12 col-md-4"><?php the_post_thumbnail(); ?></figure>
					<div class="entry-resume col-12 col-md-8 pr-md-0">
						<header class="entry-header-search">
							<h2 class="title-post-search"><?php the_title(); ?></h2>
						</header><!-- .entry-header -->
						<div class="content-resume"><?php the_excerpt(); ?></div>
						<button>Lire la suite<i class="ti-angle-right"></i></button>
					</div>
				</div>
			</a>
		<?php else :?>
			<a href="<?php the_permalink()?>" rel="bookmark" title="Voir l'article : <?php the_title()?>">
				<div class="d-flex">
					<div class="entry-resume">
						<header class="entry-header-search">
							<h2 class="title-post-search"><?php the_title(); ?></h2>
						</header><!-- .entry-header -->
						<div class="content-resume"><?php the_excerpt(); ?></div>
						<button>Lire la suite<i class="ti-angle-right"></i></button>
					</div>
				</div>
			</a>
		<?php endif;?>
</li>