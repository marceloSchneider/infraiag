$(document).ready(function(){
    $('#filter_button').click(function(){
        $.post('rede/app_dev.php/home/listageral', {})
    });
});


