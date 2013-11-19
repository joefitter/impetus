function sortHeights(){
    var maxHeight = 0;
    var maxBottomHeight = 0;
    $(".teaser-inner").each(function(){
        var $this = $(this);
        var innerHeight = $this.children("p").outerHeight() + $this.children("h3").outerHeight(true);
        var innerBottomHeight = $this.children(".story-teaser-wrapper").outerHeight() + $this.children(".teaser-button").outerHeight() + 40;
        $this.css("height", innerHeight);
        if(innerBottomHeight > maxBottomHeight){
            maxBottomHeight = innerBottomHeight;
        }
        if($this.height() > maxHeight){
            maxHeight = $this.height();
        }
    });
    $(".teaser-inner").each(function(){
        var $this = $(this);
        $this.css("height", maxHeight + 10);
        $this.css("padding-bottom", maxBottomHeight);
        $this.children(".story-teaser-wrapper").css({top: maxHeight + 10});
    });
}

function addSocialLinksToNavigation(){
    var twitter = $("#twitter-link").attr("href"),
        facebook = $("#facebook-link").attr("href"),
        path = $("#twitter-link img").attr("src").replace("twitter.png", "");
    $(".nav-menu ul li").last().after($("<li />", {
        html: '<a target="_blank" href="' + twitter +'"><img src="'+path+'twitter-white.png" /></a>',
        id: "twitter-nav-link"
    }).addClass("half-width hidden"));
    $(".nav-menu ul li").last().after($("<li />", {
        html: '<a target="_blank" href="'+facebook+'"><img src="'+path+'facebook-white.png" /></a>',
        id: "facebook-nav-link"
    }).addClass("half-width hidden"));
    var textSize = $(".text-size-controls").clone();
    $(".nav-menu ul li").last().after($("<li />", {
        id: "text-size-menu-control",
        html: textSize
    }).addClass("third-width hidden"));

}

function adjustOverlay(){
    var h = $("div#header-image").outerHeight(),
        w = $("div.wrapper").offset().left;
    $("div.overlay-inner").css("margin-left", w);
    var $overlay = $("div.overlay"),
        overlayHeight = $overlay.outerHeight();
    $overlay.css("margin-top", (h - overlayHeight)/2);
}

function orientationFix(){
    if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i)) {
        var viewportmeta = document.querySelector('meta[name="viewport"]');
        if (viewportmeta) {
            viewportmeta.content = 'width=device-width, minimum-scale=1.0, maximum-scale=10, initial-scale=1.0';
            document.body.addEventListener('gesturestart', function () {
                viewportmeta.content = 'width=device-width, minimum-scale=0.25, maximum-scale=10';
                sortHeights();
            }, false);
        }
    }
}
$(function(){
    orientationFix();
    $(window).resize(function(){
        sortHeights();
    });
    addSocialLinksToNavigation();
    $("a#more").click(function(){
        $("body").scrollTo("#anchor", 800,{'axis':'y'});
    });
    var selected;
    if($.cookie("font_size")){
        $("body").removeClass("small-text med-text large-text").addClass($.cookie("font_size"));
        $(".text-size-controls a, .navbar .text-size-controls a").removeClass("selected");
        $("#" + $.cookie("font_size") + ", .navbar .text-size-controls a#" + $.cookie("font_size")).addClass("selected");
    } else {
        $("body").removeClass("med-text large-text").addClass("small-text");
        $("#small-text").addClass("selected");
    }
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
    $("#text-size-menu-control").click(function(){
        var size;
        switch($.cookie("font_size")){
            case "small-text":
                size = "med-text";
                break;
            case "med-text":
                size = "large-text";
                break;
            case "large-text":
                size = "small-text";
                break;
            default:
                size = "med-text";
                break;
        }
        $.cookie("font_size", size);
        $("#text-size-menu-control a, .text-size-controls a").removeClass("selected");
        $("#text-size-menu-control a#" + size + ", .text-size-controls a#" + size).addClass("selected");
        $("body").removeClass("small-text med-text large-text").addClass(size);
        return false;
    });
    $("a#menu-button").click(function(){
        var $el = $("div.navbar");
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
        } else if($this.hasClass("rss")){

            img = "rss";
        }  else {
            img = "arrow-right";
        }
        $this.hover(function(){
            var src = $this.children("img").attr("src");
            $this.children("img").attr("src", src.replace(img, img + "-white"));
        }, function(){
            var src = $this.children("img").attr("src");
            $this.children("img").attr("src", src.replace("-white", ""));
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
    $("a.expand").click(function(){
        var $this = $(this),
            $li = $this.parent("li"),
            $img = $this.children("img"),
            src = $img.attr("src");
        $this.stop();
        if($li.hasClass("current")){
            $li.children("ul").slideUp(400, function(){
                $li.removeClass("current");
            });
            $img.attr("src", src.replace("hide", "show"));
        } else {
            $li.children("ul").slideDown(400, function(){
                $li.addClass("current");
            });
            $img.attr("src", src.replace("show", "hide"));
        }
        return false;
    });
    $(".text-size-controls a").not(".navbar .text-size-controls a").click(function(){
        $(".text-size-controls a, #text-size-menu-control a").removeClass("selected");
        var $this = $(this),
            $body = $("body"),
            size = $this.attr("id");
        $this.addClass("selected");
        $body.removeClass("small-text med-text large-text");
        $body.addClass(size);
        $.cookie("font_size", size, {expires: 365, path: '/'});
        sortHeights();
        adjustOverlay();
        return false;
    });
});