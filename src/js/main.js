/*
*   Loading screen
*/
const sx_loading_screen = (state)=>{
    
    // Create loading screen 
    if(state == true){
        jQuery("body").append('<div class="sx_loading_screen" loading_screen="full_screen"></div>');
        return;
    }

    // remove loading screen 
    jQuery("[loading_screen='full_screen']").remove();
}

/*
*   Random string
*/
const sx_random_string = (length)=>{
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * 
        charactersLength));
   }
   return result;
}

/*
*   Popups 
*/
const sx_popups = (text,state,auto_delete)=>{
    popup_uuid = 'popup-container-'+sx_random_string(10);

    // Auto delete popup after 3,5 seconds
    if(auto_delete == true){
        text = text+"<script>setTimeout(() => { jQuery('#"+popup_uuid+"').remove(); }, 3500);</script>";
    }

    jQuery("[sx-popups='wrapper']").append('<div id="'+popup_uuid+'" sx-popups="container" status="'+state+'"><span>'+text+'</span></div></div>');
}

/*
*   Send form information
*/
jQuery(document).on('submit','[sx-form-uuid][reload="false"]',function(){
    form = jQuery(this);

    // Check Values 
    if(form.attr('sx-sumbit-page') == undefined){ sx_popups('Geen submit pagina toegevoegd','error',true); return false; } // Page



});

/*
*   Form submit
*/
jQuery(document).on('click','[sx-submit-form]',function(){
    jQuery("[sx-form-uuid='"+jQuery(this).attr('sx-submit-form')+"']").submit();
    return false;
});


/*
*   Done loading page 
*/
jQuery(window).on('load',function(){
    jQuery('body').append('<div sx-popups="wrapper"></div>'); // Insert popup wrapper
});
