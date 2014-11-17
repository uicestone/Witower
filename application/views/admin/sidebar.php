	<div id="left" class="span3 sidebar">
		<div class="box list">
			<ul class="nav nav-list">
<?if($this->user->isLogged('config')){?>
				<li<?if(uri_segment(2)==='config'){?> class="active1"<?}?>><a href="/<?=uri_segment(1)?>/config">系统设置</a></li>
<?}?>
<?if($this->user->isLogged('finance')){?>
				<li<?if(uri_segment(2)==='finance'){?> class="active1"<?}?>><a href="/<?=uri_segment(1)?>/finance">财务管理</a></li>
<?}?>
<?if($this->user->isLogged('company')){?>
				<li<?if(uri_segment(2)==='company'){?> class="active1"<?}?>><a href="/<?=uri_segment(1)?>/company">企业管理</a></li>
<?}?>
<?if($this->user->isLogged('user')){?>
				<li<?if(uri_segment(2)==='user'){?> class="active1"<?}?>><a href="/<?=uri_segment(1)?>/user">用户管理</a></li>
<?}?>
<?if($this->user->isLogged('product')){?>
				<li<?if(uri_segment(2)==='product'){?> class="active1"<?}?>><a href="/<?=uri_segment(1)?>/product">产品管理</a></li>
<?}?>
<?if($this->user->isLogged('project')){?>
				<li<?if(uri_segment(2)==='project'){?> class="active1"<?}?>><a href="/<?=uri_segment(1)?>/project">项目管理</a></li>
<?}?>
				<li class="divider"></li>
			  </ul>
		</div>
	</div>
