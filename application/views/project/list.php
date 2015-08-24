<?php $this->view('header'); ?>
<link href="<?=base_url()?>style/liulanxiangmu.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>style/style.css" rel="stylesheet" type="text/css" />

<?php if(isset($recommended_project)){ ?>
<?php $this->view('project/recommended'); ?>
<?php } ?>
<br>
</div>
<?php $this->view('project/search'); ?>

<br>
<div class="indexDiv">
 <?php foreach ($projects as $project) { ?>
      <li>
          <div class="imgDiv"><a href="<?= site_url() ?>project/<?= $project['id'] ?>">
		  
		  <?= $this->image('project', $project['id'], 200 ,array( 146,87))?>
		  
		  </a></div>
          <div class="bg">
              <div class="name"><a href="<?= site_url() ?>project/<?= $project['id'] ?>"><?= $project['name'] ?></div>
              <div class="time">截止时间：<?= in_array($project['status'], array('preparing', 'witting')) ? $project['wit_end'] : $project['vote_end'] ?> <em><?= lang($project['status']) ?></em></div>
              <div class="price"><a href="<?= site_url() ?>project/<?= $project['id'] ?>">项目金额：<span><?= $project['bonus'] ?></span></div>
              <div class="msg">讨论留言：<?= $project['comments_count'] ?><span>参与人数：<?= $project['witters'] ?></span></div>
          </div>
      </li>

      <?}?>
</div>

<?php $this->view('footer'); ?>


