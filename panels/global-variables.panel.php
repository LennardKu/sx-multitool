<?php
if(!defined('Sx_file_access')){ die('Could not open file');} // Disable direct access


// if(isset($_FILES['file'])){
//     $upload = new sx_upload($_FILES['file'],array(),'test');
//     $upload->create_file();
//     echo $upload->get_file_information()['complete_url'];
// }

echo '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /><script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>';

echo '<div class="sx_tabs">';

    echo '<input type="radio" name="sx_tabs" id="standard_variables" checked="checked">';
    echo '<label for="standard_variables" class="tab_indicator">Standaard variabelen </label>';
    echo '<div class="tab">';
        echo '<h1>Standaard waarde</h1>';    

        echo '<button create-btn="create_variable" btn="default">Create</button>';
        echo '<div class="sx_table">';
            echo '<div class="sx_table-header">';
                echo '<div class="header__item"><span class="filter__link" >Naam</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >Slug</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >Waarde</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >Shortcode</span></div>';
            echo '</div>';
            echo '<div class="sx_table-content" load-content="global_variables" loaded="false" offset="0">';
            echo '</div>';
        echo '</div>';

    echo '</div>';

    /*
    *   Scripts
    */  
    echo '<input type="radio" name="sx_tabs" id="google_fields">';
    echo '<label for="google_fields" class="tab_indicator">Scripts </label>';
    echo '<div class="tab">';
        echo '<h1>Scripts</h1>';
        
        echo '<button create-btn="insert_script" btn="default">Create</button>';
        echo '<div class="sx_table">';
            echo '<div class="sx_table-header">';
                echo '<div class="header__item"><span class="filter__link" >Script naam</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >Locatie</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >Upload url</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >Script</span></div>';
                echo '<div class="header__item"><span class="filter__link filter__link--number" >status</span></div>';
            echo '</div>';
            echo '<div class="sx_table-content" load-content="get_scripts" loaded="false" offset="0">';
            echo '</div>';
        echo '</div>';

    echo '</div>';

    /*
    *   Login page
    */
    echo '<input type="radio" name="sx_tabs" id="login_page" >';
    echo '<label for="login_page" class="tab_indicator">Login pagina</label>';
    echo '<div class="tab">';
        echo '<h1>Login pagina</h1>'; 

        echo '<div class="" style="max-width:900px">';

            $form_uuid = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
            $colorInformation = new sx_login_screen;    
            $reload_content = "'logo-login'";


            echo '<div class="container sx-form-wrapper">';
                echo '<form sx-form-uuid="'.$form_uuid.'" after-function="loadSingleItem('.$reload_content.')" sx-sumbit-page="/global-variables/login-screen.php?confirm=true" dont-reset-form="true" reload="false">'; 
                        
                    echo '<label for="variable">Custom style</label>';
                    echo '<textarea style="height:200px" name="style" id="css-editor"></textarea>';

                    echo '<label for="variable">Logo</label>';
                    echo '<input type="file" name="logo" accept="*/image">';

                    echo '<img src="" id="login-image" src-after loaded="false" load-content="logo-login" width="200"/>';
                    

                    echo '<hr></hr>';
                    echo '<span>Kleuren</span><br />';

                    
                    echo '<label for="variable">Knop kleur</label><br />';
                    echo '<input type="color" name="color[#wp-submit@background-color]" value="'.$colorInformation->get_item('#wp-submit')['value'].'"><br />';
                    
                    echo '<label for="variable">Achtergrond kleur</label><br />';
                    echo '<input type="color" name="color[body@background]" value="'.$colorInformation->get_item('body')['value'].'"><br />';

                    echo '<label for="variable">Icoon kleur</label><br />';
                    echo '<input type="color" name="color[.dashicons@color]" value="'.$colorInformation->get_item('.dashicons')['value'].'"><br />';

                    echo '<label for="variable">Link kleur</label><br />';
                    echo '<input type="color" name="color[a@color]" value="'.$colorInformation->get_item('a')['value'].'"><br />';

                echo '</form>';
                echo '<br / >';

                echo '<button btn="default" sx-submit-form="'.$form_uuid.'">Opslaan</button>';
            echo '</div>';

        echo '</div>';

    echo '</div>';

    /*
    *   Cookie message 
    */
    $cookie_message = new cookie_message;

    echo '<input type="radio" name="sx_tabs" id="cookie_message" >';
    echo '<label for="cookie_message"class="tab_indicator">Cookie melding</label>';
    echo '<div class="tab">';
        echo '<h1><label style="background-color:transparent"><input '.($cookie_message->cookie_information()['status'] == 'true' ? 'checked' : '').' type="Checkbox" change-data="change_cookie_message" /> Cookie melding</label></h1>'; 

        echo '<div class="" style="max-width:900px">';

            $form_uuid = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);

            echo '<div class="container sx-form-wrapper">';
                echo '<form sx-form-uuid="'.$form_uuid.'" sx-sumbit-page="/global-variables/cookie_message.php?edit=true" dont-reset-form="true" reload="false">'; 
                        
                    echo '<label for="variable">Melding</label>';
                    echo '<textarea style="height:200px" name="message">'.$cookie_message->cookie_information()['message'].'</textarea>';

                    echo '<label for="variable">style</label>';
                    echo '<textarea style="height:200px" name="style">'.$cookie_message->cookie_information()['style'].'</textarea>';

                    echo '<label for="variable">Accept scripts</label>';
                    echo '<select class="js-example-basic-multiple" name="accept[]" multiple="multiple" load-content="accept_script_variables" loaded="false"></select>';
                echo '</form>';

                echo '<button btn="not-important" style="margin-right:10px" cookie-concept="'.$form_uuid.'">Concept bekijken</button>';
                echo '<button btn="default" sx-submit-form="'.$form_uuid.'">Opslaan</button>';
            echo '</div>';

        echo '</div>';


    echo '</div>';

echo '</div>';


// Js 
echo '<script src="'.sx_plugin_path('url').'/src/js/main.js" sx_plugin_location="'.sx_plugin_path('url').'" ></script>';
echo '<script src="'.sx_plugin_path('url').'/src/js/global_variables.js" sx_plugin_location="'.sx_plugin_path('url').'" ></script>';
echo '<script src="'.sx_plugin_path('url').'/src/js/modal.js" sx_plugin_location="'.sx_plugin_path('url').'" ></script>';
echo '<script src="'.sx_plugin_path('url').'/src/js/ace.js"></script>';
echo '<script>var editor = ace.edit("css-editor");
editor.setTheme("ace/theme/monokai");
editor.getSession().setMode("ace/mode/css"); </script>';
// echo '<script src="'.sx_plugin_path('url').'/src/js/select2.js"></script>';
// echo '<link rel="stylesheet" href="'.sx_plugin_path('url').'src/css/select2.min.css">';