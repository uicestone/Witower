<?php $this->view('header'); ?>
<?php $this->view(uri_segment(1).'/sidebar'); ?>
<style>
    .model span{float:right;}
</style>
<div id="right" class="span9">
	<?php $this->view('alert'); ?>
	<div class="model">
		<div class="title"><h3><a href="/<?=uri_segment(1)?>/config">评<?=is_null($_GET['project']);?>论管理</a></h3>
		<? $isnul = $this->input->get('project')?$this->input->get('project'):0;if($isnul!=0):?>
		<span><a href="/admin/project" >返回项目列表</a></span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
		<span><a href="/admin/wit?project=<?= $this->input->get('project'); ?> ">查看当前项目</a></span>
		<?endif;?>
		</div>
		<div class="main">
			<form method="post" onsubmit="return confirm('您确认要删除该评论吗？')">
				<table class="table table-bordered">
					<thead>
						<tr>
						<th style="width: 20%;">用户</th>
						<th style="width: 40%;">内容</th>
						<th style="width: 20%;">发表时间</th>
						<th style="width: 20%;">操作</th></tr>
					</thead>
					<tbody>
						<?php foreach ($list as $comment) { ?>
							<tr>
								<td><?= $comment['username'] ?></td>
								<td><?= $comment['content'] ?></td>
								<td><?= date('Y-m-d H:i:s',$comment['time']);  ?></td>
								<td>
								<a href="/admin/comment?is_show=<?=$comment['is_show']?>&id=<?=$comment['id']?><?= $this->uri->segment(3) ?><? if($this->input->get('project')){ echo "&project=".$this->input->get('project');} ?>">
								<? if($comment['is_show']	== 0){ ?>显示<? }else{ ?>不显示 <? }?></a>
								<a href="/admin/comment?del=<?=$comment['id']?><? if($this->input->get('project')){ echo "&project=".$this->input->get('project');} ?>">删除</a>
								<a href="/admin/commenttoproject?id=<?=$comment['id']?>">查看项目</a>
								</td>
							</tr>					
						<?php } ?>
					</tbody>
				</table>
			</form>
			<?=$pagination?>
		</div>
	</div>
</div>
<script language="javascript">
if(<? if($this->input->get('project')){ echo $this->input->get('project');}else{echo 0;} ?>){
	if(<? if($this->input->get('id')){ echo $this->input->get('id');}else{echo 0;} ?>){
		window.location.href = "<?=site_url()?>admin/comment?project=<?= $this->input->get('project') ?>";
	}
	if(<? if($this->input->get('del')){ echo $this->input->get('del');}else{echo 0;} ?>){
		window.location.href = "<?=site_url()?>admin/comment?project=<?= $this->input->get('project') ?>";
	}
}else{
	if(<? if($this->input->get('id')){ echo $this->input->get('id');}else{echo 0;} ?>){
		window.location.href = "<?=site_url()?>admin/comment";
	}
	if(<? if($this->input->get('del')){ echo $this->input->get('del');}else{echo 0;} ?>){
		window.location.href = "<?=site_url()?>admin/comment";
	}
}
</script>
<?php $this->view('footer'); ?>