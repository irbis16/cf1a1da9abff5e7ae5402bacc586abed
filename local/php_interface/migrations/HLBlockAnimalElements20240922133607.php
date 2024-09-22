<?php

namespace Sprint\Migration;


class HLBlockAnimalElements20240922133607 extends Version
{
    protected $author = "admin";

    protected $description   = "";

    protected $moduleVersion = "4.12.6";

    /**
     * @throws Exceptions\MigrationException
     * @throws Exceptions\RestartException
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $this->getExchangeManager()
             ->HlblockElementsImport()
             ->setExchangeResource('hlblock_elements.xml')
             ->setLimit(20)
             ->execute(function ($item) {
                 $this->getHelperManager()
                      ->Hlblock()
                      ->addElement(
                          $item['hlblock_id'],
                          $item['fields']
                      );
             });
    }

    /**
     * @throws Exceptions\MigrationException
     * @throws Exceptions\RestartException
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function down()
    {
        $helper = $this->getHelperManager();
        $hlBlockHelper = $helper->Hlblock();
        $elements = $hlBlockHelper->getElement(self:$hlBlockHelper);
        foreach ($elements as $element) {
            $hlBlockHelper->deleteElement(left::$hlBlockHelper, $element['ID']);
        }
    }


}
