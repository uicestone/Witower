<?$this->view('header')?>
<div id="content" class="page-company">
	<div class="breadcrumb">
		<strong>企业</strong> >> 编辑项目
	</div>
	<?$this->view('company/sidebar')?>
	<div id="right">
		<div class="model">
			<div class="title"><h3>编辑项目}</h3></div>
			<div class="main">
				<div class="show_content">
					<form class="form-horizontal" enctype="multipart/form-data" method="post">
						<div class="control-group">
							<label class="control-label">项目名称</label>
							<div class="controls">
								<input type="text" name="title" value="<?=$project[title]?>">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">项目图片</label>
							<div class="controls">
								<input type="file" name="pic">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">项目描述</label>
							<div class="controls">
								<textarea rows="4" name="summary"><?=$project[summary]?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">发布日期</label>
							<div class="controls">
								<input type="text" name="start_time" value="<?=$project[start_time]?>">
								截止日期
								<input type="text" name="end_time" value="<?=$project[end_time]?>">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">悬赏金额</label>
							<div class="controls">
								<input type="text" name="money" value="<?=$project[money]?>">目前可使用悬赏金额是 90000 元
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">关键词</label>
							<div class="controls">
								<input type="text">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button class="btn btn-primary" type="submit" name="submit">确定</button>
								<button class="btn btn-primary" type="reset">重置</button>
								<button class="btn btn-primary" type="submit" name="preview">预览</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?$this->view('footer')?>