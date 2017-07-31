$( document ).ready(function() {
 //define a marca dágua
 var cpfAluno = $('input[name="cpf-aluno"]').attr('value');
 var nomeAluno = $('input[name="nome-aluno"]').attr('value');
 var categoryId = $('input[name="categoryId"]').attr('value');
 var vdmask = '<span id="video-mask">'+
 '<span>exibição autorizada para: </span>'+
 '<span> </span>'+
 '<span id="aluno-nome"> '+nomeAluno+' </span>'+
 '<span> - </span>'+
 '<span id="aluno-cpf">'+cpfAluno +'</span>'+
 '<br>'+
 '<span class="dbm-copyright">Esse material possui copyright sua cópia ou transmissão em grupo não é autorizada</span>'+
 '</span>';

 //coloca a marca dágua no video
 var videoCtrls = $('#videoWrapper').children().children();
  if(parseInt(categoryId) != 1){
    videoCtrls.append(vdmask);
  }
 //quando a API do yt esta pronta
 $('.js-player').on('ready',function(){
   //alert("teste");
   //chama o objeto video
   var players = plyr.get('.js-player');

   ///////////////////////////////////////////////////////
   //pega a API
   // necessário trabalhar aqui para tirar a logo do YT
   var teste = players[0].getEmbed();

   teste.hideVideoInfo();
   var gi = teste.getIframe();
   gi.modestbranding = 1;
   ///////////////////////////////////////////////////////

   //pega o tempo pela API
   var tempo = players[0].getDuration();

   function formatTime(time){
   //formata o tempo para display na control bar
     time = Math.round(time);
     var minutes = Math.floor(time / 60),
     seconds = time - minutes * 60;
     seconds = seconds < 10 ? '0' + seconds : seconds;
     return minutes + ":" + seconds;
   }

   // colocar o tempo de duração na info
   $('#info-duracao').html(formatTime(tempo));
 })
});//ready jquery
