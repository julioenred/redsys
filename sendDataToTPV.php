<?php
    include 'apiRedsys.php';
    $redsys = new RedsysAPI;
        
    // Valores de entrada
    $fuc="999008881";
    $terminal="871";
    $moneda="978";
    $trans="0";
    $url="";
    $urlOKKO="";
    $id=time();
    $amount="145";
    
    // Se Rellenan los campos
    $redsys->setParameter("DS_MERCHANT_AMOUNT",$amount);
    $redsys->setParameter("DS_MERCHANT_ORDER",strval($id));
    $redsys->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);
    $redsys->setParameter("DS_MERCHANT_CURRENCY",$moneda);
    $redsys->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
    $redsys->setParameter("DS_MERCHANT_TERMINAL",$terminal);
    $redsys->setParameter("DS_MERCHANT_MERCHANTURL",$url);
    $redsys->setParameter("DS_MERCHANT_URLOK",$urlOKKO);     
    $redsys->setParameter("DS_MERCHANT_URLKO",$urlOKKO);

    //Datos de configuración
    $version="HMAC_SHA256_V1";
    $kc = 'Mk9m98IfEblmPfrpsawt7BmxObt98Jev';//Clave recuperada de CANALES
    // Se generan los parámetros de la petición
    $request = "";
    $params = $redsys->createMerchantParameters();
    $signature = $redsys->createMerchantSignature($kc);

 
?>
<html lang="es">
<head>
</head>
<body>
    <form name="frm" action="http://sis-d.redsys.es/sis/realizarPago" method="POST" target="_blank">
        Ds_Merchant_SignatureVersion <input type="text" name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
        Ds_Merchant_MerchantParameters <input type="text" name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
        Ds_Merchant_Signature <input type="text" name="Ds_Signature" value="<?php echo $signature; ?>"/></br>
        <input type="submit" value="Enviar" >
    </form>

</body>
</html>
