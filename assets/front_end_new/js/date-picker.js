! function(e) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], e) : e("object" == typeof exports ? require("jquery") : jQuery)
}(function(e) {
    "use strict";
    e.Zebra_DatePicker = function(t, s) {
        var i, n, a, r, o, d, c, l, _, h, g, u, p, f, b, m, y, v, w, k, D, A, M, C, P, F, Z, x, Y, S, I, z, O, N, j, H, W, T, L, Q, J, G = {
                always_visible: !1,
                container: e("body"),
                custom_classes: !1,
                days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                days_abbr: !1,
                default_position: "above",
                direction: 0,
                disabled_dates: !1,
                enabled_dates: !1,
                enabled_hours: !1,
                enabled_minutes: !1,
                enabled_seconds: !1,
                first_day_of_week: 1,
                format: "Y-m-d",
                header_captions: {
                    days: "F, Y",
                    months: "Y",
                    years: "Y1 - Y2"
                },
                header_navigation: ["&#171;", "&#187;"],
                icon_position: "right",
                inside: !0,
                lang_clear_date: "Clear date",
                months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                months_abbr: !1,
                offset: [5, -5],
                open_icon_only: !1,
                open_on_focus: !1,
                pair: !1,
                readonly_element: !0,
                select_other_months: !1,
                show_clear_date: 0,
                show_icon: !0,
                show_other_months: !0,
                show_select_today: "Today",
                show_week_number: !1,
                start_date: !1,
                strict: !1,
                view: "days",
                weekend_days: [0, 6],
                zero_pad: !1,
                onChange: null,
                onClear: null,
                onOpen: null,
                onClose: null,
                onSelect: null
            },
            U = [],
            V = {},
            $ = [],
            q = [],
            E = {},
            R = "",
            B = [],
            X = this;
        X.settings = {};
        var K = e(t),
            ee = function(t) {
                var _, C, O, Q, ee = {
                        days: ["d", "j", "D"],
                        months: ["F", "m", "M", "n", "t"],
                        years: ["o", "Y", "y"],
                        hours: ["G", "g", "H", "h"],
                        minutes: ["i"],
                        seconds: ["s"],
                        ampm: ["A", "a"]
                    },
                    ie = null;
                for (O = 0; O < 3; O++) R += Math.floor(65536 * (1 + Math.random())).toString(16);
                if (!t) {
                    X.settings = e.extend({}, G, s), E.readonly = K.attr("readonly"), E.style = K.attr("style");
                    for (_ in K.data()) 0 === _.indexOf("zdp_") && (_ = _.replace(/^zdp\_/, ""), void 0 !== G[_] && (X.settings[_] = "pair" === _ ? e(K.data("zdp_" + _)) : K.data("zdp_" + _)))
                }
                X.settings.readonly_element && K.attr("readonly", "readonly"), T = !1;
                for (ie in ee) e.each(ee[ie], function(t, s) {
                    var i, n;
                    if (X.settings.format.indexOf(s) > -1)
                        if ("days" === ie) B.push("days");
                        else if ("months" === ie) B.push("months");
                    else if ("years" === ie) B.push("years");
                    else if ("hours" === ie || "minutes" === ie || "seconds" === ie || "ampm" === ie)
                        if (T || (T = {
                                is12hour: !1
                            }, B.push("time")), "hours" === ie)
                            for ("g" === s || "h" == s ? (n = 12, T.is12hour = !0) : n = 24, T.hours = [], i = 12 === n ? 1 : 0; i < (12 === n ? 13 : n); i++)(!e.isArray(X.settings.enabled_hours) || e.inArray(i, X.settings.enabled_hours) > -1) && T.hours.push(i);
                        else if ("minutes" === ie)
                        for (T.minutes = [], i = 0; i < 60; i++)(!e.isArray(X.settings.enabled_minutes) || e.inArray(i, X.settings.enabled_minutes) > -1) && T.minutes.push(i);
                    else if ("seconds" === ie)
                        for (T.seconds = [], i = 0; i < 60; i++)(!e.isArray(X.settings.enabled_seconds) || e.inArray(i, X.settings.enabled_seconds) > -1) && T.seconds.push(i);
                    else T.ampm = ["am", "pm"]
                });
                0 === B.length && (B = ["years", "months", "days"]), -1 === e.inArray(X.settings.view, B) && (X.settings.view = B[B.length - 1]);
                for (O in X.settings.custom_classes) X.settings.custom_classes.hasOwnProperty(O) && U.push(O);
                for (Q = 0; Q < 2 + U.length; Q++) C = 0 === Q ? X.settings.disabled_dates : 1 === Q ? X.settings.enabled_dates : X.settings.custom_classes[U[Q - 2]], e.isArray(C) && C.length > 0 && e.each(C, function() {
                    var t, s, i, n, a = this.split(" ");
                    for (t = 0; t < 4; t++) {
                        for (a[t] || (a[t] = "*"), a[t] = a[t].indexOf(",") > -1 ? a[t].split(",") : new Array(a[t]), s = 0; s < a[t].length; s++)
                            if (a[t][s].indexOf("-") > -1 && null !== (n = a[t][s].match(/^([0-9]+)\-([0-9]+)/))) {
                                for (i = me(n[1]); i <= me(n[2]); i++) - 1 === e.inArray(i, a[t]) && a[t].push(i + "");
                                a[t].splice(s, 1)
                            }
                        for (s = 0; s < a[t].length; s++) a[t][s] = isNaN(me(a[t][s])) ? a[t][s] : me(a[t][s])
                    }
                    0 === Q ? $.push(a) : 1 === Q ? q.push(a) : (void 0 === V[U[Q - 2]] && (V[U[Q - 2]] = []), V[U[Q - 2]].push(a))
                });
                var ne, ae, re = new Date,
                    oe = X.settings.reference_date ? X.settings.reference_date : K.data("zdp_reference_date") && void 0 !== K.data("zdp_reference_date") ? K.data("zdp_reference_date") : re;
                if (j = void 0, p = void 0, b = oe.getMonth(), o = re.getMonth(), m = oe.getFullYear(), d = re.getFullYear(), f = oe.getDate(), r = re.getDate(), !0 === X.settings.direction) j = oe;
                else if (!1 === X.settings.direction) D = (p = oe).getMonth(), A = p.getFullYear(), k = p.getDate();
                else if (!e.isArray(X.settings.direction) && he(X.settings.direction) && me(X.settings.direction) > 0 || e.isArray(X.settings.direction) && ((ne = te(X.settings.direction[0])) || !0 === X.settings.direction[0] || he(X.settings.direction[0]) && X.settings.direction[0] > 0) && ((ae = te(X.settings.direction[1])) || !1 === X.settings.direction[1] || he(X.settings.direction[1]) && X.settings.direction[1] >= 0)) j = ne || new Date(m, b, f + me(e.isArray(X.settings.direction) ? !0 === X.settings.direction[0] ? 0 : X.settings.direction[0] : X.settings.direction)), b = j.getMonth(), m = j.getFullYear(), f = j.getDate(), ae && +ae >= +j ? p = ae : !ae && !1 !== X.settings.direction[1] && e.isArray(X.settings.direction) && (p = new Date(m, b, f + me(X.settings.direction[1]))), p && (D = p.getMonth(), A = p.getFullYear(), k = p.getDate());
                else if (!e.isArray(X.settings.direction) && he(X.settings.direction) && me(X.settings.direction) < 0 || e.isArray(X.settings.direction) && (!1 === X.settings.direction[0] || he(X.settings.direction[0]) && X.settings.direction[0] < 0) && ((ne = te(X.settings.direction[1])) || he(X.settings.direction[1]) && X.settings.direction[1] >= 0)) p = new Date(m, b, f + me(e.isArray(X.settings.direction) ? !1 === X.settings.direction[0] ? 0 : X.settings.direction[0] : X.settings.direction)), D = p.getMonth(), A = p.getFullYear(), k = p.getDate(), ne && +ne < +p ? j = ne : !ne && e.isArray(X.settings.direction) && (j = new Date(A, D, k - me(X.settings.direction[1]))), j && (b = j.getMonth(), m = j.getFullYear(), f = j.getDate());
                else if (e.isArray(X.settings.disabled_dates) && X.settings.disabled_dates.length > 0)
                    for (var de in $)
                        if ("*" === $[de][0] && "*" === $[de][1] && "*" === $[de][2] && "*" === $[de][3]) {
                            var ce = [];
                            if (e.each(q, function() {
                                    var e = this;
                                    "*" !== e[2][0] && ce.push(parseInt(e[2][0] + ("*" === e[1][0] ? "12" : be(e[1][0], 2)) + ("*" === e[0][0] ? "*" === e[1][0] ? "31" : new Date(e[2][0], e[1][0], 0).getDate() : be(e[0][0], 2)), 10))
                                }), ce.sort(), ce.length > 0) {
                                var le = (ce[0] + "").match(/([0-9]{4})([0-9]{2})([0-9]{2})/);
                                m = parseInt(le[1], 10), b = parseInt(le[2], 10) - 1, f = parseInt(le[3], 10)
                            }
                            break
                        }
                if (_e(m, b, f)) {
                    for (; _e(m);) j ? (m++, b = 0) : (m--, b = 11);
                    for (; _e(m, b);) j ? (b++, f = 1) : (b--, f = new Date(m, b + 1, 0).getDate()), b > 11 ? (m++, b = 0, f = 1) : b < 0 && (m--, b = 11, f = new Date(m, b + 1, 0).getDate());
                    for (; _e(m, b, f);) j ? f++ : f--, re = new Date(m, b, f), m = re.getFullYear(), b = re.getMonth(), f = re.getDate();
                    re = new Date(m, b, f), m = re.getFullYear(), b = re.getMonth(), f = re.getDate()
                }
                var ge = te(K.val() || (X.settings.start_date ? X.settings.start_date : ""));
                if (ge && X.settings.strict && _e(ge.getFullYear(), ge.getMonth(), ge.getDate()) && K.val(""), t || void 0 === j && void 0 === ge || ye(void 0 !== ge ? ge : j), !(X.settings.always_visible instanceof jQuery)) {
                    if (!t) {
                        if (X.settings.show_icon) {
                            "firefox" === we.name && K.is('input[type="text"]') && "inline" === K.css("display") && K.css("display", "inline-block");
                            var fe = e('<span class="Zebra_DatePicker_Icon_Wrapper"></span>').css({
                                display: K.css("display"),
                                position: "static" === K.css("position") ? "relative" : K.css("position"),
                                float: K.css("float"),
                                top: K.css("top"),
                                right: K.css("right"),
                                bottom: K.css("bottom"),
                                left: K.css("left"),
								
								
                            });
                            "block" === K.css("display") && fe.css("width:100%;", K.outerWidth(!0)), K.wrap(fe).css({
                                position: "relative",
                                top: "auto",
                                right: "auto",
                                bottom: "auto",
                                left: "auto"
                            }), w = e('<button type="button" class="Zebra_DatePicker_Icon' + ("disabled" === K.attr("disabled") ? " Zebra_DatePicker_Icon_Disabled" : "") + '">Pick a date</button>'), X.icon = w, n = X.settings.open_icon_only ? w : w.add(K)
                        } else n = K;
                        n.on("click.Zebra_DatePicker_" + R + (X.settings.open_on_focus ? " focus.Zebra_DatePicker_" + R : ""), function() {
                            c.hasClass("dp_visible") || K.attr("disabled") || X.show()
                        }), n.on("keydown.Zebra_DatePicker_" + R, function(e) {
                            9 === e.keyCode && c.hasClass("dp_visible") && X.hide()
                        }), !X.settings.readonly_element && X.settings.pair && K.on("blur.Zebra_DatePicker_" + R, function() {
                            var t;
                            (t = te(e(this).val())) && !_e(t.getFullYear(), t.getMonth(), t.getDate()) && ye(t)
                        }), void 0 !== w && w.insertAfter(K)
                    }
                    if (void 0 !== w) {
                        w.attr("style", ""), X.settings.inside && w.addClass("Zebra_DatePicker_Icon_Inside_" + ("right" === X.settings.icon_position ? "Right" : "Left"));
                        var ve = K.outerWidth(),
                            ke = K.outerHeight(),
                            De = parseInt(K.css("marginLeft"), 10) || 0,
                            Ae = parseInt(K.css("marginTop"), 10) || 0,
                            Me = (w.outerWidth(), w.outerHeight()),
                            Ce = parseInt(w.css("marginLeft"), 10) || 0;
                        parseInt(w.css("marginRight"), 10);
                        X.settings.inside ? (w.css("top", Ae + (ke - Me) / 2), "right" === X.settings.icon_position ? w.css("right", 0) : w.css("left", 0)) : w.css({
                            top: Ae + (ke - Me) / 2,
                            left: De + ve + Ce
                        }), w.removeClass(" Zebra_DatePicker_Icon_Disabled"), "disabled" === K.attr("disabled") && w.addClass("Zebra_DatePicker_Icon_Disabled")
                    }
                }
                if (N = !1 !== X.settings.show_select_today && e.inArray("days", B) > -1 && !_e(d, o, r) && X.settings.show_select_today, t) return e(".dp_previous", c).html(X.settings.header_navigation[0]), e(".dp_next", c).html(X.settings.header_navigation[1]), e(".dp_clear", c).html(X.settings.lang_clear_date), void e(".dp_today", c).html(X.settings.show_select_today);
                e(window).on("resize.Zebra_DatePicker_" + R + ", orientationchange.Zebra_DatePicker_" + R, function() {
                    X.hide(), void 0 !== w && (clearTimeout(H), H = setTimeout(function() {
                        X.update()
                    }, 100))
                });
                var Pe = '<div class="Zebra_DatePicker"><table class="dp_header"><tr><td class="dp_previous">' + X.settings.header_navigation[0] + '</td><td class="dp_caption">&#032;</td><td class="dp_next">' + X.settings.header_navigation[1] + '</td></tr></table><table class="dp_daypicker"></table><table class="dp_monthpicker"></table><table class="dp_yearpicker"></table><table class="dp_timepicker"></table><table class="dp_footer"><tr><td class="dp_today">' + N + '</td><td class="dp_clear">' + X.settings.lang_clear_date + '</td><td class="dp_timepicker_toggler">&nbsp;</td><td class="dp_confirm">&nbsp;</td></tr></table></div>';
                c = e(Pe), v = e("table.dp_header", c), l = e("table.dp_daypicker", c), M = e("table.dp_monthpicker", c), L = e("table.dp_yearpicker", c), W = e("table.dp_timepicker", c), y = e("table.dp_footer", c), z = e("td.dp_today", y), i = e("td.dp_clear", y), Y = e("td.dp_timepicker_toggler", y), a = e("td.dp_confirm", y), X.settings.always_visible instanceof jQuery ? K.attr("disabled") || (X.settings.always_visible.append(c), X.show()) : X.settings.container.append(c), c.on("mouseover", "td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_week_number)", function() {
                    e(this).addClass("dp_hover")
                }).on("mouseout", "td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_week_number)", function() {
                    e(this).removeClass("dp_hover")
                }), se(c), e(".dp_previous", v).on("click", function() {
                    "months" === J ? I-- : "years" === J ? I -= 12 : --S < 0 && (S = 11, I--), ue()
                }), e(".dp_caption", v).on("click", function() {
                    J = "days" === J ? e.inArray("months", B) > -1 ? "months" : e.inArray("years", B) > -1 ? "years" : "days" : "months" === J ? e.inArray("years", B) > -1 ? "years" : e.inArray("days", B) > -1 ? "days" : "months" : e.inArray("days", B) > -1 ? "days" : e.inArray("months", B) > -1 ? "months" : "years", ue()
                }), e(".dp_next", v).on("click", function() {
                    "months" === J ? I++ : "years" === J ? I += 12 : 12 == ++S && (S = 0, I++), ue()
                }), l.on("click", "td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_week_number)", function() {
                    var t;
                    X.settings.select_other_months && e(this).attr("class") && null !== (t = e(this).attr("class").match(/date\_([0-9]{4})(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])/)) ? pe(t[1], t[2] - 1, t[3], "days", e(this)) : pe(I, S, me(e(this).html()), "days", e(this))
                }), M.on("click", "td:not(.dp_disabled)", function() {
                    var t = e(this).attr("class").match(/dp\_month\_([0-9]+)/);
                    S = me(t[1]), -1 === e.inArray("days", B) ? pe(I, S, 1, "months", e(this)) : (J = "days", X.settings.always_visible && K.val(""), ue())
                }), L.on("click", "td:not(.dp_disabled)", function() {
                    I = me(e(this).html()), -1 === e.inArray("months", B) ? pe(I, 1, 1, "years", e(this)) : (J = "months", X.settings.always_visible && K.val(""), ue())
                }), z.on("click", function(t) {
                    var s = new Date;
                    t.preventDefault(), pe(s.getFullYear(), s.getMonth(), s.getDate(), "days", e(".dp_current", l))
                }), i.on("click", function(t) {
                    t.preventDefault(), K.val(""), h = null, g = null, u = null, X.settings.always_visible ? e("td.dp_selected", c).removeClass("dp_selected") : (S = null, I = null), K.focus(), X.hide(), X.settings.onClear && "function" == typeof X.settings.onClear && X.settings.onClear.call(K, K)
                }), Y.on("click", function() {
                    "time" !== J ? (J = "time", ue()) : e(".dp_caption", v).trigger("click")
                }), a.on("click", function() {
                    X.hide()
                }), c.on("click", ".dp_time_controls_increase td, .dp_time_controls_decrease td", function() {
                    var t, s = e(this).parent(".dp_time_controls_increase").length > 0,
                        i = e(this).attr("class").match(/dp\_time\_([^\s]+)/i),
                        n = e(".dp_time_elements .dp_time_" + i[1] + ("ampm" !== i[1] ? "s" : ""), W),
                        a = n.text().toLowerCase(),
                        r = T[i[1] + ("ampm" !== i[1] ? "s" : "")],
                        o = r.indexOf("ampm" !== i[1] ? parseInt(a, 10) : a),
                        d = -1 === o ? 0 : s ? o + 1 >= r.length ? 0 : o + 1 : o - 1 < 0 ? r.length - 1 : o - 1;
                    "hour" === i[1] ? P = r[d] : "minute" === i[1] ? F = r[d] : "second" === i[1] ? Z = r[d] : x = r[d], !h && X.settings.start_date && (t = te(X.settings.start_date)) && (h = t.getDate()), h || (h = f), n.text(be(r[d], 2).toUpperCase()), pe(I, S, h)
                }), X.settings.always_visible instanceof jQuery || (e(document).on("mousedown.Zebra_DatePicker_" + R + " touchstart.Zebra_DatePicker_" + R, function(t) {
                    c.hasClass("dp_visible") && (X.settings.open_icon_only && X.icon && e(t.target).get(0) !== X.icon.get(0) || !X.settings.open_icon_only && e(t.target).get(0) !== K.get(0) && (!X.icon || e(t.target).get(0) !== X.icon.get(0))) && 0 === e(t.target).parents().filter(".Zebra_DatePicker").length && X.hide(!0)
                }), e(document).on("keyup.Zebra_DatePicker_" + R, function(e) {
                    c.hasClass("dp_visible") && 27 === e.which && X.hide()
                })), ue()
            };
        X.clear_date = function() {
            e(i).trigger("click")
        }, X.destroy = function() {
            void 0 !== X.icon && (X.icon.off("click.Zebra_DatePicker_" + R), X.icon.off("focus.Zebra_DatePicker_" + R), X.icon.off("keydown.Zebra_DatePicker_" + R), X.icon.remove()), c.off(), c.remove(), !X.settings.show_icon || X.settings.always_visible instanceof jQuery || K.unwrap(), K.off("blur.Zebra_DatePicker_" + R), K.off("click.Zebra_DatePicker_" + R), K.off("focus.Zebra_DatePicker_" + R), K.off("keydown.Zebra_DatePicker_" + R), K.off("mousedown.Zebra_DatePicker_" + R), e(document).off("keyup.Zebra_DatePicker_" + R), e(document).off("mousedown.Zebra_DatePicker_" + R), e(document).off("touchstart.Zebra_DatePicker_" + R), e(window).off("resize.Zebra_DatePicker_" + R), e(window).off("orientationchange.Zebra_DatePicker_" + R), K.removeData("Zebra_DatePicker"), K.attr("readonly", E.readonly), K.attr("style", E.style ? E.style : "")
        }, X.hide = function(e) {
            X.settings.always_visible && !e || (le("hide"), c.removeClass("dp_visible").addClass("dp_hidden"), X.settings.onClose && "function" == typeof X.settings.onClose && X.settings.onClose.call(K, K))
        }, X.set_date = function(e) {
            var t;
            (t = te(e)) && !_e(t.getFullYear(), t.getMonth(), t.getDate()) && (K.val(e), ye(t))
        }, X.show = function() {
            J = X.settings.view;
            var t, s = te(K.val() || (X.settings.start_date ? X.settings.start_date : ""));
            if (s ? (g = s.getMonth(), S = s.getMonth(), u = s.getFullYear(), I = s.getFullYear(), h = s.getDate(), _e(u, g, h) && (X.settings.strict && K.val(""), S = b, I = m)) : (S = b, I = m), T && (t = s || new Date, P = t.getHours(), F = t.getMinutes(), Z = t.getSeconds(), x = P >= 12 ? "pm" : "am", T.is12hour && (P = P % 12 == 0 ? 12 : P % 12), e.isArray(X.settings.enabled_hours) && -1 === e.inArray(P, X.settings.enabled_hours) && (P = X.settings.enabled_hours[0]), e.isArray(X.settings.enabled_minutes) && -1 === e.inArray(F, X.settings.enabled_minutes) && (F = X.settings.enabled_minutes[0]), e.isArray(X.settings.enabled_seconds) && -1 === e.inArray(Z, X.settings.enabled_seconds) && (Z = X.settings.enabled_seconds[0])), ue(), X.settings.always_visible instanceof jQuery) c.removeClass("dp_hidden").addClass("dp_visible");
            else {
                if (X.settings.container.is("body")) {
                    var i = c.outerWidth(),
                        n = c.outerHeight(),
                        a = (void 0 !== w ? w.offset().left + w.outerWidth(!0) : K.offset().left + K.outerWidth(!0)) + X.settings.offset[0],
                        r = (void 0 !== w ? w.offset().top : K.offset().top) - n + X.settings.offset[1],
                        o = e(window).width(),
                        d = e(window).height(),
                        l = e(window).scrollTop(),
                        _ = e(window).scrollLeft();
                    "below" === X.settings.default_position && (r = (void 0 !== w ? w.offset().top : K.offset().top) + X.settings.offset[1]), a + i > _ + o && (a = _ + o - i), a < _ && (a = _), r + n > l + d && (r = l + d - n), r < l && (r = l), c.css({
                        left: a,
                        top: r
                    })
                } else c.css({
                    left: 0,
                    top: 0
                });
                c.removeClass("dp_hidden").addClass("dp_visible"), le()
            }
            X.settings.onOpen && "function" == typeof X.settings.onOpen && X.settings.onOpen.call(K, K)
        }, X.update = function(t) {
            X.original_direction && (X.original_direction = X.direction), X.settings = e.extend(X.settings, t), ee(!0)
        };
        var te = function(t) {
                if (t += "", "" !== e.trim(t)) {
                    for (var s = ie(X.settings.format), i = ["d", "D", "j", "l", "N", "S", "w", "F", "m", "M", "n", "Y", "y", "G", "g", "H", "h", "i", "s", "a", "A"], n = [], a = [], r = null, o = null, d = 0; d < i.length; d++)(r = s.indexOf(i[d])) > -1 && n.push({
                        character: i[d],
                        position: r
                    });
                    if (n.sort(function(e, t) {
                            return e.position - t.position
                        }), e.each(n, function(e, t) {
                            switch (t.character) {
                                case "d":
                                    a.push("0[1-9]|[12][0-9]|3[01]");
                                    break;
                                case "D":
                                    a.push("[a-z]{3}");
                                    break;
                                case "j":
                                    a.push("[1-9]|[12][0-9]|3[01]");
                                    break;
                                case "l":
                                    a.push("[a-z]+");
                                    break;
                                case "N":
                                    a.push("[1-7]");
                                    break;
                                case "S":
                                    a.push("st|nd|rd|th");
                                    break;
                                case "w":
                                    a.push("[0-6]");
                                    break;
                                case "F":
                                    a.push("[a-z]+");
                                    break;
                                case "m":
                                    a.push("0[1-9]|1[012]");
                                    break;
                                case "M":
                                    a.push("[a-z]{3}");
                                    break;
                                case "n":
                                    a.push("[1-9]|1[012]");
                                    break;
                                case "Y":
                                    a.push("[0-9]{4}");
                                    break;
                                case "y":
                                    a.push("[0-9]{2}");
                                    break;
                                case "G":
                                    a.push("[1-9]|1[0-9]|2[0123]");
                                    break;
                                case "g":
                                    a.push("[0-9]|1[012]");
                                    break;
                                case "H":
                                    a.push("0[0-9]|1[0-9]|2[0123]");
                                    break;
                                case "h":
                                    a.push("0[0-9]|1[012]");
                                    break;
                                case "i":
                                case "s":
                                    a.push("0[0-9]|[12345][0-9]");
                                    break;
                                case "a":
                                    a.push("am|pm");
                                    break;
                                case "A":
                                    a.push("AM|PM")
                            }
                        }), a.length && (n.reverse(), e.each(n, function(e, t) {
                            s = s.replace(t.character, "(" + a[a.length - e - 1] + ")")
                        }), a = new RegExp("^" + s + "$", "ig"), o = a.exec(t))) {
                        var c, l, _ = new Date,
                            h = 1,
                            g = _.getMonth() + 1,
                            u = _.getFullYear(),
                            p = _.getHours(),
                            f = _.getMinutes(),
                            b = _.getSeconds(),
                            m = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                            y = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                            v = !0;
                        if (n.reverse(), e.each(n, function(t, s) {
                                if (!v) return !0;
                                switch (s.character) {
                                    case "m":
                                    case "n":
                                        g = me(o[t + 1]);
                                        break;
                                    case "d":
                                    case "j":
                                        h = me(o[t + 1]);
                                        break;
                                    case "D":
                                    case "l":
                                    case "F":
                                    case "M":
                                        l = "D" === s.character || "l" === s.character ? X.settings.days : X.settings.months, v = !1, e.each(l, function(e, i) {
                                            if (v) return !0;
                                            if (o[t + 1].toLowerCase() === i.substring(0, "D" === s.character || "M" === s.character ? 3 : i.length).toLowerCase()) {
                                                switch (s.character) {
                                                    case "D":
                                                        o[t + 1] = m[e].substring(0, 3);
                                                        break;
                                                    case "l":
                                                        o[t + 1] = m[e];
                                                        break;
                                                    case "F":
                                                        o[t + 1] = y[e], g = e + 1;
                                                        break;
                                                    case "M":
                                                        o[t + 1] = y[e].substring(0, 3), g = e + 1
                                                }
                                                v = !0
                                            }
                                        });
                                        break;
                                    case "Y":
                                        u = me(o[t + 1]);
                                        break;
                                    case "y":
                                        u = "19" + me(o[t + 1]);
                                        break;
                                    case "G":
                                    case "H":
                                    case "g":
                                    case "h":
                                        p = me(o[t + 1]);
                                        break;
                                    case "i":
                                        f = me(o[t + 1]);
                                        break;
                                    case "s":
                                        b = me(o[t + 1]);
                                        break;
                                    case "a":
                                    case "A":
                                        c = o[t + 1].toLowerCase()
                                }
                            }), v) {
                            var w = new Date(u, (g || 1) - 1, h || 1, p + ("pm" === c ? 12 : 0), f, b);
                            if (w.getFullYear() === u && w.getDate() === (h || 1) && w.getMonth() === (g || 1) - 1) return w
                        }
                    }
                    return !1
                }
            },
            se = function(t) {
                "firefox" === we.name ? t.css("MozUserSelect", "none") : "explorer" === we.name ? e(document).on("selectstart", t, function() {
                    return !1
                }) : t.mousedown(function() {
                    return !1
                })
            },
            ie = function(e) {
                return e.replace(/([-.,*+?^${}()|[\]\/\\])/g, "\\$1")
            },
            ne = function(t) {
                var s, i, n = "",
                    a = t.getDate(),
                    r = t.getDay(),
                    o = X.settings.days[r],
                    d = t.getMonth() + 1,
                    c = X.settings.months[d - 1],
                    l = t.getFullYear() + "",
                    _ = t.getHours(),
                    h = _ % 12 == 0 ? 12 : _ % 12,
                    g = t.getMinutes(),
                    u = t.getSeconds(),
                    p = _ >= 12 ? "pm" : "am";
                for (s = 0; s < X.settings.format.length; s++) switch (i = X.settings.format.charAt(s)) {
                    case "y":
                        l = l.substr(2);
                    case "Y":
                        n += l;
                        break;
                    case "m":
                        d = be(d, 2);
                    case "n":
                        n += d;
                        break;
                    case "M":
                        c = e.isArray(X.settings.months_abbr) && void 0 !== X.settings.months_abbr[d - 1] ? X.settings.months_abbr[d - 1] : X.settings.months[d - 1].substr(0, 3);
                    case "F":
                        n += c;
                        break;
                    case "d":
                        a = be(a, 2);
                    case "j":
                        n += a;
                        break;
                    case "D":
                        o = e.isArray(X.settings.days_abbr) && void 0 !== X.settings.days_abbr[r] ? X.settings.days_abbr[r] : X.settings.days[r].substr(0, 3);
                    case "l":
                        n += o;
                        break;
                    case "N":
                        r++;
                    case "w":
                        n += r;
                        break;
                    case "S":
                        n += a % 10 == 1 && "11" !== a ? "st" : a % 10 == 2 && "12" !== a ? "nd" : a % 10 == 3 && "13" !== a ? "rd" : "th";
                        break;
                    case "g":
                        n += h;
                        break;
                    case "h":
                        n += be(h, 2);
                        break;
                    case "G":
                        n += _;
                        break;
                    case "H":
                        n += be(_, 2);
                        break;
                    case "i":
                        n += be(g, 2);
                        break;
                    case "s":
                        n += be(u, 2);
                        break;
                    case "a":
                        n += p;
                        break;
                    case "A":
                        n += p.toUpperCase();
                        break;
                    default:
                        n += i
                }
                return n
            },
            ae = function() {
                var t, s, i, n, a, c, p, f, b, m, y = new Date(I, S + 1, 0).getDate(),
                    v = new Date(I, S, 1).getDay(),
                    w = new Date(I, S, 0).getDate(),
                    k = v - X.settings.first_day_of_week;
                for (k = k < 0 ? 7 + k : k, ge(X.settings.header_captions.days), s = "<tr>", X.settings.show_week_number && (s += "<th>" + X.settings.show_week_number + "</th>"), t = 0; t < 7; t++) s += "<th>" + (e.isArray(X.settings.days_abbr) && void 0 !== X.settings.days_abbr[(X.settings.first_day_of_week + t) % 7] ? X.settings.days_abbr[(X.settings.first_day_of_week + t) % 7] : X.settings.days[(X.settings.first_day_of_week + t) % 7].substr(0, 2)) + "</th>";
                for (s += "</tr><tr>", t = 0; t < 42; t++) t > 0 && t % 7 == 0 && (s += "</tr><tr>"), t % 7 == 0 && X.settings.show_week_number && (s += '<td class="dp_week_number">' + ve(new Date(I, S, t - k + 1)) + "</td>"), i = t - k + 1, X.settings.select_other_months && (t < k || i > y) && (a = (n = new Date(I, S, i)).getFullYear(), c = n.getMonth(), p = n.getDate(), n = a + be(c + 1, 2) + be(p, 2)), t < k ? s += '<td class="' + (X.settings.select_other_months && !_e(a, c, p) ? "dp_not_in_month_selectable date_" + n : "dp_not_in_month") + '">' + (X.settings.select_other_months || X.settings.show_other_months ? be(w - k + t + 1, X.settings.zero_pad ? 2 : 0) : "&nbsp;") + "</td>" : i > y ? s += '<td class="' + (X.settings.select_other_months && !_e(a, c, p) ? "dp_not_in_month_selectable date_" + n : "dp_not_in_month") + '">' + (X.settings.select_other_months || X.settings.show_other_months ? be(i - y, X.settings.zero_pad ? 2 : 0) : "&nbsp;") + "</td>" : (f = (X.settings.first_day_of_week + t) % 7, b = "", m = ce(I, S, i), _e(I, S, i) ? (e.inArray(f, X.settings.weekend_days) > -1 ? b = "dp_weekend_disabled" : b += " dp_disabled", S === o && I === d && r === i && (b += " dp_disabled_current"), "" !== m && (b += " " + m + "_disabled")) : (e.inArray(f, X.settings.weekend_days) > -1 && (b = "dp_weekend"), S === g && I === u && h === i && (b += " dp_selected"), S === o && I === d && r === i && (b += " dp_current"), "" !== m && (b += " " + m)), s += "<td" + ("" !== b ? ' class="' + e.trim(b) + '"' : "") + ">" + ((X.settings.zero_pad ? be(i, 2) : i) || "&nbsp;") + "</td>");
                s += "</tr>", l.html(e(s)), X.settings.always_visible && (_ = e("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_week_number)", l)), l.show()
            },
            re = function() {
                ge(X.settings.header_captions.months);
                var t, s, i = "<tr>";
                for (t = 0; t < 12; t++) t > 0 && t % 3 == 0 && (i += "</tr><tr>"), s = "dp_month_" + t, _e(I, t) ? s += " dp_disabled" : !1 !== g && g === t && I === u ? s += " dp_selected" : o === t && d === I && (s += " dp_current"), i += '<td class="' + e.trim(s) + '">' + (e.isArray(X.settings.months_abbr) && void 0 !== X.settings.months_abbr[t] ? X.settings.months_abbr[t] : X.settings.months[t].substr(0, 3)) + "</td>";
                i += "</tr>", M.html(e(i)), X.settings.always_visible && (C = e("td:not(.dp_disabled)", M)), M.show()
            },
            oe = function() {
                var t;
                t = '<tr class="dp_time_controls dp_time_controls_increase">' + (T.hours ? '<td class="dp_time_hour">&#9650;</td>' : "") + (T.minutes ? '<td class="dp_time_minute">&#9650;</td>' : "") + (T.seconds ? '<td class="dp_time_second">&#9650;</td>' : "") + (T.ampm ? '<td class="dp_time_ampm">&#9650;</td>' : "") + "</tr>", t += '<tr class="dp_time_elements">', T.hours && (t += '<td class="dp_disabled dp_time_hours">' + be(P, 2) + "</td>"), T.minutes && (t += '<td class="dp_disabled dp_time_minutes">' + be(F, 2) + "</td>"), T.seconds && (t += '<td class="dp_disabled dp_time_seconds">' + be(Z, 2) + "</td>"), T.ampm && (t += '<td class="dp_disabled dp_time_ampm">' + x.toUpperCase() + "</td>"), t += "</tr>", t += '<tr class="dp_time_controls dp_time_controls_decrease">' + (T.hours ? '<td class="dp_time_hour">&#9660;</td>' : "") + (T.minutes ? '<td class="dp_time_minute">&#9660;</td>' : "") + (T.seconds ? '<td class="dp_time_second">&#9660;</td>' : "") + (T.ampm ? '<td class="dp_time_ampm">&#9660;</td>' : "") + "</tr>", W.html(e(t)), W.show()
            },
            de = function() {
                ge(X.settings.header_captions.years);
                var t, s, i = "<tr>";
                for (t = 0; t < 12; t++) t > 0 && t % 3 == 0 && (i += "</tr><tr>"), s = "", _e(I - 7 + t) ? s += " dp_disabled" : u && u === I - 7 + t ? s += " dp_selected" : d === I - 7 + t && (s += " dp_current"), i += "<td" + ("" !== e.trim(s) ? ' class="' + e.trim(s) + '"' : "") + ">" + (I - 7 + t) + "</td>";
                i += "</tr>", L.html(e(i)), X.settings.always_visible && (Q = e("td:not(.dp_disabled)", L)), L.show()
            },
            ce = function(t, s, i) {
                var n, a, r;
                void 0 !== s && (s += 1);
                for (a in U)
                    if (n = U[a], r = !1, e.isArray(V[n]) && e.each(V[n], function() {
                            if (!r) {
                                var a, o = this;
                                if ((e.inArray(t, o[2]) > -1 || e.inArray("*", o[2]) > -1) && (void 0 !== s && e.inArray(s, o[1]) > -1 || e.inArray("*", o[1]) > -1) && (void 0 !== i && e.inArray(i, o[0]) > -1 || e.inArray("*", o[0]) > -1)) {
                                    if (o[3].indexOf("*") > -1) return r = n;
                                    if (a = new Date(t, s - 1, i).getDay(), e.inArray(a, o[3]) > -1) return r = n
                                }
                            }
                        }), r) return r;
                return r || ""
            },
            le = function(t) {
                var s, i;
                if ("explorer" === we.name && 6 === we.version) switch (O || (s = me(c.css("zIndex")) - 1, O = e("<iframe>", {
                    src: 'javascript:document.write("")',
                    scrolling: "no",
                    frameborder: 0,
                    css: {
                        zIndex: s,
                        position: "absolute",
                        top: -1e3,
                        left: -1e3,
                        width: c.outerWidth(),
                        height: c.outerHeight(),
                        filter: "progid:DXImageTransform.Microsoft.Alpha(opacity=0)",
                        display: "none"
                    }
                }), e("body").append(O)), t) {
                    case "hide":
                        O.hide();
                        break;
                    default:
                        i = c.offset(), O.css({
                            top: i.top,
                            left: i.left,
                            display: "block"
                        })
                }
            },
            _e = function(t, s, i) {
                var n, a, r, o;
                if (!(void 0 !== t && !isNaN(t) || void 0 !== s && !isNaN(s) || void 0 !== i && !isNaN(i))) return !1;
                if (t < 1e3) return !0;
                if (e.isArray(X.settings.direction) || 0 !== me(X.settings.direction)) {
                    if (n = me(fe(t, void 0 !== s ? be(s, 2) : "", void 0 !== i ? be(i, 2) : "")), 8 === (a = (n + "").length) && (void 0 !== j && n < me(fe(m, be(b, 2), be(f, 2))) || void 0 !== p && n > me(fe(A, be(D, 2), be(k, 2))))) return !0;
                    if (6 === a && (void 0 !== j && n < me(fe(m, be(b, 2))) || void 0 !== p && n > me(fe(A, be(D, 2))))) return !0;
                    if (4 === a && (void 0 !== j && n < m || void 0 !== p && n > A)) return !0
                }
                return void 0 !== s && (s += 1), r = !1, o = !1, e.isArray($) && $.length && e.each($, function() {
                    if (!r) {
                        var n, a = this;
                        if ((e.inArray(t, a[2]) > -1 || e.inArray("*", a[2]) > -1) && (void 0 !== s && e.inArray(s, a[1]) > -1 || e.inArray("*", a[1]) > -1) && (void 0 !== i && e.inArray(i, a[0]) > -1 || e.inArray("*", a[0]) > -1)) {
                            if (a[3].indexOf("*") > -1) return r = !0;
                            if (n = new Date(t, s - 1, i).getDay(), e.inArray(n, a[3]) > -1) return r = !0
                        }
                    }
                }), q && e.each(q, function() {
                    if (!o) {
                        var n, a = this;
                        if ((e.inArray(t, a[2]) > -1 || e.inArray("*", a[2]) > -1) && (o = !0, void 0 !== s))
                            if (o = !0, e.inArray(s, a[1]) > -1 || e.inArray("*", a[1]) > -1) {
                                if (void 0 !== i)
                                    if (o = !0, e.inArray(i, a[0]) > -1 || e.inArray("*", a[0]) > -1) {
                                        if (a[3].indexOf("*") > -1) return o = !0;
                                        if (n = new Date(t, s - 1, i).getDay(), e.inArray(n, a[3]) > -1) return o = !0;
                                        o = !1
                                    } else o = !1
                            } else o = !1
                    }
                }), (!q || !o) && !(!$ || !r)
            },
            he = function(e) {
                return (e + "").match(/^\-?[0-9]+$/)
            },
            ge = function(t) {
                !isNaN(parseFloat(S)) && isFinite(S) && (t = t.replace(/\bm\b|\bn\b|\bF\b|\bM\b/, function(t) {
                    switch (t) {
                        case "m":
                            return be(S + 1, 2);
                        case "n":
                            return S + 1;
                        case "F":
                            return X.settings.months[S];
                        case "M":
                            return e.isArray(X.settings.months_abbr) && void 0 !== X.settings.months_abbr[S] ? X.settings.months_abbr[S] : X.settings.months[S].substr(0, 3);
                        default:
                            return t
                    }
                })), !isNaN(parseFloat(I)) && isFinite(I) && (t = t.replace(/\bY\b/, I).replace(/\by\b/, (I + "").substr(2)).replace(/\bY1\b/i, I - 7).replace(/\bY2\b/i, I + 4)), e(".dp_caption", v).html(t)
            },
            ue = function() {
                var t, s, n;
                "" === l.text() || "days" === J ? ("" === l.text() ? (X.settings.always_visible instanceof jQuery || c.css("left", -1e3), c.css("visibility", "visible"), ae(), t = l.outerWidth(), s = l.outerHeight(), M.css({
                    width: t,
                    height: s
                }), L.css({
                    width: t,
                    height: s
                }), W.css({
                    width: t,
                    height: s + v.outerHeight(!0)
                }), v.css("width", t), y.css("width", t), c.css("visibility", "").addClass("dp_hidden")) : ae(), v.show(), M.hide(), L.hide(), W.hide(), Y.hide(), a.hide(), T && Y.show().removeClass("dp_timepicker_toggler_calendar")) : "months" === J ? (re(), l.hide(), L.hide(), W.hide(), Y.hide(), a.hide()) : "years" === J ? (de(), l.hide(), M.hide(), W.hide(), Y.hide(), a.hide()) : "time" === J && (oe(), 1 === B.length ? (Y.hide(), a.show()) : (Y.show().addClass("dp_timepicker_toggler_calendar"), "" === K.val() ? (Y.css("width", "100%"), a.hide()) : (Y.css("width", "50%"), a.show())), v.hide(), l.hide(), M.hide(), L.hide()), "time" !== J && X.settings.onChange && "function" == typeof X.settings.onChange && void 0 !== J && ((n = "days" === J ? l.find("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month)") : "months" === J ? M.find("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month)") : L.find("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month)")).each(function() {
                    var t;
                    "days" === J ? e(this).hasClass("dp_not_in_month_selectable") ? (t = e(this).attr("class").match(/date\_([0-9]{4})(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])/), e(this).data("date", t[1] + "-" + t[2] + "-" + t[3])) : e(this).data("date", I + "-" + be(S + 1, 2) + "-" + be(me(e(this).text()), 2)) : "months" === J ? (t = e(this).attr("class").match(/dp\_month\_([0-9]+)/), e(this).data("date", I + "-" + be(me(t[1]) + 1, 2))) : e(this).data("date", me(e(this).text()))
                }), X.settings.onChange.call(K, J, n, K)), y.show(), "time" === J && B.length > 1 ? (z.hide(), i.hide()) : (z.show(), i.show(), !0 === X.settings.show_clear_date || 0 === X.settings.show_clear_date && "" !== K.val() || X.settings.always_visible && !1 !== X.settings.show_clear_date ? N ? (z.css("width", "50%"), i.css("width", "50%")) : (z.hide(), i.css("width", "time" === J && 1 === B.length ? "50%" : "100%")) : (i.hide(), N ? z.css("width", "100%") : (z.hide(), T || y.hide())))
            },
            pe = function(e, t, s, i, n) {
                var a = new Date(e, t, s, T && T.hours ? P + (T.ampm && "pm" === x ? 12 : 0) : 12, T && T.minutes ? F : 0, T && T.seconds ? Z : 0),
                    r = "days" === i ? _ : "months" === i ? C : Q,
                    o = ne(a);
                K.val(o), (X.settings.always_visible || T) && (g = a.getMonth(), S = a.getMonth(), u = a.getFullYear(), I = a.getFullYear(), h = a.getDate(), n && r && (r.removeClass("dp_selected"), n.addClass("dp_selected"), "days" === i && n.hasClass("dp_not_in_month_selectable") && X.show())), T ? (J = "time", ue()) : (K.focus(), X.hide()), ye(a), X.settings.onSelect && "function" == typeof X.settings.onSelect && X.settings.onSelect.call(K, o, e + "-" + be(t + 1, 2) + "-" + be(s, 2), a, K, ve(a))
            },
            fe = function() {
                var e, t = "";
                for (e = 0; e < arguments.length; e++) t += arguments[e] + "";
                return t
            },
            be = function(e, t) {
                for (e += ""; e.length < t;) e = "0" + e;
                return e
            },
            me = function(e) {
                return parseInt(e, 10)
            },
            ye = function(t) {
                X.settings.pair && e.each(X.settings.pair, function() {
                    var s, i = e(this);
                    i.data && i.data("Zebra_DatePicker") ? ((s = i.data("Zebra_DatePicker")).update({
                        reference_date: t,
                        direction: 0 === s.settings.direction ? 1 : s.settings.direction
                    }), s.settings.always_visible && s.show()) : i.data("zdp_reference_date", t)
                })
            },
            ve = function(e) {
                var t, s, i, n, a, r, o, d = e.getFullYear(),
                    c = e.getMonth() + 1,
                    l = e.getDate();
                return c < 3 ? (i = (s = ((t = d - 1) / 4 | 0) - (t / 100 | 0) + (t / 400 | 0)) - (((t - 1) / 4 | 0) - ((t - 1) / 100 | 0) + ((t - 1) / 400 | 0)), n = 0, a = l - 1 + 31 * (c - 1)) : (n = (i = (s = ((t = d) / 4 | 0) - (t / 100 | 0) + (t / 400 | 0)) - (((t - 1) / 4 | 0) - ((t - 1) / 100 | 0) + ((t - 1) / 400 | 0))) + 1, a = l + ((153 * (c - 3) + 2) / 5 | 0) + 58 + i), r = (t + s) % 7, l = (a + r - n) % 7, o = a + 3 - l, o < 0 ? 53 - ((r - i) / 5 | 0) : o > 364 + i ? 1 : 1 + (o / 7 | 0)
            },
            we = {
                init: function() {
                    this.name = this.searchString(this.dataBrowser) || "", this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || ""
                },
                searchString: function(e) {
                    var t, s, i;
                    for (t = 0; t < e.length; t++)
                        if (s = e[t].string, i = e[t].prop, this.versionSearchString = e[t].versionSearch || e[t].identity, s) {
                            if (-1 !== s.indexOf(e[t].subString)) return e[t].identity
                        } else if (i) return e[t].identity
                },
                searchVersion: function(e) {
                    var t = e.indexOf(this.versionSearchString);
                    if (-1 !== t) return parseFloat(e.substring(t + this.versionSearchString.length + 1))
                },
                dataBrowser: [{
                    string: navigator.userAgent,
                    subString: "Firefox",
                    identity: "firefox"
                }, {
                    string: navigator.userAgent,
                    subString: "MSIE",
                    identity: "explorer",
                    versionSearch: "MSIE"
                }]
            };
        we.init(), ee()
    }, e.fn.Zebra_DatePicker = function(t) {
        return this.each(function() {
            void 0 !== e(this).data("Zebra_DatePicker") && e(this).data("Zebra_DatePicker").destroy();
            var s = new e.Zebra_DatePicker(this, t);
            e(this).data("Zebra_DatePicker", s)
        })
    }
});

$(document).ready(function() {
    $('#datepicker-example1').Zebra_DatePicker({
		default_position:'below',
		direction: 1
	});
});



