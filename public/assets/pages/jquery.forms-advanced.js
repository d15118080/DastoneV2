/**
 * Theme: Dastone - Responsive Bootstrap 5 Admin Dashboard
 * Author: Mannatthemes
 * Form Advanced Js
 */





!function($) {
  "use strict";

  var AdvancedForm = function() {};

  AdvancedForm.prototype.init = function() {
      $("input[name='commission']").TouchSpin({
          min: 0,
          max: 100,
          step: 0.1,
          decimals: 2,
          boostat: 5,
          maxboostedstep: 10,
          postfix: "%",
          buttondown_class: "btn btn-primary",
          buttonup_class: "btn btn-primary",
      });
  },
  //init
  $.AdvancedForm = new AdvancedForm, $.AdvancedForm.Constructor = AdvancedForm
}(window.jQuery),

//initializing
function ($) {
  "use strict";
  $.AdvancedForm.init();
}(window.jQuery);

