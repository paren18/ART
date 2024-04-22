<?php

$eventManager = Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandler('', 'RealEstateAgentsOnAfterAdd', 'ClearCachel');
$eventManager->addEventHandler('', 'RealEstateAgentsOnAfterUpdate', 'ClearCachel');
$eventManager->addEventHandler('', 'RealEstateAgentsOnAfterDelete', 'ClearCachel');

function ClearCachel(\Bitrix\Main\Entity\Event $event)
{

    $tableName = $event->getParameter("name");


    $taggedCache = \Bitrix\Main\Application::getInstance()->getTaggedCache();
    $taggedCache->clearByTag('hlblock_table_name_real_estate_agents' . $tableName);
}
