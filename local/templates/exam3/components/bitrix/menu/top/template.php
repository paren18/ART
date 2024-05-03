<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <nav class="nav">
    <div class="inner-wrap">
    <div class="inner-wrap">
    <div class="menu-block popup-wrap">
    <a href="" class="btn-menu btn-toggle"></a>
    <div class="menu popup-block">
    <ul class="">
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>
        <?if ($arItem["PERMISSION"] <= "D") continue;
        ?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <?if ($arItem['PARAMS']['CLASS_STYLE']):?>
        <li><a href="<?=$arItem["LINK"]?>" class="<?=$arItem['PARAMS']['CLASS_STYLE']?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
            <? else:?>
			<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
				<? endif;?>
                <ul>
                    <?php if(!empty($arItem['PARAMS']['DEC'])):?>
                        <div class="menu-text"><?= $arItem['PARAMS']['DEC']?></div>
                    <?endif?>
		<?else:?>
			<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
				<ul><?php if(!empty($arItem['PARAMS']['DEC'])):?>
                        <div class="menu-text"><?= $arItem['PARAMS']['DEC']?></div>
                    <?endif?>
		<?endif?>
	<?else:?>
		<?if ($arItem["PERMISSION"] > "D"):?>
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <?php if($arItem['LINK']=='/ekz3/'): ?>
                    <li class="main-page"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
                <?php else:?>
                    <?if ($arItem['PARAMS']['CLASS_STYLE']):?>
                        <li><a href="<?=$arItem["LINK"]?>" class="<?=$arItem['PARAMS']['CLASS_STYLE']?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
                    <? else:?>
                        <li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
                    <? endif;?>
			<?php endif;?>
                    <?else:?>
				<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>
		<?else:?>
            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>
                </ul>
    </div>
        <div class="menu-overlay"></div>
    </div>
    </div>
    </div>
    </nav>
<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<div class="menu-clear-left"></div>
<?endif?>