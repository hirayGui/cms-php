CREATE DATABASE cms_teste;

USE cms_teste;

/* Creating tables */
CREATE TABLE tb_users(
	id_user INT NOT NULL AUTO_INCREMENT,
	ds_name VARCHAR(40) NOT NULL,
	ds_email VARCHAR(40) NOT NULL,
	ds_password VARCHAR(255) NOT NULL,
	ds_status ENUM('ativo', 'inativo') DEFAULT 'ativo' NOT NULL,
	ds_role ENUM('admin', 'user') DEFAULT 'user' NOT NULL,
	PRIMARY KEY(id_user)
);

CREATE TABLE tb_categories(
	id_category INT NOT NULL AUTO_INCREMENT,
    ds_name VARCHAR(40) NOT NULL,
    PRIMARY KEY(id_category)
);

CREATE TABLE tb_posts(
	id_post INT NOT NULL AUTO_INCREMENT,
    ds_title VARCHAR(40) NOT NULL,
    ds_body TEXT NOT NULL,
    dt_created DATE DEFAULT(current_date) NOT NULL,
    ds_status ENUM('publicado', 'não publicado') DEFAULT 'publicado' NOT NULL,
    id_user INT NOT NULL,
    id_category INT NOT NULL,
    PRIMARY KEY(id_post),
    FOREIGN KEY (id_user) REFERENCES tb_users(id_user),
    FOREIGN KEY (id_category) REFERENCES tb_categories(id_category)
    );/* Post has an author and a category, therefore it needs their primary keys*/
    
/*Inserts*/
INSERT INTO tb_categories(
			ds_name
            ) 
VALUES(
		'Notícias'
		);

INSERT INTO tb_users (
				ds_name, 
                ds_email, 
                ds_password, 
                ds_status,
                ds_role
                ) 
VALUES (
		'Toninho', 
        'antoniosaraivada@gmail.com', 
        'fe442ae37a1ea8d2a41a55ac648557cc0b90af552bd5a716f7c94001b4e6c2d2', 
        'ativo',
        'user'
        );
        
INSERT INTO tb_posts (
				ds_title,
                ds_body,
                ds_status,
                id_user,
                id_category)
VALUES (
		'Post 3',
		'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquam, 
        iste. Quod dolore similique error. Sed omnis, beatae labore ipsum 
        exercitationem expedita tenetur molestiae tempore suscipit perspiciatis 
        quisquam? Culpa, numquam optio!',
        'publicado',
        1,
        3);

/*Selects*/
SELECT id_category,
	   ds_name
FROM tb_categories;

SELECT 	id_user, 
		ds_name,
        ds_email,
        ds_password,
        ds_role,
        ds_status
FROM tb_users;

SELECT 	id_post as Id,
		ds_title as Título,
        ds_body as Texto,
        DATE_FORMAT(dt_created, '%e %b %Y') as Criação,
        ds_status as Status,
        id_user as Autor,
        id_category as Categoria
FROM tb_posts;

/**/
SELECT table_schema "DB name",
sum( data_length + index_length ) / 1024 / 1024 "DB size in MB",
sum( data_free )/ 1024 / 1024 "free/reclaimable space in MB"
FROM information_schema.TABLES
GROUP BY table_schema; 

SELECT 	id_user, 
		ds_name,
        ds_email,
        ds_password,
        ds_role,
        ds_status
FROM tb_users
ORDER BY id_user DESC
LIMIT 3;
