<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

//Quick translation
$n2mu_qt = n2mu_get_option('quick-translation');
$translation['tags'] = $n2mu_qt ? n2mu_get_option('qt-blog-tags') : esc_html__('Tags:', 'magnat');

if(n2mu_get_option('blog-single-meta') != false) { 
    if(n2mu_get_option('blog-single-meta-tags') != false) { ?>
        <?php if(get_the_tags()) { ?>
            <div class="tags">
                <span class="tags-before"><?php echo esc_html($translation['tags']);?></span>
                <?php
                esc_attr(the_tags('',', ')); ?>
            </div> 
        <?php } ?>
    <?php } ?>
<?php } ?>