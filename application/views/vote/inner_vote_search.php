<div class="main">
	<ul>
		<li>
			<b>热门标签</b>
			<a href="#" style="color:#004856;" >不限</a>
			<?foreach ($hot_tags as $hot_tags){?>
					<a href="#" class="on"><?=$hot_tags?></a>				
			<?}?>				
			<div class="search-bar">
					<input type="text"><input type="button">
			</div>
		</li>
		<li>
			<b>金额</b>
			<a href="#" style="color:#004856;" >不限</a>
			<?foreach ($money as $money){?>
					<a href="#" class="on"><?=$money?>元</a>
			<?}?>
		</li>
		<li>
			<b>时间</b>
			<a href="#" style="color:#004856;" >不限</a>
			<?foreach ($date as $date){?>
					<a href="#" class="on"><?=$date?></a>
			<?}?>
		</li>
		<li>
			<b>参与人数</b>
			<a href="#" style="color:#004856;" >不限</a>
			<?foreach ($people as $people){?>
					<a href="#" class="on"><?=$people?></a>
			<?}?>
		</li>
		<li>
			<b>我的参与</b>
			<a href="{url $cat-search-tag-$tag-money-$money-time-$time-user-$user-joinin-0-order-$order}" <!--{if 0 == $joinin}-->style="color:#004856;"<!--{/if}--> >不限</a>
			<!--{loop $joinin_list $key $data}-->
					<a href="{url $cat-search-tag-$tag-money-$money-time-$time-user-$user-joinin-$data['id']-order-$order}" <!--{if $data['id'] == $joinin}-->style="color:#004856;"<!--{/if}--> ><?=$data['name']?></a>
			<!--{/loop}-->
		</li>
	</ul>
</div>