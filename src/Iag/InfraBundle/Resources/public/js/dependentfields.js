$(document).ready(function(){
   
    $("#iag_infrabundle_espelhar_rack, #iag_infrabundle_espelhar_switchs").change(function(){
        
        
        
        var form = $('#form-filter').children('form');
        
        var formUrl = form.attr('action');
        
        var $rackId = $("#iag_infrabundle_espelhar_rack").val();
        
        var $switchId = $("#iag_infrabundle_espelhar_switchs").val();

        $.post(formUrl, {rackId: $rackId, switchId: $switchId}, function(data){
            //alert(data);
            $("#form-filter").html(data);
        });
    });
});


