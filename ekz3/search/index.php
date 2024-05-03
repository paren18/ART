<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
?><?$APPLICATION->IncludeComponent(
	"bitrix:search.page",
	"clear",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"DEFAULT_SORT" => "rank",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FILTER_NAME" => "",
		"NO_WORD_LOGIC" => "N",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Результаты поиска",
		"PAGE_RESULT_COUNT" => "50",
		"PATH_TO_USER_PROFILE" => "",
		"RATING_TYPE" => "",
		"RESTART" => "N",
		"SHOW_ITEM_DATE_CHANGE" => "N",
		"SHOW_ITEM_TAGS" => "N",
		"SHOW_ORDER_BY" => "N",
		"SHOW_RATING" => "",
		"SHOW_TAGS_CLOUD" => "N",
		"SHOW_WHEN" => "N",
		"SHOW_WHERE" => "N",
		"TAGS_INHERIT" => "Y",
		"USE_LANGUAGE_GUESS" => "Y",
		"USE_SUGGEST" => "N",
		"USE_TITLE_RANK" => "N",
		"arrFILTER" => array("iblock_rew"),
		"arrFILTER_iblock_rew" => array("14"),
		"arrWHERE" => array()
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>