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
            language: "fr"
        })
        .on("changeDate", function() {
            $(this).next("input:hidden[name='selectedDate']").val($(this).datepicker("getFormattedDate"));
        })
    ;
    
    $("#rangeDatepicker")
        .datepicker({
            language: "fr",
            format: "dd/mm/yyyy"
        })
    ;
    
    
    var date, day;    
    $("#dayDatepicker")
        .datepicker({
            language: "fr",
            maxViewMode : 1
        })
        .on("changeDate", function() {
            date = $(this).datepicker("getFormattedDate");
            day = parseInt($(this).datepicker("getFormattedDate").substring(0,2), 10);
            
            $(this).next("input:hidden[name='selectedDay']").val(date);
            $(this).val(day);
        })
        .on("change", function() {
            $(this).val(day);
        })
    ;
});

