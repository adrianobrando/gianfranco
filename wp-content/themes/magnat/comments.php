<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

$n2mu_qt = n2mu_get_option('quick-translation');
$translation['password-protected'] = $n2mu_qt ? n2mu_get_option('qt-comments-password-protected') : esc_html__('This post is password protected. Enter the password to view comments.', 'magnat');
$translation['no-comments'] = $n2mu_qt ? n2mu_get_option('qt-comments-no-comments') : esc_html__('No Comments', 'magnat');
$translation['one-comment'] = $n2mu_qt ? n2mu_get_option('qt-comments-one-comment') : esc_html__('One Comment', 'magnat');
$translation['comments'] = $n2mu_qt ? n2mu_get_option('qt-comments-comments') : esc_html__('Comments', 'magnat');
$translation['comments-closed'] = $n2mu_qt ? n2mu_get_option('qt-comments-closed') : esc_html__('Comments are closed.', 'magnat');
$translation['comments-leave'] = $n2mu_qt ? n2mu_get_option('qt-comments-leave') : esc_html__('Leave A Comment', 'magnat');
$translation['comments-loggedin'] = $n2mu_qt ? n2mu_get_option('qt-comments-loggedin') : esc_html__('Logged in as', 'magnat');
$translation['comments-logout'] = $n2mu_qt ? n2mu_get_option('qt-comments-logout') : esc_html__('Log out', 'magnat');
$translation['comments-submit'] = $n2mu_qt ? n2mu_get_option('qt-comments-submit') : esc_html__('Comment', 'magnat');
$translation['comments-name'] = $n2mu_qt ? n2mu_get_option('qt-comments-name') : esc_html__('Name', 'magnat');
$translation['comments-email'] = $n2mu_qt ? n2mu_get_option('qt-comments-email') : esc_html__('Email', 'magnat');
$translation['comments-website'] = $n2mu_qt ? n2mu_get_option('qt-comments-website') : esc_html__('Website', 'magnat');

	if ( post_password_required() ) { ?>
		<p class="no-comments"><?php esc_html($translation['password-protected']); ?></p>
	<?php
		return;
	}
?>
	
<?php if ( have_comments() ) : ?>

	<div class="comment_list" id="comments">
		<h4><?php comments_number(esc_html($translation['no-comments']), esc_html($translation['one-comment']), esc_html('% '.$translation['comments'])); ?></h4>

		<ol>
			<?php wp_list_comments('type=comment&callback=n2mu_comment'); ?>
		</ol>

		<div class="section-comment-navigation">
		    <div class="comment-navigation-prev"><?php previous_comments_link(); ?></div>
		    <div class="comment-navigation-next"><?php next_comments_link(); ?></div>
		</div>
	</div>

<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>

	 <?php else : // comments are closed ?>
		<?php if(!is_page()) { ?>
			<p class="no-comments"><?php esc_html($translation['comments-closed']); ?></p>
		<?php } ?>
	<?php endif; ?>

<?php endif; ?>

<?php if ( comments_open() ) : ?>

				
	<?php

$args = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'title_reply'       => '<span>'.esc_html($translation['comments-leave']).'</span>',
  'label_submit'      => esc_html($translation['comments-submit']),

  'comment_field' =>  '<div id="comment-textarea">
					<p>		
						<label for="comment">'.esc_html($translation['comments-submit']).'<span class="required">*</span></label>
						<textarea id="comment" rows="6" class="" name="comment"></textarea>
					</p>
				</div>',
	
  'must_log_in' => '<p>You must be <a href="'.esc_url(wp_login_url( get_permalink() )).'">logged in</a> to post a comment.</p>',

  'logged_in_as' => '<p>'.esc_html($translation['comments-loggedin']).' <a href="'.esc_url(get_option('siteurl')).'/wp-admin/profile.php">'.$user_identity.'</a>. <a href="'.wp_logout_url(get_permalink()).'" title="Log out of this account">'.esc_html($translation['comments-logout'] . '&raquo;').'</a></p>',

  'comment_notes_before' => '',  
  'comment_notes_after' => '',

  'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<div class="row">
			<p class="col-md-4 col-xs-12">
			<label for="author">'.esc_html($translation['comments-name']).'<span class="required">*</span></label>
			<input id="author" class="" name="author" type="text" value=""/>
		</p>',

    'email' =>
      '<p class="col-md-4 col-xs-12">	
			<label for="email">'.esc_html($translation['comments-email']).'<span class="required">*</span></label> 
			<input id="email" class="" name="email" type="email" value=""/>
		</p>',

    'url' =>
      '<p class="col-md-4 col-xs-12">		
			<label for="url">'.esc_html($translation['comments-website']).'</label>
			<input id="url" class="" name="url" type="text" value="" size="30"/>
		</p>
		</div>'
    )
  ),
);	
		?>		

		<?php comment_form($args); ?>


<?php endif; ?>