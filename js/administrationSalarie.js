$(function(){    
    $("#inputMdp1, #inputMdp2").hide();
    
    function t(){
        var ajout = false;
        var gestion = false;
        
        $("input[type='checkbox']").each(function(){
            if($(this).is(":checked")){                
                if(($(this).attr("id") & 1) == 0){
                    ajout = true;
                }
                else{
                    gestion = true;
                }
            }
        });
        
        if(ajout){
            $("#mdp1").prop("required", true);
            $("#inputMdp1").show("slow");
        }else{
            $("#mdp1").prop("required", false);
            $("#inputMdp1").hide("slow");
        }
        
        if(gestion){
            $("#mdp2").prop("required", true);
            $("#inputMdp2").show("slow");
        }
        else{
            $("#mdp2").prop("required", false);
            $("#inputMdp2").hide("slow");
        }
        
        setTimeout(t, 800);
    }
    
    t();
});