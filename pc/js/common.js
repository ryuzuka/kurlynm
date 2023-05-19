(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

/** common.js ******************************************************************************************************* */
;
(function ($, _, $moment) {
  var Header = function Header() {
    var $document = $(document);
    var $header = $('header.header');
    var $loginMenu = $header.find('.login-menu');
    var isLoginMenu = -1;
    var _this = {
      loginMenu: {
        show: function show() {
          isLoginMenu = 1;
          $loginMenu.show();
          setTimeout(function () {
            return $document.on('click', hideLoginMenu);
          }, 1);
        },
        hide: function hide() {
          isLoginMenu = -1;
          $loginMenu.hide();
          $document.off('click', hideLoginMenu);
        }
      }
    };
    $header.on('mouseleave', function (e) {
      if (isLoginMenu === 1) {
        _this.loginMenu.hide();
      }
    });
    $header.find('.login.active').on('click mouseenter', function (e) {
      e.preventDefault();
      if (isLoginMenu === -1) {
        _this.loginMenu.show();
      } else if (isLoginMenu === 1 && e.type === 'click') {
        _this.loginMenu.hide();
      }
    });
    function hideLoginMenu(e) {
      if (e.type === 'click') {
        if ($(e.target).closest('.login-menu').length < 1) {
          _this.loginMenu.hide();
        }
      }
    }
    return _this;
  };
  var Footer = function Footer() {
    var _this = {};
    return _this;
  };
  var components = function () {
    return {
      searchForm: function searchForm() {
        $('.estimate-form').each(function () {
          var $searchForm = $(this);
          var $period = $searchForm.find('.input-group');
          var $calendar = $searchForm.find('.calendar');
          var _today = new Date();
          var _date = {
            from: $.utils.urlParam('start_date') || '',
            to: $.utils.urlParam('end_date') || ''
          };
          var _prevDate = {
            from: '',
            to: ''
          };
          var _period = 'all';
          var _this = {
            set: function set(calendar, date) {
              _date[calendar] = $moment(date).format(window.KurlyNextmile.DATE_FORMAT);
              $searchForm.find('.' + calendar).calendar('set', _date[calendar]);
            },
            all: function all() {
              _date.from = '';
              _date.to = '';
              $calendar.find('input').val('').attr('value', '');
            },
            check: function check(from, to) {
              from = parseInt($moment(from).format('YYYYMMDD'));
              to = parseInt($moment(to).format('YYYYMMDD'));
              return from <= to ? true : false;
            },
            error: function error(closeFunc) {
              $('#pop-invalid-date').modal({}, function (e) {
                if (e.type === 'close') {
                  closeFunc();
                }
              });
            },
            trigger: function trigger() {
              $searchForm.triggerHandler({
                type: 'change-calendar',
                date: _date,
                period: _period
              });
            }
          };

          // 기간
          $period.on('change-input', function (e) {
            _period = e.value === 'all' ? 'all' : parseInt(e.value);
            if (e.value === 'all') {
              _this.all();
            } else {
              _this.set('to', _today);
              _this.set('from', $moment(_today).add(-1 * _period, 'months'));
            }
            _this.trigger();
          });

          // calendar
          $searchForm.find('.from, .to').calendar('clear').calendar().on('select', function (e) {
            _period = '';
            $period.find('input').prop('checked', false).attr('checked', false);
            _.extend(_prevDate, JSON.parse(JSON.stringify(_date)));
            $(e.target).hasClass('from') ? _date.from = e.date : _date.to = e.date;
            if (_date.from !== '' && _date.to !== '') {
              if (_this.check(_date.from, _date.to)) {
                _this.trigger();
              } else {
                _this.error(function () {
                  _this.set('from', $moment(_prevDate.from));
                  _this.set('to', $moment(_prevDate.to));
                });
              }
            }
          });

          // reset
          $searchForm.find('.reset').on('click', function (e) {
            e.preventDefault();
            $period.input('checked', 0);
          });

          // init
          setTimeout(function () {
            if (_date.from && _date.to) {
              _this.set('from', _date.from);
              _this.set('to', _date.to);
            } else {
              $period.input('checked', 0);
            }
          }, 1);
        });
      },
      transportList: function transportList() {
        $('.transport-list').each(function () {
          var $transport = $(this);
          var $list = $transport.find('.area');
          var _this = {
            add: function add(idx, isDelete) {
              $list.eq(isDelete ? idx - 1 : idx).find('.btn-add').attr('disabled', !isDelete);
              $list.eq(!isDelete ? idx + 1 : idx)[!isDelete ? 'show' : 'hide']();
            }
          };
          $list.on('click', '.btn-add, .btn-add.delete', function (e) {
            var $btn = $(e.target);
            _this.add($btn.closest('.area').index(), $btn.hasClass('delete'));
          });
        });
      },
      selectDate: function selectDate() {
        $('.select-date').each(function () {
          var $selectDate = $(this);
          var $year = $selectDate.find('.year.dropdown');
          var $month = $selectDate.find('.month.dropdown');
          var $date = $selectDate.find('.date.dropdown');
          var $input = $selectDate.find('input#release_date');
          var _today = $moment(new Date());
          var _date = {};
          var _this = {
            numberFormat: function numberFormat(num) {
              if (num) return (num.toString().length < 2 ? '0' : '') + num;
            },
            year: function year(_year) {
              var html = '';
              for (var i = 0; i < 2; ++i) {
                html += "<li role=\"option\" aria-selected=\"false\"><button type=\"button\" data-value=\"".concat(_year + i, "\">").concat(_year + i, "\uB144</button></li>");
              }
              $year.dropdown('clear').find('.dropdown-list').html(html);
              $year.dropdown({
                activeIndex: 0
              });
            },
            month: function month(_month2, date) {
              $month.dropdown('clear').dropdown({
                activeIndex: _month2 - 1
              });
              this.date(_month2, date);
            },
            date: function date(month, _date2) {
              month = _this.numberFormat(month);
              _date2 = _this.numberFormat(_date2);
              var selectedDate = _date.year + month + _date2;
              var html = '';
              var days = $moment(selectedDate).daysInMonth();
              for (var i = 1; i <= days; ++i) {
                html += "<li role=\"option\" aria-selected=\"false\"><button type=\"button\" data-value=\"".concat(i, "\">").concat(i, "\uC77C</button></li>");
              }
              $date.dropdown('clear').find('.dropdown-list').html('');
              $date.find('.dropdown-list').html(html);
              $date.dropdown({
                activeIndex: parseInt(_date2) - 1
              });
            },
            trigger: function trigger() {
              var date = $moment(_date.year + _this.numberFormat(_date.month) + _this.numberFormat(_date.date)).format(window.KurlyNextmile.DATE_FORMAT);
              $input.val(date).attr('value', date);
              $selectDate.triggerHandler({
                type: 'change',
                date: _date,
                dateFormat: date
              });
            }
          };
          $selectDate.find('.year, .month, .date').on('change', function (e) {
            var dateFormat = e.target.classList[0];
            _date[dateFormat] = e.value;
            if (dateFormat === 'month') {
              _this.date(e.value, 1);
            } else {
              _this.trigger();
            }
          });
          _this.year(_today.year());
          _this.month(_today.month() + 1, _today.date());
          setTimeout(_this.trigger, 1);
        });
      },
      selectMonth: function selectMonth() {
        $('.month-group').each(function () {
          var $selectMonth = $(this);
          var $month = $selectMonth.find('.dropdown');
          var _type = $selectMonth.data('type');
          var _month = $moment(new Date()).month() + 1;
          $month.each(function (index, el) {
            var $dropdown = $(el);
            var month = _month + (index - 2) > 12 ? _month + (index - 2) - 12 : _month + (index - 2);
            $selectMonth.find('input#' + _type + '_month' + (index + 1)).val(month).attr('value', month);
            $dropdown.dropdown('clear').dropdown({
              'activeIndex': month - 1
            }).on('change', function (e) {
              var input = 'input#' + _type + '_month' + (index + 1);
              $selectMonth.find(input).val(e.value).attr('value', e.value);
            });
          });
        });
      },
      selectTime: function selectTime() {
        $('.select-time').each(function () {
          var $selectDate = $(this);
          var _type = $selectDate.data('type');
          var $input = $selectDate.find('input#' + _type + '_time');
          var _time = {
            hour: 0,
            minute: 0
          };
          var _this = {
            numberFormat: function numberFormat(num) {
              return (String(num).toString().length < 2 ? '0' : '') + num + '';
            },
            trigger: function trigger() {
              var time = _this.numberFormat(_time.hour) + ':' + _this.numberFormat(_time.minute);
              $input.val(time).attr('value', time);
              $selectDate.triggerHandler({
                type: 'change',
                hour: _time.hour,
                minute: _time.minute,
                time: _time,
                timeFormat: time
              });
            }
          };
          $selectDate.find('.dropdown').on('change', function (e) {
            _time[e.target.classList[0]] = e.value;
            _this.trigger();
          });
          setTimeout(_this.trigger, 1);
        });
      }
    };
  }();
  $(function () {
    window.KurlyNextmile.Header = Header();
    window.KurlyNextmile.Footer = Footer();
    for (var component in components) {
      components[component]();
    }
  });
})(window.jQuery, window._, window.moment);
/** ***************************************************************************************************************** */

},{}]},{},[1]);
