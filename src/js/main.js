/*
*   Variables
*/
const sx_plugin_location_main = document.currentScript.getAttribute('sx_plugin_location');

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
    form_uuid = form.attr('sx-form-uuid');

    // Check Values 
    if(form.attr('sx-sumbit-page') == undefined){ sx_popups('Geen submit pagina toegevoegd','error',true); return false; } // Page

    // Check if executing
    if(form.attr('executing') !== undefined && form.attr('executing') == 'true'){ sx_popups('Opdracht al verstuurd.','error',true); return false; }
    form.attr('executing','true'); // set executing

    
    var data = new FormData(form[0]);
    data.append("label", "WEBUPLOAD");

    jQuery.ajax({
        url: sx_plugin_location_main+'/ajax/'+form.attr('sx-sumbit-page'),
        data: data,
        processData: false,
        type: 'POST',
        contentType: false,
        beforeSend: function (x) {
            if (x && x.overrideMimeType) {
                x.overrideMimeType("multipart/form-data");
            }
        },
        mimeType: 'multipart/form-data',        
        success: function (data) {
            form.attr('executing','false'); // disable executing

            jQuery('[sx-submit-form="'+form_uuid+'"]').html('Opslaan'); // button text

            if(data == 'error'){ sx_popups('Opdracht mislukt.','error',true); return false;} // Error         

            // Error codes
            if(data == 'slug_exists'){ sx_popups('Slug bestaat al.','error',true); return false;} // Error         
            if(data == 'fill_in_all_data'){ sx_popups('Niet alles ingevuld.','error',true); return false;} // Error         

            // Data created
            if(data == 'success'){
                form[0].reset();
                sx_popups('Variable aangemaakt','success',true); 

                if(form.attr('after-function') !== undefined){
                    jQuery('body').append('<script>'+form.attr('after-function')+'</script>');
                }

                return false;
            } 

        },error:function(){
            form.attr('executing','false'); // disable executing
            jQuery('[sx-submit-form="'+form_uuid+'"]').html('Opnieuw proberen'); // button text
            sx_popups('Opdracht mislukt.','error',true); // disable loading
            return false;
        }
    });
    
    return false;

});

/*
*   Form submit
*/
jQuery(document).on('click','[sx-submit-form]',function(){
    jQuery("[sx-form-uuid='"+jQuery(this).attr('sx-submit-form')+"']").submit();
    jQuery(this).html('Versturen...'); // Change btn text
    return false;
});

/*
*   Reload content
*/
const sx_reload_content = (reload_element)=>{
    jQuery('[load-content="'+reload_element+'"]').attr('loaded','false');
    load_content();
}

/*
*   Load content 
*/
const load_content = ()=>{
    jQuery("[load-content][loaded='false']").each(function() { 
        if(jQuery(this).attr('offset') !== undefined){offset = jQuery(this).attr('offset'); }
        get_content(jQuery(this).attr('load-content'),jQuery(this),offset);
    });
}

/*
*   Done loading page 
*/
jQuery(window).on('load',function(){
    jQuery('body').append('<div sx-popups="wrapper"></div>'); // Insert popup wrapper
    load_content(); // Load content
});