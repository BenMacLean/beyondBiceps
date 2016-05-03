<?php
	if ( post_password_required() ) {
		return;
	}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title">
			<?php
				printf( _nx( 'Comment 1', 'Comments %1$s', get_comments_number(), 'comments', 'healthcoach' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h4>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'healthcoach' ); ?></h2>
				<div class="nav-links">
					<?php
						if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'healthcoach' ) ) ) :
							printf( '<div class="nav-previous">%s</div>', $prev_link );
						endif;

						if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'healthcoach' ) ) ) :
							printf( '<div class="nav-next">%s</div>', $next_link );
						endif;
					?>
				</div>
			</nav>
		<?php endif; ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'type'        => 'comment',
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 65,
					'callback'    => 'stm_comment_template'
				) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'healthcoach' ); ?></h2>
				<div class="nav-links">
					<?php
						if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'healthcoach' ) ) ) :
							printf( '<div class="nav-previous">%s</div>', $prev_link );
						endif;

						if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'healthcoach' ) ) ) :
							printf( '<div class="nav-next">%s</div>', $next_link );
						endif;
					?>
				</div>
			</nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'healthcoach' ); ?></p>
	<?php endif; ?>

	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields =  array(

			'author' =>
				'<div class="row"><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><p class="comment-form-author">' .
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30"' . $aria_req . ' placeholder="' . __( 'Name', 'healthcoach' ) . '" /></p></div>',

			'email' =>
				'<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><p class="comment-form-email">' .
				'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30"' . $aria_req . ' placeholder="' . __( 'E-mail (Not necessary)', 'healthcoach' ) . '" /></p></div></div>',

			'url' => false
		);

		$comments_args = array(
			'label_submit'=> __( 'Post Comment', 'healthcoach' ),
			'title_reply'=> __( 'Write a comment', 'healthcoach' ),
			'comment_field' =>  '<div class="row"><div class="col-lg-12 col-md-12"><p class="comment-form-message">' .
				'<textarea id="comment-message" name="comment" cols="45" rows="8" aria-required="true" placeholder="'.  __( 'Message', 'healthcoach' )  .'">' .
				'</textarea></p></div></div>',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'fields' => apply_filters( 'comment_form_default_fields', $fields )
		);

		comment_form($comments_args);
	?>

</div>
