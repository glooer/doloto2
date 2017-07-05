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
	var warp = $('#js-animation-doloto')
	for (var i = 0; i < 160; i++) {
		warp.append('<img src="http://cdn.olof.ru/dump/doloto/assets/images/fucking_amination/animation' + addZero(i, 4) + '.png">')
	}

	var current = 1;
	var warp__items = warp.find('img')
	setInterval(function() {
		warp__items[current].style.display = 'none';
		current += 1;
		if (current >= warp__items.length) {
			current = 1;
		}
		warp__items[current].style.display = 'block';
	}, 30)
})
