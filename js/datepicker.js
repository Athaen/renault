$.fn.datepicker.dates.fr = {
    days: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
    daysShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
    daysMin: ["d", "l", "ma", "me", "j", "v", "s"],
    months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
    monthsShort: ["janv.", "févr.", "mars", "avril", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
    today: "Aujourd'hui",
    monthsTitle: "Mois",
    clear: "Effacer",
    weekStart: 1,
    format: "dd/mm/yyyy"
}

$(function() {
    
    $("#embeddingDatePicker")
        .datepicker({
            startView: 1,
            minViewMode: 1,
            language: "fr",
        })
        .on("changeDate", function() {
            // Set the value for the date input
            $("#selectedDate").val($("#embeddingDatePicker").datepicker("getFormattedDate"));
        })
    ;
    
    $("#selectedDate").attr("value", "");
    
    $("#validationPlanningForm").click(function() {
        if($('#selectedDate').attr("value") == ''){
            $("#embeddingDatePicker").popover("show");
            
            $("#embeddingDatePicker").on("shown.bs.popover", function(){
                $("body").one("click", function(){
                    $("#embeddingDatePicker").popover("hide");
                });
            });
            
            return false; 
        }
        else{
            $(this).submit();
        }
    });
});

