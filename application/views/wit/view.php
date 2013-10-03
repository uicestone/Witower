<? $this->view('header') ?>
	<ul class="breadcrumb">
		<li>
			<strong><a href="/project">项目</a></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/project/view/<?=$project['id']?>"><?=$project['name']?></a>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/wit/<?=$wit['id']?>"><?=$wit['name']?></a>
		</li>
	</ul>
	<div id="left" class="span9">
		<div class="model model-b">
			<div class="title">
				<h3><?=$version['name']?></h3>
				<?if($wit['selected']){?><span class="icon-check" title="已选中"></span><?}?>
				<?if($wit['deleted']){?><span class="icon-remove-sign" title="已删除"></span><?}?>
			</div>
			<div class="main">
				<?=$version['content']?>
			</div>
		</div>
	</div>
	<?$this->view('wit/sidebar')?>
<? $this->view('footer') ?>
