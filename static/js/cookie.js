
var Cookie = {
    cookie_filter   : PROJECT_NAME + '_filter',
    cookie_18_years : PROJECT_NAME + '_visit',
    cookie_pref     : PROJECT_NAME + '_',
            
    setCookie:
        function(cname, cvalue, expires_days)
        {
            if (expires_days == undefined)
            {
                expires_days = 3 * 30;  // 3 monthes
            }
            var d = new Date();
            d.setTime(d.getTime() + (expires_days*24*60*60*1000));
            var expires = "expires="+d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires;
        },
        
    getCookie:
        function(cname)
        {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i=0; i<ca.length; i++)
            {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1);
                if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
            }
            return "";
        }
}