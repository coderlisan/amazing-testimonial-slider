<?php

/**
 * Plugin Name: Lisan Testimonial
 * Plugin URI: https://learnwithlisan.com/plugins/the-basics
 * Description: Handle the basics with this plugin.
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: wplisan
 * Author URI: https://learnwithlisan.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: lsts
 */

/**
 * lsts enqueue styles
 */
function lsts_style() {
  wp_enqueue_style('lsts_c1', plugins_url('/css/font-awesome.min.css', __FILE__));
  wp_enqueue_style('lsts_c2', plugins_url('/css/owl.carousel.min.css', __FILE__));
  wp_enqueue_style('lsts_c3', plugins_url('/css/owl.theme.min.css', __FILE__));
  wp_enqueue_style('lsts_c4', plugins_url('/css/custom.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'lsts_style');

/**
 * admin enqueue css file
 */
function lsts_admin_funcs() {
  wp_enqueue_style('lsts_ac1', plugins_url('/css/lsts_admin.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'lsts_admin_funcs');

/**
 * lsts enqueue script
 */
function lsts_scripts_main() {
  if (wp_script_is('owl.carousel.min.js', 'enqueued')) return;
  else {
    wp_enqueue_script('lsts_j1', plugin_dir_url(__FILE__) . 'js/owl.carousel.min.js', [], '1.0.0', true);
  }
}
add_action('wp_enqueue_scripts', 'lsts_scripts_main');


function lsts_scripts() {
  wp_enqueue_script('lsts_j2', plugin_dir_url(__FILE__) . 'js/owl-custom.js', [], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'lsts_scripts');


// Register Scripts &amp; Styles in Admin panel
function custom_color_picker_scripts() {
  wp_enqueue_style('wp-color-picker');
  wp_enqueue_script('iris', admin_url('js/iris.min.js'), array('jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch'), false, 1);
  wp_enqueue_script('cp-active', plugins_url('/js/cp-active.js', __FILE__), array('jquery'), '', true);
}
add_action('admin_enqueue_scripts', 'custom_color_picker_scripts');

/**
 * lsts custom post type register
 */
if (!function_exists('lsts_custom_post_type')) {
  function lsts_custom_post_type() {
    $labels = array(
      'name'        => _x('Testimonials', 'Post Type General Name', 'lsts'),
      'singular_name'         => _x('Testimonial', 'Post Type Singular Name', 'lsts'),
      'menu_name'             => __('Testimonial', 'lsts'),
      'name_admin_bar'        => __('Testimonial', 'lsts'),
      'archives'              => __('Testimonials Archives', 'lsts'),
      'attributes'            => __('Testimonials Attributes', 'lsts'),
      'parent_item_colon'     => __('Parent Testimonials: ', 'lsts'),
      'all_items'             => __('All Testimonials', 'lsts'),
      'add_new_item'          => __('Add New Testimonials', 'lsts'),
      'add_new'               => __('Add New', 'lsts'),
      'new_item'              => __('New Testimonials', 'lsts'),
      'edit_item'             => __('Edit Testimonials', 'lsts'),
      'update_item'           => __('Update Testimonials', 'lsts'),
      'view_item'             => __('View Testimonials', 'lsts'),
      'view_items'            => __('View Testimonials', 'lsts'),
      'search_items'          => __('Search Testimonials', 'lsts'),
      'not_found'             => __('Not found Testimonials', 'lsts'),
      'not_found_in_trash'    => __('Not found in Trash', 'lsts'),
      'featured_image'        => __('Featured Image', 'lsts'),
      'set_featured_image'    => __('Set featured image', 'lsts'),
      'remove_featured_image' => __('Remove featured image', 'lsts'),
      'use_featured_image'    => __('Use as featured image', 'lsts'),
      'insert_into_item'      => __('Insert into item', 'lsts'),
      'uploaded_to_this_item' => __('Uploaded to this item', 'lsts'),
      'items_list'            => __('Testimonials list', 'lsts'),
      'items_list_navigation' => __('Testimonials list navigation', 'lsts'),
      'filter_items_list'     => __('Filter Testimonials list', 'lsts'),
    );
    $args = array(
      'label'               => __('Testimonial', 'lsts'),
      'description'         => __('lsts Description', 'lsts'),
      'labels'              => $labels,
      'supports'            => array('title', 'editor', 'thumbnail'),
      // 'taxonomies'          => array('category', 'post_tag'),
      'hierarchical'        => false,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_admin_bar'   => true,
      'show_in_nav_menus'   => true,
      'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'capability_type'     => 'page',
      'menu_icon' => 'dashicons-format-quote'
    );
    register_post_type('lsts_post_type', $args);
  }
  add_action('init', 'lsts_custom_post_type', 0);
}

/**
 * post query for testimonial
 */
function lsts_testimonial_loop() { ?>
  <div id="testimonial-slider" class="owl-carousel">
    <?php
    $args = array(
      'post_type'              => array('lsts_post_type'),
      'post_status'            => array('publish'),
    );
    // The Query
    $lsts_query = new WP_Query($args);

    // The Loop
    if ($lsts_query->have_posts()) {
      while ($lsts_query->have_posts()) {
        $lsts_query->the_post();
        // do something
    ?>
        <div class="testimonial">
          <div class="pic">
            <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'full') ?>" alt="<?php the_title() ?>">
          </div>
          <h3 class="title"><?php the_title() ?></h3>
          <p class="description"><?php the_excerpt() ?></p>
          <div class="testimonial-content">
            <div class="testimonial-profile">
              <h3 class="name"><?= get_post_meta(get_the_ID(), 'ls_nm', true) ?></h3>
              <span class="post"><?= get_post_meta(get_the_ID(), 'ls_pf', true) ?></span>
            </div>
            <ul class="rating">
              <?php
              $lsts_client_review = get_post_meta(get_the_id(), 'ls_rt', true);
              $bb = '<i class="fa fa-star"></i>';
              $dd = '<i class="far fa-star"></i>';
              $qq = '<i class="fas fa-star-half"></i>';
              if ($lsts_client_review == 1) echo $bb . $dd . $dd . $dd . $dd;
              if ($lsts_client_review == 1.5) echo $bb . $qq . $dd . $dd . $dd;
              if ($lsts_client_review == 2) echo $bb . $bb . $dd . $dd . $dd;
              if ($lsts_client_review == 2.5) echo $bb . $bb . $qq . $dd . $dd;
              if ($lsts_client_review == 3) echo $bb . $bb . $bb . $dd . $dd;
              if ($lsts_client_review == 3.5) echo $bb . $bb . $bb . $qq . $dd;
              if ($lsts_client_review == 4) echo $bb . $bb . $bb . $bb . $dd;
              if ($lsts_client_review == 4.5) echo $bb . $bb . $bb . $bb . $qq;
              if ($lsts_client_review == 5) echo $bb . $bb . $bb . $bb . $bb;
              ?>
            </ul>
          </div>
        </div>
    <?php
      }
    } else {
      // no posts found
    }
    // Restore original Post Data
    wp_reset_postdata(); ?>
  </div>
<?php
}

require_once "cmb/init.php";
require_once "cmb/config.php";

/**
 * shortcode for this plugin
 */
function lsts_shortcode() {
  add_shortcode('LSTS', 'lsts_testimonial_loop');
}
add_action('init', 'lsts_shortcode');

/**
 * Redirect to plugin settings page
 */
register_activation_hook(__FILE__, 'lsts_plugin_activation');
add_action('admin_init', 'lsts_plugin_redirect');

function lsts_plugin_activation() {
  add_option('lsts_plugin_do_activation_redirect', true);
}

function lsts_plugin_redirect() {
  if (get_option('lsts_plugin_do_activation_redirect', false)) {
    delete_option('lsts_plugin_do_activation_redirect');
    if (!isset($_GET['activate-multi']))
      wp_redirect('edit.php?post_type=lsts_post_type&page=settings-page');
  }
}

/**
 * Get all php files
 */
foreach (glob(plugin_dir_path(__FILE__) . "inc/*.php") as $php_file) include_once $php_file;
