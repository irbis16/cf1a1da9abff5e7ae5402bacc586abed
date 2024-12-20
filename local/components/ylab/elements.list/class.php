<?php
/**@global CMain $APPLICATION */
use Bitrix\Main\Loader;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
class ElementsList extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {

        return $arParams;
    }
    public function executeComponent()
    {


        //$oDateTime = date('d.m.Y H:i:s');
        $arrFilterCurDate = [
        'IBLOCK_CODE' => $arParams['IBLOCK_CODE'],
        "IBLOCK_CODE" => "security_section",
        'ACTIVE' => 'Y', 
        //'<DATE_ACTIVE_TO' => $oDateTime,           
        ];

        $arParams = &$this->arParams;
        $arResult = &$this->arResult;
        $arResult = [
            'ITEMS' => [],
        ];
    

Loader::includeModule('iblock');

if ($this->StartResultCache()) {
    $dbItems = $dctElement = CIBlockElement::GetList(
        [],
        $arrFilterCurDate,
        false,
        false,     
        [
            'IBLOCK_ID',
            'ID',
            'NAME',
           'DATE_ACTIVE_TO',
        ]
        );
        $arResult = [];
        while ($arItem = $dbItems->Fetch()) {
            $arResult['ITEMS'][] = $arItem;
        }

        $this->includeComponentTemplate();
        } else {
             $this->abortResultCache();
        }
    }
}