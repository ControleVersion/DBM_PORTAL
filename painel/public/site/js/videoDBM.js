function YTvideoStarter(idWrapper,idYT,idClique){
      //adiciona a imagem fornecida pelo youtube como img
      // ao receber um clique carrega o video do YT

      // idWrapper : elemento pai - wrapper da imagem
      var video = $(idWrapper);
      // idYT : id do video do YT que deve ser passado
      YTid = idYT;

      var filhos = video.children();
      img = filhos[1];
      //pega a imagem padrão do video do YT 
      // colocar com src do <img>
      img.src = "https://img.youtube.com/vi/"+ YTid +"/maxresdefault.jpg";
      // colocar um atribute data-yt =ara passar o valor do id e armazenar na teg
      img.dataset.yt = YTid; 
      // mqdefault.jpg => (320×180 pixels)
      // hqdefault.jp => (480×360 pixels)
      // sddefault.jpg =>  (640×480 pixels)
      // maxresdefault.jpg => (1920×1080 pixels)

      //evento click
      $(idClique).click(function(e){
            //recupera o local do click
            //e puxa o data-yt que contem o id do video
            YTid = e.target.nextElementSibling.dataset.yt;
      
            ///////////////////////////////////////////////////////////////////////////////
            // roberto estou tentando colocar esses videos reposivos
            // acrescentei a div com classes embed-responsive embed-responsive-16by9
            // conforme a API do bootstrap pede. 

            // ja tentei de tudo. Mas o iframe está herdando o tamanho de algum elemento
            // que não estou conseguindo identificar. 

            //percebi que o cara que fez o template mudou o css destas classes.
            //alguma ideia de como resolver?

            // isto está sendo aplicado no "index" e no "o curso"
            ///////////////////////////////////////////////////////////////////////////////

            var video = '<div class="embed-responsive embed-responsive-16by9">'+
            '<iframe class="embed-responsive-item" '+
            ' src="https://www.youtube.com/embed/'+YTid+'?autoplay=1"'+
            ' frameborder="0" disablekb="1" '+
            ' modestbranding="1" rel="0" showinfo ="0" iv_load_policy="3" allowfullscreen '+ 
            '"></iframe></div>';

            $(idWrapper).html(""); //limpa a div
            $(idWrapper).html(video); //carrega o novo conteudo incorporado
      });
}

// <div class="">
//   <iframe class="embed-responsive-item" src="..."></iframe>
// </div>