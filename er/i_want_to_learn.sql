drop database if exists iwtl;
create database iwtl;
use iwtl;

create table user(
    id int primary key not null auto_increment,
    username varchar(50) not null,
    `password` varchar(255) not null,
    email varchar(255) not null,
    registration_date datetime not null default current_timestamp,
    active bit not null default 1,
    `role` tinyint not null default 0, -- 0 - user, 1 - admin
    last_login datetime
);

create table topic(
    id int primary key not null auto_increment,
    `name` varchar(255) not null,
    `description` text not null,
    date_posted datetime not null default current_timestamp,
    user int not null,
    image int
);

create table suggestion(
    id int primary key not null auto_increment,
    `user` int not null,
    title varchar(255) not null,
    topic int not null,
    date_posted datetime not null default current_timestamp,
    short_description varchar(255) not null,
    long_description text
);

create table image(
    id int primary key not null auto_increment,
    `user` int not null,
    file_path varchar(255) not null,
    date_posted datetime not null default current_timestamp,
    alt_text varchar(255),
    suggestion int
);

create table user_topic_subscription(
    `user` int not null,
    topic int not null,
    subscribed_since datetime not null default current_timestamp
);

create table user_suggestion_review(
	`user` int not null,
	suggestion int not null,
	user_score tinyint not null default 1,
	date_reviewed datetime not null default current_timestamp
);

alter table topic
	add foreign key (image) references image(id);
alter table topic
	add foreign key (user) references user(id);

alter table suggestion
    add foreign key (user) references user(id);
alter table suggestion
    add foreign key (topic) references topic(id);

alter table image 
    add foreign key (user) references user(id);
alter table image
	add foreign key (suggestion) references suggestion(id);

alter table user_topic_subscription
    add foreign key (user) references user(id);
alter table user_topic_subscription
    add foreign key (topic) references topic(id);
   
alter table user_suggestion_review
	add foreign key (user) references user(id);
alter table user_suggestion_review
	add foreign key (suggestion) references suggestion(id);




