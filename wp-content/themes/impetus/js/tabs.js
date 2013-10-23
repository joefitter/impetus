(function($){
	function adjustHeights(){
		var height = 0,
			teasers = $(".team-member-teaser");
		teasers.each(function(){
			var $this = $(this);
			if($this.outerHeight() > height){
				height = $this.outerHeight();
			}
		});
		teasers.each(function(){
			$(this).css({height:height});
		});
	}
	var lastTab = "";
	function showTab(){
		var activeTab = null, selectedTab;
		$("ul.tabs li a, ul.job-tabs li a").removeClass("selected");
		$("div.tabs-catch-all").hide();
		if(window.location.hash){
			activeTab = window.location.hash.replace("#", "");
		}
		selectedTab = activeTab != null ? $("ul.tabs li a[data-id='" + activeTab + "'], ul.job-tabs li a[data-id='" + activeTab + "']") : $("ul.tabs li a, ul.job-tabs li a").first();
		var tabId = selectedTab.attr("data-tab"),
			tabUrl = selectedTab.attr("data-id"),
			tabName = selectedTab.attr("data-name");
		selectedTab.addClass("selected");
		if(window.location.href.indexOf("get-support") !== -1){
			$("input[name='subject']").val("Get Support - " + tabName);
		} else if(window.location.href.indexOf("volunteer") !== -1){
			$("input[name='subject']").val("Volunteer - " + tabName);
		}
		var email;
		switch(tabName){
			case "ASpire":
				email = "aspire@bh-impetus.org";
				break;
			case "InterAct":
				email = "interact@bh-impetus.org";
				break;
			case "Better Futures":
				email = "betterfutures@bh-impetus.org";
				break;
			case "Neighbourhood Care Scheme":
				email = "ncs@bh-impetus.org";
				break;
			default:
				email = "info@bh-icas.org";
				break;
		}

		if($("form.wpcf7-form input[name='to-address']").length ===0){
			$("form.wpcf7-form").append('<input type="hidden" name="to-address" value="'+email+'" />');
		} else {
			$("form.wpcf7-form input[name='to-address']").val(email);
		}

		var $displayTab = $("div.tabs-catch-all[data-tab='" + tabId + "']");
		$displayTab.show();
		if(activeTab == "our-team" || activeTab == "stories"){
			adjustHeights();
		}
		$inner = $displayTab.find("div.tab-inner");
		if($inner.hasClass("full")){
			$(".content-sidebar").addClass("hidden").removeClass("fl fr");
		} else if($inner.hasClass("fl")){
			$(".content-sidebar").addClass("fr").removeClass("hidden fl");
		} else if($inner.hasClass("fr")){
			$(".content-sidebar").addClass("fl").removeClass("fr hidden");
		}
		$(".charityName").html(tabName);
		$("a.call-to-action:not('.no-change')").each(function(){
			var $this = $(this),
				href = $this.attr("href");
			if(href.indexOf(lastTab) != -1 && href.indexOf(lastTab) != 0){
				if(!$this.hasClass("no-hash")){
					href = href.substring(0, href.indexOf(lastTab)-1);
				} else {
					href = href.substring(0, href.indexOf(lastTab));
				}
			}
			if($this.hasClass("no-hash")){
				$this.attr("href", href + tabUrl);
			} else {
				$this.attr("href", href + "#" + tabUrl);
			}
			
		});
		lastTab = tabUrl;
	}

	$(function(){
		showTab();
		$("ul.tabs li a, ul.job-tabs li a").click(function(){
			var $this = $(this);
			parent.location.hash = $this.attr("data-id");
			showTab();
			return false;
		});
	});
})(jQuery);