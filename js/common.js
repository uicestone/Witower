function tabChange(title,content){
	$(content).not(":first").hide(); //Hide all content
	$(title).eq(0).addClass("curr active").show(); //Activate first tab
	$(title).each(function(i) {
		$(this).click(function(e){
		$(title).removeClass("curr active"); //Remove any "curr" class
		$(this).addClass("curr active"); //Add "curr" class to selected tab
		$(content).hide();
		$(content).eq(i).show();
		e.preventDefault();
		})
	});
	}


$(document).ready(function() {

	$(".page-company").each(function(){
		var $title = $(this).find("#right .main .nav li");
		var $content = $(this).find("#right .main .show_content");
		tabChange($title,$content);
	})


	var Request = {};
	Request.r1 = "/index.php?user-getmicroblogcomments-";
	Request.flags = "index.php?projectvote-vote-1-";
	Request.addAttention = "index.php?user-addfocus-";

	$("a[href = '#']").click(function(e){e.preventDefault();});// prevent every anchor default event

 var $container = $('div.water');
	$container.imagesLoaded(function(){
		$container.masonry({
			itemSelector : '.box',
			columnWidth : 196
		});
	});

	$('#mycarousel').jcarousel({
		visible:10
	});




	 // Totop
	var GoToTop = (function(){
		$(window).scroll(function(){
			if($(this).scrollTop()!=0){
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
			if($.data(td, "num") == undefined){
				$.data(td, "num",0);
				$input.val(0);
			}else{}
			var num = $.data(td, "num");

			$(this).find("img:lt(" + (num + 1) + ")").each(function(){
				$(this).attr("src","style/default/flag.png");
				$.data(td, "num",(num+1));
			});
			$input.val(num+1);
			if(count == 3){
				$(".flags img").each(function(){
					$(this).attr("src","style/default/flag-off.png");
				});
			}else{
				$(".flags img:gt(" + (2-count) + ")").each(function(){
					$(this).attr("src","style/default/flag-off.png");
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
			$(".voting table td.images img").attr("src","style/default/flag-off.png");
			$(".flags img").attr("src","style/default/flag.png");
		});



	}());



	var Comment = (function(){
		$(".model").on("click",".btn-comment",function(){
			var microblogId = $(this).parents(".model:first").attr("id");

			var subComment=$(this).parent('li').parent('ul').parent('div').siblings('.sub_comment');
			
			subComment.show();
			
			return false;

/*			$.get(Request.r1 + microblogId,function(data){

				var contentHtml = "";
				$.each(data,function(i,val){
					contentHtml += "<li><p>" + val["content"] + "<span>" + val["time"] + "</span><img src=" + val["username"] + " /></p></li>"
				});

				

			},"json");
*/
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
			var $self = $(this)
			$.get(Request.addAttention + userId,function(data){
				if(data == "success"){
					$self.html("已关注").removeClass("add_attention").addClass("added").unbind("mouseup");
				}else{}
			});
		});
	}());
});