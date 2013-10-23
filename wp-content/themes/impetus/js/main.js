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
        class: "half-width hidden",
        html: '<a target="_blank" href="' + twitter +'"><img src="'+path+'twitter-white.png" /></a>',
        id: "twitter-nav-link"
    }));
    $(".nav-menu ul li").last().after($("<li />", {
        class: "half-width hidden",
        html: '<a target="_blank" href="'+facebook+'"><img src="'+path+'facebook-white.png" /></a>',
        id: "facebook-nav-link"
    }));
}

function adjustOverlay(){
    var h = $("div#header-image").outerHeight(),
        w = $("div.wrapper").offset().left;
    $("div.overlay-inner").css("margin-left", w);
    var $overlay = $("div.overlay"),
        overlayHeight = $overlay.outerHeight();
    $overlay.css("margin-top", (h - overlayHeight)/2);
}

$(function(){
    $(window).resize(function(){
        if($("document").width() > 740){
            sortHeights();
        }
    });
    addSocialLinksToNavigation();
    $("a#more").click(function(){
        $("body").scrollTo("#anchor", 800);
    });
    if($.cookie("font_size")){
        $("body").css({fontSize: $.cookie("font_size") + "%"});
    }
    var selected;
    switch($.cookie("font_size")){
        case "100":
            selected = "#small-text";
            break;
        case "115":
            selected = "#med-text";
            break;
        case "125":
            selected = "#large-text";
            break;
        default:
            selected = "small-text";
            break;
    }
    $("#text-size-controls a").removeClass("selected");
    $(selected).addClass("selected");
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
        if($(document).width() > 860){
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
    $("#text-size-controls a").click(function(){
        $("#text-size-controls a").removeClass("selected");
        $(this).addClass("selected");
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
        $.cookie("font_size", size, {expires: 365, path: '/'});
        $("body").css({fontSize: size + "%"});
        sortHeights();
        adjustOverlay();
        return false;
    });
});