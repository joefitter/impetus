<?php
get_header(); ?>
<div id="projects-top">
	<div class="wrapper">
		<div class="blog-header-left">
			<h1 class="projects-title orange">Impetus Blog</h1>
			<p class="projects-strapline">Real people. Real issues.</p>
		</div>
		<img class="blog-img" src="<?php bloginfo("stylesheet_directory"); ?>/img/blog.png" />
		<div class="blog-header-right">
			<h3>Follow our updates</h3>
			<a href="<?php bloginfo('rss2_url'); ?>" class="call-to-action no-hash rss">
				<span>Subscribe to blog by RSS</span>
				<img class="icon" src="<?php bloginfo("stylesheet_directory"); ?>/img/rss.png" />
			</a>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="green-line"></div>
<div class="wrapper" id="content">
	<div class="posts-left">
		<h2>
		<?php if(is_category()){
			single_cat_title();
		} else if(is_tag()){
			single_tag_title();
		} ?>
		<?php if ( is_month() ){ $this_header = "Monthly archives for " . get_the_date('F, Y'); }
else if ( is_year() ){ $this_header = "Yearly archives for " . get_the_date('Y'); }
else { $this_header = "Archives"; } ?>
		<?php echo $this_header; ?>
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	</h2>
			<div class="post-snippet">
				<a class="no-hover-underline" href="<?php the_permalink(); ?>"><h2 class="post-title"><?php the_title(); ?></h2></a>
				<em>Posted on 
					<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>">
						<?php the_time('jS F Y'); ?>
					</a> 
					by <?php the_author_posts_link( ); ?>
				</em>
				<?php the_content("Continue reading..."); ?>
				<div class="clear"></div>
			</div>

		<?php endwhile; endif; ?>
		<div class="pagination-links">
			<?php global $wp_query;

			$big = 999999999;

			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages
			) ); ?>
		</div>
	</div>
	<div id="sidebar">
		<?php get_sidebar(); ?>
	</div>
	<div class="clear"></div>
</div>
<div class="tab-bottom">
	<div class="wrapper">
		<div class="tab-bottom-left">
			<h3>Want to speak to us directly?</h3>
			<a href="#" class="call-to-action">Contact Us<?php echo get_right_arrow_HTML(); ?></a>
			<a class="number orange bold" href="tel:01273775888">01273 775 888 <img class="phone-link" src="<?php bloginfo("stylesheet_directory");?>/img/phone-orange.png" /></a>
			<div class="clear"></div>
			
		</div>
		<div class="tab-bottom-right half">
			<h3>Understand our projects</h3>
			<a href="<?php echo get_permalink_from_page_name("Projects"); ?>" class="call-to-action no-change">
				<span>Learn more about Impetus projects</span>
				<?php echo get_right_arrow_HTML(); ?>
			</a>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php get_footer(); ?>