/*
*   Variables
*/
const sx_plugin_location = document.currentScript.getAttribute('sx_plugin_location');

/*
*   Get content
*/
const get_content = (content_name,container,offset)=> {
    jQuery.ajax({
        url:sx_plugin_location+'/ajax/global-variables/load_content.php',
        type:'get',
        data:{
            content_name:content_name,
            offset:offset
        },success:function(response){
            if(response == 'error'){ alert('Er ging iets mis met het laden van: '+content_name); return false; } // Error

            container.html(response); // Put data inside container
            container.attr('loaded','true'); // Set container loaded
        }
    });
}


/*
*   Create global variable
*/
const create_variable = ()=>{

    sx_create_variable_btn = jQuery(this);

    sx_loading_screen(true); // Enable loading screen

    if(sx_create_variable_btn.attr('executing') == 'true'){ return false; } // Check if already executing
    sx_create_variable_btn.attr('executing','true'); // Set executing

    jQuery.ajax({
        url:sx_plugin_location+'/ajax/global-variables/create_global_variable.php',
        type:'get',
        data:{
            get_modal:true
        },success:function(response){
            if(response == 'error'){ alert('Er ging iets mis.'); sx_create_variable_btn.attr('executing','false'); sx_loading_screen(false); return false; }

            sx_create_variable_btn.attr('executing','false'); // Disable executing
            jQuery("body").append(response); // Put response inside body
            sx_loading_screen(false); // Disable loading screen 

        }
    }); 

}

/*
*   Create variable btn
*/
jQuery(document).on('click','[create-btn="create_variable"]',function(){
    create_variable();
});

/*
*   Insert script
*/
const insert_script = ()=>{

    sx_create_variable_btn = jQuery(this);

    sx_loading_screen(true); // Enable loading screen

    if(sx_create_variable_btn.attr('executing') == 'true'){ return false; } // Check if already executing
    sx_create_variable_btn.attr('executing','true'); // Set executing

    jQuery.ajax({
        url:sx_plugin_location+'/ajax/global-variables/insert_script.php',
        type:'get',
        data:{
            get_modal:true
        },success:function(response){
            if(response == 'error'){ alert('Er ging iets mis.'); sx_create_variable_btn.attr('executing','false'); sx_loading_screen(false); return false; }

            sx_create_variable_btn.attr('executing','false'); // Disable executing
            jQuery("body").append(response); // Put response inside body
            sx_loading_screen(false); // Disable loading screen 

        }
    }); 

}

/*
*   Edit content
*/
const edit_content = (element)=>{
    edit_type = element.attr('edit-type');
    edit_data = element.attr('edit-data');

    sx_loading_screen(true);  // Enable loading screen 

    jQuery.ajax({
        url:sx_plugin_location+'/ajax/global-variables/edit_data.php',
        type:'get',
        data:{
            edit_data:edit_data,
            edit_type:edit_type
        },success:function(response){
            if(response == 'error'){ sx_popups('Er ging iets mis','error',true); sx_loading_screen(false); return false;} // Error

            sx_loading_screen(false);  // Disable loading screen 
            jQuery('body').append(response);

        }
    });

}

jQuery(document).on('click','[edit-data][edit-type]',function(){
    edit_content(jQuery(this));
});

/*
*   Insert script btn
*/
jQuery(document).on('click','[create-btn="insert_script"]',function(){
    insert_script();
});


