<?php

function redirect_if($condition, $url) {
  if ($condition) {
    redirect($url);
  }
}

function guid() {
  if (function_exists('com_create_guid') === true) {
    return trim(com_create_guid(), '{}');
  }

  return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function get_app_version() {
  $line = fgets(fopen(FCPATH . '/changelog.txt', 'r'));
  return $line;
}

function email_send($from, $to, $subject, $message) {
  if ($from && $to) {
    $obj = &get_instance();
    $obj->load->library('email');

    $obj->email->from($from, '');
    $obj->email->to($to);

    $obj->email->subject($subject);
    $obj->email->message($message);

    $obj->email->send();
  }
}

function upload_config() {
  return array(
    'upload_path' => './uploads',
    'allowed_types' => 'gif|jpg|jpeg|png',
    'max_size' => 2014,
    'max_width' => 2048,
    'max_height' => 2048,
  );
}

function http_get_contents($url) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $contents = curl_exec($ch);
  if (curl_errno($ch)) {
//    echo curl_error($ch);
//    echo "\n<br />";
    $contents = '';
  } else {
    curl_close($ch);
  }

  if (!is_string($contents) || !strlen($contents)) {
//    echo "Failed to get contents.";
    $contents = '';
  }

  return $contents;
}

function session($key, $value = '') {
  $obj = &get_instance();
  if ($value) {
    $obj->session->set_userdata($key, $value);
  }
  return $obj->session->userdata($key);
}

function print_pre($text) {
  echo '<pre>';
  print_r($text);
  echo '</pre>';
}

function trimmed_base_url() {
  return trim(base_url(), '/');
}

function api_get($url, $data) {
  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, $url . '?' . http_build_query($data));
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($curl, CURLOPT_HTTPGET, 1);

  $output = curl_exec($curl);

  curl_close($curl);
  return $output;
}

function api_post($url, $data) {
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $output = curl_exec($ch);

  curl_close($ch);
  return $output;
}