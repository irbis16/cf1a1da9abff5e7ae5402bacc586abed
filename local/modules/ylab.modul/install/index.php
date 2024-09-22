<?
//use Ylab\Modul\Orm\AutoTable;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
//Loader::registerNamespace('Ylab\Modul', getenv("DOCUMENT_ROOT") . '/local/modules/ylab.modul/lib/');


//use \Bitrix\Main\Loader; 
//Loader::registerNamespace('Ylab\Modul', dirname(__DIR__) . '/lib');
use Bitrix\Main\Entity\Base;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
use Bitrix\Main\ModuleManager;
//use Bitrix\Main\ORM;
use Bitrix\Main\EventManager;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\ExpressionField;
use Exception;
use Bitrix\Main\DB\SqlExpression;
use Bitrix\Main\ORM\Fields\IntegerField;
use Ylab\Modul;
//use Ylab\Modul\Orm;
Loader::registerNamespace('Ylab\Modul\Orm', getenv("DOCUMENT_ROOT") . '/local/modules/ylab.modul/lib/orm/');
use Ylab\Modul\Orm\AutoTable;
//use AutoTable;
//Loader::registerNamespace('Ylab\Modul', __DIR__ . '/lib');
//Loader::registerNamespace('Ylab\Modul', __DIR__ . '/lib/orm');
//Loc::loadMessage(__FILE__);

//Orm::AutoTable();
//use Ylab\Modul\Orm\AutoTable;
//Loader::registerNamespace('Ylab\Modul', 'local/modules/ylab.modul/lib');
//
//use Ylab\Modul;

class ylab_modul extends CModule
{
    public $MODULE_ID = 'ylab.modul';
    public function __construct()
    {
        $arModuleVersion = [];

        include(__DIR__ . "/version.php");

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        //include(__DIR__ . '/../locale/ru.php');
            $this->MODULE_NAME = Loc::getMessage('YLAB_MODUL_MODULE_NAME');
            $this->MODULE_DESCRIPTION = Loc::getMessage('YLAB_MODUL_DESCRIPTION');
            $this->PARTNER_NAME = Loc::getMessage('YLAB_MODUL_PARTNER_NAME');
            $this->PARTNER_URI = Loc::getMessage('YLAB_MODUL_PARTNER_URI');
            //Loader::registerNamespace('Ylab\Modul', dirname(__DIR__) . '/lib');
            //$this->connection = Application::getConnection();
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
        CopyDirFiles(__DIR__ . '/bitrix/components/', getenv("DOCUMENT_ROOT") . '/bitrix/components/', true, true);
        //CopyDirFiles(getenv("DOCUMENT_ROOT") . '/local/components/', getenv("DOCUMENT_ROOT") . '/bitrix/components/', true, true);
        //CopyDirFiles(__DIR__ . "/bitrix/components", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components", true, true);
    }
    public function InstallDB()
    {
        //Loader::includeModule($this->MODULE_ID);
        //Loader::includeModule($this->MODULE_ID);
        $connection = \Bitrix\Main\Application::getConnection();
        if(!$connection->isTableExists(AutoTable::getTableName()))
        {
            AutoTable::getEntity()->createDbTable();
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
        DeleteDirFilesEx(/*__DIR__.*/'bitrix/components/ylab');
        //DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/components/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components/");
    }
    public function UnInstallDB()
    
    {
        $connection = \Bitrix\Main\Application::getConnection();
        if($connection->isTableExists(AutoTable::getTableName()))
        {
            $connection->dropTable(AutoTable::getTableName());
        }
    }

    public function UnInstallEvents()
    {
        $eventManager = \Bitrix\Main\EventManager::getInstance();
        $eventManager->UnRegisterEventHandler('main', 'OnBeforeProlog', $this->MODULE_ID);
    }
    
}
?>
