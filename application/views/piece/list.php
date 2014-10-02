<? $this->view('header') ?>

<div class="water hide thumbnails">
<?foreach($pieces as $piece){?>
	<div class="span3 box">
		<div class="thumbnail">
			<a href="<?=site_url()?>piece/<?=$piece['id']?>"><img src="/uploads/images/product/0.jpg"></a>
			<div class="container">
				<h4><a href="<?=site_url()?>piece/<?=$piece['id']?>"><?=$piece['name']?></a></h4>
				<p><?=$piece['description']?></p>
			</div>
		</div>
	</div>
<?}?>
</div>
<? $this->view('footer') ?>
