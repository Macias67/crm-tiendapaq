;(function (d) {
	var style = d.createElement("style");
	var text  = ".fallback_viewer .cover,.fyu_symbol{-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;-webkit-touch-callout:none;-khtml-user-select:none}.fallback_viewer .cover,.fyu_symbol,.fyu_wrapper,.fyu_wrapper canvas,.noselect,body.noselect{-webkit-touch-callout:none}.fallback_root,.fyu_desc{visibility:hidden}.fyu_clickndrag,.fyu_controls a,.fyubtn,.fyuv .fyumsg{text-align:center;font-weight:700}.fyu_clickndrag,.fyu_wrapper,.fyubtn{font-family:Lato,HelveticaNeue-Light,Helvetica Neue Light,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif}.fyu_container{background-color:#666}.fyu_vertical{min-width:160px;min-height:284px;max-width:320px;max-height:568px}.fyu_horizontal{min-width:284px;min-height:160px;max-width:568px;max-height:320px}.fyu_wrapper{padding:0;margin:0;background:#393939;overflow:hidden;position:relative;-webkit-tap-highlight-color:transparent;tap-highlight-color:transparent}.fyu_wrapper>div{width:100%;height:100%;position:relative}.fyu_horizontal .fyu_wrapper>div{height:0;padding-bottom:56.25%}.fyu_vertical .fyu_wrapper>div{height:0;padding-bottom:177%}.fyu_wrapper embed,.fyu_wrapper object{height:100%;width:100%}.fyu_wrapper a{text-decoration:none;color:#fff}.fyu_wrapper .plBtn{cursor:pointer;display:block;width:460px;height:460px;z-index:9999;background:url(https://fyu.se/assets/viewer/arr-h.png) center center no-repeat;position:absolute;left:50%;top:50%;margin-left:-230px;margin-top:-230px}.fyu_wrapper .plBtn.vrt{background:url(https://fyu.se/assets/viewer/arr-v.png) center center no-repeat}.plBtn:hover{opacity:.85}.fallback_root,.fyuv .fyumsg.hidden,.fyuv:hover .fyumsg,.fyv:hover .fyu_clickndrag,.noselect.fyuse .fyumsg{opacity:0}.no_viewer .links{margin:-80px 0 0;position:absolute;z-index:2;text-align:center;left:0;right:0;top:50%}.no_viewer .links a{display:block;width:180px;background:#fafafa;margin:10px auto;height:27px;padding:12px 0;border:1px solid #aaa;font-weight:400;font-size:18px;border-radius:0;text-shadow:0 1px 1px #fff}.no_viewer{height:100%;background:#fff}.fallback_viewer img.act{display:block}.fallback_viewer img{position:absolute;top:0;left:0;z-index:100;display:none;-webkit-transform:translate3d(0,0,0);-moz-transform:translate3d(0,0,0);transform:translate3d(0,0,0)}.fallback_viewer,.fyuse_tag{-webkit-transform:translate3d(0,0,0)}.fallback_viewer .cover{width:100%;height:100%;position:absolute;z-index:101;user-select:none}.portr .fallback_viewer{max-height:450px}.fallback_viewer{width:100%;height:100%;top:0;position:absolute;left:0;overflow:hidden;opacity:0;-moz-transform:translate3d(0,0,0);transform:translate3d(0,0,0);-webkit-transition:opacity .3s;transition:opacity .3s}.lands img{height:100%}.lands.ratioSmall img{width:100%;height:auto}.portr.ratioSmall img{height:100%}.portr.ratioSmall .fallback_viewer,.portr.ratioSmall>img{max-height:580px}.mobile .vert #cnt .inner{max-height:900px}.lands.ratioSmall div img,.portr.ratioLarge div img{max-height:inherit}.portr.ratioSmall div img{max-height:inherit;height:auto;width:100%}.fyuv img,.fyv img{display:block;margin:0 auto}.fyuv.horiz,.fyv.horiz{cursor:url(https://fyu.se/assets/viewer/cursor_h.gif) 24 16,col-resize}.fyuv.vert,.fyv.vert{cursor:url(https://fyu.se/assets/viewer/cursor_v.gif) 16 24,row-resize}body.fyuse .horiz{cursor:url(https://fyu.se/assets/viewer/cursor_hgrab.gif) 24 16,col-resize}body.fyuse .vert{cursor:url(https://fyu.se/assets/viewer/cursor_vgrab.gif) 16 24,row-resize}.fyuv,.fyv{overflow:hidden;display:block;position:relative;cursor:default;height:100%;width:100%}.fyu_wrapper canvas{position:absolute;left:0;top:0;-webkit-tap-highlight-color:transparent;tap-highlight-color:transparent}.fyu_clickndrag,.fyuv .fyumsg{display:block;position:absolute;z-index:100;background:rgba(0,0,0,.6);color:#f7f7f7;width:100%;height:30px;line-height:30px;top:50%;margin-top:-15px;left:0;font-size:14px;opacity:.9;right:0;cursor:inherit;-webkit-transition:opacity .3s;-moz-transition:opacity .3s;transition:opacity .3s}.fyu_controls a,.fyu_controls a:hover{color:#fff;text-decoration:none}.fyu_dschldr,.fyu_symbol{cursor:auto}.fyu_symbol{background:url(https://fyu.se/assets/symbol.png) 37px 37px no-repeat;width:100px;height:100px;display:block;position:absolute;left:-22px;top:-22px;z-index:101;background-size:48px;user-select:none}a.fyu_symbol{cursor:pointer}.noselect,body.noselect{cursor:default;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.fyu_wrapper .ldr2{overflow:visible}body .ldr.stopped,body .ldr2.stopped i,body .ldr2.stopped span,body .stopped .ldr2 i,body .stopped .ldr2 span{opacity:0;-webkit-animation-state:paused}.fyu_wrapper .clear{clear:both!important}@-moz-keyframes spin{0%{-moz-transform:rotate(0)}100%{-moz-transform:rotate(360deg)}}@-webkit-keyframes spin{0%{-webkit-transform:rotate(0)}100%{-webkit-transform:rotate(360deg)}}.fyu_wrapper #svg{-webkit-transform:rotate(-92deg);-moz-transform:rotate(-92deg);transform:rotate(-92deg);transition:opacity .2s}.fyu_wrapper #svg circle{stroke-dashoffset:0;stroke:rgba(90,90,90,.6);stroke-width:8px}.fyu_wrapper #svg #bar{stroke:#d84a3a}.fyu_wrapper #svg.fade{opacity:0}.fyu_controls{position:absolute;right:8px;bottom:6px;height:40px;opacity:0;-webkit-transition:opacity .38s;transition:opacity .38s}.fyuv:hover .fyu_controls{opacity:1}.fyu_controls a{height:36px;width:36px;display:block;border-radius:20px;background:rgba(0,0,0,.62);float:left;margin-right:5px;line-height:37px;font-size:8px;cursor:pointer;opacity:.78}.fyu_controls a.x2{background:url(https://fyu.se/assets/viewer/x2.png) 1px 6px no-repeat rgba(0,0,0,.62);background-size:32px}.fyu_controls .pause.paused span{display:none}.fyu_controls .play>span{margin:3px 5px}.fyu_controls .play span span{width:3px;height:13px;background:#f6f6f6;display:block;float:left;margin-right:3px}.fyu_controls .play .pause.paused{position:absolute;top:6px;left:10px;width:0;height:0;border-style:solid;border-width:9px 0 9px 11px;border-color:transparent transparent transparent #fff}.fyu_controls .play .pause.playing{display:block;height:15px;width:20px;position:absolute;top:9px;left:8px}.fyu_desc{position:absolute;left:0;top:0;right:0;height:31px;padding:20px 74px;color:#f7f7f7;background:rgba(0,0,0,.65);font-weight:700;font-size:12px;opacity:0;-webkit-transition:opacity .3s;transition:opacity .3s}.fyuv .fyu_lftbrdr,.fyuv .fyu_rghtbrdr{height:100%;width:88px;top:0;z-index:999;position:absolute}.fyu_dschldr:hover .fyu_desc{opacity:1;visibility:visible}.fyuv .fyu_lftbrdr{background-image:-webkit-gradient(linear,left top,right top,from(rgba(250,250,250,.8)),to(rgba(255,255,255,0)));left:-100px;-webkit-transition:transform .01s;transition:transform .01s}.fyuv .fyu_rghtbrdr{background-image:-webkit-gradient(linear,left top,right top,from(rgba(255,255,255,0)),to(rgba(250,250,250,.8)));right:-100px;-webkit-transition:transform .01s;transition:transform .01s}.fyuv.dy .fyu_rghtbrdr{background-image:-webkit-gradient(linear,left top,left bottom,from(rgba(255,255,255,0)),to(rgba(250,250,250,.8)));right:0;bottom:-100px;left:0;top:auto;height:100px;width:100%}.fyuv.dy .fyu_lftbrdr{background-image:-webkit-gradient(linear,left top,left bottom,from(rgba(250,250,250,.8)),to(rgba(255,255,255,0)));right:0;top:-100px;left:0;height:100px;width:100%}.fyuse_tag{font-size:.82em;background:rgba(241,146,17,.86);border-radius:2px;color:#fff;position:absolute;z-index:98;width:auto;height:auto;display:none;padding:5px 13px 6px;line-height:1;max-width:160px}.fyuse_tag:before{border:solid;border-color:rgba(241,146,17,.86) transparent;border-width:0 6px 6px;top:-6px;left:calc(50% - 6px);position:absolute;z-index:99}.fyuse_tag a{opacity:.9;color:#fff;cursor:pointer}.fyuse_tag_user a:hover{text-decoration:none}.fyubtn{position:absolute;display:block;border-radius:20px;width:30px;height:30px;background:rgba(0,0,0,.8);line-height:30px;color:#f0f0f0;font-size:10px;opacity:0;cursor:pointer;bottom:10px}.fyubtn.x2{right:10px}.fyubtn.tags{right:46px}.fyv:hover .fyubtn{opacity:.7}";
	style.setAttribute("type", "text/css");
	if (style.styleSheet) {
		style.styleSheet.cssText = text;
	}
	else {
		var textnode = document.createTextNode(text);
		style.appendChild(textnode);
	}
	!function (e, t) {
		"use strict";
		function n(e) {
			requestAnimFrame(function () {
				i(e)
			})
		}

		function i(e) {
			var t = e.listeners;
			if (e.is_rendering) {
				var i = e.sens;
				!t.focus && .5 > i && (i = .5);
				var r = 0, a = 3 / e.sens, o = p.info.has_touch ? 7 : 10;
				switch (e.direction) {
					case 0:
						r = t.x - t.rx;
						break;
					case 1:
						r = -(t.x - t.rx);
						break;
					case 2:
						r = -(t.y - t.ry);
						break;
					case 3:
						r = t.y - t.ry
				}
				var s = t.active_frame;
				if (0 !== r) {
					var l = t.active_frame;
					0 > r ? (e.config.fy.l[1] >= t.active_frame && (l = t.active_frame + (r / a << 0)), l !== t.active_frame && (t.active_frame = l, t.focus
						? (t.rx = t.x, t.ry = t.y) : (t.rx = t.ry = 0, t.x = t.y = 0)), t.active_frame = t.active_frame > 0 ? t.active_frame
						: 0, Math.abs(t.active_frame - e.renderer.visible_frame) > o && (s = e.renderer.visible_frame - o))
						: (e.config.fy.l[0] <= t.active_frame && (l = t.active_frame + (r / a << 0)), l !== t.active_frame && (t.active_frame = l, t.focus
						? (t.rx = t.x, t.ry = t.y) : (t.rx = t.ry = 0, t.x = t.y = 0)), t.active_frame = t.active_frame < e.config.fy.f - 1 ? t.active_frame
						: e.config.fy.f - 1)
				}
				Math.abs(t.active_frame - e.renderer.visible_frame) > o && (s = t.active_frame > e.renderer.visible_frame ? e.renderer.visible_frame + o
					: e.renderer.visible_frame - o), t.active_frame != e.renderer.visible_frame && e.renderer.displayFrame(s, e), n(e)
			}
		}

		function r(e) {
			var t = e.config.fy.t / 1;
			if (!e.renderer.displayFrame(t, e) && !e.renderer.displayFrame(t + 1, e) && t > 0) {
				for (; !e.renderer.displayFrame(--t, e) && 0 !== t;) {
					;
				}
			}
			if (e.controls = p.setupControls(e, t), p.autoplay && !p.info.has_touch && e.config.autoplay) {
				var n                = e.config.fy.f - 1;
				e.listeners.autoplay = new p.autoplay(e, 3080 + 10 * n, null, function (t) {
					var i = Math.round(n * t);
					e.renderer.displayFrame(i, e), e.listeners.active_frame = i
				})
			}
		}

		function a(e) {
			e.requestAnimFrame = function () {
				return e.requestAnimationFrame || e.webkitRequestAnimationFrame || e.mozRequestAnimationFrame || function (t) {
						e.setTimeout(t, 1e3 / 60)
					}
			}()
		}

		function o(e, t) {
			return new e(t)
		}

		function s(e) {
			var t = e.config.fy.p;
			return t ? (t /= 1, e.more = {tags: 0 !== (1 & t) ? !0 : !1, pano: 0 !== (8 & t) ? !0 : !1, tweens: 0 !== (2 & t) ? !0 : !1}, !0) : !1
		}

		function l(t, n, i, r) {
			if (e.URL) {
				p.utils.downloadBase(t, "blob", function (e) {
					e.size > 512 ? i(e, t, n) : r(t, n)
				}, function () {
					r(t, n)
				});
			}
			else {
				var a = new Image;
				a.onload = function () {
					i(a, t, n)
				}, a.onerror = function () {
					r(t, n)
				}, a.src = t
			}
		}

		function c(e, t) {
			var n = p.entries.length, i = null, r = null;
			if (n > 0) {
				for (; 0 !== n--;) {
					if (i = p.entries[n], i && i.events[e]) {
						for (r = i.events[e].length; r-- > 0;) {
							i.events[e][r](t, i)
						}
					}
				}
			}
		}

		function d(e, t, n) {
			var i;
			return function () {
				var r = this, a = arguments, o = function () {
					i = null, n || e.apply(r, a)
				}, s  = n && !i;
				clearTimeout(i), i = setTimeout(o, t), s && e.apply(r, a)
			}
		}

		function u(e) {
			var t = e.getBoundingClientRect(), n = function (e) {
				return e.top >= -e.height && e.left >= -e.width && e.bottom <= (window.innerHeight || document.documentElement.clientHeight) + e.height && e.right <= (window.innerWidth || document.documentElement.clientWidth) + e.width
			}, i  = function (e) {
				return e.offsetHeight > 0
			}, r  = e.parentNode.parentNode;
			return -1 !== r.id.indexOf("swipeview-masterpage") && n(t) ? "swipeview-active" === r.className : n(t) && i(e)
		}

		a(e);
		var f = "https://fyu.se/assets/2.0/viewer/", h = 0, p = e.fyu || {};
		!p.entries && (p.entries = []), !p.info && (p.info = {}), p.root_path = f, e.fyu = p, p.addViewer = function (e, n, i, r) {
			var a = e, o = e;
			if (++h, "string" == typeof e ? o = t.getElementById(e) : a = o.id ? o.id : "fyu" + h, o) {
				var s = new y(o, n, i, r, h);
				return s.o_id = a, o.id = a, p.entries.push(s), s
			}
			return !1
		}, p.removeViewer = function (e) {
			var t = p.entries.length;
			if (0 === t) {
				return !1;
			}
			if ("string" == typeof e) {
				for (; 0 !== t--;) {
					if (p.entries[t].id === e) {
						return p.entries[t].destroy(), p.entries[t] = null, p.entries.splice(t, 1), p.utils.req.abortAll(), t
					}
				}
			}
			else {
				for (; 0 !== t--;) {
					if (p.entries[t] === e) {
						return p.entries[t].destroy(), p.entries[t] = null, p.entries.splice(t, 1), p.utils.req.abortAll(), t;
					}
				}
			}
			return !1
		}, p.renderOnViewport = d(function () {
			var e = p.entries.length, t = null;
			if (e > 0) {
				for (; 0 !== e--;) {
					t = p.entries[e], t && (t.onviewport = u(t.el))
				}
			}
		}, 220);
		var m = 960, v = 540, g = {}, y = function (n, i, r, a, l) {
			var c = a.fy, d = 0;
			c.w > c.h ? (a.fy.ratio = m / v, d = Math.ceil(m / (c.w / c.h)))
				: (a.fy.ratio = v / m, d = Math.ceil(m * (c.w / c.h))), a.stab_scale = !1, a.fy.g && (a.stab_scale = a.fy.w / a.fy.cw * a.fy.g);
			var u = t.createElement("div");
			if (n.appendChild(u), this.el = u, this.path = r, this.config = a, this.sens = c["<"] || 1, this.loaded = !1, this.loaded_full = !1, this.loaded_frames = 0, this.onviewport = !0, this.imgdata = [], this.events = {}, this.id = l, this.o_id = null, this.f_uid = i, -1 === a.fy.l[1] && (a.fy.l[1] = a.fy.f - 1), a.fy.t < 0 && (a.fy.t = 0), a.embed = -1 !== e.location.href.indexOf("embed"), 1 === a.fy.m
					? this.direction = Math.abs(c.dy) > Math.abs(c.dx) ? c.dy < 0 ? 0 : 1 : c.dx < 0 ? 2 : 3 : this.direction = Math.abs(c.dx) > Math.abs(c.dy)
					? c.dx < 0 ? 0 : 1 : c.dy < 0 ? 2
						                                                                                                            : 3, this.events.resize = [], this.events.ondrag = [], !t.addEventListener || -1 !== e.navigator.userAgent.indexOf("6.0.5 Safari/")) {
				var h = 0;
				try {
					try {
						var g = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");
						try {
							g.AllowScriptAccess = "always"
						}
						catch (y) {
							return "6,0,0"
						}
					}
					catch (y) {
					}
					h = new ActiveXObject("ShockwaveFlash.ShockwaveFlash").GetVariable("$version").replace(/\D+/g, ",").match(/^,?(.+),?$/)[1], h = h.split(",").shift() / 1
				}
				catch (y) {
					try {
						navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin && (h = (navigator.plugins["Shockwave Flash 2.0"] || navigator.plugins["Shockwave Flash"]).description.replace(/\D+/g, ",").match(/^,?(.+),?$/)[1], h = h.split(",").shift() / 1)
					}
					catch (y) {
					}
				}
				if (15 >= h) {
					var w = document.createElement("div");
					w.cssText = "position:absolute;width:100%;height:100%;left:0;top:0", w.innerHTML = '<img style="width:128px;height:128px;margin:0 auto;display:block;border:0" src="https://fyu.se/assets/2.0/viewer/ie.png" /><p style="width:80%;max-width:300px;text-align:center;color:#333;margin:0 auto;margin-top:10%">Oops, your browser is sadly unsupported</p>', this.el.appendChild(w)
				}
				else {
					var b = f + "FyuseViewer.swf?id=" + i, _ = t.createElement("div");
					_.style.cssText = "position:absolute;width:100%;height:100%;left:0;top:0", t.addEventListener
						? _.innerHTML = '<object data="' + b + '&autoplay=1" class="viewer"><param name="allowScriptAccess" value="always"><param name="hasPriority" value="true"><param name="wmode" value="opaque"><param name="movie" value="' + b + '&autoplay=1"></object>'
						: _.innerHTML = '<object style="width:100%;height:100%" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" data="' + b + '&autoplay=1" class="viewer"><param name="allowScriptAccess" value="always"> <param name="movie" value="' + b + '&autoplay=1"> <param name="wmode" value="opaque"><param name="hasPriority" value="true"></object>', this.el.appendChild(_)
				}
				return this
			}
			this.renderer = new p.renderer(this, p.info.has_touch ? "canvas" : "canvas_big", c.w > c.h ? m : d, c.w > c.h ? d
				: m), this.el.appendChild(this.renderer.el), this.renderer.makeCover(this);
			var E = t.createElement("div"), k = this;
			if (E.oncontextmenu = function () {
					return !1
				}, E.style.cssText = "position:absolute;left:0;top:0;right:0;bottom:0;", k.el.appendChild(E), a.preload = a.autoplay ? 1
					: a.preload, a.preload) {
				k.loader = o(a.loaderClass || x, k), requestAnimFrame(function () {
					k.loadFrames()
				});
			}
			else {
				var C = t.createElement("a");
				C.className = "plBtn" + (this.direction > 1 ? " vrt" : ""), k.el.appendChild(C), C.onclick = function () {
					k.loader = o(a.loaderClass || x, k), k.loadFrames(), C.onclick = null, k.el.removeChild(C), C = null
				}
			}
			this.createTags = function (e) {
				for (var t = this, n = t.el, i = e.length, r = {
					data      : [], enabled: !1, show: function () {
						return this.enabled || this.display(t.renderer.visible_frame), this.enabled = !0, !1
					}, hide   : function () {
						for (var e = this.data.length; e--;) {
							this.data[e].elem.style.display = "none";
						}
						return this.enabled = !1, !1
					}, display: function (e) {
						for (var t = this.data.length, n = function (t) {
							var n, i, r, o = t[e], s = t.elem.style, l = 6;
							if (o) {
								var c = k.renderer.coords;
								if (i = c.width, r = c.height, s.display = "block", n = t.elem.offsetWidth, 1 === a.fy.m) {
									switch (a.fy.r) {
										case 1:
											s.top = (1 - o.Y) * r + l + c.top + "px", s.left = (1 - o.X) * i - n / 2 + c.left + "px";
											break;
										case 0:
											s.top = o.Y * r + l + c.top + "px", s.left = o.X * i - n / 2 + c.left + "px"
									}
								}
								else {
									switch (a.fy.r) {
										case 2:
											s.top = o.X * r + l + c.top + "px", s.left = (1 - o.Y) * i - n / 2 + c.left + "px";
											break;
										case 0:
											s.top = o.X * r + l + c.top + "px", s.left = o.Y * i - n / 2 + c.left + "px"
									}
								}
							}
							else {
								s.display = "none"
							}
						}; t--;) {
							n(this.data[t]);
						}
						return !1
					}
				}, o       = function (e) {
					r.data.push(s(e))
				}, s       = function (e) {
					var t = {Desc: e.Desc, Type: e.Type};
					return e.Trackers.forEach(function (e) {
						t[e.F] = {X: e.X, Y: e.Y}
					}), t.elem = l(t), t
				}, l       = function (e) {
					var t = document.createElement("span"), i = e.Desc, r = function (e) {
						return '<a href="https://fyu.se/t/' + e.replace("#", "") + '">' + e + "</a>"
					}, a  = function (e) {
						return '<a href="' + e + '" target="_blank">' + e + "</a>"
					};
					return t.className = "fyuse_tag", 0 === e.Type ? (i = p.utils.tagLinks(i), t.className += " fyuse_tag_user") : 1 === e.Type ? i = r(i)
						: 2 === e.Type && (i = a(i)), t.innerHTML = i, n.appendChild(t), t
				}; i--;) {
					o(e[i]);
				}
				return this.tags = r, !1
			}, s(k) && (k.more.tags && p.utils.downloadTags(k), p.ui && p.ui.buildInterface(this))
		};
		y.prototype.destroy = function () {
			var e = this;
			g[e.id] = !0, e.is_rendering = !1, clearTimeout(w[e.id]), w[e.id] = null, e.listeners && (e.listeners.motionScheduled && clearTimeout(e.listeners.motionScheduled), e.listeners.motionScheduled = null, e.listeners.autoplay && e.listeners.autoplay.stop()), e.renderer && e.renderer.destroy(), e.loader && e.loader.destroy(), e.renderer = e.loader = e.imgdata = e.events = null
		}, y.prototype.loadFrames = function () {
			var e           = this, n = e.config.fy, i = n.f - 1, a = e.config.threads ? Math.abs(e.config.threads / 1) + 1
				: 36, o = -1, s = 1, c = !0, d = 0, u = e.config.fy.t, f = ".jpg";
			if (e.config.fy["."]) {
				var h = t.createElement("canvas");
				h.getContext && h.getContext("2d") && 0 === h.toDataURL("image/webp").indexOf("data:image/webp") && (f = ".webp")
			}
			if (!g[e.id]) {
				var p = function (t, n, r) {
					g[e.id] || (e.imgdata[r - 1] = t, a = 0 > a ? 1 : ++a, ++s <= i
						? (e.loader && e.loader.setPercentage(s / i * 100, !0), y(), 11 > s && s % 2 == 0 && e.renderer.resize(e), s > 28 && !e.loaded && v())
						: e.loaded
						                                                       ? (e.loaded_full = !0, e.loader && e.loader.done(), e.config.nologo && e.loader.removeLogo(), e.renderer.resize(e), e.oncomplete && e.oncomplete())
						                                                       : (e.loaded_full = !0, e.renderer.resize(e), e.loader && e.loader.done(), v()), e.loaded_frames = s)
				}, m  = function (t, n) {
					g[e.id] || (e.imgdata[n - 1] = null, a = 0 > a ? 1 : ++a, ++s <= i ? (e.loader && e.loader.setPercentage(s / i * 100, !0), y())
						: e.loaded || (e.loaded_full = !0, e.loader && e.loader.done(), v()), e.loaded_frames = s)
				}, v  = function () {
					e.loaded = !0, e.onload && e.onload(), r(e), requestAnimFrame(function () {
						g[e.id] || e.renderer.destroyCover(e)
					})
				}, y  = function () {
					for (var t = 0; --a > -1 && ++o < i;) {
						if (t = c ? u + d++ : u - d, c = !c, d > i) {
							return;
						}
						t > i || 0 > t ? (++a, --o) : l(e.path + "frames_" + t + f, t, p, m)
					}
				};
				y()
			}
		};
		var w                      = {};
		y.prototype.flintRendering = function () {
			var e = this;
			e.renderer && (e.is_rendering = !0, w[e.id] ? (clearTimeout(w[e.id]), w[e.id] = null) : n(e), w[e.id] = setTimeout(function () {
				e.is_rendering = !1, w[e.id] = null
			}, 1500))
		};
		var x                      = function (t) {
			var n = document.createElement("a"), i = document.createElement("a");
			n.style.cssText = "-ms-transform:scale(.6);-webkit-transform:scale(.6);transform:scale(.65);position:absolute;left:-24px;top:-24px;background:url(https://fyu.se/assets/symbol.png) no-repeat 34px 34px;background-size:52px;z-index:501;width:96px;height:96px", n.className = "fyu_ldr", i.innerHTML = '<svg width="120" height="120" viewPort="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg"><circle r="26" cx="60" cy="60" fill="transparent" stroke-dasharray="320" stroke-dashoffset="0"></circle><circle r="26" cx="60" cy="60" fill="transparent" stroke-dasharray="320" stroke-dashoffset="0" style="stroke-width:1px;stroke:#666;opacity:0.3"></circle><circle class="fyu_bar" r="28" cx="60" cy="60" fill="transparent" stroke-dasharray="185" stroke-dashoffset="0" style="stroke-width:7px;stroke:#F19211;stroke-dashoffset: 165px"></circle></svg>', (t.config.embed || t.config.jsembed) && (i.style.cssText = "cursor:pointer;display:block", i.href = "https://fyu.se/v/" + t.f_uid, i.setAttribute("target", "_blank")), -1 !== e.location.href.indexOf("nologo") && (n.style.opacity = "0"), n.appendChild(i), t.el.appendChild(n), this.el = i
		};
		x.prototype.setPercentage = function (e, t) {
			var n = this.el.getElementsByClassName("fyu_bar")[0], i = n.getAttribute("r"), r = Math.PI * (2 * i), a = 0;
			e = 0 > e ? 0 : e > 100 ? 100 : e, a = 0 === t ? e / 100 * r * -1 : (100 - e) / 100 * r, requestAnimFrame(function () {
				n.style.strokeDashoffset = a + "px"
			})
		}, x.prototype.done = function (e) {
			var t = this, n = function () {
				var e = t.el.getElementsByClassName("fyu_bar")[0];
				e && (e.parentNode.removeChild(e), e = null)
			};
			e ? n() : requestAnimFrame(n)
		}, x.prototype.destroy = function () {
			this.done(!0)
		}, x.prototype.removeLogo = function () {
			var e = this.el.parentNode;
			requestAnimFrame(function () {
				e.parentNode.removeChild(e)
			})
		}, e.addEventListener && (e.addEventListener("resize", function (e) {
			c("resize", e), p.renderOnViewport()
		}, !1), e.addEventListener("scroll", d(p.renderOnViewport, 220), !1), e.addEventListener("load", d(p.renderOnViewport, 150), !1))
	}(window, document), function (e, t, n) {
		"use strict";
		function i(e, t, n, i, r) {
			this.scale_u = e, this.scale_v = t, this.angle = n, this.tx = i, this.ty = r
		}

		function r(e, t, n, r, a) {
			i.apply(this, arguments)
		}

		function a(e, t, n, r, a) {
			i.apply(this, arguments)
		}

		function o(e, t) {
			var n = new Int32Array(e, 4, 1)[0], i = new Float32Array(e, 8), o = [], l = [], c = function (e, t, n, i, r, a) {
				for (var o = t + r, s = r, l = 0; o > s; ++s) {
					l = 5 * s + a, n.push(new i(e[l], e[l + 1], e[l + 2], e[l + 3], e[l + 4]))
				}
			};
			c(i, n, l, a, 0, 0), c(i, new Int32Array(e, 20 * n + 12, 1)[0], o, r, n, 2);
			for (var d = [], u = 0; n > u; ++u) {
				d[u] = s(o[u], !1);
			}
			t.config.transformations = {transformations: d, stab_params: o, trans_params: l}, t.renderer && t.renderer.applyTweens && t.renderer.applyTweens()
		}

		function s(e, t) {
			var n, i = 0;
			n        = t ? -Math.sin(e.angle) : Math.sin(e.angle);
			var r    = Math.cos(e.angle), a = e.scale_u, o = e.scale_v, s = e.tx, c = e.ty, d = new l(3, 3);
			return d.at[0][0] = a * r, d.at[0][1] = -o * n, d.at[1][1] = a * n, d.at[2][0] = 0, d.at[2][1] = 0, d.at[2][2] = 1, 0 === i
				? (d.at[0][2] = s, d.at[1][2] = c) : 1 === i ? (d.at[0][2] = a * s, d.at[1][2] = o * c) : 2 === i
				? (d.at[0][2] = r * s - n * c, d.at[1][2] = n * s + r * c) : (d.at[0][2] = a * (r * s - n * c), d.at[1][2] = o * (n * s + r * c)), d
		}

		function l(e, t) {
			for (var n = [], i = 0; e > i; ++i) {
				for (var r = [], a = 0; t > a; ++a) {
					r[a] = 0;
				}
				n[i] = r
			}
			this.at = n
		}

		e.utils = {
			req       : {
				cid        : 0, cached: {}, set: function (e) {
					return this.cached[++this.cid] = e, this.cid
				}, unset   : function (e) {
					delete this.cached[e]
				}, abortAll: function () {
					for (var e in this.cached) {
						this.cached[e].onreadystatechange = null, this.cached[e].abort();
					}
					this.cached = {}
				}
			}, metrics: function () {
				this.base = null, this.prev, this.sended = !1, this.dir = "+", this.img = new Image, this.check = function (e, t) {
					if (!t.ie) {
						var n;
						this.base || (this.base = e, this.prev = e), e > this.prev ? n = "+" : e < this.prev ? n = "-"
							: e === this.prev && (n = this.dir), this.dir !== n && (this.dir = n, this.base = e, this.sended = !1), Math.abs(this.base - e) >= 20 && !this.sended && (this.img.src = "https://fyu.se/api/1.5/logs/webviewer/" + t.f_uid, this.sended = !0), this.prev = e
					}
				}
			}
		}, e.utils.downloadTags = function (t) {
			e.net.request({
				url: t.path + "tags.json", success: function (e) {
					t.createTags(JSON.parse(e.response || e.responseText))
				}
			})
		}, e.utils.downloadTweens = function (e) {
			this.downloadBase(e.path + "tween.magic", "arraybuffer", function (t) {
				var n = new Uint8Array(t, 0, 1)[0];
				1 === n && o(t, e), console.log && void 0
			}, function () {
			})
		}, e.utils.downloadBase = function (e, t, n, i) {
			var r, a = new XMLHttpRequest, o = this;
			!t && (t = "text"), a.open("GET", e, !0), a.responseType = t, a.onload = function () {
				o.req.unset(r), n(a.response)
			}, a.onerror = function () {
				i()
			}, a.send(null), r = o.req.set(a)
		};
		var c = navigator.userAgent.toLowerCase().indexOf("android") > -1, d = !1;
		c || (d = -1 !== navigator.userAgent.indexOf("iPhone") || -1 !== navigator.userAgent.indexOf("iPod") || -1 !== navigator.userAgent.indexOf("iPad")), (d || c) && (e.info && (e.info.is_mobile = !0), requestAnimFrame(function () {
			n.getElementsByTagName("html")[0].className += " mob"
		})), e.utils.openInFyuse = function (e, n) {
			var i = "fyuse://";
			if (n) {
				switch (n) {
					case 1:
						t.location = i + "user/" + e;
						break;
					case 2:
						t.location = i + "explore/" + e;
						break;
					case 3:
						t.location = i + "tag/" + e;
						break;
					case 4:
						t.location = i + "gallery/" + e
				}
			}
			else {
				window.location = i + "view/" + e;
			}
			setTimeout(function () {
				c ? window.location = "https://play.google.com/store/apps/details?id=com.fyusion.fyuse"
					: window.location = "https://itunes.apple.com/us/app/fyuse/id862863329?mt=8"
			}, 2200)
		}, e.utils.loadScript = function (e, t) {
			var i = n.createElement("script"), r = n.getElementsByTagName("head")[0];
			i.type = "text/javascript", i.src = e, i.onload = function () {
				t && t(), t = null, r.removeChild(i), i.onload = i = r = null
			}, r.appendChild(i)
		}, e.utils.fireEvent = function (e, t, n) {
			var i = null;
			if (e && e.events[t]) {
				for (i = e.events[t].length; i-- > 0;) {
					e.events[t][i](n, e)
				}
			}
		}, e.callbacks = {}, function () {
			var e = document.createElement("canvas");
			return e.getContext && e.getContext("2d") && "function" == typeof e.getContext("2d").fillText
				? (e = e.getContext("2d"), e.textBaseline = "top", e.font = "32px Arial", e.fillText("😃", 0, 0), 0 !== e.getImageData(16, 16, 1, 1).data[0]) : !1
		}() ? e.utils.moji = function (e) {
			return e
		} : e.utils.moji = function (e) {
			var t = ("string" == typeof e ? e : e.innerHTML).replace(RegExp("�[�-�]|�[�-�]|�[�-�]", "g"), function (e) {
				return '<span class="emoji emoji' + (1024 * (e.charCodeAt(0) - 55296) + e.charCodeAt(1) - 56320 + 65536).toString(16) + '"></span>'
			}), t = t.replace(/\ud83c[\uda00-\udfff]\ud83c[\udb00-\udfff]/g, function (e) {
				var t = 1024 * (e.charCodeAt(0) - 55296) + e.charCodeAt(1) - 56320 + 65536;
				return e = 1024 * (e.charCodeAt(2) - 55296) + e.charCodeAt(3) - 56320 + 65536, '<span class="emoji emoji' + t.toString(16) + e.toString(16) + '"></span>'
			});
			return "string" == typeof e ? t : (e.innerHTML = t, !1)
		}, e.utils.hashLinks = function (e) {
			return e = e.replace(/#([A-Za-z0-9\u00C0-\u017F]+)/g, "<a style='cursor:pointer' class='action _hash' href='https://fyu.se/t/$1'>#$1</a>")
		}, e.utils.tagLinks = function (e) {
			var t = e.match(/@([^\]]+)/g), n = t ? t.length : 0;
			if (0 === n) {
				return e;
			}
			for (var i = null, i = "", r = 0; n > r; ++r) {
				-1 !== t[r].indexOf("~")
					? (i = t[r].split("~"), i = "<a href='//fyu.se/u/" + i[0].substr(2) + "'>@" + i[1] + "</a>", e = e.replace(t[r] + "]]", i))
					: e = e.replace(t[r] + "]]", "");
			}
			return e
		}, e.utils.htmlEntities = function (e) {
			return String(e).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;")
		}, e.utils.linkify = function (e) {
			var t = /((www[-A-Z0-9]{0,1}\.[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])|(\b(https?|ftp|file|):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|]))/gi;
			return e.replace(t, "<a style='cursor:pointer' target='_blank' href='$1'>$1</a>").replace(/='www./g, "='http://")
		}, e.utils.formatTime = function (e) {
			var t = new Date;
			return e = new Date(e), e = (t - e) / 1e3 >> 0, 59 >= e ? (t = e > 1 ? "s" : "", e + " second" + t + " ago") : e >= 60 && 3599 >= e
				? (e = Math.floor(e / 60), e + " minute" + (e > 1 ? "s" : "") + " ago") : e >= 3600 && 86399 >= e ? (e = Math.floor(e / 3600), e + " hour" + (e > 1
				? "s" : "") + " ago") : e >= 86400 && 2592030 >= e ? (e = Math.floor(e / 86400), e + " day" + (e > 1 ? "s" : "") + " ago") : e >= 2592031
				? (e = Math.floor(e / 2592e3), e + " month" + (e > 1 ? "s" : "") + " ago") : void 0
		}, e.net = {}, e.net.request = function (e) {
			var t, n     = e.url, i = e.method || "GET", r = e.success || function () {
				}, a = e.failure || function () {
				};
			window.XDomainRequest ? (t = new XDomainRequest, t.onload = function () {
				r.call(null, t)
			}) : t = window.XMLHttpRequest ? new XMLHttpRequest : new ActiveXObject("Msxml2.XMLHTTP"), t.onreadystatechange = function () {
				4 === t.readyState && (200 === t.status ? r.call(null, t) : a.call(null, t))
			}, t.open(i, n), t.send(null)
		}
	}(window.fyu, window, document), function (e, t) {
		"use strict";
		var n = e.renderer = function (e, n, i, r) {
			var a = this, o = this.el = document.createElement("div"), s = null;
			a.full_width = i, a.full_height = r, a.cover = null, a.scale_mode = 0, a.coords = {
				width : 0,
				height: 0,
				left  : 0,
				top   : 0
			}, a.el.style.cssText = "position:absolute;background:#333;overflow:hidden", "canvas" === n
				? (a.img = new Image, s = this.canvas = document.createElement("canvas"), a.ctx = this.canvas.getContext("2d")) : "canvas_big" === n
				                                                                             ? (a.img = new Image, s = this.canvas = document.createElement("canvas"), a.ctx = this.canvas.getContext("2d"), a.scale_mode = 1)
				                                                                             : s = a.canvas = a.img = document.createElement("img"), s.style.cssText = "position:relative;background:#333;left:0;top:0;", o.appendChild(this.canvas), a.resize(e, !1), t.URL
				? this.img.onload = function () {
				URL.revokeObjectURL(a.img.src), a.ctx && a.ctx.drawImage(a.img, 0, 0, a.canvas.width, a.canvas.height)
			} : (e.ie = !0, this.img.onload = function () {
				a.ctx && a.ctx.drawImage(a.img, 0, 0, a.canvas.width, a.canvas.height)
			}), e.events.resize.push(function (e, t) {
				a.resize(t, !0)
			})
		};
		n.prototype.resize = function (e, t) {
			var n = e.config.fy.ratio, i = e.el, r = this.canvas, a = this.el, o = i.offsetWidth, s = i.offsetHeight, l = o / s, c = 0, d = 0, u = this;
			e.config.aspect && 1 === e.config.aspect.mode && Math.abs(n - l) < e.config.aspect.tolerance ? l >= n
				? (d = o / n, c = o, u.coords.width = o, u.coords.height = d, u.coords.left = 0, u.coords.top = s / 2 - d / 2 << 0, u.el.style.cssText = "overflow:hidden;position:absolute;width:" + o + "px;height:" + d + "px;left:0;top:" + u.coords.top + "px")
				: (c = s * n, d = s, u.coords.width = c, u.coords.height = s, u.coords.top = 0, u.coords.left = (0 >= o ? c
					: o) / 2 - c / 2 << 0, u.el.style.cssText = "overflow:hidden;position:absolute;width:" + c + "px;height:" + s + "px;top:0;left:" + u.coords.left + "px")
				: l >= n ? (c = s * n, d = s, u.coords.width = c, u.coords.height = s, u.coords.top = 0, u.coords.left = (0 >= o ? c
					: o) / 2 - c / 2 << 0, u.el.style.cssText = "overflow:hidden;position:absolute;width:" + c + "px;height:" + s + "px;top:0;left:" + u.coords.left + "px")
				: (d = o / n, c = o, u.coords.width = o, u.coords.height = d, u.coords.left = 0, u.coords.top = s / 2 - d / 2 << 0, u.el.style.cssText = "overflow:hidden;position:absolute;width:" + o + "px;height:" + d + "px;left:0;top:" + u.coords.top + "px"), requestAnimFrame(function () {
				if (r.width !== a.offsetWidth || r.height !== a.offsetHeight) {
					if (0 === u.scale_mode) {
						r.width = a.offsetWidth, r.height = a.offsetHeight;
					}
					else {
						r.width = u.full_width, r.height = u.full_height;
						var n = "";
						n = u.full_width > u.full_height ? "scale(" + (a.offsetWidth / u.full_width + .001) + ")"
							: "scale(" + (a.offsetHeight / u.full_height + .001) + ")", r.style.msTransform = n, r.style.webkitTransform = n, r.style.transform = n, r.style.transformOrigin = "0 0", r.style.webkitTransformOrigin = "0 0", r.style.msTransformOrigin = "0 0"
					}
					u.visible_frame >= 0 && u.visible_frame < e.imgdata.length ? e.listeners && u.displayFrame(u.visible_frame, e)
						: t && e.listeners && u.displayFrame(0, e)
				}
			})
		}, n.prototype.displayFrame = function (e, n) {
			var i = this;
			if (!n.imgdata[e]) {
				return i.visible_frame = e, !1;
			}
			if (t.URL) {
				var r = URL.createObjectURL(n.imgdata[e]);
				i.visible_frame = e, i.img.src = r
			}
			else {
				i.visible_frame = e, i.img.src = n.imgdata[e].src;
			}
			return n.tags && n.tags.enabled && n.tags.display(e), this.metrics.check(e, n), !0
		}, n.prototype.metrics = new e.utils.metrics, n.prototype.makeCover = function (e) {
			var t = this;
			t.cover = document.createElement("img"), t.cover.src = e.path + "frames_" + e.config.fy.t + ".jpg", t.cover.style.cssText = "position:absolute;left:0;top:0;width:100%;height:100%;z-index:50;right:0;bottom:0;outline:0;", t.el.appendChild(t.cover)
		}, n.prototype.destroyCover = function () {
			var e = this;
			e.cover && requestAnimFrame(function () {
				e.cover.parentNode.removeChild(e.cover), e.cover = null
			})
		}, n.prototype.destroy = function () {
			var e = this.el.parentNode;
			return e.parentNode.removeChild(e), !1
		}
	}(window.fyu, window), function (e, t, n) {
		"use strict";
		function i(e) {
			var i = u[this.id];
			if (n.addEventListener("touchmove", i.touchDragMove, !1), n.addEventListener("touchend", i.touchDragUp, !1), i.autoplay && (i.autoplay.stop(), i.autoplay = null), e.touches.length > 0) {
				var r = e.touches[0];
				i.x = r.pageX, i.y = r.pageY
			}
			i.focus = !0, setTimeout(function () {
				i.focus && (i.lock_action = !0)
			}, 135), clearTimeout(i.timeout), i.timeout = null, this.config.fy.cv < 0 && (i.x = t.innerWidth - i.x, i.y = t.innerHeight - i.y), i.rx = i.x, i.ry = i.y, this.flintRendering()
		}

		function r(e) {
			var n = u[this.id];
			if (e.touches.length > 0) {
				n.lock_action && (e.preventDefault(), e.stopPropagation());
				var i = e.touches[0];
				n.x = i.pageX, n.y = i.pageY, this.config.fy.cv < 0 && (n.x = t.innerWidth - n.x, n.y = t.innerHeight - n.y)
			}
			this.flintRendering()
		}

		function a(t) {
			e.MotionHelper && e.MotionHelper.calibrate();
			var i = u[this.id];
			i.lock_action = !1, i.timeout = setTimeout(function () {
				i.focus = !1, i.lock_action = !1, e.MotionHelper && e.MotionHelper.calibrate()
			}, 206), n.removeEventListener("touchend", i.touchDragUp, !1), n.removeEventListener("touchmove", i.touchDragMove, !1)
		}

		function o(e) {
			var i = u[this.id];
			i.autoplay && (i.autoplay.stop(), i.autoplay = null), n.body.className += " fyuse", n.addEventListener("mousemove", i.mouseDragMove, !1), n.addEventListener("mouseup", i.mouseDragUp, !1), e.pageX && (i.x = e.pageX, i.y = e.pageY), i.focus = !0, this.config.fy.cv < 0 && (i.x = t.innerWidth - i.x, i.y = t.innerHeight - i.y), i.rx = i.x, i.ry = i.y
		}

		function s(e) {
			var t = u[this.id];
			e.offsetX ? (t.x = e.offsetX, t.y = e.offsetY) : e.layerX && (t.x = e.layerX, t.y = e.layerY)
		}

		function l(e) {
			var n = u[this.id];
			e.pageX && (n.x = e.pageX, n.y = e.pageY), this.config.fy.cv < 0 && (n.x = t.innerWidth - n.x, n.y = t.innerHeight - n.y);
			for (var e = this.events.ondrag, i = e.length; i-- > 0;) {
				e[i]();
			}
			this.flintRendering()
		}

		function c(e) {
			var t = u[this.id], i = n.body.className;
			t.focus = !1, n.body.className = i.replace(" fyuse", "").replace(" fyuse", ""), n.removeEventListener("mouseup", t.mouseDragUp, !1), n.removeEventListener("mousemove", t.mouseDragMove, !1)
		}

		function d(e) {
			var t = n.createElement("span");
			t.innerHTML = "Click and Drag", t.className = "fyu_clickndrag noselect", e.el.appendChild(t), e.el.addEventListener("mousedown", u[e.id].mouseDragDown, !1)
		}

		var u = {}, f = !!("ontouchstart" in t), h = !!window.DeviceMotionEvent;
		h && f && !e.MotionHelper && e.utils.loadScript(e.root_path + "motionhelper.js"), e.info.has_touch = f, e.info.has_gyro = h, e.setupControls = function (n, h) {
			var p = function () {
				var e = 0;
				e     = n.direction > 1 ? n.el.offsetWidth : n.el.offsetHeight;
				var t = n.config.fy.f / (.66 * e);
				return t > .1666 && (t = .1666), .0833333 > t && (t = .0833333), u[n.id] && (u[n.id].mult = t), t
			};
			n.events.resize.push(p), n.config.controls.drag ? (u[n.id] = {
				mouseDragDown: o.bind(n),
				mouseDragUp  : c.bind(n),
				mouseDragMove: l.bind(n),
				rx           : -1,
				ry           : -1,
				x            : -1,
				y            : -1,
				focus        : !1,
				active_frame : h,
				mult         : p()
			}, n.el.addEventListener("mousedown", u[n.id].mouseDragDown, !1), n.direction < 2 ? n.el.className += " fyv horiz"
				: n.el.className += " fyv vert", f || (d(n), n.events.ondrag.push(function () {
				var e = n.el.getElementsByClassName("fyu_clickndrag")[0];
				e.parentNode.removeChild(e), e = null, n.events.ondrag.pop()
			}))) : n.config.controls.hover ? (u[n.id] = {
				mouseHover  : s.bind(n),
				rx          : 0,
				ry          : 0,
				x           : -1,
				y           : -1,
				active_frame: h,
				mult        : p()
			}, n.el.addEventListener("mousemove", u[n.id].mouseHover, !1)) : u[n.id] = {
				rx          : 0,
				ry          : 0,
				x           : -1,
				y           : -1,
				active_frame: h,
				mult        : p()
			}, f && n.config.controls.drag && (u[n.id].touchDragDown = i.bind(n), u[n.id].touchDragMove = r.bind(n), u[n.id].touchDragUp = a.bind(n), n.el.addEventListener("touchstart", u[n.id].touchDragDown, !1)), n.listeners = u[n.id];
			var m = function () {
				n.listeners.motionScheduled = e.MotionHelper.start().schedule(function (e) {
					if (!n.listeners.focus && n.onviewport) {
						var i = -e.rotation_x, r = e.rotation_y;
						if (-1 === i && (i = -e.rx, r = e.rz), n.listeners.x += 248 * i, n.listeners.y += 252 * r, 90 === t.orientation) {
							var a = n.listeners.x;
							n.listeners.x = -n.listeners.y, n.listeners.y = -a
						}
						else if (-90 === t.orientation) {
							var a = n.listeners.x;
							n.listeners.x = n.listeners.y, n.listeners.y = a
						}
						Math.abs(n.listeners.x) < .2 && (n.listeners.x = 0), Math.abs(n.listeners.y) < .2 && (n.listeners.y = 0), n.flintRendering()
					}
				}, 40)
			};
			e.MotionHelper ? m() : (!e.callbacks.motion && (e.callbacks.motion = []), e.callbacks.motion.push(m))
		}
	}(window.fyu, window, document), function (e, t, n) {
		"use strict";
		function i(t) {
			for (var n = 0, i = e.entries.length; i > n; n++) {
				if (e.entries[n].f_uid === t) {
					return e.entries[n]
				}
			}
		}

		function r(e) {
			var t = n.createElement("a");
			t.innerHTML = "tags", t.className = "fyubtn tags", t.setAttribute("onclick", 'fyu.ui.tags("' + e.f_uid + '")'), e.el.appendChild(t)
		}

		function a(e) {
			var t = n.createElement("a");
			t.innerHTML = "x2", t.className = "fyubtn x2", t.setAttribute("onclick", 'fyu.ui.fullscreen("' + e.f_uid + '")'), e.el.appendChild(t)
		}

		var o = document.documentElement;
		e.ui = {}, e.ui.buildInterface = function (t) {
			t.more.tags && r(t), e.info.is_mobile || t.ie || (!t.config.embed || n.fullScreenEnabled || n.webkitFullscreenEnabled || n.mozFullScreenEnabled) && a(t)
		}, e.ui.tags = function (e) {
			var t = i(e);
			t.tags && (t.tags.enabled ? t.tags.hide() : t.tags.show())
		}, e.ui.fullscreen = function (r) {
			var a = i(r), s = a.renderer.in_fullscreen;
			if (s) {
				if (n.getElementById("fyu_cover")) {
					var l = n.getElementById("fyu_cover").getElementsByClassName("fyu_clayer")[0], c = document.createEvent("HTMLEvents");
					c.initEvent("click", !0, !0), l.dispatchEvent(c)
				}
				else {
					a && a.config.embed && (n.exitFullscreen ? n.exitFullscreen() : n.mozCancelFullScreen ? n.mozCancelFullScreen()
						: n.webkitExitFullscreen && n.webkitExitFullscreen());
				}
				return void(a.renderer.in_fullscreen = !1)
			}
			if (a.config.embed && !s && !a.config.jsembed) {
				return o.requestFullscreen ? o.requestFullscreen() : o.mozRequestFullScreen ? o.mozRequestFullScreen()
					: o.webkitRequestFullScreen && o.webkitRequestFullScreen(), a.renderer.in_fullscreen = !0, void setTimeout(function () {
					e.utils.fireEvent(a, "resize")
				}, 320);
			}
			a.renderer.in_fullscreen = !0;
			var d                    = document.createElement("div");
			d.id = "fyu_cover", d.className = "close", d.style.cssText = "opacity:0;position:fixed;z-index:1000;left:0;top:0;right:0;bottom:0;transition:opacity .27s .08s;-webkit-transition:opacity .27s .08s;background:rgba(0,0,0,0.81)", n.body.appendChild(d), n.body.style.overflow = "hidden";
			var l = document.createElement("div");
			l.className = "fyu_clayer", l.style.cssText = "position:absolute;left:0;right:0;bottom:0;top:0;z-index:1";
			var u = document.createElement("a"), f = document.createElement("div"), h = 1.6 * a.config.fy.w, p = 1.6 * a.config.fy.h;
			f.style.cssText = "overflow:hidden;position:relative;z-index:100;margin:0;max-width:" + h + "px;max-height:" + p + "px;", d.appendChild(f);
			var m = f;
			u.className = "fyu_close", d.appendChild(u), d.appendChild(l);
			var v = a.el;
			v.setAttribute("data-parent", a.f_uid);
			var g = v.getElementsByTagName("canvas")[0], y = g.getBoundingClientRect(), w = document.body.getBoundingClientRect(), x = y.top - w.top, b = y.left - w.left, _ = new Image, E = a.renderer.coords.width << 0;
			_.src = a.renderer.canvas.toDataURL("image/jpeg");
			var k = this, C = "";
			_.style.cssText = "z-index:100;position:absolute;left:" + b + "px;top:" + x + "px;opacity:1;width:" + E + "px;transition:all .34s;-webkit-transition:all .34s;" + C, n.body.appendChild(_), f.appendChild(v);
			var T = function (t) {
				this && this.removeEventListener && this.removeEventListener("click", T);
				var r = m.getElementsByClassName("fyv")[0];
				if (r) {
					var a = i(r.getAttribute("data-parent"));
					n.getElementById(a.o_id).appendChild(r), a.renderer.in_fullscreen = !1, e.utils.fireEvent(a, "resize")
				}
				a && a.config.embed && (n.exitFullscreen ? n.exitFullscreen() : n.mozCancelFullScreen ? n.mozCancelFullScreen()
					: n.webkitExitFullscreen && n.webkitExitFullscreen()), m.parentNode.parentNode.removeChild(m.parentNode), n.body.style.overflow = "auto", m = null
			};
			setTimeout(function () {
				requestAnimFrame(function () {
					var e = f.getBoundingClientRect(), t = document.body.getBoundingClientRect();
					_.style.top = e.top - t.top + "px", _.style.left = e.left - t.left + "px", _.style.width = f.offsetWidth + "px", _.style.opacity = .8, d.style.opacity = 1, setTimeout(function () {
						_.parentNode.removeChild(_), _ = null, l.addEventListener("click", T, !1)
					}, 310)
				})
			}, 8);
			var k = a;
			a.events.resize.push(function (e, n) {
				var i = .8 * t.innerWidth, r = .8 * t.innerHeight, a = k.renderer.coords.width / k.renderer.coords.height, o = 0, s = 0;
				r > i ? (o = i / a, i > h && (i = h, o = i / a), o > p && (o = p, i = o * a), s = i)
					: (s = r * a, s > h && (s = h, o = s / a), r > p && (o = p, s = o * a), o = r), f.style.width = s + "px", f.style.height = o + "px", f.style.left = (t.innerWidth - s) / 2 + "px", f.style.top = (t.innerHeight - o) / 2 + "px"
			}), e.utils.fireEvent(a, "resize")
		}
	}(fyu, window, document), function (e, t, n) {
		"use strict";
		function i(e, t, n, i) {
			function r(e, t) {
				return 1 - 3 * t + 3 * e
			}

			function a(e, t) {
				return 3 * t - 6 * e
			}

			function o(e) {
				return 3 * e
			}

			function s(e, t, n) {
				return ((r(t, n) * e + a(t, n)) * e + o(t)) * e
			}

			function l(e, t, n) {
				return 3 * r(t, n) * e * e + 2 * a(t, n) * e + o(t)
			}

			function c(t) {
				for (var i = t, r = 0; 4 > r; ++r) {
					var a = l(i, e, n);
					if (0 == a) {
						return i;
					}
					var o = s(i, e, n) - t;
					i -= o / a
				}
				return i
			}

			this.get = function (r) {
				return e == t && n == i ? r : s(c(r), t, i)
			}
		}

		e.autoplay = function (e, t, r, a) {
			var o = r, s = 68;
			o || (o = [.4, 0, .6, 1]);
			var l     = new i(o[0], o[1], o[2], o[3]), c = (t / s << 0) + 1, d = c * (e.renderer.visible_frame / e.config.fy.f) << 0, u = !0;
			this.loop = setInterval(function () {
				if (!n.hidden && e.onviewport) {
					var t = 3;
					u ? ++d : --d, d >= c - t ? (u = !u, d -= t) : t + 2 >= d && (u = !u, d = t + 2);
					var i = l.get(d / c);
					if (!e.loaded_full) {
						var r = Math.round(e.config.fy.f * i);
						if (!e.imgdata[r]) {
							return void(u = !u)
						}
					}
					a(i)
				}
			}, s)
		}, e.autoplay.prototype.stop = function () {
			clearInterval(this.loop), this.loop = null
		}
	}(window.fyu, window, document);
	d.getElementsByTagName("head")[0].appendChild(style);
})(document);
