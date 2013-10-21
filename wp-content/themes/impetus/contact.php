<?php
/*
 *
 * Template name: Contact
 *
 */

get_header(); ?>
<div id="projects-top">
	<div class="wrapper">
		<div class="contact-top">
			<h1 class="projects-title orange">Contact Impetus</h1>
			<p class="projects-strapline">For all general enquiries please fill out the form below.</p>
		</div>
	</div>
</div>
<div class="green-line"></div>
<div class="wrapper">
	<div id="contact-page">
		<div class="content-sidebar contact">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; endif; ?>
		</div>
		<div class="tab-inner">
			<div id="map">
				<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Brighton+%26+Hove+Impetus,+Western+Road,+Hove&amp;sll=50.826467,-0.161254&amp;sspn=0.006269,0.016512&amp;ie=UTF8&amp;hq=&amp;hnear=&amp;ll=50.826262,-0.162345&amp;spn=0.006295,0.006295&amp;t=m&amp;output=embed"></iframe><br /><small><a href="https://maps.google.co.uk/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Brighton+%26+Hove+Impetus,+Western+Road,+Hove&amp;sll=50.826467,-0.161254&amp;sspn=0.006269,0.016512&amp;ie=UTF8&amp;hq=&amp;hnear=&amp;ll=50.826262,-0.162345&amp;spn=0.006295,0.006295&amp;t=m" style="color:#0000FF;text-align:left">View Larger Map</a></small> <br /><br />1st Floor Intergen House <br />65-67 Western Road <br />Hove <br />BN3 2JQ
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="tab-bottom">
	<div class="wrapper">
		<div class="tab-bottom-left">
			<h3>Want to speak to us on the phone?</h3>
			<a class="number orange bold" href="tel:01273775888">01273 775 888 <img class="phone-link" src="<?php bloginfo("stylesheet_directory");?>/img/phone-orange.png" /></a>
			<div class="clear"></div>
			
		</div>
		<div class="tab-bottom-right half">
			<h3>Looking for a job?</h3>
			<a href="<?php echo get_permalink_from_page_name("Jobs"); ?>" class="call-to-action no-change">
				<span>View all available positions at Impetus</span>
				<?php echo get_right_arrow_HTML(); ?>
			</a>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php get_footer(); ?>