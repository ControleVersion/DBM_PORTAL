// realiza o scroll de página de maneira suave
// só incluir a classe scrollSuave no <a>
var doc = $('html, body');
$('.scrollSuave').click(function() {
  doc.animate({
      scrollTop: $( $.attr(this, 'href') ).offset().top
  }, 1000);
  return false;
});