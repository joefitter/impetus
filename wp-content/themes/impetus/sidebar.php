<div class="sidebar-section">
	<h2><?php _e("Archives"); ?></h2>
	<ul>
	<?php
	$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");
	foreach($years as $year) :
	?>
		<li><a href="<?php echo get_year_link($year); ?> "><?php echo $year; ?></a>

			<ul>
			<?php	$months = $wpdb->get_col("SELECT DISTINCT MONTH(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND YEAR(post_date) = '".$year."' ORDER BY post_date DESC");
				foreach($months as $month) :
				?>
				<li><a href="<?php echo get_month_link($year, $month); ?>"><?php echo date( 'F', mktime(0, 0, 0, $month) );?></a>
					

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
		<?php wp_tag_cloud(array("smallest" => 14, "largest" => "14", "unit" => "px", "number" => 10, "orderby" => "count", "order" => "DESC")); ?>
	</div>
</div>