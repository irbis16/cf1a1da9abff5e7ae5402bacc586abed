<?
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
//use \Bitrix\Main\Loader; 
//Loader::registerNamespace('Ylab\Modul', dirname(__DIR__) . '/lib');
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
//Loader::registerNamespace('Ylab\Modul', 'local/modules/ylab.modul/lib');
//
//use Ylab\Modul;
/*
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
                'default' => 'Y',
                'title' => Loc::getMessage('LECTION_TABLE_FIELD_ACTIVE'),
            ]),

            'SORT' => new ORM\Fields\IntegerField('SORT', [
                'default' => '500',
                'title' => Loc::getMessage('LECTION_TABLE_FIELD_ACTIVE'),
            ]),
        ];
    }
}*/

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
            'title' => Loc::getMessage('LECTION_TABLE_FIELD_SORT'),
            ]),
            'DATE' => new ORM\Fields\DatetimeField('DATE', [
            'default_value' => function() {
                return new Main\Type\DateTime();
            },
            'title' => Loc::getMessage('LECTION_TABLE_FIELD_DATE'),
            ]),
            
            'LECTION_NUMBER' => new ORM\Fields\IntegerField ('LECTION_NUMBER', [
            'title' => Loc::getMessage('LECTION_TABLE_FIELD_LECTION_NUMBER')
            ]), 
            
            'LECTION_NAME' => new ORM\Fields\StringField( 'LECTION_NAME', [
            'title' => Loc::getMessage('LECTION_TABLE_FIELD_LECTION_NAME'),
            ]),

            ];
            /*foreach ($lectionsData as $number => $lectionData) {
                $lectionObject = LectionTable::getEntity()->createObject();
                $lectionObject['LECTION_NUMBER'] = $NUMBER + 1;
                $lectionObject['LECTION_NAME'] = $lectionData['LECTION_NAME'];

                $saveResult = $lectionObject->save();
                if(!$saveResult->isSuccess()) {
                    throw new \Exception(implode(', ' . $saveResult->getErrorMessages()));
                }

            }*/
    }
}
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
        DeleteDirFilesEx(/*__DIR__.*/'bitrix/components/ylab');
        //DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/components/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components/");
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