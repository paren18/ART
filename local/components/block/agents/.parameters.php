<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/*
 * Нужно создать параметры, можно посмотреть как это сделано в компоненте news.list
 * 1. Строка для Название таблицы (TABLE_NAME) Highload-блока. Ниже приведено в качестве примера
 * 2. Количество элементов для постраничной пагинации
 * 3. Кеширование (CACHE_TIME)
 */

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(

        "HLBLOCK_TNAME"  =>  array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("MCART_AGENTS_LIST_HLBLOCK_TNAME"), // Название параметра, берется из языкового файла
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
        "PAGE_ELEMENT_COUNT"  =>  array(
            "PARENT" => "BASE",
            "NAME" => "Элементов на странице",
            "TYPE" => "STRING",
            "DEFAULT" => "10",
        ),

        "CACHE_TIME"  =>  array(
            "DEFAULT" => 360000,
        ),
    )
);
?>

