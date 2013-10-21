<?php

get_header(); ?>
<div class="wrapper">
	<h1 class="tab-title"><?php the_title(); ?></h1>
	<div class="posts-left">
		<div class="post-image">
			<?php the_post_thumbnail(); ?>
			<div class="image-overlay">
				<div class="image-overlay-inner">
					<div class="image-overlay-inner-inner">
						<?php the_excerpt(); ?>
					</div>
				</div>
			</div>
		</div>
		<?php the_content(); ?>
	</div>
	<?php $terms = array_shift(get_the_terms(get_the_ID(), "story_project"));
	$project = str_replace("Story ", "", $terms->name); ?>
	<div id="sidebar" class="no-head">
		<a href="<?php echo get_permalink_from_page_name("Projects") . name_to_id($project) . "/#stories" ?>" class="call-to-action left-arrow">
			View All <?php echo $project ?> Stories
			<img src="<?php bloginfo("stylesheet_directory"); ?>/img/arrow-left.png" />
		</a>
	</div>
	<div class="clear"></div>
</div>
<div class="tab-bottom">
	<div class="wrapper">
		<h3><img class="rss" src="<?php bloginfo("stylesheet_directory"); ?>/img/rss-alt.png" />Latest News about <?php echo $project; ?></h3>
		<?php $footer_posts = get_featured_post_by_cat($project);
		if($footer_posts->have_posts()) : while($footer_posts->have_posts()) : $footer_posts->the_post(); ?>
			<div class="tab-bottom-left">
			
			<h6><?php the_title(); ?></h6>
			<em>Posted on 
				<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>">
					<?php the_time('jS F Y'); ?>
				</a> 
				by <?php the_author_posts_link( ); ?>
			</em>
			
		</div>
		<div class="tab-bottom-right">
			<a class="call-to-action no-change bigger fr" href="<?php the_permalink(); ?>">Read more
				<?php echo get_right_arrow_html(); ?>
			</a>
		</div>
		<div class="clear"></div>
		<?php endwhile; endif; ?>
	</div>
</div>
<?php get_footer(); ?>