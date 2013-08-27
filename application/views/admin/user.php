<? $this->view('header') ?>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong><?=lang(uri_segment(1))?></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/<?=uri_segment(1)?>/user">用户管理</a>
		</li>
	</ul>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right">
		<div class="model">
			<div class="title"><h3><a href="/<?=uri_segment(1)?>/user">用户管理</a></h3></div>
			<div class="main">
				<a class="btn" href="/<?=uri_segment(1)?>/adduser">增加用户</a>
				<table class="table table-bordered">
					<thead>
						<tr><th>名称</th><th>电子邮件</th><th>组</th><th width="96px">&nbsp;</th></tr>
					</thead>
					<tbody>
						<? foreach ($users as $user) { ?>								
							<tr> 
								<td><a href="/space/<?=$user['id']?>"><?=$user['name']?></a></td>
								<td><?=$user['email']?></td>
								<td><?=$user['group']?></td>
								<td>
									<a href="/admin/user/<?=$user['id']?>" class='btn btn-small'>编辑</a>
									<a href="/admin/finance?user=<?=$user['id']?>" class='btn btn-small'>财务</a>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
				<?=$pagination?>
			</div>
		</div>
	</div>
</div>
<?
$this->view('footer')?>