$(document).ready(function(){
    $('#limpar-formulario').click(function(){
        $('form[name="iag_homebundle_lista"]').each(function(){
            this.value = '';
            console.log(this.value);
        });
    });
});