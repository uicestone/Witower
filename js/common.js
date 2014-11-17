$(function() {
	
	$('a[disabled="disabled"]').on('click',function(event){
		event.preventDefault();
	}).removeClass('btn-primary');
	
	$('.add-follow[user]').on('click.add-follow',function(){
		var follow_button=$(this);
		$.post('/user/addfollow/'+follow_button.attr('user'),function(){
			follow_button.text('\u5DF2\u5173\u6CE8').off('.add-follow');
		});
	});
	
	$('.label-info').siblings('input')
		.on('focus',function(){
			$(this).siblings('.label-info').fadeIn(500)
		})
		.on('blur',function(){
			$(this).siblings('.label-info').fadeOut(500)
		});

	$('.datepicker:enabled:not([readonly])').each(function(){
		
		var options = {
			language:'zh-CN',
			autoclose:true
		};
		
		if(!$(this).data('date-range-unlimited')){
			options.startDate = $(this).data('startdate');
			options.endDate = $(this).data('enddate');
		}
		
		$(this).datepicker(options);
	});
	
	$('.participator li')
		.on('mouseenter',function(){
			$(this).find('.add-follow').show();
		})
		.on('mouseleave',function(){
			$(this).find('.add-follow').hide();
		});
	
	$(window).on('scroll',function(){
		if($(window).scrollTop()>0){
			$('#back-to-top').show();
		}else{
			$('#back-to-top').hide();
		}
	});
	
	$('#back-to-top').on('click',function(){
		$(window).scrollTop(0);
	});
		
	$.get('/cron');

	var Request = {};
	Request.r1 = 'user/getstatuscomments/';
	Request.flags = '/vote-vote-1-';
	Request.addAttention = '/user/follow/';

	$("a[href = '#']").click(function(e){e.preventDefault();});// prevent every anchor default event

 var $container = $('.water').masonry();
	$container.imagesLoaded(function(){
		$container.masonry({
			itemSelector : '.box',
			columnWidth :62.305
		});
	}).fadeIn(500);
	
//	$container.children('.box').show();

	$('#mycarousel').jcarousel({
		visible:10
	});

	 // Totop
	var GoToTop = (function(){
		$(window).scroll(function(){
			if($(this).scrollTop()!==0){
				$('#goToTop').fadeIn();}
			else{
				$('#goToTop').fadeOut();} });
		$('#goToTop').click(function(){
			$('body,html').animate({scrollTop:0},800);});
	}());


	//vote flags
	var VoteFlags = (function(){
		var count = 0;

		// onclick
		$(".voting table td.images").click(function(){
			if(count >= 3)return;
			count++;
			var td = $(this)[0];
			var $input = $(this).find("input");
			if($.data(td, "num") === undefined){
				$.data(td, "num",0);
				$input.val(0);
			}else{}
			var num = $.data(td, "num");

			$(this).find("img:lt(" + (num + 1) + ")").each(function(){
				$(this).attr("src","/style/flag.png");
				$.data(td, "num",(num+1));
			});
			$input.val(num+1);
			if(count === 3){
				$(".flags img").each(function(){
					$(this).attr("src","/style/flag-off.png");
				});
			}else{
				$(".flags img:gt(" + (2-count) + ")").each(function(){
					$(this).attr("src","/style/flag-off.png");
				});
			}
		});

		 //reset
		$(".voting .tail button[type='reset']").bind("click",function(e){
			count = 0;
			$(".voting table td.images").each(function(){
				$.data($(this)[0], "num",0);
				$(this).find("input").val(0);
			});
			$(".voting table td.images img").attr("src","/style/flag-off.png");
			$(".flags img").attr("src","/style/flag.png");
		});
	}());

	var Comment = (function(){
		$(".model").on("click",".btn-comment",function(){
			var microblogId = $(this).parents(".model:first").attr("id");

			var subComment=$(this).parent('li').parent('ul').parent('div').siblings('.sub_comment');
			
			subComment.show(150);
			
			return false;

		})
		
		.on('click','[name="comment-content-submit"]',function(){
			
			var microblogId = $(this).parents(".model:first").attr("id");
			
			var commentField = $(this).siblings('[name="comment-content"]');
			
			var commentContent=commentField.val();
			
			if(commentContent === ''){
				alert('请填写评论内容');
				return false;
			}
			
			$.post((location.pathname.match(/\/project/)?'/project/addversioncomment/':'/user/addstatuscomment/')+microblogId,{commentContent:commentContent},function(response){
				$('.model#'+microblogId+' ul.comment-list').prepend('<li><dl class="dl-horizontal"><dt><a href="/space/'+response.user+'"><img src="/uploads/images/avatar/'+response.user+'_30.jpg"></a></dt><dd><p class="avatar"><a href="/space/'+response.user+'">'+response.username+'</a></p><p class="content">'+response.content+'<span class="time">( '+response.time+') </span></p></dd></dl></li>');
				commentField.val('');
			},'json');
			
			return false;
		});
		
		$('.close-comment-list').on('click',function(){
			$(this).parent('.sub_comment').hide(150);
		});
		
	}());
	
});

$(function () {
	$("#controls li a").click(function () {
		/*Performed when a control is clicked */
		shuffle();
		var rel = $(this).attr("rel");
		if ($("#" + rel).hasClass("current")) {
			return false;
		}
		/* Bug Fix, thanks Dave -> added .stop(true,true) 
		 to stop any ongoing animation */
		$("#" + rel).stop(true, true).show();
		$(".current").fadeOut().removeClass("current");
		$("#" + rel).addClass("current");
		$(".active").removeClass("active");
		$(this).parents("li").addClass("active");
		set_new_interval(5000);
		return false;
	});
	/* 
	 * Optional Pause on Hover Feature 
	 * Comment out to use it
	 * Thanks, Andrew 
	 */
	/*$('.banner').hover(function() {
	 clearInterval(slide);
	 }, function () {
	 slide = setInterval( "banner_switch()", 7000 );
	 });*/
});
function banner_switch() {
	/*This function is called on to switch the banners out when the time limit is reached */
	shuffle();
	var next = $('.banner.current').next('.banner').length ?
			$('.banner.current').next('.banner') : $('#banners .banner:first');
	$(next).show();
	$(".current").fadeOut().removeClass("current");
	$(next).addClass("current");
	var next_link = $(".active").next("li").length ? $('.active').next('li') : $('#controls li:first');
	$(".active").removeClass("active");
	$(next_link).addClass('active');
}
$(function () {
	/*Initial timer setting */
	slide = setInterval("banner_switch()", 5000);
});
function set_new_interval(interval) {
	/*Simply clears out the old timer interval and restarts it */
	clearInterval(slide);
	slide = setInterval("banner_switch()", interval);
}
function shuffle() {
	/*This function takes every .banner and changes the z-index to 1, hides them,
	 then takes the ".current" banner and brings it above and shows it */
	$(".banner").css("z-index", 1).hide();
	$(".current").css("z-index", 2).show();
}
$(function () {

	var liwid = $(".list1 ul li").width() + 24;
	var len = $(".list1 ul li").size() - 11;
	var index = 0;
	$(".list1 .right").click(function () {
		index++;
		if (index > len) {
			index = len;
			return;
		}
		var leng = -liwid * index;
		$(".list1 ul").animate({left: leng}, 300);


	});

	$(".list1 .left").click(function () {
		index--;
		if (index <= -1) {
			index = 0;
			return;
		}
		var leng = -liwid * index;
		$(".list1 ul").animate({left: leng}, 300);

	});




	var liwid2 = $(".list2 ul li").width() + 24;
	var len2 = $(".list2 ul li").size() - 11;
	var index2 = 0;

	$(".list2 .right").click(function () {
		index2++;
		if (index2 > len2) {
			index2 = len2;
			return;
		}
		var leng2 = -liwid2 * index2;
		$(".list2 ul").animate({left: leng2}, 300);


	});

	$(".list2 .left").click(function () {
		index2--;
		if (index2 <= -1) {
			index2 = 0;
			return;
		}
		var leng2 = -liwid2 * index2;
		$(".list2 ul").animate({left: leng2}, 300);

	});

	var liwid3 = $(".list3 ul li").width() + 24;
	var len3 = $(".list3 ul li").size() - 11;
	var index3 = 0;

	$(".list3 .right").click(function () {
		index3++;
		if (index3 > len3) {
			index3 = len3;
			return;
		}
		var leng3 = -liwid3 * index3;
		$(".list3 ul").animate({left: leng3}, 300);


	});

	$(".list3 .left").click(function () {
		index3--;
		if (index3 <= -1) {
			index3 = 0;
			return;
		}
		var leng2 = -liwid3 * index3;
		$(".list3 ul").animate({left: leng2}, 300);

	});


	$(".ul2 .c a").click(function () {

		$(this).parent().next(".jiaob").show();
		$(this).parent().parent(".ul2").parent(".div_r").next(".pinglun").css("height", "auto");
		$(this).parent().parent(".ul2").parent(".div_r").next(".pinglun").parent(".xxcon").next(".xxbottom").css("background-image", "url('../style/shouqi.png')").css("height", "20px").css("cursor", "pointer");

	})

	$(".xxbottom").click(function () {

		$(this).css("background-image", "url('../style/xxbotback.png')");
		$(this).prev(".xxcon").find(".pinglun").css("height", "0px");
		$(this).prev(".xxcon").find(".jiaob").hide();


	});

})