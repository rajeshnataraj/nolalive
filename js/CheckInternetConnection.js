// JavaScript Document
/*
    checknet jQuery plugin by Tom Riley
    v1.6 Feb 2013
    http://tomriley.net
    http://3rdwavemedia.com
*/
(function (b) {
    b.fn.checknet = function (a) {
        function c() {
            window.checknet.windowIsActive = document.hidden || document.mozHidden || document.webkitHidden || document.msHidden ? !1 : !0
        }

        function d(a) {
			//alert(window.checknet.windowIsActive);
            window.checknet.windowIsActive && b.ajax({
                url: a,
                cache: !1,
                type: "HEAD"
           }).done(function () {
                window.checknet.conIsActive = !0
            }).fail(function () {
                window.checknet.conIsActive = !1
            }).always(function () {
				
              if(window.checknet.conIsActive)
			  {
				 if(b('.white-overlay').length==1)
				  closeloadingalert();
				  ajaxclosingalert();
				var pagename= getPageName(ajaxCurrentRequest.url);
				var pagelink= ajaxCurrentRequest.url+"?"+ajaxCurrentRequest.data;
				/*if(ajaxCurrentRequest.url!='autocomplete.php' && ajaxCurrentRequest.data!='oper=lockstatus')
				setTimeout(function(){ showpages(pagename,pagelink); },1000); */
				ajaxcnt=0;
				 
				 
			  }
			  else 
			  {
				 if(b('.white-overlay').length==0)
				 showloadingalert(window.checknet.config.warnMsg);
				 setTimeout(function () {
                d(window.checknet.config.checkURL)
           }, window.checknet.config.checkInterval) 
			  }
            });
			  
        }
        a = a || {};
        a.checkURL = a.checkURL || window.location.href;
		
        a.checkInterval = a.checkInterval || 5E3;
        a.warnMsg = a.msg || "No Internet connection detected, disabled features will be re-enabled when a connection is detected. "; - 1 === a.checkURL.indexOf("http") && (a.checkURL = "http://" + a.checkURL);
        window.checknet = {
            windowIsActive: !0,
            conIsActive: !0,
            config: a
		
        };
        "undefined" !== typeof document.hidden ? document.addEventListener("visibilitychange", c) : "undefined" !== typeof document.webkitHidden ? document.addEventListener("webkitvisibilitychange", c) : "undefined" !== typeof document.mozHidden ? document.addEventListener("mozvisibilitychange", c) : "undefined" !== typeof document.msHidden && document.addEventListener("msvisibilitychange", c);
        d(window.checknet.config.checkURL)
	   /*setTimeout(function () {
                d(window.checknet.config.checkURL)
           }, 5000)*/ 
		
    }
})(jQuery);
