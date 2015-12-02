/*
    Seed file for 337 final project
*/

drop table if exists accounts;
CREATE TABLE accounts (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_name varchar(64) NOT NULL default '',
password varchar(255) NOT NULL default '',
first_name varchar(64) NOT NULL default '',
last_name varchar(64) NOT NULL default '',
publication varchar(64) NOT NULL default ''
);


drop table if exists reviews;
CREATE TABLE reviews(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
movie_title varchar(64) NOT NULL default '',
review varchar(2000) NOT NULL default '',
is_fresh varchar(6) NOT NULL default '',
author varchar(64) NOT NULL default '',
publication varchar(100) NOT NULL default ''
);

drop table if exists movies;
CREATE TABLE movies(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_name varchar(64) NOT NULL default '',
title varchar(64) NOT NULL default '',
freshness INT NOT NULL default 0,
director varchar(100) NOT NULL default '',
year INT NOT NULL default 0,
rating varchar(140) NOT NULL default '',
runtime INT NOT NULL default 0,
box_office INT NOT NULL default 0
);

insert into accounts(user_name, password, first_name, last_name, publication) values 
    ('CWalken', 'Anotherhashedpassword', 'Chris', 'Walken', 'Promenade'),
    ('KWalken', '4n0th3RH4SH3dp455w0rDz!', 'Kyle', 'Walken', 'Step By Step'),
    ('DFarber', 'H4SH3dp455w0rDz!', 'Dave', 'Farber', 'Fox Groomers');
insert into reviews(movie_title, review, author, publication) values 
    ('The Princess Bride', 'One of Reiner''s most entertaining films, effective as a swashbuckling epic, romantic fable, and satire of these genres.', 'FRESH', 'Emanuel Levy', 'Emanuel Levy'),
    ('The Princess Bride', 'Based on William Goldman''s novel, this is a post-modern fairy tale that challenges and affirms the conventions of a genre that may not be flexible enough to support such horseplay.', 'ROTTEN', 'Variety Staff', 'Variety');
insert into movies(user_name, title, freshness, director, year, rating, runtime, box_office) values 
    ('CWalken','Senior Abnormal Samurai Chickens', 11, 'director 1', 1999, 'G', 0, 0),
    ('KWalken','Adolescent Cancerous Peasant Ducklings', 22, 'director 2', 1999, 'PG', -12, -999999999),
    ('DFarber','Teenage Mutant Ninja Turkeys', 33, 'director 3', 1999, 'NC-70', 999, 999999999);
