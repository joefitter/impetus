<?php
/*
 * Template for displaying single
 * Impetus projects
 */
$page_title = get_the_title();
get_header(); ?>
<div class="tab-bottom top">
	<div class="wrapper">
		<div class="tab-bottom-left half">
			<h3><?php echo get_post_meta($post->ID, "call_to_action_left", true); ?></h3>
			<?php if($post->ID == 134){ ?>>
				<a class="number orange bold" style="margin-left:0;" href="tel:01273229002">01273 229 002 <img class="phone-link" src="<?php bloginfo("stylesheet_directory"); ?>/img/phone-orange.png"></a>
			<?php } else { ?>
			<?php if($post->ID != 1637){ ?>
			<a href="<?php echo get_permalink_from_page_name("Get Support") . "#" . name_to_id(get_the_title()); ?>" class="call-to-action no-change">
				<span>Get support from</span> 
				<span><?php the_title(); ?></span>
				<img src="<?php bloginfo("stylesheet_directory"); ?>/img/arrow-right.png"/>
			</a>
			<?php } ?>
			<?php } ?>
			<div class="clear"></div>
		</div>
		<div class="tab-bottom-right half">

			<h3><?php echo get_post_meta($post->ID, "call_to_action_right", true); ?></h3>
			<?php if($post->ID == 134){ ?>
				<a href="/wp-content/uploads/2013/11/ICAS-leaflet-FINAL.pdf" target="_blank" class="call-to-action no-change">
					<span>ICAS Leaflet</span>
					<?php echo get_right_arrow_html(); ?>
				</a>
				<a href="http://www.sussexinterpreting.org.uk/resources.asp" target="_blank" class="call-to-action no-change">
					<span>More languages</span>
					<?php echo get_right_arrow_html(); ?>
				</a>
			<?php } else { ?>
			<?php if($post->ID != 1637){ ?>
			<a href="<?php echo get_permalink_from_page_name("Volunteer") . "#" . name_to_id(get_the_title()); ?>" class="call-to-action no-change">
				<span>Volunteer to help</span>
				<?php echo get_right_arrow_html(); ?>
			</a>
			<?php } ?>
			<?php if($post->ID != 1637){ ?>
			<a href="<?php echo get_permalink_from_page_name("Donate") . "#" . name_to_id(get_the_title()); ?>" class="call-to-action no-change">
				<span>Donate to</span> 
				<span><?php the_title(); ?></span>
				<?php echo get_right_arrow_html(); ?>
			</a>
			<?php } ?>
			<?php } ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="grey-back" id="tabs-top">
	<div class="wrapper" id="main">
		<div>
			<ul class="tabs">
				<?php $tabs = get_tabs_by_page(get_the_title() . " Project"); ?>
				<?php if($tabs->have_posts()) : while($tabs->have_posts()) : $tabs->the_post() ?>
				<li>
					<a class="link-catch-all" data-tab="<?php echo $post->ID; ?>" data-name="<?php the_title(); ?>" data-id="<?php echo name_to_id(get_the_title()); ?>"><?php echo get_tab_label($post->ID) != "" ? get_tab_label($post->ID) : get_the_title() ?></a>
				</li>
				<?php endwhile; endif; ?>
			</ul>
		</div>
	</div>
</div>
<div id="content">
	<div class="green-line"></div>
	<div class="wrapper">
		<div id="tab-holder">
			<?php if($tabs->have_posts()) : while($tabs->have_posts()) : $tabs->the_post() ?>
			<div class="tabs-catch-all" data-tab="<?php echo $post->ID; ?>">
				<h1 class="tab-title"><?php the_title(); ?>
					<?php if(get_the_number($post->ID)){ ?>
						<span class="call-direct">Call direct <a class="number" href="tel:<?php echo get_the_number($post->ID); ?>"><?php echo get_the_number($post->ID); ?></a><img class="phone" src="<?php bloginfo("stylesheet_directory"); ?>/img/phone.png"></span>
					<?php } ?>
				</h1>
				<?php $layout = get_layout($post->ID); ?>
				<div class="tab-inner <?php echo $layout; ?>">
					<?php the_content(); ?>
				</div>
			</div>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); wp_reset_query(); rewind_posts(); ?>
			<div class="content-sidebar fr">
				<?php include("dynamic-sidebar.php"); ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
	<?php $footer_posts = get_featured_post_by_cat(get_the_title());
			if($footer_posts->have_posts()) : while($footer_posts->have_posts()) : $footer_posts->the_post(); ?>
	<div class="tab-bottom">
		<div class="wrapper">
			<h3><img class="rss" src="<?php bloginfo("stylesheet_directory"); ?>/img/rss-alt.png" />Latest News about <?php echo $page_title ?></h3>
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
			
		</div>
	</div>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>