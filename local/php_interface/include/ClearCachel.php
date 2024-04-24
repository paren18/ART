<?php
use Bitrix\Main\Entity\DataManager;
$eventManager = Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandler('', 'RealEstateAgentsOnAfterAdd', 'ClearCachel');
$eventManager->addEventHandler('', 'RealEstateAgentsOnAfterUpdate', 'ClearCachel');
$eventManager->addEventHandler('', 'RealEstateAgentsOnAfterDelete', 'ClearCachel');

function ClearCachel(\Bitrix\Main\Entity\Event $event)
{
    $entityClass = $event->getEntity()->getDataClass();
    $tableName = $entityClass::getTableName();
    $taggedCache = \Bitrix\Main\Application::getInstance()->getTaggedCache();
    $taggedCache->clearByTag('hlblock_table_name_' . $tableName);
}
