<?php

class Page_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function find_all() {
    return $this->db->get('pages')->result();
  }

  function read($id) {
    return $this->db->get_where('pages', array('id' => $id))->row();
  }

  function save($page) {
    $this->db->insert('pages', $page);
  }

  function update($page, $id) {
    $this->db->update('pages', $page, array('id' => $id));
  }

  function delete($id) {
    $this->db->delete('pages', array('id' => $id));
  }

}
