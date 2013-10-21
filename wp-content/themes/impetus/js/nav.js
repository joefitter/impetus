(function($){
	$(function(){
		$("#projects-dropdown ul li a").hover(function(){
			var $this = $(this),
				id = $this.attr("data-id");
			$("#projects-dropdown ul li a, .project-details").removeClass("selected");
			$(this).addClass("selected");
			$(".project-details[data-id='" + id + "']").addClass("selected");
		});
		$(".nav-menu ul li a:contains('Projects'), #projects-dropdown").hover(function(){
			$(".nav-menu ul li a:contains('Projects'), #projects-dropdown").toggleClass("hover");
		});
		$(document).mousemove(function(){
			if($(".nav-menu ul li a:contains('Projects')").hasClass("hover") || $("#projects-dropdown").hasClass("hover")){
				if($(document).width() > 857){
					$("#projects-dropdown").show();
					$(".nav-menu ul li a:contains('Projects')").addClass("selected");
				}
			} else {
				$("#projects-dropdown").hide();
				$(".nav-menu ul li a:contains('Projects')").removeClass("selected");
			}
		});
	});
})(jQuery);