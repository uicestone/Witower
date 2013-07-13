<?$this->view('header')?>
<div id="content" class="page-user model-view">
	<ul class="breadcrumb">
		<li>
			<strong>用户</strong>
			<span class="divider">/</span>
		</li>
		<li>
<?if($user['id']==$this->user->id){?>
			我的首页
<?}else{?>
			<?=$user['name']?>
<?}?>
		</li>
	</ul>
	<div id="left">
<?if($user['id']===$this->user->id){?>
		<form method="post" action="/user/addstatus">
			<div class="model model-b weibo-send">
				<div class="main">
					<textarea name="content" rows="4" cols=""></textarea>
					<div class="buttons">
						<div class="fn-right">
							<button type="submit" value="1" class="btn btn-primary">发表</button>
						</div>
					</div>
				</div>
			</div>
		</form>
<?}?>
		<div class="model model-b category">
			<ul>
				<li><a href="/<?=uri_string()?>" class="f10">全部</a></li>|
				<li><a href="/<?=uri_string()?>?statustype=project" class="f10">项目</a></li>|
				<li><a href="/<?=uri_string()?>?statustype=vote" class="f10">投票</a> </li>
			</ul>
		</div>
<?foreach($status as $status){?>
		<div id="<?=$status['id']?>" class="model model-b">
			<div class="main">
				<div class="detail">
					<div class="main">
						<p><span name=<?=$status['username']?>><img src="/uploads/images/avatar/<?=$status['user']?>_100.jpg" class="user_img"></span><?=$status['content']?></p>
					</div>
					<div class="tail icons">
						<?=date('Y-m-d H:i:s',$status['time'])?>
						<ul>
							<li><span class="icon-comment"></span><a href="#" class="btn-comment">评论(<?=count($status['comments'])?>)</a></li>
						</ul>
					</div>
					<div class="sub_comment" style="display:none">
						<div class="comment">
							<form>
								<textarea name="comment-content" placeholder="评论内容"></textarea>
								<button type="button" name="comment-content-submit" class="btn">提交</button>
							</form>
						</div>
						<ul class="comment-list">
<?	foreach($status['comments'] as $status_comment){?>
							<li>
								<p class="content"><?=$status_comment['content']?></p><span class="time"><?=$status_comment['time']?></span>
								<span class="avatar"><a href="/space/<?=$status_comment['user']?>"><img src="/uploads/images/avatar/<?=$status_comments['user']?>_30.jpg" class="user_img"></a></span>
							</li>
<?	}?>
						</ul>
					</div>
				</div>
			</div>
		</div>
<?}?>
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
		<form method="post" action="/?user-search" class="form-search" style="margin-top:10px;">
			<input type="text" name='keyword' placeholder="搜索用户" style="margin-left:10px; width: 125px;" />
			<button type="submit" name="search" class="btn">搜索</button>
		</form>
		<div class="box my-box">
			<div>
				<img src="/uploads/images/avatar/<?=$user['id']?>_100.jpg" />
				<h1><?=$user['name']?></h1>
				<p><?followButton($user['id'])?></p>
<?if($this->user->isLogged('usermanager') && !$this->user->inGroup('blacklist',$user['id'])){?>
				<p><a href="/user/addtoblacklist/<?=$user['id']?>" class="btn btn-mini">加入黑名单</a></p>
<?}?>
<?if($this->user->inGroup('blacklist',$user['id'])){?>
				<p><a href="/user/removefromblacklist/<?=$user['id']?>" class="btn btn-mini">移出黑名单</a></p>
<?}?>
			</div>
			<table>
				<tr>
					<td><a href="#">关注</a></td>
					<td><a href="#">粉丝</a></td>
					<td><a href="#">微博</a></td>
				</tr>
				<tr>
					<td><?=$user['follows']?></td>
					<td><?=$user['fans']?></td>
					<td><?=$user['statuses']?></td>
				</tr>
			</table>
        </div>
	<!--TODO 区分空间和主页，并不是已登录用户是否本人来判断-->
        <!--{if $function=='home'}-->
		<div class="box my-nav">
			<dl>
				<dt>我的微博</dt>
				<dd><span class="icon-hand-right"></span><a href="#">提到我的</a></dd>
				<dd><span class="icon-user"></span><a href="#">评论</a></dd>
				<dd><span class="icon-envelope"></span><a href="#">私信</a></dd>
				<dd><span class="icon-exclamation-sign"></span><a href="#">通知</a></dd>
				<dd><span class="icon-heart"></span><a href="#">收藏</a></dd>
				<dd><span class="icon-th-large"></span><a href="#">我的邀请</a></dd>

				<dt>我的成果</dt>

				<dt>我的统计</dt>
				<dd><span class="icon-folder-close"></span><a href="#">活动数量(<?//TODO 用户参与活动数?>)</a></dd>
				<dd><span class="icon-align-left"></span><a href="#">投票数量(<?//用户参与投票数?>)</a></dd>
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
				<button><img src="style/icon-search.png"></button>
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
					<li> <a href="#"><img src="style/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
					<li> <a href="#"><img src="style/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
					<li> <a href="#"><img src="style/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
					<li> <a href="#"><img src="style/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
					<li> <a href="#"><img src="style/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
					<li> <a href="#"><img src="style/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
					<li> <a href="#"><img src="style/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
					<li> <a href="#"><img src="style/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>
				</ul>
			</div>
		</div>
		<!--{/if}-->

	</div>
</div>
<?$this->view('footer')?>