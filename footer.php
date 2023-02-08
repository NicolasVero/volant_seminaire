		<?php
		
		if (! defined('ABSPATH')) {
			exit;
		}?>
		</main><!-- .main-page -->
		<footer id="colophon" class="footer-site container-fluid" role="contentinfo">
			<div id="find-us" class="map-container row">
				<?php dynamic_sidebar('Map'); ?>
			</div>
			<div class="footer-nav">
					<div class="row">
						<?php
						get_template_part('template-parts/navigation/nav', 'footer');
						?>
						<div class="container-social-copyright col-12 col-md-7 d-flex flex-column justify-content-end">	
						<?php
						get_template_part('template-parts/navigation/nav', 'medias-sociaux');
						get_template_part('template-parts/navigation/nav', 'copyright');
						?>
						</div>
						<div class="container-button-top col-12 col-md-1 d-flex flex-column align-items-center align-items-md-end justify-content-center justify-content-md-end pr-md-0">
							<button class="btn-return-top"><i class="ti-arrow-up d-block"></i></button>
							<span>retour en haut</span>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-copyright row d-flex justify-content-center justify-content-lg-end">
				© <?php echo date('Y'); ?> Havre caravano
			</div>
		</footer>
<?php wp_footer(); ?>
</body>
</html>
