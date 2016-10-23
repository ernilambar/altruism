<?php
/**
 * Hooks.
 *
 * @package Altruism
 */

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

add_action( 'wp_footer', 'altruism_add_templates' );

/**
 * Customizer primary menu .
 *
 * @since 2.0.0
 *
 * @param array    $items Menu items.
 * @param stdClass $args  An object containing wp_nav_menu() arguments.
 * @return array Modified array.
 */
function altruism_customize_primary_menu( $items, $args ) {

	if ( 'primary' === $args->theme_location ) {
		if ( ! empty( $items ) ) {
			$cnt = count( $items );
			for ( $i = 1; $i <= $cnt; $i++ ) {
				switch ( $items[ $i ]->object ) {
					case 'page':
						$items[ $i ]->url = home_url() . '/p/' . basename( get_permalink( $items[ $i ]->object_id ) );
						break;

					default:
						break;
				}
			}
		}
	}

	return $items;
}

add_filter( 'wp_nav_menu_objects', 'altruism_customize_primary_menu', 10, 2 );
