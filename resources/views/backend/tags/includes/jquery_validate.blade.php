$(function(){
    $('#form_validate').validate({
        rules:{
            name:"required"
        },
        messages:{
            name:"Tag name is required"
        }
    })
});