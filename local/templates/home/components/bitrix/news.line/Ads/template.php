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
use \Bitrix\Main\Localization\Loc;
$this->setFrameMode(true);
?>

<div class="site-section site-section-sm bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <div class="site-section-title">
                    <h2><?=Loc::getMessage("PROIT");?></h2>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
            <div class="col-md-6 col-lg-4 mb-4">
            <div  class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="prop-entry d-block">
                        <figure>
                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" class="img-fluid">
                        </figure>
                        <div class="prop-text">
                            <div class="inner">
                                <span class="price rounded">₽<?=$arItem["PROPERTY_PRICE_VALUE"]?></span>
                                <h3 class="title"><?=$arItem["NAME"]?></h3>
                                <p class="location"><?=$arItem["PREVIEW_TEXT"]?></p>
                            </div>
                            <div class="prop-more-info">
                                <div class="inner d-flex">
                                    <div class="col">
                                        <span><?=Loc::getMessage("TOTALAREA");?></span>
                                        <strong><?=$arItem["PROPERTY_TOTALAREA_VALUE"]?></strong>
                                    </div>
                                    <div class="col">
                                        <span><?=Loc::getMessage("NUMFLOORS");?></span>
                                        <strong><?=$arItem["PROPERTY_NUMFLOORS_VALUE"]?></strong>
                                    </div>
                                    <div class="col">
                                        <span><?=Loc::getMessage("NUMOFBATH");?></span>
                                        <strong><?=$arItem["PROPERTY_NUMOFBATH_VALUE"]?></strong>
                                    </div>
                                    <div class="col">
                                        <span><?=Loc::getMessage("AVAOFGARAGE");?></span>
                                        <strong><?=$arItem["PROPERTY_AVAOFGARAGE_VALUE"]?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?endforeach;?>
                </div>
        </div>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="site-pagination">
                        <?=$arResult["NAV_STRING"]?>
                    </div>
                </div>
            </div>
        <?endif;?>
    </div>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="site-pagination">
                    <?=$arResult["NAV_STRING"]?>
                </div>
            </div>
        </div>
    <?endif;?>
</div>


