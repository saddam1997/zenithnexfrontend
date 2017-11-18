
var LunoAuth = (function () {
    function LunoAuth() {
    }
    LunoAuth.auth = function () {
        if (!LunoAuth.fetched) {
            LunoAuth.fetch();
        }
        return LunoAuth.deferred;
    };
    LunoAuth.fetch = function () {
        LunoAuth.fetched = true;
        var r = $.get("/ajax/1/init");
        r.done(function (d) { return LunoAuth.deferred.resolve(d.userInfo || d.user_info); });
        r.fail(function (xhr) { return LunoAuth.deferred.reject(xhr.status); });
    };
    LunoAuth.registerHandlers = function () {
        LunoAuth.deferred.then(function (userInfo) {
            $(".auth").removeClass("auth");
            if (+userInfo.user_id > 0) {
                $(".auth-loggedin").removeClass("auth-loggedin");
                $(".auth-given_name").text(userInfo.given_name);
                $(".auth-email").text(userInfo.email);
                if (userInfo.is_blocked) {
                    $(".auth-is_blocked").removeClass("auth-is_blocked");
                }
                else {
                    $(".auth-is_blocked").remove();
                }
                if (userInfo.oath_enabled) {
                    $(".auth-oath_enabled").removeClass("auth-oath_enabled");
                }
                else {
                    $(".auth-oath_enabled").remove();
                }
                $(".auth-loggedout").remove();
            }
            else {
                $(".auth-loggedout").removeClass("auth-loggedout");
                $(".auth-loggedin").remove();
            }
        });
        LunoAuth.deferred.then(function (userInfo) {
            if (+userInfo.user_id > 0 && ga) {
                ga("set", "userId", userInfo.user_id);
            }
        });
    };
    LunoAuth.fetched = false;
    LunoAuth.deferred = $.Deferred();
    return LunoAuth;
}());
LunoAuth.registerHandlers();
function getCarouselScreenWidths() {
    "use strict";
    return {
        "desktopWidth": 1199,
        "desktopSmallWidth": 979,
        "tabletWidth": 768,
        "mobileWidth": 479
    };
}
var LunoColors = {
    bluePrimary: "#0091FF",
    blueSecondary: "#12326B",
    purple: "#7E57C2",
    green: "#8BC34A",
    orange: "#FF5722",
    red: "#D50000",
    yellow: "#f6d750",
    grey900: "#212121",
    grey600: "#757575",
    grey500: "#9E9E9E",
    grey400: "#bdbdbd",
    grey300: "#E0E0E0",
    greyBackground: "#F2F2F2",
    white: "#ffffff",
    lightBluePrimary: "#0AA1FF"
};
function initFooter() {
    "use strict";
    $(".ln-footer-links").matchHeight();
    $("#cookie-warning .gotit").click(function (e) {
        e.preventDefault();
        $("#cookie-warning").remove();
        $.cookie("accepted_cookies", "1", { "expires": 365, "path": "/" });
    });
}
$.fn.lightbox = function (imageMsg, closeMsg) {
    "use strict";
    function buildLightbox() {
        var $lightbox = $("<div class=\"lightbox\">" +
            "<div class=\"lightbox-backdrop\"></div>" +
            "<span class=\"lightbox-info\"></span>" +
            "<img class=\"lightbox-image\">" +
            ("<a href=\"\" class=\"lightbox-close\">" + closeMsg + "</a>") +
            "</div>");
        $("body").append($lightbox);
        $lightbox.hide();
        return $lightbox;
    }
    var images = [];
    var index = 0;
    var open = false;
    var $lightbox = buildLightbox();
    var $backdrop = $lightbox.find(".lightbox-backdrop");
    var $info = $lightbox.find(".lightbox-info");
    var $img = $lightbox.find(".lightbox-image");
    var $close = $lightbox.find(".lightbox-close");
    function hide() {
        $lightbox.hide();
        open = false;
    }
    function prev() {
        index--;
        if (index < 0) {
            index = images.length - 1;
        }
        show();
    }
    function next() {
        index = (index + 1) % images.length;
        show();
    }
    var naturalWidth;
    var naturalHeight;
    function show() {
        $lightbox.show();
        open = true;
        $img.attr("src", images[index].attr("src"));
        $img.attr("srcset", images[index].attr("srcset"));
        $info.text(imageMsg + " " + (index + 1) + "/" + images.length);
        var img = new Image();
        img.src = images[index].attr("src");
        naturalWidth = img.naturalWidth;
        naturalHeight = img.naturalHeight;
        resize();
    }
    function resize() {
        var width = $(window).width() - 30;
        var height = $(window).height() - 100;
        width = Math.min(width, naturalWidth);
        height = Math.min(height, naturalHeight);
        if (naturalWidth / naturalHeight > width / height) {
            $img.width(width);
            $img.height(width / naturalWidth * naturalHeight);
        }
        else {
            $img.height(height);
            $img.width(height / naturalHeight * naturalWidth);
        }
    }
    $backdrop.click(function (e) {
        e.preventDefault();
        hide();
    });
    $close.click(function (e) {
        e.preventDefault();
        hide();
    });
    $img.click(function (e) {
        e.preventDefault();
        next();
    });
    $(window).on("keypress", function (e) {
        if (!open) {
            return;
        }
        e.preventDefault();
        if (e.keyCode == 32) {
            next();
        }
    });
    $(window).on("keyup", function (e) {
        if (!open) {
            return;
        }
        e.preventDefault();
        if (e.keyCode == 27) {
            hide();
        }
        else if (e.keyCode == 37) {
            prev();
        }
        else if (e.keyCode == 39) {
            next();
        }
    });
    $(window).on("resize", function () {
        if (!open) {
            return;
        }
        resize();
    });
    this.each(function () {
        var $img = $(this);
        var n = images.length;
        $img.click(function (e) {
            e.preventDefault();
            index = n;
            show();
        });
        images.push($img);
    });
    return this;
};
function initEasySteps() {
    "use strict";
    var widths = getCarouselScreenWidths();
    function carouselSetActiveItem(elem, num) {
        var visibleItems = elem.data("owlCarousel").owl.visibleItems;
        var found = false;
        for (var i in visibleItems) {
            if (num === visibleItems[i]) {
                found = true;
                break;
            }
        }
        if (found === false) {
            if (num > visibleItems[visibleItems.length - 1]) {
                elem.trigger("owl.goTo", num - visibleItems.length + 2);
            }
            else {
                if (num - 1 === -1) {
                    num = 0;
                }
                elem.trigger("owl.goTo", num);
            }
        }
        else if (num === visibleItems[visibleItems.length - 1]) {
            elem.trigger("owl.goTo", visibleItems[1]);
        }
        else if (num === visibleItems[0]) {
            elem.trigger("owl.goTo", num - 1);
        }
    }
    function syncCarousels(fromElem, toElem) {
        var carousel = fromElem.data("owlCarousel");
        if (!carousel) {
            return;
        }
        var current = carousel.currentItem;
        toElem
            .find(".owl-item")
            .removeClass("synced")
            .eq(current)
            .addClass("synced");
        if (toElem.data("owlCarousel") !== undefined) {
            carouselSetActiveItem(toElem, current);
        }
    }
    function initStepsCarousel(el) {
        var steps1 = el.find(".steps1");
        var steps2 = el.find(".steps2");
        var itemCount = el.find(".item").length;
        steps1.owlCarousel({
            singleItem: true,
            transitionStyle: "fadeIn",
            slideSpeed: 2000,
            navigation: false,
            pagination: false,
            autoPlay: true,
            afterAction: function () {
                syncCarousels(steps1, steps2);
            },
            responsiveRefreshRate: 200
        });
        steps2.owlCarousel({
            items: itemCount,
            loop: true,
            itemsDesktop: [widths.desktopWidth, itemCount],
            itemsDesktopSmall: [widths.desktopSmallWidth, itemCount],
            itemsTablet: [widths.tabletWidth, itemCount],
            itemsMobile: [widths.mobileWidth, itemCount],
            pagination: false,
            responsiveRefreshRate: 100,
            afterInit: function (el) {
                el.find(".owl-item").eq(0).addClass("synced");
            }
        });
        steps2.on("click", ".owl-item", function (e) {
            e.preventDefault();
            var num = $(this).data("owlItem");
            steps1.trigger("owl.goTo", num);
        });
    }
    $(function () {
        $(".easy-steps").each(function () {
            initStepsCarousel($(this));
        });
    });
}
function initNavScroll() {
    "use strict";
    $(document).on("scroll", function () {
        if ($(document).scrollTop() > 30) {
            $(".ln-navbar").addClass("ln-nav-collapse");        }
        else {
            $(".ln-navbar").removeClass("ln-nav-collapse");
        }
    });
    $(function () {
        var r = $.get("/ajax/1/display_ticker");
        r.done(function (data) {
            $(".btc-price").text(data.btc_price);
        });
        if ("orientation" in window &&
            navigator.userAgent.toLowerCase().indexOf("chrome") > -1) {
            $(".ln-h-100").height($(window).innerHeight()).removeClass("ln-h-100");
        }
    });
}
function initPageBanner() {
    "use strict";
    if (document.location.href.indexOf("bitx=true") >= 0) {
        $(".page-banner").show();
        $("body").addClass("has-page-banner");
    }
}
function initSideNav() {
    "use strict";
    var Menu = function () {
        function extend(a, b) {
            for (var key in b) {
                if (b.hasOwnProperty(key)) {
                    a[key] = b[key];
                }
            }
            return a;
        }
        function each(collection, callback) {
            for (var i = 0; i < collection.length; i++) {
                var item = collection[i];
                callback(item);
            }
        }
        function Menu(options) {
            this.options = extend({}, this.options);
            extend(this.options, options);
            this._init();
        }
        Menu.prototype.options = {
            wrapper: "#o-wrapper",
            type: "slide-left",
            menuOpenerClass: ".sidenav-button",
            maskId: "#sidenav-mask"
        };
        Menu.prototype._init = function () {
            this.body = document.body;
            this.wrapper = document.querySelector(this.options.wrapper);
            this.mask = document.querySelector(this.options.maskId);
            this.menu = document.querySelector("#sidenav-menu--" + this.options.type);
            this.closeBtn = this.menu.querySelector(".sidenav-menu__close");
            this.menuOpeners = document.querySelectorAll(this.options.menuOpenerClass);
            this._initEvents();
        };
        Menu.prototype._initEvents = function () {
            this.closeBtn.addEventListener("click", function (e) {
                e.preventDefault();
                this.close();
            }.bind(this));
            this.mask.addEventListener("click", function (e) {
                e.preventDefault();
                this.close();
            }.bind(this));
        };
        Menu.prototype.open = function () {
            this.body.classList.add("has-active-menu");
            this.wrapper.classList.add("has-" + this.options.type);
            this.menu.classList.add("is-active");
            this.mask.classList.add("is-active");
            this.disableMenuOpeners();
        };
        Menu.prototype.close = function () {
            this.body.classList.remove("has-active-menu");
            this.wrapper.classList.remove("has-" + this.options.type);
            this.menu.classList.remove("is-active");
            this.mask.classList.remove("is-active");
            this.enableMenuOpeners();
        };
        Menu.prototype.disableMenuOpeners = function () {
            each(this.menuOpeners, function (item) {
                item.disabled = true;
            });
        };
        Menu.prototype.enableMenuOpeners = function () {
            each(this.menuOpeners, function (item) {
                item.disabled = false;
            });
        };
        return Menu;
    }();
    var slideLeft = new Menu({
        wrapper: "#o-wrapper",
        type: "slide-left",
        menuOpenerClass: "sidenav-button",
        maskId: "#sidenav-mask"
    });
    var slideLeftBtn = document.querySelector("#sidenav-button--slide-left");
    slideLeftBtn.addEventListener("click", function (e) {
        e.preventDefault;
        slideLeft.open();
    });
}

