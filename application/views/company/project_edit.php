<?$this->view('header')?>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong>企业</strong>
			<span class="divider">/</span>
		</li>
		<li>
			编辑项目
		</li>
	</ul>
	<?$this->view('company/sidebar')?>
	<div id="right">
		<div class="model">
			<div class="title"><h3>编辑项目</h3></div>
			<div class="main">
				<div class="show_content">
					<form class="form-horizontal" enctype="multipart/form-data" method="post">
						<div class="control-group">
							<label class="control-label">项目名称</label>
							<div class="controls">
								<input type="text" name="name" value="<?=$project['name']?>">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">所属产品</label>
							<div class="controls">
								<select name="product">
									<?=options($products, $project['product'],'', true)?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">项目图片</label>
							<div class="controls">
								<input type="file" name="image">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">项目描述</label>
							<div class="controls">
								<textarea rows="4" name="summary"><?=$project['summary']?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">发布日期</label>
							<div class="controls">
								<input type="text" name="start" value="<?=$project['wit_start']?>">
								截止日期
								<input type="text" name="end" value="<?=$project['wit_end']?>">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">悬赏金额</label>
							<div class="controls">
								<input type="text" name="bonus" value="<?=$project['bonus']?>">
								<span>目前可使用悬赏金额是 <?=$this->company->total_bonus?> 元</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">关键词</label>
							<div class="controls">
								<input type="text" name="tags" />
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button class="btn btn-primary" type="submit" name="submit">确定</button>
								<button class="btn" type="reset">重置</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>