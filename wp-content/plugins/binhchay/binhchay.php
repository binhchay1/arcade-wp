<?php if (!defined('ABSPATH')) die;
/*
Plugin Name: Config SEO
Description: All config SEO for this domain only
Author: binhchay
Version: 1.0
License: GPLv2 or later
*/

define('BINHCHAY_ADMIN_VERSION', '1.0.0');
define('BINHCHAY_ADMIN_DIR', 'binhchay');

require plugin_dir_path(__FILE__) . 'admin-form.php';
function run_ct_wp_admin_form()
{
    $plugin = new Admin_Form();
    $plugin->init();
}
run_ct_wp_admin_form();

add_action('template_redirect', function () {

    if ((defined('DOING_CRON') && DOING_CRON) || (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST) || (defined('DOING_AJAX') && DOING_AJAX)) return;

    if (is_admin()) return;

    global $wp_query;
    if ($wp_query->is_404 === false) {
        return;
    } else {
        $paths = explode('/', $_SERVER['REQUEST_URI']);
        foreach ($paths as $path) {
            if ($path == '404') {
                status_header(200);
                return;
            }
        }
    }
}, PHP_INT_MAX);

add_action('init', function ($search) {
    add_rewrite_rule('search/?$', 'index.php?s=' . $search, 'top');
});


function create_plugin_database_table()
{
    global $wpdb;
    $db_table_name = $wpdb->prefix . 'category_custom';
    $db_version = '1.0.0';
    $charset_collate = $wpdb->get_charset_collate();

    if ($wpdb->get_var("show tables like '$db_table_name'") != $db_table_name) {
        $sql = "CREATE TABLE $db_table_name (
                id int(11) NOT NULL auto_increment,
                category_id varchar(15) NOT NULL,
                content text NOT NULL,
                UNIQUE KEY id (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        add_option('my_db_version', $db_version);
        dbDelta($sql);
    }
}

register_activation_hook(__FILE__, 'create_plugin_database_table');
