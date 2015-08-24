<? $this->view('header') ?>
<div style="margin:10px 0;" class="text-right"><a href="<?=site_url()?>piece/add" class="btn btn-primary">发布作品</a></div>
<div class="water hide thumbnails">
<?foreach($pieces as $piece){?>
	<div class="span3 box">
		<div class="thumbnail">
			<?
			$files = json_decode($piece['files']);

			$thumbnail_url = base_url().'style/video_icon.png';


			foreach($files as $file){
				if(preg_match('/^image/', $file->file_type)){
					$thumbnail_url = $file->url;
				}
			}
			?>
			<a href="<?=site_url()?>piece/<?=$piece['id']?>">
			
				<img src="<?=$thumbnail_url?>" width="100%;">
			
			</a>
			<div class="container">
            <h4><b>作品名称:</b><a href="<?=site_url()?>piece/<?=$piece['id']?>"><?=substr($piece['name'],0,21)?>...</a></h4>
            <h4><b>&nbsp;&nbsp;发布人:</b><?=$this->db->query("select name from user where id = {$piece['user']}")->row()->name?></h4>
            <h4><b>发布时间:</b><?=date('Y-m-d H:i', intval($piece['time']))?></h4>

           <!-- <div class="hb"></div>
            <div class="zuop">
            <div class="div"><?=$piece['user']?><div class="jif">积分：<span>1589</span></div></div>


            </div>-->



<!--				<p><?=preg_replace('/\<iframe[\s\S]*?\<\/iframe\>/', '', $piece['description'])?></p>-->



			</div>
		</div>
	</div>
<?}?>
</div>

<? $this->view('footer') ?>
