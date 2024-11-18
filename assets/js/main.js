/***************************************************
==================== JS INDEX ======================
 * ***************************************************
01. Toggle For Footer
02. Section Slider
03. Recent Blog Slider
04. Find Area Title 
05. Notification Count
06. Mobile Menu
07. Search Bar
08. Magnific PopUp
09. Blog Inner Section Slider

 ****************************************************/
(function ($) {
  ('use strict');

  let arrowLeftSVG = `<span class="boo-slider-arrow-left"><svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.12 18.296a.426.426 0 0 0 0-.6L1.445 10.02a1 1 0 0 1-.215-.32h20.345a.425.425 0 1 0 0-.85H1.225c.05-.115.12-.225.215-.32L9.115.856a.426.426 0 0 0 0-.6.426.426 0 0 0-.6 0L.84 7.93a1.91 1.91 0 0 0 0 2.7l7.675 7.675a.426.426 0 0 0 .6 0" fill="#E2DAD6"/></svg></span>`;
  let arrowRightSVG = `<span class="boo-slider-arrow-right"><svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.88.626a.426.426 0 0 0 0 .6L20.555 8.9c.095.095.165.205.215.32H.425a.425.425 0 1 0 0 .85h20.35a1 1 0 0 1-.215.32l-7.675 7.675a.426.426 0 0 0 0 .6.426.426 0 0 0 .6 0l7.675-7.675a1.91 1.91 0 0 0 0-2.7L13.485.616a.426.426 0 0 0-.6 0" fill="#E2DAD6"/></svg></span>`;

  let windowWidth = window.innerWidth;

  // 01. Toggle For Footer
  function initializeFooterToggle() {
    $('.boo-footer-widget-title').off('click');

    if (windowWidth < 767) {
      const titles = $('.boo-footer-widget-title');
      const menuContainers = $('.footer-top-area-widget');

      if (titles.length && menuContainers.length) {
        titles.each(function (index) {
          $(this).on('click', function () {
            menuContainers.eq(index).toggleClass('menu-toggle-active');
          });
        });
      }
      $(
        '.footer-top-bottom-area-wrapper .footer-top-bottom-single-area:nth-child(1) .boo-footer-widget-title'
      ).click();
    } else {
      $('.footer-top-area-widget').removeClass('menu-toggle-active');
    }
  }
  // 02. Section Slider
  function booSliderSection() {
    if (windowWidth < 1200) {
      $('.boo-slider-section').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
        dots: true,
        arrows: true,
        infinite: false,
        lazyLoad: 'ondemand',
        prevArrow: arrowLeftSVG,
        nextArrow: arrowRightSVG,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2.1
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1.3
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1.1
            }
          }
        ]
      });
    }
  }
  // 03. Recent Blog Slider
  function recentBlogSlider() {
    $('.recent-blog-loop .elementor-loop-container').slick({
      slidesToShow: 3.34,
      slidesToScroll: 3,
      autoplay: false,
      autoplaySpeed: 2000,
      dots: true,
      arrows: true,
      infinite: false,
      lazyLoad: 'ondemand',
      prevArrow: arrowLeftSVG,
      nextArrow: arrowRightSVG,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2.1,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1.3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1.1,
            slidesToScroll: 2,
            infinite: false
          }
        }
      ]
    });
    $(
      '.recent-blog-loop .elementor-widget-container .elementor-loop-container .slick-list .slick-track .slick-slide:has(style)'
    ).hide();
  }
  // 04. Find Area Title
  function findAreaTitle() {
    $('.find-area-wrapper h5').on('click', function () {
      $(this).closest('.single-find-area').find('.icon-lists-wrapper').toggle();
      $(this).toggleClass('boo-find-active-icons');
    });
    if (windowWidth < 1024) {
      $('.find-area-wrapper .icon-lists-wrapper').hide();
      $('.find-area-wrapper .single-find-area:nth-child(1) h5').click();
    }
  }

  // 05. Notification Count
  function booTopbarNotificationCount() {
    var $notificationWrapper = $(
      '.menu-topbar-menu-right-container .boo-top-bar-right-notification a'
    );

    if ($notificationWrapper.length && booNotificationData.count) {
      var $countSpan = $('<span></span>')
        .addClass('notification-count')
        .text(booNotificationData.count);

      $notificationWrapper.append($countSpan);
    } else {
    }
  }

  // 06. Mobile Menu
  function booMobileMenu() {
    $('.boo-hamburger-menu').on('click', function () {
      $(this).toggleClass('boo-hamburger-menu-active');
      $('.boo-mobile-menu-wrapper').toggleClass('boo-menu-active');
      $('body').toggleClass('menu-open');
    });
    if ($(window).width() < 980) {
      $('.main-menu-wrapper li.menu-item-has-children > .boo-mega-sub-menu li')
        .addClass('back-menu-item')
        .find('a')
        .addClass('go-back')
        .attr('href', 'javascript:void(0)');

      $('.main-menu-wrapper li.menu-item-has-children').on(
        'click',
        function () {
          $(this).children('.boo-mega-sub-menu').show();
          $(this).children('.boo-mega-sub-menu').addClass('sub-menu-active');
        }
      );
      $('body').on('click', '.back-menu-item', function () {
        $(this).parent().hide();
        $(this).parent().removeClass('sub-menu-active');
      });
    }
  }

  // 07. Search Bar
  function searchBar() {
    $('.top-bar-search-icon').on('click', function () {
      $('.boo-search-bar-area-wrapper').addClass('search-opened');
      $('body').addClass('menu-open');
    });

    $('.search-close-btn').on('click', function () {
      $('.boo-search-bar-area-wrapper').removeClass('search-opened');
      $('body').removeClass('menu-open');
    });
  }

  // 08. magnific popup
  function magnificpopup() {
    $('.boo-video-play-btn').magnificPopup({
      type: 'iframe',
      iframe: {
        patterns: {
          youtube: {
            index: 'youtube.com/',
            id: 'v=',
            src: 'https://www.youtube.com/embed/%id%?autoplay=1&rel=0'
          },
          vimeo: {
            index: 'vimeo.com/',
            id: '/',
            src: 'https://player.vimeo.com/video/%id%?autoplay=1&title=0&byline=0&portrait=0'
          }
        }
      }
    });
  }

  // 09. Blog Inner Section Slider
  function booBlogSectionSlider() {
    if (windowWidth <= 767) {
      $('#boo-posts-inner-section').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
        dots: true,
        arrows: false,
        infinite: false,
        lazyLoad: 'ondemand'
      });
    }
  }

  $(document).ready(function () {
    initializeFooterToggle();
    booSliderSection();
    recentBlogSlider();
    findAreaTitle();
    booTopbarNotificationCount();
    booMobileMenu();
    searchBar();
    magnificpopup();
    booBlogSectionSlider();
  });
})(jQuery);
