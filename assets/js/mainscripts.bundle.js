function skinChanger() {
    $(".right-sidebar .demo-choose-skin li").on("click", function() {
        var a = $("body"),
            b = $(this),
            c = $(".right-sidebar .demo-choose-skin li.active").data("theme");
        $(".right-sidebar .demo-choose-skin li").removeClass("active"), a.removeClass("theme-" + c), b.addClass("active"), a.addClass("theme-" + b.data("theme"))
    })
}

function setSkinListHeightAndScroll() {
    var a = $(window).height() - ($(".navbar").innerHeight() + $(".right-sidebar .nav-tabs").outerHeight()),
        b = $(".demo-choose-skin");
    b.slimScroll({
        destroy: !0
    }).height("auto"), b.parent().find(".slimScrollBar, .slimScrollRail").remove(), b.slimscroll({
        height: a + "px",
        color: "rgba(0,0,0,0.5)",
        size: "4px",
        alwaysVisible: !1,
        borderRadius: "0",
        railBorderRadius: "0"
    })
}

function setSettingListHeightAndScroll() {
    var a = $(window).height() - ($(".navbar").innerHeight() + $(".right-sidebar .nav-tabs").outerHeight()),
        b = $(".right-sidebar .demo-settings");
    b.slimScroll({
        destroy: !0
    }).height("auto"), b.parent().find(".slimScrollBar, .slimScrollRail").remove(), b.slimscroll({
        height: a + "px",
        color: "rgba(0,0,0,0.5)",
        size: "4px",
        alwaysVisible: !1,
        borderRadius: "0",
        railBorderRadius: "0"
    })
}

function activateNotificationAndTasksScroll() {
    $(".navbar-right .dropdown-menu .body .menu").slimscroll({
        height: "254px",
        color: "rgba(0,0,0,0.5)",
        size: "4px",
        alwaysVisible: !1,
        borderRadius: "0",
        railBorderRadius: "0"
    })
}

function addLoadEvent(a) {
    var b = window.onload;
    "function" != typeof window.onload ? window.onload = a : window.onload = function() {
        b(), a()
    }
}

if ("undefined" == typeof jQuery) throw new Error("jQuery plugins need to be before this file");
$.AdminBSB = {}, $.AdminBSB.options = {
    colors: {
        red: "#ec3b57",
        pink: "#E91E63",
        purple: "#ba3bd0",
        deepPurple: "#673AB7",
        indigo: "#3F51B5",
        blue: "#457fca",
        lightBlue: "#03A9F4",
        cyan: "#01b4ae",
        green: "#78b83e",
        lightGreen: "#8BC34A",
        yellow: "#ffe821",
        orange: "#FF9800",
        deepOrange: "#f83600",
        grey: "#9E9E9E",
        blueGrey: "#607D8B",
        black: "#000000",
        blush: "#F15F79",
        white: "#ffffff",
        darkblue: "#346699"
    },
    leftSideBar: {
        scrollColor: "rgba(0,0,0,0.5)",
        scrollWidth: "4px",
        scrollAlwaysVisible: !1,
        scrollBorderRadius: "0",
        scrollRailBorderRadius: "0"
    },
    dropdownMenu: {
        effectIn: "fadeIn",
        effectOut: "fadeOut"
    }
}, $.AdminBSB.leftSideBar = {
    activate: function() {
        var a = this,
            b = $("body"),
            c = $(".overlay");
        $(window).click(function(d) {
            var e = $(d.target);
            "i" === d.target.nodeName.toLowerCase() && (e = $(d.target).parent()), !e.hasClass("bars") && a.isOpen() && 0 === e.parents("#leftsidebar").length && (e.hasClass("js-right-sidebar") || c.fadeOut(), b.removeClass("overlay-open"))
        }), $.each($(".menu-toggle.toggled"), function(a, b) {
            $(b).next().slideToggle(0)
        }), $.each($(".menu .list li.active"), function(a, b) {
            var c = $(b).find("a:eq(0)");
            c.addClass("toggled"), c.next().show()
        }), $(".menu-toggle").on("click", function(a) {
            var b = $(this),
                c = b.next();
            if ($(b.parents("ul")[0]).hasClass("list")) {
                var d = $(a.target).hasClass("menu-toggle") ? a.target : $(a.target).parents(".menu-toggle");
                $.each($(".menu-toggle.toggled").not(d).next(), function(a, b) {
                    $(b).is(":visible") && ($(b).prev().toggleClass("toggled"), $(b).slideUp())
                })
            }
            b.toggleClass("toggled"), c.slideToggle(320)
        }), a.setMenuHeight(), a.checkStatuForResize(!0), $(window).resize(function() {
            a.setMenuHeight(), a.checkStatuForResize(!1)
        }), Waves.attach(".menu .list a", ["waves-block"]), Waves.init()
    },
    setMenuHeight: function() {
        if ("undefined" != typeof $.fn.slimScroll) {
            var a = $.AdminBSB.options.leftSideBar,
                b = $(window).height() - ($(".legal").outerHeight() + $(".user-info").outerHeight() + $(".navbar").innerHeight()),
                c = $(".list");
            c.slimScroll({
                destroy: !0
            }).height("auto"), c.parent().find(".slimScrollBar, .slimScrollRail").remove(), c.slimscroll({
                height: b + "px",
                color: a.scrollColor,
                size: a.scrollWidth,
                alwaysVisible: a.scrollAlwaysVisible,
                borderRadius: a.scrollBorderRadius,
                railBorderRadius: a.scrollRailBorderRadius
            })
        }
    },
    checkStatuForResize: function(a) {
        var b = $("body"),
            c = $(".navbar .navbar-header .bars"),
            d = b.width();
        a && b.find(".content, .sidebar").addClass("no-animate").delay(1e3).queue(function() {
            $(this).removeClass("no-animate").dequeue()
        }), d < 1170 ? (b.addClass("ls-closed"), c.fadeIn()) : (b.removeClass("ls-closed"), c.fadeOut())
    },
    isOpen: function() {
        return $("body").hasClass("overlay-open")
    }
}, $.AdminBSB.rightSideBar = {
    activate: function() {
        var a = this,
            b = $("#rightsidebar"),
            c = $(".overlay");
        $(window).click(function(d) {
            var e = $(d.target);
            "i" === d.target.nodeName.toLowerCase() && (e = $(d.target).parent()), !e.hasClass("js-right-sidebar") && a.isOpen() && 0 === e.parents("#rightsidebar").length && (e.hasClass("bars") || c.fadeOut(), b.removeClass("open"))
        }), $(".js-right-sidebar").on("click", function() {
            b.toggleClass("open"), a.isOpen() ? c.fadeIn() : c.fadeOut()
        })
    },
    isOpen: function() {
        return $(".right-sidebar").hasClass("open")
    }
};
var $searchBar = $(".search-bar");
$.AdminBSB.search = {
    activate: function() {
        var a = this;
        $(".js-search").on("click", function() {
            a.showSearchBar()
        }), $searchBar.find(".close-search").on("click", function() {
            a.hideSearchBar()
        }), $searchBar.find('input[type="text"]').on("keyup", function(b) {
            27 == b.keyCode && a.hideSearchBar()
        })
    },
    showSearchBar: function() {
        $searchBar.addClass("open"), $searchBar.find('input[type="text"]').focus()
    },
    hideSearchBar: function() {
        $searchBar.removeClass("open"), $searchBar.find('input[type="text"]').val("")
    }
}, $.AdminBSB.navbar = {
    activate: function() {
        var a = $("body"),
            b = $(".overlay");
        $(".bars").on("click", function() {
            a.toggleClass("overlay-open"), a.hasClass("overlay-open") ? b.fadeIn() : b.fadeOut()
        }), $('.nav [data-close="true"]').on("click", function() {
            var a = $(".navbar-toggle").is(":visible"),
                b = $(".navbar-collapse");
            a && b.slideUp(function() {
                b.removeClass("in").removeAttr("style")
            })
        })
    }
}, $.AdminBSB.input = {
    activate: function() {
        $(".form-control").focus(function() {
            $(this).parent().addClass("focused")
        }), $(".form-control").focusout(function() {
            var a = $(this);
            a.parents(".form-group").hasClass("form-float") ? "" == a.val() && a.parents(".form-line").removeClass("focused") : a.parents(".form-line").removeClass("focused")
        }), $("body").on("click", ".form-float .form-line .form-label", function() {
            $(this).parent().find("input").focus()
        })
    }
};

//~ , $.AdminBSB.select = {
    //~ activate: function() {
        //~ $.fn.selectpicker && $("select:not(.ms)").selectpicker()
    //~ }
//~ }, $.AdminBSB.dropdownMenu = {
    //~ activate: function() {
        //~ var a = this;
        //~ $(".dropdown, .dropup, .btn-group").on({
            //~ "show.bs.dropdown": function() {
                //~ var b = a.dropdownEffect(this);
                //~ a.dropdownEffectStart(b, b.effectIn)
            //~ },
            //~ "shown.bs.dropdown": function() {
                //~ var b = a.dropdownEffect(this);
                //~ b.effectIn && b.effectOut && a.dropdownEffectEnd(b, function() {})
            //~ },
            //~ "hide.bs.dropdown": function(b) {
                //~ var c = a.dropdownEffect(this);
                //~ c.effectOut && (b.preventDefault(), a.dropdownEffectStart(c, c.effectOut), a.dropdownEffectEnd(c, function() {
                    //~ c.dropdown.removeClass("open")
                //~ }))
            //~ }
        //~ }), Waves.attach(".dropdown-menu li a", ["waves-block"]), Waves.init()
    //~ },
    //~ dropdownEffect: function(a) {
        //~ var b = $.AdminBSB.options.dropdownMenu.effectIn,
            //~ c = $.AdminBSB.options.dropdownMenu.effectOut,
            //~ d = $(a),
            //~ e = $(".dropdown-menu", a);
        //~ if (d.size() > 0) {
            //~ var f = d.data("effect-in"),
                //~ g = d.data("effect-out");
            //~ void 0 !== f && (b = f), void 0 !== g && (c = g)
        //~ }
        //~ return {
            //~ target: a,
            //~ dropdown: d,
            //~ dropdownMenu: e,
            //~ effectIn: b,
            //~ effectOut: c
        //~ }
    //~ },
    //~ dropdownEffectStart: function(a, b) {
        //~ b && (a.dropdown.addClass("dropdown-animating"), a.dropdownMenu.addClass("animated dropdown-animated"), a.dropdownMenu.addClass(b))
    //~ },
    //~ dropdownEffectEnd: function(a, b) {
        //~ var c = "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
        //~ a.dropdown.one(c, function() {
            //~ a.dropdown.removeClass("dropdown-animating"), a.dropdownMenu.removeClass("animated dropdown-animated"), a.dropdownMenu.removeClass(a.effectIn), a.dropdownMenu.removeClass(a.effectOut), "function" == typeof b && b()
        //~ })
    //~ }
//~ };

var edge = "Microsoft Edge",
    ie10 = "Internet Explorer 10",
    ie11 = "Internet Explorer 11",
    opera = "Opera",
    firefox = "Mozilla Firefox",
    chrome = "Google Chrome",
    safari = "Safari";
$.AdminBSB.browser = {
    activate: function() {
        var a = this,
            b = a.getClassName();
        "" !== b && $("html").addClass(a.getClassName())
    },
    getBrowser: function() {
        var a = navigator.userAgent.toLowerCase();
        return /edge/i.test(a) ? edge : /rv:11/i.test(a) ? ie11 : /msie 10/i.test(a) ? ie10 : /opr/i.test(a) ? opera : /chrome/i.test(a) ? chrome : /firefox/i.test(a) ? firefox : navigator.userAgent.match(/Version\/[\d\.]+.*Safari/) ? safari : void 0
    },
    getClassName: function() {
        var a = this.getBrowser();
        return a === edge ? "edge" : a === ie11 ? "ie11" : a === ie10 ? "ie10" : a === opera ? "opera" : a === chrome ? "chrome" : a === firefox ? "firefox" : a === safari ? "safari" : ""
    }
}, $(function() {
	// $.AdminBSB.dropdownMenu.activate(),
	// $.AdminBSB.select.activate(),
    $.AdminBSB.browser.activate(), $.AdminBSB.leftSideBar.activate(), $.AdminBSB.rightSideBar.activate(), $.AdminBSB.navbar.activate(), $.AdminBSB.input.activate(), $.AdminBSB.search.activate(), setTimeout(function() {
        $(".page-loader-wrapper").fadeOut()
    }, 50)
}), $(function() {
    $(".control").click(function() {
        $("body").addClass("mode-search"), $(".input-search").focus()
    }), $(".icon-close").click(function() {
        $("body").removeClass("mode-search")
    })
}), $(window).scroll(function() {
    var a = $(window).scrollTop();
    a >= 30 ? $(".clearHeader").addClass("n-top") : $(".clearHeader").removeClass("n-top");
    var a = $(window).scrollTop();
    a >= 30 ? $(".morphsearch").addClass("m-top") : $(".morphsearch").removeClass("m-top")
}), 
//~ $(function() {
    //~ var a = document.getElementById("morphsearch"),
        //~ b = a.querySelector("input.morphsearch-input"),
        //~ c = a.querySelector("span.morphsearch-close"),
        //~ d = isAnimating = !1,
        //~ e = function(c) {
            //~ if ("focus" === c.type.toLowerCase() && d) return !1;
            //~ morphsearch.getBoundingClientRect();
            //~ d ? (classie.remove(a, "open"), "" !== b.value && setTimeout(function() {
                //~ classie.add(a, "hideInput"), setTimeout(function() {
                    //~ classie.remove(a, "hideInput"), b.value = ""
                //~ }, 300)
            //~ }, 500), b.blur()) : classie.add(a, "open"), d = !d
        //~ };
    //~ b.addEventListener("focus", e), c.addEventListener("click", e), document.addEventListener("keydown", function(a) {
        //~ var b = a.keyCode || a.which;
        //~ 27 === b && d && e(a)
    //~ }), a.querySelector('button[type="submit"]').addEventListener("click", function(a) {
        //~ a.preventDefault()
    //~ })
//~ }), 

$(function() {
    skinChanger(), activateNotificationAndTasksScroll(), setSkinListHeightAndScroll(), setSettingListHeightAndScroll(), $(window).resize(function() {
        setSkinListHeightAndScroll(), setSettingListHeightAndScroll()
    })
});
