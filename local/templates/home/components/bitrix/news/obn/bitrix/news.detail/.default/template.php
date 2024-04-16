<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<?php if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
<div class="site-blocks-cover overlay" style="background-image: url('<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>');"
     data-aos="fade" data-stellar-background-ratio="0.5">
    <?php endif; ?>

    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-10">
                <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded"><?= Loc::getMessage("Details"); ?></span>
                <h1 class="mb-2"><?= $arResult["NAME"] ?></h1>
                <p class="mb-5"><strong
                            class="h2 text-success font-weight-bold">₽<?= $arResult["PROPERTIES"]["PRICE"]["VALUE"] ?></strong>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="site-section site-section-sm">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" style="margin-top: -150px;">
                <div class="mb-5">
                    <div class="slide-one-item home-slider owl-carousel">
                        <?php foreach ($arResult["DISPLAY_PROPERTIES"]["GALERPICS"]["VALUE"] as $imageID): ?>
                            <div><img src="<?= CFile::GetPath($imageID) ?>" alt="Image" class="img-fluid"></div>
                        <?php endforeach; ?>
                    </div>


                </div>
                <div class="bg-white">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <strong class="text-success h1 mb-3">₽<?= $arResult["DISPLAY_PROPERTIES"]["PRICE"]["VALUE"] ?></strong>
                        </div>
                        <div class="col-md-6">
                            <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
                                <li>
                                    <span class="property-specs"><?= Loc::getMessage("TIMESTAMP"); ?></span>
                                    <span class="property-specs-number"><?= $arResult["TIMESTAMP_X"] ?></span>
                                </li>
                                <?php if (!empty($arResult["DISPLAY_PROPERTIES"]["NUMFLOORS"]["VALUE"])): ?>
                                    <li>
                                        <span class="property-specs"><?= Loc::getMessage("NUMFLOORS"); ?></span>
                                        <span class="property-specs-number"><?= $arResult["DISPLAY_PROPERTIES"]["NUMFLOORS"]["VALUE"] ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($arResult["DISPLAY_PROPERTIES"]["TOTALAREA"]["VALUE"])): ?>
                                    <li>
                                        <span class="property-specs"><?= Loc::getMessage("TOTALAREA"); ?></span>
                                        <span class="property-specs-number"><?= $arResult["DISPLAY_PROPERTIES"]["TOTALAREA"]["VALUE"] ?></span>
                                    </li>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-6 col-lg-4 text-left border-bottom border-top py-3">
                            <span class="d-inline-block text-black mb-0 caption-text"><?= Loc::getMessage("NUMOFBATH"); ?></span>
                            <strong class="d-block"><?= $arResult["DISPLAY_PROPERTIES"]["NUMOFBATH"]["VALUE"] ?></strong>
                        </div>
                        <?php if (!empty($arResult["DISPLAY_PROPERTIES"]["AVAOFGARAGE"]["VALUE"])): ?>
                            <div class="col-md-6 col-lg-4 text-left border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text"><?= Loc::getMessage("AVAOFGARAGE"); ?></span>
                                <strong class="d-block"><?= $arResult["DISPLAY_PROPERTIES"]["AVAOFGARAGE"]["VALUE"] ?></strong>
                            </div>
                        <?php endif; ?>
                    </div>
                    <h2 class="h4 text-black"><?= Loc::getMessage("DETAIL_TEXT"); ?></h2>
                    <p><?= $arResult["DETAIL_TEXT"] ?></p>

                    <div class="row mt-5">
                        <?php if (!empty($arResult["DISPLAY_PROPERTIES"]["GALERPICS"]["VALUE"])): ?>
                            <div class="col-12">
                                <h2 class="h4 text-black mb-3"><?= Loc::getMessage("GALERPICS"); ?></h2>
                            </div>
                            <?php foreach ($arResult["DISPLAY_PROPERTIES"]["GALERPICS"]["VALUE"] as $imageID): ?>
                                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                                    <?php
                                    $imageSrc = CFile::GetPath($imageID);
                                    ?>
                                        <a href="<?= $imageSrc ?>" class="image-popup gal-item">
                                            <img src="<?= $imageSrc ?>" alt="Image" class="img-fluid">
                                        </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="row mt-5">
                        <?php if (!empty($arResult['DISPLAY_PROPERTIES']['DOPMAT']['VALUE'])): ?>
                            <div class="col-md-12">
                                <h4 class="text-black"><?= Loc::getMessage("DOPMAT"); ?></h4>
                                <div class="h4 text-black">
                                    <?php foreach ($arResult['DISPLAY_PROPERTIES']['DOPMAT']['VALUE'] as $fileId): ?>
                                        <?php $fileInfo = CFile::GetFileArray($fileId); ?>
                                        <?php if ($fileInfo): ?>
                                            <a href="<?= $fileInfo['SRC'] ?>"
                                               target="_blank"><?= $fileInfo['ORIGINAL_NAME'] ?></a><br>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="row mt-5">
                        <?php if (!empty($arResult['DISPLAY_PROPERTIES']['LINKS']['VALUE'])): ?>
                        <div class="col-md-12">
                            <h2 class="h4 text-black"><?= Loc::getMessage("LINKS"); ?></h2>
                            <div class="h4 text-black">
                                <?php foreach ($arResult['DISPLAY_PROPERTIES']['LINKS']['VALUE'] as $link): ?>
                                    <a href="<?= $link ?>"><?= $link ?></a><br>
                                <?php endforeach; ?>
                            </div>
                        </div>
                            <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 pl-md-5">

                <div class="bg-white widget border rounded">

                    <h3 class="h4 text-black widget-title mb-3">Contact Agent</h3>
                    <form action="" class="form-contact-agent">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" id="phone" class="btn btn-primary" value="Send Message">
                        </div>
                    </form>
                </div>

                <div class="bg-white widget border rounded">
                    <h3 class="h4 text-black widget-title mb-3">Paragraph</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit qui explicabo, libero nam, saepe
                        eligendi. Molestias maiores illum error rerum. Exercitationem ullam saepe, minus, reiciendis
                        ducimus quis. Illo, quisquam, veritatis.</p>
                </div>

            </div>

        </div>
    </div>
</div>