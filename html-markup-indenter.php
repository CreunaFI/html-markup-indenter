<?php
/*
Plugin Name: HTML Markup Indenter
Plugin URI: https://github.com/CreunaFI/html-markup-indenter
Description: Indents the HTML markup output by WordPress
Version: 2.0.0
Requires at least: 4.9.0
Tested up to: 4.9.8
Requires PHP: 5.3
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
    if (extension_loaded('mbstring') && html_markup_indenter_is_html() && !is_user_logged_in()) {
        $final = '';
        $levels = ob_get_level();
        for ($i = 0; $i < $levels; $i++) {
            $final = $final . ob_get_clean();
        }
        $indenter = new \Gajus\Dindent\Indenter();
        echo $indenter->indent($final);
    }
}, 0);

function html_markup_indenter_is_html() {
    foreach (headers_list() as $header) {
        if (strpos($header, "Content-Type: text/html") !== false) {
            return true;
        }
    }
    return false;
}

add_action('admin_notices', function() {
    if (!extension_loaded('mbstring')) {
        echo '<div class="notice notice-warning"><p>';
        echo __("Mbstring PHP extension is not loaded. HTML Markup Indenter has been disabled.", 'html-markup-indenter');
        echo '</p></div>';
    }
});
