const AjaxUrl = document.currentScript.getAttribute('ajax-url'); 
var Offset = 0;
jQuery('body').attr('data-hold-page-leave',false);

const generateImage = (Offset,DeleteNotSetFormat)=>{

    jQuery.ajax({
        url:AjaxUrl+'/ajax/images/regenerate.php',
        type:'get',
        data:{
            Offset:Offset,
            DeleteNotSetFormat:DeleteNotSetFormat
        },success:function(Response){

            // All images generated
            if(Response.Error !== undefined && Response.Error == 'AllImagesGenerated'){
                sx_loading_screen(false);
                jQuery('body').attr('data-hold-page-leave',false);
                 console.log('All Generated'); 
                 return false; 
            } 

            Offset = Number(Offset) + 1;
            console.log('Success'+Offset);
            jQuery('#regenerateimages').attr('data-offset',Offset);
            generateImage(Offset,DeleteNotSetFormat);
        },error: function(){
            Offset = Number(Offset) + 1;
            console.log(Offset);
            jQuery('#regenerateimages').attr('data-offset',Offset);
            generateImage(Offset,DeleteNotSetFormat);
        }
    });
};

jQuery(document).on('click','#regenerateimages',function(){
    DeleteNotSetFormat = false;
    DeleteNotSetFormatValue = jQuery('#DeleteNotSetFormat').val();
    if(DeleteNotSetFormatValue == 'Verwijderen' || DeleteNotSetFormatValue == 'verwijderen'){ DeleteNotSetFormat = true; }
    Offset = jQuery('#regenerateimages').attr('data-offset');
    jQuery('body').attr('data-hold-page-leave',true);
    sx_loading_screen(true);
    generateImage(Offset,DeleteNotSetFormat);
});

/*
*   Check delete field
*/
jQuery(document).on('keyup','#DeleteNotSetFormat',function(){
    if(jQuery.trim(jQuery(this).val()) == 'verwijderen'){
        jQuery('#DeleteNotSetFormatConfirm').show();
        return;
    }
    jQuery('#DeleteNotSetFormatConfirm').hide();
});

/*
*   Check for page leave
*/
const CheckGenerateProccess = ()=>{
    if($('body').attr('data-hold-page-leave') == 'false'){
        return true;
    }  
    return false;
};

jQuery(document).on('click','a',function(){
    return CheckGenerateProccess();
});

window.addEventListener('beforeunload', function (e) {
    if(CheckGenerateProccess()){
        
    }
    e.preventDefault();
    e.returnValue = '';

});
