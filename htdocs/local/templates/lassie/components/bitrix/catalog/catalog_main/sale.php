<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y') {
	$basketAction = $arParams['COMMON_ADD_TO_BASKET_ACTION'] ?? '';
} else {
	$basketAction = $arParams['SECTION_ADD_TO_BASKET_ACTION'] ?? '';
}


if ($isSidebar) {
	$contentBlockClass = ($isSidebarLeft ? "col-md-9 col-sm-8 order-1 order-sm-2" : "col-md-9 col-sm-8 order-1");
} else {
	$contentBlockClass = "col";
}
?>


<div class="catalog catalog-page__catalog">

	<!-- <div class="row mb-4 bx-<?= $arParams["TEMPLATE_THEME"] ?>"> -->
	<? if ($arParams['USE_FILTER'] === 'Y' || $isSidebar): ?>
		<form method="post" action="" data-block='1' class="catalog-page__filter catalog__filter form">
			<fieldset class="form__fieldset">
				<!-- <div class="col-lg-3 col-md-4 col-sm-5<?= (isset($arParams['FILTER_HIDE_ON_MOBILE']) && $arParams['FILTER_HIDE_ON_MOBILE'] === 'Y' ? ' d-none d-sm-block' : '') ?>"> -->
				<?
				//region Filter
				if ($arParams['USE_FILTER'] === 'Y'): ?>
					<div class="bx-sidebar-block">
						<?
						$APPLICATION->IncludeComponent(
							"bitrix:catalog.smart.filter",
							"",
							array(
								"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
								"IBLOCK_ID" => $arParams["IBLOCK_ID"],
								"SECTION_ID" => $arCurSection['ID'],
								"FILTER_NAME" => $arParams["FILTER_NAME"],
								"PRICE_CODE" => $arParams["~PRICE_CODE"],
								"CACHE_TYPE" => $arParams["CACHE_TYPE"],
								"CACHE_TIME" => $arParams["CACHE_TIME"],
								"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
								"SAVE_IN_SESSION" => "N",
								"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
								"XML_EXPORT" => "N",
								"SECTION_TITLE" => "NAME",
								"SECTION_DESCRIPTION" => "DESCRIPTION",
								'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
								"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
								'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
								'CURRENCY_ID' => $arParams['CURRENCY_ID'],
								"SEF_MODE" => $arParams["SEF_MODE"],
								"SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
								"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
								"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
								"INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
							),
							$component,
							array('HIDE_ICONS' => 'Y')
						);
						?>
					</div>
				<? endif
				//endregion
				?>
			</fieldset>
		</form>
		<!-- </div> -->
	<? endif ?>


	<!-- <div class="pb-4 <?= (($isFilter || $isSidebar) ? "col-lg-9 col-md-8 col-sm-7" : "col") ?>"> -->
	<div class="catalog__main">
		<div class="catalog__sort">
			<div class="catalog__sort-group"><span class="catalog__sort-text text">Сортировать по:</span>
				<select name="sort" class="js-select select">
					<option value="popular">Популярности</option>
					<option value="price">Цене</option>
					<option value="new">Новизне</option>
					<option value="availibel">Наличию</option>
				</select>
			</div>
			<div class="catalog__sort-group"><span class="catalog__sort-text text">Отображать по:</span>
				<select name="display" class="js-select select">
					<option value="12">12</option>
					<option value="9">9</option>
					<option value="6">6</option>
					<option value="3">3</option>
				</select>
			</div>
		</div>
		<?
		// if (ModuleManager::isModuleInstalled("sale")) {
		// 	$arRecomData = array();
		// 	$recomCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
		// 	$obCache = new CPHPCache();
		// 	if ($obCache->InitCache(36000, serialize($recomCacheID), "/sale/bestsellers")) {
		// 		$arRecomData = $obCache->GetVars();
		// 	} elseif ($obCache->StartDataCache()) {
		// 		if (Loader::includeModule("catalog")) {
		// 			$arSKU = CCatalogSku::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
		// 			$arRecomData['OFFER_IBLOCK_ID'] = (!empty($arSKU) ? $arSKU['IBLOCK_ID'] : 0);
		// 		}
		// 		$obCache->EndDataCache($arRecomData);
		// 	}
		// }
		?>
		<!-- <div class="catalog__main"> -->
		<?
		$intSectionID = $APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"section",
			array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
				"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
				"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
				"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
				"PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
				"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
				"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
				"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
				"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
				"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
				"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
				"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
				"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"MESSAGE_404" => $arParams["~MESSAGE_404"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"SHOW_404" => $arParams["SHOW_404"],
				"FILE_404" => $arParams["FILE_404"],
				"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
				"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
				"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
				"PRICE_CODE" => $arParams["~PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
				"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
				"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
				"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

				"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["PAGER_TITLE"],
				"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
				"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
				"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
				"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
				"LAZY_LOAD" => $arParams["LAZY_LOAD"],
				"MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
				"LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

				"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
				"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
				"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
				"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
				"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
				"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
				"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
				"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
				"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
				'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
				'CURRENCY_ID' => $arParams['CURRENCY_ID'],
				'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
				'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

				'LABEL_PROP' => $arParams['LABEL_PROP'],
				'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
				'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
				'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'] ?? '',
				'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
				'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
				'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
				'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
				'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
				'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
				'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
				'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

				'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
				'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
				'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
				'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
				'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
				'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
				'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
				'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
				'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
				'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
				'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
				'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
				'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
				'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'] ?? '',
				'MESS_NOT_AVAILABLE_SERVICE' => $arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '',
				'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

				'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
				'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
				'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

				'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
				"ADD_SECTIONS_CHAIN" => "N",
				'ADD_TO_BASKET_ACTION' => $basketAction,
				'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
				'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
				'COMPARE_NAME' => $arParams['COMPARE_NAME'],
				'USE_COMPARE_LIST' => 'Y',
				'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
				'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
				'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
			),
			$component
		);

		$GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;
		?>
	</div>
</div>
<!-- </div> -->