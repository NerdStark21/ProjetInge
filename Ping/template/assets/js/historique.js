
////// Affichage et gestion du tableau /////////////////

let listMonth = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

let listEnergyTest2017 = {"water" : [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                  "electricity" : [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
                  "gas" : [25, 26, 27, 28, 32, 30, 31, 32, 33, 34, 35, 36]};
let listEnergyTest2018 = {"water" : [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
                  "electricity" : [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                  "gas" : [25, 26, 27, 28, 32, 30, 31, 32, 33, 34, 35, 36]};
let listEnergyTest2019 = {"water" : [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                  "electricity" : [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
                  "gas" : [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]};

let listCompareTest2018 = {"water" : [25, 26, 27, 28, 32, 30, 31, 32, 33, 34, 35, 36],
                  "electricity" : [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
                  "gas" : [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]};

let listEnergyTest = {  2017 : listEnergyTest2017,
                        2018 : listEnergyTest2018,
                        2019 : listEnergyTest2019};

let listCompareTest = { 2017 : listCompareTest2018,
                        2018 : listCompareTest2018, 
                        2019 : listCompareTest2018};

let energyType = ["water", "electricity", "gas"];
let annee = 2018;

$(document).ready(function (){

console.log("READY");
// Pour afficher tous les mois dans le tableau
for(let k=0; k<12;k++){
    let clone = $(".monthClone").clone();
    clone.removeClass("monthClone");
    clone.text(listMonth[k]);
    //clone.css("text-align: center;")
    $(".ligne_header").append(clone);
}

remplirTableau(listEnergyTest[annee], listCompareTest[annee]);

$("#nextYear, #previousYear").click(function(event){
    if(event.target.id == "nextYear"){annee += 1;}
    else{annee -= 1;}
    viderTableau();
    remplirTableau(listEnergyTest[annee], listCompareTest[annee]);
});

$("#historique, #blank").click(function(event){
    let newPage = (event.target.id == "historique")?"historique.html":"blank.html";
    actualisation(newPage);
});

function actualisation(newPage){
    console.log(newPage);
    $.ajax({
       url : newPage,
       type : 'GET',
       dataType : 'html',
       success : function(code_html, statut){
            $("#body").empty();
            $(code_html).appendTo("#body"); // On passe code_html à jQuery() qui va nous créer l'arbre DOM !
       },
       error : function(resultat, statut, erreur){
         
       },
       complete : function(resultat, statut){

       }
    });
}

function remplirTableau(listEnergy, listCompare){
    
    $("#year").text(annee);     // On met la bonne année
    console.log(listEnergy);
    for (j=0;j<3;j++){
        //console.log(energyTypeTest[j], listEnergyTest, listCompareTest);
        remplirLigne(energyType[j], listEnergy, listCompare);
    }
}

function viderTableau(){
    for (j=0;j<3;j++){
        $('tr td[class~="value"]').remove();
    }
}

function remplirLigne(energy, listEnergy, listCompare){
    for(k=0;k<12;k++){
        let clone = $(".".concat(energy)).find(".valueClone").clone();
        clone.removeClass("valueClone");
        let actualEnergy = listEnergy[energy][k];
        let previousEnergy = listCompare[energy][k];
        if(actualEnergy <= 1.05*previousEnergy){
            clone.addClass("green value");
        }
        else if(actualEnergy <= 1.15*previousEnergy){
            clone.addClass("orange value");
        }
        else{
            clone.addClass("red value");
        }
        clone.text(actualEnergy);
        $(".".concat(energy)).append(clone);
    }
};
})

//////// Affichage et gestion des flags ///////////////////

// C'est les dates anglo-saxones Mois/Jour/Année
let listFlag2018 = {"energy": ["water", "electricity"],
                    "date": ["01/01/2018", "02/01/2018"],
                    "action": [["changer radiateur"], ["manger le chat", "manger le chien"]]};
function afficherFlag(){
  for(k=0; k<listFlag2018["date"].length;k++){
    let clone = $(".flagClone").clone();
    clone.removeClass("flagClone");
    clone.addClass("msg".concat(k));
    clone.addClass("flag");
    var date = new Date(listFlag2018["date"][k]);
    if(k>0){
      var previousdate = new Date(listFlag2018["date"][k-1]);
      console.log(date.getMonth());
      console.log(previousdate.getMonth());
      clone.css('margin-left', ''.concat((date.getMonth()-previousdate.getMonth()-1)*7.69).concat('%'));
    }
    else{
      clone.css('margin-left', ''.concat((date.getMonth()+1)*7.69).concat('%'));
    }
    var txt = "";
    for(j=0;j<listFlag2018["action"][k].length;j++){
      txt = txt.concat(listFlag2018["action"][k][j]).concat("<br/>");
    }
    clone.find("p").html(txt);
    $("#flags").append(clone);
  }
}

afficherFlag();