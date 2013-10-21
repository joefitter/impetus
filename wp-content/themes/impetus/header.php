<!doctype html>
<html>
<head>
	<meta charset="UTF-8"/>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="viewport" content="width=device-width">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:700,400|Open+Sans:400italic,600italic,700italic,400,600,700' rel='stylesheet' type='text/css'>
	<link rel="alternate" title="Impetus RSS" href="<?php bloginfo('home'); ?>/feed/" type="application/rss+xml">
	<link rel="stylesheet" href="<?php bloginfo("stylesheet_directory"); ?>/css/ladda.min.css" />
	<link rel="stylesheet" href="<?php bloginfo("stylesheet_directory"); ?>/reset.css"/>
	<link rel="stylesheet" href="<?php bloginfo("stylesheet_url"); ?>"/>
	<!--[if IE]>
		<link rel="stylesheet" href="<?php bloginfo("stylesheet_directory"); ?>/ie7.css" />
	<![endif]-->
	<?php if(is_page("Get Help") || is_page("Donate") || is_page("Volunteer") || is_singular("project") || is_page("Jobs") || is_page("About") || is_page("Reports")){ ?>
		<script src="<?php bloginfo("stylesheet_directory"); ?>/js/tabs.js"></script>
	<?php } ?>
	<script src="<?php bloginfo("stylesheet_directory"); ?>/js/nav.js"></script>
	<script>
		function sortHeights(){
			var maxHeight = 0;
			$(".teaser-inner").each(function(){
				var $this = $(this);
				$this.css("height", "auto");
				if($this.outerHeight() > maxHeight){
					maxHeight = $this.height();
				}
			});
			$(".teaser-inner").each(function(){
				$(this).css("height", maxHeight);
			});
		}

		function adjustOverlay(){
			var h = $("div#header-image").outerHeight(),
				w = $("div.wrapper").offset().left;
			$("div.overlay-inner").css("margin-left", w);
		}

		$(function(){
			sortHeights();
			$("a.show-jobs").click(function(){
				var $el = $("div#jobs-sidebar");
				if($el.hasClass("showing")){
					$el.removeClass("showing");
					$el.hide();
				} else {
					$el.addClass("showing");
					$el.show();
				}
				return false;
			});
			$("a#menu-button").click(function(){
				var $el = $("div.navbar")
				if($el.hasClass("showing")){
					$el.removeClass("showing");
					$el.hide();
				} else {
					$el.addClass("showing");
					$el.show();
				}
				return false;
			});
			$(".view-project, a.call-to-action").each(function(){
				var $this = $(this), img;
				if($this.hasClass("left-arrow")){
					img = "arrow-left";
				} else {
					img = "arrow-right";
				}
				$this.hover(function(){
					$this.children("img").attr("src", "<?php bloginfo('stylesheet_directory'); ?>/img/" + img + "-white.png");
				}, function(){
					$this.children("img").attr("src", "<?php bloginfo('stylesheet_directory'); ?>/img/" + img + ".png");
				});
			});
			adjustOverlay();
			$(window).resize(function(){
				adjustOverlay();
				if($(document).width() > 840){
					$("#navbar").show();
					$("div#jobs-sidebar").show();
					$("#projects-dropdown").fadeOut(200);
					$(".nav-menu ul li a:contains('Projects')").removeClass("selected");
				} else {
					if(!$("#navbar").hasClass("showing")){
						$("#navbar").hide();
					}
					if(!$("div#jobs-sidebar").hasClass("showing")){
						$("div#jobs-sidebar").hide();
					}
				}
			});
			$("div.select-button").click(function(){
				$(this).parent("div.select-holder").find("select").trigger("select");
			});
			$("#text-size-controls a").click(function(){
				var $this = $(this), size;
				switch($this.attr("id")){
					case "small-text":
						size = 100;
						break;
					case "med-text":
						size = 115;
						break;
					case "large-text":
						size = 125;
						break;
					default:
						size = 100;
						break;
				}
				console.log(size)
				$("body").css({fontSize: size + "%"});
				sortHeights();
				return false;
			});
			<?php if(is_singular( "project" ) || is_post_type_archive("project")){ ?>
				$("li.page_item:contains('Projects')").addClass("current_page_item");
			<?php } ?>
			<?php if(is_singular( "volunteer" )){ ?>
				$("li.page_item:contains('Volunteer')").addClass("current_page_item");
			<?php } ?>
			<?php if(is_singular( "post" )){ ?>
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
				<a id="logo" href="<?php bloginfo("home"); ?>"><img src="<?php bloginfo("stylesheet_directory"); ?>/img/impetus-logo.png"/></a>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				<div id="header-right">
					<div id="text-size-controls">
						<a href="#" class="change-text" id="small-text">A</a>
						<a href="#" class="change-text" id="med-text">A</a>
						<a href="#" class="change-text" id="large-text">A+</a>
					</div>
					<div id="small-menu">
						<ul>
							<li><a href="/jobs"<?php if(is_page("Jobs")){ ?> class="selected"<?php } ?>>Jobs</a></li>
							<li><a href="/reports"<?php if(is_page("Reports")){ ?> class="selected"<?php } ?>>Reports</a></li>
							<li><a href="/contact"<?php if(is_page("Contact")){ ?> class="selected"<?php } ?>>Contact</a></li>
							<li id="last">
								<a href="/accessibility"<?php if(is_page("Accessibility")){ ?> class="selected"<?php } ?>>Accessibility</a>
							</li>
						</ul>
					</div>
					
					<div class="clear"></div>
					<div id="social-links">
						<p id="find-us">Find us on</p>
						
						<a class="social" target="_blank" href="https://twitter.com/BHImpetus"><img src="<?php bloginfo("stylesheet_directory"); ?>/img/twitter.png"/></a>
						<a class="social" href="#"><img src="<?php bloginfo("stylesheet_directory"); ?>/img/facebook.png"/></a>
						<div class="clear"></div>
					</div>
				</div>
				<div class="clear"></div>
				<a id="menu-button">Menu</a>
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
								<img src="<?php echo get_featured_image_url($post->ID); ?>" />			
							</div>
							<div class="project-excerpt">
								<p><?php the_excerpt(); ?></p>
							</div>
						</div>
					<?php $first = false; ?>
					<?php endwhile; ?>
				<?php wp_reset_postdata(); wp_reset_query(); rewind_posts(); ?>
				</div>
			</div>
		</div>
		<?php if(!is_404() && !is_page("Contact") && !is_post_type_archive("project") && !is_page("Jobs") && !is_home() && !is_singular( "volunteer" ) && !is_archive() && !is_singular("post")){ ?>
		<!--[if !IE]><!-->
			<div id="header-wrapper">
		<!--<![endif]-->
				<div id="header-image">
							<?php if(get_post_meta($post->ID, "overlay_subtitle", true) != ""){ ?>
						<div class="overlay">
							<div class="overlay-inner">
								<h1 class="orange overlay-title"><?php the_title(); ?><?php if(is_page("About")){ ?> Impetus<?php } ?><?php if(is_page("Reports")){ ?> &amp; Policies<?php } ?></h1>
								<p class="projects-strapline"><?php echo get_post_meta($post->ID, "overlay_subtitle", true); ?></p>
							</div>
						</div>
					<?php } ?>
					<div id="image-inner">
						<!--<img src="http://lorempixel.com/1280/270" />-->
						<img src="<?php bloginfo("stylesheet_directory"); ?>/img/volunteer-hero.jpg" />
					</div>
				</div>
		<!--[if !IE]><!-->
			</div>
		<!--<![endif]-->
			<div class="orange-line"></div>
		<?php }?>
	</header>
	