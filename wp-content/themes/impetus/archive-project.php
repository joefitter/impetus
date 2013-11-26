<?php
get_header(); ?>
<div class="green-line"></div>
<div class="wrapper" id="main">
	<div id="content">
		<h2 class="projects green">Our Projects</h2>
		<?php $projects = get_posts_by_type("project"); $i=0;
		while($projects->have_posts()) : $projects->the_post(); ?>
			<?php if($post->ID != 134){ ?>
			<?php if($post->ID != 1637){ ?>
				<div class="project-teaser">
					<?php if($i > 1) { ?>
					<div class="teaser-line"></div>
					<?php } ?>
					<div class="teaser-inner">
						<h3 class="teaser-title orange"><?php the_title(); ?></h3>
						<?php the_excerpt(); ?>
						<div class="teaser-button">
							<a class="view-project" href="<?php the_permalink(); ?>">More about <?php the_title(); ?><?php echo get_right_arrow_HTML(); ?></a>
						</div>
					</div>
				</div>
				<?php $i++; ?>
			<?php } ?>
			<?php } ?>
		<?php endwhile; ?>
		<div class="clear"></div>
		<?php while($projects->have_posts()) : $projects->the_post(); ?>
			<?php if($post->ID == 134){ ?>
	<div id="content">
		<h2 class="projects green">Other ways we help</h2>
				<div class="project-teaser left">
					<h3 class="orange"><?php the_title() ?></h3>
					<p><?php the_excerpt(); ?></p>
					<div class="teaser-button">
						<a class="view-project" href="<?php the_permalink(); ?>">More about <?php the_title(); ?><?php echo get_right_arrow_HTML(); ?></a>
					</div>
				</div>
			<?php } ?>
		<?php endwhile; ?>
		<?php while($projects->have_posts()) : $projects->the_post(); ?>
			<?php if($post->ID == 1637){ ?>
				<div class="project-teaser right">
					<h3 class="orange"><?php the_title() ?></h3>
					<p style="line-height:15px"><br></p>
					<p><?php the_excerpt(); ?></p>
					<div class="teaser-button">
						<a class="view-project" href="<?php the_permalink(); ?>">More about <?php the_title(); ?><?php echo get_right_arrow_HTML(); ?></a>
					</div>
				</div>
<div class="clear"></div>
	</div>
			<?php } ?>
		<?php endwhile; ?>
		<div class="project-teaser left">
			<h2 class="projects green">How you can support us</h2>
			<p>Impetus are always looking for volunteers to take part in our charity based projects.</p>
			<p>You can also directly donate money to one of our causes.</p>
			<div class="teaser-button full-width">
				<a class="view-project half left" href="/volunteer">Volunteer <?php echo get_right_arrow_HTML(); ?></a>
				<a class="view-project half right" href="/donate">Donate to us <?php echo get_right_arrow_HTML(); ?></a>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="tab-bottom">
	<div class="wrapper">
		<div class="tab-bottom-left half">
			<h3>Want to learn more about Impetus?</h3>
			<a href="#" class="call-to-action">Find out about Impetus<?php echo get_right_arrow_HTML(); ?></a>
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

<?php get_footer();

?>