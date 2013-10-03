<?$this->view('header')?>
	<ul class="breadcrumb">
		<li>
			<strong><?=lang(uri_segment(1))?></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/<?=uri_segment(1)?>/finance">系统配置</a>
			<span class="divider">/</span>
		</li>
		<li>
			<?=$item?>
		</li>
	</ul>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right" class="span9">
		<div class="model">
			<div class="title"><h3>系统配置 - <?=$item?></h3></div>
			<div class="main">
				<div class="show_content">
					<?$this->view('alert')?>
					<form class="form-horizontal" method="post">
						<div class="control-group">
							<label class="control-label">值</label>
							<div class="controls">
								<input type="text" name="value" value="<?=set_value('value',$value)?>">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button class="btn btn-primary" type="submit" name="submit">保存</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?$this->view('footer')?>