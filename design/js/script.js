jQuery(() => {
    $(".sidebar-menu [href]").each(function () {
        if (this.href == window.location.href) {
            $(this).addClass("active");
        }
    });
});

  // Код главного меню
  $('.header-burger').on("click", function () {
    $('.mobile-container').css('display', 'flex');
    $('.header-burger').css('display', 'none');
    $('.header-burger-2').css('display', 'flex');
  });
  $('.header-burger-2').on("click", function () {
    $('.mobile-container').css('display', 'none');
    $('.header-burger-2').css('display', 'none');
    $('.header-burger').css('display', 'flex');
  });
  $('.section-one').on("click", function () {
    $('.mobile-container').css('display', 'none');
    $('.header-burger-2').css('display', 'none');
    $('.header-burger').css('display', 'flex');
  });

$(function() {
  $(".input-file").fileinput('<button class="input-file">Загрузить изображение</button>');
});
$(function() {
  $(".dobavit-download-text").fileinput('<button class="dobavit-download-text">Загрузить <span>изображение</span></button>');
});
$(function() {
  $(".dobavit-download-text-2").fileinput('<button class="dobavit-download-text-2">Загрузить <span>видео</span></button>');
});
$(function() {
  $(".dobavit-download-ingredient").fileinput('<button class="dobavit-download-ingredient">Выбрать <span>ингредиенты</span></button>');
});

// Код меню каталога
$('.tab-title-element-1').on("click", function () {
  $('.blok-tab-body-1').css('display', 'flex');
  $('.blok-tab-body-2').css('display', 'none');
  $('.blok-tab-body-3').css('display', 'none');
  $('.blok-tab-body-4').css('display', 'none');
  $('.blok-tab-body-5').css('display', 'none');
  $('.blok-tab-body-6').css('display', 'none');
  $('.tab-title-element-1').css('background', '#C2E66E');
  $('.tab-title-element-2').css('background', '#F6F6F7');
  $('.tab-title-element-3').css('background', '#F6F6F7');
  $('.tab-title-element-4').css('background', '#F6F6F7');
  $('.tab-title-element-5').css('background', '#F6F6F7');
  $('.tab-title-element-6').css('background', '#F6F6F7');
  $('.tab-title-element-1').css('color', '#272932');
  $('.tab-title-element-2').css('color', '#52545B');
  $('.tab-title-element-3').css('color', '#52545B');
  $('.tab-title-element-4').css('color', '#52545B');
  $('.tab-title-element-5').css('color', '#52545B');
  $('.tab-title-element-6').css('color', '#52545B');
});
$('.tab-title-element-2').on("click", function () {
  $('.blok-tab-body-2').css('display', 'flex');
  $('.blok-tab-body-1').css('display', 'none');
  $('.blok-tab-body-3').css('display', 'none');
  $('.blok-tab-body-4').css('display', 'none');
  $('.blok-tab-body-5').css('display', 'none');
  $('.blok-tab-body-6').css('display', 'none');
  $('.tab-title-element-2').css('background', '#C2E66E');
  $('.tab-title-element-1').css('background', '#F6F6F7');
  $('.tab-title-element-3').css('background', '#F6F6F7');
  $('.tab-title-element-4').css('background', '#F6F6F7');
  $('.tab-title-element-5').css('background', '#F6F6F7');
  $('.tab-title-element-6').css('background', '#F6F6F7');
  $('.tab-title-element-2').css('color', '#272932');
  $('.tab-title-element-1').css('color', '#52545B');
  $('.tab-title-element-3').css('color', '#52545B');
  $('.tab-title-element-4').css('color', '#52545B');
  $('.tab-title-element-5').css('color', '#52545B');
  $('.tab-title-element-6').css('color', '#52545B');
});
$('.tab-title-element-3').on("click", function () {
  $('.blok-tab-body-3').css('display', 'flex');
  $('.blok-tab-body-2').css('display', 'none');
  $('.blok-tab-body-1').css('display', 'none');
  $('.blok-tab-body-4').css('display', 'none');
  $('.blok-tab-body-5').css('display', 'none');
  $('.blok-tab-body-6').css('display', 'none');
  $('.tab-title-element-3').css('background', '#C2E66E');
  $('.tab-title-element-2').css('background', '#F6F6F7');
  $('.tab-title-element-1').css('background', '#F6F6F7');
  $('.tab-title-element-4').css('background', '#F6F6F7');
  $('.tab-title-element-5').css('background', '#F6F6F7');
  $('.tab-title-element-6').css('background', '#F6F6F7');
  $('.tab-title-element-3').css('color', '#272932');
  $('.tab-title-element-2').css('color', '#52545B');
  $('.tab-title-element-1').css('color', '#52545B');
  $('.tab-title-element-4').css('color', '#52545B');
  $('.tab-title-element-5').css('color', '#52545B');
  $('.tab-title-element-6').css('color', '#52545B');
});
$('.tab-title-element-4').on("click", function () {
  $('.blok-tab-body-4').css('display', 'flex');
  $('.blok-tab-body-2').css('display', 'none');
  $('.blok-tab-body-1').css('display', 'none');
  $('.blok-tab-body-3').css('display', 'none');
  $('.blok-tab-body-5').css('display', 'none');
  $('.blok-tab-body-6').css('display', 'none');
  $('.tab-title-element-4').css('background', '#C2E66E');
  $('.tab-title-element-2').css('background', '#F6F6F7');
  $('.tab-title-element-1').css('background', '#F6F6F7');
  $('.tab-title-element-3').css('background', '#F6F6F7');
  $('.tab-title-element-5').css('background', '#F6F6F7');
  $('.tab-title-element-6').css('background', '#F6F6F7');
  $('.tab-title-element-4').css('color', '#272932');
  $('.tab-title-element-2').css('color', '#52545B');
  $('.tab-title-element-1').css('color', '#52545B');
  $('.tab-title-element-3').css('color', '#52545B');
  $('.tab-title-element-5').css('color', '#52545B');
  $('.tab-title-element-6').css('color', '#52545B');
});
$('.tab-title-element-5').on("click", function () {
  $('.blok-tab-body-5').css('display', 'flex');
  $('.blok-tab-body-2').css('display', 'none');
  $('.blok-tab-body-1').css('display', 'none');
  $('.blok-tab-body-3').css('display', 'none');
  $('.blok-tab-body-4').css('display', 'none');
  $('.blok-tab-body-6').css('display', 'none');
  $('.tab-title-element-5').css('background', '#C2E66E');
  $('.tab-title-element-2').css('background', '#F6F6F7');
  $('.tab-title-element-1').css('background', '#F6F6F7');
  $('.tab-title-element-3').css('background', '#F6F6F7');
  $('.tab-title-element-4').css('background', '#F6F6F7');
  $('.tab-title-element-6').css('background', '#F6F6F7');
  $('.tab-title-element-5').css('color', '#272932');
  $('.tab-title-element-2').css('color', '#52545B');
  $('.tab-title-element-1').css('color', '#52545B');
  $('.tab-title-element-3').css('color', '#52545B');
  $('.tab-title-element-4').css('color', '#52545B');
  $('.tab-title-element-6').css('color', '#52545B');
});
$('.tab-title-element-6').on("click", function () {
  $('.blok-tab-body-6').css('display', 'flex');
  $('.blok-tab-body-2').css('display', 'none');
  $('.blok-tab-body-1').css('display', 'none');
  $('.blok-tab-body-3').css('display', 'none');
  $('.blok-tab-body-4').css('display', 'none');
  $('.blok-tab-body-5').css('display', 'none');
  $('.tab-title-element-6').css('background', '#C2E66E');
  $('.tab-title-element-2').css('background', '#F6F6F7');
  $('.tab-title-element-1').css('background', '#F6F6F7');
  $('.tab-title-element-3').css('background', '#F6F6F7');
  $('.tab-title-element-4').css('background', '#F6F6F7');
  $('.tab-title-element-5').css('background', '#F6F6F7');
  $('.tab-title-element-6').css('color', '#272932');
  $('.tab-title-element-2').css('color', '#52545B');
  $('.tab-title-element-1').css('color', '#52545B');
  $('.tab-title-element-3').css('color', '#52545B');
  $('.tab-title-element-4').css('color', '#52545B');
  $('.tab-title-element-5').css('color', '#52545B');
});

var swiper = new Swiper('.swiper-otzivi', {
  loop: true,
  setWrapperSize: true,
  width: null,
  navigation: {
      nextEl: '.swiper-button-otzivi-next',
      prevEl: '.swiper-button-otzivi-prev',
  },
  breakpoints: {
      320: {
          slidesPerView: 1,
          spaceBetween: 0
      },
      569: {
        slidesPerView: 2,
        spaceBetween: 10
    },
      1025: {
        slidesPerView: 2,
        spaceBetween: 20
    },
      1231: {
        slidesPerView: 3,
        spaceBetween: 20
    },
      1441: {
         slidesPerView: 3,
          spaceBetween: 20
      }
  }
});