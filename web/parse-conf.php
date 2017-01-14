<?php
require('../vendor/autoload.php');
 
use Parse\ParseClient;

//prod
//ParseClient::initialize('9O3uQHctMnz86F6m3lifIlwKrMGONwlUjO2OL4uf', '46Wag1ZQ2LmwdEOh5Y4tZhX1YvBr0Fm1U9mJ3InL', 'gevC48VkzGHGrWrRJpz8Dt7SRl4BdJ0ycszsQX9k');
ParseClient::initialize('9O3uQHctMnz86F6m3lifIlwKrMGONwlUjO2OL4uf', '', 'gevC48VkzGHGrWrRJpz8Dt7SRl4BdJ0ycszsQX9k');
ParseClient::setServerURL('http://hungrybeeprod.herokuapp.com/parse');
?>