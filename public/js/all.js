var _typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},Confirmation=function(){function e(e,t){i.data("form-id","#"+e.attr("id")),i.data("callback-function",function(e,o){switch(o.status){case 422:Utility.displayErrorMessageBox(Object.values(o.responseJSON.errors).join("<br>"));break;case 200:if(o.hasOwnProperty("responseJSON")){var a=o.responseJSON;!0===a.success?(Utility.displaySuccessMessageBox(a.message),t.submit()):Utility.displayErrorMessageBox(a.message)}else Utility.displayJsonResponseError(o,e.attr("action"));break;default:Utility.displayUnknownError(o,e.attr("action"))}}),a.html(e.data("deletion-confirmation-message")+e.data("info")+"?"),o.modal()}function t(){i.click(function(e){e.preventDefault(),o.modal("toggle"),Utility.submitForm($(i.data("form-id")),i.data("callback-function"))})}var o=$("#confirmation-box"),a=$("#confirmation-text"),i=$("#yes-answer");return{confirmToDelete:e,initialize:t}}(jQuery),Form=function(){function e(){$("#join-form").click(function(e){window.console.log("test")}),t.submit(function(e){e.preventDefault(),Utility.submitForm($(this))}),o.submit(function(e){var t=this;e.preventDefault(),_submitEvent=function(){Utility.submitForm($(t))}}),i.on("click",function(e){e.preventDefault(),$(this).closest("form").submit()}),Search.SearchForm.submit(function(e){e.preventDefault(),window.console.log("submit"),Search.submitForm($(this))}),Search.ResultDiv.on("submit",a,function(e){e.preventDefault(),Confirmation.confirmToDelete($(this),Search.SearchForm)}),$(".deletion").submit(function(e){e.preventDefault(),Confirmation.confirmToDelete($(this),Search.SearchForm)})}var t=$(".submission-form"),o=$(".recaptcha-form"),a=".deletion",i=$(".form-submit");return{initialize:e}}(jQuery),Menu=function(){function e(){$(".parent").click(function(){$(".dropdown").is(":visible")?$(".dropdown").hide():$(".dropdown").css("display","block")}),$(".parent-mobile").click(function(){$(".dropdown-mobile").is(":visible")?$(".dropdown-mobile").hide():$(".dropdown-mobile").css("display","block")})}return{initialize:e}}(jQuery),Search=function(){function e(e){a.removeClass("alert"),Utility.submitForm(e,function(e,t){switch(Utility.clearErrors(),t.status){case 422:Utility.displayInvalidInputs(t.responseJSON),a.html("");break;case 200:$("#content-list-box").empty(),$("#content-list-box").html(t.responseJSON.data),$(".gif-loader").hide(),$("input[name=search]").empty();break;default:var o=t.statusText;t.hasOwnProperty("responseJSON")&&t.responseJSON.hasOwnProperty("message")&&(o=t.responseJSON.message),a.html(Translator.translate("error")+" "+o).addClass("alert")}})}function t(){a.on("click",".pagination a",function(t){t.preventDefault();var o=document.createElement("form");o.setAttribute("method","GET"),o.setAttribute("action",$(this).attr("href")),e($(o))})}function o(){t()}var a=$("#search-result"),i=($("#give-result-box"),$("#receive-result-box"),$("#search-form"));$("#search-form-detail");return{ResultDiv:a,SearchForm:i,initialize:o,submitForm:e}}(jQuery),Translator=function(){function e(){$.holdReady(!0);var e=[];Laravel.languageCodes.forEach(function(t){e.push($.getJSON("/languages/"+t+".json",{timestamp:Date.now()}))}),$.when.apply(this,e).then(function(){for(var e=0;e<arguments.length;e++)o.add({language:Laravel.languageCodes[e],data:arguments[e][0]});o.useLanguage(Laravel.currentLanguage)},function(){Utility.displayErrorMessageBox("Error! Failed to load some translation files, please contact the system administrator.")}).always(function(){$.holdReady(!1)})}function t(e){return o.translate(e)}var o=JSTranslate.i18n({language:Laravel.languageCodes,defaultLanguage:Laravel.defaultLanguage});return{initialize:e,translate:t}}(jQuery),Utility=function(){function e(e,t){a(),g.html(e),g.hasClass("alert")?t||(m.html(Translator.translate("utility.result.success")),g.removeClass("alert")):t&&(m.html(Translator.translate("utility.result.error")),g.addClass("alert")),d.modal()}function t(t){e(t,!1)}function o(t){e(t,!0)}function a(){$(":input").removeClass("error"),$(".alert.help-text").addClass("d-none")}function i(e){if(a(),e.hasOwnProperty("errors")){var t=0;for(var o in e.errors){var i=e.errors[o],n=/^[^.]+\.\d+$/.test(o)?o.replace(".",""):$('[name="'+o+'"]').attr("id"),r="object"===(void 0===i?"undefined":_typeof(i))?i[0]:i;if(n)$("#"+n).addClass("error"),$("#"+n+"-help-text").text(r).removeClass("d-none"),"budget_type"!==o&&"milerate_subtype"!==o&&"taxi_subtype"!==o&&"biketaxi_subtype"!==o||($("#"+o).addClass("error"),$("#"+o+"-help-text").text(r).removeClass("d-none")),$("#toggle-error-message").length&&0===t&&("milerate_subtype"===o||"taxi_subtype"===o||"biketaxi_subtype"===o?$("html, body").animate({scrollTop:$("#"+o+"-help-text").offset().top},1e3):$("html, body").animate({scrollTop:$("#"+n).offset().top},1e3));else{var s=$('[name="'+o+'[]"]').parents(".checkbox-group").attr("id");$("#"+s+"-help-text").text(r).removeClass("d-none")}t++}}}function n(e,t){a();var i="<h5>"+Translator.translate("utility.calling_system_administrator")+"</h5>";i+="<strong>"+Translator.translate("utility.error_url")+"</strong> "+t+"<br>",i+="<strong>"+Translator.translate("utility.error_status_code")+"</strong> "+e.status+"<br>",i+="<strong>"+Translator.translate("utility.error_status_text")+"</strong> "+e.statusText+"<br>",o(i)}function r(e,t){e.statusText=Translator.translate("utility.json_response_error"),n(e,t)}function s(e,a){switch(a.status){case 422:case 429:i(a.responseJSON);break;case 200:if(a.hasOwnProperty("responseJSON")){var s=a.responseJSON;!0===s.success?s.hasOwnProperty("message")?(d.on("hidden.bs.modal",function(){s.redirectedUrl?location.href=s.redirectedUrl:e.trigger("reset")}),t(s.message)):s.redirectedUrl&&(location.href=s.redirectedUrl):o(s.message)}else r(a,e.attr("action"));break;default:a.hasOwnProperty("responseJSON")&&a.responseJSON.hasOwnProperty("message")?o(a.responseJSON.message):n(a,e.attr("action"))}}function l(e,t,o){"function"==typeof o?o.apply(this,[e,t]):s(e,t)}function c(e){return"GET"===e.attr("method")?e.serialize():new FormData(e.get(0))}function u(e,t){$.ajax({url:e.attr("action"),method:e.attr("method"),data:c(e),cache:!1,contentType:!1,processData:!1,success:function(o,a,i){l(e,i,t)},error:function(o){l(e,o,t)}})}var d=$("#result-box"),m=$("#result-title"),g=$("#result-text");return{submitForm:u,displaySuccessMessageBox:t,displayErrorMessageBox:o,displayInvalidInputs:i,displayUnknownError:n,displayJsonResponseError:r,clearErrors:a,ResultBoxSelector:d,takeSubmitAction:s,runCallbackFunction:l,getFormData:c}}(jQuery),PasswordToggle=function(){function e(){$("#password-field").click(function(){$(".fa-eye").length?($("#password-field").html(""),$("#password-field").html('<i class="fa fa-eye-slash"></i>'),$("#password").attr("type","text")):($("#password-field").html(""),$("#password-field").html('<i class="fa fa-eye"></i>'),$("#password").attr("type","password"))})}return{initialize:e}}(jQuery),Footer=function(){function e(){$(".redirect_to").length&&$(".redirect_to").change(function(){"_blank"===$(this).attr("target")?window.open($(this).val(),"_blank"):window.location=$(this).val()}),$(window).resize(function(){$(window).width()<=768&&($(".menu-two-title").click(function(){$(".menu-one").hide(),$(".menu-two").show(),$(".menu-two-title").addClass("active"),$(".menu-one-title").removeClass("active")}),$(".menu-one-title").click(function(){$(".menu-two").hide(),$(".menu-one").show(),$(".menu-one-title").addClass("active"),$(".menu-two-title").removeClass("active")}))}),$(document).on("click",".pick-flavor",function(){var e=$(this).attr("data-url");window.location=e})}return{initialize:e}}(jQuery),SkinToggle=function(){function e(){$(document).ready(function(){var e=localStorage.getItem("skin");window.console.log(e),"light-mode"===e||null===e?($("#skin-toggle").prop("checked",!1),$("#skin-toggle-body").prop("checked",!1),$("body").removeClass("dark-mode"),$(".sun-image").attr("src","/../images/sun.svg"),$(".moon-image").attr("src","/../images/moon.svg"),$(".slider").css("background-image","url(/../images/slider-text.png)")):($("#skin-toggle").prop("checked",!0),$("#skin-toggle-body").prop("checked",!0),$("body").addClass("dark-mode"),$(".sun-image").attr("src","/../images/day.svg"),$(".moon-image").attr("src","/../images/night.svg"),$(".sun-image").css("width","20px"),$(".moon-image").css("width","17px"),$(".slider").css("background-image","url(/../images/slider-text-white.png)"))}),$("#skin-toggle").click(function(){1==$(this).prop("checked")?($("body").addClass("dark-mode"),$(".sun-image").attr("src","/../images/day.svg"),$(".moon-image").attr("src","/../images/night.svg"),$(".sun-image").css("width","20px"),$(".moon-image").css("width","17px"),$(".slider").css("background-image","url(/../images/slider-text-white.png)"),localStorage.removeItem("skin"),localStorage.setItem("skin","dark-mode")):0==$(this).prop("checked")&&($("body").removeClass("dark-mode"),$(".sun-image").attr("src","/../images/sun.svg"),$(".moon-image").attr("src","/../images/moon.svg"),$(".slider").css("background-image","url(/../images/slider-text.png)"),localStorage.removeItem("skin"),localStorage.setItem("skin","light-mode"))}),$("body #skin-toggle-body").click(function(){1==$(this).prop("checked")?($("body").addClass("dark-mode"),$(".sun-image").attr("src","/../images/day.svg"),$(".moon-image").attr("src","/../images/night.svg"),$(".sun-image").css("width","20px"),$(".moon-image").css("width","17px"),$(".slider").css("background-image","url(/../images/slider-text-white.png)"),localStorage.removeItem("skin"),localStorage.setItem("skin","dark-mode")):0==$(this).prop("checked")&&($("body").removeClass("dark-mode"),$(".sun-image").attr("src","/../images/sun.svg"),$(".moon-image").attr("src","/../images/moon.svg"),$(".slider").css("background-image","url(/../images/slider-text.png)"),localStorage.removeItem("skin"),localStorage.setItem("skin","light-mode"))})}return{initialize:e}}(jQuery),Fonts=function(){function e(){$(document).ready(function(){var e=localStorage.getItem("fontSize"),t=localStorage.getItem("fontRange");$("p").css("font-size",e+"px"),$("a").css("font-size",e+"px"),$("#font-range").val(t)}),$("body #font-range").on("input",function(){localStorage.removeItem("fontRange"),localStorage.setItem("fontRange",$(this).val()),1==$(this).val()&&($("p").css("font-size","16px"),$("a").css("font-size","16px"),localStorage.removeItem("fontSize"),localStorage.setItem("fontSize",16)),2==$(this).val()&&($("p").css("font-size","21px"),$("a").css("font-size","21px"),localStorage.removeItem("fontSize"),localStorage.setItem("fontSize",21)),3==$(this).val()&&($("p").css("font-size","26px"),$("a").css("font-size","26px"),localStorage.removeItem("fontSize"),localStorage.setItem("fontSize",26))}),$("body #font-range-mobile").on("input",function(){1==$(this).val()&&($("p").css("font-size","16px"),$("a").css("font-size","16px"),localStorage.removeItem("fontSize"),localStorage.setItem("fontSize",16)),2==$(this).val()&&($("p").css("font-size","21px"),$("a").css("font-size","21px"),localStorage.removeItem("fontSize"),localStorage.setItem("fontSize",21)),3==$(this).val()&&($("p").css("font-size","26px"),$("a").css("font-size","26px"),localStorage.removeItem("fontSize"),localStorage.setItem("fontSize",26))})}return{initialize:e}}(jQuery),LazyLoad=function(){function e(){$(".gif-loader").hide(),$("body").on("touchmove",t),$(window).on("scroll",o)}function t(){if($("#loadMore").length&&$(window).scrollTop()<$(window).height()-$(document).height()){Utility.clearErrors();var e=$("#loadMore").data("url");$("#loadMore").remove(),$(document).ajaxStart(function(){$(".gif-loader").show()}).ajaxStop(function(){$(".gif-loader").hide()}),$.ajax({url:e,method:"GET",cache:!1,contentType:!1,processData:!1,success:function(t){e?($("#loadMore").remove(),$("#content-list-box").append(t.data)):$("#loadMore").hide()}})}}function o(){if($("#loadMore").length&&$(document).height()>=$(window).scrollTop()+$(window).height()){Utility.clearErrors();var e=$("#loadMore").data("url");$("#loadMore").remove(),$(document).ajaxStart(function(){$(".gif-loader").show()}).ajaxStop(function(){$(".gif-loader").hide()}),$.ajax({url:e,method:"GET",cache:!1,contentType:!1,processData:!1,success:function(t){$(".gif-loader").remove(),e?($("#loadMore").remove(),$("#content-list-box").append(t.data)):$("#loadMore").hide()}})}}return{initialize:e}}(jQuery),SpinnerSelector=$("#spinner, #spinner-popup");Translator.initialize(),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$(document).ajaxStart(function(){SpinnerSelector.show()}).ajaxComplete(function(){SpinnerSelector.hide()}).ready(function(){Menu.initialize(),Search.initialize(),Confirmation.initialize(),Form.initialize(),Footer.initialize(),PasswordToggle.initialize(),SkinToggle.initialize(),Fonts.initialize(),LazyLoad.initialize()});
