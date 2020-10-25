<?php

class Cms extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('post_model');
    $this->load->model('post_comment_model');
    $this->load->model('page_model');
  }

  function install() {
  }

  function settings() {
    
  }

  function home() {
    load_view('home', null, 'layout', get_cms_theme());
  }

  function blog() {
    $data['posts'] = $this->post_model->find_all();
    load_view('blog', $data, 'layout', get_cms_theme());
  }

  function page($page_id) {
    $data['page'] = $this->page_model->read($page_id);
    load_view('page', $data, 'layout', get_cms_theme());
  }

  function post($post_id) {
    $post = $this->post_model->read($post_id);
    redirect_if(!$post, '.');
    $data['post'] = $post;
    load_view('post', $data, 'layout', get_cms_theme());
  }

  function leave_comment($post_id) {
    $comment = post_comment_form($post_id);
    $this->cms_model->save_post_comment($comment);
    redirect('post/' . $post_id);
  }

  function show_404() {
    load_view('404', null, 'layout', get_cms_theme());
  }

  // Admin functions
  function login() {
    $data['message'] = '';
    if ($this->input->post()) {
      list($username, $password) = login_form();
      $user = $this->user_model->read_by_username_and_password($username, $password);
      if ($user) {
        $this->session->set_userdata('user_id', $user->id);
        $this->session->set_userdata('username', $user->username);
        redirect('posts');
      } else {
        $data['message'] = 'Invalid username or password. Please try again!';
      }
    }
    $this->load->view('login', $data);
  }

  function logout() {
    $this->session->sess_destroy();
    redirect('login');
  }

  function posts() {
    $data['posts'] = $this->post_model->find_all();
    load_view('posts/index', $data, 'admin_layout', '');
  }

  function add_post() {
    if ($this->input->post()) {
      $post = post_form($this->session->userdata('user_id'));
      post_form_validate();
      if ($this->form_validation->run() != FALSE) {
        $this->post_model->save($post);
        redirect('posts');
      }
    }
    load_view('posts/add', null, 'admin_layout');
  }

  function edit_post($post_id) {
    if ($this->input->post()) {
      $post = post_form($this->session->userdata('user_id'));
      post_form_validate();
      if ($this->form_validation->run() != FALSE) {
        $this->post_model->update($post, $post_id);
        redirect('posts');
      }
    }
    $data['post'] = $this->post_model->read($post_id);
    load_view('posts/edit', $data, 'admin_layout', '');
  }

  function delete_post($post_id) {
    $this->post_model->delete($post_id);
    redirect('posts');
  }

  function pages() {
    $data['pages'] = $this->page_model->find_all();
    load_view('pages/index', $data, 'admin_layout');
  }

  function add_page() {
    if ($this->input->post()) {
      $page = page_form();
      page_form_validate();
      if ($this->form_validation->run() != FALSE) {
        $this->page_model->save($page);
        redirect('pages');
      }
    }
    load_view('pages/add', null, 'admin_layout', '');
  }

  function edit_page($page_id) {
    if ($this->input->post()) {
      $page = page_form();
      page_form_validate();
      if ($this->form_validation->run() != FALSE) {
        $this->page_model->update($page, $page_id);
        redirect('pages');
      }
    }
    $data['page'] = $this->page_model->read($page_id);
    load_view('pages/edit', $data, 'admin_layout');
  }

  function delete_page($page_id) {
    $this->page_model->delete($page_id);
    redirect('pages');
  }
}