<?php
if(!defined('Sx_file_access')){ die('Could not open file');} // Disable direct access
echo '<style>[password-field-tooltip]{display:block}</style>';

echo '<input password-checker="password" type="text" style="border-width:5px"/>';
echo '<button id="sumbit_button">Test</button>';
echo '<script src="'.sx_plugin_path('url').'/src/js/password-check.js" lang="En" ></script>';
echo "<script defer>
    PasswordCheck(false,'password',{
        button:'#sumbit_button',
        Repeat:false,
        CapitalLength:2,
        SpecialLength:0,
        type:'tooltip',
    },true)
</script>
";

echo 'test';
