/*! elementor-pro - v2.8.5 - 08-03-2020 */
/******/ (function(modules) { // webpackBootstrap
    /******/ 	// The module cache
    /******/ 	var installedModules = {};
    /******/
    /******/ 	// The require function
    /******/ 	function __webpack_require__(moduleId) {
        /******/
                        console.log('moduleId',moduleId);
        /******/ 		// Check if module is in cache
        /******/ 		if(installedModules[moduleId]) {
            /******/ 			return installedModules[moduleId].exports;
            /******/ 		}
        /******/ 		// Create a new module (and put it into the cache)
        /******/ 		var module = installedModules[moduleId] = {
            /******/ 			i: moduleId,
            /******/ 			l: false,
            /******/ 			exports: {}
            /******/ 		};
        /******/
        /******/ 		// Execute the module function
        /******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
        /******/
        /******/ 		// Flag the module as loaded
        /******/ 		module.l = true;
        /******/
        /******/ 		// Return the exports of the module
        /******/ 		return module.exports;
        /******/ 	}
    /******/
    /******/
    /******/ 	// expose the modules object (__webpack_modules__)
    /******/ 	__webpack_require__.m = modules;
    /******/
    /******/ 	// expose the module cache
    /******/ 	__webpack_require__.c = installedModules;
    /******/
    /******/ 	// define getter function for harmony exports
    /******/ 	__webpack_require__.d = function(exports, name, getter) {
        /******/ 		if(!__webpack_require__.o(exports, name)) {
            /******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
            /******/ 		}
        /******/ 	};
    /******/
    /******/ 	// define __esModule on exports
    /******/ 	__webpack_require__.r = function(exports) {
        /******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
            /******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
            /******/ 		}
        /******/ 		Object.defineProperty(exports, '__esModule', { value: true });
        /******/ 	};
    /******/
    /******/ 	// create a fake namespace object
    /******/ 	// mode & 1: value is a module id, require it
    /******/ 	// mode & 2: merge all properties of value into the ns
    /******/ 	// mode & 4: return value when already ns object
    /******/ 	// mode & 8|1: behave like require
    /******/ 	__webpack_require__.t = function(value, mode) {
        /******/
        /******/ 	};
    /******/
    /******/ 	// getDefaultExport function for compatibility with non-harmony modules
    /******/ 	__webpack_require__.n = function(module) {
        /******/ 		var getter = module && module.__esModule ?
            /******/ 			function getDefault() { return module['default']; } :
            /******/ 			function getModuleExports() { return module; };
        /******/ 		__webpack_require__.d(getter, 'a', getter);
        /******/ 		return getter;
        /******/ 	};
    /******/
    /******/ 	// Object.prototype.hasOwnProperty.call
    /******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
    /******/
    /******/ 	// __webpack_public_path__
    /******/ 	__webpack_require__.p = "";
    /******/
    /******/
    /******/ 	// Load entry module and return exports
    /******/ 	return __webpack_require__(__webpack_require__.s = 2 );
    /******/ })
/************************************************************************/
/******/ ([

    /*0*/
    (function(module, exports, __webpack_require__) {

        "use strict";


        module.exports = elementorModules.frontend.handlers.Base.extend({

            getDefaultSettings: function getDefaultSettings() {
                return {
                    selectors: {
                        mainSwiper: '.elementor-main-swiper',
                        swiperSlide: '.swiper-slide'
                    },
                    slidesPerView: {
                        desktop: 3,
                        tablet: 2,
                        mobile: 1
                    }
                };
            },

            getDefaultElements: function getDefaultElements() {
                var selectors = this.getSettings('selectors');

                var elements = {
                    $mainSwiper: this.$element.find(selectors.mainSwiper)
                };

                elements.$mainSwiperSlides = elements.$mainSwiper.find(selectors.swiperSlide);

                return elements;
            },

            getSlidesCount: function getSlidesCount() {
                return this.elements.$mainSwiperSlides.length;
            },

            getInitialSlide: function getInitialSlide() {
                var editSettings = this.getEditSettings();

                return editSettings.activeItemIndex ? editSettings.activeItemIndex - 1 : 0;
            },

            getEffect: function getEffect() {
                return this.getElementSettings('effect');
            },

            getDeviceSlidesPerView: function getDeviceSlidesPerView(device) {
                var slidesPerViewKey = 'slides_per_view' + ('desktop' === device ? '' : '_' + device);

                return Math.min(this.getSlidesCount(), +this.getElementSettings(slidesPerViewKey) || this.getSettings('slidesPerView')[device]);
            },

            getSlidesPerView: function getSlidesPerView(device) {
                if ('slide' === this.getEffect()) {
                    return this.getDeviceSlidesPerView(device);
                }

                return 1;
            },

            getDesktopSlidesPerView: function getDesktopSlidesPerView() {
                return this.getSlidesPerView('desktop');
            },

            getTabletSlidesPerView: function getTabletSlidesPerView() {
                return this.getSlidesPerView('tablet');
            },

            getMobileSlidesPerView: function getMobileSlidesPerView() {
                return this.getSlidesPerView('mobile');
            },

            getDeviceSlidesToScroll: function getDeviceSlidesToScroll(device) {
                var slidesToScrollKey = 'slides_to_scroll' + ('desktop' === device ? '' : '_' + device);

                return Math.min(this.getSlidesCount(), +this.getElementSettings(slidesToScrollKey) || 1);
            },

            getSlidesToScroll: function getSlidesToScroll(device) {
                if ('slide' === this.getEffect()) {
                    return this.getDeviceSlidesToScroll(device);
                }

                return 1;
            },

            getDesktopSlidesToScroll: function getDesktopSlidesToScroll() {
                return this.getSlidesToScroll('desktop');
            },

            getTabletSlidesToScroll: function getTabletSlidesToScroll() {
                return this.getSlidesToScroll('tablet');
            },

            getMobileSlidesToScroll: function getMobileSlidesToScroll() {
                return this.getSlidesToScroll('mobile');
            },

            getSpaceBetween: function getSpaceBetween(device) {
                var propertyName = 'space_between';

                if (device && 'desktop' !== device) {
                    propertyName += '_' + device;
                }

                return this.getElementSettings(propertyName).size || 0;
            },

            getSwiperOptions: function getSwiperOptions() {
                var elementSettings = this.getElementSettings();

                // TODO: Temp migration for old saved values since 2.2.0
                if ('progress' === elementSettings.pagination) {
                    elementSettings.pagination = 'progressbar';
                }

                var swiperOptions = {
                    grabCursor: true,
                    initialSlide: this.getInitialSlide(),
                    slidesPerView: this.getDesktopSlidesPerView(),
                    slidesPerGroup: this.getDesktopSlidesToScroll(),
                    spaceBetween: this.getSpaceBetween(),
                    loop: 'yes' === elementSettings.loop,
                    speed: elementSettings.speed,
                    effect: this.getEffect(),
                    preventClicksPropagation: false,
                    slideToClickedSlide: true,
                    handleElementorBreakpoints: true
                };

                if (elementSettings.show_arrows) {
                    swiperOptions.navigation = {
                        prevEl: '.elementor-swiper-button-prev',
                        nextEl: '.elementor-swiper-button-next'
                    };
                }

                if (elementSettings.pagination) {
                    swiperOptions.pagination = {
                        el: '.swiper-pagination',
                        type: elementSettings.pagination,
                        clickable: true
                    };
                }

                if ('cube' !== this.getEffect()) {
                    var breakpointsSettings = {},
                        breakpoints = elementorFrontend.config.breakpoints;

                    breakpointsSettings[breakpoints.lg - 1] = {
                        slidesPerView: this.getTabletSlidesPerView(),
                        slidesPerGroup: this.getTabletSlidesToScroll(),
                        spaceBetween: this.getSpaceBetween('tablet')
                    };

                    breakpointsSettings[breakpoints.md - 1] = {
                        slidesPerView: this.getMobileSlidesPerView(),
                        slidesPerGroup: this.getMobileSlidesToScroll(),
                        spaceBetween: this.getSpaceBetween('mobile')
                    };

                    swiperOptions.breakpoints = breakpointsSettings;
                }

                if (!this.isEdit && elementSettings.autoplay) {
                    swiperOptions.autoplay = {
                        delay: elementSettings.autoplay_speed,
                        disableOnInteraction: !!elementSettings.pause_on_interaction
                    };
                }

                return swiperOptions;
            },

            updateSpaceBetween: function updateSpaceBetween(swiper, propertyName) {
                var deviceMatch = propertyName.match('space_between_(.*)'),
                    device = deviceMatch ? deviceMatch[1] : 'desktop',
                    newSpaceBetween = this.getSpaceBetween(device),
                    breakpoints = elementorFrontend.config.breakpoints;

                if ('desktop' !== device) {
                    var breakpointDictionary = {
                        tablet: breakpoints.lg - 1,
                        mobile: breakpoints.md - 1
                    };

                    swiper.params.breakpoints[breakpointDictionary[device]].spaceBetween = newSpaceBetween;
                } else {
                    swiper.originalParams.spaceBetween = newSpaceBetween;
                }

                swiper.params.spaceBetween = newSpaceBetween;

                swiper.update();
            },

            onInit: function onInit() {
                var _this = this;

                elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);

                var elementSettings = this.getElementSettings();

                this.swipers = {};

                if (1 >= this.getSlidesCount()) {
                    return;
                }

                this.swipers.main = new Swiper(this.elements.$mainSwiper, this.getSwiperOptions());

                if (elementSettings.pause_on_hover) {
                    this.elements.$mainSwiper.on({
                        mouseenter: function mouseenter() {
                            _this.swipers.main.autoplay.stop();
                        },
                        mouseleave: function mouseleave() {
                            _this.swipers.main.autoplay.start();
                        }
                    });
                }
            },

            onElementChange: function onElementChange(propertyName) {
                if (1 >= this.getSlidesCount()) {
                    return;
                }

                if (0 === propertyName.indexOf('width')) {
                    this.swipers.main.update();
                }

                if (0 === propertyName.indexOf('space_between')) {
                    this.updateSpaceBetween(this.swipers.main, propertyName);
                }
            },

            onEditSettingsChange: function onEditSettingsChange(propertyName) {
                if (1 >= this.getSlidesCount()) {
                    return;
                }

                if ('activeItemIndex' === propertyName) {
                    this.swipers.main.slideToLoop(this.getEditSettings('activeItemIndex') - 1);
                }
            }
        });

        /***/ }),
    /* 1 */
    /***/ (function(module, exports, __webpack_require__) {

        "use strict";


        var Base = __webpack_require__(0),
            TestimonialImageCarousel;

        TestimonialImageCarousel = Base.extend({

            getDefaultSettings: function getDefaultSettings() {
                var defaultSettings = Base.prototype.getDefaultSettings.apply(this, arguments);

                defaultSettings.slidesPerView = {
                    desktop: 1,
                    tablet: 1,
                    mobile: 1
                };

                if (defaultSettings.loop) {
                    defaultSettings.loopedSlides = this.getSlidesCount();
                }

                return defaultSettings;
            },

            getEffect: function getEffect() {
                return 'slide';
            }
        });

        module.exports = function ($scope) {
            new TestimonialImageCarousel({ $element: $scope });
        };

        /***/ }),

    /*2*/
    (function(module, exports, __webpack_require__) {

        "use strict";


        var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

        var _get = function get(object, property, receiver) { if (object === null) object = Function.prototype; var desc = Object.getOwnPropertyDescriptor(object, property); if (desc === undefined) { var parent = Object.getPrototypeOf(object); if (parent === null) { return undefined; } else { return get(parent, property, receiver); } } else if ("value" in desc) { return desc.value; } else { var getter = desc.get; if (getter === undefined) { return undefined; } return getter.call(receiver); } };

        function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

        function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

        function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

        var ElementorProFrontend = function (_elementorModules$Vie) {
            _inherits(ElementorProFrontend, _elementorModules$Vie);

            function ElementorProFrontend() {
                _classCallCheck(this, ElementorProFrontend);

                return _possibleConstructorReturn(this, (ElementorProFrontend.__proto__ || Object.getPrototypeOf(ElementorProFrontend)).apply(this, arguments));
            }

            _createClass(ElementorProFrontend, [{
                key: 'onInit',
                value: function onInit() {
                    _get(ElementorProFrontend.prototype.__proto__ || Object.getPrototypeOf(ElementorProFrontend.prototype), 'onInit', this).call(this);

                    this.modules = {};
                }
            }, {
                key: 'bindEvents',
                value: function bindEvents() {
                    jQuery(window).on('elementor/frontend/init', this.onElementorFrontendInit.bind(this));
                }
            }, {
                key: 'initModules',
                value: function initModules() {
                    var _this2 = this;

                    var handlers = {
                        carousel: __webpack_require__(3)
                    };

                    jQuery.each(handlers, function (moduleName, ModuleClass) {
                        _this2.modules[moduleName] = new ModuleClass();
                    });
                }
            }, {
                key: 'onElementorFrontendInit',
                value: function onElementorFrontendInit() {
                    this.initModules();
                }
            }]);

            return ElementorProFrontend;
        }(elementorModules.ViewModule);

        window.elementorProFrontend = new ElementorProFrontend();

        /***/ }),

    /*3*/
    (function(module, exports, __webpack_require__) {

        "use strict";


        module.exports = function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/testimonial-image-carousel.default', __webpack_require__(1));
        };

        /***/ }),
    /* 4 */
    /***/ (function(module, exports, __webpack_require__) {

        "use strict";


        Object.defineProperty(exports, "__esModule", {
            value: true
        });

        var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

        function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

        function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

        function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

        var _class = function (_elementorModules$Mod) {
            _inherits(_class, _elementorModules$Mod);

            function _class(settings, callback) {
                _classCallCheck(this, _class);

                var _this = _possibleConstructorReturn(this, (_class.__proto__ || Object.getPrototypeOf(_class)).call(this, settings));

                _this.callback = callback;
                return _this;
            }

            _createClass(_class, [{
                key: 'getTriggerSetting',
                value: function getTriggerSetting(settingKey) {
                    return this.getSettings(this.getName() + '_' + settingKey);
                }
            }]);

            return _class;
        }(elementorModules.Module);

        exports.default = _class;

        /***/ })
]);