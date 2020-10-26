<?php

class Cms extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('post_model');
    $this->load->model('post_comment_model');
    $this->load->model('page_model');
    $this->load->model('link_model');
  }

  function install() {

  }

  function home() {
    load_view('home');
  }

  function blog() {
    $data['posts'] = $this->post_model->find_all();
    load_view('blog', $data);
  }

  function page($page_id) {
    $data['page'] = $this->page_model->read($page_id);
    load_view('page', $data);
  }

  function post($post_id) {
    $post = $this->post_model->read($post_id);
    redirect_if(!$post, '.');
    $data['post'] = $post;
    load_view('post', $data);
  }

  function leave_comment($post_id) {
    $comment = post_comment_form($post_id);
    $this->cms_model->save_post_comment($comment);
    redirect('post/' . $post_id);
  }

  function show_404() {
    load_view('404');
  }

  // Admin functions
  function login() {
    redirect_if(session('user_id'), 'posts');

    $data['message'] = '';
    if ($this->input->post()) {
      list($username, $password) = login_form();
      $user = $this->user_model->read_by_username_and_password($username, $password);
      if ($user) {
        session('user_id', $user->id);
        session('username', $user->username);
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

  function settings() {
    redirect_if(!session('user_id'), 'login');
    load_admin_view('settings');
  }

  function posts() {
    redirect_if(!session('user_id'), 'login');
    $data['posts'] = $this->post_model->find_all();
    load_admin_view('posts/index', $data);
  }

  function add_post() {
    redirect_if(!session('user_id'), 'login');
    if ($this->input->post()) {
      $post = post_form($this->session->userdata('user_id'));
      print_pre($post);
      post_form_validate();
      if ($this->form_validation->run() != FALSE) {
        $this->post_model->save($post);
        redirect('posts');
      }
    }
    load_admin_view('posts/add', null);
  }

  function edit_post($post_id) {
    redirect_if(!session('user_id'), 'login');
    if ($this->input->post()) {
      $post = post_form($this->session->userdata('user_id'));
      post_form_validate();
      if ($this->form_validation->run() != FALSE) {
        $this->post_model->update($post, $post_id);
        redirect('posts');
      }
    }
    $data['post'] = $this->post_model->read($post_id);
    load_admin_view('posts/edit', $data);
  }

  function delete_post($post_id) {
    redirect_if(!session('user_id'), 'login');
    $this->post_model->delete($post_id);
    redirect('posts');
  }

  function pages() {
    redirect_if(!session('user_id'), 'login');
    $data['pages'] = $this->page_model->find_all();
    load_admin_view('pages/index', $data);
  }

  function add_page() {
    redirect_if(!session('user_id'), 'login');
    if ($this->input->post()) {
      $page = page_form();
      page_form_validate();
      if ($this->form_validation->run() != FALSE) {
        $this->page_model->save($page);
        redirect('pages');
      }
    }
    load_admin_view('pages/add');
  }

  function edit_page($page_id) {
    redirect_if(!session('user_id'), 'login');
    if ($this->input->post()) {
      $page = page_form();
      page_form_validate();
      if ($this->form_validation->run() != FALSE) {
        $this->page_model->update($page, $page_id);
        redirect('pages');
      }
    }
    $data['page'] = $this->page_model->read($page_id);
    load_admin_view('pages/edit', $data);
  }

  function delete_page($page_id) {
    redirect_if(!session('user_id'), 'login');
    $this->page_model->delete($page_id);
    redirect('pages');
  }

  function links() {
    redirect_if(!session('user_id'), 'login');
    $data['links'] = $this->link_model->find_all();
    load_admin_view('links/index', $data);
  }

  function add_link() {
    redirect_if(!session('user_id'), 'login');
    if ($this->input->post()) {
      $link = link_form();
      link_form_validate();
      if ($this->form_validation->run() != FALSE) {
        $this->link_model->save($link);
        redirect('links');
      }
    }
    $data['pages'] = $this->page_model->find_all_for_dropdown();
    load_admin_view('links/add', $data);
  }

  function edit_link($link_id) {
    redirect_if(!session('user_id'), 'login');
    if ($this->input->post()) {
      $link = link_form();
      link_form_validate();
      if ($this->form_validation->run() != FALSE) {
        $this->link_model->update($link, $link_id);
        redirect('links');
      }
    }
    $data['link'] = $this->link_model->read($link_id);
    $data['pages'] = $this->page_model->find_all_for_dropdown();
    load_admin_view('links/edit', $data);
  }

  function delete_link($link_id) {
    redirect_if(!session('user_id'), 'login');
    $this->link_model->delete($link_id);
    redirect('links');
  }

  function init() {
    $user = array('username' => 'a', 'password' => password_hash('a', PASSWORD_DEFAULT));
    $this->user_model->save($user);
  }
}