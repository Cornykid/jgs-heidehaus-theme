					</main>

					<footer class="footer navbar-fixed-bottom" role="contentinfo">
                        <div class="row">
                            <div class="footer-col-one col-md-3 col-lg-3">
                                <h3>Connect with us</h3>
                            </div>

                            <div class="footer-col-two col-md-3 col-lg-3">
                                <h3>Sitemap</h3>
                                <?php wp_nav_menu([
                                    'container'       => '',
                                    'container_class' => '',
                                    'menu_class'      => '',
                                    'theme_location'  => 'footer',
                                ]); ?>
                            </div>

                            <div class="footer-col-three col-md-3 col-lg-3">
                                <h3>Legal</h3>
                                <?php wp_nav_menu([
                                    'container'       => '',
                                    'container_class' => '',
                                    'menu_class'      => '',
                                    'theme_location'  => 'footer-legal',
                                ]); ?>
                            </div>

                            <div class="footer-col-four col-md-3 col-lg-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <p><?php echo get_theme_mod('jgs_footer_copyright','Copyright &copy; '.date('Y')); ?></p>
                            </div>
                        </div>
					</footer>
				</section>
			</div>
		</div>
				
		<?php wp_footer(); ?>
	</body>
</html>
