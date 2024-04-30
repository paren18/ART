<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>




<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
<div class="review-block" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
    <div class="review-text">

        <div class="review-block-title" ><span class="review-block-name"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></b></a></span><span class="review-block-description"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?>, <?echo $arItem['DISPLAY_PROPERTIES']["POSITION"]['VALUE']?>, <?echo $arItem['DISPLAY_PROPERTIES']["COMPANY"]['VALUE']?></span></div>

        <div class="review-text-cont">
            <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                <?echo $arItem["PREVIEW_TEXT"];?>
            <?endif;?>
        </div>
    </div>
    <?php if (!empty($arItem["PREVIEW_PICTURE"]["SRC"])): ?>
        <div class="review-img-wrap">
            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="img">
            </a>
        </div>
    <?php else: ?>
        <div class="review-img-wrap">
            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                <img class="preview_picture" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/rew/no_photo.jpg" alt="img">
            </a>
        </div>
    <?php endif; ?>
</div>


<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
