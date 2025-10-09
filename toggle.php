<?php

include 'utils.php';

/*
 * Config-Datei einlesen. Ohne die geht gar nichts.
 */

try{
    $config = json_decode(file_get_contents('config.json'), true);
} catch (Exception $e) {
    echo "Fehler: Konnte Config-Datei nicht lesen.";
    exit;
}

/*
 * Config-Datei überprüfen
 */

// check if mieternummer is set in config and is not empty
if (!isset($config['mieternummer']) || empty($config['mieternummer'])) {
    echo "Fehler: Mieternummer in Config nicht gesetzt.";
    exit;
}
$mieternummer = $config['mieternummer'];
// check if mieterpasswort is set in config and is not empty
if (!isset($config['mieterpasswort']) || empty($config['mieterpasswort'])) {
    echo "Fehler: Mieterpasswort in Config nicht gesetzt.";
    exit;
}
$mieterpasswort = $config['mieterpasswort'];
// check if studnethost is set in config and is an ip address
if (!isset($config['studnethost']) || !filter_var($config['studnethost'], FILTER_VALIDATE_IP)) {
    echo "Fehler: Studnethost in Config nicht gesetzt oder keine valide IP-Adresse.";
    exit;
}
$studnethost = $config['studnethost'];
// check if adminpasswort is set in config and is not empty
if (!isset($config['adminpasswort']) || empty($config['adminpasswort'])) {
    echo "Fehler: Adminpasswort in Config nicht gesetzt.";
    exit;
}
$adminpasswort = $config['adminpasswort'];

/*
 * Adminpasswort überprüfen
 */

if (!isset($_POST['password']) || $_POST['password'] !== $adminpasswort) {
    header('Location: index.php?error=1');
    exit;
}

/*
 * Gewünschte Aktion ausführen
 */

$isScreenRunning = isScreenRunning();
if(isset($_POST['action']) && $_POST['action'] == 'turnon' && !$isScreenRunning)
    shell_exec("screen -S internet -dm sshpass -p $mieterpasswort ssh $mieternummer@$studnethost -oStrictHostKeyChecking=no");
elseif(isset($_POST['action']) && $_POST['action'] == 'turnoff' && $isScreenRunning)
    shell_exec("screen -X -S internet quit");

/*
 * Action extrahieren und ausführen
 */

header('Location: index.php');