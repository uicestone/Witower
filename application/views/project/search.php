<div class="main">
	<ul>
		<li>
			<b>分类</b>
			<a href="#" class="on" >全部分类</a>
			<?foreach ($hot_tags as $hot_tags){?>
					<a href="#" <?if(false){?>class="on"<?}?>><?=$hot_tags?></a>				
			<?}?>
		</li>
		<li>
			<b>状态</b>
			<a href="#" class="on" >全部状态</a>
			<?foreach ($money as $money){?>
					<a href="#" <?if(false){?>class="on"<?}?>><?=$money?>元</a>
			<?}?>
		</li>
		<li>
			<b>排序</b>
			<a href="#" class="on" >金额最高</a>
			<?foreach ($date as $date){?>
			<a href="#" <?if(false){?>class="on"<?}?>><?=$date?></a>
			<?}?>
		</li>
	</ul>
</div>
