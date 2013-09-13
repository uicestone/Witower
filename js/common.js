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

	var Request = {};
	Request.r1 = 'user/getstatuscomments/';
	Request.flags = '/vote-vote-1-';
	Request.addAttention = '/user/follow/';

	$("a[href = '#']").click(function(e){e.preventDefault();});// prevent every anchor default event

 var $container = $('div.water');
	$container.imagesLoaded(function(){
		$container.masonry({
			itemSelector : '.box',
			columnWidth : 196
		});
	});
	
	$container.children('.box').show();

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
			
			subComment.show();
			
			return false;

		})
		
		.on('click','[name="comment-content-submit"]',function(){
			
			var microblogId = $(this).parents(".model:first").attr("id");
			
			var commentContent=$(this).siblings('[name="comment-content"]').val();
			
			$.post('/index.php?user-addmicroblogcomment-'+microblogId,{commentContent:commentContent},function(response){
				$('.model#'+microblogId+' ul.comment-list').prepend('<li><p class="content">'+response.content+'</p><span class="time">'+response.time+'</span><span class="avatar"><a href="/?user-space-'+response.uid+'"><img src="/uploads/userface/'+response.uid+'.jpg_30.jpg"></a></span></li>');
				$(this).siblings('input[name="comment-content"]').val('');
			},'json');
			return false;
		});
	}());
	
	var addAttention = (function(){
		$(".add_attention").mouseup(function(){
			var userId = $(this).attr("uid");
			var $self = $(this);
			$.get(Request.addAttention + userId,function(data){
				if(data === 'success'){
					$self.html("已关注").removeClass("add_attention").addClass("added").unbind("mouseup");
				}else{}
			});
		});
	}());
});