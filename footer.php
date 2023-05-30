		<?php
		
		if (! defined('ABSPATH')) {
			exit;
		}?>
		</main><!-- .main-page -->
		<footer id="footer-site" class="footer-site" role="contentinfo">
			<div class="footer-nav container d-flex justify-content-between">
				<?php
					get_template_part('template-parts/navigation/nav', 'footer');
					get_template_part('template-parts/navigation/nav', 'copyright');
				?>
			</div>
		</footer>
<?php wp_footer(); ?>
</body>
</html>
