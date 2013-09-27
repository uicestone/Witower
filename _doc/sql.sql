-- 同步版本表中的所在项目
update version inner join wit on wit.id = version.wit set version.project = wit.project;

-- 根据版本打分更新候选人分数
create temporary table version_grouped
select id,project,sum(score_company) sum, user from version
group by project, user;
update project_candidate inner join version_grouped on project_candidate.candidate=version_grouped.user and project_candidate.project=version_grouped.project
set project_candidate.score_company = version_grouped.sum;

-- 删除创意版本
update wit set latest_version = null;
truncate table version_comment;
delete from version;
ALTER TABLE  `version` AUTO_INCREMENT =1;
delete from wit;
ALTER TABLE  `wit` AUTO_INCREMENT =1;

-- 删除项目产品
truncate table project_candidate;
truncate table project_tag;
truncate table project_vote;
truncate table user_favorite_project;
truncate table finance;
truncate table product_tag;
delete from project;
delete from product;
delete from tag;
ALTER TABLE  `project` AUTO_INCREMENT =1;
ALTER TABLE  `product` AUTO_INCREMENT =1;
ALTER TABLE  `tag` AUTO_INCREMENT =1;

-- 删除用户公司
TRUNCATE TABLE company;
TRUNCATE TABLE  `user_follow`;
TRUNCATE TABLE  `user_profile`;

TRUNCATE TABLE  `user_status_comment`;
delete from user_status;
ALTER TABLE  `user_status` AUTO_INCREMENT =1;
delete from user;
ALTER TABLE  `user` AUTO_INCREMENT =1;

-- 更新并校正用户粉丝数
update user inner join (
    select user.id,count(*) fans from `user`
    inner join user_follow on user_follow.idol = user.id
    group by user.id
)fans using (id)
set user.fans = fans.fans;

-- 更新并校正用户关注数
update user inner join (
    select user.id,count(*) follows from `user`
    inner join user_follow on user_follow.fan = user.id
    group by user.id
)follows using (id)
set user.follows = follows.follows;

-- 更新并校正用户状态数
update user inner join (
    select user.id,count(*) statuses from `user`
    inner join user_status on user_status.user = user.id
    group by user.id
)statuses using (id)
set user.statuses = statuses.statuses;