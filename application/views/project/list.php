<?$this->view('header')?>
<div id="content" class="page-list">
	<div class="breadcrumb">
	</div>

	<?$this->view('project/inner_recommend')?>

	<div class="search">
		<div class="title">
			<b class="s14">项目统计</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;进行的项目：<b class="s18"><?=$active_project?></b>         &nbsp;&nbsp;&nbsp;参与的人数：<b class="s18"><?=$participants?></b>人
		</div>

		<?$this->view('project/inner_search')?>

	</div>

	<div class="model">
		<div class="title">
			<h3>
				<!--{if $type=='hot'}-->人气项目
				<!--{elseif $type=='money'}-->项目金额
				<!--{elseif $type=='starttime'}-->最新项目
				<!--{else}-->
				项目列表
				<!--{/if}-->		
			</h3>
			<ul>
				<li <!--{if 0 == $order}-->class="on"<!--{/if}-->><a href="{url list}">默认</a></li>
				<!--{loop $order_list $key $data}-->
				<li <!--{if $data['id'] == $order}-->class="on"<!--{/if}--> ><a href="{url $cat-search-tag-0-money-$money-time-$time-user-$user-order-$data['id']}" ><?=$data['name']?></a></li>
				<!--{/loop}-->
			</ul>			
		</div>
		<div class="main">
			<div class="model-a">
				<h4>最新项目</h4>

				<?foreach($latest_projects as $project){?>
				<div class="main">
                                    <a href="project-view-<?=$project['id']?>"><img src="uploads/images/project/<?=$project['id']?>_200.jpg"></a>
					<ul>
						<li><b>项目名称：</b><?=$project['name']?></li>
						<li><b>项目介绍：</b><?=$project['summary']?></li>
						<li><b>发布企业：</b><?=$project['company_name']?></li>
						<li><b>项目金额：</b><?=$project['bonus']?></li>
						<li><b>项目时间：</b><?=$project['date_start']?> 至 <?=$project['date_end']?></li>
						<li class="tags">
							<b>标签：</b>
							<?foreach($project['labels'] as $labels){?>
								<a href="<?=$labels?>"><?=$labels?></a>
							<?}?>
						</li>
					</ul>
				</div>
				<div class="tail icons">
					<ul>
						<li class="cat-1"><a href="/project/<?=$project['id']?>">(<?=$project['comments_count']?>)</a></li>
						<li class="cat-2"><a href="/project/<?=$project['id']?>">(<?=$project['favorites']?>)</a></li>
						<li class="cat-3"><a href="/project/<?=$project['id']?>">(<?=$project['company']?>)</a></li>
					</ul>
				</div>
				<?}?>

			</div>
			<div class="model-a">
				<h4>人气项目</h4>

				<?foreach($hotprojects as $project){?>
				<div class="main">
					<a href="project-view-<?=$project['id']?>"><img src="uploads/images/project/<?=$project['id']?>_200.jpg"></a>
					<ul>
						<li><b>项目名称：</b><?=$project['name']?></li>
						<li><b>项目介绍：</b><?=$project['summary']?></li>
						<li><b>发布企业：</b><?=$project['company_name']?></li>
						<li><b>项目金额：</b><?=$project['bonus']?></li>
						<li><b>项目时间：</b><?=$project['date_start']?> 至 <?=$project['date_end']?></li>
						<li class="tags">
							<b>标签：</b>
							<?foreach($project['labels'] as $labels){?>
								<a href="<?=$labels?>"><?=$labels?></a>
							<?}?>
						</li>
					</ul>
				</div>
				<div class="tail icons">
					<ul>
						<li class="cat-1"><a href="/project/<?=$project['id']?>">(<?=$project['comments_count']?>)</a></li>
						<li class="cat-2"><a href="/project/<?=$project['id']?>">(<?=$project['favorites']?>)</a></li>
						<li class="cat-3"><a href="/project/<?=$project['id']?>">(<?=$project['company']?>)</a></li>
					</ul>
				</div>
				<?}?>

			</div>
			<div class="model-a">
				<h4>项目金额</h4>

				<?foreach($bonus_projects as $project){?>
				<div class="main">
					<a href="project-view-<?=$project['id']?>"><img src="uploads/images/project/<?=$project['id']?>_200.jpg"></a>
					<ul>
						<li><b>项目名称：</b><?=$project['name']?></li>
						<li><b>项目介绍：</b><?=$project['summary']?></li>
						<li><b>发布企业：</b><?=$project['company_name']?></li>
						<li><b>项目金额：</b><?=$project['bonus']?></li>
						<li><b>项目时间：</b><?=$project['date_start']?> 至 <?=$project['date_end']?></li>
						<li class="tags">
							<b>标签：</b>
							<?foreach($project['labels'] as $labels){?>
								<a href="<?=$labels?>"><?=$labels?></a>
							<?}?>
						</li>
					</ul>
				</div>
				<div class="tail icons">
					<ul>
						<li class="cat-1"><a href="/project/<?=$project['id']?>">(<?=$project['comments_count']?>)</a></li>
						<li class="cat-2"><a href="/project/<?=$project['id']?>">(<?=$project['favorites']?>)</a></li>
						<li class="cat-3"><a href="/project/<?=$project['id']?>">(<?=$project['company']?>)</a></li>
					</ul>
				</div>
				<?}?>

			</div>
			</div>
	</div>
</div>
<?$this->view('footer')?>
