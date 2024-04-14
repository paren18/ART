<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? use \Bitrix\Main\Localization\Loc; ?>
<div class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center">
                <div class="site-section-title">
                    <h2><?=Loc::getMessage("Blog");?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>

                <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="100">
                    <div  class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="p-4 bg-white">
                            <? if ($arItem["PREVIEW_PICTURE"]): ?>
                                <a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" class="img-fluid"></a>
                            <? endif; ?>
                            <span class="d-block text-secondary small text-uppercase"><? echo $arItem["DISPLAY_ACTIVE_FROM"] ?></span>

                            <h2 class="h5 text-black mb-3"><a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem["NAME"] ?></a></h2>
                            <p><? echo $arItem["PREVIEW_TEXT"] ?></p>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>

    </div>
</div>


