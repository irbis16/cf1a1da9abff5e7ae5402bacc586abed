<?php
/**@global Cmain $APPLICATION */
use Bitrix\Iblock\ElementTable;
use Bitrix\Main\Loader;
use Ylab\Modul\Lection;

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Демо модуля');

Loader::requireModule('ylab.modul');
//Lection::helloWorld();
Lection::fillDemoLections();
/*
$items = ElementTable::query()
    ->setFilter([
        'IBLOCK_ID' => '5',
        'ACTIVE' => 'Y'
    ])
    //->where('IBLOCK_ID', '=', 5)
    ->setSelect([
        'ID',
        'NAME',
        'CODE',
    ])
    //->fetchAll();
    ->fetchCollection();
    //$code = $items->getCodeList();
    $code = $items->getIdList();

?>$items ($code):<br/><?php
?><pre><?var_dump($code)?></pre><?
/* */

?>111111<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
