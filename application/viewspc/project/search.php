<div class="main">
	<ul>
		<li>
			<b>分类</b>
			<a href="<?=site_url()?>project"<?php if(!$this->input->get('tag')){ ?> class="on"<?php } ?>>全部分类</a>
			<?foreach ($hot_tags as $tag){?>
			<a href="<?=site_url()?>project?tag=<?=$tag?>"<?php if($this->input->get('tag') === $tag){?>class="on"<?php } ?>><?=$tag?></a>
			<?}?>
		</li>
		<li>
			<b>悬赏</b>
			<a href="<?=site_url()?>project"<?php if(!$this->input->get('bonus_range')){ ?> class="on"<?php } ?>>全部金额</a>
			<?foreach ($bonus_ranges as $bonus_range){?>
			<a href="<?=site_url()?>project?bonus_range=<?=$bonus_range?>"<?php if($this->input->get('bonus_range') === $bonus_range){?>class="on"<?php } ?>><?=$bonus_range?>元</a>
			<?}?>
		</li>
	</ul>
</div>
