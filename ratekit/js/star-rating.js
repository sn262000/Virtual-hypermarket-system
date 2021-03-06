/*!
 * The following section @copyright &copy; Kartik Visweswaran, Krajee.com, 2013 - 2016
 * @version 3.5.8
 *
 * A simple yet powerful JQuery star rating plugin that allows rendering fractional star ratings and supports
 * Right to Left (RTL) input.
 *
 * For more JQuery plugins visit http://plugins.krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */

!function (e) {
	"use strict";
	"function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof module && module.exports ? module.exports = e(require("jquery")) : e(window.jQuery)
}(function (e) {
	"use strict";
	e.fn.ratingLocales = {};
	var t, a, n, r, i, l, s, o, c, u, g;
	t = ".rating", a = 0, n = 5, r = .5, i = function (t, a) {
		return null === t || void 0 === t || 0 === t.length || a && "" === e.trim(t)
	}, l = function (e, t) {
		e.removeClass(t).addClass(t)
	}, s = function (e, t, a) {
		var n = i(e.data(t)) ? e.attr(t) : e.data(t);
		return n ? n : a[t]
	}, o = function (e) {
		var t = ("" + e).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
		return t ? Math.max(0, (t[1] ? t[1].length : 0) - (t[2] ? +t[2] : 0)) : 0
	}, c = function (e, t) {
		return parseFloat(e.toFixed(t))
	}, u = function (e, a, n, r) {
		var i = r ? a : a.split(" ").join(t + " ") + t;
		e.off(i).on(i, n)
	}, g = function (t, a) {
		this.$element = e(t), this.init(a)
	}, g.prototype = {
		constructor            : g, _parseAttr: function (e, t) {
			var l, o, c, u = this, g = u.$element, h = g.attr("type");
			if ("range" === h || "number" === h) {
				switch (o = s(g, e, t), e) {
					case"min":
						c = a;
						break;
					case"max":
						c = n;
						break;
					default:
						c = r
				}
				return l = i(o) ? c : o, parseFloat(l)
			}
			return parseFloat(t[e])
		}, setDefault          : function (e, t) {
			var a = this;
			i(a[e]) && (a[e] = t)
		}, getPosition         : function (e) {
			var t = i(e.pageX) ? e.originalEvent.touches[0].pageX : e.pageX;
			return t - this.$rating.offset().left
		}, listenClick         : function (e, t) {
			return e.stopPropagation(), e.preventDefault(), e.handled === !0 ? !1 : (t(e), void(e.handled = !0))
		}, starClick           : function (e) {
			var t, a = this;
			a.listenClick(e, function (e) {
				return a.inactive ? !1 : (t = a.getPosition(e), a.setStars(t), a.$element.trigger("change").trigger("rating.change", [a.$element.val(), a.$caption.html()]), void(a.starClicked = !0))
			})
		}, starMouseMove       : function (e) {
			var t, a, n = this;
			!n.hoverEnabled || n.inactive || e && e.isDefaultPrevented() || (n.starClicked = !1, t = n.getPosition(e), a = n.calculate(t), n.toggleHover(a), n.$element.trigger("rating.hover", [a.val, a.caption, "stars"]))
		}, starMouseLeave      : function (e) {
			var t, a = this;
			!a.hoverEnabled || a.inactive || a.starClicked || e && e.isDefaultPrevented() || (t = a.cache, a.toggleHover(t), a.$element.trigger("rating.hoverleave", ["stars"]))
		}, clearClick          : function (e) {
			var t = this;
			t.listenClick(e, function () {
				t.inactive || (t.clear(), t.clearClicked = !0)
			})
		}, clearMouseMove      : function (e) {
			var t, a, n, r, i = this;
			!i.hoverEnabled || i.inactive || !i.hoverOnClear || e && e.isDefaultPrevented() || (i.clearClicked = !1, t = '<span class="' + i.clearCaptionClass + '">' + i.clearCaption + "</span>", a = i.clearValue, n = i.getWidthFromValue(a), r = {
				caption: t,
				width  : n,
				val    : a
			}, i.toggleHover(r), i.$element.trigger("rating.hover", [a, t, "clear"]))
		}, clearMouseLeave     : function (e) {
			var t, a = this;
			!a.hoverEnabled || a.inactive || a.clearClicked || !a.hoverOnClear || e && e.isDefaultPrevented() || (t = a.cache, a.toggleHover(t), a.$element.trigger("rating.hoverleave", ["clear"]))
		}, resetForm           : function (e) {
			var t = this;
			e && e.isDefaultPrevented() || t.inactive || t.reset()
		}, initTouch           : function (e) {
			var t = this, a = "touchend" === e.type;
			t.setTouch(e, a)
		}, listen              : function () {
			var t = this, a = t.$element.closest("form"), n = t.$rating, r = t.$clear;
			u(n, "touchstart touchmove touchend", e.proxy(t.initTouch, t)), u(n, "click touchstart", e.proxy(t.starClick, t)), u(n, "mousemove", e.proxy(t.starMouseMove, t)), u(n, "mouseleave", e.proxy(t.starMouseLeave, t)), u(r, "click touchstart", e.proxy(t.clearClick, t)), u(r, "mousemove", e.proxy(t.clearMouseMove, t)), u(r, "mouseleave", e.proxy(t.clearMouseLeave, t)), a.length && u(a, "reset", e.proxy(t.resetForm, t))
		}, destroy             : function () {
			var t = this, a = t.$element;
			i(t.$container) || t.$container.before(a).remove(), e.removeData(a.get(0)), a.off("rating").removeClass("hide")
		}, create              : function (e) {
			var t = this, a = t.$element;
			e = e || t.options || {}, t.destroy(), a.rating(e)
		}, setTouch            : function (e, t) {
			var a, n, r, l, s, o, c, u = this, g = "ontouchstart" in window || window.DocumentTouch && document instanceof window.DocumentTouch;
			g && !u.inactive && (a = e.originalEvent, n = i(a.touches) ? a.changedTouches : a.touches, r = u.getPosition(n[0]), t ? (u.setStars(r), u.$element.trigger("change").trigger("rating.change", [u.$element.val(), u.$caption.html()]), u.starClicked = !0) : (l = u.calculate(r), s = l.val <= u.clearValue ? u.fetchCaption(u.clearValue) : l.caption, o = u.getWidthFromValue(u.clearValue), c = l.val <= u.clearValue ? u.rtl ? 100 - o + "%" : o + "%" : l.width, u.$caption.html(s), u.$stars.css("width", c)))
		}, initSlider          : function (e) {
			var t = this;
			i(t.$element.val()) && t.$element.val(0), t.initialValue = t.$element.val(), t.setDefault("min", t._parseAttr("min", e)), t.setDefault("max", t._parseAttr("max", e)), t.setDefault("step", t._parseAttr("step", e)), (isNaN(t.min) || i(t.min)) && (t.min = a), (isNaN(t.max) || i(t.max)) && (t.max = n), (isNaN(t.step) || i(t.step) || 0 === t.step) && (t.step = r), t.diff = t.max - t.min
		}, init                : function (t) {
			var a, n, r, s = this, o = s.$element;
			s.options = t, e.each(t, function (e, t) {
				s[e] = t
			}), s.starClicked = !1, s.clearClicked = !1, s.initSlider(t), s.checkDisabled(), s.setDefault("rtl", o.attr("dir")), s.rtl && o.attr("dir", "rtl"), a = s.glyphicon ? "???" : "???", s.setDefault("symbol", a), s.setDefault("clearButtonBaseClass", "clear-rating"), s.setDefault("clearButtonActiveClass", "clear-rating-active"), s.setDefault("clearValue", s.min), l(o, "form-control hide"), s.$clearElement = i(t.clearElement) ? null : e(t.clearElement), s.$captionElement = i(t.captionElement) ? null : e(t.captionElement), void 0 === s.$rating && void 0 === s.$container && (s.$rating = e(document.createElement("div")).html('<div class="rating-stars"></div>'), s.$container = e(document.createElement("div")), s.$container.before(s.$rating).append(s.$rating), o.before(s.$container).appendTo(s.$rating)), s.$stars = s.$rating.find(".rating-stars"), s.generateRating(), s.$clear = i(s.$clearElement) ? s.$container.find("." + s.clearButtonBaseClass) : s.$clearElement, s.$caption = i(s.$captionElement) ? s.$container.find(".caption") : s.$captionElement, s.setStars(), s.listen(), s.showClear && s.$clear.attr({"class": s.getClearClass()}), n = o.val(), r = s.getWidthFromValue(n), s.cache = {
				caption: s.$caption.html(),
				width  : (s.rtl ? 100 - r : r) + "%",
				val    : n
			}, o.removeClass("rating-loading")
		}, checkDisabled       : function () {
			var e = this;
			e.disabled = s(e.$element, "disabled", e.options), e.readonly = s(e.$element, "readonly", e.options), e.inactive = e.disabled || e.readonly
		}, getClearClass       : function () {
			return this.clearButtonBaseClass + " " + (this.inactive ? "" : this.clearButtonActiveClass)
		}, generateRating      : function () {
			var e = this, t = e.renderClear(), a = e.renderCaption(), n = e.rtl ? "rating-container-rtl" : "rating-container", r = e.getStars();
			n += e.glyphicon ? ("???" === e.symbol ? " rating-gly-star" : " rating-gly") + e.ratingClass : i(e.ratingClass) ? " rating-uni" : " " + e.ratingClass, e.$rating.attr("class", n), e.$rating.attr("data-content", r), e.$stars.attr("data-content", r), n = e.rtl ? "star-rating-rtl" : "star-rating", e.$container.attr("class", n + " rating-" + e.size), e.$container.removeClass("rating-active rating-disabled"), e.inactive ? e.$container.addClass("rating-disabled") : e.$container.addClass("rating-active"), i(e.$caption) && (e.rtl ? e.$container.prepend(a) : e.$container.append(a)), i(e.$clear) && (e.rtl ? e.$container.append(t) : e.$container.prepend(t)), i(e.containerClass) || l(e.$container, e.containerClass)
		}, getStars            : function () {
			var e, t = this, a = t.stars, n = "";
			for (e = 1; a >= e; e++)n += t.symbol;
			return n
		}, renderClear         : function () {
			var e, t = this;
			return t.showClear ? (e = t.getClearClass(), i(t.$clearElement) ? '<div class="' + e + '" title="' + t.clearButtonTitle + '">' + t.clearButton + "</div>" : (l(t.$clearElement, e), t.$clearElement.attr({title: t.clearButtonTitle}).html(t.clearButton), "")) : ""
		}, renderCaption       : function () {
			var e, t = this, a = t.$element.val();
			return t.showCaption ? (e = t.fetchCaption(a), i(t.$captionElement) ? '<div class="caption">' + e + "</div>" : (l(t.$captionElement, "caption"), t.$captionElement.html(e), "")) : ""
		}, fetchCaption        : function (e) {
			var t, a, n, r, l, s = this, o = parseFloat(e), c = s.starCaptions, u = s.starCaptionClasses;
			return r = "function" == typeof u ? u(o) : u[o], n = "function" == typeof c ? c(o) : c[o], a = i(n) ? s.defaultCaption.replace(/\{rating}/g, o) : n, t = i(r) ? s.clearCaptionClass : r, l = o === s.clearValue ? s.clearCaption : a, '<span class="' + t + '">' + l + "</span>"
		}, getWidthFromValue   : function (e) {
			var t = this, a = t.min, n = t.max;
			return a >= e || a === n ? 0 : e >= n ? 100 : 100 * (e - a) / (n - a)
		}, getValueFromPosition: function (e) {
			var t, a, n = this, r = o(n.step), i = n.$rating.width();
			return a = n.diff * e / (i * n.step), a = n.rtl ? Math.floor(a) : Math.ceil(a), t = c(parseFloat(n.min + a * n.step), r), t = Math.max(Math.min(t, n.max), n.min), n.rtl ? n.max - t : t
		}, toggleHover         : function (e) {
			var t, a, n, r = this;
			r.hoverChangeCaption && (n = e.val <= r.clearValue ? r.fetchCaption(r.clearValue) : e.caption, r.$caption.html(n)), r.hoverChangeStars && (t = r.getWidthFromValue(r.clearValue), a = e.val <= r.clearValue ? r.rtl ? 100 - t + "%" : t + "%" : e.width, r.$stars.css("width", a))
		}, calculate           : function (e) {
			var t = this, a = i(t.$element.val()) ? 0 : t.$element.val(), n = arguments.length ? t.getValueFromPosition(e) : a, r = t.fetchCaption(n), l = t.getWidthFromValue(n);
			return t.rtl && (l = 100 - l), l += "%", {caption: r, width: l, val: n}
		}, setStars            : function (e) {
			var t = this, a = arguments.length ? t.calculate(e) : t.calculate();
			t.$element.val(a.val), t.$stars.css("width", a.width), t.$caption.html(a.caption), t.cache = a
		}, clear               : function () {
			var e = this, t = '<span class="' + e.clearCaptionClass + '">' + e.clearCaption + "</span>";
			e.$stars.removeClass("rated"), e.inactive || e.$caption.html(t), e.$element.val(e.clearValue), e.setStars(), e.$element.trigger("rating.clear")
		}, reset               : function () {
			var e = this;
			e.$element.val(e.initialValue), e.setStars(), e.$element.trigger("rating.reset")
		}, update              : function (e) {
			var t = this;
			arguments.length && (t.$element.val(e), t.setStars())
		}, refresh             : function (t) {
			var a = this;
			arguments.length && (a.$rating.off("rating"), void 0 !== a.$clear && a.$clear.off(), a.init(e.extend(!0, a.options, t)), a.showClear ? a.$clear.show() : a.$clear.hide(), a.showCaption ? a.$caption.show() : a.$caption.hide(), a.$element.trigger("rating.refresh"))
		}
	}, e.fn.rating = function (t) {
		var a = Array.apply(null, arguments), n = [];
		switch (a.shift(), this.each(function () {
			var r, l = e(this), s = l.data("rating"), o = "object" == typeof t && t, c = o.language || l.data("language") || "en", u = {};
			s || ("en" === c || i(e.fn.ratingLocales[c]) || (u = e.fn.ratingLocales[c]), r = e.extend(!0, {}, e.fn.rating.defaults, e.fn.ratingLocales.en, u, o, l.data()), s = new g(this, r), l.data("rating", s)), "string" == typeof t && n.push(s[t].apply(s, a))
		}), n.length) {
			case 0:
				return this;
			case 1:
				return n[0];
			default:
				return n
		}
	}, e.fn.rating.defaults = {
		language              : "en",
		stars                 : 5,
		glyphicon             : !0,
		symbol                : null,
		ratingClass           : "",
		disabled              : !1,
		readonly              : !1,
		rtl                   : !1,
		size                  : "md",
		showClear             : !0,
		showCaption           : !0,
		starCaptionClasses    : {
			.5 : "label label-danger",
			1  : "label label-danger",
			1.5: "label label-warning",
			2  : "label label-warning",
			2.5: "label label-info",
			3  : "label label-info",
			3.5: "label label-primary",
			4  : "label label-primary",
			4.5: "label label-success",
			5  : "label label-success"
		},
		clearButton           : '<i class="glyphicon glyphicon-minus-sign"></i>',
		clearButtonBaseClass  : "clear-rating",
		clearButtonActiveClass: "clear-rating-active",
		clearCaptionClass     : "label label-default",
		clearValue            : null,
		captionElement        : null,
		clearElement          : null,
		containerClass        : null,
		hoverEnabled          : !0,
		hoverChangeCaption    : !0,
		hoverChangeStars      : !0,
		hoverOnClear          : !0
	}, e.fn.ratingLocales.en = {
		defaultCaption  : "{rating} Stars",
		starCaptions    : {
			.5 : "Half Star",
			1  : "One Star",
			1.5: "One & Half Star",
			2  : "Two Stars",
			2.5: "Two & Half Stars",
			3  : "Three Stars",
			3.5: "Three & Half Stars",
			4  : "Four Stars",
			4.5: "Four & Half Stars",
			5  : "Five Stars"
		},
		clearButtonTitle: "Clear",
		clearCaption    : "Not Rated"
	}, e.fn.rating.Constructor = g
});
