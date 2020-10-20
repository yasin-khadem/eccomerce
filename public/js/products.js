(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/products"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Front/Product/ProductRoutes.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Front/Product/ProductRoutes.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Show__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Show */ "./resources/js/views/Front/Product/Show.vue");
/* harmony import */ var _views_errors_NotFound__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @/views/errors/NotFound */ "./resources/js/views/errors/NotFound.vue");
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
  name: "ProductRoutes",
  components: {
    Show: _Show__WEBPACK_IMPORTED_MODULE_0__["default"],
    NotFound: _views_errors_NotFound__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  props: ['url'],
  computed: {
    componentName: function componentName() {
      return ['show'].includes(this.url) ? this.url : 'not-found';
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Front/Product/ProductRoutes.vue?vue&type=template&id=9d4a86f8&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Front/Product/ProductRoutes.vue?vue&type=template&id=9d4a86f8& ***!
  \*************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(_vm.componentName, { tag: "component" })
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/Front/Product/ProductRoutes.vue":
/*!************************************************************!*\
  !*** ./resources/js/views/Front/Product/ProductRoutes.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProductRoutes_vue_vue_type_template_id_9d4a86f8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProductRoutes.vue?vue&type=template&id=9d4a86f8& */ "./resources/js/views/Front/Product/ProductRoutes.vue?vue&type=template&id=9d4a86f8&");
/* harmony import */ var _ProductRoutes_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProductRoutes.vue?vue&type=script&lang=js& */ "./resources/js/views/Front/Product/ProductRoutes.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProductRoutes_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProductRoutes_vue_vue_type_template_id_9d4a86f8___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProductRoutes_vue_vue_type_template_id_9d4a86f8___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/Front/Product/ProductRoutes.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/Front/Product/ProductRoutes.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/views/Front/Product/ProductRoutes.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductRoutes_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductRoutes.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Front/Product/ProductRoutes.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductRoutes_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/Front/Product/ProductRoutes.vue?vue&type=template&id=9d4a86f8&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/views/Front/Product/ProductRoutes.vue?vue&type=template&id=9d4a86f8& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductRoutes_vue_vue_type_template_id_9d4a86f8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductRoutes.vue?vue&type=template&id=9d4a86f8& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Front/Product/ProductRoutes.vue?vue&type=template&id=9d4a86f8&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductRoutes_vue_vue_type_template_id_9d4a86f8___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductRoutes_vue_vue_type_template_id_9d4a86f8___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);