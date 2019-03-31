for cloning table

CREATE TABLE new_table LIKE original_table;

for renaming column

ALTER TABLE admins CHANGE gfmid adminid varchar(1000);