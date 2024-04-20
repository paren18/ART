<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/*
 *  Задать имя компонента и Описание
 *  Разместить его в своем разделе в Визуальном редакторе
 */


if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentDescription = array(
    "NAME" => GetMessage("T_IBLOCK_DESC_AGENTS"),
    "DESCRIPTION" => GetMessage("T_IBLOCK_DESC_AGENTS_DESC"),
    "ICON" => "/images/news_list.gif",
    "SORT" => 20,
//	"SCREENSHOT" => array(
//		"/images/post-77-1108567822.jpg",
//		"/images/post-1169930140.jpg",
//	),
    "CACHE_PATH" => "Y",
    "PATH" => array(
        "ID" => GetMessage("AGENTS_NAME"),
        "CHILD" => array(
            "ID" => "my_block",
            "NAME" => GetMessage("T_IBLOCK_DESC_AGENTS"),
            "SORT" => 10,
            
        ),
    ),

);
