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
};

$.fn.tagName = function() { return this.get(0).tagName.toLowerCase(); }

$(function() {
    
    $(".jsDatepicker")
        .datepicker({
            language: "fr",
        })
        .on("changeDate", function() {
            $(this).next("input:hidden").val($(this).datepicker("getFormattedDate"));
        })
    ;

//    $(".datepickerValidation").click(function() {        
//        if($(this).parent().parent().find("input:hidden").attr("value") == ""){
//            $(".jsDatepicker").popover("show");
//            
//            $(".jsDatepicker").on("shown.bs.popover", function(){
//                $("body").one("click", function(){
//                    $(".jsDatepicker").popover("hide");
//                });
//            });
//            
//            return false; 
//        }
//        else{
//            $(this).submit();
//        }        
//    });
});

