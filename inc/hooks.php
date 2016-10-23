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

			<p class="author-info"><img src="<%= _embedded.author[0].avatar_urls[24] %>"> <%= _embedded.author[0].name %></p>

			<%= content.rendered %>
		</div>
	</script>
	<?php
}

add_action( 'wp_footer', 'altruism_add_templates' );

class Altruism_Menu_Walker extends Walker_Nav_Menu {

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		if ( 'page' !== $item->object ) {
			return;
		}

		$link_data = '';

		switch ( $item->object ) {
			case 'page':
				$item->url = home_url() . '/p/' . basename( get_permalink( $item->object_id ) );
				$link_data = 'p/' . basename( get_permalink( $item->object_id ) );
				break;

			default:
				break;
		}
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );

		// Passed classes.
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// Build HTML.
		$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . ' ' . $class_names . '">';

		// Link attributes.
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_url( $item->url        ) .'"' : '';
		$attributes .= ! empty( $link_data )        ? ' data-name="'   . esc_attr( $link_data ) .'"' : '';
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
		    $args->before,
		    $attributes,
		    $args->link_before,
		    apply_filters( 'the_title', $item->title, $item->ID ),
		    $args->link_after,
		    $args->after
		);

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}

}
