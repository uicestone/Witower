	<div id="left" class="span3 sidebar">
		<div class="box list">
			<ul class="nav nav-list">
<?if($this->user->isLogged('config')){?>
				<li<?if(uri_segment(2)==='config'){?> class="active"<?}?>><a href="/<?=uri_segment(1)?>/config">系统设置</a></li>
<?}?>
<?if($this->user->isLogged('finance')){?>
				<li<?if(uri_segment(2)==='finance'){?> class="active"<?}?>><a href="/<?=uri_segment(1)?>/finance">财务管理</a></li>
<?}?>
<?if($this->user->isLogged('company')){?>
				<li<?if(uri_segment(2)==='company'){?> class="active"<?}?>><a href="/<?=uri_segment(1)?>/company">企业管理</a></li>
<?}?>
<?if($this->user->isLogged('company')){?>
				<li<?if(uri_segment(2)==='user'){?> class="active"<?}?>><a href="/<?=uri_segment(1)?>/user">用户管理</a></li>
<?}?>
<?if($this->user->isLogged('company')){?>
				<li<?if(uri_segment(2)==='product'){?> class="active"<?}?>><a href="/<?=uri_segment(1)?>/product">产品管理</a></li>
<?}?>
<?if($this->user->isLogged('project')){?>
				<li<?if(uri_segment(2)==='project'){?> class="active"<?}?>><a href="/<?=uri_segment(1)?>/project">项目管理</a></li>
<?}?>
				<li class="divider"></li>
			  </ul>
		</div>
		<div class="box list">
			<ul class="nav nav-list">
				<li class="nav-header">寻求帮助</li>
				<li><a href="#">如何快速发布项目活动？</a></li>
				<li><a href="#">正等待你选出后选人</a></li>
				<li><a href="#">三星LEX3D手机创意作品</a></li>
				<li><a href="#">世联研究房价备案制</a></li>
				<li><a href="#">博策堂开发商正在面临</a></li>
				<li class="divider"></li>
			  </ul>
		</div>
		<div class="box list">
			<ul class="nav nav-list">
				<li class="nav-header">新手帮助</li>
				<li><a href="#">如何快速发布项目活动？</a></li>
				<li><a href="#">正等待你选出后选人</a></li>
				<li><a href="#">三星LEX3D手机创意作品</a></li>
				<li><a href="#">世联研究房价备案制</a></li>
				<li><a href="#">博策堂开发商正在面临</a></li>
				<li class="divider"></li>
			  </ul>
		</div>
	</div>
