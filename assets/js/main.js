function addZero(n, i) {
	if (!i) {
		i = 4
	}

	n = n.toString();
	while (n.length < i) {
		n = '0' + n;
	}

	return n;
}


$('.content-product__container .content-product-items').slick({
  centerMode: true,
  centerPadding: '0',
  slidesToShow: 5,
	autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});



$(document).ready(function() {

	/*
	 * ***********************************************************************
	 *                           ПРАВКИ 21.07.2017 (Илья)
	 * ***********************************************************************
	 */

	(function(){
		function viewFeedbackText() {
			var $self = $(this)
			var $text = $self.parents('.feedback-item__text')
			if ($text.hasClass('feedback-item__text_hidden')) {
				$self.text("Свернуть")
				$text.removeClass('feedback-item__text_hidden');
			}
			else {
				$self.text("Развернуть")
				$text.addClass('feedback-item__text_hidden');
			}
		}
		$(".feedback-item__text").each(function(){
			$(this).addClass("feedback-item__text_hidden");
			$(this).append(
				$("<a/>", {
					"class": "feedback-item__view-btn",
					"text": "Показать",
					"click": viewFeedbackText,
					"onclick": viewFeedbackText
				})
			)
		})
	})()

	///////


	var warp = $('#js-animation-doloto')
	for (var i = 0; i < 141; i++) {
		warp.append('<img src="http://cdn.olof.ru/dump/doloto2/assets/images/fucking_animation_2/bandicam-2017-07-05-09-49-09-610' + addZero(i, 4) + '.png">')
	}

	var current = 1;
	var warp__items = warp.find('img');
	setInterval(function() {
		warp__items[current].style.display = 'none';
		current += 1;
		if (current >= warp__items.length) {
			current = 1;
		}
		warp__items[current].style.display = 'block';
	}, 30)



})
