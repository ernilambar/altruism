    <footer id="colophon" class="site-footer" role="contentinfo">
      <div class="copyright">
          <p>
              <?php esc_attr_e( 'Copyright &copy;', 'altruism' ); ?>&nbsp;<?php echo date( 'Y' ); ?>&nbsp;<?php printf( '<a class="site-link" href="%s" rel="home">%s</a>', esc_url( home_url( '/#/' ) ), get_bloginfo( 'name' ) ); ?>&nbsp;<?php esc_attr_e( 'All rights reserved.', 'altruism' ); ?>
          </p>
      </div><!-- .copyright -->
      <div class="site-info">
      	<?php
	      	printf( esc_html__( 'Powered by %s and %s', 'altruism' ), '<a href="' . esc_url( __( 'https://wordpress.org/', 'altruism' ) ) . '" target="_blank">WordPress</a>', '<a href="' . esc_url( __( 'https://angularjs.org/', 'altruism' ) ) . '" target="_blank">AngularJS</a>' );
      	?>
      	<span class="sep"> | </span>
      	<?php printf( esc_html__( '%1$s by %2$s', 'altruism' ), 'Altruism', '<a href="' . esc_url( 'http://nilambar.co/' ) . '" rel="designer" target="_blank">Nilambar</a>' ); ?>
      </div><!-- .site-info -->
    </footer>

    <?php wp_footer(); ?>
  </body>
</html>
