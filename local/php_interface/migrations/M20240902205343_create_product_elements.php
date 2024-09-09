<?php

namespace Sprint\Migration;

class M20240902205343 extends Version
{
    protected $author = "admin";

    protected $description   = "_create_pdoduct_elements";

    protected $moduleVersion = "4.12.6";

    /**
     * @throws Exceptions\MigrationException
     * @throws Exceptions\RestartException
     * @return bool|void
     */
    public function up()
    {
        $this->getExchangeManager()
             ->IblockElementsImport()
             ->setExchangeResource('iblock_elements.xml')
             ->setLimit(20)
             ->execute(function ($item) {
                 $this->getHelperManager()
                      ->Iblock()
                      ->addElement(
                          $item['iblock_id'],
                          $item['fields'],
                          $item['properties']
                      );
             });
    }

    /**
     * @throws Exceptions\MigrationException
     * @throws Exceptions\RestartException
     * @return bool|void
     */
    public function down()
    {
        //Удаляем все элементы по 10 штук за раз

        $helper = $this->getHelperManager();
        $iblockId1 = $helper->Iblock()->getIblockIdIfExists('product');

        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        $dbRes = CIBlockElement::GetList([], ['IBLOCK_ID' => $iblockId1], false, ['nTopCount' => 10]);

        $bFound = 0;

        while ($aItem = $dbRes->Fetch()) {
            $helper->Iblock()->deleteElement($aItem['ID']);
            $this->out('deleted %d', $aItem['ID']);
            $bFound++;
        }

        if ($bFound) {
            $this->restart();
        }

    }

}
