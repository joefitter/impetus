<?php

get_header(); ?>

<div id="projects-top">
	<div class="wrapper">
		<h1 class="projects-title orange">Volunteer at Impetus</h1>
		<p class="projects-strapline">View volunteer vacancies and download an application form below.</p>
	</div>
</div>
<div class="green-line"></div>
<div class="wrapper" id="content">
	<a href="#" class="show-jobs">View Current Vacancies</a>
	<div class="content-sidebar" id="jobs-sidebar">
		<h2>Current Vacancies</h2>
		<ul class="job-tabs">
			<?php $vacancies = get_posts_by_type("volunteer", "DESC"); ?>
			<?php if($vacancies->have_posts()) : while($vacancies->have_posts()) : $vacancies->the_post(); ?>
				<li>
					<a href="<?php the_permalink(); ?>" class="job-teaser" data-id="<?php echo name_to_id(get_the_title()); ?>" data-tab="<?php the_ID(); ?>" data-name="<?php the_title(); ?>"><?php the_title(); ?></a>
				</li>
			<?php endwhile; endif; ?>
		</ul>
	</div>
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<div data-tab="<?php the_ID(); ?>">
			<div class="tab-inner job-tab">
				<div class="job-teaser title">
					<h3><?php the_title(); ?></h3>
				</div>
				<h5>Job Description</h5>
				<?php the_content(); ?>
				<?php if(get_post_meta($post->ID, "_job_hours", true)){ ?>
					<h5>Hours</h5>
					<p><?php echo get_post_meta($post->ID, "_job_hours", true); ?></p>
				<?php } ?>
				
				<?php if(get_post_meta($post->ID, "_job_status", true)){ ?>
					<h5>Status</h5>
					<p><?php echo get_post_meta($post->ID, "_job_status", true); ?></p>
				<?php } ?>
				<?php if(get_post_meta($post->ID, "_job_closing_date", true)){ ?>
					<h5>Closing date for applications</h5>
					<p><?php echo get_post_meta($post->ID, "_job_closing_date", true); ?></p>
				<?php } ?>
				<?php if(get_post_meta($post->ID, "_job_interviews", true)){ ?>
					<h5>Interviews</h5>
					<p><?php echo get_post_meta($post->ID, "_job_interviews", true); ?></p>
				<?php } ?>
				<?php if(get_post_meta(get_the_ID(), 'wp_custom_attachment', true)){ ?>
					<?php $file = get_post_meta(get_the_ID(), 'wp_custom_attachment', true); ?>
					<h2>Interested in this vacancy?</h2>
					<a class="btn-large download" href="<?php echo  $file["url"]; ?>">
						Download Application Pack
						<img class="icon" src="<?php bloginfo( "stylesheet_directory" ); ?>/img/download.png" />
					</a>
					<p><?php echo get_post_meta($post->ID, '_job_footer', true); ?></p>
				<?php } else { ?>
					<h3>Get in Touch</h3>
					<?php echo do_shortcode('[contact-form-7 id="69" title="Volunteer Form"]'); ?>
				<?php } ?>
			</div>
		</div>
	<?php endwhile; endif; ?>
	
	<div class="clear"></div>
</div>

<div class="tab-bottom">
	<div class="wrapper">
		<div class="tab-bottom-left">
			<h3>Looking for paid positions?</h3>
			<a href="<?php echo get_permalink_from_page_name("Jobs"); ?>" class="call-to-action no-change">
				<span>View available jobs</span>
				<?php echo get_right_arrow_HTML(); ?>
			</a>
		</div>
		<div class="tab-bottom-right half">
			<h3>Need further information?</h3>
			<a href="#" class="call-to-action">Contact Us<?php echo get_right_arrow_HTML(); ?></a>
			<a class="number orange bold" href="tel:01273775888">01273 775 888 <img class="phone-link" src="<?php bloginfo("stylesheet_directory");?>/img/phone-orange.png" /></a>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>