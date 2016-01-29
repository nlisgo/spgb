<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php if ($title_prefix || $title_suffix || $display_submitted || !$page): ?>
  <header>
    <?php print render($title_prefix); ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?> class="title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    
    <?php print $user_picture; ?>
    
    <?php if ($display_submitted): ?>
      <div class="node-info">
        <?php print $submitted; ?>
      </div>
    <?php endif; ?>

  </header>
  <?php endif; ?>

  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>
  
  <?php if ($links = render($content['links'])): ?>
  <footer>
  <?php print render($content['links']); ?>
  </footer>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

</article>
