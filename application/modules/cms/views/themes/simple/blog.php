<h2>Blog</h2>
<?php foreach (get_posts() as $post): ?>
  <h3><?php echo $post->title; ?></h3>
  <small><?php echo $post->date; ?></small>
  <?php echo $post->teaser; ?>
  <p><?php echo anchor('post/' . $post->id, 'Read more'); ?>
<?php endforeach; ?>