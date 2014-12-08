<div class="main">
	<ul>
		<li>
			<b>投票类型</b>
			<a href="#" class="on">不限</a>
			<?foreach ($hot_tags as $hot_tags){?>
				<a href="#"<?if(false){?> class="on"<?}?>><?=$hot_tags?></a>				
			<?}?>				
		</li>
		<li>
			<b>参与人数</b>
			<a href="#" class="on">不限</a>
			<?foreach ($money as $money){?>
				<a href="#"<?if(false){?> class="on"<?}?>><?=$money?>元</a>
			<?}?>
		</li>
		<li>
			<b>投票日期</b>
			<a href="#" class="on">不限</a>
			<?foreach ($money as $money){?>
				<a href="#"<?if(false){?> class="on"<?}?>><?=$money?>元</a>
			<?}?>
		</li>
	</ul>
</div>