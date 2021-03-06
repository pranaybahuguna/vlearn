/*
 * jQuery timepicker addon
 * By: Trent Richardson [http://trentrichardson.com]
 * Version 0.9.7
 * Last Modified: 10/02/2011
 *
 * Copyright 2011 Trent Richardson
 * Dual licensed under the MIT and GPL licenses.
 * http://trentrichardson.com/Impromptu/GPL-LICENSE.txt
 * http://trentrichardson.com/Impromptu/MIT-LICENSE.txt
 *
 * HERES THE CSS:
 * .ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
 * .ui-timepicker-div dl { text-align: left; }
 * .ui-timepicker-div dl dt { height: 25px; }
 * .ui-timepicker-div dl dd { margin: -25px 10px 10px 65px; }
 * .ui-timepicker-div td { font-size: 90%; }
 * .ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }
 */

(function (e) {
    /* Check function jQuery.fn.timepicker exist*/
    if (e.fn.timepicker != undefined) {
        return;
    }
	function m() {
		this.regional = [];
		this.regional[""] = {currentText: "Now", closeText: "Done", ampm: false, amNames: ["AM", "A"], pmNames: ["PM", "P"], timeFormat: "hh:mm tt", timeSuffix: "", timeOnlyTitle: "Choose Time", timeText: "Time", hourText: "Hour", minuteText: "Minute", secondText: "Second", millisecText: "Millisecond", timezoneText: "Time Zone"};
		this._defaults = {showButtonPanel: true, timeOnly: false, showHour: true, showMinute: true, showSecond: false, showMillisec: false, showTimezone: false, showTime: true, stepHour: 0.05, stepMinute: 0.05,
			stepSecond                   : 0.05, stepMillisec: 0.5, hour: 0, minute: 0, second: 0, millisec: 0, timezone: "+0000", hourMin: 0, minuteMin: 0, secondMin: 0, millisecMin: 0, hourMax: 23, minuteMax: 59, secondMax: 59, millisecMax: 999, minDateTime: null, maxDateTime: null, onSelect: null, hourGrid: 0, minuteGrid: 0, secondGrid: 0, millisecGrid: 0, alwaysSetTime: true, separator: " ", altFieldTimeOnly: true, showTimepicker: true, timezoneIso8609: false, timezoneList: null};
		e.extend(this._defaults, this.regional[""])
	}

	e.extend(e.ui, {timepicker: {version: "0.9.7"}});
	e.extend(m.prototype,
		{$input                : null, $altInput: null, $timeObj: null, inst: null, hour_slider: null, minute_slider: null, second_slider: null, millisec_slider: null, timezone_select: null, hour: 0, minute: 0, second: 0, millisec: 0, timezone: "+0000", hourMinOriginal: null, minuteMinOriginal: null, secondMinOriginal: null, millisecMinOriginal: null, hourMaxOriginal: null, minuteMaxOriginal: null, secondMaxOriginal: null, millisecMaxOriginal: null, ampm: "", formattedDate: "", formattedTime: "", formattedDateTime: "", timezoneList: null, setDefaults: function (c) {
			var a = this._defaults,
				c = c || {};
			e.extend(a, c);
			for (var b in c)if (c[b] === null || c[b] === void 0)a[b] = c[b];
			return this
		}, _newInst            : function (c, a) {
			var b = new m, d = {}, f;
			for (f in this._defaults) {
				var g = c.attr("time:" + f);
				if (g)try {
					d[f] = eval(g)
				} catch (j) {
					d[f] = g
				}
			}
			b._defaults = e.extend({}, this._defaults, d, a, {beforeShow: function (c, d) {
				e.isFunction(a.beforeShow) && a.beforeShow(c, d, b)
			}, onChangeMonthYear                                        : function (d, f, g) {
				b._updateDateTime(g);
				e.isFunction(a.onChangeMonthYear) && a.onChangeMonthYear.call(c[0], d, f, g, b)
			}, onClose                                                  : function (d, f) {
				b.timeDefined ===
					true && c.val() != "" && b._updateDateTime(f);
				e.isFunction(a.onClose) && a.onClose.call(c[0], d, f, b)
			}, timepicker                                               : b});
			b.amNames = e.map(b._defaults.amNames, function (a) {
				return a.toUpperCase()
			});
			b.pmNames = e.map(b._defaults.pmNames, function (a) {
				return a.toUpperCase()
			});
			if (b._defaults.timezoneList === null) {
				d = [];
				for (f = -11; f <= 12; f++)d.push((f >= 0 ? "+" : "-") + ("0" + Math.abs(f).toString()).slice(-2) + "00");
				b._defaults.timezoneIso8609 && (d = e.map(d, function (a) {
					return a == "+0000" ? "Z" : a.substring(0, 3) + ":" + a.substring(3)
				}));
				b._defaults.timezoneList =
					d
			}
			b.hour = b._defaults.hour;
			b.minute = b._defaults.minute;
			b.second = b._defaults.second;
			b.millisec = b._defaults.millisec;
			b.ampm = "";
			b.$input = c;
			if (a.altField)b.$altInput = e(a.altField).css({cursor: "pointer"}).focus(function () {
				c.trigger("focus")
			});
			if (b._defaults.minDate == 0 || b._defaults.minDateTime == 0)b._defaults.minDate = new Date;
			if (b._defaults.maxDate == 0 || b._defaults.maxDateTime == 0)b._defaults.maxDate = new Date;
			if (b._defaults.minDate !== void 0 && b._defaults.minDate instanceof Date)b._defaults.minDateTime = new Date(b._defaults.minDate.getTime());
			if (b._defaults.minDateTime !== void 0 && b._defaults.minDateTime instanceof Date)b._defaults.minDate = new Date(b._defaults.minDateTime.getTime());
			if (b._defaults.maxDate !== void 0 && b._defaults.maxDate instanceof Date)b._defaults.maxDateTime = new Date(b._defaults.maxDate.getTime());
			if (b._defaults.maxDateTime !== void 0 && b._defaults.maxDateTime instanceof Date)b._defaults.maxDate = new Date(b._defaults.maxDateTime.getTime());
			return b
		}, _addTimePicker      : function (c) {
			this.timeDefined = this._parseTime(this.$altInput &&
				this._defaults.altFieldTimeOnly ? this.$input.val() + " " + this.$altInput.val() : this.$input.val());
			this._limitMinMaxDateTime(c, false);
			this._injectTimePicker()
		}, _parseTime          : function (c, a) {
			var b = this._defaults.timeFormat.toString().replace(/h{1,2}/ig, "(\\d?\\d)").replace(/m{1,2}/ig, "(\\d?\\d)").replace(/s{1,2}/ig, "(\\d?\\d)").replace(/l{1}/ig, "(\\d?\\d?\\d)").replace(/t{1,2}/ig, this._getPatternAmpm()).replace(/z{1}/ig, "(z|[-+]\\d\\d:?\\d\\d)?").replace(/\s/g, "\\s?") + this._defaults.timeSuffix + "$", d = this._getFormatPositions(),
				f = "";
			if (!this.inst)this.inst = e.datepicker._getInst(this.$input[0]);
			if (a || !this._defaults.timeOnly)b = ".{" + e.datepicker._get(this.inst, "dateFormat").length + ",}" + this._defaults.separator.replace(RegExp("[.*+?|()\\[\\]{}\\\\]", "g"), "\\$&") + b;
			if (b = c.match(RegExp(b, "i"))) {
				if (d.t !== -1)b[d.t] === void 0 || b[d.t].length === 0 ? this.ampm = f = "" : (f = e.inArray(b[d.t].toUpperCase(), this.amNames) !== -1 ? "AM" : "PM", this.ampm = this._defaults[f == "AM" ? "amNames" : "pmNames"][0]);
				if (d.h !== -1)this.hour = f == "AM" && b[d.h] == "12" ? 0 : f == "PM" &&
					b[d.h] != "12" ? (parseFloat(b[d.h]) + 12).toFixed(0) : Number(b[d.h]);
				if (d.m !== -1)this.minute = Number(b[d.m]);
				if (d.s !== -1)this.second = Number(b[d.s]);
				if (d.l !== -1)this.millisec = Number(b[d.l]);
				if (d.z !== -1 && b[d.z] !== void 0) {
					d = b[d.z].toUpperCase();
					switch (d.length) {
						case 1:
							d = this._defaults.timezoneIso8609 ? "Z" : "+0000";
							break;
						case 5:
							this._defaults.timezoneIso8609 && (d = d.substring(1) == "0000" ? "Z" : d.substring(0, 3) + ":" + d.substring(3));
							break;
						case 6:
							this._defaults.timezoneIso8609 ? d.substring(1) == "00:00" && (d = "Z") : d = d == "Z" ||
								d.substring(1) == "00:00" ? "+0000" : d.replace(/:/, "")
					}
					this.timezone = d
				}
				return true
			}
			return false
		}, _getPatternAmpm     : function () {
			var c = [];
			o = this._defaults;
			o.amNames && e.merge(c, o.amNames);
			o.pmNames && e.merge(c, o.pmNames);
			c = e.map(c, function (a) {
				return a.replace(/[.*+?|()\[\]{}\\]/g, "\\$&")
			});
			return"(" + c.join("|") + ")?"
		}, _getFormatPositions : function () {
			var c = this._defaults.timeFormat.toLowerCase().match(/(h{1,2}|m{1,2}|s{1,2}|l{1}|t{1,2}|z)/g), a = {h: -1, m: -1, s: -1, l: -1, t: -1, z: -1};
			if (c)for (var b = 0; b < c.length; b++)a[c[b].toString().charAt(0)] == -1 && (a[c[b].toString().charAt(0)] = b + 1);
			return a
		}, _injectTimePicker   : function () {
			var c = this.inst.dpDiv, a = this._defaults, b = this, d = (a.hourMax - (a.hourMax - a.hourMin) % a.stepHour).toFixed(0), f = (a.minuteMax - (a.minuteMax - a.minuteMin) % a.stepMinute).toFixed(0), g = (a.secondMax - (a.secondMax - a.secondMin) % a.stepSecond).toFixed(0), j = (a.millisecMax - (a.millisecMax - a.millisecMin) % a.stepMillisec).toFixed(0), h = this.inst.id.toString().replace(/([^A-Za-z0-9_])/g, "");
			if (c.find("div#ui-timepicker-div-" + h).length === 0 && a.showTimepicker) {
				var i =
					'<div class="ui-timepicker-div" id="ui-timepicker-div-' + h + '"><dl><dt class="ui_tpicker_time_label" id="ui_tpicker_time_label_' + h + '"' + (a.showTime ? "" : ' style="display:none;"') + ">" + a.timeText + '</dt><dd class="ui_tpicker_time" id="ui_tpicker_time_' + h + '"' + (a.showTime ? "" : ' style="display:none;"') + '></dd><dt class="ui_tpicker_hour_label" id="ui_tpicker_hour_label_' + h + '"' + (a.showHour ? "" : ' style="display:none;"') + ">" + a.hourText + "</dt>", q = 0, r = 0, m = 0, s = 0, l;
				if (a.showHour && a.hourGrid > 0) {
					i += '<dd class="ui_tpicker_hour"><div id="ui_tpicker_hour_' +
						h + '"' + (a.showHour ? "" : ' style="display:none;"') + '></div><div style="padding-left: 1px"><table class="ui-tpicker-grid-label"><tr>';
					for (var k = a.hourMin; k <= d; k += parseInt(a.hourGrid, 10)) {
						q++;
						var n = a.ampm && k > 12 ? k - 12 : k;
						n < 10 && (n = "0" + n);
						a.ampm && (k == 0 ? n = "12a" : n += k < 12 ? "a" : "p");
						i += "<td>" + n + "</td>"
					}
					i += "</tr></table></div></dd>"
				} else i += '<dd class="ui_tpicker_hour" id="ui_tpicker_hour_' + h + '"' + (a.showHour ? "" : ' style="display:none;"') + "></dd>";
				i += '<dt class="ui_tpicker_minute_label" id="ui_tpicker_minute_label_' +
					h + '"' + (a.showMinute ? "" : ' style="display:none;"') + ">" + a.minuteText + "</dt>";
				if (a.showMinute && a.minuteGrid > 0) {
					i += '<dd class="ui_tpicker_minute ui_tpicker_minute_' + a.minuteGrid + '"><div id="ui_tpicker_minute_' + h + '"' + (a.showMinute ? "" : ' style="display:none;"') + '></div><div style="padding-left: 1px"><table class="ui-tpicker-grid-label"><tr>';
					for (k = a.minuteMin; k <= f; k += parseInt(a.minuteGrid, 10))r++, i += "<td>" + (k < 10 ? "0" : "") + k + "</td>";
					i += "</tr></table></div></dd>"
				} else i += '<dd class="ui_tpicker_minute" id="ui_tpicker_minute_' +
					h + '"' + (a.showMinute ? "" : ' style="display:none;"') + "></dd>";
				i += '<dt class="ui_tpicker_second_label" id="ui_tpicker_second_label_' + h + '"' + (a.showSecond ? "" : ' style="display:none;"') + ">" + a.secondText + "</dt>";
				if (a.showSecond && a.secondGrid > 0) {
					i += '<dd class="ui_tpicker_second ui_tpicker_second_' + a.secondGrid + '"><div id="ui_tpicker_second_' + h + '"' + (a.showSecond ? "" : ' style="display:none;"') + '></div><div style="padding-left: 1px"><table><tr>';
					for (var p = a.secondMin; p <= g; p += parseInt(a.secondGrid, 10))m++, i += "<td>" +
						(p < 10 ? "0" : "") + p + "</td>";
					i += "</tr></table></div></dd>"
				} else i += '<dd class="ui_tpicker_second" id="ui_tpicker_second_' + h + '"' + (a.showSecond ? "" : ' style="display:none;"') + "></dd>";
				i += '<dt class="ui_tpicker_millisec_label" id="ui_tpicker_millisec_label_' + h + '"' + (a.showMillisec ? "" : ' style="display:none;"') + ">" + a.millisecText + "</dt>";
				if (a.showMillisec && a.millisecGrid > 0) {
					i += '<dd class="ui_tpicker_millisec ui_tpicker_millisec_' + a.millisecGrid + '"><div id="ui_tpicker_millisec_' + h + '"' + (a.showMillisec ? "" : ' style="display:none;"') +
						'></div><div style="padding-left: 1px"><table><tr>';
					for (k = a.millisecMin; k <= j; k += parseInt(a.millisecGrid, 10))s++, i += "<td>" + (k < 10 ? "0" : "") + p + "</td>";
					i += "</tr></table></div></dd>"
				} else i += '<dd class="ui_tpicker_millisec" id="ui_tpicker_millisec_' + h + '"' + (a.showMillisec ? "" : ' style="display:none;"') + "></dd>";
				i += '<dt class="ui_tpicker_timezone_label" id="ui_tpicker_timezone_label_' + h + '"' + (a.showTimezone ? "" : ' style="display:none;"') + ">" + a.timezoneText + "</dt>";
				i += '<dd class="ui_tpicker_timezone" id="ui_tpicker_timezone_' +
					h + '"' + (a.showTimezone ? "" : ' style="display:none;"') + "></dd>";
				i += "</dl></div>";
				$tp = e(i);
				a.timeOnly === true && ($tp.prepend('<div class="ui-widget-header ui-helper-clearfix ui-corner-all"><div class="ui-datepicker-title">' + a.timeOnlyTitle + "</div></div>"), c.find(".ui-datepicker-header, .ui-datepicker-calendar").hide());
				this.hour_slider = $tp.find("#ui_tpicker_hour_" + h).slider({orientation: "horizontal", value: this.hour, min: a.hourMin, max: d, step: a.stepHour, slide: function (a, c) {
					b.hour_slider.slider("option", "value",
						c.value);
					b._onTimeChange()
				}});
				this.minute_slider = $tp.find("#ui_tpicker_minute_" + h).slider({orientation: "horizontal", value: this.minute, min: a.minuteMin, max: f, step: a.stepMinute, slide: function (a, c) {
					b.minute_slider.slider("option", "value", c.value);
					b._onTimeChange()
				}});
				this.second_slider = $tp.find("#ui_tpicker_second_" + h).slider({orientation: "horizontal", value: this.second, min: a.secondMin, max: g, step: a.stepSecond, slide: function (a, c) {
					b.second_slider.slider("option", "value", c.value);
					b._onTimeChange()
				}});
				this.millisec_slider =
					$tp.find("#ui_tpicker_millisec_" + h).slider({orientation: "horizontal", value: this.millisec, min: a.millisecMin, max: j, step: a.stepMillisec, slide: function (a, c) {
						b.millisec_slider.slider("option", "value", c.value);
						b._onTimeChange()
					}});
				this.timezone_select = $tp.find("#ui_tpicker_timezone_" + h).append("<select></select>").find("select");
				e.fn.append.apply(this.timezone_select, e.map(a.timezoneList, function (a) {
					return e("<option />").val(typeof a == "object" ? a.value : a).text(typeof a == "object" ? a.label : a)
				}));
				this.timezone_select.val(typeof this.timezone !=
					"undefined" && this.timezone != null && this.timezone != "" ? this.timezone : a.timezone);
				this.timezone_select.change(function () {
					b._onTimeChange()
				});
				a.showHour && a.hourGrid > 0 && (l = 100 * q * a.hourGrid / (d - a.hourMin), $tp.find(".ui_tpicker_hour table").css({width: l + "%", marginLeft: l / (-2 * q) + "%", borderCollapse: "collapse"}).find("td").each(function () {
					e(this).click(function () {
						var c = e(this).html();
						if (a.ampm)var d = c.substring(2).toLowerCase(), c = parseInt(c.substring(0, 2), 10), c = d == "a" ? c == 12 ? 0 : c : c == 12 ? 12 : c + 12;
						b.hour_slider.slider("option",
							"value", c);
						b._onTimeChange();
						b._onSelectHandler()
					}).css({cursor: "pointer", width: 100 / q + "%", textAlign: "center", overflow: "hidden"})
				}));
				a.showMinute && a.minuteGrid > 0 && (l = 100 * r * a.minuteGrid / (f - a.minuteMin), $tp.find(".ui_tpicker_minute table").css({width: l + "%", marginLeft: l / (-2 * r) + "%", borderCollapse: "collapse"}).find("td").each(function () {
					e(this).click(function () {
						b.minute_slider.slider("option", "value", e(this).html());
						b._onTimeChange();
						b._onSelectHandler()
					}).css({cursor: "pointer", width: 100 / r + "%", textAlign: "center",
						overflow  : "hidden"})
				}));
				a.showSecond && a.secondGrid > 0 && $tp.find(".ui_tpicker_second table").css({width: l + "%", marginLeft: l / (-2 * m) + "%", borderCollapse: "collapse"}).find("td").each(function () {
					e(this).click(function () {
						b.second_slider.slider("option", "value", e(this).html());
						b._onTimeChange();
						b._onSelectHandler()
					}).css({cursor: "pointer", width: 100 / m + "%", textAlign: "center", overflow: "hidden"})
				});
				a.showMillisec && a.millisecGrid > 0 && $tp.find(".ui_tpicker_millisec table").css({width: l + "%", marginLeft: l / (-2 * s) + "%",
					borderCollapse                                                                       : "collapse"}).find("td").each(function () {
					e(this).click(function () {
						b.millisec_slider.slider("option", "value", e(this).html());
						b._onTimeChange();
						b._onSelectHandler()
					}).css({cursor: "pointer", width: 100 / s + "%", textAlign: "center", overflow: "hidden"})
				});
				d = c.find(".ui-datepicker-buttonpane");
				d.length ? d.before($tp) : c.append($tp);
				this.$timeObj = $tp.find("#ui_tpicker_time_" + h);
				if (this.inst !== null)c = this.timeDefined, this._onTimeChange(), this.timeDefined = c;
				c = function () {
					b._onSelectHandler()
				};
				this.hour_slider.bind("slidestop",
					c);
				this.minute_slider.bind("slidestop", c);
				this.second_slider.bind("slidestop", c);
				this.millisec_slider.bind("slidestop", c)
			}
		}, _limitMinMaxDateTime: function (c, a) {
			var b = this._defaults, d = new Date(c.selectedYear, c.selectedMonth, c.selectedDay);
			if (this._defaults.showTimepicker) {
				if (e.datepicker._get(c, "minDateTime") !== null && e.datepicker._get(c, "minDateTime") !== void 0 && d) {
					var f = e.datepicker._get(c, "minDateTime"), g = new Date(f.getFullYear(), f.getMonth(), f.getDate(), 0, 0, 0, 0);
					if (this.hourMinOriginal === null || this.minuteMinOriginal ===
						null || this.secondMinOriginal === null || this.millisecMinOriginal === null)this.hourMinOriginal = b.hourMin, this.minuteMinOriginal = b.minuteMin, this.secondMinOriginal = b.secondMin, this.millisecMinOriginal = b.millisecMin;
					if (c.settings.timeOnly || g.getTime() == d.getTime())if (this._defaults.hourMin = f.getHours(), this.hour <= this._defaults.hourMin)if (this.hour = this._defaults.hourMin, this._defaults.minuteMin = f.getMinutes(), this.minute <= this._defaults.minuteMin)this.minute = this._defaults.minuteMin, this._defaults.secondMin =
						f.getSeconds(); else if (this.second <= this._defaults.secondMin)this.second = this._defaults.secondMin, this._defaults.millisecMin = f.getMilliseconds(); else {
						if (this.millisec < this._defaults.millisecMin)this.millisec = this._defaults.millisecMin;
						this._defaults.millisecMin = this.millisecMinOriginal
					} else this._defaults.minuteMin = this.minuteMinOriginal, this._defaults.secondMin = this.secondMinOriginal, this._defaults.millisecMin = this.millisecMinOriginal; else this._defaults.hourMin = this.hourMinOriginal, this._defaults.minuteMin =
						this.minuteMinOriginal, this._defaults.secondMin = this.secondMinOriginal, this._defaults.millisecMin = this.millisecMinOriginal
				}
				if (e.datepicker._get(c, "maxDateTime") !== null && e.datepicker._get(c, "maxDateTime") !== void 0 && d) {
					f = e.datepicker._get(c, "maxDateTime");
					g = new Date(f.getFullYear(), f.getMonth(), f.getDate(), 0, 0, 0, 0);
					if (this.hourMaxOriginal === null || this.minuteMaxOriginal === null || this.secondMaxOriginal === null)this.hourMaxOriginal = b.hourMax, this.minuteMaxOriginal = b.minuteMax, this.secondMaxOriginal = b.secondMax,
						this.millisecMaxOriginal = b.millisecMax;
					if (c.settings.timeOnly || g.getTime() == d.getTime())if (this._defaults.hourMax = f.getHours(), this.hour >= this._defaults.hourMax)if (this.hour = this._defaults.hourMax, this._defaults.minuteMax = f.getMinutes(), this.minute >= this._defaults.minuteMax)this.minute = this._defaults.minuteMax, this._defaults.secondMax = f.getSeconds(); else if (this.second >= this._defaults.secondMax)this.second = this._defaults.secondMax, this._defaults.millisecMax = f.getMilliseconds(); else {
						if (this.millisec >
							this._defaults.millisecMax)this.millisec = this._defaults.millisecMax;
						this._defaults.millisecMax = this.millisecMaxOriginal
					} else this._defaults.minuteMax = this.minuteMaxOriginal, this._defaults.secondMax = this.secondMaxOriginal, this._defaults.millisecMax = this.millisecMaxOriginal; else this._defaults.hourMax = this.hourMaxOriginal, this._defaults.minuteMax = this.minuteMaxOriginal, this._defaults.secondMax = this.secondMaxOriginal, this._defaults.millisecMax = this.millisecMaxOriginal
				}
				a !== void 0 && a === true && (b = (this._defaults.hourMax -
					(this._defaults.hourMax - this._defaults.hourMin) % this._defaults.stepHour).toFixed(0), d = (this._defaults.minuteMax - (this._defaults.minuteMax - this._defaults.minuteMin) % this._defaults.stepMinute).toFixed(0), f = (this._defaults.secondMax - (this._defaults.secondMax - this._defaults.secondMin) % this._defaults.stepSecond).toFixed(0), g = (this._defaults.millisecMax - (this._defaults.millisecMax - this._defaults.millisecMin) % this._defaults.stepMillisec).toFixed(0), this.hour_slider && this.hour_slider.slider("option", {min: this._defaults.hourMin,
					max                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     : b}).slider("value", this.hour), this.minute_slider && this.minute_slider.slider("option", {min: this._defaults.minuteMin, max: d}).slider("value", this.minute), this.second_slider && this.second_slider.slider("option", {min: this._defaults.secondMin, max: f}).slider("value", this.second), this.millisec_slider && this.millisec_slider.slider("option", {min: this._defaults.millisecMin, max: g}).slider("value", this.millisec))
			}
		}, _onTimeChange       : function () {
			var c = this.hour_slider ? this.hour_slider.slider("value") : false, a = this.minute_slider ?
				this.minute_slider.slider("value") : false, b = this.second_slider ? this.second_slider.slider("value") : false, d = this.millisec_slider ? this.millisec_slider.slider("value") : false, f = this.timezone_select ? this.timezone_select.val() : false, g = this._defaults;
			typeof c == "object" && (c = false);
			typeof a == "object" && (a = false);
			typeof b == "object" && (b = false);
			typeof d == "object" && (d = false);
			typeof f == "object" && (f = false);
			c !== false && (c = parseInt(c, 10));
			a !== false && (a = parseInt(a, 10));
			b !== false && (b = parseInt(b, 10));
			d !== false && (d = parseInt(d,
				10));
			var j = g[c < 12 ? "amNames" : "pmNames"][0], h = c != this.hour || a != this.minute || b != this.second || d != this.millisec || this.ampm.length > 0 && c < 12 != (e.inArray(this.ampm.toUpperCase(), this.amNames) !== -1) || f != this.timezone;
			if (h) {
				if (c !== false)this.hour = c;
				if (a !== false)this.minute = a;
				if (b !== false)this.second = b;
				if (d !== false)this.millisec = d;
				if (f !== false)this.timezone = f;
				if (!this.inst)this.inst = e.datepicker._getInst(this.$input[0]);
				this._limitMinMaxDateTime(this.inst, true)
			}
			if (g.ampm)this.ampm = j;
			this._formatTime();
			this.$timeObj &&
			this.$timeObj.text(this.formattedTime + g.timeSuffix);
			this.timeDefined = true;
			h && this._updateDateTime()
		}, _onSelectHandler    : function () {
			var c = this._defaults.onSelect, a = this.$input ? this.$input[0] : null;
			c && a && c.apply(a, [this.formattedDateTime, this])
		}, _formatTime         : function (c, a, b) {
			if (b == void 0)b = this._defaults.ampm;
			var c = c || {hour: this.hour, minute: this.minute, second: this.second, millisec: this.millisec, ampm: this.ampm, timezone: this.timezone}, d = (a || this._defaults.timeFormat).toString(), f = parseInt(c.hour, 10);
			b && (!e.inArray(c.ampm.toUpperCase(),
				this.amNames) !== -1 && (f %= 12), f === 0 && (f = 12));
			d = d.replace(/(?:hh?|mm?|ss?|[tT]{1,2}|[lz])/g, function (a) {
				switch (a.toLowerCase()) {
					case "hh":
						return("0" + f).slice(-2);
					case "h":
						return f;
					case "mm":
						return("0" + c.minute).slice(-2);
					case "m":
						return c.minute;
					case "ss":
						return("0" + c.second).slice(-2);
					case "s":
						return c.second;
					case "l":
						return("00" + c.millisec).slice(-3);
					case "z":
						return c.timezone;
					case "t":
					case "tt":
						if (b) {
							var d = c.ampm;
							a.length == 1 && (d = d.charAt(0));
							return a.charAt(0) == "T" ? d.toUpperCase() : d.toLowerCase()
						}
						return""
				}
			});
			if (arguments.length)return d; else this.formattedTime = d
		}, _updateDateTime     : function (c) {
			c = this.inst || c;
			dt = new Date(c.selectedYear, c.selectedMonth, c.selectedDay);
			dateFmt = e.datepicker._get(c, "dateFormat");
			formatCfg = e.datepicker._getFormatConfig(c);
			timeAvailable = dt !== null && this.timeDefined;
			var a = this.formattedDate = e.datepicker.formatDate(dateFmt, dt === null ? new Date : dt, formatCfg);
			if (!(c.lastVal !== void 0 && c.lastVal.length > 0 && this.$input.val().length === 0)) {
				if (this._defaults.timeOnly === true)a = this.formattedTime;
				else if (this._defaults.timeOnly !== true && (this._defaults.alwaysSetTime || timeAvailable))a += this._defaults.separator + this.formattedTime + this._defaults.timeSuffix;
				this.formattedDateTime = a;
				this._defaults.showTimepicker ? this.$altInput && this._defaults.altFieldTimeOnly === true ? (this.$altInput.val(this.formattedTime), this.$input.val(this.formattedDate)) : (this.$altInput && this.$altInput.val(a), this.$input.val(a)) : this.$input.val(this.formattedDate);
				this.$input.trigger("change")
			}
		}});
	e.fn.extend({timepicker: function (c) {
		var c =
			c || {}, a = arguments;
		typeof c == "object" && (a[0] = e.extend(c, {timeOnly: true}));
		return e(this).each(function () {
			e.fn.datetimepicker.apply(e(this), a)
		})
	}, datetimepicker      : function (c) {
		var c = c || {}, a = arguments;
		return typeof c == "string" ? c == "getDate" ? e.fn.datepicker.apply(e(this[0]), a) : this.each(function () {
			var b = e(this);
			b.datepicker.apply(b, a)
		}) : this.each(function () {
			var a = e(this);
			a.datepicker(e.timepicker._newInst(a, c)._defaults)
		})
	}});
	e.datepicker._base_selectDate = e.datepicker._selectDate;
	e.datepicker._selectDate =
		function (c, a) {
			var b = this._getInst(e(c)[0]), d = this._get(b, "timepicker");
			d ? (d._limitMinMaxDateTime(b, true), b.inline = b.stay_open = true, this._base_selectDate(c, a), b.inline = b.stay_open = false, this._notifyChange(b), this._updateDatepicker(b)) : this._base_selectDate(c, a)
		};
	e.datepicker._base_updateDatepicker = e.datepicker._updateDatepicker;
	e.datepicker._updateDatepicker = function (c) {
		var a = c.input[0];
		if (!e.datepicker._curInst || !(e.datepicker._curInst != c && e.datepicker._datepickerShowing && e.datepicker._lastInput !=
			a))if (typeof c.stay_open !== "boolean" || c.stay_open === false)this._base_updateDatepicker(c), (a = this._get(c, "timepicker")) && a._addTimePicker(c)
	};
	e.datepicker._base_doKeyPress = e.datepicker._doKeyPress;
	e.datepicker._doKeyPress = function (c) {
		var a = e.datepicker._getInst(c.target), b = e.datepicker._get(a, "timepicker");
		if (b && e.datepicker._get(a, "constrainInput")) {
			var d = b._defaults.ampm, a = e.datepicker._possibleChars(e.datepicker._get(a, "dateFormat")), b = b._defaults.timeFormat.toString().replace(/[hms]/g, "").replace(/TT/g,
				d ? "APM" : "").replace(/Tt/g, d ? "AaPpMm" : "").replace(/tT/g, d ? "AaPpMm" : "").replace(/T/g, d ? "AP" : "").replace(/tt/g, d ? "apm" : "").replace(/t/g, d ? "ap" : "") + " " + b._defaults.separator + b._defaults.timeSuffix + (b._defaults.showTimezone ? b._defaults.timezoneList.join("") : "") + b._defaults.amNames.join("") + b._defaults.pmNames.join("") + a, d = String.fromCharCode(c.charCode === void 0 ? c.keyCode : c.charCode);
			return c.ctrlKey || d < " " || !a || b.indexOf(d) > -1
		}
		return e.datepicker._base_doKeyPress(c)
	};
	e.datepicker._base_doKeyUp = e.datepicker._doKeyUp;
	e.datepicker._doKeyUp = function (c) {
		var a = e.datepicker._getInst(c.target), b = e.datepicker._get(a, "timepicker");
		if (b && b._defaults.timeOnly && a.input.val() != a.lastVal)try {
			e.datepicker._updateDatepicker(a)
		} catch (d) {
			e.datepicker.log(d)
		}
		return e.datepicker._base_doKeyUp(c)
	};
	e.datepicker._base_gotoToday = e.datepicker._gotoToday;
	e.datepicker._gotoToday = function (c) {
		var a = this._getInst(e(c)[0]), b = a.dpDiv;
		this._base_gotoToday(c);
		var c = new Date, d = this._get(a, "timepicker");
		if (d._defaults.showTimezone && d.timezone_select) {
			var f =
				c.getTimezoneOffset(), g = f > 0 ? "-" : "+", f = Math.abs(f), j = f % 60, f = g + ("0" + (f - j) / 60).slice(-2) + ("0" + j).slice(-2);
			d._defaults.timezoneIso8609 && (f = f.substring(0, 3) + ":" + f.substring(3));
			d.timezone_select.val(f)
		}
		this._setTime(a, c);
		e(".ui-datepicker-today", b).click()
	};
	e.datepicker._disableTimepickerDatepicker = function (c) {
		var a = this._getInst(c), b = this._get(a, "timepicker");
		e(c).datepicker("getDate");
		if (b)b._defaults.showTimepicker = false, b._updateDateTime(a)
	};
	e.datepicker._enableTimepickerDatepicker = function (c) {
		var a =
			this._getInst(c), b = this._get(a, "timepicker");
		e(c).datepicker("getDate");
		if (b)b._defaults.showTimepicker = true, b._addTimePicker(a), b._updateDateTime(a)
	};
	e.datepicker._setTime = function (c, a) {
		var b = this._get(c, "timepicker");
		if (b) {
			var d = b._defaults, e = a ? a.getHours() : d.hour, g = a ? a.getMinutes() : d.minute, j = a ? a.getSeconds() : d.second, h = a ? a.getMilliseconds() : d.millisec;
			if (e < d.hourMin || e > d.hourMax || g < d.minuteMin || g > d.minuteMax || j < d.secondMin || j > d.secondMax || h < d.millisecMin || h > d.millisecMax)e = d.hourMin, g = d.minuteMin,
				j = d.secondMin, h = d.millisecMin;
			b.hour = e;
			b.minute = g;
			b.second = j;
			b.millisec = h;
			b.hour_slider && b.hour_slider.slider("value", e);
			b.minute_slider && b.minute_slider.slider("value", g);
			b.second_slider && b.second_slider.slider("value", j);
			b.millisec_slider && b.millisec_slider.slider("value", h);
			b._onTimeChange();
			b._updateDateTime(c)
		}
	};
	e.datepicker._setTimeDatepicker = function (c, a, b) {
		var c = this._getInst(c), d = this._get(c, "timepicker");
		d && (this._setDateFromField(c), a && (typeof a == "string" ? (d._parseTime(a, b), a = new Date,
			a.setHours(d.hour, d.minute, d.second, d.millisec)) : a = new Date(a.getTime()), a.toString() == "Invalid Date" && (a = void 0), this._setTime(c, a)))
	};
	e.datepicker._base_setDateDatepicker = e.datepicker._setDateDatepicker;
	e.datepicker._setDateDatepicker = function (c, a) {
		var b = this._getInst(c), d = a instanceof Date ? new Date(a.getTime()) : a;
		this._updateDatepicker(b);
		this._base_setDateDatepicker.apply(this, arguments);
		this._setTimeDatepicker(c, d, true)
	};
	e.datepicker._base_getDateDatepicker = e.datepicker._getDateDatepicker;
	e.datepicker._getDateDatepicker =
		function (c, a) {
			var b = this._getInst(c), d = this._get(b, "timepicker");
			return d ? (this._setDateFromField(b, a), (b = this._getDate(b)) && d._parseTime(e(c).val(), d.timeOnly) && b.setHours(d.hour, d.minute, d.second, d.millisec), b) : this._base_getDateDatepicker(c, a)
		};
	e.datepicker._base_parseDate = e.datepicker.parseDate;
	e.datepicker.parseDate = function (c, a, b) {
		var d;
		try {
			d = this._base_parseDate(c, a, b)
		} catch (e) {
			d = this._base_parseDate(c, a.substring(0, a.length - (e.length - e.indexOf(":") - 2)), b)
		}
		return d
	};
	e.datepicker._base_formatDate =
		e.datepicker._formatDate;
	e.datepicker._formatDate = function (c, a, b, d) {
		var e = this._get(c, "timepicker");
		return e ? (a && this._base_formatDate(c, a, b, d), e._updateDateTime(), e.$input.val()) : this._base_formatDate(c)
	};
	e.datepicker._base_optionDatepicker = e.datepicker._optionDatepicker;
	e.datepicker._optionDatepicker = function (c, a, b) {
		var d = this._get(this._getInst(c), "timepicker");
		if (d) {
			var e, g, j;
			if (typeof a == "string")a === "minDate" || a === "minDateTime" ? e = b : a === "maxDate" || a === "maxDateTime" ? g = b : a === "onSelect" && (j = b);
			else if (typeof a == "object")if (a.minDate)e = a.minDate; else if (a.minDateTime)e = a.minDateTime; else if (a.maxDate)g = a.maxDate; else if (a.maxDateTime)g = a.maxDateTime;
			if (e)e = e == 0 ? new Date : new Date(e), d._defaults.minDate = e, d._defaults.minDateTime = e; else if (g)g = g == 0 ? new Date : new Date(g), d._defaults.maxDate = g, d._defaults.maxDateTime = g; else if (j)d._defaults.onSelect = j
		}
		this._base_optionDatepicker(c, a, b)
	};
	e.timepicker = new m;
	e.timepicker.version = "0.9.7"
})(jQuery);