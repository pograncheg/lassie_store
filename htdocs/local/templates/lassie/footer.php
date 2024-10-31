<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

</main>
<footer class="footer">
    <div class="container footer__container">

        <div class="footer__col">
            <h3 class="footer__title">Покупки</h3>
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "footer_menu",
                array(
                    "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                    "CHILD_MENU_TYPE" => "",    // Тип меню для остальных уровней
                    "DELAY" => "N",    // Откладывать выполнение шаблона меню
                    "MAX_LEVEL" => "1",    // Уровень вложенности меню
                    "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                    "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                    "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                    "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                    "ROOT_MENU_TYPE" => "bottom",    // Тип меню для первого уровня
                    "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                    "COMPONENT_TEMPLATE" => "footer_menu",
                    "MENU_THEME" => "site"
                ),
                false
            ); ?>

        </div>
        <div class="footer__col">
            <h3 class="footer__title">Lassie</h3>
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "footer_menu",
                array(
                    "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                    "CHILD_MENU_TYPE" => "",    // Тип меню для остальных уровней
                    "DELAY" => "N",    // Откладывать выполнение шаблона меню
                    "MAX_LEVEL" => "1",    // Уровень вложенности меню
                    "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                    "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                    "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                    "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                    "ROOT_MENU_TYPE" => "footer_lassie",    // Тип меню для первого уровня
                    "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                    "COMPONENT_TEMPLATE" => "footer_menu",
                    "MENU_THEME" => "site"
                ),
                false
            ); ?>

        </div>
        <div class="footer__col">
            <h3 class="footer__title">Lassie клуб</h3>
            <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"footer_menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "footer_personal",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "footer_menu",
		"MENU_THEME" => "site"
	),
	false
); ?>

        </div>
        <div class="footer__col">
            <h3 class="footer__title">Социальные сети</h3>
            <ul class="footer__socials socials">
                <li class="socials__item"><a href="javascript:void(0);" class="socials__name socials__name_vk"><span class="icon-vkontakte"></span></a>
                </li>
                <li class="socials__item"><a href="javascript:void(0);" class="socials__name socials__name_ok"><span class="icon-odnoklassniki"></span></a>
                </li>
                <li class="socials__item"><a href="javascript:void(0);" class="socials__name socials__name_fb"><span class="icon-facebook"></span></a>
                </li>
                <li class="socials__item"><a href="javascript:void(0);" class="socials__name socials__name_tw"><span class="icon-twitter-bird"></span></a>
                </li>
            </ul>
            <p class="footer__text">Следи за новостями и акциями
                <br>в социальных сетях. Будь первым!
            </p>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container footer__container">
            <div class="footer__bottom-col">
                <p class="footer__text">Официальный интернет-магазин Lassie® в России</p>
            </div>
            <div class="footer__bottom-col">
                <div class="footer__text-group"><a href="tel:+78003331204" class="footer__text">8 (800) 333-12-04 </a><span class="footer__text">(горячая линия)</span>
                </div>
                <div class="footer__text-group"><a href="tel:+74952150435" class="footer__text">8 (495) 215-04-35 </a><span class="footer__text">(ежедневно с 9:00 до 24:00)</span>
                </div><a href="mailto:order@lassieshop.ru" class="footer__text footer__text_block">order@lassieshop.ru</a>
            </div>
        </div>
    </div>
</footer>


</body>

</html>