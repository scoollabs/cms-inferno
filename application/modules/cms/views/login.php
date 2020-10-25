<?php $this->load->view('_head'); ?>

<div class="login">
  <center>
    <?php echo img(array('src' => 'assets/cms/img/logo.png')); ?>
    <h3>Login</h3>
    <?php if ($message): ?>
      <p class="alert alert-warning"><?php echo $message; ?></p>
    <?php endif; ?>
  </center>
  <?php echo form_open('cms/login'); ?>
  <p>Username<br>
    <?php echo form_input('username', $this->input->post('username'), 'class="form-control"'); ?>
    <?php echo form_error('username'); ?>
  </p>
  <p>Password<br>
    <?php echo form_password('password', '', 'class="form-control"'); ?>
    <?php echo form_error('password'); ?>
  </p>
  <p>
    <?php echo form_submit('submit', 'Login', 'class="btn btn-secondary"'); ?>
    <?php echo anchor('cms/forgot', 'Forgot password?'); ?>
  </p>
  <?php echo form_close(); ?>
</div>