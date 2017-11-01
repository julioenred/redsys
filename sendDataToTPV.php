<?php
    include './redsys/apiRedsys.php';
    include 'config.php';
    define('REQUEST_DEV', 'https://sis-t.redsys.es:25443/sis/realizarPago');
    $redsys = new RedsysAPI;
        
    // Valores de entrada
    $moneda="978";
    $trans="0";
    $url="";
    $urlOKKO="";
    $id=time();
    $amount="145";
    
    // Se Rellenan los campos
    $redsys->setParameter("DS_MERCHANT_AMOUNT",$amount);
    $redsys->setParameter("DS_MERCHANT_ORDER",strval($id));
    $redsys->setParameter("DS_MERCHANT_MERCHANTCODE", MERCHANT_DEV);
    $redsys->setParameter("DS_MERCHANT_CURRENCY",$moneda);
    $redsys->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
    $redsys->setParameter("DS_MERCHANT_TERMINAL", TERMINAL_DEV);
    $redsys->setParameter("DS_MERCHANT_MERCHANTURL",$url);
    $redsys->setParameter("DS_MERCHANT_URLOK", URL_RESPONSE);     
    $redsys->setParameter("DS_MERCHANT_URLKO", URL_ERROR);
    $redsys->setParameter("DS_MERCHANT_PAN", $_POST['card']);
    $redsys->setParameter("DS_MERCHANT_EXPIRYDATE", FECHA_DEV);
    $redsys->setParameter("DS_MERCHANT_CVV2", CVV2_DEV);
    

    //Datos de configuración
    $version="HMAC_SHA256_V1";
    $key = KEY_DEV;//Clave recuperada de CANALES
    // Se generan los parámetros de la petición
    $request = "";
    $params = $redsys->createMerchantParameters();
    $signature = $redsys->createMerchantSignature($key);
?>
<html lang="es">
<head>
</head>
<body>
    <form name="frm" action="<?php echo REQUEST_DEV ?>" method="POST">
        Ds_Merchant_SignatureVersion <input type="text" name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
        Ds_Merchant_MerchantParameters <input type="text" name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
        Ds_Merchant_Signature <input type="text" name="Ds_Signature" value="<?php echo $signature; ?>"/></br>
    </form>
    <script>document.forms[0].submit();</script>
</body>
</html>

