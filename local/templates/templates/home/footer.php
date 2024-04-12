<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="mb-5">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "index_inc4",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "index_inc4.php"
                        )
                    );?>
                </div>



            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="row mb-5">
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "menu_butt", Array(

                    ),
                        false
                    );?>
                </div>
            </div>


            <div class="col-lg-4 mb-5 mb-lg-0">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "index_inc5",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "index_inc5.php"
                    )
                );?>



            </div>

        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "index_inc6",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "index_inc6.php"
                    )
                );?>
            </div>

        </div>
    </div>
</footer>

</div>
<?
global$APPLICATION;
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/jquery-3.3.1.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/jquery-migrate-3.0.1.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/jquery-ui.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/popper.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/bootstrap.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/owl.carousel.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/mediaelement-and-player.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/jquery.stellar.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/jquery.countdown.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/jquery.magnific-popup.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/bootstrap-datepicker.min.js');
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/aos.js');


$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/assets/js/main.js');

?>



</body>

</html>