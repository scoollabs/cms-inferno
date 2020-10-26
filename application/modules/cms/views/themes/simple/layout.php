<style>
  footer {
    margin: 100px 0 50px;
  }

  nav a {
    margin-right: 10px;
  }
</style>

<h1>CMS Inferno</h1>

<nav>
  <?php echo anchor('.', 'Home'); ?>
  <?php echo anchor('blog', 'Blog'); ?>
  <?php foreach (get_links() as $link): ?>
    <?php echo anchor($link->url, $link->name); ?>
  <?php endforeach; ?>
</nav>

<?php foreach (array() as $nav) : ?>
<?php endforeach; ?>

<?php echo $content; ?>

<footer>
  <hr>
  &copy; <?php echo date('Y'); ?>. All rights reserved.

  <p>
    <?php echo anchor('cms/login', 'Login'); ?>
  </p>
</footer>