<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


    <nav class="site-navigation text-right text-md-right" role="navigation">
        <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3">
            <a href="#" class="site-menu-toggle js-menu-toggle text-black">
                <span class="icon-menu h3"></span>
            </a>
        </div>

        <?php if (!empty($arResult)): ?>
            <ul class="site-menu js-clone-nav d-none d-lg-block">
                <?php foreach ($arResult as $arItem): ?>
                    <?php if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue; ?>
                    <?php if ($arItem["SELECTED"]): ?>
                        <li class="active"><a href="<?= $arItem["LINK"] ?>" class="selected"><?= $arItem["TEXT"] ?></a></li>
                    <?php else: ?>
                        <li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </nav>
