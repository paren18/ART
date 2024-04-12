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
<div class="slide-one-item home-slider owl-carousel">
    <?php foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
    <div  class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="site-blocks-cover" style="background-image: url(<?php echo $arItem["PREVIEW_PICTURE"]["SRC"]; ?>);" data-aos="fade"
             data-stellar-background-ratio="0.5">
            <div class="text">
                <h2><?php echo $arItem["NAME"]; ?></h2>
                <?php if ($arItem["DISPLAY_ACTIVE_FROM"]): ?>
                    <p class="location"><span class="property-icon icon-room"></span><?php echo $arItem["DISPLAY_ACTIVE_FROM"]; ?></p>
                <?php endif; ?>
                <?php if ($arItem["PREVIEW_TEXT"]): ?>
                    <p class="mb-2"><strong><?php echo $arItem["PREVIEW_TEXT"]; ?></strong></p>
                <?php endif; ?>
                <p class="mb-0"><a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>" class="text-uppercase small letter-spacing-1 font-weight-bold">More Details</a></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>
