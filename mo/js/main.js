(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

/** main.js ******************************************************************************************************* */
;
($, function (_) {
  window.KurlyNextmile.Main = function () {
    var documentH = document.documentElement.clientHeight;
    var $main = $('.main');
    var $countNum = $main.find('.count-num');
    var $slide = $main.find('.main_slide');
    var $ani = $main.find('.ani');
    var $banner = $('.slide_top');
    var isCountAni = false;
    var _this = {
      countAnimate: function countAnimate() {
        $countNum.each(function (idx, el) {
          $(el).removeClass('small mid big');
          var num = $(el).data('count').toString();
          var size = '';
          if (idx === 0) {} else {
            if (num.length === 1) {
              size = 'xsmall';
            } else if (num.length === 2) {
              size = 'small';
            } else if (num.length === 3) {
              size = 'mid';
            } else if (num.length > 3) {
              size = 'big';
            }
          }
          $(el).addClass(size);
          $.increaseNumber($(el), {
            start: 0,
            end: Number($(el).data('count')),
            duration: 2500 + 500 * idx,
            decimal: idx === 0 ? 1 : 0
          }).on('complete', function () {});
        });
      }
    };
    var _eventHandler = {
      scroll: function scroll(e) {
        $ani.each(function (idx, el) {
          if (el.getBoundingClientRect) {
            var clientRect = el.getBoundingClientRect();
            if (documentH > clientRect.top + clientRect.height / 2) {
              if (idx === 0) {
                if (!isCountAni) {
                  isCountAni = true;
                  _this.countAnimate();
                }
              } else if (idx === 1) {
                if (el.className.indexOf('show') < 0) {
                  el.classList.add('show');
                  $(window).off('scroll', _eventHandler.scroll);
                }
              }
            }
          }
        });
      }
    };

    // WOW
    new WOW().init();

    // scroll
    $(window).on('scroll', _eventHandler.scroll).trigger('scroll');

    // slide
    $slide.slick({
      dots: false,
      infinite: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      centerMode: true,
      centerPadding: '70px'
    });

    //banner
    if ($banner.length > 0) {
      $banner.slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        arrows: false
      });
    }
    return _this;
  };
})(window.jQuery, window._);
/** ***************************************************************************************************************** */

},{}]},{},[1]);
