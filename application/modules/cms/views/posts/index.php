<h3>Posts</h3>
<p><?php echo anchor('posts/add', '<i class="fa fa-plus-circle" aria-hidden="true"></i> Add post', 'class="btn btn-sm btn-secondary"'); ?></p>
<table class="table">
  <tr>
    <th>Date</th>
    <th>Title</th>
    <th></th>
  </tr>
  <?php foreach ($posts as $post): ?>
    <tr>
      <td><?php echo date('M j', strtotime($post->date)); ?></td>
      <td><?php echo anchor('post/' . $post->id, $post->title); ?></td>
      <td>
        <?php echo anchor('posts/edit/' . $post->id, 'Edit'); ?>
        <a href='javascript:void(0);' onclick="deletePost('<?php echo $post->id; ?>', <?php echo $post->id; ?>);" title="Delete">Delete</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<script>
    var url = '<?php echo base_url(); ?>';
    function deletePost(name, id) {
      var c = confirm('Do you really want to delete ' + name + '?');
      if (c === true) {
        window.location = url + 'posts/delete/' + id;
      } else {
        return false;
      }
    }
</script>