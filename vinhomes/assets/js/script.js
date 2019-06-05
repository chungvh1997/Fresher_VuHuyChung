$(document).ready(function () {
	$("#content.product .content-navigation span").click(function (e) {
		var top = $($(this).data("href")).offset().top - $("#menu-center").outerHeight() - 10;
		$('html, body').animate({ scrollTop: top }, 800);
		e.preventDefault();
		e.stopPropagation();
	});
	newSwiper(swiperInit);
	timeOut_500();
	$(".various").fancybox({
		openEffect: "elastic",
		closeEffect: "elastic",
		helpers	: { thumbs	: { width	: 50, height	: 50 } }
	});

	$("#menu-mobile #menu-mobile-container").mmenu({
		"onClick":function(){
			console.log(123);
		}
	});
	setTimeout(function(){
	
		$("#menu-mobile-container").before($("#menu-mobile"));
		$("#menu-mobile .btn").bind("click",function() {
			  var api = $("#menu-mobile-container").data( "mmenu" );
				//console.log(api);
				api.close();
		});
	},500);
});

function timeOut_500() {
	setTimeout(function () {
		$("#content .menu-right, #content .content-box").css("min-height", $("#content").outerHeight() + "px");
		$("#content .contact-right").css("height", $("#content .contact-left").outerHeight() + "px");
		$(document).scroll(function () {
			if($("#menu-center").length) {
				var sctop = $(this).scrollTop();
				var mntop = $("#menu-center").offset().top;
				if(sctop > mntop) {
					if(!$("#menu-center .scrollfix").hasClass("fixed"))
						$("#menu-center .scrollfix").addClass("fixed");
				}
				else
					$("#menu-center .scrollfix").removeClass("fixed");
			}
		});
		$(document).trigger("scroll");
	}, 500);
}

function swiperInit(id) {
	if(id == "slider-container") {
		setTimeout(function () {
			$("#slider .swiper-slide").each(function() {
				$(this).css("height", Math.min($(this).outerWidth() * 0.5, $(window).outerHeight() - $("#header").outerHeight() + 22) + "px");
				$(this).find("img").css("min-height", Math.min($(this).outerWidth() * 0.5, $(window).outerHeight() - $("#header").outerHeight() + 22) + "px");
			});
		}, 500);
	}
	if(id == "index-top-slider") {
		setTimeout(function () {
			var hmax = 0;
			$("#index-top .item .item-title").each(function() {
				if(hmax < $(this).outerHeight())
					hmax = $(this).outerHeight();
			});
			if(hmax > 0)
				$("#index-top .item .item-title").css("height", hmax + "px");
			hmax = 0;
			$("#index-top .item .item-description").each(function() {
				if(hmax < $(this).outerHeight())
					hmax = $(this).outerHeight();
			});
			if(hmax > 0)
				$("#index-top .item .item-description").css("height", hmax + "px");
			// $("#index-top .item a").each(function () {
			// 	$(this).css("min-height", "calc(" + $(this).outerWidth() + "px * 570 / 760)");
			// });
		}, 500);
	}
	if($("#"+id).hasClass("index-product-slider")) {
		setTimeout(function () {
			$("#"+id+" .item-thumbnail img").each(function () {
				$(this).css("height", "calc(" + $(this).outerWidth() + "px * 570 / 760)");
			});
		}, 500);
	}
	if(id == "index-post-slider") {
		setTimeout(function () {
			$("#index-post-slider .item-thumbnail img").each(function () {
				$(this).css("height", "calc(" + $(this).outerWidth() + "px * 570 / 760)");
			});
			if(window.matchMedia("(min-width: 768px)").matches) {
				var l1 = $("#index-post-left-slider .item .item-description");
				var l2 = $("#index-post-left-slider").outerHeight() - l1.outerHeight();
				var l3 = $("#index-post-right-slider").outerHeight();
				var l4 = l3 - l2;
				var l5 = Number(l1.css("font-size").replace("px", "")) + 6;
				var l6 = Math.floor(l4 / l5) * l5;
				l1.css("height", l6 + "px");
				l1.css("line-height", l5 + "px");
				l1.css("margin-bottom", (l4 - l6) + "px");
			}
			var r1 = $("#index-post-right-slider .item .item-description");
			var r2 = $("#index-post-right-slider .item .item-title").outerHeight();
			var r3 = $("#index-post-right-slider .item .item-heading").outerHeight() - Number(r1.css("margin-top").replace("px", ""));
			r3 -= Number($("#index-post-right-slider .item .item-heading").css("padding-top").replace("px", "")) * 2;
			var r4 = r3 - r2;
			var r5 = Number(r1.css("font-size").replace("px", "")) + 6;
			var r6 = Math.floor(r4 / r5) * r5;
			r1.css("height", r6 + "px");
			r1.css("line-height", r5 + "px");
		}, 500);
	}
	if(id == "product-thumbnail") {
		setTimeout(function () {
			var wmax = 0;
			$("#product-thumbnail .swiper-slide a").each(function () {
				if(wmax < $(this).outerHeight())
					wmax = $(this).outerHeight();
			});
			if(wmax > 0)
				$("#product-thumbnail .swiper-slide a").css("min-height", wmax + "px");
		}, 500);
	}
	if(id == "index-video-slider") {
		setTimeout(function () {
			$("#index-video-slider iframe").each(function () {
				$(this).css("height",($(this).outerWidth()*0.5)+"px");
				
			});
			
				
		}, 500);
	}
}