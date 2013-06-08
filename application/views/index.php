<? $this->view('header') ?>

<div id="content">
<? $this->view('index_left') ?>
<!--div class="info">
	<div class="fn-left">
		<ul>
			<li><a href="#">最新</a></li>
			<li><a href="#">人气</a></li>
			<li><a href="#">精品</a></li>
		</ul>
	</div>
	<div class="fn-right">
		交易数量：<span>1,534</span>个    交易金额：<span>1,657,353</span>元    新增用户：<span>5,772</span>人
		<div class="search-bar">
			<ul>
				<li><input type="text"></li>
				<li class="category">
					列别1
					<ul>
						<li>列别1</li>
						<li>列别1</li>
						<li>列别1</li>
						<li>列别1</li>
					</ul>
				</li>
				<li>
					<input type="button" value="搜索">
				</li>
			</ul>
		</div>
	</div>
</div-->

<div class="water">
	<? foreach ($projects as $project) {//这里的单个project是c里面projects下面的子数组 然后 每个里面的 id  XX XX 对吧?>
		<div class="box">
			<div class="img cell">
				<!--img src="style/p.jpg"-->
				<a href="/project/<?= $project['id'] ?>">
					<img src="/uploads/images/project/<?= $project['id'];?>_100.jpg">
				</a>
				<p><?= $project['name'] ?></p>
			</div>
			<div class="details cell">
				项目金额 ：<span class="price"><?= $project['bonus'] ?>元</span><br>
				截止日期 ： <?=$project['date_end'] ?><br>
				标签：
				<? foreach ($project['tags'] as $tag) { ?>
					<a class="f3" href="#"><?= $tag ?></a>
				<? } ?>
				<ul>
					<a href="/project/<?= $project['id'] ?>"><li class="cat-1" title="参与">(<?= $project['participants'] ?>)</li></a>
					<a href="/project/<?= $project['id'] ?>"><li class="cat-2" title="讨论">(<?= $project['comments_count'] ?>)</li></a>
					<a href="/project/<?= $project['id'] ?>"><li class="cat-3" title="收藏">(<?= $project['favorites'] ?>)</li></a>
				</ul>
			</div>
			<div class="users cell">
				<p><? //=$project[summary]   ?></p>
				<ul>
					<? foreach ($project['comments'] as $comment) { ?>
								<li><a href="/space/<?= $comment['user'] ?>"><!--<img src="style/p5.jpg">--><img src="/uploads/images/avartar/<?=$comment['user'] ?>_30.jpg"></a>
							<p><a href="/space/<?= $comment['user'] ?>"><?= $comment['username'] ?>：</a><?= $comment['content'] ?></p>
						</li>
					<? } ?>
				</ul>
			</div>
			<div class="tail cell"> <a href="/project/<?= $project['id'] ?>"> >>> </a></div>
		</div>
	<? } ?>
	<!--        
			<div class="box">
				<div class="img cell">
					<img src="style/p.jpg">
					<p>玖城品牌策划设计</p>
				</div>
				<div class="details cell">
					项目金额 ：<span class="price">88888元</span>       <br>
					截止日期 ： 2012-04-22<br>
					标签：<a class="f3" href="#">集团</a><a class="f3" href="#">品牌</a><a class="f3" href="#">名片</a>
					<ul>
						<li class="cat-1">(16)</li>
						<li class="cat-2">(16)</li>
						<li class="cat-3">(16)</li>
					</ul>
				</div>
				<div class="users cell">
					<p>IT产业不断发展中，逐渐摸索出自己的产业发展规律，有人将他们统称为IT定律。下面这张图我们将介绍摩尔定律、安迪比尔定</p>
					<ul>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
					</ul>
				</div>
				<div class="tail cell"> <a href="#"> >>> </a></div>
			</div>
			<div class="box">
				<div class="img cell">
					<img src="style/p.jpg">
					<p>玖城品牌策划设计</p>
				</div>
				<div class="details cell">
					项目金额 ：<span class="price">88888元</span>       <br>
					截止日期 ： 2012-04-22<br>
					标签：<a class="f3" href="#">集团</a><a class="f3" href="#">品牌</a><a class="f3" href="#">名片</a>
					<ul>
						<li class="cat-1">(16)</li>
						<li class="cat-2">(16)</li>
						<li class="cat-3">(16)</li>
					</ul>
				</div>
				<div class="users cell">
					<p>IT产业不断发展中，逐渐摸索出自己的产业发展规律，有人将他们统称为IT定律。下面这张图我们将介绍摩尔定律、安迪比尔定</p>
					<ul>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
					</ul>
				</div>
				<div class="tail cell"> <a href="#"> >>> </a></div>
			</div>
			<div class="box">
				<div class="img cell">
					<img src="style/p.jpg">
					<p>玖城品牌策划设计</p>
				</div>
				<div class="details cell">
					项目金额 ：<span class="price">88888元</span>       <br>
					截止日期 ： 2012-04-22<br>
					标签：<a class="f3" href="#">集团</a><a class="f3" href="#">品牌</a><a class="f3" href="#">名片</a>
					<ul>
						<li class="cat-1">(16)</li>
						<li class="cat-2">(16)</li>
						<li class="cat-3">(16)</li>
					</ul>
				</div>
				<div class="users cell">
					<p>IT产业不断发展中，逐渐摸索出自己的产业发展规律，有人将他们统称为IT定律。下面这张图我们将介绍摩尔定律、安迪比尔定</p>
					<ul>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
					</ul>
				</div>
				<div class="tail cell"> <a href="#"> >>> </a></div>
			</div>
			<div class="box">
				<div class="img cell">
					<img src="style/p.jpg">
					<p>玖城品牌策划设计</p>
				</div>
				<div class="details cell">
					项目金额 ：<span class="price">88888元</span>       <br>
					截止日期 ： 2012-04-22<br>
					标签：<a class="f3" href="#">集团</a><a class="f3" href="#">品牌</a><a class="f3" href="#">名片</a>
					<ul>
						<li class="cat-1">(16)</li>
						<li class="cat-2">(16)</li>
						<li class="cat-3">(16)</li>
					</ul>
				</div>
				<div class="users cell">
					<p>IT产业不断发展中，逐渐摸索出自己的产业发展规律，有人将他们统称为IT定律。下面这张图我们将介绍摩尔定律、安迪比尔定</p>
					<ul>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
					</ul>
				</div>
				<div class="tail cell"> <a href="#"> >>> </a></div>
			</div>
			<div class="box">
				<div class="img cell">
					<img src="style/p.jpg">
					<p>玖城品牌策划设计</p>
				</div>
				<div class="details cell">
					项目金额 ：<span class="price">88888元</span>       <br>
					截止日期 ： 2012-04-22<br>
					标签：<a class="f3" href="#">集团</a><a class="f3" href="#">品牌</a><a class="f3" href="#">名片</a>
					<ul>
						<li class="cat-1">(16)</li>
						<li class="cat-2">(16)</li>
						<li class="cat-3">(16)</li>
					</ul>
				</div>
				<div class="users cell">
					<p>IT产业不断发展中，逐渐摸索出自己的产业发展规律，有人将他们统称为IT定律。下面这张图我们将介绍摩尔定律、安迪比尔定</p>
					<ul>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
					</ul>
				</div>
				<div class="tail cell"> <a href="#"> >>> </a></div>
			</div>
			<div class="box">
				<div class="img cell">
					<img src="style/p.jpg">
					<p>玖城品牌策划设计</p>
				</div>
				<div class="details cell">
					项目金额 ：<span class="price">88888元</span>       <br>
					截止日期 ： 2012-04-22<br>
					标签：<a class="f3" href="#">集团</a><a class="f3" href="#">品牌</a><a class="f3" href="#">名片</a>
					<ul>
						<li class="cat-1">(16)</li>
						<li class="cat-2">(16)</li>
						<li class="cat-3">(16)</li>
					</ul>
				</div>
				<div class="users cell">
					<p>IT产业不断发展中，逐渐摸索出自己的产业发展规律，有人将他们统称为IT定律。下面这张图我们将介绍摩尔定律、安迪比尔定</p>
					<ul>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
					</ul>
				</div>
				<div class="tail cell"> <a href="#"> >>> </a></div>
			</div>
			<div class="box">
				<div class="img cell">
					<img src="style/p.jpg">
					<p>玖城品牌策划设计</p>
				</div>
				<div class="details cell">
					项目金额 ：<span class="price">88888元</span>       <br>
					截止日期 ： 2012-04-22<br>
					标签：<a class="f3" href="#">集团</a><a class="f3" href="#">品牌</a><a class="f3" href="#">名片</a>
					<ul>
						<li class="cat-1">(16)</li>
						<li class="cat-2">(16)</li>
						<li class="cat-3">(16)</li>
					</ul>
				</div>
				<div class="users cell">
					<p>IT产业不断发展中，逐渐摸索出自己的产业发展规律，有人将他们统称为IT定律。下面这张图我们将介绍摩尔定律、安迪比尔定</p>
					<ul>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
					</ul>
				</div>
				<div class="tail cell"> <a href="#"> >>> </a></div>
			</div>
			<div class="box">
				<div class="img cell">
					<img src="style/p.jpg">
					<p>玖城品牌策划设计</p>
				</div>
				<div class="details cell">
					项目金额 ：<span class="price">88888元</span>       <br>
					截止日期 ： 2012-04-22<br>
					标签：<a class="f3" href="#">集团</a><a class="f3" href="#">品牌</a><a class="f3" href="#">名片</a>
					<ul>
						<li class="cat-1">(16)</li>
						<li class="cat-2">(16)</li>
						<li class="cat-3">(16)</li>
					</ul>
				</div>
				<div class="users cell">
					<p>IT产业不断发展中，逐渐摸索出自己的产业发展规律，有人将他们统称为IT定律。下面这张图我们将介绍摩尔定律、安迪比尔定</p>
					<ul>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
					</ul>
				</div>
				<div class="tail cell"> <a href="#"> >>> </a></div>
			</div>
			<div class="box">
				<div class="img cell">
					<img src="style/p.jpg">
					<p>玖城品牌策划设计</p>
				</div>
				<div class="details cell">
					项目金额 ：<span class="price">88888元</span>       <br>
					截止日期 ： 2012-04-22<br>
					标签：<a class="f3" href="#">集团</a><a class="f3" href="#">品牌</a><a class="f3" href="#">名片</a>
					<ul>
						<li class="cat-1">(16)</li>
						<li class="cat-2">(16)</li>
						<li class="cat-3">(16)</li>
					</ul>
				</div>
				<div class="users cell">
					<p>IT产业不断发展中，逐渐摸索出自己的产业发展规律，有人将他们统称为IT定律。下面这张图我们将介绍摩尔定律、安迪比尔定</p>
					<ul>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
					</ul>
				</div>
				<div class="tail cell"> <a href="#"> >>> </a></div>
			</div>
			<div class="box">
				<div class="img cell">
					<img src="style/p.jpg">
					<p>玖城品牌策划设计</p>
				</div>
				<div class="details cell">
					项目金额 ：<span class="price">88888元</span>       <br>
					截止日期 ： 2012-04-22<br>
					标签：<a class="f3" href="#">集团</a><a class="f3" href="#">品牌</a><a class="f3" href="#">名片</a>
					<ul>
						<li class="cat-1">(16)</li>
						<li class="cat-2">(16)</li>
						<li class="cat-3">(16)</li>
					</ul>
				</div>
				<div class="users cell">
					<p>IT产业不断发展中，逐渐摸索出自己的产业发展规律，有人将他们统称为IT定律。下面这张图我们将介绍摩尔定律、安迪比尔定</p>
					<ul>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
					</ul>
				</div>
				<div class="tail cell"> <a href="#"> >>> </a></div>
			</div>
			<div class="box">
				<div class="img cell">
					<img src="style/p.jpg">
					<p>玖城品牌策划设计</p>
				</div>
				<div class="details cell">
					项目金额 ：<span class="price">88888元</span>       <br>
					截止日期 ： 2012-04-22<br>
					标签：<a class="f3" href="#">集团</a><a class="f3" href="#">品牌</a><a class="f3" href="#">名片</a>
					<ul>
						<li class="cat-1">(16)</li>
						<li class="cat-2">(16)</li>
						<li class="cat-3">(16)</li>
					</ul>
				</div>
				<div class="users cell">
					<p>IT产业不断发展中，逐渐摸索出自己的产业发展规律，有人将他们统称为IT定律。下面这张图我们将介绍摩尔定律、安迪比尔定</p>
					<ul>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
						<li><img src="style/p5.jpg">
							<p><a href="#">用户名：</a>产业不断发展中，逐渐摸索出自己的产业发展规律</p>
						</li>
					</ul>
				</div>
				<div class="tail cell"> <a href="#"> >>> </a></div>
			</div>
	-->
</div>
<!--{if !$user[uid]}-->
<div class="login">
	<p>
		想看更多？请<a href="/signup">注册</a>或<a href="/login">登录</a>
	</p>
</div>
<!--{/if}-->

</div>

<? $this->view('footer') ?>
