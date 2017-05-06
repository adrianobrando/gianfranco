<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

//Quick translation
$n2mu_qt = n2mu_get_option('quick-translation');
$translation['no-comment'] = $n2mu_qt ? n2mu_get_option('qt-blog-no-comment') : esc_html__('No comments yet', 'magnat');
$translation['one-comment'] = $n2mu_qt ? n2mu_get_option('qt-blog-one-comment') : esc_html__('1 comment', 'magnat');
$translation['comments'] = $n2mu_qt ? n2mu_get_option('qt-blog-comments') : esc_html__('comments', 'magnat');
$translation['comments-off'] = $n2mu_qt ? n2mu_get_option('qt-blog-comments-off') : esc_html__('Comments are Off', 'magnat');
$translation['comment-password'] = $n2mu_qt ? n2mu_get_option('qt-blog-comment-password') : esc_html__('Enter your password to view comments.', 'magnat');

if(n2mu_get_option('blog-single-meta') != false) { ?>
    <div class="blog-post-meta">
        <?php if(n2mu_get_option('blog-single-meta-date') != false) { ?>
            <span class="date">
                <i class="post-icon fa fa-calendar"></i>
                <?php echo esc_attr(get_the_date());?>
            </span>
        <?php } ?>
        <?php if(n2mu_get_option('blog-single-meta-author') != false) { ?>
            <span class="author">
                <i class="post-icon fa fa-user"></i>
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID', $post->post_author ))); ?>">
                    <?php echo esc_html(get_the_author_meta('display_name', $post->post_author)); ?>
                </a>
            </span>
        <?php } ?>
        <?php if(n2mu_get_option('blog-single-meta-categories') != false) { ?>
            <span class="category">
                <i class="post-icon fa fa-folder-o"></i>
                <?php
                    $categories = get_the_terms( $post->ID, 'category' );
                    
                    $len_cats = count($categories);
                    foreach ($categories as $id_cats => $category) { 
                        $cat_id =  $category->term_id; ?>
                        <a href="<?php echo esc_url(get_category_link( $cat_id )); ?>" title="<?php echo esc_attr($category->name);?>" >
                            <?php echo esc_attr($category->name);
                            if ($id_cats != $len_cats - 1) {
                                echo ",";
                            } ?>
                        </a>
                    <?php } ?>
            </span>
        <?php } ?>
        <?php if(n2mu_get_option('blog-single-meta-comments') != false) { ?>
            <span class="comments <?php if(!get_the_tags()){ echo "no-border-comments";}?>">
                <i class="post-icon fa fa-commenting-o"></i>
                <?php comments_popup_link( $translation['no-comment'], $translation['one-comment'], '% ' . $translation['comments'] , 'comments-link', $translation['comments-off']);?>
            </span>
        <?php } ?>
    </div>
<?php } ?>