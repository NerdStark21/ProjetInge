/*
$("#submit").click(function(event){
    event.preventDefault();
    console.log($("#modification").val());
    console.log($("#date").val());
    $.post(
        'historique.php', // Un script PHP que l'on va créer juste après
        {
            text : $("#modification").val(),  // Nous récupérons la valeur de nos input que l'on fait passer à connexion.php
            date : $("#date").val()
        },

        function(data){

            if(data == 'Success'){
                 // Le membre est connecté. Ajoutons lui un message dans la page HTML.

                 $("#resultat").html("<p>Vous avez été connecté avec succès !</p>");
            }
            else{
                 // Le membre n'a pas été connecté. (data vaut ici "failed")

                 $("#resultat").html("<p>Erreur lors de la connexion...</p>");
            }
    
        },
        'text'
     );
    document.location.href = "index.php";
});
*/
