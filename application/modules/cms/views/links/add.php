<h3>Add link</h3>
<?php echo form_open('links/add'); ?>
<p>Title<br>
  <?php echo form_input('name', $this->input->post('name'), 'class="form-control form-control-sm"'); ?>
  <?php echo form_error('name'); ?>
</p>
<p id="pages">Pages<br>
  <?php echo form_dropdown('page_id', $pages, $this->input->post('page_id'), 'class="form-control form-control-sm"'); ?>
  <?php echo form_error('page_id'); ?>
</p>
<p id="external-url" class="hidden">URL<br>
  <?php echo form_input('url', $this->input->post('url'), 'class="form-control form-control-sm"'); ?>
  <?php echo form_error('url'); ?>
</p>
<p>
  <label>
    <input type="checkbox" id="is-external" name="is_external" value="1">
    External
  </label>
</p>
<p>
  <?php echo form_submit('submit', 'Save changes', 'class="btn btn-sm btn-secondary"'); ?>
  or <?php echo anchor('links', 'cancel'); ?>
</p>
<?php echo form_close(); ?>

<style>
  .hidden {
    display: none;
  }
  </style>
<script>
  $(function() {
    $('#is-external').change(function() {
      var external = $(this).is(':checked');
      if (external) {
        $('#pages').hide();
        $('#external-url').show();
      } else {
        $('#pages').show();
        $('#external-url').hide();
      }
    });
  });
</script>