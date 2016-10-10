CREATE TABLE user (
	userID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username varchar(255),
	password varchar(255),
	firstname varchar(255),
	lastname varchar(255),
	email varchar(255),
	last_login timestamp()
);

CREATE TABLE role (
	roleID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	role varchar(25) default 'teacher'
);

CREATE TABLE user_role (
	user int NOT NULL,
	role int NOT NULL,
	primary key (userID, roleID)
);

CREATE TABLE observation (
	obsID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	obsDate date timestamp(),
	obsLength time(),
	rating varchar(255),
	videofile varchar(255)
);

CREATE TABLE comments (
	commID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	commDomain varchar(255),
	behavior varchar(255),
	rating varchar(255),
	comment varchar(255)
);

CREATE TABLE observation_users (
	observation int NOT NULL,
	teacher int NOT NULL,
	observer int NOT NULL,
	primary key (observation, teacher, observer)
)

CREATE TABLE observation_comments (
	observation int NOT NULL,
	comment int NOT NULL,
	commTime time(),
	primary key (observation, teacher, observer)
)

