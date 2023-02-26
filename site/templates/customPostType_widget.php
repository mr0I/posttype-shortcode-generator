<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<?php
require_once(CPTS_ROOTDIR . 'helpers/helpers.php');
$post_id = '';
$post_type = '';
extract(shortcode_atts(array(
    'post_id' => '',
    'post_type' => ''
), $atts));

$post = [];
if ($post_id !== '' && $post_type !== '') {
    $post = getSinglePost($post_id, $post_type);
}

$isRtl = !!str_starts_with(get_locale(), 'fa_');
?>

<?php if (sizeof($post) !== 0) :
    $postThumbnailSrc = get_the_post_thumbnail_url($post[0]->ID, 'large') != ''
        ? get_the_post_thumbnail_url($post[0]->ID, 'large')
        : CPTS_STATIC . 'images/not_available.jpg';
?>
    <section class="customTypeWidget">
        <div class="customTypeWidget__container">
            <div class="customTypeWidget__content <?= $isRtl ? 'rtl' : 'ltr' ?>">
                <p><?= mb_strimwidth($post[0]->post_content, 0, 650, '...'); ?></p>
                <a class="customTypeWidget__content__link" href="<?= get_permalink($post[0]->ID) ?>"><?= __('Read More...', 'cpt_shortcode') ?></a>
            </div>
            <div class="customTypeWidget__image">
                <figure>
                    <img src="<?= $postThumbnailSrc ?>" alt="<?= $post[0]->post_title; ?>" />
                </figure>
            </div>
        </div>
    </section>
<?php endif; ?>