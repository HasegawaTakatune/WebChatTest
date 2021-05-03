
$(function (){
    $('[name="radio-type"]:radio').change(function(){
        var type = $(this).val();
        if(type == 1){
            document.getElementById('input-key').disabled = true;
        }
        else{
            document.getElementById('input-key').disabled = false;
        }
    });
});