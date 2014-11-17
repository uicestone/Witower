<!--<div class="model recommend">
	<div class="title"><h3>每日推荐</h3></div>
	<div class="main">
		<div class="info">
			<a href="/project/<?=$recommended_project['id']?>"><?=$this->image('project',$recommended_project['id'],100)?></a>
			<a class="btn btn-primary pull-right" href="/project/<?=$recommended_project['id']?>">我要参与</a>
			<ul>
				<li><b>发布企业：</b><?=$recommended_project['company_name']?>
					<?followButton($recommended_project['company'])?>
				</li>
				<li><b>项目名称：</b><a href="/project/<?=$recommended_project['id']?>"><?=$recommended_project['name']?></a></li>
				<li>
					<div class="clearfix"></div>
					<div class="well"><?=$recommended_project['summary']?></div>
				</li>
				<li><b>项目金额：</b><?=$recommended_project['bonus']?>元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>截止日期：</b><?=$recommended_project['wit_end']?></li>
				<li>标签：
					<span class="tags">
						<?foreach($recommended_project['tags'] as $tags){?>
								<a href="/list/search/tag/<?=$tags?>"><?=$tags?></a>
						<?}?>
					</span>
				</li>
			</ul>

		</div>
		<div class="scroll-img">
			<div class="pull-left"><p>他们正在讨论</p></div>
			<div class="pull-right">
				<ul id="mycarousel" class="jcarousel-skin-tango">
					<?foreach($recommended_project['commenters'] as $commenter){?>
						<li><a href="/user/space/<?=$commenter['id']?>"><?=$this->image('avatar',$commenter['id'],100,65)?><span><?=$commenter['name']?></span></a></li>
					<?}?>
				</ul>
			</div>
		</div>
	</div>
</div>
-->
		<script type="text/javascript" src="<?=site_url()?>js/new.js"></script>
<div class="reday">
  <div class="maxred">
    <div class="img">
      <?=$this->image('project',$recommended_project['id'])?>
      "</div>
    <div class="reday_r">
      <h2><strong><a href="/project/<?=$recommended_project['id']?>">
        <?=$recommended_project['name']?>
        </a></strong></h2>
      <h4>项目描述</h4>
      <?=$recommended_project['summary']?>
      <b>发布企业：</b>
      <?=$recommended_project['company_name']?>
      &nbsp; &nbsp;
      <?followButton($recommended_project['company'])?>
      <br>
      <b>活动状态：</b>
      <?=lang($recommended_project['status'])?>
      <br>
      <b>项目金额：</b>
      <span><?=$recommended_project['bonus']?></span>
      元 <br>
      <b>截止时间：</b>
      <?=$recommended_project['wit_end']?>
      <div class="div"><a  href="/project/<?=$recommended_project['id']?>"><img src="<?=site_url()?>style/woyaocanyu.png" /></a></div>
    </div>
  </div>
  <div class="tlrs">当前正在讨论</div>
  <div class="blocks">
  <div class="list1">
    <div class="left"><img src="<?=site_url()?>style/left.png" /></div>
    <div class="maxul">
      <ul >
        <?foreach($recommended_project['commenters'] as $commenter){?>
        <li><a href="/user/space/<?=$commenter['id']?>">
          <?=$this->image('avatar',$commenter['id'],100,55)?>
          <span>
          <?=$commenter['name']?>
          </span></a></li>
        <?}?>
      </ul>
    </div>
    <div class="right"><img src="<?=site_url()?>style/right.png" /></div>
  </div>
</div>
</div>