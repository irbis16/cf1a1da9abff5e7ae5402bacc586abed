<?php
//Loader::registerNamespace('Ylab\Modul', dirname(__DIR__) . '/lib');
namespace Ylab\Modul;
//use Bitrix\Main\Loader;
use Ylab\Modul\Orm\LectionTable;

class Lection
{
    public static function helloworld()
    {
        echo "helloworld";
    }
    public static function fillDemoLections()
    {
        $lectionsData = [
            [
                'LECTION_NAME' => 'Установка Битрикс',
                'DATE' => (new \Bitrix\Main\Type\DateTime())->setDate(2024, 9, 1),
            ],
            [
                'LECTION_NAME' => 'Установка Битрикс 2',
                'DATE' => (new \Bitrix\Main\Type\DateTime())->setDate(2024, 9, 2),
            ],
            [
                'LECTION_NAME' => 'Установка Битрикс 3',
                'DATE' => (new \Bitrix\Main\Type\DateTime())->setDate(2024, 9, 3),
            ],
        ];
        foreach ($lectionsData as $number => $lectionData) {
            $lectionObject = LectionTable::getEntity()->createObject();
            $lectionObject['LECTION_NUMBER'] = $number + 1;
            $lectionObject['LECTION_NAME'] = $lectionData['LECTION_NAME'];

            $saveResult = $lectionObject->save();
            if(!$saveResult->isSuccess()) {
                throw new \Exception(implode(', ' . $saveResult->getErrorMessages()));
            }

        }

    }
 
}
/** */