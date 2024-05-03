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

    <div class="review-block">
        <div class="review-text">

            <div class="review-block-title"><span class="review-block-name">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></span>
                <span class="review-block-description"><?=$arItem["DISPLAY_ACTIVE_FROM"]?><?=GetMessage('YEAR')?>,
                    <?=$arItem['DISPLAY_PROPERTIES']['POSITION']['VALUE']?>,
                    <?=$arItem['DISPLAY_PROPERTIES']['COMPANY']['VALUE']?></span></div>

            <div class="review-text-cont">
                <?= $arItem["PREVIEW_TEXT"];?>
            </div>
        </div>


        <?php if(!empty($arItem["PREVIEW_PICTURE"]["SRC"])):?>
            <?
            $resizedImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array("width" => 68, "height" => 59), BX_RESIZE_IMAGE_EXACT);
            ?>
        <div class="review-img-wrap"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                <img src="<?=$resizedImage["src"]?>" alt="img">
            </a>
        </div>
    <?php else:?>
            <div class="review-img-wrap">
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                    <img class="preview_picture" src="<?= SITE_TEMPLATE_PATH ?>/img/rew/no_photo.jpg" alt="img">
                </a>
            </div>
    <?php endif;?>
    </div>
<?endforeach;?>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <br/><?= $arResult["NAV_STRING"] ?>
<? endif; ?>
