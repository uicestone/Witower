<div class="main">
	<ul>
		<li>
			<b>投票人数</b>
			<a href="<?=site_url()?>vote"<?php if(!$this->input->get('voters')){ ?> class="on"<?php } ?>>全部</a>
			<?foreach (array('0-10', '11-30', '31-100') as $popular){?>
			<a href="<?=site_url()?>vote?voters=<?=$popular?>"<?php if($this->input->get('voters') === $popular){?>class="on"<?php } ?>><?=$popular?></a>
			<?}?>
		</li>
		<li>
			<b>剩余时间</b>
			<a href="<?=site_url()?>vote"<?php if(!$this->input->get('vote_end')){ ?> class="on"<?php } ?>>全部</a>
			<?foreach (array(date('Y-m-d', strtotime('+1 day')) => '1天', date('Y-m-d', strtotime('+2 days')) => '2天', date('Y-m-d', strtotime('+3 days')) => '3天') as $vote_end => $label){?>
			<a href="<?=site_url()?>vote?vote_end=<?=$vote_end?>"<?php if($this->input->get('vote_end') === $vote_end){?>class="on"<?php } ?>><?=$label?></a>
			<?}?>
		</li>
	</ul>
</div>
