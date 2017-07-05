<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.css" />
		<link rel="stylesheet" href="http://cdn.olof.ru/dump/doloto/assets/css/style.css">
	</head>
	<body>
		<header>
			<div class="header-info__container">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="float-left header-logo-flex__container">
								<div class="header-logo__container">
									<img class="" src="http://cdn.olof.ru/dump/doloto/assets/images/logo.png" alt="">
								</div>
							</div>
							<div class="float-right">
								<div class="header-phone__container">
									<div class="header-phone__item">
										8 (3522) 430-432
									</div>
									<div class="header-phone__item">
										8 (912) 572-56-43
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</header>
		<div style="clear:both;">

		</div>
		<div class="jumbotron__container">
			<div class="container">
				<div class="jumbotron__title">
					ДОЛОТА ДЛЯ БУРЕНИЯ СКВАЖИН
				</div>
				<div class="row" style="    padding: 3rem 0;">
					<div class="col-lg-8">
						<div class="jumbotron__image">
							<!-- <img src="assets/images/doloto.gif" alt=""> -->
							<div class="js-img-animation" id="js-animation-doloto"></div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="jumbotron__form">
							<form class="" action="index.html" method="post">
								<div class="jumbotron__form-title">
									Задать вопрос
								</div>
								<div class="form-group product-input">
									<input class="form-control product-input" type="text" name="" value="" placeholder="Имя">
								</div>
								<div class="form-group">
									<input class="form-control product-input" type="text" name="" value="" placeholder="Фамилия">
								</div>
								<div class="form-group">
									<input class="form-control product-input" type="text" name="" value="" placeholder="Телефон">
								</div>
								<div class="form-group" style="margin-top: 5rem;">
									<button class="btn btn-doloto" type="submit" name="button">Отправить</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div>
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="header-menu__container group">
							<div class="z-col-5">
								<div class="header-menu__item header">
									<div class="header-menu__item-text">
										<a class="invisible-link" href="#products">Долота</a>
									</div>
								</div>
							</div>

							<div class="z-col-5">
								<div class="header-menu__item header">
									<div class="header-menu__item-text">
										<a class="invisible-link" href="#advantages">Преимущества</a>
									</div>
								</div>
							</div>
							<div class="z-col-5">
								<div class="header-menu__item header">
									<div class="header-menu__item-text">
										<a class="invisible-link" href="#about">О компании</a>
									</div>
								</div>
							</div>
							<div class="z-col-5">
								<div class="header-menu__item header">
									<div class="header-menu__item-text">
										<a class="invisible-link" href="#feedback">Отзывы</a>
									</div>
								</div>
							</div>
							<div class="z-col-5">
								<div class="header-menu__item header">
									<div class="header-menu__item-text">
										<a class="invisible-link" href="#contacts">Контакты</a>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>


		<?php 
		error_reporting(E_ERROR);
		$output = [];

		CModule::IncludeModule('iblock');

		$section_iterator = \Bitrix\Iblock\SectionTable::GetList([
			'select' => ['name' => 'NAME', 'id' => 'ID'],
			'filter' => [
				'ID' => [1, 4, 3, 2, 31]
			]
		]);

		while ($item = $section_iterator->fetch()) {
			$output[] = [
				'section' => $item
			];
		}


		$output = array_map(function($item) {
			$item['value'] = \Bitrix\Iblock\ElementTable::GetList([
				'select' => [
					'name' => 'NAME',
					'preview_picture' => 'PREVIEW_PICTURE',
					'detail_picture' => 'DETAIL_PICTURE',
					'price' => 'price_prop.VALUE'
				],
				'filter' => [
					'IBLOCK_SECTION_ID' => $item['section']['id']
				],
				'runtime' => [
					new \Bitrix\Main\Entity\ReferenceField('price_prop', '\Bitrix\Iblock\ElementPropertyTable', [
						'=this.ID' => 'ref.IBLOCK_ELEMENT_ID',
						'ref.IBLOCK_PROPERTY_ID' => ['1']
					])
				]
			])->fetchAll();

			if (count($item['value']) == 0) {
				return null;
			}

			while (count($item['value']) <= 5) {
				$item['value'] = array_merge($item['value'], $item['value']); 
			}
			
			return $item;
		}, $output);

		?>
		<a name="products"></a>
		<?php foreach ($output as $key => $value): ?>
			<div>
				<div class="container">
					<div class="content-product__title">
						<?= $value['section']['name'] ?>
					</div>
				</div>
			</div>

			<div class="content-product__container <?= $key % 2 ? '' : 'blue' ?> group">
				<div class=" content-product-items">
					<?php foreach ($value['value'] as $element): ?>
						<div class="content-product__item">
							<div class="content-product__item-image">
								<img src="<?= CFile::GetPath($element['preview_picture'] ?: $element['detail_picture']) ?>" alt="">
							</div>
							<div class="content-product__item-price">
								<?php if (!$element['price']): ?>
									<div class="content-product__item-price-empty">Цена договорная</div>
								<?php else: ?>
									<?= number_format(floatval($element['price']), 0, '', ' ') ?> <i class="fa fa-rub" aria-hidden="true"></i>
								<?php endif; ?>
							</div>
							<div class="content-product__item-desc">
								<?= $element['name'] ?>
							</div>
							<div class="content-product__item-button">
								<a class="product-button" href="#">Заказать</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<br><br>
		<?php endforeach; ?>
		<a name="feedback"></a>
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="doloto-title">
						Отзывы
					</div>
					<div class="feedback__container">
						<div class="feedback-item__container">
							<div class="feedback-item__username">
								Вячеслав, буровик, бурение абиссинских колодцев, г. Магнитогорск
							</div>
							<div class="feedback-item__text">
								"В июле 2016 г. приобрел Долото D93 с круглыми лопастями, пробурил подряд 4 скважины, очень понравилось как оно по глине идет. Долото его не кусками отламывает, а крошит на
мелкие части. На 3-х скважинах натыкался на полуметровые плиты - пробурил без проблем, только напайку одну надломил, В общем с этим буром переосмыслил бурение скважин и зарабатывание денег на этом, буду дальше продолжать, а так, если честно, я хотел все это бросить.Большое спасибо за великолепный инструмент."
							</div>
						</div>
						<div class="feedback-item__container">
							<div class="feedback-item__avatar">
								<img src="assets/images/feedback-users/1.JPG" alt="">
							</div>
							<div class="feedback-item__username">
								Наиль, буровик, респ. Башкортостан
							</div>
							<div class="feedback-item__text">
								<p>О компании «Буровой инструмент» узнал
									из интернета. Познакомиться решил лично.
									 Приехал на завод.</p>

<p>После обсуждения моих условий бурения:
	глина, трещиноватые грунты, мне
	предложили необычную, но очень удачную
	модель «итальянского» долота д151/З-88,
	 укомплектовали переводником З-88/З-56.
	Очень неплохой инструмент, который помогает
	 бурить тяжелые глинистые грунты с
	 каменными прослойками без смены долота.</p>

<p>Второе приобретенное долото PDC д151.
	Пробурил 5 скважин по скале. Очень хорошо идет,
	после бурения по галечнику выбило 3 пластинки.
	Обратился в компанию «Буровой инструмент»,
	мне оперативно, в этот же день,
	отремонтировали долото.</p>

<p>Компания «Буровой инструмент» -
	компания для буровиков. Рекомендую!</p>
							</div>
						</div>
					</div>
				</div>
				<a name="advantages"></a>
				<div class="col-lg-8">
					<div class="doloto-title">
						Преимущества
					</div>
					<div class="advantages__container">
						<div class="advantages-item__container">
							<div class="advantages-item__logo">
								<img src="assets/images/advantages-like.png" alt="">
							</div>
							<div class="advantages-item__text">
								Стабильное качество и неизменная работа по совершенствовании конструкции ДОЛОТ
							</div>
						</div>
						<div class="advantages-item__container">
							<div class="advantages-item__text">
								В наличии все резьбовые окончания, лопасти, сердечники
							</div>
							<div class="advantages-item__logo right">
								<img src="assets/images/advantages-galkes.png" alt="">
							</div>
						</div>
						<div class="advantages-item__container">
							<div class="advantages-item__logo">
								<img src="assets/images/advantages-key.png" alt="">
							</div>
							<div class="advantages-item__text">
								Ремонт долот с заменой твердосплавных напаек
							</div>

						</div>
						<div class="advantages-item__container">
							<div class="advantages-item__text">
								Изготовление оригинальной конструкции по заявке заказчика
							</div>
							<div class="advantages-item__logo right">
								<img src="assets/images/advantages-rezba.png" alt="">
							</div>
						</div>
					</div>
					<div class="doloto-title">
						Применение долот
					</div>
					<div class="features__container">
						<div class="advantages-item__container">
							<div class="advantages-item__logo">
								<img src="assets/images/advantages-electro.png" alt="">
							</div>
							<div class="advantages-item__text">
								Использование в различных видах буровых установках
							</div>
						</div>
						<div class="advantages-item__container">
							<div class="advantages-item__text">
								Применяется для бурения различных видов грунтов
							</div>
							<div class="advantages-item__logo right">
								<img src="assets/images/advantages-horizont.png" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a name="about"></a>
		<div class="about__container">
			<div class="container">
				<div class="doloto-title about__text">
					О компании
				</div>
				<div class="about__detail">
					<p>Компания «Буровой инструмент» - основана в 2009 году в Кургане и
						занимается производством и продажей комплектующих для бурения.</p>
					<p>Наш вертлюг является уникальной инженерной разработкой, улучшаемой
						от версии к версии по отзывам и пожеланиям буровых компаний.</p>
					<p>На основе улучшенной конструкции мы производим различные
						модификации. В настоящий момент нами разработано свыше 15 моделей.</p>
					<p>Работаем с клиентами по всему миру:</p>
				</div>
				<div class="about__map">
				<div id="ymap-container" style='height:400px'></div>
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
	<script>
	var map;
	ymaps.ready(function(){
			var markParams = {
					iconLayout: 'default#image',
					iconImageHref: '//vertlug.com/landing-section/mark_2.png',
					iconImageSize: [29, 33],
					iconImageOffset: [-24, -20]
			};

			map = new ymaps.Map("ymap-container", {
					center: [52.03830991686452, 83.45307624601895],
					zoom: 3,
					controls: [
							'fullscreenControl','zoomControl'
					]
			});
			map.geoObjects.add(new ymaps.Placemark([54.671151486097,20.52476803571], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([47.203816204921,39.729691328125], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([55.72484752993,37.624912806358], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([43.554227738073,39.742941427455], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([42.988266365274,41.07228713058], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([59.889444517054,30.38178596875], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([56.290245153186,44.005986], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([57.975369698934,56.229398], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([56.806226679967,60.632979820312], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([55.12462817215,61.490489625], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([54.958533996022,73.365465417969], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([48.504868540643,135.09663623828], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([43.120171179236,131.93203289453], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([51.80712420693,107.57588525391], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([46.933404694083,142.72229262084], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([55.408019161097,65.358593824144], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([51.164045, 71.364353], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([49.775862, 73.078220], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([52.288355, 76.774456], {}, markParams));
			map.geoObjects.add(new ymaps.Placemark([53.115866, 63.579876], {}, markParams));

			map.behaviors.disable("scrollZoom"); // отключае прокрутку колесом
	});
	</script>
				</div>
			</div>
		</div>
		<div class="callback__container">
			<div class="container">
				<div class="callback-form__container">
					<form class="callback-form-form">
						<div class="callback-form__title__container">
							ЗАКАЗАТЬ ДОЛОТО
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-lg-6">
									<input class="form-control" placeholder="Имя" type="text" name="" value="">
								</div>
								<div class="col-lg-6">
									<input class="form-control" placeholder="Номер телефона" type="text" name="" value="">
								</div>
							</div>
						</div>
						<div class="form-group callback-form__title__submit">
							<button class="btn btn-callback" type="submit" name="button">Заказать</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<a name="contacts"></a>
		<footer>
			<div class="footer__container">
				<div class="footer-company-info__container group">
					<div class="container">
						<div class="footer-company-info__address float-left">
							г. Курган, пр. Машиностроителей, 37
						</div>
						<div class="footer-company-info__phone float-right">
							8 (3522) 430-432  /  8 (912) 572-56-43
						</div>
					</div>
				</div>
				<div class="footer-copy__container group">
					<div class="container">
						<div class="footer-copy__companyname float-left">
							© Буровой инструмент 2017
						</div>
						<div class="footer-copy__designer float-right">
							 Сайт сделан в РА "Артист"
						</div>
					</div>
				</div>
			</div>
		</footer>

		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
		<script src="http://cdn.olof.ru/dump/doloto/assets/js/main.js" charset="utf-8"></script>
	</body>
</html>
