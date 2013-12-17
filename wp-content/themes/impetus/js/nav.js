(function($){
	$(function(){
		var timeout = [];
		$("#projects-dropdown ul li a").mouseenter(function(){
			var $this = $(this),
				id = $this.attr("data-id");
			$("#projects-dropdown ul li a, .project-details").removeClass("selected");
			$(this).addClass("selected");
			$(".project-details[data-id='" + id + "']").addClass("selected");
		});
		$(".nav-menu ul li a:contains('Services'), #projects-dropdown").mouseenter(function(){
			for(var i=0; i< timeout.length; i++){
				clearTimeout(timeout[i]);
			}
			$(".nav-menu ul li a:contains('Services'), #projects-dropdown").addClass("hover");
		});
		$(".nav-menu ul li a:contains('Services'), #projects-dropdown").mouseleave(function(){
			timeout.push(setTimeout(function(){
				$(".nav-menu ul li a:contains('Services'), #projects-dropdown").removeClass("hover");
			}, 100));
		});
		$(document).mousemove(function(){
			if($(".nav-menu ul li a:contains('Services')").hasClass("hover") || $("#projects-dropdown").hasClass("hover")){
				if($(document).width() > 983){
					$("#projects-dropdown").show();
					$(".nav-menu ul li a:contains('Services')").addClass("selected");
				}
			} else {
				$("#projects-dropdown").fadeOut("fast");
				$(".nav-menu ul li a:contains('Services')").removeClass("selected");
			}
		});
	});
})(jQuery);