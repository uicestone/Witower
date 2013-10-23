<? $this->view('header') ?>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right" class="span9">
		<div class="model">
			<div class="title"><h3><a href="/<?=uri_segment(1)?>/product">产品管理</a></h3></div>
			<div class="main">
				<button class="btn" type="button" onclick="location.href = '/<?=uri_segment(1)?>/addproduct'">增加新产品</button>
				<table class="table table-bordered">
					<thead>
						<tr><th style="width:100px">产品名称</th><th class="descript">描述</th><th style="width:6em;">项目</th></tr>
					</thead>
					<tbody>
						<? foreach ($products as $product) { ?>								
							<tr> 
								<td>
									<?= $product['name'] ?>
									<?=$this->image('product',$product['id'],100)?>
									<a class="btn btn-small" href="/<?=uri_segment(1)?>/product/<?= $product['id'] ?>" style="margin-top: 5px">修改</a>
								</td>
								<td><?=str_getSummary($product['description'],250)?></td>
								<td>
									<a href="/<?=uri_segment(1)?>/project/witting">进行中：<?= $product['projects_witting'] ?>个</a><br>
									<a href="/<?=uri_segment(1)?>/project/voting">投票中：<?= $product['projects_voting'] ?>个</a><br><br>
									<a class="btn btn-small" href="/<?=uri_segment(1)?>/addproject?product=<?= $product['id'] ?>">发布项目</a>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
				<?=$pagination?>
			</div>
		</div>
	</div>
<?
$this->view('footer')?>