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
		lastTab = tabUrl
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
})(jQuery)


