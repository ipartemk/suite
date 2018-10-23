(window["webpackJsonp_yves_default"] = window["webpackJsonp_yves_default"] || []).push([[9],{

/***/ "./vendor/spryker-shop/shop-ui/src/SprykerShop/Yves/ShopUi/Theme/default/components/molecules/flash-message/flash-message.ts":
/*!***********************************************************************************************************************************!*\
  !*** ./vendor/spryker-shop/shop-ui/src/SprykerShop/Yves/ShopUi/Theme/default/components/molecules/flash-message/flash-message.ts ***!
  \***********************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _models_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../models/component */ "./vendor/spryker-shop/shop-ui/src/SprykerShop/Yves/ShopUi/Theme/default/models/component.ts");
var __extends = (undefined && undefined.__extends) || (function () {
    var extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();

var FlashMessage = (function (_super) {
    __extends(FlashMessage, _super);
    function FlashMessage() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.defaultDuration = 5000;
        return _this;
    }
    FlashMessage.prototype.readyCallback = function () {
        var _this = this;
        this.mapEvents();
        setTimeout(function () { return _this.showFor(_this.defaultDuration); });
    };
    FlashMessage.prototype.mapEvents = function () {
        var _this = this;
        this.addEventListener('click', function (event) { return _this.onClick(event); });
    };
    FlashMessage.prototype.onClick = function (event) {
        event.preventDefault();
        this.hide();
    };
    FlashMessage.prototype.showFor = function (duration) {
        var _this = this;
        this.classList.add(this.name + "--show");
        this.durationTimeoutId = setTimeout(function () { return _this.hide(); }, duration);
    };
    FlashMessage.prototype.hide = function () {
        clearTimeout(this.durationTimeoutId);
        this.classList.remove(this.name + "--show");
    };
    return FlashMessage;
}(_models_component__WEBPACK_IMPORTED_MODULE_0__["default"]));
/* harmony default export */ __webpack_exports__["default"] = (FlashMessage);


/***/ }),

/***/ "./vendor/spryker-shop/shop-ui/src/SprykerShop/Yves/ShopUi/Theme/default/models/component.ts":
/*!***************************************************************************************************!*\
  !*** ./vendor/spryker-shop/shop-ui/src/SprykerShop/Yves/ShopUi/Theme/default/models/component.ts ***!
  \***************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _app_config__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../app/config */ "./vendor/spryker-shop/shop-ui/src/SprykerShop/Yves/ShopUi/Theme/default/app/config.ts");
var __extends = (undefined && undefined.__extends) || (function () {
    var extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();

var Component = (function (_super) {
    __extends(Component, _super);
    function Component() {
        var _this = _super.call(this) || this;
        _this.name = _this.tagName.toLowerCase();
        _this.jsName = "js-" + _this.name;
        document.addEventListener(Object(_app_config__WEBPACK_IMPORTED_MODULE_0__["get"])().events.ready, function () { return _this.readyCallback(); }, {
            capture: false,
            once: true
        });
        return _this;
    }
    return Component;
}(HTMLElement));
/* harmony default export */ __webpack_exports__["default"] = (Component);


/***/ })

}]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi92ZW5kb3Ivc3ByeWtlci1zaG9wL3Nob3AtdWkvc3JjL1NwcnlrZXJTaG9wL1l2ZXMvU2hvcFVpL1RoZW1lL2RlZmF1bHQvY29tcG9uZW50cy9tb2xlY3VsZXMvZmxhc2gtbWVzc2FnZS9mbGFzaC1tZXNzYWdlLnRzIiwid2VicGFjazovLy8uL3ZlbmRvci9zcHJ5a2VyLXNob3Avc2hvcC11aS9zcmMvU3ByeWtlclNob3AvWXZlcy9TaG9wVWkvVGhlbWUvZGVmYXVsdC9tb2RlbHMvY29tcG9uZW50LnRzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFBa0Q7QUFFbEQ7SUFBMEMsZ0NBQVM7SUFBbkQ7UUFBQSxxRUEyQkM7UUExQlkscUJBQWUsR0FBVyxJQUFJOztJQTBCM0MsQ0FBQztJQXZCYSxvQ0FBYSxHQUF2QjtRQUFBLGlCQUdDO1FBRkcsSUFBSSxDQUFDLFNBQVMsRUFBRSxDQUFDO1FBQ2pCLFVBQVUsQ0FBQyxjQUFNLFlBQUksQ0FBQyxPQUFPLENBQUMsS0FBSSxDQUFDLGVBQWUsQ0FBQyxFQUFsQyxDQUFrQyxDQUFDLENBQUM7SUFDekQsQ0FBQztJQUVTLGdDQUFTLEdBQW5CO1FBQUEsaUJBRUM7UUFERyxJQUFJLENBQUMsZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFVBQUMsS0FBWSxJQUFLLFlBQUksQ0FBQyxPQUFPLENBQUMsS0FBSyxDQUFDLEVBQW5CLENBQW1CLENBQUMsQ0FBQztJQUMxRSxDQUFDO0lBRVMsOEJBQU8sR0FBakIsVUFBa0IsS0FBWTtRQUMxQixLQUFLLENBQUMsY0FBYyxFQUFFLENBQUM7UUFDdkIsSUFBSSxDQUFDLElBQUksRUFBRSxDQUFDO0lBQ2hCLENBQUM7SUFFRCw4QkFBTyxHQUFQLFVBQVEsUUFBZ0I7UUFBeEIsaUJBR0M7UUFGRyxJQUFJLENBQUMsU0FBUyxDQUFDLEdBQUcsQ0FBSSxJQUFJLENBQUMsSUFBSSxXQUFRLENBQUMsQ0FBQztRQUN6QyxJQUFJLENBQUMsaUJBQWlCLEdBQUcsVUFBVSxDQUFDLGNBQU0sWUFBSSxDQUFDLElBQUksRUFBRSxFQUFYLENBQVcsRUFBRSxRQUFRLENBQUMsQ0FBQztJQUNyRSxDQUFDO0lBRUQsMkJBQUksR0FBSjtRQUNJLFlBQVksQ0FBQyxJQUFJLENBQUMsaUJBQWlCLENBQUMsQ0FBQztRQUNyQyxJQUFJLENBQUMsU0FBUyxDQUFDLE1BQU0sQ0FBSSxJQUFJLENBQUMsSUFBSSxXQUFRLENBQUMsQ0FBQztJQUNoRCxDQUFDO0lBQ0wsbUJBQUM7QUFBRCxDQUFDLENBM0J5Qyx5REFBUyxHQTJCbEQ7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FDN0I2QztBQVU5QztJQUFnRCw2QkFBVztJQUl2RDtRQUFBLFlBQ0ksaUJBQU8sU0FRVjtRQVBHLEtBQUksQ0FBQyxJQUFJLEdBQUcsS0FBSSxDQUFDLE9BQU8sQ0FBQyxXQUFXLEVBQUUsQ0FBQztRQUN2QyxLQUFJLENBQUMsTUFBTSxHQUFHLFFBQU0sS0FBSSxDQUFDLElBQU0sQ0FBQztRQUVoQyxRQUFRLENBQUMsZ0JBQWdCLENBQUMsdURBQU0sRUFBRSxDQUFDLE1BQU0sQ0FBQyxLQUFLLEVBQUUsY0FBTSxZQUFJLENBQUMsYUFBYSxFQUFFLEVBQXBCLENBQW9CLEVBQUU7WUFDekUsT0FBTyxFQUFFLEtBQUs7WUFDZCxJQUFJLEVBQUUsSUFBSTtTQUNiLENBQUMsQ0FBQzs7SUFDUCxDQUFDO0lBR0wsZ0JBQUM7QUFBRCxDQUFDLENBaEIrQyxXQUFXLEdBZ0IxRCIsImZpbGUiOiIuL2pzL3l2ZXNfZGVmYXVsdC45LmpzIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IENvbXBvbmVudCBmcm9tICcuLi8uLi8uLi9tb2RlbHMvY29tcG9uZW50JztcblxuZXhwb3J0IGRlZmF1bHQgY2xhc3MgRmxhc2hNZXNzYWdlIGV4dGVuZHMgQ29tcG9uZW50IHtcbiAgICByZWFkb25seSBkZWZhdWx0RHVyYXRpb246IG51bWJlciA9IDUwMDBcbiAgICBkdXJhdGlvblRpbWVvdXRJZDogYW55XG5cbiAgICBwcm90ZWN0ZWQgcmVhZHlDYWxsYmFjaygpOiB2b2lkIHtcbiAgICAgICAgdGhpcy5tYXBFdmVudHMoKTtcbiAgICAgICAgc2V0VGltZW91dCgoKSA9PiB0aGlzLnNob3dGb3IodGhpcy5kZWZhdWx0RHVyYXRpb24pKTtcbiAgICB9XG5cbiAgICBwcm90ZWN0ZWQgbWFwRXZlbnRzKCk6IHZvaWQge1xuICAgICAgICB0aGlzLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKGV2ZW50OiBFdmVudCkgPT4gdGhpcy5vbkNsaWNrKGV2ZW50KSk7XG4gICAgfVxuXG4gICAgcHJvdGVjdGVkIG9uQ2xpY2soZXZlbnQ6IEV2ZW50KTogdm9pZCB7XG4gICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgIHRoaXMuaGlkZSgpO1xuICAgIH1cblxuICAgIHNob3dGb3IoZHVyYXRpb246IG51bWJlcikge1xuICAgICAgICB0aGlzLmNsYXNzTGlzdC5hZGQoYCR7dGhpcy5uYW1lfS0tc2hvd2ApO1xuICAgICAgICB0aGlzLmR1cmF0aW9uVGltZW91dElkID0gc2V0VGltZW91dCgoKSA9PiB0aGlzLmhpZGUoKSwgZHVyYXRpb24pO1xuICAgIH1cblxuICAgIGhpZGUoKSB7XG4gICAgICAgIGNsZWFyVGltZW91dCh0aGlzLmR1cmF0aW9uVGltZW91dElkKTtcbiAgICAgICAgdGhpcy5jbGFzc0xpc3QucmVtb3ZlKGAke3RoaXMubmFtZX0tLXNob3dgKTtcbiAgICB9XG59XG4iLCJpbXBvcnQgeyBnZXQgYXMgY29uZmlnIH0gZnJvbSAnLi4vYXBwL2NvbmZpZyc7XG5cbmV4cG9ydCBpbnRlcmZhY2UgSUNvbXBvbmVudENvbnRydWN0b3Ige1xuICAgIG5ldygpOiBDb21wb25lbnRcbn1cblxuZXhwb3J0IGludGVyZmFjZSBJQ29tcG9uZW50SW1wb3J0ZXIge1xuICAgICgpOiBQcm9taXNlPHsgZGVmYXVsdDogSUNvbXBvbmVudENvbnRydWN0b3IgfT5cbn1cblxuZXhwb3J0IGRlZmF1bHQgYWJzdHJhY3QgY2xhc3MgQ29tcG9uZW50IGV4dGVuZHMgSFRNTEVsZW1lbnQge1xuICAgIHJlYWRvbmx5IG5hbWU6IHN0cmluZ1xuICAgIHJlYWRvbmx5IGpzTmFtZTogc3RyaW5nXG5cbiAgICBjb25zdHJ1Y3RvcigpIHtcbiAgICAgICAgc3VwZXIoKTtcbiAgICAgICAgdGhpcy5uYW1lID0gdGhpcy50YWdOYW1lLnRvTG93ZXJDYXNlKCk7XG4gICAgICAgIHRoaXMuanNOYW1lID0gYGpzLSR7dGhpcy5uYW1lfWA7XG5cbiAgICAgICAgZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcihjb25maWcoKS5ldmVudHMucmVhZHksICgpID0+IHRoaXMucmVhZHlDYWxsYmFjaygpLCB7XG4gICAgICAgICAgICBjYXB0dXJlOiBmYWxzZSxcbiAgICAgICAgICAgIG9uY2U6IHRydWVcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgcHJvdGVjdGVkIGFic3RyYWN0IHJlYWR5Q2FsbGJhY2soKTogdm9pZFxufVxuIl0sInNvdXJjZVJvb3QiOiIifQ==