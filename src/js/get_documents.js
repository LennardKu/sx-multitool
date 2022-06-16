const document_body_uuid = document.currentScript.getAttribute('panel-body-uuid');
const document_ajax_map = document.currentScript.getAttribute('document-ajax-map');


const get_documents = ()=>{

    jQuery.ajax({
        url:document_ajax_map+'/get_documents.php',
        type:"get",
        data:{

        },success:function(documents){
            jQuery("[panel_body_uuid='"+document_body_uuid+"']").html(documents);
        }
    });

}


get_documents();