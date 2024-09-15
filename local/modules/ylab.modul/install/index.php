<?
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Entity\Base;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\ORM;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\ExpressionField;
use Exception;
use Bitrix\Main\DB\SqlExpression;
use Bitrix\Main\ORM\Fields\IntegerField;
Loc::loadMessages(__FILE__);

class LectionTable extends DataManager
{
    public static function getTableName()
    {
        return "ylab_lections";
    }
    public static function getMap()
    {
        return[
            new IntegerField("ID", [
                "primary" => true,
                "autocomplete" => true,
            ]),
            'ACTIVE' => new ORM\Fields\BooleanField('ACTIVE', [
                'values' => ['N', 'Y'],
                'default_value' => 'Y',
                'title' => Loc::getMessage('LECTION_TABLE_FIELD_ACTIVE'),
            ]),
            'SORT' => new ORM\Fields\IntegerField('SORT', [
                'default_value' => '500',
                'title' => Loc::getMessage('LECTION_TABLE_FIELD_ACTIVE'),
            ]),
        ];
    }
}*

class ylab_modul extends CModule
{
    public $MODULE_ID = 'ylab.modul';
    public function __construct()
    {
        $arModuleVersion = [];

        include(__DIR__ . "/version.php");

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        include(__DIR__ . '/../locale/ru.php');
            $this->MODULE_NAME = Loc::getMessage('YLAB_MODUL_MODULE_NAME');
            $this->MODULE_DESCRIPTION = Loc::getMessage('YLAB_MODUL_DESCRIPTION');
            $this->PARTNER_NAME = Loc::getMessage('YLAB_MODUL_PARTNER_NAME');
            $this->PARTNER_URI = Loc::getMessage('YLAB_MODUL_PARTNER_URI');

    }

    public function DoInstall()
    {
        $this->InstallFiles();
        $this->InstallDB();
        $this->InstallEvents();
        RegisterModule($this->MODULE_ID);
    }
    public function InstallFiles()
    {
        CopyDirFiles(getenv("DOCUMENT_ROOT") . '/local/components/', getenv("DOCUMENT_ROOT") . '/bitrix/components/', true, true);
        //CopyDirFiles(__DIR__ . "/bitrix/components", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components", true, true);
    }
    public function InstallDB()
    {
        $connection = \Bitrix\Main\Application::getConnection();
        if(!$connection->isTableExists(LectionTable::getTableName()))
        {
            LectionTable::getEntity()->createDbTable();
        }
    }
    public function InstallEvents()
    {
        $eventManager = \Bitrix\Main\EventManager::getInstance();
        $eventManager->registerEventHandlerCompatible('main', 'OnBeforeProlog', $this->MODULE_ID);
    }
    public function DoUninstall()
    {
        $this->UnInstallFiles();
        $this->UnInstallDB();
        $this->UnInstallEvents();

        UnRegisterModule($this->MODULE_ID);
    }

    public function UnInstallFiles()
    {
        DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/components/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components/");
    }
    public function UnInstallDB()
    
    {
        $connection = \Bitrix\Main\Application::getConnection();
        if($connection->isTableExists(LectionTable::getTableName()))
        {
            $connection->dropTable(LectionTable::getTableName());
        }
    }

    public function UnInstallEvents()
    {
        $eventManager = \Bitrix\Main\EventManager::getInstance();
        $eventManager->UnRegisterEventHandler('main', 'OnBeforeProlog', $this->MODULE_ID);
    }
    
}
?>