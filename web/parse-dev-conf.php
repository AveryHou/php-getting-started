<?php
require('../vendor/autoload.php');
 
use Parse\ParseClient;

//Application ID, REST, MASTER

// dev
//ParseClient::initialize('oVYLOizsuLXxCRucXmrgWF6q0OjlXc9d1fXfBDmU', 'iiBwHRMDSpWdP8NEODUx0WkBXWay5q8YvEPFCxIA', 'IdnvI0MJAOVh2m96HVyzprD1mieHYUH2viIoSDaw');
ParseClient::initialize('oVYLOizsuLXxCRucXmrgWF6q0OjlXc9d1fXfBDmU', '', 'IdnvI0MJAOVh2m96HVyzprD1mieHYUH2viIoSDaw');
ParseClient::setServerURL('http://hungrybeedev.herokuapp.com/parse');

?>