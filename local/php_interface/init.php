<?php
//Loader::registerNamespace('Ylab\Modul', dirname(__DIR__) . '/lib');
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("MyClass40", "OnBeforeIBlockElementAddHandler"));
class MyClass40{
static function OnBeforeIBlockElementAddHandler(&$arFields)
	{
    $trans = \Bitrix\Main\Security\Random::getString(20,false);
    //$trans = 'mufw5fwamxha2pgveiqy';
    $iblock = new CIBlockElement();
    $codeExist = $iblock ->isExistsMnemonicCode($trans, null, 6);
        if ($codeExist) {
        $arFields["CODE"] = $trans . '-'. rand(1, 999);
        } else {
            $arFields["CODE"] = $trans ;  
        }
}
}
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("MyClass50", "OnBeforeIBlockElementUpdateHandler"));
class MyClass50{
static function OnBeforeIBlockElementUpdateHandler(&$arFields)
	{
    $trans = \Bitrix\Main\Security\Random::getString(20,false);
    //$trans = 'mufw5fwamxha2pgveiqy';
    $iblock = new CIBlockElement();
    $codeExist = $iblock ->isExistsMnemonicCode($trans, null, 6);
        if ($codeExist) {
        $arFields["CODE"] = $trans . '-'. rand(1, 999);
        } else {
            $arFields["CODE"] = $trans ;  
        }
}
}
function CheckDateTo() {
    $objDateTime = new DateTime();
	$date = date('Y-m-d H:i:s');
	$timestamp = MakeTimeStamp($date, 'YYYY-MM-DD H:i:s');
	//$convertDateTime = ConvertTimeStamp($timestamp);
    $convertDateTime = ConvertTimeStamp(false, 'FULL');
    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_TO");
	//ниже не рабочий вариант с ACTIVE_DATE"=>"Y.
	//$arFilter = Array("IBLOCK_ID"=>6, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "<DATE_ACTIVE_TO" => $objDateTime->format('d.m.Y H:i:s'));
	$arFilter = Array("IBLOCK_ID"=>6, "ACTIVE"=>"Y", "<DATE_ACTIVE_TO" => $objDateTime->format('d.m.Y H:i:s'));
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    $i;
    while($ob = $res->GetNextElement())
    {
    $i++;
    $el = new CIBlockElement;
    $ElementArray = Array("ACTIVE" => "N",);
    $arFields = $ob->GetFields();
    $el->Update($arFields['ID'], $ElementArray);
    }
    echo "отключено элементов: " .$i . " / ".$objDateTime->format('d.m.Y H:i:s');
    //return __METHOD__ . '();';
}
//CheckDateTo();
?>