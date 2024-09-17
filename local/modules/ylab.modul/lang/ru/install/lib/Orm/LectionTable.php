<?
$MESS['LECTION_TABLE_FIELD_SORT'] = 'Сортировка';
$MESS['LECTION_TABLE_FIELD_ACTIVE'] = 'Активность';
$MESS['LECTION_TABLE_FIELD_LECTION_NUMBER'] = 'Номер';
$MESS['LECTION_TABLE_FIELD_LECTION_NAME'] = 'Название';
$MESS['LECTION_TABLE_FIELD_DATE'] = 'День';


'ACTIVE' => new ORM\Fields\BooleanField('ACTIVE', [
    'values' => ['N', 'Y'],
    'default_value' => 'Y',
    'title' => Loc::getMessage('AUTO_TABLE_FIELD_ACTIVE'),
    ]),
    'SORT' => new ORM\Fields\IntegerField('SORT', [
    'default_value' => '500',
    'title' => Loc::getMessage('AUTO_TABLE_FIELD_SORT'),
    ]),
    'COMMERCE' => new ORM\Fields\BooleanField('COMMERCE', [
        'values' => ['N', 'Y'],
        'default_value' => 'Y',
        'title' => Loc::getMessage('AUTO_TABLE_FIELD_COMMERCEE'),
        ]),
    'GRUZP' => new ORM\Fields\IntegerField('GRUZP', [
        'default_value' => '500',
        'title' => Loc::getMessage('AUTO_TABLE_FIELD_GRUZP'),
        ]),
    'DATE' => new ORM\Fields\DatetimeField('DATE', [
    'default_value' => function() {
        return new Main\Type\DateTime();
    },
    'title' => Loc::getMessage('AUTO_TABLE_FIELD_DATE'),
    ]),
    
    'LECTION_NUMBER' => new ORM\Fields\IntegerField ('LECTION_NUMBER', [
    'title' => Loc::getMessage('AUTO_TABLE_FIELD_LECTION_NUMBER')
    ]), 
    
    'MARKA_AUTO' => new ORM\Fields\StringField( 'MARKA_AUTO', [
    'title' => Loc::getMessage('AUTO_TABLE_FIELD_MARKA_AUTO'),
    ]),
    'MODEL_AUTO' => new ORM\Fields\StringField( 'MODEL_AUTO', [
        'title' => Loc::getMessage('AUTO_TABLE_FIELD_MODEL_AUTO'),
        ]),
