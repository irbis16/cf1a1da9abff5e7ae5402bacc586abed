<?
namespace Ylab\Modul\Orm;

Loc::loadMessage(__FILE__);
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
            foreach ($lectionsData as $number => $lectionData) {
                $lectionObject = LectionTable::getEntity()->createObject();
                $lectionObject['LECTION_NUMBER'] = $NUMBER + 1;
                $lectionObject['LECTION_NAME'] = $lectionData['LECTION_NAME'];

                $saveResult = $lectionObject->save();
                if(!$saveResult->isSuccess()) {
                    throw new \Exception(implode(', ' . $saveResult->getErrorMessages()));
                }

            }
    }
}