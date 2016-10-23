<?php
/**
 * Hooks.
 *
 * @package Altruism
 */

if ( ! function_exists( 'altruism_add_templates' ) ) :

	/**
	 * Add templates.
	 *
	 * @since 2.0.0
	 */
	function altruism_add_templates() {
		?>
		<script id="posts-tmpl" type="text/template">
			<% _.each( data, function( post ) { %>
				<div id="post-<%= post.id %>">
					<% var d = new Date( post.date ); %>
					<% function addZ(n){return n<10? '0'+n:''+n;} %>
					<h1>
						<a class="js-single-post" data-name="<%= d.getFullYear() %>/<%= addZ( d.getMonth() + 1.0 ) %>/<%= post.slug %>" href="<%= altruismObj.base_url %>/<%= d.getFullYear() %>/<%= addZ( d.getMonth() + 1.0 ) %>/<%= post.slug %>"><%= post.title.rendered %></a>
					</h1>
					<%= post.excerpt.rendered %>
				</div>
			<% }); %>
		</script>

		<script id="post-tmpl" type="text/template">
			<div id="post-<%= id %>">
				<h1><%= title.rendered %></h1>

				<p class="author-info">Written by: <img src="<%= _embedded.author[0].avatar_urls[24] %>"> <%= _embedded.author[0].name %></p>

				<%= content.rendered %>
			</div>
		</script>
		<?php
	}
endif;

add_action( 'wp_footer', 'altruism_add_templates' );
