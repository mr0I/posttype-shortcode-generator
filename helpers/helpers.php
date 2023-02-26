<?php

function getAllPosts($post_type)
{
    $args = [
        'post_type' => $post_type,
        'offset' => 0,
        'post_status' => 'publish'
    ];
    $results = new WP_Query($args);
    return $results->posts;
}

function getSinglePost($post_id, $post_type)
{
    $args = [
        'p' => $post_id,
        'post_type' => $post_type,
        'posts_per_page' => 1,
        'offset' => 0,
        'post_status' => 'publish'
    ];
    $result = new WP_Query($args);
    return $result->posts;
}

function getPostTypesList()
{
    return get_post_types([
        'public'   => true,
        '_builtin' => false
    ], 'object');
}
