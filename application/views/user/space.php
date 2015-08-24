<?$this->view('header')?>
<link href="<?=base_url()?>style/gerenzhongxin.css" rel="stylesheet" type="text/css" />
    <div class="header">
        <div class="change">
			<div class="testimg">
				<?=$this->image('avatar',$user['id'],100)?>
            </div>
        </div>
        <div class="testtxt">
                <p><b><?=$user['name']?></b>
                    <?if(uri_segment(1)==='space'){?>
                        <?followButton($user['id'])?>
                    <?}?>
                </p>
                <?if($this->user->isLogged('user') && !$this->user->inGroup('blacklist',$user['id'])){?>
                    <p><a href="<?=site_url()?>/user/addtoblacklist/<?=$user['id']?>" class="btn btn-mini">加入黑名单</a></p>
                <?}?>
                <?if($this->user->inGroup('blacklist',$user['id'])){?>
                    <p><a href="<?=site_url()?>/user/removefromblacklist/<?=$user['id']?>" class="btn btn-mini">移出黑名单</a></p>
                <?}?>
                <table>
                    <tr>
                        <td><?=$user['follows']?></td>
                        <td><?=$user['fans']?></td>
                        <td><?=$user['statuses']?></td>
                    </tr>
                    <tr>
                        <td><a href="#">关注</a></td>
                        <td><a href="#">粉丝</a></td>
                        <td><a href="#">微博</a></td>
                    </tr>
                </table>
                <?if(uri_segment(1)==='home'){?>
                    <div class="box my-nav">
                        <span class="icon-folder-close"></span>活动数量(<?=$this->project->count(array('user_witted'=>$user['id']))?>)
                        <span class="icon-align-left"></span>投票数量(<?=$this->project->count(array('user_voted'=>$user['id']))?>)
                    </div>
                <?}else{?>
                    <div class="box">
                        <div class="title">
                            <h3>推荐活动</h3><a href="<?=site_url()?>/project" target="_blank" class="more">more</a>
                        </div>
                        <div class="main">
                            <ul>
                                <? foreach ($recommended_projects as $project){?>
                                    <li> <a href="<?=site_url()?>/project/<?= $project['id']?>"><?= $project['name']?></a></li>
                                <?}?>
                            </ul>
                        </div>
                    </div>

                    <div class="box">
                        <div class="title">
                            <h3>投票进行时</h3><a href="<?=site_url()?>/vote" target="_blank" class="more">more</a>
                        </div>
                        <div class="main">
                            <ul>
                                <?foreach($recommended_votes as  $project){?>
                                    <li> <a href="<?=site_url()?>/vote/<?=$project['id']?>"><?=$project['name']?></a></li>
                                <?}?>
                            </ul>
                        </div>
                    </div>

                    <div class="box">
                        <div class="title">
                            <h3>Ta关注的企业 (<?=count($idols)?>)</h3>
                        </div>
                        <div class="main participator">
                            <ul>
                                <?foreach($idols as $idol){?>
                                    <li>
                                        <a href="<?=site_url()?>/space/<?= $idol['id'] ?>">
                                            <?=$this->image('avatar',$idol['id'],100,50)?>
                                            <span><?= $idol['name'] ?></span>
                                        </a>
                                        <?followButton($idol['id'])?>
                                    </li>
                                <?}?>
                            </ul>
                        </div>
                    </div>
                <?}?>
        </div>
    </div>


    <div class="indexDiv">
    	<div class="bg">
			<div class="label">
                <a href="<?=site_url()?><?=uri_string()?>" class="f10">全部</a>
                <a href="<?=site_url()?><?=uri_string()?>?status_type=project" class="f10">项目</a>
                <a href="<?=site_url()?><?=uri_string()?>?status_type=vote" class="f10">投票</a>
			</div>
        </div>

        <?if(uri_segment(1)==='home'){?>
		<form method="post" action="<?=site_url()?>user/addstatus">
			<div class="model model-b weibo-send">
				<div class="main">
					<textarea name="content" rows="4" cols="" placeholder="输入内容" id="area"></textarea>
					<div class="buttons">
						<div class="btn3">
							<button type="submit" value="1" id="btn3">发　表</button>
						</div>
					</div>
				</div>
			</div>
		</form>
<?}?>
<?foreach($status as $status){?>
		<div id="<?=$status['id']?>" class="model model-b">
			<div class="main">
				<div class="detail">
					<div class="main">
						<p>
							<a href="<?=site_url()?>/space/<?=$status['user']?>"><?=$this->image('avatar',$status['user'],100)?></a>
							<a href="<?=site_url()?>/space/<?=$status['user']?>"><h5><?=$status['username']?></h5></a>

<?if($status['url']){?>
							<a href="<?=$status['url']?>" target="_blank" class="btn btn-small">去看看</a>
<?}?>
						</p>
					</div>
						<div class="tail icons">
							<?=date('Y-m-d H:i:s',$status['time'])?>
							<ul>
								<li><span class="icon-comment"></span><a href="#" class="btn-comment">评论(<?=count($status['comments'])?>)</a></li>
							</ul>
						</div>
					<div class="sub_comment" >
						<div class="comment">
							<form>
								<textarea name="comment-content" class="comment-field" placeholder="评论内容" rows="1"></textarea>
								<button type="button" name="comment-content-submit" class="btn">提交</button>
							</form>
						</div>
						<ul class="comment-list">
<?	foreach($status['comments'] as $status_comment){?>
							<li>
								<dl class="dl-horizontal">
									<dt>
										<a href="/space/<?=$status_comment['user']?>"><?=$this->image('avatar',$status_comment['user'],100,30)?></a>
									</dt>
									<dd>
										<p class="avatar">
											<a href="/space/<?=$status_comment['user']?>"><?=$status_comment['username']?></a>
										</p>
										<p class="content">
											<?=$status_comment['content']?>
											<span class="time">( <?=date('Y-m-d H:i:s',$status_comment['time'])?>) </span>
										</p>
									</dd>
								</dl>
							</li>
<?	}?>
						</ul>
						<button class="close-comment-list btn btn-mini pull-right"><span class="icon-chevron-up"></span>收起评论</button>
					</div>
				</div>
			</div>
		</div>
<?}?></div>
<br/><br/><br/><br/>
<?$this->view('footer')?>