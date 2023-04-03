<?php
/**
 * @package lastUpdate
 * @version 1.0.0
 */
/*
Plugin Name: lastUpdate
Plugin URI: http://wordpress.org/plugins/hello-dolly/
description: This plugin displays the date of the last update for each post
Author: Faissal AOUKCHA
Version: 1.0.0
Author URI: http://ma.tt/
*/

function last_update_date() {
    $last_update_date = get_the_modified_date();
    echo "<span class='last-update-date'>Last updated on " . $last_update_date . "</span>";
}

function add_last_update_date() {
    add_filter( 'the_content', 'last_update_date' );
}

add_action( 'wp', 'add_last_update_date' );
?>
