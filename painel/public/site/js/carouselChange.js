$( document ).ready(function() {
    // automatização dos carousels main e de depoimentos

	setInterval(function(){
    	
        //carousel principal
        var carousel = $(".swiper-pagination").children();
    	// testando qual é o elemento selecionado
    	for(i=0;i < carousel.length;i++){
    		var active = carousel[i].classList.contains("swiper-pagination-bullet-active");
    		// caso não tenha click
    		if (active == false){
    			carousel[i].click();
    			{ 
    				break; 
    			}
    		};
    	}


        //depoimentos
        var depoimentos = $('.owl-dots').children();

        for(i=0;i<depoimentos.length;i++){
            var depActive = depoimentos[i].classList.contains("active");
            if (depActive == true){
                // se não for o último
                if (i < (depoimentos.length - 1)){
                    depoimentos[i+1].click();
                    {
                        break;
                    }
                }else{
                    depoimentos[0].click();
                    {
                        break;
                    }
                };    
            }
        }
	},10000);


});




