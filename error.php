<?php 

include './redsys/apiRedsys.php';
include 'config.php';

$redsys = new RedsysAPI;

if (!empty( $_GET ) ) 
{             
    $version = $_GET["Ds_SignatureVersion"];
    $datos = $_GET["Ds_MerchantParameters"];
    $signatureRecibida = $_GET["Ds_Signature"];
    
    $decodec = $redsys->decodeMerchantParameters($datos);    
    $kc = KEY_DEV;
    $firma = $redsys->createMerchantSignatureNotif($kc, $datos);  

    if ($firma === $signatureRecibida)
    {
        echo '<pre>';
        var_dump($decodec);
        echo '</pre>';
    } 
    else 
    {
        echo '<pre>';
        var_dump($decodec);
        echo '</pre>';
    }
}