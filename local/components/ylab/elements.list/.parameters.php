<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $APPLICATION;
/** @var array $arCurrentValues */
$arComponentParameters = array (
    "GROUPS" => array (
        "DATA_SOURCE" => array(
            "NAME" => 'Источник',
            "SORT" => 200
        ),
        "CACHE" => array(
            "NAME" => 'Настройки кеширования',
            "SORT" => 900            
        )
    )
    );
	$arComponentParameters["PARAMETERS"] = array(
		"IBLOCK_CODE" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => "Код ИБ",
			"TYPE" => "STRING",
			"DEFAULT" => "",
			"REFRESH" => "N",
		),
		"CACHE_TIME" => Array(
            "DEFAULT" => 3600,      
        ),
	);


/*
	$arComponentParameters = array (
		"GROUPS" => array (
			"DATA_SEC" => array(
				"NAME" => 'Статус доступа',
				"SORT" => 300
			),
			"CACHE" => array(
				"NAME" => 'Настройки кеширования',
				"SORT" => 900            
			)
		)
		);
		$arComponentParameters["PARAMETERS"] = array(
			"IBLOCK_CODE" => array(
				"PARENT" => "DATA_SEC",
				"NAME" => "Только просроченные",
				"TYPE" => "CHECKBOX",
				"DEFAULT" => "N",
				"REFRESH" => "N",
			),
			"CACHE_TIME" => Array(
				"DEFAULT" => 3600,      
			),
		);

*/