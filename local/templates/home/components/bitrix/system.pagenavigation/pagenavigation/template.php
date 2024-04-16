<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

$colorSchemes = array(
	"green" => "bx-green",
	"yellow" => "bx-yellow",
	"red" => "bx-red",
	"blue" => "bx-blue",
);
$colorScheme = $colorSchemes[$arParams["TEMPLATE_THEME"] ?? ''] ?? '';
?>
<?php
$NavPageCount = $arResult["NavPageCount"];
$NavPageNomer = $arResult["NavPageNomer"];
$NavNum = $arResult["NavNum"];
$sUrlPath = $arResult["sUrlPath"];
$strNavQueryString = $arResult["NavQueryString"];
?>

<div class="site-pagination">
    <?php for ($i = 1; $i <= $NavPageCount; $i++): ?>
        <?php if ($i == $NavPageNomer): ?>
            <a href="#" class="active"><?= $i ?></a>
        <?php else: ?>
            <a href="<?= $sUrlPath ?>?<?= $strNavQueryString ?>PAGEN_<?= $NavNum ?>=<?= $i ?>"><?= $i ?></a>
        <?php endif ?>
    <?php endfor ?>
    <?php if ($NavPageCount > 5): ?>
        <span>...</span>
        <a href="<?= $sUrlPath ?>?<?= $strNavQueryString ?>PAGEN_<?= $NavNum ?>=<?= $NavPageCount ?>"><?= $NavPageCount ?></a>
    <?php endif ?>
</div>
