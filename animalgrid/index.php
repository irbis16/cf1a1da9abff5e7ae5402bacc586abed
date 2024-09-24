<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Грид");

use Bitrix\Main\Loader; 
// пространства имен highloadblock
use Bitrix\Highloadblock\HighloadBlockTable;
// подключаем модуль highloadblock
\Bitrix\Main\Loader::includeModule("highloadblock");
use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity;
?>

<?
$APPLICATION->IncludeComponent(
	'ylab:animalgrid',
	'',
	Array(
	)
);?> 
<div>
	 <?php
// Подключаем грид
/*


$APPLICATION->IncludeComponent(
    'bitrix:main.ui.grid',
    '',
    [
        'GRID_ID' => $arResult['GRID_ID'],
        'COLUMNS' => $arResult['COLUMNS'],
        'ROWS' => ,
        'AJAX_MODE' => 'Y',
        'AJAX_OPTION_JUMP' => 'N',
        'AJAX_OPTION_HISTORY' => 'N',
        'PAGE_SIZES' => $arResult['PAGE_SIZES'],
        'NAV_OBJECT' => $arResult['NAV_OBJECT'],
        'SHOW_CHECK_ALL_CHECKBOXES' => true,
        'SHOW_ROW_ACTIONS_MENU' => true,
        'SHOW_GRID_SETTINGS_MENU' => true,
        'SHOW_NAVIGATION_PANEL' => true,
        'SHOW_PAGINATION' => true,
        'SHOW_SELECTED_COUNTER' => true,
        'SHOW_TOTAL_COUNTER' => true,
        'SHOW_ACTION_PANEL' => true,
    ]
);*/
?>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>