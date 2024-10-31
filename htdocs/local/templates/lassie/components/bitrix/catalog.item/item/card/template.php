<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */
?>

<article class="good" style="width:auto;">
    <div class="good__content">

        <a class="card_item_link" href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $imgTitle ?>"
            data-entity="image-wrapper">

            <img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="Товар" class="good__img" title="" id="<?= $itemIds['PICT'] ?>">

            <? if ($item['LABEL']): {
            ?>
                    <?
                    if (!empty($item['LABEL_ARRAY_VALUE'])) {
                        foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value) {
                    ?>
                            <span class="flag flag_type_<?= $value ?>"><?= $value ?></span>
                    <?
                        }
                    }
                    ?>
            <?
                }
            endif;
            ?>
        </a><a href="javascript:void(0);" class="like">Мне нравится</a>
        <h4 class="good__name" id="<?= $itemIds['PICT_SLIDER'] ?>">
            <?= $productTitle ?>
        </h4>
        <?
        foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName) {
            if ($blockName === 'price') {
                // echo '<pre>';
                // print_r($price);
                // echo '</pre>';
        ?>
                <div class="good__price-wrapper" data-entity="price-block">
                    <span class="good__price <?= ($price['PERCENT'] > 0 ? 'good__price_new' : '') ?>" id="<?= $itemIds['PRICE'] ?>">
                        <?
                        if (!empty($price)) {
                            if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers) {
                                echo Loc::getMessage(
                                    'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
                                    array(
                                        '#PRICE#' => $price['PRINT_RATIO_PRICE'],
                                        '#VALUE#' => $measureRatio,
                                        '#UNIT#' => $minOffer['ITEM_MEASURE']['TITLE']
                                    )
                                );
                            } else {
                                echo $price['RATIO_PRICE'] . ' р.';
                            }
                        }
                        ?>
                    </span>
                    <?
                    if ($arParams['SHOW_OLD_PRICE'] === 'Y' && $price['PERCENT'] > 0) {
                    ?>
                        <span class="good__price good__price_old" id="<?= $itemIds['PRICE_OLD'] ?>"><?= $price['RATIO_BASE_PRICE'] . ' р.' ?></span>
                    <?
                    }

                    if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && $price['PERCENT'] > 0) {
                    ?>
                        <span class="good__discount">Скидка<?= ' ' . $price['PERCENT'] ?>%</span>
                    <?
                    }
                    ?>
                </div>
        <?
                break;
            }
        }
        ?>
    </div>
    <div class="good__hover">
        <form method="post" action="" class="form good__order">
            <?
            foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName) {
                switch ($blockName) {
                    case 'sku':
                        if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $haveOffers && !empty($item['OFFERS_PROP'])) {
            ?>
                            <div class="good__order-row" id="<?= $itemIds['PROP_DIV'] ?>">
                                <!-- <div data-entity="sku-line-block"> -->
                                <?
                                foreach ($arParams['SKU_PROPS'] as $skuProperty) {
                                    $propertyId = $skuProperty['ID'];
                                    $skuProperty['NAME'] = htmlspecialcharsbx($skuProperty['NAME']);
                                    if (!isset($item['SKU_TREE_VALUES'][$propertyId]))
                                        continue;
                                ?>
                                    <label class="good__order-label">Выберите <?= $skuProperty['NAME'] ?></label>
                                    <?
                                    foreach ($skuProperty['VALUES'] as $value) {
                                        if (!isset($item['SKU_TREE_VALUES'][$propertyId][$value['ID']]))
                                            continue;
                                        $value['NAME'] = htmlspecialcharsbx($value['NAME']);

                                    ?>
                                        <div class="checkbox-tile"
                                            data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>" data-onevalue="<?= $value['ID'] ?>">
                                            <input id="good<?= $item['ID'] ?>-<?= $value['NAME'] ?>-<?= $value['ID'] ?>"
                                                name="Good[size]" type="radio" value="<?= $value['NAME'] ?>" required class="checkbox-tile__elem">
                                            <label for="good<?= $item['ID'] ?>-<?= $value['NAME'] ?>-<?= $value['ID'] ?>"
                                                class="checkbox-tile__label"><?= $value['NAME'] ?></label>
                                        </div>
                                    <?

                                    }
                                    ?>
                                <?
                                }
                                ?>
                            </div>
                            <?
                            foreach ($arParams['SKU_PROPS'] as $skuProperty) {
                                if (!isset($item['OFFERS_PROP'][$skuProperty['CODE']]))
                                    continue;

                                $skuProps[] = array(
                                    'ID' => $skuProperty['ID'],
                                    'SHOW_MODE' => $skuProperty['SHOW_MODE'],
                                    'VALUES' => $skuProperty['VALUES'],
                                    'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
                                );
                            }

                            unset($skuProperty, $value);
                        }

                        break;

                    case 'quantity':
                        if (!$haveOffers) {
                            if ($actualItem['CAN_BUY'] && $arParams['USE_PRODUCT_QUANTITY']) {
                            ?>

                                <div class="good__order-row" data-entity="quantity-block">
                                    <label for="<?= $itemIds['QUANTITY'] ?>" type="number" class="good__order-label">Количество</label>
                                    <div class="input-number">
                                        <input id="<?= $itemIds['QUANTITY'] ?>" type="number" step="1" min="1" required class="input-number__elem"
                                            name="<?= $arParams['PRODUCT_QUANTITY_VARIABLE'] ?>" value="<?= $measureRatio ?>">>
                                        <div class="input-number__counter">
                                            <span class="input-number__counter-spin input-number__counter-spin_more" id="<?= $itemIds['QUANTITY_UP'] ?>">Больше</span>
                                            <span class="input-number__counter-spin input-number__counter-spin_less" id="<?= $itemIds['QUANTITY_DOWN'] ?>">Меньше</span>
                                        </div>
                                    </div>
                                </div>
                            <?
                            }
                        } elseif ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y') {
                            if ($arParams['USE_PRODUCT_QUANTITY']) {
                            ?>
                                <div class="good__order-row" data-entity="quantity-block">
                                    <label for="<?= $itemIds['QUANTITY'] ?>" type="number" class="good__order-label">Количество</label>
                                    <div class="input-number">
                                        <input id="<?= $itemIds['QUANTITY'] ?>" type="number" step="1" min="1" required class="input-number__elem"
                                            name="<?= $arParams['PRODUCT_QUANTITY_VARIABLE'] ?>" value="<?= $measureRatio ?>">>
                                        <div class="input-number__counter">
                                            <span class="input-number__counter-spin input-number__counter-spin_more" id="<?= $itemIds['QUANTITY_UP'] ?>">Больше</span>
                                            <span class="input-number__counter-spin input-number__counter-spin_less" id="<?= $itemIds['QUANTITY_DOWN'] ?>">Меньше</span>
                                        </div>
                                    </div>
                                </div>
                        <?
                            }
                        }
                        break;

                    case 'buttons':
                        ?>
                        <!-- <div class="card_item_activites_btns" data-entity="buttons-block"> -->
                        <?
                        if (!$haveOffers) {
                            if ($actualItem['CAN_BUY']) {
                        ?>
                                <div id="<?= $itemIds['BASKET_ACTIONS'] ?>">
                                    <button id="<?= $itemIds['BUY_LINK'] ?>" class="btn">
                                        <?= ($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET']) ?>
                                    </button>
                                </div>
                            <?
                            } else {
                            ?>
                                <?
                                if ($showSubscribe) {
                                    $APPLICATION->IncludeComponent(
                                        'bitrix:catalog.product.subscribe',
                                        '',
                                        array(
                                            'PRODUCT_ID' => $actualItem['ID'],
                                            'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
                                            'BUTTON_CLASS' => 'btn btn-primary ' . $buttonSizeClass,
                                            'DEFAULT_DISPLAY' => true,
                                            'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
                                        ),
                                        $component,
                                        array('HIDE_ICONS' => 'Y')
                                    );
                                }
                                ?>
                                <button id="<?= $itemIds['NOT_AVAILABLE_MESS'] ?>">
                                    <?= $arParams['MESS_NOT_AVAILABLE'] ?>
                                </button>
                            <?
                            }
                        } else {
                            if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y') {
                            ?>
                                <!-- Видим эту кнопку -->
                                <button id="<?= $itemIds['BUY_LINK'] ?>" class="btn">
                                    <?= ($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET']) ?>
                                </button>

                                <?
                                if ($showSubscribe) {
                                    $APPLICATION->IncludeComponent(
                                        'bitrix:catalog.product.subscribe',
                                        '',
                                        array(
                                            'PRODUCT_ID' => $item['ID'],
                                            'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
                                            'BUTTON_CLASS' => 'btn btn-primary ' . $buttonSizeClass,
                                            'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
                                            'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
                                        ),
                                        $component,
                                        array('HIDE_ICONS' => 'Y')
                                    );
                                }
                                //$actualItem['CAN_BUY']
                                ?>
                                <!-- <button id="<?= $itemIds['NOT_AVAILABLE_MESS'] ?>">
                                                <?= $arParams['MESS_NOT_AVAILABLE'] ?>
                                            </button> -->
                            <?
                            } else {
                            ?>
                                <a href="<?= $item['DETAIL_PAGE_URL'] ?>">
                                    <?= $arParams['MESS_BTN_DETAIL'] ?>
                                </a>
                        <?
                            }
                        }
                        ?>
                        <!-- </div> -->
            <?
                        break;
                }
            }
            ?>
        </form>
    </div>
    <!-- </div> -->
</article>