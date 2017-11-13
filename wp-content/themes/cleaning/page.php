<?php wp_get_header(); ?>
			<?php get_sidebar('top'); ?>

<div class="art-content-layout">
    <div class="art-content-layout-row">
		<div class="art-layout-cell art-sidebar1">
          <?php get_sidebar('default'); ?>
          <div class="cleared"></div>
        </div>
                <div class="art-layout-cell art-content">
			<?php 
				if(have_posts()) {
					
					/* Start the Loop */ 
					while (have_posts()) {
						the_post();
						get_template_part('content', 'page');
						comments_template();
					}

				} else {
				
					 theme_404_content();
					 
				} 
		    ?>
			<?php get_sidebar('bottom'); ?>
          <div class="cleared"></div>
        </div>
    </div>
</div>
<div class="cleared"></div>
<?php wp_get_footer(); ?>