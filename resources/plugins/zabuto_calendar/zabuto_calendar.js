if (typeof jQuery == "undefined") {
    throw new Error("jQuery is not loaded")
}
$.fn.zabuto_calendar = function(b) {
    var c = $.extend({}, $.fn.zabuto_calendar_defaults(), b);
    var a = $.fn.zabuto_calendar_language(c.language);
    c = $.extend({}, c, a);
    this.each(function() {
        var i = $(this);
        i.attr("id", "zabuto_calendar_" + Math.floor(Math.random() * 99999).toString(36));
        i.data("initYear", c.year);
        i.data("initMonth", c.month);
        i.data("monthLabels", c.month_labels);
        i.data("weekStartsOn", c.weekstartson);
        i.data("navIcons", c.nav_icon);
        i.data("dowLabels", c.dow_labels);
        i.data("showToday", c.today);
        i.data("showDays", c.show_days);
        i.data("showPrevious", c.show_previous);
        i.data("showNext", c.show_next);
        i.data("cellBorder", c.cell_border);
        i.data("jsonData", c.data);
        i.data("ajaxSettings", c.ajax);
        i.data("legendList", c.legend);
        i.data("actionFunction", c.action);
        i.data("actionNavFunction", c.action_nav);
        k();

        function k() {
            var x = parseInt(i.data("initYear"));
            var A = parseInt(i.data("initMonth")) - 1;
            var C = new Date(x, A, 1, 0, 0, 0, 0);
            i.data("initDate", C);
            var D = (i.data("cellBorder") === true) ? " table-bordered" : "";
            var B = $('<table class="table' + D + '"></table>');
            B = u(i, B, C.getFullYear(), C.getMonth());
            var w = f(i);
            var y = $('<div class="zabuto_calendar"></div>');
            y.append(B);
            y.append(w);
            i.append(y);
            var z = i.data("jsonData");
            if (false !== z) {
                p(i, C.getFullYear(), C.getMonth())
            }
        }

        function u(y, A, x, z) {
            var w = new Date(x, z, 1, 0, 0, 0, 0);
            y.data("currDate", w);
            A.empty();
            A = q(y, A, x, z);
            A = d(y, A);
            A = o(y, A, x, z);
            p(y, x, z);
            return A
        }

        function f(y) {
            var w = $('<div class="legend" id="' + y.attr("id") + '_legend"></div>');
            var x = y.data("legendList");
            if (typeof(x) == "object" && x.length > 0) {
                $(x).each(function(C, E) {
                    if (typeof(E) == "object") {
                        if ("type" in E) {
                            var D = "";
                            if ("label" in E) {
                                D = E.label
                            }
                            switch (E.type) {
                                case "text":
                                    if (D !== "") {
                                        var B = "";
                                        if ("badge" in E) {
                                            if (typeof(E.classname) === "undefined") {
                                                var F = "badge-event"
                                            } else {
                                                var F = E.classname
                                            }
                                            B = '<span class="badge ' + F + '">' + E.badge + "</span> "
                                        }
                                        w.append('<span class="legend-' + E.type + '">' + B + D + "</span>")
                                    }
                                    break;
                                case "block":
                                    if (D !== "") {
                                        D = "<span>" + D + "</span>"
                                    }
                                    if (typeof(E.classname) === "undefined") {
                                        var A = "event"
                                    } else {
                                        var A = "event-styled " + E.classname
                                    }
                                    w.append('<span class="legend-' + E.type + '"><ul class="legend"><li class="' + A + '"></li></ul>' + D + "</span>");
                                    break;
                                case "list":
                                    if ("list" in E && typeof(E.list) == "object" && E.list.length > 0) {
                                        var z = $('<ul class="legend"></ul>');
                                        $(E.list).each(function(H, G) {
                                            z.append('<li class="' + G + '"></li>')
                                        });
                                        w.append(z)
                                    }
                                    break;
                                case "spacer":
                                    w.append('<span class="legend-' + E.type + '"> </span>');
                                    break
                            }
                        }
                    }
                })
            }
            return w
        }

        function q(E, D, G, M) {
            var L = E.data("navIcons");
            var A = $('<span><span class="fa fa-fw fa-chevron-left"></span></span>');
            var Q = $('<span><span class="fa fa-fw fa-chevron-right"></span></span>');
            if (typeof(L) === "object") {
                if ("prev" in L) {
                    A.html(L.prev)
                }
                if ("next" in L) {
                    Q.html(L.next)
                }
            }
            var K = E.data("showPrevious");
            if (typeof(K) === "number" || K === false) {
                K = n(E.data("showPrevious"), true)
            }
            var w = $('<div class="calendar-month-navigation"></div>');
            w.attr("id", E.attr("id") + "_nav-prev");
            w.data("navigation", "prev");
            if (K !== false) {
                var N = (M - 1);
                var F = G;
                if (N == -1) {
                    F = (F - 1);
                    N = 11
                }
                w.data("to", {
                    year: F,
                    month: (N + 1)
                });
                w.append(A);
                if (typeof(E.data("actionNavFunction")) === "function") {
                    w.click(E.data("actionNavFunction"))
                }
                w.click(function(R) {
                    u(E, D, F, N)
                })
            }
            var C = E.data("showNext");
            if (typeof(C) === "number" || C === false) {
                C = n(E.data("showNext"), false)
            }
            var z = $('<div class="calendar-month-navigation"></div>');
            z.attr("id", E.attr("id") + "_nav-next");
            z.data("navigation", "next");
            if (C !== false) {
                var x = (M + 1);
                var P = G;
                if (x == 12) {
                    P = (P + 1);
                    x = 0
                }
                z.data("to", {
                    year: P,
                    month: (x + 1)
                });
                z.append(Q);
                if (typeof(E.data("actionNavFunction")) === "function") {
                    z.click(E.data("actionNavFunction"))
                }
                z.click(function(R) {
                    u(E, D, P, x)
                })
            }
            var B = E.data("monthLabels");
            var J = $("<td></td>").append(w);
            var O = $("<td></td>").append(z);
            var H = $("<strong>" + B[M] + " " + G + "</strong>");
            H.dblclick(function() {
                var R = E.data("initDate");
                u(E, D, R.getFullYear(), R.getMonth())
            });
            var I = $('<td colspan="5"></td>');
            I.append(H);
            var y = $('<tr class="calendar-month-header"></tr>');
            y.append(J, I, O);
            D.append(y);
            return D
        }

        function d(z, B) {
            if (z.data("showDays") === true) {
                var w = z.data("weekStartsOn");
                var x = z.data("dowLabels");
                if (w === 0) {
                    var A = $.extend([], x);
                    var C = new Array(A.pop());
                    x = C.concat(A)
                }
                var y = $('<tr class="calendar-dow-header"></tr>');
                $(x).each(function(D, E) {
                    y.append("<th>" + E + "</th>")
                });
                B.append(y)
            }
            return B
        }

        function o(E, D, G, L) {
            var C = E.data("ajaxSettings");
            var F = r(G, L);
            var w = m(G, L);
            var B = h(G, L, 1);
            var N = h(G, L, w);
            var A = 1;
            var z = E.data("weekStartsOn");
            if (z === 0) {
                if (N == 6) {
                    F++
                }
                if (B == 6 && (N == 0 || N == 1 || N == 5)) {
                    F--
                }
                B++;
                if (B == 7) {
                    B = 0
                }
            }
            for (var y = 0; y < F; y++) {
                var x = $('<tr class="calendar-dow"></tr>');
                for (var I = 0; I < 7; I++) {
                    if (I < B || A > w) {
                        x.append("<td></td>")
                    } else {
                        var M = E.attr("id") + "_" + j(G, L, A);
                        var K = M + "_day";
                        var J = $('<div id="' + K + '" class="day" >' + A + "</div>");
                        J.data("day", A);
                        if (v(G, L, A)) {
                            J.addClass("today");
                            if (E.data("showToday") === true) {
                                J.html('<span class="badge badge-today">' + A + "</span>")
                            }
                        }
                        var H = $('<td id="' + M + '"></td>');
                        H.append(J);
                        H.data("date", j(G, L, A));
                        H.data("hasEvent", false);
                        if (typeof(E.data("actionFunction")) === "function") {
                            H.addClass("dow-clickable");
                            H.click(function() {
                                E.data("selectedDate", $(this).data("date"))
                            });
                            H.click(E.data("actionFunction"))
                        }
                        x.append(H);
                        A++
                    }
                    if (I == 6) {
                        B = 0
                    }
                }
                D.append(x)
            }
            return D
        }

        function g(z, F, E, H) {
            var G = $('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>');
            var y = $('<h4 class="modal-title" id="' + z + '_modal_title">' + F + "</h4>");
            var I = $('<div class="modal-header"></div>');
            I.append(G);
            I.append(y);
            var D = $('<div class="modal-body" id="' + z + '_modal_body">' + E + "</div>");
            var C = $('<div class="modal-footer" id="' + z + '_modal_footer"></div>');
            if (typeof(H) !== "undefined") {
                var x = $("<div>" + H + "</div>");
                C.append(x)
            }
            var A = $('<div class="modal-content"></div>');
            A.append(I);
            A.append(D);
            A.append(C);
            var w = $('<div class="modal-dialog"></div>');
            w.append(A);
            var B = $('<div class="modal fade" id="' + z + '_modal" tabindex="-1" role="dialog" aria-labelledby="' + z + '_modal_title" aria-hidden="true"></div>');
            B.append(w);
            B.data("dateId", z);
            B.attr("dateId", z);
            return B
        }

        function p(y, x, A) {
            var w = y.data("jsonData");
            var z = y.data("ajaxSettings");
            y.data("events", false);
            if (false !== w) {
                return l(y)
            } else {
                if (false !== z) {
                    return s(y, x, A)
                }
            }
            return true
        }

        function l(x) {
            var w = x.data("jsonData");
            x.data("events", w);
            e(x, "json");
            return true
        }

        function s(x, w, A) {
            var z = x.data("ajaxSettings");
            if (typeof(z) != "object" || typeof(z.url) == "undefined") {
                alert("Invalid calendar event settings");
                return false
            }
            var y = {
                year: w,
                month: (A + 1)
            };
            $.ajax({
                type: "GET",
                url: z.url,
                data: y,
                dataType: "json"
            }).done(function(B) {
                var C = [];
                $.each(B, function(E, D) {
                    C.push(B[E])
                });
                x.data("events", C);
                e(x, "ajax")
            });
            return true
        }

        function e(z, y) {
            var x = z.data("jsonData");
            var A = z.data("ajaxSettings");
            var w = z.data("events");
            if (w !== false) {
                $(w).each(function(F, H) {
                    var B = z.attr("id") + "_" + H.date;
                    var D = $("#" + B);
                    var I = $("#" + B + "_day");
                    D.data("hasEvent", true);
                    if (typeof(H.title) !== "undefined") {
                        D.attr("title", H.title)
                    }
                    if (typeof(H.classname) === "undefined") {
                        D.addClass("event")
                    } else {
                        D.addClass("event-styled");
                        I.addClass(H.classname)
                    }
                    if (typeof(H.badge) !== "undefined" && H.badge !== false) {
                        var C = (H.badge === true) ? "" : " badge-" + H.badge;
                        var E = I.data("day");
                        I.html('<span class="badge badge-event' + C + '">' + E + "</span>")
                    }
                    if (typeof(H.body) !== "undefined") {
                        var G = false;
                        if (y === "json" && typeof(H.modal) !== "undefined" && H.modal === true) {
                            G = true
                        } else {
                            if (y === "ajax" && "modal" in A && A.modal === true) {
                                G = true
                            }
                        }
                        if (G === true) {
                            D.addClass("event-clickable");
                            var J = g(B, H.title, H.body, H.footer);
                            $("body").append(J);
                            $("#" + B).click(function() {
                                $("#" + B + "_modal").modal()
                            })
                        }
                    }
                })
            }
        }

        function v(y, z, x) {
            var A = new Date();
            var w = new Date(y, z, x);
            return (w.toDateString() == A.toDateString())
        }

        function j(y, z, x) {
            var w, A;
            A = (x < 10) ? "0" + x : x;
            w = z + 1;
            w = (w < 10) ? "0" + w : w;
            return y + "-" + w + "-" + A
        }

        function h(y, z, x) {
            var w = new Date(y, z, x, 0, 0, 0, 0);
            var A = w.getDay();
            if (A == 0) {
                A = 6
            } else {
                A--
            }
            return A
        }

        function m(x, y) {
            var w = 28;
            while (t(x, y + 1, w + 1)) {
                w++
            }
            return w
        }

        function r(y, A) {
            var w = m(y, A);
            var C = h(y, A, 1);
            var z = h(y, A, w);
            var B = w;
            var x = (C - z);
            if (x > 0) {
                B += x
            }
            return Math.ceil(B / 7)
        }

        function t(z, w, x) {
            return w > 0 && w < 13 && z > 0 && z < 32768 && x > 0 && x <= (new Date(z, w, 0)).getDate()
        }

        function n(y, A) {
            if (y === false) {
                y = 0
            }
            var z = i.data("currDate");
            var x = i.data("initDate");
            var w;
            w = (x.getFullYear() - z.getFullYear()) * 12;
            w -= z.getMonth() + 1;
            w += x.getMonth();
            if (A === true) {
                if (w < (parseInt(y) - 1)) {
                    return true
                }
            } else {
                if (w >= (0 - parseInt(y))) {
                    return true
                }
            }
            return false
        }
    });
    return this
};
$.fn.zabuto_calendar_defaults = function() {
    var a = new Date();
    var c = a.getFullYear();
    var d = a.getMonth() + 1;
    var b = {
        language: false,
        year: c,
        month: d,
        show_previous: true,
        show_next: true,
        cell_border: false,
        today: true,
        show_days: true,
        weekstartson: 1,
        nav_icon: false,
        data: false,
        ajax: false,
        legend: false,
        action: false,
        action_nav: false
    };
    return b
};
$.fn.zabuto_calendar_language = function(a) {
    if (typeof(a) == "undefined" || a === false) {
        a = "en"
    }
    switch (a.toLowerCase()) {
        case "ar":
            return {
                month_labels: ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"],
                dow_labels: ["أثنين", "ثلاثاء", "اربعاء", "خميس", "جمعه", "سبت", "أحد"]
            };
            break;
        case "az":
            return {
                month_labels: ["Yanvar", "Fevral", "Mart", "Aprel", "May", "İyun", "İyul", "Avqust", "Sentyabr", "Oktyabr", "Noyabr", "Dekabr"],
                dow_labels: ["B.e", "Ç.A", "Çərş", "C.A", "Cümə", "Şən", "Baz"]
            };
            break;
        case "cn":
            return {
                month_labels: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                dow_labels: ["星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"]
            };
            break;
        case "cs":
            return {
                month_labels: ["Leden", "Únor", "Březen", "Duben", "Květen", "Červen", "Červenec", "Srpen", "Září", "Říjen", "Listopad", "Prosinec"],
                dow_labels: ["Po", "Út", "St", "Čt", "Pá", "So", "Ne"]
            };
            break;
        case "de":
            return {
                month_labels: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
                dow_labels: ["Mo", "Di", "Mi", "Do", "Fr", "Sa", "So"]
            };
            break;
        case "en":
            return {
                month_labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                dow_labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"]
            };
            break;
        case "he":
            return {
                month_labels: ["ינואר", "פברואר", "מרץ", "אפריל", "מאי", "יוני", "יולי", "אוגוסט", "ספטמבר", "אוקטובר", "נובמבר", "דצמבר"],
                dow_labels: ["ב", "ג", "ד", "ה", "ו", "ש", "א"]
            };
            break;
        case "es":
            return {
                month_labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                dow_labels: ["Lu", "Ma", "Mi", "Ju", "Vi", "Sá", "Do"]
            };
            break;
        case "fi":
            return {
                month_labels: ["Tammikuu", "Helmikuu", "Maaliskuu", "Huhtikuu", "Toukokuu", "Kesäkuu", "Heinäkuu", "Elokuu", "Syyskuu", "Lokakuu", "Marraskuu", "Joulukuu"],
                dow_labels: ["Ma", "Ti", "Ke", "To", "Pe", "La", "Su"]
            };
            break;
        case "fr":
            return {
                month_labels: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
                dow_labels: ["Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"]
            };
            break;
        case "hu":
            return {
                month_labels: ["Január", "Február", "Március", "Április", "Május", "Június", "Július", "Augusztus", "Szeptember", "Október", "November", "December"],
                dow_labels: ["Hé", "Ke", "Sze", "Cs", "Pé", "Szo", "Va"]
            };
            break;
        case "id":
            return {
                month_labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                dow_labels: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"]
            };
            break;
        case "it":
            return {
                month_labels: ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"],
                dow_labels: ["Lun", "Mar", "Mer", "Gio", "Ven", "Sab", "Dom"]
            };
            break;
        case "jp":
            return {
                month_labels: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
                dow_labels: ["月", "火", "水", "木", "金", "土", "日"]
            };
            break;
        case "kr":
            return {
                month_labels: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
                dow_labels: ["월", "화", "수", "목", "금", "토", "일"]
            };
            break;
        case "nl":
            return {
                month_labels: ["Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December"],
                dow_labels: ["Ma", "Di", "Wo", "Do", "Vr", "Za", "Zo"]
            };
            break;
        case "no":
            return {
                month_labels: ["Januar", "Februar", "Mars", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Desember"],
                dow_labels: ["Ma", "Ti", "On", "To", "Fr", "L\u00f8", "S\u00f8"]
            };
            break;
        case "pl":
            return {
                month_labels: ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"],
                dow_labels: ["pon.", "wt.", "śr.", "czw.", "pt.", "sob.", "niedz."]
            };
            break;
        case "pt":
            return {
                month_labels: ["Janeiro", "Fevereiro", "Marco", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                dow_labels: ["S", "T", "Q", "Q", "S", "S", "D"]
            };
            break;
        case "ru":
            return {
                month_labels: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
                dow_labels: ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вск"]
            };
            break;
        case "se":
            return {
                month_labels: ["Januari", "Februari", "Mars", "April", "Maj", "Juni", "Juli", "Augusti", "September", "Oktober", "November", "December"],
                dow_labels: ["Mån", "Tis", "Ons", "Tor", "Fre", "Lör", "Sön"]
            };
            break;
        case "sk":
            return {
                month_labels: ["Január", "Február", "Marec", "Apríl", "Máj", "Jún", "Júl", "August", "September", "Október", "November", "December"],
                dow_labels: ["Po", "Ut", "St", "Št", "Pi", "So", "Ne"]
            };
            break;
        case "tr":
            return {
                month_labels: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
                dow_labels: ["Pts", "Salı", "Çar", "Per", "Cuma", "Cts", "Paz"]
            };
            break;
        case "ua":
            return {
                month_labels: ["Січень", "Лютий", "Березень", "Квітень", "Травень", "Червень", "Липень", "Серпень", "Вересень", "Жовтень", "Листопад", "Грудень"],
                dow_labels: ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Нд"]
            };
            break
    }
};