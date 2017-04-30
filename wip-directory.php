<?php
/*
  Plugin Name: WiP Directory
  Plugin URI: http://shaobogu.com
  Description: Adds the Directory post-type for WiP
  Version: 1.0
  Author: Shaobo & Anna
  License: GPL2
*/

defined( 'ABSPATH' ) or die( 'WordPress not initialized');

class wip_directory {
    
    static function create_post_type() {
        register_post_type('wip_directory', array(
            "labels" => array(
                "name" => "Directory",
                "singular_name" => "Directory Item"
            ),
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "exclude_from_search" => true,
            "supports" => array("title", "editor", "author", "custom-fields"),
            "delete_with_user" => true
        ));
    }
    
    static function add_directory_categories_field() {
        register_setting("wip_directory_options", "wip_directory_categories");
    }
    
    static function add_directory_categories_menu() {
        add_submenu_page(
                "edit.php?post_type=wip_directory", 
                "Directory Categories", 
                "Categories",
                "manage_options",
                "directory_categories",
                array("wip_directory", "directory_categories_menu")
                );
    }
    
    static function directory_categories_menu() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()) ?></h1>
            <?php settings_errors(); ?>
            <form method="post" action="options.php">
                <?php settings_fields( 'wip_directory_options' ); ?>
                <?php do_settings_sections( 'wip_directory_options' ); ?>
                <div id="wip_directory_categories_group"></div>
                <a href="javascript:void(0)" onclick="WIPDirectoryAdmin.addCategory()">Add New</a>
                <input id="wip_directory_categories_field" type="hidden" name="wip_directory_categories" value="<?php echo get_option('wip_directory_categories'); ?>">
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
    
    static function add_scripts() {
        wp_enqueue_script("wip-directory-script", plugins_url("wip-directory.js", __FILE__), array("wp-api"), null, true);
    }
    
    static function add_admin_scripts($hook) {
        wp_enqueue_script("wip-directory-admin-script", plugins_url("wip-directory-admin.js", __FILE__), array("jquery"), null, true);
    }

}

add_action("init", array("wip_directory", "create_post_type"));

add_action("admin_init", array("wip_directory", "add_directory_categories_field"));
add_action("admin_menu", array("wip_directory", "add_directory_categories_menu"));

add_action("wp_enqueue_scripts", array("wip_directory", "add_scripts"));
add_action("admin_enqueue_scripts", array("wip_directory", "add_admin_scripts"));

?>