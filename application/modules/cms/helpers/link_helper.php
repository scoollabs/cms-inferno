<?php

function link_form() {
  $obj = &get_instance();
  return array(
    'name' => $obj->input->post('name'),
    'url' => $obj->input->post('url'),
    'page_id' => $obj->input->post('page_id'),
    'is_external' => $obj->input->post('is_external'),
  );
}

function link_form_validate() {
  $obj = &get_instance();
  $obj->form_validation->set_rules('name', 'Name', 'required');
  // $obj->form_validation->set_rules('url', 'URL', 'required');
}

function get_links() {
  $obj = &get_instance();
  $obj->load->model('link_model');
  return $obj->link_model->find_all();
}