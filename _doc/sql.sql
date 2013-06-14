-- 根据版本打分更新候选人分数
create temporary table version_grouped
select id,project,sum(score_company) sum, user from version
group by project, user;
update project_candidate inner join version_grouped on project_candidate.candidate=version_grouped.user and project_candidate.project=version_grouped.project
set project_candidate.score_company = version_grouped.sum;