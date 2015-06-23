<?php
/** 
 * Summary
 *
 * Description.
 *
 * @link  URL
 * @since x.x.x
 *
 * @package    {WordPress}
 * @subpackage {Component} 
 */
?>
<h1 class="name post-title entry-title" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing"><span itemprop="name"><?php the_title(); ?></span></h1>

<?php get_template_part( 'includes/post-meta' ); // Get Post Meta template ?>
<div class="entry">

	<?php
	if ( ! empty( $review_position ) && ( $review_position == 'top' || $review_position == 'both'  ) )  {
		tie_get_review('review-top');
	}

	the_content();
	wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tie' ), 'after' => '</div>' ) );

	if( ! empty( $review_position ) && ( $review_position == 'bottom' || $review_position == 'both' ) ) {
		tie_get_review('review-bottom');
	}

	edit_post_link( __( 'Edit', 'tie' ), '<span class="edit-link">', '</span>' ); ?>

</div><!-- .entry /-->

<?php the_tags( '<span style="display:none">',' ', '</span>'); ?>
<span style="display:none" class="updated"><?php the_time( 'Y-m-d' ); ?></span>

<?php if ( get_the_author_meta( 'google' ) ) { ?>
	<div style="display:none" class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person">
		<strong class="fn" itemprop="name"><a href="<?php the_author_meta( 'google' ); ?>?rel=author">+<?php echo get_the_author(); ?></a></strong>
	</div>
<?php } else { ?>
	<div style="display:none" class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person">
		<strong class="fn" itemprop="name"><?php the_author_posts_link(); ?></strong>
	</div>
<?php }
// Get Share Button template
if ( ( tie_get_option( 'share_post' ) && empty( $get_meta[ "tie_hide_share" ][ 0 ] ) ) || $get_meta[ "tie_hide_share" ][ 0 ] == 'no' ) {
	get_template_part( 'includes/post-share' );
}