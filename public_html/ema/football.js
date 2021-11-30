/*! http://mths.be/placeholder v2.0.8 by @mathias */
;(function(window, document, $) {

	// Opera Mini v7 doesn’t support placeholder although its DOM seems to indicate so
	var isOperaMini = Object.prototype.toString.call(window.operamini) == '[object OperaMini]';
	var isInputSupported = 'placeholder' in document.createElement('input') && !isOperaMini;
	var isTextareaSupported = 'placeholder' in document.createElement('textarea') && !isOperaMini;
	var prototype = $.fn;
	var valHooks = $.valHooks;
	var propHooks = $.propHooks;
	var hooks;
	var placeholder;

	if (isInputSupported && isTextareaSupported) {

		placeholder = prototype.placeholder = function() {
			return this;
		};

		placeholder.input = placeholder.textarea = true;

	} else {

		placeholder = prototype.placeholder = function() {
			var $this = this;
			$this
				.filter((isInputSupported ? 'textarea' : ':input') + '[placeholder]')
				.not('.placeholder')
				.bind({
					'focus.placeholder': clearPlaceholder,
					'blur.placeholder': setPlaceholder
				})
				.data('placeholder-enabled', true)
				.trigger('blur.placeholder');
			return $this;
		};

		placeholder.input = isInputSupported;
		placeholder.textarea = isTextareaSupported;

		hooks = {
			'get': function(element) {
				var $element = $(element);

				var $passwordInput = $element.data('placeholder-password');
				if ($passwordInput) {
					return $passwordInput[0].value;
				}

				return $element.data('placeholder-enabled') && $element.hasClass('placeholder') ? '' : element.value;
			},
			'set': function(element, value) {
				var $element = $(element);

				var $passwordInput = $element.data('placeholder-password');
				if ($passwordInput) {
					return $passwordInput[0].value = value;
				}

				if (!$element.data('placeholder-enabled')) {
					return element.value = value;
				}
				if (value == '') {
					element.value = value;
					// Issue #56: Setting the placeholder causes problems if the element continues to have focus.
					if (element != safeActiveElement()) {
						// We can't use `triggerHandler` here because of dummy text/password inputs :(
						setPlaceholder.call(element);
					}
				} else if ($element.hasClass('placeholder')) {
					clearPlaceholder.call(element, true, value) || (element.value = value);
				} else {
					element.value = value;
				}
				// `set` can not return `undefined`; see http://jsapi.info/jquery/1.7.1/val#L2363
				return $element;
			}
		};

		if (!isInputSupported) {
			valHooks.input = hooks;
			propHooks.value = hooks;
		}
		if (!isTextareaSupported) {
			valHooks.textarea = hooks;
			propHooks.value = hooks;
		}

		$(function() {
			// Look for forms
			$(document).delegate('form', 'submit.placeholder', function() {
				// Clear the placeholder values so they don't get submitted
				var $inputs = $('.placeholder', this).each(clearPlaceholder);
				setTimeout(function() {
					$inputs.each(setPlaceholder);
				}, 10);
			});
		});

		// Clear placeholder values upon page reload
		$(window).bind('beforeunload.placeholder', function() {
			$('.placeholder').each(function() {
				this.value = '';
			});
		});

	}

	function args(elem) {
		// Return an object of element attributes
		var newAttrs = {};
		var rinlinejQuery = /^jQuery\d+$/;
		$.each(elem.attributes, function(i, attr) {
			if (attr.specified && !rinlinejQuery.test(attr.name)) {
				newAttrs[attr.name] = attr.value;
			}
		});
		return newAttrs;
	}

	function clearPlaceholder(event, value) {
		var input = this;
		var $input = $(input);
		if (input.value == $input.attr('placeholder') && $input.hasClass('placeholder')) {
			if ($input.data('placeholder-password')) {
				$input = $input.hide().next().show().attr('id', $input.removeAttr('id').data('placeholder-id'));
				// If `clearPlaceholder` was called from `$.valHooks.input.set`
				if (event === true) {
					return $input[0].value = value;
				}
				$input.focus();
			} else {
				input.value = '';
				$input.removeClass('placeholder');
				input == safeActiveElement() && input.select();
			}
		}
	}

	function setPlaceholder() {
		var $replacement;
		var input = this;
		var $input = $(input);
		var id = this.id;
		if (input.value == '') {
			if (input.type == 'password') {
				if (!$input.data('placeholder-textinput')) {
					try {
						$replacement = $input.clone().attr({ 'type': 'text' });
					} catch(e) {
						$replacement = $('<input>').attr($.extend(args(this), { 'type': 'text' }));
					}
					$replacement
						.removeAttr('name')
						.data({
							'placeholder-password': $input,
							'placeholder-id': id
						})
						.bind('focus.placeholder', clearPlaceholder);
					$input
						.data({
							'placeholder-textinput': $replacement,
							'placeholder-id': id
						})
						.before($replacement);
				}
				$input = $input.removeAttr('id').hide().prev().attr('id', id).show();
				// Note: `$input[0] != input` now!
			}
			$input.addClass('placeholder');
			$input[0].value = $input.attr('placeholder');
		} else {
			$input.removeClass('placeholder');
		}
	}

	function safeActiveElement() {
		// Avoid IE9 `document.activeElement` of death
		// https://github.com/mathiasbynens/jquery-placeholder/pull/99
		try {
			return document.activeElement;
		} catch (exception) {}
	}

}(this, document, jQuery));;/*!
 * VERSION: 1.11.5
 * DATE: 2014-02-20
 * UPDATES AND DOCS AT: http://www.greensock.com
 * 
 * Includes all of the following: TweenLite, TweenMax, TimelineLite, TimelineMax, EasePack, CSSPlugin, RoundPropsPlugin, BezierPlugin, AttrPlugin, DirectionalRotationPlugin
 *
 * @license Copyright (c) 2008-2014, GreenSock. All rights reserved.
 * This work is subject to the terms at http://www.greensock.com/terms_of_use.html or for
 * Club GreenSock members, the software agreement that was issued with your membership.
 * 
 * @author: Jack Doyle, jack@greensock.com
 **/
(window._gsQueue||(window._gsQueue=[])).push(function(){"use strict";window._gsDefine("TweenMax",["core.Animation","core.SimpleTimeline","TweenLite"],function(t,e,i){var s=[].slice,r=function(t,e,s){i.call(this,t,e,s),this._cycle=0,this._yoyo=this.vars.yoyo===!0,this._repeat=this.vars.repeat||0,this._repeatDelay=this.vars.repeatDelay||0,this._dirty=!0,this.render=r.prototype.render},n=1e-10,a=i._internals.isSelector,o=i._internals.isArray,h=r.prototype=i.to({},.1,{}),l=[];r.version="1.11.5",h.constructor=r,h.kill()._gc=!1,r.killTweensOf=r.killDelayedCallsTo=i.killTweensOf,r.getTweensOf=i.getTweensOf,r.ticker=i.ticker,h.invalidate=function(){return this._yoyo=this.vars.yoyo===!0,this._repeat=this.vars.repeat||0,this._repeatDelay=this.vars.repeatDelay||0,this._uncache(!0),i.prototype.invalidate.call(this)},h.updateTo=function(t,e){var s,r=this.ratio;e&&this._startTime<this._timeline._time&&(this._startTime=this._timeline._time,this._uncache(!1),this._gc?this._enabled(!0,!1):this._timeline.insert(this,this._startTime-this._delay));for(s in t)this.vars[s]=t[s];if(this._initted)if(e)this._initted=!1;else if(this._gc&&this._enabled(!0,!1),this._notifyPluginsOfEnabled&&this._firstPT&&i._onPluginEvent("_onDisable",this),this._time/this._duration>.998){var n=this._time;this.render(0,!0,!1),this._initted=!1,this.render(n,!0,!1)}else if(this._time>0){this._initted=!1,this._init();for(var a,o=1/(1-r),h=this._firstPT;h;)a=h.s+h.c,h.c*=o,h.s=a-h.c,h=h._next}return this},h.render=function(t,e,i){this._initted||0===this._duration&&this.vars.repeat&&this.invalidate();var s,r,a,o,h,_,u,p,c=this._dirty?this.totalDuration():this._totalDuration,f=this._time,m=this._totalTime,d=this._cycle,g=this._duration;if(t>=c?(this._totalTime=c,this._cycle=this._repeat,this._yoyo&&0!==(1&this._cycle)?(this._time=0,this.ratio=this._ease._calcEnd?this._ease.getRatio(0):0):(this._time=g,this.ratio=this._ease._calcEnd?this._ease.getRatio(1):1),this._reversed||(s=!0,r="onComplete"),0===g&&(p=this._rawPrevTime,(0===t||0>p||p===n)&&p!==t&&(i=!0,p>n&&(r="onReverseComplete")),this._rawPrevTime=p=!e||t||0===p?t:n)):1e-7>t?(this._totalTime=this._time=this._cycle=0,this.ratio=this._ease._calcEnd?this._ease.getRatio(0):0,(0!==m||0===g&&this._rawPrevTime>n)&&(r="onReverseComplete",s=this._reversed),0>t?(this._active=!1,0===g&&(this._rawPrevTime>=0&&(i=!0),this._rawPrevTime=p=!e||t||0===this._rawPrevTime?t:n)):this._initted||(i=!0)):(this._totalTime=this._time=t,0!==this._repeat&&(o=g+this._repeatDelay,this._cycle=this._totalTime/o>>0,0!==this._cycle&&this._cycle===this._totalTime/o&&this._cycle--,this._time=this._totalTime-this._cycle*o,this._yoyo&&0!==(1&this._cycle)&&(this._time=g-this._time),this._time>g?this._time=g:0>this._time&&(this._time=0)),this._easeType?(h=this._time/g,_=this._easeType,u=this._easePower,(1===_||3===_&&h>=.5)&&(h=1-h),3===_&&(h*=2),1===u?h*=h:2===u?h*=h*h:3===u?h*=h*h*h:4===u&&(h*=h*h*h*h),this.ratio=1===_?1-h:2===_?h:.5>this._time/g?h/2:1-h/2):this.ratio=this._ease.getRatio(this._time/g)),f===this._time&&!i&&d===this._cycle)return m!==this._totalTime&&this._onUpdate&&(e||this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||l)),void 0;if(!this._initted){if(this._init(),!this._initted||this._gc)return;this._time&&!s?this.ratio=this._ease.getRatio(this._time/g):s&&this._ease._calcEnd&&(this.ratio=this._ease.getRatio(0===this._time?0:1))}for(this._active||!this._paused&&this._time!==f&&t>=0&&(this._active=!0),0===m&&(this._startAt&&(t>=0?this._startAt.render(t,e,i):r||(r="_dummyGS")),this.vars.onStart&&(0!==this._totalTime||0===g)&&(e||this.vars.onStart.apply(this.vars.onStartScope||this,this.vars.onStartParams||l))),a=this._firstPT;a;)a.f?a.t[a.p](a.c*this.ratio+a.s):a.t[a.p]=a.c*this.ratio+a.s,a=a._next;this._onUpdate&&(0>t&&this._startAt&&this._startTime&&this._startAt.render(t,e,i),e||(this._totalTime!==m||s)&&this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||l)),this._cycle!==d&&(e||this._gc||this.vars.onRepeat&&this.vars.onRepeat.apply(this.vars.onRepeatScope||this,this.vars.onRepeatParams||l)),r&&(this._gc||(0>t&&this._startAt&&!this._onUpdate&&this._startTime&&this._startAt.render(t,e,i),s&&(this._timeline.autoRemoveChildren&&this._enabled(!1,!1),this._active=!1),!e&&this.vars[r]&&this.vars[r].apply(this.vars[r+"Scope"]||this,this.vars[r+"Params"]||l),0===g&&this._rawPrevTime===n&&p!==n&&(this._rawPrevTime=0)))},r.to=function(t,e,i){return new r(t,e,i)},r.from=function(t,e,i){return i.runBackwards=!0,i.immediateRender=0!=i.immediateRender,new r(t,e,i)},r.fromTo=function(t,e,i,s){return s.startAt=i,s.immediateRender=0!=s.immediateRender&&0!=i.immediateRender,new r(t,e,s)},r.staggerTo=r.allTo=function(t,e,n,h,_,u,p){h=h||0;var c,f,m,d,g=n.delay||0,v=[],y=function(){n.onComplete&&n.onComplete.apply(n.onCompleteScope||this,arguments),_.apply(p||this,u||l)};for(o(t)||("string"==typeof t&&(t=i.selector(t)||t),a(t)&&(t=s.call(t,0))),c=t.length,m=0;c>m;m++){f={};for(d in n)f[d]=n[d];f.delay=g,m===c-1&&_&&(f.onComplete=y),v[m]=new r(t[m],e,f),g+=h}return v},r.staggerFrom=r.allFrom=function(t,e,i,s,n,a,o){return i.runBackwards=!0,i.immediateRender=0!=i.immediateRender,r.staggerTo(t,e,i,s,n,a,o)},r.staggerFromTo=r.allFromTo=function(t,e,i,s,n,a,o,h){return s.startAt=i,s.immediateRender=0!=s.immediateRender&&0!=i.immediateRender,r.staggerTo(t,e,s,n,a,o,h)},r.delayedCall=function(t,e,i,s,n){return new r(e,0,{delay:t,onComplete:e,onCompleteParams:i,onCompleteScope:s,onReverseComplete:e,onReverseCompleteParams:i,onReverseCompleteScope:s,immediateRender:!1,useFrames:n,overwrite:0})},r.set=function(t,e){return new r(t,0,e)},r.isTweening=function(t){return i.getTweensOf(t,!0).length>0};var _=function(t,e){for(var s=[],r=0,n=t._first;n;)n instanceof i?s[r++]=n:(e&&(s[r++]=n),s=s.concat(_(n,e)),r=s.length),n=n._next;return s},u=r.getAllTweens=function(e){return _(t._rootTimeline,e).concat(_(t._rootFramesTimeline,e))};r.killAll=function(t,i,s,r){null==i&&(i=!0),null==s&&(s=!0);var n,a,o,h=u(0!=r),l=h.length,_=i&&s&&r;for(o=0;l>o;o++)a=h[o],(_||a instanceof e||(n=a.target===a.vars.onComplete)&&s||i&&!n)&&(t?a.totalTime(a.totalDuration()):a._enabled(!1,!1))},r.killChildTweensOf=function(t,e){if(null!=t){var n,h,l,_,u,p=i._tweenLookup;if("string"==typeof t&&(t=i.selector(t)||t),a(t)&&(t=s.call(t,0)),o(t))for(_=t.length;--_>-1;)r.killChildTweensOf(t[_],e);else{n=[];for(l in p)for(h=p[l].target.parentNode;h;)h===t&&(n=n.concat(p[l].tweens)),h=h.parentNode;for(u=n.length,_=0;u>_;_++)e&&n[_].totalTime(n[_].totalDuration()),n[_]._enabled(!1,!1)}}};var p=function(t,i,s,r){i=i!==!1,s=s!==!1,r=r!==!1;for(var n,a,o=u(r),h=i&&s&&r,l=o.length;--l>-1;)a=o[l],(h||a instanceof e||(n=a.target===a.vars.onComplete)&&s||i&&!n)&&a.paused(t)};return r.pauseAll=function(t,e,i){p(!0,t,e,i)},r.resumeAll=function(t,e,i){p(!1,t,e,i)},r.globalTimeScale=function(e){var s=t._rootTimeline,r=i.ticker.time;return arguments.length?(e=e||n,s._startTime=r-(r-s._startTime)*s._timeScale/e,s=t._rootFramesTimeline,r=i.ticker.frame,s._startTime=r-(r-s._startTime)*s._timeScale/e,s._timeScale=t._rootTimeline._timeScale=e,e):s._timeScale},h.progress=function(t){return arguments.length?this.totalTime(this.duration()*(this._yoyo&&0!==(1&this._cycle)?1-t:t)+this._cycle*(this._duration+this._repeatDelay),!1):this._time/this.duration()},h.totalProgress=function(t){return arguments.length?this.totalTime(this.totalDuration()*t,!1):this._totalTime/this.totalDuration()},h.time=function(t,e){return arguments.length?(this._dirty&&this.totalDuration(),t>this._duration&&(t=this._duration),this._yoyo&&0!==(1&this._cycle)?t=this._duration-t+this._cycle*(this._duration+this._repeatDelay):0!==this._repeat&&(t+=this._cycle*(this._duration+this._repeatDelay)),this.totalTime(t,e)):this._time},h.duration=function(e){return arguments.length?t.prototype.duration.call(this,e):this._duration},h.totalDuration=function(t){return arguments.length?-1===this._repeat?this:this.duration((t-this._repeat*this._repeatDelay)/(this._repeat+1)):(this._dirty&&(this._totalDuration=-1===this._repeat?999999999999:this._duration*(this._repeat+1)+this._repeatDelay*this._repeat,this._dirty=!1),this._totalDuration)},h.repeat=function(t){return arguments.length?(this._repeat=t,this._uncache(!0)):this._repeat},h.repeatDelay=function(t){return arguments.length?(this._repeatDelay=t,this._uncache(!0)):this._repeatDelay},h.yoyo=function(t){return arguments.length?(this._yoyo=t,this):this._yoyo},r},!0),window._gsDefine("TimelineLite",["core.Animation","core.SimpleTimeline","TweenLite"],function(t,e,i){var s=function(t){e.call(this,t),this._labels={},this.autoRemoveChildren=this.vars.autoRemoveChildren===!0,this.smoothChildTiming=this.vars.smoothChildTiming===!0,this._sortChildren=!0,this._onUpdate=this.vars.onUpdate;var i,s,r=this.vars;for(s in r)i=r[s],a(i)&&-1!==i.join("").indexOf("{self}")&&(r[s]=this._swapSelfInParams(i));a(r.tweens)&&this.add(r.tweens,0,r.align,r.stagger)},r=1e-10,n=i._internals.isSelector,a=i._internals.isArray,o=[],h=function(t){var e,i={};for(e in t)i[e]=t[e];return i},l=function(t,e,i,s){t._timeline.pause(t._startTime),e&&e.apply(s||t._timeline,i||o)},_=o.slice,u=s.prototype=new e;return s.version="1.11.5",u.constructor=s,u.kill()._gc=!1,u.to=function(t,e,s,r){return e?this.add(new i(t,e,s),r):this.set(t,s,r)},u.from=function(t,e,s,r){return this.add(i.from(t,e,s),r)},u.fromTo=function(t,e,s,r,n){return e?this.add(i.fromTo(t,e,s,r),n):this.set(t,r,n)},u.staggerTo=function(t,e,r,a,o,l,u,p){var c,f=new s({onComplete:l,onCompleteParams:u,onCompleteScope:p,smoothChildTiming:this.smoothChildTiming});for("string"==typeof t&&(t=i.selector(t)||t),n(t)&&(t=_.call(t,0)),a=a||0,c=0;t.length>c;c++)r.startAt&&(r.startAt=h(r.startAt)),f.to(t[c],e,h(r),c*a);return this.add(f,o)},u.staggerFrom=function(t,e,i,s,r,n,a,o){return i.immediateRender=0!=i.immediateRender,i.runBackwards=!0,this.staggerTo(t,e,i,s,r,n,a,o)},u.staggerFromTo=function(t,e,i,s,r,n,a,o,h){return s.startAt=i,s.immediateRender=0!=s.immediateRender&&0!=i.immediateRender,this.staggerTo(t,e,s,r,n,a,o,h)},u.call=function(t,e,s,r){return this.add(i.delayedCall(0,t,e,s),r)},u.set=function(t,e,s){return s=this._parseTimeOrLabel(s,0,!0),null==e.immediateRender&&(e.immediateRender=s===this._time&&!this._paused),this.add(new i(t,0,e),s)},s.exportRoot=function(t,e){t=t||{},null==t.smoothChildTiming&&(t.smoothChildTiming=!0);var r,n,a=new s(t),o=a._timeline;for(null==e&&(e=!0),o._remove(a,!0),a._startTime=0,a._rawPrevTime=a._time=a._totalTime=o._time,r=o._first;r;)n=r._next,e&&r instanceof i&&r.target===r.vars.onComplete||a.add(r,r._startTime-r._delay),r=n;return o.add(a,0),a},u.add=function(r,n,o,h){var l,_,u,p,c,f;if("number"!=typeof n&&(n=this._parseTimeOrLabel(n,0,!0,r)),!(r instanceof t)){if(r instanceof Array||r&&r.push&&a(r)){for(o=o||"normal",h=h||0,l=n,_=r.length,u=0;_>u;u++)a(p=r[u])&&(p=new s({tweens:p})),this.add(p,l),"string"!=typeof p&&"function"!=typeof p&&("sequence"===o?l=p._startTime+p.totalDuration()/p._timeScale:"start"===o&&(p._startTime-=p.delay())),l+=h;return this._uncache(!0)}if("string"==typeof r)return this.addLabel(r,n);if("function"!=typeof r)throw"Cannot add "+r+" into the timeline; it is not a tween, timeline, function, or string.";r=i.delayedCall(0,r)}if(e.prototype.add.call(this,r,n),(this._gc||this._time===this._duration)&&!this._paused&&this._duration<this.duration())for(c=this,f=c.rawTime()>r._startTime;c._timeline;)f&&c._timeline.smoothChildTiming?c.totalTime(c._totalTime,!0):c._gc&&c._enabled(!0,!1),c=c._timeline;return this},u.remove=function(e){if(e instanceof t)return this._remove(e,!1);if(e instanceof Array||e&&e.push&&a(e)){for(var i=e.length;--i>-1;)this.remove(e[i]);return this}return"string"==typeof e?this.removeLabel(e):this.kill(null,e)},u._remove=function(t,i){e.prototype._remove.call(this,t,i);var s=this._last;return s?this._time>s._startTime+s._totalDuration/s._timeScale&&(this._time=this.duration(),this._totalTime=this._totalDuration):this._time=this._totalTime=this._duration=this._totalDuration=0,this},u.append=function(t,e){return this.add(t,this._parseTimeOrLabel(null,e,!0,t))},u.insert=u.insertMultiple=function(t,e,i,s){return this.add(t,e||0,i,s)},u.appendMultiple=function(t,e,i,s){return this.add(t,this._parseTimeOrLabel(null,e,!0,t),i,s)},u.addLabel=function(t,e){return this._labels[t]=this._parseTimeOrLabel(e),this},u.addPause=function(t,e,i,s){return this.call(l,["{self}",e,i,s],this,t)},u.removeLabel=function(t){return delete this._labels[t],this},u.getLabelTime=function(t){return null!=this._labels[t]?this._labels[t]:-1},u._parseTimeOrLabel=function(e,i,s,r){var n;if(r instanceof t&&r.timeline===this)this.remove(r);else if(r&&(r instanceof Array||r.push&&a(r)))for(n=r.length;--n>-1;)r[n]instanceof t&&r[n].timeline===this&&this.remove(r[n]);if("string"==typeof i)return this._parseTimeOrLabel(i,s&&"number"==typeof e&&null==this._labels[i]?e-this.duration():0,s);if(i=i||0,"string"!=typeof e||!isNaN(e)&&null==this._labels[e])null==e&&(e=this.duration());else{if(n=e.indexOf("="),-1===n)return null==this._labels[e]?s?this._labels[e]=this.duration()+i:i:this._labels[e]+i;i=parseInt(e.charAt(n-1)+"1",10)*Number(e.substr(n+1)),e=n>1?this._parseTimeOrLabel(e.substr(0,n-1),0,s):this.duration()}return Number(e)+i},u.seek=function(t,e){return this.totalTime("number"==typeof t?t:this._parseTimeOrLabel(t),e!==!1)},u.stop=function(){return this.paused(!0)},u.gotoAndPlay=function(t,e){return this.play(t,e)},u.gotoAndStop=function(t,e){return this.pause(t,e)},u.render=function(t,e,i){this._gc&&this._enabled(!0,!1);var s,n,a,h,l,_=this._dirty?this.totalDuration():this._totalDuration,u=this._time,p=this._startTime,c=this._timeScale,f=this._paused;if(t>=_?(this._totalTime=this._time=_,this._reversed||this._hasPausedChild()||(n=!0,h="onComplete",0===this._duration&&(0===t||0>this._rawPrevTime||this._rawPrevTime===r)&&this._rawPrevTime!==t&&this._first&&(l=!0,this._rawPrevTime>r&&(h="onReverseComplete"))),this._rawPrevTime=this._duration||!e||t||0===this._rawPrevTime?t:r,t=_+1e-4):1e-7>t?(this._totalTime=this._time=0,(0!==u||0===this._duration&&(this._rawPrevTime>r||0>t&&this._rawPrevTime>=0))&&(h="onReverseComplete",n=this._reversed),0>t?(this._active=!1,0===this._duration&&this._rawPrevTime>=0&&this._first&&(l=!0),this._rawPrevTime=t):(this._rawPrevTime=this._duration||!e||t||0===this._rawPrevTime?t:r,t=0,this._initted||(l=!0))):this._totalTime=this._time=this._rawPrevTime=t,this._time!==u&&this._first||i||l){if(this._initted||(this._initted=!0),this._active||!this._paused&&this._time!==u&&t>0&&(this._active=!0),0===u&&this.vars.onStart&&0!==this._time&&(e||this.vars.onStart.apply(this.vars.onStartScope||this,this.vars.onStartParams||o)),this._time>=u)for(s=this._first;s&&(a=s._next,!this._paused||f);)(s._active||s._startTime<=this._time&&!s._paused&&!s._gc)&&(s._reversed?s.render((s._dirty?s.totalDuration():s._totalDuration)-(t-s._startTime)*s._timeScale,e,i):s.render((t-s._startTime)*s._timeScale,e,i)),s=a;else for(s=this._last;s&&(a=s._prev,!this._paused||f);)(s._active||u>=s._startTime&&!s._paused&&!s._gc)&&(s._reversed?s.render((s._dirty?s.totalDuration():s._totalDuration)-(t-s._startTime)*s._timeScale,e,i):s.render((t-s._startTime)*s._timeScale,e,i)),s=a;this._onUpdate&&(e||this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||o)),h&&(this._gc||(p===this._startTime||c!==this._timeScale)&&(0===this._time||_>=this.totalDuration())&&(n&&(this._timeline.autoRemoveChildren&&this._enabled(!1,!1),this._active=!1),!e&&this.vars[h]&&this.vars[h].apply(this.vars[h+"Scope"]||this,this.vars[h+"Params"]||o)))}},u._hasPausedChild=function(){for(var t=this._first;t;){if(t._paused||t instanceof s&&t._hasPausedChild())return!0;t=t._next}return!1},u.getChildren=function(t,e,s,r){r=r||-9999999999;for(var n=[],a=this._first,o=0;a;)r>a._startTime||(a instanceof i?e!==!1&&(n[o++]=a):(s!==!1&&(n[o++]=a),t!==!1&&(n=n.concat(a.getChildren(!0,e,s)),o=n.length))),a=a._next;return n},u.getTweensOf=function(t,e){for(var s=i.getTweensOf(t),r=s.length,n=[],a=0;--r>-1;)(s[r].timeline===this||e&&this._contains(s[r]))&&(n[a++]=s[r]);return n},u._contains=function(t){for(var e=t.timeline;e;){if(e===this)return!0;e=e.timeline}return!1},u.shiftChildren=function(t,e,i){i=i||0;for(var s,r=this._first,n=this._labels;r;)r._startTime>=i&&(r._startTime+=t),r=r._next;if(e)for(s in n)n[s]>=i&&(n[s]+=t);return this._uncache(!0)},u._kill=function(t,e){if(!t&&!e)return this._enabled(!1,!1);for(var i=e?this.getTweensOf(e):this.getChildren(!0,!0,!1),s=i.length,r=!1;--s>-1;)i[s]._kill(t,e)&&(r=!0);return r},u.clear=function(t){var e=this.getChildren(!1,!0,!0),i=e.length;for(this._time=this._totalTime=0;--i>-1;)e[i]._enabled(!1,!1);return t!==!1&&(this._labels={}),this._uncache(!0)},u.invalidate=function(){for(var t=this._first;t;)t.invalidate(),t=t._next;return this},u._enabled=function(t,i){if(t===this._gc)for(var s=this._first;s;)s._enabled(t,!0),s=s._next;return e.prototype._enabled.call(this,t,i)},u.duration=function(t){return arguments.length?(0!==this.duration()&&0!==t&&this.timeScale(this._duration/t),this):(this._dirty&&this.totalDuration(),this._duration)},u.totalDuration=function(t){if(!arguments.length){if(this._dirty){for(var e,i,s=0,r=this._last,n=999999999999;r;)e=r._prev,r._dirty&&r.totalDuration(),r._startTime>n&&this._sortChildren&&!r._paused?this.add(r,r._startTime-r._delay):n=r._startTime,0>r._startTime&&!r._paused&&(s-=r._startTime,this._timeline.smoothChildTiming&&(this._startTime+=r._startTime/this._timeScale),this.shiftChildren(-r._startTime,!1,-9999999999),n=0),i=r._startTime+r._totalDuration/r._timeScale,i>s&&(s=i),r=e;this._duration=this._totalDuration=s,this._dirty=!1}return this._totalDuration}return 0!==this.totalDuration()&&0!==t&&this.timeScale(this._totalDuration/t),this},u.usesFrames=function(){for(var e=this._timeline;e._timeline;)e=e._timeline;return e===t._rootFramesTimeline},u.rawTime=function(){return this._paused?this._totalTime:(this._timeline.rawTime()-this._startTime)*this._timeScale},s},!0),window._gsDefine("TimelineMax",["TimelineLite","TweenLite","easing.Ease"],function(t,e,i){var s=function(e){t.call(this,e),this._repeat=this.vars.repeat||0,this._repeatDelay=this.vars.repeatDelay||0,this._cycle=0,this._yoyo=this.vars.yoyo===!0,this._dirty=!0},r=1e-10,n=[],a=new i(null,null,1,0),o=s.prototype=new t;return o.constructor=s,o.kill()._gc=!1,s.version="1.11.5",o.invalidate=function(){return this._yoyo=this.vars.yoyo===!0,this._repeat=this.vars.repeat||0,this._repeatDelay=this.vars.repeatDelay||0,this._uncache(!0),t.prototype.invalidate.call(this)},o.addCallback=function(t,i,s,r){return this.add(e.delayedCall(0,t,s,r),i)},o.removeCallback=function(t,e){if(t)if(null==e)this._kill(null,t);else for(var i=this.getTweensOf(t,!1),s=i.length,r=this._parseTimeOrLabel(e);--s>-1;)i[s]._startTime===r&&i[s]._enabled(!1,!1);return this},o.tweenTo=function(t,i){i=i||{};var s,r,o,h={ease:a,overwrite:2,useFrames:this.usesFrames(),immediateRender:!1};for(r in i)h[r]=i[r];return h.time=this._parseTimeOrLabel(t),s=Math.abs(Number(h.time)-this._time)/this._timeScale||.001,o=new e(this,s,h),h.onStart=function(){o.target.paused(!0),o.vars.time!==o.target.time()&&s===o.duration()&&o.duration(Math.abs(o.vars.time-o.target.time())/o.target._timeScale),i.onStart&&i.onStart.apply(i.onStartScope||o,i.onStartParams||n)},o},o.tweenFromTo=function(t,e,i){i=i||{},t=this._parseTimeOrLabel(t),i.startAt={onComplete:this.seek,onCompleteParams:[t],onCompleteScope:this},i.immediateRender=i.immediateRender!==!1;var s=this.tweenTo(e,i);return s.duration(Math.abs(s.vars.time-t)/this._timeScale||.001)},o.render=function(t,e,i){this._gc&&this._enabled(!0,!1);var s,a,o,h,l,_,u=this._dirty?this.totalDuration():this._totalDuration,p=this._duration,c=this._time,f=this._totalTime,m=this._startTime,d=this._timeScale,g=this._rawPrevTime,v=this._paused,y=this._cycle;if(t>=u?(this._locked||(this._totalTime=u,this._cycle=this._repeat),this._reversed||this._hasPausedChild()||(a=!0,h="onComplete",0===this._duration&&(0===t||0>g||g===r)&&g!==t&&this._first&&(l=!0,g>r&&(h="onReverseComplete"))),this._rawPrevTime=this._duration||!e||t||0===this._rawPrevTime?t:r,this._yoyo&&0!==(1&this._cycle)?this._time=t=0:(this._time=p,t=p+1e-4)):1e-7>t?(this._locked||(this._totalTime=this._cycle=0),this._time=0,(0!==c||0===p&&(g>r||0>t&&g>=0)&&!this._locked)&&(h="onReverseComplete",a=this._reversed),0>t?(this._active=!1,0===p&&g>=0&&this._first&&(l=!0),this._rawPrevTime=t):(this._rawPrevTime=p||!e||t||0===this._rawPrevTime?t:r,t=0,this._initted||(l=!0))):(0===p&&0>g&&(l=!0),this._time=this._rawPrevTime=t,this._locked||(this._totalTime=t,0!==this._repeat&&(_=p+this._repeatDelay,this._cycle=this._totalTime/_>>0,0!==this._cycle&&this._cycle===this._totalTime/_&&this._cycle--,this._time=this._totalTime-this._cycle*_,this._yoyo&&0!==(1&this._cycle)&&(this._time=p-this._time),this._time>p?(this._time=p,t=p+1e-4):0>this._time?this._time=t=0:t=this._time))),this._cycle!==y&&!this._locked){var T=this._yoyo&&0!==(1&y),w=T===(this._yoyo&&0!==(1&this._cycle)),x=this._totalTime,b=this._cycle,P=this._rawPrevTime,S=this._time;if(this._totalTime=y*p,y>this._cycle?T=!T:this._totalTime+=p,this._time=c,this._rawPrevTime=0===p?g-1e-4:g,this._cycle=y,this._locked=!0,c=T?0:p,this.render(c,e,0===p),e||this._gc||this.vars.onRepeat&&this.vars.onRepeat.apply(this.vars.onRepeatScope||this,this.vars.onRepeatParams||n),w&&(c=T?p+1e-4:-1e-4,this.render(c,!0,!1)),this._locked=!1,this._paused&&!v)return;this._time=S,this._totalTime=x,this._cycle=b,this._rawPrevTime=P}if(!(this._time!==c&&this._first||i||l))return f!==this._totalTime&&this._onUpdate&&(e||this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||n)),void 0;if(this._initted||(this._initted=!0),this._active||!this._paused&&this._totalTime!==f&&t>0&&(this._active=!0),0===f&&this.vars.onStart&&0!==this._totalTime&&(e||this.vars.onStart.apply(this.vars.onStartScope||this,this.vars.onStartParams||n)),this._time>=c)for(s=this._first;s&&(o=s._next,!this._paused||v);)(s._active||s._startTime<=this._time&&!s._paused&&!s._gc)&&(s._reversed?s.render((s._dirty?s.totalDuration():s._totalDuration)-(t-s._startTime)*s._timeScale,e,i):s.render((t-s._startTime)*s._timeScale,e,i)),s=o;else for(s=this._last;s&&(o=s._prev,!this._paused||v);)(s._active||c>=s._startTime&&!s._paused&&!s._gc)&&(s._reversed?s.render((s._dirty?s.totalDuration():s._totalDuration)-(t-s._startTime)*s._timeScale,e,i):s.render((t-s._startTime)*s._timeScale,e,i)),s=o;this._onUpdate&&(e||this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||n)),h&&(this._locked||this._gc||(m===this._startTime||d!==this._timeScale)&&(0===this._time||u>=this.totalDuration())&&(a&&(this._timeline.autoRemoveChildren&&this._enabled(!1,!1),this._active=!1),!e&&this.vars[h]&&this.vars[h].apply(this.vars[h+"Scope"]||this,this.vars[h+"Params"]||n)))},o.getActive=function(t,e,i){null==t&&(t=!0),null==e&&(e=!0),null==i&&(i=!1);var s,r,n=[],a=this.getChildren(t,e,i),o=0,h=a.length;for(s=0;h>s;s++)r=a[s],r.isActive()&&(n[o++]=r);return n},o.getLabelAfter=function(t){t||0!==t&&(t=this._time);var e,i=this.getLabelsArray(),s=i.length;for(e=0;s>e;e++)if(i[e].time>t)return i[e].name;return null},o.getLabelBefore=function(t){null==t&&(t=this._time);for(var e=this.getLabelsArray(),i=e.length;--i>-1;)if(t>e[i].time)return e[i].name;return null},o.getLabelsArray=function(){var t,e=[],i=0;for(t in this._labels)e[i++]={time:this._labels[t],name:t};return e.sort(function(t,e){return t.time-e.time}),e},o.progress=function(t){return arguments.length?this.totalTime(this.duration()*(this._yoyo&&0!==(1&this._cycle)?1-t:t)+this._cycle*(this._duration+this._repeatDelay),!1):this._time/this.duration()},o.totalProgress=function(t){return arguments.length?this.totalTime(this.totalDuration()*t,!1):this._totalTime/this.totalDuration()},o.totalDuration=function(e){return arguments.length?-1===this._repeat?this:this.duration((e-this._repeat*this._repeatDelay)/(this._repeat+1)):(this._dirty&&(t.prototype.totalDuration.call(this),this._totalDuration=-1===this._repeat?999999999999:this._duration*(this._repeat+1)+this._repeatDelay*this._repeat),this._totalDuration)},o.time=function(t,e){return arguments.length?(this._dirty&&this.totalDuration(),t>this._duration&&(t=this._duration),this._yoyo&&0!==(1&this._cycle)?t=this._duration-t+this._cycle*(this._duration+this._repeatDelay):0!==this._repeat&&(t+=this._cycle*(this._duration+this._repeatDelay)),this.totalTime(t,e)):this._time},o.repeat=function(t){return arguments.length?(this._repeat=t,this._uncache(!0)):this._repeat},o.repeatDelay=function(t){return arguments.length?(this._repeatDelay=t,this._uncache(!0)):this._repeatDelay},o.yoyo=function(t){return arguments.length?(this._yoyo=t,this):this._yoyo},o.currentLabel=function(t){return arguments.length?this.seek(t,!0):this.getLabelBefore(this._time+1e-8)},s},!0),function(){var t=180/Math.PI,e=[],i=[],s=[],r={},n=function(t,e,i,s){this.a=t,this.b=e,this.c=i,this.d=s,this.da=s-t,this.ca=i-t,this.ba=e-t},a=",x,y,z,left,top,right,bottom,marginTop,marginLeft,marginRight,marginBottom,paddingLeft,paddingTop,paddingRight,paddingBottom,backgroundPosition,backgroundPosition_y,",o=function(t,e,i,s){var r={a:t},n={},a={},o={c:s},h=(t+e)/2,l=(e+i)/2,_=(i+s)/2,u=(h+l)/2,p=(l+_)/2,c=(p-u)/8;return r.b=h+(t-h)/4,n.b=u+c,r.c=n.a=(r.b+n.b)/2,n.c=a.a=(u+p)/2,a.b=p-c,o.b=_+(s-_)/4,a.c=o.a=(a.b+o.b)/2,[r,n,a,o]},h=function(t,r,n,a,h){var l,_,u,p,c,f,m,d,g,v,y,T,w,x=t.length-1,b=0,P=t[0].a;for(l=0;x>l;l++)c=t[b],_=c.a,u=c.d,p=t[b+1].d,h?(y=e[l],T=i[l],w=.25*(T+y)*r/(a?.5:s[l]||.5),f=u-(u-_)*(a?.5*r:0!==y?w/y:0),m=u+(p-u)*(a?.5*r:0!==T?w/T:0),d=u-(f+((m-f)*(3*y/(y+T)+.5)/4||0))):(f=u-.5*(u-_)*r,m=u+.5*(p-u)*r,d=u-(f+m)/2),f+=d,m+=d,c.c=g=f,c.b=0!==l?P:P=c.a+.6*(c.c-c.a),c.da=u-_,c.ca=g-_,c.ba=P-_,n?(v=o(_,P,g,u),t.splice(b,1,v[0],v[1],v[2],v[3]),b+=4):b++,P=m;c=t[b],c.b=P,c.c=P+.4*(c.d-P),c.da=c.d-c.a,c.ca=c.c-c.a,c.ba=P-c.a,n&&(v=o(c.a,P,c.c,c.d),t.splice(b,1,v[0],v[1],v[2],v[3]))},l=function(t,s,r,a){var o,h,l,_,u,p,c=[];if(a)for(t=[a].concat(t),h=t.length;--h>-1;)"string"==typeof(p=t[h][s])&&"="===p.charAt(1)&&(t[h][s]=a[s]+Number(p.charAt(0)+p.substr(2)));if(o=t.length-2,0>o)return c[0]=new n(t[0][s],0,0,t[-1>o?0:1][s]),c;for(h=0;o>h;h++)l=t[h][s],_=t[h+1][s],c[h]=new n(l,0,0,_),r&&(u=t[h+2][s],e[h]=(e[h]||0)+(_-l)*(_-l),i[h]=(i[h]||0)+(u-_)*(u-_));return c[h]=new n(t[h][s],0,0,t[h+1][s]),c},_=function(t,n,o,_,u,p){var c,f,m,d,g,v,y,T,w={},x=[],b=p||t[0];u="string"==typeof u?","+u+",":a,null==n&&(n=1);for(f in t[0])x.push(f);if(t.length>1){for(T=t[t.length-1],y=!0,c=x.length;--c>-1;)if(f=x[c],Math.abs(b[f]-T[f])>.05){y=!1;break}y&&(t=t.concat(),p&&t.unshift(p),t.push(t[1]),p=t[t.length-3])}for(e.length=i.length=s.length=0,c=x.length;--c>-1;)f=x[c],r[f]=-1!==u.indexOf(","+f+","),w[f]=l(t,f,r[f],p);for(c=e.length;--c>-1;)e[c]=Math.sqrt(e[c]),i[c]=Math.sqrt(i[c]);if(!_){for(c=x.length;--c>-1;)if(r[f])for(m=w[x[c]],v=m.length-1,d=0;v>d;d++)g=m[d+1].da/i[d]+m[d].da/e[d],s[d]=(s[d]||0)+g*g;for(c=s.length;--c>-1;)s[c]=Math.sqrt(s[c])}for(c=x.length,d=o?4:1;--c>-1;)f=x[c],m=w[f],h(m,n,o,_,r[f]),y&&(m.splice(0,d),m.splice(m.length-d,d));return w},u=function(t,e,i){e=e||"soft";var s,r,a,o,h,l,_,u,p,c,f,m={},d="cubic"===e?3:2,g="soft"===e,v=[];if(g&&i&&(t=[i].concat(t)),null==t||d+1>t.length)throw"invalid Bezier data";for(p in t[0])v.push(p);for(l=v.length;--l>-1;){for(p=v[l],m[p]=h=[],c=0,u=t.length,_=0;u>_;_++)s=null==i?t[_][p]:"string"==typeof(f=t[_][p])&&"="===f.charAt(1)?i[p]+Number(f.charAt(0)+f.substr(2)):Number(f),g&&_>1&&u-1>_&&(h[c++]=(s+h[c-2])/2),h[c++]=s;for(u=c-d+1,c=0,_=0;u>_;_+=d)s=h[_],r=h[_+1],a=h[_+2],o=2===d?0:h[_+3],h[c++]=f=3===d?new n(s,r,a,o):new n(s,(2*r+s)/3,(2*r+a)/3,a);h.length=c}return m},p=function(t,e,i){for(var s,r,n,a,o,h,l,_,u,p,c,f=1/i,m=t.length;--m>-1;)for(p=t[m],n=p.a,a=p.d-n,o=p.c-n,h=p.b-n,s=r=0,_=1;i>=_;_++)l=f*_,u=1-l,s=r-(r=(l*l*a+3*u*(l*o+u*h))*l),c=m*i+_-1,e[c]=(e[c]||0)+s*s},c=function(t,e){e=e>>0||6;var i,s,r,n,a=[],o=[],h=0,l=0,_=e-1,u=[],c=[];for(i in t)p(t[i],a,e);for(r=a.length,s=0;r>s;s++)h+=Math.sqrt(a[s]),n=s%e,c[n]=h,n===_&&(l+=h,n=s/e>>0,u[n]=c,o[n]=l,h=0,c=[]);return{length:l,lengths:o,segments:u}},f=window._gsDefine.plugin({propName:"bezier",priority:-1,API:2,global:!0,init:function(t,e,i){this._target=t,e instanceof Array&&(e={values:e}),this._func={},this._round={},this._props=[],this._timeRes=null==e.timeResolution?6:parseInt(e.timeResolution,10);var s,r,n,a,o,h=e.values||[],l={},p=h[0],f=e.autoRotate||i.vars.orientToBezier;this._autoRotate=f?f instanceof Array?f:[["x","y","rotation",f===!0?0:Number(f)||0]]:null;for(s in p)this._props.push(s);for(n=this._props.length;--n>-1;)s=this._props[n],this._overwriteProps.push(s),r=this._func[s]="function"==typeof t[s],l[s]=r?t[s.indexOf("set")||"function"!=typeof t["get"+s.substr(3)]?s:"get"+s.substr(3)]():parseFloat(t[s]),o||l[s]!==h[0][s]&&(o=l);if(this._beziers="cubic"!==e.type&&"quadratic"!==e.type&&"soft"!==e.type?_(h,isNaN(e.curviness)?1:e.curviness,!1,"thruBasic"===e.type,e.correlate,o):u(h,e.type,l),this._segCount=this._beziers[s].length,this._timeRes){var m=c(this._beziers,this._timeRes);this._length=m.length,this._lengths=m.lengths,this._segments=m.segments,this._l1=this._li=this._s1=this._si=0,this._l2=this._lengths[0],this._curSeg=this._segments[0],this._s2=this._curSeg[0],this._prec=1/this._curSeg.length}if(f=this._autoRotate)for(f[0]instanceof Array||(this._autoRotate=f=[f]),n=f.length;--n>-1;)for(a=0;3>a;a++)s=f[n][a],this._func[s]="function"==typeof t[s]?t[s.indexOf("set")||"function"!=typeof t["get"+s.substr(3)]?s:"get"+s.substr(3)]:!1;return!0},set:function(e){var i,s,r,n,a,o,h,l,_,u,p=this._segCount,c=this._func,f=this._target;if(this._timeRes){if(_=this._lengths,u=this._curSeg,e*=this._length,r=this._li,e>this._l2&&p-1>r){for(l=p-1;l>r&&e>=(this._l2=_[++r]););this._l1=_[r-1],this._li=r,this._curSeg=u=this._segments[r],this._s2=u[this._s1=this._si=0]}else if(this._l1>e&&r>0){for(;r>0&&(this._l1=_[--r])>=e;);0===r&&this._l1>e?this._l1=0:r++,this._l2=_[r],this._li=r,this._curSeg=u=this._segments[r],this._s1=u[(this._si=u.length-1)-1]||0,this._s2=u[this._si]}if(i=r,e-=this._l1,r=this._si,e>this._s2&&u.length-1>r){for(l=u.length-1;l>r&&e>=(this._s2=u[++r]););this._s1=u[r-1],this._si=r}else if(this._s1>e&&r>0){for(;r>0&&(this._s1=u[--r])>=e;);0===r&&this._s1>e?this._s1=0:r++,this._s2=u[r],this._si=r}o=(r+(e-this._s1)/(this._s2-this._s1))*this._prec}else i=0>e?0:e>=1?p-1:p*e>>0,o=(e-i*(1/p))*p;for(s=1-o,r=this._props.length;--r>-1;)n=this._props[r],a=this._beziers[n][i],h=(o*o*a.da+3*s*(o*a.ca+s*a.ba))*o+a.a,this._round[n]&&(h=h+(h>0?.5:-.5)>>0),c[n]?f[n](h):f[n]=h;if(this._autoRotate){var m,d,g,v,y,T,w,x=this._autoRotate;for(r=x.length;--r>-1;)n=x[r][2],T=x[r][3]||0,w=x[r][4]===!0?1:t,a=this._beziers[x[r][0]],m=this._beziers[x[r][1]],a&&m&&(a=a[i],m=m[i],d=a.a+(a.b-a.a)*o,v=a.b+(a.c-a.b)*o,d+=(v-d)*o,v+=(a.c+(a.d-a.c)*o-v)*o,g=m.a+(m.b-m.a)*o,y=m.b+(m.c-m.b)*o,g+=(y-g)*o,y+=(m.c+(m.d-m.c)*o-y)*o,h=Math.atan2(y-g,v-d)*w+T,c[n]?f[n](h):f[n]=h)}}}),m=f.prototype;f.bezierThrough=_,f.cubicToQuadratic=o,f._autoCSS=!0,f.quadraticToCubic=function(t,e,i){return new n(t,(2*e+t)/3,(2*e+i)/3,i)},f._cssRegister=function(){var t=window._gsDefine.globals.CSSPlugin;if(t){var e=t._internals,i=e._parseToProxy,s=e._setPluginRatio,r=e.CSSPropTween;e._registerComplexSpecialProp("bezier",{parser:function(t,e,n,a,o,h){e instanceof Array&&(e={values:e}),h=new f;var l,_,u,p=e.values,c=p.length-1,m=[],d={};if(0>c)return o;for(l=0;c>=l;l++)u=i(t,p[l],a,o,h,c!==l),m[l]=u.end;for(_ in e)d[_]=e[_];return d.values=m,o=new r(t,"bezier",0,0,u.pt,2),o.data=u,o.plugin=h,o.setRatio=s,0===d.autoRotate&&(d.autoRotate=!0),!d.autoRotate||d.autoRotate instanceof Array||(l=d.autoRotate===!0?0:Number(d.autoRotate),d.autoRotate=null!=u.end.left?[["left","top","rotation",l,!1]]:null!=u.end.x?[["x","y","rotation",l,!1]]:!1),d.autoRotate&&(a._transform||a._enableTransforms(!1),u.autoRotate=a._target._gsTransform),h._onInitTween(u.proxy,d,a._tween),o
}})}},m._roundProps=function(t,e){for(var i=this._overwriteProps,s=i.length;--s>-1;)(t[i[s]]||t.bezier||t.bezierThrough)&&(this._round[i[s]]=e)},m._kill=function(t){var e,i,s=this._props;for(e in this._beziers)if(e in t)for(delete this._beziers[e],delete this._func[e],i=s.length;--i>-1;)s[i]===e&&s.splice(i,1);return this._super._kill.call(this,t)}}(),window._gsDefine("plugins.CSSPlugin",["plugins.TweenPlugin","TweenLite"],function(t,e){var i,s,r,n,a=function(){t.call(this,"css"),this._overwriteProps.length=0,this.setRatio=a.prototype.setRatio},o={},h=a.prototype=new t("css");h.constructor=a,a.version="1.11.5",a.API=2,a.defaultTransformPerspective=0,h="px",a.suffixMap={top:h,right:h,bottom:h,left:h,width:h,height:h,fontSize:h,padding:h,margin:h,perspective:h,lineHeight:""};var l,_,u,p,c,f,m=/(?:\d|\-\d|\.\d|\-\.\d)+/g,d=/(?:\d|\-\d|\.\d|\-\.\d|\+=\d|\-=\d|\+=.\d|\-=\.\d)+/g,g=/(?:\+=|\-=|\-|\b)[\d\-\.]+[a-zA-Z0-9]*(?:%|\b)/gi,v=/[^\d\-\.]/g,y=/(?:\d|\-|\+|=|#|\.)*/g,T=/opacity *= *([^)]*)/,w=/opacity:([^;]*)/,x=/alpha\(opacity *=.+?\)/i,b=/^(rgb|hsl)/,P=/([A-Z])/g,S=/-([a-z])/gi,k=/(^(?:url\(\"|url\())|(?:(\"\))$|\)$)/gi,R=function(t,e){return e.toUpperCase()},A=/(?:Left|Right|Width)/i,C=/(M11|M12|M21|M22)=[\d\-\.e]+/gi,O=/progid\:DXImageTransform\.Microsoft\.Matrix\(.+?\)/i,D=/,(?=[^\)]*(?:\(|$))/gi,M=Math.PI/180,I=180/Math.PI,E={},N=document,F=N.createElement("div"),L=N.createElement("img"),X=a._internals={_specialProps:o},z=navigator.userAgent,U=function(){var t,e=z.indexOf("Android"),i=N.createElement("div");return u=-1!==z.indexOf("Safari")&&-1===z.indexOf("Chrome")&&(-1===e||Number(z.substr(e+8,1))>3),c=u&&6>Number(z.substr(z.indexOf("Version/")+8,1)),p=-1!==z.indexOf("Firefox"),/MSIE ([0-9]{1,}[\.0-9]{0,})/.exec(z)&&(f=parseFloat(RegExp.$1)),i.innerHTML="<a style='top:1px;opacity:.55;'>a</a>",t=i.getElementsByTagName("a")[0],t?/^0.55/.test(t.style.opacity):!1}(),Y=function(t){return T.test("string"==typeof t?t:(t.currentStyle?t.currentStyle.filter:t.style.filter)||"")?parseFloat(RegExp.$1)/100:1},j=function(t){window.console&&console.log(t)},B="",q="",V=function(t,e){e=e||F;var i,s,r=e.style;if(void 0!==r[t])return t;for(t=t.charAt(0).toUpperCase()+t.substr(1),i=["O","Moz","ms","Ms","Webkit"],s=5;--s>-1&&void 0===r[i[s]+t];);return s>=0?(q=3===s?"ms":i[s],B="-"+q.toLowerCase()+"-",q+t):null},W=N.defaultView?N.defaultView.getComputedStyle:function(){},G=a.getStyle=function(t,e,i,s,r){var n;return U||"opacity"!==e?(!s&&t.style[e]?n=t.style[e]:(i=i||W(t,null))?(t=i.getPropertyValue(e.replace(P,"-$1").toLowerCase()),n=t||i.length?t:i[e]):t.currentStyle&&(n=t.currentStyle[e]),null==r||n&&"none"!==n&&"auto"!==n&&"auto auto"!==n?n:r):Y(t)},$=function(t,e,i,s,r){if("px"===s||!s)return i;if("auto"===s||!i)return 0;var n,a=A.test(e),o=t,h=F.style,l=0>i;return l&&(i=-i),"%"===s&&-1!==e.indexOf("border")?n=i/100*(a?t.clientWidth:t.clientHeight):(h.cssText="border:0 solid red;position:"+G(t,"position")+";line-height:0;","%"!==s&&o.appendChild?h[a?"borderLeftWidth":"borderTopWidth"]=i+s:(o=t.parentNode||N.body,h[a?"width":"height"]=i+s),o.appendChild(F),n=parseFloat(F[a?"offsetWidth":"offsetHeight"]),o.removeChild(F),0!==n||r||(n=$(t,e,i,s,!0))),l?-n:n},Z=function(t,e,i){if("absolute"!==G(t,"position",i))return 0;var s="left"===e?"Left":"Top",r=G(t,"margin"+s,i);return t["offset"+s]-($(t,e,parseFloat(r),r.replace(y,""))||0)},Q=function(t,e){var i,s,r={};if(e=e||W(t,null))if(i=e.length)for(;--i>-1;)r[e[i].replace(S,R)]=e.getPropertyValue(e[i]);else for(i in e)r[i]=e[i];else if(e=t.currentStyle||t.style)for(i in e)"string"==typeof i&&void 0===r[i]&&(r[i.replace(S,R)]=e[i]);return U||(r.opacity=Y(t)),s=be(t,e,!1),r.rotation=s.rotation,r.skewX=s.skewX,r.scaleX=s.scaleX,r.scaleY=s.scaleY,r.x=s.x,r.y=s.y,xe&&(r.z=s.z,r.rotationX=s.rotationX,r.rotationY=s.rotationY,r.scaleZ=s.scaleZ),r.filters&&delete r.filters,r},H=function(t,e,i,s,r){var n,a,o,h={},l=t.style;for(a in i)"cssText"!==a&&"length"!==a&&isNaN(a)&&(e[a]!==(n=i[a])||r&&r[a])&&-1===a.indexOf("Origin")&&("number"==typeof n||"string"==typeof n)&&(h[a]="auto"!==n||"left"!==a&&"top"!==a?""!==n&&"auto"!==n&&"none"!==n||"string"!=typeof e[a]||""===e[a].replace(v,"")?n:0:Z(t,a),void 0!==l[a]&&(o=new ue(l,a,l[a],o)));if(s)for(a in s)"className"!==a&&(h[a]=s[a]);return{difs:h,firstMPT:o}},K={width:["Left","Right"],height:["Top","Bottom"]},J=["marginLeft","marginRight","marginTop","marginBottom"],te=function(t,e,i){var s=parseFloat("width"===e?t.offsetWidth:t.offsetHeight),r=K[e],n=r.length;for(i=i||W(t,null);--n>-1;)s-=parseFloat(G(t,"padding"+r[n],i,!0))||0,s-=parseFloat(G(t,"border"+r[n]+"Width",i,!0))||0;return s},ee=function(t,e){(null==t||""===t||"auto"===t||"auto auto"===t)&&(t="0 0");var i=t.split(" "),s=-1!==t.indexOf("left")?"0%":-1!==t.indexOf("right")?"100%":i[0],r=-1!==t.indexOf("top")?"0%":-1!==t.indexOf("bottom")?"100%":i[1];return null==r?r="0":"center"===r&&(r="50%"),("center"===s||isNaN(parseFloat(s))&&-1===(s+"").indexOf("="))&&(s="50%"),e&&(e.oxp=-1!==s.indexOf("%"),e.oyp=-1!==r.indexOf("%"),e.oxr="="===s.charAt(1),e.oyr="="===r.charAt(1),e.ox=parseFloat(s.replace(v,"")),e.oy=parseFloat(r.replace(v,""))),s+" "+r+(i.length>2?" "+i[2]:"")},ie=function(t,e){return"string"==typeof t&&"="===t.charAt(1)?parseInt(t.charAt(0)+"1",10)*parseFloat(t.substr(2)):parseFloat(t)-parseFloat(e)},se=function(t,e){return null==t?e:"string"==typeof t&&"="===t.charAt(1)?parseInt(t.charAt(0)+"1",10)*Number(t.substr(2))+e:parseFloat(t)},re=function(t,e,i,s){var r,n,a,o,h=1e-6;return null==t?o=e:"number"==typeof t?o=t:(r=360,n=t.split("_"),a=Number(n[0].replace(v,""))*(-1===t.indexOf("rad")?1:I)-("="===t.charAt(1)?0:e),n.length&&(s&&(s[i]=e+a),-1!==t.indexOf("short")&&(a%=r,a!==a%(r/2)&&(a=0>a?a+r:a-r)),-1!==t.indexOf("_cw")&&0>a?a=(a+9999999999*r)%r-(0|a/r)*r:-1!==t.indexOf("ccw")&&a>0&&(a=(a-9999999999*r)%r-(0|a/r)*r)),o=e+a),h>o&&o>-h&&(o=0),o},ne={aqua:[0,255,255],lime:[0,255,0],silver:[192,192,192],black:[0,0,0],maroon:[128,0,0],teal:[0,128,128],blue:[0,0,255],navy:[0,0,128],white:[255,255,255],fuchsia:[255,0,255],olive:[128,128,0],yellow:[255,255,0],orange:[255,165,0],gray:[128,128,128],purple:[128,0,128],green:[0,128,0],red:[255,0,0],pink:[255,192,203],cyan:[0,255,255],transparent:[255,255,255,0]},ae=function(t,e,i){return t=0>t?t+1:t>1?t-1:t,0|255*(1>6*t?e+6*(i-e)*t:.5>t?i:2>3*t?e+6*(i-e)*(2/3-t):e)+.5},oe=function(t){var e,i,s,r,n,a;return t&&""!==t?"number"==typeof t?[t>>16,255&t>>8,255&t]:(","===t.charAt(t.length-1)&&(t=t.substr(0,t.length-1)),ne[t]?ne[t]:"#"===t.charAt(0)?(4===t.length&&(e=t.charAt(1),i=t.charAt(2),s=t.charAt(3),t="#"+e+e+i+i+s+s),t=parseInt(t.substr(1),16),[t>>16,255&t>>8,255&t]):"hsl"===t.substr(0,3)?(t=t.match(m),r=Number(t[0])%360/360,n=Number(t[1])/100,a=Number(t[2])/100,i=.5>=a?a*(n+1):a+n-a*n,e=2*a-i,t.length>3&&(t[3]=Number(t[3])),t[0]=ae(r+1/3,e,i),t[1]=ae(r,e,i),t[2]=ae(r-1/3,e,i),t):(t=t.match(m)||ne.transparent,t[0]=Number(t[0]),t[1]=Number(t[1]),t[2]=Number(t[2]),t.length>3&&(t[3]=Number(t[3])),t)):ne.black},he="(?:\\b(?:(?:rgb|rgba|hsl|hsla)\\(.+?\\))|\\B#.+?\\b";for(h in ne)he+="|"+h+"\\b";he=RegExp(he+")","gi");var le=function(t,e,i,s){if(null==t)return function(t){return t};var r,n=e?(t.match(he)||[""])[0]:"",a=t.split(n).join("").match(g)||[],o=t.substr(0,t.indexOf(a[0])),h=")"===t.charAt(t.length-1)?")":"",l=-1!==t.indexOf(" ")?" ":",",_=a.length,u=_>0?a[0].replace(m,""):"";return _?r=e?function(t){var e,p,c,f;if("number"==typeof t)t+=u;else if(s&&D.test(t)){for(f=t.replace(D,"|").split("|"),c=0;f.length>c;c++)f[c]=r(f[c]);return f.join(",")}if(e=(t.match(he)||[n])[0],p=t.split(e).join("").match(g)||[],c=p.length,_>c--)for(;_>++c;)p[c]=i?p[0|(c-1)/2]:a[c];return o+p.join(l)+l+e+h+(-1!==t.indexOf("inset")?" inset":"")}:function(t){var e,n,p;if("number"==typeof t)t+=u;else if(s&&D.test(t)){for(n=t.replace(D,"|").split("|"),p=0;n.length>p;p++)n[p]=r(n[p]);return n.join(",")}if(e=t.match(g)||[],p=e.length,_>p--)for(;_>++p;)e[p]=i?e[0|(p-1)/2]:a[p];return o+e.join(l)+h}:function(t){return t}},_e=function(t){return t=t.split(","),function(e,i,s,r,n,a,o){var h,l=(i+"").split(" ");for(o={},h=0;4>h;h++)o[t[h]]=l[h]=l[h]||l[(h-1)/2>>0];return r.parse(e,o,n,a)}},ue=(X._setPluginRatio=function(t){this.plugin.setRatio(t);for(var e,i,s,r,n=this.data,a=n.proxy,o=n.firstMPT,h=1e-6;o;)e=a[o.v],o.r?e=e>0?0|e+.5:0|e-.5:h>e&&e>-h&&(e=0),o.t[o.p]=e,o=o._next;if(n.autoRotate&&(n.autoRotate.rotation=a.rotation),1===t)for(o=n.firstMPT;o;){if(i=o.t,i.type){if(1===i.type){for(r=i.xs0+i.s+i.xs1,s=1;i.l>s;s++)r+=i["xn"+s]+i["xs"+(s+1)];i.e=r}}else i.e=i.s+i.xs0;o=o._next}},function(t,e,i,s,r){this.t=t,this.p=e,this.v=i,this.r=r,s&&(s._prev=this,this._next=s)}),pe=(X._parseToProxy=function(t,e,i,s,r,n){var a,o,h,l,_,u=s,p={},c={},f=i._transform,m=E;for(i._transform=null,E=e,s=_=i.parse(t,e,s,r),E=m,n&&(i._transform=f,u&&(u._prev=null,u._prev&&(u._prev._next=null)));s&&s!==u;){if(1>=s.type&&(o=s.p,c[o]=s.s+s.c,p[o]=s.s,n||(l=new ue(s,"s",o,l,s.r),s.c=0),1===s.type))for(a=s.l;--a>0;)h="xn"+a,o=s.p+"_"+h,c[o]=s.data[h],p[o]=s[h],n||(l=new ue(s,h,o,l,s.rxp[h]));s=s._next}return{proxy:p,end:c,firstMPT:l,pt:_}},X.CSSPropTween=function(t,e,s,r,a,o,h,l,_,u,p){this.t=t,this.p=e,this.s=s,this.c=r,this.n=h||e,t instanceof pe||n.push(this.n),this.r=l,this.type=o||0,_&&(this.pr=_,i=!0),this.b=void 0===u?s:u,this.e=void 0===p?s+r:p,a&&(this._next=a,a._prev=this)}),ce=a.parseComplex=function(t,e,i,s,r,n,a,o,h,_){i=i||n||"",a=new pe(t,e,0,0,a,_?2:1,null,!1,o,i,s),s+="";var u,p,c,f,g,v,y,T,w,x,P,S,k=i.split(", ").join(",").split(" "),R=s.split(", ").join(",").split(" "),A=k.length,C=l!==!1;for((-1!==s.indexOf(",")||-1!==i.indexOf(","))&&(k=k.join(" ").replace(D,", ").split(" "),R=R.join(" ").replace(D,", ").split(" "),A=k.length),A!==R.length&&(k=(n||"").split(" "),A=k.length),a.plugin=h,a.setRatio=_,u=0;A>u;u++)if(f=k[u],g=R[u],T=parseFloat(f),T||0===T)a.appendXtra("",T,ie(g,T),g.replace(d,""),C&&-1!==g.indexOf("px"),!0);else if(r&&("#"===f.charAt(0)||ne[f]||b.test(f)))S=","===g.charAt(g.length-1)?"),":")",f=oe(f),g=oe(g),w=f.length+g.length>6,w&&!U&&0===g[3]?(a["xs"+a.l]+=a.l?" transparent":"transparent",a.e=a.e.split(R[u]).join("transparent")):(U||(w=!1),a.appendXtra(w?"rgba(":"rgb(",f[0],g[0]-f[0],",",!0,!0).appendXtra("",f[1],g[1]-f[1],",",!0).appendXtra("",f[2],g[2]-f[2],w?",":S,!0),w&&(f=4>f.length?1:f[3],a.appendXtra("",f,(4>g.length?1:g[3])-f,S,!1)));else if(v=f.match(m)){if(y=g.match(d),!y||y.length!==v.length)return a;for(c=0,p=0;v.length>p;p++)P=v[p],x=f.indexOf(P,c),a.appendXtra(f.substr(c,x-c),Number(P),ie(y[p],P),"",C&&"px"===f.substr(x+P.length,2),0===p),c=x+P.length;a["xs"+a.l]+=f.substr(c)}else a["xs"+a.l]+=a.l?" "+f:f;if(-1!==s.indexOf("=")&&a.data){for(S=a.xs0+a.data.s,u=1;a.l>u;u++)S+=a["xs"+u]+a.data["xn"+u];a.e=S+a["xs"+u]}return a.l||(a.type=-1,a.xs0=a.e),a.xfirst||a},fe=9;for(h=pe.prototype,h.l=h.pr=0;--fe>0;)h["xn"+fe]=0,h["xs"+fe]="";h.xs0="",h._next=h._prev=h.xfirst=h.data=h.plugin=h.setRatio=h.rxp=null,h.appendXtra=function(t,e,i,s,r,n){var a=this,o=a.l;return a["xs"+o]+=n&&o?" "+t:t||"",i||0===o||a.plugin?(a.l++,a.type=a.setRatio?2:1,a["xs"+a.l]=s||"",o>0?(a.data["xn"+o]=e+i,a.rxp["xn"+o]=r,a["xn"+o]=e,a.plugin||(a.xfirst=new pe(a,"xn"+o,e,i,a.xfirst||a,0,a.n,r,a.pr),a.xfirst.xs0=0),a):(a.data={s:e+i},a.rxp={},a.s=e,a.c=i,a.r=r,a)):(a["xs"+o]+=e+(s||""),a)};var me=function(t,e){e=e||{},this.p=e.prefix?V(t)||t:t,o[t]=o[this.p]=this,this.format=e.formatter||le(e.defaultValue,e.color,e.collapsible,e.multi),e.parser&&(this.parse=e.parser),this.clrs=e.color,this.multi=e.multi,this.keyword=e.keyword,this.dflt=e.defaultValue,this.pr=e.priority||0},de=X._registerComplexSpecialProp=function(t,e,i){"object"!=typeof e&&(e={parser:i});var s,r,n=t.split(","),a=e.defaultValue;for(i=i||[a],s=0;n.length>s;s++)e.prefix=0===s&&e.prefix,e.defaultValue=i[s]||a,r=new me(n[s],e)},ge=function(t){if(!o[t]){var e=t.charAt(0).toUpperCase()+t.substr(1)+"Plugin";de(t,{parser:function(t,i,s,r,n,a,h){var l=(window.GreenSockGlobals||window).com.greensock.plugins[e];return l?(l._cssRegister(),o[s].parse(t,i,s,r,n,a,h)):(j("Error: "+e+" js file not loaded."),n)}})}};h=me.prototype,h.parseComplex=function(t,e,i,s,r,n){var a,o,h,l,_,u,p=this.keyword;if(this.multi&&(D.test(i)||D.test(e)?(o=e.replace(D,"|").split("|"),h=i.replace(D,"|").split("|")):p&&(o=[e],h=[i])),h){for(l=h.length>o.length?h.length:o.length,a=0;l>a;a++)e=o[a]=o[a]||this.dflt,i=h[a]=h[a]||this.dflt,p&&(_=e.indexOf(p),u=i.indexOf(p),_!==u&&(i=-1===u?h:o,i[a]+=" "+p));e=o.join(", "),i=h.join(", ")}return ce(t,this.p,e,i,this.clrs,this.dflt,s,this.pr,r,n)},h.parse=function(t,e,i,s,n,a){return this.parseComplex(t.style,this.format(G(t,this.p,r,!1,this.dflt)),this.format(e),n,a)},a.registerSpecialProp=function(t,e,i){de(t,{parser:function(t,s,r,n,a,o){var h=new pe(t,r,0,0,a,2,r,!1,i);return h.plugin=o,h.setRatio=e(t,s,n._tween,r),h},priority:i})};var ve="scaleX,scaleY,scaleZ,x,y,z,skewX,rotation,rotationX,rotationY,perspective".split(","),ye=V("transform"),Te=B+"transform",we=V("transformOrigin"),xe=null!==V("perspective"),be=function(t,e,i,s){if(t._gsTransform&&i&&!s)return t._gsTransform;var r,n,o,h,l,_,u,p,c,f,m,d,g,v=i?t._gsTransform||{skewY:0}:{skewY:0},y=0>v.scaleX,T=2e-5,w=1e5,x=179.99,b=x*M,P=xe?parseFloat(G(t,we,e,!1,"0 0 0").split(" ")[2])||v.zOrigin||0:0;for(ye?r=G(t,Te,e,!0):t.currentStyle&&(r=t.currentStyle.filter.match(C),r=r&&4===r.length?[r[0].substr(4),Number(r[2].substr(4)),Number(r[1].substr(4)),r[3].substr(4),v.x||0,v.y||0].join(","):""),n=(r||"").match(/(?:\-|\b)[\d\-\.e]+\b/gi)||[],o=n.length;--o>-1;)h=Number(n[o]),n[o]=(l=h-(h|=0))?(0|l*w+(0>l?-.5:.5))/w+h:h;if(16===n.length){var S=n[8],k=n[9],R=n[10],A=n[12],O=n[13],D=n[14];if(v.zOrigin&&(D=-v.zOrigin,A=S*D-n[12],O=k*D-n[13],D=R*D+v.zOrigin-n[14]),!i||s||null==v.rotationX){var E,N,F,L,X,z,U,Y=n[0],j=n[1],B=n[2],q=n[3],V=n[4],W=n[5],$=n[6],Z=n[7],Q=n[11],H=Math.atan2($,R),K=-b>H||H>b;v.rotationX=H*I,H&&(L=Math.cos(-H),X=Math.sin(-H),E=V*L+S*X,N=W*L+k*X,F=$*L+R*X,S=V*-X+S*L,k=W*-X+k*L,R=$*-X+R*L,Q=Z*-X+Q*L,V=E,W=N,$=F),H=Math.atan2(S,Y),v.rotationY=H*I,H&&(z=-b>H||H>b,L=Math.cos(-H),X=Math.sin(-H),E=Y*L-S*X,N=j*L-k*X,F=B*L-R*X,k=j*X+k*L,R=B*X+R*L,Q=q*X+Q*L,Y=E,j=N,B=F),H=Math.atan2(j,W),v.rotation=H*I,H&&(U=-b>H||H>b,L=Math.cos(-H),X=Math.sin(-H),Y=Y*L+V*X,N=j*L+W*X,W=j*-X+W*L,$=B*-X+$*L,j=N),U&&K?v.rotation=v.rotationX=0:U&&z?v.rotation=v.rotationY=0:z&&K&&(v.rotationY=v.rotationX=0),v.scaleX=(0|Math.sqrt(Y*Y+j*j)*w+.5)/w,v.scaleY=(0|Math.sqrt(W*W+k*k)*w+.5)/w,v.scaleZ=(0|Math.sqrt($*$+R*R)*w+.5)/w,v.skewX=0,v.perspective=Q?1/(0>Q?-Q:Q):0,v.x=A,v.y=O,v.z=D}}else if(!(xe&&!s&&n.length&&v.x===n[4]&&v.y===n[5]&&(v.rotationX||v.rotationY)||void 0!==v.x&&"none"===G(t,"display",e))){var J=n.length>=6,te=J?n[0]:1,ee=n[1]||0,ie=n[2]||0,se=J?n[3]:1;v.x=n[4]||0,v.y=n[5]||0,_=Math.sqrt(te*te+ee*ee),u=Math.sqrt(se*se+ie*ie),p=te||ee?Math.atan2(ee,te)*I:v.rotation||0,c=ie||se?Math.atan2(ie,se)*I+p:v.skewX||0,f=_-Math.abs(v.scaleX||0),m=u-Math.abs(v.scaleY||0),Math.abs(c)>90&&270>Math.abs(c)&&(y?(_*=-1,c+=0>=p?180:-180,p+=0>=p?180:-180):(u*=-1,c+=0>=c?180:-180)),d=(p-v.rotation)%180,g=(c-v.skewX)%180,(void 0===v.skewX||f>T||-T>f||m>T||-T>m||d>-x&&x>d&&false|d*w||g>-x&&x>g&&false|g*w)&&(v.scaleX=_,v.scaleY=u,v.rotation=p,v.skewX=c),xe&&(v.rotationX=v.rotationY=v.z=0,v.perspective=parseFloat(a.defaultTransformPerspective)||0,v.scaleZ=1)}v.zOrigin=P;for(o in v)T>v[o]&&v[o]>-T&&(v[o]=0);return i&&(t._gsTransform=v),v},Pe=function(t){var e,i,s=this.data,r=-s.rotation*M,n=r+s.skewX*M,a=1e5,o=(0|Math.cos(r)*s.scaleX*a)/a,h=(0|Math.sin(r)*s.scaleX*a)/a,l=(0|Math.sin(n)*-s.scaleY*a)/a,_=(0|Math.cos(n)*s.scaleY*a)/a,u=this.t.style,p=this.t.currentStyle;if(p){i=h,h=-l,l=-i,e=p.filter,u.filter="";var c,m,d=this.t.offsetWidth,g=this.t.offsetHeight,v="absolute"!==p.position,w="progid:DXImageTransform.Microsoft.Matrix(M11="+o+", M12="+h+", M21="+l+", M22="+_,x=s.x,b=s.y;if(null!=s.ox&&(c=(s.oxp?.01*d*s.ox:s.ox)-d/2,m=(s.oyp?.01*g*s.oy:s.oy)-g/2,x+=c-(c*o+m*h),b+=m-(c*l+m*_)),v?(c=d/2,m=g/2,w+=", Dx="+(c-(c*o+m*h)+x)+", Dy="+(m-(c*l+m*_)+b)+")"):w+=", sizingMethod='auto expand')",u.filter=-1!==e.indexOf("DXImageTransform.Microsoft.Matrix(")?e.replace(O,w):w+" "+e,(0===t||1===t)&&1===o&&0===h&&0===l&&1===_&&(v&&-1===w.indexOf("Dx=0, Dy=0")||T.test(e)&&100!==parseFloat(RegExp.$1)||-1===e.indexOf("gradient("&&e.indexOf("Alpha"))&&u.removeAttribute("filter")),!v){var P,S,k,R=8>f?1:-1;for(c=s.ieOffsetX||0,m=s.ieOffsetY||0,s.ieOffsetX=Math.round((d-((0>o?-o:o)*d+(0>h?-h:h)*g))/2+x),s.ieOffsetY=Math.round((g-((0>_?-_:_)*g+(0>l?-l:l)*d))/2+b),fe=0;4>fe;fe++)S=J[fe],P=p[S],i=-1!==P.indexOf("px")?parseFloat(P):$(this.t,S,parseFloat(P),P.replace(y,""))||0,k=i!==s[S]?2>fe?-s.ieOffsetX:-s.ieOffsetY:2>fe?c-s.ieOffsetX:m-s.ieOffsetY,u[S]=(s[S]=Math.round(i-k*(0===fe||2===fe?1:R)))+"px"}}},Se=function(){var t,e,i,s,r,n,a,o,h,l,_,u,c,f,m,d,g,v,y,T,w,x,b,P=this.data,S=this.t.style,k=P.rotation*M,R=P.scaleX,A=P.scaleY,C=P.scaleZ,O=P.perspective;if(p){var D=1e-4;D>R&&R>-D&&(R=C=2e-5),D>A&&A>-D&&(A=C=2e-5),!O||P.z||P.rotationX||P.rotationY||(O=0)}if(k||P.skewX)v=Math.cos(k),y=Math.sin(k),t=v,r=y,P.skewX&&(k-=P.skewX*M,v=Math.cos(k),y=Math.sin(k)),e=-y,n=v;else{if(!(P.rotationY||P.rotationX||1!==C||O))return S[ye]="translate3d("+P.x+"px,"+P.y+"px,"+P.z+"px)"+(1!==R||1!==A?" scale("+R+","+A+")":""),void 0;t=n=1,e=r=0}_=1,i=s=a=o=h=l=u=c=f=0,m=O?-1/O:0,d=P.zOrigin,g=1e5,k=P.rotationY*M,k&&(v=Math.cos(k),y=Math.sin(k),h=_*-y,c=m*-y,i=t*y,a=r*y,_*=v,m*=v,t*=v,r*=v),k=P.rotationX*M,k&&(v=Math.cos(k),y=Math.sin(k),T=e*v+i*y,w=n*v+a*y,x=l*v+_*y,b=f*v+m*y,i=e*-y+i*v,a=n*-y+a*v,_=l*-y+_*v,m=f*-y+m*v,e=T,n=w,l=x,f=b),1!==C&&(i*=C,a*=C,_*=C,m*=C),1!==A&&(e*=A,n*=A,l*=A,f*=A),1!==R&&(t*=R,r*=R,h*=R,c*=R),d&&(u-=d,s=i*u,o=a*u,u=_*u+d),s=(T=(s+=P.x)-(s|=0))?(0|T*g+(0>T?-.5:.5))/g+s:s,o=(T=(o+=P.y)-(o|=0))?(0|T*g+(0>T?-.5:.5))/g+o:o,u=(T=(u+=P.z)-(u|=0))?(0|T*g+(0>T?-.5:.5))/g+u:u,S[ye]="matrix3d("+[(0|t*g)/g,(0|r*g)/g,(0|h*g)/g,(0|c*g)/g,(0|e*g)/g,(0|n*g)/g,(0|l*g)/g,(0|f*g)/g,(0|i*g)/g,(0|a*g)/g,(0|_*g)/g,(0|m*g)/g,s,o,u,O?1+-u/O:1].join(",")+")"},ke=function(t){var e,i,s,r,n,a=this.data,o=this.t,h=o.style;return a.rotationX||a.rotationY||a.z||a.force3D?(this.setRatio=Se,Se.call(this,t),void 0):(a.rotation||a.skewX?(e=a.rotation*M,i=e-a.skewX*M,s=1e5,r=a.scaleX*s,n=a.scaleY*s,h[ye]="matrix("+(0|Math.cos(e)*r)/s+","+(0|Math.sin(e)*r)/s+","+(0|Math.sin(i)*-n)/s+","+(0|Math.cos(i)*n)/s+","+a.x+","+a.y+")"):h[ye]="matrix("+a.scaleX+",0,0,"+a.scaleY+","+a.x+","+a.y+")",void 0)};de("transform,scale,scaleX,scaleY,scaleZ,x,y,z,rotation,rotationX,rotationY,rotationZ,skewX,skewY,shortRotation,shortRotationX,shortRotationY,shortRotationZ,transformOrigin,transformPerspective,directionalRotation,parseTransform,force3D",{parser:function(t,e,i,s,n,a,o){if(s._transform)return n;var h,l,_,u,p,c,f,m=s._transform=be(t,r,!0,o.parseTransform),d=t.style,g=1e-6,v=ve.length,y=o,T={};if("string"==typeof y.transform&&ye)_=d.cssText,d[ye]=y.transform,d.display="block",h=be(t,null,!1),d.cssText=_;else if("object"==typeof y){if(h={scaleX:se(null!=y.scaleX?y.scaleX:y.scale,m.scaleX),scaleY:se(null!=y.scaleY?y.scaleY:y.scale,m.scaleY),scaleZ:se(y.scaleZ,m.scaleZ),x:se(y.x,m.x),y:se(y.y,m.y),z:se(y.z,m.z),perspective:se(y.transformPerspective,m.perspective)},f=y.directionalRotation,null!=f)if("object"==typeof f)for(_ in f)y[_]=f[_];else y.rotation=f;h.rotation=re("rotation"in y?y.rotation:"shortRotation"in y?y.shortRotation+"_short":"rotationZ"in y?y.rotationZ:m.rotation,m.rotation,"rotation",T),xe&&(h.rotationX=re("rotationX"in y?y.rotationX:"shortRotationX"in y?y.shortRotationX+"_short":m.rotationX||0,m.rotationX,"rotationX",T),h.rotationY=re("rotationY"in y?y.rotationY:"shortRotationY"in y?y.shortRotationY+"_short":m.rotationY||0,m.rotationY,"rotationY",T)),h.skewX=null==y.skewX?m.skewX:re(y.skewX,m.skewX),h.skewY=null==y.skewY?m.skewY:re(y.skewY,m.skewY),(l=h.skewY-m.skewY)&&(h.skewX+=l,h.rotation+=l)}for(xe&&null!=y.force3D&&(m.force3D=y.force3D,c=!0),p=m.force3D||m.z||m.rotationX||m.rotationY||h.z||h.rotationX||h.rotationY||h.perspective,p||null==y.scale||(h.scaleZ=1);--v>-1;)i=ve[v],u=h[i]-m[i],(u>g||-g>u||null!=E[i])&&(c=!0,n=new pe(m,i,m[i],u,n),i in T&&(n.e=T[i]),n.xs0=0,n.plugin=a,s._overwriteProps.push(n.n));return u=y.transformOrigin,(u||xe&&p&&m.zOrigin)&&(ye?(c=!0,i=we,u=(u||G(t,i,r,!1,"50% 50%"))+"",n=new pe(d,i,0,0,n,-1,"transformOrigin"),n.b=d[i],n.plugin=a,xe?(_=m.zOrigin,u=u.split(" "),m.zOrigin=(u.length>2&&(0===_||"0px"!==u[2])?parseFloat(u[2]):_)||0,n.xs0=n.e=d[i]=u[0]+" "+(u[1]||"50%")+" 0px",n=new pe(m,"zOrigin",0,0,n,-1,n.n),n.b=_,n.xs0=n.e=m.zOrigin):n.xs0=n.e=d[i]=u):ee(u+"",m)),c&&(s._transformType=p||3===this._transformType?3:2),n},prefix:!0}),de("boxShadow",{defaultValue:"0px 0px 0px 0px #999",prefix:!0,color:!0,multi:!0,keyword:"inset"}),de("borderRadius",{defaultValue:"0px",parser:function(t,e,i,n,a){e=this.format(e);var o,h,l,_,u,p,c,f,m,d,g,v,y,T,w,x,b=["borderTopLeftRadius","borderTopRightRadius","borderBottomRightRadius","borderBottomLeftRadius"],P=t.style;for(m=parseFloat(t.offsetWidth),d=parseFloat(t.offsetHeight),o=e.split(" "),h=0;b.length>h;h++)this.p.indexOf("border")&&(b[h]=V(b[h])),u=_=G(t,b[h],r,!1,"0px"),-1!==u.indexOf(" ")&&(_=u.split(" "),u=_[0],_=_[1]),p=l=o[h],c=parseFloat(u),v=u.substr((c+"").length),y="="===p.charAt(1),y?(f=parseInt(p.charAt(0)+"1",10),p=p.substr(2),f*=parseFloat(p),g=p.substr((f+"").length-(0>f?1:0))||""):(f=parseFloat(p),g=p.substr((f+"").length)),""===g&&(g=s[i]||v),g!==v&&(T=$(t,"borderLeft",c,v),w=$(t,"borderTop",c,v),"%"===g?(u=100*(T/m)+"%",_=100*(w/d)+"%"):"em"===g?(x=$(t,"borderLeft",1,"em"),u=T/x+"em",_=w/x+"em"):(u=T+"px",_=w+"px"),y&&(p=parseFloat(u)+f+g,l=parseFloat(_)+f+g)),a=ce(P,b[h],u+" "+_,p+" "+l,!1,"0px",a);return a},prefix:!0,formatter:le("0px 0px 0px 0px",!1,!0)}),de("backgroundPosition",{defaultValue:"0 0",parser:function(t,e,i,s,n,a){var o,h,l,_,u,p,c="background-position",m=r||W(t,null),d=this.format((m?f?m.getPropertyValue(c+"-x")+" "+m.getPropertyValue(c+"-y"):m.getPropertyValue(c):t.currentStyle.backgroundPositionX+" "+t.currentStyle.backgroundPositionY)||"0 0"),g=this.format(e);if(-1!==d.indexOf("%")!=(-1!==g.indexOf("%"))&&(p=G(t,"backgroundImage").replace(k,""),p&&"none"!==p)){for(o=d.split(" "),h=g.split(" "),L.setAttribute("src",p),l=2;--l>-1;)d=o[l],_=-1!==d.indexOf("%"),_!==(-1!==h[l].indexOf("%"))&&(u=0===l?t.offsetWidth-L.width:t.offsetHeight-L.height,o[l]=_?parseFloat(d)/100*u+"px":100*(parseFloat(d)/u)+"%");d=o.join(" ")}return this.parseComplex(t.style,d,g,n,a)},formatter:ee}),de("backgroundSize",{defaultValue:"0 0",formatter:ee}),de("perspective",{defaultValue:"0px",prefix:!0}),de("perspectiveOrigin",{defaultValue:"50% 50%",prefix:!0}),de("transformStyle",{prefix:!0}),de("backfaceVisibility",{prefix:!0}),de("userSelect",{prefix:!0}),de("margin",{parser:_e("marginTop,marginRight,marginBottom,marginLeft")}),de("padding",{parser:_e("paddingTop,paddingRight,paddingBottom,paddingLeft")}),de("clip",{defaultValue:"rect(0px,0px,0px,0px)",parser:function(t,e,i,s,n,a){var o,h,l;return 9>f?(h=t.currentStyle,l=8>f?" ":",",o="rect("+h.clipTop+l+h.clipRight+l+h.clipBottom+l+h.clipLeft+")",e=this.format(e).split(",").join(l)):(o=this.format(G(t,this.p,r,!1,this.dflt)),e=this.format(e)),this.parseComplex(t.style,o,e,n,a)}}),de("textShadow",{defaultValue:"0px 0px 0px #999",color:!0,multi:!0}),de("autoRound,strictUnits",{parser:function(t,e,i,s,r){return r}}),de("border",{defaultValue:"0px solid #000",parser:function(t,e,i,s,n,a){return this.parseComplex(t.style,this.format(G(t,"borderTopWidth",r,!1,"0px")+" "+G(t,"borderTopStyle",r,!1,"solid")+" "+G(t,"borderTopColor",r,!1,"#000")),this.format(e),n,a)},color:!0,formatter:function(t){var e=t.split(" ");return e[0]+" "+(e[1]||"solid")+" "+(t.match(he)||["#000"])[0]}}),de("borderWidth",{parser:_e("borderTopWidth,borderRightWidth,borderBottomWidth,borderLeftWidth")}),de("float,cssFloat,styleFloat",{parser:function(t,e,i,s,r){var n=t.style,a="cssFloat"in n?"cssFloat":"styleFloat";return new pe(n,a,0,0,r,-1,i,!1,0,n[a],e)}});var Re=function(t){var e,i=this.t,s=i.filter||G(this.data,"filter"),r=0|this.s+this.c*t;100===r&&(-1===s.indexOf("atrix(")&&-1===s.indexOf("radient(")&&-1===s.indexOf("oader(")?(i.removeAttribute("filter"),e=!G(this.data,"filter")):(i.filter=s.replace(x,""),e=!0)),e||(this.xn1&&(i.filter=s=s||"alpha(opacity="+r+")"),-1===s.indexOf("opacity")?0===r&&this.xn1||(i.filter=s+" alpha(opacity="+r+")"):i.filter=s.replace(T,"opacity="+r))};de("opacity,alpha,autoAlpha",{defaultValue:"1",parser:function(t,e,i,s,n,a){var o=parseFloat(G(t,"opacity",r,!1,"1")),h=t.style,l="autoAlpha"===i;return"string"==typeof e&&"="===e.charAt(1)&&(e=("-"===e.charAt(0)?-1:1)*parseFloat(e.substr(2))+o),l&&1===o&&"hidden"===G(t,"visibility",r)&&0!==e&&(o=0),U?n=new pe(h,"opacity",o,e-o,n):(n=new pe(h,"opacity",100*o,100*(e-o),n),n.xn1=l?1:0,h.zoom=1,n.type=2,n.b="alpha(opacity="+n.s+")",n.e="alpha(opacity="+(n.s+n.c)+")",n.data=t,n.plugin=a,n.setRatio=Re),l&&(n=new pe(h,"visibility",0,0,n,-1,null,!1,0,0!==o?"inherit":"hidden",0===e?"hidden":"inherit"),n.xs0="inherit",s._overwriteProps.push(n.n),s._overwriteProps.push(i)),n}});var Ae=function(t,e){e&&(t.removeProperty?t.removeProperty(e.replace(P,"-$1").toLowerCase()):t.removeAttribute(e))},Ce=function(t){if(this.t._gsClassPT=this,1===t||0===t){this.t.className=0===t?this.b:this.e;for(var e=this.data,i=this.t.style;e;)e.v?i[e.p]=e.v:Ae(i,e.p),e=e._next;1===t&&this.t._gsClassPT===this&&(this.t._gsClassPT=null)}else this.t.className!==this.e&&(this.t.className=this.e)};de("className",{parser:function(t,e,s,n,a,o,h){var l,_,u,p,c,f=t.className,m=t.style.cssText;if(a=n._classNamePT=new pe(t,s,0,0,a,2),a.setRatio=Ce,a.pr=-11,i=!0,a.b=f,_=Q(t,r),u=t._gsClassPT){for(p={},c=u.data;c;)p[c.p]=1,c=c._next;u.setRatio(1)}return t._gsClassPT=a,a.e="="!==e.charAt(1)?e:f.replace(RegExp("\\s*\\b"+e.substr(2)+"\\b"),"")+("+"===e.charAt(0)?" "+e.substr(2):""),n._tween._duration&&(t.className=a.e,l=H(t,_,Q(t),h,p),t.className=f,a.data=l.firstMPT,t.style.cssText=m,a=a.xfirst=n.parse(t,l.difs,a,o)),a}});var Oe=function(t){if((1===t||0===t)&&this.data._totalTime===this.data._totalDuration&&"isFromStart"!==this.data.data){var e,i,s,r,n=this.t.style,a=o.transform.parse;if("all"===this.e)n.cssText="",r=!0;else for(e=this.e.split(","),s=e.length;--s>-1;)i=e[s],o[i]&&(o[i].parse===a?r=!0:i="transformOrigin"===i?we:o[i].p),Ae(n,i);r&&(Ae(n,ye),this.t._gsTransform&&delete this.t._gsTransform)}};for(de("clearProps",{parser:function(t,e,s,r,n){return n=new pe(t,s,0,0,n,2),n.setRatio=Oe,n.e=e,n.pr=-10,n.data=r._tween,i=!0,n}}),h="bezier,throwProps,physicsProps,physics2D".split(","),fe=h.length;fe--;)ge(h[fe]);h=a.prototype,h._firstPT=null,h._onInitTween=function(t,e,o){if(!t.nodeType)return!1;this._target=t,this._tween=o,this._vars=e,l=e.autoRound,i=!1,s=e.suffixMap||a.suffixMap,r=W(t,""),n=this._overwriteProps;var h,p,f,m,d,g,v,y,T,x=t.style;if(_&&""===x.zIndex&&(h=G(t,"zIndex",r),("auto"===h||""===h)&&(x.zIndex=0)),"string"==typeof e&&(m=x.cssText,h=Q(t,r),x.cssText=m+";"+e,h=H(t,h,Q(t)).difs,!U&&w.test(e)&&(h.opacity=parseFloat(RegExp.$1)),e=h,x.cssText=m),this._firstPT=p=this.parse(t,e,null),this._transformType){for(T=3===this._transformType,ye?u&&(_=!0,""===x.zIndex&&(v=G(t,"zIndex",r),("auto"===v||""===v)&&(x.zIndex=0)),c&&(x.WebkitBackfaceVisibility=this._vars.WebkitBackfaceVisibility||(T?"visible":"hidden"))):x.zoom=1,f=p;f&&f._next;)f=f._next;y=new pe(t,"transform",0,0,null,2),this._linkCSSP(y,null,f),y.setRatio=T&&xe?Se:ye?ke:Pe,y.data=this._transform||be(t,r,!0),n.pop()}if(i){for(;p;){for(g=p._next,f=m;f&&f.pr>p.pr;)f=f._next;(p._prev=f?f._prev:d)?p._prev._next=p:m=p,(p._next=f)?f._prev=p:d=p,p=g}this._firstPT=m}return!0},h.parse=function(t,e,i,n){var a,h,_,u,p,c,f,m,d,g,v=t.style;for(a in e)c=e[a],h=o[a],h?i=h.parse(t,c,a,this,i,n,e):(p=G(t,a,r)+"",d="string"==typeof c,"color"===a||"fill"===a||"stroke"===a||-1!==a.indexOf("Color")||d&&b.test(c)?(d||(c=oe(c),c=(c.length>3?"rgba(":"rgb(")+c.join(",")+")"),i=ce(v,a,p,c,!0,"transparent",i,0,n)):!d||-1===c.indexOf(" ")&&-1===c.indexOf(",")?(_=parseFloat(p),f=_||0===_?p.substr((_+"").length):"",(""===p||"auto"===p)&&("width"===a||"height"===a?(_=te(t,a,r),f="px"):"left"===a||"top"===a?(_=Z(t,a,r),f="px"):(_="opacity"!==a?0:1,f="")),g=d&&"="===c.charAt(1),g?(u=parseInt(c.charAt(0)+"1",10),c=c.substr(2),u*=parseFloat(c),m=c.replace(y,"")):(u=parseFloat(c),m=d?c.substr((u+"").length)||"":""),""===m&&(m=a in s?s[a]:f),c=u||0===u?(g?u+_:u)+m:e[a],f!==m&&""!==m&&(u||0===u)&&(_||0===_)&&(_=$(t,a,_,f),"%"===m?(_/=$(t,a,100,"%")/100,e.strictUnits!==!0&&(p=_+"%")):"em"===m?_/=$(t,a,1,"em"):(u=$(t,a,u,m),m="px"),g&&(u||0===u)&&(c=u+_+m)),g&&(u+=_),!_&&0!==_||!u&&0!==u?void 0!==v[a]&&(c||"NaN"!=c+""&&null!=c)?(i=new pe(v,a,u||_||0,0,i,-1,a,!1,0,p,c),i.xs0="none"!==c||"display"!==a&&-1===a.indexOf("Style")?c:p):j("invalid "+a+" tween value: "+e[a]):(i=new pe(v,a,_,u-_,i,0,a,l!==!1&&("px"===m||"zIndex"===a),0,p,c),i.xs0=m)):i=ce(v,a,p,c,!0,null,i,0,n)),n&&i&&!i.plugin&&(i.plugin=n);return i},h.setRatio=function(t){var e,i,s,r=this._firstPT,n=1e-6;if(1!==t||this._tween._time!==this._tween._duration&&0!==this._tween._time)if(t||this._tween._time!==this._tween._duration&&0!==this._tween._time||this._tween._rawPrevTime===-1e-6)for(;r;){if(e=r.c*t+r.s,r.r?e=e>0?0|e+.5:0|e-.5:n>e&&e>-n&&(e=0),r.type)if(1===r.type)if(s=r.l,2===s)r.t[r.p]=r.xs0+e+r.xs1+r.xn1+r.xs2;else if(3===s)r.t[r.p]=r.xs0+e+r.xs1+r.xn1+r.xs2+r.xn2+r.xs3;else if(4===s)r.t[r.p]=r.xs0+e+r.xs1+r.xn1+r.xs2+r.xn2+r.xs3+r.xn3+r.xs4;else if(5===s)r.t[r.p]=r.xs0+e+r.xs1+r.xn1+r.xs2+r.xn2+r.xs3+r.xn3+r.xs4+r.xn4+r.xs5;else{for(i=r.xs0+e+r.xs1,s=1;r.l>s;s++)i+=r["xn"+s]+r["xs"+(s+1)];r.t[r.p]=i}else-1===r.type?r.t[r.p]=r.xs0:r.setRatio&&r.setRatio(t);else r.t[r.p]=e+r.xs0;r=r._next}else for(;r;)2!==r.type?r.t[r.p]=r.b:r.setRatio(t),r=r._next;else for(;r;)2!==r.type?r.t[r.p]=r.e:r.setRatio(t),r=r._next},h._enableTransforms=function(t){this._transformType=t||3===this._transformType?3:2,this._transform=this._transform||be(this._target,r,!0)},h._linkCSSP=function(t,e,i,s){return t&&(e&&(e._prev=t),t._next&&(t._next._prev=t._prev),t._prev?t._prev._next=t._next:this._firstPT===t&&(this._firstPT=t._next,s=!0),i?i._next=t:s||null!==this._firstPT||(this._firstPT=t),t._next=e,t._prev=i),t},h._kill=function(e){var i,s,r,n=e;if(e.autoAlpha||e.alpha){n={};for(s in e)n[s]=e[s];n.opacity=1,n.autoAlpha&&(n.visibility=1)}return e.className&&(i=this._classNamePT)&&(r=i.xfirst,r&&r._prev?this._linkCSSP(r._prev,i._next,r._prev._prev):r===this._firstPT&&(this._firstPT=i._next),i._next&&this._linkCSSP(i._next,i._next._next,r._prev),this._classNamePT=null),t.prototype._kill.call(this,n)};var De=function(t,e,i){var s,r,n,a;if(t.slice)for(r=t.length;--r>-1;)De(t[r],e,i);else for(s=t.childNodes,r=s.length;--r>-1;)n=s[r],a=n.type,n.style&&(e.push(Q(n)),i&&i.push(n)),1!==a&&9!==a&&11!==a||!n.childNodes.length||De(n,e,i)};return a.cascadeTo=function(t,i,s){var r,n,a,o=e.to(t,i,s),h=[o],l=[],_=[],u=[],p=e._internals.reservedProps;for(t=o._targets||o.target,De(t,l,u),o.render(i,!0),De(t,_),o.render(0,!0),o._enabled(!0),r=u.length;--r>-1;)if(n=H(u[r],l[r],_[r]),n.firstMPT){n=n.difs;for(a in s)p[a]&&(n[a]=s[a]);h.push(e.to(u[r],i,n))}return h},t.activate([a]),a},!0),function(){var t=window._gsDefine.plugin({propName:"roundProps",priority:-1,API:2,init:function(t,e,i){return this._tween=i,!0}}),e=t.prototype;e._onInitAllProps=function(){for(var t,e,i,s=this._tween,r=s.vars.roundProps instanceof Array?s.vars.roundProps:s.vars.roundProps.split(","),n=r.length,a={},o=s._propLookup.roundProps;--n>-1;)a[r[n]]=1;for(n=r.length;--n>-1;)for(t=r[n],e=s._firstPT;e;)i=e._next,e.pg?e.t._roundProps(a,!0):e.n===t&&(this._add(e.t,t,e.s,e.c),i&&(i._prev=e._prev),e._prev?e._prev._next=i:s._firstPT===e&&(s._firstPT=i),e._next=e._prev=null,s._propLookup[t]=o),e=i;return!1},e._add=function(t,e,i,s){this._addTween(t,e,i,i+s,e,!0),this._overwriteProps.push(e)
}}(),window._gsDefine.plugin({propName:"attr",API:2,version:"0.2.0",init:function(t,e){var i;if("function"!=typeof t.setAttribute)return!1;this._target=t,this._proxy={};for(i in e)this._addTween(this._proxy,i,parseFloat(t.getAttribute(i)),e[i],i)&&this._overwriteProps.push(i);return!0},set:function(t){this._super.setRatio.call(this,t);for(var e,i=this._overwriteProps,s=i.length;--s>-1;)e=i[s],this._target.setAttribute(e,this._proxy[e]+"")}}),window._gsDefine.plugin({propName:"directionalRotation",API:2,version:"0.2.0",init:function(t,e){"object"!=typeof e&&(e={rotation:e}),this.finals={};var i,s,r,n,a,o,h=e.useRadians===!0?2*Math.PI:360,l=1e-6;for(i in e)"useRadians"!==i&&(o=(e[i]+"").split("_"),s=o[0],r=parseFloat("function"!=typeof t[i]?t[i]:t[i.indexOf("set")||"function"!=typeof t["get"+i.substr(3)]?i:"get"+i.substr(3)]()),n=this.finals[i]="string"==typeof s&&"="===s.charAt(1)?r+parseInt(s.charAt(0)+"1",10)*Number(s.substr(2)):Number(s)||0,a=n-r,o.length&&(s=o.join("_"),-1!==s.indexOf("short")&&(a%=h,a!==a%(h/2)&&(a=0>a?a+h:a-h)),-1!==s.indexOf("_cw")&&0>a?a=(a+9999999999*h)%h-(0|a/h)*h:-1!==s.indexOf("ccw")&&a>0&&(a=(a-9999999999*h)%h-(0|a/h)*h)),(a>l||-l>a)&&(this._addTween(t,i,r,r+a,i),this._overwriteProps.push(i)));return!0},set:function(t){var e;if(1!==t)this._super.setRatio.call(this,t);else for(e=this._firstPT;e;)e.f?e.t[e.p](this.finals[e.p]):e.t[e.p]=this.finals[e.p],e=e._next}})._autoCSS=!0,window._gsDefine("easing.Back",["easing.Ease"],function(t){var e,i,s,r=window.GreenSockGlobals||window,n=r.com.greensock,a=2*Math.PI,o=Math.PI/2,h=n._class,l=function(e,i){var s=h("easing."+e,function(){},!0),r=s.prototype=new t;return r.constructor=s,r.getRatio=i,s},_=t.register||function(){},u=function(t,e,i,s){var r=h("easing."+t,{easeOut:new e,easeIn:new i,easeInOut:new s},!0);return _(r,t),r},p=function(t,e,i){this.t=t,this.v=e,i&&(this.next=i,i.prev=this,this.c=i.v-e,this.gap=i.t-t)},c=function(e,i){var s=h("easing."+e,function(t){this._p1=t||0===t?t:1.70158,this._p2=1.525*this._p1},!0),r=s.prototype=new t;return r.constructor=s,r.getRatio=i,r.config=function(t){return new s(t)},s},f=u("Back",c("BackOut",function(t){return(t-=1)*t*((this._p1+1)*t+this._p1)+1}),c("BackIn",function(t){return t*t*((this._p1+1)*t-this._p1)}),c("BackInOut",function(t){return 1>(t*=2)?.5*t*t*((this._p2+1)*t-this._p2):.5*((t-=2)*t*((this._p2+1)*t+this._p2)+2)})),m=h("easing.SlowMo",function(t,e,i){e=e||0===e?e:.7,null==t?t=.7:t>1&&(t=1),this._p=1!==t?e:0,this._p1=(1-t)/2,this._p2=t,this._p3=this._p1+this._p2,this._calcEnd=i===!0},!0),d=m.prototype=new t;return d.constructor=m,d.getRatio=function(t){var e=t+(.5-t)*this._p;return this._p1>t?this._calcEnd?1-(t=1-t/this._p1)*t:e-(t=1-t/this._p1)*t*t*t*e:t>this._p3?this._calcEnd?1-(t=(t-this._p3)/this._p1)*t:e+(t-e)*(t=(t-this._p3)/this._p1)*t*t*t:this._calcEnd?1:e},m.ease=new m(.7,.7),d.config=m.config=function(t,e,i){return new m(t,e,i)},e=h("easing.SteppedEase",function(t){t=t||1,this._p1=1/t,this._p2=t+1},!0),d=e.prototype=new t,d.constructor=e,d.getRatio=function(t){return 0>t?t=0:t>=1&&(t=.999999999),(this._p2*t>>0)*this._p1},d.config=e.config=function(t){return new e(t)},i=h("easing.RoughEase",function(e){e=e||{};for(var i,s,r,n,a,o,h=e.taper||"none",l=[],_=0,u=0|(e.points||20),c=u,f=e.randomize!==!1,m=e.clamp===!0,d=e.template instanceof t?e.template:null,g="number"==typeof e.strength?.4*e.strength:.4;--c>-1;)i=f?Math.random():1/u*c,s=d?d.getRatio(i):i,"none"===h?r=g:"out"===h?(n=1-i,r=n*n*g):"in"===h?r=i*i*g:.5>i?(n=2*i,r=.5*n*n*g):(n=2*(1-i),r=.5*n*n*g),f?s+=Math.random()*r-.5*r:c%2?s+=.5*r:s-=.5*r,m&&(s>1?s=1:0>s&&(s=0)),l[_++]={x:i,y:s};for(l.sort(function(t,e){return t.x-e.x}),o=new p(1,1,null),c=u;--c>-1;)a=l[c],o=new p(a.x,a.y,o);this._prev=new p(0,0,0!==o.t?o:o.next)},!0),d=i.prototype=new t,d.constructor=i,d.getRatio=function(t){var e=this._prev;if(t>e.t){for(;e.next&&t>=e.t;)e=e.next;e=e.prev}else for(;e.prev&&e.t>=t;)e=e.prev;return this._prev=e,e.v+(t-e.t)/e.gap*e.c},d.config=function(t){return new i(t)},i.ease=new i,u("Bounce",l("BounceOut",function(t){return 1/2.75>t?7.5625*t*t:2/2.75>t?7.5625*(t-=1.5/2.75)*t+.75:2.5/2.75>t?7.5625*(t-=2.25/2.75)*t+.9375:7.5625*(t-=2.625/2.75)*t+.984375}),l("BounceIn",function(t){return 1/2.75>(t=1-t)?1-7.5625*t*t:2/2.75>t?1-(7.5625*(t-=1.5/2.75)*t+.75):2.5/2.75>t?1-(7.5625*(t-=2.25/2.75)*t+.9375):1-(7.5625*(t-=2.625/2.75)*t+.984375)}),l("BounceInOut",function(t){var e=.5>t;return t=e?1-2*t:2*t-1,t=1/2.75>t?7.5625*t*t:2/2.75>t?7.5625*(t-=1.5/2.75)*t+.75:2.5/2.75>t?7.5625*(t-=2.25/2.75)*t+.9375:7.5625*(t-=2.625/2.75)*t+.984375,e?.5*(1-t):.5*t+.5})),u("Circ",l("CircOut",function(t){return Math.sqrt(1-(t-=1)*t)}),l("CircIn",function(t){return-(Math.sqrt(1-t*t)-1)}),l("CircInOut",function(t){return 1>(t*=2)?-.5*(Math.sqrt(1-t*t)-1):.5*(Math.sqrt(1-(t-=2)*t)+1)})),s=function(e,i,s){var r=h("easing."+e,function(t,e){this._p1=t||1,this._p2=e||s,this._p3=this._p2/a*(Math.asin(1/this._p1)||0)},!0),n=r.prototype=new t;return n.constructor=r,n.getRatio=i,n.config=function(t,e){return new r(t,e)},r},u("Elastic",s("ElasticOut",function(t){return this._p1*Math.pow(2,-10*t)*Math.sin((t-this._p3)*a/this._p2)+1},.3),s("ElasticIn",function(t){return-(this._p1*Math.pow(2,10*(t-=1))*Math.sin((t-this._p3)*a/this._p2))},.3),s("ElasticInOut",function(t){return 1>(t*=2)?-.5*this._p1*Math.pow(2,10*(t-=1))*Math.sin((t-this._p3)*a/this._p2):.5*this._p1*Math.pow(2,-10*(t-=1))*Math.sin((t-this._p3)*a/this._p2)+1},.45)),u("Expo",l("ExpoOut",function(t){return 1-Math.pow(2,-10*t)}),l("ExpoIn",function(t){return Math.pow(2,10*(t-1))-.001}),l("ExpoInOut",function(t){return 1>(t*=2)?.5*Math.pow(2,10*(t-1)):.5*(2-Math.pow(2,-10*(t-1)))})),u("Sine",l("SineOut",function(t){return Math.sin(t*o)}),l("SineIn",function(t){return-Math.cos(t*o)+1}),l("SineInOut",function(t){return-.5*(Math.cos(Math.PI*t)-1)})),h("easing.EaseLookup",{find:function(e){return t.map[e]}},!0),_(r.SlowMo,"SlowMo","ease,"),_(i,"RoughEase","ease,"),_(e,"SteppedEase","ease,"),f},!0)}),function(t){"use strict";var e=t.GreenSockGlobals||t;if(!e.TweenLite){var i,s,r,n,a,o=function(t){var i,s=t.split("."),r=e;for(i=0;s.length>i;i++)r[s[i]]=r=r[s[i]]||{};return r},h=o("com.greensock"),l=1e-10,_=[].slice,u=function(){},p=function(){var t=Object.prototype.toString,e=t.call([]);return function(i){return null!=i&&(i instanceof Array||"object"==typeof i&&!!i.push&&t.call(i)===e)}}(),c={},f=function(i,s,r,n){this.sc=c[i]?c[i].sc:[],c[i]=this,this.gsClass=null,this.func=r;var a=[];this.check=function(h){for(var l,_,u,p,m=s.length,d=m;--m>-1;)(l=c[s[m]]||new f(s[m],[])).gsClass?(a[m]=l.gsClass,d--):h&&l.sc.push(this);if(0===d&&r)for(_=("com.greensock."+i).split("."),u=_.pop(),p=o(_.join("."))[u]=this.gsClass=r.apply(r,a),n&&(e[u]=p,"function"==typeof define&&define.amd?define((t.GreenSockAMDPath?t.GreenSockAMDPath+"/":"")+i.split(".").join("/"),[],function(){return p}):"undefined"!=typeof module&&module.exports&&(module.exports=p)),m=0;this.sc.length>m;m++)this.sc[m].check()},this.check(!0)},m=t._gsDefine=function(t,e,i,s){return new f(t,e,i,s)},d=h._class=function(t,e,i){return e=e||function(){},m(t,[],function(){return e},i),e};m.globals=e;var g=[0,0,1,1],v=[],y=d("easing.Ease",function(t,e,i,s){this._func=t,this._type=i||0,this._power=s||0,this._params=e?g.concat(e):g},!0),T=y.map={},w=y.register=function(t,e,i,s){for(var r,n,a,o,l=e.split(","),_=l.length,u=(i||"easeIn,easeOut,easeInOut").split(",");--_>-1;)for(n=l[_],r=s?d("easing."+n,null,!0):h.easing[n]||{},a=u.length;--a>-1;)o=u[a],T[n+"."+o]=T[o+n]=r[o]=t.getRatio?t:t[o]||new t};for(r=y.prototype,r._calcEnd=!1,r.getRatio=function(t){if(this._func)return this._params[0]=t,this._func.apply(null,this._params);var e=this._type,i=this._power,s=1===e?1-t:2===e?t:.5>t?2*t:2*(1-t);return 1===i?s*=s:2===i?s*=s*s:3===i?s*=s*s*s:4===i&&(s*=s*s*s*s),1===e?1-s:2===e?s:.5>t?s/2:1-s/2},i=["Linear","Quad","Cubic","Quart","Quint,Strong"],s=i.length;--s>-1;)r=i[s]+",Power"+s,w(new y(null,null,1,s),r,"easeOut",!0),w(new y(null,null,2,s),r,"easeIn"+(0===s?",easeNone":"")),w(new y(null,null,3,s),r,"easeInOut");T.linear=h.easing.Linear.easeIn,T.swing=h.easing.Quad.easeInOut;var x=d("events.EventDispatcher",function(t){this._listeners={},this._eventTarget=t||this});r=x.prototype,r.addEventListener=function(t,e,i,s,r){r=r||0;var o,h,l=this._listeners[t],_=0;for(null==l&&(this._listeners[t]=l=[]),h=l.length;--h>-1;)o=l[h],o.c===e&&o.s===i?l.splice(h,1):0===_&&r>o.pr&&(_=h+1);l.splice(_,0,{c:e,s:i,up:s,pr:r}),this!==n||a||n.wake()},r.removeEventListener=function(t,e){var i,s=this._listeners[t];if(s)for(i=s.length;--i>-1;)if(s[i].c===e)return s.splice(i,1),void 0},r.dispatchEvent=function(t){var e,i,s,r=this._listeners[t];if(r)for(e=r.length,i=this._eventTarget;--e>-1;)s=r[e],s.up?s.c.call(s.s||i,{type:t,target:i}):s.c.call(s.s||i)};var b=t.requestAnimationFrame,P=t.cancelAnimationFrame,S=Date.now||function(){return(new Date).getTime()},k=S();for(i=["ms","moz","webkit","o"],s=i.length;--s>-1&&!b;)b=t[i[s]+"RequestAnimationFrame"],P=t[i[s]+"CancelAnimationFrame"]||t[i[s]+"CancelRequestAnimationFrame"];d("Ticker",function(t,e){var i,s,r,o,h,l=this,_=S(),p=e!==!1&&b,c=function(t){k=S(),l.time=(k-_)/1e3;var e,n=l.time-h;(!i||n>0||t===!0)&&(l.frame++,h+=n+(n>=o?.004:o-n),e=!0),t!==!0&&(r=s(c)),e&&l.dispatchEvent("tick")};x.call(l),l.time=l.frame=0,l.tick=function(){c(!0)},l.sleep=function(){null!=r&&(p&&P?P(r):clearTimeout(r),s=u,r=null,l===n&&(a=!1))},l.wake=function(){null!==r&&l.sleep(),s=0===i?u:p&&b?b:function(t){return setTimeout(t,0|1e3*(h-l.time)+1)},l===n&&(a=!0),c(2)},l.fps=function(t){return arguments.length?(i=t,o=1/(i||60),h=this.time+o,l.wake(),void 0):i},l.useRAF=function(t){return arguments.length?(l.sleep(),p=t,l.fps(i),void 0):p},l.fps(t),setTimeout(function(){p&&(!r||5>l.frame)&&l.useRAF(!1)},1500)}),r=h.Ticker.prototype=new h.events.EventDispatcher,r.constructor=h.Ticker;var R=d("core.Animation",function(t,e){if(this.vars=e=e||{},this._duration=this._totalDuration=t||0,this._delay=Number(e.delay)||0,this._timeScale=1,this._active=e.immediateRender===!0,this.data=e.data,this._reversed=e.reversed===!0,U){a||n.wake();var i=this.vars.useFrames?z:U;i.add(this,i._time),this.vars.paused&&this.paused(!0)}});n=R.ticker=new h.Ticker,r=R.prototype,r._dirty=r._gc=r._initted=r._paused=!1,r._totalTime=r._time=0,r._rawPrevTime=-1,r._next=r._last=r._onUpdate=r._timeline=r.timeline=null,r._paused=!1;var A=function(){a&&S()-k>2e3&&n.wake(),setTimeout(A,2e3)};A(),r.play=function(t,e){return arguments.length&&this.seek(t,e),this.reversed(!1).paused(!1)},r.pause=function(t,e){return arguments.length&&this.seek(t,e),this.paused(!0)},r.resume=function(t,e){return arguments.length&&this.seek(t,e),this.paused(!1)},r.seek=function(t,e){return this.totalTime(Number(t),e!==!1)},r.restart=function(t,e){return this.reversed(!1).paused(!1).totalTime(t?-this._delay:0,e!==!1,!0)},r.reverse=function(t,e){return arguments.length&&this.seek(t||this.totalDuration(),e),this.reversed(!0).paused(!1)},r.render=function(){},r.invalidate=function(){return this},r.isActive=function(){var t,e=this._timeline,i=this._startTime;return!e||!this._gc&&!this._paused&&e.isActive()&&(t=e.rawTime())>=i&&i+this.totalDuration()/this._timeScale>t},r._enabled=function(t,e){return a||n.wake(),this._gc=!t,this._active=this.isActive(),e!==!0&&(t&&!this.timeline?this._timeline.add(this,this._startTime-this._delay):!t&&this.timeline&&this._timeline._remove(this,!0)),!1},r._kill=function(){return this._enabled(!1,!1)},r.kill=function(t,e){return this._kill(t,e),this},r._uncache=function(t){for(var e=t?this:this.timeline;e;)e._dirty=!0,e=e.timeline;return this},r._swapSelfInParams=function(t){for(var e=t.length,i=t.concat();--e>-1;)"{self}"===t[e]&&(i[e]=this);return i},r.eventCallback=function(t,e,i,s){if("on"===(t||"").substr(0,2)){var r=this.vars;if(1===arguments.length)return r[t];null==e?delete r[t]:(r[t]=e,r[t+"Params"]=p(i)&&-1!==i.join("").indexOf("{self}")?this._swapSelfInParams(i):i,r[t+"Scope"]=s),"onUpdate"===t&&(this._onUpdate=e)}return this},r.delay=function(t){return arguments.length?(this._timeline.smoothChildTiming&&this.startTime(this._startTime+t-this._delay),this._delay=t,this):this._delay},r.duration=function(t){return arguments.length?(this._duration=this._totalDuration=t,this._uncache(!0),this._timeline.smoothChildTiming&&this._time>0&&this._time<this._duration&&0!==t&&this.totalTime(this._totalTime*(t/this._duration),!0),this):(this._dirty=!1,this._duration)},r.totalDuration=function(t){return this._dirty=!1,arguments.length?this.duration(t):this._totalDuration},r.time=function(t,e){return arguments.length?(this._dirty&&this.totalDuration(),this.totalTime(t>this._duration?this._duration:t,e)):this._time},r.totalTime=function(t,e,i){if(a||n.wake(),!arguments.length)return this._totalTime;if(this._timeline){if(0>t&&!i&&(t+=this.totalDuration()),this._timeline.smoothChildTiming){this._dirty&&this.totalDuration();var s=this._totalDuration,r=this._timeline;if(t>s&&!i&&(t=s),this._startTime=(this._paused?this._pauseTime:r._time)-(this._reversed?s-t:t)/this._timeScale,r._dirty||this._uncache(!1),r._timeline)for(;r._timeline;)r._timeline._time!==(r._startTime+r._totalTime)/r._timeScale&&r.totalTime(r._totalTime,!0),r=r._timeline}this._gc&&this._enabled(!0,!1),(this._totalTime!==t||0===this._duration)&&this.render(t,e,!1)}return this},r.progress=r.totalProgress=function(t,e){return arguments.length?this.totalTime(this.duration()*t,e):this._time/this.duration()},r.startTime=function(t){return arguments.length?(t!==this._startTime&&(this._startTime=t,this.timeline&&this.timeline._sortChildren&&this.timeline.add(this,t-this._delay)),this):this._startTime},r.timeScale=function(t){if(!arguments.length)return this._timeScale;if(t=t||l,this._timeline&&this._timeline.smoothChildTiming){var e=this._pauseTime,i=e||0===e?e:this._timeline.totalTime();this._startTime=i-(i-this._startTime)*this._timeScale/t}return this._timeScale=t,this._uncache(!1)},r.reversed=function(t){return arguments.length?(t!=this._reversed&&(this._reversed=t,this.totalTime(this._timeline&&!this._timeline.smoothChildTiming?this.totalDuration()-this._totalTime:this._totalTime,!0)),this):this._reversed},r.paused=function(t){if(!arguments.length)return this._paused;if(t!=this._paused&&this._timeline){a||t||n.wake();var e=this._timeline,i=e.rawTime(),s=i-this._pauseTime;!t&&e.smoothChildTiming&&(this._startTime+=s,this._uncache(!1)),this._pauseTime=t?i:null,this._paused=t,this._active=this.isActive(),!t&&0!==s&&this._initted&&this.duration()&&this.render(e.smoothChildTiming?this._totalTime:(i-this._startTime)/this._timeScale,!0,!0)}return this._gc&&!t&&this._enabled(!0,!1),this};var C=d("core.SimpleTimeline",function(t){R.call(this,0,t),this.autoRemoveChildren=this.smoothChildTiming=!0});r=C.prototype=new R,r.constructor=C,r.kill()._gc=!1,r._first=r._last=null,r._sortChildren=!1,r.add=r.insert=function(t,e){var i,s;if(t._startTime=Number(e||0)+t._delay,t._paused&&this!==t._timeline&&(t._pauseTime=t._startTime+(this.rawTime()-t._startTime)/t._timeScale),t.timeline&&t.timeline._remove(t,!0),t.timeline=t._timeline=this,t._gc&&t._enabled(!0,!0),i=this._last,this._sortChildren)for(s=t._startTime;i&&i._startTime>s;)i=i._prev;return i?(t._next=i._next,i._next=t):(t._next=this._first,this._first=t),t._next?t._next._prev=t:this._last=t,t._prev=i,this._timeline&&this._uncache(!0),this},r._remove=function(t,e){return t.timeline===this&&(e||t._enabled(!1,!0),t.timeline=null,t._prev?t._prev._next=t._next:this._first===t&&(this._first=t._next),t._next?t._next._prev=t._prev:this._last===t&&(this._last=t._prev),this._timeline&&this._uncache(!0)),this},r.render=function(t,e,i){var s,r=this._first;for(this._totalTime=this._time=this._rawPrevTime=t;r;)s=r._next,(r._active||t>=r._startTime&&!r._paused)&&(r._reversed?r.render((r._dirty?r.totalDuration():r._totalDuration)-(t-r._startTime)*r._timeScale,e,i):r.render((t-r._startTime)*r._timeScale,e,i)),r=s},r.rawTime=function(){return a||n.wake(),this._totalTime};var O=d("TweenLite",function(e,i,s){if(R.call(this,i,s),this.render=O.prototype.render,null==e)throw"Cannot tween a null target.";this.target=e="string"!=typeof e?e:O.selector(e)||e;var r,n,a,o=e.jquery||e.length&&e!==t&&e[0]&&(e[0]===t||e[0].nodeType&&e[0].style&&!e.nodeType),h=this.vars.overwrite;if(this._overwrite=h=null==h?X[O.defaultOverwrite]:"number"==typeof h?h>>0:X[h],(o||e instanceof Array||e.push&&p(e))&&"number"!=typeof e[0])for(this._targets=a=_.call(e,0),this._propLookup=[],this._siblings=[],r=0;a.length>r;r++)n=a[r],n?"string"!=typeof n?n.length&&n!==t&&n[0]&&(n[0]===t||n[0].nodeType&&n[0].style&&!n.nodeType)?(a.splice(r--,1),this._targets=a=a.concat(_.call(n,0))):(this._siblings[r]=Y(n,this,!1),1===h&&this._siblings[r].length>1&&j(n,this,null,1,this._siblings[r])):(n=a[r--]=O.selector(n),"string"==typeof n&&a.splice(r+1,1)):a.splice(r--,1);else this._propLookup={},this._siblings=Y(e,this,!1),1===h&&this._siblings.length>1&&j(e,this,null,1,this._siblings);(this.vars.immediateRender||0===i&&0===this._delay&&this.vars.immediateRender!==!1)&&this.render(-this._delay,!1,!0)},!0),D=function(e){return e.length&&e!==t&&e[0]&&(e[0]===t||e[0].nodeType&&e[0].style&&!e.nodeType)},M=function(t,e){var i,s={};for(i in t)L[i]||i in e&&"x"!==i&&"y"!==i&&"width"!==i&&"height"!==i&&"className"!==i&&"border"!==i||!(!E[i]||E[i]&&E[i]._autoCSS)||(s[i]=t[i],delete t[i]);t.css=s};r=O.prototype=new R,r.constructor=O,r.kill()._gc=!1,r.ratio=0,r._firstPT=r._targets=r._overwrittenProps=r._startAt=null,r._notifyPluginsOfEnabled=!1,O.version="1.11.5",O.defaultEase=r._ease=new y(null,null,1,1),O.defaultOverwrite="auto",O.ticker=n,O.autoSleep=!0,O.selector=t.$||t.jQuery||function(e){return t.$?(O.selector=t.$,t.$(e)):t.document?t.document.getElementById("#"===e.charAt(0)?e.substr(1):e):e};var I=O._internals={isArray:p,isSelector:D},E=O._plugins={},N=O._tweenLookup={},F=0,L=I.reservedProps={ease:1,delay:1,overwrite:1,onComplete:1,onCompleteParams:1,onCompleteScope:1,useFrames:1,runBackwards:1,startAt:1,onUpdate:1,onUpdateParams:1,onUpdateScope:1,onStart:1,onStartParams:1,onStartScope:1,onReverseComplete:1,onReverseCompleteParams:1,onReverseCompleteScope:1,onRepeat:1,onRepeatParams:1,onRepeatScope:1,easeParams:1,yoyo:1,immediateRender:1,repeat:1,repeatDelay:1,data:1,paused:1,reversed:1,autoCSS:1},X={none:0,all:1,auto:2,concurrent:3,allOnStart:4,preexisting:5,"true":1,"false":0},z=R._rootFramesTimeline=new C,U=R._rootTimeline=new C;U._startTime=n.time,z._startTime=n.frame,U._active=z._active=!0,R._updateRoot=function(){if(U.render((n.time-U._startTime)*U._timeScale,!1,!1),z.render((n.frame-z._startTime)*z._timeScale,!1,!1),!(n.frame%120)){var t,e,i;for(i in N){for(e=N[i].tweens,t=e.length;--t>-1;)e[t]._gc&&e.splice(t,1);0===e.length&&delete N[i]}if(i=U._first,(!i||i._paused)&&O.autoSleep&&!z._first&&1===n._listeners.tick.length){for(;i&&i._paused;)i=i._next;i||n.sleep()}}},n.addEventListener("tick",R._updateRoot);var Y=function(t,e,i){var s,r,n=t._gsTweenID;if(N[n||(t._gsTweenID=n="t"+F++)]||(N[n]={target:t,tweens:[]}),e&&(s=N[n].tweens,s[r=s.length]=e,i))for(;--r>-1;)s[r]===e&&s.splice(r,1);return N[n].tweens},j=function(t,e,i,s,r){var n,a,o,h;if(1===s||s>=4){for(h=r.length,n=0;h>n;n++)if((o=r[n])!==e)o._gc||o._enabled(!1,!1)&&(a=!0);else if(5===s)break;return a}var _,u=e._startTime+l,p=[],c=0,f=0===e._duration;for(n=r.length;--n>-1;)(o=r[n])===e||o._gc||o._paused||(o._timeline!==e._timeline?(_=_||B(e,0,f),0===B(o,_,f)&&(p[c++]=o)):u>=o._startTime&&o._startTime+o.totalDuration()/o._timeScale>u&&((f||!o._initted)&&2e-10>=u-o._startTime||(p[c++]=o)));for(n=c;--n>-1;)o=p[n],2===s&&o._kill(i,t)&&(a=!0),(2!==s||!o._firstPT&&o._initted)&&o._enabled(!1,!1)&&(a=!0);return a},B=function(t,e,i){for(var s=t._timeline,r=s._timeScale,n=t._startTime;s._timeline;){if(n+=s._startTime,r*=s._timeScale,s._paused)return-100;s=s._timeline}return n/=r,n>e?n-e:i&&n===e||!t._initted&&2*l>n-e?l:(n+=t.totalDuration()/t._timeScale/r)>e+l?0:n-e-l};r._init=function(){var t,e,i,s,r=this.vars,n=this._overwrittenProps,a=this._duration,o=r.immediateRender,h=r.ease;if(r.startAt){if(this._startAt&&this._startAt.render(-1,!0),r.startAt.overwrite=0,r.startAt.immediateRender=!0,this._startAt=O.to(this.target,0,r.startAt),o)if(this._time>0)this._startAt=null;else if(0!==a)return}else if(r.runBackwards&&0!==a)if(this._startAt)this._startAt.render(-1,!0),this._startAt=null;else{i={};for(s in r)L[s]&&"autoCSS"!==s||(i[s]=r[s]);if(i.overwrite=0,i.data="isFromStart",this._startAt=O.to(this.target,0,i),r.immediateRender){if(0===this._time)return}else this._startAt.render(-1,!0)}if(this._ease=h?h instanceof y?r.easeParams instanceof Array?h.config.apply(h,r.easeParams):h:"function"==typeof h?new y(h,r.easeParams):T[h]||O.defaultEase:O.defaultEase,this._easeType=this._ease._type,this._easePower=this._ease._power,this._firstPT=null,this._targets)for(t=this._targets.length;--t>-1;)this._initProps(this._targets[t],this._propLookup[t]={},this._siblings[t],n?n[t]:null)&&(e=!0);else e=this._initProps(this.target,this._propLookup,this._siblings,n);if(e&&O._onPluginEvent("_onInitAllProps",this),n&&(this._firstPT||"function"!=typeof this.target&&this._enabled(!1,!1)),r.runBackwards)for(i=this._firstPT;i;)i.s+=i.c,i.c=-i.c,i=i._next;this._onUpdate=r.onUpdate,this._initted=!0},r._initProps=function(e,i,s,r){var n,a,o,h,l,_;if(null==e)return!1;this.vars.css||e.style&&e!==t&&e.nodeType&&E.css&&this.vars.autoCSS!==!1&&M(this.vars,e);for(n in this.vars){if(_=this.vars[n],L[n])_&&(_ instanceof Array||_.push&&p(_))&&-1!==_.join("").indexOf("{self}")&&(this.vars[n]=_=this._swapSelfInParams(_,this));else if(E[n]&&(h=new E[n])._onInitTween(e,this.vars[n],this)){for(this._firstPT=l={_next:this._firstPT,t:h,p:"setRatio",s:0,c:1,f:!0,n:n,pg:!0,pr:h._priority},a=h._overwriteProps.length;--a>-1;)i[h._overwriteProps[a]]=this._firstPT;(h._priority||h._onInitAllProps)&&(o=!0),(h._onDisable||h._onEnable)&&(this._notifyPluginsOfEnabled=!0)}else this._firstPT=i[n]=l={_next:this._firstPT,t:e,p:n,f:"function"==typeof e[n],n:n,pg:!1,pr:0},l.s=l.f?e[n.indexOf("set")||"function"!=typeof e["get"+n.substr(3)]?n:"get"+n.substr(3)]():parseFloat(e[n]),l.c="string"==typeof _&&"="===_.charAt(1)?parseInt(_.charAt(0)+"1",10)*Number(_.substr(2)):Number(_)-l.s||0;l&&l._next&&(l._next._prev=l)}return r&&this._kill(r,e)?this._initProps(e,i,s,r):this._overwrite>1&&this._firstPT&&s.length>1&&j(e,this,i,this._overwrite,s)?(this._kill(i,e),this._initProps(e,i,s,r)):o},r.render=function(t,e,i){var s,r,n,a,o=this._time,h=this._duration;if(t>=h)this._totalTime=this._time=h,this.ratio=this._ease._calcEnd?this._ease.getRatio(1):1,this._reversed||(s=!0,r="onComplete"),0===h&&(a=this._rawPrevTime,(0===t||0>a||a===l)&&a!==t&&(i=!0,a>l&&(r="onReverseComplete")),this._rawPrevTime=a=!e||t||0===a?t:l);else if(1e-7>t)this._totalTime=this._time=0,this.ratio=this._ease._calcEnd?this._ease.getRatio(0):0,(0!==o||0===h&&this._rawPrevTime>l)&&(r="onReverseComplete",s=this._reversed),0>t?(this._active=!1,0===h&&(this._rawPrevTime>=0&&(i=!0),this._rawPrevTime=a=!e||t||0===this._rawPrevTime?t:l)):this._initted||(i=!0);else if(this._totalTime=this._time=t,this._easeType){var _=t/h,u=this._easeType,p=this._easePower;(1===u||3===u&&_>=.5)&&(_=1-_),3===u&&(_*=2),1===p?_*=_:2===p?_*=_*_:3===p?_*=_*_*_:4===p&&(_*=_*_*_*_),this.ratio=1===u?1-_:2===u?_:.5>t/h?_/2:1-_/2}else this.ratio=this._ease.getRatio(t/h);if(this._time!==o||i){if(!this._initted){if(this._init(),!this._initted||this._gc)return;this._time&&!s?this.ratio=this._ease.getRatio(this._time/h):s&&this._ease._calcEnd&&(this.ratio=this._ease.getRatio(0===this._time?0:1))}for(this._active||!this._paused&&this._time!==o&&t>=0&&(this._active=!0),0===o&&(this._startAt&&(t>=0?this._startAt.render(t,e,i):r||(r="_dummyGS")),this.vars.onStart&&(0!==this._time||0===h)&&(e||this.vars.onStart.apply(this.vars.onStartScope||this,this.vars.onStartParams||v))),n=this._firstPT;n;)n.f?n.t[n.p](n.c*this.ratio+n.s):n.t[n.p]=n.c*this.ratio+n.s,n=n._next;this._onUpdate&&(0>t&&this._startAt&&this._startTime&&this._startAt.render(t,e,i),e||(this._time!==o||s)&&this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||v)),r&&(this._gc||(0>t&&this._startAt&&!this._onUpdate&&this._startTime&&this._startAt.render(t,e,i),s&&(this._timeline.autoRemoveChildren&&this._enabled(!1,!1),this._active=!1),!e&&this.vars[r]&&this.vars[r].apply(this.vars[r+"Scope"]||this,this.vars[r+"Params"]||v),0===h&&this._rawPrevTime===l&&a!==l&&(this._rawPrevTime=0)))}},r._kill=function(t,e){if("all"===t&&(t=null),null==t&&(null==e||e===this.target))return this._enabled(!1,!1);e="string"!=typeof e?e||this._targets||this.target:O.selector(e)||e;var i,s,r,n,a,o,h,l;if((p(e)||D(e))&&"number"!=typeof e[0])for(i=e.length;--i>-1;)this._kill(t,e[i])&&(o=!0);else{if(this._targets){for(i=this._targets.length;--i>-1;)if(e===this._targets[i]){a=this._propLookup[i]||{},this._overwrittenProps=this._overwrittenProps||[],s=this._overwrittenProps[i]=t?this._overwrittenProps[i]||{}:"all";break}}else{if(e!==this.target)return!1;a=this._propLookup,s=this._overwrittenProps=t?this._overwrittenProps||{}:"all"}if(a){h=t||a,l=t!==s&&"all"!==s&&t!==a&&("object"!=typeof t||!t._tempKill);for(r in h)(n=a[r])&&(n.pg&&n.t._kill(h)&&(o=!0),n.pg&&0!==n.t._overwriteProps.length||(n._prev?n._prev._next=n._next:n===this._firstPT&&(this._firstPT=n._next),n._next&&(n._next._prev=n._prev),n._next=n._prev=null),delete a[r]),l&&(s[r]=1);!this._firstPT&&this._initted&&this._enabled(!1,!1)}}return o},r.invalidate=function(){return this._notifyPluginsOfEnabled&&O._onPluginEvent("_onDisable",this),this._firstPT=null,this._overwrittenProps=null,this._onUpdate=null,this._startAt=null,this._initted=this._active=this._notifyPluginsOfEnabled=!1,this._propLookup=this._targets?{}:[],this},r._enabled=function(t,e){if(a||n.wake(),t&&this._gc){var i,s=this._targets;if(s)for(i=s.length;--i>-1;)this._siblings[i]=Y(s[i],this,!0);else this._siblings=Y(this.target,this,!0)}return R.prototype._enabled.call(this,t,e),this._notifyPluginsOfEnabled&&this._firstPT?O._onPluginEvent(t?"_onEnable":"_onDisable",this):!1},O.to=function(t,e,i){return new O(t,e,i)},O.from=function(t,e,i){return i.runBackwards=!0,i.immediateRender=0!=i.immediateRender,new O(t,e,i)},O.fromTo=function(t,e,i,s){return s.startAt=i,s.immediateRender=0!=s.immediateRender&&0!=i.immediateRender,new O(t,e,s)},O.delayedCall=function(t,e,i,s,r){return new O(e,0,{delay:t,onComplete:e,onCompleteParams:i,onCompleteScope:s,onReverseComplete:e,onReverseCompleteParams:i,onReverseCompleteScope:s,immediateRender:!1,useFrames:r,overwrite:0})},O.set=function(t,e){return new O(t,0,e)},O.getTweensOf=function(t,e){if(null==t)return[];t="string"!=typeof t?t:O.selector(t)||t;var i,s,r,n;if((p(t)||D(t))&&"number"!=typeof t[0]){for(i=t.length,s=[];--i>-1;)s=s.concat(O.getTweensOf(t[i],e));for(i=s.length;--i>-1;)for(n=s[i],r=i;--r>-1;)n===s[r]&&s.splice(i,1)}else for(s=Y(t).concat(),i=s.length;--i>-1;)(s[i]._gc||e&&!s[i].isActive())&&s.splice(i,1);return s},O.killTweensOf=O.killDelayedCallsTo=function(t,e,i){"object"==typeof e&&(i=e,e=!1);for(var s=O.getTweensOf(t,e),r=s.length;--r>-1;)s[r]._kill(i,t)};var q=d("plugins.TweenPlugin",function(t,e){this._overwriteProps=(t||"").split(","),this._propName=this._overwriteProps[0],this._priority=e||0,this._super=q.prototype},!0);if(r=q.prototype,q.version="1.10.1",q.API=2,r._firstPT=null,r._addTween=function(t,e,i,s,r,n){var a,o;return null!=s&&(a="number"==typeof s||"="!==s.charAt(1)?Number(s)-i:parseInt(s.charAt(0)+"1",10)*Number(s.substr(2)))?(this._firstPT=o={_next:this._firstPT,t:t,p:e,s:i,c:a,f:"function"==typeof t[e],n:r||e,r:n},o._next&&(o._next._prev=o),o):void 0},r.setRatio=function(t){for(var e,i=this._firstPT,s=1e-6;i;)e=i.c*t+i.s,i.r?e=0|e+(e>0?.5:-.5):s>e&&e>-s&&(e=0),i.f?i.t[i.p](e):i.t[i.p]=e,i=i._next},r._kill=function(t){var e,i=this._overwriteProps,s=this._firstPT;if(null!=t[this._propName])this._overwriteProps=[];else for(e=i.length;--e>-1;)null!=t[i[e]]&&i.splice(e,1);for(;s;)null!=t[s.n]&&(s._next&&(s._next._prev=s._prev),s._prev?(s._prev._next=s._next,s._prev=null):this._firstPT===s&&(this._firstPT=s._next)),s=s._next;return!1},r._roundProps=function(t,e){for(var i=this._firstPT;i;)(t[this._propName]||null!=i.n&&t[i.n.split(this._propName+"_").join("")])&&(i.r=e),i=i._next},O._onPluginEvent=function(t,e){var i,s,r,n,a,o=e._firstPT;if("_onInitAllProps"===t){for(;o;){for(a=o._next,s=r;s&&s.pr>o.pr;)s=s._next;(o._prev=s?s._prev:n)?o._prev._next=o:r=o,(o._next=s)?s._prev=o:n=o,o=a}o=e._firstPT=r}for(;o;)o.pg&&"function"==typeof o.t[t]&&o.t[t]()&&(i=!0),o=o._next;return i},q.activate=function(t){for(var e=t.length;--e>-1;)t[e].API===q.API&&(E[(new t[e])._propName]=t[e]);return!0},m.plugin=function(t){if(!(t&&t.propName&&t.init&&t.API))throw"illegal plugin definition.";var e,i=t.propName,s=t.priority||0,r=t.overwriteProps,n={init:"_onInitTween",set:"setRatio",kill:"_kill",round:"_roundProps",initAll:"_onInitAllProps"},a=d("plugins."+i.charAt(0).toUpperCase()+i.substr(1)+"Plugin",function(){q.call(this,i,s),this._overwriteProps=r||[]},t.global===!0),o=a.prototype=new q(i);o.constructor=a,a.API=t.API;for(e in n)"function"==typeof t[e]&&(o[n[e]]=t[e]);return a.version=t.version,q.activate([a]),a},i=t._gsQueue){for(s=0;i.length>s;s++)i[s]();for(r in c)c[r].func||t.console.log("GSAP encountered missing dependency: com.greensock."+r)}a=!1}}(window);;/*!
 * VERSION: 0.10.2
 * DATE: 2014-04-18
 * UPDATES AND DOCS AT: http://www.greensock.com
 *
 * Requires TweenLite and CSSPlugin version 1.11.0 or later (TweenMax contains both TweenLite and CSSPlugin). ThrowPropsPlugin is required for momentum-based continuation of movement after the mouse/touch is released (ThrowPropsPlugin is a membership benefit of Club GreenSock - http://www.greensock.com/club/).
 *
 * @license Copyright (c) 2008-2014, GreenSock. All rights reserved.
 * This work is subject to the terms at http://www.greensock.com/terms_of_use.html or for
 * Club GreenSock members, the software agreement that was issued with your membership.
 *
 * @author: Jack Doyle, jack@greensock.com
 */
(window._gsQueue || (window._gsQueue = [])).push( function() {

	"use strict";

	window._gsDefine("utils.Draggable", ["events.EventDispatcher","TweenLite"], function(EventDispatcher, TweenLite) {

		var _tempVarsXY = {css:{}}, //speed optimization - we reuse the same vars object for x/y TweenLite.set() calls to minimize garbage collection tasks and improve performance.
			_tempVarsX = {css:{}},
			_tempVarsY = {css:{}},
			_tempVarsRotation = {css:{}},
			_tempEvent = {}, //for populating with pageX/pageY in old versions of IE
			_doc = document,
			_docElement = _doc.documentElement || {},
			_emptyArray = [],
			_emptyFunc = function() { return false; },
			_RAD2DEG = 180 / Math.PI,
			_max = 999999999999999,
			_getTime = Date.now || function() {return new Date().getTime();},
			_isOldIE = (_doc.all && !_doc.addEventListener),
			_renderQueue = [],
			_lookup = {}, //when a Draggable is created, the target gets a unique _gsDragID property that allows gets associated with the Draggable instance for quick lookups in Draggable.get(). This avoids circular references that could cause gc problems.
			_lookupCount = 0,
			_clickableTagExp = /^(?:a|input|textarea|button|select)$/i,
			_dragCount = 0, //total number of elements currently being dragged
			_prefix,
			_isMultiTouching,
			_lastDragTime = 0,
			ThrowPropsPlugin,

			_renderQueueTick = function() {
				var i = _renderQueue.length;
				while (--i > -1) {
					_renderQueue[i]();
				}
			},
			_addToRenderQueue = function(func) {
				_renderQueue.push(func);
				if (_renderQueue.length === 1) {
					TweenLite.ticker.addEventListener("tick", _renderQueueTick, this, false, 1);
				}
			},
			_removeFromRenderQueue = function(func) {
				var i = _renderQueue.length;
				while (--i > -1) {
					if (_renderQueue[i] === func) {
						_renderQueue.splice(i, 1);
					}
				}
				TweenLite.to(_renderQueueTimeout, 0, {overwrite:"all", delay:15, onComplete:_renderQueueTimeout}); //remove the "tick" listener only after the render queue is empty for 15 seconds (to improve performance). Adding/removing it constantly for every click/touch wouldn't deliver optimal speed, and we also don't want the ticker to keep calling the render method when things are idle for long periods of time (we want to improve battery life on mobile devices).
			},
			_renderQueueTimeout = function() {
				if (!_renderQueue.length) {
					TweenLite.ticker.removeEventListener("tick", _renderQueueTick);
				}
			},

			_extend = function(obj, defaults) {
				var p;
				for (p in defaults) {
					if (obj[p] === undefined) {
						obj[p] = defaults[p];
					}
				}
				return obj;
			},

		//just used for IE8 and earlier to normalize events and populate pageX/pageY
			_populateIEEvent = function(e, preventDefault) {
				e = e || window.event;
				_tempEvent.pageX = e.clientX + _doc.body.scrollLeft + _docElement.scrollLeft;
				_tempEvent.pageY = e.clientY + _doc.body.scrollTop + _docElement.scrollTop;
				if (preventDefault) {
					e.returnValue = false;
				}
				return _tempEvent;
			},

		//grabs the first element it finds (and we include the window as an element), so if it's selector text, it'll feed that value to TweenLite.selector, if it's a jQuery object or some other selector engine's result, it'll grab the first one, and same for an array. If the value doesn't contain a DOM element, it'll just return null.
			_unwrapElement = function(value) {
				if (!value) {
					return value;
				}
				if (typeof(value) === "string") {
					value = TweenLite.selector(value);
				}
				if (value.length && value !== window && value[0] && value[0].style && !value.nodeType) {
					value = value[0];
				}
				return (value === window || (value.nodeType && value.style)) ? value : null;
			},

			_checkPrefix = function(e, p) {
				var s = e.style,
					capped, i, a;
				if (s[p] === undefined) {
					a = ["O","Moz","ms","Ms","Webkit"];
					i = 5;
					capped = p.charAt(0).toUpperCase() + p.substr(1);
					while (--i > -1 && s[a[i]+capped] === undefined) { }
					if (i < 0) {
						return "";
					}
					_prefix = (i === 3) ? "ms" : a[i];
					p = _prefix + capped;
				}
				return p;
			},

			_setStyle = function(e, p, value) {
				var s = e.style;
				if (s[p] === undefined) {
					p = _checkPrefix(e, p);
				}
				if (value == null) {
					if (s.removeProperty) {
						s.removeProperty(p.replace(/([A-Z])/g, "-$1").toLowerCase());
					} else { //note: old versions of IE use "removeAttribute()" instead of "removeProperty()"
						s.removeAttribute(p);
					}
				} else if (s[p] !== undefined) {
					s[p] = value;
				}
			},

			_getComputedStyle = _doc.defaultView ? _doc.defaultView.getComputedStyle : _emptyFunc,
			_horizExp = /(?:Left|Right|Width)/i,
			_suffixExp = /(?:\d|\-|\+|=|#|\.)*/g,
			_convertToPixels = function(t, p, v, sfx, recurse) {
				if (sfx === "px" || !sfx) { return v; }
				if (sfx === "auto" || !v) { return 0; }
				var horiz = _horizExp.test(p),
					node = t,
					style = _tempDiv.style,
					neg = (v < 0),
					pix;
				if (neg) {
					v = -v;
				}
				if (sfx === "%" && p.indexOf("border") !== -1) {
					pix = (v / 100) * (horiz ? t.clientWidth : t.clientHeight);
				} else {
					style.cssText = "border:0 solid red;position:" + _getStyle(t, "position", true) + ";line-height:0;";
					if (sfx === "%" || !node.appendChild) {
						node = t.parentNode || _doc.body;
						style[(horiz ? "width" : "height")] = v + sfx;
					} else {
						style[(horiz ? "borderLeftWidth" : "borderTopWidth")] = v + sfx;
					}
					node.appendChild(_tempDiv);
					pix = parseFloat(_tempDiv[(horiz ? "offsetWidth" : "offsetHeight")]);
					node.removeChild(_tempDiv);
					if (pix === 0 && !recurse) {
						pix = _convertToPixels(t, p, v, sfx, true);
					}
				}
				return neg ? -pix : pix;
			},
			_calculateOffset = function(t, p) { //for figuring out "top" or "left" in px when it's "auto". We need to factor in margin with the offsetLeft/offsetTop
				if (_getStyle(t, "position", true) !== "absolute") { return 0; }
				var dim = ((p === "left") ? "Left" : "Top"),
					v = _getStyle(t, "margin" + dim, true);
				return t["offset" + dim] - (_convertToPixels(t, p, parseFloat(v), v.replace(_suffixExp, "")) || 0);
			},

			_getStyle = function(element, prop, keepUnits) {
				var rv = (element._gsTransform || {})[prop],
					cs;
				if (rv || rv === 0) {
					return rv;
				} else if (element.style[prop]) {
					rv = element.style[prop];
				} else if ((cs = _getComputedStyle(element))) {
					rv = cs.getPropertyValue(prop.replace(/([A-Z])/g, "-$1").toLowerCase());
					rv = (rv || cs.length) ? rv : cs[prop]; //Opera behaves VERY strangely - length is usually 0 and cs[prop] is the only way to get accurate results EXCEPT when checking for -o-transform which only works with cs.getPropertyValue()!
				} else if (element.currentStyle) {
					rv = element.currentStyle[prop];
				}
				if (rv === "auto" && (prop === "top" || prop === "left")) {
					rv = _calculateOffset(element, prop);
				}
				return keepUnits ? rv : parseFloat(rv) || 0;
			},

			_dispatchEvent = function(instance, type, callbackName) {
				var vars = instance.vars,
					callback = vars[callbackName],
					listeners = instance._listeners[type];
				if (typeof(callback) === "function") {
					callback.apply(vars[callbackName + "Scope"] || instance, vars[callbackName + "Params"] || [instance.pointerEvent]);
				}
				if (listeners) {
					instance.dispatchEvent(type);
				}
			},
			_getBounds = function(obj, context) { //accepts any of the following: a DOM element, jQuery object, selector text, or an object defining bounds as {top, left, width, height} or {minX, maxX, minY, maxY}. Returns an object with left, top, width, and height properties.
				var e = _unwrapElement(obj),
					top, left, offset;
				if (!e) {
					if (obj.left !== undefined) {
						offset = _getOffsetTransformOrigin(context); //the bounds should be relative to the origin
						return {left: obj.left - offset.x, top: obj.top - offset.y, width: obj.width, height: obj.height};
					}
					left = obj.min || obj.minX || obj.minRotation || 0;
					top = obj.min || obj.minY || 0;
					return {left:left, top:top, width:(obj.max || obj.maxX || obj.maxRotation || 0) - left, height:(obj.max || obj.maxY || 0) - top};
				}
				return _getElementBounds(e, context);
			},

			_tempDiv = _doc.createElement("div"),
			_supports3D = (_checkPrefix(_tempDiv, "perspective") !== ""),


		// start matrix and point conversion methods...
			_originProp = _checkPrefix(_tempDiv, "transformOrigin").replace(/^ms/g, "Ms").replace(/([A-Z])/g, "-$1").toLowerCase(),
			_transformProp = _checkPrefix(_tempDiv, "transform"),
			_transformCSSProp = _transformProp.replace(/^ms/g, "Ms").replace(/([A-Z])/g, "-$1").toLowerCase(),
			_point1 = {}, //we reuse _point1 and _point2 objects inside matrix and point conversion methods to conserve memory and minimize garbage collection tasks.
			_point2 = {},
			_hasReparentBug, //we'll set this inside the _getOffset2DMatrix() method after the body has loaded.
			_getOffsetTransformOrigin = function(e, decoratee) {
				decoratee = decoratee || {};
				if (!e || e === _docElement || !e.parentNode) {
					return {x:0, y:0};
				}
				var cs = _getComputedStyle(e),
					v = (_originProp && cs) ? cs.getPropertyValue(_originProp) : "50% 50%",
					a = v.split(" "),
					x = (v.indexOf("left") !== -1) ? "0%" : (v.indexOf("right") !== -1) ? "100%" : a[0],
					y = (v.indexOf("top") !== -1) ? "0%" : (v.indexOf("bottom") !== -1) ? "100%" : a[1];
				if (y === "center" || y == null) {
					y = "50%";
				}
				if (x === "center" || isNaN(parseFloat(x))) { //remember, the user could flip-flop the values and say "bottom center" or "center bottom", etc. "center" is ambiguous because it could be used to describe horizontal or vertical, hence the isNaN(). If there's an "=" sign in the value, it's relative.
					x = "50%";
				}
				decoratee.x = ((x.indexOf("%") !== -1) ? e.offsetWidth * parseFloat(x) / 100 : parseFloat(x));
				decoratee.y = ((y.indexOf("%") !== -1) ? e.offsetHeight * parseFloat(y) / 100 : parseFloat(y));
				return decoratee;
			},
			_getOffset2DMatrix = function(e, offsetOrigin, parentOffsetOrigin) {
				var cs, m, parent, offsetParent;
				if (e === window || !e || !e.parentNode) {
					return [1,0,0,1,0,0];
				}
				parent = e.parentNode;
				offsetParent = e.offsetParent;
				cs = _getComputedStyle(e);
				m = cs ? cs.getPropertyValue(_transformCSSProp) : e.currentStyle ? e.currentStyle[_transformProp] : "1,0,0,1,0,0";
				m = (m + "").match(/(?:\-|\b)[\d\-\.e]+\b/g) || [1,0,0,1,0,0];
				if (m.length > 6) {
					m = [m[0], m[1], m[4], m[5], m[12], m[13]];
				}
				if (offsetOrigin) {
					m[4] = Number(m[4]) + offsetOrigin.x + e.offsetLeft - parentOffsetOrigin.x - (parent !== _doc.body ? parent.scrollLeft : 0) + (offsetParent ? parseInt(_getStyle(offsetParent, "borderLeftWidth"), 10) || 0 : 0);
					m[5] = Number(m[5]) + offsetOrigin.y + e.offsetTop - parentOffsetOrigin.y - (parent !== _doc.body ? parent.scrollTop : 0) + (offsetParent ? parseInt(_getStyle(offsetParent, "borderTopWidth"), 10) || 0 : 0);

					//some browsers (like Chrome 31) have a bug that causes the offsetParent not to report correctly when a transform is applied to an element's parent, so the offsetTop and offsetLeft are measured from the parent instead of whatever the offsetParent reports as. For example, put an absolutely-positioned child div inside a position:static parent, then check the child's offsetTop before and after you apply a transform, like rotate(1deg). You'll see that it changes, but the offsetParent doesn't. So we must sense this condition here (and we can only do it after the body has loaded, as browsers don't accurately report offsets otherwise) and set a variable that we can easily reference later.
					if (_hasReparentBug === undefined && _doc.body && _transformProp) {
						_hasReparentBug = (function() {
							var parent = _doc.createElement("div"),
								child = _doc.createElement("div"),
								oldOffsetParent, value;
							child.style.position = "absolute";
							_doc.body.appendChild(parent);
							parent.appendChild(child);
							oldOffsetParent = child.offsetParent;
							parent.style[_transformProp] = "rotate(1deg)";
							value = (child.offsetParent === oldOffsetParent);
							_doc.body.removeChild(parent);
							return value;
						}());
					}
					if (parent && parent.offsetParent === e.offsetParent && (!_hasReparentBug || _getOffset2DMatrix(parent).join("") === "100100")) {
						m[4] -= parent.offsetLeft;
						m[5] -= parent.offsetTop;
					}
				}
				return m;
			},
			_getConcatenatedMatrix = function(e, invert) {
				//note: we keep reusing _point1 and _point2 in order to minimize memory usage and garbage collection chores.
				var originOffset = _getOffsetTransformOrigin(e, _point1),
					parentOriginOffset = _getOffsetTransformOrigin(e.parentNode, _point2),
					m = _getOffset2DMatrix(e, originOffset, parentOriginOffset),
					a, b, c, d, tx, ty, m2, determinant;
				while ((e = e.parentNode) && e.parentNode && e !== _docElement) {
					originOffset = parentOriginOffset;
					parentOriginOffset = _getOffsetTransformOrigin(e.parentNode, (originOffset === _point1) ? _point2 : _point1);
					m2 = _getOffset2DMatrix(e, originOffset, parentOriginOffset);
					a = m[0];
					b = m[1];
					c = m[2];
					d = m[3];
					tx = m[4];
					ty = m[5];
					m[0] = a * m2[0] + b * m2[2];
					m[1] = a * m2[1] + b * m2[3];
					m[2] = c * m2[0] + d * m2[2];
					m[3] = c * m2[1] + d * m2[3];
					m[4] = tx * m2[0] + ty * m2[2] + m2[4];
					m[5] = tx * m2[1] + ty * m2[3] + m2[5];
				}
				if (invert) {
					a = m[0];
					b = m[1];
					c = m[2];
					d = m[3];
					tx = m[4];
					ty = m[5];
					determinant = (a * d - b * c);
					m[0] = d / determinant;
					m[1] = -b / determinant;
					m[2] = -c / determinant;
					m[3] = a / determinant;
					m[4] = (c * ty - d * tx) / determinant;
					m[5] = -(a * ty - b * tx) / determinant;
				}
				return m;
			},
			_localToGlobal = function(e, p, decoratee) {
				var m = _getConcatenatedMatrix(e),
					x = p.x,
					y = p.y;
				decoratee = (decoratee === true) ? p : decoratee || {};
				decoratee.x = x * m[0] + y * m[2] + m[4];
				decoratee.y = x * m[1] + y * m[3] + m[5];
				return decoratee;
			},
			_localizePoint = function(p, localToGlobal, globalToLocal) {
				var x = p.x * localToGlobal[0] + p.y * localToGlobal[2] + localToGlobal[4],
					y = p.x * localToGlobal[1] + p.y * localToGlobal[3] + localToGlobal[5];
				p.x = x * globalToLocal[0] + y * globalToLocal[2] + globalToLocal[4];
				p.y = x * globalToLocal[1] + y * globalToLocal[3] + globalToLocal[5];
				return p;
			},
			_getElementBounds = function(e, context) {
				var origin, left, right, top, bottom, mLocalToGlobal, mGlobalToLocal, p1, p2, p3, p4;
				if (e === window) {
					top = (e.pageYOffset != null) ? e.pageYOffset : (_doc.scrollTop != null) ? _doc.scrollTop : _docElement.scrollTop || _doc.body.scrollTop || 0;
					left = (e.pageXOffset != null) ? e.pageXOffset : (_doc.scrollLeft != null) ? _doc.scrollLeft : _docElement.scrollLeft || _doc.body.scrollLeft || 0;
					right = left + (_docElement.clientWidth || e.innerWidth || _doc.body.clientWidth || 0);
					bottom = top + ((e.innerHeight - 20 < _docElement.clientHeight) ? _docElement.clientHeight : e.innerHeight || _doc.body.clientHeight || 0); //some browsers (like Firefox) ignore absolutely positioned elements, and collapse the height of the documentElement, so it could be 8px, for example, if you have just an absolutely positioned div. In that case, we use the innerHeight to resolve this.
				} else {
					origin = _getOffsetTransformOrigin(e);
					left = -origin.x;
					right = left + e.offsetWidth;
					top = -origin.y;
					bottom = top + e.offsetHeight;
				}
				if (e === context) {
					return {left:left, top:top, width: right - left, height: bottom - top};
				}
				mLocalToGlobal = _getConcatenatedMatrix(e);
				mGlobalToLocal = _getConcatenatedMatrix(context, true);
				p1 = _localizePoint({x:left, y:top}, mLocalToGlobal, mGlobalToLocal);
				p2 = _localizePoint({x:right, y:top}, mLocalToGlobal, mGlobalToLocal);
				p3 = _localizePoint({x:right, y:bottom}, mLocalToGlobal, mGlobalToLocal);
				p4 = _localizePoint({x:left, y:bottom}, mLocalToGlobal, mGlobalToLocal);
				left = Math.min(p1.x, p2.x, p3.x, p4.x);
				top = Math.min(p1.y, p2.y, p3.y, p4.y);
				return {left:left, top:top, width:Math.max(p1.x, p2.x, p3.x, p4.x) - left, height:Math.max(p1.y, p2.y, p3.y, p4.y) - top};
			},
		// end matrix and point conversion methods



			_isArrayLike = function(e) {
				return (e.length && e[0] && ((e[0].nodeType && e[0].style && !e.nodeType) || (e[0].length && e[0][0]))) ? true : false; //could be an array of jQuery objects too, so accommodate that.
			},

			_flattenArray = function(a) {
				var result = [],
					l = a.length,
					i, e, j;
				for (i = 0; i < l; i++) {
					e = a[i];
					if (_isArrayLike(e)) {
						j = e.length;
						for (j = 0; j < e.length; j++) {
							result.push(e[j]);
						}
					} else {
						result.push(e);
					}
				}
				return result;
			},

			_isTouchDevice = (("ontouchstart" in _docElement) && ("orientation" in window)),
			_touchEventLookup = (function(types) { //we create an object that makes it easy to translate touch event types into their "pointer" counterparts if we're in a browser that uses those instead. Like IE10 uses "MSPointerDown" instead of "touchstart", for example.
				var standard = types.split(","),
					converted = ((_tempDiv.onpointerdown !== undefined) ? "pointerdown,pointermove,pointerup,pointercancel" : (_tempDiv.onmspointerdown !== undefined) ? "MSPointerDown,MSPointerMove,MSPointerUp,MSPointerCancel" : types).split(","),
					obj = {},
					i = 7;
				while (--i > -1) {
					obj[standard[i]] = converted[i];
					obj[converted[i]] = standard[i];
				}
				return obj;
			}("touchstart,touchmove,touchend,touchcancel")),

			_addListener = function(element, type, func) {
				if (element.addEventListener) {
					element.addEventListener(_touchEventLookup[type] || type, func, false);
				} else if (element.attachEvent) {
					element.attachEvent("on" + type, func);
				}
			},

			_removeListener = function(element, type, func) {
				if (element.removeEventListener) {
					element.removeEventListener(_touchEventLookup[type] || type, func);
				} else if (element.detachEvent) {
					element.detachEvent("on" + type, func);
				}
			},

			_onMultiTouchDocumentEnd = function(e) {
				_isMultiTouching = (e.touches && _dragCount < e.touches.length);
				_removeListener(e.target, "touchend", _onMultiTouchDocumentEnd);
			},

			_onMultiTouchDocument = function(e) {
				_isMultiTouching = (e.touches && _dragCount < e.touches.length);
				_addListener(e.target, "touchend", _onMultiTouchDocumentEnd);
			},

			_parseThrowProps = function(draggable, snap, max, min, factor, forceZeroVelocity) {
				var vars = {},
					a, i, l;
				if (snap) {
					if (factor !== 1 && snap instanceof Array) { //some data must be altered to make sense, like if the user passes in an array of rotational values in degrees, we must convert it to radians. Or for scrollLeft and scrollTop, we invert the values.
						vars.end = a = [];
						l = snap.length;
						for (i = 0; i < l; i++) {
							a[i] = snap[i] * factor;
						}
					} else if (typeof(snap) === "function") {
						vars.end = function(value) {
							return snap.call(draggable, value) * factor; //we need to ensure that we can scope the function call to the Draggable instance itself so that users can access important values like maxX, minX, maxY, minY, x, and y from within that function.
						};
					} else {
						vars.end = snap;
					}
				}
				if (max || max === 0) {
					vars.max = max;
				}
				if (min || min === 0) {
					vars.min = min;
				}
				if (forceZeroVelocity) {
					vars.velocity = 0;
				}
				return vars;
			},

			_isClickable = function(e) { //sometimes it's convenient to mark an element as clickable by adding a data-clickable="true" attribute (in which case we won't preventDefault() the mouse/touch event). This method checks if the element is an <a>, <input>, or <button> or has an onclick or has the data-clickable attribute set to true (or any of its parent elements).
				var data;
				return (!e || !e.getAttribute || e.nodeName === "BODY") ? false : ((data = e.getAttribute("data-clickable")) === "true" || (data !== "false" && (e.onclick || _clickableTagExp.test(e.nodeName + "")))) ? true : _isClickable(e.parentNode);
			},

			_addPaddingBR,
			_addPaddingLeft = (function() { //this function is in charge of analyzing browser behavior related to padding. It sets the _addPaddingBR to true if the browser doesn't normally factor in the bottom or right padding on the element inside the scrolling area, and it sets _addPaddingLeft to true if it's a browser that requires the extra offset (offsetLeft) to be added to the paddingRight (like Opera).
				var div = _doc.createElement("div"),
					child = _doc.createElement("div"),
					childStyle = child.style,
					parent = _doc.body || _tempDiv,
					val;
				childStyle.display = "inline-block";
				childStyle.position = "relative";
				div.style.cssText = child.innerHTML = "width:90px; height:40px; padding:10px; overflow:auto; visibility: hidden";
				div.appendChild(child);
				parent.appendChild(div);
				_addPaddingBR = (child.offsetHeight + 18 > div.scrollHeight); //div.scrollHeight should be child.offsetHeight + 20 because of the 10px of padding on each side, but some browsers ignore one side. We allow a 2px margin of error.
				childStyle.width = "100%";
				if (!_transformProp) {
					childStyle.paddingRight = "500px";
					val = div.scrollLeft = div.scrollWidth - div.clientWidth;
					childStyle.left = "-90px";
					val = (val !== div.scrollLeft);
				}
				parent.removeChild(div);
				return val;
			}()),




		//The ScrollProxy class wraps an element's contents into another div (we call it "content") that we either add padding when necessary or apply a translate3d() transform in order to overscroll (scroll past the boundaries). This allows us to simply set the scrollTop/scrollLeft (or top/left for easier reverse-axis orientation, which is what we do in Draggable) and it'll do all the work for us. For example, if we tried setting scrollTop to -100 on a normal DOM element, it wouldn't work - it'd look the same as setting it to 0, but if we set scrollTop of a ScrollProxy to -100, it'll give the correct appearance by either setting paddingTop of the wrapper to 100 or applying a 100-pixel translateY.
			ScrollProxy = function(element, vars) {
				element = _unwrapElement(element);
				vars = vars || {};
				var content = _doc.createElement("div"),
					style = content.style,
					node = element.firstChild,
					offsetTop = 0,
					offsetLeft = 0,
					prevTop = element.scrollTop,
					prevLeft = element.scrollLeft,
					scrollWidth = element.scrollWidth,
					scrollHeight = element.scrollHeight,
					extraPadRight = 0,
					maxLeft = 0,
					maxTop = 0,
					elementWidth, elementHeight, contentHeight, nextNode, transformStart, transformEnd;

				if (_supports3D && vars.force3D !== false) {
					transformStart = "translate3d(";
					transformEnd = "px,0px)";
				} else if (_transformProp) {
					transformStart = "translate(";
					transformEnd = "px)";
				}

				this.scrollTop = function(value, force) {
					if (!arguments.length) {
						return -this.top();
					}
					this.top(-value, force);
				};

				this.scrollLeft = function(value, force) {
					if (!arguments.length) {
						return -this.left();
					}
					this.left(-value, force);
				};

				this.left = function(value, force) {
					if (!arguments.length) {
						return -(element.scrollLeft + offsetLeft);
					}
					var dif = element.scrollLeft - prevLeft,
						oldOffset = offsetLeft;
					if ((dif > 2 || dif < -2) && !force) { //if the user interacts with the scrollbar (or something else scrolls it, like the mouse wheel), we should kill any tweens of the ScrollProxy.
						prevLeft = element.scrollLeft;
						TweenLite.killTweensOf(this, true, {left:1, scrollLeft:1});
						this.left(-prevLeft);
						if (vars.onKill) {
							vars.onKill();
						}
						return;
					}
					value = -value; //invert because scrolling works in the opposite direction
					if (value < 0) {
						offsetLeft = (value - 0.5) | 0;
						value = 0;
					} else if (value > maxLeft) {
						offsetLeft = (value - maxLeft) | 0;
						value = maxLeft;
					} else {
						offsetLeft = 0;
					}
					if (offsetLeft || oldOffset) {
						if (transformStart) {
							if (!this._suspendTransforms) {
								style[_transformProp] = transformStart + -offsetLeft + "px," + -offsetTop + transformEnd;
							}
						} else {
							style.left = -offsetLeft + "px";
						}
						if (_addPaddingLeft && offsetLeft + extraPadRight >= 0) {
							style.paddingRight = offsetLeft + extraPadRight + "px";
						}
					}
					element.scrollLeft = value | 0;
					prevLeft = element.scrollLeft; //don't merge this with the line above because some browsers adjsut the scrollLeft after it's set, so in order to be 100% accurate in tracking it, we need to ask the browser to report it.
				};

				this.top = function(value, force) {
					if (!arguments.length) {
						return -(element.scrollTop + offsetTop);
					}
					var dif = element.scrollTop - prevTop,
						oldOffset = offsetTop;
					if ((dif > 2 || dif < -2) && !force) { //if the user interacts with the scrollbar (or something else scrolls it, like the mouse wheel), we should kill any tweens of the ScrollProxy.
						prevTop = element.scrollTop;
						TweenLite.killTweensOf(this, true, {top:1, scrollTop:1});
						this.top(-prevTop);
						if (vars.onKill) {
							vars.onKill();
						}
						return;
					}
					value = -value; //invert because scrolling works in the opposite direction
					if (value < 0) {
						offsetTop = (value - 0.5) | 0;
						value = 0;
					} else if (value > maxTop) {
						offsetTop = (value - maxTop) | 0;
						value = maxTop;
					} else {
						offsetTop = 0;
					}
					if (offsetTop || oldOffset) {
						if (transformStart) {
							if (!this._suspendTransforms) {
								style[_transformProp] = transformStart + -offsetLeft + "px," + -offsetTop + transformEnd;
							}
						} else {
							style.top = -offsetTop + "px";
						}
					}
					element.scrollTop = value | 0;
					prevTop = element.scrollTop;
				};

				this.maxScrollTop = function() {
					return maxTop;
				};

				this.maxScrollLeft = function() {
					return maxLeft;
				};

				this.disable = function() {
					node = content.firstChild;
					while (node) {
						nextNode = node.nextSibling;
						element.appendChild(node);
						node = nextNode;
					}
					if (element === content.parentNode) { //in case disable() is called when it's already disabled.
						element.removeChild(content);
					}
				};

				this.enable = function() {
					node = element.firstChild;
					if (node === content) {
						return;
					}
					while (node) {
						nextNode = node.nextSibling;
						content.appendChild(node);
						node = nextNode;
					}
					element.appendChild(content);
					this.calibrate();
				};

				this.calibrate = function(force) {
					var widthMatches = (element.clientWidth === elementWidth),
						x, y;
					prevTop = element.scrollTop;
					prevLeft = element.scrollLeft;
					if (widthMatches && element.clientHeight === elementHeight && content.offsetHeight === contentHeight && scrollWidth === element.scrollWidth && scrollHeight === element.scrollHeight && !force) {
						return; //no need to recalculate things if the width and height haven't changed.
					}
					if (offsetTop || offsetLeft) {
						x = this.left();
						y = this.top();
						this.left(-element.scrollLeft);
						this.top(-element.scrollTop);
					}
					//first, we need to remove any width constraints to see how the content naturally flows so that we can see if it's wider than the containing element. If so, we've got to record the amount of overage so that we can apply that as padding in order for browsers to correctly handle things. Then we switch back to a width of 100% (without that, some browsers don't flow the content correctly)
					if (!widthMatches || force) {
						style.display = "block";
						style.width = "auto";
						style.paddingRight = "0px";
						extraPadRight = Math.max(0, element.scrollWidth - element.clientWidth);
						//if the content is wider than the container, we need to add the paddingLeft and paddingRight in order for things to behave correctly.
						if (extraPadRight) {
							extraPadRight += _getStyle(element, "paddingLeft") + (_addPaddingBR ? _getStyle(element, "paddingRight") : 0);
						}
					}
					style.display = "inline-block";
					style.position = "relative";
					style.overflow = "visible";
					style.width = "100%";
					style.paddingRight = extraPadRight + "px";
					//some browsers neglect to factor in the bottom padding when calculating the scrollHeight, so we need to add that padding to the content when that happens. Allow a 2px margin for error
					if (_addPaddingBR) {
						style.paddingBottom = _getStyle(element, "paddingBottom", true);
					}
					if (_isOldIE) {
						style.zoom = "1";
					}
					elementWidth = element.clientWidth;
					elementHeight = element.clientHeight;
					scrollWidth = element.scrollWidth;
					scrollHeight = element.scrollHeight;
					maxLeft = element.scrollWidth - elementWidth;
					maxTop = element.scrollHeight - elementHeight;
					contentHeight = content.offsetHeight;
					if (x || y) {
						this.left(x);
						this.top(y);
					}
				};

				this.content = content;
				this.element = element;
				this._suspendTransforms = false;
				this.enable();
			},

			Draggable = function(target, vars) {
				EventDispatcher.call(this, target);
				target = _unwrapElement(target); //in case the target is a selector object or selector text
				if (!ThrowPropsPlugin) {
					ThrowPropsPlugin = (window.GreenSockGlobals || window).com.greensock.plugins.ThrowPropsPlugin;
				}
				this.vars = vars = vars || {};
				this.target = target;
				this.x = this.y = this.rotation = 0;
				this.dragResistance = parseFloat(vars.dragResistance) || 0;
				this.edgeResistance = isNaN(vars.edgeResistance) ? 1 : parseFloat(vars.edgeResistance) || 0;
				this.lockAxis = vars.lockAxis;
				var type = (vars.type || (_isOldIE ? "top,left" : "x,y")).toLowerCase(),
					xyMode = (type.indexOf("x") !== -1 || type.indexOf("y") !== -1),
					rotationMode = (type.indexOf("rotation") !== -1),
					xProp = xyMode ? "x" : "left",
					yProp = xyMode ? "y" : "top",
					allowX = (type.indexOf("x") !== -1 || type.indexOf("left") !== -1 || type === "scroll"),
					allowY = (type.indexOf("y") !== -1 || type.indexOf("top") !== -1 || type === "scroll"),
					self = this,
					trigger = _unwrapElement(vars.trigger || vars.handle || target),
					killProps = {},
					dragEndTime = 0,
					scrollProxy, startMouseX, startMouseY, startElementX, startElementY, hasBounds, hasDragCallback, maxX, minX, maxY, minY, tempVars, cssVars, touch, touchID, rotationOrigin, dirty, old, snapX, snapY, isClicking, touchEventTarget, lockedAxis, matrix, interrupted,

				//this method gets called on every tick of TweenLite.ticker which allows us to synchronize the renders to the core engine (which is typically synchronized with the display refresh via requestAnimationFrame). This is an optimization - it's better than applying the values inside the "mousemove" or "touchmove" event handler which may get called many times inbetween refreshes.
					render = function(suppressEvents) {
						if (dirty) {
							var x = self.x,
								y = self.y,
								min = 0.000001;
							if (x < min && x > -min) { //browsers don't handle super small decimals well.
								x = 0;
							}
							if (y < min && y > -min) {
								y = 0;
							}
							if (rotationMode) {
								cssVars.rotation = self.rotation = self.x;
								TweenLite.set(target, tempVars);
							} else {
								if (scrollProxy) {
									if (allowY) {
										scrollProxy.top(y);
									}
									if (allowX) {
										scrollProxy.left(x);
									}
								} else if (xyMode) {
									if (allowY) {
										cssVars.y = y;
									}
									if (allowX) {
										cssVars.x = x;
									}
									TweenLite.set(target, tempVars);
								} else {
									if (allowY) {
										target.style.top = y + "px";
									}
									if (allowX) {
										target.style.left = x + "px";
									}
								}
							}
							if (hasDragCallback && !suppressEvents) {
								_dispatchEvent(self, "drag", "onDrag");
							}
						}
						dirty = false;
					},

				//copies the x/y from the element (whether that be transforms, top/left, or ScrollProxy's top/left) to the Draggable's x and y (and rotation if necessary) properties so that they reflect reality and it also (optionally) applies any snapping necessary. This is used by the ThrowPropsPlugin tween in an onUpdate to ensure things are synced and snapped.
					syncXY = function(skipOnUpdate, skipSnap) {
						var snappedValue;
						if (xyMode) {
							if (!target._gsTransform) { //just in case the _gsTransform got wiped, like if the user called clearProps on the transform or something (very rare), doing an x tween forces a re-parsing of the transforms and population of the _gsTransform.
								TweenLite.set(target, {x:"+=0"});
							}
							self.y = target._gsTransform.y;
							self.x = target._gsTransform.x;
						} else if (rotationMode) {
							if (!target._gsTransform) { //just in case the _gsTransform got wiped, like if the user called clearProps on the transform or something (very rare), doing an x tween forces a re-parsing of the transforms and population of the _gsTransform.
								TweenLite.set(target, {x:"+=0"});
							}
							self.x = self.rotation = target._gsTransform.rotation;
						} else if (scrollProxy) {
							self.y = scrollProxy.top();
							self.x = scrollProxy.left();
						} else {
							self.y = parseInt(target.style.top, 10) || 0;
							self.x = parseInt(target.style.left, 10) || 0;
						}
						if ((snapX || snapY) && !skipSnap) {
							if (snapX) {
								snappedValue = snapX(self.x);
								if (snappedValue !== self.x) {
									self.x = snappedValue;
									if (rotationMode) {
										self.rotation = snappedValue;
									}
									dirty = true;
								}
							}
							if (snapY) {
								snappedValue = snapY(self.y);
								if (snappedValue !== self.y) {
									self.y = snappedValue;
									dirty = true;
								}
							}
							if (dirty) {
								render(true);
							}
						}
						if (vars.onThrowUpdate && !skipOnUpdate) {
							vars.onThrowUpdate.apply(vars.onThrowUpdateScope || self, vars.onThrowUpdateParams || _emptyArray);
						}
					},

					calculateBounds = function() {
						var bounds, targetBounds, snap, snapIsRaw;
						hasBounds = false;
						if (scrollProxy) {
							scrollProxy.calibrate();
							self.minX = minX = -scrollProxy.maxScrollLeft();
							self.minY = minY = -scrollProxy.maxScrollTop();
							self.maxX = maxX = self.maxY = maxY = 0;
							hasBounds = true;
						} else if (!!vars.bounds) {
							bounds = _getBounds(vars.bounds, target.parentNode); //could be a selector/jQuery object or a DOM element or a generic object like {top:0, left:100, width:1000, height:800} or {minX:100, maxX:1100, minY:0, maxY:800}
							if (rotationMode) {
								self.minX = minX = bounds.left;
								self.maxX = maxX = bounds.left + bounds.width;
								self.minY = minY = self.maxY = maxY = 0;
							} else if (vars.bounds.maxX !== undefined || vars.bounds.maxY !== undefined) {
								bounds = vars.bounds;
								self.minX = minX = bounds.minX;
								self.minY = minY = bounds.minY;
								self.maxX = maxX = bounds.maxX;
								self.maxY = maxY = bounds.maxY;
							} else {
								targetBounds = _getBounds(target, target.parentNode);
								self.minX = minX = _getStyle(target, xProp) + bounds.left - targetBounds.left;
								self.minY = minY = _getStyle(target, yProp) + bounds.top - targetBounds.top;
								self.maxX = maxX = minX + (bounds.width - targetBounds.width);
								self.maxY = maxY = minY + (bounds.height - targetBounds.height);
							}
							if (minX > maxX) {
								self.minX = maxX;
								self.maxX = maxX = minX;
								minX = self.minX;
							}
							if (minY > maxY) {
								self.minY = maxY;
								self.maxY = maxY = minY;
								minY = self.minY;
							}
							if (rotationMode) {
								self.minRotation = minX;
								self.maxRotation = maxX;
							}
							hasBounds = true;
						}
						if (vars.liveSnap) {
							snap = (vars.liveSnap === true) ? (vars.snap || {}) : vars.liveSnap;
							snapIsRaw = (snap instanceof Array || typeof(snap) === "function");
							if (rotationMode) {
								snapX = buildSnapFunc((snapIsRaw ? snap : snap.rotation), minX, maxX, 1);
								snapY = null;
							} else {
								if (allowX) {
									snapX = buildSnapFunc((snapIsRaw ? snap : snap.x || snap.left || snap.scrollLeft), minX, maxX, scrollProxy ? -1 : 1);
								}
								if (allowY) {
									snapY = buildSnapFunc((snapIsRaw ? snap : snap.y || snap.top || snap.scrollTop), minY, maxY, scrollProxy ? -1 : 1);
								}
							}
						}

					},

					animate = function(throwProps, forceZeroVelocity) {
						var snap, snapIsRaw, tween;
						if (throwProps && ThrowPropsPlugin) {
							if (throwProps === true) {
								snap = vars.snap || {};
								snapIsRaw = (snap instanceof Array || typeof(snap) === "function");
								throwProps = {resistance:(vars.throwResistance || vars.resistance || 1000) / (rotationMode ? 10 : 1)};
								if (rotationMode) {
									throwProps.rotation = _parseThrowProps(self, snapIsRaw ? snap : snap.rotation, maxX, minX, 1, forceZeroVelocity);
								} else {
									if (allowX) {
										throwProps[xProp] = _parseThrowProps(self, snapIsRaw ? snap : snap.x || snap.left || snap.scrollLeft, maxX, minX, scrollProxy ? -1 : 1, forceZeroVelocity || (self.lockAxis && lockedAxis === "x"));
									}
									if (allowY) {
										throwProps[yProp] = _parseThrowProps(self, snapIsRaw ? snap : snap.y || snap.top || snap.scrollTop, maxY, minY, scrollProxy ? -1 : 1, forceZeroVelocity || (self.lockAxis && lockedAxis === "y"));
									}
								}
							}
//							debugger;
							self.tween = tween = ThrowPropsPlugin.to(scrollProxy || target, {throwProps:throwProps, ease:(vars.ease || Power3.easeOut), onComplete:vars.onThrowComplete, onCompleteParams:vars.onThrowCompleteParams, onCompleteScope:(vars.onThrowCompleteScope || self), onUpdate:(vars.fastMode ? vars.onThrowUpdate : syncXY), onUpdateParams:vars.onThrowUpdateParams, onUpdateScope:(vars.onThrowUpdateScope || self)}, (isNaN(vars.maxDuration) ? 2 : vars.maxDuration), (isNaN(vars.minDuration) ? 0.5 : vars.minDuration), (isNaN(vars.overshootTolerance) ? (1 - self.edgeResistance) + 0.2 : vars.overshootTolerance));
							if (!vars.fastMode) {
								//to populate the end values, we just scrub the tween to the end, record the values, and then jump back to the beginning.
								if (scrollProxy) {
									scrollProxy._suspendTransforms = true; //Microsoft browsers have a bug that causes them to briefly render the position incorrectly (it flashes to the end state when we seek() the tween even though we jump right back to the current position, and this only seems to happen when we're affecting both top and left), so we set a _suspendTransforms flag to prevent it from actually applying the values in the ScrollProxy.
								}
								tween.seek(tween.duration());
								syncXY(true, true);
								self.endX = self.x;
								self.endY = self.y;
								if (rotationMode) {
									self.endRotation = self.x;
								}
								tween.play(0);
								syncXY(true, true);
								if (scrollProxy) {
									scrollProxy._suspendTransforms = false;
								}
							}
						} else if (hasBounds) {
							self.applyBounds();
						}
					},

					updateMatrix = function() {
						matrix = _getConcatenatedMatrix(target.parentNode, true);
						if (!matrix[1] && !matrix[2] && matrix[0] == 1 && matrix[3] == 1 && matrix[4] == 0 && matrix[5] == 0) { //if there are no transforms, we can optimize performance by not factoring in the matrix
							matrix = null;
						}
					},

					recordStartPositions = function() {
						var edgeTolerance = 1 - self.edgeResistance;
						updateMatrix();
						if (scrollProxy) {
							calculateBounds();
							startElementY = scrollProxy.top();
							startElementX = scrollProxy.left();
						} else {
							//if the element is in the process of tweening, don't force snapping to occur because it could make it jump. Imagine the user throwing, then before it's done, clicking on the element in its inbetween state.
							if (isTweening()) {
								syncXY(true, true);
								calculateBounds();
							} else {
								self.applyBounds();
							}
							if (rotationMode) {
								rotationOrigin = _localToGlobal(target, {x:0, y:0});
								syncXY(true, true);
								startElementX = self.x; //starting rotation (x always refers to rotation in type:"rotation", measured in degrees)
								startElementY = self.y = Math.atan2(rotationOrigin.y - startMouseY, startMouseX - rotationOrigin.x) * _RAD2DEG;
							} else {
								startElementY = _getStyle(target, yProp); //record the starting top and left values so that we can just add the mouse's movement to them later.
								startElementX = _getStyle(target, xProp);
							}
						}
						if (hasBounds && edgeTolerance) {
							if (startElementX > maxX) {
								startElementX = maxX + (startElementX - maxX) / edgeTolerance;
							} else if (startElementX < minX) {
								startElementX = minX - (minX - startElementX) / edgeTolerance;
							}
							if (!rotationMode) {
								if (startElementY > maxY) {
									startElementY = maxY + (startElementY - maxY) / edgeTolerance;
								} else if (startElementY < minY) {
									startElementY = minY - (minY - startElementY) / edgeTolerance;
								}
							}
						}
					},

					isTweening = function() {
						return (self.tween && self.tween.isActive());
					},

					buildSnapFunc = function(snap, min, max, factor) {
						if (typeof(snap) === "function") {
							return function(n) {
								var edgeTolerance = !self.isPressed ? 1 : 1 - self.edgeResistance; //if we're tweening, disable the edgeTolerance because it's already factored into the tweening values (we don't want to apply it multiple times)
								return snap.call(self, (n > max ? max + (n - max) * edgeTolerance : (n < min) ? min + (n - min) * edgeTolerance : n)) * factor;
							};
						}
						if (snap instanceof Array) {
							return function(n) {
								var i = snap.length,
									closest = 0,
									absDif = _max,
									val, dif;
								while (--i > -1) {
									val = snap[i];
									dif = val - n;
									if (dif < 0) {
										dif = -dif;
									}
									if (dif < absDif && val >= min && val <= max) {
										closest = i;
										absDif = dif;
									}
								}
								return snap[closest];
							};
						}
						return isNaN(snap) ? function(n) { return n; } : function() { return snap * factor; };
					},

				//called when the mouse is pressed (or touch starts)
					onPress = function(e) {
						var temp;
						if (self.isPressed || !e) { //just in case the browser dispatches a "touchstart" and "mousedown" (some browsers emulate mouse events when using touches)
							return;
						}
						interrupted = isTweening();
						self.pointerEvent = e;
						if (_touchEventLookup[e.type]) { //note: on iOS, BOTH touchmove and mousemove are dispatched, but the mousemove has pageY and pageX of 0 which would mess up the calculations and needlessly hurt performance.
							touchEventTarget = (e.type.indexOf("touch") !== -1) ? trigger : _doc; //pointer-based touches (for Microsoft browsers) don't remain locked to the original target like other browsers, so we must use the document instead. The event type would be "MSPointerDown" or "pointerdown".
							_addListener(touchEventTarget, "touchend", onRelease);
							_addListener(touchEventTarget, "touchmove", onMove);
							_addListener(touchEventTarget, "touchcancel", onRelease);
							_addListener(_doc, "touchstart", _onMultiTouchDocument);
						} else {
							touchEventTarget = null;
							_addListener(_doc, "mousemove", onMove); //attach these to the document instead of the box itself so that if the user's mouse moves too quickly (and off of the box), things still work.
							_addListener(_doc, "mouseup", onRelease);
						}
						isClicking = (_isClickable(e.target) && !vars.dragClickables);
						if (isClicking) {
							_addListener(e.target, "change", onRelease); //in some browsers, when you mousedown on a <select> element, no mouseup gets dispatched! So we listen for a "change" event instead.
							return;
						}
						if (_isOldIE) {
							e = _populateIEEvent(e, true);
						} else if (!(e.touches && e.touches.length > _dragCount + 1)) { //in some mobile browsers, e.preventDefault() when pressing on a link (or element with an onclick) will cause the link not to work.
							e.preventDefault();
							if (e.preventManipulation) {
								e.preventManipulation();  //for some Microsoft browsers
							}
						}
						if (e.changedTouches) { //touch events store the data slightly differently
							e = touch = e.changedTouches[0];
							touchID = e.identifier;
						} else if (e.pointerId) {
							touchID = e.pointerId; //for some Microsoft browsers
						} else {
							touch = null;
						}
						_dragCount++;
						_addToRenderQueue(render); //causes the Draggable to render on each "tick" of TweenLite.ticker (performance optimization - updating values in a mousemove can cause them to happen too frequently, like multiple times between frame redraws which is wasteful, and it also prevents values from updating properly in IE8)
						if (self.tween) {
							self.tween.kill();
						}
						TweenLite.killTweensOf(scrollProxy || target, true, killProps); //in case the user tries to drag it before the last tween is done.
						startMouseY = self.pointerY = e.pageY; //record the starting x and y so that we can calculate the movement from the original in _onMouseMove
						startMouseX = self.pointerX = e.pageX;
						recordStartPositions();
						if (matrix) {
							temp = startMouseX * matrix[0] + startMouseY * matrix[2] + matrix[4];
							startMouseY = startMouseX * matrix[1] + startMouseY * matrix[3] + matrix[5];
							startMouseX = temp;
						}
						self.tween = lockedAxis = null;
						if (!rotationMode && !scrollProxy && vars.zIndexBoost !== false) {
							target.style.zIndex = Draggable.zIndex++;
						}
						self.isPressed = true;
						hasDragCallback = !!(vars.onDrag || self._listeners.drag);
						if (!rotationMode) {
							_setStyle(trigger, "cursor", vars.cursor || "move");
						}
						_dispatchEvent(self, "press", "onPress");
					},

				//called every time the mouse/touch moves
					onMove = function(e) {
						if (_isMultiTouching || !self.isPressed) {
							return;
						}
						if (_isOldIE) {
							e = _populateIEEvent(e, true);
						} else {
							e.preventDefault();
							if (e.preventManipulation) { //for some Microsoft browsers
								e.preventManipulation();
							}
						}
						self.pointerEvent = e;
						var touches = e.changedTouches,
							dragTolerance = 1 - self.dragResistance,
							edgeTolerance = 1 - self.edgeResistance,
							xChange, yChange, x, y, i, dif, mouseX, mouseY, temp;
						if (touches) { //touch events store the data slightly differently
							e = touches[0];
							if (e !== touch && e.identifier !== touchID) { //Usually changedTouches[0] will be what we're looking for, but in case it's not, look through the rest of the array...(and Android browsers don't reuse the event like iOS)
								i = touches.length;
								while (--i > -1 && (e = touches[i]).identifier !== touchID) {}
								if (i < 0) {
									return;
								}
							}
						} else if (e.pointerId && touchID && e.pointerId !== touchID) { //for some Microsoft browsers, we must attach the listener to the doc rather than the trigger so that when the finger moves outside the bounds of the trigger, things still work. So if the event we're receiving has a pointerId that doesn't match the touchID, ignore it (for multi-touch)
							return;
						}
						mouseX = self.pointerX = e.pageX;
						mouseY = self.pointerY = e.pageY;

						if (rotationMode) {
							y = Math.atan2(rotationOrigin.y - e.pageY, e.pageX - rotationOrigin.x) * _RAD2DEG;
							dif = self.y - y;
							self.y = y;
							if (dif > 180) {
								startElementY -= 360;
							} else if (dif < -180) {
								startElementY += 360;
							}
							x = startElementX + (startElementY - y) * dragTolerance;

						} else {
							if (matrix) {
								temp = mouseX * matrix[0] + mouseY * matrix[2] + matrix[4];
								mouseY = mouseX * matrix[1] + mouseY * matrix[3] + matrix[5];
								mouseX = temp;
							}
							yChange = (mouseY - startMouseY);
							xChange = (mouseX - startMouseX);
							if (yChange < 2 && yChange > -2) {
								yChange = 0;
							}
							if (xChange < 2 && xChange > -2) {
								xChange = 0;
							}
							if (self.lockAxis && (xChange || yChange)) {
								if (lockedAxis === "y" || (!lockedAxis && Math.abs(xChange) > Math.abs(yChange) && allowX)) {
									yChange = 0;
									lockedAxis = "y";
								} else if (allowY) {
									xChange = 0;
									lockedAxis = "x";
								}
							}
							x = startElementX + xChange * dragTolerance;
							y = startElementY + yChange * dragTolerance;
						}

						if (snapX || snapY) {
							if (snapX) {
								x = snapX(x);
							}
							if (snapY) {
								y = snapY(y);
							}
						} else if (hasBounds) {
							if (x > maxX) {
								x = maxX + (x - maxX) * edgeTolerance;
							} else if (x < minX) {
								x = minX + (x - minX) * edgeTolerance;
							}
							if (!rotationMode) {
								if (y > maxY) {
									y = maxY + (y - maxY) * edgeTolerance;
								} else if (y < minY) {
									y = minY + (y - minY) * edgeTolerance;
								}
							}
						}
						if (self.x !== x || (self.y !== y && !rotationMode)) {
							self.x = self.endX = x;
							if (rotationMode) {
								self.endRotation = x;
							} else {
								self.y = self.endY = y;
							}
							dirty = true; //a flag that indicates we need to render the target next time the TweenLite.ticker dispatches a "tick" event (typically on a requestAnimationFrame) - this is a performance optimization (we shouldn't render on every move because sometimes many move events can get dispatched between screen refreshes, and that'd be wasteful to render every time)
							if (!self.isDragging) {
								self.isDragging = true;
								_dispatchEvent(self, "dragstart", "onDragStart");
							}
						}
					},

				//called when the mouse/touch is released
					onRelease = function(e, force) {
						if (e && touchID && !force && e.pointerId && e.pointerId !== touchID) {  //for some Microsoft browsers, we must attach the listener to the doc rather than the trigger so that when the finger moves outside the bounds of the trigger, things still work. So if the event we're receiving has a pointerId that doesn't match the touchID, ignore it (for multi-touch)
							return;
						}
						self.isPressed = false;
						var originalEvent = e,
							wasDragging = self.isDragging,
							touches, i;
						if (touchEventTarget) {
							_removeListener(touchEventTarget, "touchend", onRelease);
							_removeListener(touchEventTarget, "touchmove", onMove);
							_removeListener(touchEventTarget, "touchcancel", onRelease);
							_removeListener(_doc, "touchstart", _onMultiTouchDocument);
						} else {
							_removeListener(_doc, "mouseup", onRelease);
							_removeListener(_doc, "mousemove", onMove);
						}
						dirty = false;
						if (isClicking) {
							if (e) {
								_removeListener(e.target, "change", onRelease);
							}
							_dispatchEvent(self, "release", "onRelease");
							_dispatchEvent(self, "click", "onClick");
							isClicking = false;
							return;
						}
						_removeFromRenderQueue(render);
						if (!rotationMode) {
							_setStyle(trigger, "cursor", vars.cursor || "move");
						}
						if (wasDragging) {
							dragEndTime = _lastDragTime = _getTime();
							self.isDragging = false;
						}
						_dragCount--;
						if (e) {
							if (_isOldIE) {
								e = _populateIEEvent(e, false);
							}
							touches = e.changedTouches;
							if (touches) { //touch events store the data slightly differently
								e = touches[0];
								if (e !== touch && e.identifier !== touchID) { //Usually changedTouches[0] will be what we're looking for, but in case it's not, look through the rest of the array...(and Android browsers don't reuse the event like iOS)
									i = touches.length;
									while (--i > -1 && (e = touches[i]).identifier !== touchID) {}
									if (i < 0) {
										return;
									}
								}
							}
							self.pointerEvent = originalEvent;
							self.pointerX = e.pageX;
							self.pointerY = e.pageY;
						}
						if (originalEvent && !wasDragging) {
							if (interrupted && vars.snap) { //otherwise, if the user clicks on the object while it's animating to a snapped position, and then releases without moving 3 pixels, it will just stay there (it should animate/snap)
								animate(vars.throwProps);
							}
							_dispatchEvent(self, "release", "onRelease");
							_dispatchEvent(self, "click", "onClick");
						} else {
							animate(vars.throwProps); //will skip if throwProps isn't defined or ThrowPropsPlugin isn't loaded.
							if (!_isOldIE && originalEvent && (vars.dragClickables || !_isClickable(originalEvent.target))) {
								originalEvent.preventDefault();
								if (originalEvent.preventManipulation) {
									originalEvent.preventManipulation();  //for some Microsoft browsers
								}
							}
							_dispatchEvent(self, "release", "onRelease");
						}
						if (wasDragging) {
							_dispatchEvent(self, "dragend", "onDragEnd");
						}
						return true;
					},

					onClick = function(e) {
						if (self.isPressed || _getTime() - dragEndTime < 20) {
							if (e.preventDefault) {
								e.preventDefault();
							} else {
								e.returnValue = false;
							}
							if (e.preventManipulation) {
								e.preventManipulation();  //for some Microsoft browsers
							}
						}
					};

				old = Draggable.get(this.target);
				if (old) {
					old.kill(); // avoids duplicates (an element can only be controlled by one Draggable)
				}

				//give the user access to start/stop dragging...
				this.startDrag = function(e) {
					onPress(e);
					if (!self.isDragging) {
						self.isDragging = true;
						_dispatchEvent(self, "dragstart", "onDragStart");
					}
				};
				this.drag = onMove;
				this.endDrag = function(e) {
					onRelease(e, true);
				};
				this.timeSinceDrag = function() {
					return self.isDragging ? 0 : (_getTime() - dragEndTime) / 1000;
				};
				this.hitTest = function(target, threshold) {
					return Draggable.hitTest(self.target, target, threshold);
				};

				this.applyBounds = function(newBounds) {
					var x, y;
					if (newBounds && vars.bounds !== newBounds) {
						vars.bounds = newBounds;
						return self.update(true);
					}
					syncXY(true);
					calculateBounds();
					if (hasBounds) {
						x = self.x;
						y = self.y;
						if (hasBounds) {
							if (x > maxX) {
								x = maxX;
							} else if (x < minX) {
								x = minX;
							}
							if (y > maxY) {
								y = maxY;
							} else if (y < minY) {
								y = minY;
							}
						}
						if (self.x !== x || self.y !== y) {
							self.x = self.endX = x;
							if (rotationMode) {
								self.endRotation = x;
							} else {
								self.y = self.endY = y;
							}
							dirty = true;
							render();
						}
					}
					return self;
				};

				this.update = function(applyBounds) {
					var x = self.x,
						y = self.y;
					updateMatrix();
					if (applyBounds) {
						self.applyBounds();
					} else {
						syncXY(true);
					}
					if (self.isPressed && (x !== self.x || (y !== self.y && !rotationMode))) {
						recordStartPositions();
					}
					return self;
				};

				this.enable = function() {
					var id;
					_addListener(trigger, "mousedown", onPress);
					_addListener(trigger, "touchstart", onPress);
					_addListener(trigger, "click", onClick);
					if (!rotationMode) {
						_setStyle(trigger, "cursor", vars.cursor || "move");
					}
					trigger.ondragstart = trigger.onselectstart = _emptyFunc; //prevent text selection (and prevent IE from dragging images)
					_setStyle(trigger, "userSelect", "none");
					_setStyle(trigger, "touchCallout", "none");
					_setStyle(trigger, "touchAction", "none");
					if (ThrowPropsPlugin) {
						ThrowPropsPlugin.track(scrollProxy || target, (xyMode ? "x,y" : rotationMode ? "rotation" : "top,left"));
					}
					if (scrollProxy) {
						scrollProxy.enable();
					}
					target._gsDragID = id = "d" + (_lookupCount++);
					_lookup[id] = this;
					if (scrollProxy) {
						scrollProxy.element._gsDragID = id;
					}
					TweenLite.set(target, {x:"+=0"}); //simply ensures that there's a _gsTransform on the element.
					this.update();
					return self;
				};

				this.disable = function() {
					var dragging = this.isDragging;
					if (!rotationMode) {
						_setStyle(trigger, "cursor", null);
					}
					TweenLite.killTweensOf(scrollProxy || target, true, killProps);
					trigger.ondragstart = trigger.onselectstart = null;
					_setStyle(trigger, "userSelect", "text");
					_setStyle(trigger, "touchCallout", "default");
					_setStyle(trigger, "MSTouchAction", "auto");
					_removeListener(trigger, "mousedown", onPress);
					_removeListener(trigger, "touchstart", onPress);
					_removeListener(trigger, "click", onClick);
					if (touchEventTarget) {
						_removeListener(touchEventTarget, "touchcancel", onRelease);
						_removeListener(touchEventTarget, "touchend", onRelease);
						_removeListener(touchEventTarget, "touchmove", onMove);
					}
					_removeListener(_doc, "mouseup", onRelease);
					_removeListener(_doc, "mousemove", onMove);
					if (ThrowPropsPlugin) {
						ThrowPropsPlugin.untrack(scrollProxy || target, (xyMode ? "x,y" : rotationMode ? "rotation" : "top,left"));
					}
					if (scrollProxy) {
						scrollProxy.disable();
					}
					_removeFromRenderQueue(render);
					this.isDragging = this.isPressed = isClicking = false;
					if (dragging) {
						_dispatchEvent(this, "dragend", "onDragEnd");
					}
					return self;
				};

				this.kill = function() {
					self.disable();
					delete _lookup[target._gsDragID];
					return self;
				};

				if (type.indexOf("scroll") !== -1) {
					scrollProxy = this.scrollProxy = new ScrollProxy(target, _extend({onKill:function() { //ScrollProxy's onKill() gets called if/when the ScrollProxy senses that the user interacted with the scroll position manually (like using the scrollbar). IE9 doesn't fire the "mouseup" properly when users drag the scrollbar of an element, so this works around that issue.
						if (self.isPressed) {
							onRelease(null);
						}}}, vars));
					//a bug in many Android devices' stock browser causes scrollTop to get forced back to 0 after it is altered via JS, so we set overflow to "hidden" on mobile/touch devices (they hide the scroll bar anyway). That works around the bug. (This bug is discussed at https://code.google.com/p/android/issues/detail?id=19625)
					target.style.overflowY = (allowY && !_isTouchDevice) ? "auto" : "hidden";
					target.style.overflowX = (allowX && !_isTouchDevice) ? "auto" : "hidden";
					target = scrollProxy.content;
				}

				if (vars.force3D !== false) {
					TweenLite.set(target, {force3D:true}); //improve performance by forcing a GPU layer when possible
				}
				if (rotationMode) {
					killProps.rotation = 1;
				} else {
					if (allowX) {
						killProps[xProp] = 1;
					}
					if (allowY) {
						killProps[yProp] = 1;
					}
				}
				if (rotationMode) {
					tempVars = _tempVarsRotation;
					cssVars = tempVars.css;
					tempVars.overwrite = false;
				} else if (xyMode) {
					tempVars = (allowX && allowY) ? _tempVarsXY : allowX ? _tempVarsX : _tempVarsY;
					cssVars = tempVars.css;
					tempVars.overwrite = false;
				}

				this.enable();
			},
			p = Draggable.prototype = new EventDispatcher();

		// !!!!!!!!!!!!!!!!!!!!!!!!!**********************

		p.constructor = Draggable;
		p.pointerX = p.pointerY = 0;
		p.isDragging = p.isPressed = false;
		Draggable.version = "0.10.2";
		Draggable.zIndex = 1000;

		_addListener(_doc, "touchcancel", function() {
			//some older Android devices intermittently stop dispatching "touchmove" events if we don't listen for "touchcancel" on the document. Very strange indeed.
		});
		_addListener(_doc, "contextmenu", function(e) {
			var p;
			for (p in _lookup) {
				if (_lookup[p].isPressed) {
					_lookup[p].endDrag();
				}
			}
		});

		Draggable.create = function(targets, vars) {
			if (typeof(targets) === "string") {
				targets = TweenLite.selector(targets);
			}
			var a = _isArrayLike(targets) ? _flattenArray(targets) : [targets],
				i = a.length;
			while (--i > -1) {
				a[i] = new Draggable(a[i], vars);
			}
			return a;
		};

		Draggable.get = function(target) {
			return _lookup[(_unwrapElement(target) || {})._gsDragID];
		};

		Draggable.timeSinceDrag = function() {
			return (_getTime() - _lastDragTime) / 1000;
		};

		var _parseRect = function(e, undefined) { //accepts a DOM element, a mouse event, or a rectangle object and returns the corresponding rectangle with left, right, width, height, top, and bottom properties
			var r = (e.pageX !== undefined) ? {left:e.pageX, top:e.pageY, right:e.pageX + 1, bottom:e.pageY + 1} : (!e.nodeType && e.left !== undefined && e.top !== undefined) ? e : _unwrapElement(e).getBoundingClientRect();
			if (r.right === undefined && r.width !== undefined) {
				r.right = r.left + r.width;
				r.bottom = r.top + r.height;
			} else if (!r.width) { //some browsers don't include width and height properties
				r.width = r.right - r.left;
				r.height = r.bottom - r.top;
			}
			return r;
		};

		Draggable.hitTest = function(obj1, obj2, threshold) { //
			if (obj1 === obj2) {
				return false;
			}
			var r1 = _parseRect(obj1),
				r2 = _parseRect(obj2),
				isOutside = (r2.left > r1.right || r2.right < r1.left || r2.top > r1.bottom || r2.bottom < r1.top),
				overlap, area, isRatio;
			if (isOutside || !threshold) {
				return !isOutside;
			}
			isRatio = ((threshold + "").indexOf("%") !== -1);
			threshold = parseFloat(threshold) || 0;
			overlap = {left:Math.max(r1.left, r2.left), top:Math.max(r1.top, r2.top)};
			overlap.width = Math.min(r1.right, r2.right) - overlap.left;
			overlap.height = Math.min(r1.bottom, r2.bottom) - overlap.top;
			if (overlap.width < 0 || overlap.height < 0) {
				return false;
			}
			if (isRatio) {
				threshold *= 0.01;
				area = overlap.width * overlap.height;
				return (area >= r1.width * r1.height * threshold || area >= r2.width * r2.height * threshold);
			}
			return (overlap.width > threshold && overlap.height > threshold);
		};

		return Draggable;

	}, true);


}); if (window._gsDefine) { window._gsQueue.pop()(); };/*!
 * VERSION: 0.9.5
 * DATE: 2014-04-16
 * UPDATES AND DOCS AT: http://www.greensock.com
 *
 * @license Copyright (c) 2008-2014, GreenSock. All rights reserved.
 * ThrowPropsPlugin is a Club GreenSock membership benefit; You must have a valid membership to use
 * this code without violating the terms of use. Visit http://www.greensock.com/club/ to sign up or get more details.
 * This work is subject to the software agreement that was issued with your membership.
 * 
 * @author: Jack Doyle, jack@greensock.com
 */
(window._gsQueue || (window._gsQueue = [])).push( function() {

	"use strict";

	window._gsDefine("plugins.ThrowPropsPlugin", ["plugins.TweenPlugin", "TweenLite", "easing.Ease", "utils.VelocityTracker"], function(TweenPlugin, TweenLite, Ease, VelocityTracker) {

		var ThrowPropsPlugin = function(props, priority) {
				TweenPlugin.call(this, "throwProps");
				this._overwriteProps.length = 0;
			},
			_max = 999999999999999,
			_min = 0.0000000001,
			_recordEndMode = false,//in a typcial throwProps css tween that has an "end" defined as a function, it grabs that value initially when the tween is rendered, then again when we calculate the necessary duration, and then a 3rd time after we invalidate() the tween, so we toggle _recordEndMode to true when we're about to begin such a tween which tells the engine to grab the end value(s) once and record them as "max" and "min" on the throwProps object, thus we can skip those extra calls. Then we set it back to false when we're done with our fancy initialization routine.
			_transforms = {x:1,y:1,z:2,scale:1,scaleX:1,scaleY:1,rotation:1,rotationZ:1,rotationX:2,rotationY:2,skewX:1,skewY:1},
			_getClosest = function(n, values, max, min) {
				var i = values.length,
					closest = 0,
					absDif = _max,
					val, dif;
				while (--i > -1) {
					val = values[i];
					dif = val - n;
					if (dif < 0) {
						dif = -dif;
					}
					if (dif < absDif && val >= min && val <= max) {
						closest = i;
						absDif = dif;
					}
				}
				return values[closest];
			},
			_parseEnd = function(curProp, end, max, min) {
				if (curProp.end === "auto") {
					return curProp;
				}
				max = isNaN(max) ? _max : max;
				min = isNaN(min) ? -_max : min;
				var adjustedEnd = (typeof(curProp.end) === "function") ? curProp.end(end) : (curProp.end instanceof Array) ? _getClosest(end, curProp.end, max, min) : Number(curProp.end);
				if (adjustedEnd > max) {
					adjustedEnd = max;
				} else if (adjustedEnd < min) {
					adjustedEnd = min;
				}
				return {max:adjustedEnd, min:adjustedEnd, unitFactor:curProp.unitFactor};
			},
			_extend = function(decoratee, extras, exclude) {
				for (var p in extras) {
					if (decoratee[p] === undefined && p !== exclude) {
						decoratee[p] = extras[p];
					}
				}
				return decoratee;
			},
			_calculateChange = ThrowPropsPlugin.calculateChange = function(velocity, ease, duration, checkpoint) {
				if (checkpoint == null) {
					checkpoint = 0.05;
				}
				var e = (ease instanceof Ease) ? ease : (!ease) ? TweenLite.defaultEase : new Ease(ease);
				return (duration * checkpoint * velocity) / e.getRatio(checkpoint);
			},
			_calculateDuration = ThrowPropsPlugin.calculateDuration = function(start, end, velocity, ease, checkpoint) {
				checkpoint = checkpoint || 0.05;
				var e = (ease instanceof Ease) ? ease : (!ease) ? TweenLite.defaultEase : new Ease(ease);
				return Math.abs( (end - start) * e.getRatio(checkpoint) / velocity / checkpoint );
			},
			_calculateTweenDuration = ThrowPropsPlugin.calculateTweenDuration = function(target, vars, maxDuration, minDuration, overshootTolerance, recordEnd) {
				if (typeof(target) === "string") {
					target = TweenLite.selector(target);
				}
				if (!target) {
					return 0;
				}
				if (maxDuration == null) {
					maxDuration = 10;
				}
				if (minDuration == null) {
					minDuration = 0.2;
				}
				if (overshootTolerance == null) {
					overshootTolerance = 1;
				}
				if (target.length) {
					target = target[0] || target;
				}
				var duration = 0,
					clippedDuration = 9999999999,
					throwPropsVars = vars.throwProps || vars,
					ease = (vars.ease instanceof Ease) ? vars.ease : (!vars.ease) ? TweenLite.defaultEase : new Ease(vars.ease),
					checkpoint = isNaN(throwPropsVars.checkpoint) ? 0.05 : Number(throwPropsVars.checkpoint),
					resistance = isNaN(throwPropsVars.resistance) ? ThrowPropsPlugin.defaultResistance : Number(throwPropsVars.resistance),
					p, curProp, curDuration, curVelocity, curResistance, curVal, end, curClippedDuration, tracker, unitFactor;

				for (p in throwPropsVars) {

					if (p !== "resistance" && p !== "checkpoint" && p !== "preventOvershoot") {
						curProp = throwPropsVars[p];
						if (typeof(curProp) !== "object") {
							tracker = tracker || VelocityTracker.getByTarget(target);
							if (tracker && tracker.isTrackingProp(p)) {
								curProp = (typeof(curProp) === "number") ? {velocity:curProp} : {velocity:tracker.getVelocity(p)}; //if we're tracking this property, we should use the tracking velocity and then use the numeric value that was passed in as the min and max so that it tweens exactly there.
							} else {
								curVelocity = Number(curProp) || 0;
								curDuration = (curVelocity * resistance > 0) ? curVelocity / resistance : curVelocity / -resistance;
							}
						}
						if (typeof(curProp) === "object") {
							if (curProp.velocity !== undefined && typeof(curProp.velocity) === "number") {
								curVelocity = Number(curProp.velocity) || 0;
							} else {
								tracker = tracker || VelocityTracker.getByTarget(target);
								curVelocity =  (tracker && tracker.isTrackingProp(p)) ? tracker.getVelocity(p) : 0;
							}
							curResistance = isNaN(curProp.resistance) ? resistance : Number(curProp.resistance);
							curDuration = (curVelocity * curResistance > 0) ? curVelocity / curResistance : curVelocity / -curResistance;
							curVal = (typeof(target[p]) === "function") ? target[ ((p.indexOf("set") || typeof(target["get" + p.substr(3)]) !== "function") ? p : "get" + p.substr(3)) ]() : target[p] || 0;
							end = curVal + _calculateChange(curVelocity, ease, curDuration, checkpoint);
							if (curProp.end !== undefined) {
								curProp = _parseEnd(curProp, end, curProp.max, curProp.min);
								if (recordEnd || _recordEndMode) {
									throwPropsVars[p] = _extend(curProp, throwPropsVars[p], "end");
								}
							}
							if (curProp.max !== undefined && end > Number(curProp.max) + _min) {
								unitFactor = curProp.unitFactor || ThrowPropsPlugin.defaultUnitFactors[p] || 1; //some values are measured in special units like radians in which case our thresholds need to be adjusted accordingly.
								//if the value is already exceeding the max or the velocity is too low, the duration can end up being uncomfortably long but in most situations, users want the snapping to occur relatively quickly (0.75 seconds), so we implement a cap here to make things more intuitive. If the max and min match, it means we're animating to a particular value and we don't want to shorten the time unless the velocity is really slow. Example: a rotation where the start and natural end value are less than the snapping spot, but the natural end is pretty close to the snap.
								curClippedDuration = ((curVal > curProp.max && curProp.min !== curProp.max) || (curVelocity * unitFactor > -15 && curVelocity * unitFactor < 45)) ? (minDuration + (maxDuration - minDuration) * 0.1) : _calculateDuration(curVal, curProp.max, curVelocity, ease, checkpoint);
								if (curClippedDuration + overshootTolerance < clippedDuration) {
									clippedDuration = curClippedDuration + overshootTolerance;
								}

							} else if (curProp.min !== undefined && end < Number(curProp.min) - _min) {
								unitFactor = curProp.unitFactor || ThrowPropsPlugin.defaultUnitFactors[p] || 1; //some values are measured in special units like radians in which case our thresholds need to be adjusted accordingly.
								//if the value is already exceeding the min or if the velocity is too low, the duration can end up being uncomfortably long but in most situations, users want the snapping to occur relatively quickly (0.75 seconds), so we implement a cap here to make things more intuitive.
								curClippedDuration = ((curVal < curProp.min && curProp.min !== curProp.max) || (curVelocity * unitFactor > -45 && curVelocity * unitFactor < 15)) ? (minDuration + (maxDuration - minDuration) * 0.1) : _calculateDuration(curVal, curProp.min, curVelocity, ease, checkpoint);
								if (curClippedDuration + overshootTolerance < clippedDuration) {
									clippedDuration = curClippedDuration + overshootTolerance;
								}
							}

							if (curClippedDuration > duration) {
								duration = curClippedDuration;
							}
						}

						if (curDuration > duration) {
							duration = curDuration;
						}

					}
				}
				if (duration > clippedDuration) {
					duration = clippedDuration;
				}
				if (duration > maxDuration) {
					return maxDuration;
				} else if (duration < minDuration) {
					return minDuration;
				}
				return duration;
			},
			p = ThrowPropsPlugin.prototype = new TweenPlugin("throwProps"),
			_cssProxy, _cssVars, _last, _lastValue; //these serve as a cache of sorts, recording the last css-related proxy and the throwProps vars that get calculated in the _cssRegister() method. This allows us to grab them in the ThrowPropsPlugin.to() function and calculate the duration. Of course we could have structured things in a more "clean" fashion, but performance is of paramount importance.



		p.constructor = ThrowPropsPlugin;
		ThrowPropsPlugin.version = "0.9.5";
		ThrowPropsPlugin.API = 2;
		ThrowPropsPlugin._autoCSS = true; //indicates that this plugin can be inserted into the "css" object using the autoCSS feature of TweenLite
		ThrowPropsPlugin.defaultResistance = 100;
		ThrowPropsPlugin.defaultUnitFactors = {time:1000, totalTime:1000}; //setting the unitFactor to a higher value (default is 1) reduces the chance of the auto-accelerating behavior kicking in when determining durations when the initial velocity is adequately low - imagine dragging something past a boundary and then letting go - snapping back relatively quickly should be prioritized over matching the initial velocity (at least that's the behavior most people consider intuitive). But in some situations when the units are very low (like "time" of a timeline or rotation when using radians), it can kick in too frequently so this allows tweaking.

		ThrowPropsPlugin.track = function(target, props, types) {
			return VelocityTracker.track(target, props, types);
		};

		ThrowPropsPlugin.untrack = function(target, props) {
			VelocityTracker.untrack(target, props);
		};

		ThrowPropsPlugin.isTracking = function(target, prop) {
			return VelocityTracker.isTracking(target, prop);
		};

		ThrowPropsPlugin.getVelocity = function(target, prop) {
			var vt = VelocityTracker.getByTarget(target);
			return vt ? vt.getVelocity(prop) : NaN;
		};

		ThrowPropsPlugin._cssRegister = function() {
			var CSSPlugin = (window.GreenSockGlobals || window).com.greensock.plugins.CSSPlugin;
			if (!CSSPlugin) {
				return;
			}
			var _internals = CSSPlugin._internals,
				_parseToProxy = _internals._parseToProxy,
				_setPluginRatio = _internals._setPluginRatio,
				CSSPropTween = _internals.CSSPropTween;
			_internals._registerComplexSpecialProp("throwProps", {parser:function(t, e, prop, cssp, pt, plugin) {
				plugin = new ThrowPropsPlugin();
				var velocities = {},
					min = {},
					max = {},
					end = {},
					res = {},
					preventOvershoot = {},
					hasResistance, val, p, data, tracker;
				_cssVars = {};
				for (p in e) {
					if (p !== "resistance" && p !== "preventOvershoot") {
						val = e[p];
						if (typeof(val) === "object") {
							if (val.velocity !== undefined && typeof(val.velocity) === "number") {
								velocities[p] = Number(val.velocity) || 0;
							} else {
								tracker = tracker || VelocityTracker.getByTarget(t);
								velocities[p] = (tracker && tracker.isTrackingProp(p)) ? tracker.getVelocity(p) : 0; //rotational values are actually converted to radians in CSSPlugin, but our tracking velocity is in radians already, so make it into degrees to avoid a funky conversion
							}
							if (val.end !== undefined) {
								end[p] = val.end;
							}
							if (val.min !== undefined) {
								min[p] = val.min;
							}
							if (val.max !== undefined) {
								max[p] = val.max;
							}
							if (val.preventOvershoot) {
								preventOvershoot[p] = true;
							}
							if (val.resistance !== undefined) {
								hasResistance = true;
								res[p] = val.resistance;
							}
						} else if (typeof(val) === "number") {
							velocities[p] = val;
						} else {
							tracker = tracker || VelocityTracker.getByTarget(t);
							if (tracker && tracker.isTrackingProp(p)) {
								velocities[p] = tracker.getVelocity(p);
							} else {
								velocities[p] = val || 0;
							}
						}
						if (_transforms[p]) {
							cssp._enableTransforms((_transforms[p] === 2));
						}
					}
				}
				data = _parseToProxy(t, velocities, cssp, pt, plugin);
				_cssProxy = data.proxy;
				velocities = data.end;
				for (p in _cssProxy) {
					_cssVars[p] = {velocity:velocities[p], min:min[p], max:max[p], end:end[p], resistance:res[p], preventOvershoot:preventOvershoot[p]};
				}
				if (e.resistance != null) {
					_cssVars.resistance = e.resistance;
				}
				if (e.preventOvershoot) {
					_cssVars.preventOvershoot = true;
				}
				pt = new CSSPropTween(t, "throwProps", 0, 0, data.pt, 2);
				pt.plugin = plugin;
				pt.setRatio = _setPluginRatio;
				pt.data = data;
				plugin._onInitTween(_cssProxy, _cssVars, cssp._tween);
				return pt;
			}});
		};


		ThrowPropsPlugin.to = function(target, vars, maxDuration, minDuration, overshootTolerance) {
			if (!vars.throwProps) {
				vars = {throwProps:vars};
			}
			if (overshootTolerance === 0) {
				vars.throwProps.preventOvershoot = true;
			}
			_recordEndMode = true; //if we encounter a function-based "end" value, ThrowPropsPlugin will record it as "max" and "min" properties, replacing "end" (this is an optimization so that the function only gets called once)
			var tween = new TweenLite(target, 1, vars);
			tween.render(0, true, true); //we force a render so that the CSSPlugin instantiates and populates the _cssProxy and _cssVars which we need in order to calculate the tween duration. Remember, we can't use the regular target for calculating the duration because the current values wouldn't be able to be grabbed like target["propertyName"], as css properties can be complex like boxShadow:"10px 10px 20px 30px red" or backgroundPosition:"25px 50px". The proxy is the result of breaking all that complex data down and finding just the numeric values and assigning them to a generic proxy object with unique names. THAT is what the _calculateTweenDuration() can look at. We also needed to do the same break down of any min or max or velocity data
			if (tween.vars.css) {
				tween.duration(_calculateTweenDuration(_cssProxy, {throwProps:_cssVars, ease:vars.ease}, maxDuration, minDuration, overshootTolerance));
				if (tween._delay && !tween.vars.immediateRender) {
					tween.invalidate(); //if there's a delay, the starting values could be off, so invalidate() to force reinstantiation when the tween actually starts.
				} else {
					_last._onInitTween(_cssProxy, _lastValue, tween);
				}
				_recordEndMode = false;
				return tween;
			} else {
				tween.kill();
				tween = new TweenLite(target, _calculateTweenDuration(target, vars, maxDuration, minDuration, overshootTolerance), vars);
				_recordEndMode = false;
				return tween;
			}
		};

		p._onInitTween = function(target, value, tween) {
			this.target = target;
			this._props = [];
			_last = this;
			_lastValue = value;
			var ease = tween._ease,
				checkpoint = isNaN(value.checkpoint) ? 0.05 : Number(value.checkpoint),
				duration = tween._duration,
				preventOvershoot = value.preventOvershoot,
				cnt = 0,
				p, curProp, curVal, isFunc, velocity, change1, end, change2, tracker;
			for (p in value) {
				if (p !== "resistance" && p !== "checkpoint" && p !== "preventOvershoot") {
					curProp = value[p];
					if (typeof(curProp) === "number") {
						velocity = Number(curProp) || 0;
					} else if (typeof(curProp) === "object" && !isNaN(curProp.velocity)) {
						velocity = Number(curProp.velocity);
					} else {
						tracker = tracker || VelocityTracker.getByTarget(target);
						if (tracker && tracker.isTrackingProp(p)) {
							velocity = tracker.getVelocity(p);
						} else {
							throw("ERROR: No velocity was defined in the throwProps tween of " + target + " property: " + p);
						}
					}
					change1 = _calculateChange(velocity, ease, duration, checkpoint);
					change2 = 0;
					isFunc = (typeof(target[p]) === "function");
					curVal = (isFunc) ? target[ ((p.indexOf("set") || typeof(target["get" + p.substr(3)]) !== "function") ? p : "get" + p.substr(3)) ]() : target[p];
					if (typeof(curProp) === "object") {
						end = curVal + change1;
						if (curProp.end !== undefined) {
							curProp = _parseEnd(curProp, end, curProp.max, curProp.min);
							if (_recordEndMode) {
								value[p] = _extend(curProp, value[p], "end");
							}
						}
						if (curProp.max !== undefined && Number(curProp.max) < end) {
							if (preventOvershoot || curProp.preventOvershoot) {
								change1 = curProp.max - curVal;
							} else {
								change2 = (curProp.max - curVal) - change1;
							}
						} else if (curProp.min !== undefined && Number(curProp.min) > end) {
							if (preventOvershoot || curProp.preventOvershoot) {
								change1 = curProp.min - curVal;
							} else {
								change2 = (curProp.min - curVal) - change1;
							}
						}
					}
					this._props[cnt++] = {p:p, s:curVal, c1:change1, c2:change2, f:isFunc, r:false};
					this._overwriteProps[cnt] = p;
				}
			}
			return true;
		};

		p._kill = function(lookup) {
			var i = this._props.length;
			while (--i > -1) {
				if (lookup[this._props[i].p] != null) {
					this._props.splice(i, 1);
				}
			}
			return TweenPlugin.prototype._kill.call(this, lookup);
		};

		p._roundProps = function(lookup, value) {
			var p = this._props,
				i = p.length;
			while (--i > -1) {
				if (lookup[p[i]] || lookup.throwProps) {
					p[i].r = value;
				}
			}
		};

		p.setRatio = function(v) {
			var i = this._props.length,
				cp, val;
			while (--i > -1) {
				cp = this._props[i];
				val = cp.s + cp.c1 * v + cp.c2 * v * v;
				if (cp.r) {
					val = Math.round(val);
				}
				if (cp.f) {
					this.target[cp.p](val);
				} else {
					this.target[cp.p] = val;
				}
			}
		};

		TweenPlugin.activate([ThrowPropsPlugin]);

		return ThrowPropsPlugin;

	}, true);



	/*
	 * ----------------------------------------------------------------
	 * VelocityTracker
	 * ----------------------------------------------------------------
	 */
	window._gsDefine("utils.VelocityTracker", ["TweenLite"], function(TweenLite) {

		var _first,	_initted, _time1, _time2,
			_capsExp = /([A-Z])/g,
			_empty = {},
			_transforms = {x:1,y:1,z:2,scale:1,scaleX:1,scaleY:1,rotation:1,rotationZ:1,rotationX:2,rotationY:2,skewX:1,skewY:1},
			_getComputedStyle = document.defaultView ? document.defaultView.getComputedStyle : function() {},
			_getStyle = function(t, p, cs) {
				var rv = (t._gsTransform || _empty)[p];
				if (rv || rv === 0) {
					return rv;
				} else if (t.style[p]) {
					rv = t.style[p];
				} else if ((cs = cs || _getComputedStyle(t, null))) {
					t = cs.getPropertyValue(p.replace(_capsExp, "-$1").toLowerCase());
					rv = (t || cs.length) ? t : cs[p]; //Opera behaves VERY strangely - length is usually 0 and cs[p] is the only way to get accurate results EXCEPT when checking for -o-transform which only works with cs.getPropertyValue()!
				} else if (t.currentStyle) {
					cs = t.currentStyle;
					rv = cs[p];
				}
				return parseFloat(rv) || 0;
			},
			_ticker = TweenLite.ticker,
			VelocityProp = function(p, isFunc, next) {
				this.p = p;
				this.f = isFunc;
				this.v1 = this.v2 = 0;
				this.t1 = this.t2 = _ticker.time;
				this.css = false;
				this.type = "";
				this._prev = null;
				if (next) {
					this._next = next;
					next._prev = this;
				}
			},
			_update = function() {
				var vt = _first,
					t = _ticker.time,
					val, vp;
				//if the frame rate is too high, we won't be able to track the velocity as well, so only update the values about 33 times per second
				if (t - _time1 >= 0.03) {
					_time2 = _time1;
					_time1 = t;
					while (vt) {
						vp = vt._firstVP;
						while (vp) {
							val = vp.css ? _getStyle(vt.target, vp.p) : vp.f ? vt.target[vp.p]() : vt.target[vp.p];
							if (val !== vp.v1 || t - vp.t1 > 0.15) { //use a threshold of 0.15 seconds for zeroing-out velocity. If we only use 0.03 and things update slightly slower, like some Android devices dispatch "touchmove" events sluggishly so 2 or 3 ticks of the TweenLite.ticker may elapse inbetween, thus it may appear like the object is not moving but it actually is but it's not updating as frequently. A threshold of 0.15 seconds seems to be a good balance. We want to update things frequently (0.03 seconds) when they're moving so that we can respond to fast motions accurately, but we want to be more resistant to go back to a zero velocity.
								vp.v2 = vp.v1;
								vp.v1 = val;
								vp.t2 = vp.t1;
								vp.t1 = t;
							}
							vp = vp._next;
						}
						vt = vt._next;
					}
				}
			},
			VelocityTracker = function(target) {
				this._lookup = {};
				this.target = target;
				this.elem = (target.style && target.nodeType) ? true : false;
				if (!_initted) {
					_ticker.addEventListener("tick", _update, null, false, -100);
					_time1 = _time2 = _ticker.time;
					_initted = true;
				}
				if (_first) {
					this._next = _first;
					_first._prev = this;
				}
				_first = this;
			},
			getByTarget = VelocityTracker.getByTarget = function(target) {
				var vt = _first;
				while (vt) {
					if (vt.target === target) {
						return vt;
					}
					vt = vt._next;
				}
			},
			p = VelocityTracker.prototype;

		p.addProp = function(prop, type) {
			if (!this._lookup[prop]) {
				var t = this.target,
					isFunc = (typeof(t[prop]) === "function"),
					alt = isFunc ? this._altProp(prop) : prop,
					vp = this._firstVP;
				this._firstVP = this._lookup[prop] = this._lookup[alt] = vp = new VelocityProp((alt !== prop && prop.indexOf("set") === 0) ? alt : prop, isFunc, vp);
				vp.css = (this.elem && (this.target.style[vp.p] !== undefined || _transforms[vp.p]));
				if (vp.css && _transforms[vp.p] && !t._gsTransform) {
					TweenLite.set(t, {x:"+=0"}); //just forces CSSPlugin to create a _gsTransform for the element if it doesn't exist
				}
				vp.type = type || (vp.css && prop.indexOf("rotation") === 0) ? "deg" : "";
				vp.v1 = vp.v2 = vp.css ? _getStyle(t, vp.p) : isFunc ? t[vp.p]() : t[vp.p];
			}
		};

		p.removeProp = function(prop) {
			var vp = this._lookup[prop];
			if (vp) {
				if (vp._prev) {
					vp._prev._next = vp._next;
				} else if (vp === this._firstVP) {
					this._firstVP = vp._next;
				}
				if (vp._next) {
					vp._next._prev = vp._prev;
				}
				this._lookup[prop] = 0;
				if (vp.f) {
					this._lookup[this._altProp(prop)] = 0; //if it's a getter/setter, we should remove the matching counterpart (if one exists)
				}
			}
		};

		p.isTrackingProp = function(prop) {
			return (this._lookup[prop] instanceof VelocityProp);
		};

		p.getVelocity = function(prop) {
			var vp = this._lookup[prop],
				target = this.target,
				val, dif, rotationCap;
			if (!vp) {
				throw "The velocity of " + prop + " is not being tracked.";
			}
			val = vp.css ? _getStyle(target, vp.p) : vp.f ? target[vp.p]() : target[vp.p];
			dif = (val - vp.v2);
			if (vp.type === "rad" || vp.type === "deg") { //rotational values need special interpretation so that if, for example, they go from 179 to -178 degrees it is interpreted as a change of 3 instead of -357.
				rotationCap = (vp.type === "rad") ? Math.PI * 2 : 360;
				dif = dif % rotationCap;
				if (dif !== dif % (rotationCap / 2)) {
					dif = (dif < 0) ? dif + rotationCap : dif - rotationCap;
				}
			}
			return dif / (_ticker.time - vp.t2);
		};

		p._altProp = function(p) { //for getters/setters like getCustomProp() and setCustomProp() - we should accommodate both
			var pre = p.substr(0, 3),
				alt = ((pre === "get") ? "set" : (pre === "set") ? "get" : pre) + p.substr(3);
			return (typeof(this.target[alt]) === "function") ? alt : p;
		};

		VelocityTracker.getByTarget = function(target) {
			var vt = _first;
			if (typeof(target) === "string") {
				target = TweenLite.selector(target);
			}
			if (target.length && target !== window && target[0] && target[0].style && !target.nodeType) {
				target = target[0];
			}
			while (vt) {
				if (vt.target === target) {
					return vt;
				}
				vt = vt._next;
			}
		};

		VelocityTracker.track = function(target, props, types) {
			var vt = getByTarget(target),
				a = props.split(","),
				i = a.length;
			types = (types || "").split(",");
			if (!vt) {
				vt = new VelocityTracker(target);
			}
			while (--i > -1) {
				vt.addProp(a[i], types[i] || types[0]);
			}
			return vt;
		};

		VelocityTracker.untrack = function(target, props) {
			var vt = getByTarget(target),
				a = (props || "").split(","),
				i = a.length;
			if (!vt) {
				return;
			}
			while (--i > -1) {
				vt.removeProp(a[i]);
			}
			if (!vt._firstVP || !props) {
				if (vt._prev) {
					vt._prev._next = vt._next;
				} else if (vt === _first) {
					_first = vt._next;
				}
				if (vt._next) {
					vt._next._prev = vt._prev;
				}
			}
		};

		VelocityTracker.isTracking = function(target, prop) {
			var vt = getByTarget(target);
			return (!vt) ? false : (!prop && vt._firstVP) ? true : vt.isTrackingProp(prop);
		};

		return VelocityTracker;

	}, true);


}); if (window._gsDefine) { window._gsQueue.pop()(); };/*!
 * VERSION: 1.7.3
 * DATE: 2014-01-14
 * UPDATES AND DOCS AT: http://www.greensock.com
 *
 * @license Copyright (c) 2008-2014, GreenSock. All rights reserved.
 * This work is subject to the terms at http://www.greensock.com/terms_of_use.html or for
 * Club GreenSock members, the software agreement that was issued with your membership.
 * 
 * @author: Jack Doyle, jack@greensock.com
 **/
(window._gsQueue||(window._gsQueue=[])).push(function(){"use strict";var t=document.documentElement,e=window,i=function(i,s){var r="x"===s?"Width":"Height",n="scroll"+r,a="client"+r,o=document.body;return i===e||i===t||i===o?Math.max(t[n],o[n])-(e["inner"+r]||Math.max(t[a],o[a])):i[n]-i["offset"+r]},s=window._gsDefine.plugin({propName:"scrollTo",API:2,version:"1.7.3",init:function(t,s,r){return this._wdw=t===e,this._target=t,this._tween=r,"object"!=typeof s&&(s={y:s}),this._autoKill=s.autoKill!==!1,this.x=this.xPrev=this.getX(),this.y=this.yPrev=this.getY(),null!=s.x?(this._addTween(this,"x",this.x,"max"===s.x?i(t,"x"):s.x,"scrollTo_x",!0),this._overwriteProps.push("scrollTo_x")):this.skipX=!0,null!=s.y?(this._addTween(this,"y",this.y,"max"===s.y?i(t,"y"):s.y,"scrollTo_y",!0),this._overwriteProps.push("scrollTo_y")):this.skipY=!0,!0},set:function(t){this._super.setRatio.call(this,t);var s=this._wdw||!this.skipX?this.getX():this.xPrev,r=this._wdw||!this.skipY?this.getY():this.yPrev,n=r-this.yPrev,a=s-this.xPrev;this._autoKill&&(!this.skipX&&(a>7||-7>a)&&i(this._target,"x")>s&&(this.skipX=!0),!this.skipY&&(n>7||-7>n)&&i(this._target,"y")>r&&(this.skipY=!0),this.skipX&&this.skipY&&this._tween.kill()),this._wdw?e.scrollTo(this.skipX?s:this.x,this.skipY?r:this.y):(this.skipY||(this._target.scrollTop=this.y),this.skipX||(this._target.scrollLeft=this.x)),this.xPrev=this.x,this.yPrev=this.y}}),r=s.prototype;s.max=i,r.getX=function(){return this._wdw?null!=e.pageXOffset?e.pageXOffset:null!=t.scrollLeft?t.scrollLeft:document.body.scrollLeft:this._target.scrollLeft},r.getY=function(){return this._wdw?null!=e.pageYOffset?e.pageYOffset:null!=t.scrollTop?t.scrollTop:document.body.scrollTop:this._target.scrollTop},r._kill=function(t){return t.scrollTo_x&&(this.skipX=!0),t.scrollTo_y&&(this.skipY=!0),this._super._kill.call(this,t)}}),window._gsDefine&&window._gsQueue.pop()();;/*!
 * @license PreloadJS
 * Visit http://createjs.com/ for documentation, updates and examples.
 *
 * Copyright (c) 2011-2013 gskinner.com, inc.
 *
 * Distributed under the terms of the MIT license.
 * http://www.opensource.org/licenses/mit-license.html
 *
 * This notice shall be included in all copies or substantial portions of the Software.
 */

// namespace:
this.createjs = this.createjs||{};

(function() {
	"use strict";

	/**
	 * Contains properties and methods shared by all events for use with
	 * {{#crossLink "EventDispatcher"}}{{/crossLink}}.
	 *
	 * Note that Event objects are often reused, so you should never
	 * rely on an event object's state outside of the call stack it was received in.
	 * @class Event
	 * @param {String} type The event type.
	 * @param {Boolean} bubbles Indicates whether the event will bubble through the display list.
	 * @param {Boolean} cancelable Indicates whether the default behaviour of this event can be cancelled.
	 * @constructor
	 **/
	var Event = function(type, bubbles, cancelable) {
		this.initialize(type, bubbles, cancelable);
	};
	var p = Event.prototype;

// events:

// public properties:

	/**
	 * The type of event.
	 * @property type
	 * @type String
	 **/
	p.type = null;

	/**
	 * The object that generated an event.
	 * @property target
	 * @type Object
	 * @default null
	 * @readonly
	 */
	p.target = null;

	/**
	 * The current target that a bubbling event is being dispatched from. For non-bubbling events, this will
	 * always be the same as target. For example, if childObj.parent = parentObj, and a bubbling event
	 * is generated from childObj, then a listener on parentObj would receive the event with
	 * target=childObj (the original target) and currentTarget=parentObj (where the listener was added).
	 * @property currentTarget
	 * @type Object
	 * @default null
	 * @readonly
	 */
	p.currentTarget = null;

	/**
	 * For bubbling events, this indicates the current event phase:<OL>
	 * 	<LI> capture phase: starting from the top parent to the target</LI>
	 * 	<LI> at target phase: currently being dispatched from the target</LI>
	 * 	<LI> bubbling phase: from the target to the top parent</LI>
	 * </OL>
	 * @property eventPhase
	 * @type Number
	 * @default 0
	 * @readonly
	 */
	p.eventPhase = 0;

	/**
	 * Indicates whether the event will bubble through the display list.
	 * @property bubbles
	 * @type Boolean
	 * @default false
	 * @readonly
	 */
	p.bubbles = false;

	/**
	 * Indicates whether the default behaviour of this event can be cancelled via
	 * {{#crossLink "Event/preventDefault"}}{{/crossLink}}. This is set via the Event constructor.
	 * @property cancelable
	 * @type Boolean
	 * @default false
	 * @readonly
	 */
	p.cancelable = false;

	/**
	 * The epoch time at which this event was created.
	 * @property timeStamp
	 * @type Number
	 * @default 0
	 * @readonly
	 */
	p.timeStamp = 0;

	/**
	 * Indicates if {{#crossLink "Event/preventDefault"}}{{/crossLink}} has been called
	 * on this event.
	 * @property defaultPrevented
	 * @type Boolean
	 * @default false
	 * @readonly
	 */
	p.defaultPrevented = false;

	/**
	 * Indicates if {{#crossLink "Event/stopPropagation"}}{{/crossLink}} or
	 * {{#crossLink "Event/stopImmediatePropagation"}}{{/crossLink}} has been called on this event.
	 * @property propagationStopped
	 * @type Boolean
	 * @default false
	 * @readonly
	 */
	p.propagationStopped = false;

	/**
	 * Indicates if {{#crossLink "Event/stopImmediatePropagation"}}{{/crossLink}} has been called
	 * on this event.
	 * @property immediatePropagationStopped
	 * @type Boolean
	 * @default false
	 * @readonly
	 */
	p.immediatePropagationStopped = false;

	/**
	 * Indicates if {{#crossLink "Event/remove"}}{{/crossLink}} has been called on this event.
	 * @property removed
	 * @type Boolean
	 * @default false
	 * @readonly
	 */
	p.removed = false;

// constructor:
	/**
	 * Initialization method.
	 * @method initialize
	 * @param {String} type The event type.
	 * @param {Boolean} bubbles Indicates whether the event will bubble through the display list.
	 * @param {Boolean} cancelable Indicates whether the default behaviour of this event can be cancelled.
	 * @protected
	 **/
	p.initialize = function(type, bubbles, cancelable) {
		this.type = type;
		this.bubbles = bubbles;
		this.cancelable = cancelable;
		this.timeStamp = (new Date()).getTime();
	};

// public methods:

	/**
	 * Sets {{#crossLink "Event/defaultPrevented"}}{{/crossLink}} to true.
	 * Mirrors the DOM event standard.
	 * @method preventDefault
	 **/
	p.preventDefault = function() {
		this.defaultPrevented = true;
	};

	/**
	 * Sets {{#crossLink "Event/propagationStopped"}}{{/crossLink}} to true.
	 * Mirrors the DOM event standard.
	 * @method stopPropagation
	 **/
	p.stopPropagation = function() {
		this.propagationStopped = true;
	};

	/**
	 * Sets {{#crossLink "Event/propagationStopped"}}{{/crossLink}} and
	 * {{#crossLink "Event/immediatePropagationStopped"}}{{/crossLink}} to true.
	 * Mirrors the DOM event standard.
	 * @method stopImmediatePropagation
	 **/
	p.stopImmediatePropagation = function() {
		this.immediatePropagationStopped = this.propagationStopped = true;
	};

	/**
	 * Causes the active listener to be removed via removeEventListener();
	 *
	 * 		myBtn.addEventListener("click", function(evt) {
	 * 			// do stuff...
	 * 			evt.remove(); // removes this listener.
	 * 		});
	 *
	 * @method remove
	 **/
	p.remove = function() {
		this.removed = true;
	};

	/**
	 * Returns a clone of the Event instance.
	 * @method clone
	 * @return {Event} a clone of the Event instance.
	 **/
	p.clone = function() {
		return new Event(this.type, this.bubbles, this.cancelable);
	};

	/**
	 * Returns a string representation of this object.
	 * @method toString
	 * @return {String} a string representation of the instance.
	 **/
	p.toString = function() {
		return "[Event (type="+this.type+")]";
	};

	createjs.Event = Event;
}());

// namespace:
this.createjs = this.createjs||{};

(function() {
	"use strict";

	/**
	 * EventDispatcher provides methods for managing queues of event listeners and dispatching events.
	 *
	 * You can either extend EventDispatcher or mix its methods into an existing prototype or instance by using the
	 * EventDispatcher {{#crossLink "EventDispatcher/initialize"}}{{/crossLink}} method.
	 *
	 * Together with the CreateJS Event class, EventDispatcher provides an extended event model that is based on the
	 * DOM Level 2 event model, including addEventListener, removeEventListener, and dispatchEvent. It supports
	 * bubbling / capture, preventDefault, stopPropagation, stopImmediatePropagation, and handleEvent.
	 *
	 * EventDispatcher also exposes a {{#crossLink "EventDispatcher/on"}}{{/crossLink}} method, which makes it easier
	 * to create scoped listeners, listeners that only run once, and listeners with associated arbitrary data. The
	 * {{#crossLink "EventDispatcher/off"}}{{/crossLink}} method is merely an alias to
	 * {{#crossLink "EventDispatcher/removeEventListener"}}{{/crossLink}}.
	 *
	 * Another addition to the DOM Level 2 model is the {{#crossLink "EventDispatcher/removeAllEventListeners"}}{{/crossLink}}
	 * method, which can be used to listeners for all events, or listeners for a specific event. The Event object also
	 * includes a {{#crossLink "Event/remove"}}{{/crossLink}} method which removes the active listener.
	 *
	 * <h4>Example</h4>
	 * Add EventDispatcher capabilities to the "MyClass" class.
	 *
	 *      EventDispatcher.initialize(MyClass.prototype);
	 *
	 * Add an event (see {{#crossLink "EventDispatcher/addEventListener"}}{{/crossLink}}).
	 *
	 *      instance.addEventListener("eventName", handlerMethod);
	 *      function handlerMethod(event) {
 *          console.log(event.target + " Was Clicked");
 *      }
	 *
	 * <b>Maintaining proper scope</b><br />
	 * Scope (ie. "this") can be be a challenge with events. Using the {{#crossLink "EventDispatcher/on"}}{{/crossLink}}
	 * method to subscribe to events simplifies this.
	 *
	 *      instance.addEventListener("click", function(event) {
 *          console.log(instance == this); // false, scope is ambiguous.
 *      });
	 *
	 *      instance.on("click", function(event) {
 *          console.log(instance == this); // true, "on" uses dispatcher scope by default.
 *      });
	 *
	 * If you want to use addEventListener instead, you may want to use function.bind() or a similar proxy to manage scope.
	 *
	 *
	 * @class EventDispatcher
	 * @constructor
	 **/
	var EventDispatcher = function() {
		/*	this.initialize(); */ // not needed.
	};
	var p = EventDispatcher.prototype;


	/**
	 * Static initializer to mix EventDispatcher methods into a target object or prototype.
	 *
	 * 		EventDispatcher.initialize(MyClass.prototype); // add to the prototype of the class
	 * 		EventDispatcher.initialize(myObject); // add to a specific instance
	 *
	 * @method initialize
	 * @static
	 * @param {Object} target The target object to inject EventDispatcher methods into. This can be an instance or a
	 * prototype.
	 **/
	EventDispatcher.initialize = function(target) {
		target.addEventListener = p.addEventListener;
		target.on = p.on;
		target.removeEventListener = target.off =  p.removeEventListener;
		target.removeAllEventListeners = p.removeAllEventListeners;
		target.hasEventListener = p.hasEventListener;
		target.dispatchEvent = p.dispatchEvent;
		target._dispatchEvent = p._dispatchEvent;
	};

// constructor:

// private properties:
	/**
	 * @protected
	 * @property _listeners
	 * @type Object
	 **/
	p._listeners = null;

	/**
	 * @protected
	 * @property _captureListeners
	 * @type Object
	 **/
	p._captureListeners = null;

// constructor:
	/**
	 * Initialization method.
	 * @method initialize
	 * @protected
	 **/
	p.initialize = function() {};

// public methods:
	/**
	 * Adds the specified event listener. Note that adding multiple listeners to the same function will result in
	 * multiple callbacks getting fired.
	 *
	 * <h4>Example</h4>
	 *
	 *      displayObject.addEventListener("click", handleClick);
	 *      function handleClick(event) {
	 *         // Click happened.
	 *      }
	 *
	 * @method addEventListener
	 * @param {String} type The string type of the event.
	 * @param {Function | Object} listener An object with a handleEvent method, or a function that will be called when
	 * the event is dispatched.
	 * @param {Boolean} [useCapture] For events that bubble, indicates whether to listen for the event in the capture or bubbling/target phase.
	 * @return {Function | Object} Returns the listener for chaining or assignment.
	 **/
	p.addEventListener = function(type, listener, useCapture) {
		var listeners;
		if (useCapture) {
			listeners = this._captureListeners = this._captureListeners||{};
		} else {
			listeners = this._listeners = this._listeners||{};
		}
		var arr = listeners[type];
		if (arr) { this.removeEventListener(type, listener, useCapture); }
		arr = listeners[type]; // remove may have deleted the array
		if (!arr) { listeners[type] = [listener];  }
		else { arr.push(listener); }
		return listener;
	};

	/**
	 * A shortcut method for using addEventListener that makes it easier to specify an execution scope, have a listener
	 * only run once, associate arbitrary data with the listener, and remove the listener.
	 *
	 * This method works by creating an anonymous wrapper function and subscribing it with addEventListener.
	 * The created anonymous function is returned for use with .removeEventListener (or .off).
	 *
	 * <h4>Example</h4>
	 *
	 * 		var listener = myBtn.on("click", handleClick, null, false, {count:3});
	 * 		function handleClick(evt, data) {
	 * 			data.count -= 1;
	 * 			console.log(this == myBtn); // true - scope defaults to the dispatcher
	 * 			if (data.count == 0) {
	 * 				alert("clicked 3 times!");
	 * 				myBtn.off("click", listener);
	 * 				// alternately: evt.remove();
	 * 			}
	 * 		}
	 *
	 * @method on
	 * @param {String} type The string type of the event.
	 * @param {Function | Object} listener An object with a handleEvent method, or a function that will be called when
	 * the event is dispatched.
	 * @param {Object} [scope] The scope to execute the listener in. Defaults to the dispatcher/currentTarget for function listeners, and to the listener itself for object listeners (ie. using handleEvent).
	 * @param {Boolean} [once=false] If true, the listener will remove itself after the first time it is triggered.
	 * @param {*} [data] Arbitrary data that will be included as the second parameter when the listener is called.
	 * @param {Boolean} [useCapture=false] For events that bubble, indicates whether to listen for the event in the capture or bubbling/target phase.
	 * @return {Function} Returns the anonymous function that was created and assigned as the listener. This is needed to remove the listener later using .removeEventListener.
	 **/
	p.on = function(type, listener, scope, once, data, useCapture) {
		if (listener.handleEvent) {
			scope = scope||listener;
			listener = listener.handleEvent;
		}
		scope = scope||this;
		return this.addEventListener(type, function(evt) {
			listener.call(scope, evt, data);
			once&&evt.remove();
		}, useCapture);
	};

	/**
	 * Removes the specified event listener.
	 *
	 * <b>Important Note:</b> that you must pass the exact function reference used when the event was added. If a proxy
	 * function, or function closure is used as the callback, the proxy/closure reference must be used - a new proxy or
	 * closure will not work.
	 *
	 * <h4>Example</h4>
	 *
	 *      displayObject.removeEventListener("click", handleClick);
	 *
	 * @method removeEventListener
	 * @param {String} type The string type of the event.
	 * @param {Function | Object} listener The listener function or object.
	 * @param {Boolean} [useCapture] For events that bubble, indicates whether to listen for the event in the capture or bubbling/target phase.
	 **/
	p.removeEventListener = function(type, listener, useCapture) {
		var listeners = useCapture ? this._captureListeners : this._listeners;
		if (!listeners) { return; }
		var arr = listeners[type];
		if (!arr) { return; }
		for (var i=0,l=arr.length; i<l; i++) {
			if (arr[i] == listener) {
				if (l==1) { delete(listeners[type]); } // allows for faster checks.
				else { arr.splice(i,1); }
				break;
			}
		}
	};

	/**
	 * A shortcut to the removeEventListener method, with the same parameters and return value. This is a companion to the
	 * .on method.
	 *
	 * @method off
	 * @param {String} type The string type of the event.
	 * @param {Function | Object} listener The listener function or object.
	 * @param {Boolean} [useCapture] For events that bubble, indicates whether to listen for the event in the capture or bubbling/target phase.
	 **/
	p.off = p.removeEventListener;

	/**
	 * Removes all listeners for the specified type, or all listeners of all types.
	 *
	 * <h4>Example</h4>
	 *
	 *      // Remove all listeners
	 *      displayObject.removeAllEvenListeners();
	 *
	 *      // Remove all click listeners
	 *      displayObject.removeAllEventListeners("click");
	 *
	 * @method removeAllEventListeners
	 * @param {String} [type] The string type of the event. If omitted, all listeners for all types will be removed.
	 **/
	p.removeAllEventListeners = function(type) {
		if (!type) { this._listeners = this._captureListeners = null; }
		else {
			if (this._listeners) { delete(this._listeners[type]); }
			if (this._captureListeners) { delete(this._captureListeners[type]); }
		}
	};

	/**
	 * Dispatches the specified event to all listeners.
	 *
	 * <h4>Example</h4>
	 *
	 *      // Use a string event
	 *      this.dispatchEvent("complete");
	 *
	 *      // Use an Event instance
	 *      var event = new createjs.Event("progress");
	 *      this.dispatchEvent(event);
	 *
	 * @method dispatchEvent
	 * @param {Object | String | Event} eventObj An object with a "type" property, or a string type.
	 * While a generic object will work, it is recommended to use a CreateJS Event instance. If a string is used,
	 * dispatchEvent will construct an Event instance with the specified type.
	 * @param {Object} [target] The object to use as the target property of the event object. This will default to the
	 * dispatching object. <b>This parameter is deprecated and will be removed.</b>
	 * @return {Boolean} Returns the value of eventObj.defaultPrevented.
	 **/
	p.dispatchEvent = function(eventObj, target) {
		if (typeof eventObj == "string") {
			// won't bubble, so skip everything if there's no listeners:
			var listeners = this._listeners;
			if (!listeners || !listeners[eventObj]) { return false; }
			eventObj = new createjs.Event(eventObj);
		}
		// TODO: deprecated. Target param is deprecated, only use case is MouseEvent/mousemove, remove.
		eventObj.target = target||this;

		if (!eventObj.bubbles || !this.parent) {
			this._dispatchEvent(eventObj, 2);
		} else {
			var top=this, list=[top];
			while (top.parent) { list.push(top = top.parent); }
			var i, l=list.length;

			// capture & atTarget
			for (i=l-1; i>=0 && !eventObj.propagationStopped; i--) {
				list[i]._dispatchEvent(eventObj, 1+(i==0));
			}
			// bubbling
			for (i=1; i<l && !eventObj.propagationStopped; i++) {
				list[i]._dispatchEvent(eventObj, 3);
			}
		}
		return eventObj.defaultPrevented;
	};

	/**
	 * Indicates whether there is at least one listener for the specified event type and `useCapture` value.
	 * @method hasEventListener
	 * @param {String} type The string type of the event.
	 * @return {Boolean} Returns true if there is at least one listener for the specified event.
	 **/
	p.hasEventListener = function(type) {
		var listeners = this._listeners, captureListeners = this._captureListeners;
		return !!((listeners && listeners[type]) || (captureListeners && captureListeners[type]));
	};

	/**
	 * @method toString
	 * @return {String} a string representation of the instance.
	 **/
	p.toString = function() {
		return "[EventDispatcher]";
	};

// private methods:
	/**
	 * @method _dispatchEvent
	 * @param {Object | String | Event} eventObj
	 * @param {Object} eventPhase
	 * @protected
	 **/
	p._dispatchEvent = function(eventObj, eventPhase) {
		var l, listeners = (eventPhase==1) ? this._captureListeners : this._listeners;
		if (eventObj && listeners) {
			var arr = listeners[eventObj.type];
			if (!arr||!(l=arr.length)) { return; }
			eventObj.currentTarget = this;
			eventObj.eventPhase = eventPhase;
			eventObj.removed = false;
			arr = arr.slice(); // to avoid issues with items being removed or added during the dispatch
			for (var i=0; i<l && !eventObj.immediatePropagationStopped; i++) {
				var o = arr[i];
				if (o.handleEvent) { o.handleEvent(eventObj); }
				else { o(eventObj); }
				if (eventObj.removed) {
					this.off(eventObj.type, o, eventPhase==1);
					eventObj.removed = false;
				}
			}
		}
	};


	createjs.EventDispatcher = EventDispatcher;
}());

// namespace:
this.createjs = this.createjs||{};

/**
 * @class Utility Methods
 */
(function() {
	"use strict";

	/*
	 * Employs Duff's Device to make a more performant implementation of indexOf.
	 * see http://jsperf.com/duffs-indexof/2
	 * #method indexOf
	 * @param {Array} array Array to search for searchElement
	 * @param searchElement Element to search array for.
	 * @return {Number} The position of the first occurrence of a specified value searchElement in the passed in array ar.
	 * @constructor
	 */
	/* replaced with simple for loop for now, perhaps will be researched further
	 createjs.indexOf = function (ar, searchElement) {
	 var l = ar.length;

	 var n = (l * 0.125) ^ 0;	// 0.125 == 1/8, using multiplication because it's faster in some browsers	// ^0 floors result
	 for (var i = 0; i < n; i++) {
	 if(searchElement === ar[i*8])   { return (i*8);}
	 if(searchElement === ar[i*8+1]) { return (i*8+1);}
	 if(searchElement === ar[i*8+2]) { return (i*8+2);}
	 if(searchElement === ar[i*8+3]) { return (i*8+3);}
	 if(searchElement === ar[i*8+4]) { return (i*8+4);}
	 if(searchElement === ar[i*8+5]) { return (i*8+5);}
	 if(searchElement === ar[i*8+6]) { return (i*8+6);}
	 if(searchElement === ar[i*8+7]) { return (i*8+7);}
	 }

	 var n = l % 8;
	 for (var i = 0; i < n; i++) {
	 if (searchElement === ar[l-n+i]) {
	 return l-n+i;
	 }
	 }

	 return -1;
	 }
	 */

	/**
	 * Finds the first occurrence of a specified value searchElement in the passed in array, and returns the index of
	 * that value.  Returns -1 if value is not found.
	 *
	 *      var i = createjs.indexOf(myArray, myElementToFind);
	 *
	 * @method indexOf
	 * @param {Array} array Array to search for searchElement
	 * @param searchElement Element to find in array.
	 * @return {Number} The first index of searchElement in array.
	 */
	createjs.indexOf = function (array, searchElement){
		for (var i = 0,l=array.length; i < l; i++) {
			if (searchElement === array[i]) {
				return i;
			}
		}
		return -1;
	}

}());


// namespace:
this.createjs = this.createjs||{};

/**
 * Various utilities that the CreateJS Suite uses. Utilities are created as separate files, and will be available on the
 * createjs namespace directly:
 *
 * <h4>Example</h4>
 *      myObject.addEventListener("change", createjs.proxy(myMethod, scope));
 *
 * @class Utility Methods
 * @main Utility Methods
 */

(function() {
	"use strict";

	/**
	 * A function proxy for methods. By default, JavaScript methods do not maintain scope, so passing a method as a
	 * callback will result in the method getting called in the scope of the caller. Using a proxy ensures that the
	 * method gets called in the correct scope.
	 *
	 * Additional arguments can be passed that will be applied to the function when it is called.
	 *
	 * <h4>Example</h4>
	 *      myObject.addEventListener("event", createjs.proxy(myHandler, this, arg1, arg2));
	 *
	 *      function myHandler(arg1, arg2) {
	 *           // This gets called when myObject.myCallback is executed.
	 *      }
	 *
	 * @method proxy
	 * @param {Function} method The function to call
	 * @param {Object} scope The scope to call the method name on
	 * @param {mixed} [arg] * Arguments that are appended to the callback for additional params.
	 * @public
	 * @static
	 */
	createjs.proxy = function (method, scope) {
		var aArgs = Array.prototype.slice.call(arguments, 2);
		return function () {
			return method.apply(scope, Array.prototype.slice.call(arguments, 0).concat(aArgs));
		};
	}

}());

// namespace:
this.createjs = this.createjs||{};

(function() {
	"use strict";
	/**
	 * The base loader, which defines all the generic callbacks and events. All loaders extend this class, including the
	 * {{#crossLink "LoadQueue"}}{{/crossLink}}.
	 * @class AbstractLoader
	 * @uses EventDispatcher
	 */
	var AbstractLoader = function () {
		this.init();
	};

	AbstractLoader.prototype = {};
	var p = AbstractLoader.prototype;
	var s = AbstractLoader;

	/**
	 * The RegExp pattern to use to parse file URIs. This supports simple file names, as well as full domain URIs with
	 * query strings. The resulting match is: protocol:$1 domain:$2 path:$3 file:$4 extension:$5 query:$6.
	 * @property FILE_PATTERN
	 * @type {RegExp}
	 * @static
	 * @protected
	 */
	s.FILE_PATTERN = /^(?:(\w+:)\/{2}(\w+(?:\.\w+)*\/?))?([/.]*?(?:[^?]+)?\/)?((?:[^/?]+)\.(\w+))(?:\?(\S+)?)?$/;

	/**
	 * If the loader has completed loading. This provides a quick check, but also ensures that the different approaches
	 * used for loading do not pile up resulting in more than one <code>complete</code> event.
	 * @property loaded
	 * @type {Boolean}
	 * @default false
	 */
	p.loaded = false;

	/**
	 * Determine if the loader was canceled. Canceled loads will not fire complete events. Note that
	 * {{#crossLink "LoadQueue"}}{{/crossLink}} queues should be closed using {{#crossLink "AbstractLoader/close"}}{{/crossLink}}
	 * instead of canceled.
	 * @property canceled
	 * @type {Boolean}
	 * @default false
	 */
	p.canceled = false;

	/**
	 * The current load progress (percentage) for this item. This will be a number between 0 and 1.
	 * @property progress
	 * @type {Number}
	 * @default 0
	 */
	p.progress = 0;

	/**
	 * The item this loader represents. Note that this is null in a {{#crossLink "LoadQueue"}}{{/crossLink}}, but will
	 * be available on loaders such as {{#crossLink "XHRLoader"}}{{/crossLink}} and {{#crossLink "TagLoader"}}{{/crossLink}}.
	 * @property _item
	 * @type {Object}
	 * @private
	 */
	p._item = null;

	/**
	 * A path that will be prepended on to the item's source parameter before it is loaded.
	 * @property _basePath
	 * @type {String}
	 * @private
	 * @since 0.3.1
	 */
	p._basePath = null;

// Events
	/**
	 * The event that is fired when the overall progress changes.
	 * @event progress
	 * @param {Object} target The object that dispatched the event.
	 * @param {String} type The event type.
	 * @param {Number} loaded The amount that has been loaded so far. Note that this is may just be a percentage of 1,
	 * since file sizes can not be determined before a load is kicked off, if at all.
	 * @param {Number} total The total number of bytes. Note that this may just be 1.
	 * @param {Number} progress The ratio that has been loaded between 0 and 1.
	 * @since 0.3.0
	 */

	/**
	 * The event that is fired when a load starts.
	 * @event loadstart
	 * @param {Object} target The object that dispatched the event.
	 * @param {String} type The event type.
	 * @since 0.3.1
	 */

	/**
	 * The event that is fired when the entire queue has been loaded.
	 * @event complete
	 * @param {Object} target The object that dispatched the event.
	 * @param {String} type The event type.
	 * @since 0.3.0
	 */

	/**
	 * The event that is fired when the loader encounters an error. If the error was encountered by a file, the event will
	 * contain the item that caused the error. There may be additional properties such as the error reason on event
	 * objects.
	 * @event error
	 * @param {Object} target The object that dispatched the event.
	 * @param {String} type The event type.
	 * @param {Object} [item] The item that was being loaded that caused the error. The item was specified in
	 * the {{#crossLink "LoadQueue/loadFile"}}{{/crossLink}} or {{#crossLink "LoadQueue/loadManifest"}}{{/crossLink}}
	 * call. If only a string path or tag was specified, the object will contain that value as a property.
	 * @param {String} [error] The error object or text.
	 * @since 0.3.0
	 */

	//TODO: Deprecated
	/**
	 * REMOVED. Use {{#crossLink "EventDispatcher/addEventListener"}}{{/crossLink}} and the {{#crossLink "AbstractLoader/progress:event"}}{{/crossLink}}
	 * event.
	 * @property onProgress
	 * @type {Function}
	 * @deprecated Use addEventListener and the "progress" event.
	 */
	/**
	 * REMOVED. Use {{#crossLink "EventDispatcher/addEventListener"}}{{/crossLink}} and the {{#crossLink "AbstractLoader/loadstart:event"}}{{/crossLink}}
	 * event.
	 * @property onLoadStart
	 * @type {Function}
	 * @deprecated Use addEventListener and the "loadstart" event.
	 */
	/**
	 * REMOVED. Use {{#crossLink "EventDispatcher/addEventListener"}}{{/crossLink}} and the {{#crossLink "AbstractLoader/complete:event"}}{{/crossLink}}
	 * event.
	 * @property onComplete
	 * @type {Function}
	 * @deprecated Use addEventListener and the "complete" event.
	 */
	/**
	 * REMOVED. Use {{#crossLink "EventDispatcher/addEventListener"}}{{/crossLink}} and the {{#crossLink "AbstractLoader/error:event"}}{{/crossLink}}
	 * event.
	 * @property onError
	 * @type {Function}
	 * @deprecated Use addEventListener and the "error" event.
	 */


// mix-ins:
		// EventDispatcher methods:
	p.addEventListener = null;
	p.removeEventListener = null;
	p.removeAllEventListeners = null;
	p.dispatchEvent = null;
	p.hasEventListener = null;
	p._listeners = null;
	createjs.EventDispatcher.initialize(p);


	/**
	 * Get a reference to the manifest item that is loaded by this loader. In most cases this will be the value that was
	 * passed into {{#crossLink "LoadQueue"}}{{/crossLink}} using {{#crossLink "LoadQueue/loadFile"}}{{/crossLink}} or
	 * {{#crossLink "LoadQueue/loadManifest"}}{{/crossLink}}. However if only a String path was passed in, then it will
	 * be an Object created by the LoadQueue.
	 * @return {Object} The manifest item that this loader is responsible for loading.
	 */
	p.getItem = function() {
		return this._item;
	};

	/**
	 * Initialize the loader. This is called by the constructor.
	 * @method init
	 * @private
	 */
	p.init = function () {};

	/**
	 * Begin loading the queued items. This method can be called when a {{#crossLink "LoadQueue"}}{{/crossLink}} is set
	 * up but not started immediately.
	 * @example
	 *      var queue = new createjs.LoadQueue();
	 *      queue.addEventListener("complete", handleComplete);
	 *      queue.loadManifest(fileArray, false); // Note the 2nd argument that tells the queue not to start loading yet
	 *      queue.load();
	 * @method load
	 */
	p.load = function() {};

	/**
	 * Close the active queue. Closing a queue completely empties the queue, and prevents any remaining items from
	 * starting to download. Note that currently any active loads will remain open, and events may be processed.
	 *
	 * To stop and restart a queue, use the {{#crossLink "LoadQueue/setPaused"}}{{/crossLink}} method instead.
	 * @method close
	 */
	p.close = function() {};


//Callback proxies
	/**
	 * Dispatch a loadstart event. Please see the {{#crossLink "AbstractLoader/loadstart:event"}}{{/crossLink}} event
	 * for details on the event payload.
	 * @method _sendLoadStart
	 * @protected
	 */
	p._sendLoadStart = function() {
		if (this._isCanceled()) { return; }
		this.dispatchEvent("loadstart");
	};

	/**
	 * Dispatch a progress event. Please see the {{#crossLink "AbstractLoader/progress:event"}}{{/crossLink}} event for
	 * details on the event payload.
	 * @method _sendProgress
	 * @param {Number | Object} value The progress of the loaded item, or an object containing <code>loaded</code>
	 * and <code>total</code> properties.
	 * @protected
	 */
	p._sendProgress = function(value) {
		if (this._isCanceled()) { return; }
		var event = null;
		if (typeof(value) == "number") {
			this.progress = value;
			event = new createjs.Event("progress");
			event.loaded = this.progress;
			event.total = 1;
		} else {
			event = value;
			this.progress = value.loaded / value.total;
			if (isNaN(this.progress) || this.progress == Infinity) { this.progress = 0; }
		}
		event.progress = this.progress;
		this.hasEventListener("progress") && this.dispatchEvent(event);
	};

	/**
	 * Dispatch a complete event. Please see the {{#crossLink "AbstractLoader/complete:event"}}{{/crossLink}} event
	 * for details on the event payload.
	 * @method _sendComplete
	 * @protected
	 */
	p._sendComplete = function() {
		if (this._isCanceled()) { return; }
		this.dispatchEvent("complete");
	};

	/**
	 * Dispatch an error event. Please see the {{#crossLink "AbstractLoader/error:event"}}{{/crossLink}} event for
	 * details on the event payload.
	 * @method _sendError
	 * @param {Object} event The event object containing specific error properties.
	 * @protected
	 */
	p._sendError = function(event) {
		if (this._isCanceled() || !this.hasEventListener("error")) { return; }
		if (event == null) {
			event = new createjs.Event("error");
		}
		this.dispatchEvent(event);
	};

	/**
	 * Determine if the load has been canceled. This is important to ensure that method calls or asynchronous events
	 * do not cause issues after the queue has been cleaned up.
	 * @method _isCanceled
	 * @return {Boolean} If the loader has been canceled.
	 * @protected
	 */
	p._isCanceled = function() {
		if (window.createjs == null || this.canceled) {
			return true;
		}
		return false;
	};

	/**
	 * Parse a file URI using the <code>AbstractLoader.FILE_PATTERN</code> RegExp pattern.
	 * @method _parseURI
	 * @param {String} path The file path to parse.
	 * @return {Array} The matched file contents. Please see the <code>AbstractLoader.FILE_PATTERN</code> property for
	 * details on the return value. This will return null if it does not match.
	 * @protected
	 */
	p._parseURI = function(path) {
		if (!path) { return null; }
		return path.match(s.FILE_PATTERN);
	};

	/**
	 * Formats an object into a query string for either a POST or GET request.
	 * @method _formatQueryString
	 * @param {Object} data The data to convert to a query string.
	 * @param {Array} [query] Existing name/value pairs to append on to this query.
	 * @private
	 */
	p._formatQueryString = function(data, query) {
		if (data == null) {
			throw new Error('You must specify data.');
		}
		var params = [];
		for (var n in data) {
			params.push(n+'='+escape(data[n]));
		}
		if (query) {
			params = params.concat(query);
		}
		return params.join('&');
	};

	/**
	 * A utility method that builds a file path using a source, a basePath, and a data object, and formats it into a new
	 * path. All of the loaders in PreloadJS use this method to compile paths when loading.
	 * @method buildPath
	 * @param {String} src The source path to add values to.
	 * @param {String} [basePath] A string to prepend to the file path. Sources beginning with http:// or similar will
	 * not receive a base path.
	 * @param {Object} [data] Object used to append values to this request as a query string. Existing parameters on the
	 * path will be preserved.
	 * @returns {string} A formatted string that contains the path and the supplied parameters.
	 * @since 0.3.1
	 */
	p.buildPath = function(src, _basePath, data) {
		if (_basePath != null) {
			var match = this._parseURI(src);
			// IE 7,8 Return empty string here.
			if (match == null || match[1] == null || match[1] == '') {
				src = _basePath + src;
			}
		}
		if (data == null) {
			return src;
		}

		var query = [];
		var idx = src.indexOf('?');

		if (idx != -1) {
			var q = src.slice(idx+1);
			query = query.concat(q.split('&'));
		}

		if (idx != -1) {
			return src.slice(0, idx) + '?' + this._formatQueryString(data, query);
		} else {
			return src + '?' + this._formatQueryString(data, query);
		}
	};

	/**
	 * @method toString
	 * @return {String} a string representation of the instance.
	 */
	p.toString = function() {
		return "[PreloadJS AbstractLoader]";
	};

	createjs.AbstractLoader = AbstractLoader;

}());


// namespace:
this.createjs = this.createjs||{};

//TODO: addHeadTags support

/*
 TODO: WINDOWS ISSUES
 * No error for HTML audio in IE 678
 * SVG no failure error in IE 67 (maybe 8) TAGS AND XHR
 * No script complete handler in IE 67 TAGS (XHR is fine)
 * No XML/JSON in IE6 TAGS
 * Need to hide loading SVG in Opera TAGS
 * No CSS onload/readystatechange in Safari or Android TAGS (requires rule checking)
 * SVG no load or failure in Opera XHR
 * Reported issues with IE7/8
 */

(function() {
	"use strict";

	/**
	 * The LoadQueue class is the main API for preloading content. LoadQueue is a load manager, which maintains
	 * a single file, or a queue of files.
	 *
	 * <b>Creating a Queue</b><br />
	 * To use LoadQueue, create a LoadQueue instance. If you want to force tag loading where possible, set the useXHR
	 * argument to false.
	 *
	 *      var queue = new createjs.LoadQueue(true);
	 *
	 * <b>Listening for Events</b><br />
	 * Add any listeners you want to the queue. Since PreloadJS 0.3.0, the {{#crossLink "EventDispatcher"}}{{/crossLink}}
	 * lets you add as many listeners as you want for events. You can subscribe to complete, error, fileload, progress,
	 * and fileprogress.
	 *
	 *      queue.addEventListener("fileload", handleFileLoad);
	 *      queue.addEventListener("complete", handleComplete);
	 *
	 * <b>Adding files and manifests</b><br />
	 * Add files you want to load using {{#crossLink "LoadQueue/loadFile"}}{{/crossLink}} or add multiple files at a
	 * time using {{#crossLink "LoadQueue/loadManifest"}}{{/crossLink}}. Files are appended to the queue, so you can use
	 * these methods as many times as you like, whenever you like.
	 *
	 *      queue.loadFile("filePath/file.jpg");
	 *      queue.loadFile({id:"image", src:"filePath/file.jpg"});
	 *      queue.loadManifest(["filePath/file.jpg", {id:"image", src:"filePath/file.jpg"}];
	 *
	 * If you pass <code>false</code> as the second parameter, the queue will not immediately load the files (unless it
	 * has already been started). Call the {{#crossLink "AbstractLoader/load"}}{{/crossLink}} method to begin a paused queue.
	 * Note that a paused queue will automatically resume when new files are added to it.
	 *
	 *      queue.load();
	 *
	 * <b>File Types</b><br />
	 * The file type of a manifest item is auto-determined by the file extension. The pattern matching in PreloadJS
	 * should handle the majority of standard file and url formats, and works with common file extensions. If you have
	 * either a non-standard file extension, or are serving the file using a proxy script, then you can pass in a
	 * <code>type</code> property with any manifest item.
	 *
	 *      queue.loadFile({src:"path/to/myFile.mp3x", type:createjs.LoadQueue.SOUND});
	 *
	 *      // Note that PreloadJS will not read a file extension from the query string
	 *      queue.loadFile({src:"http://server.com/proxy?file=image.jpg"}, type:createjs.LoadQueue.IMAGE});
	 *
	 * Supported types include:
	 * <ul>
	 *     <li>createjs.LoadQueue.BINARY (Raw binary data via XHR)</li>
	 *     <li>createjs.LoadQueue.CSS (CSS files)</li>
	 *     <li>createjs.LoadQueue.IMAGE (Common image formats)</li>
	 *     <li>createjs.LoadQueue.JAVASCRIPT (JavaScript files)</li>
	 *     <li>createjs.LoadQueue.JSON (JSON data)</li>
	 *     <li>createjs.LoadQueue.JSONP (JSON files cross-domain)</li>
	 *     <li>createjs.LoadQueue.SOUND (Audio file formats)</li>
	 *     <li>createjs.LoadQueue.SVG (SVG files)</li>
	 *     <li>createjs.LoadQueue.TEXT (Text files - XHR only)</li>
	 *     <li>createjs.LoadQueue.XML (XML data)</li>
	 * </ul>
	 *
	 * <b>Handling Results</b><br />
	 * When a file is finished downloading, a "fileload" event is dispatched. In an example above, there is an event
	 * listener snippet for fileload. Loaded files are always an object that can be used immediately, including:
	 * <ul>
	 *     <li>Image: An &lt;img /&gt; tag</li>
	 *     <li>Audio: An &lt;audio /&gt; tag</a>
	 *     <li>JavaScript: A &lt;script /&gt; tag</li>
	 *     <li>CSS: A &lt;link /&gt; tag</li>
	 *     <li>XML: An XML DOM node</li>
	 *     <li>SVG: An &lt;object /&gt; tag</li>
	 *     <li>JSON: A formatted JavaScript Object</li>
	 *     <li>Text: Raw text</li>
	 *     <li>Binary: The binary loaded result</li>
	 * </ul>
	 *
	 *      function handleFileLoad(event) {
	 *          var item = event.item; // A reference to the item that was passed in
	 *          var type = item.type;
	 *
	 *          // Add any images to the page body.
	 *          if (type == createjs.LoadQueue.IMAGE) {
	 *              document.body.appendChild(event.result);
	 *          }
	 *      }
	 *
	 * At any time after the file has been loaded (usually after the queue has completed), any result can be looked up
	 * via its "id" using {{#crossLink "LoadQueue/getResult"}}{{/crossLink}}. If no id was provided, then the "src" or
	 * file path can be used instead. It is recommended to always pass an id.
	 *
	 *      var image = queue.getResult("image");
	 *      document.body.appendChild(image);
	 *
	 * Raw loaded content can be accessed using the <code>rawResult</code> property of the <code>fileload</code> event,
	 * or can be looked up using {{#crossLink "LoadQueue/getResult"}}{{/crossLink}}, and <code>true</code> as the 2nd
	 * parameter. This is only applicable for content that has been parsed for the browser, specifically, JavaScript,
	 * CSS, XML, SVG, and JSON objects.
	 *
	 *      var image = queue.getResult("image", true);
	 *
	 * <b>Plugins</b><br />
	 * LoadQueue has a simple plugin architecture to help process and preload content. For example, to preload audio,
	 * make sure to install the <a href="http://soundjs.com">SoundJS</a> Sound class, which will help preload HTML
	 * audio, Flash audio, and WebAudio files. This should be installed <b>before</b> loading any audio files.
	 *
	 *      queue.installPlugin(createjs.Sound);
	 *
	 * <h4>Known Browser Issues</h4>
	 * <ul>
	 *     <li>Browsers without audio support can not load audio files.</li>
	 *     <li>Safari on Mac OS X can only play HTML audio if QuickTime is installed</li>
	 *     <li>HTML Audio tags will only download until their <code>canPlayThrough</code> event is fired. Browsers other
	 *     than Chrome will continue to download in the background.</li>
	 *     <li>When loading scripts using tags, they are automatically added to the document.</li>
	 *     <li>Scripts loaded via XHR may not be properly inspectable with browser tools.</li>
	 *     <li>IE6 and IE7 (and some other browsers) may not be able to load XML, Text, or JSON, since they require
	 *     XHR to work.</li>
	 *     <li>Content loaded via tags will not show progress, and will continue to download in the background when
	 *     canceled, although no events will be dispatched.</li>
	 * </ul>
	 *
	 * @class LoadQueue
	 * @param {Boolean} [useXHR=true] Determines whether the preload instance will favor loading with XHR (XML HTTP Requests),
	 * or HTML tags. When this is <code>false</code>, LoadQueue will use tag loading when possible, and fall back on XHR
	 * when necessary.
	 * @param {String} basePath A path that will be prepended on to the source parameter of all items in the queue
	 * before they are loaded.  Sources beginning with http:// or similar will not receive a base path.
	 * Note that a basePath provided to any loadFile or loadManifest call will override the
	 * basePath specified on the LoadQueue constructor.
	 * @constructor
	 * @extends AbstractLoader
	 */
	var LoadQueue = function(useXHR, basePath) {
		this.init(useXHR, basePath);
	};

	var p = LoadQueue.prototype = new createjs.AbstractLoader();
	var s = LoadQueue;

	/**
	 * Time in milliseconds to assume a load has failed.
	 * @property LOAD_TIMEOUT
	 * @type {Number}
	 * @default 8000
	 * @static
	 */
	s.LOAD_TIMEOUT = 8000;

// Preload Types
	/**
	 * The preload type for generic binary types. Note that images and sound files are treated as binary.
	 * @property BINARY
	 * @type {String}
	 * @default binary
	 * @static
	 */
	s.BINARY = "binary";

	/**
	 * The preload type for css files. CSS files are loaded into a LINK or STYLE tag (depending on the load type)
	 * @property CSS
	 * @type {String}
	 * @default css
	 * @static
	 */
	s.CSS = "css";

	/**
	 * The preload type for image files, usually png, gif, or jpg/jpeg. Images are loaded into an IMAGE tag.
	 * @property IMAGE
	 * @type {String}
	 * @default image
	 * @static
	 */
	s.IMAGE = "image";

	/**
	 * The preload type for javascript files, usually with the "js" file extension. JavaScript files are loaded into a
	 * SCRIPT tag.
	 * @property JAVASCRIPT
	 * @type {String}
	 * @default javascript
	 * @static
	 */
	s.JAVASCRIPT = "javascript";

	/**
	 * The preload type for json files, usually with the "json" file extension. JSON data is loaded and parsed into a
	 * JavaScript object.
	 * @property JSON
	 * @type {String}
	 * @default json
	 * @static
	 */
	s.JSON = "json";

	/**
	 * The preload type for jsonp files, usually with the "json" file extension. JSOON data is loaded and parsed into a
	 * JavaScript object. You are required to pass a callback parameter that matches the jsonp result.
	 * @property JSONP
	 * @type {String}
	 * @default jsonp
	 * @static
	 */
	s.JSONP = "jsonp";

	/**
	 * The preload type for sound files, usually mp3, ogg, or wav. Audio is loaded into an AUDIO tag.
	 * @property SOUND
	 * @type {String}
	 * @default sound
	 * @static
	 */
	s.SOUND = "sound";

	s.VIDEO = "video";

	/**
	 * The preload type for SVG files.
	 * @property SVG
	 * @type {String}
	 * @default svg
	 * @static
	 */
	s.SVG = "svg";

	/**
	 * The preload type for text files, which is also the default file type if the type can not be determined. Text is
	 * loaded as raw text.
	 * @property TEXT
	 * @type {String}
	 * @default text
	 * @static
	 */
	s.TEXT = "text";

	/**
	 * The preload type for xml files. XML is loaded into an XML document.
	 * @property XML
	 * @type {String}
	 * @default xml
	 * @static
	 */
	s.XML = "xml";

	/**
	 * Defines a POST request, use for a method value when loading data.
	 *
	 * @type {string}
	 */
	s.POST = 'POST';

	/**
	 * Defines a GET request, use for a method value when loading data.
	 *
	 * @type {string}
	 */
	s.GET = 'GET';


// Prototype
	/**
	 * Use XMLHttpRequest (XHR) when possible. Note that LoadQueue will default to tag loading or XHR loading depending
	 * on the requirements for a media type. For example, HTML audio can not be loaded with XHR, and WebAudio can not be
	 * loaded with tags, so it will default the the correct type instead of using the user-defined type.
	 *
	 * <b>Note: This property is read-only.</b> To change it, please use the {{#crossLink "LoadQueue/setUseXHR"}}{{/crossLink}}
	 * method.
	 *
	 * @property useXHR
	 * @type {Boolean}
	 * @readOnly
	 * @default true
	 */
	p.useXHR = true;

	/**
	 * Does LoadQueue stop processing the current queue when an error is encountered.
	 * @property stopOnError
	 * @type {Boolean}
	 * @default false
	 */
	p.stopOnError = false;

	/**
	 * Ensure loaded scripts "complete" in the order they are specified. Note that scripts loaded via tags will only
	 * load one at a time, and will be added to the document when they are loaded.
	 * @property maintainScriptOrder
	 * @type {Boolean}
	 * @default true
	 */
	p.maintainScriptOrder = true;

	/*
	 * LM: Not Implemented.
	 * Automatically add tags to the HEAD of the document when they are loaded. Note that when loading JavaScript
	 * using a tag-based approach (<code>useXHR=false</code>), tags are automatically added to the HEAD in order to
	 * load them.
	 * @property addHeadTags
	 * @type {Boolean}
	 * @default trues
	 */
	//p.addHeadTags = true;

	/**
	 * The next preload queue to process when this one is complete. If an error is thrown in the current queue, and
	 * <code>loadQueue.stopOnError</code> is <code>true</code>, the next queue will not be processed.
	 * @property next
	 * @type {LoadQueue}
	 * @default null
	 */
	p.next = null;

// Events
	/**
	 * This event is fired when an individual file has loaded, and been processed.
	 * @event fileload
	 * @param {Object} target The object that dispatched the event.
	 * @param {String} type The event type.
	 * @param {Object} item The file item which was specified in the {{#crossLink "LoadQueue/loadFile"}}{{/crossLink}}
	 * or {{#crossLink "LoadQueue/loadManifest"}}{{/crossLink}} call. If only a string path or tag was specified, the
	 * object will contain that value as a property.
	 * @param {Object} result The HTML tag or parsed result of the loaded item.
	 * @param {Object} rawResult The unprocessed result, usually the raw text or binary data before it is converted
	 * to a usable object.
	 * @since 0.3.0
	 */

	/**
	 * This event is fired when an an individual file progress changes.
	 * @event fileprogress
	 * @param {Object} The object that dispatched the event.
	 * @param {String} type The event type.
	 * @param {Object} item The file item which was specified in the {{#crossLink "LoadQueue/loadFile"}}{{/crossLink}}
	 * or {{#crossLink "LoadQueue/loadManifest"}}{{/crossLink}} call. If only a string path or tag was specified, the
	 * object will contain that value as a property.
	 * @param {Number} loaded The number of bytes that have been loaded. Note that this may just be a percentage of 1.
	 * @param {Number} total The total number of bytes. If it is unknown, the value is 1.
	 * @param {Number} progress The amount that has been loaded between 0 and 1.
	 * @since 0.3.0
	 */

	/**
	 * This event is fired when an individual file starts to load.
	 * @event filestart
	 * @param {Object} The object that dispatched the event.
	 * @param {String} type The event type.
	 * @param {Object} item The file item which was specified in the {{#crossLink "LoadQueue/loadFile"}}{{/crossLink}}
	 * or {{#crossLink "LoadQueue/loadManifest"}}{{/crossLink}} call. If only a string path or tag was specified, the
	 * object will contain that value as a property.
	 */

	//TODO: Deprecated
	/**
	 * REMOVED. Use {{#crossLink "EventDispatcher/addEventListener"}}{{/crossLink}} and the {{#crossLink "LoadQueue/fileload:event"}}{{/crossLink}}
	 * event.
	 * @property onFileLoad
	 * @type {Function}
	 * @deprecated Use addEventListener and the "fileload" event.
	 */
	/**
	 * REMOVED. Use {{#crossLink "EventDispatcher/addEventListener"}}{{/crossLink}} and the {{#crossLink "LoadQueue/fileprogress:event"}}{{/crossLink}}
	 * event.
	 * @property onFileProgress
	 * @type {Function}
	 * @deprecated Use addEventListener and the "fileprogress" event.
	 */


// Protected
	/**
	 * An object hash of callbacks that are fired for each file type before the file is loaded, giving plugins the
	 * ability to override properties of the load. Please see the {{#crossLink "LoadQueue/installPlugin"}}{{/crossLink}}
	 * method for more information.
	 * @property _typeCallbacks
	 * @type {Object}
	 * @private
	 */
	p._typeCallbacks = null;

	/**
	 * An object hash of callbacks that are fired for each file extension before the file is loaded, giving plugins the
	 * ability to override properties of the load. Please see the {{#crossLink "LoadQueue/installPlugin"}}{{/crossLink}}
	 * method for more information.
	 * @property _extensionCallbacks
	 * @type {null}
	 * @private
	 */
	p._extensionCallbacks = null;

	/**
	 * Determines if the loadStart event was dispatched already. This event is only fired one time, when the first
	 * file is requested.
	 * @property _loadStartWasDispatched
	 * @type {Boolean}
	 * @default false
	 * @private
	 */
	p._loadStartWasDispatched = false;

	/**
	 * The number of maximum open connections that a loadQueue tries to maintain. Please see
	 * {{#crossLink "LoadQueue/setMaxConnections"}}{{/crossLink}} for more information.
	 * @property _maxConnections
	 * @type {Number}
	 * @default 1
	 * @private
	 */
	p._maxConnections = 1;

	/**
	 * Determines if there is currently a script loading. This helps ensure that only a single script loads at once when
	 * using a script tag to do preloading.
	 * @property _currentlyLoadingScript
	 * @type {Boolean}
	 * @private
	 */
	p._currentlyLoadingScript = null;

	/**
	 * An array containing the currently downloading files.
	 * @property _currentLoads
	 * @type {Array}
	 * @private
	 */
	p._currentLoads = null;

	/**
	 * An array containing the queued items that have not yet started downloading.
	 * @property _loadQueue
	 * @type {Array}
	 * @private
	 */
	p._loadQueue = null;

	/**
	 * An array containing downloads that have not completed, so that the LoadQueue can be properly reset.
	 * @property _loadQueueBackup
	 * @type {Array}
	 * @private
	 */
	p._loadQueueBackup = null;

	/**
	 * An object hash of items that have finished downloading, indexed by item IDs.
	 * @property _loadItemsById
	 * @type {Object}
	 * @private
	 */
	p._loadItemsById = null;

	/**
	 * An object hash of items that have finished downloading, indexed by item source.
	 * @property _loadItemsBySrc
	 * @type {Object}
	 * @private
	 */
	p._loadItemsBySrc = null;

	/**
	 * An object hash of loaded items, indexed by the ID of the load item.
	 * @property _loadedResults
	 * @type {Object}
	 * @private
	 */
	p._loadedResults = null;

	/**
	 * An object hash of un-parsed loaded items, indexed by the ID of the load item.
	 * @property _loadedRawResults
	 * @type {Object}
	 * @private
	 */
	p._loadedRawResults = null;

	/**
	 * The number of items that have been requested. This helps manage an overall progress without knowing how large
	 * the files are before they are downloaded.
	 * @property _numItems
	 * @type {Number}
	 * @default 0
	 * @private
	 */
	p._numItems = 0;

	/**
	 * The number of items that have completed loaded. This helps manage an overall progress without knowing how large
	 * the files are before they are downloaded.
	 * @property _numItemsLoaded
	 * @type {Number}
	 * @default 0
	 * @private
	 */
	p._numItemsLoaded = 0;

	/**
	 * A list of scripts in the order they were requested. This helps ensure that scripts are "completed" in the right
	 * order.
	 * @property _scriptOrder
	 * @type {Array}
	 * @private
	 */
	p._scriptOrder = null;

	/**
	 * A list of scripts that have been loaded. Items are added to this list as <code>null</code> when they are
	 * requested, contain the loaded item if it has completed, but not been dispatched to the user, and <code>true</true>
	 * once they are complete and have been dispatched.
	 * @property _loadedScripts
	 * @type {Array}
	 * @private
	 */
	p._loadedScripts = null;

	// Overrides abstract method in AbstractLoader
	p.init = function(useXHR, basePath) {
		this._numItems = this._numItemsLoaded = 0;
		this._paused = false;
		this._loadStartWasDispatched = false;

		this._currentLoads = [];
		this._loadQueue = [];
		this._loadQueueBackup = [];
		this._scriptOrder = [];
		this._loadedScripts = [];
		this._loadItemsById = {};
		this._loadItemsBySrc = {};
		this._loadedResults = {};
		this._loadedRawResults = {};

		// Callbacks for plugins
		this._typeCallbacks = {};
		this._extensionCallbacks = {};

		this._basePath = basePath;
		this.setUseXHR(useXHR);
	};

	/**
	 * Change the usXHR value. Note that if this is set to true, it may fail depending on the browser's capabilities.
	 * @method setUseXHR
	 * @param {Boolean} value The new useXHR value to set.
	 * @return {Boolean} The new useXHR value. If XHR is not supported by the browser, this will return false, even if
	 * the provided value argument was true.
	 * @since 0.3.0
	 */
	p.setUseXHR = function(value) {
		// Determine if we can use XHR. XHR defaults to TRUE, but the browser may not support it.
		//TODO: Should we be checking for the other XHR types? Might have to do a try/catch on the different types similar to createXHR.
		this.useXHR = (value != false && window.XMLHttpRequest != null);
		return this.useXHR;
	};

	/**
	 * Stops all queued and loading items, and clears the queue. This also removes all internal references to loaded
	 * content, and allows the queue to be used again. Items that have not yet started can be kicked off again using
	 * the {{#crossLink "AbstractLoader/load"}}{{/crossLink}} method.
	 * @method removeAll
	 * @since 0.3.0
	 */
	p.removeAll = function() {
		this.remove();
	};

	/**
	 * Stops an item from being loaded, and removes it from the queue. If nothing is passed, all items are removed.
	 * This also removes internal references to loaded item(s).
	 * @method remove
	 * @param {String | Array} idsOrUrls The id or ids to remove from this queue. You can pass an item, an array of
	 * items, or multiple items as arguments.
	 * @since 0.3.0
	 */
	p.remove = function(idsOrUrls) {
		var args = null;

		if (idsOrUrls && !(idsOrUrls instanceof Array)) {
			args = [idsOrUrls];
		} else if (idsOrUrls) {
			args = idsOrUrls;
		} else if (arguments.length > 0) {
			return;
		}

		var itemsWereRemoved = false;

		// Destroy everything
		if (!args) {
			this.close();

			for (var n in this._loadItemsById) {
				this._disposeItem(this._loadItemsById[n]);
			}

			this.init(this.useXHR);

			// Remove specific items
		} else {
			while (args.length) {
				var item = args.pop();
				var r = this.getResult(item);

				//Remove from the main load Queue
				for (i = this._loadQueue.length-1;i>=0;i--) {
					loadItem = this._loadQueue[i].getItem();
					if (loadItem.id == item || loadItem.src == item) {
						this._loadQueue.splice(i,1)[0].cancel();
						break;
					}
				}

				//Remove from the backup queue
				for (i = this._loadQueueBackup.length-1;i>=0;i--) {
					loadItem = this._loadQueueBackup[i].getItem();
					if (loadItem.id == item || loadItem.src == item) {
						this._loadQueueBackup.splice(i,1)[0].cancel();
						break;
					}
				}

				if (r) {
					delete this._loadItemsById[r.id];
					delete this._loadItemsBySrc[r.src];
					this._disposeItem(r);
				} else {
					for (var i=this._currentLoads.length-1;i>=0;i--) {
						var loadItem = this._currentLoads[i].getItem();
						if (loadItem.id == item || loadItem.src == item) {
							this._currentLoads.splice(i,1)[0].cancel();
							itemsWereRemoved = true;
							break;
						}
					}
				}
			}

			// If this was called during a load, try to load the next item.
			if (itemsWereRemoved) {
				this._loadNext();
			}
		}
	};

	/**
	 * Stops all open loads, destroys any loaded items, and resets the queue, so all items can
	 * be reloaded again by calling {{#crossLink "AbstractLoader/load"}}{{/crossLink}}. Items are not removed from the
	 * queue. To remove items use the {{#crossLink "LoadQueue/remove"}}{{/crossLink}} or
	 * {{#crossLink "LoadQueue/removeAll"}}{{/crossLink}} method.
	 * @method reset
	 * @since 0.3.0
	 */
	p.reset = function() {
		this.close();
		for (var n in this._loadItemsById) {
			this._disposeItem(this._loadItemsById[n]);
		}

		//Reset the queue to its start state
		var a = [];
		for (var i = 0,l = this._loadQueueBackup.length;i<l;i++) {
			a.push(this._loadQueueBackup[i].getItem());
		}

		this.loadManifest(a, false);
	};

	/**
	 * Determine if a specific type should be loaded as a binary file. Currently, only images and items marked
	 * specifically as "binary" are loaded as binary. Note that audio is <b>not</b> a binary type, as we can not play
	 * back using an audio tag if it is loaded as binary. Plugins can change the item type to binary to ensure they get
	 * a binary result to work with. Binary files are loaded using XHR2.
	 * @method isBinary
	 * @param {String} type The item type.
	 * @return If the specified type is binary.
	 * @private
	 */
	s.isBinary = function(type) {
		switch (type) {
			case createjs.LoadQueue.IMAGE:
			case createjs.LoadQueue.BINARY:
				return true;
			default:
				return false;
		}
	};

	/**
	 * Register a plugin. Plugins can map to both load types (sound, image, etc), or can map to specific extensions
	 * (png, mp3, etc). Currently, only one plugin can exist per type/extension. Plugins must return an object containing:
	 *  <ul><li>callback: The function to call</li>
	 *      <li>types: An array of types to handle</li>
	 *      <li>extensions: An array of extensions to handle. This only fires if an applicable type handler has not fired.</li></ul>
	 * Note that even though a plugin might match both a type and extension handler, the type handler takes priority and
	 * is the only one that gets fired.  For example if you have a handler for type=sound, and a handler for extension=mp3,
	 * only the type handler would fire when an mp3 file is loaded.
	 * @method installPlugin
	 * @param {Function} plugin The plugin to install
	 */
	p.installPlugin = function(plugin) {
		if (plugin == null || plugin.getPreloadHandlers == null) { return; }
		var map = plugin.getPreloadHandlers();
		if (map.types != null) {
			for (var i=0, l=map.types.length; i<l; i++) {
				this._typeCallbacks[map.types[i]] = map.callback;
			}
		}
		if (map.extensions != null) {
			for (i=0, l=map.extensions.length; i<l; i++) {
				this._extensionCallbacks[map.extensions[i]] = map.callback;
			}
		}
	};

	/**
	 * Set the maximum number of concurrent connections. Note that browsers and servers may have a built-in maximum
	 * number of open connections, so any additional connections may remain in a pending state until the browser
	 * opens the connection. Note that when loading scripts using tags, with <code>maintainScriptOrder=true</code>, only
	 * one script is loaded at a time due to browser limitations.
	 * @method setMaxConnections
	 * @param {Number} value The number of concurrent loads to allow. By default, only a single connection per LoadQueue
	 * is open at any time.
	 */
	p.setMaxConnections = function (value) {
		this._maxConnections = value;
		if (!this._paused && this._loadQueue.length > 0) {
			this._loadNext();
		}
	}

	/**
	 * Load a single file. To add multiple files at once, use the {{#crossLink "LoadQueue/loadManifest"}}{{/crossLink}}
	 * method.
	 *
	 * Note that files are always appended to the current queue, so this method can be used multiple times to add files.
	 * To clear the queue first, use the {{#crossLink "AbstractLoader/close"}}{{/crossLink}} method.
	 * @method loadFile
	 * @param {Object | String} file The file object or path to load. A file can be either
	 * <ol>
	 *     <li>a path to a resource (string). Note that this kind of load item will be
	 *     converted to an object (see below) in the background.</li>
	 *     <li>OR an object that contains:<ul>
	 *         <li>src: The source of the file that is being loaded. This property is <b>required</b>. The source can
	 *         either be a string (recommended), or an HTML tag.</li>
	 *         <li>type: The type of file that will be loaded (image, sound, json, etc). PreloadJS does auto-detection
	 *         of types using the extension. Supported types are defined on LoadQueue, such as <code>LoadQueue.IMAGE</code>.
	 *         It is recommended that a type is specified when a non-standard file URI (such as a php script) us used.</li>
	 *         <li>id: A string identifier which can be used to reference the loaded object.</li>
	 *         <li>callback: Optional, used for JSONP requests, to define what method to call when the JSONP is loaded.</li>
	 *         <li>data: An arbitrary data object, which is included with the loaded object</li>
	 *         <li>method: used to define if this request uses GET or POST when sending data to the server. Default; GET</li>
	 *         <li>values: Optional object of name/value pairs to send to the server.</li>
	 *     </ul>
	 * </ol>
	 * @param {Boolean} [loadNow=true] Kick off an immediate load (true) or wait for a load call (false). The default
	 * value is true. If the queue is paused using {{#crossLink "LoadQueue/setPaused"}}{{/crossLink}}, and the value is
	 * true, the queue will resume automatically.
	 * @param {String} [basePath] An optional base path prepended to the file source when the file is loaded.
	 * Sources beginning with http:// or similar will not receive a base path.
	 * The load item will not be modified.
	 */
	p.loadFile = function(file, loadNow, basePath) {
		if (file == null) {
			var event = new createjs.Event("error");
			event.text = "PRELOAD_NO_FILE";
			this._sendError(event);
			return;
		}
		this._addItem(file, basePath);

		if (loadNow !== false) {
			this.setPaused(false);
		} else {
			this.setPaused(true);
		}
	}

	/**
	 * Load an array of items. To load a single file, use the {{#crossLink "LoadQueue/loadFile"}}{{/crossLink}} method.
	 * The files in the manifest are requested in the same order, but may complete in a different order if the max
	 * connections are set above 1 using {{#crossLink "LoadQueue/setMaxConnections"}}{{/crossLink}}. Scripts will load
	 * in the right order as long as <code>loadQueue.maintainScriptOrder</code> is true (which is default).
	 *
	 * Note that files are always appended to the current queue, so this method can be used multiple times to add files.
	 * To clear the queue first, use the {{#crossLink "AbstractLoader/close"}}{{/crossLink}} method.
	 * @method loadManifest
	 * @param {Array} manifest The list of files to load. Each file can be either:
	 * <ol>
	 *     <li>a path to a resource (string). Note that this kind of load item will be
	 *      converted to an object (see below) in the background.</li>
	 *     <li>OR an object that contains:<ul>
	 *         <li>src: The source of the file that is being loaded. This property is <b>required</b>.
	 *         The source can either be a string (recommended), or an HTML tag. </li>
	 *         <li>type: The type of file that will be loaded (image, sound, json, etc). PreloadJS does auto-detection
	 *         of types using the extension. Supported types are defined on LoadQueue, such as <code>LoadQueue.IMAGE</code>.
	 *         It is recommended that a type is specified when a non-standard file URI (such as a php script) us used.</li>
	 *         <li>id: A string identifier which can be used to reference the loaded object.</li>
	 *         <li>data: An arbitrary data object, which is returned with the loaded object</li>
	 *     </ul>
	 * </ol>
	 * @param {Boolean} [loadNow=true] Kick off an immediate load (true) or wait for a load call (false). The default
	 * value is true. If the queue is paused using {{#crossLink "LoadQueue/setPaused"}}{{/crossLink}} and this value is
	 * true, the queue will resume automatically.
	 * @param {String} [basePath] An optional base path prepended to each of the files' source when the file is loaded.
	 * Sources beginning with http:// or similar will not receive a base path.
	 * The load items will not be modified.
	 */
	p.loadManifest = function(manifest, loadNow, basePath) {
		var data = null;

		if (manifest instanceof Array) {
			if (manifest.length == 0) {
				var event = new createjs.Event("error");
				event.text = "PRELOAD_MANIFEST_EMPTY";
				this._sendError(event);
				return;
			}
			data = manifest;
		} else {
			if (manifest == null) {
				var event = new createjs.Event("error");
				event.text = "PRELOAD_MANIFEST_NULL";
				this._sendError(event);
				return;
			}
			data = [manifest];
		}

		for (var i=0, l=data.length; i<l; i++) {
			this._addItem(data[i], basePath);
		}

		if (loadNow !== false) {
			this.setPaused(false);
		} else {
			this.setPaused(true);
		}

	};

	// Overrides abstract method in AbstractLoader
	p.load = function() {
		this.setPaused(false);
	};

	/**
	 * Look up a load item using either the "id" or "src" that was specified when loading it.
	 * @method getItem
	 * @param {String} value The <code>id</code> or <code>src</code> of the load item.
	 * @return {Object} The load item that was initially requested using {{#crossLink "LoadQueue/loadFile"}}{{/crossLink}}
	 * or {{#crossLink "LoadQueue/loadManifest"}}{{/crossLink}}. This object is also returned via the "fileload" event
	 * as the "item" parameter.
	 */
	p.getItem = function(value) {
		return this._loadItemsById[value] || this._loadItemsBySrc[value];
	};

	/**
	 * Look up a loaded result using either the "id" or "src" that was specified when loading it.
	 * @method getResult
	 * @param {String} value The <code>id</code> or <code>src</code> of the load item.
	 * @param {Boolean} [rawResult=false] Return a raw result instead of a formatted result. This applies to content
	 * loaded via XHR such as scripts, XML, CSS, and Images. If there is no raw result, the formatted result will be
	 * returned instead.
	 * @return {Object} A result object containing the content that was loaded, such as:
	 * <ul>
	 *      <li>An image tag (&lt;image /&gt;) for images</li>
	 *      <li>A script tag for JavaScript (&lt;script /&gt;). Note that scripts loaded with tags may be added to the
	 *      HTML head.</li>
	 *      <li>A style tag for CSS (&lt;style /&gt;)</li>
	 *      <li>Raw text for TEXT</li>
	 *      <li>A formatted JavaScript object defined by JSON</li>
	 *      <li>An XML document</li>
	 *      <li>An binary arraybuffer loaded by XHR</li>
	 *      <li>An audio tag (&lt;audio &gt;) for HTML audio. Note that it is recommended to use SoundJS APIs to play
	 *      loaded audio. Specifically, audio loaded by Flash and WebAudio will return a loader object using this method
	 *      which can not be used to play audio back.</li>
	 * </ul>
	 * This object is also returned via the "fileload" event as the "item" parameter. Note that if a raw result is
	 * requested, but not found, the result will be returned instead.
	 */
	p.getResult = function(value, rawResult) {
		var item = this._loadItemsById[value] || this._loadItemsBySrc[value];
//        console.log(this._loadItemsById[value], item, this._loadedResults);
		if (item == null) { return null; }
		var id = item.id;
		if (rawResult && this._loadedRawResults[id]) {
			return this._loadedRawResults[id];
		}
		return this._loadedResults[id];
	};

	/**
	 * Pause or resume the current load. Active loads will not be cancelled, but the next items in the queue will not
	 * be processed when active loads complete. LoadQueues are not paused by default.
	 * @method setPaused
	 * @param {Boolean} value Whether the queue should be paused or not.
	 */
	p.setPaused = function(value) {
		this._paused = value;
		if (!this._paused) {
			this._loadNext();
		}
	};

	// Overrides abstract method in AbstractLoader
	p.close = function() {
		while (this._currentLoads.length) {
			this._currentLoads.pop().cancel();
		}
		this._scriptOrder.length = 0;
		this._loadedScripts.length = 0;
		this.loadStartWasDispatched = false;
	};


//Protected Methods
	/**
	 * Add an item to the queue. Items are formatted into a usable object containing all the properties necessary to
	 * load the content. The load queue is populated with the loader instance that handles preloading, and not the load
	 * item that was passed in by the user. To look up the load item by id or src, use the {{#crossLink "LoadQueue.getItem"}}{{/crossLink}}
	 * method.
	 * @method _addItem
	 * @param {String|Object} value The item to add to the queue.
	 * @param {String} basePath A path to prepend to the item's source.
	 * 	Sources beginning with http:// or similar will not receive a base path.
	 * @private
	 */
	p._addItem = function(value, basePath) {
		var item = this._createLoadItem(value);
		if (item == null) { return; } // Sometimes plugins or types should be skipped.
		var loader = this._createLoader(item, basePath);
		if (loader != null) {
			this._loadQueue.push(loader);
			this._loadQueueBackup.push(loader);

			this._numItems++;
			this._updateProgress();

			// Only worry about script order when using XHR to load scripts. Tags are only loading one at a time.
			if (this.maintainScriptOrder
				&& item.type == createjs.LoadQueue.JAVASCRIPT
				&& loader instanceof createjs.XHRLoader) {
				this._scriptOrder.push(item);
				this._loadedScripts.push(null);
			}
		}
	};

	/**
	 * Create a refined load item, which contains all the required properties (src, type, extension, tag). The type of
	 * item is determined by browser support, requirements based on the file type, and developer settings. For example,
	 * XHR is only used for file types that support it in new browsers.
	 *
	 * Before the item is returned, any plugins registered to handle the type or extension will be fired, which may
	 * alter the load item.
	 * @method _createLoadItem
	 * @param {String | Object | HTMLAudioElement | HTMLImageElement} value The item that needs to be preloaded.
	 * @return {Object} The loader instance that will be used.
	 * @private
	 */
	p._createLoadItem = function(value) {
		var item = null;

		// Create/modify a load item
		switch(typeof(value)) {
			case "string":
				item = {
					src: value
				}; break;
			case "object":
				if (window.HTMLAudioElement && value instanceof HTMLAudioElement) {
					item = {
						tag: value,
						src: item.tag.src,
						type: createjs.LoadQueue.SOUND
					};
				} else {
					item = value;
				}
				break;
			default:
				return null;
		}

		// Note: This does NOT account for basePath. It should be fine.
		var match = this._parseURI(item.src);
		if (match != null) { item.ext = match[5]; }
		if (item.type == null) {
			item.type = this._getTypeByExtension(item.ext);
		}

		if (item.type == createjs.LoadQueue.JSON && item.callback != null) {
			item.type = createjs.LoadQueue.JSONP;
		}

		if (item.type == createjs.LoadQueue.JSONP && item.callback == null) {
			throw new Error('callback is required for loading JSONP requests.');
		}

		// Create a tag for the item. This ensures there is something to either load with or populate when finished.
		if (item.tag == null) {
			item.tag = this._createTag(item.type);
		}

		// If there's no id, set one now.
		if (item.id == null || item.id == "") {
			item.id = item.src;
		}

		// Give plugins a chance to modify the loadItem:
		var customHandler = this._typeCallbacks[item.type] || this._extensionCallbacks[item.ext];
		if (customHandler) {
			var result = customHandler(item.src, item.type, item.id, item.data);
			//Plugin will handle the load, so just ignore it.
			if (result === false) {
				return null;

				// Load as normal:
			} else if (result === true) {
				// Do Nothing

				// Result is a loader class:
			} else {
				if (result.src != null) { item.src = result.src; }
				if (result.id != null) { item.id = result.id; }
				if (result.tag != null && result.tag.load instanceof Function) { //Item has what we need load
					item.tag = result.tag;
				}
				if (result.completeHandler != null) {item.completeHandler = result.completeHandler;}  // we have to call back this function when we are done loading
			}

			// Allow type overriding:
			if (result.type) { item.type = result.type; }

			// Update the extension in case the type changed:
			match = this._parseURI(item.src);
			if (match != null && match[5] != null) { item.ext = match[5].toLowerCase(); }
		}

		// Store the item for lookup. This also helps clean-up later.
		this._loadItemsById[item.id] = item;
		this._loadItemsBySrc[item.src] = item;

		return item;
	};

	/**
	 * Create a loader for a load item.
	 * @method _createLoader
	 * @param {Object} item A formatted load item that can be used to generate a loader.
	 * @param {String} basePath A path that will be prepended on to the source parameter of all items in the queue before they are loaded. Note that a basePath provided to any loadFile or loadManifest call will override the basePath specified on the LoadQueue constructor.
	 * @return {AbstractLoader} A loader that can be used to load content.
	 * @private
	 */
	p._createLoader = function(item, basePath) {
		// Initially, try and use the provided/supported XHR mode:
		var useXHR = this.useXHR;

		// Determine the XHR usage overrides:
		switch (item.type) {
			case createjs.LoadQueue.JSON:
			case createjs.LoadQueue.XML:
			case createjs.LoadQueue.TEXT:
				useXHR = true; // Always use XHR2 with text/XML
				break;
			case createjs.LoadQueue.SOUND:
			case createjs.LoadQueue.VIDEO:
			case createjs.LoadQueue.JSONP:
				useXHR = false; // Never load audio using XHR. WebAudio will provide its own loader.
				break;
			case null:
				return null;
			// Note: IMAGE, CSS, SCRIPT, SVG can all use TAGS or XHR.
		}

		// If no basepath was provided here (from _addItem), then use the LoadQueue._basePath instead.
		if (basePath == null) { basePath = this._basePath; }

		if (useXHR) {
			return new createjs.XHRLoader(item, basePath);
		} else {
			return new createjs.TagLoader(item, basePath);
		}
	};


	/**
	 * Load the next item in the queue. If the queue is empty (all items have been loaded), then the complete event
	 * is processed. The queue will "fill up" any empty slots, up to the max connection specified using
	 * {{#crossLink "LoadQueue.setMaxConnections"}}{{/crossLink}} method. The only exception is scripts that are loaded
	 * using tags, which have to be loaded one at a time to maintain load order.
	 * @method _loadNext
	 * @private
	 */
	p._loadNext = function() {
		if (this._paused) { return; }

		// Only dispatch loadstart event when the first file is loaded.
		if (!this._loadStartWasDispatched) {
			this._sendLoadStart();
			this._loadStartWasDispatched = true;
		}

		// The queue has completed.
		if (this._numItems == this._numItemsLoaded) {
			this.loaded = true;
			this._sendComplete();

			// Load the next queue, if it has been defined.
			if (this.next && this.next.load) {
				this.next.load();
			}
		} else {
			this.loaded = false;
		}

		// Must iterate forwards to load in the right order.
		for (var i=0; i<this._loadQueue.length; i++) {
			if (this._currentLoads.length >= this._maxConnections) { break; }
			var loader = this._loadQueue[i];

			// Determine if we should be only loading one at a time:
			if (this.maintainScriptOrder
				&& loader instanceof createjs.TagLoader
				&& loader.getItem().type == createjs.LoadQueue.JAVASCRIPT) {
				if (this._currentlyLoadingScript) { continue; } // Later items in the queue might not be scripts.
				this._currentlyLoadingScript = true;
			}
			this._loadQueue.splice(i, 1);
			i--;
			this._loadItem(loader);
		}
	};

	/**
	 * Begin loading an item. Events are not added to the loaders until the load starts.
	 * @method _loadItem
	 * @param {AbstractLoader} loader The loader instance to start. Currently, this will be an XHRLoader or TagLoader.
	 * @private
	 */
	p._loadItem = function(loader) {
//        console.log(loader);
		loader.addEventListener("progress", createjs.proxy(this._handleProgress, this));
		loader.addEventListener("complete", createjs.proxy(this._handleFileComplete, this));
		loader.addEventListener("error", createjs.proxy(this._handleFileError, this));
		this._currentLoads.push(loader);
		this._sendFileStart(loader.getItem());
		loader.load();
	};

	/**
	 * The callback that is fired when a loader encounters an error. The queue will continue loading unless {{#crossLink "LoadQueue/stopOnError:property"}}{{/crossLink}}
	 * is set to `true`.
	 * @method _handleFileError
	 * @param {Object} event The error event, containing relevant error information.
	 * @private
	 */
	p._handleFileError = function(event) {
		var loader = event.target;
		this._numItemsLoaded++;
		this._updateProgress();

		var event = new createjs.Event("error");
		event.text = "FILE_LOAD_ERROR";
		event.item = loader.getItem();
		// TOOD: Propagate actual error message.

		this._sendError(event);

		if (!this.stopOnError) {
			this._removeLoadItem(loader);
			this._loadNext();
		}
	};

	/**
	 * An item has finished loading. We can assume that it is totally loaded, has been parsed for immediate use, and
	 * is available as the "result" property on the load item. The raw text result for a parsed item (such as JSON, XML,
	 * CSS, JavaScript, etc) is available as the "rawResult" event, and can also be looked up using {{#crossLink "LoadQueue/getResult"}}{{/crossLink}}.
	 * @method _handleFileComplete
	 * @param {Object} event The event object from the loader.
	 * @private
	 */
	p._handleFileComplete = function(event) {
//        console.log('_handleFileComplete', event);
		var loader = event.target;
		var item = loader.getItem();

		this._loadedResults[item.id] = loader.getResult();
		if (loader instanceof createjs.XHRLoader) {
			this._loadedRawResults[item.id] = loader.getResult(true);
		}

		this._removeLoadItem(loader);

		// Ensure that script loading happens in the right order.
		if (this.maintainScriptOrder && item.type == createjs.LoadQueue.JAVASCRIPT) {
			if (loader instanceof createjs.TagLoader) {
				this._currentlyLoadingScript = false;
			} else {
				this._loadedScripts[createjs.indexOf(this._scriptOrder, item)] = item;
				this._checkScriptLoadOrder(loader);
				return;
			}
		}

		this._processFinishedLoad(item, loader);
	}

	p._processFinishedLoad = function(item, loader) {
		// Old handleFileTagComplete follows here.
		this._numItemsLoaded++;

		this._updateProgress();
		this._sendFileComplete(item, loader);

		this._loadNext();
	};

	/**
	 * Ensure the scripts load and dispatch in the correct order. When using XHR, scripts are stored in an array in the
	 * order they were added, but with a "null" value. When they are completed, the value is set to the load item,
	 * and then when they are processed and dispatched, the value is set to <code>true</code>. This method simply
	 * iterates the array, and ensures that any loaded items that are not preceded by a <code>null</code> value are
	 * dispatched.
	 * @method _checkScriptLoadOrder
	 * @private
	 */
	p._checkScriptLoadOrder = function () {
		var l = this._loadedScripts.length;

		for (var i=0;i<l;i++) {
			var item = this._loadedScripts[i];
			if (item === null) { break; } // This is still loading. Do not process further.
			if (item === true) { continue; } // This has completed, and been processed. Move on.

			// This item has finished, and is the next one to get dispatched.
			this._processFinishedLoad(item);
			this._loadedScripts[i] = true;
			i--; l--;
		}
	};

	/**
	 * A load item is completed or was canceled, and needs to be removed from the LoadQueue.
	 * @method _removeLoadItem
	 * @param {AbstractLoader} loader A loader instance to remove.
	 * @private
	 */
	p._removeLoadItem = function(loader) {
		var l = this._currentLoads.length;
		for (var i=0;i<l;i++) {
			if (this._currentLoads[i] == loader) {
				this._currentLoads.splice(i,1); break;
			}
		}
	};

	/**
	 * An item has dispatched progress. Propagate that progress, and update the LoadQueue overall progress.
	 * @method _handleProgress
	 * @param {Object} event The progress event from the item.
	 * @private
	 */
	p._handleProgress = function(event) {
		var loader = event.target;
		this._sendFileProgress(loader.getItem(), loader.progress);
		this._updateProgress();
	};

	/**
	 * Overall progress has changed, so determine the new progress amount and dispatch it. This changes any time an
	 * item dispatches progress or completes. Note that since we don't know the actual filesize of items before they are
	 * loaded, and even then we can only get the size of items loaded with XHR. In this case, we define a "slot" for
	 * each item (1 item in 10 would get 10%), and then append loaded progress on top of the already-loaded items.
	 *
	 * For example, if 5/10 items have loaded, and item 6 is 20% loaded, the total progress would be:<ul>
	 *      <li>5/10 of the items in the queue (50%)</li>
	 *      <li>plus 20% of item 6's slot (2%)</li>
	 *      <li>equals 52%</li></ul>
	 * @method _updateProgress
	 * @private
	 */
	p._updateProgress = function () {
		var loaded = this._numItemsLoaded / this._numItems; // Fully Loaded Progress
		var remaining = this._numItems-this._numItemsLoaded;
		if (remaining > 0) {
			var chunk = 0;
			for (var i=0, l=this._currentLoads.length; i<l; i++) {
				chunk += this._currentLoads[i].progress;
			}
			loaded += (chunk / remaining) * (remaining/this._numItems);
		}
		this._sendProgress(loaded);
	}

	/**
	 * Clean out item results, to free them from memory. Mainly, the loaded item and results are cleared from internal
	 * hashes.
	 * @method _disposeItem
	 * @param {Object} item The item that was passed in for preloading.
	 * @private
	 */
	p._disposeItem = function(item) {
		delete this._loadedResults[item.id];
		delete this._loadedRawResults[item.id];
		delete this._loadItemsById[item.id];
		delete this._loadItemsBySrc[item.src];
	};


	/**
	 * Create an HTML tag. This is in LoadQueue instead of {{#crossLink "TagLoader"}}{{/crossLink}} because no matter
	 * how we load the data, we may need to return it in a tag.
	 * @method _createTag
	 * @param {String} type The item type. Items are passed in by the developer, or deteremined by the extension.
	 * @return {HTMLImageElement|HTMLAudioElement|HTMLScriptElement|HTMLLinkElement|Object} The tag that is created.
	 * Note that tags are not appended to the HTML body.
	 * @private
	 */
	p._createTag = function(type) {
		var tag = null;
		switch (type) {
			case createjs.LoadQueue.IMAGE:
				return document.createElement("img");
			case createjs.LoadQueue.SOUND:
				tag = document.createElement("audio");
				tag.autoplay = false;
				// Note: The type property doesn't seem necessary.
				return tag;
			case createjs.LoadQueue.VIDEO:
				tag = document.createElement("video");
				tag.autoplay = false;
				// Note: The type property doesn't seem necessary.
				return tag;
			case createjs.LoadQueue.JSONP:
			case createjs.LoadQueue.JAVASCRIPT:
				tag = document.createElement("script");
				tag.type = "text/javascript";
				return tag;
			case createjs.LoadQueue.CSS:
				if (this.useXHR) {
					tag = document.createElement("style");
				} else {
					tag = document.createElement("link");
				}
				tag.rel  = "stylesheet";
				tag.type = "text/css";
				return tag;
			case createjs.LoadQueue.SVG:
				if (this.useXHR) {
					tag = document.createElement("svg");
				} else {
					tag = document.createElement("object");
					tag.type = "image/svg+xml";
				}
				return tag;
		}
		return null;
	};

	/**
	 * Determine the type of the object using common extensions. Note that the type can be passed in with the load item
	 * if it is an unusual extension.
	 * @param {String} extension The file extension to use to determine the load type.
	 * @return {String} The determined load type (for example, <code>LoadQueue.IMAGE</code> or null if it can not be
	 * determined by the extension.
	 * @private
	 */
	p._getTypeByExtension = function(extension) {
		if (extension == null) {
			return createjs.LoadQueue.TEXT;
		}
		switch (extension.toLowerCase()) {
			case "jpeg":
			case "jpg":
			case "gif":
			case "png":
			case "webp":
			case "bmp":
				return createjs.LoadQueue.IMAGE;
			case "ogg":
			case "mp3":
			case "wav":
				return createjs.LoadQueue.SOUND;
			case "mp4":
			case "webm":
			case "ogv":
				return createjs.LoadQueue.VIDEO;
			case "json":
				return createjs.LoadQueue.JSON;
			case "xml":
				return createjs.LoadQueue.XML;
			case "css":
				return createjs.LoadQueue.CSS;
			case "js":
				return createjs.LoadQueue.JAVASCRIPT;
			case 'svg':
				return createjs.LoadQueue.SVG;
			default:
				return createjs.LoadQueue.TEXT;
		}
	};

	/**
	 * Dispatch a fileprogress event (and onFileProgress callback). Please see the <code>LoadQueue.fileprogress</code>
	 * event for details on the event payload.
	 * @method _sendFileProgress
	 * @param {Object} item The item that is being loaded.
	 * @param {Number} progress The amount the item has been loaded (between 0 and 1).
	 * @protected
	 */
	p._sendFileProgress = function(item, progress) {
		if (this._isCanceled()) {
			this._cleanUp();
			return;
		}
		if (!this.hasEventListener("fileprogress")) { return; }

		var event = new createjs.Event("fileprogress");
		event.progress = progress;
		event.loaded = progress;
		event.total = 1;
		event.item = item;

		this.dispatchEvent(event);
	};

	/**
	 * Dispatch a fileload event. Please see the {{#crossLink "LoadQueue/fileload:event"}}{{/crossLink}} event for
	 * details on the event payload.
	 * @method _sendFileComplete
	 * @param {Object} item The item that is being loaded.
	 * @param {TagLoader | XHRLoader} loader
	 * @protected
	 */
	p._sendFileComplete = function(item, loader) {
		if (this._isCanceled()) { return; }

		var event = new createjs.Event("fileload");
		event.loader = loader;
		event.item = item;
		event.result = this._loadedResults[item.id];
		event.rawResult = this._loadedRawResults[item.id];

		// This calls a handler specified on the actual load item. Currently, the SoundJS plugin uses this.
		if (item.completeHandler) {
			item.completeHandler(event);
		}

		this.hasEventListener("fileload") && this.dispatchEvent(event)
	};

	/**
	 * Dispatch a filestart event immediately before a file starts to load. Please see the {{#crossLink "LoadQueue/filestart:event"}}{{/crossLink}}
	 * event for details on the event payload.
	 * @method _sendFileStart
	 * @param {TagLoader | XHRLoader} loader
	 * @protected
	 */
	p._sendFileStart = function(item) {
		var event = new createjs.Event("filestart");
		event.item = item;
		this.hasEventListener("filestart") && this.dispatchEvent(event);
	};

	p.toString = function() {
		return "[PreloadJS LoadQueue]";
	};

	/**
	 * REMOVED.  Use createjs.proxy instead
	 * @method proxy
	 * @param {Function} method The function to call
	 * @param {Object} scope The scope to call the method name on
	 * @static
	 * @private
	 * @deprecated In favour of the createjs.proxy method (see LoadQueue source).
	 */

	createjs.LoadQueue = LoadQueue;


// Helper methods

	// An additional module to determine the current browser, version, operating system, and other environmental variables.
	var BrowserDetect = function() {}

	BrowserDetect.init = function() {
		var agent = navigator.userAgent;
		BrowserDetect.isFirefox = (agent.indexOf("Firefox") > -1);
		BrowserDetect.isOpera = (window.opera != null);
		BrowserDetect.isChrome = (agent.indexOf("Chrome") > -1);
		BrowserDetect.isIOS = agent.indexOf("iPod") > -1 || agent.indexOf("iPhone") > -1 || agent.indexOf("iPad") > -1;
	}

	BrowserDetect.init();

	createjs.LoadQueue.BrowserDetect = BrowserDetect;

}());

this.createjs = this.createjs||{};

(function() {
	"use strict";
	/**
	 * A preloader that loads items using a tag-based approach. HTML audio and images can use this loader to load
	 * content cross-domain without security errors, whereas anything loaded with XHR has potential issues with cross-
	 * domain requests.
	 *
	 * Note for audio tags, TagLoader relies on the <code>canPlayThrough</code> event, which fires when the buffer
	 * is full enough to play the audio all the way through at the current download speed. This completely preloads most
	 * sound effects, however longer tracks like background audio will only load a portion before the event is fired.
	 * Most browsers (all excluding Chrome) will continue to preload once this is fired, so this is considered good
	 * enough for most cases.
	 * @class TagLoader
	 * @constructor
	 * @extends AbstractLoader
	 * @param {Object} item The item to load. Please see {{#crossLink "LoadQueue/loadFile"}}{{/crossLink}} for
	 * information on load items.
	 */
	var TagLoader = function (item, basePath) {
		this.init(item, basePath);
	};

	var p = TagLoader.prototype = new createjs.AbstractLoader();

// Protected

	/**
	 * The timeout that is fired if nothing is loaded after a certain delay. See the <code>LoadQueue.LOAD_TIMEOUT</code>
	 * for the timeout duration.
	 * @property _loadTimeout
	 * @type {Number}
	 * @private
	 */
	p._loadTimeout = null;

	/**
	 * A reference to a bound function, which we need in order to properly remove the event handler when the load
	 * completes.
	 * @property _tagCompleteProxy
	 * @type {Function}
	 * @private
	 */
	p._tagCompleteProxy = null;

	/**
	 * Determines if the load item is an audio tag, since we take some specific approaches to properly load audio.
	 * @property _isAudio
	 * @type {Boolean}
	 * @default false
	 */
	p._isAudio = false;

	/**
	 * Determines if the load item is an audio tag, since we take some specific approaches to properly load audio.
	 * @property _isAudio
	 * @type {Boolean}
	 * @default false
	 */
	p._isVideo = false;

	/**
	 * The HTML tag or JavaScript object this loader uses to preload content. Note that a tag may be a custom object
	 * that matches the API of an HTML tag (load method, onload callback). For example, flash audio from SoundJS passes
	 * in a custom object to handle preloading for Flash audio and WebAudio.
	 * @property _tag
	 * @type {HTMLAudioElement | Object}
	 * @private
	 */
	p._tag = null;

	/**
	 * When loading a JSONP request this will be the parsed JSON result.
	 *
	 * @type {Object}
	 * @private
	 */
	p._jsonResult = null;

	// Overrides abstract method in AbstractLoader
	p.init = function (item, basePath) {
		this._item = item;
		this._basePath = basePath;
		this._tag = item.tag;
		this._isAudio = (window.HTMLAudioElement && item.tag instanceof HTMLAudioElement);
		this._isVideo = (window.HTMLVideoElement && item.tag instanceof HTMLVideoElement);
		this._tagCompleteProxy = createjs.proxy(this._handleLoad, this);
	};

	/**
	 * Get the loaded content. This is usually an HTML tag or other tag-style object that has been fully loaded. If the
	 * loader is not complete, this will be null.
	 * @method getResult
	 * @return {HTMLImageElement | HTMLAudioElement | Object} The loaded and parsed content.
	 */
	p.getResult = function() {
		if (this._item.type == createjs.LoadQueue.JSONP) {
			return this._jsonResult;
		} else {
			return this._tag;
		}
	};

	// Overrides abstract method in AbstractLoader
	p.cancel = function() {
		this.canceled = true;
		this._clean();
		var item = this.getItem();
	};

	// Overrides abstract method in AbstractLoader
	p.load = function() {
		var item = this._item;
		var tag = this._tag;

		// In case we don't get any events.
		clearTimeout(this._loadTimeout); // Clear out any existing timeout
		this._loadTimeout = setTimeout(createjs.proxy(this._handleTimeout, this), createjs.LoadQueue.LOAD_TIMEOUT);

		if (this._isAudio || this._isVideo) {
			tag.src = null; // Unset the source so we can set the preload type to "auto" without kicking off a load. This is only necessary for audio tags passed in by the developer.
			tag.preload = "auto";
		}

//        console.log(tag);
		// Handlers for all tags
		tag.onerror = createjs.proxy(this._handleError,  this);
		// Note: We only get progress events in Chrome, but do not fully load tags in Chrome due to its behaviour, so we ignore progress.

		if (this._isAudio || this._isVideo) {
			tag.onstalled = createjs.proxy(this._handleStalled,  this);
			// This will tell us when audio is buffered enough to play through, but not when its loaded.
			// The tag doesn't keep loading in Chrome once enough has buffered, and we have decided that behaviour is sufficient.
			tag.addEventListener("canplaythrough", this._tagCompleteProxy, false); // canplaythrough callback doesn't work in Chrome, so we use an event.
			tag.addEventListener("load", this._tagCompleteProxy, false); // canplaythrough callback doesn't work in Chrome, so we use an event.
            tag.load();
			tag.onload = createjs.proxy(this._handleLoad,  this);
			tag.onreadystatechange = createjs.proxy(this._handleReadyStateChange,  this);
		} else {
			tag.onload = createjs.proxy(this._handleLoad,  this);
			tag.onreadystatechange = createjs.proxy(this._handleReadyStateChange,  this);
		}

		var src = this.buildPath(item.src, this._basePath, item.values);

		// Set the src after the events are all added.
		switch(item.type) {
			case createjs.LoadQueue.CSS:
				tag.href = src;
				break;
			case createjs.LoadQueue.SVG:
				tag.data = src;
				break;
			default:
				tag.src = src;
		}

		// If we're loading JSONP, we need to add our callback now.
		if (item.type == createjs.LoadQueue.JSONP) {
			if (item.callback == null) {
				throw new Error('callback is required for loading JSONP requests.');
			}

			if (window[item.callback] != null) {
				throw new Error('JSONP callback "' + item.callback + '" already exists on window. You need to specify a different callback. Or re-name the current one.');
			}

			window[item.callback] = createjs.proxy(this._handleJSONPLoad, this);
		}

		// If its SVG, it needs to be on the DOM to load (we remove it before sending complete).
		// It is important that this happens AFTER setting the src/data.
		if (item.type == createjs.LoadQueue.SVG ||
			item.type == createjs.LoadQueue.JSONP ||
			item.type == createjs.LoadQueue.JSON ||
			item.type == createjs.LoadQueue.JAVASCRIPT ||
			item.type == createjs.LoadQueue.CSS) {
			this._startTagVisibility = tag.style.visibility;
			tag.style.visibility = "hidden";
			(document.body || document.getElementsByTagName("body")[0]).appendChild(tag);
		}

		// Note: Previous versions didn't seem to work when we called load() for OGG tags in Firefox. Seems fixed in 15.0.1
		if (tag.load != null) {
			tag.load();
		}
	};

	p._handleJSONPLoad = function(data) {
		this._jsonResult = data;
	};

	/**
	 * Handle an audio timeout. Newer browsers get a callback from the tags, but older ones may require a setTimeout
	 * to handle it. The setTimeout is always running until a response is handled by the browser.
	 * @method _handleTimeout
	 * @private
	 */
	p._handleTimeout = function() {
//        console.log('timeout');
		this._clean();
		var event = new createjs.Event("error");
		event.text = "PRELOAD_TIMEOUT";
		this._sendError(event);
	};

	/**
	 * Handle a stalled audio event. The main place we seem to get these is with HTMLAudio in Chrome when we try and
	 * playback audio that is already in a load, but not complete.
	 * @method _handleStalled
	 * @private
	 */
	p._handleStalled = function() {
		//Ignore, let the timeout take care of it. Sometimes its not really stopped.
	};

	/**
	 * Handle an error event generated by the tag.
	 * @method _handleError
	 * @private
	 */
	p._handleError = function(event) {
		this._clean();

		var newEvent = new createjs.Event("error");
		//TODO: Propagate actual event error?
		this._sendError(newEvent);
	};

	/**
	 * Handle the readyStateChange event from a tag. We sometimes need this in place of the onload event (mainly SCRIPT
	 * and LINK tags), but other cases may exist.
	 * @method _handleReadyStateChange
	 * @private
	 */
	p._handleReadyStateChange = function() {
//        console.log('_handleReadyStateChange');
		clearTimeout(this._loadTimeout);
		// This is strictly for tags in browsers that do not support onload.
		var tag = this.getItem().tag;

		// Complete is for old IE support.
		if (tag.readyState == "loaded" || tag.readyState == "complete") {
			this._handleLoad();
		}
	};

	/**
	 * Handle a load (complete) event. This is called by tag callbacks, but also by readyStateChange and canPlayThrough
	 * events. Once loaded, the item is dispatched to the {{#crossLink "LoadQueue"}}{{/crossLink}}.
	 * @method _handleLoad
	 * @param {Object} [event] A load event from a tag. This is sometimes called from other handlers without an event.
	 * @private
	 */
	p._handleLoad = function(event) {
//        console.log('_handleLoad');
		if (this._isCanceled()) { return; }

		var item = this.getItem();
		var tag = item.tag;

		if (this.loaded || this.isAudio || this.isVideo && tag.readyState !== 4) { return; } //LM: Not sure if we still need the audio check.
		this.loaded = true;

		// Remove from the DOM
		switch (item.type) {
			case createjs.LoadQueue.SVG:
			case createjs.LoadQueue.JSONP:
				// case createjs.LoadQueue.CSS:
				//LM: We may need to remove CSS tags loaded using a LINK
				tag.style.visibility = this._startTagVisibility;
				(document.body || document.getElementsByTagName("body")[0]).removeChild(tag);
				break;
			default:
		}

		this._clean();
		this._sendComplete();
	};

	/**
	 * Clean up the loader.
	 * This stops any timers and removes references to prevent errant callbacks and clean up memory.
	 * @method _clean
	 * @private
	 */
	p._clean = function() {
		clearTimeout(this._loadTimeout);

		// Delete handlers.
		var tag = this.getItem().tag;
		tag.onload = null;
		tag.removeEventListener && tag.removeEventListener("canplaythrough", this._tagCompleteProxy, false);
		tag.onstalled = null;
		tag.onprogress = null;
		tag.onerror = null;

		//TODO: Test this
		if (tag.parentNode) {
			tag.parentNode.removeChild(tag);
		}

		var item = this.getItem();
		if (item.type == createjs.LoadQueue.JSONP) {
			window[item.callback] = null;
		}
	};

	p.toString = function() {
		return "[PreloadJS TagLoader]";
	}

	createjs.TagLoader = TagLoader;

}());



(function () {
	"use strict";

	/**
	 * A preloader that loads items using XHR requests, usually XMLHttpRequest. However XDomainRequests will be used
	 * for cross-domain requests if possible, and older versions of IE fall back on to ActiveX objects when necessary.
	 * XHR requests load the content as text or binary data, provide progress and consistent completion events, and
	 * can be canceled during load. Note that XHR is not supported in IE 6 or earlier, and is not recommended for
	 * cross-domain loading.
	 * @class XHRLoader
	 * @constructor
	 * @param {Object} item The object that defines the file to load. Please see the {{#crossLink "LoadQueue/loadFile"}}{{/crossLink}}
	 * for an overview of supported file properties.
	 * @extends AbstractLoader
	 */
	var XHRLoader = function (item, basePath) {
		this.init(item, basePath);
	};

	var p = XHRLoader.prototype = new createjs.AbstractLoader();

	//Protected
	/**
	 * A reference to the XHR request used to load the content.
	 * @property _request
	 * @type {XMLHttpRequest | XDomainRequest | ActiveX.XMLHTTP}
	 * @private
	 */
	p._request = null;

	/**
	 * A manual load timeout that is used for browsers that do not support the onTimeout event on XHR (XHR level 1,
	 * typically IE9).
	 * @property _loadTimeout
	 * @type {Number}
	 * @private
	 */
	p._loadTimeout = null;

	/**
	 * The browser's XHR (XMLHTTPRequest) version. Supported versions are 1 and 2. There is no official way to detect
	 * the version, so we use capabilities to make a best guess.
	 * @property _xhrLevel
	 * @type {Number}
	 * @default 1
	 * @private
	 */
	p._xhrLevel = 1;

	/**
	 * The response of a loaded file. This is set because it is expensive to look up constantly. This property will be
	 * null until the file is loaded.
	 * @property _response
	 * @type {mixed}
	 * @private
	 */
	p._response = null;

	/**
	 * The response of the loaded file before it is modified. In most cases, content is converted from raw text to
	 * an HTML tag or a formatted object which is set to the <code>result</code> property, but the developer may still
	 * want to access the raw content as it was loaded.
	 * @property _rawResponse
	 * @type {String|Object}
	 * @private
	 */
	p._rawResponse = null;

	// Overrides abstract method in AbstractLoader
	p.init = function (item, basePath) {
		this._item = item;
		this._basePath = basePath;
		if (!this._createXHR(item)) {
			//TODO: Throw error?
		}
	};

	/**
	 * Look up the loaded result.
	 * @method getResult
	 * @param {Boolean} [rawResult=false] Return a raw result instead of a formatted result. This applies to content
	 * loaded via XHR such as scripts, XML, CSS, and Images. If there is no raw result, the formatted result will be
	 * returned instead.
	 * @return {Object} A result object containing the content that was loaded, such as:
	 * <ul>
	 *      <li>An image tag (&lt;image /&gt;) for images</li>
	 *      <li>A script tag for JavaScript (&lt;script /&gt;). Note that scripts loaded with tags may be added to the
	 *      HTML head.</li>
	 *      <li>A style tag for CSS (&lt;style /&gt;)</li>
	 *      <li>Raw text for TEXT</li>
	 *      <li>A formatted JavaScript object defined by JSON</li>
	 *      <li>An XML document</li>
	 *      <li>An binary arraybuffer loaded by XHR</li>
	 * </ul>
	 * Note that if a raw result is requested, but not found, the result will be returned instead.
	 */
	p.getResult = function (rawResult) {
		if (rawResult && this._rawResponse) {
			return this._rawResponse;
		}
		return this._response;
	};

	// Overrides abstract method in AbstractLoader
	p.cancel = function () {
		this.canceled = true;
		this._clean();
		this._request.abort();
	};

	// Overrides abstract method in AbstractLoader
	p.load = function () {
		if (this._request == null) {
			this._handleError();
			return;
		}

		//Events
		this._request.onloadstart = createjs.proxy(this._handleLoadStart, this);
		this._request.onprogress = createjs.proxy(this._handleProgress, this);
		this._request.onabort = createjs.proxy(this._handleAbort, this);
		this._request.onerror = createjs.proxy(this._handleError, this);
		this._request.ontimeout = createjs.proxy(this._handleTimeout, this);
		// Set up a timeout if we don't have XHR2
		if (this._xhrLevel == 1) {
			this._loadTimeout = setTimeout(createjs.proxy(this._handleTimeout, this), createjs.LoadQueue.LOAD_TIMEOUT);
		}

		// Note: We don't get onload in all browsers (earlier FF and IE). onReadyStateChange handles these.
		this._request.onload = createjs.proxy(this._handleLoad, this);

		this._request.onreadystatechange = createjs.proxy(this._handleReadyStateChange, this);

		// Sometimes we get back 404s immediately, particularly when there is a cross origin request.  // note this does not catch in Chrome
		try {
			if (!this._item.values || this._item.method == createjs.LoadQueue.GET) {
				this._request.send();
			} else if (this._item.method == createjs.LoadQueue.POST) {
				this._request.send(this._formatQueryString(this._item.values));
			}
		} catch (error) {
			var event = new createjs.Event("error");
			event.error = error;
			this._sendError(event);
		}
	};

	/**
	 * Get all the response headers from the XmlHttpRequest.
	 *
	 * <strong>From the docs:</strong> Return all the HTTP headers, excluding headers that are a case-insensitive match
	 * for Set-Cookie or Set-Cookie2, as a single string, with each header line separated by a U+000D CR U+000A LF pair,
	 * excluding the status line, and with each header name and header value separated by a U+003A COLON U+0020 SPACE
	 * pair.
	 * @method getAllResponseHeaders
	 * @return {String}
	 * @since 0.4.1
	 */
	p.getAllResponseHeaders = function () {
		if  (this._request.getAllResponseHeaders instanceof Function) {
			return this._request.getAllResponseHeaders();
		} else {
			return null;
		}
	};

	/**
	 * Get a specific response header from the XmlHttpRequest.
	 *
	 * <strong>From the docs:</strong> Returns the header field value from the response of which the field name matches
	 * header, unless the field name is Set-Cookie or Set-Cookie2.
	 * @method getResponseHeader
	 * @param {String} header The header name to retrieve.
	 * @return {String}
	 * @since 0.4.1
	 */
	p.getResponseHeader = function (header) {
		if (this._request.getResponseHeader instanceof Function) {
			return this._request.getResponseHeader(header);
		} else {
			return null;
		}
	};

	/**
	 * The XHR request has reported progress.
	 * @method _handleProgress
	 * @param {Object} event The XHR progress event.
	 * @private
	 */
	p._handleProgress = function (event) {
		if (!event || event.loaded > 0 && event.total == 0) {
			return; // Sometimes we get no "total", so just ignore the progress event.
		}

		var newEvent = new createjs.Event("progress");
		newEvent.loaded = event.loaded;
		newEvent.total = event.total;
		this._sendProgress(newEvent);
	};

	/**
	 * The XHR request has reported a load start.
	 * @method _handleLoadStart
	 * @param {Object} event The XHR loadStart event.
	 * @private
	 */
	p._handleLoadStart = function (event) {
		clearTimeout(this._loadTimeout);
		this._sendLoadStart();
	};

	/**
	 * The XHR request has reported an abort event.
	 * @method handleAbort
	 * @param {Object} event The XHR abort event.
	 * @private
	 */
	p._handleAbort = function (event) {
		this._clean();
		var event = new createjs.Event("error");
		event.text = "XHR_ABORTED";
		this._sendError(event);
	};

	/**
	 * The XHR request has reported an error event.
	 * @method _handleError
	 * @param {Object} event The XHR error event.
	 * @private
	 */
	p._handleError = function (event) {
		this._clean();
		var newEvent = new createjs.Event("error");
		//TODO: Propagate event error
		this._sendError(newEvent);
	};

	/**
	 * The XHR request has reported a readyState change. Note that older browsers (IE 7 & 8) do not provide an onload
	 * event, so we must monitor the readyStateChange to determine if the file is loaded.
	 * @method _handleReadyStateChange
	 * @param {Object} event The XHR readyStateChange event.
	 * @private
	 */
	p._handleReadyStateChange = function (event) {
		if (this._request.readyState == 4) {
			this._handleLoad();
		}
	};

	/**
	 * The XHR request has completed. This is called by the XHR request directly, or by a readyStateChange that has
	 * <code>request.readyState == 4</code>. Only the first call to this method will be processed.
	 * @method _handleLoad
	 * @param {Object} event The XHR load event.
	 * @private
	 */
	p._handleLoad = function (event) {
		if (this.loaded) {
			return;
		}
		this.loaded = true;

		if (!this._checkError()) {
			this._handleError();
			return;
		}

		this._response = this._getResponse();
		this._clean();
		var isComplete = this._generateTag();
		if (isComplete) {
			this._sendComplete();
		}
	};

	/**
	 * The XHR request has timed out. This is called by the XHR request directly, or via a <code>setTimeout</code>
	 * callback.
	 * @method _handleTimeout
	 * @param {Object} [event] The XHR timeout event. This is occasionally null when called by the backup setTimeout.
	 * @private
	 */
	p._handleTimeout = function (event) {
		this._clean();
		var newEvent = new createjs.Event("error");
		newEvent.text = "PRELOAD_TIMEOUT";
		//TODO: Propagate actual event error
		this._sendError(event);
	};


// Protected
	/**
	 * Determine if there is an error in the current load. This checks the status of the request for problem codes. Note
	 * that this does not check for an actual response. Currently, it only checks for 404 or 0 error code.
	 * @method _checkError
	 * @return {Boolean} If the request status returns an error code.
	 * @private
	 */
	p._checkError = function () {
		//LM: Probably need additional handlers here, maybe 501
		var status = parseInt(this._request.status);

		switch (status) {
			case 404:   // Not Found
			case 0:     // Not Loaded
				return false;
		}
		return true;
	};

	/**
	 * Validate the response. Different browsers have different approaches, some of which throw errors when accessed
	 * in other browsers. If there is no response, the <code>_response</code> property will remain null.
	 * @method _getResponse
	 * @private
	 */
	p._getResponse = function () {
		if (this._response != null) {
			return this._response;
		}

		if (this._request.response != null) {
			return this._request.response;
		}

		// Android 2.2 uses .responseText
		try {
			if (this._request.responseText != null) {
				return this._request.responseText;
			}
		} catch (e) {
		}

		// When loading XML, IE9 does not return .response, instead it returns responseXML.xml
		//TODO: TEST
		try {
			if (this._request.responseXML != null) {
				return this._request.responseXML;
			}
		} catch (e) {
		}
		return null;
	};

	/**
	 * Create an XHR request. Depending on a number of factors, we get totally different results.
	 * <ol><li>Some browsers get an <code>XDomainRequest</code> when loading cross-domain.</li>
	 *      <li>XMLHttpRequest are created when available.</li>
	 *      <li>ActiveX.XMLHTTP objects are used in older IE browsers.</li>
	 *      <li>Text requests override the mime type if possible</li>
	 *      <li>Origin headers are sent for crossdomain requests in some browsers.</li>
	 *      <li>Binary loads set the response type to "arraybuffer"</li></ol>
	 * @method _createXHR
	 * @param {Object} item The requested item that is being loaded.
	 * @return {Boolean} If an XHR request or equivalent was successfully created.
	 * @private
	 */
	p._createXHR = function (item) {
		// Check for cross-domain loads. We can't fully support them, but we can try.
		var target = document.createElement("a");
		target.href = this.buildPath(item.src, this._basePath);

		var host = document.createElement("a");
		host.href = location.href;

		var crossdomain = (target.hostname != "") &&
			(target.port != host.port ||
				target.protocol != host.protocol ||
				target.hostname != host.hostname);

		// Create the request. Fall back to whatever support we have.
		var req = null;
		if (crossdomain && window.XDomainRequest) {
			req = new XDomainRequest(); // Note: IE9 will fail if this is not actually cross-domain.
		} else if (window.XMLHttpRequest) { // Old IE versions use a different approach
			req = new XMLHttpRequest();
		} else {
			try {
				req = new ActiveXObject("Msxml2.XMLHTTP.6.0");
			} catch (e) {
				try {
					req = new ActiveXObject("Msxml2.XMLHTTP.3.0");
				} catch (e) {
					try {
						req = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						return false;
					}
				}
			}
		}

		// IE9 doesn't support overrideMimeType(), so we need to check for it.
		if (item.type == createjs.LoadQueue.TEXT && req.overrideMimeType) {
			req.overrideMimeType("text/plain; charset=x-user-defined");
		}

		// Determine the XHR level
		this._xhrLevel = (typeof req.responseType === "string") ? 2 : 1;

		var src = null;
		if (item.method == createjs.LoadQueue.GET) {
			src = this.buildPath(item.src, this._basePath, item.values);
		} else {
			src = this.buildPath(item.src, this._basePath);
		}

		// Open the request.  Set cross-domain flags if it is supported (XHR level 1 only)
		req.open(item.method || createjs.LoadQueue.GET, src, true);

		if (crossdomain && req instanceof XMLHttpRequest && this._xhrLevel == 1) {
			req.setRequestHeader("Origin", location.origin);
		}

		// To send data we need to set the Content-type header)
		if (item.values && item.method == createjs.LoadQueue.POST) {
			req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		}

		// Binary files are loaded differently.
		if (createjs.LoadQueue.isBinary(item.type)) {
			req.responseType = "arraybuffer";
		}

		this._request = req;
		return true;
	};

	/**
	 * A request has completed (or failed or canceled), and needs to be disposed.
	 * @method _clean
	 * @private
	 */
	p._clean = function () {
		clearTimeout(this._loadTimeout);

		var req = this._request;
		req.onloadstart = null;
		req.onprogress = null;
		req.onabort = null;
		req.onerror = null;
		req.onload = null;
		req.ontimeout = null;
		req.onloadend = null;
		req.onreadystatechange = null;
	};

	/**
	 * Generate a tag for items that can be represented as tags. For example, IMAGE, SCRIPT, and LINK. This also handles
	 * XML and SVG objects.
	 * @method _generateTag
	 * @return {Boolean} If a tag was generated and is ready for instantiation. If it still needs processing, this
	 * method returns false.
	 * @private
	 */
	p._generateTag = function () {
		var type = this._item.type;
		var tag = this._item.tag;

		switch (type) {
			// Note: Images need to wait for onload, but do use the cache.
			case createjs.LoadQueue.IMAGE:
				tag.onload = createjs.proxy(this._handleTagReady, this);
				tag.src = this.buildPath(this._item.src, this._basePath, this._item.values);

				this._rawResponse = this._response;
				this._response = tag;
				return false; // Images need to get an onload event first

			case createjs.LoadQueue.JAVASCRIPT:
				tag = document.createElement("script");
				tag.text = this._response;

				this._rawResponse = this._response;
				this._response = tag;
				return true;

			case createjs.LoadQueue.CSS:
				// Maybe do this conditionally?
				var head = document.getElementsByTagName("head")[0]; //Note: This is unavoidable in IE678
				head.appendChild(tag);

				if (tag.styleSheet) { // IE
					tag.styleSheet.cssText = this._response;
				} else {
					var textNode = document.createTextNode(this._response);
					tag.appendChild(textNode);
				}

				this._rawResponse = this._response;
				this._response = tag;
				return true;

			case createjs.LoadQueue.XML:
				var xml = this._parseXML(this._response, "text/xml");
				this._response = xml;
				return true;

			case createjs.LoadQueue.SVG:
				var xml = this._parseXML(this._response, "image/svg+xml");
				this._rawResponse = this._response;
				if (xml.documentElement != null) {
					tag.appendChild(xml.documentElement);
					this._response = tag;
				} else { // For browsers that don't support SVG, just give them the XML. (IE 9-8)
					this._response = xml;
				}
				return true;

			case createjs.LoadQueue.JSON:
				var json = {};
				try {
					json = JSON.parse(this._response);
				} catch (error) {
					json = error;
				}

				this._rawResponse = this._response;
				this._response = json;
				return true;

		}
		return true;
	};

	/**
	 * Parse XML using the DOM. This is required when preloading XML or SVG.
	 * @method _parseXML
	 * @param {String} text The raw text or XML that is loaded by XHR.
	 * @param {String} type The mime type of the XML.
	 * @return {XML} An XML document.
	 * @private
	 */
	p._parseXML = function (text, type) {
		var xml = null;
		if (window.DOMParser) {
			var parser = new DOMParser();
			xml = parser.parseFromString(text, type);  // OJR Opera throws DOMException: NOT_SUPPORTED_ERR  // potential solution https://gist.github.com/1129031
		} else { // IE
			xml = new ActiveXObject("Microsoft.XMLDOM");
			xml.async = false;
			xml.loadXML(text);
		}
		return xml;
	};

	/**
	 * A generated tag is now ready for use.
	 * @method _handleTagReady
	 * @private
	 */
	p._handleTagReady = function () {
		this._sendComplete();
	}

	p.toString = function () {
		return "[PreloadJS XHRLoader]";
	}

	createjs.XHRLoader = XHRLoader;

}());

/**
 * Include json2 here, to correctly parse json.
 * Used on browsers that don't have a native JSON object.
 *
 */
/*
 json2.js
 2012-10-08

 Public Domain.

 NO WARRANTY EXPRESSED OR IMPLIED. USE AT YOUR OWN RISK.

 See http://www.JSON.org/js.html


 This code should be minified before deployment.
 See http://javascript.crockford.com/jsmin.html

 USE YOUR OWN COPY. IT IS EXTREMELY UNWISE TO LOAD CODE FROM SERVERS YOU DO
 NOT CONTROL.
 */


// Create a JSON object only if one does not already exist. We create the
// methods in a closure to avoid creating global variables.

if (typeof JSON !== 'object') {
	JSON = {};
}

(function () {
	'use strict';

	function f(n) {
		// Format integers to have at least two digits.
		return n < 10 ? '0' + n : n;
	}

	if (typeof Date.prototype.toJSON !== 'function') {

		Date.prototype.toJSON = function (key) {

			return isFinite(this.valueOf())
				? this.getUTCFullYear() + '-' +
				f(this.getUTCMonth() + 1) + '-' +
				f(this.getUTCDate()) + 'T' +
				f(this.getUTCHours()) + ':' +
				f(this.getUTCMinutes()) + ':' +
				f(this.getUTCSeconds()) + 'Z'
				: null;
		};

		String.prototype.toJSON =
			Number.prototype.toJSON =
				Boolean.prototype.toJSON = function (key) {
					return this.valueOf();
				};
	}

	var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
		escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
		gap,
		indent,
		meta = {    // table of character substitutions
			'\b':'\\b',
			'\t':'\\t',
			'\n':'\\n',
			'\f':'\\f',
			'\r':'\\r',
			'"':'\\"',
			'\\':'\\\\'
		},
		rep;


	function quote(string) {

// If the string contains no control characters, no quote characters, and no
// backslash characters, then we can safely slap some quotes around it.
// Otherwise we must also replace the offending characters with safe escape
// sequences.

		escapable.lastIndex = 0;
		return escapable.test(string) ? '"' + string.replace(escapable, function (a) {
			var c = meta[a];
			return typeof c === 'string'
				? c
				: '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
		}) + '"' : '"' + string + '"';
	}


	function str(key, holder) {

// Produce a string from holder[key].

		var i, // The loop counter.
			k, // The member key.
			v, // The member value.
			length,
			mind = gap,
			partial,
			value = holder[key];

// If the value has a toJSON method, call it to obtain a replacement value.

		if (value && typeof value === 'object' &&
			typeof value.toJSON === 'function') {
			value = value.toJSON(key);
		}

// If we were called with a replacer function, then call the replacer to
// obtain a replacement value.

		if (typeof rep === 'function') {
			value = rep.call(holder, key, value);
		}

// What happens next depends on the value's type.

		switch (typeof value) {
			case 'string':
				return quote(value);

			case 'number':

// JSON numbers must be finite. Encode non-finite numbers as null.

				return isFinite(value) ? String(value) : 'null';

			case 'boolean':
			case 'null':

// If the value is a boolean or null, convert it to a string. Note:
// typeof null does not produce 'null'. The case is included here in
// the remote chance that this gets fixed someday.

				return String(value);

// If the type is 'object', we might be dealing with an object or an array or
// null.

			case 'object':

// Due to a specification blunder in ECMAScript, typeof null is 'object',
// so watch out for that case.

				if (!value) {
					return 'null';
				}

// Make an array to hold the partial results of stringifying this object value.

				gap += indent;
				partial = [];

// Is the value an array?

				if (Object.prototype.toString.apply(value) === '[object Array]') {

// The value is an array. Stringify every element. Use null as a placeholder
// for non-JSON values.

					length = value.length;
					for (i = 0; i < length; i += 1) {
						partial[i] = str(i, value) || 'null';
					}

// Join all of the elements together, separated with commas, and wrap them in
// brackets.

					v = partial.length === 0
						? '[]'
						: gap
						? '[\n' + gap + partial.join(',\n' + gap) + '\n' + mind + ']'
						: '[' + partial.join(',') + ']';
					gap = mind;
					return v;
				}

// If the replacer is an array, use it to select the members to be stringified.

				if (rep && typeof rep === 'object') {
					length = rep.length;
					for (i = 0; i < length; i += 1) {
						if (typeof rep[i] === 'string') {
							k = rep[i];
							v = str(k, value);
							if (v) {
								partial.push(quote(k) + (gap ? ': ' : ':') + v);
							}
						}
					}
				} else {

// Otherwise, iterate through all of the keys in the object.

					for (k in value) {
						if (Object.prototype.hasOwnProperty.call(value, k)) {
							v = str(k, value);
							if (v) {
								partial.push(quote(k) + (gap ? ': ' : ':') + v);
							}
						}
					}
				}

// Join all of the member texts together, separated with commas,
// and wrap them in braces.

				v = partial.length === 0
					? '{}'
					: gap
					? '{\n' + gap + partial.join(',\n' + gap) + '\n' + mind + '}'
					: '{' + partial.join(',') + '}';
				gap = mind;
				return v;
		}
	}

// If the JSON object does not yet have a stringify method, give it one.

	if (typeof JSON.stringify !== 'function') {
		JSON.stringify = function (value, replacer, space) {

// The stringify method takes a value and an optional replacer, and an optional
// space parameter, and returns a JSON text. The replacer can be a function
// that can replace values, or an array of strings that will select the keys.
// A default replacer method can be provided. Use of the space parameter can
// produce text that is more easily readable.

			var i;
			gap = '';
			indent = '';

// If the space parameter is a number, make an indent string containing that
// many spaces.

			if (typeof space === 'number') {
				for (i = 0; i < space; i += 1) {
					indent += ' ';
				}

// If the space parameter is a string, it will be used as the indent string.

			} else if (typeof space === 'string') {
				indent = space;
			}

// If there is a replacer, it must be a function or an array.
// Otherwise, throw an error.

			rep = replacer;
			if (replacer && typeof replacer !== 'function' &&
				(typeof replacer !== 'object' ||
					typeof replacer.length !== 'number')) {
				throw new Error('JSON.stringify');
			}

// Make a fake root object containing our value under the key of ''.
// Return the result of stringifying the value.

			return str('', {'':value});
		};
	}


// If the JSON object does not yet have a parse method, give it one.

	if (typeof JSON.parse !== 'function') {
		JSON.parse = function (text, reviver) {

// The parse method takes a text and an optional reviver function, and returns
// a JavaScript value if the text is a valid JSON text.

			var j;

			function walk(holder, key) {

// The walk method is used to recursively walk the resulting structure so
// that modifications can be made.

				var k, v, value = holder[key];
				if (value && typeof value === 'object') {
					for (k in value) {
						if (Object.prototype.hasOwnProperty.call(value, k)) {
							v = walk(value, k);
							if (v !== undefined) {
								value[k] = v;
							} else {
								delete value[k];
							}
						}
					}
				}
				return reviver.call(holder, key, value);
			}


// Parsing happens in four stages. In the first stage, we replace certain
// Unicode characters with escape sequences. JavaScript handles many characters
// incorrectly, either silently deleting them, or treating them as line endings.

			text = String(text);
			cx.lastIndex = 0;
			if (cx.test(text)) {
				text = text.replace(cx, function (a) {
					return '\\u' +
						('0000' + a.charCodeAt(0).toString(16)).slice(-4);
				});
			}

// In the second stage, we run the text against regular expressions that look
// for non-JSON patterns. We are especially concerned with '()' and 'new'
// because they can cause invocation, and '=' because it can cause mutation.
// But just to be safe, we want to reject all unexpected forms.

// We split the second stage into 4 regexp operations in order to work around
// crippling inefficiencies in IE's and Safari's regexp engines. First we
// replace the JSON backslash pairs with '@' (a non-JSON character). Second, we
// replace all simple value tokens with ']' characters. Third, we delete all
// open brackets that follow a colon or comma or that begin the text. Finally,
// we look to see that the remaining characters are only whitespace or ']' or
// ',' or ':' or '{' or '}'. If that is so, then the text is safe for eval.

			if (/^[\],:{}\s]*$/
				.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@')
					.replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']')
					.replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {

// In the third stage we use the eval function to compile the text into a
// JavaScript structure. The '{' operator is subject to a syntactic ambiguity
// in JavaScript: it can begin a block or an object literal. We wrap the text
// in parens to eliminate the ambiguity.

				j = eval('(' + text + ')');

// In the optional fourth stage, we recursively walk the new structure, passing
// each name/value pair to a reviver function for possible transformation.

				return typeof reviver === 'function'
					? walk({'':j}, '')
					: j;
			}

// If the text is not JSON parseable, then a SyntaxError is thrown.

			throw new SyntaxError('JSON.parse');
		};
	}
}());


// namespace:
this.createjs = this.createjs || {};

/**
 * The SoundJS library manages the playback of audio on the web. It works via plugins which abstract the actual audio
 * implementation, so playback is possible on any platform without specific knowledge of what mechanisms are necessary
 * to play sounds.
 *
 * To use SoundJS, use the public API on the {{#crossLink "Sound"}}{{/crossLink}} class. This API is for:
 * <ul><li>Installing audio playback Plugins</li>
 *      <li>Registering (and preloading) sounds</li>
 *      <li>Creating and playing sounds</li>
 *      <li>Master volume, mute, and stop controls for all sounds at once</li>
 * </ul>
 *
 * <b>Please note that as of version 0.4.0, the "SoundJS" object only provides version information. All APIs from
 * SoundJS are now available on the {{#crossLink "Sound"}}{{/crossLink}} class.</b>
 *
 * <b>Controlling Sounds</b><br />
 * Playing sounds creates {{#crossLink "SoundInstance"}}{{/crossLink}} instances, which can be controlled individually.
 * <ul><li>Pause, resume, seek, and stop sounds</li>
 *      <li>Control a sound's volume, mute, and pan</li>
 *      <li>Listen for events on sound instances to get notified when they finish, loop, or fail</li>
 * </ul>
 *
 * <h4>Feature Set Example</h4>
 *      createjs.Sound.addEventListener("fileload", createjs.proxy(this.loadHandler, this));
 *      createjs.Sound.registerSound("path/to/mySound.mp3|path/to/mySound.ogg", "sound");
 *      function loadHandler(event) {
 *          // This is fired for each sound that is registered.
 *          var instance = createjs.Sound.play("sound");  // play using id.  Could also use full sourcepath or event.src.
 *          instance.addEventListener("complete", createjs.proxy(this.handleComplete, this));
 *          instance.volume = 0.5;
 *      }
 *
 * <h4>Browser Support</h4>
 * Audio will work in browsers which support HTMLAudioElement (<a href="http://caniuse.com/audio">http://caniuse.com/audio</a>)
 * or WebAudio (<a href="http://caniuse.com/audio-api">http://caniuse.com/audio-api</a>). A Flash fallback can be added
 * as well, which will work in any browser that supports the Flash player.
 * @module SoundJS
 * @main SoundJS
 */

(function () {

	"use strict";

	//TODO: Interface to validate plugins and throw warnings
	//TODO: Determine if methods exist on a plugin before calling  // OJR this is only an issue if something breaks or user changes something
	//TODO: Interface to validate instances and throw warnings
	//TODO: Surface errors on audio from all plugins
	//TODO: Timeouts  // OJR for?
	/**
	 * The Sound class is the public API for creating sounds, controlling the overall sound levels, and managing plugins.
	 * All Sound APIs on this class are static.
	 *
	 * <b>Registering and Preloading</b><br />
	 * Before you can play a sound, it <b>must</b> be registered. You can do this with {{#crossLink "Sound/registerSound"}}{{/crossLink}},
	 * or register multiple sounds using {{#crossLink "Sound/registerManifest"}}{{/crossLink}}. If you don't register a
	 * sound prior to attempting to play it using {{#crossLink "Sound/play"}}{{/crossLink}} or create it using {{#crossLink "Sound/createInstance"}}{{/crossLink}},
	 * the sound source will be automatically registered but playback will fail as the source will not be ready. If you use
	 * <a href="http://preloadjs.com" target="_blank">PreloadJS</a>, this is handled for you when the sound is
	 * preloaded. It is recommended to preload sounds either internally using the register functions or externally using
	 * PreloadJS so they are ready when you want to use them.
	 *
	 * <b>Playback</b><br />
	 * To play a sound once it's been registered and preloaded, use the {{#crossLink "Sound/play"}}{{/crossLink}} method.
	 * This method returns a {{#crossLink "SoundInstance"}}{{/crossLink}} which can be paused, resumed, muted, etc.
	 * Please see the {{#crossLink "SoundInstance"}}{{/crossLink}} documentation for more on the instance control APIs.
	 *
	 * <b>Plugins</b><br />
	 * By default, the {{#crossLink "WebAudioPlugin"}}{{/crossLink}} or the {{#crossLink "HTMLAudioPlugin"}}{{/crossLink}}
	 * are used (when available), although developers can change plugin priority or add new plugins (such as the
	 * provided {{#crossLink "FlashPlugin"}}{{/crossLink}}). Please see the {{#crossLink "Sound"}}{{/crossLink}} API
	 * methods for more on the playback and plugin APIs. To install plugins, or specify a different plugin order, see
	 * {{#crossLink "Sound/installPlugins"}}{{/crossLink}}.
	 *
	 * <h4>Example</h4>
	 *      createjs.Sound.registerPlugins([createjs.WebAudioPlugin, createjs.FlashPlugin]);
	 *      createjs.Sound.addEventListener("fileload", createjs.proxy(this.loadHandler, (this));
	 *      createjs.Sound.registerSound("path/to/mySound.mp3|path/to/mySound.ogg", "sound");
	 *      function loadHandler(event) {
     *          // This is fired for each sound that is registered.
     *          var instance = createjs.Sound.play("sound");  // play using id.  Could also use full source path or event.src.
     *          instance.addEventListener("complete", createjs.proxy(this.handleComplete, this));
     *          instance.volume = 0.5;
	 *      }
	 *
	 * The maximum number of concurrently playing instances of the same sound can be specified in the "data" argument
	 * of {{#crossLink "Sound/registerSound"}}{{/crossLink}}.  Note that if not specified, the active plugin will apply
	 * a default limit.  Currently HTMLAudioPlugin sets a default limit of 2, while WebAudioPlugin and FlashPlugin set a
	 * default limit of 100.
	 *
	 *      createjs.Sound.registerSound("sound.mp3", "soundId", 4);
	 *
	 * Sound can be used as a plugin with PreloadJS to help preload audio properly. Audio preloaded with PreloadJS is
	 * automatically registered with the Sound class. When audio is not preloaded, Sound will do an automatic internal
	 * load. As a result, it may not play immediately the first time play is called. Use the
	 * {{#crossLink "Sound/fileload"}}{{/crossLink}} event to determine when a sound has finished internally preloading.
	 * It is recommended that all audio is preloaded before it is played.
	 *
	 *      createjs.PreloadJS.installPlugin(createjs.Sound);
	 *
	 * <b>Mobile Safe Approach</b><br />
	 * Mobile devices require sounds to be played inside of a user initiated event (touch/click) in varying degrees.
	 * As of SoundJS 0.4.1, you can launch a site inside of a user initiated event and have audio playback work. To
	 * enable as broadly as possible, the site needs to setup the Sound plugin in its initialization (for example via
	 * <code>createjs.Sound.initializeDefaultPlugins();</code>), and all sounds need to be played in the scope of the
	 * application.  See the MobileSafe demo for a working example.
	 *
	 * <h4>Example</h4>
	 *     document.getElementById("status").addEventListener("click", handleTouch, false);    // works on Android and iPad
	 *     function handleTouch(event) {
	 *       document.getElementById("status").removeEventListener("click", handleTouch, false);    // remove the listener
	 *       var thisApp = new myNameSpace.MyApp();    // launch the app
	 *     }
	 *
	 * <h4>Known Browser and OS issues</h4>
	 * <b>IE 9 HTML Audio limitations</b><br />
	 * <ul><li>There is a delay in applying volume changes to tags that occurs once playback is started. So if you have
	 * muted all sounds, they will all play during this delay until the mute applies internally. This happens regardless of
	 * when or how you apply the volume change, as the tag seems to need to play to apply it.</li>
     * <li>MP3 encoding will not always work for audio tags, particularly in Internet Explorer. We've found default
	 * encoding with 64kbps works.</li>
	 * <li>There is a limit to how many audio tags you can load and play at once, which appears to be determined by
	 * hardware and browser settings.  See {{#crossLink "HTMLAudioPlugin.MAX_INSTANCES"}}{{/crossLink}} for a safe estimate.</li></ul>
	 *
	 * <b>Firefox 25 Web Audio limitations</b>
	 * <ul><li>mp3 audio files do not load properly on all windows machines, reported
	 * <a href="https://bugzilla.mozilla.org/show_bug.cgi?id=929969" target="_blank">here</a>. </br>
	 * For this reason it is recommended to pass ogg file first until this bug is resolved, if possible.</li></ul>

	 * <b>Safari limitations</b><br />
	 * <ul><li>Safari requires Quicktime to be installed for audio playback.</li></ul>
	 *
	 * <b>iOS 6 Web Audio limitations</b><br />
	 * <ul><li>Sound is initially muted and will only unmute through play being called inside a user initiated event
	 * (touch/click).</li>
	 * <li>Despite suggestions to the opposite, we have control over audio volume through our gain nodes.</li>
	 * <li>A bug exists that will distort un-cached web audio when a video element is present in the DOM.</li>
	 * <li>Note HTMLAudioPlugin is not supported on iOS by default.  See {{#crossLink "HTMLAudioPlugin"}}{{/crossLink}}
	 * for more details.<li>
	 * </ul>
	 *
	 * <b>Android HTML Audio limitations</b><br />
	 * <ul><li>We have no control over audio volume. Only the user can set volume on their device.</li>
	 * <li>We can only play audio inside a user event (touch/click).  This currently means you cannot loop sound or use
	 * a delay.</li></ul>
	 *
	 *
	 * @class Sound
	 * @static
	 * @uses EventDispatcher
	 */
	function Sound() {
		throw "Sound cannot be instantiated";
	}

	var s = Sound;

	/**
	 * The character (or characters) that are used to split multiple paths from an audio source.
	 * @property DELIMITER
	 * @type {String}
	 * @default |
	 * @static
	 */
	s.DELIMITER = "|";

	/**
	 * The duration in milliseconds to determine a timeout.
	 * @property AUDIO_TIMEOUT
	 * @static
	 * @type {Number}
	 * @default 8000
	 * @protected
	 */
	s.AUDIO_TIMEOUT = 8000; // TODO: This is not implemeneted  // OJR remove property? doc'd as protected to remove from docs for now

	/**
	 * The interrupt value to interrupt any currently playing instance with the same source, if the maximum number of
	 * instances of the sound are already playing.
	 * @property INTERRUPT_ANY
	 * @type {String}
	 * @default any
	 * @static
	 */
	s.INTERRUPT_ANY = "any";

	/**
	 * The interrupt value to interrupt the earliest currently playing instance with the same source that progressed the
	 * least distance in the audio track, if the maximum number of instances of the sound are already playing.
	 * @property INTERRUPT_EARLY
	 * @type {String}
	 * @default early
	 * @static
	 */
	s.INTERRUPT_EARLY = "early";

	/**
	 * The interrupt value to interrupt the currently playing instance with the same source that progressed the most
	 * distance in the audio track, if the maximum number of instances of the sound are already playing.
	 * @property INTERRUPT_LATE
	 * @type {String}
	 * @default late
	 * @static
	 */
	s.INTERRUPT_LATE = "late";

	/**
	 * The interrupt value to not interrupt any currently playing instances with the same source, if the maximum number of
	 * instances of the sound are already playing.
	 * @property INTERRUPT_NONE
	 * @type {String}
	 * @default none
	 * @static
	 */
	s.INTERRUPT_NONE = "none";

// The playState in plugins should be implemented with these values.
	/**
	 * Defines the playState of an instance that is still initializing.
	 * @property PLAY_INITED
	 * @type {String}
	 * @default playInited
	 * @static
	 */
	s.PLAY_INITED = "playInited";

	/**
	 * Defines the playState of an instance that is currently playing or paused.
	 * @property PLAY_SUCCEEDED
	 * @type {String}
	 * @default playSucceeded
	 * @static
	 */
	s.PLAY_SUCCEEDED = "playSucceeded";

	/**
	 * Defines the playState of an instance that was interrupted by another instance.
	 * @property PLAY_INTERRUPTED
	 * @type {String}
	 * @default playInterrupted
	 * @static
	 */
	s.PLAY_INTERRUPTED = "playInterrupted";

	/**
	 * Defines the playState of an instance that completed playback.
	 * @property PLAY_FINISHED
	 * @type {String}
	 * @default playFinished
	 * @static
	 */
	s.PLAY_FINISHED = "playFinished";

	/**
	 * Defines the playState of an instance that failed to play. This is usually caused by a lack of available channels
	 * when the interrupt mode was "INTERRUPT_NONE", the playback stalled, or the sound could not be found.
	 * @property PLAY_FAILED
	 * @type {String}
	 * @default playFailed
	 * @static
	 */
	s.PLAY_FAILED = "playFailed";

	/**
	 * A list of the default supported extensions that Sound will <i>try</i> to play. Plugins will check if the browser
	 * can play these types, so modifying this list before a plugin is initialized will allow the plugins to try to
	 * support additional media types.
	 *
	 * NOTE this does not currently work for {{#crossLink "FlashPlugin"}}{{/crossLink}}.
	 *
	 * More details on file formats can be found at http://en.wikipedia.org/wiki/Audio_file_format. A very detailed
	 * list of file formats can be found at http://www.fileinfo.com/filetypes/audio. A useful list of extensions for
	 * each format can be found at http://html5doctor.com/html5-audio-the-state-of-play/
	 * @property SUPPORTED_EXTENSIONS
	 * @type {Array[String]}
	 * @default ["mp3", "ogg", "mpeg", "wav", "m4a", "mp4", "aiff", "wma", "mid"]
	 */
	s.SUPPORTED_EXTENSIONS = ["mp3", "ogg", "mpeg", "wav", "m4a", "mp4", "aiff", "wma", "mid"];  // OJR does not currently support FlashPlugin

	/**
	 * Some extensions use another type of extension support to play (one of them is a codex).  This allows you to map
	 * that support so plugins can accurately determine if an extension is supported.  Adding to this list can help
	 * plugins determine more accurately if an extension is supported.
	 * @property EXTENSION_MAP
	 * @type {Object}
	 * @since 0.4.0
	 */
	s.EXTENSION_MAP = {
		m4a:"mp4"
	};

	/**
	 * The RegExp pattern used to parse file URIs. This supports simple file names, as well as full domain URIs with
	 * query strings. The resulting match is: protocol:$1 domain:$2 path:$3 file:$4 extension:$5 query:$6.
	 * @property FILE_PATTERN
	 * @type {RegExp}
	 * @static
	 * @protected
	 */
	s.FILE_PATTERN = /^(?:(\w+:)\/{2}(\w+(?:\.\w+)*\/?))?([/.]*?(?:[^?]+)?\/)?((?:[^/?]+)\.(\w+))(?:\?(\S+)?)?$/;

	/**
	 * Determines the default behavior for interrupting other currently playing instances with the same source, if the
	 * maximum number of instances of the sound are already playing.  Currently the default is {{#crossLink "Sound/INTERRUPT_NONE:property"}}{{/crossLink}}
	 * but this can be set and will change playback behavior accordingly.  This is only used when {{#crossLink "Sound/play"}}{{/crossLink}}
	 * is called without passing a value for interrupt.
	 * @property defaultInterruptBehavior
	 * @type {String}
	 * @default none
	 * @static
	 * @since 0.4.0
	 */
	s.defaultInterruptBehavior = s.INTERRUPT_NONE;  // OJR does s.INTERRUPT_ANY make more sense as default?  Needs game dev testing to see which case makes more sense.

	/**
	 * Used internally to assign unique IDs to each SoundInstance.
	 * @property lastID
	 * @type {Number}
	 * @static
	 * @protected
	 */
	s.lastId = 0;

	/**
	 * The currently active plugin. If this is null, then no plugin could be initialized. If no plugin was specified,
	 * Sound attempts to apply the default plugins: {{#crossLink "WebAudioPlugin"}}{{/crossLink}}, followed by
	 * {{#crossLink "HTMLAudioPlugin"}}{{/crossLink}}.
	 * @property activePlugin
	 * @type {Object}
	 * @static
	 */
    s.activePlugin = null;

	/**
	 * Determines if the plugins have been registered. If false, the first call to play() will instantiate the default
	 * plugins ({{#crossLink "WebAudioPlugin"}}{{/crossLink}}, followed by {{#crossLink "HTMLAudioPlugin"}}{{/crossLink}}).
	 * If plugins have been registered, but none are applicable, then sound playback will fail.
	 * @property pluginsRegistered
	 * @type {Boolean}
	 * @default false
	 * @static
	 * @protected
	 */
	s.pluginsRegistered = false;

	/**
	 * The master volume value, which affects all sounds. Use {{#crossLink "Sound/getVolume"}}{{/crossLink}} and
	 * {{#crossLink "Sound/setVolume"}}{{/crossLink}} to modify the volume of all audio.
	 * @property masterVolume
	 * @type {Number}
	 * @default 1
	 * @protected
	 * @since 0.4.0
	 */
	s.masterVolume = 1;

	/**
	 * The master mute value, which affects all sounds.  This is applies to all sound instances.  This value can be set
	 * through {{#crossLink "Sound/setMute"}}{{/crossLink}} and accessed via {{#crossLink "Sound/getMute"}}{{/crossLink}}.
	 * @property masterMute
	 * @type {Boolean}
	 * @default false
	 * @protected
	 * @static
	 * @since 0.4.0
	 */
	s.masterMute = false;

	/**
	 * An array containing all currently playing instances. This allows Sound to control the volume, mute, and playback of
	 * all instances when using static APIs like {{#crossLink "Sound/stop"}}{{/crossLink}} and {{#crossLink "Sound/setVolume"}}{{/crossLink}}.
	 * When an instance has finished playback, it gets removed via the {{#crossLink "Sound/finishedPlaying"}}{{/crossLink}}
	 * method. If the user replays an instance, it gets added back in via the {{#crossLink "Sound/beginPlaying"}}{{/crossLink}}
	 * method.
	 * @property instances
	 * @type {Array}
	 * @protected
	 * @static
	 */
	s.instances = [];

	/**
	 * An object hash storing sound sources via there corresponding ID.
	 * @property idHash
	 * @type {Object}
	 * @protected
	 * @static
	 */
	s.idHash = {};

	/**
	 * An object hash that stores preloading sound sources via the parsed source that is passed to the plugin.  Contains the
	 * source, id, and data that was passed in by the user.  Parsed sources can contain multiple instances of source, id,
	 * and data.
	 * @property preloadHash
	 * @type {Object}
	 * @protected
	 * @static
	 */
	s.preloadHash = {};

	/**
	 * An object that stands in for audio that fails to play. This allows developers to continue to call methods
	 * on the failed instance without having to check if it is valid first. The instance is instantiated once, and
	 * shared to keep the memory footprint down.
	 * @property defaultSoundInstance
	 * @type {Object}
	 * @protected
	 * @static
	 */
	s.defaultSoundInstance = null;

// mix-ins:
	// EventDispatcher methods:
	s.addEventListener = null;
	s.removeEventListener = null;
	s.removeAllEventListeners = null;
	s.dispatchEvent = null;
	s.hasEventListener = null;
	s._listeners = null;

	createjs.EventDispatcher.initialize(s); // inject EventDispatcher methods.


// Events
	/**
	 * This event is fired when a file finishes loading internally. This event is fired for each loaded sound,
	 * so any handler methods should look up the <code>event.src</code> to handle a particular sound.
	 * @event fileload
	 * @param {Object} target The object that dispatched the event.
	 * @param {String} type The event type.
	 * @param {String} src The source of the sound that was loaded. Note this will only return the loaded part of a
	 * delimiter-separated source.
	 * @param {String} [id] The id passed in when the sound was registered. If one was not provided, it will be null.
	 * @param {Number|Object} [data] Any additional data associated with the item. If not provided, it will be undefined.
	 * @since 0.4.1
	 */

	//TODO: Deprecated
	/**
	 * REMOVED. Use {{#crossLink "EventDispatcher/addEventListener"}}{{/crossLink}} and the {{#crossLink "Sound/fileload:event"}}{{/crossLink}}
	 * event.
	 * @property onLoadComplete
	 * @type {Function}
	 * @deprecated Use addEventListener and the fileload event.
	 * @since 0.4.0
	 */

	/**
	 * Used by external plugins to dispatch file load events.
	 * @method sendFileLoadEvent
	 * @param {String} src A sound file has completed loading, and should be dispatched.
	 * @protected
	 * @static
	 * @since 0.4.1
	 */
	s.sendFileLoadEvent = function (src) {
		if (!s.preloadHash[src]) {
			return;
		}
		for (var i = 0, l = s.preloadHash[src].length; i < l; i++) {
			var item = s.preloadHash[src][i];
			s.preloadHash[src][i] = true;

			if (!s.hasEventListener("fileload")) { continue; }

			var event = new createjs.Event("fileload");
			event.src = item.src,
			event.id = item.id,
			event.data = item.data

			s.dispatchEvent(event);
		}
	}

	/**
	 * Get the preload rules to allow Sound to be used as a plugin by <a href="http://preloadjs.com" target="_blank">PreloadJS</a>.
	 * Any load calls that have the matching type or extension will fire the callback method, and use the resulting
	 * object, which is potentially modified by Sound. This helps when determining the correct path, as well as
	 * registering the audio instance(s) with Sound. This method should not be called, except by PreloadJS.
	 * @method getPreloadHandlers
	 * @return {Object} An object containing:
	 * <ul><li>callback: A preload callback that is fired when a file is added to PreloadJS, which provides
	 *      Sound a mechanism to modify the load parameters, select the correct file format, register the sound, etc.</li>
	 *      <li>types: A list of file types that are supported by Sound (currently supports "sound").</li>
	 *      <li>extensions: A list of file extensions that are supported by Sound (see {{#crossLink "Sound.SUPPORTED_EXTENSIONS"}}{{/crossLink}}).</li></ul>
	 * @static
	 * @protected
	 */
	s.getPreloadHandlers = function () {
		return {
			callback:createjs.proxy(s.initLoad, s),
			types:["sound"],
			extensions:s.SUPPORTED_EXTENSIONS
		};
	}

	/**
	 * Register a Sound plugin. Plugins handle the actual playback of audio. The default plugins are
	 * ({{#crossLink "WebAudioPlugin"}}{{/crossLink}} followed by {{#crossLink "HTMLAudioPlugin"}}{{/crossLink}}),
	 * and are installed if no other plugins are present when the user attempts to start playback or register sound.
	 * <h4>Example</h4>
	 *      createjs.FlashPlugin.BASE_PATH = "../src/SoundJS/";
	 *      createjs.Sound.registerPlugin(createjs.FlashPlugin);
	 *
	 * To register multiple plugins, use {{#crossLink "Sound/registerPlugins"}}{{/crossLink}}.
	 *
	 * @method registerPlugin
	 * @param {Object} plugin The plugin class to install.
	 * @return {Boolean} Whether the plugin was successfully initialized.
	 * @static
	 */
	s.registerPlugin = function (plugin) {
		s.pluginsRegistered = true;
		if (plugin == null) {
			return false;
		}
		// Note: Each plugin is passed in as a class reference, but we store the activePlugin as an instance
		if (plugin.isSupported()) {
			s.activePlugin = new plugin();
			//TODO: Check error on initialization
			return true;
		}
		return false;
	}

	/**
	 * Register a list of Sound plugins, in order of precedence. To register a single plugin, use
	 * {{#crossLink "Sound/registerPlugin"}}{{/crossLink}}.
	 *
	 * <h4>Example</h4>
	 *      createjs.FlashPlugin.BASE_PATH = "../src/SoundJS/";
	 *      createjs.Sound.registerPlugins([createjs.WebAudioPlugin, createjs.HTMLAudioPlugin, createjs.FlashPlugin]);
	 *
	 * @method registerPlugins
	 * @param {Array} plugins An array of plugins classes to install.
	 * @return {Boolean} Whether a plugin was successfully initialized.
	 * @static
	 */
	s.registerPlugins = function (plugins) {
		for (var i = 0, l = plugins.length; i < l; i++) {
			var plugin = plugins[i];
			if (s.registerPlugin(plugin)) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Initialize the default plugins. This method is automatically called when any audio is played or registered before
	 * the user has manually registered plugins, and enables Sound to work without manual plugin setup. Currently, the
	 * default plugins are {{#crossLink "WebAudioPlugin"}}{{/crossLink}} followed by {{#crossLink "HTMLAudioPlugin"}}{{/crossLink}}.
	 *
	 *  * <h4>Example</h4>
	 *      if (!createjs.initializeDefaultPlugins()) { return; }
	 *
	 * @method initializeDefaultPlugins
	 * @returns {Boolean} If a plugin is initialized (true) or not (false). If the browser does not have the
	 * capabilities to initialize any available plugins, this will return false.
	 * @since 0.4.0
	 */
	s.initializeDefaultPlugins = function () {
		if (s.activePlugin != null) {
			return true;
		}
		if (s.pluginsRegistered) {
			return false;
		}
		if (s.registerPlugins([createjs.WebAudioPlugin, createjs.HTMLAudioPlugin])) {
			return true;
		}
		return false;
	}

	/**
	 * Determines if Sound has been initialized, and a plugin has been activated.
	 *
	 * <h4>Example</h4>
	 * This example sets up a Flash fallback, but only if there is no plugin specified yet.
	 *
	 *      if (!createjs.Sound.isReady()) {
	 *			createjs.FlashPlugin.BASE_PATH = "../src/SoundJS/";
	 *      	createjs.Sound.registerPlugins([createjs.WebAudioPlugin, createjs.HTMLAudioPlugin, createjs.FlashPlugin]);
	 *      }
	 *
	 * @method isReady
	 * @return {Boolean} If Sound has initialized a plugin.
	 * @static
	 */
	s.isReady = function () {
		return (s.activePlugin != null);
	}

	/**
	 * Get the active plugins capabilities, which help determine if a plugin can be used in the current environment,
	 * or if the plugin supports a specific feature. Capabilities include:
	 * <ul>
	 *     <li><b>panning:</b> If the plugin can pan audio from left to right</li>
	 *     <li><b>volume;</b> If the plugin can control audio volume.</li>
	 *     <li><b>mp3:</b> If MP3 audio is supported.</li>
	 *     <li><b>ogg:</b> If OGG audio is supported.</li>
	 *     <li><b>wav:</b> If WAV audio is supported.</li>
	 *     <li><b>mpeg:</b> If MPEG audio is supported.</li>
	 *     <li><b>m4a:</b> If M4A audio is supported.</li>
	 *     <li><b>mp4:</b> If MP4 audio is supported.</li>
	 *     <li><b>aiff:</b> If aiff audio is supported.</li>
	 *     <li><b>wma:</b> If wma audio is supported.</li>
	 *     <li><b>mid:</b> If mid audio is supported.</li>
	 *     <li><b>tracks:</b> The maximum number of audio tracks that can be played back at a time. This will be -1
	 *     if there is no known limit.</li>
	 * @method getCapabilities
	 * @return {Object} An object containing the capabilities of the active plugin.
	 * @static
	 */
	s.getCapabilities = function () {
		if (s.activePlugin == null) {
			return null;
		}
		return s.activePlugin.capabilities;
	}

	/**
	 * Get a specific capability of the active plugin. See {{#crossLink "Sound/getCapabilities"}}{{/crossLink}} for a
	 * full list of capabilities.
	 *
	 * <h4>Example</h4>
	 *      var maxAudioInstances = createjs.Sound.getCapability("tracks");
	 *
	 * @method getCapability
	 * @param {String} key The capability to retrieve
	 * @return {Number|Boolean} The value of the capability.
	 * @static
	 * @see getCapabilities
	 */
	s.getCapability = function (key) {
		if (s.activePlugin == null) {
			return null;
		}
		return s.activePlugin.capabilities[key];
	}

	/**
	 * Process manifest items from <a href="http://preloadjs.com" target="_blank">PreloadJS</a>. This method is intended
	 * for usage by a plugin, and not for direct interaction.
	 * @method initLoad
	 * @param {String | Object} src The src or object to load. This is usually a string path, but can also be an
	 * HTMLAudioElement or similar audio playback object.
	 * @param {String} [type] The type of object. Will likely be "sound" or null.
	 * @param {String} [id] An optional user-specified id that is used to play sounds.
	 * @param {Number|String|Boolean|Object} [data] Data associated with the item. Sound uses the data parameter as the
	 * number of channels for an audio instance, however a "channels" property can be appended to the data object if
	 * this property is used for other information. The audio channels will default to 1 if no value is found.
	 * @return {Boolean|Object} An object with the modified values of those that were passed in, or false if the active
	 * plugin can not play the audio type.
	 * @protected
	 * @static
	 */
	s.initLoad = function (src, type, id, data, basePath) {
		var details = s.registerSound(src, id, data, false, basePath);
		if (details == null) {
			return false;
		}
		return details;
	}

	/**
	 * Register an audio file for loading and future playback in Sound. This is automatically called when using
	 * <a href="http://preloadjs.com" target="_blank">PreloadJS</a>.  It is recommended to register all sounds that
	 * need to be played back in order to properly prepare and preload them. Sound does internal preloading when required.
	 *
	 * <h4>Example</h4>
	 *      createjs.Sound.addEventListener("fileload", handleLoad); // add an event listener for when load is completed
	 *      createjs.Sound.registerSound("myAudioPath/mySound.mp3|myAudioPath/mySound.ogg", "myID", 3);
	 *
	 * @method registerSound
	 * @param {String | Object} src The source or an Objects with a "src" property
	 * @param {String} [id] An id specified by the user to play the sound later.
	 * @param {Number | Object} [data] Data associated with the item. Sound uses the data parameter as the number of
	 * channels for an audio instance, however a "channels" property can be appended to the data object if it is used
	 * for other information. The audio channels will set a default based on plugin if no value is found.
	 * @param {Boolean} [preload=true] If the sound should be internally preloaded so that it can be played back
	 * without an external preloader.
	 * @param {string} basePath Set a path that will be prepending to src for loading.
	 * @return {Object} An object with the modified values that were passed in, which defines the sound.
	 * Returns false if the source cannot be parsed or no plugins can be initialized.
	 * Returns true if the source is already loaded.
	 * @static
	 * @since 0.4.0
	 */
	s.registerSound = function (src, id, data, preload, basePath) {
		if (!s.initializeDefaultPlugins()) {
			return false;
		}

		if (src instanceof Object) {
			basePath = id;	//this assumes preload will not be passed in as a property // OJR check if arguments == 3
			//?? preload = src.preload;
			// OJR refactor how data is passed in to make the parameters work better
			id = src.id;
			data = src.data;
			src = src.src;
		}
		var details = s.parsePath(src, "sound", id, data);
		if (details == null) {
			return false;
		}

		if (id != null) {
			s.idHash[id] = details.src;
		}

		var numChannels = null; // null tells SoundChannel to set this to it's internal maxDefault
		if (data != null) {
			if (!isNaN(data.channels)) {
				numChannels = parseInt(data.channels);
			}
			else if (!isNaN(data)) {
				numChannels = parseInt(data);
			}
		}
		var loader = s.activePlugin.register(details.src, numChannels);  // Note only HTML audio uses numChannels

		if (loader != null) {	// all plugins currently return a loader
			if (loader.numChannels != null) {
				numChannels = loader.numChannels;
			} // currently only HTMLAudio returns this
			SoundChannel.create(details.src, numChannels);

			// return the number of instances to the user.  This will also be returned in the load event.
			if (data == null || !isNaN(data)) {
				data = details.data = numChannels || SoundChannel.maxPerChannel();
			} else {
				data.channels = details.data.channels = numChannels || SoundChannel.maxPerChannel();
			}

			// If the loader returns a tag, return it instead for preloading.
			if (loader.tag != null) {
				details.tag = loader.tag;
			} else if (loader.src) {
				details.src = loader.src;
			}
			// If the loader returns a complete handler, pass it on to the prelaoder.
			if (loader.completeHandler != null) {
				details.completeHandler = loader.completeHandler;
			}
			if (loader.type) {
				details.type = loader.type;
			}
		}

		if (preload != false) {
			if (!s.preloadHash[details.src]) {
				s.preloadHash[details.src] = [];
			}  // we do this so we can store multiple id's and data if needed
			s.preloadHash[details.src].push({src:src, id:id, data:data});  // keep this data so we can return it in fileload event
			if (s.preloadHash[details.src].length == 1) {
				// if already loaded once, don't load a second time  // OJR note this will disallow reloading a sound if loading fails or the source changes
				if (basePath == null) {basePath = "";}
				s.activePlugin.preload(details.src, loader, basePath);
			} else {
				// if src already loaded successfully, return true
				if (s.preloadHash[details.src][0] == true) {return true;}
			}
		}

		return details;
	}

	/**
	 * Register a manifest of audio files for loading and future playback in Sound. It is recommended to register all
	 * sounds that need to be played back in order to properly prepare and preload them. Sound does internal preloading
	 * when required.
	 *
	 * <h4>Example</h4>
	 *      var manifest = [
	 *          {src:"asset0.mp3|asset0.ogg", id:"example"}, // Note the Sound.DELIMITER '|'
	 *          {src:"asset1.mp3|asset1.ogg", id:"1", data:6},
	 *          {src:"asset2.mp3", id:"works"}
	 *      ];
	 *      createjs.Sound.addEventListener("fileload", handleLoad); // call handleLoad when each sound loads
	 *      createjs.Sound.registerManifest(manifest, assetPath);
	 *
	 * @method registerManifest
	 * @param {Array} manifest An array of objects to load. Objects are expected to be in the format needed for
	 * {{#crossLink "Sound/registerSound"}}{{/crossLink}}: <code>{src:srcURI, id:ID, data:Data, preload:UseInternalPreloader}</code>
	 * with "id", "data", and "preload" being optional.
	 * @param {string} basePath Set a path that will be prepending to each src when loading.
	 * @return {Object} An array of objects with the modified values that were passed in, which defines each sound.
	 * Like registerSound, it will return false for any values that the source cannot be parsed or if no plugins can be initialized.
	 * Also, it will returns true for any values that the source is already loaded.
	 * @static
	 * @since 0.4.0
	 */
	s.registerManifest = function (manifest, basePath) {
		var returnValues = [];
		for (var i = 0, l = manifest.length; i < l; i++) {
			returnValues[i] = createjs.Sound.registerSound(manifest[i].src, manifest[i].id, manifest[i].data, manifest[i].preload, basePath);
		}
		return returnValues;
	}

	/**
	 * Remove a sound that has been registered with {{#crossLink "Sound/registerSound"}}{{/crossLink}} or
	 * {{#crossLink "Sound/registerManifest"}}{{/crossLink}}.
	 * Note this will stop playback on active instances playing this sound before deleting them.
	 * Note if you passed in a basePath, you do not need to pass it or add assetPath to the src here.
	 *
	 * <h4>Example</h4>
	 *      createjs.Sound.removeSound("myAudioPath/mySound.mp3|myAudioPath/mySound.ogg");
	 *      createjs.Sound.removeSound("myID");
	 *
	 * @method removeSound
	 * @param {String | Object} src The src or ID of the audio, or an Object with a "src" property
	 * @return {Boolean} True if sound is successfully removed.
	 * @static
	 * @since 0.4.1
	 */
	s.removeSound = function(src) {
		if (s.activePlugin == null) {
			return false;
		}

		if (src instanceof Object) {
			src = src.src;
		}
		src = s.getSrcById(src);
		var details = s.parsePath(src);
		if (details == null) {
			return false;
		}
		src = details.src;

		// remove src from idHash	// Note "for in" can be a slow operation
		for(var prop in s.idHash){
			if(s.idHash[prop] == src) {
				delete(s.idHash[prop]);
			}
		}

		// clear from SoundChannel, which also stops and deletes all instances
		SoundChannel.removeSrc(src);

		// remove src from preloadHash	// Note "for in" can be a slow operation
		delete(s.preloadHash[src]);

		// activePlugin cleanup
		s.activePlugin.removeSound(src);

		return true;
	}

	/**
	 * Remove a manifest of audio files that have been registered with {{#crossLink "Sound/registerSound"}}{{/crossLink}} or
	 * {{#crossLink "Sound/registerManifest"}}{{/crossLink}}.
	 * Note this will stop playback on active instances playing this audio before deleting them.
	 * Note if you passed in a basePath, you do not need to pass it or add it to the src here.
	 *
	 * <h4>Example</h4>
	 *      var manifest = [
	 *          {src:"asset0.mp3|asset0.ogg", id:"example"}, // Note the Sound.DELIMITER '|'
	 *          {src:"asset1.mp3|asset1.ogg", id:"1", data:6},
	 *          {src:"asset2.mp3", id:"works"}
	 *      ];
	 *      createjs.Sound.removeManifest(manifest);
	 *
	 * @method removeManifest
	 * @param {Array} manifest An array of objects to remove. Objects are expected to be in the format needed for
	 * {{#crossLink "Sound/removeSound"}}{{/crossLink}}: <code>{srcOrID:srcURIorID}</code>
	 * @return {Object} An array of Boolean values representing if the sounds with the same array index in manifest was
	 * successfully removed.
	 * @static
	 * @since 0.4.1
	 */
	s.removeManifest = function (manifest) {
		var returnValues = [];
		for (var i = 0, l = manifest.length; i < l; i++) {
			returnValues[i] = createjs.Sound.removeSound(manifest[i].src);
		}
		return returnValues;
	}

	/**
	 * Remove all sounds that have been registered with {{#crossLink "Sound/registerSound"}}{{/crossLink}} or
	 * {{#crossLink "Sound/registerManifest"}}{{/crossLink}}.
	 * Note this will stop playback on all active sound instances before deleting them.
	 *
	 * <h4>Example</h4>
	 *     createjs.Sound.removeAllSounds();
	 *
	 * @method removeAllSounds
	 * @static
	 * @since 0.4.1
	 */
	s.removeAllSounds = function() {
		s.idHash = {};
		s.preloadHash = {};
		SoundChannel.removeAll();
		s.activePlugin.removeAllSounds();
	}

	/**
	 * Check if a source has been loaded by internal preloaders. This is necessary to ensure that sounds that are
	 * not completed preloading will not kick off a new internal preload if they are played.
	 *
	 * <h4>Example</h4>
	 *     var mySound = "assetPath/asset0.mp3|assetPath/asset0.ogg";
	 *     if(createjs.Sound.loadComplete(mySound) {
	 *         createjs.Sound.play(mySound);
	 *     }
	 *
	 * @method loadComplete
	 * @param {String} src The src or id that is being loaded.
	 * @return {Boolean} If the src is already loaded.
	 * @since 0.4.0
	 */
	s.loadComplete = function (src) {
		var details = s.parsePath(src, "sound");
		if (details) {
			src = s.getSrcById(details.src);
		} else {
			src = s.getSrcById(src);
		}
		return (s.preloadHash[src][0] == true);  // src only loads once, so if it's true for the first it's true for all
	}

	/**
	 * Parse the path of a sound, usually from a manifest item. Manifest items support single file paths, as well as
	 * composite paths using {{#crossLink "Sound/DELIMITER:property"}}{{/crossLink}}, which defaults to "|". The first path supported by the
	 * current browser/plugin will be used.
	 * @method parsePath
	 * @param {String} value The path to an audio source.
	 * @param {String} [type] The type of path. This will typically be "sound" or null.
	 * @param {String} [id] The user-specified sound ID. This may be null, in which case the src will be used instead.
	 * @param {Number | String | Boolean | Object} [data] Arbitrary data appended to the sound, usually denoting the
	 * number of channels for the sound. This method doesn't currently do anything with the data property.
	 * @return {Object} A formatted object that can be registered with the {{#crossLink "Sound/activePlugin:property"}}{{/crossLink}}
	 * and returned to a preloader like <a href="http://preloadjs.com" target="_blank">PreloadJS</a>.
	 * @protected
	 */
	s.parsePath = function (value, type, id, data) {
        if (typeof(value) != "string") {value = value.toString();}
		var sounds = value.split(s.DELIMITER);
		var ret = {type:type || "sound", id:id, data:data};
		var c = s.getCapabilities();
		for (var i = 0, l = sounds.length; i < l; i++) {
			var sound = sounds[i];

			var match = sound.match(s.FILE_PATTERN);
			if (match == null) {
				return false;
			}
			var name = match[4];
			var ext = match[5];

			if (c[ext] && createjs.indexOf(s.SUPPORTED_EXTENSIONS, ext) > -1) {
				ret.name = name;
				ret.src = sound;
				ret.extension = ext;
				return ret;
			}
		}
		return null;
	}


	/* ---------------
	 Static API.
	 --------------- */
	/**
	 * Play a sound and get a {{#crossLink "SoundInstance"}}{{/crossLink}} to control. If the sound fails to play, a
	 * SoundInstance will still be returned, and have a playState of {{#crossLink "Sound/PLAY_FAILED:property"}}{{/crossLink}}.
	 * Note that even on sounds with failed playback, you may still be able to call SoundInstance {{#crossLink "SoundInstance/play"}}{{/crossLink}},
	 * since the failure could be due to lack of available channels. If the src does not have a supported extension or
	 * if there is no available plugin, {{#crossLink "Sound/defaultSoundInstance:property"}}{{/crossLink}} will be
	 * returned, which will not play any audio, but will not generate errors.
	 *
	 * <h4>Example</h4>
	 *      createjs.Sound.addEventListener("fileload", handleLoad);
	 *      createjs.Sound.registerSound("myAudioPath/mySound.mp3", "myID", 3);
	 *      function handleLoad(event) {
	 *      	createjs.Sound.play("myID");
	 *      	// alternately we could call the following
	 *      	var myInstance = createjs.Sound.play("myAudioPath/mySound.mp3", createjs.Sound.INTERRUPT_ANY, 0, 0, -1, 1, 0);
	 *      	// another alternative is to pass in just the options we want to set inside of an object
	 *      	var myInstance = createjs.Sound.play("myAudioPath/mySound.mp3", {interrupt: createjs.Sound.INTERRUPT_ANY, loop:-1});
	 *      }
	 *
	 * @method play
	 * @param {String} src The src or ID of the audio.
	 * @param {String | Object} [interrupt="none"|options] How to interrupt any currently playing instances of audio with the same source,
	 * if the maximum number of instances of the sound are already playing. Values are defined as <code>INTERRUPT_TYPE</code>
	 * constants on the Sound class, with the default defined by {{#crossLink "Sound/defaultInterruptBehavior:property"}}{{/crossLink}}.
	 * <br /><strong>OR</strong><br />
	 * This parameter can be an object that contains any or all optional properties by name, including: interrupt,
	 * delay, offset, loop, volume, and pan (see the above code sample).
	 * @param {Number} [delay=0] The amount of time to delay the start of audio playback, in milliseconds.
	 * @param {Number} [offset=0] The offset from the start of the audio to begin playback, in milliseconds.
	 * @param {Number} [loop=0] How many times the audio loops when it reaches the end of playback. The default is 0 (no
	 * loops), and -1 can be used for infinite playback.
	 * @param {Number} [volume=1] The volume of the sound, between 0 and 1. Note that the master volume is applied
	 * against the individual volume.
	 * @param {Number} [pan=0] The left-right pan of the sound (if supported), between -1 (left) and 1 (right).
	 * @return {SoundInstance} A {{#crossLink "SoundInstance"}}{{/crossLink}} that can be controlled after it is created.
	 * @static
	 */
	s.play = function (src, interrupt, delay, offset, loop, volume, pan) {
		var instance = s.createInstance(src);

		var ok = s.playInstance(instance, interrupt, delay, offset, loop, volume, pan);
		if (!ok) {
			instance.playFailed();
		}
		return instance;
	}

	/**
	 * Creates a {{#crossLink "SoundInstance"}}{{/crossLink}} using the passed in src. If the src does not have a
	 * supported extension or if there is no available plugin, a {{#crossLink "Sound/defaultSoundInstance:property"}}{{/crossLink}}
	 * will be returned that can be called safely but does nothing.
	 *
	 * <h4>Example</h4>
	 *      var myInstance = null;
	 *      createjs.Sound.addEventListener("fileload", handleLoad);
	 *      createjs.Sound.registerSound("myAudioPath/mySound.mp3", "myID", 3);
	 *      function handleLoad(event) {
	 *      	myInstance = createjs.Sound.createInstance("myID");
	 *      	// alternately we could call the following
	 *      	myInstance = createjs.Sound.createInstance("myAudioPath/mySound.mp3");
	 *      }
	 *
	 * @method createInstance
	 * @param {String} src The src or ID of the audio.
	 * @return {SoundInstance} A {{#crossLink "SoundInstance"}}{{/crossLink}} that can be controlled after it is created.
	 * Unsupported extensions will return the default SoundInstance.
	 * @since 0.4.0
	 */
	s.createInstance = function (src) {
		if (!s.initializeDefaultPlugins()) {
			return s.defaultSoundInstance;
		}

		src = s.getSrcById(src);
		var details = s.parsePath(src, "sound");

		var instance = null;
		if (details != null && details.src != null) {
			// make sure that we have a sound channel (sound is registered or previously played)
			SoundChannel.create(details.src);
			instance = s.activePlugin.create(details.src);
		} else {
			// the src is not supported, so give back a dummy instance.
			// This can happen if PreloadJS fails because the plugin does not support the ext, and was passed an id which
			// will not get added to the idHash.
			instance = Sound.defaultSoundInstance;
		}

		instance.uniqueId = s.lastId++;  // OJR moved this here so we can have multiple plugins active in theory

		return instance;
	}

	/**
	 * Set the master volume of Sound. The master volume is multiplied against each sound's individual volume.  For
	 * example, if master volume is 0.5 and a sound's volume is 0.5, the resulting volume is 0.25. To set individual
	 * sound volume, use SoundInstance {{#crossLink "SoundInstance/setVolume"}}{{/crossLink}} instead.
	 *
	 * <h4>Example</h4>
	 *     createjs.Sound.setVolume(0.5);
	 *
	 * @method setVolume
	 * @param {Number} value The master volume value. The acceptable range is 0-1.
	 * @static
	 */
	s.setVolume = function (value) {
		if (Number(value) == null) {
			return false;
		}
		value = Math.max(0, Math.min(1, value));
		s.masterVolume = value;
		if (!this.activePlugin || !this.activePlugin.setVolume || !this.activePlugin.setVolume(value)) {
			var instances = this.instances;  // OJR does this impact garbage collection more than it helps performance?
			for (var i = 0, l = instances.length; i < l; i++) {
				instances[i].setMasterVolume(value);
			}
		}
	}

	/**
	 * Get the master volume of Sound. The master volume is multiplied against each sound's individual volume.
	 * To get individual sound volume, use SoundInstance {{#crossLink "SoundInstance/volume"}}{{/crossLink}} instead.
	 *
	 * <h4>Example</h4>
	 *     var masterVolume = createjs.Sound.getVolume();
	 *
	 * @method getVolume
	 * @return {Number} The master volume, in a range of 0-1.
	 * @static
	 */
	s.getVolume = function () {
		return s.masterVolume;
	}

	/**
	 * REMOVED. Please see {{#crossLink "Sound/setMute"}}{{/crossLink}}.
	 * @method mute
	 * @param {Boolean} value Whether the audio should be muted or not.
	 * @static
	 * @deprecated This function has been deprecated. Please use setMute instead.
	 */

	/**
	 * Mute/Unmute all audio. Note that muted audio still plays at 0 volume. This global mute value is maintained
	 * separately and when set will override, but not change the mute property of individual instances. To mute an individual
	 * instance, use SoundInstance {{#crossLink "SoundInstance/setMute"}}{{/crossLink}} instead.
	 *
	 * <h4>Example</h4>
	 *     createjs.Sound.setMute(true);
	 *
	 * @method setMute
	 * @param {Boolean} value Whether the audio should be muted or not.
	 * @return {Boolean} If the mute was set.
	 * @static
	 * @since 0.4.0
	 */
	s.setMute = function (value) {
		if (value == null || value == undefined) {
			return false;
		}

		this.masterMute = value;
		if (!this.activePlugin || !this.activePlugin.setMute || !this.activePlugin.setMute(value)) {
			var instances = this.instances;
			for (var i = 0, l = instances.length; i < l; i++) {
				instances[i].setMasterMute(value);
			}
		}
		return true;
	}

	/**
	 * Returns the global mute value. To get the mute value of an individual instance, use SoundInstance
	 * {{#crossLink "SoundInstance/getMute"}}{{/crossLink}} instead.
	 *
	 * <h4>Example</h4>
	 *     var masterMute = createjs.Sound.getMute();
	 *
	 * @method getMute
	 * @return {Boolean} The mute value of Sound.
	 * @static
	 * @since 0.4.0
	 */
	s.getMute = function () {
		return this.masterMute;
	}

	/**
	 * Stop all audio (global stop). Stopped audio is reset, and not paused. To play audio that has been stopped,
	 * call {{#crossLink "SoundInstance.play"}}{{/crossLink}}.
	 *
	 * <h4>Example</h4>
	 *     createjs.Sound.stop();
	 *
	 * @method stop
	 * @static
	 */
	s.stop = function () {
		var instances = this.instances;
		for (var i = instances.length; i--; ) {
			instances[i].stop();  // NOTE stop removes instance from this.instances
		}
	}


	/* ---------------
	 Internal methods
	 --------------- */
	/**
	 * Play an instance. This is called by the static API, as well as from plugins. This allows the core class to
	 * control delays.
	 * @method playInstance
	 * @param {SoundInstance} instance The {{#crossLink "SoundInstance"}}{{/crossLink}} to start playing.
	 * @param {String | Object} [interrupt="none"|options] How to interrupt any currently playing instances of audio with the same source,
	 * if the maximum number of instances of the sound are already playing. Values are defined as <code>INTERRUPT_TYPE</code>
	 * constants on the Sound class, with the default defined by {{#crossLink "Sound/defaultInterruptBehavior"}}{{/crossLink}}.
	 * <br /><strong>OR</strong><br />
	 * This parameter can be an object that contains any or all optional properties by name, including: interrupt,
	 * delay, offset, loop, volume, and pan (see the above code sample).
	 * @param {Number} [delay=0] Time in milliseconds before playback begins.
	 * @param {Number} [offset=instance.offset] Time into the sound to begin playback in milliseconds.  Defaults to the
	 * current value on the instance.
	 * @param {Number} [loop=0] The number of times to loop the audio. Use 0 for no loops, and -1 for an infinite loop.
	 * @param {Number} [volume] The volume of the sound between 0 and 1. Defaults to current instance value.
	 * @param {Number} [pan] The pan of the sound between -1 and 1. Defaults to current instance value.
	 * @return {Boolean} If the sound can start playing. Sounds that fail immediately will return false. Sounds that
	 * have a delay will return true, but may still fail to play.
	 * @protected
	 * @static
	 */
	s.playInstance = function (instance, interrupt, delay, offset, loop, volume, pan) {
		if (interrupt instanceof Object) {
			delay = interrupt.delay;
			offset = interrupt.offset;
			loop = interrupt.loop;
			volume = interrupt.volume;
			pan = interrupt.pan;
		}

		interrupt = interrupt || s.defaultInterruptBehavior;
		if (delay == null) {delay = 0;}
		if (offset == null) {offset = instance.getPosition();}
		if (loop == null) {loop = 0;}
		if (volume == null) {volume = instance.volume;}
		if (pan == null) {pan = instance.pan;}

		if (delay == 0) {
			var ok = s.beginPlaying(instance, interrupt, offset, loop, volume, pan);
			if (!ok) {
				return false;
			}
		} else {
			//Note that we can't pass arguments to proxy OR setTimeout (IE only), so just wrap the function call.
			// OJR WebAudio may want to handle this differently, so it might make sense to move this functionality into the plugins in the future
			var delayTimeoutId = setTimeout(function () {
				s.beginPlaying(instance, interrupt, offset, loop, volume, pan);
			}, delay);
			instance.delayTimeoutId = delayTimeoutId;
		}

		this.instances.push(instance);

		return true;
	}

	/**
	 * Begin playback. This is called immediately or after delay by {{#crossLink "Sound/playInstance"}}{{/crossLink}}.
	 * @method beginPlaying
	 * @param {SoundInstance} instance A {{#crossLink "SoundInstance"}}{{/crossLink}} to begin playback.
	 * @param {String} [interrupt=none] How this sound interrupts other instances with the same source. Defaults to
	 * {{#crossLink "Sound/INTERRUPT_NONE:property"}}{{/crossLink}}. Interrupts are defined as <code>INTERRUPT_TYPE</code>
	 * constants on Sound.
	 * @param {Number} [offset] Time in milliseconds into the sound to begin playback.  Defaults to the current value on
	 * the instance.
	 * @param {Number} [loop=0] The number of times to loop the audio. Use 0 for no loops, and -1 for an infinite loop.
	 * @param {Number} [volume] The volume of the sound between 0 and 1. Defaults to the current value on the instance.
	 * @param {Number} [pan=instance.pan] The pan of the sound between -1 and 1. Defaults to current instance value.
	 * @return {Boolean} If the sound can start playing. If there are no available channels, or the instance fails to
	 * start, this will return false.
	 * @protected
	 * @static
	 */
	s.beginPlaying = function (instance, interrupt, offset, loop, volume, pan) {
		if (!SoundChannel.add(instance, interrupt)) {
			return false;
		}
		var result = instance.beginPlaying(offset, loop, volume, pan);
		if (!result) {
			//LM: Should we remove this from the SoundChannel (see finishedPlaying)
			var index = createjs.indexOf(this.instances, instance);
			if (index > -1) {
				this.instances.splice(index, 1);
			}
			return false;
		}
		return true;
	}

	/**
	 * Get the source of a sound via the ID passed in with a register call. If no ID is found the value is returned
	 * instead.
	 * @method getSrcById
	 * @param {String} value The ID the sound was registered with.
	 * @return {String} The source of the sound.  Returns null if src has been registered with this id.
	 * @protected
	 * @static
	 */
	s.getSrcById = function (value) {
		if (s.idHash == null || s.idHash[value] == null) {
			return value;
		}
		return s.idHash[value];
	}

	/**
	 * A sound has completed playback, been interrupted, failed, or been stopped. This method removes the instance from
	 * Sound management. It will be added again, if the sound re-plays. Note that this method is called from the
	 * instances themselves.
	 * @method playFinished
	 * @param {SoundInstance} instance The instance that finished playback.
	 * @protected
	 * @static
	 */
	s.playFinished = function (instance) {
		SoundChannel.remove(instance);
		var index = createjs.indexOf(this.instances, instance);
		if (index > -1) {
			this.instances.splice(index, 1);
		}
	}

	/**
	 * REMOVED.  Please use createjs.proxy instead
	 * @method proxy
	 * @param {Function} method The function to call
	 * @param {Object} scope The scope to call the method name on
	 * @protected
	 * @static
	 * @deprecated Deprecated in favor of createjs.proxy.
	 */

	createjs.Sound = Sound;

	/**
	 * An internal class that manages the number of active {{#crossLink "SoundInstance"}}{{/crossLink}} instances for
	 * each sound type. This method is only used internally by the {{#crossLink "Sound"}}{{/crossLink}} class.
	 *
	 * The number of sounds is artificially limited by Sound in order to prevent over-saturation of a
	 * single sound, as well as to stay within hardware limitations, although the latter may disappear with better
	 * browser support.
	 *
	 * When a sound is played, this class ensures that there is an available instance, or interrupts an appropriate
	 * sound that is already playing.
	 * #class SoundChannel
	 * @param {String} src The source of the instances
	 * @param {Number} [max=1] The number of instances allowed
	 * @constructor
	 * @protected
	 */
	function SoundChannel(src, max) {
		this.init(src, max);
	}

	/* ------------
	 Static API
	 ------------ */
	/**
	 * A hash of channel instances indexed by source.
	 * #property channels
	 * @type {Object}
	 * @static
	 */
	SoundChannel.channels = {};

	/**
	 * Create a sound channel. Note that if the sound channel already exists, this will fail.
	 * #method create
	 * @param {String} src The source for the channel
	 * @param {Number} max The maximum amount this channel holds. The default is {{#crossLink "SoundChannel.maxDefault"}}{{/crossLink}}.
	 * @return {Boolean} If the channels were created.
	 * @static
	 */
	SoundChannel.create = function (src, max) {
		var channel = SoundChannel.get(src);
		if (channel == null) {
			SoundChannel.channels[src] = new SoundChannel(src, max);
			return true;
		}
		return false;
	}
	/**
	 * Delete a sound channel, stop and delete all related instances. Note that if the sound channel does not exist, this will fail.
	 * #method remove
	 * @param {String} src The source for the channel
	 * @return {Boolean} If the channels were deleted.
	 * @static
	 */
	SoundChannel.removeSrc = function (src) {
		var channel = SoundChannel.get(src);
		if (channel == null) {
			return false;
		}
		channel.removeAll();	// this stops and removes all active instances
		delete(SoundChannel.channels[src]);
		return true;
	}
	/**
	 * Delete all sound channels, stop and delete all related instances.
	 * #method removeAll
	 * @static
	 */
	SoundChannel.removeAll = function () {
		for(var channel in SoundChannel.channels) {
			SoundChannel.channels[channel].removeAll();	// this stops and removes all active instances
		}
		SoundChannel.channels = {};
	}
	/**
	 * Add an instance to a sound channel.
	 * #method add
	 * @param {SoundInstance} instance The instance to add to the channel
	 * @param {String} interrupt The interrupt value to use. Please see the {{#crossLink "Sound/play"}}{{/crossLink}}
	 * for details on interrupt modes.
	 * @return {Boolean} The success of the method call. If the channel is full, it will return false.
	 * @static
	 */
	SoundChannel.add = function (instance, interrupt) {
		var channel = SoundChannel.get(instance.src);
		if (channel == null) {
			return false;
		}
		return channel.add(instance, interrupt);
	}
	/**
	 * Remove an instance from the channel.
	 * #method remove
	 * @param {SoundInstance} instance The instance to remove from the channel
	 * @return The success of the method call. If there is no channel, it will return false.
	 * @static
	 */
	SoundChannel.remove = function (instance) {
		var channel = SoundChannel.get(instance.src);
		if (channel == null) {
			return false;
		}
		channel.remove(instance);
		return true;
	}
	/**
	 * Get the maximum number of sounds you can have in a channel.
	 * #method maxPerChannel
	 * @return {Number} The maximum number of sounds you can have in a channel.
	 */
	SoundChannel.maxPerChannel = function () {
		return p.maxDefault;
	}
	/**
	 * Get a channel instance by its src.
	 * #method get
	 * @param {String} src The src to use to look up the channel
	 * @static
	 */
	SoundChannel.get = function (src) {
		return SoundChannel.channels[src];
	}

	var p = SoundChannel.prototype;

	/**
	 * The source of the channel.
	 * #property src
	 * @type {String}
	 */
	p.src = null;

	/**
	 * The maximum number of instances in this channel.  -1 indicates no limit
	 * #property max
	 * @type {Number}
	 */
	p.max = null;

	/**
	 * The default value to set for max, if it isn't passed in.  Also used if -1 is passed.
	 * #property maxDefault
	 * @type {Number}
	 * @default 100
	 * @since 0.4.0
	 */
	p.maxDefault = 100;

	/**
	 * The current number of active instances.
	 * #property length
	 * @type {Number}
	 */
	p.length = 0;

	/**
	 * Initialize the channel.
	 * #method init
	 * @param {String} src The source of the channel
	 * @param {Number} max The maximum number of instances in the channel
	 * @protected
	 */
	p.init = function (src, max) {
		this.src = src;
		this.max = max || this.maxDefault;
		if (this.max == -1) {
			this.max == this.maxDefault;
		}
		this.instances = [];
	};

	/**
	 * Get an instance by index.
	 * #method get
	 * @param {Number} index The index to return.
	 * @return {SoundInstance} The SoundInstance at a specific instance.
	 */
	p.get = function (index) {
		return this.instances[index];
	};

	/**
	 * Add a new instance to the channel.
	 * #method add
	 * @param {SoundInstance} instance The instance to add.
	 * @return {Boolean} The success of the method call. If the channel is full, it will return false.
	 */
	p.add = function (instance, interrupt) {
		if (!this.getSlot(interrupt, instance)) {
			return false;
		}
		this.instances.push(instance);
		this.length++;
		return true;
	};

	/**
	 * Remove an instance from the channel, either when it has finished playing, or it has been interrupted.
	 * #method remove
	 * @param {SoundInstance} instance The instance to remove
	 * @return {Boolean} The success of the remove call. If the instance is not found in this channel, it will
	 * return false.
	 */
	p.remove = function (instance) {
		var index = createjs.indexOf(this.instances, instance);
		if (index == -1) {
			return false;
		}
		this.instances.splice(index, 1);
		this.length--;
		return true;
	};

	/**
	 * Stop playback and remove all instances from the channel.  Usually in response to a delete call.
	 * #method removeAll
	 */
	p.removeAll = function () {
		// Note that stop() removes the item from the list, but we don't want to assume that.
		for (var i=this.length-1; i>=0; i--) {
			this.instances[i].stop();
		}
	};

	/**
	 * Get an available slot depending on interrupt value and if slots are available.
	 * #method getSlot
	 * @param {String} interrupt The interrupt value to use.
	 * @param {SoundInstance} instance The sound instance that will go in the channel if successful.
	 * @return {Boolean} Determines if there is an available slot. Depending on the interrupt mode, if there are no slots,
	 * an existing SoundInstance may be interrupted. If there are no slots, this method returns false.
	 */
	p.getSlot = function (interrupt, instance) {
		var target, replacement;

		for (var i = 0, l = this.max; i < l; i++) {
			target = this.get(i);

			// Available Space
			if (target == null) {
				return true;
			} else if (interrupt == Sound.INTERRUPT_NONE && target.playState != Sound.PLAY_FINISHED) {
				continue;
			}

			// First replacement candidate
			if (i == 0) {
				replacement = target;
				continue;
			}

			// Audio is complete or not playing
			if (target.playState == Sound.PLAY_FINISHED ||
					target.playState == Sound.PLAY_INTERRUPTED ||
					target.playState == Sound.PLAY_FAILED) {
				replacement = target;

				// Audio is a better candidate than the current target, according to playhead
			} else if (
					(interrupt == Sound.INTERRUPT_EARLY && target.getPosition() < replacement.getPosition()) ||
							(interrupt == Sound.INTERRUPT_LATE && target.getPosition() > replacement.getPosition())) {
				replacement = target;
			}
		}

		if (replacement != null) {
			replacement.interrupt();
			this.remove(replacement);
			return true;
		}
		return false;
	};

	p.toString = function () {
		return "[Sound SoundChannel]";
	};

	// do not add SoundChannel to namespace


	// This is a dummy sound instance, which allows Sound to return something so developers don't need to check nulls.
	function SoundInstance() {
		this.isDefault = true;
		this.addEventListener = this.removeEventListener = this.removeAllEventListener = this.dispatchEvent = this.hasEventListener = this._listeners = this.interrupt = this.playFailed = this.pause = this.resume = this.play = this.beginPlaying = this.cleanUp = this.stop = this.setMasterVolume = this.setVolume = this.mute = this.setMute = this.getMute = this.setPan = this.getPosition = this.setPosition = function () {
			return false;
		};
		this.getVolume = this.getPan = this.getDuration = function () {
			return 0;
		}
		this.playState = Sound.PLAY_FAILED;
		this.toString = function () {
			return "[Sound Default Sound Instance]";
		}
	}

	Sound.defaultSoundInstance = new SoundInstance();

	//TODO: Moved to createjs/utils/Proxy.js. Deprecate on next version.
	if (createjs.proxy == null) {
		createjs.proxy = function() {
			throw("Proxy has been moved to an external file, and must be included separately.");
		}
	}


	/**
	 * An additional module to determine the current browser, version, operating system, and other environment
	 * variables. It is not publically documented.
	 * #class BrowserDetect
	 * @param {Boolean} isFirefox True if our browser is Firefox.
	 * @param {Boolean} isOpera True if our browser is opera.
	 * @param {Boolean} isChrome True if our browser is Chrome.  Note that Chrome for Android returns true, but is a
	 * completely different browser with different abilities.
	 * @param {Boolean} isIOS True if our browser is safari for iOS devices (iPad, iPhone, and iPad).
	 * @param {Boolean} isAndroid True if our browser is Android.
	 * @param {Boolean} isBlackberry True if our browser is Blackberry.
	 * @constructor
	 * @static
	 */
	function BrowserDetect() {
	}

	BrowserDetect.init = function () {
		var agent = window.navigator.userAgent;
		BrowserDetect.isFirefox = (agent.indexOf("Firefox") > -1);
		BrowserDetect.isOpera = (window.opera != null);
		BrowserDetect.isChrome = (agent.indexOf("Chrome") > -1);  // NOTE that Chrome on Android returns true but is a completely different browser with different abilities
		BrowserDetect.isIOS = agent.indexOf("iPod") > -1 || agent.indexOf("iPhone") > -1 || agent.indexOf("iPad") > -1;
		BrowserDetect.isAndroid = (agent.indexOf("Android") > -1);
		BrowserDetect.isBlackberry = (agent.indexOf("Blackberry") > -1);
	}

	BrowserDetect.init();

	createjs.Sound.BrowserDetect = BrowserDetect;

}());

/*
 * HTMLAudioPlugin
 * Visit http://createjs.com/ for documentation, updates and examples.
 *
 *
 * Copyright (c) 2012 gskinner.com, inc.
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 */

/**
 * @module SoundJS
 */

// namespace:
this.createjs = this.createjs || {};

(function () {

	"use strict";

	/**
	 * Play sounds using HTML &lt;audio&gt; tags in the browser. This plugin is the second priority plugin installed
	 * by default, after the {{#crossLink "WebAudioPlugin"}}{{/crossLink}}, which is supported on Chrome, Safari, and
	 * iOS. This handles audio in all other modern browsers. For older browsers that do not support html audio, include
	 * and install the {{#crossLink "FlashPlugin"}}{{/crossLink}}.
	 *
	 * <h4>Known Browser and OS issues for HTML Audio</h4>
	 * <b>All browsers</b><br />
	 * Testing has shown in all browsers there is a limit to how many audio tag instances you are allowed.  If you exceed
	 * this limit, you can expect to see unpredictable results.  This will be seen as soon as you register sounds, as
	 * tags are precreated to all Chrome to load them.  Please use {{#crossLink "Sound.MAX_INSTANCES"}}{{/crossLink}} as
	 * a guide to how many total audio tags you can safely use in all browsers.
	 *
     * <b>IE 9 html limitations</b><br />
     * <ul><li>There is a delay in applying volume changes to tags that occurs once playback is started. So if you have
     * muted all sounds, they will all play during this delay until the mute applies internally. This happens regardless of
     * when or how you apply the volume change, as the tag seems to need to play to apply it.</li>
     * <li>MP3 encoding will not always work for audio tags if it's not default.  We've found default encoding with
     * 64kbps works.</li>
	 * <li>There is a limit to how many audio tags you can load and play at once, which appears to be determined by
	 * hardware and browser settings.  See {{#crossLink "HTMLAudioPlugin.MAX_INSTANCES"}}{{/crossLink}} for a safe estimate.</li></ul>
	 *
	 * <b>Safari limitations</b><br />
	 * <ul><li>Safari requires Quicktime to be installed for audio playback.</li></ul>
	 *
	 * <b>iOS 6 limitations</b><br />
	 * Note it is recommended to use {{#crossLink "WebAudioPlugin"}}{{/crossLink}} for iOS (6+). HTML Audio is disabled by
	 * default as it can only have one &lt;audio&gt; tag, can not preload or autoplay the audio, can not cache the audio,
	 * and can not play the audio except inside a user initiated event.
	 *<br /><br />
	 * <b>Android HTML Audio limitations</b><br />
	 * <ul><li>We have no control over audio volume. Only the user can set volume on their device.</li>
	 *      <li>We can only play audio inside a user event (touch/click).  This currently means you cannot loop sound or use a delay.</li>
	 * <b> Android Chrome 26.0.1410.58 specific limitations</b><br />
	 * 		<li>Chrome reports true when you run createjs.Sound.BrowserDetect.isChrome, but is a different browser
	 *      with different abilities.</li>
	 *      <li>Can only play 1 sound at a time.</li>
	 *      <li>Sound is not cached.</li>
	 *      <li>Sound can only be loaded in a user initiated touch/click event.</li>
	 *      <li>There is a delay before a sound is played, presumably while the src is loaded.</li>
	 * </ul>
	 *
	 * See {{#crossLink "Sound"}}{{/crossLink}} for general notes on known issues.
	 *
	 * @class HTMLAudioPlugin
	 * @constructor
	 */
	function HTMLAudioPlugin() {
		this.init();
	}

	var s = HTMLAudioPlugin;

	/**
	 * The maximum number of instances that can be loaded and played. This is a browser limitation, primarily limited to IE9.
	 * The actual number varies from browser to browser (and is largely hardware dependant), but this is a safe estimate.
	 * @property MAX_INSTANCES
	 * @type {Number}
	 * @default 30
	 * @static
	 */
	s.MAX_INSTANCES = 30;

	/**
	 * The capabilities of the plugin. This is generated via the the SoundInstance {{#crossLink "HTMLAudioPlugin/generateCapabilities"}}{{/crossLink}}
	 * method. Please see the Sound {{#crossLink "Sound/getCapabilities"}}{{/crossLink}} method for an overview of all
	 * of the available properties.
	 * @property capabilities
	 * @type {Object}
	 * @protected
	 * @static
	 */
	s.capabilities = null;

	/**
	 * Event constant for the "canPlayThrough" event for cleaner code.
	 * @property AUDIO_READY
	 * @type {String}
	 * @default canplaythrough
	 * @static
	 */
	s.AUDIO_READY = "canplaythrough";

	/**
	 * Event constant for the "ended" event for cleaner code.
	 * @property AUDIO_ENDED
	 * @type {String}
	 * @default ended
	 * @static
	 */
	s.AUDIO_ENDED = "ended";

	/**
	 * Event constant for the "seeked" event for cleaner code.  We utilize this event for maintaining loop events.
	 * @property AUDIO_SEEKED
	 * @type {String}
	 * @default seeked
	 * @static
	 */
	s.AUDIO_SEEKED = "seeked";

	/**
	 * Event constant for the "error" event for cleaner code.
	 * @property AUDIO_ERROR
	 * @type {String}
	 * @default error
	 * @static
	 */
	s.AUDIO_ERROR = "error"; //TODO: Handle error cases

	/**
	 * Event constant for the "stalled" event for cleaner code.
	 * @property AUDIO_STALLED
	 * @type {String}
	 * @default stalled
	 * @static
	 */
	s.AUDIO_STALLED = "stalled";


	/**
	 * Allows users to enable HTML audio on IOS, which is disabled by default.
	 * Note this needs to be set before HTMLAudioPlugin is registered with SoundJS.
	 * This is not recommend because of severe limitations on IOS devices including:
	 * <li>it can only have one &lt;audio&gt; tag</li>
	 * <li>can not preload or autoplay the audio</li>
	 * <li>can not cache the audio</li>
	 * <li>can not play the audio except inside a user initiated event</li>
	 *
	 * @property enableIOS
	 * @type {Boolean}
	 * @default false
	 */
	s.enableIOS = false;

	/**
	 * Determine if the plugin can be used in the current browser/OS. Note that HTML audio is available in most modern
	 * browsers, but is disabled in iOS because of its limitations.
	 * @method isSupported
	 * @return {Boolean} If the plugin can be initialized.
	 * @static
	 */
	s.isSupported = function () {
		// HTML audio can be enable on iOS by removing this if statement, but it is not recommended due to the limitations:
		// iOS can only have a single <audio> instance, cannot preload or autoplay, cannot cache sound, and can only be
		// played in response to a user event (click)
		if (createjs.Sound.BrowserDetect.isIOS && !s.enableIOS) {
			return false;
		}
		s.generateCapabilities();
		var t = s.tag;  // OJR do we still need this check, when cap will already be null if this is the case
		if (t == null || s.capabilities == null) {
			return false;
		}
		return true;
	};

	/**
	 * Determine the capabilities of the plugin. Used internally. Please see the Sound API {{#crossLink "Sound/getCapabilities"}}{{/crossLink}}
	 * method for an overview of plugin capabilities.
	 * @method generateCapabiities
	 * @static
	 * @protected
	 */
	s.generateCapabilities = function () {
		if (s.capabilities != null) {
			return;
		}
		var t = s.tag = document.createElement("audio");
		if (t.canPlayType == null) {
			return null;
		}

		s.capabilities = {
			panning:true,
			volume:true,
			tracks:-1
		};

		// determine which extensions our browser supports for this plugin by iterating through Sound.SUPPORTED_EXTENSIONS
		var supportedExtensions = createjs.Sound.SUPPORTED_EXTENSIONS;
		var extensionMap = createjs.Sound.EXTENSION_MAP;
		for (var i = 0, l = supportedExtensions.length; i < l; i++) {
			var ext = supportedExtensions[i];
			var playType = extensionMap[ext] || ext;
			s.capabilities[ext] = (t.canPlayType("audio/" + ext) != "no" && t.canPlayType("audio/" + ext) != "") || (t.canPlayType("audio/" + playType) != "no" && t.canPlayType("audio/" + playType) != "");
		}  // OJR another way to do this might be canPlayType:"m4a", codex: mp4
	}

	var p = HTMLAudioPlugin.prototype;

	// doc'd above
	p.capabilities = null;

	/**
	 * Object hash indexed by the source of each file to indicate if an audio source is loaded, or loading.
	 * @property audioSources
	 * @type {Object}
	 * @protected
	 * @since 0.4.0
	 */
	p.audioSources = null;

	/**
	 * The default number of instances to allow.  Passed back to {{#crossLink "Sound"}}{{/crossLink}} when a source
	 * is registered using the {{#crossLink "Sound/register"}}{{/crossLink}} method.  This is only used if
	 * a value is not provided.
	 *
	 * <b>NOTE this property only exists as a limitation of HTML audio.</b>
	 * @property defaultNumChannels
	 * @type {Number}
	 * @default 2
	 * @since 0.4.0
	 */
	p.defaultNumChannels = 2;

	// Proxies, make removing listeners easier.
	p.loadedHandler = null;

	/**
	 * An initialization function run by the constructor
	 * @method init
	 * @protected
	 */
	p.init = function () {
		this.capabilities = s.capabilities;
		this.audioSources = {};
	};

	/**
	 * Pre-register a sound instance when preloading/setup. This is called by {{#crossLink "Sound"}}{{/crossLink}}.
	 * Note that this provides an object containing a tag used for preloading purposes, which
	 * <a href="http://preloadjs.com">PreloadJS</a> can use to assist with preloading.
	 * @method register
	 * @param {String} src The source of the audio
	 * @param {Number} instances The number of concurrently playing instances to allow for the channel at any time.
	 * @return {Object} A result object, containing a tag for preloading purposes and a numChannels value for internally
	 * controlling how many instances of a source can be played by default.
	 */
	p.register = function (src, instances) {
		this.audioSources[src] = true;  // Note this does not mean preloading has started
		var channel = createjs.HTMLAudioPlugin.TagPool.get(src);
		var tag = null;
		var l = instances || this.defaultNumChannels;
		for (var i = 0; i < l; i++) {  // OJR should we be enforcing s.MAX_INSTANCES here?  Does the chrome bug still exist, or can we change this code?
			tag = this.createTag(src);
			channel.add(tag);
		}

		tag.id = src;	// co-opting id as we need a way to store original src in case it is changed before loading
		this.loadedHandler = createjs.proxy(this.handleTagLoad, this);  // we need this bind to be able to remove event listeners
		tag.addEventListener && tag.addEventListener("canplaythrough", this.loadedHandler);
		if(tag.onreadystatechange == null) {
			tag.onreadystatechange = this.loadedHandler;
		} else {
			var f = tag.onreadystatechange;
			// OJR will this lose scope?
			tag.onreadystatechange = function() {
				f();
				this.loadedHandler();
			}
		}

		return {
			tag:tag, // Return one instance for preloading purposes
			numChannels:l  // The default number of channels to make for this Sound or the passed in value
		};
	};

	/**
	 * Checks if src was changed on tag used to create instances in TagPool before loading
	 * Currently PreloadJS does this when a basePath is set, so we are replicating that behavior for internal preloading.
	 * @method handleTagLoad
	 * @param event
	 * @protected
	 */
	p.handleTagLoad = function(event) {
		// cleanup and so we don't send the event more than once
		event.target.removeEventListener && event.target.removeEventListener("canplaythrough", this.loadedHandler);
		event.target.onreadystatechange = null;

		if (event.target.src == event.target.id) { return; }
		// else src has changed before loading, and we need to make the change to TagPool because we pre create tags
		createjs.HTMLAudioPlugin.TagPool.checkSrc(event.target.id);
	};

	/**
	 * Create an HTML audio tag.
	 * @method createTag
	 * @param {String} src The source file to set for the audio tag.
	 * @return {HTMLElement} Returns an HTML audio tag.
	 * @protected
	 */
	p.createTag = function (src) {
		var tag = document.createElement("audio");
		tag.autoplay = false;
		tag.preload = "none";
		//LM: Firefox fails when this the preload="none" for other tags, but it needs to be "none" to ensure PreloadJS works.
		tag.src = src;
		return tag;
	};

	/**
	 * Remove a sound added using {{#crossLink "HTMLAudioPlugin/register"}}{{/crossLink}}. Note this does not cancel
	 * a preload.
	 * @method removeSound
	 * @param {String} src The sound URI to unload.
	 * @since 0.4.1
	 */
	p.removeSound = function (src) {
		delete(this.audioSources[src]);
		createjs.HTMLAudioPlugin.TagPool.remove(src);
	};

	/**
	 * Remove all sounds added using {{#crossLink "HTMLAudioPlugin/register"}}{{/crossLink}}. Note this does not cancel a preload.
	 * @method removeAllSounds
	 * @param {String} src The sound URI to unload.
	 * @since 0.4.1
	 */
	p.removeAllSounds = function () {
		this.audioSources = {};	// this drops all references, in theory freeing them for garbage collection
		createjs.HTMLAudioPlugin.TagPool.removeAll();
	};

	/**
	 * Create a sound instance. If the sound has not been preloaded, it is internally preloaded here.
	 * @method create
	 * @param {String} src The sound source to use.
	 * @return {SoundInstance} A sound instance for playback and control.
	 */
	p.create = function (src) {
		// if this sound has not be registered, create a tag and preload it
		if (!this.isPreloadStarted(src)) {
			var channel = createjs.HTMLAudioPlugin.TagPool.get(src);
			var tag = this.createTag(src);
			tag.id = src;
			channel.add(tag);
			this.preload(src, {tag:tag});
		}

		return new createjs.HTMLAudioPlugin.SoundInstance(src, this);
	};

	/**
	 * Checks if preloading has started for a specific source.
	 * @method isPreloadStarted
	 * @param {String} src The sound URI to check.
	 * @return {Boolean} If the preload has started.
	 * @since 0.4.0
	 */
	p.isPreloadStarted = function (src) {
		return (this.audioSources[src] != null);
	};

	/**
	 * Internally preload a sound.
	 * @method preload
	 * @param {String} src The sound URI to load.
	 * @param {Object} instance An object containing a tag property that is an HTML audio tag used to load src.
	 * @param {String} basePath A file path to prepend to the src.
	 * @since 0.4.0
	 */
	p.preload = function (src, instance, basePath) {
		this.audioSources[src] = true;
		if(basePath != null) {instance.tag.src = basePath + src;}
		new createjs.HTMLAudioPlugin.Loader(src, instance.tag);
	};

	p.toString = function () {
		return "[HTMLAudioPlugin]";
	};

	createjs.HTMLAudioPlugin = HTMLAudioPlugin;
}());


(function () {

	"use strict";

	// NOTE Documentation for the SoundInstance class in WebAudioPlugin file. Each plugin generates a SoundInstance that
	// follows the same interface.
	function SoundInstance(src, owner) {
		this.init(src, owner);
	}

	var p = SoundInstance.prototype;

	p.src = null,
	p.uniqueId = -1;
	p.playState = null;
	p.owner = null;
	p.loaded = false;
	p.offset = 0;
	p.delay = 0;
	p._volume =  1;
	// IE8 has Object.defineProperty, but only for DOM objects, so check if fails to suppress errors
	try {
		Object.defineProperty(p, "volume", {
			get: function() {
				return this._volume;
			},
			set: function(value) {
				if (Number(value) == null) {return;}
				value = Math.max(0, Math.min(1, value));
				this._volume = value;
				this.updateVolume();
			}
		});
	} catch (e) {
		// dispatch message or error?
	};
	p.pan = 0;
	p.duration = 0;
	p.remainingLoops = 0;
	p.delayTimeoutId = null;
	p.tag = null;
	p.muted = false;
	p.paused = false;

// mix-ins:
	// EventDispatcher methods:
	p.addEventListener = null;
	p.removeEventListener = null;
	p.removeAllEventListeners = null;
	p.dispatchEvent = null;
	p.hasEventListener = null;
	p._listeners = null;

	// Proxies, make removing listeners easier.
	p.endedHandler = null;
	p.readyHandler = null;
	p.stalledHandler = null;
	p.loopHandler = null;

// Constructor
	p.init = function (src, owner) {
		this.src = src;
		this.owner = owner;

		this.endedHandler = createjs.proxy(this.handleSoundComplete, this);
		this.readyHandler = createjs.proxy(this.handleSoundReady, this);
		this.stalledHandler = createjs.proxy(this.handleSoundStalled, this);
		this.loopHandler = createjs.proxy(this.handleSoundLoop, this);
	};

	p.sendEvent = function (type) {
		var event = new createjs.Event(type);
		this.dispatchEvent(event);
	};

	p.cleanUp = function () {
		var tag = this.tag;
		if (tag != null) {
			tag.pause();
			tag.removeEventListener(createjs.HTMLAudioPlugin.AUDIO_ENDED, this.endedHandler, false);
			tag.removeEventListener(createjs.HTMLAudioPlugin.AUDIO_READY, this.readyHandler, false);
			tag.removeEventListener(createjs.HTMLAudioPlugin.AUDIO_SEEKED, this.loopHandler, false);
			try {
				tag.currentTime = 0;
			} catch (e) {
			} // Reset Position
			createjs.HTMLAudioPlugin.TagPool.setInstance(this.src, tag);
			this.tag = null;
		}

		clearTimeout(this.delayTimeoutId);
		if (window.createjs == null) {
			return;
		}
		createjs.Sound.playFinished(this);
	};

	p.interrupt = function () {
		if (this.tag == null) {
			return;
		}
		this.playState = createjs.Sound.PLAY_INTERRUPTED;
		this.cleanUp();
		this.paused = false;
		this.sendEvent("interrupted");
	};

// Public API
	p.play = function (interrupt, delay, offset, loop, volume, pan) {
		this.cleanUp(); //LM: Is this redundant?
		createjs.Sound.playInstance(this, interrupt, delay, offset, loop, volume, pan);
	};

	p.beginPlaying = function (offset, loop, volume, pan) {
		if (window.createjs == null) {
			return -1;
		}
		var tag = this.tag = createjs.HTMLAudioPlugin.TagPool.getInstance(this.src);
		if (tag == null) {
			this.playFailed();
			return -1;
		}

		tag.addEventListener(createjs.HTMLAudioPlugin.AUDIO_ENDED, this.endedHandler, false);

		// Reset this instance.
		this.offset = offset;
		this.volume = volume;
		this.pan = pan;	// not pan has no effect
		this.updateVolume();  // note this will set for mute and masterMute
		this.remainingLoops = loop;

		if (tag.readyState !== 4) {
			tag.addEventListener(createjs.HTMLAudioPlugin.AUDIO_READY, this.readyHandler, false);
			tag.addEventListener(createjs.HTMLAudioPlugin.AUDIO_STALLED, this.stalledHandler, false);
			tag.preload = "auto"; // This is necessary for Firefox, as it won't ever "load" until this is set.
			tag.load();
		} else {
			this.handleSoundReady(null);
		}

		this.sendEvent("succeeded");
		return 1;
	};

	// Note: Sounds stall when trying to begin playback of a new audio instance when the existing instances
	//  has not loaded yet. This doesn't mean the sound will not play.
	p.handleSoundStalled = function (event) {
		this.cleanUp();  // OJR NOTE this will stop playback, and I think we should remove this and let the developer decide how to handle stalled instances
		this.sendEvent("failed");
	};

	p.handleSoundReady = function (event) {
		if (window.createjs == null) {
			return;
		}

		// OJR would like a cleaner way to do this in init, discuss with LM
		this.duration = this.tag.duration * 1000;  // need this for setPosition on stopped sounds

		this.playState = createjs.Sound.PLAY_SUCCEEDED;
		this.paused = false;
		this.tag.removeEventListener(createjs.HTMLAudioPlugin.AUDIO_READY, this.readyHandler, false);

		if (this.offset >= this.getDuration()) {
			this.playFailed();  // OJR: throw error?
			return;
		} else if (this.offset > 0) {
			this.tag.currentTime = this.offset * 0.001;
		}
		if (this.remainingLoops == -1) {
			this.tag.loop = true;
		}
		if(this.remainingLoops != 0) {
			this.tag.addEventListener(createjs.HTMLAudioPlugin.AUDIO_SEEKED, this.loopHandler, false);
			this.tag.loop = true;
		}
		this.tag.play();
	};

	p.pause = function () {
		if (!this.paused && this.playState == createjs.Sound.PLAY_SUCCEEDED && this.tag != null) {
			this.paused = true;
			// Note: when paused by user, we hold a reference to our tag. We do not release it until stopped.
			this.tag.pause();

			clearTimeout(this.delayTimeoutId);

			return true;
		}
		return false;
	};

	p.resume = function () {
		if (!this.paused || this.tag == null) {
			return false;
		}
		this.paused = false;
		this.tag.play();
		return true;
	};

	p.stop = function () {
		this.offset = 0;
		this.pause();
		this.playState = createjs.Sound.PLAY_FINISHED;
		this.cleanUp();
		return true;
	};

	p.setMasterVolume = function (value) {
		this.updateVolume();
		return true;
	};

	p.setVolume = function (value) {
		this.volume = value;
		return true;
	};

	p.updateVolume = function () {
		if (this.tag != null) {
			var newVolume = (this.muted || createjs.Sound.masterMute) ? 0 : this._volume * createjs.Sound.masterVolume;
			if (newVolume != this.tag.volume) {
				this.tag.volume = newVolume;
			}
			return true;
		} else {
			return false;
		}
	};

	p.getVolume = function (value) {
		return this.volume;
	};

	p.setMasterMute = function (isMuted) {
		this.updateVolume();
		return true;
	};

	p.setMute = function (isMuted) {
		if (isMuted == null || isMuted == undefined) {
			return false;
		}

		this.muted = isMuted;
		this.updateVolume();
		return true;
	};

	p.getMute = function () {
		return this.muted;
	};

	// Can not set pan in HTML
	p.setPan = function (value) {
		return false;
	};

	p.getPan = function () {
		return 0;
	};

	p.getPosition = function () {
		if (this.tag == null) {
			return this.offset;
		}
		return this.tag.currentTime * 1000;
	};

	p.setPosition = function (value) {
		if (this.tag == null) {
			this.offset = value
		} else {
			this.tag.removeEventListener(createjs.HTMLAudioPlugin.AUDIO_SEEKED, this.loopHandler, false);
			try {
				this.tag.currentTime = value * 0.001;
			} catch (error) { // Out of range
				return false;
			}
			this.tag.addEventListener(createjs.HTMLAudioPlugin.AUDIO_SEEKED, this.loopHandler, false);
		}
		return true;
	};

	p.getDuration = function () {  // NOTE this will always return 0 until sound has been played.
		return this.duration;
	};

	p.handleSoundComplete = function (event) {
		this.offset = 0;

		if (window.createjs == null) {
			return;
		}
		this.playState = createjs.Sound.PLAY_FINISHED;
		this.cleanUp();
		this.sendEvent("complete");
	};

	// handles looping functionality
	// NOTE with this approach audio will loop as reliably as the browser allows
	// but we could end up sending the loop event after next loop playback begins
	p.handleSoundLoop = function (event) {
		this.offset = 0;

		this.remainingLoops--;
		if(this.remainingLoops == 0) {
			this.tag.loop = false;
			this.tag.removeEventListener(createjs.HTMLAudioPlugin.AUDIO_SEEKED, this.loopHandler, false);
		}
		this.sendEvent("loop");
	};

	p.playFailed = function () {
		if (window.createjs == null) {
			return;
		}
		this.playState = createjs.Sound.PLAY_FAILED;
		this.cleanUp();
		this.sendEvent("failed");
	};

	p.toString = function () {
		return "[HTMLAudioPlugin SoundInstance]";
	};

	createjs.EventDispatcher.initialize(SoundInstance.prototype);

	createjs.HTMLAudioPlugin.SoundInstance = SoundInstance;

}());


(function () {

	"use strict";

	/**
	 * An internal helper class that preloads html audio via HTMLAudioElement tags. Note that PreloadJS will NOT use
	 * this load class like it does Flash and WebAudio plugins.
	 * Note that this class and its methods are not documented properly to avoid generating HTML documentation.
	 * #class Loader
	 * @param {String} src The source of the sound to load.
	 * @param {HTMLAudioElement} tag The audio tag of the sound to load.
	 * @constructor
	 * @protected
	 * @since 0.4.0
	 */
	function Loader(src, tag) {
		this.init(src, tag);
	}

	var p = Loader.prototype;

	/**
	 * The source to be loaded.
	 * #property src
	 * @type {String}
	 * @default null
	 * @protected
	 */
	p.src = null;

	/**
	 * The tag to load the source with / into.
	 * #property tag
	 * @type {AudioTag}
	 * @default null
	 * @protected
	 */
	p.tag = null;

	/**
	 * An interval used to give us progress.
	 * #property preloadTimer
	 * @type {String}
	 * @default null
	 * @protected
	 */
	p.preloadTimer = null;

	// Proxies, make removing listeners easier.
	p.loadedHandler = null;

	// constructor
	p.init = function (src, tag) {
		this.src = src;
		this.tag = tag;

		this.preloadTimer = setInterval(createjs.proxy(this.preloadTick, this), 200);

		// This will tell us when audio is buffered enough to play through, but not when its loaded.
		// The tag doesn't keep loading in Chrome once enough has buffered, and we have decided that behaviour is sufficient.
		// Note that canplaythrough callback doesn't work in Chrome, we have to use the event.
		this.loadedHandler = createjs.proxy(this.sendLoadedEvent, this);  // we need this bind to be able to remove event listeners
		this.tag.addEventListener && this.tag.addEventListener("canplaythrough", this.loadedHandler);
		if(this.tag.onreadystatechange == null) {
			this.tag.onreadystatechange = createjs.proxy(this.sendLoadedEvent, this);  // OJR not 100% sure we need this, just copied from PreloadJS
		} else {
			var f = this.tag.onreadystatechange;
			this.tag.onreadystatechange = function() {
				f();
				this.tag.onreadystatechange = createjs.proxy(this.sendLoadedEvent, this);  // OJR not 100% sure we need this, just copied from PreloadJS
			}
		}

		this.tag.preload = "auto";
		//this.tag.src = src;
		this.tag.load();
	};

	/**
	 * Allows us to have preloading progress and tell when its done.
	 * #method preloadTick
	 * @protected
	 */
	p.preloadTick = function () {
		var buffered = this.tag.buffered;
		var duration = this.tag.duration;

		if (buffered.length > 0) {
			if (buffered.end(0) >= duration - 1) {
				this.handleTagLoaded();
			}
		}
	};

	/**
	 * Internal handler for when a tag is loaded.
	 * #method handleTagLoaded
	 * @protected
	 */
	p.handleTagLoaded = function () {
		clearInterval(this.preloadTimer);
	};

	/**
	 * Communicates back to Sound that a load is complete.
	 * #method sendLoadedEvent
	 * @param {Object} evt The load Event
	 */
	p.sendLoadedEvent = function (evt) {
		this.tag.removeEventListener && this.tag.removeEventListener("canplaythrough", this.loadedHandler);  // cleanup and so we don't send the event more than once
		this.tag.onreadystatechange = null;  // cleanup and so we don't send the event more than once
		createjs.Sound.sendFileLoadEvent(this.src);  // fire event or callback on Sound
	};

	// used for debugging
	p.toString = function () {
		return "[HTMLAudioPlugin Loader]";
	}

	createjs.HTMLAudioPlugin.Loader = Loader;

}());


(function () {

	"use strict";

	/**
	 * The TagPool is an object pool for HTMLAudio tag instances. In Chrome, we have to pre-create the number of HTML
	 * audio tag instances that we are going to play before we load the data, otherwise the audio stalls.
	 * (Note: This seems to be a bug in Chrome)
	 * #class TagPool
	 * @param {String} src The source of the channel.
	 * @protected
	 */
	function TagPool(src) {
		this.init(src);
	}

	var s = TagPool;

	/**
	 * A hash lookup of each sound channel, indexed by the audio source.
	 * #property tags
	 * @static
	 * @protected
	 */
	s.tags = {};

	/**
	 * Get a tag pool. If the pool doesn't exist, create it.
	 * #method get
	 * @param {String} src The source file used by the audio tag.
	 * @static
	 * @protected
	 */
	s.get = function (src) {
		var channel = s.tags[src];
		if (channel == null) {
			channel = s.tags[src] = new TagPool(src);
		}
		return channel;
	}

	/**
	 * Delete a TagPool and all related tags. Note that if the TagPool does not exist, this will fail.
	 * #method remove
	 * @param {String} src The source for the tag
	 * @return {Boolean} If the TagPool was deleted.
	 * @static
	 */
	s.remove = function (src) {
		var channel = s.tags[src];
		if (channel == null) {
			return false;
		}
		channel.removeAll();
		delete(s.tags[src]);
		return true;
	}

	/**
	 * Delete all TagPools and all related tags.
	 * #method removeAll
	 * @static
	 */
	s.removeAll = function () {
		for(var channel in s.tags) {
			s.tags[channel].removeAll();	// this stops and removes all active instances
		}
		s.tags = {};
	}

	/**
	 * Get a tag instance. This is a shortcut method.
	 * #method getInstance
	 * @param {String} src The source file used by the audio tag.
	 * @static
	 * @protected
	 */
	s.getInstance = function (src) {
		var channel = s.tags[src];
		if (channel == null) {
			return null;
		}
		return channel.get();
	}

	/**
	 * Return a tag instance. This is a shortcut method.
	 * #method setInstance
	 * @param {String} src The source file used by the audio tag.
	 * @param {HTMLElement} tag Audio tag to set.
	 * @static
	 * @protected
	 */
	s.setInstance = function (src, tag) {
		var channel = s.tags[src];
		if (channel == null) {
			return null;
		}
		return channel.set(tag);
	}

	/**
	 * A function to check if src has changed in the loaded audio tag.
	 * This is required because PreloadJS appends a basePath to the src before loading.
	 * Note this is currently only called when a change is detected
	 * #method checkSrc
	 * @param src the unaltered src that is used to store the channel.
	 * @static
	 * @protected
	 */
	s.checkSrc = function (src) {
		var channel = s.tags[src];
		if (channel == null) {
			return null;
		}
		channel.checkSrcChange();
	}

	var p = TagPool.prototype;

	/**
	 * The source of the tag pool.
	 * #property src
	 * @type {String}
	 * @protected
	 */
	p.src = null;

	/**
	 * The total number of HTMLAudio tags in this pool. This is the maximum number of instance of a certain sound
	 * that can play at one time.
	 * #property length
	 * @type {Number}
	 * @default 0
	 * @protected
	 */
	p.length = 0;

	/**
	 * The number of unused HTMLAudio tags.
	 * #property available
	 * @type {Number}
	 * @default 0
	 * @protected
	 */
	p.available = 0;

	/**
	 * A list of all available tags in the pool.
	 * #property tags
	 * @type {Array}
	 * @protected
	 */
	p.tags = null;

	// constructor
	p.init = function (src) {
		this.src = src;
		this.tags = [];
	};

	/**
	 * Add an HTMLAudio tag into the pool.
	 * #method add
	 * @param {HTMLAudioElement} tag A tag to be used for playback.
	 */
	p.add = function (tag) {
		this.tags.push(tag);
		this.length++;
		this.available++;
	};

	/**
	 * Remove all tags from the channel.  Usually in response to a delete call.
	 * #method removeAll
	 */
	p.removeAll = function () {
		// This may not be neccessary
		while(this.length--) {
			delete(this.tags[this.length]);	// NOTE that the audio playback is already stopped by this point
		}
		this.src = null;
		this.tags.length = 0;
	};

	/**
	 * Get an HTMLAudioElement for immediate playback. This takes it out of the pool.
	 * #method get
	 * @return {HTMLAudioElement} An HTML audio tag.
	 */
	p.get = function () {
		if (this.tags.length == 0) {
			return null;
		}
		this.available = this.tags.length;
		var tag = this.tags.pop();
		if (tag.parentNode == null) {
			document.body.appendChild(tag);
		}
		return tag;
	};

	/**
	 * Put an HTMLAudioElement back in the pool for use.
	 * #method set
	 * @param {HTMLAudioElement} tag HTML audio tag
	 */
	p.set = function (tag) {
		var index = createjs.indexOf(this.tags, tag);
		if (index == -1) {
			this.tags.push(tag);
		}
		this.available = this.tags.length;
	};

	/**
	 * Make sure the src of all other tags is correct after load.
	 * This is needed because PreloadJS appends a basePath to src before loading.
	 * #method checkSrcChange
	 */
	p.checkSrcChange = function () {
		// the last tag always has the latest src after loading
		//var i = this.length-1;	// this breaks in Firefox because it is not correctly removing an event listener
		var i = this.tags.length - 1;
		var newSrc = this.tags[i].src;
		while(i--) {
			this.tags[i].src = newSrc;
		}
	};

	p.toString = function () {
		return "[HTMLAudioPlugin TagPool]";
	}

	createjs.HTMLAudioPlugin.TagPool = TagPool;

}());

/*!	SWFObject v2.2 <http://code.google.com/p/swfobject/> 
	is released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

var swfobject = function() {
	
	var UNDEF = "undefined",
		OBJECT = "object",
		SHOCKWAVE_FLASH = "Shockwave Flash",
		SHOCKWAVE_FLASH_AX = "ShockwaveFlash.ShockwaveFlash",
		FLASH_MIME_TYPE = "application/x-shockwave-flash",
		EXPRESS_INSTALL_ID = "SWFObjectExprInst",
		ON_READY_STATE_CHANGE = "onreadystatechange",
		
		win = window,
		doc = document,
		nav = navigator,
		
		plugin = false,
		domLoadFnArr = [main],
		regObjArr = [],
		objIdArr = [],
		listenersArr = [],
		storedAltContent,
		storedAltContentId,
		storedCallbackFn,
		storedCallbackObj,
		isDomLoaded = false,
		isExpressInstallActive = false,
		dynamicStylesheet,
		dynamicStylesheetMedia,
		autoHideShow = true,
	
	/* Centralized function for browser feature detection
		- User agent string detection is only used when no good alternative is possible
		- Is executed directly for optimal performance
	*/	
	ua = function() {
		var w3cdom = typeof doc.getElementById != UNDEF && typeof doc.getElementsByTagName != UNDEF && typeof doc.createElement != UNDEF,
			u = nav.userAgent.toLowerCase(),
			p = nav.platform.toLowerCase(),
			windows = p ? /win/.test(p) : /win/.test(u),
			mac = p ? /mac/.test(p) : /mac/.test(u),
			webkit = /webkit/.test(u) ? parseFloat(u.replace(/^.*webkit\/(\d+(\.\d+)?).*$/, "$1")) : false, // returns either the webkit version or false if not webkit
			ie = !+"\v1", // feature detection based on Andrea Giammarchi's solution: http://webreflection.blogspot.com/2009/01/32-bytes-to-know-if-your-browser-is-ie.html
			playerVersion = [0,0,0],
			d = null;
		if (typeof nav.plugins != UNDEF && typeof nav.plugins[SHOCKWAVE_FLASH] == OBJECT) {
			d = nav.plugins[SHOCKWAVE_FLASH].description;
			if (d && !(typeof nav.mimeTypes != UNDEF && nav.mimeTypes[FLASH_MIME_TYPE] && !nav.mimeTypes[FLASH_MIME_TYPE].enabledPlugin)) { // navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin indicates whether plug-ins are enabled or disabled in Safari 3+
				plugin = true;
				ie = false; // cascaded feature detection for Internet Explorer
				d = d.replace(/^.*\s+(\S+\s+\S+$)/, "$1");
				playerVersion[0] = parseInt(d.replace(/^(.*)\..*$/, "$1"), 10);
				playerVersion[1] = parseInt(d.replace(/^.*\.(.*)\s.*$/, "$1"), 10);
				playerVersion[2] = /[a-zA-Z]/.test(d) ? parseInt(d.replace(/^.*[a-zA-Z]+(.*)$/, "$1"), 10) : 0;
			}
		}
		else if (typeof win.ActiveXObject != UNDEF) {
			try {
				var a = new ActiveXObject(SHOCKWAVE_FLASH_AX);
				if (a) { // a will return null when ActiveX is disabled
					d = a.GetVariable("$version");
					if (d) {
						ie = true; // cascaded feature detection for Internet Explorer
						d = d.split(" ")[1].split(",");
						playerVersion = [parseInt(d[0], 10), parseInt(d[1], 10), parseInt(d[2], 10)];
					}
				}
			}
			catch(e) {}
		}
		return { w3:w3cdom, pv:playerVersion, wk:webkit, ie:ie, win:windows, mac:mac };
	}(),
	
	/* Cross-browser onDomLoad
		- Will fire an event as soon as the DOM of a web page is loaded
		- Internet Explorer workaround based on Diego Perini's solution: http://javascript.nwbox.com/IEContentLoaded/
		- Regular onload serves as fallback
	*/ 
	onDomLoad = function() {
		if (!ua.w3) { return; }
		if ((typeof doc.readyState != UNDEF && doc.readyState == "complete") || (typeof doc.readyState == UNDEF && (doc.getElementsByTagName("body")[0] || doc.body))) { // function is fired after onload, e.g. when script is inserted dynamically 
			callDomLoadFunctions();
		}
		if (!isDomLoaded) {
			if (typeof doc.addEventListener != UNDEF) {
				doc.addEventListener("DOMContentLoaded", callDomLoadFunctions, false);
			}		
			if (ua.ie && ua.win) {
				doc.attachEvent(ON_READY_STATE_CHANGE, function() {
					if (doc.readyState == "complete") {
						doc.detachEvent(ON_READY_STATE_CHANGE, arguments.callee);
						callDomLoadFunctions();
					}
				});
				if (win == top) { // if not inside an iframe
					(function(){
						if (isDomLoaded) { return; }
						try {
							doc.documentElement.doScroll("left");
						}
						catch(e) {
							setTimeout(arguments.callee, 0);
							return;
						}
						callDomLoadFunctions();
					})();
				}
			}
			if (ua.wk) {
				(function(){
					if (isDomLoaded) { return; }
					if (!/loaded|complete/.test(doc.readyState)) {
						setTimeout(arguments.callee, 0);
						return;
					}
					callDomLoadFunctions();
				})();
			}
			addLoadEvent(callDomLoadFunctions);
		}
	}();
	
	function callDomLoadFunctions() {
		if (isDomLoaded) { return; }
		try { // test if we can really add/remove elements to/from the DOM; we don't want to fire it too early
			var t = doc.getElementsByTagName("body")[0].appendChild(createElement("span"));
			t.parentNode.removeChild(t);
		}
		catch (e) { return; }
		isDomLoaded = true;
		var dl = domLoadFnArr.length;
		for (var i = 0; i < dl; i++) {
			domLoadFnArr[i]();
		}
	}
	
	function addDomLoadEvent(fn) {
		if (isDomLoaded) {
			fn();
		}
		else { 
			domLoadFnArr[domLoadFnArr.length] = fn; // Array.push() is only available in IE5.5+
		}
	}
	
	/* Cross-browser onload
		- Based on James Edwards' solution: http://brothercake.com/site/resources/scripts/onload/
		- Will fire an event as soon as a web page including all of its assets are loaded 
	 */
	function addLoadEvent(fn) {
		if (typeof win.addEventListener != UNDEF) {
			win.addEventListener("load", fn, false);
		}
		else if (typeof doc.addEventListener != UNDEF) {
			doc.addEventListener("load", fn, false);
		}
		else if (typeof win.attachEvent != UNDEF) {
			addListener(win, "onload", fn);
		}
		else if (typeof win.onload == "function") {
			var fnOld = win.onload;
			win.onload = function() {
				fnOld();
				fn();
			};
		}
		else {
			win.onload = fn;
		}
	}
	
	/* Main function
		- Will preferably execute onDomLoad, otherwise onload (as a fallback)
	*/
	function main() { 
		if (plugin) {
			testPlayerVersion();
		}
		else {
			matchVersions();
		}
	}
	
	/* Detect the Flash Player version for non-Internet Explorer browsers
		- Detecting the plug-in version via the object element is more precise than using the plugins collection item's description:
		  a. Both release and build numbers can be detected
		  b. Avoid wrong descriptions by corrupt installers provided by Adobe
		  c. Avoid wrong descriptions by multiple Flash Player entries in the plugin Array, caused by incorrect browser imports
		- Disadvantage of this method is that it depends on the availability of the DOM, while the plugins collection is immediately available
	*/
	function testPlayerVersion() {
		var b = doc.getElementsByTagName("body")[0];
		var o = createElement(OBJECT);
		o.setAttribute("type", FLASH_MIME_TYPE);
		var t = b.appendChild(o);
		if (t) {
			var counter = 0;
			(function(){
				if (typeof t.GetVariable != UNDEF) {
					var d = t.GetVariable("$version");
					if (d) {
						d = d.split(" ")[1].split(",");
						ua.pv = [parseInt(d[0], 10), parseInt(d[1], 10), parseInt(d[2], 10)];
					}
				}
				else if (counter < 10) {
					counter++;
					setTimeout(arguments.callee, 10);
					return;
				}
				b.removeChild(o);
				t = null;
				matchVersions();
			})();
		}
		else {
			matchVersions();
		}
	}
	
	/* Perform Flash Player and SWF version matching; static publishing only
	*/
	function matchVersions() {
		var rl = regObjArr.length;
		if (rl > 0) {
			for (var i = 0; i < rl; i++) { // for each registered object element
				var id = regObjArr[i].id;
				var cb = regObjArr[i].callbackFn;
				var cbObj = {success:false, id:id};
				if (ua.pv[0] > 0) {
					var obj = getElementById(id);
					if (obj) {
						if (hasPlayerVersion(regObjArr[i].swfVersion) && !(ua.wk && ua.wk < 312)) { // Flash Player version >= published SWF version: Houston, we have a match!
							setVisibility(id, true);
							if (cb) {
								cbObj.success = true;
								cbObj.ref = getObjectById(id);
								cb(cbObj);
							}
						}
						else if (regObjArr[i].expressInstall && canExpressInstall()) { // show the Adobe Express Install dialog if set by the web page author and if supported
							var att = {};
							att.data = regObjArr[i].expressInstall;
							att.width = obj.getAttribute("width") || "0";
							att.height = obj.getAttribute("height") || "0";
							if (obj.getAttribute("class")) { att.styleclass = obj.getAttribute("class"); }
							if (obj.getAttribute("align")) { att.align = obj.getAttribute("align"); }
							// parse HTML object param element's name-value pairs
							var par = {};
							var p = obj.getElementsByTagName("param");
							var pl = p.length;
							for (var j = 0; j < pl; j++) {
								if (p[j].getAttribute("name").toLowerCase() != "movie") {
									par[p[j].getAttribute("name")] = p[j].getAttribute("value");
								}
							}
							showExpressInstall(att, par, id, cb);
						}
						else { // Flash Player and SWF version mismatch or an older Webkit engine that ignores the HTML object element's nested param elements: display alternative content instead of SWF
							displayAltContent(obj);
							if (cb) { cb(cbObj); }
						}
					}
				}
				else {	// if no Flash Player is installed or the fp version cannot be detected we let the HTML object element do its job (either show a SWF or alternative content)
					setVisibility(id, true);
					if (cb) {
						var o = getObjectById(id); // test whether there is an HTML object element or not
						if (o && typeof o.SetVariable != UNDEF) { 
							cbObj.success = true;
							cbObj.ref = o;
						}
						cb(cbObj);
					}
				}
			}
		}
	}
	
	function getObjectById(objectIdStr) {
		var r = null;
		var o = getElementById(objectIdStr);
		if (o && o.nodeName == "OBJECT") {
			if (typeof o.SetVariable != UNDEF) {
				r = o;
			}
			else {
				var n = o.getElementsByTagName(OBJECT)[0];
				if (n) {
					r = n;
				}
			}
		}
		return r;
	}
	
	/* Requirements for Adobe Express Install
		- only one instance can be active at a time
		- fp 6.0.65 or higher
		- Win/Mac OS only
		- no Webkit engines older than version 312
	*/
	function canExpressInstall() {
		return !isExpressInstallActive && hasPlayerVersion("6.0.65") && (ua.win || ua.mac) && !(ua.wk && ua.wk < 312);
	}
	
	/* Show the Adobe Express Install dialog
		- Reference: http://www.adobe.com/cfusion/knowledgebase/index.cfm?id=6a253b75
	*/
	function showExpressInstall(att, par, replaceElemIdStr, callbackFn) {
		isExpressInstallActive = true;
		storedCallbackFn = callbackFn || null;
		storedCallbackObj = {success:false, id:replaceElemIdStr};
		var obj = getElementById(replaceElemIdStr);
		if (obj) {
			if (obj.nodeName == "OBJECT") { // static publishing
				storedAltContent = abstractAltContent(obj);
				storedAltContentId = null;
			}
			else { // dynamic publishing
				storedAltContent = obj;
				storedAltContentId = replaceElemIdStr;
			}
			att.id = EXPRESS_INSTALL_ID;
			if (typeof att.width == UNDEF || (!/%$/.test(att.width) && parseInt(att.width, 10) < 310)) { att.width = "310"; }
			if (typeof att.height == UNDEF || (!/%$/.test(att.height) && parseInt(att.height, 10) < 137)) { att.height = "137"; }
			doc.title = doc.title.slice(0, 47) + " - Flash Player Installation";
			var pt = ua.ie && ua.win ? "ActiveX" : "PlugIn",
				fv = "MMredirectURL=" + encodeURI(window.location).toString().replace(/&/g,"%26") + "&MMplayerType=" + pt + "&MMdoctitle=" + doc.title;
			if (typeof par.flashvars != UNDEF) {
				par.flashvars += "&" + fv;
			}
			else {
				par.flashvars = fv;
			}
			// IE only: when a SWF is loading (AND: not available in cache) wait for the readyState of the object element to become 4 before removing it,
			// because you cannot properly cancel a loading SWF file without breaking browser load references, also obj.onreadystatechange doesn't work
			if (ua.ie && ua.win && obj.readyState != 4) {
				var newObj = createElement("div");
				replaceElemIdStr += "SWFObjectNew";
				newObj.setAttribute("id", replaceElemIdStr);
				obj.parentNode.insertBefore(newObj, obj); // insert placeholder div that will be replaced by the object element that loads expressinstall.swf
				obj.style.display = "none";
				(function(){
					if (obj.readyState == 4) {
						obj.parentNode.removeChild(obj);
					}
					else {
						setTimeout(arguments.callee, 10);
					}
				})();
			}
			createSWF(att, par, replaceElemIdStr);
		}
	}
	
	/* Functions to abstract and display alternative content
	*/
	function displayAltContent(obj) {
		if (ua.ie && ua.win && obj.readyState != 4) {
			// IE only: when a SWF is loading (AND: not available in cache) wait for the readyState of the object element to become 4 before removing it,
			// because you cannot properly cancel a loading SWF file without breaking browser load references, also obj.onreadystatechange doesn't work
			var el = createElement("div");
			obj.parentNode.insertBefore(el, obj); // insert placeholder div that will be replaced by the alternative content
			el.parentNode.replaceChild(abstractAltContent(obj), el);
			obj.style.display = "none";
			(function(){
				if (obj.readyState == 4) {
					obj.parentNode.removeChild(obj);
				}
				else {
					setTimeout(arguments.callee, 10);
				}
			})();
		}
		else {
			obj.parentNode.replaceChild(abstractAltContent(obj), obj);
		}
	} 

	function abstractAltContent(obj) {
		var ac = createElement("div");
		if (ua.win && ua.ie) {
			ac.innerHTML = obj.innerHTML;
		}
		else {
			var nestedObj = obj.getElementsByTagName(OBJECT)[0];
			if (nestedObj) {
				var c = nestedObj.childNodes;
				if (c) {
					var cl = c.length;
					for (var i = 0; i < cl; i++) {
						if (!(c[i].nodeType == 1 && c[i].nodeName == "PARAM") && !(c[i].nodeType == 8)) {
							ac.appendChild(c[i].cloneNode(true));
						}
					}
				}
			}
		}
		return ac;
	}
	
	/* Cross-browser dynamic SWF creation
	*/
	function createSWF(attObj, parObj, id) {
		var r, el = getElementById(id);
		if (ua.wk && ua.wk < 312) { return r; }
		if (el) {
			if (typeof attObj.id == UNDEF) { // if no 'id' is defined for the object element, it will inherit the 'id' from the alternative content
				attObj.id = id;
			}
			if (ua.ie && ua.win) { // Internet Explorer + the HTML object element + W3C DOM methods do not combine: fall back to outerHTML
				var att = "";
				for (var i in attObj) {
					if (attObj[i] != Object.prototype[i]) { // filter out prototype additions from other potential libraries
						if (i.toLowerCase() == "data") {
							parObj.movie = attObj[i];
						}
						else if (i.toLowerCase() == "styleclass") { // 'class' is an ECMA4 reserved keyword
							att += ' class="' + attObj[i] + '"';
						}
						else if (i.toLowerCase() != "classid") {
							att += ' ' + i + '="' + attObj[i] + '"';
						}
					}
				}
				var par = "";
				for (var j in parObj) {
					if (parObj[j] != Object.prototype[j]) { // filter out prototype additions from other potential libraries
						par += '<param name="' + j + '" value="' + parObj[j] + '" />';
					}
				}
				el.outerHTML = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"' + att + '>' + par + '</object>';
				objIdArr[objIdArr.length] = attObj.id; // stored to fix object 'leaks' on unload (dynamic publishing only)
				r = getElementById(attObj.id);	
			}
			else { // well-behaving browsers
				var o = createElement(OBJECT);
				o.setAttribute("type", FLASH_MIME_TYPE);
				for (var m in attObj) {
					if (attObj[m] != Object.prototype[m]) { // filter out prototype additions from other potential libraries
						if (m.toLowerCase() == "styleclass") { // 'class' is an ECMA4 reserved keyword
							o.setAttribute("class", attObj[m]);
						}
						else if (m.toLowerCase() != "classid") { // filter out IE specific attribute
							o.setAttribute(m, attObj[m]);
						}
					}
				}
				for (var n in parObj) {
					if (parObj[n] != Object.prototype[n] && n.toLowerCase() != "movie") { // filter out prototype additions from other potential libraries and IE specific param element
						createObjParam(o, n, parObj[n]);
					}
				}
				el.parentNode.replaceChild(o, el);
				r = o;
			}
		}
		return r;
	}
	
	function createObjParam(el, pName, pValue) {
		var p = createElement("param");
		p.setAttribute("name", pName);	
		p.setAttribute("value", pValue);
		el.appendChild(p);
	}
	
	/* Cross-browser SWF removal
		- Especially needed to safely and completely remove a SWF in Internet Explorer
	*/
	function removeSWF(id) {
		var obj = getElementById(id);
		if (obj && obj.nodeName == "OBJECT") {
			if (ua.ie && ua.win) {
				obj.style.display = "none";
				(function(){
					if (obj.readyState == 4) {
						removeObjectInIE(id);
					}
					else {
						setTimeout(arguments.callee, 10);
					}
				})();
			}
			else {
				obj.parentNode.removeChild(obj);
			}
		}
	}
	
	function removeObjectInIE(id) {
		var obj = getElementById(id);
		if (obj) {
			for (var i in obj) {
				if (typeof obj[i] == "function") {
					obj[i] = null;
				}
			}
			obj.parentNode.removeChild(obj);
		}
	}
	
	/* Functions to optimize JavaScript compression
	*/
	function getElementById(id) {
		var el = null;
		try {
			el = doc.getElementById(id);
		}
		catch (e) {}
		return el;
	}
	
	function createElement(el) {
		return doc.createElement(el);
	}
	
	/* Updated attachEvent function for Internet Explorer
		- Stores attachEvent information in an Array, so on unload the detachEvent functions can be called to avoid memory leaks
	*/	
	function addListener(target, eventType, fn) {
		target.attachEvent(eventType, fn);
		listenersArr[listenersArr.length] = [target, eventType, fn];
	}
	
	/* Flash Player and SWF content version matching
	*/
	function hasPlayerVersion(rv) {
		var pv = ua.pv, v = rv.split(".");
		v[0] = parseInt(v[0], 10);
		v[1] = parseInt(v[1], 10) || 0; // supports short notation, e.g. "9" instead of "9.0.0"
		v[2] = parseInt(v[2], 10) || 0;
		return (pv[0] > v[0] || (pv[0] == v[0] && pv[1] > v[1]) || (pv[0] == v[0] && pv[1] == v[1] && pv[2] >= v[2])) ? true : false;
	}
	
	/* Cross-browser dynamic CSS creation
		- Based on Bobby van der Sluis' solution: http://www.bobbyvandersluis.com/articles/dynamicCSS.php
	*/	
	function createCSS(sel, decl, media, newStyle) {
		if (ua.ie && ua.mac) { return; }
		var h = doc.getElementsByTagName("head")[0];
		if (!h) { return; } // to also support badly authored HTML pages that lack a head element
		var m = (media && typeof media == "string") ? media : "screen";
		if (newStyle) {
			dynamicStylesheet = null;
			dynamicStylesheetMedia = null;
		}
		if (!dynamicStylesheet || dynamicStylesheetMedia != m) { 
			// create dynamic stylesheet + get a global reference to it
			var s = createElement("style");
			s.setAttribute("type", "text/css");
			s.setAttribute("media", m);
			dynamicStylesheet = h.appendChild(s);
			if (ua.ie && ua.win && typeof doc.styleSheets != UNDEF && doc.styleSheets.length > 0) {
				dynamicStylesheet = doc.styleSheets[doc.styleSheets.length - 1];
			}
			dynamicStylesheetMedia = m;
		}
		// add style rule
		if (ua.ie && ua.win) {
			if (dynamicStylesheet && typeof dynamicStylesheet.addRule == OBJECT) {
				dynamicStylesheet.addRule(sel, decl);
			}
		}
		else {
			if (dynamicStylesheet && typeof doc.createTextNode != UNDEF) {
				dynamicStylesheet.appendChild(doc.createTextNode(sel + " {" + decl + "}"));
			}
		}
	}
	
	function setVisibility(id, isVisible) {
		if (!autoHideShow) { return; }
		var v = isVisible ? "visible" : "hidden";
		if (isDomLoaded && getElementById(id)) {
			getElementById(id).style.visibility = v;
		}
		else {
			createCSS("#" + id, "visibility:" + v);
		}
	}

	/* Filter to avoid XSS attacks
	*/
	function urlEncodeIfNecessary(s) {
		var regex = /[\\\"<>\.;]/;
		var hasBadChars = regex.exec(s) != null;
		return hasBadChars && typeof encodeURIComponent != UNDEF ? encodeURIComponent(s) : s;
	}
	
	/* Release memory to avoid memory leaks caused by closures, fix hanging audio/video threads and force open sockets/NetConnections to disconnect (Internet Explorer only)
	*/
	var cleanup = function() {
		if (ua.ie && ua.win) {
			window.attachEvent("onunload", function() {
				// remove listeners to avoid memory leaks
				var ll = listenersArr.length;
				for (var i = 0; i < ll; i++) {
					listenersArr[i][0].detachEvent(listenersArr[i][1], listenersArr[i][2]);
				}
				// cleanup dynamically embedded objects to fix audio/video threads and force open sockets and NetConnections to disconnect
				var il = objIdArr.length;
				for (var j = 0; j < il; j++) {
					removeSWF(objIdArr[j]);
				}
				// cleanup library's main closures to avoid memory leaks
				for (var k in ua) {
					ua[k] = null;
				}
				ua = null;
				for (var l in swfobject) {
					swfobject[l] = null;
				}
				swfobject = null;
			});
		}
	}();
	
	return {
		/* Public API
			- Reference: http://code.google.com/p/swfobject/wiki/documentation
		*/ 
		registerObject: function(objectIdStr, swfVersionStr, xiSwfUrlStr, callbackFn) {
			if (ua.w3 && objectIdStr && swfVersionStr) {
				var regObj = {};
				regObj.id = objectIdStr;
				regObj.swfVersion = swfVersionStr;
				regObj.expressInstall = xiSwfUrlStr;
				regObj.callbackFn = callbackFn;
				regObjArr[regObjArr.length] = regObj;
				setVisibility(objectIdStr, false);
			}
			else if (callbackFn) {
				callbackFn({success:false, id:objectIdStr});
			}
		},
		
		getObjectById: function(objectIdStr) {
			if (ua.w3) {
				return getObjectById(objectIdStr);
			}
		},
		
		embedSWF: function(swfUrlStr, replaceElemIdStr, widthStr, heightStr, swfVersionStr, xiSwfUrlStr, flashvarsObj, parObj, attObj, callbackFn) {
			var callbackObj = {success:false, id:replaceElemIdStr};
			if (ua.w3 && !(ua.wk && ua.wk < 312) && swfUrlStr && replaceElemIdStr && widthStr && heightStr && swfVersionStr) {
				setVisibility(replaceElemIdStr, false);
				addDomLoadEvent(function() {
					widthStr += ""; // auto-convert to string
					heightStr += "";
					var att = {};
					if (attObj && typeof attObj === OBJECT) {
						for (var i in attObj) { // copy object to avoid the use of references, because web authors often reuse attObj for multiple SWFs
							att[i] = attObj[i];
						}
					}
					att.data = swfUrlStr;
					att.width = widthStr;
					att.height = heightStr;
					var par = {}; 
					if (parObj && typeof parObj === OBJECT) {
						for (var j in parObj) { // copy object to avoid the use of references, because web authors often reuse parObj for multiple SWFs
							par[j] = parObj[j];
						}
					}
					if (flashvarsObj && typeof flashvarsObj === OBJECT) {
						for (var k in flashvarsObj) { // copy object to avoid the use of references, because web authors often reuse flashvarsObj for multiple SWFs
							if (typeof par.flashvars != UNDEF) {
								par.flashvars += "&" + k + "=" + flashvarsObj[k];
							}
							else {
								par.flashvars = k + "=" + flashvarsObj[k];
							}
						}
					}
					if (hasPlayerVersion(swfVersionStr)) { // create SWF
						var obj = createSWF(att, par, replaceElemIdStr);
						if (att.id == replaceElemIdStr) {
							setVisibility(replaceElemIdStr, true);
						}
						callbackObj.success = true;
						callbackObj.ref = obj;
					}
					else if (xiSwfUrlStr && canExpressInstall()) { // show Adobe Express Install
						att.data = xiSwfUrlStr;
						showExpressInstall(att, par, replaceElemIdStr, callbackFn);
						return;
					}
					else { // show alternative content
						setVisibility(replaceElemIdStr, true);
					}
					if (callbackFn) { callbackFn(callbackObj); }
				});
			}
			else if (callbackFn) { callbackFn(callbackObj);	}
		},
		
		switchOffAutoHideShow: function() {
			autoHideShow = false;
		},
		
		ua: ua,
		
		getFlashPlayerVersion: function() {
			return { major:ua.pv[0], minor:ua.pv[1], release:ua.pv[2] };
		},
		
		hasFlashPlayerVersion: hasPlayerVersion,
		
		createSWF: function(attObj, parObj, replaceElemIdStr) {
			if (ua.w3) {
				return createSWF(attObj, parObj, replaceElemIdStr);
			}
			else {
				return undefined;
			}
		},
		
		showExpressInstall: function(att, par, replaceElemIdStr, callbackFn) {
			if (ua.w3 && canExpressInstall()) {
				showExpressInstall(att, par, replaceElemIdStr, callbackFn);
			}
		},
		
		removeSWF: function(objElemIdStr) {
			if (ua.w3) {
				removeSWF(objElemIdStr);
			}
		},
		
		createCSS: function(selStr, declStr, mediaStr, newStyleBoolean) {
			if (ua.w3) {
				createCSS(selStr, declStr, mediaStr, newStyleBoolean);
			}
		},
		
		addDomLoadEvent: addDomLoadEvent,
		
		addLoadEvent: addLoadEvent,
		
		getQueryParamValue: function(param) {
			var q = doc.location.search || doc.location.hash;
			if (q) {
				if (/\?/.test(q)) { q = q.split("?")[1]; } // strip question mark
				if (param == null) {
					return urlEncodeIfNecessary(q);
				}
				var pairs = q.split("&");
				for (var i = 0; i < pairs.length; i++) {
					if (pairs[i].substring(0, pairs[i].indexOf("=")) == param) {
						return urlEncodeIfNecessary(pairs[i].substring((pairs[i].indexOf("=") + 1)));
					}
				}
			}
			return "";
		},
		
		// For internal usage only
		expressInstallCallback: function() {
			if (isExpressInstallActive) {
				var obj = getElementById(EXPRESS_INSTALL_ID);
				if (obj && storedAltContent) {
					obj.parentNode.replaceChild(storedAltContent, obj);
					if (storedAltContentId) {
						setVisibility(storedAltContentId, true);
						if (ua.ie && ua.win) { storedAltContent.style.display = "block"; }
					}
					if (storedCallbackFn) { storedCallbackFn(storedCallbackObj); }
				}
				isExpressInstallActive = false;
			} 
		}
	};
}();



// namespace:
this.createjs = this.createjs || {};

(function () {

	"use strict";

	/**
	 * Play sounds using a Flash instance. This plugin is not used by default, and must be registered manually in
	 * {{#crossLink "Sound"}}{{/crossLink}} using the {{#crossLink "Sound/registerPlugins"}}{{/crossLink}} method. This
	 * plugin is recommended to be included if sound support is required in older browsers such as IE8.
	 *
	 * This plugin requires FlashAudioPlugin.swf and swfObject.js (which is compiled
	 * into the minified FlashPlugin-X.X.X.min.js file. You must ensure that {{#crossLink "FlashPlugin/BASE_PATH:property"}}{{/crossLink}}
	 * is set when using this plugin, so that the script can find the swf.
	 *
	 * <h4>Example</h4>
	 *      createjs.FlashPlugin.BASE_PATH = "../src/SoundJS/";
	 *      createjs.Sound.registerPlugins([createjs.WebAudioPlugin, createjs.HTMLAudioPlugin, createjs.FlashPlugin]);
	 *      // Adds FlashPlugin as a fallback if WebAudio and HTMLAudio do not work.
	 *
	 * Note that the SWF is embedded into a container DIV (with an id and classname of "SoundJSFlashContainer"), and
	 * will have an id of "flashAudioContainer". The container DIV is positioned 1 pixel off-screen to the left to avoid
	 * showing the 1x1 pixel white square.
	 *
	 * <h4>Known Browser and OS issues for HTML Audio</h4>
	 * <b>All browsers</b><br />
	 * <ul><li> There can be a delay in flash player starting playback of audio.  This has been most noticeable in Firefox.
	 * Unfortunely this is an issue with the flash player and therefore cannot be addressed by SoundJS.</li></ul>
	 *
	 * @class FlashPlugin
	 * @constructor
	 */
	function FlashPlugin() {
		this.init();
	}

	var s = FlashPlugin;

	/**
	 * The capabilities of the plugin. This is generated via the {{#crossLink "WebAudioPlugin/generateCapabilities"}}{{/crossLink}}
	 * method. Please see the Sound {{#crossLink "Sound/getCapabilities"}}{{/crossLink}} method for a list of available
	 * capabilities.
	 * @property capabilities
	 * @type {Object}
	 * @static
	 */
	s.capabilities = null;

	/**
	 * The path relative to the HTML page that the FlashAudioPlugin.swf resides. Note if this is not correct, this
	 * plugin will not work.
	 * @property BASE_PATH
	 * @type {String}
	 * @default src/SoundJS
	 * @static
	 */
	s.BASE_PATH = "src/SoundJS/";

	/**
	 * Determine if the plugin can be used in the current browser/OS.
	 * @method isSupported
	 * @return {Boolean} If the plugin can be initialized.
	 * @static
	 */
	s.isSupported = function () {
		if (createjs.Sound.BrowserDetect.isIOS) {
			return false;
		}
		s.generateCapabilities();
		if (swfobject == null) {
			return false;
		}
		return swfobject.hasFlashPlayerVersion("9.0.0");
		//TODO: Internal detection instead of SWFObject?
	};

	/**
	 * Determine the capabilities of the plugin. Used internally. Please see the Sound API {{#crossLink "Sound/getCapabilities"}}{{/crossLink}}
	 * method for an overview of plugin capabilities.
	 * @method generateCapabiities
	 * @static
	 * @protected
	 */
	s.generateCapabilities = function () {
		if (s.capabilities != null) {
			return;
		}
		// TODO change to support file types using SUPPORTED_EXTENSIONS like other plugins if possible
		// see http://helpx.adobe.com/flash/kb/supported-codecs-flash-player.html
		var c = s.capabilities = {
			panning:true,
			volume:true,
			tracks:-1,
			mp3:true,
			ogg:false,
			mpeg:true,
			wav:true,
			// our current implementation cannot support mp4 http://forums.adobe.com/thread/825408
			m4a:false,
			mp4:false,
			aiff:false, // not listed in player but is Supported by Flash so this may be true
			wma:false,
			mid:false
		};
	};


	var p = s.prototype = {

		/**
		 * An object hash indexed by ID that indicates if each source is loaded or loading.
		 * @property audioSources
		 * @type {Object}
		 * @protected
		 */
		audioSources:null,

		/**
		 * The internal volume value of the plugin.
		 * @property volume
		 * @type {Number}
		 * @default 1
		 * @protected
		 */
		volume:1,

		/**
		 * The id name of the DIV that gets created for Flash content.
		 * @property CONTAINER_ID
		 * @type {String}
		 * @default flashAudioContainer
		 * @protected
		 */
		CONTAINER_ID:"flashAudioContainer",

		/**
		 * The id name of the DIV wrapper that contains the Flash content.
		 * @property WRAPPER_ID
		 * @type {String}
		 * @default SoundJSFlashContainer
		 * @protected
		 * @since 0.4.1
		 */
		WRAPPER_ID:"SoundJSFlashContainer",

		// doc'd above
		capabilities:null,

// FlashPlugin Specifics
		/**
		 * A reference to the DIV container that gets created to hold the Flash instance.
		 * @property container
		 * @type {HTMLDivElement}
		 * @protected
		 */
		container:null,

		/**
		 * A reference to the Flash instance that gets created.
		 * @property flash
		 * @type {Object | Embed}
		 * @protected
		 */
		flash:null,

		/**
		 * Determines if the Flash object has been created and initialized. This is required to make <code>ExternalInterface</code>
		 * calls from JavaScript to Flash.
		 * @property flashReady
		 * @type {Boolean}
		 * @default false
		 */
		flashReady:false,

		/**
		 * A hash of SoundInstances indexed by the related ID in Flash. This lookup is required to connect sounds in
		 * JavaScript to their respective instances in Flash.
		 * @property flashInstances
		 * @type {Object}
		 * @protected
		 */
		flashInstances:null,

		/**
		 * A hash of Sound Preload instances indexed by the related ID in Flash. This lookup is required to connect
		 * a preloading sound in Flash with its respective instance in JavaScript.
		 * @property flashPreloadInstances
		 * @type {Object}
		 * @protected
		 */
		flashPreloadInstances:null,

		/**
		 * A hash of Sound Preload instances indexed by the src. This lookup is required to load sounds if internal
		 * preloading is tried when flash is not ready.
		 * @property preloadInstances
		 * @type {Object}
		 * @protected
		 * @since 0.4.0
		 */
		preloadInstances:null,

		/**
		 * An array of Sound Preload instances that are waiting to preload. Once Flash is initialized, the queued
		 * instances are preloaded.
		 * @property queuedInstances
		 * @type {Object}
		 * @protected
		 */
		queuedInstances:null,

		/**
		 * A developer flag to output all flash events to the console (if it exists).  Used for debugging.
		 *
		 *      createjs.Sound.activePlugin.showOutput = true;
		 *
		 * @property showOutput
		 * @type {Boolean}
		 * @default false
		 */
		showOutput:false,

		/**
		 * An initialization function run by the constructor
		 * @method init
		 * @protected
		 */
		init:function () {
			this.capabilities = s.capabilities;
			this.audioSources = {};

			this.flashInstances = {};
			this.flashPreloadInstances = {};
			this.preloadInstances = {};
			this.queuedInstances = [];

			// Create DIV
			var w = this.wrapper = document.createElement("div");
			w.id = this.WRAPPER_ID;
			w.style.position = "absolute";
			w.style.marginLeft = "-1px";
			w.className = this.WRAPPER_ID;
			document.body.appendChild(w);

			// Create Placeholder
			var c = this.container = document.createElement("div");
			c.id = this.CONTAINER_ID;
			c.appendChild(document.createTextNode("SoundJS Flash Container"));
			w.appendChild(c);

			// Embed SWF
			var val = swfobject.embedSWF(s.BASE_PATH + "FlashAudioPlugin.swf", this.CONTAINER_ID, "1", "1",
					"9.0.0", null, null, null, null,
					createjs.proxy(this.handleSWFReady, this)
			);

			//TODO: Internal detection instead of swfobject
		},

		/**
		 * The SWF used for sound preloading and playback has been initialized.
		 * @method handleSWFReady
		 * @param {Object} event Contains a reference to the swf.
		 * @protected
		 */
		handleSWFReady:function (event) {
			this.flash = event.ref;
			this.loadTimeout = setTimeout(createjs.proxy(this.handleTimeout, this), 2000);  // OJR note this function doesn't do anything right now
		},

		/**
		 * The Flash application that handles preloading and playback is ready. We wait for a callback from Flash to
		 * ensure that everything is in place before playback begins.
		 * @method handleFlashReady
		 * @protected
		 */
		handleFlashReady:function () {
			this.flashReady = true;

			// Anything that needed to be preloaded, can now do so.
			for (var i = 0, l = this.queuedInstances.length; i < l; i++) {
				this.flash.register(this.queuedInstances[i]);  // NOTE this flash function currently does nothing
			}
			this.queuedInstances.length = 0;

			// Associate flash instance with any preloadInstance that already exists.
			for (var n in this.flashPreloadInstances) {
				this.flashPreloadInstances[n].initialize(this.flash);
			}

			// load sounds that tried to preload before flash was ready
			for (var n in this.preloadInstances) {
				this.preloadInstances[n].initialize(this.flash);
			}
			this.preloadInstances = {};

			// Associate flash instance with any sound instance that has already been played.
			for (var n in this.flashInstances) {
				this.flashInstances[n].initialize(this.flash);
			}
		},

		/**
		 * The callback when Flash does not initialize. This usually means the SWF is missing or incorrectly pathed.
		 * @method handleTimeout
		 * @protected
		 */
		handleTimeout:function () {
			//LM: Surface to user? AUDIO_FLASH_FAILED
		},

		/**
		 * Pre-register a sound instance when preloading/setup. Note that the FlashPlugin will return a Loader
		 * instance for preloading since Flash can not access the browser cache consistently.
		 * @method register
		 * @param {String} src The source of the audio
		 * @param {Number} instances The number of concurrently playing instances to allow for the channel at any time.
		 * @return {Object} A result object, containing a tag for preloading purposes.
		 */
		register:function (src, instances) {
			//Note that currently, registering with the flash instance does nothing.
			this.audioSources[src] = true;  // NOTE this does not mean preloading has started
			if (!this.flashReady) {
				this.queuedInstances.push(src);
			} else {
				this.flash.register(src);  // NOTE this flash function currently does nothing  // OJR remove this entire thing, as it does nothing?
			}
			var tag = new createjs.FlashPlugin.Loader(src, this, this.flash);
			return {
				tag:tag
			};
		},


		/**
		 * Remove a sound added using {{#crossLink "FlashPlugin/register"}}{{/crossLink}}. Note this does not cancel a
		 * preload.
		 * @method removeSound
		 * @param {String} src The sound URI to unload.
		 * @since 0.4.1
		 */
		removeSound:function (src) {
			delete(this.audioSources[src]);
			var i = createjs.indexOf(this.queuedInstances, src);
			if(i != -1) {
				this.queuedInstances.splice(i,1);
			}
			// NOTE sound cannot be removed from a swf
		},

		/**
		 * Remove all sounds added using {{#crossLink "FlashPlugin/register"}}{{/crossLink}}. Note this does not cancel a preload.
		 * @method removeAllSounds
		 * @param {String} src The sound URI to unload.
		 * @since 0.4.1
		 */
		removeAllSounds:function () {
			this.audioSources = {};	// this drops all references, in theory freeing them for garbage collection
			this.queuedInstances.length = 0;

			// OJR these may not be necessary, but are included for cleanup clarity.
			this.flashInstances = {};
			this.flashPreloadInstances = {};
			this.preloadInstances = {};
			// NOTE sound cannot be removed from a swf
		},

		/**
		 * Create a sound instance. If the sound has not been preloaded, it is internally preloaded here.
		 * @method create
		 * @param {String} src The sound source to use.
		 * @return {SoundInstance} A sound instance for playback and control.
		 */
		create:function (src) {
			if (!this.isPreloadStarted(src)) {
				this.preload(src);
			}

			try {
				var instance = new createjs.FlashPlugin.SoundInstance(src, this, this.flash, this.audioSources[src]);
				return instance;
			} catch (err) {
				//console.log("Error: Please ensure you have permission to play audio from this location.", err);
			}
			return null;
		},

		/**
		 * Checks if preloading has started for a specific source. If the source is found, we can assume it is loading,
		 * or has already finished loading.
		 * @method isPreloadStarted
		 * @param {String} src The sound URI to check.
		 * @return {Boolean}
		 */
		isPreloadStarted:function (src) {
			return (this.audioSources[src] != null);
		},

		/**
		 * Preload a sound instance. This plugin uses Flash to preload and play all sounds.
		 * @method preload
		 * @param {String} src The path to the Sound
		 * @param {Object} instance Not used in this plugin.
		 * @param {String} basePath A file path to prepend to the src.
		 */
		preload:function (src, instance, basePath) {
			this.audioSources[src] = true;  // NOTE this does not mean preloading has started, just that it will
			var loader = new createjs.FlashPlugin.Loader(src, this, this.flash);
			if (basePath != null) {loader.src = basePath + src;}
			loader.load();  // this will handle if flash is not ready
		},

		/**
		 * Registers loaded source files to handle src being changed before loading.
		 * This occurs when there is a basePath added (by PreloadJS or internal Preloading.
		 * @param loadSrc
		 * @param src
		 * @protected
		 */
		registerLoadedSrc: function(loadSrc, src) {
			this.audioSources[src] = loadSrc;
		},

		/**
		 * Set the master volume of the plugin, which affects all SoundInstances.
		 * @method setVolume
		 * @param {Number} value The volume to set, between 0 and 1.
		 * @return {Boolean} If the plugin processes the setVolume call (true). The Sound class will affect all the
		 * instances manually otherwise.
		 * @since 0.4.0
		 */
		setVolume:function (value) {
			this.volume = value;
			return this.updateVolume();
		},

		/**
		 * Internal function used to set the gain value for master audio.  Should not be called externally.
		 * @method updateVolume
		 * @return {Boolean}
		 * @protected
		 * @since 0.4.0
		 */
		updateVolume:function () {
			var newVolume = createjs.Sound.masterMute ? 0 : this.volume;
			return this.flash.setMasterVolume(newVolume);
		},

		/**
		 * Get the master volume of the plugin, which affects all SoundInstances.
		 * @method getVolume
		 * @return The volume level, between 0 and 1.
		 * @since 0.4.0
		 */
		getVolume:function () {
			return this.volume;
		},

		/**
		 * Mute all sounds via the plugin.
		 * @method setMute
		 * @param {Boolean} value If all sound should be muted or not. Note that plugin-level muting just looks up
		 * the mute value of Sound {{#crossLink "Sound/getMute"}}{{/crossLink}}, so this property is not used here.
		 * @return {Boolean} If the mute call succeeds.
		 * @since 0.4.0
		 */
		setMute:function (isMuted) {
			return this.updateVolume();
		},

// Flash Communication
		/**
		 * Used to couple a Flash loader instance with a <code>Loader</code> instance
		 * @method registerPreloadInstance
		 * @param {String} flashId Used to identify the Loader.
		 * @param {Loader} instance The actual instance.
		 */
		registerPreloadInstance:function (flashId, instance) {
			this.flashPreloadInstances[flashId] = instance;
		},

		/**
		 * Used to decouple a <code>Loader</code> instance from Flash.
		 * @method unregisterPreloadInstance
		 * @param {String} flashId Used to identify the Loader.
		 */
		unregisterPreloadInstance:function (flashId) {
			delete this.flashPreloadInstances[flashId];
		},

		/**
		 * Used to couple a Flash sound instance with a {{#crossLink "SoundInstance"}}{{/crossLink}}.
		 * @method registerSoundInstance
		 * @param {String} flashId Used to identify the SoundInstance.
		 * @param {Loader} instance The actual instance.
		 */
		registerSoundInstance:function (flashId, instance) {
			this.flashInstances[flashId] = instance;
		},

		/**
		 * Used to decouple a {{#crossLink "SoundInstance"}}{{/crossLink}} from Flash.
		 * instance.
		 * @method unregisterSoundInstance
		 * @param {String} flashId Used to identify the SoundInstance.
		 * @param {Loader} instance The actual instance.
		 */
		unregisterSoundInstance:function (flashId) {
			delete this.flashInstances[flashId];
		},

		/**
		 * Used to output traces from Flash to the console, if {{#crossLink "FlashPlugin/showOutput"}}{{/crossLink}} is
		 * <code>true</code>.
		 * @method flashLog
		 * @param {String} data The information to be output.
		 */
		flashLog:function (data) {
			try {
				this.showOutput && console.log(data);
			} catch (error) {
			}
		},

		/**
		 * Handles events from Flash, and routes communication to a {{#crossLink "SoundInstance"}}{{/crossLink}} via
		 * the Flash ID. The method and arguments from Flash are run directly on the sound instance.
		 * @method handleSoundEvent
		 * @param {String} flashId Used to identify the SoundInstance.
		 * @param {String} method Indicates the method to run.
		 */
		handleSoundEvent:function (flashId, method) {
			var instance = this.flashInstances[flashId];
			if (instance == null) {
				return;
			}
			var args = [];
			for (var i = 2, l = arguments.length; i < l; i++) {
				args.push(arguments[i]);
			}
			try {
				if (args.length == 0) {
					instance[method]();
				} else {
					instance[method].apply(instance, args);
				}
			} catch (error) {
			}
		},

		/**
		 * Handles events from Flash and routes communication to a <code>Loader</code> via the Flash ID. The method
		 * and arguments from Flash are run directly on the sound loader.
		 * @method handlePreloadEvent
		 * @param {String} flashId Used to identify the loader instance.
		 * @param {String} method Indicates the method to run.
		 */
		handlePreloadEvent:function (flashId, method) {
			var instance = this.flashPreloadInstances[flashId];
			if (instance == null) {
				return;
			}
			var args = [];
			for (var i = 2, l = arguments.length; i < l; i++) {
				args.push(arguments[i]);
			}
			try {
				if (args.length == 0) {
					instance[method]();
				} else {
					instance[method].apply(instance, args);
				}
			} catch (error) {
			}
		},

		/**
		 * Handles events from Flash intended for the FlashPlugin class. Currently only a "ready" event is processed.
		 * @method handleEvent
		 * @param {String} method Indicates the method to run.
		 */
		handleEvent:function (method) {
			//Sound.log("Handle Event", method);
			switch (method) {
				case "ready":
					clearTimeout(this.loadTimeout);
					this.handleFlashReady();
					break;
			}
		},

		/**
		 * Handles error events from Flash. Note this function currently does not process any events.
		 * @method handleErrorEvent
		 * @param {String} error Indicates the error.
		 */
		handleErrorEvent:function (error) {
		},

		toString:function () {
			return "[FlashPlugin]";
		}

	}

	createjs.FlashPlugin = FlashPlugin;

}());


(function () {

	"use strict";

	// NOTE documentation for this class can be found online or in WebAudioPlugin.SoundInstance
	// NOTE audio control is shuttled to a flash player instance via the flash reference.
	function SoundInstance(src, owner, flash, flashSrc) {
		this.init(src, owner, flash, flashSrc);
	}

	var p = SoundInstance.prototype;

	p.src = null;
	p.flashSrc = null;	// because loaded src in flash can be different due to basePath appending
	p.uniqueId = -1;
	p.owner = null;
	p.capabilities = null;
	p.flash = null;
	p.flashId = null; // To communicate with Flash
	p.loop = 0;
	p._volume =  1;
	p._pan =  0;
	p.offset = 0; // used for setPosition on a stopped instance
	p.duration = 0;
	p.delayTimeoutId = null;
	p.muted = false;
	p.paused = false;

	// IE8 has Object.defineProperty, but only for DOM objects, so check if fails to suppress errors
	try {
		Object.defineProperty(p, "volume", {
			get: function() {
				return this._volume;
			},
			set: function(value) {
				if (Number(value) == null) {return;}
				value = Math.max(0, Math.min(1, value));
				this._volume = value;
				return this.flash.setVolume(this.flashId, value)
			}
		});
		Object.defineProperty(p, "pan", {
			get: function() {
				return this._pan;
			},
			set: function(value) {
				if (Number(value)==null) {return;}
				value = Math.max(-1, Math.min(1, value));	// force pan to stay in the -1 to 1 range
				this._pan = value;
				return this.flash.setPan(this.flashId, value);
			}
		});
	} catch (e) {
		// dispatch message or error?
	};

// mix-ins:
	// EventDispatcher methods:
	p.addEventListener = null;
	p.removeEventListener = null;
	p.removeAllEventListeners = null;
	p.dispatchEvent = null;
	p.hasEventListener = null;
	p._listeners = null;

// Constructor
	p.init = function (src, owner, flash, flashSrc) {
		this.src = src;
		this.flashSrc = flashSrc;
		this.owner = owner;
		this.flash = flash;
	};

	p.initialize = function (flash) {
		this.flash = flash;
	};

// Public API

	p.interrupt = function () {
		this.playState = createjs.Sound.PLAY_INTERRUPTED;
		this.flash.interrupt(this.flashId);
		this.cleanUp();
		this.paused = false;
		this.sendEvent("interrupted");
	};

	p.cleanUp = function () {
		clearTimeout(this.delayTimeoutId);
		this.owner.unregisterSoundInstance(this.flashId);
		createjs.Sound.playFinished(this);
	};

	p.play = function (interrupt, delay, offset, loop, volume, pan) {
		createjs.Sound.playInstance(this, interrupt, delay, offset, loop, volume, pan);
	};

	p.beginPlaying = function (offset, loop, volume, pan) {
		this.loop = loop;
		this.paused = false;

		if (!this.owner.flashReady) {
			return false;
		}

		this.offset = offset;

		this.flashId = this.flash.playSound(this.flashSrc, offset, loop, volume, pan);
		if (this.flashId == null) {
			this.cleanUp();
			return false;
		}

		//this.duration = this.flash.getDuration(this.flashId);  // this is 0 at this point
		if (this.muted) {
			this.setMute(true);
		}
		this.playState = createjs.Sound.PLAY_SUCCEEDED;
		this.owner.registerSoundInstance(this.flashId, this);
		this.sendEvent("succeeded");
		return true;
	};

	p.playFailed = function () {
		this.playState = createjs.Sound.PLAY_FAILED;
		this.cleanUp();
		this.sendEvent("failed");
	};

	p.pause = function () {
		if (!this.paused && this.playState == createjs.Sound.PLAY_SUCCEEDED) {
			this.paused = true;
			clearTimeout(this.delayTimeoutId);
			return this.flash.pauseSound(this.flashId);
		}
		return false;
	};

	p.resume = function () {
		if (!this.paused) {
			return false;
		}
		this.paused = false;
		return this.flash.resumeSound(this.flashId);
	};

	p.stop = function () {
		this.playState = createjs.Sound.PLAY_FINISHED;
		this.paused = false;
		this.offset = 0;  // flash destroys the wrapper, so we need to track offset on our own
		var ok = this.flash.stopSound(this.flashId);
		this.cleanUp();
		return ok;
	};

	// leaving functionality in so IE8 will work
	p.setVolume = function (value) {
		if (Number(value) == null) {return;}
		value = Math.max(0, Math.min(1, value));
		this._volume = value;
		return this.flash.setVolume(this.flashId, value)
	};

	p.getVolume = function () {
		return this._volume;
	};

	p.setMute = function (value) {
		this.muted = value;
		return value ? this.flash.muteSound(this.flashId) : this.flash.unmuteSound(this.flashId);
	};

	p.getMute = function () {
		return this.muted;
	};

	p.getPan = function () {
		return this._pan;
	};

	// duplicating functionality to support IE8
	p.setPan = function (value) {
		if (Number(value)==null) {return;}
		value = Math.max(-1, Math.min(1, value));	// force pan to stay in the -1 to 1 range
		this._pan = value;
		return this.flash.setPan(this.flashId, value);
	};

	p.getPosition = function () {
		var value = -1;
		if (this.flash && this.flashId) {
			value = this.flash.getPosition(this.flashId); // this returns -1 on stopped instance
		}
		if (value != -1) {
			this.offset = value;
		}
		return this.offset;
	};

	p.setPosition = function (value) {
		this.offset = value;
		this.flash && this.flashId && this.flash.setPosition(this.flashId, value);
		return true;
	};

	p.getDuration = function () {
		var value = -1;
		if (this.flash && this.flashId) {
			value = this.flash.getDuration(this.flashId);
		}
		if (value != -1) {
			this.duration = value;
		}
		return this.duration;
	};

// Flash callbacks, only exist in FlashPlugin
	p.sendEvent = function (type) {
		var event = new createjs.Event(type);
		this.dispatchEvent(event);
	};

	/**
	 * Called from Flash.  Lets us know flash has finished playing a sound.
	 * #method handleSoundFinished
	 * @protected
	 */
	p.handleSoundFinished = function () {
		this.playState = createjs.Sound.PLAY_FINISHED;
		this.cleanUp();
		this.sendEvent("complete");
	};

	/**
	 * Called from Flash.  Lets us know that flash has played a sound to completion and is looping it.
	 * #method handleSoundLoop
	 * @protected
	 */
	p.handleSoundLoop = function () {
		this.sendEvent("loop");
	};

	p.toString = function () {
		return "[FlashPlugin SoundInstance]"
	};

	// Note this is for SoundInstance above.
	createjs.EventDispatcher.initialize(SoundInstance.prototype);

	createjs.FlashPlugin.SoundInstance = SoundInstance;
}());


(function () {

	"use strict";

	/**
	 * Loader provides a mechanism to preload Flash content via PreloadJS or internally. Instances are returned to
	 * the preloader, and the load method is called when the asset needs to be requested.
	 *
	 * Loader has the same APIs as an &lt;audio&gt; tag. The instance calls the <code>onload</code>, <code>onprogress</code>,
	 * and <code>onerror</code> callbacks when necessary.
	 *
	 * #class Loader
	 * @param {String} src The path to the sound
	 * @param {Object} flash The flash instance that will do the preloading.
	 * @protected
	 */
	function Loader(src, owner, flash) {
		this.init(src, owner, flash);
	}

	var p = Loader.prototype;

	/**
	 * A reference to the Flash instance that gets created.
	 * #property flash
	 * @type {Object | Embed}
	 */
	p.flash = null;

	/**
	 * The source file to be loaded.
	 * #property src
	 * @type {String}
	 */
	p.src = null;

	/**
	 * The original src, before being altered with basePath possibly by PreloadJS
	 * #property src
	 * @type {String}
	 */
	p.originalSrc = null;

	/**
	 * ID used to facilitate communication with flash.
	 * #property flashId
	 * @type {String}
	 */
	p.flashId = null;

	/**
	 * The percentage of progress.
	 * #property progress
	 * @type {Number}
	 * @default -1
	 */
	p.progress = -1;

	/**
	 * Used to report if audio is ready.  Value of 4 indicates ready.
	 * #property readyState
	 * @type {Number}
	 * @default 0
	 */
	p.readyState = 0;

	/**
	 * Indicates if <code>load</code> has been called on this.
	 * #property loading
	 * @type {Boolean}
	 * @default false
	 */
	p.loading = false;

	/**
	 * Plugin that created this.  This will be an instance of <code>FlashPlugin</code>.
	 * #property owner
	 * @type {Object}
	 */
	p.owner = null;

// Calbacks
	/**
	 * The callback that fires when the load completes. This follows HTML tag name conventions.
	 * #property onload
	 * @type {Method}
	 */
	p.onload = null;

	/**
	 * The callback that fires as the load progresses. This follows HTML tag name conventions.
	 * #property onprogress
	 * @type {Method}
	 */
	p.onprogress = null;

	/**
	 * The callback that fires if the load hits an error. This follows HTML tag name conventions.
	 * #property onerror
	 * @type {Method}
	 */
	p.onerror = null;

	// constructor
	p.init = function (src, owner, flash) {
		this.src = src;
		this.originalSrc = src;
		this.owner = owner;
		this.flash = flash;
	};

	/**
	 * Called when Flash has been initialized. If a load call was made before this, call it now.
	 * #method initialize
	 * @param {Object | Embed} flash A reference to the Flash instance.
	 */
	p.initialize = function (flash) {
		this.flash = flash;
		if (this.loading) {
			this.loading = false;
			this.load(this.src);
		}
	};

	/**
	 * Start loading.
	 * #method load
	 * @param {String} src The path to the sound.
	 * @return {Boolean} If the load was started. If Flash has not been initialized, the load will fail.
	 */
	p.load = function (src) {
		if (src != null) {
			this.src = src;
		}
		if (this.flash == null || !this.owner.flashReady) {
			this.loading = true;
			// register for future preloading
			this.owner.preloadInstances[this.src] = this; // OJR this would be better as an API call
			return false;
		}

		this.flashId = this.flash.preload(this.src);
		// Associate this preload instance with the FlashID, so callbacks can route here.
		this.owner.registerPreloadInstance(this.flashId, this);
		return true;
	};

	/**
	 * Receive progress from Flash and pass it to callback.
	 *
	 * <strong>Note</strong>: this is not a public API, but is used to allow preloaders to subscribe to load
	 * progress as if this is an HTML audio tag. This reason is why this still uses a callback instead of an event.
	 * #method handleProgress
	 * @param {Number} loaded Amount loaded
	 * @param {Number} total Total amount to be loaded.
	 */
	p.handleProgress = function (loaded, total) {
		this.progress = loaded / total;
		this.onprogress && this.onprogress({loaded:loaded, total:total, progress:this.progress});
	};

	/**
	 * Called from Flash when sound is loaded.  Set our ready state and fire callbacks / events
	 * #method handleComplete
	 */
	p.handleComplete = function () {
		this.progress = 1;
		this.readyState = 4;
		this.owner.registerLoadedSrc(this.src, this.originalSrc);
		//this.src = this.originalSrc;
		createjs.Sound.sendFileLoadEvent(this.originalSrc);  // fire event or callback on Sound // can't use onload callback because we need to pass the source
		this.onload && this.onload();
	};

	/**
	 * Receive error event from flash and pass it to callback.
	 * @param {Event} error
	 */
	p.handleError = function (error) {
		this.onerror && this.onerror(error);
	};

	p.toString = function () {
		return "[FlashPlugin Loader]";
	};

	createjs.FlashPlugin.Loader = Loader;

}());

/*
 * WebAudioPlugin
 * Visit http://createjs.com/ for documentation, updates and examples.
 *
 *
 * Copyright (c) 2012 gskinner.com, inc.
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 */

/**
 * @module SoundJS
 */

// namespace:
this.createjs = this.createjs || {};

(function () {

	"use strict";

	/**
	 * Play sounds using Web Audio in the browser. The WebAudio plugin has been successfully tested with:
	 * <ul><li>Google Chrome, version 23+ on OS X and Windows</li>
	 *      <li>Safari 6+ on OS X</li>
	 *      <li>Mobile Safari on iOS 6+</li>
	 * </ul>
	 *
	 * The WebAudioPlugin is currently the default plugin, and will be used anywhere that it is supported. Currently
	 * Chrome and Safari offer support.  Firefox and Android Chrome both offer support for web audio in upcoming
	 * releases.  To change plugin priority, check out the Sound API {{#crossLink "Sound/registerPlugins"}}{{/crossLink}} method.

	 * <h4>Known Browser and OS issues for Web Audio Plugin</h4>
	 * <b>Firefox 25</b>
	 * <ul><li>mp3 audio files do not load properly on all windows machines, reported
	 * <a href="https://bugzilla.mozilla.org/show_bug.cgi?id=929969" target="_blank">here</a>. </br>
	 * For this reason it is recommended to pass ogg file first until this bug is resolved, if possible.</li></ul>
	 * <br />
	 * <b>Webkit (Chrome and Safari)</b>
	 * <ul><li>AudioNode.disconnect does not always seem to work.  This can cause the file size to grow over time if you
	 * are playing a lot of audio files.</li></ul>
	 * <br />
	 * <b>iOS 6 limitations</b>
	 * 	<ul><li>Sound is initially muted and will only unmute through play being called inside a user initiated event (touch/click).</li>
	 *  <li>Despite suggestions to the opposite, we have relative control over audio volume through the gain nodes.</li>
	 *	<li>A bug exists that will distort uncached audio when a video element is present in the DOM.</li>
	 * </ul>
	 * @class WebAudioPlugin
	 * @constructor
	 * @since 0.4.0
	 */
	function WebAudioPlugin() {
		this.init();
	}

	var s = WebAudioPlugin;

	/**
	 * The capabilities of the plugin. This is generated via the {{#crossLink "WebAudioPlugin/generateCapabilities:method"}}{{/crossLink}}
	 * method and is used internally.
	 * @property capabilities
	 * @type {Object}
	 * @default null
	 * @protected
	 * @static
	 */
	s.capabilities = null;

	/**
	 * Determine if the plugin can be used in the current browser/OS.
	 * @method isSupported
	 * @return {Boolean} If the plugin can be initialized.
	 * @static
	 */
	s.isSupported = function () {
		// check if this is some kind of mobile device, Web Audio works with local protocol under PhoneGap and it is unlikely someone is trying to run a local file
		var isMobilePhoneGap = createjs.Sound.BrowserDetect.isIOS || createjs.Sound.BrowserDetect.isAndroid || createjs.Sound.BrowserDetect.isBlackberry;
		// OJR isMobile may be redundant with isFileXHRSupported available.  Consider removing.
		if (location.protocol == "file:" && !isMobilePhoneGap && !this.isFileXHRSupported()) { return false; }  // Web Audio requires XHR, which is not usually available locally
		s.generateCapabilities();
		if (s.context == null) {
			return false;
		}
		return true;
	};

	/**
	 * Determine if XHR is supported, which is necessary for web audio.
	 * @method isFileXHRSupported
	 * @return {Boolean} If XHR is supported.
	 * @since 0.4.2
	 * @protected
	 * @static
	 */
	s.isFileXHRSupported = function() {
		// it's much easier to detect when something goes wrong, so let's start optimisticaly
		var supported = true;

		var xhr = new XMLHttpRequest();
		try {
			xhr.open("GET", "fail.fail", false); // loading non-existant file triggers 404 only if it could load (synchronous call)
		} catch (error) {
			// catch errors in cases where the onerror is passed by
			supported = false;
			return supported;
		}
		xhr.onerror = function() { supported = false; }; // cause irrelevant
		// with security turned off, we can get empty success results, which is actually a failed read (status code 0?)
		xhr.onload = function() { supported = this.status == 404 || (this.status == 200 || (this.status == 0 && this.response != "")); };
		try {
			xhr.send();
		} catch (error) {
			// catch errors in cases where the onerror is passed by
			supported = false;
		}

		return supported;
	}

	/**
	 * Determine the capabilities of the plugin. Used internally. Please see the Sound API {{#crossLink "Sound/getCapabilities"}}{{/crossLink}}
	 * method for an overview of plugin capabilities.
	 * @method generateCapabiities
	 * @static
	 * @protected
	 */
	s.generateCapabilities = function () {
		if (s.capabilities != null) {
			return;
		}
		// Web Audio can be in any formats supported by the audio element, from http://www.w3.org/TR/webaudio/#AudioContext-section,
		// therefore tag is still required for the capabilities check
		var t = document.createElement("audio");

		if (t.canPlayType == null) {
			return null;
		}

		// This check is first because it's what is currently used, but the spec calls for it to be AudioContext so this
		//  will probably change in time
		if (window.webkitAudioContext) {
			s.context = new webkitAudioContext();
		} else if (window.AudioContext) {
			s.context = new AudioContext();
		} else {
			return null;
		}

		// this handles if only deprecated Web Audio API calls are supported
		s.compatibilitySetUp();

		// playing this inside of a touch event will enable audio on iOS, which starts muted
		s.playEmptySound();

		s.capabilities = {
			panning:true,
			volume:true,
			tracks:-1
		};

		// determine which extensions our browser supports for this plugin by iterating through Sound.SUPPORTED_EXTENSIONS
		var supportedExtensions = createjs.Sound.SUPPORTED_EXTENSIONS;
		var extensionMap = createjs.Sound.EXTENSION_MAP;
		for (var i = 0, l = supportedExtensions.length; i < l; i++) {
			var ext = supportedExtensions[i];
			var playType = extensionMap[ext] || ext;
			s.capabilities[ext] = (t.canPlayType("audio/" + ext) != "no" && t.canPlayType("audio/" + ext) != "") || (t.canPlayType("audio/" + playType) != "no" && t.canPlayType("audio/" + playType) != "");
		}  // OJR another way to do this might be canPlayType:"m4a", codex: mp4

		// 0=no output, 1=mono, 2=stereo, 4=surround, 6=5.1 surround.
		// See http://www.w3.org/TR/webaudio/#AudioChannelSplitter for more details on channels.
		if (s.context.destination.numberOfChannels < 2) {
			s.capabilities.panning = false;
		}

		// set up AudioNodes that all of our source audio will connect to
		s.dynamicsCompressorNode = s.context.createDynamicsCompressor();
		s.dynamicsCompressorNode.connect(s.context.destination);
		s.gainNode = s.context.createGain();
		s.gainNode.connect(s.dynamicsCompressorNode);
	};

	/**
	 * Set up compatibility if only deprecated web audio calls are supported.
	 * See http://www.w3.org/TR/webaudio/#DeprecationNotes
	 * Needed so we can support new browsers that don't support deprecated calls (Firefox) as well as old browsers that
	 * don't support new calls.
	 *
	 * @method compatibilitySetUp
	 * @protected
	 * @since 0.4.2
	 */
	s.compatibilitySetUp = function() {
		//assume that if one new call is supported, they all are
		if (s.context.createGain) { return; }

		// simple name change, functionality the same
		s.context.createGain = s.context.createGainNode;

		// source node, add to prototype
		var audioNode = s.context.createBufferSource();
		audioNode.__proto__.start = audioNode.__proto__.noteGrainOn;	// note that noteGrainOn requires all 3 parameters
		audioNode.__proto__.stop = audioNode.__proto__.noteOff;

		// panningModel
		this.panningModel = 0;
	}

	/**
	 * Plays an empty sound in the web audio context.  This is used to enable web audio on iOS devices, as they
	 * require the first sound to be played inside of a user initiated event (touch/click).  This is called when
	 * {{#crossLink "WebAudioPlugin"}}{{/crossLink}} is initialized (by Sound {{#crossLink "Sound/initializeDefaultPlugins"}}{{/crossLink}}
	 * for example).
	 *
	 * <h4>Example</h4>
	 *
	 *     function handleTouch(event) {
	 *         createjs.WebAudioPlugin.playEmptySound();
	 *     }
	 *
	 * @method playEmptySound
	 * @since 0.4.1
	 */
	s.playEmptySound = function() {
		// create empty buffer
		var buffer = this.context.createBuffer(1, 1, 22050);
		var source = this.context.createBufferSource();
		source.buffer = buffer;

		// connect to output (your speakers)
		source.connect(this.context.destination);

		// play the file
		source.start(0, 0, 0);
	};


	var p = WebAudioPlugin.prototype;

	p.capabilities = null; // doc'd above

	/**
	 * The internal volume value of the plugin.
	 * @property volume
	 * @type {Number}
	 * @default 1
	 * @protected
	 */
		// TODO refactor Sound.js so we can use getter setter for volume
	p.volume = 1;

	/**
	 * The web audio context, which WebAudio uses to play audio. All nodes that interact with the WebAudioPlugin
	 * need to be created within this context.
	 * @property context
	 * @type {AudioContext}
	 */
	p.context = null;

	/**
	 * Value to set panning model to equal power for SoundInstance.  Can be "equalpower" or 0 depending on browser implementation.
	 * @property panningModel
	 * @type {Number / String}
	 * @protected
	 */
	p.panningModel = "equalpower";

	/**
	 * A DynamicsCompressorNode, which is used to improve sound quality and prevent audio distortion according to
	 * http://www.w3.org/TR/webaudio/#DynamicsCompressorNode. It is connected to <code>context.destination</code>.
	 * @property dynamicsCompressorNode
	 * @type {AudioNode}
	 */
	p.dynamicsCompressorNode = null;

	/**
	 * A GainNode for controlling master volume. It is connected to {{#crossLink "WebAudioPlugin/dynamicsCompressorNode:property"}}{{/crossLink}}.
	 * @property gainNode
	 * @type {AudioGainNode}
	 */
	p.gainNode = null;

	/**
	 * An object hash used internally to store ArrayBuffers, indexed by the source URI used  to load it. This
	 * prevents having to load and decode audio files more than once. If a load has been started on a file,
	 * <code>arrayBuffers[src]</code> will be set to true. Once load is complete, it is set the the loaded
	 * ArrayBuffer instance.
	 * @property arrayBuffers
	 * @type {Object}
	 * @protected
	 */
	p.arrayBuffers = null;

	/**
	 * An initialization function run by the constructor
	 * @method init
	 * @protected
	 */
	p.init = function () {
		this.capabilities = s.capabilities;
		this.arrayBuffers = {};

		this.context = s.context;
		this.gainNode = s.gainNode;
		this.dynamicsCompressorNode = s.dynamicsCompressorNode;
	};

	/**
	 * Pre-register a sound for preloading and setup. This is called by {{#crossLink "Sound"}}{{/crossLink}}.
	 * Note that WebAudio provides a <code>Loader</code> instance, which <a href="http://preloadjs.com">PreloadJS</a>
	 * can use to assist with preloading.
	 * @method register
	 * @param {String} src The source of the audio
	 * @param {Number} instances The number of concurrently playing instances to allow for the channel at any time.
	 * Note that the WebAudioPlugin does not manage this property.
	 * @return {Object} A result object, containing a "tag" for preloading purposes.
	 */
	p.register = function (src, instances) {
		this.arrayBuffers[src] = true;  // This is needed for PreloadJS
		var tag = new createjs.WebAudioPlugin.Loader(src, this);
		return {
			tag:tag
		};
	};

	/**
	 * Checks if preloading has started for a specific source. If the source is found, we can assume it is loading,
	 * or has already finished loading.
	 * @method isPreloadStarted
	 * @param {String} src The sound URI to check.
	 * @return {Boolean}
	 */
	p.isPreloadStarted = function (src) {
		return (this.arrayBuffers[src] != null);
	};

	/**
	 * Checks if preloading has finished for a specific source.
	 * @method isPreloadComplete
	 * @param {String} src The sound URI to load.
	 * @return {Boolean}
	 */
	p.isPreloadComplete = function (src) {
		return (!(this.arrayBuffers[src] == null || this.arrayBuffers[src] == true));
	};

	/**
	 * Remove a source from our preload list. Note this does not cancel a preload.
	 * @method removeFromPreload
	 * @param {String} src The sound URI to unload.
	 * @deprecated
	 */
	p.removeFromPreload = function (src) {
		delete(this.arrayBuffers[src]);
	};

	/**
	 * Remove a sound added using {{#crossLink "WebAudioPlugin/register"}}{{/crossLink}}. Note this does not cancel a preload.
	 * @method removeSound
	 * @param {String} src The sound URI to unload.
	 * @since 0.4.1
	 */
	p.removeSound = function (src) {
		delete(this.arrayBuffers[src]);
	};

	/**
	 * Remove all sounds added using {{#crossLink "WebAudioPlugin/register"}}{{/crossLink}}. Note this does not cancel a preload.
	 * @method removeAllSounds
	 * @param {String} src The sound URI to unload.
	 * @since 0.4.1
	 */
	p.removeAllSounds = function () {
		this.arrayBuffers = {};
	};

	/**
	 * Add loaded results to the preload object hash.
	 * @method addPreloadResults
	 * @param {String} src The sound URI to unload.
	 * @return {Boolean}
	 */
	p.addPreloadResults = function (src, result) {
		this.arrayBuffers[src] = result;
	};

	/**
	 * Handles internal preload completion.
	 * @method handlePreloadComplete
	 * @protected
	 */
	p.handlePreloadComplete = function () {
		//LM: I would recommend having the Loader include an "event" in the onload, and properly binding this callback.
		createjs.Sound.sendFileLoadEvent(this.src);  // fire event or callback on Sound
		// note "this" will reference Loader object
	};

	/**
	 * Internally preload a sound. Loading uses XHR2 to load an array buffer for use with WebAudio.
	 * @method preload
	 * @param {String} src The sound URI to load.
	 * @param {Object} instance Not used in this plugin.
	 * @param {String} basePath A file path to prepend to the src.
	 * @protected
	 */
	p.preload = function (src, instance, basePath) {
		this.arrayBuffers[src] = true;
		var loader = new createjs.WebAudioPlugin.Loader(src, this);
		loader.onload = this.handlePreloadComplete;
		if (basePath != null) {loader.src = basePath+loader.src;}
		loader.load();
	};

	/**
	 * Create a sound instance. If the sound has not been preloaded, it is internally preloaded here.
	 * @method create
	 * @param {String} src The sound source to use.
	 * @return {SoundInstance} A sound instance for playback and control.
	 */
	p.create = function (src) {
		if (!this.isPreloadStarted(src)) {
			this.preload(src);
		}
		return new createjs.WebAudioPlugin.SoundInstance(src, this);
	};

	/**
	 * Set the master volume of the plugin, which affects all SoundInstances.
	 * @method setVolume
	 * @param {Number} value The volume to set, between 0 and 1.
	 * @return {Boolean} If the plugin processes the setVolume call (true). The Sound class will affect all the
	 * instances manually otherwise.
	 */
	p.setVolume = function (value) {
		this.volume = value;
		this.updateVolume();
		return true;
	};

	/**
	 * Set the gain value for master audio. Should not be called externally.
	 * @method updateVolume
	 * @protected
	 */
	p.updateVolume = function () {
		var newVolume = createjs.Sound.masterMute ? 0 : this.volume;
		if (newVolume != this.gainNode.gain.value) {
			this.gainNode.gain.value = newVolume;
		}
	};

	/**
	 * Get the master volume of the plugin, which affects all SoundInstances.
	 * @method getVolume
	 * @return The volume level, between 0 and 1.
	 */
	p.getVolume = function () {
		return this.volume;
	};

	/**
	 * Mute all sounds via the plugin.
	 * @method setMute
	 * @param {Boolean} value If all sound should be muted or not. Note that plugin-level muting just looks up
	 * the mute value of Sound {{#crossLink "Sound/getMute"}}{{/crossLink}}, so this property is not used here.
	 * @return {Boolean} If the mute call succeeds.
	 */
	p.setMute = function (value) {
		this.updateVolume();
		return true;
	};

	p.toString = function () {
		return "[WebAudioPlugin]";
	};

	createjs.WebAudioPlugin = WebAudioPlugin;
}());

(function () {

	"use strict";

	/**
	 * A SoundInstance is created when any calls to the Sound API method {{#crossLink "Sound/play"}}{{/crossLink}} or
	 * {{#crossLink "Sound/createInstance"}}{{/crossLink}} are made. The SoundInstance is returned by the active plugin
	 * for control by the user.
	 *
	 * <h4>Example</h4>
	 *
	 *      var myInstance = createjs.Sound.play("myAssetPath/mySrcFile.mp3");
	 *
	 * A number of additional parameters provide a quick way to determine how a sound is played. Please see the Sound
	 * API method {{#crossLink "Sound/play"}}{{/crossLink}} for a list of arguments.
	 *
	 * Once a SoundInstance is created, a reference can be stored that can be used to control the audio directly through
	 * the SoundInstance. If the reference is not stored, the SoundInstance will play out its audio (and any loops), and
	 * is then de-referenced from the {{#crossLink "Sound"}}{{/crossLink}} class so that it can be cleaned up. If audio
	 * playback has completed, a simple call to the {{#crossLink "SoundInstance/play"}}{{/crossLink}} instance method
	 * will rebuild the references the Sound class need to control it.
	 *
	 *      var myInstance = createjs.Sound.play("myAssetPath/mySrcFile.mp3");
	 *      myInstance.addEventListener("complete", playAgain);
	 *      function playAgain(event) {
	 *          myInstance.play();
	 *      }
	 *
	 * Events are dispatched from the instance to notify when the sound has completed, looped, or when playback fails
	 *
	 *      var myInstance = createjs.Sound.play("myAssetPath/mySrcFile.mp3");
	 *      myInstance.addEventListener("complete", handleComplete);
	 *      myInstance.addEventListener("loop", handleLoop);
	 *      myInstance.addEventListener("failed", handleFailed);
	 *
	 *
	 * @class SoundInstance
	 * @param {String} src The path to and file name of the sound.
	 * @param {Object} owner The plugin instance that created this SoundInstance.
	 * @uses EventDispatcher
	 * @constructor
	 */
	function SoundInstance(src, owner) {
		this.init(src, owner);
	}

	var p = SoundInstance.prototype;

	/**
	 * The source of the sound.
	 * @property src
	 * @type {String}
	 * @default null
	 * @protected
	 */
	p.src = null;

	/**
	 * The unique ID of the instance. This is set by {{#crossLink "Sound"}}{{/crossLink}}.
	 * @property uniqueId
	 * @type {String} | Number
	 * @default -1
	 */
	p.uniqueId = -1;

	/**
	 * The play state of the sound. Play states are defined as constants on {{#crossLink "Sound"}}{{/crossLink}}.
	 * @property playState
	 * @type {String}
	 * @default null
	 */
	p.playState = null;

	/**
	 * The plugin that created the instance
	 * @property owner
	 * @type {WebAudioPlugin}
	 * @default null
	 * @protected
	 */
	p.owner = null;

	/**
	 * How far into the sound to begin playback in milliseconds. This is passed in when play is called and used by
	 * pause and setPosition to track where the sound should be at.
	 * Note this is converted from milliseconds to seconds for consistency with the WebAudio API.
	 * @property offset
	 * @type {Number}
	 * @default 0
	 * @protected
	 */
	p.offset = 0;

	/**
	 * The time in milliseconds before the sound starts.
	 * Note this is handled by {{#crossLink "Sound"}}{{/crossLink}}.
	 * @property delay
	 * @type {Number}
	 * @default 0
	 * @protected
	 */
	p.delay = 0;


	/**
	 * The volume of the sound, between 0 and 1.
	 * Note this uses a getter setter, which is not supported by Firefox versions 3.6 or lower and Opera versions 11.50 or lower,
	 * and Internet Explorer 8 or lower.  Instead use {{#crossLink "SoundInstance/setVolume"}}{{/crossLink}} and {{#crossLink "SoundInstance/getVolume"}}{{/crossLink}}.
	 *
	 * The actual output volume of a sound can be calculated using:
	 * <code>myInstance.volume * createjs.Sound.getVolume();</code>
	 *
	 * @property volume
	 * @type {Number}
	 * @default 1
	 */
	p._volume =  1;
	// IE8 has Object.defineProperty, but only for DOM objects, so check if fails to suppress errors
	try {
		Object.defineProperty(p, "volume", {
			get: function() {
				return this._volume;
			},
			set: function(value) {
				if (Number(value) == null) {return false}
				value = Math.max(0, Math.min(1, value));
				this._volume = value;
				this.updateVolume();
			}
		});
	} catch (e) {
		// dispatch message or error?
	};

	/**
	 * The pan of the sound, between -1 (left) and 1 (right). Note that pan does not work for HTML Audio.
	 * Note this uses a getter setter, which is not supported by Firefox versions 3.6 or lower, Opera versions 11.50 or lower,
	 * and Internet Explorer 8 or lower.  Instead use {{#crossLink "SoundInstance/setPan"}}{{/crossLink}} and {{#crossLink "SoundInstance/getPan"}}{{/crossLink}}.
	 * Note in WebAudioPlugin this only gives us the "x" value of what is actually 3D audio.
	 *
	 * @property pan
	 * @type {Number}
	 * @default 0
	 */
	p._pan =  0;
	// IE8 has Object.defineProperty, but only for DOM objects, so check if fails to suppress errors
	try {
		Object.defineProperty(p, "pan", {
			get: function() {
				return this._pan;
			},
			set: function(value) {
				if (!this.owner.capabilities.panning || Number(value) == null) {return false;}

				value = Math.max(-1, Math.min(1, value));	// force pan to stay in the -1 to 1 range
				// Note that panning in WebAudioPlugin can support 3D audio, but our implementation does not.
				this._pan = value;  // Unfortunately panner does not give us a way to access this after it is set http://www.w3.org/TR/webaudio/#AudioPannerNode
				this.panNode.setPosition(value, 0, -0.5);  // z need to be -0.5 otherwise the sound only plays in left, right, or center
			}
		});
	} catch (e) {
		// dispatch message or error?
	};


	/**
	 * The length of the audio clip, in milliseconds.
	 * Use {{#crossLink "SoundInstance/getDuration:method"}}{{/crossLink}} to access.
	 * @property pan
	 * @type {Number}
	 * @default 0
	 * @protected
	 */
	p.duration = 0;

	/**
	 * The number of play loops remaining. Negative values will loop infinitely.
	 * @property remainingLoops
	 * @type {Number}
	 * @default 0
	 * @protected
	 */
	p.remainingLoops = 0;

	/**
	 * A Timeout created by {{#crossLink "Sound"}}{{/crossLink}} when this SoundInstance is played with a delay.
	 * This allows SoundInstance to remove the delay if stop or pause or cleanup are called before playback begins.
	 * @property delayTimeoutId
	 * @type {timeoutVariable}
	 * @default null
	 * @protected
	 * @since 0.4.0
	 */
	p.delayTimeoutId = null;

	/**
	 * Timeout that is created internally to handle sound playing to completion. Stored so we can remove it when
	 * stop, pause, or cleanup are called
	 * @property soundCompleteTimeout
	 * @type {timeoutVariable}
	 * @default null
	 * @protected
	 * @since 0.4.0
	 */
	p.soundCompleteTimeout = null;

	/**
	 * NOTE this only exists as a {{#crossLink "WebAudioPlugin"}}{{/crossLink}} property and is only intended for use by advanced users.
	 * GainNode for controlling <code>SoundInstance</code> volume. Connected to the WebAudioPlugin {{#crossLink "WebAudioPlugin/gainNode:property"}}{{/crossLink}}
	 * that sequences to <code>context.destination</code>.
	 * @property gainNode
	 * @type {AudioGainNode}
	 * @default null
	 * @since 0.4.0
	 *
	 */
	p.gainNode = null;

	/**
	 * NOTE this only exists as a {{#crossLink "WebAudioPlugin"}}{{/crossLink}} property and is only intended for use by advanced users.
	 * A panNode allowing left and right audio channel panning only. Connected to SoundInstance {{#crossLink "SoundInstance/gainNode:property"}}{{/crossLink}}.
	 * @property panNode
	 * @type {AudioPannerNode}
	 * @default null
	 * @since 0.4.0
	 */
	p.panNode = null;

	/**
	 * NOTE this only exists as a {{#crossLink "WebAudioPlugin"}}{{/crossLink}} property and is only intended for use by advanced users.
	 * sourceNode is the audio source. Connected to {{#crossLink "SoundInstance/gainNode:property"}}{{/crossLink}}.
	 * @property sourceNode
	 * @type {AudioNode}
	 * @default null
	 * @since 0.4.0
	 *
	 */
	p.sourceNode = null;

	/**
	 * NOTE this only exists as a {{#crossLink "WebAudioPlugin"}}{{/crossLink}} property and is only intended for use by advanced users.
	 * sourceNodeNext is the audio source for the next loop, inserted in a look ahead approach to allow for smooth
	 * looping. Connected to {{#crossLink "SoundInstance/gainNode:property"}}{{/crossLink}}.
	 * @property sourceNodeNext
	 * @type {AudioNode}
	 * @default null
	 * @protected
	 * @since 0.4.1
	 *
	 */
	p.sourceNodeNext = null;

	/**
	 * Determines if the audio is currently muted.
	 * Use {{#crossLink "SoundInstance/getMute:method"}}{{/crossLink}} and {{#crossLink "SoundInstance/setMute:method"}}{{/crossLink}} to access.
	 * @property muted
	 * @type {Boolean}
	 * @default false
	 * @protected
	 */
	p.muted = false;

	/**
	 * Determines if the audio is currently paused.
	 * Use {{#crossLink "SoundInstance/pause:method"}}{{/crossLink}} and {{#crossLink "SoundInstance/resume:method"}}{{/crossLink}} to set.
	 * @property paused
	 * @type {Boolean}
	 * @default false
	 * @protected
	 */
	p.paused = false;

	/**
	 * WebAudioPlugin only.
	 * Time audio started playback, in seconds. Used to handle set position, get position, and resuming from paused.
	 * @property startTime
	 * @type {Number}
	 * @default 0
	 * @protected
	 * @since 0.4.0
	 */
	p.startTime = 0;

// mix-ins:
	// EventDispatcher methods:
	p.addEventListener = null;
	p.removeEventListener = null;
	p.removeAllEventListeners = null;
	p.dispatchEvent = null;
	p.hasEventListener = null;
	p._listeners = null;

	// Proxies, make removing listeners easier.
	p.endedHandler = null;
	p.readyHandler = null;
	p.stalledHandler = null;

// Events
	/**
	 * The event that is fired when a sound is ready to play.
	 * @event ready
	 * @param {Object} target The object that dispatched the event.
	 * @param {String} type The event type.
	 * @since 0.4.0
	 */

	/**
	 * The event that is fired when playback has started successfully.
	 * @event succeeded
	 * @param {Object} target The object that dispatched the event.
	 * @param {String} type The event type.
	 * @since 0.4.0
	 */

	/**
	 * The event that is fired when playback is interrupted. This happens when another sound with the same
	 * src property is played using an interrupt value that causes this instance to stop playing.
	 * @event interrupted
	 * @param {Object} target The object that dispatched the event.
	 * @param {String} type The event type.
	 * @since 0.4.0
	 */

	/**
	 * The event that is fired when playback has failed. This happens when there are too many channels with the same
	 * src property already playing (and the interrupt value doesn't cause an interrupt of another instance), or
	 * the sound could not be played, perhaps due to a 404 error.
	 * @event failed
	 * @param {Object} target The object that dispatched the event.
	 * @param {String} type The event type.
	 * @since 0.4.0
	 */

	/**
	 * The event that is fired when a sound has completed playing but has loops remaining.
	 * @event loop
	 * @param {Object} target The object that dispatched the event.
	 * @param {String} type The event type.
	 * @since 0.4.0
	 */

	/**
	 * The event that is fired when playback completes. This means that the sound has finished playing in its
	 * entirety, including its loop iterations.
	 * @event complete
	 * @param {Object} target The object that dispatched the event.
	 * @param {String} type The event type.
	 * @since 0.4.0
	 */

	//TODO: Deprecated
	/**
	 * REMOVED. Use {{#crossLink "EventDispatcher/addEventListener"}}{{/crossLink}} and the {{#crossLink "SoundInstance/ready:event"}}{{/crossLink}}
	 * event.
	 * @property onReady
	 * @type {Function}
	 * @deprecated Use addEventListener and the "ready" event.
	 */
	/**
	 * REMOVED. Use {{#crossLink "EventDispatcher/addEventListener"}}{{/crossLink}} and the {{#crossLink "SoundInstance/succeeded:event"}}{{/crossLink}}
	 * event.
	 * @property onPlaySucceeded
	 * @type {Function}
	 * @deprecated Use addEventListener and the "succeeded" event.
	 */
	/**
	 * REMOVED. Use {{#crossLink "EventDispatcher/addEventListener"}}{{/crossLink}} and the {{#crossLink "SoundInstance/interrupted:event"}}{{/crossLink}}
	 * event.
	 * @property onPlayInterrupted
	 * @type {Function}
	 * @deprecated Use addEventListener and the "interrupted" event.
	 */
	/**
	 * REMOVED. Use {{#crossLink "EventDispatcher/addEventListener"}}{{/crossLink}} and the {{#crossLink "SoundInstance/failed:event"}}{{/crossLink}}
	 * event.
	 * @property onPlayFailed
	 * @type {Function}
	 * @deprecated Use addEventListener and the "failed" event.
	 */
	/**
	 * REMOVED. Use {{#crossLink "EventDispatcher/addEventListener"}}{{/crossLink}} and the {{#crossLink "SoundInstance/complete:event"}}{{/crossLink}}
	 * event.
	 * @property onComplete
	 * @type {Function}
	 * @deprecated Use addEventListener and the "complete" event.
	 */
	/**
	 * REMOVED. Use {{#crossLink "EventDispatcher/addEventListener"}}{{/crossLink}} and the {{#crossLink "SoundInstance/loop:event"}}{{/crossLink}}
	 * event.
	 * @property onLoop
	 * @type {Function}
	 * @deprecated Use addEventListener and the "loop" event.
	 */

	/**
	 * A helper method that dispatches all events for SoundInstance.
	 * @method sendEvent
	 * @param {String} type The event type
	 * @protected
	 */
	p.sendEvent = function (type) {
		var event = new createjs.Event(type);
		this.dispatchEvent(event);
	};

// Constructor
	/**
	 * Initialize the SoundInstance. This is called from the constructor.
	 * @method init
	 * @param {string} src The source of the audio.
	 * @param {Class} owner The plugin that created this instance.
	 * @protected
	 */
	p.init = function (src, owner) {
		this.owner = owner;
		this.src = src;

		this.gainNode = this.owner.context.createGain();

		this.panNode = this.owner.context.createPanner();  //TODO test how this affects when we have mono audio
		this.panNode.panningModel = this.owner.panningModel;
		this.panNode.connect(this.gainNode);

		if (this.owner.isPreloadComplete(this.src)) {
			this.duration = this.owner.arrayBuffers[this.src].duration * 1000;
		}

		this.endedHandler = createjs.proxy(this.handleSoundComplete, this);
		this.readyHandler = createjs.proxy(this.handleSoundReady, this);
		this.stalledHandler = createjs.proxy(this.handleSoundStalled, this);
	};

	/**
	 * Clean up the instance. Remove references and clean up any additional properties such as timers.
	 * @method cleanup
	 * @protected
	 */
	p.cleanUp = function () {
		if (this.sourceNode && this.playState == createjs.Sound.PLAY_SUCCEEDED) {
			this.sourceNode = this.cleanUpAudioNode(this.sourceNode);
			this.sourceNodeNext = this.cleanUpAudioNode(this.sourceNodeNext);
		}

		if (this.gainNode.numberOfOutputs != 0) {
			this.gainNode.disconnect(0);
		}  // this works because we only have one connection, and it returns 0 if we've already disconnected it.
		// OJR there appears to be a bug that this doesn't always work in webkit (Chrome and Safari). According to the documentation, this should work.

		clearTimeout(this.delayTimeoutId); // clear timeout that plays delayed sound
		clearTimeout(this.soundCompleteTimeout);  // clear timeout that triggers sound complete

		this.startTime = 0;	// This is used by getPosition

		if (window.createjs == null) {
			return;
		}
		createjs.Sound.playFinished(this);
	};

	/**
	 * Turn off and disconnect an audioNode, then set reference to null to release it for garbage collection
	 * @param audioNode
	 * @return {audioNode}
	 * @protected
	 * @since 0.4.1
	 */
	p.cleanUpAudioNode = function(audioNode) {
		if(audioNode) {
			audioNode.stop(0);
			audioNode.disconnect(this.panNode);
			audioNode = null;	// release reference so Web Audio can handle removing references and garbage collection
		}
		return audioNode;
	};

	/**
	 * The sound has been interrupted.
	 * @method interrupt
	 * @protected
	 */
	p.interrupt = function () {
		this.cleanUp();
		this.playState = createjs.Sound.PLAY_INTERRUPTED;
		this.paused = false;
		this.sendEvent("interrupted");
	};

	// Playback has stalled, and therefore failed.
	p.handleSoundStalled = function (event) {
		this.sendEvent("failed");
	};

	// The sound is ready for playing
	p.handleSoundReady = function (event) {
		if (window.createjs == null) {
			return;
		}

		if ((this.offset*1000) > this.getDuration()) {	// converting offset to ms
			this.playFailed();
			return;
		} else if (this.offset < 0) {  // may not need this check if play ignores negative values, this is not specified in the API http://www.w3.org/TR/webaudio/#AudioBufferSourceNode
			this.offset = 0;
		}

		this.playState = createjs.Sound.PLAY_SUCCEEDED;
		this.paused = false;

		this.gainNode.connect(this.owner.gainNode);  // this line can cause a memory leak.  Nodes need to be disconnected from the audioDestination or any sequence that leads to it.

		var dur = this.owner.arrayBuffers[this.src].duration;
		this.sourceNode = this.createAndPlayAudioNode((this.owner.context.currentTime - dur), this.offset);
		this.duration = dur * 1000;	// NOTE *1000 because WebAudio reports everything in seconds but js uses milliseconds
		this.startTime = this.sourceNode.startTime - this.offset;

		this.soundCompleteTimeout = setTimeout(this.endedHandler, (dur - this.offset) * 1000);

		if(this.remainingLoops != 0) {
			this.sourceNodeNext = this.createAndPlayAudioNode(this.startTime, 0);
		}
	};

	/**
	 * Creates an audio node using the current src and context, connects it to the gain node, and starts playback.
	 * @method createAudioNode
	 * @param {Number} startTime The time to add this to the web audio context, in seconds.
	 * @param {Number} offset The amount of time into the src audio to start playback, in seconds.
	 * @return {audioNode}
	 * @protected
	 * @since 0.4.1
	 */
	p.createAndPlayAudioNode = function(startTime, offset) {
		// WebAudio supports BufferSource, MediaElementSource, and MediaStreamSource.
		// NOTE MediaElementSource requires different commands to play, pause, and stop because it uses audio tags.
		// The same is assumed for MediaStreamSource, although it may share the same commands as MediaElementSource.
		var audioNode = this.owner.context.createBufferSource();
		audioNode.buffer = this.owner.arrayBuffers[this.src];
		audioNode.connect(this.panNode);
		var currentTime = this.owner.context.currentTime;
		audioNode.startTime = startTime + audioNode.buffer.duration;	//currentTime + audioNode.buffer.duration - (currentTime - startTime);
		audioNode.start(audioNode.startTime, offset, audioNode.buffer.duration - offset);
		return audioNode;
	};

	// Public API
	/**
	 * Play an instance. This method is intended to be called on SoundInstances that already exist (created
	 * with the Sound API {{#crossLink "Sound/createInstance"}}{{/crossLink}} or {{#crossLink "Sound/play"}}{{/crossLink}}).
	 *
	 * <h4>Example</h4>
	 *      var myInstance = createjs.Sound.createInstance(mySrc);
	 *      myInstance.play(createjs.Sound.INTERRUPT_ANY);
	 *      // alternatively, we can pass in options we want to set in an object
	 *      myInstance.play({offset:1, loop:2, pan:0.5});
	 *
	 * @method play
	 * @param {String | Object} [interrupt="none"|options] How to interrupt any currently playing instances of audio with the same source,
	 * if the maximum number of instances of the sound are already playing. Values are defined as <code>INTERRUPT_TYPE</code>
	 * constants on the Sound class, with the default defined by {{#crossLink "Sound/defaultInterruptBehavior"}}{{/crossLink}}.
	 * <br /><strong>OR</strong><br />
	 * This parameter can be an object that contains any or all optional properties by name, including: interrupt,
	 * delay, offset, loop, volume, and pan (see the above code sample).
	 * @param {Number} [delay=0] The delay in milliseconds before the sound starts
	 * @param {Number} [offset=0] How far into the sound to begin playback, in milliseconds.
	 * @param {Number} [loop=0] The number of times to loop the audio. Use -1 for infinite loops.
	 * @param {Number} [volume=1] The volume of the sound, between 0 and 1.
	 * @param {Number} [pan=0] The pan of the sound between -1 (left) and 1 (right). Note that pan is not supported
	 * for HTML Audio.
	 */
	p.play = function (interrupt, delay, offset, loop, volume, pan) {
		this.cleanUp();
		createjs.Sound.playInstance(this, interrupt, delay, offset, loop, volume, pan);
	};

	/**
	 * Called by the Sound class when the audio is ready to play (delay has completed). Starts sound playing if the
	 * src is loaded, otherwise playback will fail.
	 * @method beginPlaying
	 * @param {Number} offset How far into the sound to begin playback, in milliseconds.
	 * @param {Number} loop The number of times to loop the audio. Use -1 for infinite loops.
	 * @param {Number} volume The volume of the sound, between 0 and 1.
	 * @param {Number} pan The pan of the sound between -1 (left) and 1 (right). Note that pan does not work for HTML Audio.
	 * @protected
	 */
	p.beginPlaying = function (offset, loop, volume, pan) {
		if (window.createjs == null) {
			return;
		}

		if (!this.src) {
			return;
		}

		this.offset = offset / 1000;  //convert ms to sec
		this.remainingLoops = loop;
		this.volume = volume;
		this.pan = pan;

		if (this.owner.isPreloadComplete(this.src)) {
			this.handleSoundReady(null);
			this.sendEvent("succeeded");
			return 1;
		} else {
			this.playFailed();
			return;
		}
	};

	/**
	 * Pause the instance. Paused audio will stop at the current time, and can be resumed using
	 * {{#crossLink "SoundInstance/resume"}}{{/crossLink}}.
	 *
	 * <h4>Example</h4>
	 *
	 *      myInstance.pause();
	 *
	 * @method pause
	 * @return {Boolean} If the pause call succeeds. This will return false if the sound isn't currently playing.
	 */
	p.pause = function () {
		if (!this.paused && this.playState == createjs.Sound.PLAY_SUCCEEDED) {
			this.paused = true;

			this.offset = this.owner.context.currentTime - this.startTime;  // this allows us to restart the sound at the same point in playback
			this.cleanUpAudioNode(this.sourceNode);
			this.cleanUpAudioNode(this.sourceNodeNext);

			if (this.gainNode.numberOfOutputs != 0) {
				this.gainNode.disconnect();
			}  // this works because we only have one connection, and it returns 0 if we've already disconnected it.

			clearTimeout(this.delayTimeoutId); // clear timeout that plays delayed sound
			clearTimeout(this.soundCompleteTimeout);  // clear timeout that triggers sound complete
			return true;
		}
		return false;
	};

	/**
	 * Resume an instance that has been paused using {{#crossLink "SoundInstance/pause"}}{{/crossLink}}. Audio that
	 * has not been paused will not playback when this method is called.
	 *
	 * <h4>Example</h4>
	 *
	 *     myInstance.pause();
	 *     // do some stuff
	 *     myInstance.resume();
	 *
	 * @method resume
	 * @return {Boolean} If the resume call succeeds. This will return false if called on a sound that is not paused.
	 */
	p.resume = function () {
		if (!this.paused) {
			return false;
		}
		this.handleSoundReady(null);
		return true;
	};

	/**
	 * Stop playback of the instance. Stopped sounds will reset their position to 0, and calls to {{#crossLink "SoundInstance/resume"}}{{/crossLink}}
	 * will fail.  To start playback again, call {{#crossLink "SoundInstance/play"}}{{/crossLink}}.
	 *
	 * <h4>Example</h4>
	 *
	 *     myInstance.stop();
	 *
	 * @method stop
	 * @return {Boolean} If the stop call succeeds.
	 */
	p.stop = function () {
		this.cleanUp();
		this.playState = createjs.Sound.PLAY_FINISHED;
		this.offset = 0;  // set audio to start at the beginning
		return true;
	};

	/**
	 * NOTE that you can set volume directly, and setVolume remains to allow support for IE8 with FlashPlugin.
	 * Set the volume of the instance. You can retrieve the volume using {{#crossLink "SoundInstance/getVolume"}}{{/crossLink}}.
	 *
	 * <h4>Example</h4>
	 *
	 *      myInstance.setVolume(0.5);
	 *
	 * Note that the master volume set using the Sound API method {{#crossLink "Sound/setVolume"}}{{/crossLink}}
	 * will be applied to the instance volume.
	 *
	 * @method setVolume
	 * @param value The volume to set, between 0 and 1.
	 * @return {Boolean} If the setVolume call succeeds.
	 */
	p.setVolume = function (value) {
		this.volume = value;
		return true;  // This is always true because even if the volume is not updated, the value is set
	};

	/**
	 * Internal function used to update the volume based on the instance volume, master volume, instance mute value,
	 * and master mute value.
	 * @method updateVolume
	 * @return {Boolean} if the volume was updated.
	 * @protected
	 */
	p.updateVolume = function () {
		var newVolume = this.muted ? 0 : this._volume;
		if (newVolume != this.gainNode.gain.value) {
			this.gainNode.gain.value = newVolume;
			return true;
		}
		return false;
	};

	/**
	 * NOTE that you can get volume directly, and getVolume remains to allow support for IE8 with FlashPlugin.
	 *
	 * Get the volume of the instance. The actual output volume of a sound can be calculated using:
	 * <code>myInstance.getVolume() * createjs.Sound.getVolume();</code>
	 *
	 * @method getVolume
	 * @return The current volume of the sound instance.
	 */
	p.getVolume = function () {
		return this.volume;
	};

	/**
	 * REMOVED. <strong>Please use {{#crossLink "SoundInstance/setMute"}}{{/crossLink}} instead</strong>.
	 * @method mute
	 * @param {Boolean} value If the sound should be muted or not.
	 * @return {Boolean} If the mute call succeeds.
	 * @deprecated This method has been replaced by setMute.
	 */

	/**
	 * Mute and unmute the sound. Muted sounds will still play at 0 volume. Note that an unmuted sound may still be
	 * silent depending on {{#crossLink "Sound"}}{{/crossLink}} volume, instance volume, and Sound mute.
	 *
	 * <h4>Example</h4>
	 *
	 *     myInstance.setMute(true);
	 *
	 * @method setMute
	 * @param {Boolean} value If the sound should be muted.
	 * @return {Boolean} If the mute call succeeds.
	 * @since 0.4.0
	 */
	p.setMute = function (value) {
		if (value == null || value == undefined) {
			return false;
		}

		this.muted = value;
		this.updateVolume();
		return true;
	};

	/**
	 * Get the mute value of the instance.
	 *
	 * <h4>Example</h4>
	 *
	 *      var isMuted = myInstance.getMute();
	 *
	 * @method getMute
	 * @return {Boolean} If the sound is muted.
	 * @since 0.4.0
	 */
	p.getMute = function () {
		return this.muted;
	};

	/**
	 * NOTE that you can set pan directly, and getPan remains to allow support for IE8 with FlashPlugin.
	 *
	 * Set the left(-1)/right(+1) pan of the instance. Note that {{#crossLink "HTMLAudioPlugin"}}{{/crossLink}} does not
	 * support panning, and only simple left/right panning has been implemented for {{#crossLink "WebAudioPlugin"}}{{/crossLink}}.
	 * The default pan value is 0 (center).
	 *
	 * <h4>Example</h4>
	 *
	 *     myInstance.setPan(-1);  // to the left!
	 *
	 * @method setPan
	 * @param {Number} value The pan value, between -1 (left) and 1 (right).
	 * @return {Number} If the setPan call succeeds.
	 */
	p.setPan = function (value) {
		this.pan = value;  // Unfortunately panner does not give us a way to access this after it is set http://www.w3.org/TR/webaudio/#AudioPannerNode
		if(this.pan != value) {return false;}
	};

	/**
	 * NOTE that you can get volume directly, and getPan remains to allow support for IE8 with FlashPlugin.
	 *
	 * Get the left/right pan of the instance. Note in WebAudioPlugin this only gives us the "x" value of what is
	 * actually 3D audio.
	 *
	 * <h4>Example</h4>
	 *
	 *     var myPan = myInstance.getPan();
	 *
	 * @method getPan
	 * @return {Number} The value of the pan, between -1 (left) and 1 (right).
	 */
	p.getPan = function () {
		return this.pan;
	};

	/**
	 * Get the position of the playhead in the instance in milliseconds.
	 *
	 * <h4>Example</h4>
	 *
	 *     var currentOffset = myInstance.getPosition();
	 *
	 * @method getPosition
	 * @return {Number} The position of the playhead in the sound, in milliseconds.
	 */
	p.getPosition = function () {
		if (this.paused || this.sourceNode == null) {
			var pos = this.offset;
		} else {
			var pos = this.owner.context.currentTime - this.startTime;
		}

		return pos * 1000; // pos in seconds * 1000 to give milliseconds
	};

	/**
	 * Set the position of the playhead in the instance. This can be set while a sound is playing, paused, or even
	 * stopped.
	 *
	 * <h4>Example</h4>
	 *
	 *      myInstance.setPosition(myInstance.getDuration()/2); // set audio to its halfway point.
	 *
	 * @method setPosition
	 * @param {Number} value The position to place the playhead, in milliseconds.
	 */
	p.setPosition = function (value) {
		this.offset = value / 1000; // convert milliseconds to seconds

		if (this.sourceNode && this.playState == createjs.Sound.PLAY_SUCCEEDED) {
			// we need to stop this sound from continuing to play, as we need to recreate the sourceNode to change position
			this.cleanUpAudioNode(this.sourceNode);
			this.cleanUpAudioNode(this.sourceNodeNext);
			clearTimeout(this.soundCompleteTimeout);  // clear timeout that triggers sound complete
		}  // NOTE we cannot just call cleanup because it also calls the Sound function playFinished which releases this instance in SoundChannel

		if (!this.paused && this.playState == createjs.Sound.PLAY_SUCCEEDED) {
			this.handleSoundReady(null);
		}

		return true;
	};

	/**
	 * Get the duration of the instance, in milliseconds. Note in most cases, you need to play a sound using
	 * {{#crossLink "SoundInstance/play"}}{{/crossLink}} or the Sound API {{#crossLink "Sound.play"}}{{/crossLink}}
	 * method before its duration can be reported accurately.
	 *
	 * <h4>Example</h4>
	 *
	 *     var soundDur = myInstance.getDuration();
	 *
	 * @method getDuration
	 * @return {Number} The duration of the sound instance in milliseconds.
	 */
	p.getDuration = function () {
		return this.duration;
	};

	// Audio has finished playing. Manually loop it if required.
	// called internally by soundCompleteTimeout in WebAudioPlugin
	p.handleSoundComplete = function (event) {
		this.offset = 0;  // have to set this as it can be set by pause during playback


		if (this.remainingLoops != 0) {
			this.remainingLoops--;  // NOTE this introduces a theoretical limit on loops = float max size x 2 - 1

			// OJR we are using a look ahead approach to ensure smooth looping.  We add sourceNodeNext to the audio
			// context so that it starts playing even if this callback is delayed.  This technique and the reasons for
			// using it are described in greater detail here:  http://www.html5rocks.com/en/tutorials/audio/scheduling/
			// NOTE the cost of this is that our audio loop may not always match the loop event timing precisely.
			if(this.sourceNodeNext) { // this can be set to null, but this should not happen when looping
				this.cleanUpAudioNode(this.sourceNode);
				this.sourceNode = this.sourceNodeNext;
				this.startTime = this.sourceNode.startTime;
				this.sourceNodeNext = this.createAndPlayAudioNode(this.startTime, 0);
				this.soundCompleteTimeout = setTimeout(this.endedHandler, this.duration);
			}
			else {
				this.handleSoundReady(null);
			}

			this.sendEvent("loop");
			return;
		}

		if (window.createjs == null) {
			return;
		}
		this.cleanUp();
		this.playState = createjs.Sound.PLAY_FINISHED;
		this.sendEvent("complete");
	};

	// Play has failed, which can happen for a variety of reasons.
	p.playFailed = function () {
		if (window.createjs == null) {
			return;
		}
		this.cleanUp();
		this.playState = createjs.Sound.PLAY_FAILED;
		this.sendEvent("failed");
	};

	p.toString = function () {
		return "[WebAudioPlugin SoundInstance]";
	};

	// This is for the above SoundInstance.
	createjs.EventDispatcher.initialize(SoundInstance.prototype); // inject EventDispatcher methods.

	createjs.WebAudioPlugin.SoundInstance = SoundInstance;
}());

(function () {

	"use strict";

	/**
	 * An internal helper class that preloads web audio via XHR. Note that this class and its methods are not documented
	 * properly to avoid generating HTML documentation.
	 * #class Loader
	 * @param {String} src The source of the sound to load.
	 * @param {Object} owner A reference to the class that created this instance.
	 * @constructor
	 */
	function Loader(src, owner) {
		this.init(src, owner);
	}

	var p = Loader.prototype;

	// the request object for or XHR2 request
	p.request = null;

	p.owner = null;
	p.progress = -1;

	/**
	 * The source of the sound to load. Used by callback functions when we return this class.
	 * #property src
	 * @type {String}
	 */
	p.src = null;

	/**
	 * The original source of the sound, before it is altered with a basePath.
	 * #property src
	 * @type {String}
	 */
	p.originalSrc = null;

	/**
	 * The decoded AudioBuffer array that is returned when loading is complete.
	 * #property result
	 * @type {AudioBuffer}
	 * @protected
	 */
	p.result = null;

	// Calbacks
	/**
	 * The callback that fires when the load completes. This follows HTML tag naming.
	 * #property onload
	 * @type {Method}
	 */
	p.onload = null;

	/**
	 * The callback that fires as the load progresses. This follows HTML tag naming.
	 * #property onprogress
	 * @type {Method}
	 */
	p.onprogress = null;

	/**
	 * The callback that fires if the load hits an error.
	 * #property onError
	 * @type {Method}
	 * @protected
	 */
	p.onError = null;

	// constructor
	p.init = function (src, owner) {
		this.src = src;
		this.originalSrc = src;
		this.owner = owner;
	};

	/**
	 * Begin loading the content.
	 * #method load
	 * @param {String} src The path to the sound.
	 */
	p.load = function (src) {
		if (src != null) {
			// TODO does this need to set this.originalSrc
			this.src = src;
		}

		this.request = new XMLHttpRequest();
		this.request.open("GET", this.src, true);
		this.request.responseType = "arraybuffer";
		this.request.onload = createjs.proxy(this.handleLoad, this);
		this.request.onError = createjs.proxy(this.handleError, this);
		this.request.onprogress = createjs.proxy(this.handleProgress, this);

		this.request.send();
	};

	/**
	 * The loader has reported progress.
	 *
	 * <strong>Note</strong>: this is not a public API, but is used to allow preloaders to subscribe to load
	 * progress as if this is an HTML audio tag. This reason is why this still uses a callback instead of an event.
	 * #method handleProgress
	 * @param {Number} loaded The loaded amount.
	 * @param {Number} total The total amount.
	 * @protected
	 */
	p.handleProgress = function (loaded, total) {
		this.progress = loaded / total;
		this.onprogress != null && this.onprogress({loaded:loaded, total:total, progress:this.progress});
	};

	/**
	 * The sound has completed loading.
	 * #method handleLoad
	 * @protected
	 */
	p.handleLoad = function () {
		this.owner.context.decodeAudioData(this.request.response,
			createjs.proxy(this.handleAudioDecoded, this),
			createjs.proxy(this.handleError, this));
	};

	/**
	 * The audio has been decoded.
	 * #method handleAudioDecoded
	 * @protected
	 */
	p.handleAudioDecoded = function (decodedAudio) {
		this.progress = 1;
		this.result = decodedAudio;
		this.src = this.originalSrc;
		this.owner.addPreloadResults(this.src, this.result);
		this.onload && this.onload();
	};

	/**
	 * Errors have been caused by the loader.
	 * #method handleError
	 * @protected
	 */
	p.handleError = function (evt) {
		this.owner.removeSound(this.src);
		this.onerror && this.onerror(evt);
	};

	p.toString = function () {
		return "[WebAudioPlugin Loader]";
	};

	createjs.WebAudioPlugin.Loader = Loader;

}());



;function gatewayCall(action, data, callback){

	var url = staticContentUrl + 'gateway/js.php?action=' + action + '&device=' + (isMobile ? 'mobile' : 'desktop') + '&demandware=' + isNotDemandWare + '&version=' + version,
		sendData = data;

	sendData.action = action;
	sendData.locale = locale;

	$.ajax(url, {
		type: 'GET',
		xhrFields: {
			withCredentials: true
		},
		crossDomain: true,
		data: sendData,
		success: function(rsp){
			callback(rsp);
		}
	});

};function tagPageView(id, category) {
	var newID, newCat;
	if(id.length > 50) {
		newID = id.substring(0, 50);
	} else {
		newID = id;
	}
	if(category.length > 50) {
		newCat = category.substring(0, 50);
	} else {
		newCat = category;
	}
	console.log('%c____tagPageView____', "color:red;", newID, newCat);
	if (typeof adidas !== 'undefined' && adidas.Analytics) {
		adidas.Analytics.tagPageView(newID, newCat);
	}
}

function tagConversionEvent(id, value, category, points) {
	var newID, newCat;
	if(id.length > 50) {
		newID = id.substring(0, 50);
	} else {
		newID = id;
	}
	if(category.length > 50) {
		newCat = category.substring(0, 50);
	} else {
		newCat = category;
	}
	console.log('%c____tagConversionEvent____', "color:blue;", newID, value, newCat, points);
	if (typeof adidas !== 'undefined' && adidas.Analytics) {
		adidas.Analytics.tagConversionEvent(newID, value, newCat, points);
	}
}

function tagPageElement(id, category) {
	var newID, newCat;
	if(id.length > 50) {
		newID = id.substring(0, 50);
	} else {
		newID = id;
	}
	if(category.length > 50) {
		newCat = category.substring(0, 50);
	} else {
		newCat = category;
	}
	console.log('%c____tagPageElement____', "color:green;", newID, newCat);
	if (typeof adidas !== 'undefined' && adidas.Analytics) {
		adidas.Analytics.tagPageElement(newID, newCat);
	}
}

function tagRegistration(id, category) {
	var newID, newCat;
	if(id.length > 50) {
		newID = id.substring(0, 50);
	} else {
		newID = id;
	}
	if(category.length > 50) {
		newCat = category.substring(0, 50);
	} else {
		newCat = category;
	}
	console.log('%c____tagRegistration____', "color:green;", newID, newCat);
	if (typeof adidas !== 'undefined' && adidas.Analytics) {
		adidas.Analytics.tagRegistration(newID, newCat, '', '', '');
	}
}

function tagLink(href, name, pageId) {
	if (typeof name === "undefined") { name = null; }
	if (typeof pageId === "undefined") { pageId = null; }
	console.log('%c____tagLink____', "color:pink;", href, name, pageId);
	if (typeof adidas !== 'undefined' && adidas.Analytics) {
		adidas.Analytics.tagLink(href, name, pageId);
	}
}



function addTrackingEvents(){

	$('[data-tagPageView]').each(function(i, elm){
		var data = $(elm).attr('data-tagPageView'),
			splittedData = data.split('::');

		tagPageView(splittedData[0], splittedData[1]);
	});

	$('body').on('click', '[data-tagPageElement]', function(e){
		var $elm = $(e.currentTarget),
			data = $elm.attr('data-tagPageElement');

		var multipleTagsSplit = data.split(',');

		console.log(multipleTagsSplit);

		for (var i = 0; i < multipleTagsSplit.length; i++) {
			var tag = multipleTagsSplit[i],
				splittedData = tag.split('::');

			tagPageElement(splittedData[0], splittedData[1]);
		}
	});

	var trackingPrefix = $('[data-stkprefix]').attr('data-stkprefix');
	if (typeof adistk !== 'undefined' && typeof adistk.tracking !== 'undefined' && trackingPrefix){
		adistk.tracking.prefix(trackingPrefix);
	}

};var ImageLoader = (function () {
    function ImageLoader(images) {
        var _this = this;
        this.images = images;
        this._loadStack = [];
        this._loaded = 0;
        setTimeout(function () {
            _this.createLoadStack();
        }, 0);
    }
    ImageLoader.IMAGELOADED = 'image_loaded';
	ImageLoader.prototype.onLoaded = function (cb) {
		this._onLoaded = cb;
	};
    ImageLoader.prototype.createLoadStack = function () {
        for(var i = 0; i < this.images.length; i++) {
            var image = this.images[i];
            switch(typeof image) {
                case 'string':
                    this.addToStack(image, false);
                    break;
                case 'object':
                    this.addToStack($(image).attr('src'), false);
                    break;
                default:
                    break;
            }
        }
        this.load();
    };
    ImageLoader.prototype.addToStack = function (value, doLoad) {
        if (typeof doLoad === "undefined") { doLoad = true; }
        this._loadStack.push(value);
        if(doLoad) {
            this.load();
        }
    };
    ImageLoader.prototype.load = function () {
        var _this = this;
        if(this._loadStack.length > 0 && this._loadStack.length > this._loaded) {
            for(var i = this._loaded; i < this._loadStack.length; i++) {
                var image = this._loadStack[i];
                (function (image) {
                    var loadingImg = new Image();
                    loadingImg.onload = function () {
                        _this.handleLoaded(loadingImg, image);
                    };
                    loadingImg.src = image;
                })(image);
            }
        } else if(this._loadStack.length === this._loaded) {
        	$(this).trigger(ImageLoader.IMAGELOADED);
	        if (typeof this._onLoaded !== 'undefined'){
		        this._onLoaded();
	        }
        }
    };
    ImageLoader.prototype.handleLoaded = function (image, src) {
        ++this._loaded;
        if(this._loaded === this._loadStack.length) {
	        $(this).trigger(ImageLoader.IMAGELOADED);
	        if (typeof this._onLoaded !== 'undefined'){
		        this._onLoaded();
	        }
        }
    };
    return ImageLoader;
})();;var ImageSequence = (function () {
    function ImageSequence($elm, options) {
        var _this = this;
        this.$elm = $elm;
        this._loaded = false;
        this._counter = {
            frame: 0
        };
        this._lastFrame = 0;
        this._options = {
            'sequence': '',
            'repeat': true,
            'fps': 25,
            'fpr': null,
            'totalFrames': 0,
            'autoLoad': true,
            'autoPlay': false,
            'horizontal': true
        };
        this._dimensions = {
            'x': 0,
            'y': 0
        };
        if(options && !options.sequence) {
            options.sequence = $elm.attr('data-sequence');
        }
        if(options && !options.totalFrames) {
            options.totalFrames = parseInt($elm.attr('data-sequence-frames'), 10);
        }
        if(options && !options.fpr && $elm.attr('data-sequence-fpr')) {
            options.fpr = parseInt($elm.attr('data-sequence-fpr'), 10);
        }
        if(options) {
            $.extend(this._options, options);
        }
        this.setDimensions();
        if(this._options.autoLoad) {
            this.load(function () {
                if(_this._options.autoPlay) {
					_this.start();
                }
            });
        }
        $elm.data('imgSequence', this);
    }
    ImageSequence.EVENT_LOADED = 'anim_loaded';
    ImageSequence.EVENT_START = 'anim_start';
    ImageSequence.EVENT_STOP = 'anim_stop';
    ImageSequence.EVENT_COMPLETE = 'anim_complete';
	ImageSequence.prototype.onEventStart = function(cb){
		this._onEventStart = cb;
	};
    ImageSequence.prototype.load = function (callback) {
        var _this = this;
        var loader = new ImageLoader([
            this._options.sequence
        ]);
	    loader.onLoaded(function(){
		    _this._loaded = true;
		    $(_this).trigger(ImageSequence.EVENT_LOADED);
		    _this.setBackground();
		    _this.setDimensions();
		    if(callback) {
			    callback();
		    }
	    });
        //$(loader).on(ImageLoader.IMAGELOADED, function() {

        //});
    };
    ImageSequence.prototype.setDimensions = function () {
        this._dimensions.x = this.$elm.width();
        this._dimensions.y = this.$elm.height();
    };
    ImageSequence.prototype.setBackground = function () {
        this.$elm.css('backgroundImage', 'url(' + this._options.sequence + ')');
    };
    ImageSequence.prototype.getBackgroundPosition = function (frame) {
        if(!frame) {
            frame = Math.floor(this._counter.frame);
        }
        var xPos = frame, yPos = 0;
        if(this._options.fpr !== null) {
            xPos = Math.max(0, ((frame - 1) % this._options.fpr));
            yPos = Math.max(0, Math.floor((frame - 1) / this._options.fpr));
        }
        var x = this._options.horizontal ? -(xPos * this._dimensions.x) + 'px' : '0', y = this._options.horizontal ? -(yPos * this._dimensions.y) + 'px' : -(frame * this._dimensions.y) + 'px';
        return x + ' ' + y;
    };
    ImageSequence.prototype.start = function () {
        var _this = this;
        if(!this._loaded) {
            this.load(function() {
                _this.animate();
            });
        } else {
            this.animate();
        }
    };
    ImageSequence.prototype.animate = function () {
        this.setDimensions();
        $(this).trigger(ImageSequence.EVENT_START);
	    if (typeof this._onEventStart !== 'undefined'){
		    this._onEventStart();
	    }
        TweenLite.to(this._counter, (this._options.totalFrames - this._counter.frame) / this._options.fps, {
            frame: this._options.totalFrames,
            onUpdate: this.update.bind(this),
            onComplete: this.complete.bind(this)
        });
    };
    ImageSequence.prototype.stop = function () {
	    $(this).trigger(ImageSequence.EVENT_STOP);
        TweenLite.killTweensOf(this._counter);
        this._counter.frame = 0;
        this.update();
    };
    ImageSequence.prototype.update = function () {
        var curFrame = Math.floor(this._counter.frame);
        if(this._lastFrame !== curFrame) {
            this.$elm.css('backgroundPosition', this.getBackgroundPosition());
        }
        this._lastFrame = curFrame;
    };
    ImageSequence.prototype.complete = function () {
	    $(this).trigger(ImageSequence.EVENT_COMPLETE);
        if(this._options.repeat) {
            this.stop();
            this.animate();
        }
    };
    ImageSequence.prototype.destruct = function () {
    };
    return ImageSequence;
})();;var SoundManager = (function () {
	function SoundManager(enabled) {
		if (typeof enabled === 'undefined') { enabled = true; }
		this._enabled = true;
		this._manifest = [
			/*
			{ id: 'ambient', src: 'bootselector_ambience_loop_normalized.ogg|bootselector_ambience_loop_normalized.mp3' },
			{ id: 'ambient_feature', src: 'feature_explorer_loop_normalized.ogg|feature_explorer_loop_normalized.mp3' },
			{ id: 'woosh', src: 'bootselector_scroll_woosh_loop_normalized.ogg|bootselector_scroll_woosh_loop_normalized.mp3' }
			*/
		];
		this._enabled = enabled;
		if(enabled) {
			this.init();
		}

		window['SoundManager'] = this;
	}
	SoundManager.prototype.init = function () {
		createjs.FlashPlugin.BASE_PATH = 'inc/swf/';
		createjs.Sound.registerPlugins([
			createjs.WebAudioPlugin,
			createjs.HTMLAudioPlugin,
			createjs.FlashPlugin
		]);
		createjs.Sound.registerManifest(this._manifest, staticContentUrl + 'data/audio/');
	};
	SoundManager.prototype.play = function (id, loop) {
		if(!this._enabled) {
			return null;
		}
		var options = {};
		if (loop){
			options.loop = 1000;
		}
		return createjs.Sound.play(id, options);
	};
	SoundManager.prototype.mute = function () {
		if(this._enabled) {
			createjs.Sound.setMute(true);
		}
	};
	SoundManager.prototype.unMute = function () {
		if(this._enabled) {
			createjs.Sound.setMute(false);
		}
	};
	SoundManager.prototype.setVolume = function (volume) {
		if(this._enabled) {
			createjs.Sound.setVolume(volume || 1)
		}
	};
	return SoundManager;
})();;var Carousel = (function(){

	Carousel.ACTIVECLASS = 'active';
	Carousel.CENTERITEMCLASS = 'item-center';
	Carousel.INITREADY = 'init_ready';

	function Carousel(wrapper, options){

		var _this = this;

		this._total = 0;
		this._active = 0;
		this._oldActive = 0;

		this.element = wrapper;

		this._options = {
			transitionDuration: 0.5,
			transitionEase: Power3.easeOut,
			transitionProp: 'left',
			canSwipe: false,
			disableLoop: false,
			addKeyEvents: true
		};

		$.extend(this._options, options);

		this.findItems();
		this.setActiveElements();

		$('[data-click-prev]', this.element).on('click', function(){
			_this.onPrevClick();
		});
		$('[data-click-next]', this.element).on('click', function(){
			_this.onNextClick();
		});
		$('[data-carousel-activate]', this.element).on('click', function(){
			_this.activate(parseInt($(this).attr('data-carousel-activate'), 10) - 1);
		});

		if (this._options.canSwipe){
			var swipeElm = $(this.element).find('[data-swipe-elm]')[0] || this.element;
			$(swipeElm).on('swipecustomleft', function(){
				_this.onNextClick();
			}).on('swipecustomright', function(){
				_this.onPrevClick();
			});
		}

		if (this._options.addKeyEvents){

			$(window).on('keyup', function(e){
				if (_this.inWindow()){
					if (e.keyCode == 37){
						_this.onPrevClick();
					}
					else if (e.keyCode == 39){
						_this.onNextClick();
					}
				}
			});

		}
	}

	Carousel.prototype = {

		onChange: function(cb){
			this._onChange = cb;
		},

		findItems: function(){
			this.$items = $(this.element).find('[data-carousel-item]');
			this._total = this.$items.length;
		},

		getDirection: function(){
			if(this._clickState === 'prev') {
				return -1;
			} else if(this._clickState === 'next') {
				return 1;
			}
			return this._active < this._oldActive ? -1 : 1;
		},

		slide: function(){
			var _this = this;
			var wrapper = $('[data-carousel-wrap]', this.element)[0] || this.element,
				tweenDuration = this._disableTween ? 0 : this._options.transitionDuration;

			var oldActive = this._oldActive;

			var $oldElement = $(this.$items[this._oldActive]).removeClass(Carousel.CENTERITEMCLASS),
				$newElement = $(this.$items[this._active]),
				nextCurrentPosition = this.getDirection() < 0 ? -1 : 1,
				oldNewPosition = this.getDirection() < 0 ? 1 : -1,
				elementWidth = $(wrapper).width();

			TweenLite.killTweensOf($oldElement);
			TweenLite.killTweensOf($newElement);
			TweenLite.set($oldElement, {
				'left': 0
			});
			TweenLite.set($newElement, {
				'left': elementWidth * nextCurrentPosition
			});
			TweenLite.to($oldElement, tweenDuration, {
				'left': elementWidth * oldNewPosition,
				ease: this._options.transitionEase
			});
			TweenLite.to($newElement, tweenDuration, {
				'left': 0,
				ease: this._options.transitionEase,
				onComplete: function () {
					_this.$items.removeClass(Carousel.ACTIVECLASS).removeAttr('style');
					$newElement.addClass(Carousel.ACTIVECLASS).addClass(Carousel.CENTERITEMCLASS).removeAttr('style');
				}
			});
			this._oldActive = this._active;
			this._disableTween = false;

			this.setActiveElements();

			if (typeof this._onChange !== 'undefined'){
				this._onChange(oldActive);
			}
		},

		setActiveElements: function(){
			var $activateElements = $('[data-carousel-activate]', this.element).removeClass('active');
			$($activateElements[this._active]).addClass('active');
		},

		onPrevClick: function(){
			this._clickState = 'prev';
			if(this._options.disableLoop && this._active === 0) {
				return null;
			}
			this._active = (this._active - 1 + this.$items.length) % this.$items.length;
			this.slide();
		},
		onNextClick: function(){
			this._clickState = 'next';
			if(this._options.disableLoop && this._active >= this.$items.length - 1) {
				return null;
			}
			this._active = (this._active + 1) % this.$items.length;
			this.slide();
		},
		activate: function(key, disableTween){
			if (typeof key === 'undefined') { key = this_active; }
			if (typeof disableTween === 'undefined') { disableTween = false; }
			if(disableTween === true) {
				this._disableTween = true;
			}
			this._oldActive = this._active;
			var currentActive = this._active;

			if (currentActive === key){ return; }
			if(key >= 0 && key <= this.$items.length) {
				this._clickState = this._active < key ? 'next' : 'prev';
				this._active = key;
				this.slide();
			} else if(key > this.$items.length) {
				this._clickState = 'prev';
				this._active = this.$items.length;
				this.slide();
			} else {
				this._clickState = 'next';
				this._active = 0;
				this.slide();
			}
			if(currentActive === this._active) {
				this._disableTween = false;
			}
		},
		inWindow: function(){
			var wrapper = $(this.element).find('[data-carousel-wrap]')[0] || this.element;
			var scrollPos = $(window).scrollTop(),
				itemHeight = $(wrapper).height(),
				startY = $(wrapper).offset().top,
				endY = startY + itemHeight,
				middleY = startY + (itemHeight / 2);
			return middleY - (itemHeight / 4) >= scrollPos && middleY + (itemHeight / 4) <= scrollPos + $(window).height();
		}

	};

	return Carousel;

})();;function buyArea(wrapper){
	var $wrapper = $(wrapper),
		$buyButton = $wrapper.find('.button'),
		$closeButton = $wrapper.find('.button-close'),
		$optionWrapper = $wrapper.find('.option-wrapper'),
		$optionWrapperLabel = $optionWrapper.find('.label'),
		$chosenSize = $wrapper.find('.size-chosen');

	var optionMouseTimeout;

	$buyButton.on('click', function(e){
		if (!$wrapper.hasClass('has-item')){
			e.preventDefault();
			$wrapper.addClass('add-clicked');
		}
	});
	$closeButton.on('click', function(e){
		e.preventDefault();
		$wrapper.removeClass('add-clicked');
	});

	$chosenSize.on('click', function(){
		$wrapper.addClass('add-clicked');
	});

	$optionWrapper.on('mouseenter', function(){
		clearTimeout(optionMouseTimeout);

	}).on('mouseleave', function(){
		optionMouseTimeout = setTimeout(function(){
			$wrapper.removeClass('choose-size-open');
		}, 300);
	});
	$optionWrapperLabel.on('click', function(e){
		e.preventDefault();
		$wrapper.toggleClass('choose-size-open');
		$wrapper.find('.scroll-wrapper').data('scrollbar').update();
	});

	$optionWrapper.find('.options').on('click', 'li', function(e){

		var $current = $(e.currentTarget);
		$wrapper.removeClass('add-clicked choose-size-open')
			.addClass('has-item');

		$chosenSize.text($current.text());

		$wrapper.attr('buy-id', $current.attr('data-id') || null);
	});
};var player;

var ytPlayVideoPlayers = {};

function playVideoClick(){
	$('[data-play-video]').on('click', function(e){
		var $target = $('#' + $(this).attr('data-play-video')),
			$parent = $target.parent();

		if (ytPlayVideoPlayers[$(this).attr('data-play-video')]){
			ytPlayVideoPlayers[$(this).attr('data-play-video')].playVideo();
		}
		else {
			var ytPlayer = new YT.Player($target.attr('id'), {
				height: '100%',
				width: '100%',
				videoId: $target.attr('data-video'),
				playerVars: {
					'autoplay': 1,
					'controls': 1,
					'modestbranding': 1,
					'color': 'white',
					'showinfo': 0,
					'rel': 0,
					'hd': 1,
					'iv_load_policy': 3
				},
				events: {
					'onReady': function(){
						$parent.addClass('video-initialized');
					},
					'onStateChange': function(state){
						if (state.data !== YT.PlayerState.PLAYING && state.data !== YT.PlayerState.PAUSED && !isMobile){
							$parent.removeClass('video-initialized');
						}
						else if (state.data !== YT.PlayerState.PLAYING && isMobile) {
							$parent.removeClass('video-initialized');
						}
						else if (state.data === YT.PlayerState.PLAYING){
							$parent.addClass('video-initialized');
						}
					}
				}
			});

			ytPlayVideoPlayers[$(this).attr('data-play-video')] = ytPlayer;
		}
	});

	$('[data-pause-video]').on('click', function(e){
		e.preventDefault();
		var targetVideo = $('#' + $(this).attr('data-pause-video'))[0];
		if (ytPlayVideoPlayers[$(this).attr('data-pause-video')]){
			ytPlayVideoPlayers[$(this).attr('data-pause-video')].pauseVideo();
			$(targetVideo).parent().removeClass('video-initialized');
		}
		else if (targetVideo){
			targetVideo.pause();
		}
	});
};var Scrollbar = (function () {
	function Scrollbar(element, options) {
		if (typeof options === "undefined") {
			options = {};
		};

		this.element = element;

		this._options = {
			horizontal: false,
			hideBar: false
		};
		this._isDragging = false;
		this._overflow = 0;
		$.extend(this._options, options);

		$(this.element).data('scrollbar', this);

		this.init();
	}
	Scrollbar.prototype.init = function () {
		this.$content = $('.scroll-content', this.element);
		this.$bar = $('.scroll-bar', this.element).last();
		this.$knob = $('.scroll-bar .knob', this.element).last();
		this.addEvents();
	};
	Scrollbar.prototype.addEvents = function () {
		var _this = this;
		$(window).on('resize.' + this.eventNamespace, function () {
			_this.update();
			_this.onScroll();
		});
		this.$content.on('scroll.' + this.eventNamespace, function () {
			_this.showKnob();
			_this.onScroll();
		});
		this.$bar.on('mouseenter.' + this.eventNamespace, function () {
			if(_this._options.hideBar) {
				_this.showKnob();
			}
		});
		this.$bar.on('mouseleave.' + this.eventNamespace, function () {
			if(!_this._isDragging && _this._options.hideBar) {
				_this.startHideKnob();
			}
		});
		this._dragInstance = Draggable.create(this.$knob[0], {
			bounds: this.$bar[0],
			type: this._options.horizontal ? 'x' : 'y',
			zIndexBoost: false,
			cursor: 'default',
			onDragStart: function () {
				_this._isDragging = true;
			},
			onDragEnd: function () {
				_this._isDragging = false;
			},
			onDrag: function () {
				_this.handleDrag();
			}
		})[0];
		this.hideKnob(true);
		this.update();
	};
	Scrollbar.prototype.handleDrag = function () {
		var max = this._options.horizontal ? this.$bar.width() - this.$knob.width() : this.$bar.height() - this.$knob.height(),
			percentage = (this.$knob.position()[this._options.horizontal ? 'left' : 'top'] / max);

		if (this._options.horizontal) {
			this.$content.scrollLeft(this._overflow * percentage);
		}
		else {
			this.$content.scrollTop(this._overflow * percentage);
		}
	};
	Scrollbar.prototype.update = function () {
		this._overflow = this._options.horizontal ? this.$content[0].scrollWidth - $(this.element).width() : this.$content[0].scrollHeight - $(this.element).height();
		this.resizeKnob();
		this._dragInstance.applyBounds();
		this.onScroll();
	};
	Scrollbar.prototype.onScroll = function () {
		var scrollPos = this._options.horizontal ? this.$content.scrollLeft() : this.$content.scrollTop(),
			percentage = (scrollPos / this._overflow),
			max = this._options.horizontal ? this.$bar.width() - this.$knob.width() : this.$bar.height() - this.$knob.height();

		var knobPos = {};
		if (this._options.horizontal)
		{
			knobPos.x = max * percentage;
		}
		else
		{
			knobPos.y = max * percentage;
		}

		TweenLite.set(this.$knob, knobPos);

		this.startHideKnob();
	};
	Scrollbar.prototype.resizeKnob = function () {
		if(!this._options.horizontal && $(this.element).height() > 0 && this.$content[0].scrollHeight > 0) {
			this.$knob.css({
				'height': Math.max(20, this.$bar.height() * ($(this.element).height() / this.$content[0].scrollHeight))
			});
		}
		else if (this._options.horizontal && $(this.element).width() > 0 && this.$content[0].scrollWidth > 0) {
			this.$knob.css({
				'width': Math.max(20, this.$bar.width() * ($(this.element).width() / this.$content[0].scrollWidth))
			});
		}

		if(!this._options.hideBar && this._overflow === 0) {
			TweenLite.to(this.$knob, 0.2, {
				opacity: 0
			});
		} else if(!this._options.hideBar && this._overflow !== 0) {
			TweenLite.to(this.$knob, 0.2, {
				opacity: 1
			});
		}
	};
	Scrollbar.prototype.showKnob = function () {
		if(this._options.hideBar && this._overflow > 0) {
			clearTimeout(this._hideTimer);
			this._dragInstance.enable();
			TweenLite.to(this.$bar, 0.2, {
				opacity: 1
			});
		}
	};
	Scrollbar.prototype.hideKnob = function (disableTween) {
		if (typeof disableTween === "undefined") { disableTween = false; }
		if(this._options.hideBar) {
			this._dragInstance.disable();
			TweenLite.to(this.$bar, disableTween ? 0 : 0.2, {
				opacity: 0
			});
		}
	};
	Scrollbar.prototype.startHideKnob = function () {
		var _this = this;
		if(this._options.hideBar) {
			clearTimeout(this._hideTimer);
			this._hideTimer = setTimeout(function () {
				_this.hideKnob();
			}, 800);
		}
	};
	Scrollbar.prototype.scrollTo = function (pos) {
		if (typeof pos === "undefined") { pos = 0; }
		if (this._options.horizontal){
			this.$content.scrollLeft(pos);
		}
		else {
			this.$content.scrollTop(pos);
		}
	};
	Scrollbar.prototype.destruct = function () {
		$(window).off(this.eventNamespace);
		this.$content.off(this.eventNamespace);
		if(this._dragInstance) {
			this._dragInstance.disable();
			this._dragInstance = null;
		}
		clearTimeout(this._hideTimer);
		_super.prototype.destruct.call(this);
	};
	return Scrollbar;
})();;var ScrollManager = (function(){

	ScrollManager.BLOCKS = {
		'ambassador': 'Ambassador',
		'interactive-boot': 'InteractiveBoot',
		'battle-pack': 'BattlePack',
		'gallery': 'Gallery',
		'apparel': 'Apparel',
		'video': 'Video',
		'explore-federations': 'ExploreFederations',
		'pushbox': 'Pushbox',
		'order-kit': 'OrderKit',
		'boot-selector': 'ScrollBootSelector'
	};

	function ScrollManager(){

		var _this = this;

		this._blocks = [];
		this._lastY = 0;

		this._targetY = 0;
		this._currentY = 0;
		this._running = false;

		$('[data-scroll-component]').each(function(i, elm){
			var name = $(elm).attr('data-scroll-component');
			if (name in ScrollManager.BLOCKS){
				var classFn = stringToObject(ScrollManager.BLOCKS[name]);
				var instance = new classFn(elm);
				instance.initialize();
				_this._blocks.push(instance);
			}
		});

		$(window).bind('scroll resize', $.proxy(this.handleScroll, this));
		this.handleScroll();

		requestAnimFrame($.proxy(this.onAnimationFrame, this));
	}

	ScrollManager.prototype = {

		onAnimationFrame: function(time){
			var diff = (this._targetY - this._currentY);
			this._currentY += diff / 6;

			this._dir = this._currentY >= this._lastY ? 'down' : 'up';

			for (var i = 0; i < this._blocks.length; i++) {
				this.updateBlockState(this._blocks[i]);
			}

			this._lastY = this._currentY;

			if (Math.abs(diff) > 0.0001)
			{
				requestAnimFrame($.proxy(this.onAnimationFrame, this));
			}
			else
			{
				//console.log(' >> STOP', this._currentY, this._targetY);
				this._running = false;
			}
		},

		easeToTime: function(y){
			this._targetY = y;

			if (!this._running)
			{
				//console.log(' >> START', this._currentY, this._targetY);
				this._running = true;
				requestAnimFrame($.proxy(this.onAnimationFrame, this));
			}
		},

		handleScroll: function(){
			this.easeToTime($(window).scrollTop());
		},

		updateBlockState: function(block){
			var progress = block.getProgress(this._currentY);
			var currentState = block.getState();

			var newState = progress > 0 && progress < 1 ? ScrollAbstract.STATE_ENTER : ScrollAbstract.STATE_OUT;

			if (currentState == ScrollAbstract.STATE_OUT && newState != ScrollAbstract.STATE_OUT){
				block.setState(ScrollAbstract.STATE_ENTER, this._currentY);
			}
			else if (currentState != ScrollAbstract.STATE_OUT && newState == ScrollAbstract.STATE_OUT){
				block.setState(ScrollAbstract.STATE_OUT, this._currentY);
			}

			// Center Check
			if (newState != ScrollAbstract.STATE_OUT && currentState != ScrollAbstract.STATE_CENTER){
				if (
					(block._enteredFrom == 'up' && progress > 0.4) || 
					(block._enteredFrom == 'down' && progress < 0.53)
				){
					block.setState(ScrollAbstract.STATE_CENTER, this._currentY);
				}
			}

			if (newState != ScrollAbstract.STATE_OUT){
				block.handleScroll(progress);
			}

		}

	};

	return ScrollManager;

})();


window.requestAnimFrame = (function(){
	return window.requestAnimationFrame ||
		window.webkitRequestAnimationFrame ||
		window.mozRequestAnimationFrame ||
		function( callback ){
			window.setTimeout(callback, 1000 / 60);
		};
})();;var _extends = function (d, b) {
	function __() { this.constructor = d; }
	__.prototype = b.prototype;
	d.prototype = new __();
};

var ScrollAbstract = (function(){

	function ScrollAbstract(){}

	ScrollAbstract.STATE_ENTER = 'enter';
	ScrollAbstract.STATE_CENTER = 'center';
	ScrollAbstract.STATE_OUT = 'out';

	ScrollAbstract.prototype = {

		initialize: function(){
			this._state = ScrollAbstract.STATE_OUT;

			this.setOffset();
			$(window).bind('resize', $.proxy(this.setOffset, this));
		},

		getState: function(){ return this._state; },

		setState: function(state, y){
			this._state = state;

			switch (this._state){
				case ScrollAbstract.STATE_ENTER: {
					this._enteredFrom = this.getProgress(y) < 0.5 ? 'up' : 'down';
					this.enter();
					break;
				}
				case ScrollAbstract.STATE_CENTER: {
					this.center();
					break;
				}
				case ScrollAbstract.STATE_OUT: {
					this.out();
					break;
				}
			}
		},

		enter: function(){},
		center: function(){},
		out: function(){},

		setOffset: function(){
			this._start = $(this.wrapper).position().top;
			this._height = $(this.wrapper).outerHeight();
			this._end = this._start + this._height;

			this._scrolls = {
				top: this._start - window.innerHeight,
				bottom: this._end
			}
		},

		getProgress: function(y){
			if (typeof y === 'undefined'){ y = $(window).scrollTop(); }
			return Math.max(0, Math.min(1, (y - this._scrolls.top) / (this._scrolls.bottom - this._scrolls.top)));
		},

		handleScroll: function(progress){},

		isScrollTop: function(){},

		isScrollCenter: function(){},

		isScrollBottom: function(){}

	};

	return ScrollAbstract;

})();;var Ambassador = (function(){

	_extends(Ambassador, ScrollAbstract);

	function Ambassador(elm){

		var _this = this;

		this.wrapper = elm;

		this.autoPlayTl = new TimelineLite();
		this.mainTl = new TimelineLite();

		var introLinesTween = [];
		$('.main-title, .title .heading-04, .title .button', this.wrapper).each(function(i, elm){
			introLinesTween.push(TweenLite.from(elm, 0.6, { x: 50, opacity: 0, delay: i * 0.1, ease: Power3.easeOut }));
		});
		this.autoPlayTl.add(introLinesTween);
		this.autoPlayTl.pause();

		$('.title', this.wrapper).removeClass('invisible');

		var mainTweenItems = [];
		$('.intro-copy .heading-02, .intro-copy .copy-04', this.wrapper).each(function(i, elm){
			mainTweenItems.push(TweenLite.from(elm, 1.5, { x: 50, opacity: 0, delay: i * 0.3, ease: Power3.easeOut }));
		});
		this.mainTl.add(mainTweenItems);

		this.mainTl.add(TweenLite.to($('.title', this.wrapper), 3, { y: 50 }), '-=1');
		this.mainTl.add(TweenLite.to($('.anim-frame', this.wrapper), 3, { y: -100 }), '-=3.6');
		this.mainTl.add(TweenLite.to($('.intro-copy', this.wrapper), 3, { y: -50 }), '-=4');

		this.mainTl.pause();

		if (!isiPad)
		{
			var sequence = new ImageSequence($('[data-sequence]', elm), {
				'autoPlay': true,
				'repeat': false,
				'fps': 14
			});
			sequence.onEventStart(function(){
				_this.autoPlayTl.play();
			});
			/*
			$(sequence).on(ImageSequence.EVENT_START, function(){
				_this.autoPlayTl.play();
			});
			*/
		}
		else
		{
			setTimeout(function(){
				_this.autoPlayTl.play();
			}, 300);
		}
	}

	Ambassador.prototype.handleScroll = function(progress){
		this.mainTl.seek(Math.max(0, (progress * (1 / 0.5) - 0.9) * this.mainTl.duration()));
	};

	return Ambassador;

})();;var ScrollBootSelector = (function(){

	_extends(ScrollBootSelector, ScrollAbstract);

	function ScrollBootSelector(elm){

		var _this = this;

		this.wrapper = elm;

		this._elementsHidden = false;
		this._videoPlayed = false;
	}

	ScrollBootSelector.prototype.center = function(){
		if (!this._videoPlayed){
			playBootSelectorIntroVideo();
			this._videoPlayed = true;
		}

		if (!this._elementsHidden){
			var _this = this;
			setTimeout(function(){
				TweenLite.to($('.title, .read-more', _this.wrapper), 0.6, { 'autoAlpha': 0 });
			}, 3000);
			this._elementsHidden = true;
		}
	};

	return ScrollBootSelector;

})();;var InteractiveBoot = (function(){

	_extends(InteractiveBoot, ScrollAbstract);

	function InteractiveBoot(elm){

		var _this = this;

		this.wrapper = elm;

		this._videoPlayed = false;
		this._videoCompleted = false;
		this._soundStarted = false;

		this._volume = typeof defaultVolume !== 'undefined' ? defaultVolume : 0.5;

		if (!instances.soundManager){
			instances.soundManager = new SoundManager();
		}

		this._soundTween = {
			volume: this._volume
		};

		if (isiPad){
			$('.video-wrap', this.wrapper).remove();
			$('.replay-icon', this.wrapper).remove();
		}
		this.$video = $('video', elm);

		if (this.$video[0]){
			this.$video[0].volume = this._volume;
			this.$video.on('play', function(){
				_this.$video.parent().addClass('video-playing');
			});
			this.$video.on('ended', function(){
				_this.$video.parent().addClass('completed');
				_this.mainTl.play();

				_this.$replayIcon.removeClass('hidden');

				_this._videoCompleted = true;
				_this._soundStarted = true;
				if (_this.ambient){
					_this.ambient.play();
				}
				else {
					_this.ambient = SoundManager.play('ambient_feature', true);
				}
				if (_this._isMuted){
					SoundManager.mute();
				}
				else {
					SoundManager.unMute();
				}
			});
		}

		$('.button-play', elm).on('click', function(e){
			e.preventDefault();

			_this.startVideo();
		});

		this.mainTl = new TimelineLite({
			onStart: function(){
				if ($(_this.wrapper).hasClass('scrollto-complete')) {
					TweenLite.to(window, 0.3, { scrollTo:{ y: $(_this.wrapper).offset().top } });
				}
			},
			onComplete: function(){
				$('.areas > li', _this.wrapper).addClass('has-mouseovers');
				$(_this.wrapper).addClass('has-mousemove');
			}
		});
		if (!$(this.wrapper).hasClass('no-fade')){
			this.mainTl.add(TweenLite.from($('.bg-image', this.wrapper), 1, { opacity: 0 }));
		}
		this.mainTl.add(TweenLite.from($('.buy-module', this.wrapper), 0.5, { opacity: 0, y: 60 }), '+=0.5');

		var mainTweenItems = [];
		$('.areas .label', this.wrapper).each(function(i, elm){
			mainTweenItems.push(TweenLite.from(elm, 0.2, {
				y: 100,
				opacity: 0,
				delay: i * 0.1,
				ease: Power3.easeOut
			}));
		});
		this.mainTl.add(mainTweenItems);
		this.mainTl.pause();

		this._isMuted = false;

		this.$replayIcon = $('.replay-icon', this.wrapper);
		this.$replayIcon.on('click', function(){

			_this._videoCompleted = false;
			_this._soundStarted = false;

			_this.$replayIcon.addClass('hidden');
			_this.$video.parent().removeClass('completed');

			_this.mainTl.seek(0);

			_this.ambient.pause();

			if (_this._isMuted){
				_this.$video[0].volume = 0;
			}

			_this.$video[0].currentTime = 0;
			_this.$video[0].play();

		});

		this.$soundIcon = $('.sound-icon', this.wrapper);
		this.$soundIcon.on('click', function(){
			if (_this._soundStarted){
				if (_this._isMuted){
					SoundManager.unMute();
				}
				else {
					SoundManager.mute();
				}
			}
			else {
				_this.$video[0].volume = !_this._isMuted ? 0 : _this._volume;
			}
			_this.$soundIcon.toggleClass('muted');
			_this._isMuted = !_this._isMuted;
		});
	}

	InteractiveBoot.prototype.center = function(){

		if ($(this.wrapper).hasClass('scrollto-complete')) {
			TweenLite.to(window, 0.3, { scrollTo:{ y: $(this.wrapper).offset().top } });
		}

		this.startVideo();
	};

	InteractiveBoot.prototype.startVideo = function(){
		if (this.$video[0]){
			if (!this._videoPlayed){

				this._videoPlayed = true;
				if (!$('html').hasClass('lt-ie9')){
					this.$video[0].play();

					if ($(this.wrapper).attr('data-trackstart')){
						var data = $(this.wrapper).attr('data-trackstart').split('::');
						tagPageElement(data[0], data[1]);
					}
				}
				else {
					this.$replayIcon.removeClass('hidden');
					this.$video.parent().addClass('completed');
					this.mainTl.play();
				}
			}
		}
		else {
			this.$replayIcon.removeClass('hidden');
			$(this.wrapper).parent().addClass('completed');
			this.mainTl.play();

			if (this.ambient){
				this.ambient.play();
			}
			else {
				this.ambient = SoundManager.play('ambient_feature', true);
			}

			this._soundStarted = true;
		}

		this.$soundIcon.removeClass('hidden');
	};

	InteractiveBoot.prototype.enter = function(){
		if (this._soundStarted && !this._isMuted){
			//SoundManager.unMute();
			this.ambient.setVolume(0);
			this.tweenSoundOn();
		}
		if (this._videoPlayed && !this._videoCompleted && !$('html').hasClass('lt-ie9')){
			this.$video[0].play();
		}
	};

	InteractiveBoot.prototype.out = function(){
		this.tweenSoundOff();

		if (!this._videoCompleted && this.$video[0]){
			this.$video[0].pause();
		}
	};

	InteractiveBoot.prototype.tweenSoundOn = function(){

		var _this = this;
		if (this._soundStarted && !this._isMuted){
			TweenLite.to(this._soundTween, 1, { volume: _this._volume, onUpdate: function(){
				_this.ambient.setVolume(_this._soundTween.volume);
			} });
		};
	};

	InteractiveBoot.prototype.tweenSoundOff = function(){

		var _this = this;
		if (this._soundStarted && !this._isMuted){
			TweenLite.to(this._soundTween, 1, { volume: 0, onUpdate: function(){
				_this.ambient.setVolume(_this._soundTween.volume);
			} });
		};
	};

	/*
	 InteractiveBoot.prototype.handleScroll = function(progress){
	 //this.mainTl.seek(Math.max(0, (progress * (1 / 0.55) - 0.05)) * this.mainTl.duration());
	 //this.mainTl.seek(Math.max(0, (progress * (1 / 0.55) - 0)) * this.mainTl.duration());
	 };
	 */

	return InteractiveBoot;

})();;var BattlePack = (function(){

	_extends(BattlePack, ScrollAbstract);

	function BattlePack(elm){

		var _this = this;

		this.wrapper = elm;

		this.mainTl = new TimelineLite();

		this.mainTl.add(TweenLite.from($('.page-subhead', this.wrapper), 1.5, { opacity: 0, y: 100 }));

		var mainTweenItems = [];
		$('.anim-list > li', this.wrapper).each(function(i, elm){
			mainTweenItems.push(TweenLite.from(elm, 1, {
				scale: 0,
				opacity: 0,
				delay: i * 0.3,
				ease: Power3.easeOut
			}));
			mainTweenItems.push(TweenLite.from($(elm).find('.title'), 0.65, {
				opacity: 0,
				y: 50,
				delay: i * 0.3 + 1
			}));

			if ($(elm).find('.learn-more')) {
				mainTweenItems.push(TweenLite.from($(elm).find('.learn-more'), 1, {
					opacity: 0,
					y: 100,
					delay: i * 0.3 + 1.5
				}));
			}
		});
		this.mainTl.add(mainTweenItems);
		this.mainTl.pause();
	}

	BattlePack.prototype.handleScroll = function(progress){
		this.mainTl.seek(Math.max(0, (progress * (1 / 0.5) - 0)) * this.mainTl.duration());
	};

	return BattlePack;

})();;var Gallery = (function(){

	_extends(Gallery, ScrollAbstract);

	function Gallery(elm){

		var _this = this;

		this.wrapper = elm;

		this.mainTl = new TimelineLite();

		this.mainTl.add(TweenLite.from($('.items-wrapper', this.wrapper), 2, { opacity: 0, y: -400 }));
		this.mainTl.pause();
	}

	Gallery.prototype.handleScroll = function(progress){
		this.mainTl.seek(Math.max(0, (progress * (1 / 0.4) - 0)) * this.mainTl.duration());
	};

	return Gallery;

})();;var Apparel = (function(){

	_extends(Apparel, ScrollAbstract);

	function Apparel(elm){

		var _this = this;

		this.wrapper = elm;

		this.mainTl = new TimelineLite();

		var $items = $('.col', this.wrapper);

		if (!isiPad){
			if ($(this.wrapper).hasClass('app-brazuca'))
			{
				this.mainTl.add(TweenLite.from($items[0], 1, { marginLeft: '-50%' }));
				this.mainTl.add(TweenLite.from($items[1], 1, { marginLeft: '-50%' }), '-=0.5');
				this.mainTl.add(TweenLite.from($items[2], 1, { marginLeft: '-50%' }), '-=0.5');
				this.mainTl.add(TweenLite.from($items[3], 1, { marginLeft: '-100%' }), '-=0.5');
			}
			else
			{
				if ($(this.wrapper).hasClass('app-federation'))
				{
					this.mainTl.add(TweenLite.from($items[0], 1, { marginLeft: '-25%' }));
					this.mainTl.add(TweenLite.from($items[1], 1, { marginLeft: '-25%' }), '-=0.5');
					this.mainTl.add(TweenLite.from($items[2], 1, { marginLeft: '-50%' }), '-=0.5');
				}
				else
				{
					this.mainTl.add(TweenLite.from($items[0], 1, { marginLeft: '-125%' }));
					this.mainTl.add(TweenLite.from($items[1], 1, { marginLeft: '-25%' }), '-=0.5');
					this.mainTl.add(TweenLite.from($items[2], 1, { marginLeft: '-25%' }), '-=0.5');
				}
				this.mainTl.add(TweenLite.from($('figure', $items[3]), 1, { top: '-100%' }), '-=0.5');
				this.mainTl.add(TweenLite.from($('figure', $items[4]), 1, { top: '-100%' }), '-=0.5');
				this.mainTl.add(TweenLite.from($('figure', $items[5]), 1, { top: '-100%' }), '-=0.5');
			}
		}
		this.mainTl.pause();
	}

	Apparel.prototype.handleScroll = function(progress){
		this.mainTl.seek(Math.max(0, (progress * (1 / 0.5) - 0)) * this.mainTl.duration());
	};

	return Apparel;

})();;var Video = (function(){

	_extends(Video, ScrollAbstract);

	function Video(elm){

		var _this = this;

		this.wrapper = elm;

		this.mainTl = new TimelineLite();

		if (!isiPad){
			this.mainTl.add(TweenLite.from(this.wrapper, 2, { opacity: 0, y: 200 }));
		}
		this.mainTl.pause();
	}

	Video.prototype.handleScroll = function(progress){
		this.mainTl.seek(Math.max(0, (progress * (1 / 0.25) - 0)) * this.mainTl.duration());
	};

	return Video;

})();;var monthKeys = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'],
	countries = [],
	consentData = [],
	parentConsent = false,
	$newsletterWrapper,
	$newsletterForm,
	$consentElement,
	currentMarket = '',
	currentCountry,
	currentConsent,
	validationFailedClass = 'validation-failed',
	/*
	errorMessages = {
		'required': 'validation_required',
		'non_valid_email': 'validation_email',
		'min_age': 'validation_error_age',
		'call': 'something_went_wrong'
	},
	*/
	secondLayerOpen = false;

function initNewsletterForm(){
	$newsletterWrapper = $('.popup-newsletter');

	if ($newsletterWrapper[0]){
		$newsletterForm = $('.form-newsletter');
		$consentElement = $newsletterForm.find('.parent-consent');

		fillSelects();

		$newsletterForm.find('select').on('change', selectChange);
		checkParentConsent();

		$newsletterForm.on('submit', submitForm);

		$newsletterForm.find('.first-layer').on('click', 'a', function(e){
			e.preventDefault();

			if (currentConsent['second_layer']){
				openSecondLayer();
			}
			else {
				window.open(currentCountry['privacy_policy']);
			}
		});

		$newsletterWrapper.find('.close').on('click', function(e){
			e.preventDefault();
			if (secondLayerOpen){
				closeSecondLayer();
			}
			else {
				closeNewsletterPopup();
			}
		});

		if ($.placeholder)

		$('input, textarea').placeholder();

		/*
		var $termsLabel = $newsletterForm.find('.set-terms-link');
		$termsLabel.html(instances.localeManager.getString($termsLabel.attr('data-translate-custom')).replace('{terms}', '<a href="#">' + instances.localeManager.getString('defaults.terms_conditions') + '</a>'));
		*/
	}
}

function validateEmail($inp){
	return new RegExp( '^[a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$', 'i' ).test($inp.val()) || $inp.val() == $inp.attr('placeholder');
}

function submitForm(e){
	e.preventDefault();

	var errors = [];
	var minAge = 16;
	if (currentConsent){
		minAge = currentConsent['min_age'];
	}

	var $emailInput = $newsletterForm.find('input[name="email"]'),
		$daySelect = $newsletterForm.find('select[name="day"]'),
		$monthSelect = $newsletterForm.find('select[name="month"]'),
		$yearSelect = $newsletterForm.find('select[name="year"]'),
		$countrySelect = $newsletterForm.find('select[name="country"]'),
		$termsInput = $newsletterForm.find('input[name="terms"]'),
		$useDataInput = $newsletterForm.find('input[name="use-data"]'),
		$parentConsentInput = $newsletterForm.find('input[name="parent-consent"]'),
		$messiIdInput = $newsletterForm.find('input[name="messi-id"]');

	if ($emailInput.val().length === 0 || !validateEmail($emailInput)){
		$emailInput.addClass(validationFailedClass);

		errors.push('email');
	}
	else {
		$emailInput.removeClass(validationFailedClass);
	}

	var day = $daySelect.val(),
		month = $monthSelect.val(),
		year = $yearSelect.val();

	if (day.length > 0 && month.length > 0 && year.length > 0){
		var dob = year + '/' + month + '/' + day,
			age = getAge(dob);

		if (age < minAge){
			errors.push('dob-min');
		}
	}
	else {
		errors.push('dob');
	}

	if ($countrySelect.val().length == 0){
		errors.push('country');
	}

	/*
	if (typeof $termsInput.attr('checked') == 'undefined'){
		$termsInput.parent().addClass(validationFailedClass);
		errors.push('terms');
	}
	else {
		$termsInput.parent().removeClass(validationFailedClass);
	}
	*/

	if (typeof $useDataInput.attr('checked') == 'undefined'){
		$useDataInput.parent().addClass(validationFailedClass);
		errors.push('use-data');
	}
	else {
		$useDataInput.parent().removeClass(validationFailedClass);
	}

	if (typeof $parentConsentInput.attr('checked') == 'undefined' && parentConsent){
		$parentConsentInput.parent().addClass(validationFailedClass);
		errors.push('parent-consent');
	}
	else {
		$parentConsentInput.parent().removeClass(validationFailedClass);
	}

	$newsletterForm.find('.errors span').remove();

	if (errors.length === 0){

		if (typeof tagPageElement !== 'undefined'){
			//id, value, category, points
			var pageElementTag = $newsletterWrapper.attr('data-tagCompletePageElement').split('::');
			if (pageElementTag.length > 0){
				tagPageElement(pageElementTag[0], pageElementTag[1]);
			}
		}

		var url = staticContentUrl + 'gateway/js.php?action=CRM.register',
			crmVO = {};

		crmVO._explicitType = 'crmVO';
		crmVO.country = $countrySelect.val();
		crmVO.email = $emailInput.val();
		crmVO.dateOfBirth = year + '-' + str_pad(month, 2, '0', 'STR_PAD_LEFT') + '-' + str_pad(day, 2, '0', 'STR_PAD_LEFT');
		crmVO.optIn = typeof $useDataInput.attr('checked') !== 'undefined' ? true : false;
		crmVO.terms = typeof $termsInput.attr('checked') !== 'undefined' ? true : false;
		crmVO.parentalConsent = typeof $parentConsentInput.attr('checked') !== 'undefined' ? true : false;

		if ($messiIdInput[0]){
			crmVO.messi = true;
		}

		$.ajax(url, {
			type: 'GET',
			xhrFields: {
				withCredentials: true
			},
			crossDomain: true,
			data: {
				'action': 'CRM.register',
				'crmVO': crmVO
			},
			success: function(rsp){
				if (rsp.success && rsp.data.result) {
					$newsletterForm.addClass('form-send');

					if (typeof tagRegistration !== 'undefined'){
						tagRegistration(rsp.data.UID, crmVO.email);
					}

					if (typeof tagConversionEvent !== 'undefined'){
						//id, value, category, points
						var conversionTag = $newsletterWrapper.attr('data-tagConversionEvent').split('::');
						if (conversionTag.length > 0){
							tagConversionEvent(conversionTag[0], 2, conversionTag[1], '');
						}
					}
				}
				else {
					console.log('error');

					setErrorMessage('call', 'call');
				}
			}
		});

		console.log(crmVO, url);

	}
	else {
		console.log(errors);

		for (var i = 0; i < errors.length; i++) {
			var error = errors[i];

			switch (error) {
				case 'email': {
					if ($emailInput.val().length > 0) {
						setErrorMessage('email', 'non_valid_email');
					}
					else {
						setErrorMessage('email', 'required');
					}
					break;
				}
				case 'country': {
					setErrorMessage('country', 'required');
					break;
				}
				case 'dob':
				case 'dob-min': {
					setErrorMessage('dob', 'min_age', 'age', minAge);
					break;
				}
			}
		}
	}
}

function openNewsletterPopup(){
	$('.popup-mask').addClass('show');
	$newsletterWrapper.addClass('show');

	if (typeof tagConversionEvent !== 'undefined'){
		//id, value, category, points
		var conversionTag = $newsletterWrapper.attr('data-tagConversionEvent').split('::');
		if (conversionTag.length > 0){
			tagConversionEvent(conversionTag[0], 1, conversionTag[1], '');
		}
	}
}

function closeNewsletterPopup(){
	$('.popup-mask').removeClass('show');
	$newsletterWrapper.removeClass('show');
}

function openSecondLayer(){
	$newsletterWrapper.find('.second-layer-wrapper').addClass('show');
	secondLayerOpen = true;
}

function closeSecondLayer(){
	$newsletterWrapper.find('.second-layer-wrapper').removeClass('show');
	secondLayerOpen = false;
}

function setErrorMessage(field, message, replaceField, replaceValue){
	$newsletterForm.find('.errors-' + field + ' span').remove();
	var errorText = errorMessages[message];//,
		//errorText = instances.localeManager.getString('defaults.' + error);

	if (replaceField && replaceValue){
		errorText = errorText.replace('{' + replaceField + '}', replaceValue);
	}

	$newsletterForm.find('.errors-' + field).append('<span>' + errorText + '</span>');
}

function fillSelects(){
	var $daySelect = $newsletterForm.find('select[name="day"]'),
		$monthSelect = $newsletterForm.find('select[name="month"]'),
		$yearSelect = $newsletterForm.find('select[name="year"]'),
		$countrySelect = $newsletterForm.find('select[name="country"]');

	for(var i = 0; i < 31; i++) {
		$daySelect.append('<option value="' + (i + 1) + '">' + (i + 1) + '</option>');
	}
	for(var i = 0; i < 100; i++){
		$yearSelect.append('<option value="' + (2014 - i) + '">' + (2014 - i) + '</option>');
	}
	/*
	for(var i = 0; i < monthKeys.length; i++) {
		$monthSelect.append('<option value="' + (i + 1) + '">' + (monthKeys[i]) + '</option>');
		//$monthSelect.append('<option value="' + (i + 1) + '">' + (instances.localeManager.getString('defaults.months.' + monthKeys[i])) + '</option>');
	}
	*/

	getData(function(){
		for (var i = 0; i < countries.length; i++) {
			var country = countries[i];
			$countrySelect.append('<option value="' + (country.market) + '">' + (country.name) + '</option>');
		}
	});
}

function getData(callback){

	$.ajax(staticContentUrl + 'inc/json/legal_consent.json' + '?device=' + (isMobile ? 'mobile' : 'desktop') + '&demandware=' + isNotDemandWare + '&locale=' + locale + '&version=' + version, {
		dataType: 'json',
		xhrFields: {
			withCredentials: true
		},
		crossDomain: true,
		success: function(response) {

			consentData = response.consents;
			countries = response.markets;

			callback();

		}
	});

}

function setCurrentCountry(){
	for (var i = 0; i < countries.length; i++) {
		var country = countries[i];
		if (country.market == currentMarket){
			currentCountry = country;
			return;
		}
	}
}

function setCurrentConsent(){
	setCurrentCountry();

	for (var i = 0; i < consentData.length; i++) {
		var consent = consentData[i];
		if (consent.id == currentCountry['consent_id']){
			currentConsent = consent;

			setFormText();
		}
	}
}

function setFormText(){

	$newsletterForm.find('.first-layer .lbl').html(currentConsent['first_layer']);

	$newsletterWrapper.find('.second-layer-wrapper').html();
	if (currentConsent['second_layer']){
		$newsletterWrapper.find('.second-layer-wrapper').html(currentConsent['second_layer']);

		$newsletterWrapper.find('.second-layer-wrapper').on('click', '.privacy-policy', function(e){
			e.preventDefault();

			window.open(currentCountry['privacy_policy']);
		});
	}

	if(currentConsent['parental_consent'] != 'undefined'){
		$newsletterForm.find('.parent-consent .lbl').html(currentConsent['parental_consent']);
	}

}

function selectChange(e){

	$(e.currentTarget).parent().find('.label').text($(e.currentTarget).find('option:selected').text());

	var $countrySelect = $newsletterForm.find('select[name="country"]'),
		market = $countrySelect.val();

	if (market !== currentMarket){
		currentMarket = market;
		setCurrentConsent();
	}

	checkParentConsent();
}

function checkParentConsent(){

	if (currentMarket.length > 0){
		$newsletterForm.find('.first-layer').css('display', 'block');

		var $daySelect = $newsletterForm.find('select[name="day"]'),
			$monthSelect = $newsletterForm.find('select[name="month"]'),
			$yearSelect = $newsletterForm.find('select[name="year"]'),
			day = $daySelect.val(),
			month = $monthSelect.val(),
			year = $yearSelect.val();

		if(month.length == 1) {
			month = '0' + month;
		}

		if (year.length > 0 && month.length > 0 && day.length > 0 && currentConsent['max_age']){
			var dob = year + '/' + month + '/' + day,
				age = getAge(dob);

			if(age >= currentConsent['min_age'] && age <= currentConsent['max_age']) {
				parentConsent = true;
			} else {
				parentConsent = false;
			}
		}
		else {
			parentConsent = false;
		}
	}
	else {
		$newsletterForm.find('.first-layer').css('display', 'none');
	}

	if (parentConsent){
		$consentElement.css('display', 'block');
	}
	else {
		$consentElement.css('display', 'none');
	}

}

function getAge(dateString) {
	var today = new Date();
	var birthDate = new Date(dateString);
	var age = today.getFullYear() - birthDate.getFullYear();
	var m = today.getMonth() - birthDate.getMonth();
	if(m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
		age--;
	}
	return age;
};var instances = instances || {},    // Instances Object
	drag,                           // Drag Instance
	$wrapper,
	$introVideo,
	$img,                           // Image for the Sequence
	$backImg,                       // Image for the Sequence
	$scrollElm,                     // Draggable Element
	$progressWrap,                  // Progress Wrapper
	$bar,                           // Progress Bar
	$skip,
	$replayIcon,
	$soundIcon,
	totalImages = 600,              // Images Amount
	loaded = 0,                     // Loaded Images Count
	startDragActive = -1,           // Active on Start Drag
	active = -1,                    // Active Slide
	snap = [60, 180, 300, 420, 540],// Snap Frame Points
	buttonTl,                       // Timeline for button tween
	soundTl,                        // Timeline for sound woosh
	wooshSound,                     // Woosh Sound
	shapeAnim,
	//textAnim,
	loadStarted = false,
	sound,
	$preloaderBar,
	images = [],
	canvasContext,
	currentButtonProgress,
	targetButtonProgress,
	videoPlaying = true,
	isMuted = false;

var msie = window.navigator.userAgent.indexOf('MSIE ') > 0 ? true : false;

$('window').ready(function()
{
	$wrapper = $('.boot-selector');

	if (!$wrapper[0]){ return; }

	$replayIcon = $wrapper.find('.replay-icon');

	if ($wrapper.hasClass('no-messi')){
		snap.pop();
		totalImages = 480;
	}

	if (!instances.soundManager){
		instances.soundManager = new SoundManager();
	}
	SoundManager.setVolume(0.5);

	currentButtonProgress = 0;
	targetButtonProgress = 0;

	sound = { volume: 0 };

	$preloaderBar = $wrapper.find('.preloader-bar');

	$introVideo = $wrapper.find('.intro-video');
	$introVideo.on('play', function(){
		$wrapper.find('.button-play').hide();

		if ($wrapper.attr('data-trackstart') && tagPageElement !== 'undefined'){
			var data = $wrapper.attr('data-trackstart').split('::');
			tagPageElement(data[0], data[1]);
		}
	});
	$introVideo.on('ended', function(){
		videoComplete();
	});

	var canvas = $('#canvas')[0];
	canvasContext = canvas.getContext('2d');

	shapeAnim = new ImageSequence($wrapper.find('.anim-shape'), {
		'fps': 20
	});
	/*
	textAnim = new ImageSequence($('.anim-text'), {
		'horizontal': false,
		'repeat': false,
		'fps': 15
	});
	*/
	$(shapeAnim).on(ImageSequence.EVENT_START, function(){
		//textAnim.start();

		if (!loadStarted){
			preloadImages();
			loadStarted = true;
			$('.ready-label').addClass('show');
		}
	});

	var $buttons = $('.buttons li');
	buttonTl = new TimelineLite();
	soundTl = new TimelineLite({
		onUpdate: function(){
			// console.log(sound);
		}
	});
	$buttons.each(function(i, elm){
		var tl = new TimelineLite();
		tl.add(TweenLite.from(elm, 2, { left: '200%', ease: Linear.easeNone }));
		tl.add(TweenLite.from(elm, 0.2, { opacity: 0 }), '-=1.2');
		tl.add(TweenLite.to(elm, 0.2, { opacity: 0 }), '-=1');
		buttonTl.add(tl);

		var volumeControlTl = new TimelineLite();
		volumeControlTl.add(TweenLite.to(sound, 0.2, { volume: 1 }), i === 1 ? '+=0.8' : '+=1.6');
		volumeControlTl.add(TweenLite.to(sound, 0.2, { volume: 0 }));
		soundTl.add(volumeControlTl);
	});
	buttonTl.pause();
	soundTl.pause();

	TweenLite.ticker.addEventListener('tick', update, true, false, 0);

	$scrollElm = $('.fake-scroll');

	$img = $('.image-wrap .front-image');
	$backImg = $('.image-wrap .back-image');

	$progressWrap = $('.progress-wrap');
	$bar = $('.bar');

	ThrowPropsPlugin.track($scrollElm, 'x');

	drag = Draggable.create($scrollElm, {
		type: 'x',
		ease: Power0.easeOut,
		duration: 0.2,
		overshootTolerance: 0,
		//throwProps: true,
		dragResistance: 0.5,
//		edgeTolerance:0,
		zIndexBoost: false,
		bounds: $('.boot-selector').get(0),
		onThrowUpdate: handleDrag,
		onDragStart: function(){
			TweenLite.killTweensOf($scrollElm);

			startDragActive = active;
			$wrapper.addClass('dragging').addClass('has-dragged');
		},
		onDragEnd:function(){
			$wrapper.removeClass('dragging');

			ThrowPropsPlugin.to($scrollElm, {
				throwProps: { x: { velocity: 'auto', end: xEnd } },
				onUpdate: handleThrowUpdate
			}, .5, .25, 0);
		},
		onDrag: handleDrag
	})[0];

	$soundIcon = $wrapper.find('.sound-icon');
	$soundIcon.on('click', function(){
		if (isMuted){
			SoundManager.unMute();
		}
		else {
			SoundManager.mute();
		}
		$soundIcon.toggleClass('muted');
		isMuted = !isMuted;
	});

	$replayIcon.on('click', function(){
		$('.boot-selector').removeClass('video-complete');
		if (!isMuted){
			SoundManager.mute();
			$introVideo[0].volume = 0.5;
		}
		else {
			$introVideo[0].volume = 0;
		}
		$introVideo[0].currentTime = 0;
		$introVideo[0].play();
		$replayIcon.addClass('hidden');
		$soundIcon.addClass('hidden');

		showSkipButton();
	});

	drag.disable();

	//handleDrag();

	$(window).on('resize', handleWindowResize);
	handleWindowResize();

	$skip = $('.skip-intro');

	if (!$wrapper.hasClass('no-autoplay')){
		showSkipButton();
	}

	$skip.on('click', function(){
		$introVideo[0].pause();
		videoComplete();
		$introVideo[0].currentTime = 0;
		$skip.removeClass('active').css('display', 'none');;
	});

	$progressWrap.on('click', function(e){
		if ($(e.target).hasClass('progress-wrap') || $(e.target).hasClass('progress')){
			var active = (e.pageX - $progressWrap.offset().left) / $progressWrap.width();
			goto(Math.floor(snap.length * active));
		}
	});

	$wrapper.find('.button-play').on('click', function(e){
		e.preventDefault();
		playBootSelectorIntroVideo();
	});

	$(window).on('resize', resizeBootSelector);
	resizeBootSelector();

	if (isiPad){
		$skip.hide();
		$replayIcon.hide();
		$introVideo.hide();
		$wrapper.find('.button-play').hide();
	}
});

function resizeBootSelector(){
	//$wrapper.css('maxHeight', $(window)[0].innerHeight);
}

var introVideoPlayed = false;
function playBootSelectorIntroVideo()
{
	if (!introVideoPlayed){
		if (!isiPad){
			$introVideo[0].play();
			showSkipButton();
		}
		else {
			videoComplete();
			introVideoPlayed = true;
		}
	}
}

var skipButtonTimer;
function showSkipButton()
{
	//clearTimeout(skipButtonTimer);
	$skip.addClass('active').css('display', 'block');
	/*
	skipButtonTimer = setTimeout(function(){
		$skip.removeClass('active');

		setTimeout(function() {
			$skip.css('display', 'none');
			//$skip.remove();
		}, 300);
	}, 000);
	*/
}

function goto(key)
{
	if (key >= snap.length || key < 0){ return; }

	var overflowWidth = $scrollElm.width() - $(window).width();
	TweenLite.to($scrollElm, 0.8, {
		x: (overflowWidth * (snap[key] / (totalImages - 1)) * -1),
		ease: Power3.easeOut,
		onUpdate: function(){
			handleDrag($scrollElm.position().left);
		}
	});
}


function update()
{
	if(Math.abs(currentButtonProgress - targetButtonProgress) > .001)
	{
		var oldProgress = currentButtonProgress;
		currentButtonProgress = currentButtonProgress + ((targetButtonProgress - currentButtonProgress) * .4);
		buttonTl.seek(currentButtonProgress);
	}
}

function xEnd(endValue)
{
	var x = Math.abs(Math.min(0, endValue)),
		overflowWidth = $scrollElm.width() - $(window).width(),
		img = Math.min(totalImages - 1, (Math.round((totalImages - 1) * (x / overflowWidth))));

	var minDiff = totalImages,
		minKey;
	for (var i = 0; i < snap.length; i++) {
		var frame = snap[i],
			curDiff = Math.abs(frame - img);

		if (curDiff < minDiff){
			minKey = i;
			minDiff = curDiff;
		}
	}

	if(minKey === startDragActive){
		var startX = Math.abs(overflowWidth * (snap[minKey] / (totalImages - 1)) * -1),
			extraSize = overflowWidth / snap.length * 0.2;

		if (x < startX - extraSize && minKey > 0){
			--minKey;
		}
		else if (x > startX + extraSize && minKey < snap.length - 1){
			++minKey;
		}
	}
	else if (Math.abs(minKey - startDragActive) > 1){
		minKey = Math.max(0, Math.min(snap.length - 1, minKey > startDragActive ? startDragActive + 1 : startDragActive - 1));
	}

	return overflowWidth * (snap[minKey] / (totalImages - 1)) * -1;
}

function handleThrowUpdate()
{
	handleDrag($scrollElm[0]._gsTransform.x);
}

function videoComplete(){
	videoPlaying = false;
	$('.boot-selector').addClass('video-complete');
	$replayIcon.removeClass('hidden');
	$soundIcon.removeClass('hidden');

	$skip.removeClass('active').css('display', 'none');

	if (loaded === totalImages){
		preloadComplete();
	}
	else {
		shapeAnim.start();
	}

	//$('.intro-video').off('.skipvideo');
}

var preloadImagesTimer;

function preloadImages(){

	for (var i = 0; i < snap.length; i++) {
		var number = snap[i];
		loadImage(getImagePath(number));
	}

	// Preload All Images
	for (var i = 0; i < totalImages; i++) {
		var loadedImage = getImagePath(i);
		var img = loadImage(loadedImage, function(){
			++loaded;

			$preloaderBar.css('width', (loaded / totalImages * 100) + '%');
			$preloaderBar.find('.text').text(Math.round(loaded / totalImages * 100) + '%');

			if (loaded >= totalImages){
				clearTimeout(preloadImagesTimer);

				preloadComplete();
			}
		});

		images.push(msie ? loadedImage : img);
	}

	preloadImagesTimer = setTimeout(function(){
		preloadComplete();
	}, 10000);
}

var _ambient;

function preloadComplete(){
	shapeAnim.stop();

	handleDrag();

	$('.boot-selector').addClass('load-complete');
	drag.enable();

	var overflowWidth = $scrollElm.width() - $(window).width();
	TweenLite.to($scrollElm, 0.8, {
		x: (overflowWidth * (snap[0] / (totalImages - 1)) * -1),
		ease: Power3.easeOut,
		onUpdate: function(){
			handleDrag($scrollElm.position().left);
		}
	});

	if (!_ambient){
		_ambient = SoundManager.play('ambient', true);
	}
	else {
		if (!isMuted){
			SoundManager.unMute();
		}
		else {
			SoundManager.mute();
		}
	}

	//wooshSound = SoundManager.play('woosh', true);
	//wooshSound.setVolume(0);
}

function handleWindowResize(){
	var $wrapper = $('.boot-selector'),
		$video = $wrapper.find('video');

	$wrapper.css('maxHeight', $(window).height());
	$video.removeAttr('style');

	var containerWidth = $wrapper.width(),
		containerHeight = $wrapper.height(),
		videoWidth = 1280,
		videoHeight = 720;

	var ratioX = containerWidth / videoWidth,
		ratioY = containerHeight / videoHeight,
		scale = ratioX > ratioY ? ratioX : ratioY;

	$video.css({
		width: scale * videoWidth,
		height: scale * videoHeight,

		marginLeft: ((containerWidth - videoWidth * scale) / 2),
		marginTop: ((containerHeight - videoHeight * scale) / 2)
	});
}

function handleDrag(x){

	if (typeof x !== 'number'){
		x = drag.x;
	}
	x = Math.abs(x);

	var overflowWidth = $scrollElm.width() - $(window).width(),
		img = Math.min(totalImages - 1, (Math.round((totalImages - 1) * (x / overflowWidth))));

	//$backImg.attr('src', getImagePath(img > 0 ? img - 1 : img + 1));
	//$img.attr('src', getImagePath(img));
	$bar.css('left', (img / totalImages * 100) + '%');

	//canvasContext.clear();
	canvasContext.clearRect(0, 0, 1280, 720);

	if (msie){
		var newImg = new Image;
		newImg.src = getImagePath(img);

		canvasContext.drawImage(newImg, 0, 0);
	}
	else {
		canvasContext.drawImage(images[img], 0, 0);
	}

	targetButtonProgress = Math.max(0, buttonTl.duration() * (img / totalImages));

	//soundTl.seek(Math.max(0, soundTl.duration() * (img / totalImages)), true);
	//if (wooshSound){
	//  wooshSound.setVolume(sound.volume);
	//}

	// Find the Current Active Image
	var minDiff = totalImages,
		newActive;
	for (var i = 0; i < snap.length; i++) {
		var frame = snap[i],
			curDiff = Math.abs(frame - img);

		if (curDiff < minDiff){
			newActive = i;
			minDiff = curDiff;
		}
	}
	active = newActive;
}

function getImagePath(number){
	return staticAkamaiUrl + 'data/boot-picker' + ($wrapper.hasClass('no-messi') ? '-nomessi' : '') + '/' + str_pad(number, 3, '0', 'STR_PAD_LEFT') + '.jpg';
}

if (typeof loadImage == 'undefined'){
	function loadImage(src, cb){
		var img = new Image;
		img.onload = function(){
			if (cb){ cb.call(this, img); }
		};
		img.onerror = function(){
			// console.log('error loading image: ' + src);
		};
		img.src = src;

		return img;
	}
}

if (typeof str_pad == 'undefined'){
	function str_pad(input, pad_length, pad_string, pad_type) {
		//  discuss at: http://phpjs.org/functions/str_pad/
		// original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// improved by: Michael White (http://getsprink.com)
		//    input by: Marco van Oort
		// bugfixed by: Brett Zamir (http://brett-zamir.me)
		//   example 1: str_pad('Kevin van Zonneveld', 30, '-=', 'STR_PAD_LEFT');
		//   returns 1: '-=-=-=-=-=-Kevin van Zonneveld'
		//   example 2: str_pad('Kevin van Zonneveld', 30, '-', 'STR_PAD_BOTH');
		//   returns 2: '------Kevin van Zonneveld-----'

		var half = '',
			pad_to_go;

		var str_pad_repeater = function (s, len) {
			var collect = '',
				i;

			while (collect.length < len) {
				collect += s;
			}
			collect = collect.substr(0, len);

			return collect;
		};

		input += '';
		pad_string = pad_string !== undefined ? pad_string : ' ';

		if (pad_type !== 'STR_PAD_LEFT' && pad_type !== 'STR_PAD_RIGHT' && pad_type !== 'STR_PAD_BOTH') {
			pad_type = 'STR_PAD_RIGHT';
		}
		if ((pad_to_go = pad_length - input.length) > 0) {
			if (pad_type === 'STR_PAD_LEFT') {
				input = str_pad_repeater(pad_string, pad_to_go) + input;
			} else if (pad_type === 'STR_PAD_RIGHT') {
				input = input + str_pad_repeater(pad_string, pad_to_go);
			} else if (pad_type === 'STR_PAD_BOTH') {
				half = str_pad_repeater(pad_string, Math.ceil(pad_to_go / 2));
				input = half + input + half;
				input = input.substr(0, pad_length);
			}
		}

		return input;
	}
};var currentInteractiveImage = 0,
	loadedInteractiveImages = [];

function handleWindowResize(){
	var $interactiveBoot = $('.interactive-boot'),
		$video = $('.interactive-boot video');

	$interactiveBoot.css('height', window.innerHeight);
	$video.removeAttr('style');

	var containerWidth = $interactiveBoot.width(),
		containerHeight = $interactiveBoot.height(),
		videoWidth = 1280,
		videoHeight = 720;

	var ratioX = containerWidth / videoWidth,
		ratioY = containerHeight / videoHeight,
		scale = ratioX > ratioY ? ratioX : ratioY;

	$video.css({
		width: scale * videoWidth,
		height: scale * videoHeight,

		marginLeft: ((containerWidth - videoWidth * scale) / 2),
		marginTop: ((containerHeight - videoHeight * scale) / 2)
	});
}

/* Interactive Boot, mouseevents */
function interactiveBoot(){
	var $interactiveBootWrapper = $('.interactive-boot'),
		$bootListItems = $interactiveBootWrapper.find('.areas li'),
		cursor = $interactiveBootWrapper.find('.cursor-elm')[0],
		$bgImageWrapper = $interactiveBootWrapper.find('.bg-image'),
		$bgImage = $bgImageWrapper.find('img')

	$('.total', cursor).text($bootListItems.filter('.area').length);
	$interactiveBootWrapper.attr('data-active', 1);

	$interactiveBootWrapper.on('mousemove', function(e){
		cursor.style.left = e.pageX + 'px';
		cursor.style.top = (e.pageY - $interactiveBootWrapper.offset().top) + 'px';
	});
	$interactiveBootWrapper.on('mouseleave', function(){
		var elm = $bootListItems[0];
		if (!$(elm).hasClass('has-mouseovers') && !$('html').hasClass('lt-ie9')){ return; }

		$interactiveBootWrapper.removeClass('custom-cursor');
		$interactiveBootWrapper.attr('data-active', 1);

		$bootListItems.not(':nth-child(1)').removeClass('active');
		$(elm).addClass('active');

		swapImage(1, $bgImageWrapper, function(img){
			$bgImage.remove();
			$bgImage = $(img);
		});

		currentInteractiveImage = 0;
	});

	var hideLinesTimer;

	$interactiveBootWrapper.on('mousemove', function(){
		clearTimeout(hideLinesTimer);
		if ($interactiveBootWrapper.hasClass('has-mousemove') || $('html').hasClass('lt-ie9')){
			$interactiveBootWrapper.find('.areas').addClass('show-lines');
			hideLinesTimer = setTimeout(function(){
				$interactiveBootWrapper.find('.areas').removeClass('show-lines');
			}, 300);
		}
	});

	$bootListItems.each(function(i, elm){
		$(elm).on('mouseenter', function(){
			if (!$(elm).hasClass('has-mouseovers') && !$('html').hasClass('lt-ie9')){ return; }
			$bootListItems.not(':nth-child(' + (i + 1) + ')').removeClass('active');
			$(elm).addClass('active');

			$interactiveBootWrapper.attr('data-active', i + 1);

			if ($(elm).hasClass('area')){
				// $interactiveBootWrapper.addClass('custom-cursor');
				$('.current', cursor).text(i + 1);

				swapImage(i + 1, $bgImageWrapper, function(img){
					$bgImage.remove();
					$bgImage = $(img);
				});
			}
			else {
				$interactiveBootWrapper.removeClass('custom-cursor');

				swapImage(1, $bgImageWrapper, function(img){
					$bgImage.remove();
					$bgImage = $(img);
				}, i + 1);
			}

			currentInteractiveImage = i;
		}).on('mouseleave', function(){
			$interactiveBootWrapper.removeClass('custom-cursor');
		});
	});
}

function swapImage(i, $bgImageWrapper, callback, key){
	if (typeof key === 'undefined')
	{
		key = i;
	}

	var imgUrl = $bgImageWrapper.attr('data-image-path') + '0' + i + '.jpg';

	if ($.inArray(imgUrl, loadedInteractiveImages) < 0)
	{
		loadImage(imgUrl, function(img){
			loadedInteractiveImages.push(imgUrl);
			if (currentInteractiveImage === (key - 1)){
				$bgImageWrapper.append(img);
				TweenLite.set(img, { 'opacity': 0 });
				TweenLite.to(img, 0.2, { 'opacity': 1, onComplete: function(){
					callback(img);
				} });
			}
		});
	}
	else
	{
		var img = new Image;
		img.src = imgUrl;

		$bgImageWrapper.append(img);
		TweenLite.set(img, { 'opacity': 0 });
		TweenLite.to(img, 0.2, { 'opacity': 1, onComplete: function(){
			callback(img);
		} });
	}
};/*
 * Pointer Events Polyfill: Adds support for the style attribute "pointer-events: none" to browsers without this feature (namely, IE).
 * (c) 2013, Kent Mewhort, licensed under BSD. See LICENSE.txt for details.
 */

// constructor
function PointerEventsPolyfill(options){
	// set defaults
	this.options = {
		selector: '*',
		mouseEvents: ['click','dblclick','mousedown','mouseup'],
		usePolyfillIf: function(){
			if(navigator.appName == 'Microsoft Internet Explorer')
			{
				var agent = navigator.userAgent;
				if (agent.match(/MSIE ([0-9]{1,}[\.0-9]{0,})/) != null){
					var version = parseFloat( RegExp.$1 );
					if(version < 11)
						return true;
				}
			}
			return false;
		}
	};
	if(options){
		var obj = this;
		$.each(options, function(k,v){
			obj.options[k] = v;
		});
	}

	if(this.options.usePolyfillIf())
		this.register_mouse_events();
}

// singleton initializer
PointerEventsPolyfill.initialize = function(options){
	if(PointerEventsPolyfill.singleton == null)
		PointerEventsPolyfill.singleton = new PointerEventsPolyfill(options);
	return PointerEventsPolyfill.singleton;
};

// handle mouse events w/ support for pointer-events: none
PointerEventsPolyfill.prototype.register_mouse_events = function(){
	// register on all elements (and all future elements) matching the selector
	$(document).on(this.options.mouseEvents.join(" "), this.options.selector, function(e){
		if($(this).css('pointer-events') == 'none'){
			// peak at the element below
			var origDisplayAttribute = $(this).css('display');
			$(this).css('display','none');

			var underneathElem = document.elementFromPoint(e.clientX, e.clientY);

			if(origDisplayAttribute)
				$(this)
					.css('display', origDisplayAttribute);
			else
				$(this).css('display','');

			// fire the mouse event on the element below
			e.target = underneathElem;
			$(underneathElem).trigger(e);

			return false;
		}
		return true;
	});
};;var instances = instances || {},
	defaultVolume = 0.35;

var isIE10 = navigator.appVersion.indexOf("MSIE 10") !== -1;
var isiPad = navigator.userAgent.match(/iPad/i) != null;
isiPad = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

function checkSpans (){
	$('[data-wrap-span]').each(function(i, elm){
		$(elm).html($(elm).html().replace($(elm).attr('data-wrap-span'), '<span>' + $(elm).attr('data-wrap-span') + '</span>'));
	});
}

$('.ambassador .title').addClass('invisible');

$('window').ready(function()
{
	PointerEventsPolyfill.initialize({});

	if (isiPad) { $('body').addClass('is-ipad'); }
	if (isIE10) { $('body').addClass('is-ie10'); }

	$(window).on('resize', handleWindowResize);
	handleWindowResize();

	//instances.localeManager = new LocaleManager(staticContentUrl + 'data/locale/' + ($('.adidas-football-site').attr('data-locale') || 'en_GB') + '.json', function(){

	//});
	instances.scrollManager = new ScrollManager();

	if (!instances.soundManager){
		instances.soundManager = new SoundManager();
	}

	SoundManager.setVolume(defaultVolume);

	$('.scroll-wrapper').each(function(i, elm){
		new Scrollbar(elm, {
			horizontal: $(elm).hasClass('scroll-x')
		});
	});

	$('[data-carousel]').each(function(i, elm){
		var carousel = new Carousel(elm, {
			addKeyEvents: !$(elm).attr('data-carousel-nokeyevents')
		});
		carousel.onChange(function(old){
			if ($(elm).attr('data-track-carousel')){
				var trackString = $(elm).attr('data-track-carousel'),
					splitted = trackString.split('::');

				var tagText = splitted[0].replace('{NUMBER}', this._active + 1);
				tagText = tagText.replace('{COUNTRY}', $(this.$items[this._active]).attr('data-country'));

				tagPageElement(tagText, splitted[1]);
			}

			if ($(elm).attr('data-pause-current')){
				var id = $(this.$items[old]).find('.player-elm').attr('id');
				if (ytPlayVideoPlayers[id]){
					ytPlayVideoPlayers[id].pauseVideo();
				}
			}
		});
	});

	interactiveBoot();

	buyArea($('.buy-button-area'));

	zoomHovers();

	playVideoClick();

	$('.start-exploring').on('click', function(e){
		e.preventDefault();
		$('.intro-image').addClass('hidden');
	});

	$('[data-show-newsletter]').on('click', function(e){
		e.preventDefault();
		if (typeof openNewsletterPopup !== 'undefined'){
			openNewsletterPopup();
		}
	});

	$('[data-toggle-left]').on('click', function(e){
		e.preventDefault();
		var $target = $('#' + $(this).attr('data-toggle-left'));

		TweenLite.to($target, 0.5, { 'left': $target.data('isOpen') ? '-100%' : '0' });
		$target.data('isOpen', !$target.data('isOpen'));
	});

	followUs();

	compareActive();

	youtubeGallery();

	if (typeof initNewsletterForm !== 'undefined'){
		setTimeout(initNewsletterForm, 0);
	}

	checkSpans();

	$('[data-get-video]').each(function(i, elm){
		gatewayCall('Content.anthem', {}, function(rsp){
			if (rsp.success && rsp.data) {
				$(elm).attr('data-video', rsp.data);
			}
		});
	});

	if (isiPad){

		$('body').on('click', function(e){
			var $currentTarget = $(e.target),
				$closest = $currentTarget.parents('.item-sub');

			$('.item-sub').removeClass('active');
			if ($closest[0] || $currentTarget.hasClass('item-sub')){
				alert('addClass');
				$closest.addClass('active');
			}
		});

		$('.item-sub').on('click', function(e){
			$(this).addClass('active');
		});
	}
});


var checkTrackingTimer;
function checkTracking(){

	if (typeof adistk !== 'undefined' && typeof adistk.tracking !== 'undefined'){
		clearInterval(checkTrackingTimer);
		adistk.tracking.ready.done(function() {
			if (typeof addTrackingEvents !== 'undefined'){
				addTrackingEvents();
			}
		});
	}

};

if (typeof adistk !== 'undefined'){

	checkTrackingTimer = setInterval(checkTracking, 250);

	adistk.ask.ready(function() {

		var $buyArea = $('.buy-button-area'),
			$buyWrapper = $buyArea.parents('.buy-module');

		var productId = $('[data-product-id]').attr('data-product-id');
		if (productId){
			adistk.ask.processProductByArticleID(productId, function(data) {
				var $itemsWrapper = $buyArea.find('.options');

				//$buyWrapper.find('.product-title').text(data.name);

				if ($buyArea[0] && typeof data !== 'undefined' && typeof data.availability !== 'undefined' && data.availability.available){
					var availableSizes = 0;
					for (var i = 0; i < data.availability.sizes.length; i++) {
						var size = data.availability.sizes[i];
						if (size.available){
							++availableSizes;
							$itemsWrapper.append('<li data-id="' + size.id + '">' + size.local + '</li>');
						}
					}

					if (availableSizes === 0){
						$buyWrapper.addClass('non-available');
					}

					var firstSize = data.availability.sizes[0],
						price = firstSize.price;

					var displayPrice = price;
					if (typeof adistk.ask.formatPrice !== 'undefined'){
						displayPrice = adistk.ask.formatPrice(price);
					}

					$buyWrapper.find('.price').text(displayPrice);
				}
				else {
					$buyWrapper.addClass('non-available');
				}
				$buyArea.find('.button').on('click', function(e){
					e.preventDefault();

					if ($buyArea.hasClass('has-item')){
						var id = $buyArea.attr('buy-id');
						if (id){
							adistk.ask.addToBag(productId, id, 1, function() {
								TweenLite.to(window, 0.3, { scrollTo:{ y: 0 } });

								$buyArea.removeClass('has-item add-clicked choose-size-open').attr('buy-id', '');
								$buyArea.find('.size-chosen').text('');

								console.log('Product added to bag successfully');
							}, function() {
								console.log('Error adding to bag');
							});
						}
					}
				});

			}, function(err) {
			}, true, 'name,sale_type,shop_url,availability');
		}

	});
}


function compareActive(){
	var $compareList = $('.compare-list');

	$compareList.each(function(i, wrapper){

		var $elms = $(wrapper).find('> li'),
			$activeElm = $elms.filter('[data-active]');

		var $explanations = $('.explanation-cloud'),
			timer;

		$elms.each(function(i, elm){
			$(elm).on('mouseenter', function(){
				clearTimeout(timer);
				$explanations.attr('data-active', i + 1);
			}).on('mouseleave', function(){
				timer = setTimeout(function(){
					$explanations.removeAttr('data-active');
				}, 150);
			});
		});

		//$(wrapper).on('mouseleave', function(){
			//$activeElm.trigger('mouseenter');
		//});

		/*
		$elms.on('mouseenter', function(){
			$elms.removeClass('active');
			$(this).addClass('active');
		});
		*/

		$activeElm.trigger('mouseenter');

	});
}

function followUs(){
	$('.follow-us').each(function(i, wrapper){
		var $buttons = $('[data-mouseover-elm]', wrapper),
			$arrow = $('.arrow-top', wrapper);

		$buttons.each(function(j, elm){
			$(elm).on('click', function(){
				$buttons.removeClass('active');
				$(elm).addClass('active');
				$(wrapper).attr('data-active', j + 1);

				TweenLite.to($arrow, 0.4, { left: $(elm).position().left + ($(elm).width() / 2) });
			});

			if (j === 0){
				$(elm).trigger('click');
			}
		});

	});
}

function youtubeGallery(){

	var $ytGalleryWrap = $('.youtube-gallery'),
		$videos = $ytGalleryWrap.find('.video-full'),
		$buttons = $ytGalleryWrap.find('[data-gallery-play]');

	var galleryActiveVideo = 0;

	$buttons.each(function(i, elm){
		$(elm).on('click', function(e){
			if (e){
				e.preventDefault();
			}
			var curPlayerId = $('.player-elm', $videos[galleryActiveVideo]).attr('id');
			if (ytPlayVideoPlayers[curPlayerId]) {
				ytPlayVideoPlayers[curPlayerId].pauseVideo();
			}
			$videos.css('display', 'none');
			$($videos[i]).css('display', 'block');

			galleryActiveVideo = i;

			$buttons.removeClass('active');
			$(elm).addClass('active');
		});

		if (i === galleryActiveVideo) {
			$(elm).trigger('click');
		}
	});

}

/*
var ytGalleryPlayer,
	$ytGalleryWrap;
function onYouTubeIframeAPIReady() {
	youtubeGallery();
}

function onPlayerStateChange(event) {
	if (event.data == YT.PlayerState.PLAYING) {
		$ytGalleryWrap.addClass('video-playing');
	}
	else {
		$ytGalleryWrap.removeClass('video-playing');
	}
}

function youtubeGallery(){
	$ytGalleryWrap = $('.youtube-gallery');
	var $buttons = $ytGalleryWrap.find('[data-gallery-play]');
	if ($ytGalleryWrap[0] && $buttons[0]) {

		ytGalleryPlayer = new YT.Player('yt-gallery-player', {
			videoId: $buttons.attr('data-gallery-play'),
			playerVars: {
				'autohide': 1,
				'showinfo': 0,
				'rel': 0,
				'iv_load_policy': 3//,
				//'modestbranding': 1
			},
			events: {
				'onStateChange': onPlayerStateChange
			}
		});

		$($buttons[0]).addClass('active');
		$ytGalleryWrap.attr('data-current-video', 1);

		$buttons.each(function(i, elm){
			$(elm).on('click', function(){
				$buttons.removeClass('active');
				$(elm).addClass('active');
				$ytGalleryWrap.attr('data-current-video', i + 1);
				ytGalleryPlayer.loadVideoById($(this).attr('data-gallery-play'));
			});
		});

	}
}
*/

function zoomHovers(){
	$('.zoom-hover').each(function(i, elm){

		var parent = $(elm).parents('[data-hover-elm]')[0] || elm;
		$(parent).on('mouseenter', function(){
			TweenLite.to(elm, 6, { scale: 1.2 });
		}).on('mouseleave', function(){
			TweenLite.to(elm, 1, { scale: 1 });
		});
	});
}

if (typeof loadImage == 'undefined'){
	function loadImage(src, cb){
		var img = new Image;
		img.onload = function(){
			if (cb){ cb.call(this, img); }
		};
		img.onerror = function(){
			// console.log('error loading image: ' + src);
		};
		img.src = src;

		return img;
	}
}

function stringToObject(str) {
	var type = 'function';
	var arr = str.split('.');

	var fn = (window || this);
	for (var i = 0, len = arr.length; i < len; i++) {
		fn = fn[arr[i]];
	}

	if (typeof fn !== type) {
		throw new Error(type + ' not found: ' + str);
	}

	return fn;
}

if (typeof str_pad == 'undefined'){
	function str_pad(input, pad_length, pad_string, pad_type) {
		//  discuss at: http://phpjs.org/functions/str_pad/
		// original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// improved by: Michael White (http://getsprink.com)
		//    input by: Marco van Oort
		// bugfixed by: Brett Zamir (http://brett-zamir.me)
		//   example 1: str_pad('Kevin van Zonneveld', 30, '-=', 'STR_PAD_LEFT');
		//   returns 1: '-=-=-=-=-=-Kevin van Zonneveld'
		//   example 2: str_pad('Kevin van Zonneveld', 30, '-', 'STR_PAD_BOTH');
		//   returns 2: '------Kevin van Zonneveld-----'

		var half = '',
			pad_to_go;

		var str_pad_repeater = function (s, len) {
			var collect = '',
				i;

			while (collect.length < len) {
				collect += s;
			}
			collect = collect.substr(0, len);

			return collect;
		};

		input += '';
		pad_string = pad_string !== undefined ? pad_string : ' ';

		if (pad_type !== 'STR_PAD_LEFT' && pad_type !== 'STR_PAD_RIGHT' && pad_type !== 'STR_PAD_BOTH') {
			pad_type = 'STR_PAD_RIGHT';
		}
		if ((pad_to_go = pad_length - input.length) > 0) {
			if (pad_type === 'STR_PAD_LEFT') {
				input = str_pad_repeater(pad_string, pad_to_go) + input;
			} else if (pad_type === 'STR_PAD_RIGHT') {
				input = input + str_pad_repeater(pad_string, pad_to_go);
			} else if (pad_type === 'STR_PAD_BOTH') {
				half = str_pad_repeater(pad_string, Math.ceil(pad_to_go / 2));
				input = half + input + half;
				input = input.substr(0, pad_length);
			}
		}

		return input;
	}
}