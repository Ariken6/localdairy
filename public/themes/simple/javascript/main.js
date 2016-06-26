/**
 * Created by JJ on 22/02/2015.
 */
(function ($) {
    $.entwine('lcd', function ($) {
        /**
         * ajax navigation
         */
        window.addEventListener('popstate', function (e) {
            var url = '/'
            if (e.state) {
                url = e.state.path;
            }
            $('.ajax-link').loadPage(url);
        });

        window.addEventListener('resize', function () {
            $('#current-selector').selectCurrent();
        });

        $.fn.loadPage = function (url) {
            if (!url || url == '/') {
                url = '/home/'
            }
            var container = $('.main .inner');
            $.get(url + 'ajaxlink', function (data) {
                if (data) {
                    container.fadeOut(200, function () {
                        container.html(data);
                        container.fadeIn(200);
                    });
                }
            });

            var current = $('nav.primary li.current');
            $.get(url + 'ajaxnav', function (data) {
                if (data) {
                    var target = $(data).find('.current');
                    if (target.length && target !== current) {
                        var id = target.attr('class').split(' ')[0];
                        var newCurrent = $('nav.primary').find('.' + id);
                        if (newCurrent.length) {
                            current.removeClass('current');
                            newCurrent.addClass('current');
                            $('#current-selector').finish().animate({left: newCurrent.offset().left}, 800, 'easeInOutCubic');
                        }
                    }
                }
            });
        }

        $('.ajax-link').entwine({
            onclick: function (e) {
                e.preventDefault();
                var url = this.attr('href');
                if (url !== window.location.pathname) {
                    this.loadPage(url);
                    history.pushState({path: url}, null, url);
                }
            }
        });

        /**
         * navigation
         */
        $('#current-selector').entwine({
            onadd: function () {
                this.selectCurrent();
                this._super();
            },
            selectCurrent: function () {
                var current = $('nav.primary li.current');
                if (current) {
                    this.width(current.width());
                    this.height(current.height());
                    this.finish().offset({left: current.offset().left});
                }
            }
        });

        /**
         * homepage carousel
         */
        $('.jcarousel').entwine({
            onadd: function () {
                this.jcarousel({
                    wrap: 'circular'
                });
                this._super();
            }
        });
        $('.jcarousel .jcarousel-control').entwine({
            onclick: function () {
                var carousel = this.closest('.jcarousel');
                if (this.hasClass('prev')) {
                    carousel.jcarousel('scroll', '-=1');
                }
                if (this.hasClass('next')) {
                    carousel.jcarousel('scroll', '+=1');
                }
            }
        });

        /**
         * menupage photos
         */
        $('.product-list .dish .wrapper').entwine({
            locked: false,
            onmouseenter: function () {
                var self = this;
                var displacement = '-25';
                if (this.hasClass('cover')) {
                    displacement = '+25';
                }
                if (!this.getlocked()) {
                    this.stop(true).animate({top: (displacement) + 'px'}, 500, 'easeInCubic', function () {
                        self.resetTop();
                        self.addClass('top');
                    });
                }
                this._super();
            },
            onmouseleave: function () {
                if (!this.getlocked()) {
                    this.stop(true).animate({
                        top: (0) + 'px',
                        left: (0) + 'px'
                    }, 500, 'easeOutCubic');
                }
            },
            onclick: function (e) {
                e.preventDefault();
                this.finish();
                var self = this;
                var top = self.offset().top;
                var left = self.offset().left;
                var centerTop = ($(window).height() / 2) - top;
                var centerLeft = ($(window).width() / 2) - left;
                var moveDown = self.hasClass('cover') ? 300 : 350;

                if (!this.getlocked()) {
                    this.setlocked(true);
                    $('#overlay').show();
                    var url = this.attr('href');
                    $.get(url, function (data) {
                        self.addClass('pop');
                        self.children().hide();

                        self.animate({
                            top: centerTop - moveDown,
                            left: centerLeft - 400,
                            height: 600,
                            width: 400
                        }, 200, 'easeOutCubic', function () {
                            self.append('<div id="popup"></div>');
                            $('#popup').animate({
                                marginLeft: 400,
                                opacity: 0.8
                            }, 800, 'easeInOutCubic').html(data);
                        });
                    });
                }
                else {
                    $('#popup').animate({
                        marginLeft: 0,
                        opacity: 0
                    }, 800, 'easeOutCubic', function () {
                        this.remove();
                        self.removeClass('pop');
                        self.animate({
                            top: -centerTop + moveDown,
                            left: -centerLeft + 400,
                            height: 240,
                            width: 300
                        }, 200, 'easeOutCubic', function () {
                            self.children().show();
                            $('#overlay').hide();
                            self.setlocked(false);
                            self.trigger('mouseleave');
                        });
                    });
                }
                this._super();
            },
            resetTop: function () {
                var dish = this.closest('.dish');
                dish.find('.wrapper').each(function () {
                    $(this).removeClass('top');
                });
            }
        });
        $('#popup').entwine({
            onclick: function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();
            }
        });
        $('.popup-close').entwine({
            onclick: function () {
                this.closest('.product-list .dish .wrapper').trigger('click');
            }
        });
    });
})(jQuery);