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

<div class="item-wrap">
<div class="rew-footer-carousel">
    <?foreach($arResult["ITEMS"] as $arItem):?>
<div class="item">
    <div class="side-block side-opin">
        <div class="inner-block">
            <div class="title">
                <div class="photo-block">
                    <?php if($arItem["PREVIEW_PICTURE"]["SRC"]):?>
                        <?
                        $resizedImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array("width" => 49, "height" => 49), BX_RESIZE_IMAGE_EXACT);
                        ?>
                        <img src="<?=$resizedImage["src"]?>" alt="">
                    <?php else:?>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo_left_block.jpg" alt="">
                    <?php endif;?>
                </div>
                <div class="name-block"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>
                <div class="pos-block"><?=$arResult['DISPLAY_PROPERTIES']['POSITION']['VALUE']?>,
                    <?=$arResult['DISPLAY_PROPERTIES']['COMPANY']['VALUE']?></div>
            </div>
            <div class="text-block"><?=TruncateText($arItem["PREVIEW_TEXT"], 150);?></div>
        </div>
    </div>
</div>
    <?endforeach;?>
</div>
</div>




