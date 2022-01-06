<?php
add_action('cmb2_init', 'cmb_box01');
function cmb_box01() {
  $ls_dg = new_cmb2_box(['title' => 'Designation', 'id' => 'pp_fd', 'object_types' => 'lsts_post_type']);
  $ls_dg->add_field(['name' => 'Degree', 'id' => 'ls_nm', 'type' => 'text']);
  $ls_dg->add_field(['name' => 'Profession', 'id' => 'ls_pf', 'type' => 'text']);
  $ls_dg->add_field(['name' => 'Rating', 'id' => 'ls_rt', 'type' => 'text']);
}
