<?php $this->view('header'); ?>

<div class="span12">
	<div class="model model-b">
		<div class="main">
			<?php if($this->user->id === $piece['user']){ ?>
			<a href="<?=site_url()?>piece/edit/<?=$piece['id']?>" class="btn pull-right">编辑</a>
			<?php } ?>
			<h3><?=$piece['name']?></h3>
			<div class="info">
				<div>
					<p><?=$piece['description']?></p>
				</div>
			</div>
		</div>
	</div>
	<?foreach($piece['files'] as $file){?>
	<div class="model model-b">
		<div class="main">
		<?php if(preg_match('/^image/', $file->file_type)){ ?>
			<img src="<?=$file->url?>">
		<?php }elseif(preg_match('/^video/', $file->file_type)){ ?>
			<video src="<?=$file->url?>">
		<?php } ?>
		</div>
	</div>
	<?}?>
</div>

<?php $this->view('footer'); ?>
