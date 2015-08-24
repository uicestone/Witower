<? $this->view('header') ?>
	<? $this->view(uri_segment(1).'/sidebar') ?>
	<div id="right" class="span9">
		<div class="model">
			<div class="title"><h3><a href="/<?=uri_segment(1)?>/finance">财务管理</a></h3></div>
			<div class="main">
				<a class="btn" href="/<?=uri_segment(1)?>/addfinance<?=$query?>">增加纪录</a>
				<a class="btn<?if(uri_segment(3)==='grouped'){?> active<?}?>" href="/<?=uri_segment(1)?>/finance/<?if(uri_segment(3)!=='grouped'){?>grouped<?}?><?=$query?>">分组</a>
				<ul class="inline pull-right">
				</ul>
				<table class="table table-bordered">
					<thead>
						<th style="width: 20%;">用户</th>
						<th style="width: 40%;">内容</th>
						<th style="width: 20%;">发表时间</th>
						<th style="width: 20%;">操作</th></tr>
					</thead>
					<tbody>
						<?php foreach ($list as $comment) { ?>
							<tr>
								<td><?= $comment['username'] ?></td>
								<td><?= $comment['content'] ?></td>
								<td><?= date('Y-m-d H:i:s',$comment['time']);  ?></td>
								<td>
								<a href="/index.php/admin/comment?is_show=<?=$comment['is_show']?>&id=<?=$comment['id']?>">
								<? if($comment['is_show']	== 0){ ?>显示<? }else{ ?>不显示 <? }?></a>
								<a href="/admin/comment?del=<?=$comment['id']?>">删除</a>
								</td>
							</tr>					
						<?php } ?>
					</tbody>
				</table>
				<?=$pagination?>
			</div>
		</div>
	</div>
<?
$this->view('footer')?>