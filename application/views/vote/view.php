<? $this->view('header') ?>
<div id="content" class="page-viewvote model-view">
	<div class="breadcrumb">
	</div>
	<div id="left">

		<div class="model model-b">
			<div class="main">
				<div><img src="style/default/us_pic.jpg"><br>
					<span>
						<!--{if $project[follow]}-->
						<span class="add_attention">已关注</span>
						<!--{else}-->
						<a href="javascript:void(0);" class="add_attention" uid="<?= $project['uid'] ?>">加关注</a>
						<!--{/if}-->
					</span>
				</div>
				<ul>
					<li><b>发布企业：</b><?= $project['co_name'] ?></li>
					<li><b>发布金额：</b><?= $project['money'] ?>元 </li>
					<li><b>被编辑次数：</b><?= $project['join_num'] ?>次<b>被讨论次数：</b><?= $project['comment_num'] ?>次<b>项目截止日期：</b><?= $project['end_time'] ?></li>
					<li><b>活动状态：</b>进行中</li>
					<li class="tags">
						<b>标签：</b>
						<!--{loop $project['tag_list'] $key $data}-->
						<a href="{url list-search-tag-$data['tag_id']}"><?= $data['tag_name'] ?></a>
						<!--{/loop}-->
					</li>
				</ul>
				<div class="descript">
					<div class="fn-left"><img src="style/default/5.jpg"></div><div class="fn-right">
						<p><?= $project['e_summary'] ?><a href="#">[了解更多]</a></p>
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
						</div>
					</div>
				</div>
				<div class="detail">
					<div class="title">公司介绍</div>
					<div class="main">
						<img src="style/default/5.jpg">
						<p><?= $project['uc_summary'] ?></p>
					</div>
				</div>
				<div class="detail">
					<div class="title">产品说明</div>
					<div class="main">
						<img src="style/default/5.jpg">
						<p><?= $project['summary'] ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="model model-b voting">
			<form action="{url projectvote-vote}" id="voteForm" method="post">
				<input name="pid" type="hidden" value="<?= $project['p_id'] ?>">
				<div class="title"><h3>候选人名单及投票</h3></div>
				<div class="tail">
					<div class="button-set">
						<!--{if $vote_status}-->
						您已经投票了！
						<!--{else}-->
						<button type="submit" class="btn-a">投 票</button>
						<button type="reset" class="btn-a">重 选</button>                            
						<!--{/if}-->
					</div>
					<div class="flags">
						<!--{if !$vote_status}-->
						<img src="style/default/flag.png"><img src="style/default/flag.png"><img src="style/default/flag.png">
						<!--{/if}-->
					</div>                         

				</div>
				<div class="main">
					<table>
						<!--{loop $candidates $key $data}-->
						<tr userId="u888" voteNum="3" voteTotalNum="30" percent="70">
							<td><img src="style/default/us_pic.jpg"></td>
							<td><?= $data['people_name'] ?></td>
							<td class="images">
								<!--{if !$vote_status}-->                                    
								<img src="style/default/flag-off.png"><img src="style/default/flag-off.png"><img src="style/default/flag-off.png"><input name="uid_<?= $data['uid'] ?>" type="hidden">                                    
								<!--{/if}-->
							</td>
							<td><div class="bar <?= $data['color'] ?>" style="width:<?= $data['width'] ?>px;"></div><span><?= $data['vote'] ?> (<?= $data['percentage'] ?>%)</span></td>
							<td><a href="#">Ta的贡献</a></td>
						</tr>
						<!--{/loop}-->
					</table>
				</div>
				<div class="tail">
					<div class="button-set">
						<!--{if $vote_status}-->
						您已经投票了！
						<!--{else}-->
						<button type="submit" class="btn-a">投 票</button>
						<button type="reset" class="btn-a">重 选</button>                            
						<!--{/if}-->
					</div>
				</div>
			</form>
		</div>

		<!--{loop $comment_list $key $data}-->  
		<div class="model model-b">
			<div class="main">
				<div class="detail">
					<div class="main">
						<p><span>@<?= $data['people_name'] ?>：</span><?= $data['comment'] ?></p>
						<img src="style/default/us_p1.jpg">
					</div>
					<div class="tail icons">
						今天12:03 来自新浪微博
						<ul>
							<li class="cat-1"><a href="#">转发(4)</a></li>
							<li class="cat-2"><a href="#">评论(3)</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!--{/loop}-->




	</div>
	<div id="right" class="sidebar">

		<div class="box">

			<div class="title">
				<h3>参与人员（<?= $project['join_num'] ?>）</h3><a href="#" class="more">more</a>
			</div>
			<div class="main participator">
				<ul>
					<!--{loop $project['person_list'] $key $data}-->
					<li>
						<img src="style/default/8.jpg"><a href="index.php?user-space-<?= $data['uid'] ?>"><span><?= $data['people_name'] ?></span></a>
						<!--{if $data[follow]}-->
						<span class="add_attention">已关注</span>
						<!--{else}-->
						<a href="javascript:void(0);" class="add_attention" uid="<?= $data['uid'] ?>">加关注</a>
						<!--{/if}-->                        
					</li>
					<!--{/loop}-->
				</ul>
			</div>
		</div>

		<!--{if $user['uid']}-->
		<div class="box">
			<div class="title">
				<h3>Ta收藏的标签</h3><a href="#" class="more">more</a>
			</div>
			<div class="main tags-cloud">
				<!--{loop $ta_tags $key $value}-->
				<a href="index.php?list-search-tag-<?= $value['tag_id'] ?>" ><?= $value['tag_name'] ?></a>
				<!--{/loop}-->
			</div>
		</div>
		<!--{/if}-->

		<div class="box">
			<div class="title">
				<h3>热门的标签</h3><a href="#" class="more">more</a>
			</div>
			<div class="main tags-cloud">
				<!--{loop $hot_tags $key $value}-->
				<a href="index.php?list-search-tag-<?= $value['tag_id'] ?>" ><?= $value['tag_name'] ?></a>
				<!--{/loop}-->
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>推荐活动</h3><a href="#" class="more">more</a>
			</div>
			<div class="main">
				<ul>
					<!--{loop $recommend_projects $key $value}-->
					<li> <a href="index.php?project-view-<?= $value['p_id'] ?>"><?= $value['title'] ?></a></li>
					<!--{/loop}-->
				</ul>
			</div>
		</div>

		<div class="box">
			<div class="title">
				<h3>投票进行时</h3><a href="#" class="more">more</a>
			</div>
			<div class="main">
				<ul>
					<!--{loop $voting_projects $key $value}-->
					<li> <a href="index.php?projectvote-view-<?= $value['p_id'] ?>"><?= $value['title'] ?></a></li>
					<!--{/loop}-->
				</ul>
			</div>
		</div>

		<!--{if $user['uid']}-->
		<div class="box">
			<div class="title">
				<h3>Ta关注的企业 (<?= $ta_focus_co_num ?>)</h3><a href="#" class="more">more</a>
			</div>
			<div class="main image">
				<ul>
					<!--{loop $ta_focus_co $key $value}-->
					<li>
						<a href="#"><img src="<?= $value['image'] ?>" width="40px" height="40px"></a>
						<!--<a href="#"><img src="style/default/flag.png"></a>-->
						<span><?= $value['co_name'] ?></span>
						<p><?= $value['summary'] ?></p>
					</li>
					<!--{/loop}-->
					<!--<li> <a href="#"><img src="style/default/flag.png"></a><span>财经网</span><p>采编团队向希望一览海内外重大财经新闻的读者</p></li>-->
				</ul>
			</div>
		</div>
		<!--{/if}-->

	</div>
</div>

<?
$this->view('footer')?>