// ############################################# //
// ############## Changement de page ########### //
// ############################################# //

$("#page_historique, #page_comparaison, #page_infos, #page_conso_journaliere").click(function(event){
  let newPage = "error";
  switch(event.target.id){
    case "page_historique":
    newPage = "historique.php";
    break;
    case "page_comparaison":
    newPage = "comparaison.php";
    break;
    case "page_infos":
    newPage = "infos.php";
    break;
    case "page_conso_journaliere":
    newPage = "conso_journaliere.php";
    break;
    default:
    console.log("Vous avez mal renseigné le chemin de la page ciblée !");
  }
  console.log("newPage");

  actualisation(newPage);
});

/*
Permet le changement de page en requète AJAX
@input :
  newPage : nom+extension de la page cible (pas URL)
  */
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

// ################################################## //
// ########## Affichage et gestion du tableau ####### //
// ################################################## //

// Importer le tableau depuis PHP

// const req = new XMLHttpRequest();

// req.onreadystatechange = function(event) {
//     // XMLHttpRequest.DONE === 4
//     if (this.readyState === XMLHttpRequest.DONE) {
//         if (this.status === 200) {
//             console.log("Réponse reçue: %s", this.responseText);
//         } else {
//             console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
//         }
//     }
// };

// req.open('GET', 'index.php', true);
// req.send(null);

// Liste des mois de l'année (pour affichage)
let listMonth = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

 /*{"water" : [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 50,40],
                  "electricity" : [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 100,90],
                  "gas" : [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,12] }*/
/*let listConso2017 = {"water" : [1,2,3,4,5,6,7,8,9,10,11,12],
                  "electricity" : [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
                  "gas" : [25, 26, 27, 28, 32, 30, 31, 32, 33, 34, 35, 36]  };

let listConso2018 = {"water" : [20, 20, 19, 20, 21, 22, 21, 20, 21, 20, 19, 19],
                  "electricity" : [30, 30, 25, 23, 20, 15, 13, 13, 15, 20, 25, 25],
                  "gas" : [25, 26, 27, 28, 32, 30, 31, 32, 33, 34, 35, 36]};
                  */


                  let  listConso2017  = $.parseJSON($.ajax({
                    url:  'function1.php',
                    dataType: "json", 
                    async: false,

    }).responseText); // This will wait until you get a response from the ajax request.
                  ;
                  let  listConso2016  = $.parseJSON($.ajax({
                    url:  'function2.php',
                    dataType: "json", 
                    async: false,

    }).responseText); // This will wait until you get a response from the ajax request.


                  let  listConsoCompare2016  = $.parseJSON($.ajax({
                    url:  'function3.php',
                    dataType: "json", 
                    async: false,

    }).responseText); // This will wait until you get a response from the ajax request.

                  let  listConsoCompare2017  = $.parseJSON($.ajax({
                    url:  'function4.php',
                    dataType: "json", 
                    async: false,

    }).responseText); // This will wait until you get a response from the ajax request.



/*let listConsoCompare2018 = {"water" : [25, 26, 27, 28, 32, 30, 31, 32, 33, 34, 35, 36],
                  "electricity" : [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
                  "gas" : [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]   };
                  */
// Dictionnaire des listes de consommations d'énergie de l'habitation
let listConso = {     
  2016 : listConso2016,
  2017 : listConso2017
};

// Dictionnaire des consommations des habitations de mêmes types
let listConsoCompare = { 2016 : listConsoCompare2016,
  2017 : listConsoCompare2017, 
};

// Tous les types d'énergie
let energyType = ["water", "electricity", "gas"];
// Année actuelle
let annee = 2017, lastYear = 2017;
let tab = [];



$(document).ready(function (){
  // Pour afficher tous les mois dans le tableau

  let annee = 2017;
  viderTableau();
  remplirTableau(listConso[annee], listConsoCompare[annee]);
  for(let k=0; k<12;k++){
    let clone = $(".monthClone").clone();
    clone.removeClass("monthClone");
    clone.text(listMonth[k][0]);
      //clone.css("text-align: center;")
      $(".ligne_header").append(clone);
    }

  /*
  Permet le changement d'année dans le tableau
  */
  $("#nextYear, #previousYear").click(function(event){
    console.log(annee);
    console.log(lastYear);
    if(event.target.id == "nextYear" && annee + 1 <= lastYear){
      annee += 1;
      viderTableau();
      remplirTableau(listConso[annee], listConsoCompare[annee]);
    }
    else if(event.target.id == "previousYear"){
      annee -= 1;
      viderTableau();
      remplirTableau(listConso[annee], listConsoCompare[annee]);
    }
  });



  /*
  Remplie le tableau ligne par ligne (appel : remplirLigne)
  @input : 
    listConsoYear => liste des conso à l'année voulue
    listCompareYear => liste des conso des habitations de même type à l'année voulue
    */
    function remplirTableau(listConsoYear, listCompareYear){
      $("#year").text(annee);     // On met la bonne année
      // Remplissage du tableau par ligne
      for (j=0;j<3;j++){
        remplirLigne(energyType[j], listConsoYear, listCompareYear);
      }
      affichageWarnings();
    }

  /*
  Remplie une ligne du tableau
  @input :
    energy => type d'énergie
    listConsoYear => liste des conso à l'année voulue
    listCompareYear => liste des conso des habitations de même type à l'année voulue
    */
    function remplirLigne(energy, listConsoYear, listCompareYear){
      console.log(listConsoYear);
      for(k=0;k<listConsoYear[energy].length;k++){
        let clone = $(".".concat(energy)).find(".valueClone").clone();
        clone.removeClass("valueClone");
        let actualEnergy = listConsoYear[energy][k];
        let previousEnergy = listCompareYear[energy][k];
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
      for(k=listConsoYear[energy].length;k<12;k++){
        let clone = $(".".concat(energy)).find(".valueClone").clone();
        clone.removeClass("valueClone");
        clone.addClass("empty")
        $(".".concat(energy)).append(clone);
      }
    };

  /*
  Vide le tableau de toutes les valeurs
  */
  function viderTableau(){
    // Tous les td qui contiennent au moins la classe "value"
    $('tr td[class~="value"]').remove();
    $('tr td[class~="empty"]').remove();
    let txt = $("article#historique").find("tbody").find("img").remove();
  }

  /*
  Déclenche l'affichage des warning si la dernière valeur que l'on a à notre disposition est en rouge
  */
  function affichageWarnings(){
    if(annee == lastYear){
      for(energy of energyType){
        console.log(energy);
        console.log($("article#historique").find("tbody").find("tr."+energy).find('td[class~="value"]:last').attr("class"));
        if($("article#historique").find("tbody").find("tr."+energy).find('td[class~="value"]:last').attr("class") == "red value"){
          affichageWarning(energy);
        }
      }
    }
  }

  /*
  Affiche un warning
  @input:
  energy => le type d'énergie sur lequel on doit mettre le warning
  */
  function affichageWarning(energy){
    var ligne = $("article#historique").find("tbody").find("tr."+energy).find("td:first");
    var img = $("<img></img>");
    img.attr("src", "images/warning.png");
    img.attr("width", "20");
    img.attr("height", "20");
    img.attr("title", "Cliquez ici pour voir des astuces pour réduire votre consommation")
    img.addClass("warning");
    img.addClass(energy);
    ligne.append(img);
  }
});

$("article#historique").on("click", ".warning", function(event){
  $.ajax({
     url : "astuces.php",
     type : 'GET',
     dataType : 'html',
     data : "energy="+$(this).attr("class").substr(8, $(this).attr("class").length),
     success : function(code_html, statut){
      $("#body").empty();
          $(code_html).appendTo("#body"); // On passe code_html à jQuery() qui va nous créer l'arbre DOM !
        },
        error : function(resultat, statut, erreur){

        },
        complete : function(resultat, statut){

        }
      });
});

// ############################################### //
// ########### Affichage des marqueurs ########### //
// ############################################### //

// C'est les dates anglo-saxones Mois/Jour/Année
let listFlag = new Object;
let listYear = ["2016", "2017"];
for(year of listYear){
  listFlag[year] = new Object;
  for(month of listMonth){
    listFlag[year][month] = new Object;
    listFlag[year][month]["date"] = [];
    listFlag[year][month]["action"] = [];
  }
}
listFlag["2017"]["Janvier"]["date"].push("01/01/2017");
listFlag["2017"]["Janvier"]["action"].push("changer le radiateur");
listFlag["2016"]["Février"]["date"].push("02/01/2016");
listFlag["2016"]["Février"]["action"].push("manger le chat");
listFlag["2017"]["Mars"]["date"].push("03/21/2017");
listFlag["2017"]["Mars"]["action"].push("manger le chien");
listFlag["2017"]["Mars"]["date"].push("03/23/2017");
listFlag["2017"]["Mars"]["action"].push("manger");

/*
Fait afficher tous les marqueurs de l'utilisateur (appel : afficherFlag)
@input :
  listFlag : liste de tous les marqueurs de l'utilisateur
  */
  function afficherFlags(listFlag){
    let listAction = listFlag[annee];
    let first = true;
    let compteur = 0, date;
    let ecart = 0.25;
    for(month of listMonth){
      if(listAction[month]["date"].length == 0){
        compteur ++;
      }
      else{
        console.log(month);
        date = new Date(listAction[month]["date"]);
        console.log(compteur);
        if(first){afficherFlag(date, 7.5+compteur*ecart, month); first = false;}
        else{afficherFlag(date, compteur*ecart, month);}
        compteur = 1;
      }
    }
  }

/*
Fait afficher un marqueur de l'utilisateur
@input :
  date : date correspondante au marqueur à afficher
  margin : taille de la marge, pour positionner le marqueur en face du bon mois
  month : mois associé au marqueur
  */
  function afficherFlag(date, margin, month){
    let clone = $("#flags").find(".flagClone").clone();
    clone.removeClass("flagClone");
    clone.addClass("msg".concat(date.getMonth()));
    clone.addClass("flag");
  clone.find("span").text(month); //indice du tableau que l'on utilise
  clone.find("img").addClass("msg".concat(date.getMonth()));
  clone.css('margin-left', ''.concat(margin+"%"));
  clone.attr("title", "Cliquez pour avoir le détail");
  clone.find("img").attr("title", "Cliquez pour avoir le détail");
  $("#flags").append(clone);
  console.log(margin);
}

/* Pour rechercher toutes les flags correspondant à ce mois
Input :
indiceMonth => indice du mois que l'on recherche (de 0 à 11)
listFlag => la liste de tous les flag
Output :
out => liste des indices auxquels on peut trouver les descriptions des flags du mois selectionné
*/
$("#flags").on("click", ".flag", function(event){
  let month = $(this).find("span").text();
  let article = $("article#msg");
  article.children().remove();
  $("<span></span>").appendTo(article);
  $("<ul></ul>").appendTo(article);
  let txt = "Voici la liste de tous les changements que vous avez enregistré pour le mois de ";
  article.find("span").text(txt+month.toLowerCase()+" :");
  let action, datestr, date;
  let flag = listFlag[annee][month];
  for(k=0;k<listFlag[annee][month]["date"].length;k++){
    $("<li></li>").appendTo(article.find("ul"));
    date = new Date(flag["date"][k]);
    action = flag["action"][k];
    datestr = date.getDate()+" "+listMonth[date.getMonth()];
    article.find("li:last").text(datestr+" : "+action);
  }
});

afficherFlags(listFlag);

// ############################################### //
// ########### Gestion du formulaire ############# //
// ############################################### //

// Pour ouvrir le formulaire d'ajout de marqueur
$("#ajoutflag").on("click", ".ajout", function ouvrir(){
  $("#form_ajax").load("addflag.php");
  var button1 = $("#form").find(".button").clone();
  button1.removeClass("ajout");
  var button2 = button1.clone();
  button1.addClass("confirm");
  button1.text("Ajouter");
  button2.addClass("annuler");
  button2.attr("title", "");
  button2.text("Annuler");
  $("#form").find("#ajoutflag").append(button1);
  $("#form").find("#ajoutflag").append(button2);
  $("#form").find("#ajoutflag").find(".ajout").remove();
});

// Fonction pour fermer le formulaire
function close(){
  $("#form_ajax").find("form").remove();
  var button = $("#form").find(".annuler").clone();
  button.removeClass("annuler");
  button.addClass("ajout");
  button.attr("title", "Grâce à ce bouton, vous pouvez enregistrer les différents travaux de votre habitation");
  button.text("Ajout d'un marqueur");
  $("#ajoutflag").append(button);
  $("#ajoutflag").find(".annuler").remove();
  $("#ajoutflag").find(".confirm").remove();
};

// Bouton "Annuler" du formulaire
$("#ajoutflag").on("click", ".annuler", function annuler(){
  close();
});

// Bouton "Ajouter" du formulaire
$("#ajoutflag").on("click", ".confirm", function confirm(){
  var date = $("#form_ajax").find("#date").val();
  var modification = $("#form_ajax").find("#modification").val();
  console.log(date);
  console.log(modification);
  if(date != "" && modification != ""){
    date = new Date(date);
    listFlag[annee][listMonth[date.getMonth()]]["date"].push($("#form_ajax").find("#date").val());
    listFlag[annee][listMonth[date.getMonth()]]["action"].push($("#form_ajax").find("#modification").val());
    close();
  }
  
  $("#flags").find(".flag").remove();
  afficherFlags(listFlag);
});

// ##################################################### //
// ####### Gestion du formulaire de comparaison ######## //
// ##################################################### //

function create_select(element, id){
  if(id=="energy"){
    var select = $("<option></option>");
    select.addClass("select");
    select.attr("value", element);
    switch(element){
      case "water":
      select.text("eau");
      break;
      case "electricity":
      select.text("électricité");
      break;
      case "gas":
      select.text("gaz");
      break;
    }
    $("#interval").find("select#"+id).append(select);
  }
  else{
    var select = $("<option></option>");
    select.addClass("select");
    select.attr("value", element);
    select.text(element);
    $("#interval").find("select#"+id).append(select);
  }
}

function creation_formulaire(){
  for(month of listMonth){
    create_select(month, "month");
  }
  for(year of listYear){
    create_select(year, "year");
  }
  for(energy of energyType){
    create_select(energy, "energy");
  }
}

$("#interval").on("click", ".select", function select(){
  $("#interval").find("section#text_comparaison").find("p").remove();
  let month = $("#interval").find("select#month").val();
  let year = $("#interval").find("select#year").val();
  let energy = $("#interval").find("select#energy").val();
  let moyenne = 0;
  for(year of listYear){
    moyenne+=listConsoCompare[year][energy][listMonth.indexOf(month)];
  }
  moyenne /= listYear.length;
  moyenne = (moyenne-listConso[annee][energy][listMonth.indexOf(month)])/moyenne*100;
  moyenne = Math.trunc(moyenne);
  let text = "Vous avez consommée ";
  if(moyenne>0){
    text += moyenne+"% de plus";
  }
  else{
    text += (-moyenne)+"% de moins";
  }
  text += " que les habitations de même types que vous pendant la même période.";
  $("article#interval").find("section#text_comparaison").append($("<p></p>").text(text));
});

creation_formulaire();

