<?$this->view('header')?>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong>企业</strong>
			<span class="divider">/</span>
		</li>
		<li>
			编辑产品
		</li>
	</ul>
	<?$this->view('company/sidebar')?>
	<div id="right">
		<div class="model">
			<div class="title"><h3>编辑产品</h3></div>
			<div class="main">
				<div class="show_content">
					<?$this->view('alert')?>
					<form class="form-horizontal" method="post" enctype="multipart/form-data">
						<div class="control-group">
							<label class="control-label">产品名称</label>
							<div class="controls">
								<input type="text" name="name" value="<?=$product['name']?>">
								<span class="label label-important"><?=form_error('name')?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">产品图片</label>
							<div class="controls">
								<input type="file" name="image">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">产品描述</label>
							<div class="controls">
								<textarea rows="4" name="description"><?=$product['description']?></textarea>
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button class="btn btn-primary" type="submit" name="submit">确定</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>