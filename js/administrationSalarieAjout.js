$(function(){
    var i = 0;
        
    $("#inputMdp").detach();
    
    $("input:checkbox").change(function(){
        if($(this).prop("checked")){
            i++;
        }
        else{
            i--;
        }
        
        if(i == 0){
            $("#inputMdp").appendTo();
        }
        else{
            $("#inputMdp").detach();
        }
    });    
});