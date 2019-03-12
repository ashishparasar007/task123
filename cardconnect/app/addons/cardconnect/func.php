<?php
use Tygh\Registry;

require_once "app/addons/cardconnect/cardconnectApi/CardConnectRestClient.php";

if(!defined("BOOTSTRAP")) { die("Acccess Denied");}

function fn_cardconnect_install() 
{
    $data=array(
        'processor' => 'Cardconnect Payment Gateway',
        'processor_script' => 'cardconnect.php',
        'processor_template' => 'addons/cardconnect/views/orders/components/payments/cc_cardconnect.tpl',
        'admin_template' => 'cardconnect.tpl',
        'callback'=> 'N',
        'type' => 'P',
        'addon' => 'cardconnect'
    );
    db_query('INSERT INTO ?:payment_processors ?e', $data);
}

function fn_cardconnect_uninstall() 
{
    $condition=array(
        'processor' => 'Cardconnect Payment Gateway',
        'processor_script' => 'cardconnect.php',
        'processor_template' => 'addons/cardconnect/views/orders/components/payments/cc_cardconnect.tpl',
        'admin_template' => 'cardconnect.tpl',
        'callback'=> 'N',
        'type' => 'P',
        'addon' => 'cardconnect'
    );
    $processor_id = db_get_field("SELECT processor_id from ?:payment_processors WHERE processor_script= 'cardconnect.php' ");
    db_query("DELETE FROM ?:payments WHERE processor_id = ?i", $processor_id);
    db_query("DELETE FROM ?:payment_processors WHERE ?w", $condition);//doubt
}