<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;
?>

<!doctype html>
<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title><? $APPLICATION->ShowTitle() ?></title>
    <? $APPLICATION->ShowHead(); ?>
    <?php

    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/styles/app.min.css");
    Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;subset=latin,cyrillic" rel="stylesheet">');
    // Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/scripts/app.min.js");

    ?>

</head>

<body>
    <? $APPLICATION->ShowPanel(); ?>

    <header class="header">
        <div class="header__top">
            <div class="container header__container header__container_top">
                <div class="header__col header__col_top-left"><span class="header__icon icon-mail"></span><a href="javascript:void(0);" class="link">Подписаться</a>
                </div>
                <div class="header__col header__col_top-right">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top_header_menu",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(0 => "",),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "top",
                            "USE_EXT" => "N"
                        )
                    ); ?>
                    <? $APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"header_seach", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_TITLE" => "",
		"CHECK_DATES" => "N",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => "#SITE_DIR#search/",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y",
		"COMPONENT_TEMPLATE" => "header_seach",
		"CATEGORY_0_iblock_catalog" => array(
			0 => "5",
		),
		"TEMPLATE_THEME" => "blue",
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SHOW_PREVIEW" => "Y",
		"CONVERT_CURRENCY" => "N",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75"
	),
	false
); ?>

</div>
            </div>
        </div>
        <div class="header__middle">
            <div class="container header__container header__container_middle">
                <div class="header__col header__col_logo">
                    <a href="/" class="header__logo logo">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/logo.png" class="logo__img" alt="">
                    </a>
                </div>
                <div class="header__contacts"><span class="header__icon icon-comment"></span>
                    <div class="header__col header__col_contacts">
                        <div class="contacts"><a href="tel:+74952150435" class="contacts__tel">8 495 215-04-35</a>
                            <div class="contacts__info">с 9:00 до 24:00 ежедневно</div>
                        </div>
                    </div>
                    <div class="header__col header__col_contacts">
                        <div class="contacts"><a href="tel:+78003331204" class="contacts__tel">8 800 333-12-04</a>
                            <div class="contacts__info">24 часа 7 дней в неделю</div>
                        </div>
                    </div>
                    <div class="header__col header__col_contacts"><a href="javascript:void(0);" class="link">Контактная информация</a>
                    </div>
                </div>
                <div class="header__col header__col_basket"><span class="header__icon icon-bag"></span>
                    <div class="header__basket">
                        <? $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "head_basket", Array(
	"COMPONENT_TEMPLATE" => "header_basket",
		"PATH_TO_BASKET" => "/personal/cart/",	// Страница корзины
		"PATH_TO_ORDER" => "/personal/order/make/",	// Страница оформления заказа
		"SHOW_NUM_PRODUCTS" => "Y",	// Показывать количество товаров
		"SHOW_TOTAL_PRICE" => "Y",	// Показывать общую сумму по товарам
		"SHOW_EMPTY_VALUES" => "Y",	// Выводить нулевые значения в пустой корзине
		"SHOW_PERSONAL_LINK" => "N",	// Отображать персональный раздел
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",	// Страница персонального раздела
		"SHOW_AUTHOR" => "N",	// Добавить возможность авторизации
		"PATH_TO_AUTHORIZE" => "",	// Страница авторизации
		"SHOW_REGISTRATION" => "N",	// Добавить возможность регистрации
		"PATH_TO_REGISTER" => SITE_DIR."login/",	// Страница регистрации
		"PATH_TO_PROFILE" => SITE_DIR."personal/",	// Страница профиля
		"SHOW_PRODUCTS" => "N",	// Показывать список товаров
		"POSITION_FIXED" => "N",	// Отображать корзину поверх шаблона
		"HIDE_ON_BASKET_PAGES" => "N",	// Не показывать на страницах корзины и оформления заказа
		"SHOW_DELAY" => "N",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_IMAGE" => "Y",
		"SHOW_PRICE" => "Y",
		"SHOW_SUMMARY" => "Y",
		"MAX_IMAGE_SIZE" => "70",	// Максимальный размер картинки товара
	),
	false
); ?>

</div>
                </div>
            </div>
        </div>

        <? $APPLICATION->IncludeComponent("bitrix:menu", "main_menu", Array(
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"COMPONENT_TEMPLATE" => "horizontal_multilevel",
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"MAX_LEVEL" => "3",	// Уровень вложенности меню
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_TYPE" => "N",	// Тип кеширования
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"MENU_THEME" => "site",
		"ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
		"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	),
	false
); ?>

</header>

<?
// echo $APPLICATION->GetCurPage();
if ($APPLICATION->GetCurPage() === '/') {
?>

    <main class="content index">
        <div class="index__slider slider">
            <ul class="slider__container">
                <!-- <li class="slider__item">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/slider-1.jpg" alt="" class="slider__img">
                    <div class="index__slider-title">Встречаем осень
                        <br>с новой коллекцией
                    </div>
                </li> -->
                <li class="slider__item">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/slider-1.jpg" alt="" class="slider__img">
                    <div class="index__slider-title">Встречаем осень
                        <br>с новой коллекцией
                    </div>
                </li>
            </ul>
        </div>
        <section class="popular">
            <div class="container">
                <h1 class="heading"><span class="heading__text"><?$APPLICATION->ShowTitle(false)?></span></h1>
            <?
        } else {
            ?>
                <main class="content catalog-page">
                    <div class="container">
                        <? $APPLICATION->IncludeComponent(
"bitrix:breadcrumb", 
"main_breadcrumb", 
array(
    "PATH" => "",
    "SITE_ID" => "s1",
    "START_FROM" => "0",
    "COMPONENT_TEMPLATE" => "main_breadcrumb"
),
false
); ?>

                <?$APPLICATION->ShowViewContent('product_gallery');?>


                        <h1><?$APPLICATION->ShowTitle(false)?></h1>
                        <?$APPLICATION->ShowViewContent("section_description");?>



                        <?
                } ?>