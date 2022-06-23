const sx_plugin_location_modal = document.currentScript.getAttribute('sx_plugin_location');

/*
*   Modal Options
*/
jQuery(document).on('click','[sx-remove-modal]',function(){
    jQuery('[sx-modal-uuid="'+jQuery(this).attr('sx-remove-modal')+'"]').remove();
});

jQuery(document).on('click','[sx-open-modal]',function(){
    jQuery('[sx-modal-uuid="'+jQuery(this).attr('sx-open-modal')+'"]').show();
    jQuery(this).remove();
});

jQuery(document).on('click','[sx-minimize-modal]',function(){
    jQuery('[sx-modal-uuid="'+jQuery(this).attr('sx-minimize-modal')+'"]').hide();
    // <span sx-remove-modal="'+jQuery(this).attr('sx-minimize-modal')+'">Sluiten</span>
    jQuery("[sx-popups='wrapper']").append('<div sx-popups="container" pointer="true" status="information" sx-open-modal="'+jQuery(this).attr('sx-minimize-modal')+'"><span>'+jQuery(this).attr('information')+'</span></div></div>');
});

/*
*   Confirm modal 
*/
const sx_confirm_modal = (text,btn_uuid)=>{
    sx_loading_screen(true); // enable loading screen   

    jQuery.ajax({
        url:sx_plugin_location_modal+'/ajax/confirm_modal.php',
        type:'get',
        data:{
            text:text,
            btn_uuid
        },success:function(response){
            if(response == 'error'){ sx_popups('Er ging iets mis','error',true); sx_loading_screen(false); return false;} // Error

            sx_loading_screen(false);  // Disable loading screen 
            jQuery('body').append(response);

        }
    });

}

/*
*   Check if modal exists
*   Notify for unsaved items
*/
const sx_modal_check = ()=>{
    if(!jQuery('[sx-modal-uuid]').length){
        return true;
    }

    if (confirm("U heeft nog niet opgeslagen items.\n Weet u zeker dat u deze pagina wilt verlaten?") == true) {
    return true;
    }

    return false;
}

jQuery(document).on('click','a',function(){
    return sx_modal_check();
});

window.addEventListener('beforeunload', function (e) {
    if(!jQuery('[sx-modal-uuid]').length){
        return true;
    }
    e.preventDefault();
    e.returnValue = '';

});
