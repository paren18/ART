<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php use \Bitrix\Main\Localization\Loc;?>

<div class="col-lg-4 mb-5 mb-lg-0">
    <div class="row mb-5">
        <div class="col-md-12">
            <h3 class="footer-heading mb-4"><?=Loc::getMessage("NAV");?></h3>
        </div>
        <div class="col-md-6 col-lg-6">
            <ul class="list-unstyled">
                <?php foreach ($arResult as $arItem): ?>
                    <li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

