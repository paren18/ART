<?php
// обратите внимание на эту константу
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация и регистрация");
?><p>
	 Вы зарегистрированы и успешно авторизовались.
</p>
 <?php
// ссылка для выхода из личного кабинета
$logout = $APPLICATION->GetCurPageParam(
    array(
        "login",
        "logout",
        "register",
        "forgot_password",
        "change_password"
    )
);
?>
<p>
    <a href="/?logout=yes&<?=bitrix_sessid_get()?>">
        Выйти
    </a>
</p><?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>