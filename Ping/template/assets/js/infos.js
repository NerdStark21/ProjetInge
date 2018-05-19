$(document).ready(function (){
	let listAppareil = ["lave vaisselle",
						"lave linge",
						"seche linge",
						"télé"]
	let balise, appareil;
	for(k=0;k<listAppareil.length;k++){
		appareil = listAppareil[k];
		balise = $("<div></div>");
		balise.append(
			$("<label></label>")
			.attr("for", appareil)
			.text("Combien avez-vous de "+appareil+" : "));
		balise.append(
			$("<input></input>")
			.attr("type", "number")
			.attr("name", appareil)
			.attr("id", appareil));
		$("article#infos").find("section#advanced").append(balise);
	}
})