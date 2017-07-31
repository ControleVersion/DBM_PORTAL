//recuoera o valor do cookie para colocar no input de email
var useremail = document.cookie;
  var useremail = useremail.split(';');

  var getEmail = getCookie('useremail');
  $('#form-register-email').attr('value', getEmail);
  function searchStringInArray (str, strArray) {
    for (var j=0; j<strArray.length; j++) {
      if (strArray[j].match(str)){
        var emailVal = strArray[j].split('=');
        $('#form-register-email').val(getEmail);
        $('#form-register-email').attr('value', getEmail);
        $('#form-register-nome').focus();
      }
    }
  }

  searchStringInArray('useremail',useremail);
