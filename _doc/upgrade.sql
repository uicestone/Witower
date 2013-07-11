ALTER TABLE  `wit` ADD  `latest_version` INT NULL;
ALTER TABLE  `wit` ADD INDEX (  `latest_version` );
ALTER TABLE  `wit` ADD FOREIGN KEY (  `latest_version` ) REFERENCES  `witower`.`version` (
`id`
) ON DELETE NO ACTION ON UPDATE CASCADE ;
update wit inner join 
(
select * from 
(
select * from version order by id desc
)version_ordered
group by wit
)version_grouped
on version_grouped.wit=wit.id
set wit.latest_version=version_grouped.id;


