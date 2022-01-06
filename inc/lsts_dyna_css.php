<?php

/**
 * Add some dynamic style for this plugin
 */

$item01 = get_option('item01');
$item02 = get_option('item02');

?>
<style>
  .testimonial .title {
    font-size: 16px;
    font-weight: 700;
    color: <?php if (!empty($item01)) echo esc_html($item01);
            else echo "#eabd44" ?>;
    text-transform: uppercase;
    margin: 0 0 10px 0;
  }

  .testimonial .post {
    font-size: 14px;
    color: <?php if (!empty($item01)) echo esc_html($item01);
            else echo "#eabd44" ?>;
    text-transform: capitalize;
  }

  .owl-theme .owl-controls .owl-buttons div:hover {
    background: <?php if (!empty($item01)) echo esc_html($item01);
                else echo "#eabd44" ?>;
    border-color: <?php if (!empty($item01)) echo esc_html($item01);
                  else echo "#eabd44" ?>;
  }

  .fa-star:before {
    color: <?php if (!empty($item01)) echo esc_html($item01);
            else echo "#eabd44" ?>;
  }

  /* hover css in dynamic */
  .testimonial:hover {
    border-color: <?php if (!empty($item02)) echo esc_html($item02);
                  else echo "#2d81c8" ?>;
  }

  .testimonial:hover .testimonial-content {
    border-color: <?php if (!empty($item02)) echo esc_html($item02);
                  else echo "#2d81c8" ?>;
  }

  .testimonial .testimonial-content:after {
    content: '';
    width: 100%;
    height: 0;
    background: <?php if (!empty($item02)) echo esc_html($item02);
                else echo "#2d81c8" ?>;
    position: absolute;
    bottom: 0;
    left: 0;
    z-index: -1;
    transition: all 0.7s ease 0s;
  }

  .testimonial:hover .pic {
    background: <?php if (!empty($item02)) echo esc_html($item02);
                else echo "#2d81c8" ?>;
  }
</style>