<? $this->view('header') ?>
<div id="content" class="page-viewproject model-view">
	<div class="breadcrumb">

	</div>

	<div id="left">
		<div class="model model-b">
			<div class="main">
				<div><img src="/uploads/images/project/<?=$project['id']?>_100.jpg"><br>
					<span>
						<!--{if $project[follow]}-->
						<span class="add_attention">已关注</span>
						<!--{else}-->
						<a href="javascript:void(0);" class="add_attention" uid="<?= $recommend_project['uid'] ?>">加关注</a>
						<!--{/if}-->                        
					</span>
				</div>
				<ul>
					<li><b>发布企业：</b><?= $project['company_name'] ?></li>
					<li><b>发布金额：</b><?= $project['bonus'] ?>元 </li>
					<li><b>被编辑次数：</b><?= $project['join_num'] ?>次<b>被讨论次数：</b><?= $project['comments_count'] ?>次<b>项目截止日期：</b><?= $project['date_end'] ?></li>
					<li><b>活动状态：</b>进行中 </li>
					<li class="tags">
						<b>标签：</b>
						<?foreach($project['labels'] as $project){?>
						<a href="{url list-search-tag-$data['tag_id']}"><?= $project ?></a>
						<?}?>
					</li>
				</ul>
				<div class="descript">
					<div class="fn-left"><img src="style/5.jpg"></div><div class="fn-right">
						<p><?= $project['summary'] ?><a href="#">[了解更多]</a></p>
						<div class="button">
							<div class="fn-left">


								<!-- Baidu Button BEGIN -->
								<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
									<a class="bds_qzone"></a>
									<a class="bds_tsina"></a>
									<a class="bds_tqq"></a>
									<a class="bds_renren"></a>
									<a class="bds_t163"></a>
									<span class="bds_more">更多</span>
								</div>
								<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=5594603" ></script>
								<script type="text/javascript" id="bdshell_js"></script>
								<script type="text/javascript">
									document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date() / 3600000)
								</script>
								<!-- Baidu Button END -->                            


							</div>
							<div class="fn-right">
								<a class="btn-c" href="{url doc-create-$project['p_id']}">发布创意</a>
							</div>

						</div>
					</div>
				</div>
				<div class="detail">
					<div class="title"><h3>公司介绍</h3></div>
					<div class="main">
						<img src="style/5.jpg">
						<p>杭州疑现“卖肾基地” 一颗肾行价3.5万元】据媒体报道，杭州一小区内存在非法肾源供养基地，住在“卖肾基地肾基地”中的都是年轻男子，卖肾原因有还债、嫌打工赚钱慢等。该基地内有30余名供”中的都是年轻男子，国内统一行价3.5万元。记者5月28日获悉，杭州警方目前已介入调查。</p>
					</div>
				</div>
				<div class="detail">
					<div class="title"><h3>产品说明</h3></div>
					<div class="main">
						<img src="style/5.jpg">
						<p>杭州疑现“卖肾基地” 一颗肾行价3.5万元】据媒体报道，杭州一小区内存在非法肾源供养基地，住在“卖肾基地肾基地”中的都是年轻男子，卖肾原因有还债、嫌打工赚钱慢等。该基地内有30余名供”中的都是年轻男子，国内统一行价3.5万元。记者5月28日获悉，杭州警方目前已介入调查。</p>
					</div>
				</div>
			</div>
		</div>
		<div class="model model-b">
			<div class="title"><h3>目前有2种创意</h3></div>
			<div class="main">

				<?foreach($wits as $data){?>
				<div class="detail">
					<div class="title">
						<h3><?= $data['title'] ?></h3>
						<a href="{url edition-list-$data['did']}" target="_blank">版本</a>
						<a href="{url doc-edit-$data['did']}" class="edit">编辑</a>
					</div>
					<div class="main">
						<p><?= $data['content'] ?></p>
						<img src="uploads/images/product/<?=$data['id']?>.jpg">
					</div>
					<div class="tail icons">
						<ul>
							<li class="cat-1"><a href="#">(4)</a></li>
							<li class="cat-2"><a href="#">(3)</a></li>
						</ul>
					</div>
				</div>
				<?}?>


			</div>
		</div>
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

	<!--右边栏部分-->
	<div id="right" class="sidebar">
		<div class="box">
			<div class="title">
				<h3>参与人员（<?= $participants_count ?>）</h3><a href="#" class="more">more</a>
			</div>
			<div class="main participator">
				<ul>
					<?foreach($participants as $project){?>
					<li>
						<img src="style/8.jpg"><a href="/space/<?= $project['id'] ?>"><span><?= $project['name'] ?></span></a>
						<!--{if $data[follow]}-->
						<span class="add_attention">已关注</span>
						<!--{else}-->
						<a href="javascript:void(0);" class="add_attention" uid="<?= $project['id'] ?>">加关注</a>
						<!--{/if}-->                            
					</li>
					<?}?>
				</ul>
			</div>
		</div>

		<!--{if $user['uid']}-->
		<div class="box">
			<div class="title">
				<h3>Ta收藏的标签</h3><a href="#" class="more">more</a>
			</div>
			<div class="main tags-cloud">
				<?foreach($Collection_tags as $project){?>
				<a href="/project/<?=$project ?>" ><?= $project ?></a>
				<?}?>
			</div>
		</div>
		<!--{/if}-->

		<div class="box">
			<div class="title">
				<h3>热门的标签</h3><a href="#" class="more">more</a>
			</div>
			<div class="main tags-cloud">
				<?foreach($hot_tags as $project){?>
				<a href="/project/<?= $project?>" ><?= $project ?></a>
				<?}?>
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>推荐活动</h3><a href="#" class="more">more</a>
			</div>
			<div class="main">
				<ul>
					<? foreach ($recommended_projects as $project){?>
					<li> <a href="/project/<?= $project['id']?>"><?= $project['name']?></a></li>
					<?}?>
				</ul>
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>投票进行时</h3><a href="#" class="more">more</a>
			</div>
			<div class="main">
				<ul>
					<?foreach($recommended_votes as  $project){?>
					<li> <a href="index.php?projectvote-view-<?= $project['id'] ?>"><?= $project['name'] ?></a></li>
					<?}?>
				</ul>
			</div>
		</div>

		<!--{if $user[uid]}-->
		<div class="box">
			<div class="title">
				<h3>Ta关注的企业 (<?= $ta_focus_co_num ?>)</h3><a href="#" class="more">more</a>
			</div>
			<div class="main image">
				<ul>
					<!--{loop $ta_focus_co $key $value}-->
					<li>
						<a href="#"><img src="<?= $value['image'] ?>" width="40px" height="40px"></a>
						<!--<a href="#"><img src="style/p6.jpg"></a>-->
						<span><?= $value['co_name'] ?></span>
						<p><?= $value['summary'] ?></p>
					</li>
					<!--{/loop}-->
					<!--<li> <a href="#"><img src="style/p6.jpg"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>-->
				</ul>
			</div>
		</div>
		<!--{/if}-->
	</div>
</div>


<?
$this->view('footer')?>
