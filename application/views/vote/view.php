<? $this->view('header') ?>
<link rel="stylesheet" type="text/css" href="/style/bootstrap/bootstrap.min.css">
<style>
    .tail{  height: 30px;    border-bottom: 2px solid;
  border-color: gray;padding-top: 10px;padding-bottom: 10px;}
   .tail .button-set{float:right;padding-right:5%; }
   .tail .button-set button{  background:rgb(0, 109, 204);border:0px;color:white;}
  li{  line-height: 45px;}
  ul {  height: 100%;  margin-left: 0px;}
  .tail a{color:white;}
 .tail a:visited{color:white;}
</style>
<link href="<?=base_url()?>style/xiangmuxiangxi2.css" rel="stylesheet" type="text/css" />
	<div class="indexDiv">
		<div class="model model-b">
			<div class="heading"><?= $project['name'] ?></div>
        <img src="<?=base_url()?>uploads/images/project/<?=$project['id']?>.jpg" width="100%";/>
        <div class="content">
            <div class="section">项目描述 : <span><?= $project['summary'] ?></span></div>

            <div class="section1">企业名称 : <span><?= $project['company_name'] ?></span>
                <input type="button" name="" value="关注" id="button1">
            </div>
            <div class="section">活动状态 : <span><?= lang($project['status']) ?></span></div>
            <div class="section">项目金额 : <span id="i"><?= $project['bonus'] ?>元</span></div>
            <div class="section">截止时间 : <span id="ii"><?= $project['wit_end'] ?></span></br>
            <span id="ii">被编辑次数 : <?= $project['versions'] ?>次</span></br>
            <span id="ii">被讨论次数 : <?= $project['comments_count'] ?>次</span></div>
        </div>
        <div class="image">
           <? foreach ($project['tags'] as $tag) { ?>
				<a href="#"><?= $tag ?></a>
			<? } ?><div class=""><div class="bdsharebuttonbox"><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到网易微博" href="#" class="bds_t163" data-cmd="t163"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a><a title="分享到QQ好友" href="#" class="bds_sqq" data-cmd="sqq"></a><a href="#" class="bds_more" data-cmd="more"></a></div></div>
			<script>window._bd_share_config={"common": {"bdSnsKey": {}, "bdText": "", "bdMini": "2", "bdMiniList": false, "bdPic": "", "bdStyle": "0", "bdSize": "24"}, "share": {}};
with (document)
	0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];</script>
        </div>
        <div class="hx"></div>




		<div class="model model-b voting">
			<form id="voteForm" method="post">
				<div class="heading1">候选人名单及投票</div>
                <div class="hx2"></div>
				<div class="tail">
					<div class="button-set">
                <?if($project['status']!=='voting'){?>
                						项目不在投票阶段
                <?}elseif($this->user->is_muted){?>
                						您已被禁言
                <?}elseif($voted){?>
                						您已经投票了！
                <?}elseif($this->user->id==$project['company']){?>
                						<a href="/company/project/<?=$project['id']?>" class="btn btn-primary">编辑</a>
                <?}elseif($this->user->isLogged(array('witower','project'))){?>
                						<a href="/admin/project/<?=$project['id']?>" class="btn btn-primary">编辑</a>
                <?}else{?>
						<a id="vote-button"  href="#vote-confirm-modal" role="button" class="btn btn-primary" data-toggle="modal">投票</a>

						<div id="vote-confirm-modal" style="display: block;width: 90%;left: 80%;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4>确认投票</h4>
							</div>
							<div class="modal-body hide" id="completed">
								您已经进行个人投票，投票后结果无法更改，确认请点击”投票“；点击”取消“返回进行修改”
							</div>
							<div class="modal-body hide" id="incompleted">
								您已经进行个人投票，每个人可以投的票数为3，目前您投的票数不足，确定请点击“投票”；点击“取消”返回进行修改
							</div>
							<div class="modal-footer">
								<button type="button" class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
								<button type="submit" name="vote" class="btn btn-primary">投票</button>
							</div>
						</div>

						<button type="reset" class="btn">重选</button>
<?}?>
					</div>
<?if($project['status']==='voting' && !$voted){?>
					<div class="flags" style=" margin-left: 10%;">
						<img src="<?=base_url()?>/style/flag.png"><img src="<?=base_url()?>/style/flag.png"><img src="<?=base_url()?>/style/flag.png">
					</div>
<?}?>
				</div>
				<div class="maxred1" style="margin-left: 10%;  font-size: 15px;margin-top: 5%;margin-bottom: 5%;">
					<table>
<?foreach($candidates as $candidate){?>
						<tr>
							<td><img src="<?=base_url()?>uploads/images/avatar/<?=$candidate['id']?>.jpg"; width="25px" height="25px"/></td>
							<td><?=$candidate['name']?></td>
<?if(!$voted){?>
							<td class="images" style="width: 30%;  text-align: center;">
								<img src="<?=base_url()?>/style/flag-off.png"><img src="<?=base_url()?>/style/flag-off.png"><img src="<?=base_url()?>/style/flag-off.png"><input name="candidate[<?=$candidate['id'] ?>]" type="hidden">
							</td>
<?}?>
							<td>
								<div class="bar" style="width:<?if($sum_votes==0){?>0<?}else{?><?=round($candidate['votes']/$sum_votes*100,1)?><?}?>px; background-color:#<?=dechex(rand(0,15)),dechex(rand(0,7)),dechex(rand(0,15))?>"></div>
								<span><?=$candidate['votes']?> (<?if($sum_votes==0){?>尚无投票<?}else{?><?=round($candidate['votes']/$sum_votes*100,1)?>%<?}?>)</span></td>
							<td><a href="<?=site_url()?>/wit/versions/<?=$wit['id']?>?user=<?=$candidate['id']?>" target="_blank">Ta的贡献</a></td>
						</tr>
<?}?>
					</table>
				</div>
				<div class="tail " style="border-top: 1px dashed;">
					<div class="button-set">
<?if($project['status']!=='voting'){?>
						项目不在投票阶段
<?}elseif($this->user->is_muted){?>
						您已被禁言
<?}elseif($voted){?>
						您已经投票了！
<?}elseif($this->user->id==$project['company']){?>
						<a href="/company/project/<?=$project['id']?>" class="btn btn-primary">编辑</a>
<?}elseif($this->user->isLogged(array('witower','project'))){?>
						<a href="/admin/project/<?=$project['id']?>" class="btn btn-primary">编辑</a>
<?}else{?>
						<a href="#vote-confirm-modal" role="button" class="btn btn-primary" data-toggle="modal">投票</a>
						<button type="reset" class="btn">重选</button>
<?}?>
					</div>
				</div>
			</form>
		</div>
<?if($wit){?>
		<div class="model model-b">
			<div class="title">
				<a href="/wit/<?=$wit['id']?>" target="_blank"><h3><?=$wit['name']?></h3></a>
				<span class="pull-right">
					<a href="/wit/versions/<?=$wit['id']?>" target="_blank">版本</a>
				</span>
			</div>
			<div class="main">
				<?=$wit['content']?>
			</div>
		</div>
<?}?>
		<div class="hx"></div>
        <div class="heading1">公司介绍</div>
        <div class="hx2"></div>
        <div class="content2">
            <div class="pic"><img src="<?=base_url()?>uploads/images/avatar/<?=$project['company']?>.jpg"></div>
            <div class="word"><?= $company['description'] ?></div>
        </div>
        <div class="heading1">产品说明</div>
        <div class="hx2"></div>
        <div class="content2">
            <div class="pic"><img src="<?=base_url()?>uploads/images/product/<?=$project['product']?>.jpg"></div>
            <div class="word"><?= $product['description'] ?></div>
        </div>
	</div>

</div>

<script type="text/javascript">
$(function(){
	$('#vote-button').on('click',function(){
		var votes=0;

		$(this).parents('form').find(':input[name^=candidate]').each(function(){
			votes += Number($(this).val());
		});

		if(votes===3){
			$(this).parents('form').find('#completed').show().siblings('#incompleted').hide();
		}else{
			$(this).parents('form').find('#incompleted').show().siblings('#completed').hide();
		}
	});
});
</script>

<?$this->view('footer')?>
