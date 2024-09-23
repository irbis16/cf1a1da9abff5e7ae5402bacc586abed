<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Грид");
?>
<?
$APPLICATION->IncludeComponent(
	"ylab:animalgrid", 
	".default", 
	[],
	false,
    false
);?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>