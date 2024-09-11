<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
    if($arParams["ELEM_OLD"]!="N")
    {
        echo 'YESS';
        $oDateTime = date('d.m.Y H:i:s');
        $dbItems = $dctElement = CIBlockElement::GetList(
            [],
            [
                'IBLOCK_CODE' => $arParams['IBLOCK_CODE'],
                "IBLOCK_CODE" => "security_section",
                'ACTIVE' => 'Y', 
                '<DATE_ACTIVE_TO' => $oDateTime,           
                ],
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
} else {
    echo 'NOOO';
    $dbItems = $dctElement = CIBlockElement::GetList(
        [],
        [
            'IBLOCK_CODE' => $arParams['IBLOCK_CODE'],
            "IBLOCK_CODE" => "security_section",
            'ACTIVE' => 'Y', 
                  
            ],
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

}
    $arParams = &$this->arParams;
    $arResult = &$this->arResult;
    $arResult = [
        'ITEMS' => [],
    ];


/*Loader::includeModule('iblock');
*/
// echo '<pre>';
//var_dump($arResult);
 //echo '</pre>';
//CheckDateTo();


    /*$oDateTime = date('d.m.Y H:i:s');
    $arrFilterCurDate = [
        'IBLOCK_CODE' => $arParams['IBLOCK_CODE'],
        'ACTIVE' => 'Y', 
        '<DATE_ACTIVE_TO' => $oDateTime,           
    ];

    Loader::includeModule('iblock');

   if ($this->StartResultCache()) {
        $dbItems = $dctElement = CIBlockElement::GetList(
            [],
            arrFilterCurDate,
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

*/
    ?>
