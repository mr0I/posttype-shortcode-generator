<?php defined('ABSPATH') or die('No script kiddies please!');

$postTypes = getPostTypesList();
?>

<div style="padding: 10px 0;">
    <form action="" name="sp_shortcode">
        <select id="sp_post_types" onchange="changePostType(event)" style="width: 100%;margin-bottom: 16px;">
            <option value="0" disabled selected><?= __('Select Post Type...', 'cpt_shortcode') ?></option>
            <?php foreach ($postTypes as $postType) : ?>
                <?php if ($postType->capability_type === 'post') : ?>
                    <option value="<?= $postType->name; ?>"><?= $postType->label; ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
        </select>
        <select id="sp_posts_list" onchange="changePostId(event)" style="width: 100%;margin-bottom: 16px;">
            <option value="0" disabled selected><?= __('Select Post...', 'cpt_shortcode') ?></option>
        </select>
        <input type="hidden" id="sp_shortcode_nonce" value="<?= wp_create_nonce('sp-shortcode-nonce') ?>">

        <div class="loader-spinner">
            <span class="dashicons dashicons-image-rotate spin"></span>
        </div>
    </form>

    <div class="shortcode">
        <p class="shortcode-value" style="direction: ltr;">
            [insert_cpt post_id="<span id="post_id"></span>" post_type="<span id="post_type"></span>"]
        </p>
    </div>
</div>