<?php $this->load->view('_head'); ?>

<div class="container">
  <?php echo img(array('src' => 'assets/cms/img/logo.png', 'width' => 42)); ?>
  <nav>
    <?php echo anchor('posts', '<i class="fa fa-clipboard" aria-hidden="true"></i> Posts'); ?>
    <?php echo anchor('pages', '<i class="fa fa-pagelines" aria-hidden="true"></i> Pages'); ?>
    <?php echo anchor('links', '<i class="fa fa-pagelines" aria-hidden="true"></i> Links'); ?>
    <?php echo anchor('logout', '<i class="fa fa-sign-out" aria-hidden="true"></i> Log out'); ?>
    <?php echo anchor('.', '<i class="fa fa-chrome" aria-hidden="true"></i> My Site', 'target="_blank"'); ?>
  </nav>

  <?php echo $content; ?>
  
</div>