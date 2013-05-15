<? $this->view('header') ?>
<div id="content" class="page-vote">
	<div class="breadcrumb">
	</div>
	<div class="model recommend">
		<div class="title"><h3>每日热门投票</h3></div>
		<div class="main">
			<div class="info">
				<a href="{url projectvote-view-<?= $recommend_project['p_id'] ?>}"><img src="<?= $recommend_project[image_path] ?><?= $recommend_project[image_name] ?>"></a>
				<ul>
					<li><b>发布企业：</b><?= $recommend_project['co_name'] ?>
						<!--{if $recommend_project[follow]}-->
						<span class="add_attention">已关注</span>
						<!--{else}-->
						<a href="javascript:void(0);" class="pl f3 add_attention" uid="<?= $recommend_project['uid'] ?>">加关注</a>
						<!--{/if}-->
					</li>
					<li><b>项目名称：</b><a href="{url projectvote-view-<?= $recommend_project['p_id'] ?>}"><?= $recommend_project['title'] ?></a></li>
					<li><b>项目介绍：</b><?= $recommend_project['summary'] ?></li>
					<li><b>当前人数：</b><?= $recommend_project['num'] ?>人</li>
				</ul>
			</div>
			<div class="scroll-img">
				<div class="fn-left"><p>他们已经投票</p></div>
				<div class="fn-right">
					<ul id="mycarousel" class="jcarousel-skin-tango">
						<!--{loop $recommend_project_persons $key $data}-->
						<li><a href="index.php?user-space-<?= $data[uid] ?>"><img src="style/default/1.jpg"><span><?= $data['people_name'] ?></span></a></li>
						<!--{/loop}-->
					</ul>
				</div>
			</div>
			<div class="statistics">
				<div class="main">
					<ul>
						<!--{loop $recommend_project_be_vote_persons $key $data}-->
						<li><b><?= $data['percentage'] ?>%</b>的人投票给<span><a href="index.php?user-space-<?= $data[uid] ?>">@<?= $data['people_name'] ?></a></span><br>
							<ul>
								<li>当前投票数：<?= $data['vote'] ?>票</li>
								<li>投票时间：<?= $recommend_project['vote_start_time'] ?> 至 <?= $recommend_project['vote_end_time'] ?></li>
							</ul>
							<a class="btn-a" href="{url projectvote-view-<?= $recommend_project['p_id'] ?>}">我要投票</a>
						</li>
						<!--{/loop}-->
					</ul>
				</div>
				<div class="tail"><a href="{url projectvote-view-<?= $recommend_project['p_id'] ?>}"><< 更多候选名单</a></div>
			</div>
		</div>
	</div>
	<div class="search">
		<div class="title">
			<b class="s14">投票统计</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;进行的投票：<b class="s18"><?= $project_count ?></b>            &nbsp;&nbsp;&nbsp;投票总数：<b class="s18"><?= $user_count ?></b>票
		</div>

		<? $this->view('vote/inner_vote_search') ?>

	</div>

	<div class="model list">
		<div class="title">
			<h3>
				<!--{if $type=='hot'}-->热门投票
				<!--{elseif $type=='starttime'}-->最新投票
				<!--{else}-->
				投票进行时
				<!--{/if}-->		
			</h3>
			<ul>
				<li <!--{if 0 == $order}-->class="on"<!--{/if}-->><a href="{url vote}">默认</a></li>
				<!--{loop $order_list $key $data}-->
				<li <!--{if $data['id'] == $order}-->class="on"<!--{/if}--> ><a href="{url $cat-search-tag-$tag-money-$money-time-$time-user-$user-joinin-$joinin-order-$data['id']}" ><?= $data['name'] ?></a></li>
				<!--{/loop}-->
			</ul>			
		</div>
		<div class="main">

			<div class="model-d fn-left">
				<h4>最新投票</h4>
				<div class="content">

					<!--{loop $list_votestarttime $key $data}-->
					<div class="box">
						<a href="{url projectvote-view-<?= $data['p_id'] ?>}"><img src="style/default/3.jpg"></a>
						<ul>
							<li><b>项目名称：</b><?= $data['title'] ?></li>
							<li><b>项目介绍：</b><?= $data['summary'] ?></li>
							<li><b>发布企业：</b><?= $data['co_name'] ?></li>
							<li><b>项目金额：</b><?= $data['money'] ?></li>
							<li><b>投票时间：</b><?= $data['start_time'] ?> 至 <?= $data['end_time'] ?></li>
							<li class="tags">
								<b>标签：</b>
								<!--{loop $data['tag_list'] $key_tag $data_tag}-->
								<a href="{url list-search-tag-$data_tag['tag_id']}"><?= $data_tag['tag_name'] ?></a>
								<!--{/loop}-->
							</li>
						</ul>
						<div class="join">
							<p><?= $data['total_vote'] ?>票/<?= $data['total_person'] ?>人</p>   <a href="{url projectvote-view-<?= $data['p_id'] ?>}" >我要投票</a>
						</div>
					</div>
					<!--{/loop}-->



				</div>
			</div>



			<div class="model-d fn-right">
				<h4>热门投票</h4>
				<div class="content">

					<!--{loop $list_hotvote $key $data}-->
					<div class="box">
						<a href="{url projectvote-view-<?= $data['p_id'] ?>}"><img src="style/default/3.jpg"></a>
						<ul>
							<li><b>项目名称：</b><?= $data['title'] ?></li>
							<li><b>项目介绍：</b><?= $data['summary'] ?></li>
							<li><b>发布企业：</b><?= $data['co_name'] ?></li>
							<li><b>项目金额：</b><?= $data['money'] ?></li>
							<li><b>投票时间：</b><?= $data['start_time'] ?> 至 <?= $data['end_time'] ?></li>
							<li class="tags">
								<b>标签：</b>
								<!--{loop $data['tag_list'] $key_tag $data_tag}-->
								<a href="{url list-search-tag-$data_tag['tag_id']}"><?= $data_tag['tag_name'] ?></a>
								<!--{/loop}-->
							</li>
						</ul>
						<div class="join">
							<p><?= $data['total_vote'] ?>票/<?= $data['total_person'] ?>人</p>   <a href="{url projectvote-view-<?= $data['p_id'] ?>}" >我要投票</a>
						</div>
					</div>
					<!--{/loop}-->

				</div>
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>