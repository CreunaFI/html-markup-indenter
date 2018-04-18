<?php
/*
Plugin Name: HTML Markup Indenter
Plugin URI: https://github.com/joppuyo/html-markup-cleaner
Description: Indents the HTML markup output by WordPress
Version: 1.0.0
Author: Johannes Siipola
Author URI: https://siipo.la
*/

defined('ABSPATH') or die();

require 'library/dindent/src/Indenter.php';

// Thanks to
// https://stackoverflow.com/questions/772510/wordpress-filter-to-modify-final-html-output/22818089#22818089

add_action('plugins_loaded', function () {
    ob_start();
});

add_action('shutdown', function () {
    if (!is_admin() && !is_admin_bar_showing() && !is_user_logged_in()) {
        $final = '';
        $levels = ob_get_level();
        for ($i = 0; $i < $levels; $i++) {
            $final = $final . ob_get_clean();
        }
        $indenter = new \Gajus\Dindent\Indenter();
        echo $indenter->indent($final);
    }
}, 0);

