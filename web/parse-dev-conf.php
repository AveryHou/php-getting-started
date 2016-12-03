<?php
require('../vendor/autoload.php');
 
use Parse\ParseClient;

//ParseClient::initialize('oVYLOizsuLXxCRucXmrgWF6q0OjlXc9d1fXfBDmU', '', 'IdnvI0MJAOVh2m96HVyzprD1mieHYUH2viIoSDaw');
//ParseClient::setServerURL('http://hbdevtest01.herokuapp.com', 'parse');


//Application ID, REST, MASTER

// dev
ParseClient::initialize('oVYLOizsuLXxCRucXmrgWF6q0OjlXc9d1fXfBDmU', 'iiBwHRMDSpWdP8NEODUx0WkBXWay5q8YvEPFCxIA', 'IdnvI0MJAOVh2m96HVyzprD1mieHYUH2viIoSDaw');

//prod
//ParseClient::initialize('9O3uQHctMnz86F6m3lifIlwKrMGONwlUjO2OL4uf', '46Wag1ZQ2LmwdEOh5Y4tZhX1YvBr0Fm1U9mJ3InL', 'gevC48VkzGHGrWrRJpz8Dt7SRl4BdJ0ycszsQX9k');

?>