define(['jquery'], function ($) {
  "use strict";


  function forceReloadIframe(element) {
    $(element).find('iframe[data-test=testIframe]').toArray().forEach(function (iframe) {
      iframe.src += '';
    });
  }

  return {

    'initCollapseUncollapse': function () {
      let element;
        // Chapter "tout déplier/tout replier" accordéon dsfr
        $("[data-control-seeall-target]").on("click", function(e){
          e.stopPropagation();
          var scope = $(this).attr('data-control-seeall-target');
          if($(this).hasClass('js-see-all')) {
            // ouverture chapitre accordeon dsfr
             element = document.getElementById(scope);
            for (let i = 0; i < dsfr(element).accordionsGroup.members.length; i++) {
              dsfr(element).accordionsGroup.members[i].disclose();
            }
            $(this).removeClass('js-see-all').addClass('js-hide-all');
            $(this).html($(this).attr('data-label-fold'));
          } else {
            // fermeture chapitre accordeon dsfr
            element = document.getElementById(scope);
            for (let i = 0; i < dsfr(element).accordionsGroup.members.length; i++) {
              dsfr(element).accordionsGroup.members[i].conceal();
            }
            $(this).removeClass('js-hide-all').addClass('js-see-all');
            $(this).html($(this).attr('data-label-unfold'));
          }
        });




      // RGAA collapse
      $(".collapse").on("shown.bs.collapse", function (event) {
        $(this).attr("aria-hidden", false);
        forceReloadIframe(this);
      });

      $(".collapse").on("hidden.bs.collapse", function (event) {
        $(this).attr("aria-hidden", true);
      });
      $(".sp-btn-see-all").on("click", function (event) {
        setTimeout(() => {
        $(this).focus();
        }, 0);
      });

    }
  };

});
