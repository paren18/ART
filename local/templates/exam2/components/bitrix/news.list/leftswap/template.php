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

<div class="rew-footer-carousel">
    <?foreach($arResult["ITEMS"] as $arItem):?>
    <div class="item">
        <div class="side-block side-opin">
            <div class="inner-block">
                <div class="title">
                    <div class="photo-block">
                        <? if(!empty($arItem["PREVIEW_PICTURE"]["SRC"])):?>
                        <img width="39" height="39" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="">
                        <? else:?>
                            <img width="39" height="39" src="<?= SITE_TEMPLATE_PATH ?>/img/rew/no_photo.jpg" alt="img">
                        <?endif;?>
                    </div>
                    <div class="name-block"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>
                    <div class="pos-block"><?=$arItem["DISPLAY_PROPERTIES"]['POSITION']['VALUE']?>,<?=$arItem["DISPLAY_PROPERTIES"]['COMPANY']['VALUE']?></div>
                </div>
                <div class="text-block">
                    <?
                    $str = $arItem["PREVIEW_TEXT"];
                    echo TruncateText($str, 150);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?endforeach;?>
</div>


