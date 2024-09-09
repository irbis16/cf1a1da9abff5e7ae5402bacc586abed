<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div style="">
<? if($arParams["DISPLAY_TOP_PAGER"]) {
	echo $arResult["NAV_STRING"];
}
?>
<? foreach($arResult["ITEMS"] as $arItem) {
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	<h3><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></h3>
	</div>
	<?
$res = CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID']);
$ar_res = $res->GetNext();
?>

<h5><a href="<? echo $ar_res['SECTION_PAGE_URL']; ?>"><? echo 'Раздел:' . $ar_res['NAME']; ?></a></h5>
<div>
	<span><?=$arItem["PROPERTIES"]["UF_VES"]["NAME"] . ': '?><?=$arItem["PROPERTIES"]["UF_VES"]["VALUE"]?></span>
	<span><?=$arItem["PROPERTIES"]["UF_MERA"]["VALUE"]?></span>
</div>
	<?
}
?>
</div>
<? 
//var_dump($arItem);
if($arParams["DISPLAY_BOTTOM_PAGER"]) {
	echo $arResult["NAV_STRING"];
}
//
	?>

