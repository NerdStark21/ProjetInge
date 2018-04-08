
let listMonth = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
let listEnergyTest = {"water" : [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                  "electricity" : [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
                  "gas" : [25, 26, 27, 28, 32, 30, 31, 32, 33, 34, 35, 36]};

let listCompareTest = {"water" : [1, 2, 3, 3, 5, 6, 7, 8, 9, 10, 11, 12],
                  "electricity" : [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
                  "gas" : [31, 15, 27, 29, 29, 30, 31, 40, 33, 34, 35, 37]};

$(document).ready(function (){
// Pour afficher tous les mois dans le tableau
for(let k=0; k<12;k++){
    let clone = $(".monthClone").clone();
    clone.removeClass("monthClone");
    clone.text(listMonth[k]);
    $(".ligne_header").append(clone);
}

function remplir(energy, listEnergy, listCompare, année){
    console.log("listEnergy = ", listEnergy);
    for(k=0;k<12;k++){
        let clone = $(".".concat(energy)).find(".valueClone").clone();
        clone.removeClass("valueClone");
        let actualEnergy = listEnergy[energy][k];
        let previousEnergy = listCompare[energy][k];
        console.log("Energy");
        console.log(actualEnergy);
        console.log(1.2*actualEnergy);
        console.log(previousEnergy);
        if(actualEnergy <= 1.05*previousEnergy){
            clone.addClass("green");
        }
        else if(actualEnergy <= 1.15*previousEnergy){
            clone.addClass("orange");
        }
        else{
            clone.addClass("red");
        }
        clone.text(actualEnergy);
        $(".".concat(energy)).append(clone);
    }
    console.log("FIN");
};

let energyType = ["water", "electricity", "gas"];
for (j=0;j<3;j++){
    //console.log(energyTypeTest[j], listEnergyTest, listCompareTest);
    console.log("j = ", j);
    remplir(energyType[j], listEnergyTest, listCompareTest, 2018);
}
})

/*
//Pour faire le OUVRIR / FERMER du tableau
function fermer(){
    $("section").find("th").first().text("OUVRIR");
    $('tbody').hide();
}

function ouvert(){
    $("section").find("th").first().text("FERMER");
    $('tbody').show();
}

$("#fermer").click(function(event){
    if($("section").find("th").first().text() == "FERMER")
    fermer();
    else
    ouvert();
});

$("input").keypress(function(event){
    str=$(this).val();
});

function _changeTheme(color){
    let ligne_color = $("th");
    ligne_color.removeClass("grey blue red green");
    ligne_color.addClass(color);
};
*/