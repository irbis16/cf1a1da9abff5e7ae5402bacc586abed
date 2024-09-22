<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
/**@global CMain $APPLICATION */
use Bitrix\Main\Loader;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Main\UI\PageNavigation;
//use Bitrix\Main\UI\PageNavigation;
//use Bitrix\Main\UI\PageNavigation;
//use \Bitrix\Main\Type\DateTime as DT;
//use Bitrix\Highloadblock as HL;
use Bitrix\Highloadblock\HighloadBlockTable;


class AnimalGrid extends CBitrixComponent
{
    protected static $componentCounter = 0;

    public function executeComponent()
    {
        $arResult = &$this->arResult;
        self::$componentCounter++;

Loader::requireModule('highloadblock');

$arResult = [
    'COLUMNS' => [
        [
            'id' => 'ID',
            'name' => 'ID',
            'sort' => 'ID',
            'default' => true
        ],
        [
            'id' => 'UF_ANIMALTYPE',
            'name' => 'Вид животного',
            'sort' => 'UF_ANIMALTYPE',
            'default' => true
        ],
        [
            'id' => 'UF_NAME',
            'name' => 'Кличка',
            'sort' => 'UF_NAME',
            'default' => true
        ],
        [
            'id' => 'UF_ASEX',
            'name' => 'Пол',
            'sort' => 'UF_ASEX',
            'default' => true
        ],
        [
            'id' => 'UF_BTHDAY',
            'name' => 'Пол',
            'sort' => 'UF_BTHDAY',
            'default' => true
        ],
        [
            'id' => 'UF_GEN',
            'name' => 'Пол',
            'sort' => 'UF_GEN',
            'default' => true
        ],
    ],
    'LIST_ID' => 'animal_grid_list_' . self::$componentCounter,
    'GRID_ID' => 'animal_grid_' . self::$componentCounter,
    'NAV_ID' => 'animal_grid_nav_' . self::$componentCounter,
    'ROWS' => [],
    'NAV_OBJECT' => null,
    'PAGE_SIZES' => [
        ['NAME' => '10', 'VALUE' => '10'],
        ['NAME' => '20', 'VALUE' => '20'],
        ['NAME' => '50', 'VALUE' => '50'],
    ],
    'ACTION_PANEL' => null,
    'FILTER_PARAMS' => [
        ['id' => 'NAME', 'name' => 'Название', 'type' => 'text', 'default => true'],
        ['id' => 'DATE_CREATE', 'name' => 'Дата создания', 'type' => 'date', 'default => true'],
    ],

];

$navParams = (new GridOptions($arResult['GRID_ID']))->GetNavParams();
$arResult['NAV_OBJECT'] = new PageNavigation($arResult['NAV_ID']);
$arResult['NAV_OBJECT']->allowAllRecords(true)
    ->setPageSize($navParams['nPageSize'])
    ->initFromUri();

$entityClass = HighloadBlockTable::compileEntity('Animal')->getDataClass();
$query = $entityClass::query()
    ->setSelect(['*'])
    ->countTotal(true);

if ($arResult['NAV_OBJECT']) {
    $query->setOffset($arResult['NAV_OBJECT']->getOffset());
    $query->setLimit($arResult['NAV_OBJECT']->getLimit());
}
$result = $query->exec();
$arResult['TOTAL_ROWS_COUNT'] = $result->getCount();
$arResult['NAV_OBJECT']->setRecordCount($arResult['TOTAL_ROWS_COUNT'] );

while ($item = $result->fetch()) {
    $arResult['ROWS'][] = [
        'data' => $item,
        'actions' => [],
        'attrs' => [],
    ];
    }
    
$this->includeComponentTemplate();
    }
}