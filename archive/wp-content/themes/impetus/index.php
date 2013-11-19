<?php
get_header(); ?>
<div id="projects-top">
    <div class="wrapper">
        <div class="accessibility-top">
            <h1 class="projects-title orange"><?php the_title(); ?></h1>
            <p class="projects-strapline"><?php echo get_subtitle(get_the_ID()); ?></p>
        </div>
    </div>
</div>
<div class="green-line"></div>
<div class="wrapper">
	<div id="content">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; else: ?>
			<p>Sorry, no posts found</p>
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>