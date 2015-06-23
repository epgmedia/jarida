<?php get_header(); ?>
<?php tie_setPostViews() ?>
<div class="content-wrap">
	<div class="content">
		<?php tie_breadcrumbs() ?>
		
		<?php if ( ! have_posts() ) : ?>
		<div id="post-0" class="post not-found post-listing">
			<h1 class="post-title"><?php _e( 'Not Found', 'tie' ); ?></h1>
			<div class="entry">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'tie' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div>
		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>
		
		<?php $get_meta = get_post_custom($post->ID);
			if( !empty( $get_meta['tie_review_position'][0] ) ){
				$review_position = $get_meta['tie_review_position'][0] ;
				$rv = $tie_reviews_attr;
			}
			
			$post_width = $get_meta["tie_sidebar_pos"][0];
			if( $post_width == 'full' ){
				if(tie_get_option( 'columns_num' ) == '2c') $content_width = 955;
				else $content_width = 1160;
			}
		?>
		
		<?php //Above Post Banner
		if(  empty( $get_meta["tie_hide_above"][0] ) ){
			if( !empty( $get_meta["tie_banner_above"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["tie_banner_above"][0]) .'</div>';
			else tie_banner('banner_above' , '<div class="ads-post">' , '</div>' );
		}
		?>
				
		<article <?php if( !empty( $rv['review'] ) ) echo $rv['review']; post_class('post-listing'); ?>>
			<?php get_template_part( 'includes/post-head' ); // Get Post Head template ?>	

			<div class="post-inner">
				<?php get_template_part( 'partials/content', 'post' ); ?>
			</div><!-- .post-inner -->

		</article><!-- .post-listing -->
		<?php if( tie_get_option( 'post_tags' ) ) the_tags( '<p class="post-tag">'.__( 'Tagged with: ', 'tie' )  ,' ', '</p>'); ?>

		
		<?php //Below Post Banner
		if( empty( $get_meta["tie_hide_below"][0] ) ){
			if( !empty( $get_meta["tie_banner_below"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["tie_banner_below"][0]) .'</div>';
			else tie_banner('banner_below' , '<div class="ads-post">' , '</div>' );
		}
		?>
		
		<?php if( tie_get_option( 'post_nav' ) ): ?>				
		<div class="post-navigation">
			<div class="post-previous"><?php previous_post_link( '%link', '<span>'. __( 'Previous:', 'tie' ).'</span> %title' ); ?></div>
			<div class="post-next"><?php next_post_link( '%link', '<span>'. __( 'Next:', 'tie' ).'</span> %title' ); ?></div>
		</div><!-- .post-navigation -->
		<?php endif; ?>
		
		<?php if( ( tie_get_option( 'post_authorbio' ) && empty( $get_meta["tie_hide_author"][0] ) ) || ( isset( $get_meta["tie_hide_related"][0] ) && $get_meta["tie_hide_author"][0] == 'no' ) ): ?>		
		<section id="author-box">
			<div class="block-head">
				<h3><?php _e( 'About', 'tie' ) ?> <?php the_author() ?> </h3>
			</div>
			<div class="post-listing">
				<?php tie_author_box() ?>
			</div>
		</section><!-- #author-box -->
		<?php endif; ?>

		<?php get_template_part( 'includes/post-related' ); // Get Related Posts template ?>	

		<?php endwhile;?>

		<?php comments_template( '', true ); ?>
	
	</div><!-- .content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>