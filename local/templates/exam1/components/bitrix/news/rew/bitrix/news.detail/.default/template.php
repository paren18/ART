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
<!--    <header>-->
<!--        <h1>Отзыв - --><?php //=$arResult["NAME"]?><!-- - --><?php //=$arResult['DISPLAY_PROPERTIES']["COMPANY"]['VALUE']?><!--</h1>-->
<!--    </header>-->
    <hr>
    <div class="review-block">
        <div class="review-text">
            <div class="review-text-cont">
                <?= $arResult["DETAIL_TEXT"];?>
            </div>
            <div class="review-autor">
                <?=$arResult["NAME"]?>, <?=$arResult["DISPLAY_ACTIVE_FROM"]?>г., <?=$arResult['DISPLAY_PROPERTIES']["POSITION"]['VALUE']?>, <?=$arResult['DISPLAY_PROPERTIES']["COMPANY"]['VALUE']?>.
            </div>
        </div>

        <div style="clear: both;" class="review-img-wrap">
            <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
            <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="img">
            <? else: ?>
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/rew/no_photo.jpg" alt="img">
            <? endif;?>
        </div>

    </div>
    <div class="exam-review-doc">

        <?php if (!empty($arResult["DISPLAY_PROPERTIES"]['FILES']['VALUE'])): ?>
            <p>Документы:</p>
        <?php if (count($arResult["DISPLAY_PROPERTIES"]['FILES']['VALUE']) == 1): ?>
            <div class="exam-review-item-doc">
                <img class="rew-doc-ico" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/icons/pdf_ico_40.png">
                <a href="<?= $arResult["DISPLAY_PROPERTIES"]['FILES']['FILE_VALUE']['SRC']?>"><?= $arResult["DISPLAY_PROPERTIES"]['FILES']['FILE_VALUE']['ORIGINAL_NAME'] ?></a>
            </div>
        <?php else: ?>
            <?php foreach($arResult["DISPLAY_PROPERTIES"]['FILES']['FILE_VALUE'] as $file): ?>
                <div class="exam-review-item-doc">
                    <img class="rew-doc-ico" src="<?= SITE_TEMPLATE_PATH ?>/assets/img/icons/pdf_ico_40.png">
                    <a href="<?= $file['SRC'] ?>"><?= $file['ORIGINAL_NAME'] ?></a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php endif; ?>

    </div>
    <hr>



