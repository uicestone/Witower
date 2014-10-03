<? $this->view('header') ?>
<div style="margin:10px 0;" class="text-right"><a href="<?=site_url()?>piece/add" class="btn btn-primary">发布作品</a></div>
<div class="water hide thumbnails">
<?foreach($pieces as $piece){?>
	<div class="span3 box">
		<div class="thumbnail">
			<?php
			$files = json_decode($piece['files']);
			
			$thumbnail_url = site_url() . 'style/video_icon.png';
			
			foreach($files as $file){
				if(preg_match('/^image/', $file->file_type)){
					$thumbnail_url = $file->url;
				}
			}
			?>
			<a href="<?=site_url()?>piece/<?=$piece['id']?>"><img src="<?=$thumbnail_url?>"></a>
			<div class="container">
				<h4><a href="<?=site_url()?>piece/<?=$piece['id']?>"><?=$piece['name']?></a></h4>
				<p><?=$piece['description']?></p>
			</div>
		</div>
	</div>
<?}?>
</div>
<? $this->view('footer') ?>
