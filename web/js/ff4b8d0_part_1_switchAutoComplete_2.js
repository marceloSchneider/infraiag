$('#iag_switchbundle_switchs_hostname').focusout(function(){
    $values = this.value.split('_');    
    $modelo = $values[2];
    $('#iag_switchbundle_switchs_marca').val($modelo);
});
