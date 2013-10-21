<?php
/*
 *
 * Template Name: Tab Page
 *
 */
$page_id = $post->ID;
get_header(); ?>

<div class="grey-back">
	<div id="main" class="wrapper">
		<div id="content">
			<h2><?php echo get_subtitle($page_id); ?></h2>
			<ul class="tabs">
				<?php $tabs = get_tabs_by_page(get_the_title()); ?>
				<?php if($tabs->have_posts()) : while($tabs->have_posts()) : $tabs->the_post() ?>
				<li>
					<a class="link-catch-all" data-tab="<?php echo $post->ID; ?>" data-name="<?php echo get_project_id($post->ID); ?>" data-id="<?php echo name_to_id(get_project_id($post->ID)); ?>"><?php echo get_tab_label($post->ID) != "" ? get_tab_label($post->ID) : get_project_id($post->ID) ?></a>
				</li>
				<?php endwhile; endif; ?>
			</ul>
		</div>
	</div>
</div>
<div style="overflow:hidden">
	<div class="green-line"></div>
	<div class="wrapper">
		<div>
			<?php if($tabs->have_posts()) : while($tabs->have_posts()) : $tabs->the_post() ?>
			<div class="tabs-catch-all" data-tab="<?php echo $post->ID; ?>">
				<h1 class="tab-title"><?php the_title(); ?>
					<?php if(get_the_number($post->ID)){ ?>
						<span class="call-direct">Call direct <a class="number" href="tel:<?php echo get_the_number($post->ID); ?>"><?php echo get_the_number($post->ID); ?></a><img class="phone" src="<?php bloginfo("stylesheet_directory"); ?>/img/phone.png"></span>
					<?php } ?>
				</h1>
				<div class="tab-inner">
					<?php the_content(); ?>
				</div>
			</div>
			<?php endwhile; endif; ?>
			<div class="content-sidebar">
				<?php echo get_content_by_ID($page_id); ?>		
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="tab-bottom">
		<div class="wrapper">
			<div class="tab-bottom-left">
				<h3>Other ways to get involved</h3>
				<?php echo get_call_to_action_buttons(get_the_title($page_id)); ?>
			</div>
			<div class="tab-bottom-right">
				<h3>Want to learn more?</h3>
				<a href="<?php echo get_permalink_from_page_name("Projects"); ?>" class="call-to-action no-hash">
					<span>Learn more about</span> 
					<span class="charityName">Impetus</span>
					<?php echo get_right_arrow_HTML(); ?>
				</a>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php get_footer(); ?>