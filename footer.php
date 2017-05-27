					</main>

					<footer class="footer" role="contentinfo">
						<div class="footer-col-left">
							<p><?php echo get_theme_mod('jgs_footer_copyright','Copyright &copy; '.date('Y')); ?></p>
						</div>

						<div class="footer-col-right">
							<?php wp_nav_menu([
								'container'       => '',
								'container_class' => '',
								'menu_class'      => '',
								'theme_location'  => 'footer',
							]); ?>
						</div>
					</footer>
				</section>
					
				<?php get_template_part('partials/navigations/main-offcanvas'); ?>
			</div>
		</div>
				
		<?php wp_footer(); ?>
	</body>
</html>
