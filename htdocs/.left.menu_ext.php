<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

global $APPLICATION;
$aMenuLinksExt = $APPLICATION->IncludeComponent("bitrix:menu.sections", "bootstrap_v4", array(
	"IS_SEF" => "Y",
	"SEF_BASE_URL" => "/catalog/",
	"SECTION_PAGE_URL" => "#SECTION_CODE#/",
	"DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/",
	"IBLOCK_TYPE" => 'catalog',
	"IBLOCK_ID" => '5',
	"DEPTH_LEVEL" => "3",
	"CACHE_TYPE" => "N",
), false);

$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
