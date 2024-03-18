		tarteaucitron.services.partagereseaux = {
  "key": "partagereseaux",
  "type": "social",
  "name": "Partage réseaux sociaux",
  "needConsent": true,
  "cookies": ['_pinterest_sess', '_pinterest_cm','_auth','datr','sb'],  
  "readmoreLink": "/custom_read_more", // If you want to change readmore link
  "js": function () {
    "use strict";
	   // When user allow cookie
  tarteaucitron.reloadThePage = true;
  },
  "fallback": function () {
    "use strict";
	 // when use deny cookie   
		   tarteaucitron.fallback(['social-media-sharing'], function (x) {
           return '<div class="partage_disabled"></div>';
        });
  }
};

tarteaucitron.services.remotevideo = {
	"key": "remotevideo",
	"type": "video",
	"name": "Vidéo et collecte publicitaire associée",
	"needConsent": true,
	"cookies": ['YSC', 'CONSENT','VISITOR_INFO1_LIVE'],  
	"readmoreLink": "/custom_read_more", // If you want to change readmore link
	"js": function () {
	  "use strict";
		 // When user allow cookie
	tarteaucitron.reloadThePage = true;
	},
	"fallback": function () {
	  "use strict";
	   // when use deny cookie
			 tarteaucitron.fallback(['remotevideo'], function (x) {
			 return '<div class="remote_video_disabled"></div>';
		  });
	}
  };	

	tarteaucitron.init({
    	  "privacyUrl": "/mentions-legales", /* Privacy policy url */

    	  "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
    	  "cookieName": "prefcookies", /* Cookie name */

    	  "orientation": "bottom", /* Banner position (top - bottom) */
		  "groupServices": false,

    	  "showAlertSmall": false, /* Show the small banner on bottom right */
		  "cookieslist": false, /* Show the cookie list */

		  "closePopup": false,

		  "showIcon": false, 
    	  "adblocker": false, /* Show a Warning if an adblocker is detected */
    	  "AcceptAllCta" : true, /* Show the accept all button when highPrivacy on */
    	  "highPrivacy": true, /* Disable auto consent */
    	  "handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */

    	  "removeCredit": true, /* Remove credit link */
    	  "moreInfoLink": false, /* Show more info link */

		  "useExternalCss": false, /* If false, the tarteaucitron.css file will be loaded */
          "useExternalJs": false, /* If false, the tarteaucitron.js file will be loaded */

    	  //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for multisite */
                          
        //  "readmoreLink": "/mentions-legales/", /* Change the default readmore link */

          "mandatory": true, /* Show a message about mandatory cookies */
        });	
		
		
