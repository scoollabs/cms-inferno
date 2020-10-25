<?php

function page_form() {
  $obj = &get_instance();
  return array(
    'title' => $obj->input->post('title'),
    'teaser' => $obj->input->post('teaser'),
    'content' => $obj->input->post('content'),
  );
}

function page_form_validate() {
  $obj = &get_instance();
  $obj->form_validation->set_rules('title', 'Title', 'required');
  $obj->form_validation->set_rules('content', 'Content', 'required');
}

function get_pages() {
  $obj = &get_instance();
  return $obj->page_model->find_all();
}

function section($page) {
  $obj = &get_instance();
  $obj->load->view('themes/' . config_item('cms_theme') . '/' . $page);
}

function load_view($view, $data, $layout = 'layout', $theme = '') {
  $obj = &get_instance();
  $data['content'] = $obj->load->view($theme . '/' . $view, $data, TRUE);
  $obj->load->view($theme . '/' . $layout, $data);
}

function get_cms_theme() {
  return 'themes/' . config_item('cms_theme');
}
