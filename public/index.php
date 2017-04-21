<?php

/*
 * Die index.php Datei ist der Einstiegspunkt des MVC. Hier werden zuerst alle
 * vom Framework benötigten Klassen geladen und danach wird die Anfrage dem
 * Dispatcher weitergegeben.
 *
 * Wie in der .htaccess Datei beschrieben, werden alle Anfragen, welche nicht
 * auf eine bestehende Datei zeigen hierhin umgeleitet.
 */

Session_Start();

require_once '../lib/Dispatcher.php';
require_once '../lib/View.php';
require_once '../lib/Security.php';
require_once '../lib/Error.php';
require_once '../lib/Success.php';

$dispatcher = new Dispatcher();
$dispatcher->dispatch();
