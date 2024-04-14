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
<div class="site-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 text-center mb-5">
                <div class="site-section-title">
                    <h2><?=Loc::getMessage("Our_Services");?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex flex-wrap justify-content-center">
                    <? foreach($arResult["ITEMS"] as $arItem): ?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <a href="<?=$arItem["PROPERTY_LINKS_VALUE"]?>" class="service text-center border rounded">
                                    <span class="news-date-time"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?>&nbsp;&nbsp;</span>
                                    <h2 class="service-heading"><?= $arItem["NAME"] ?></h2>
                                    <p><span class="read-more"><?=Loc::getMessage("Learn_More");?></span></p>
                                </a>
                            </div>
                        </div>

                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

