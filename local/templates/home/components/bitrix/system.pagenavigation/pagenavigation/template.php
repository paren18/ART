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

<div class="row">
    <div class="col-md-12 text-center">
        <div class="site-pagination pagination">
            <?php for ($i = 1; $i <= $arResult["NavPageCount"]; $i++): ?>
                <?php if ($i == $arResult["NavPageNomer"]): ?>
                    <a href="#" class="active"><?= $i ?></a>
                <?php else: ?>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $i ?>"><?= $i ?></a>
                <?php endif ?>
            <?php endfor ?>
        </div>
    </div>
</div>

<style>
    .site-pagination.pagination {
        display: inline-block;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    
</style>
