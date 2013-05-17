<div class="main">
	<ul>
		<li>
			<b>热门标签</b>
			<a href="#" class="on" >不限</a>
			<?foreach ($hot_tags as $hot_tags){?>
					<a href="#" class="on"><?=$hot_tags?></a>				
			<?}?>
		</li>
		<li>
			<b>金额</b>
			<a href="#" class="on" >不限</a>
			<?foreach ($money as $money){?>
					<a href="#" class="on"><?=$money?>元</a>
			<?}?>
		</li>
		<li>
			<b>时间</b>
			<a href="{url $cat-search-tag-$tag-money-$money-time-0-user-$user-order-$order}" class="on" >不限</a>
			<?foreach ($date as $date){?>
					<a href="#" class="on"><?=$date?></a>
			<?}?>
		</li>
		<li>
			<b>参与人数</b>
			<a href="{url $cat-search-tag-$tag-money-$money-time-$time-user-0-order-$order}" class="on" >不限</a>
			<?foreach ($people as $people){?>
					<a href="#" class="on"><?=$people?></a>
			<?}?>
		</li>
	</ul>
</div>
