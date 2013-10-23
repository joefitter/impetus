<div class="sidebar-section">
	<h2><?php _e("Archives"); ?></h2>
	<ul>
	<?php
	$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");
	foreach($years as $year) :
	?>
		<?php if(is_home()){
			$current = $year === date('Y');
		} else if(is_date()) {
			$currentYear = substr(trim(wp_title("", false)), 0, 4);
			$current = $year === $currentYear;
		}
		$year_count = count(get_posts("year=$year&posts_per_page=-1"));

		?>
		<li class="<?php echo $current ? "current" : ""; ?>">
			<a href="<?php echo get_year_link($year); ?> "><?php echo $year; ?></a>
			<span>(<?php echo $year_count; ?>)</span>
			<a href="#" class="expand fr">
				<img src="<?php bloginfo("stylesheet_directory"); ?><?php if($current){ ?>/img/hide.png<?php } else { ?>/img/show.png<?php } ?>" />
			</a>
			<ul>
			<?php	$months = $wpdb->get_col("SELECT DISTINCT MONTH(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND YEAR(post_date) = '".$year."' ORDER BY post_date DESC");
				foreach($months as $month) :
				?>
				<?php $month_count = count(get_posts("year=$year&monthnum=$month&posts_per_page=-1")); ?>
				<li>
					<a href="<?php echo get_month_link($year, $month); ?>"><?php echo date( 'F', mktime(0, 0, 0, $month) );?></a>
					<span>(<?php echo $month_count; ?>)</span>
				</li>
				<?php endforeach;?>
			</ul>
		</li>
	<?php endforeach; ?>
	</ul>
</div>
<div class="sidebar-section">
	<h2><?php _e("Projects"); ?></h2>
	<ul>
		<?php wp_list_cats("sort_column=name&optioncount=1&heirachical=0"); ?>
	</ul>
</div>
<div class="sidebar-section">
	<h2><?php _e("Popular tags"); ?></h2>
	<div id="tag-cloud">
		<?php wp_tag_cloud(array("smallest" => 14, "largest" => "14", "unit" => "px", "number" => 20, "orderby" => "count", "order" => "DESC", "topic_count_text_callback" => 'get_tag_cloud_text')); ?>
	</div>
</div>