<!doctype html>
<html>
<head>
	<meta charset="UTF-8"/>
	<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:700,400|Open+Sans:400italic,600italic,700italic,400,600,700' rel='stylesheet' type='text/css'>
	<link rel="alternate" title="Impetus RSS" href="<?php bloginfo('home'); ?>/feed/" type="application/rss+xml">
	<link rel="stylesheet" href="<?php bloginfo("stylesheet_directory"); ?>/css/ladda.min.css" />
	<link rel="stylesheet" href="<?php bloginfo("stylesheet_directory"); ?>/reset.css"/>
	<link rel="stylesheet" href="<?php bloginfo("stylesheet_url"); ?>"/>
	<!--[if IE 7]>
		<link rel="stylesheet" href="<?php bloginfo("stylesheet_directory"); ?>/ie7.css" />
	<![endif]-->
	<!--[if IE 8]>
		<link rel="stylesheet" href="<?php bloginfo("stylesheet_directory"); ?>/ie8.css" />
	<![endif]-->
	<script>
		window.currentPage = '<?php echo get_the_title(); ?>';
	</script>
	<?php if(is_page("volunteer") || is_singular("volunteer")){
		$volunteer_vacancies = array();
		$volunteer = get_posts_by_type("volunteer");
		if($volunteer->have_posts()) : while($volunteer->have_posts()) : $volunteer->the_post();
			$cat = get_the_terms($post->ID, 'job_tags');
			reset($cat);
			$first_key = key($cat);
			array_push($volunteer_vacancies, array("name"=>get_the_title(), "cat" => str_replace(" ", "", str_replace("Volunteer ", "", $cat[$first_key]->name))));
		endwhile; endif;
		wp_reset_postdata(); wp_reset_query(); rewind_posts(); ?>
		<script>
			$(function(){
				<?php foreach($volunteer_vacancies as $vacancy){ ?>
					$("select[name='your-position']").append("<option class='<?php echo $vacancy['cat']; ?>' value='<?php echo $vacancy['name']; ?>'><?php echo $vacancy['name']; ?></option>");
				<?php } ?>
				<?php if(is_singular('volunteer')){ ?>
					$("select[name='your-position']").val('<?php the_title(); ?>');
					$("input[name='subject']").val('Volunteer application - <?php the_title(); ?>');
				<?php } ?>
			});
		</script>
	<?php } ?>
	<?php if(is_page("Get Support") || is_page("Donate") || is_page("Volunteer") || is_singular("project") || is_page("Jobs") || is_page("About") || is_page("Reports")){ ?>
		<script src="<?php bloginfo("stylesheet_directory"); ?>/js/tabs.js"></script>
	<?php } ?>
	<script src="<?php bloginfo("stylesheet_directory"); ?>/js/nav.js"></script>
	<script src="<?php bloginfo("stylesheet_directory"); ?>/js/jquery.cookie.js"></script>
	<script src="<?php bloginfo("stylesheet_directory"); ?>/js/jquery.scrollto.js"></script>
	<script src="<?php bloginfo("stylesheet_directory"); ?>/js/main.js"></script>
	<script>
	$(function(){
		<?php if(is_singular( "project" ) || is_post_type_archive("project")){ ?>
	        $("li.page_item:contains('Services')").addClass("current_page_item");
	    <?php } ?>
	    <?php if(is_singular( "volunteer" )){ ?>
	        $("li.page_item:contains('Volunteer')").addClass("current_page_item");
	    <?php } ?>
	    <?php if(is_singular( "post" ) || (is_archive() && !is_post_type_archive())){ ?>
	        $("li.page_item:contains('Blog')").addClass("current_page_item");
	    <?php } ?>
	});
	</script>
	
<?php wp_head(); ?>
</head>
<body>
	<header>
		<div class="wrapper">
			<div id="header">
				<div id="branding">
					<a id="logo" href="<?php bloginfo("home"); ?>"><img src="<?php bloginfo("stylesheet_directory"); ?>/img/impetus-logo.png"/></a>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				</div>
				<div id="header-right">
					<div class="text-size-controls">
						<a href="#" class="change-text" id="small-text">A</a>
						<a href="#" class="change-text" id="med-text">A</a>
						<a href="#" class="change-text" id="large-text">A+</a>
					</div>
					<div id="small-menu">
						<ul>
							<li><a href="/jobs"<?php if(is_page("Jobs")){ ?> class="selected"<?php } ?>>Jobs</a></li>
							<li><a href="/contact"<?php if(is_page("Contact")){ ?> class="selected"<?php } ?>>Contact</a></li>
							<li id="last">
								<a href="/accessibility"<?php if(is_page("Accessibility")){ ?> class="selected"<?php } ?>>Accessibility</a>
							</li>
						</ul>
					</div>
					
					<div class="clear"></div>
					<div id="social-links">
						<p id="find-us">Find us on</p>
						
						<a class="social" id="twitter-link" target="_blank" href="https://twitter.com/BHImpetus"><img src="<?php bloginfo("stylesheet_directory"); ?>/img/twitter-large.png"/></a>
						<a class="social" id="facebook-link" target="_blank" href="https://www.facebook.com/pages/Brighton-Hove-Impetus/298908810236826"><img src="<?php bloginfo("stylesheet_directory"); ?>/img/facebook-large.png"/></a>
						<a id="menu-button">Menu<img src="<?php bloginfo("stylesheet_directory"); ?>/img/menu.png"></a>
						<div class="clear"></div>
					</div>
				</div>
				<div class="clear"></div>
				
			</div>
		</div>

		<div id="navbar" class="navbar">
			<div class="wrapper">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<h3 class="menu-toggle"><?php _e( 'Menu', 'twentythirteen' ); ?></h3>
					<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentythirteen' ); ?>"><?php _e( 'Skip to content', 'twentythirteen' ); ?></a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'depth' => 1) ); //, 'exclude' => '152,180,186' ?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
		<div id="projects-dropdown">
			<div class="orange-thin-line"></div>
			<div class="wrapper">
				<ul>
				<?php $projects = get_posts_by_type("project"); ?>
				<?php $first = true; ?>
				<?php while ($projects->have_posts()) : $projects->the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>" data-id="<?php echo $post->ID; ?>"<?php if($first) { ?> class="selected"<?php } ?>>
							<?php $display_title = $post->ID == 134 ? get_the_secondary_title($post->ID) : get_the_title(); ?>
							<?php echo $display_title; ?>
							<?php echo get_right_arrow_HTML(); ?>
						</a>
					</li>
				<?php $first = false; ?>
				<?php endwhile; ?>
				<?php rewind_posts(); ?>
				</ul>
				<div id="dropdown-right">
					<?php $first = true; ?>
					<?php while ($projects->have_posts()) : $projects->the_post(); ?>
						<div class="project-details<?php if($first){ ?> selected<?php } ?>" data-id="<?php echo $post->ID; ?>">
							<div class="project-image">
								<?php if( class_exists( 'kdMultipleFeaturedImages' ) ) {
    								kd_mfi_the_featured_image( 'featured-image-2', 'project' );
								}; ?>
							</div>
							<div class="project-excerpt">
								<p><?php the_excerpt(); ?></p>
							</div>
							<div class="clear"></div>
						</div>
					<?php $first = false; ?>
					<?php endwhile; ?>
				<?php wp_reset_postdata(); wp_reset_query(); rewind_posts(); ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php if(!is_404() && !is_page("Contact") && !is_page("Accessibility") && !is_post_type_archive("project") && !is_page("Jobs") && !is_page("Reports") && !is_home() && !is_singular( "volunteer" ) && !is_archive() && !is_singular("post")){ ?>
		<!--[if !IE 7]><!-->
			<div id="header-wrapper"<?php if(is_page("Home")){ ?> class="homepage"<?php } ?>>
		<!--<![endif]-->
				<?php if(is_singular( "story" )){ 
					$terms = array_shift(get_the_terms(get_the_ID(), "story_project"));
					$project = str_replace("Story ", "", $terms->name);
					$projects = get_posts_by_type("project");
					if($projects->have_posts()) : while($projects->have_posts()) : $projects->the_post();
						if($project === get_the_title()){
							$pageID = get_the_ID();
						}
					endwhile; endif;
					wp_reset_postdata(); wp_reset_query(); rewind_posts();
				} else {
					$pageID = $post->ID;
				}?>
				<div id="header-image"<?php if(is_page("Home")){ ?> class="homepage"<?php } ?>>
						<?php if($post->ID == 134){ ?>
						<div class="wrapper" id="logo-holder">
							<img id="icas-logo" src="<?php bloginfo("stylesheet_directory"); ?>/img/icas-logo.png" />
						</div>
						<?php } ?>
							<?php if(get_post_meta($pageID, "overlay_subtitle", true) != ""){ ?>
						<div class="overlay">
							<div class="overlay-inner">
								<h1 class="orange overlay-title"><?php echo get_the_title($pageID); ?><?php if(is_page("About")){ ?> Impetus<?php } ?><?php if(is_page("Reports")){ ?> &amp; Policies<?php } ?></h1>
								<p class="projects-strapline"><?php echo get_post_meta($pageID, "overlay_subtitle", true); ?></p>
							</div>
							<a href="#" class="orange no-underline" id="more">more &darr;</a>
						</div>
					<?php } ?>
					<div id="image-inner">
						<?php echo get_the_post_thumbnail($pageID); ?>
					</div>
				</div>
		<!--[if !IE 7]><!-->
			</div>
		<!--<![endif]-->
			<div id="anchor"></div>
			<div class="orange-line"></div>
		<?php }?>
		<?php if(is_post_type_archive("project")){ ?>
		<!--[if !IE 7]><!-->
			<div id="header-wrapper">
		<!--<![endif]-->
				<div id="header-image">
					<?php if(get_post_meta(13, "overlay_subtitle", true) != ""){ ?>
						<div class="overlay">
							<div class="overlay-inner">
								<h1 class="orange overlay-title"><?php echo get_post_meta(13, "subtitle", true); ?></h1>
								<p class="projects-strapline"><?php echo get_post_meta(13, "overlay_subtitle", true); ?></p>
							</div>
							<a href="#" class="orange no-underline" id="more">more &darr;</a>
						</div>
					<?php } ?>
					<div id="image-inner">
						<?php echo get_the_post_thumbnail(13); ?>
					</div>
				</div>
		<!--[if !IE 7]><!-->
			</div>
		<!--<![endif]-->
		<div id="anchor"></div>
		<?php } ?>
	</header>