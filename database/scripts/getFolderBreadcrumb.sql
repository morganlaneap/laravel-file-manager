DELIMITER //
CREATE PROCEDURE getFolderBreadcrumb()
BEGIN
SET @FolderId = 7;

CREATE TEMPORARY TABLE FolderStructure 
(
id int, 
name varchar(255)
);

WHILE (@FolderId > 0) DO
INSERT INTO FolderStructure
SELECT `folders`.`id`,
`folders`.`folder_name`
FROM `folders`
WHERE `folders`.`id` = @FolderId;

SET @FolderId = (SELECT `folders`.`parent_folder`
FROM `folders`
WHERE `folders`.`id` = @FolderId);
END WHILE;

INSERT INTO FolderStructure
SELECT 0, 'My Files';

SELECT * FROM FolderStructure;

DROP TABLE FolderStructure;
END //
DELIMITER ;

CALL getFolderBreadcrumb();

DROP PROCEDURE IF EXISTS getFolderBreadcrumb;
