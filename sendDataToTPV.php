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

    // abrimos la sesión cURL
    $ch = curl_init();
     
    // definimos la URL a la que hacemos la petición
    curl_setopt($ch, CURLOPT_URL, REQUEST_DEV);
    // indicamos el tipo de petición: POST
    curl_setopt($ch, CURLOPT_POST, TRUE);
    // definimos cada uno de los parámetros
    curl_setopt($ch, CURLOPT_POSTFIELDS, "Ds_SignatureVersion=" . $version . "&Ds_MerchantParameters=" . $params . "&Ds_Signature=" . $signature);
     
    // recibimos la respuesta y la guardamos en una variable
    curl_exec ($ch);
     
    // cerramos la sesión cURL
    curl_close ($ch);
?>

