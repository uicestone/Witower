-- 同步版本表中的所在项目
update version inner join wit on wit.id = version.wit set version.project = wit.project;

-- 根据版本打分更新候选人分数
create temporary table version_grouped
select id,project,sum(score_company) sum, user from version
group by project, user;
update project_candidate inner join version_grouped on project_candidate.candidate=version_grouped.user and project_candidate.project=version_grouped.project
set project_candidate.score_company = version_grouped.sum;

-- 删除所有项目和版本
update wit set latest_version = null;
delete from version_comment;
delete from version;
delete from wit;

delete from project_candidate;
delete from project_tag;
delete from project_vote;
delete from user_favorite_project;
delete from user_bonus;
delete from project;
delete from product_tag;
delete from product;
ALTER TABLE  `project` AUTO_INCREMENT =1;
ALTER TABLE  `product` AUTO_INCREMENT =1;

TRUNCATE TABLE company;
TRUNCATE TABLE  `user_follow`;
TRUNCATE TABLE  `user_profile`;

delete from user_status;
delete from user;
ALTER TABLE  `user` AUTO_INCREMENT =1;

ALTER TABLE `company`
  DROP `total_bonus`,
  DROP `frozen_bonus`;
