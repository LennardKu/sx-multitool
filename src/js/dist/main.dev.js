"use strict";

/*
*   Variables
*/
var sx_plugin_location_main = document.currentScript.getAttribute('sx_plugin_location');
/*
*   Loading screen
*/

var sx_loading_screen = function sx_loading_screen(state) {
  // Create loading screen 
  if (state == true) {
    jQuery("body").append('<div class="sx_loading_screen" loading_screen="full_screen"></div>');
    return;
  } // remove loading screen 


  jQuery("[loading_screen='full_screen']").remove();
};
/*
*   Random string
*/


var sx_random_string = function sx_random_string(length) {
  var result = '';
  var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  var charactersLength = characters.length;

  for (var i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }

  return result;
};
/*
*   Popups 
*/


var sx_popups = function sx_popups(text, state, auto_delete) {
  popup_uuid = 'popup-container-' + sx_random_string(10); // Auto delete popup after 3,5 seconds

  if (auto_delete == true) {
    text = text + "<script>setTimeout(() => { jQuery('#" + popup_uuid + "').remove(); }, 3500);</script>";
  }

  jQuery("[sx-popups='wrapper']").append('<div id="' + popup_uuid + '" sx-popups="container" status="' + state + '"><span>' + text + '</span></div></div>');
};
/*
*   Send form information
*/


jQuery(document).on('submit', '[sx-form-uuid][reload="false"]', function () {
  form = jQuery(this);
  form_uuid = form.attr('sx-form-uuid');
  delete_value = '';

  if (form.attr('delete') !== undefined && form.attr('delete') == 'true') {
    delete_value = '&delete_value=true';
  } // Check Values 


  if (form.attr('sx-sumbit-page') == undefined) {
    sx_popups('Geen submit pagina toegevoegd', 'error', true);
    return false;
  } // Page
  // Check if executing


  if (form.attr('executing') !== undefined && form.attr('executing') == 'true') {
    sx_popups('Opdracht al verstuurd.', 'error', true);
    return false;
  }

  form.attr('executing', 'true'); // set executing

  var data = new FormData(form[0]);
  data.append("label", "WEBUPLOAD");
  jQuery.ajax({
    url: sx_plugin_location_main + '/ajax/' + form.attr('sx-sumbit-page') + delete_value,
    data: data,
    processData: false,
    type: 'POST',
    contentType: false,
    beforeSend: function beforeSend(x) {
      if (x && x.overrideMimeType) {
        x.overrideMimeType("multipart/form-data");
      }
    },
    mimeType: 'multipart/form-data',
    success: function success(data) {
      form.attr('executing', 'false'); // disable executing

      jQuery('[sx-submit-form="' + form_uuid + '"]').html('Opslaan'); // button text

      if (data == 'error') {
        sx_popups('Opdracht mislukt.', 'error', true);
        return false;
      } // Error         
      // Error codes


      if (data == 'slug_exists') {
        sx_popups('Slug bestaat al.', 'error', true);
        return false;
      } // Error         


      if (data == 'fill_in_all_data') {
        sx_popups('Niet alles ingevuld.', 'error', true);
        return false;
      } // Error         
      // Data created


      if (data == 'success') {
        if (form.attr('dont-reset-form') == undefined) {
          form[0].reset();
        }

        if (form.attr('delete-modal') !== undefined) {
          jQuery('[sx-modal-uuid="' + form.attr('delete-modal') + '"]').remove();
        }

        if (form.attr('delete') == undefined) {
          sx_popups('Variable aangemaakt', 'success', true);
        } else {
          sx_popups('Item verwijderd', 'error', true);
        }

        if (form.attr('after-function') !== undefined) {
          jQuery('body').append('<script>' + form.attr('after-function') + '</script>');
        }

        return false;
      }
    },
    error: function error() {
      form.attr('executing', 'false'); // disable executing

      jQuery('[sx-submit-form="' + form_uuid + '"]').html('Opnieuw proberen'); // button text

      sx_popups('Opdracht mislukt.', 'error', true); // disable loading

      return false;
    }
  });
  return false;
});
/*
*   Confirm button
*/

jQuery(document).on('click', '[confirm-btn]', function () {
  if (jQuery(this).attr('confirm-btn') == 'false') {
    btn_uuid = sx_random_string(15);
    jQuery(this).attr('btn-uuid', btn_uuid);
    sx_confirm_modal('Weet u zeker dat u het script wilt verwijderen.', btn_uuid);
    return false;
  }

  return true;
});
jQuery(document).on('click', '[confirmed]', function () {
  btn_uuid = jQuery(this).attr('confirmed');
  jQuery('[btn-uuid="' + btn_uuid + '"]').attr('confirm-btn', 'true');
  jQuery('[btn-uuid="' + btn_uuid + '"]').attr('sx-submit-form', jQuery('[btn-uuid="' + btn_uuid + '"]').attr('sx-submit-form-confirm'));
  jQuery('[btn-uuid="' + btn_uuid + '"]').click();
});
/*
*   Change data
*/

jQuery(document).on('change', '[change-data]', function () {
  btn = jQuery(this); // Check if executing

  if (btn.attr('executing') !== undefined && btn.attr('executing') == 'true') {
    sx_popups('Opdracht word uitgevoerd.', 'error', true);
    return false;
  }

  btn.attr('executing', 'true'); // Set executing

  sx_loading_screen(true);
  state = 'false';

  if (btn.is(":checked")) {
    state = 'true';
  }

  key = btn.attr('change-data');
  jQuery.ajax({
    url: sx_plugin_location_main + '/ajax/change_data.php',
    type: 'post',
    data: {
      state: state,
      key: key
    },
    success: function success(response) {
      sx_loading_screen(false);
      btn.attr('executing', 'false'); // Disable executing  

      if (response == 'error') {
        sx_popups('Opdracht mislukt.', 'error', true);
        return false;
      } // Error         


      sx_popups('Gewijzigd.', 'success', true);
    },
    error: function error() {
      sx_loading_screen(false);
      btn.attr('executing', 'false'); // Disable executing  
    }
  });
});
/*
*   Copy content
*/

jQuery(document).on('click', '[copy-content]', function () {
  text = jQuery(this).html();
  navigator.clipboard.writeText(text).then(function () {});
  sx_popups('Gekopieerd naar klembord.', 'success', true); // disable loading
});
/*
*   Form submit
*/

jQuery(document).on('click', '[sx-submit-form]', function () {
  if (jQuery(this).attr('delete') !== undefined) {
    jQuery("[sx-form-uuid='" + jQuery(this).attr('sx-submit-form') + "']").attr('delete', 'true');
  }

  jQuery("[sx-form-uuid='" + jQuery(this).attr('sx-submit-form') + "']").submit();
  jQuery(this).html('Versturen...'); // Change btn text

  return false;
});
/*
*   Reload content
*/

var sx_reload_content = function sx_reload_content(reload_element) {
  jQuery('[load-content="' + reload_element + '"]').attr('loaded', 'false');
  load_content();
};
/*
*   Load content 
*/


var load_content = function load_content() {
  jQuery("[load-content][loaded='false']").each(function () {
    if (jQuery(this).attr('offset') !== undefined) {
      offset = jQuery(this).attr('offset');
    }

    get_content(jQuery(this).attr('load-content'), jQuery(this), offset);
  });
};
/*
*   Done loading page 
*/


jQuery(window).on('load', function () {
  jQuery('body').append('<div sx-popups="wrapper"></div>'); // Insert popup wrapper

  load_content(); // Load content
});
/*
*   Load single item 
*/

var loadSingleItem = function loadSingleItem(Element) {
  content_name = Element;
  container = jQuery('[load-content="' + content_name + '"]');
  jQuery.ajax({
    url: sx_plugin_location_main + '/ajax/global-variables/load_content.php',
    type: 'get',
    data: {
      content_name: content_name
    },
    success: function success(response) {
      if (response == 'error') {
        alert('Er ging iets mis met het laden van: ' + content_name);
        return false;
      } // Error


      container.attr('loaded', 'true'); // Set container loaded

      if (container.attr('src-after') !== undefined) {
        container.attr('src', response); // Put data inside container

        return;
      }

      container.html(response); // Put data inside container
    }
  });
};