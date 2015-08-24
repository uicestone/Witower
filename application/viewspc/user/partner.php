<?$this->view('header')?>

<?$this->view('index_left')?>
	<div class="list">
		<ul>
<?foreach($partners as $partner){?>
			<li><a href="/space/<?=$partner['id']?>"><?=$this->image('avatar',$partner['id'],100)?></a><span><?=$partner['name']?></span></li>
<?}?>
		</ul>
	</div>
<?if($this->user->isLogged()){?>
	<div class="login">
		<p>
			想看更多？请<a href="/signup">注册</a>或<a href="/login">登录</a>
		</p>
	</div>
<?}?>


<?$this->view('footer')?>

