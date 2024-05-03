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

<div class="review-block">
    <div class="review-text">
        <div class="review-text-cont">
            <?=$arResult["DETAIL_TEXT"];?>
        </div>
        <div class="review-autor">
            <?= $arResult["NAME"];?>,  <?= $arResult["DISPLAY_ACTIVE_FROM"];?><?=GetMessage('YEAR')?>,
            <?=$arResult['DISPLAY_PROPERTIES']['POSITION']['VALUE']?>,
            <?=$arResult['DISPLAY_PROPERTIES']['COMPANY']['VALUE']?><?=GetMessage('Toc')?>
        </div>
    </div>

    <?php if(!empty($arResult["DETAIL_PICTURE"]["SRC"])):?>
        <div style="clear: both;" class="review-img-wrap">
            <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="img"></div>
    <?php else:?>
        <div style="clear: both;" class="review-img-wrap">
            <img src="<?= SITE_TEMPLATE_PATH ?>/img/rew/no_photo.jpg" alt="img">
        </div>
    <?php endif;?>
</div>
<?php if($arResult["DISPLAY_PROPERTIES"]["FILES"]['VALUE']):?>
<div class="exam-review-doc">

    <p>Документы:</p>
    <?php foreach ($arResult["DISPLAY_PROPERTIES"]["FILES"]['VALUE'] as $image):?>
    <?php
     $srcimage= CFILE::getPath($image);
     $objimage= CFILE::getById($image);
     $ima=$objimage->fetch();
     ?>
    <div class="exam-review-item-doc"><img class="rew-doc-ico" src="<?= SITE_TEMPLATE_PATH ?>/img/icons/pdf_ico_40.png">
        <a href="$srcimage"><?=$ima["ORIGINAL_NAME"]?>
        </a></div>
        <?php endforeach;?>
</div>
<?php endif?>




