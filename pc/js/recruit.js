(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

/** recruit.js ******************************************************************************************************* */
;
(function ($) {
  // before unload
  window.onbeforeunload = function () {
    return window.scrollTo(0, 0);
  };
  window.KurlyNextmile.Recruit = function () {
    var $slide = $('.recruit_slide');
    var scrollY = 0;
    var scrollZone = 'top';
    var isScroll = false;
    var wheelDir = null;
    var slideIndex = -1;
    var scrollPoint = [parseInt($('.recruit-section').offset().top), parseInt($('.recruit_slide').offset().top), parseInt($('.welfare').offset().top), parseInt($('.step').offset().top)];
    var _this = {
      onWheel: function onWheel(isOn) {
        $(window).off('wheel')[isOn ? 'on' : 'off']('wheel', eventHandler.wheel);
      },
      onScroll: function onScroll(isOn) {
        $(window).off('scroll')[isOn ? 'on' : 'off']('scroll', eventHandler.scroll);
      },
      onSlideMouseDown: function onSlideMouseDown(isOn) {
        $slide.find('.slick-slide')[isOn ? 'on' : 'off']('mousedown', eventHandler.mousedown);
      },
      lockScroll: function lockScroll(isLock) {
        $.preventScroll(isLock);
        $.blockBodyScroll(isLock);
        if (isLock) {
          _this.onScroll(false);
          _this.scroll(scrollPoint[0], function () {
            return _this.onWheel(true);
          });
        } else {
          _this.onWheel(false);
          setTimeout(function () {
            return _this.onScroll(true);
          }, 1);
        }
        slideIndex = -1;
        _this.active(slideIndex);
      },
      scroll: function scroll(scrollY, completeFunc) {
        $('html, body').stop().animate({
          scrollTop: scrollY
        }, 500, completeFunc);
      },
      active: function active(idx) {
        $slide.find('.slick-slide').each(function (index, el) {
          $(el)[idx === index ? 'addClass' : 'removeClass']('active');
        });
      }
    };
    var eventHandler = {
      scroll: function scroll(e) {
        wheelDir = scrollY < e.currentTarget.scrollY ? 1 : -1;
        scrollY = e.currentTarget.scrollY;
        if (scrollZone === 'top' && wheelDir === 1) {
          if (scrollY > scrollPoint[0]) {
            _this.lockScroll(true);
            _this.active(slideIndex);
            slideIndex = 0;
          }
        }
      },
      wheel: function wheel(e) {
        if (e.originalEvent.deltaY < 0) {
          /** up */
          if (slideIndex < 1) {
            scrollZone = 'top';
            _this.lockScroll(false);
          } else {
            slideIndex--;
            slide.slick('slickGoTo', slideIndex);
            _this.active(slideIndex);
          }
        } else {
          /** down */
          if (slideIndex < 2) {
            slideIndex++;
            slide.slick('slickGoTo', slideIndex);
            _this.active(slideIndex);
          } else {
            isScroll = true;
            scrollZone = 'bottom';
            _this.lockScroll(false);
            _this.onSlideMouseDown(false);
            setTimeout(function () {
              return _this.onScroll(false);
            }, 1);
          }
        }
      },
      mousedown: function mousedown(e) {
        e.stopPropagation();
      }
    };
    _this.onScroll(true);
    var slide = $slide.slick({
      infinite: false,
      arrows: false,
      draggable: true,
      dots: true
    }).on('beforeChange afterChange', function (e) {
      if (isScroll) return;
      if (e.type === 'beforeChange') {
        _this.onWheel(false);
      } else if (e.type === 'afterChange') {
        slideIndex = e.target.slick.currentSlide;
        setTimeout(function () {
          return _this.onWheel(true);
        }, 500);
      }
    });
    _this.onSlideMouseDown(true);
    return _this;
  };
})(window.jQuery);
/** ***************************************************************************************************************** */

},{}]},{},[1]);
