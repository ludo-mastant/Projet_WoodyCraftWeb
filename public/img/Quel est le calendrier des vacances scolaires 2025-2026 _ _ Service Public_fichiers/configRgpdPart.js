/**chargement de orejime*/
require(['orejime/orejime', 'domReady', 'jquery'], function (orejime, domReady, $) {
  var orejimeConfig = {
    // Optional. You can customize the ID of the <div> that Orejime will create when starting up.
    // The generated <div> will be inserted at the beginning of the <body>.
    // If there is already a DOM element with this id, Orejime will use it instead of creating a new element.
    // defaults to "orejime".
    elementID: "orejime",

    // Optional. For accessibility's sake, the Orejime modal must know what is the element
    // containing your app or website. Orejime should *not* be in this element.
    // The idea is your DOM could look like this after Orejime is initialized:
    // <body>
    //      <div id="orejime">...</div>
    //      <div id="app">your actual website</div>
    // </body>
    //
    // It is highly recommended to set this option, even though it's not required.
    // defaults to undefined.
    appElement: "#orejime",

    // Optional. You can customize the name of the cookie that Orejime uses for storing
    // user consent decisions.
    // defaults to "orejime".
    cookieName: "SP_RGPD_OREJIME",

    // Optional. You can set a custom expiration time for the Orejime cookie, in days.
    // defaults to 365.
    cookieExpiresAfterDays: 182,

    // Optional. You can provide a custom function to serialize the cookie contents.
    stringifyCookie: function (contents) {
      var cookieValue = JSON.stringify(contents);
      var location = window.location.hostname.replace('lannuaire.', '');
      location = location.replace('www.', '');
      return cookieValue + "; domain=" + location;
    },

    // Optional. You can provide a custom function to unserialize the cookie contents.
    parseCookie: function (cookie) {
      return JSON.parse(cookie);
    },

    // You must provide a link to your privacy policy page
    privacyPolicy: "https://www.service-public.fr/P10001",

    // Optional. Applications configured below will be ON by default if default=true.
    // defaults to true
    default: true,

    // Optional. If "mustConsent" is set to true, Orejime will directly display the consent
    // manager modal and not allow the user to close it before having actively
    // consented or declined the use of third-party apps.
    // defaults to false
    mustConsent: false,

    // Optional. If "mustNotice" is set to true, Orejime will display the consent
    // notice and not allow the user to close it before having actively
    // consented or declined the use of third-party apps.
    // Has no effect if mustConsent is set to true.
    // defaults to false
    mustNotice: false,

    // Optional. If "implicitConsent" is set to true, Orejime will automatically accept
    // cookies if the user continues his navigation on the website after the
    // first page. If you enable this, you must warn the user
    // of this behavior in the notice window. You can do that easily by overriding
    // translation strings (see below).
    // defaults to false
    implicitConsent: false,

    // Optional. You can define the UI language directly here. If undefined, Orejime will
    // use the value given in the global "lang" variable, or fallback to the value
    // in the <html> lang attribute, or fallback to "en".
    lang: "fr",

    // Optional. You can pass an image url to show in the notice.
    // If the image is not exclusively decorative, you can pass an object
    // with the image src and alt attributes: `logo: {src: '...', alt: '...'}`
    // defaults to false
    logo: false,

    // Optional. Set Orejime in debug mode to have a few stuff
    // logged in the console, like warning about missing translations.
    // defaults to false
    debug: false,

    // You can overwrite existing translations and add translations for your
    // app descriptions and purposes. See `src/translations.yml` for a full
    // list of translations that can be overwritten
    translations: {
      fr: {
        poweredBy: false,
        accept: "Accepter",
        acceptAll: "Tout accepter",
        save: "Confirmer mes choix",
        decline: "Refuser",
        declineAll: "Tout refuser",
        consentNotice: {
          description: "Ce site utilise des cookies permettant de visualiser des contenus et d'améliorer le fonctionnement grâce aux statistiques de navigation. Si vous cliquez sur « Accepter », la Dila (éditeur du site Service-Public.fr) et ses partenaires déposeront ces cookies sur votre terminal lors de votre navigation. Si vous cliquez sur « Refuser », ces cookies ne seront pas déposés. Votre choix est conservé pendant 6 mois et vous pouvez être informé et modifier vos préférences à tout moment sur la page « Gérer les cookies »",
          learnMore: "Personnaliser"
        },
        consentModal: {
          title: "Gestion des cookies",
          description: "Un cookie est un fichier texte déposé sur votre ordinateur lors de votre visite sur le site. Il permet de conserver vos données de navigation. Cette page vous permet de donner ou de retirer votre consentement au dépôt de cookies."
        },

        app: {
          optOut: {
            title: ""
          },
          required: {
            title: ""
          },
          purposes: "Utilisations",
          purpose: "Utilisation"
        },
      },
    },

    // The list of third-party apps that Orejime will manage for you.
    // The apps will appear in the modal in the same order as defined here.
    apps: [
      {
        name: "internal-tracker",
        title: "Cookies techniques nécessaires au bon fonctionnement du site",
        description: "Ils permettent au site de fonctionner de manière optimale. Vous pouvez les supprimer depuis les paramètres de votre navigateur mais votre navigation sera dégradée.",
        // When deleting a cookie, Orejime will try to delete a cookie with the given name,
        // the "/" path, and multiple domains (the current domain and `"." + current domain`).
        // If an app sets a cookie on a different path or domain than that, Orejime won't be
        // able to delete it by itself without more info.
        // In this case, you can explicitely define a cookie, a path and domain:
        //cookies: ["*", "/", "." + location.hostname],
        required: true
      },
      {
        name: "eulerian",
        title: "Eulerian : mesure d’audience et d’utilisation du site  ",
        description: "Ils permettent d’obtenir des statistiques de fréquentation anonymes du site afin d’optimiser son ergonomie, sa navigation et ses contenus. <a href=\"https://www.eulerian.com/privacy/\" target=\"_blank\" title=\"Politique de confidentialité de Eulerian - nouvelle fenêtre\">Politique de confidentialité de Eulerian</a>",
        cookies: ["etuix"],
        optOut: false,
        default: true,
        callback: function (consent, app) {
          console.log("User consent for app " + app.name + ": consent=" + consent);
        }
      },
      {
        name: "ab-tasty",
        title: "AB Tasty",
        cookies: [
          "ABTasty",
          "ABTastySession"
        ],
        description: "Ils permettent de proposer, aléatoirement et pendant un temps limité, une version alternative de certaines pages du site. L’objectif est de tester l’efficacité de nouveautés ou d’optimiser les pages existantes du site. <a href=\"https://www.abtasty.com/fr/politique-protection-vie-privee/\" target=\"_blank\" title=\"politique de confidentialité du cookie AB Tasty - nouvelle fenêtre\">Politique de confidentialité de AB Tasty</a>",
        callback: function (consent, app) {
          console.log("User consent for app " + app.name + ": consent=" + consent);
        },
        optOut: false,
        default: false,
        onlyOnce: false
      },
      {
        name: "streaming-video",
        title: "Vidéos",
        description: "Ils permettent la lecture de vidéos sur le site Service-Public.fr en provenance de sites d’hébergement de contenus. <a href=\"https://policies.google.com/privacy\" target=\"_blank\" title=\"politique de confidentialité de YouTube - nouvelle fenêtre\">Politique de confidentialité de YouTube</a>",
        callback: function (consent, app) {
          var $videoOverlay = $("div.orejime-video-overlay, div.video-overlay");
          if (consent) {
            $videoOverlay.attr("hidden", "hidden");
            $videoOverlay.hide();
          } else {
            $videoOverlay.removeAttr("hidden");
            $videoOverlay.show();
          }
          console.log("User consent for app " + app.name + ": consent=" + consent);
        },
        optOut: false,
        default: false,
        onlyOnce: false
      },
    ],
  };

  domReady(function () {
    let orejimeInstance = orejime.init(orejimeConfig);

    let showOrejimeHandler = function () {
      setTimeout(function () {
        let $confirmButton = $("button.orejime-Modal-saveButton");
        $confirmButton.on("click", function (e) {
          let consent = false;
          consent = orejimeInstance.internals.manager.getConsent('eulerian');
          if (consent) {
            console.log("User consent is true for app Eulerian");
            window.dsfr.analytics.opt.enable();
            EA_push('onload', function () {
              EA_epmSetAllowAll();
              EA_epmEnd();
              _oEa.cookieset('EA_cookie_intermediaire', 1);
            });
          } else {
            window.dsfr.analytics.opt.disable();
          }
        });
        $("#orejime").removeAttr('aria-hidden');
        let $closeButton = $("button.orejime-Modal-closeButton");
        $closeButton.focus();
      }, 1);
    };

    let acceptVideoHandler = function (e, $elt) {
      e.preventDefault();
      $elt.parents("div.video-overlay").prev("iframe").focus();
      orejimeInstance.internals.config.apps
        .filter(function (app) {
          return app.name === "streaming-video";
        })
        .map(function (app) {
          orejimeInstance.internals.manager.updateConsent(app, true);
        });
      orejimeInstance.internals.manager.saveAndApplyConsents();

      return false;
    };

    let $acceptButton = $("button.orejime-Notice-saveButton");
    $acceptButton.on("click", function (e) {
      window.dsfr.analytics.opt.enable();
      EA_push('onload', function () {
        EA_epmSetAllowAll();
        EA_epmEnd();
        _oEa.cookieset('EA_cookie_intermediaire', 1);
      });
      orejimeInstance.internals.config.apps.map(function (app) {
        orejimeInstance.internals.manager.updateConsent(app, true);
      });
      orejimeInstance.internals.manager.saveAndApplyConsents();
    });

    let $declineButton = $("button.orejime-Button--decline");
    $declineButton.on("click", function (e) {
      window.dsfr.analytics.opt.enable();
      EA_push('onload', function () {
        EA_epmSetDenyAll();
        EA_epmEnd();
        _oEa.cookieset('EA_cookie_intermediaire', 0);
      });

      orejimeInstance.internals.manager.resetConsent();
      orejimeInstance.internals.config.apps
        .filter(function (app) {
          return app.name !== "eulerian";
        })
        .map(function (app) {
          orejimeInstance.internals.manager.updateConsent(app, false);
        });
      orejimeInstance.internals.manager.saveAndApplyConsents();
    });

    let $learnMoreButton = $("button.orejime-Notice-learnMoreButton");
    $learnMoreButton.removeAttr('role');
    $learnMoreButton.on("click", function (e) {
      showOrejimeHandler();
    });

    let $cookieFooterLink = $("a[title*='Gestion des cookies']");
    $cookieFooterLink.attr("href", "#");
    $cookieFooterLink.attr("role", "button");
    $cookieFooterLink.on("click", function (e) {
      e.preventDefault();
      orejimeInstance.show();
      showOrejimeHandler();
    });
    $cookieFooterLink.keyup(function (e) {
      if (e.keyCode === 32) {
        e.preventDefault();
        orejimeInstance.show();
        showOrejimeHandler();
        return false;
      }
    });
    $cookieFooterLink.keydown(function (e) {
      if (e.keyCode === 32) {
        return false;
      }
    });

    let $acceptVideoButton = $("a[data-test=accept-video-cookie]");
    let $divOrejimeCookies = $("div.orejime-cookies-unaccepted");
    $acceptVideoButton.on("click", function (e) {
      acceptVideoHandler(e, $(this));
      $divOrejimeCookies.focus();
    });
    $acceptVideoButton.keyup(function (e) {
      if (e.keyCode === 32) {
        acceptVideoHandler(e, $(this));
        return false;
      }
    });
    $acceptVideoButton.keydown(function (e) {
      if (e.keyCode === 32) {
        return false;
      }
    });
    EA_push('onload', function () {
      console.log("EA_push onload");
    });
  });
});
