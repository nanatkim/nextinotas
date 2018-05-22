var alunos =  document.querySelectorAll(".aluno");// query selector lista todos os atributos do aluno
var avalunos =  document.querySelector(".Avaluno");
// . querySelector lista apenas o orimeiro atributo

for(var count = 0; count < alunos.length; count++){ //for each para listar um de cada
    var aluno = alunos[count];// coloca cada aluno pra ser listado coom o contador
    var contAv1 = 0;
    var contAv2 = 0;
    var count1 = 0;
    var count2 = 0;
    var countAluno = 0;
    
    var av1s = aluno.querySelectorAll(".info-av1");
    var av2s = aluno.querySelectorAll(".info-av2");
    var tdAvf = aluno.querySelector(".info-avf");

    var avf = 0;
    if ($(".tdAvf")[0]){
        avf = tdAvf.textContent;
    }

    for(var i = 0; i < av1s.length; i++){
            count1 += 1;
            var av1 = av1s[i].textContent;
            contAv1 += parseFloat(av1);
    }

    var mediaIndividual1 = aluno.querySelector(".mediaIndividual1");
    mediaIndividual1.textContent = contAv1.toFixed(2);

    for(var i = 0; i < av2s.length; i++){
            count2 += 1;
            var av2 = av2s[i].textContent;
            contAv2 += parseFloat(av2);
            
    }

    var mediaIndividual2 = aluno.querySelector(".mediaIndividual2");
    mediaIndividual2.textContent = contAv2.toFixed(2);


    var mediaAvs = aluno.querySelector(".info-mediaAv");
    
    mediaAvs.textContent = ((parseFloat(mediaIndividual1.textContent) + parseFloat(mediaIndividual2.textContent))/2).toFixed(2);

    var mediaFinal = aluno.querySelector(".mediafinal");
    var mediafinal = mediaFinal.textContent;


    if(avf == 0 || avf == null){
        mediaFinal.textContent = parseFloat(mediaAvs.textContent).toFixed(2);
    }else{
        mediaFinal.textContent = ((parseFloat(mediaAvs.textContent) + parseFloat(tdAvf.textContent))/2).toFixed(2);
    }
    countAluno = count;

    console.log(countAluno);
}