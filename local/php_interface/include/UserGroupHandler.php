<?php

class UserGroupHandler
{
    // Метод-обработчик события OnAfterUserRegister
    public static function addUserToGroupOnReg(&$arFields)
    {
        $userActivity = $_REQUEST["UF_ACTIVITY"];

        $groupId = false;

        if ($userActivity == "8") {
            $groupId = 7;
        } elseif ($userActivity == "7") {
            $groupId = 6;
        }

        if ($groupId) {
            $user = new CUser;
            $user->Update($arFields["USER_ID"], array("GROUP_ID" => array($groupId)));
            $user->Update($arFields["USER_ID"], array("UF_ACTIVITY" => $userActivity));
        }
    }
}

// Регистрируем обработчик события
$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler("main", "OnAfterUserRegister", array("UserGroupHandler", "addUserToGroupOnReg"));

?>
