<?php
/*
 * Template name: About
 * 
 */
get_header(); ?>
<div class="grey-back">
	<div class="wrapper" id="main">
		<div id="content">
			<h2><?php echo get_subtitle(get_the_ID()); ?></h2>
			<ul class="tabs">
				<?php $tabs = get_tabs_by_page(get_the_title()); ?>
				<?php if($tabs->have_posts()) : while($tabs->have_posts()) : $tabs->the_post() ?>
				<li>
					<a class="link-catch-all" data-tab="<?php echo $post->ID; ?>" data-name="<?php the_title(); ?>" data-id="<?php echo name_to_id(get_the_title()); ?>"><?php echo the_title(); ?></a>
				</li>
				<?php endwhile; endif; ?>
			</ul>
		</div>
	</div>
</div>
<div>
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
				<?php $layout = get_layout($post->ID); ?>
				<div class="tab-inner <?php echo $layout; ?>">
					<?php the_content(); ?>
				</div>
			</div>
			<?php endwhile; endif; ?>
			<div class="content-sidebar fr">
				<?php include('dynamic-sidebar.php'); ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="tab-bottom">
		<div class="wrapper">
			<div class="tab-bottom-left">
				<h3>Want to speak to us directly?</h3>
				<a href="<?php bloginfo("home"); ?>/contact" class="call-to-action no-change">Contact Us<?php echo get_right_arrow_HTML(); ?></a>
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