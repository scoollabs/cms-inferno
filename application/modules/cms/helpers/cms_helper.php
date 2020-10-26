<?php

function login_form() {
  $obj = &get_instance();
  return array(
    $obj->input->post('username'),
    $obj->input->post('password'),
  );
}

function redirect_if($condition, $url) {
  if ($condition) {
    redirect($url);
  }
}

function print_pre($text) {
  echo '<pre>';
  print_r($text);
  echo '</pre>';
}

function session($key, $value = '') {
  $obj = &get_instance();
  if ($value) {
    $obj->session->set_userdata($key, $value);
  }
  return $obj->session->userdata($key);
}

function theme_path() {
  $obj = &get_instance();
  return trimmed_base_url() . '/application/views/' . $obj->layout->get_theme();
}

define('DEFAULT_DATE_FORMAT', 'Y-m-d H:i:s');

function now() {
  $date = new DateTime();
  return $date->format(DEFAULT_DATE_FORMAT);
}

function month() {
  $month = date('m', strtotime(now()));
  return $month;
}

function year() {
  $year = date('Y', strtotime(now()));
  return $year;
}

function get_theme() {
  $obj = &get_instance();
  $obj->load->library('layout');
  return $obj->layout->get_theme();
}

function section($page) {
  $obj = &get_instance();
  $obj->load->view('themes/' . config_item('cms_theme') . '/' . $page);
}

function load_view($view, $data = null) {
  $obj = &get_instance();
  $theme = config_item('theme');
  $theme = $theme ? $theme : 'simple';
  $data['content'] = $obj->load->view('themes/' . $theme . '/' . $view, $data, TRUE);
  $obj->load->view('themes/' . $theme . '/layout', $data);
}

function load_admin_view($view, $data = null) {
  $obj = &get_instance();
  $data['content'] = $obj->load->view($view, $data, TRUE);
  $obj->load->view('admin_layout', $data);
}

function get_cms_theme() {
  return 'themes/' . config_item('cms_theme');
}
