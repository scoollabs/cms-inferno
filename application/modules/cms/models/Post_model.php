<?php

class Post_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function find_all() {
    $this->db->select('p.*');
    $this->db->select('u.username');
    $this->db->join('users u', 'u.id = p.user_id');
    $this->db->order_by('p.date', 'desc');
    return $this->db->get('posts p')->result();
  }

  function read($id) {
    $this->db->select('p.*');
    $this->db->select('u.username');
    $this->db->join('users u', 'u.id = p.user_id');
    return $this->db->get_where('posts p', array('p.id' => $id))->row();
  }

  function read_by_title($title) {
    $this->db->select('p.*');
    $this->db->select('u.username');
    $this->db->join('users u', 'u.id = p.user_id');
    return $this->db->get_where('posts p', array('p.title' => $title))->row();
  }

  function save($post) {
    $this->db->insert('posts', $post);
  }

  function update($post, $id) {
    $this->db->update('posts', $post, array('id' => $id));
  }

  function delete($id) {
    $this->db->delete('posts', array('id' => $id));
  }

}
