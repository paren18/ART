<?php

class UserGroupHandler
{
    // Метод-обработчик события OnAfterUserRegister
    public static function addUserToGroupOnReg(&$arFields)
    {
        $userActivity = $_REQUEST["drone"];
        $groupId = ($userActivity == "seller") ? 7 : 6;
        $user = new CUser;
        $user->Update($arFields["USER_ID"], array("GROUP_ID" => array($groupId)));
    }
}

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler("main", "OnAfterUserRegister", array("UserGroupHandler", "addUserToGroupOnReg"));
?>
