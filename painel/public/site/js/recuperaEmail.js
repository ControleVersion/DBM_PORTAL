/*
var recuperaEmail = function(){
//este valor será passado para a página de cadastro
var email = $('.degustSubscribe').val();
document.cookie = "useremail=" + email;

// redireciona para a página de cadastro
window.location.href = "/registro#undefined2";
}
*/
function setCookie(c_name,value,exdays)
    {
      var exdate=new Date();
      exdate.setDate(exdate.getDate() + exdays);
      var c_value=escape(value) +
        ((exdays==null) ? "" : ("; expires="+exdate.toUTCString()));
      document.cookie=c_name + "=" + c_value;
    }

    function getCookie(c_name)
    {
     var i,x,y,ARRcookies=document.cookie.split(";");
     for (i=0;i<ARRcookies.length;i++)
     {
      x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
      y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
      x=x.replace(/^\s+|\s+$/g,"");
      if (x==c_name)
      {
       return unescape(y);
      }
     }
    }
