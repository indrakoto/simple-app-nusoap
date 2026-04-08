<?php
require_once '../../vendor/autoload.php';

//use nusoap_server;

$server = new nusoap_server();

// Konfigurasi WSDL
$server->configureWSDL('kalkulator_service', 'urn:kalkulator');

// Definisikan fungsi yang akan ditawarkan
function kali($a, $b) {
    return $a * $b;
}

// Daftarkan fungsi ke server
$server->register('kali',
    array('a' => 'xsd:int', 'b' => 'xsd:int'), // Parameter input
    array('return' => 'xsd:int'),              // Parameter output
    'urn:kalkulator',                          // Namespace
    'urn:kalkulator#kali',                     // SOAP Action
    'rpc',                                     // Style
    'encoded',                                 // Use
    'Mengalikan dua angka'                     // Dokumentasi
);

// Proses request
$server->service(file_get_contents("php://input"));
exit;