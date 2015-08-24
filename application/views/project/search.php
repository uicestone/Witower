<style>
.sort-box .bg1onnow{ background: #e9a422;color: #FFF;padding: 0px 5px;}
.sort{overflow:hidden; background-color:#999999;}
.sort-title{ width:46px; float:left; text-align:right;}
.sort-box{margin-left:50px;}
.sort-box a{display:inline-block; line-height:22px; margin-right:0px;padding:0 5px}
</style>
<div class="sort" style="  padding-top: 20px;padding-bottom: 5px;">
    <div class="sort-title"><a href="<?=site_url()?>project"<?php if(!$this->input->get('tag')){ ?> class="on"<?php } ?>>分类 :</a></div>
	<div class="sort-box">
		<a href="<?=site_url()?>project<?php if(!$this->input->get('bonus_range') == ''){ ?>?bonus_range=<?= $this->input->get('bonus_range') ?><? } ?>" <?php if($this->input->get('tag') == ''){?>class="bg1onnow"<?php } ?>>全部</a>
		<?foreach ($hot_tags as $tag){?>
		<a href="<?=site_url()?>project?tag=<?=$tag?><?php if(!$this->input->get('bonus_range') == ''){ ?>&bonus_range=<?= $this->input->get('bonus_range') ?><? } ?>"<?php if($this->input->get('tag') === $tag){?>class="bg1onnow"<?php } ?>><?=$tag?></a>
		<?}?>
		<br />
	</div>
</div>
<div class="sort" style="padding-top: 5px;   padding-bottom: 20px;">
	<div class="sort-title"><a href="<?=site_url()?>project"<?php if(!$this->input->get('bonus_range')){ ?> class="on"<?php } ?>>金额 :</a></div>
	<div class="sort-box">
		<a href="<?=site_url()?>project<?php if(!$this->input->get('tag')== ''){?>?tag=<?= $this->input->get('tag') ?><? } ?>" <?php if($this->input->get('bonus_range') == ''){?>class="bg1onnow"<?php } ?>>全部</a>
		<?foreach ($bonus_ranges as $bonus_range){?>
		<a href="<?=site_url()?>project?bonus_range=<?=$bonus_range?><?php if(!$this->input->get('tag')== ''){?>&tag=<?= $this->input->get('tag') ?><? } ?>"<?php if($this->input->get('bonus_range') === $bonus_range){?>class="bg1onnow"<?php } ?>><?=$bonus_range?>元</a>
		<?}?>
	</div>
</div>