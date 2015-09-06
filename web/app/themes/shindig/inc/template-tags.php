<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package progression
 */


/* remove more link jump */
function progression_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'progression_remove_more_link_scroll' );


function show_pagination_links()
{
    global $wp_query;

    $page_tot   = $wp_query->max_num_pages;
    $page_cur   = get_query_var( 'paged' );
    $big        = 999999999;

    if ( $page_tot == 1 ) return;

    echo paginate_links( array(
            'base'      => str_replace( $big, '%#%',get_pagenum_link( 999999999, false ) ), // need an unlikely integer cause the url can contains a number
            'format'    => '?paged=%#%',
            'current'   => max( 1, $page_cur ),
            'total'     => $page_tot,
            'prev_next' => true,
			'prev_text'    => __('&lsaquo; Previous', 'progression'),
			'next_text'    => __('Next &rsaquo;', 'progression'),
            'end_size'  => 1,
            'mid_size'  => 2,
            'type'      => 'list'
        )
    );
}

function show_pagination_links_home()
{
    global $blogloop;

    $page_tot   = $blogloop->max_num_pages;
    $big        = 999999999;
	if ( get_query_var('paged') ) {
	    $paged = get_query_var('paged');
	} else if ( get_query_var('page') ) {
	    $paged = get_query_var('page');
	} else {
	    $paged = 1;
	}
	
    if ( $page_tot == 1 ) return;

    echo paginate_links( array(
            'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ), // need an unlikely integer cause the url can contains a number
            'format'    => '?paged=%#%',
            'current'   => max( 1, $paged ),
            'total'     => $page_tot,
            'prev_next' => true,
			'prev_text'    => __('&lsaquo; Previous', 'progression'),
			'next_text'    => __('Next &rsaquo;', 'progression'),
            'end_size'  => 1,
            'mid_size'  => 2,
            'type'      => 'list'
        )
    );
}



if ( ! function_exists( 'infinite_content_nav_pro_home' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function infinite_content_nav_pro_home( $html_id ) {
	global $blogloop;

	$html_id = esc_attr( $html_id );

	if ( $blogloop->max_num_pages > 1 ) : ?>
		<div id="infinite-nav-pro">
			<div class="nav-previous"><?php next_posts_link( __( 'Load More News', 'progression' ), $blogloop->max_num_pages ); ?></div>
		</div>
	<?php endif;
}
endif;



if ( ! function_exists( 'infinite_content_nav_pro' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function infinite_content_nav_pro( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<div id="infinite-nav-pro">
			<div class="nav-previous"><?php next_posts_link( __( 'Load More', 'progression' ) ); ?></div>
		</div>
	<?php endif;
}
endif;



if ( ! function_exists( 'progression_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function progression_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<div id="post-nav-progression" class="<?php echo $nav_class; ?>">
	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>' , __('<span><i class="fa fa-angle-left"></i> Previous</span>', 'progression' ) . '%title' , TRUE); ?>	
		
		<?php next_post_link( '<div class="nav-next">%link</div>' ,  __('<span>Next <i class="fa fa-angle-right"></i></span>', 'progression' ) . '%title' , TRUE); ?>
		

	<?php endif; ?>
	<div class="clearfix"></div>
	</div><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // progression_content_nav

if ( ! function_exists( 'progression_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function progression_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'progression' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'progression' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta">
				<div class="comment-author vcard">
					
					<?php
						$avatar_size = 70;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 60;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s %2$s', 'progression' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s %2$s', 'progression' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
					<?php edit_comment_link( __( 'Edit', 'progression' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'progression' ); ?></p>
				<?php endif; ?>
			</div><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for progression_comment()

if ( ! function_exists( 'progression_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function progression_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'progression_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'progression_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since progression 1.0
 */
function progression_posted_on() {
	printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>' ),
		esc_url( get_month_link(get_the_time('Y'), get_the_time('m')) ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'progression' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function progression_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so progression_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so progression_categorized_blog should return false
		return false;
	}
}



/**
 * Display a navigation for the MENU including the parent category
 */
function progression_gallery_category_nav() {
	$term 			= get_queried_object();
	$term_all 		= ( $term->parent ? $term->parent : $term->term_id );
	$term_children 	= get_term_children( $term->term_id, 'gallery-category' );
	

	// if the current term has neither children nor a parent then display nothing
	if ( empty( $term_children ) && ! $term->parent  ) {
		return false;
	}

	// build the link to the parent ("all") category
	$term_link_classes = join( ' ', array( 'cat-item', 'cat-item-'. $term_all, ( $term->parent ? ' ' : 'current-cat' )));

	return sprintf(
		// HTML link template
		'<li class="%s"><a href="%s">%s</a></li>',

		// the string containing item classes
		$term_link_classes,

		// URL to the term archive
		get_term_link( $term_all, 'gallery-category' ),

		// link text
		__( 'All', 'progression' ) )

		// append the subcategories
		.wp_list_categories( 'taxonomy=gallery-category&echo=0&show_count=0&title_li=&show_option_none=&child_of=' . $term_all );
		
}