<?$this->view('header')?>
<div id="content" class="page-user model-view">
	<div class="breadcrumb">
		<strong>用户</strong><span>&nbsp;&gt;&nbsp;<!--{if $function=='home'}-->我的主页<!--{elseif $function=='space'}--><?=$userinfo[username]?><!--{/if}--></span>
	</div>
	<div><form method="post" action="/?user-search"><input type="text" name='keyword' placeholder="搜索用户" /><input type="submit" name="search" value="搜索" class="btn"></form></div>
	<div id="left">
		<!--{if $function=='home'}-->
		<form method="post">
			<div class="model model-b weibo-send">
				<div class="main">
					<textarea name="content" rows="4" cols=""></textarea>
					<div class="buttons">
						<!--                    <a href="#">表情</a>
											<a href="#">图片</a>
											<a href="#">音乐</a>
											<a href="#">视频</a>-->
						<div class="fn-right">
							<button type="submit" name="addmicroblog" value="1" class="btn btn-info">发表</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!--{/if}-->

		<div class="model model-b category">
			<ul>
				<li><a href="/?user-home" class="f10">全部</a></li>|
				<li><a href="/?user-home-project" class="f10">项目</a></li>|
				<li><a href="/?user-home-vote" class="f10">投票</a> </li>
				<!--                      <li><a href="/?user-home-masterpiece" class="f10">成果</a></li>|
									  <li><a href="/?user-home-blogs" class="f10">博文心情</a></li>-->
			</ul>
		</div>
		<!--{loop $microblogs $microblog}-->
		<div id="<?=$microblog['id']?>" class="model model-b">
			<div class="main">
				<div class="detail">
					<div class="main">
						<p><span name=<?=$microblog['username']?>><img src="style/default/p6.jpg" class="user_img"></span><?=$microblog['content']?></p>
					</div>
					<div class="tail icons">
						<?=$microblog['time']?>
						<ul>
							<li class="cat-1"><a href="#">转发(<?=$microblog['reposts']?>)</a></li>
							<li class="cat-2"><a href="#" class="btn-comment">评论(<?=$microblog['comments']?>)</a></li>
						</ul>
					</div>
					<div class="sub_comment" style="display:none">
						<div class="comment">
							<input name="comment-content" placeholder="评论内容">
							<button type="button" name="comment-content-submit">提交</button>
						</div>
						<ul class="comment-list">
							<!--{loop $microblogs_comments[$microblog['id']] $microblog_comments}-->
							<li>
								<p class="content"><?=$microblog_comments['content']?></p><span class="time"><?=$microblog_comments['time']?></span>
								<span class="avatar"><a href="/?user-space-<?=$microblog_comments['uid']?>"><img src="/uploads/userface/<?=$microblog_comments['uid']?>.jpg_30.jpg" class="user_img"></a></span>
							</li>
							 <!--{/loop}-->
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!--{/loop}-->
		<!--          <div class="paginator model-b">
				<span class="prev">
					&lt;前页
				</span>
		
		
		
					  <span class="thispage">1</span>
		
					  <a href="/?start=20&amp;uid=42392552">2</a>
		
		
					  <a href="/?start=40&amp;uid=42392552">3</a>
		
		
					  <a href="/?start=60&amp;uid=42392552">4</a>
		
		
					  <a href="/?start=80&amp;uid=42392552">5</a>
		
					  <span class="break">...</span>
				<span class="next">
					<link href="/?start=20&amp;uid=42392552" rel="next">
					<a href="/?start=20&amp;uid=42392552">后页&gt;</a>
				</span>
		
				  </div>-->
	</div>
	<div id="right" class="sidebar">
		<div class="box my-box">
			<div>
				<img src="uploads/userface/<?=$userinfo['uid']?>.jpg" />
				<h1><?=$userinfo['username']?>
					<!--{if $function == 'space'}-->
					<!--{if $focused}-->
					<span>已关注</span>
					<!--{else}-->
					<button class="btn add_attention" uid="<?=$userinfo['uid']?>">加关注</button>
					<!--{/if}-->
					<!--{/if}-->
				</h1>				
				<!--TODO provice 和 city值从数据库中取到-->
				<p><?=$userinfo['province']?> <?=$userinfo['city']?></p>
			</div>
			<table>
				<tr>
					<td><a href="#">关注</a></td>
					<td><a href="#">粉丝</a></td>
					<td><a href="#">微博</a></td>
				</tr>
				<tr>
					<td><?=$userinfo['focuses']?></td>
					<td><?=$userinfo['fans']?></td>
					<td><?=$userinfo['microblogs']?></td>
				</tr>
			</table>
        </div>
        <!--{if $function=='home'}-->
		<div class="box my-nav">
			<dl>
				<dt>我的微博</dt>
				<dd class="cat-1"><a href="#">提到我的</a></dd>
				<dd class="cat-2"><a href="#">评论</a></dd>
				<dd class="cat-3"><a href="#">私信</a></dd>
				<dd class="cat-4"><a href="#">通知</a></dd>
				<dd class="cat-5"><a href="#">收藏</a></dd>
				<dd class="cat-6"><a href="#">我的邀请</a></dd>

				<dt>我的成果</dt>

				<dt>我的统计</dt>
				<dd class="cat-7"><a href="#">活动数量(20)</a></dd>
				<dd class="cat-8"><a href="#">投票数量(15)</a></dd>
				<!--<dd class="cat-9"><a href="#">我的积分</a></dd>-->
				<dd class="cat-10"><a href="#">悬赏积分</a></dd>
			</dl>
		</div>
		<!--{elseif $function=='space'}-->
<!--		<div class="box">
			<div class="com-box">
				<select>
					<option>搜索标签</option>
					<option>投票</option>
					<option>活动</option>
				</select>
				<input type="text">
				<button><img src="style/default/icon-search.png"></button>
			</div>
		</div>-->
		<div class="box">
			<div class="title">
				<h3>Ta收藏的标签</h3><a href="#" class="more">more</a>
			</div>
			<div class="main tags-cloud">
				<!--{loop $favorite_tags $tag}-->
				<a href="#"><?=$tag['tag_name']?></a>
				<!--{/loop}-->
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>热门的标签</h3><a href="#" class="more">more</a>
			</div>
			<div class="main tags-cloud">
				<!--{loop $hot_tags $tag}-->
				<a href="#"><?=$tag['tag_name']?></a>
				<!--{/loop}-->
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>推荐活动</h3><a href="#" class="more">more</a>
			</div>
			<div class="main">
				<ul>
					<li> <a href="#">IPHONE4S手机创意广告项目结束</a></li>
					<li> <a href="#">IPHONE4S手机创意广告项目结束</a></li>
					<li> <a href="#">IPHONE4S手机创意广告项目结束</a></li>
					<li> <a href="#">IPHONE4S手机创意广告项目结束</a></li>
					<li> <a href="#">IPHONE4S手机创意广告项目结束</a></li>
					<li> <a href="#">IPHONE4S手机创意广告项目结束</a></li>
				</ul>
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>投票进行时</h3><a href="#" class="more">more</a>
			</div>
			<div class="main">
				<ul>
					<li> <a href="#">IPHONE4S手机创意广告项目结束</a></li>
					<li> <a href="#">IPHONE4S手机创意广告项目结束</a></li>
					<li> <a href="#">IPHONE4S手机创意广告项目结束</a></li>
					<li> <a href="#">IPHONE4S手机创意广告项目结束</a></li>
					<li> <a href="#">IPHONE4S手机创意广告项目结束</a></li>
					<li> <a href="#">IPHONE4S手机创意广告项目结束</a></li>
				</ul>
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>Ta关注的企业 (23)</h3><a href="#" class="more">more</a>
			</div>
			<div class="main image">
				<ul>
					<li> <a href="#"><img src="style/default/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
					<li> <a href="#"><img src="style/default/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
					<li> <a href="#"><img src="style/default/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
					<li> <a href="#"><img src="style/default/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
					<li> <a href="#"><img src="style/default/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
					<li> <a href="#"><img src="style/default/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
					<li> <a href="#"><img src="style/default/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
					<li> <a href="#"><img src="style/default/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
				</ul>
			</div>
		</div>
		<!--{/if}-->

	</div>
</div>
<?$this->view('footer')?>