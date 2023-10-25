<?php

//variables
$type = "mysql";
$host = "localhost";
$dbName = "fsd10_uniform";
$port = "8889"; //Benjamins port: 8889
$charset = "utf8";
$dbUsername = "fsduser";
$dbPassword = "myDBpw";

//connection string (data source name)
$DSN = "{$type}:host={$host};dbname={$dbName};port={$port};charset={$charset}";

//open new database connection
$db = new PDO($DSN, $dbUsername, $dbPassword);