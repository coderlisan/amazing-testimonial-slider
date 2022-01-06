<?php

/**
 * Adds a submenu page under a custom post type parent.
 */
function lsts_post_callback1() {
  add_submenu_page(
    'edit.php?post_type=lsts_post_type',
    __('Settings', 'lsts'),
    __('Settings', 'lsts'),
    'manage_options',
    'settings-page',
    'lsts_post_callback2'
  );
}
add_action('admin_menu', 'lsts_post_callback1');

/**
 * Limite of words of showing
 */
function lsts_excerpt_length($length) {
  return 20;
}
add_filter('excerpt_length', 'lsts_excerpt_length', 999);

/**
 * Remove extra p tags from content
 */
remove_filter('the_excerpt', 'wpautop');

/**
 * Display callback for the submenu page.
 */
function lsts_post_callback2() {
?>
  <div class="wrap lsts_wrap">
    <div class="left_module">
      <form action="options.php" method="POST">
        <h2><?php _e('Settings', 'lsts'); ?></h2>
        <?php wp_nonce_field('update-options') ?>
        <label name="item01" for="item01">Theme color: </label>
        <input type="text" name="item01" value="<?= get_option('item01') ?>" class="color-picker" />

        <label name="item02" for="item02">Hover color: </label>
        <input type="text" name="item02" value="<?= get_option('item02') ?>" class="color-picker" />

        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="item01, item02" />
        <input type="submit" name="submit" value="<?php _e('Save changes', 'lsts') ?>" />
      </form>
    </div>
    <div class="right_module">
      <h2><?php _e('About Developer', 'lsts'); ?></h2>
      <p><span>Welcome!!! I'm Lisan E. a Full-stack WordPress designer and developer with over 5+ years of excellent skills and experiences. and also have worked with over 200+ clients around the globe. Client satisfaction is my key of Success. Skills and Experiences:- </span><br>✅ WordPress website design <br>✅ Wordpress bug fixing <br>✅ Divi website design <br>✅ WooCommerce website design <br>✅ Divi bug fixing <br>✅ Elementor website design <br>✅ Elementor bug fixing <br>✅ html css bug fixing <br>✅ Slider Revolution bug fixing <br>✅ Wordpress landing page <br>✅ Speed optimization <br>✅ Elementor landing page design <br>✅ Divi landing page design</p>
      <h1><a style="color: #fff;text-decoration:none" href="https://www.fiverr.com/coderboss">Hire me on Fiverr</a></h1>
    </div>
  </div>
<?php
}
