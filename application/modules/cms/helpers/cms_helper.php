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