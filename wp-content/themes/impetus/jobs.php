<?php
/*
 *
 * Template name: Jobs
 *
 */
get_header(); ?>

<div id="projects-top">
	<div class="wrapper">
		<h1 class="projects-title orange">Jobs at Impetus</h1>
		<p class="projects-strapline">We are currently hiring. View vacancies and download an application form below.</p>
	</div>
</div>
<div class="green-line"></div>
<div class="wrapper">
	<a href="#" class="show-jobs">View Current Vacancies</a>
	<div class="content-sidebar" id="jobs-sidebar">
		<h2>Current Vacancies</h2>
		<ul class="job-tabs">
			<?php $jobs = get_posts_by_type("job", "DESC"); ?>
			<?php if($jobs->have_posts()) : while($jobs->have_posts()) : $jobs->the_post(); ?>
				<li>
					<a href="#" class="job-teaser" data-id="<?php echo name_to_id(get_the_title()); ?>" data-tab="<?php the_ID(); ?>" data-name="<?php the_title(); ?>"><?php the_title(); ?></a>
				</li>
			<?php endwhile; endif; ?>
		</ul>
	</div>
	<?php if($jobs->have_posts()) : while($jobs->have_posts()) : $jobs->the_post(); ?>
		<div class="tabs-catch-all" data-tab="<?php the_ID(); ?>">
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
				<?php if(get_post_meta($post->ID, "_job_salary", true)){ ?>
					<h5>Salary</h5>
					<p><?php echo get_post_meta($post->ID, "_job_salary", true); ?></p>
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
					<p>You can also request an Application Packs by telephone; please leave a message on 01273 229381 stating clearly your name, contact number and address.</p>
				<?php } ?>
			</div>
		</div>
	<?php endwhile; endif; ?>
	
	<div class="clear"></div>
</div>

<div class="tab-bottom">
	<div class="wrapper">
		<div class="tab-bottom-left">
			<h3>Looking for unpaid volunteer work?</h3>
			<a href="<?php echo get_permalink_from_page_name("Volunteer"); ?>" class="call-to-action no-change">
				<span>View available volunteer positions</span>
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