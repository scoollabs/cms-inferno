<?php

class Link_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function find_all() {
    return $this->db->get('links')->result();
  }

  function read($id) {
    return $this->db->get_where('links', array('id' => $id))->row();
  }

  function save($link) {
    $this->db->insert('links', $link);
  }

  function update($link, $id) {
    $this->db->update('links', $link, array('id' => $id));
  }

  function delete($id) {
    $this->db->delete('paglinkses', array('id' => $id));
  }
}