<?php defined('ABSPATH') or die('No script kiddies please!');

function CPTS_activate_function()
{
    register_uninstall_hook(__FILE__, 'cpts_uninstall');
    flush_rewrite_rules();
}

function CPTS_deactivate_function()
{
    flush_rewrite_rules();
}

function cpts_uninstall()
{
    delete_option('cpts_postTypes');
}
