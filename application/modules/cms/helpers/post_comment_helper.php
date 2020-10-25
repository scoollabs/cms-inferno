<?php

function post_comment_form($post_id) {
  $obj = &get_instance();
  return array(
    'post_id' => $post_id,
    'date' => now(),
    'name' => $obj->input->post('name'),
    'email' => $obj->input->post('email'),
    'comments' => $obj->input->post('comments'),
  );
}

function get_post_comments($post_id) {
  $obj = &get_instance();
  return $obj->post_comment_model->find_by_post($post_id);
}
