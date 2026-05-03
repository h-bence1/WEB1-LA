CREATE TABLE `users`
(
    `id`         int(10) unsigned NOT NULL auto_increment,
    `last_name`  varchar(45)      NOT NULL default '',
    `first_name` varchar(45)      NOT NULL default '',
    `username`   varchar(12)      NOT NULL default '',
    `password`   varchar(40)      NOT NULL default '',
    PRIMARY KEY (`id`)
);

CREATE TABLE logs
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    userId     INT          NOT NULL,
    action     VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE images
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    filename     VARCHAR(255) NOT NULL,
    filepath     VARCHAR(255) NOT NULL,
    uploaded_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
    uploadedUser VARCHAR(255) NOT NULL
);

CREATE TABLE contact
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    email   VARCHAR(255) NOT NULL,
    message TEXT         NOT NULL
);
