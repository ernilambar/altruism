/**
 * Main.js
 */

/** global Router */
( function( $, _, undefined ) {
	var apiUrl = altruismObj.root,
		$el = $( '#js-data' ),
		$branding = $( '#branding' );

	/**
	 * Event handler for visitors that click the logo image.
	 *
	 * Routes visitors to the homepage when they click the logo.
	 *
	 * @param  {object} event    Event object.
	 */
	$branding.click( function( event ) {
		event.preventDefault();

		/**
		 * Route to the homepage view.
		 */
		router.setRoute( '/' );
	});

	/**
	 * Single Post route callback.
	 */
	var viewPost = function( year, month, postName ) {
		$.get( apiUrl + '/wp/v2/posts/?slug=' + postName + '&_embed', function( data ) {
			var output = data[0],
				template = _.template( $( '#post-tmpl' ).html() );

			$el.html( template( output ) );
		});
	};

	/**
	 * Single Page route callback.
	 */
	var viewPage = function( pageName ) {
		$.get( apiUrl + '/wp/v2/pages/?slug=' + pageName + '&_embed', function( data ) {
			var output = data[0];
			template = _.template( $( '#post-tmpl' ).html() );

			$el.html( template( output ) );
		});
	};

	/**
	 * Homepage and Post list pagination routes callback.
	 *
	 * @param  {string} page - Pagination location.
	 */
	var listPostswithPagination = function( page ) {
		page = typeof page !== 'undefined' ? page : '1';

		$.get( apiUrl + '/wp/v2/posts?page=' + page, function( data, textStatus, jqxhr ) {
			var output = { data: data },
				currentPage = parseInt( page, 10 ),
				maxPages = parseInt( jqxhr.getResponseHeader( 'X-WP-TotalPages' ), 10 ),
				template;

			if ( currentPage > 1 ) {
				output.previous = currentPage - 1;
			}

			if ( currentPage < maxPages ) {
				output.next = currentPage + 1;
			}

    		template = _.template( $( '#posts-tmpl' ).html() );

			$el.html( template( output ) );

			/**
			 * Click event handler for a single view of a listed Post.
			 *
			 * @param  {Object} event - Event object.
			 */
			$( '.js-single-post' ).click( function( event ) {
				event.preventDefault();
				var slug = $( this ).data( 'name' );

				// router.setRoute( '/news/' + slug );
				router.setRoute( '/' + slug );

				// Scroll to the top of the page.
				$( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );
			});
		});
	};

	/**
	 * Define our routing paths and their accompanying callbacks.
	 *
	 * @type {Object}
	 */
	var routes = {
		'/': listPostswithPagination,
		'/:page': listPostswithPagination,
		'/:year/:month/:postName': viewPost,
		'/p/:pageName': viewPage
	};

	/**
	 * The Router object for our routes.
	 */
	var router = new window.Router( routes );

	router.configure( { html5history: true } );

	router.init();


})( jQuery, _ );
