/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
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
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/micromodal/dist/micromodal.es.js":
/*!*******************************************************!*\
  !*** ./node_modules/micromodal/dist/micromodal.es.js ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
const MicroModal = (() => {

  const FOCUSABLE_ELEMENTS = ['a[href]', 'area[href]', 'input:not([disabled]):not([type="hidden"]):not([aria-hidden])', 'select:not([disabled]):not([aria-hidden])', 'textarea:not([disabled]):not([aria-hidden])', 'button:not([disabled]):not([aria-hidden])', 'iframe', 'object', 'embed', '[contenteditable]', '[tabindex]:not([tabindex^="-"])'];

  class Modal {
    constructor({
      targetModal,
      triggers = [],
      onShow = () => {},
      onClose = () => {},
      openTrigger = 'data-micromodal-trigger',
      closeTrigger = 'data-micromodal-close',
      disableScroll = false,
      disableFocus = false,
      awaitCloseAnimation = false,
      awaitOpenAnimation = false,
      debugMode = false
    }) {
      // Save a reference of the modal
      this.modal = document.getElementById(targetModal); // Save a reference to the passed config

      this.config = {
        debugMode,
        disableScroll,
        openTrigger,
        closeTrigger,
        onShow,
        onClose,
        awaitCloseAnimation,
        awaitOpenAnimation,
        disableFocus // Register click events only if pre binding eventListeners

      };
      if (triggers.length > 0) this.registerTriggers(...triggers); // pre bind functions for event listeners

      this.onClick = this.onClick.bind(this);
      this.onKeydown = this.onKeydown.bind(this);
    }
    /**
     * Loops through all openTriggers and binds click event
     * @param  {array} triggers [Array of node elements]
     * @return {void}
     */


    registerTriggers(...triggers) {
      triggers.filter(Boolean).forEach(trigger => {
        trigger.addEventListener('click', event => this.showModal(event));
      });
    }

    showModal() {
      this.activeElement = document.activeElement;
      this.modal.setAttribute('aria-hidden', 'false');
      this.modal.classList.add('is-open');
      this.scrollBehaviour('disable');
      this.addEventListeners();

      if (this.config.awaitOpenAnimation) {
        const handler = () => {
          this.modal.removeEventListener('animationend', handler, false);
          this.setFocusToFirstNode();
        };

        this.modal.addEventListener('animationend', handler, false);
      } else {
        this.setFocusToFirstNode();
      }

      this.config.onShow(this.modal, this.activeElement);
    }

    closeModal() {
      const modal = this.modal;
      this.modal.setAttribute('aria-hidden', 'true');
      this.removeEventListeners();
      this.scrollBehaviour('enable');

      if (this.activeElement) {
        this.activeElement.focus();
      }

      this.config.onClose(this.modal);

      if (this.config.awaitCloseAnimation) {
        this.modal.addEventListener('animationend', function handler() {
          modal.classList.remove('is-open');
          modal.removeEventListener('animationend', handler, false);
        }, false);
      } else {
        modal.classList.remove('is-open');
      }
    }

    closeModalById(targetModal) {
      this.modal = document.getElementById(targetModal);
      if (this.modal) this.closeModal();
    }

    scrollBehaviour(toggle) {
      if (!this.config.disableScroll) return;
      const body = document.querySelector('body');

      switch (toggle) {
        case 'enable':
          Object.assign(body.style, {
            overflow: '',
            height: ''
          });
          break;

        case 'disable':
          Object.assign(body.style, {
            overflow: 'hidden',
            height: '100vh'
          });
          break;

        default:
      }
    }

    addEventListeners() {
      this.modal.addEventListener('touchstart', this.onClick);
      this.modal.addEventListener('click', this.onClick);
      document.addEventListener('keydown', this.onKeydown);
    }

    removeEventListeners() {
      this.modal.removeEventListener('touchstart', this.onClick);
      this.modal.removeEventListener('click', this.onClick);
      document.removeEventListener('keydown', this.onKeydown);
    }

    onClick(event) {
      if (event.target.hasAttribute(this.config.closeTrigger)) {
        this.closeModal();
        event.preventDefault();
      }
    }

    onKeydown(event) {
      if (event.keyCode === 27) this.closeModal(event);
      if (event.keyCode === 9) this.maintainFocus(event);
    }

    getFocusableNodes() {
      const nodes = this.modal.querySelectorAll(FOCUSABLE_ELEMENTS);
      return Array(...nodes);
    }

    setFocusToFirstNode() {
      if (this.config.disableFocus) return;
      const focusableNodes = this.getFocusableNodes();
      if (focusableNodes.length) focusableNodes[0].focus();
    }

    maintainFocus(event) {
      const focusableNodes = this.getFocusableNodes(); // if disableFocus is true

      if (!this.modal.contains(document.activeElement)) {
        focusableNodes[0].focus();
      } else {
        const focusedItemIndex = focusableNodes.indexOf(document.activeElement);

        if (event.shiftKey && focusedItemIndex === 0) {
          focusableNodes[focusableNodes.length - 1].focus();
          event.preventDefault();
        }

        if (!event.shiftKey && focusedItemIndex === focusableNodes.length - 1) {
          focusableNodes[0].focus();
          event.preventDefault();
        }
      }
    }

  }
  /**
   * Modal prototype ends.
   * Here on code is responsible for detecting and
   * auto binding event handlers on modal triggers
   */
  // Keep a reference to the opened modal


  let activeModal = null;
  /**
   * Generates an associative array of modals and it's
   * respective triggers
   * @param  {array} triggers     An array of all triggers
   * @param  {string} triggerAttr The data-attribute which triggers the module
   * @return {array}
   */

  const generateTriggerMap = (triggers, triggerAttr) => {
    const triggerMap = [];
    triggers.forEach(trigger => {
      const targetModal = trigger.attributes[triggerAttr].value;
      if (triggerMap[targetModal] === undefined) triggerMap[targetModal] = [];
      triggerMap[targetModal].push(trigger);
    });
    return triggerMap;
  };
  /**
   * Validates whether a modal of the given id exists
   * in the DOM
   * @param  {number} id  The id of the modal
   * @return {boolean}
   */


  const validateModalPresence = id => {
    if (!document.getElementById(id)) {
      console.warn(`MicroModal: \u2757Seems like you have missed %c'${id}'`, 'background-color: #f8f9fa;color: #50596c;font-weight: bold;', 'ID somewhere in your code. Refer example below to resolve it.');
      console.warn(`%cExample:`, 'background-color: #f8f9fa;color: #50596c;font-weight: bold;', `<div class="modal" id="${id}"></div>`);
      return false;
    }
  };
  /**
   * Validates if there are modal triggers present
   * in the DOM
   * @param  {array} triggers An array of data-triggers
   * @return {boolean}
   */


  const validateTriggerPresence = triggers => {
    if (triggers.length <= 0) {
      console.warn(`MicroModal: \u2757Please specify at least one %c'micromodal-trigger'`, 'background-color: #f8f9fa;color: #50596c;font-weight: bold;', 'data attribute.');
      console.warn(`%cExample:`, 'background-color: #f8f9fa;color: #50596c;font-weight: bold;', `<a href="#" data-micromodal-trigger="my-modal"></a>`);
      return false;
    }
  };
  /**
   * Checks if triggers and their corresponding modals
   * are present in the DOM
   * @param  {array} triggers   Array of DOM nodes which have data-triggers
   * @param  {array} triggerMap Associative array of modals and their triggers
   * @return {boolean}
   */


  const validateArgs = (triggers, triggerMap) => {
    validateTriggerPresence(triggers);
    if (!triggerMap) return true;

    for (var id in triggerMap) validateModalPresence(id);

    return true;
  };
  /**
   * Binds click handlers to all modal triggers
   * @param  {object} config [description]
   * @return void
   */


  const init = config => {
    // Create an config object with default openTrigger
    const options = Object.assign({}, {
      openTrigger: 'data-micromodal-trigger'
    }, config); // Collects all the nodes with the trigger

    const triggers = [...document.querySelectorAll(`[${options.openTrigger}]`)]; // Makes a mappings of modals with their trigger nodes

    const triggerMap = generateTriggerMap(triggers, options.openTrigger); // Checks if modals and triggers exist in dom

    if (options.debugMode === true && validateArgs(triggers, triggerMap) === false) return; // For every target modal creates a new instance

    for (var key in triggerMap) {
      let value = triggerMap[key];
      options.targetModal = key;
      options.triggers = [...value];
      activeModal = new Modal(options); // eslint-disable-line no-new
    }
  };
  /**
   * Shows a particular modal
   * @param  {string} targetModal [The id of the modal to display]
   * @param  {object} config [The configuration object to pass]
   * @return {void}
   */


  const show = (targetModal, config) => {
    const options = config || {};
    options.targetModal = targetModal; // Checks if modals and triggers exist in dom

    if (options.debugMode === true && validateModalPresence(targetModal) === false) return; // stores reference to active modal

    activeModal = new Modal(options); // eslint-disable-line no-new

    activeModal.showModal();
  };
  /**
   * Closes the active modal
   * @param  {string} targetModal [The id of the modal to close]
   * @return {void}
   */


  const close = targetModal => {
    targetModal ? activeModal.closeModalById(targetModal) : activeModal.closeModal();
  };

  return {
    init,
    show,
    close
  };
})();

/* harmony default export */ __webpack_exports__["default"] = (MicroModal);


/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/ts/app.ts":
/*!*****************************!*\
  !*** ./resources/ts/app.ts ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
var micromodal_1 = __webpack_require__(/*! micromodal */ "./node_modules/micromodal/dist/micromodal.es.js");
(function () {
    micromodal_1.default.init();
})();


/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/ts/app.ts ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /home/lex/School/niks/resources/ts/app.ts */"./resources/ts/app.ts");
module.exports = __webpack_require__(/*! /home/lex/School/niks/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });