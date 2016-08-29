<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once "lib/Database.php";

$Database = new Database();

$Database->exec("CREATE TABLE IF NOT EXISTS User
(
UserId int NOT NULL PRIMARY KEY AUTO_INCREMENT,
Username varchar(50),
Password varchar(50),
Email varchar(50)
);");

$Database->exec("CREATE TABLE IF NOT EXISTS Assets
(
AssetId int NOT NULL PRIMARY KEY AUTO_INCREMENT,
Javno varchar(3),
MimeTip varchar(30),
UserId int NOT NULL,
FOREIGN KEY (UserId) REFERENCES User(UserId)
);");