<?php

function post_form($user_id) {
  $obj = &get_instance();
  return array(
    'user_id' => $user_id,
    'date' => now(),
    'title' => $obj->input->post('title'),
    'teaser' => $obj->input->post('teaser'),
    'content' => $obj->input->post('content'),
  );
}

function post_form_validate() {
  $obj = &get_instance();
  $obj->form_validation->set_rules('title', 'Title', 'required');
  $obj->form_validation->set_rules('content', 'Content', 'required');
}

function get_posts() {
  $obj = &get_instance();
  return $obj->post_model->find_all();
}
