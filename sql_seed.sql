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
title varchar(140) NOT NULL default '',
freshness INT NOT NULL default 0,
director varchar(100) NOT NULL default '',
year INT NOT NULL default 0,
rating varchar(10) NOT NULL default '',
runtime INT NOT NULL default 0,
box_office INT NOT NULL default 0
);

insert into accounts(user_name, password, first_name, last_name, publication) values 
    ('CWalken', 'Anotherhashedpassword', 'Chris', 'Walken', 'Promenade'),
    ('KWalken', '4n0th3RH4SH3dp455w0rDz!', 'Kyle', 'Walken', 'Step By Step'),
    ('DFarber', 'H4SH3dp455w0rDz!', 'Dave', 'Farber', 'Fox Groomers');
insert into reviews(movie_title, review, is_fresh, author, publication) values 
    ('The Princess Bride', 'One of Reiner''s most entertaining films, effective as a swashbuckling epic, romantic fable, and satire of these genres.', 'FRESH', 'Emanuel Levy', 'EmanuelLevy.com'),
    ('The Princess Bride', 'Based on William Goldman''s novel, this is a post-modern fairy tale that challenges and affirms the conventions of a genre that may not be flexible enough to support such horseplay.', 'ROTTEN', 'Variety Staff', 'Variety'),
    ('The Princess Bride', 'Rob Reiner''s friendly 1987 fairy-tale adventure delicately mines the irony inherent in its make-believe without ever undermining the effectiveness of the fantasy.', 'FRESH', 'Jonathan Rosenbaum', 'Chicago Reader'),
    ('The Princess Bride', 'One of the Top films of the 1980s, if not of all time. A treasure of a film that you''ll want to watch again and again.', 'FRESH', 'Clint Morris', 'Moviehole'),
    ('The Princess Bride', 'An effective comedy, an interesting bedtime tale, and one of the greatest date rentals of all time.', 'FRESH', 'Brad Laidman', 'Film Threat'),
    ('The Princess Bride', 'The lesson it most effectively demonstrates is that cinema has the power to turn you into a kid again. As we wish.', 'FRESH', 'Phil Villarreal', 'Arizona Daily Star'),
    ('The Princess Bride', 'My name is Marty Stepp.  You killed my father.  Prepare to die.', 'FRESH', 'Marty Stepp', 'Step by Step Publishing'),
    ('Mortal Kombat', 'Delightfully horrible.  When the overseer of the island tournament throws out catch phrases from the retro arcade game, you can''t help but to cringe in delight.', 'FRESH', 'Kelly Dunn', 'existentialsmut.com'),
    ('Mortal Kombat', 'cheesy but still, kick ass', 'FRESH', 'Stefan Birgir', 'Birgirtown'),
    ('Mortal Kombat', 'Like watching a lot of sweaty fist fights while trapped in the world''s loudest night club.', 'ROTTEN', 'Scott Weinberg', 'FilmCritic.com'),
    ('Mortal Kombat', 'If the movie Mortal Kombat were a character in a Mortal Kombat video game, its special maneuver would be to climb on its opponent''s shoulders and defecate on his head. ', 'ROTTEN', 'Eric D. Snider', 'EricDSnider.com'),
    ('Mortal Kombat', 'What it''s missing, ironically, is the edge that''s made Mortal Kombat the video game such a powerful icon in American pop culture.', 'ROTTEN', 'Bryant Frazer', 'Deep Focus'),
    ('Mortal Kombat', 'The movie that most nearly approximates a video game: lots of action, no plot, eye-catching computer effects and a dollop of violence.', 'ROTTEN', 'Sean Means', 'Film.com'),
    ('Mortal Kombat', 'Hopeless? Oh yes. It''s hopeless alright. Mondo hopeless. ', 'ROTTEN', 'Oz', 'Hollywood Slap'),
    ('Mortal Kombat', 'MOOOORTAAAAAL KOOOOMBAAAATTT!!!', 'FRESH', 'Roger Ebert', 'Hollywood Movie Review'),   
    ('Mortal Kombat', 'Get over here.', 'ROTTEN', 'Scorpion', 'Island Battle Front'),
    ('The Martian', 'Dispenses with so much of the standard violent-action fare we have come to expect from science fiction films and instead returns the genre to its roots in the thrill of exploration and the wonders of science', 'FRESH', 'James Kendrick', 'Q Network Film Desk'),
    ('The Martian', 'It''s one of the year''s best movies and widescreen 3D experiences, a crackerjack adventure that celebrates human ingenuity over mechanical contrivance.', 'FRESH', 'Peter Howell', 'Toronto Star'),
    ('The Martian', '3-D conveys the frightening depth of space, but the suspense machinery crowds out all but the most banal philosophizing.', 'ROTTEN', 'Jonathan Rosenbaum', 'Chicago Reader'),
    ('The Martian', 'While this movie isn''t as good as ''Interstellar'', the science is more believable and the story is certainly a lot more straightforward and understandable, especially for the non-geeks amongst us.', 'FRESH', 'Robert Roten', 'Laramie Movie Scope'),
    ('The Martian', 'Don''t let seeing the movie stop you from reading the book.', 'FRESH', 'Gail Pennington', 'St. Louis Post-Dispatch'),
    ('TMNT', 'Ditching the cheeky, self-aware wink that helped to excuse the concept''s inherent corniness, the movie attempts to look polished and ''cool,'' but the been-there animation can''t compete with the then-cutting-edge puppetry of the 1990 live-action movie.', 'ROTTEN', 'Peter Debruge', 'Variety'),
    ('TMNT', 'TMNT is a fun, action-filled adventure that will satisfy longtime fans and generate a legion of new ones.', 'FRESH', 'Todd Gilchrist', 'IGN Movies'),
    ('TMNT', 'It stinks!', 'ROTTEN', 'Jay Sherman', '(unemployed)'),
    ('TMNT', 'The rubber suits are gone and they''ve been redone with fancy computer technology, but that hasn''t stopped them from becoming dull.', 'ROTTEN', 'Joshua Tyler', 'CinemaBlend.com'),
    ('TMNT', 'The turtles themselves may look prettier, but are no smarter; torn irreparably from their countercultural roots, our superheroes on the half shell have been firmly co-opted by the industry their creators once sought to spoof.', 'ROTTEN', 'Jeannette Catsoulis', 'New York Times'),
    ('TMNT', 'Impersonally animated and arbitrarily plotted, the story appears to have been made up as the filmmakers went along.', 'ROTTEN', 'Ed Gonzalez', 'Slant Magazine'),
    ('TMNT', 'The striking use of image and motion allows each sequence to leave an impression. It''s an accomplished restart to this franchise.', 'FRESH', 'Mark Palermo', '(Halifax, Nova Scotia)'),
    ('TMNT', 'The script feels like it was computer generated. This mechanical presentation lacks the cheesy charm of the three live action films.', 'ROTTEN', 'Steve Rhodes', 'Internet Reviews'),
    ('Teenage Mutant Ninja Turtles II: The Secret of the Ooze', 'This lacks the darkness and subtlety that makes the first film so good, and so adult, but its simplified plot and gags will appeal to the under tens.', 'FRESH', 'Lloyd Bradley', 'Empire Magazine'),
    ('Teenage Mutant Ninja Turtles II: The Secret of the Ooze', 'The sequel plays things very safe.', 'ROTTEN', 'Douglas Pratt', 'DVDLaser'),
    ('Teenage Mutant Ninja Turtles II: The Secret of the Ooze', 'One can have a reasonably amusing time with this predictable sequel, which is a bit longer on action and shorter on wit and character than the original.', 'FRESH', 'Jonathan Rosenbaum', 'Chicago Reader'),
    ('Teenage Mutant Ninja Turtles II: The Secret of the Ooze', 'The Turtles, when not battling Shredder or providing Vanilla Ice with the basis for a rap number, kid around in enjoyable ways.', 'FRESH', 'Janet Maslin', 'New York Times'),
    ('Teenage Mutant Ninja Turtles II: The Secret of the Ooze', 'This one should have oozed out of the can before it got into any theaters.', 'ROTTEN', 'Bob Bloom', 'Journal and Courier'),
    ('Teenage Mutant Ninja Turtles II: The Secret of the Ooze', 'Not only insulting to your intelligence, but also harmful for children to watch.', 'ROTTEN', 'Derek Smith', 'Apollo Guide'),
    ('Teenage Mutant Ninja Turtles II: The Secret of the Ooze', 'Dear God, why?', 'ROTTEN', 'Ken Hanke', 'Mountain Xpress'),
    ('Teenage Mutant Ninja Turtles II: The Secret of the Ooze', 'The muppets look mighty fake, and Vanilla Ice was better in Cool as Ice, but check out wrestler Kevin Nash as Super Shredder.', 'FRESH', 'Luke Y. Thompson', 'New Times'),
    ('Teenage Mutant Ninja Turtles II: The Secret of the Ooze', 'Even more fun than the original!', 'FRESH', 'Clint Morris', 'Moviehole'),
    ('Teenage Mutant Ninja Turtles II: The Secret of the Ooze', 'If a Vanilla Ice cameo is a highlight, imagine what the rest of the film is like.', 'ROTTEN', 'James Sanford', 'Kalamazoo Gazette'),
    ('Teenage Mutant Ninja Turtles II: The Secret of the Ooze', 'Next time, if the Turtles really want to hurt ''em, they should call on Hammer.', 'ROTTEN', 'Peter Travers', 'Rolling Stone');
insert into movies(user_name, title, freshness, director, year, rating, runtime, box_office) values 
    ('admin','The Princess Bride', 95, 'Rob Reiner', 1987, 'PG', 98, 30900000),
    ('admin','TMNT', 33, 'Kevin Munroe', 2007, 'PG', 90, 54132596),
    ('admin','The Martian', 93, 'Ridley Scott', 2015, 'PG-13', 98, 555561088),
    ('admin','Teenage Mutant Ninja Turtles II: The Secret of the Ooze', 36, 'Michael Pressman', 1991, 'PG', 88, 20030473),
    ('admin','Mortal Kombat', 74, 'Paul Anderson', 1995, 'PG-13', 101, 23283887);
