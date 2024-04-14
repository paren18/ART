<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<!--<div class="col-4 col-md-4 col-lg-8">-->
<!--    <nav class="site-navigation text-right text-md-right" role="navigation">-->
<!---->
<!--        <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3">-->
<!--            <a href="#" class="site-menu-toggle js-menu-toggle text-black">-->
<!--                <span class="icon-menu h3"></span>-->
<!--            </a>-->
<!--        </div>-->



<div class="col-12 col-md-12 col-lg-12">
    <nav class="site-navigation text-right text-md-right" role="navigation">
        <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3">
            <a href="#" class="site-menu-toggle js-menu-toggle text-black">
                <span class="icon-menu h3"></span>
            </a>
        </div>

        <? if (!empty($arResult)): ?>
        <ul class="site-menu js-clone-nav d-none d-lg-block">
            <?
            $previousLevel = 0;
            foreach($arResult as $arItem):
            ?>
            <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
            <?endif?>

            <?if ($arItem["IS_PARENT"]):?>
            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <li class="has-children <?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
                <ul class="dropdown">
                    <?else:?>
                    <li class="has-children<?if ($arItem["SELECTED"]):?> active<?endif?><?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
                        <ul class="dropdown">
                            <?endif?>
                            <?else:?>
                                <?if ($arItem["PERMISSION"] > "D"):?>
                                    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                        <li class="<?if ($arItem["SELECTED"]):?>active <?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
                                    <?else:?>
                                        <li<?if ($arItem["SELECTED"]):?> class="item-selected active"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                                    <?endif?>
                                <?else:?>
                                    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                        <li class="<?if ($arItem["SELECTED"]):?>active <?endif?>"><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
                                    <?else:?>
                                        <li class="active"><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
                                    <?endif?>
                                <?endif?>
                            <?endif?>
                            <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
                            <?endforeach?>
                            <?if ($previousLevel > 1): //close last item tags?>
                                <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
                            <?endif?>
                        </ul>
                        <div class="menu-clear-left"></div>
                        <?endif?>
    </nav>
</div>
