<?php $this->view('header')?>
<style>
.slidesjs-pagination{  display:none;}
</style>
<script type="text/javascript" src="<?= site_url() ?>js/jquery.slides.minn.js"></script>
<link href="<?=base_url()?>style/index.css" rel="stylesheet" type="text/css" />
<div class="pageBanner">
		<?php if(!empty($home_slide_images)){ ?>
		<!--幻灯片切换层START-->
		<link rel="stylesheet" type="text/css" href="<?=site_url()?>style/slides.css">
		<div id="slides" style="margin-top:-20px;">
			<?php foreach ($home_slide_images as $image) { ?>
				<?php if ($image->url) { ?><a href="<?= $image->url ?>" target="_blank"><?php } ?>
					<img src="<?= site_url() ?>uploads/images/banner/<?= $image->filename ?>" width="375px" height="156px">
					<?php if ($image->url) { ?></a><?php } ?>
			<?php } ?>
		</div>
		<!--幻灯片切换层END-->
		<?php } ?>
<div class="h10"></div>
<div class="indexDiv">
<ul>
      <li class="li_01">
          <div class="imgDiv"><a href="">
		  <?= $this->image('project', $homepage_project['id'], false ,array(null,145))?>	  
		  </a></div>
          <div class="bg">
              <div class="name"><a href="<?= site_url() ?>project/<?= $homepage_project['id'] ?>"><?= $homepage_project['name'] ?></a></div>
              <div class="time"><a href="<?= site_url() ?>project/<?= $homepage_project['id'] ?>"> 截止时间：<?=$homepage_project['wit_end']?> <em><?=lang($homepage_project['status'])?></em></div>
              <div class="content">
                  <?= str_getSummary($homepage_project['summary'], 140) ?>
              </div>
              <div class="price">项目金额：<span><?=$homepage_project['bonus']?></span></div>
              <div class="msg">讨论留言：<?=$homepage_project['comments_count']?><span>参与人数：<?=$homepage_project['witters']?></span></div>
          </div>
      </li>
      <?php foreach ($projects as $project) { ?>
      <li>
          <div class="imgDiv">
              <a href="/<?= in_array($project['status'], array('preparing', 'witting')) ? 'project' : 'vote' ?>/<?= $project['id'] ?>">
		  <?= $this->image('project', $project['id'], 200 ,array(null, 87)) ?>
		  <!--<img src="<?=base_url()?>uploads/images/project/<?=$project['id']?>.jpg" height="87px"/>--></a></div>
          <div class="bg">
              <div class="name">
              <a href="/<?= in_array($project['status'], array('preparing', 'witting')) ? 'project' : 'vote' ?>/<?= $project['id'] ?>">
                 </div>
              <div class="time">截止时间：<?= in_array($project['status'], array('preparing', 'witting')) ? $project['wit_end'] : $project['vote_end'] ?> <em><?= lang($project['status']) ?></em></div>
              <div class="price">
                <a href="/<?= in_array($project['status'], array('preparing', 'witting')) ? 'project' : 'vote' ?>/<?= $project['id'] ?>">
                      项目金额：<span><?= $project['bonus'] ?></span></div>
              <div class="msg">讨论留言：<?= $project['comments_count'] ?><span>参与人数：<?= $project['witters'] ?></span></div>
          </div>
      </li>

      <?}?>

</ul>
</div>
<script type="text/javascript">
jQuery(function ($) {
	$('#slides').slidesjs({
		width: 940,
		height: 210,
		navigation: false,
		play: {
			active: false,
			// [boolean] Generate the play and stop buttons.
			// You cannot use your own buttons. Sorry.
			effect: "fade",
			// [string] Can be either "slide" or "fade".
			interval: 4000,
			// [number] Time spent on each slide in milliseconds.
			auto: true,
			// [boolean] Start playing the slideshow on load.
				swap: false,
				// [boolean] show/hide stop and play buttons
				pauseOnHover: false,
				// [boolean] pause a playing slideshow on hover
				restartDelay: 1000
						// [number] restart delay on inactive slideshow
			}
		});
	});
</script>
<?php $this->view('footer')?>