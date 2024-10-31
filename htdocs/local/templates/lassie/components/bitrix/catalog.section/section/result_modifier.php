<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arSale = [];
foreach ($arResult['ITEMS'] as $item) {
    if($item['PROPERTIES']['SALEPRODUCT']['VALUE'] === 'Y') {
        $arSale[] = $item;
    }
}

// echo '<pre>';
// print_r($arResult['ITEMS']);
// echo '</pre>';

// $arResult['ITEMS'] = $arSale;