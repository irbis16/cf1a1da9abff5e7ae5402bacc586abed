<?php

namespace Sprint\Migration;


class MAgent220240910211924 extends Version
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
  'MODULE_ID' => 'main',
  'USER_ID' => NULL,
  'SORT' => '10',
  'NAME' => 'CheckDateTo();',
  'ACTIVE' => 'Y',
  'NEXT_EXEC' => '10.09.2024 17:56:48',
  'AGENT_INTERVAL' => '86400',
  'IS_PERIOD' => 'N',
  'RETRY_COUNT' => '0',
));
    }
}
public function down()
{
    $helper->Agent()->deleteAgentIfExists('main','cleaningExpiredItems();');
}