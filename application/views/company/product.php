<? $this->view('header') ?>
<div id="content" class="page-company">
	<ul class="breadcrumb">
		<li>
			<strong><?=lang(uri_segment(1))?></strong>
			<span class="divider">/</span>
		</li>
		<li>
			<a href="/<?=uri_segment(1)?>/product">产品管理</a>
		</li>
	</ul>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right">
		<div class="model">
			<div class="title"><h3><a href="/<?=uri_segment(1)?>/product">产品管理</a></h3></div>
			<div class="main">
				<button class="btn" type="button" onclick="location.href = '/<?=uri_segment(1)?>/addproduct'">增加新产品</button>
				<table class="table table-bordered">
					<thead>
						<tr><th>产品名称</th><th class="image">图片</th><th class="descript">描述</th><th>操作</th><th>项目</th></tr>
					</thead>
					<tbody>
						<? foreach ($products as $product) { ?>								
							<tr> 
								<td><?= $product['name'] ?></td>
								<td class="image"><?=$this->image('product',$product['id'],100)?></td>
								<td><?=str_getSummary($product['description'],150)?></td>
								<td>
									<a class="btn btn-small" href="/<?=uri_segment(1)?>/product/<?= $product['id'] ?>">修改</a><br>
									<a class="btn btn-small" href="/<?=uri_segment(1)?>/addproject?product=<?= $product['id'] ?>">发布项目</a>
								</td>
								<td>
									<a href="/<?=uri_segment(1)?>/project/witting">进行中：<?= $product['projects_witting'] ?>个</a><br>
									<a href="/<?=uri_segment(1)?>/project/voting">投票中：<?= $product['projects_voting'] ?>个</a><br>
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