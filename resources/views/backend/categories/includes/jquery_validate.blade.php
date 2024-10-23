$(function(){
    $('#form_validate').validate({
        rules:{
            name:"required"
        },
        messages:{
            name:"Category name is required"
        }
    })
});