<?php

namespace Sprint\Migration;


class MAgent20240908090230 extends Version
{
    protected $author = "admin";

    protected $description = "";

    protected $moduleVersion = "4.12.6";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Agent()->saveAgent(array (
  'MODULE_ID' => NULL,
  'USER_ID' => NULL,
  'SORT' => '10',
  'NAME' => 'CheckDateTo();',
  'ACTIVE' => 'Y',
  'NEXT_EXEC' => '09.09.2024 08:08:40',
  'AGENT_INTERVAL' => '86400',
  'IS_PERIOD' => 'N',
  'RETRY_COUNT' => '0',
));
    }
}
//