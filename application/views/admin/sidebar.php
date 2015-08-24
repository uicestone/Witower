	<div id="left" class="span3 sidebar">
		<div class="box list">
			<ul class="nav nav-list">
<?if($this->user->isLogged('config')){?>
				<li<?if(uri_segment(2)==='config'){?> class="active1"<?}?>><a href="<?=site_url()?>admin/config">系统设置</a></li>
<?}?>
<?if($this->user->isLogged('finance')){?>
				<li<?if(uri_segment(2)==='finance'){?> class="active1"<?}?>><a href="<?=site_url()?>admin/finance">财务管理</a></li>
<?}?>
<?if($this->user->isLogged('company')){?>
				<li<?if(uri_segment(2)==='company'){?> class="active1"<?}?>><a href="<?=site_url()?>admin/company">企业管理</a></li>
<?}?>
<?if($this->user->isLogged('user')){?>
				<li<?if(uri_segment(2)==='user'){?> class="active1"<?}?>><a href="<?=site_url()?>admin/user">用户管理</a></li>
<?}?>
<?if($this->user->isLogged('product')){?>
				<li<?if(uri_segment(2)==='product'){?> class="active1"<?}?>><a href="<?=site_url()?>admin/product">产品管理</a></li>
<?}?>
<?if($this->user->isLogged('project')){?>
				<li<?if(uri_segment(2)==='project'){?> class="active1"<?}?>><a href="<?=site_url()?>admin/project">项目管理</a></li>
<?}?>
				 </ul>
				 <ul class="nav nav-list">
				<li<?if(uri_segment(2)==='comment'){?> class="active1"<?}?>><a href="<?=site_url()?>admin/comment">评论管理</a></li>
				<li class="divider"></li>
			  </ul>
		</div>
	</div>
