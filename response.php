<?php 

include './redsys/apiRedsys.php';
include 'config.php';

$redsys = new RedsysAPI;

if (!empty( $_POST ) ) 
{             
    $version = $_POST["Ds_SignatureVersion"];
    $datos = $_POST["Ds_MerchantParameters"];
    $signatureRecibida = $_POST["Ds_Signature"];
    
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
        echo "FIRMA KO";
    }
}