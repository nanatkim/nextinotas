var alunos =  document.querySelectorAll(".aluno");// query selector lista todos os atributos do aluno
// . querySelector lista apenas o orimeiro atributo
var av1s = document.querySelectorAll(".info-av1");
var av2s = document.querySelectorAll(".info-av2");

for(var count = 0; count < alunos.length; count++){ //for each para listar um de cada
    var aluno = alunos[count];// coloca cada paciente pra ser listado coom o contador
    var contAv1 = 0;
    var contAv2 = 0;
    var count1 = 0;
    var count2 = 0;

    for(var i = 0; i < av1s.length; i++){
        var av1 = av1s.textContent;
        contAv1 = contAv1 + av1;
        count1 += count1;
    }

    for(var i = 0; i < av2s.length; i++){
        var av2 = av2s[i];
        contAv2 = contAv2 + av2[i];
        count2 += count2;
    }

    var tdAv1= aluno.querySelector(".info-av1");// cria variavel e aponta com o query selector
    var av1 = tdAv1.textContent;// manipula nova variavel com o conteudo da primeira variavel com o .textContent

    var tdAv2 = aluno.querySelector(".info-av2");
    var av2 = tdAv2.textContent;

    var tdAvf = aluno.querySelector(".info-avf");
    var avf = tdAvf.textContent;

    var mediaIndividual1 = aluno.querySelector(".mediaIndividual1");
    var indiv1 = mediaIndividual1.textContent;

    indiv1 = contAv1/count1;
    console.log(indiv1);

    var mediaIndividual2 = aluno.querySelector(".mediaIndividual2");
    var indiv2 = mediaIndividual2.textContent;

    indiv2 = contAv2/count2;

    var mediaFinal = aluno.querySelector(".mediafinal");
    var mediafinal = mediaFinal.textContent;

    var mediaAvs = aluno.querySelector(".info-mediaAv");
    var mediaavs = mediaAvs.textContent;

    if(avf == 0 || avf == null){
        mediafinal = (parseFloat(contAv1) + parseFloat(contAv2))/2;
    }else{
        mediafinal = ((parseFloat(contAv1) + parseFloat(contAv2))/2) + parseFloat(avf);
    }
}