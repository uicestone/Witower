<?php $this->view('header'); ?>
<?php $this->view(uri_segment(1).'/sidebar'); ?>
<div id="right" class="span9">
	<?php $this->view('alert'); ?>
	<div class="model">
		<div class="title"><h3><a href="/<?=uri_segment(1)?>/config">系统设置</a></h3></div>
		<div class="main">
			<table class="table table-bordered">
				<thead>
					<tr><th>键</th><th>值</th><th style="width: 4em;">&nbsp;</th></tr>
				</thead>
				<tbody>
					<? foreach ($config_items as $key => $value) { ?>								
						<tr> 
							<td><?=$key?></td>
							<td><?=$value?></td>
							<td><a href="/admin/config/<?=$key?>" class="btn btn-small">编辑</a></td>
						</tr>
					<? } ?>
				</tbody>
			</table>

			<div class="title"><h3><a href="/<?= uri_segment(1) ?>/config">首页幻灯片上传</a></h3></div>
			<form method="post" enctype="multipart/form-data">
				<table class="table table-bordered">
					<thead>
						<tr><th>选择文件</th><th>超链接地址</th><th style="width: 4em;">&nbsp;</th></tr>
					</thead>
					<tbody>
						<tr>
							<td valign="middle"><input type="file" name="banner_image"></td>
							<td><input type="text" name="url"></td>
							<td><button type="submit" name="upload_banner_image" class="btn btn-small">上传</button></td>
						</tr>
					</tbody>
				</table>
			</form>

			<div class="title"><h3><a href="/<?= uri_segment(1) ?>/config">已上传的图片</a></h3></div>
			<?php if (count($home_slide_images) == 0) { ?>
				还未上传图片
			<?php } else { ?>
			<form method="post" onsubmit="return confirm('您确认要删除该图片吗？')">
				<table class="table table-bordered">
					<thead>
						<tr><th style="width: 30%;">文件名</th><th style="width: 50%;">超链接地址</th><th style="width: 20%;">操作</th></tr>
					</thead>
					<tbody>
						<?php foreach ($home_slide_images as $image) { ?>
							<tr>
								<td><?= $image->filename ?></td>
								<td><?= $image->url ?></td>
								<td>
									<a href="<?= site_url() ?>uploads/images/banner/<?= $image->filename ?>" target="_blank" class="btn btn-small">查看</a>
									<button name="delete_banner_image" value="<?=$image->filename?>" class="btn btn-small">删除</button>
								</td>
							</tr>					
						<?php } ?>
					</tbody>
				</table>
			</form>
			<?php } ?>
		</div>
	</div>
</div>
<?php $this->view('footer'); ?>