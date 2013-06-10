<div class="main">
	<ul>
		<li>
			<b>热门标签</b>
			<a href="#" class="on">不限</a>
			<?foreach ($hot_tags as $hot_tags){?>
				<a href="#"<?if(false){?> class="on"<?}?>><?=$hot_tags?></a>				
			<?}?>				
		</li>
		<li>
			<b>金额</b>
			<a href="#" class="on">不限</a>
			<?foreach ($money as $money){?>
				<a href="#"<?if(false){?> class="on"<?}?>><?=$money?>元</a>
			<?}?>
		</li>
		<li>
			<b>时间</b>
			<a href="#" class="on">不限</a>
			<?foreach ($date as $date){?>
				<a href="#"<?if(false){?> class="on"<?}?>><?=$date?></a>
			<?}?>
		</li>
		<li>
			<b>参与人数</b>
			<a href="#" class="on">不限</a>
			<?foreach ($people as $people){?>
				<a href="#"<?if(false){?> class="on"<?}?>><?=$people?></a>
			<?}?>
		</li>
	</ul>
</div>