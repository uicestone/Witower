<?$this->view('header')?>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong><?=lang(uri_segment(1))?></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/<?=uri_segment(1)?>/product">产品管理</a>
			<span class="divider">/</span>
		</li>
		<li>
			<?if(isset($product['id'])){?>编辑产品 <?=$product['name']?><?}else{?>添加产品<?}?>
		</li>
	</ul>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right">
		<div class="model">
			<div class="title"><h3><?if(isset($product['id'])){?>编辑产品 <?=$product['name']?><?}else{?>添加产品<?}?></h3></div>
			<div class="main">
				<div class="show_content">
					<?$this->view('alert')?>
					<form class="form-horizontal" method="post" enctype="multipart/form-data">
						<div class="control-group">
							<label class="control-label">产品名称</label>
							<div class="controls">
								<input type="text" name="name" value="<?=set_value('name',$product['name'])?>">
								<span class="label label-important"><?=form_error('name')?></span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">产品图片</label>
							<div class="controls">
								<?=$this->image('product',isset($product['id'])?$product['id']:NULL,200,220)?>
								<br>
								<input type="file" name="image" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">产品描述</label>
							<div class="controls">
								<textarea rows="4" name="description"><?=set_value('description',$product['description'])?></textarea>
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