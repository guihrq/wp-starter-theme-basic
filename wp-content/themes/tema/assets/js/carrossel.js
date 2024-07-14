var $carouselBanner = $('.carousel-banners').flickity({
  cellSelector: '.carousel-cell',
  imagesLoaded: true,
  percentPosition: true,
  cellAlign: 'left',
  wrapAround: true,
  pauseAutoPlayOnHover: false,
  draggable: true,
  pageDots: true,
  initialIndex: 0,
  contain: true,
  prevNextButtons: true,
  autoPlay: 6000
});

var $carouselDepoimentos = $('.carousel-depoimentos').flickity({
  cellSelector: '.carousel-cell',
  imagesLoaded: true,
  percentPosition: true,
  cellAlign: 'left',
  wrapAround: true,
  pauseAutoPlayOnHover: false,
  draggable: true,
  pageDots: true,
  initialIndex: 0,
  contain: true,
  prevNextButtons: false,
  autoPlay: 6000
});