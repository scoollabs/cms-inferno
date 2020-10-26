<h3>Links</h3>
<p><?php echo anchor('links/add', '<i class="fa fa-plus-circle" aria-hidden="true"></i> Add link', 'class="btn btn-sm btn-secondary"'); ?></p>
<table class="table">
  <tr>
    <th>Name</th>
    <th></th>
  </tr>
  <?php foreach ($links as $link): ?>
    <tr>
      <td><?php echo $link->name; ?></td>
      <td>
        <?php echo anchor('links/edit/' . $link->id, 'Edit'); ?>
        <a href='javascript:void(0);' onclick="deletelink('<?php echo $link->id; ?>', <?php echo $link->id; ?>);" title="Delete">Delete</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<script>
    var url = '<?php echo base_url(); ?>';
    function deletelink(name, id) {
      var c = confirm('Do you really want to delete ' + name + '?');
      if (c === true) {
        window.location = url + 'links/delete/' + id;
      } else {
        return false;
      }
    }
</script>