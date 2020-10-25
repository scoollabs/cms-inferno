<?php

class Post_comment_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function find_by_post($post_id) {
    return $this->db->get_where('post_comments', array('post_id' => $post_id))->result();
  }

}
