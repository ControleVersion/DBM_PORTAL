$(document).ready(function () {
  //detect se o browser é mobile
  var mobileDetect = function detectmob() { 
    if( navigator.userAgent.match(/Android/i)
    || navigator.userAgent.match(/webOS/i)
    || navigator.userAgent.match(/iPhone/i)
    || navigator.userAgent.match(/iPad/i)
    || navigator.userAgent.match(/iPod/i)
    || navigator.userAgent.match(/BlackBerry/i)
    || navigator.userAgent.match(/Windows Phone/i)
    ){
      return true;
    }
    else {
      return false;
    }
  } 

  var isMobile = mobileDetect();
  if (isMobile == true){
    $('#mainTitleDBM').css("font-size","20px");
    $('#mainTitleDBM').css("margin-bottom","0px");
    $('#vmap').css("height","300px");
    $('#vmap').css("width","100%");
  }

  // função para gerar o mapa SVG do brasil
  function mapaBrazil(label){
    $('#vmap').vectorMap({
      map: 'brazil_br',
      showTooltip: true,
      backgroundColor: '#1072c0',
      hoverColor: '#1072c0',
      enableZoom: false,
      selectedColor: '#fff',
      borderWidth: 2,
      showLabels: label,
      color: '#0094d9',
      borderColor: '#fff',
      
      onRegionClick: function (element, code, region) {
        var local = region;
        //so para o mobile para estilização
        var isMobile = mobileDetect();
        //print local clicado
        $('.dbmicos-localidade').text(local);
        if (isMobile == true){
          //chama o modal
          $('#DBMmodalFakeClick').click();
        }     
      },
    });
  };


  //chama a função para criar o mapa.
  //sendo mobile tira os labels
  if (isMobile == true){
     mapaBrazil(false);
  }else{
     mapaBrazil(true);
  }

  ////////////////////////////////////////////////////////////
  //estilo
  $('#vmap path').hover(function(){
    var estado = $(this).attr('id');
    estado = estado.split('_');
    estado = estado[1];
    var pin = '#jqvmap1_'+ estado + '_pin';
    //seleciona o pin correspondente
    pin = $(pin);
    pin.css('color','#1072c0');
    pin.css('backgroundColor','#fff')
  });

  $('#vmap path').mouseout(function(){
    var estado = $(this).attr('id');
    estado = estado.split('_');
    estado = estado[1];
    var pin = '#jqvmap1_'+ estado + '_pin';
    //seleciona o pin correspondente
    pin = $(pin);
    pin.css('color','#fff');
    pin.css('backgroundColor','rgba(0,0,0,0.5)')
  });
  ///////////////////////////////////////////////////////////////////////

  //////////////////////////////////////////////////////////////////////////////
  // path do JSON
  PATH_json = 'site/js/ajax.php';
  ///////////////////////////////////////////////////////////////////////////////

  function chamaJsonDBMicos(estado){
    //contador de alunos retornados para o estado
    var count_alunos = 0;
      $.getJSON(PATH_json, function(alunos){
        $('.lista-dbmicos-brasil').html("");//limpar anterior
        //varrendo o json
        for(y=0; y < alunos.length; y++){
          if(alunos[y].estado === estado){
            //CARREGANDO O CONTEUDO VARRENDO DO OBJETO PELO CLICK
            var htmlAlunos ='<li class="lista-dbmicos-brasil-item">'+
              '<div class="text-left unit unit-horizontal txt-branco">'+
                '<div class="unit-left">'+
                  '<img src="'+alunos[y].imagem+'" width="60" height="60" alt="" class="img-responsive reveal-inline-block img-circle">'+
                '</div>'+
                '<div class="lista-dbmicos-info">'+
                  '<cite class="font-accent lista-dbmicos-info-nome">'+alunos[y].nome+'</cite>'+
                  '<div class="offset-top-5">'+
                    '<p class="text-italic">'+
                      '<span class="lista-dbmicos-info-profissao">'+alunos[y].profissao+'</span><span>, </span>'+
                      '<span class="lista-dbmicos-info-cidade">'+alunos[y].municipio+'</span>'+
                      '<span>- </span>'+
                      '<span class="lista-dbmicos-info-estado">'+alunos[y].estado.toUpperCase()+'</span>'+
                    '</p>'+
                  '</div>'+
                  '<div class="offset-top-10 offset-sm-top-10">'+
                    '<ul class="list-inline list-inline-xs list-inline-madison">'+
                      '<li>'+
                        '<a href="'+alunos[y].facebook+'" class="lista-dbmicos-info-fb icon icon-xxs fa-facebook icon-circle icon-gray-light-filled"></a>'+
                      '</li>'+
                      '<li>'+
                      '<a href="'+alunos[y].instagran+'" class="lista-dbmicos-info-inst lista-dbmicos-info-gp icon icon-xxs fa-instagram icon-circle icon-gray-light-filled"></a>'+
                      '</li>'+
                    '</ul>'+
                  '</div>'+
                '</div>'+
              '</div>'+
            '</li>';
            count_alunos = count_alunos + 1;

            //inserir os lementos na lista
            $('.lista-dbmicos-brasil').append(htmlAlunos);
          }//end if
        }//end for

        // caso não existam alunos para regigão selecionada retorne a seguinte frase.
        if(count_alunos == 0){
          htmlAlunos = "<li class='DBMicos_Null alert alert-info text-center'>Ainda não existem DBMicos neste estado.</li>";
          //insire na lista
          $('.lista-dbmicos-brasil').html(htmlAlunos);
        }
      });
    }//end function
    //////////////////////////////////////////////////

  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //selecinado pelo select
  $('#form-register-estado').change(function(){
    //recupera a sigla do estado
    estado = $(this).val();
    //recupera o elemento option a partir do estado selecionado
    selecao = 'option[value='+ estado +']';
    //recupera o nome do estado
    estado_nome = $(selecao).text(); 
    //printa
    $('.dbmicos-localidade').text(estado_nome);

    //varre o json
    chamaJsonDBMicos(estado);

    local = '#jqvmap1_'+ estado;
    
    //clica no estado e chama o modal
    $(local).click();

  });
  //////////////////////////////////////////////////////////////////////////////////

  //////////////////////////////////////////////////////////////////////////////////
  //selecionado pelo clique no mapa
  $('#vmap path').click(function(){
    //contador de alunos retornados para o estado
    var count_alunos = 0;
    var estado = $(this).attr('id');
    estado = estado.split('_');
    estado = estado[1];

    //varre o json
    chamaJsonDBMicos(estado);    
  });
  //////////////////////////////////////////////////////////////////////////////////

  
});//end jQuery start function
