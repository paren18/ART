<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>

<div class="site-section">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-lg-8 mb-5">

                <?if(!empty($arResult["ERROR_MESSAGE"]))
                {
                    foreach($arResult["ERROR_MESSAGE"] as $v)
                        ShowError($v);
                }
                if($arResult["OK_MESSAGE"] <> '')
                {
                    ?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
                }
                ?>
                <form action="<?=POST_FORM_ACTION_URI?>" method="POST" class="p-5 bg-white border">
                    <?=bitrix_sessid_post()?>

                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="font-weight-bold" for="fullname"><?=GetMessage("MFT_NAME")?></label>
                            <input type="text" id="fullname" class="form-control" placeholder="Full Name" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="font-weight-bold" for="email"><?=GetMessage("MFT_EMAIL")?></label>
                            <input type="email" id="email" class="form-control" placeholder="Email Address"   name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="font-weight-bold" for="email"> <?=GetMessage("MFT_SUBJECT")?></label>
                            <input type="text" id="subject" class="form-control" placeholder="Enter Subject" name="user_subject" value="<?=$arResult["AUTHOR_SUBJECT"]?>">
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="font-weight-bold" for="message"><?=GetMessage("MFT_MESSAGE")?></label>
                            <textarea name="MESSAGE" id="message" cols="30" rows="5" class="form-control" placeholder="Say hello to us"><?=$arResult["MESSAGE"]?></textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>" class="btn btn-primary  py-2 px-4 rounded-0">
                        </div>
                    </div>


                </form>
           