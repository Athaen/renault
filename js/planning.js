$(function(){
    // mets directement les valeurs entrées dans l'attribut value pour pouvoir les traiter ensuite
    $(".heure, .minute, .type").change(function(){
        var value = $(this).val();
        
        $(this).attr("value", value);
    });
    
    // applique les heures de la semaine à la semaine suivante
    $(".applyToNextWeek").click(function(){
        var jour = $(this).parent().parent().attr("id");
        
        for(var i = 0; i < 7; i++){    
            var jourSemaineSuivante = parseInt(jour) + 7;
            $("#" + jourSemaineSuivante + " .heure").attr("value", $("#" + jour + " .heure").attr("value"));
            $("#" + jourSemaineSuivante + " .minute").attr("value", $("#" + jour + " .minute").attr("value"));
            
            var type = $("#" + jour + " .type").val();
            $("#" + jourSemaineSuivante + " .type option[value=" + type + "]").prop("selected", true);
            
            console.log(type);
            
            jour++;
        }
    });
});