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
            <form method="post" action="<?php echo esc_html(admin_url('admin-post.php')) ?>">
                <input type="hidden" name="action" value="submit_directory_categories">
                <input type="text" name="my_text">
                <?php
                    wp_nonce_field("submit_directory_categories");
                    submit_button();
                ?>
            </form>
        </div>
        <?php
    }
    
    static function on_directory_categories_submit() {
        status_header(200);
        $text = $_POST['my_text'];
        die("Server recieved '{ $text }'");
    }
    
    static function add_scripts() {
        wp_enqueue_script("wip-directory-script", plugins_url("wip-directory.js", __FILE__), array("wp-api"), null, true);
    }
    
    static function add_admin_scripts($hook) {
        if ($hook == "edit.php?post_type=wip_directory") {
            wp_enqueue_script("wip-directory-admin-script", plugins_url("wip-directory-admin.js", __FILE__), array("jquery"), null, true);
        }
    }

}

add_action("init", array("wip_directory", "create_post_type"));

add_action("admin_menu", array("wip_directory", "add_directory_categories_menu"));
add_action("admin_enqueue_scripts", array("wip_directory", "add_scripts"));
add_action("admin_post_submit_directory_categories", array("wip_directory", "on_directory_categories_submit"));

add_action("wp_enqueue_scripts", array("wip_directory", "add_admin_scripts"));

?>