<?php
/*
*   Config
*/
include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';



if (!current_user_can( 'manage_options' )) { echo 'error'; exit;} // No access

header('Content-Type: application/json; charset=utf-8');

/*
*   Regenerate
*/
$Offset = (isset($_GET['Offset']) ? $_GET['Offset'] : 0);
$Limit = 1;



global $wpdb;
$images = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_type = 'attachment' AND post_mime_type LIKE 'image/%' ORDER BY ID ASC LIMIT ".$Limit." OFFSET ".$Offset."" );

// Check if array 
if(!is_array($images) || empty($images)){
    echo json_encode(array('Error'=>'AllImagesGenerated'));
    exit;
}


foreach ( $images as $image ) {
    $id = $image->ID;
    $fullsizepath = get_attached_file( $id );

    if ( false === $fullsizepath || !file_exists($fullsizepath) ){
        echo json_encode(array('Error'=>'FileDoesntexist'));
        exit;
    }
    require $_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/image.php';
    if ( wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $fullsizepath ) ) ){
        echo json_encode(array('Error'=>'NotGenerated'));
        exit;
    }
    echo json_encode($image);
    exit;

}

echo json_encode(array('Error'=>'NotGenerated2','ID'=>$id));
exit;