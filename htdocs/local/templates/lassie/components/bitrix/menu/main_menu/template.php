<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<div class="header__bottom">
		<div class="container">
			<nav class="header__nav navigation">
				<ul class="header__menu menu menu_width_full">

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

<?if ($previousLevel > 1 && $arItem["DEPTH_LEVEL"] === 1):?>
		</div>
		</li>
		<!-- </ul> -->
	<?endif?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="menu__item"><a href="<?=$arItem["LINK"]?>" class="menu__name"><?=$arItem["TEXT"]?></a>
				<ul class="dropdown-menu">
					<li class="dropdown-menu__content">
							<div class="dropdown-menu__img">
								<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/header-submenu-1.jpg" alt="девочка">
							</div>
								<div class="dropdown-menu__menu-col">
									<ul class="vertical-menu">
		<?else:?>
			<li class="vertical-menu__item"><span class="vertical-menu__name"><?=$arItem["TEXT"]?></span>
				<ul class="vertical-menu__submenu">
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="menu__item">
					<a href="<?=$arItem["LINK"]?>" class="<?=$arItem["TEXT"]=='Распродажа' ? 'header__sale-wrapper' : '';?> menu__name">
					<?if ($arItem["TEXT"]=='Распродажа'):?>
						<span class="header__sale"><?=$arItem["TEXT"]?></span>
					<?else:?>
						<?=$arItem["TEXT"]?>
					<?endif?>
					</a>
				</li>
			<?elseif($arItem["DEPTH_LEVEL"] == 2):?>
				<li class="vertical-menu__item"><a href="<?=$arItem["LINK"]?>" class="vertical-menu__name"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li class="vertical-menu__submenu-item"><a href="<?=$arItem["LINK"]?>" class="link vertical-menu__submenu-name"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
</nav>
</div>
</div>
<div class="menu-clear-left"></div>
<?endif?>