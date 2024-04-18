
<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
    CJSCore::Init('phone_auth');
}
?>


<div class="bx-auth">
    <?
    if (!empty($arParams["~AUTH_RESULT"]))
    {
        ShowMessage($arParams["~AUTH_RESULT"]);
    }
    ?>
    <?if($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
        <p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
    <?endif;?>

    <?if(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"] && $arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
        <p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
    <?endif?>
    <noindex>

        <?if($arResult["SHOW_SMS_FIELD"] == true):?>

            <form method="post" action="<?=$arResult["AUTH_URL"]?>" name="regform">
                <input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />
                <table class="data-table bx-registration-table">
                    <tbody>
                    <tr>
                        <td><span class="starrequired">*</span><?echo GetMessage("main_register_sms_code")?></td>
                        <td><input size="30" type="text" name="SMS_CODE" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"])?>" autocomplete="off" /></td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="code_submit_button" value="<?echo GetMessage("main_register_sms_send")?>" /></td>
                    </tr>
                    </tfoot>
                </table>
            </form>

            <script>
                new BX.PhoneAuth({
                    containerId: 'bx_register_resend',
                    errorContainerId: 'bx_register_error',
                    interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
                    data:
                        <?=CUtil::PhpToJSObject([
                            'signedData' => $arResult["SIGNED_DATA"],
                        ])?>,
                    onError:
                        function(response)
                        {
                            var errorDiv = BX('bx_register_error');
                            var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
                            errorNode.innerHTML = '';
                            for(var i = 0; i < response.errors.length; i++)
                            {
                                errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
                            }
                            errorDiv.style.display = '';
                        }
                });
            </script>

            <div id="bx_register_error" style="display:none"><?ShowError("error")?></div>

            <div id="bx_register_resend"></div>

        <?elseif(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>



            <div class="site-section">
                <div class="container">
                    <div class="row">

                        <div class="col-md-12 col-lg-8 mb-5">
                            <form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" enctype="multipart/form-data" class="p-5 bg-white border">
                                <input type="hidden" name="AUTH_FORM" value="Y" />
                                <input type="hidden" name="TYPE" value="REGISTRATION" />

                                <b><?=GetMessage("AUTH_REGISTER")?></b>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label class="font-weight-bold"><?=GetMessage("AUTH_NAME")?></label>
                                        <input type="text" name="USER_NAME"  class="form-control" value="<?=$arResult["USER_NAME"]?>" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <span class="starrequired">*</span><label class="font-weight-bold"><?=GetMessage("AUTH_LOGIN_MIN")?></label>
                                        <input type="text" name="USER_LOGIN" class="form-control" value="<?=$arResult["USER_LOGIN"]?>" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12"><span class="starrequired">*</span><label class="font-weight-bold"><?=GetMessage("AUTH_PASSWORD_REQ")?></label>
                                        <input type="password" name="USER_PASSWORD" class="form-control" value="<?=$arResult["USER_PASSWORD"]?>" autocomplete="off"/>
                                    </div>
                                </div>
                                <?if($arResult["SECURE_AUTH"]):?>
                                    <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
                                    <noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
                                    </noscript>
                                    <script type="text/javascript">
                                        document.getElementById('bx_auth_secure').style.display = 'inline-block';
                                    </script>
                                <?endif?>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <span class="starrequired">*</span><label class="font-weight-bold"><?=GetMessage("AUTH_CONFIRM")?></label>
                                        <input type="password" name="USER_CONFIRM_PASSWORD" class="form-control" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" />
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <span class="starrequired">*</span><label class="font-weight-bold"><?=GetMessage("AUTH_ACTIVITY")?></label>
                                        <div>
                                            <input type="radio" id="seller" name="drone" value="seller"/>
                                            <label for="seller">Продовец</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="buyer" name="drone" value="buyer" checked/>
                                            <label for="buyer">Покупатель</label>
                                        </div>
                                    </div>
                                </div>

                                <?if($arResult["EMAIL_REGISTRATION"]):?>
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <span class="starrequired">*</span><label class="font-weight-bold"><?if($arResult["EMAIL_REQUIRED"]):?><?endif?><?=GetMessage("AUTH_EMAIL")?></label>
                                            <input type="text" name="USER_EMAIL" class="form-control" value="<?=$arResult["USER_EMAIL"]?>" class="bx-auth-input" />
                                        </div>
                                    </div>

                                <?endif?>

                                <?if($arResult["PHONE_REGISTRATION"]):?>
                                    <tr>
                                        <td><?if($arResult["PHONE_REQUIRED"]):?><span class="starrequired">*</span><?endif?><?echo GetMessage("main_register_phone_number")?></td>
                                        <td><input type="text" name="USER_PHONE_NUMBER" maxlength="255" value="<?=$arResult["USER_PHONE_NUMBER"]?>" class="bx-auth-input" /></td>
                                    </tr>
                                <?endif?>

                                <?// ********************* User properties ***************************************************?>
                                <?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
                                    <tr><td colspan="2"><?=trim($arParams["USER_PROPERTY_NAME"]) <> '' ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></td></tr>
                                    <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
                                        <tr><td><?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;
                                                ?><?=$arUserField["EDIT_FORM_LABEL"]?>:</td><td>
                                                <?$APPLICATION->IncludeComponent(
                                                    "bitrix:system.field.edit",
                                                    $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                                                    array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "bform"), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
                                    <?endforeach;?>
                                <?endif;?>
                                <?// ******************** /User properties ***************************************************

                                /* CAPTCHA */
                                if ($arResult["USE_CAPTCHA"] == "Y")
                                {
                                    ?>
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <b><?=GetMessage("CAPTCHA_REGF_TITLE")?></b>

                                            <input type="hidden" name="captcha_sid" class="form-control" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                                        </div>
                                    </div>
                                    <td><span class="starrequired">*</span><?=GetMessage("CAPTCHA_REGF_PROMT")?>:</td>
                                    <td><input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" /></td>
                                    </tr>
                                    <?
                                }
                                /* CAPTCHA */
                                ?>
                                <tr>
                                    <td></td>
                                    <td>
                                        <?$APPLICATION->IncludeComponent("bitrix:main.userconsent.request", "",
                                            array(
                                                "ID" => COption::getOptionString("main", "new_user_agreement", ""),
                                                "IS_CHECKED" => "Y",
                                                "AUTO_SAVE" => "N",
                                                "IS_LOADED" => "Y",
                                                "ORIGINATOR_ID" => $arResult["AGREEMENT_ORIGINATOR_ID"],
                                                "ORIGIN_ID" => $arResult["AGREEMENT_ORIGIN_ID"],
                                                "INPUT_NAME" => $arResult["AGREEMENT_INPUT_NAME"],
                                                "REPLACE" => array(
                                                    "button_caption" => GetMessage("AUTH_REGISTER"),
                                                    "fields" => array(
                                                        rtrim(GetMessage("AUTH_NAME"), ":"),
                                                        rtrim(GetMessage("AUTH_LAST_NAME"), ":"),
                                                        rtrim(GetMessage("AUTH_LOGIN_MIN"), ":"),
                                                        rtrim(GetMessage("AUTH_PASSWORD_REQ"), ":"),
                                                        rtrim(GetMessage("AUTH_EMAIL"), ":"),
                                                    )
                                                ),
                                            )
                                        );?>

                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <input type="submit" name="Register" class="btn btn-primary  py-2 px-4 rounded-0" value="<?=GetMessage("AUTH_REGISTER")?>" />
                                            </div>
                                        </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
            <p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>

            <p><a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><b><?=GetMessage("AUTH_AUTH")?></b></a></p>

            <script type="text/javascript">
                document.bform.USER_NAME.focus();
            </script>

        <?endif?>

    </noindex>
</div>