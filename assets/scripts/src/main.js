// @codekit-prepend "../../../../milo-s3-browser/node_modules/dialog-polyfill/dialog-polyfill.js";

// Scripts for the MILO S3 browser
jQuery(document).ready(function() {
  // Process dialog elements
  const dialog = document.querySelectorAll('dialog');
  dialog.forEach(function(element) {
    dialogPolyfill.registerDialog(element);
  });

  // Applies preload changes
  jQuery('.m-fileList.--preload').addClass('--is-collapsed').slideToggle(0).removeClass('--preload');
  jQuery('.a-browserDescription__body').slideToggle(0).removeClass('--preload');

  // If the user is on IE, show IE-related disclosures
  if( navigator.userAgent.includes('MSIE') ){
    jQuery('#milo-sidebar-ie').removeClass('--hidden');
    jQuery('.m-downloadDialog__ieDisclosure').removeClass('--is-hidden');
  }

  // Login modal toggles
  jQuery('.o-browserLogin__link').click(function() {
    document.getElementById('milo-login-modal').showModal();
  });
  jQuery('.a-loginModal__close').click(function() {
    document.getElementById('milo-login-modal').close();
  });

  // If a download modal is in the url, open it
  if( window.location.href.indexOf('#download-') > 0 ) {
    let $id = window.location.href.split('#');
    document.getElementById($id[1]).showModal();
  }

  // Download modal toggling
  jQuery('.a-browserItem__text--title').click(function() {
    let $id = "".concat( 'download-', jQuery(this).attr('href').split('-').slice(1,2) );
    document.getElementById($id).showModal();
  });
  jQuery('.a-browserButton').click(function() {
    let $id = "".concat( 'download-', jQuery(this).attr('href').split('-').slice(1,2) );
    document.getElementById($id).showModal();
  });
  jQuery('.m-downloadDialog__close').click(function() {
    let $id = jQuery(this).parent().attr('id');
    document.getElementById($id).close();
  });

  // Controls the opening and closing of the folder icon
  jQuery('.a-fileFolder').click(function() {
    jQuery(this).find('.a-fileFolder__icon').toggleClass('--is-hidden');
    jQuery(this).siblings('.m-fileList').toggleClass('--is-clicked').slideToggle();
  });

  // Controls hover behavior for individual files
  jQuery('.a-browserItem').hover(
    function() {
      jQuery(this).children('.a-browserItem__icon').addClass('--is-hovered');
      jQuery(this).children('.a-browserItem__text').addClass('--is-hovered');
      jQuery(this).children('.a-browserItem__text').children('.a-browserItem__text--title').addClass('--is-hovered');
      jQuery(this).siblings('.a-browserButton').children('.a-browserButton__link').addClass('--is-hovered');
    },
    function() {
      jQuery(this).children('.a-browserItem__icon').removeClass('--is-hovered');
      jQuery(this).children('.a-browserItem__text').removeClass('--is-hovered');
      jQuery(this).children('.a-browserItem__text').children('.a-browserItem__text--title').removeClass('--is-hovered');
      jQuery(this).siblings('.a-browserButton').children('.a-browserButton__link').removeClass('--is-hovered');
    }
  );
  jQuery('.a-browserButton').hover(
    function() {
      jQuery(this).children('.a-browserButton__link').addClass('--is-hovered');
      jQuery(this).siblings('.a-browserItem').addClass('--is-hovered');
      jQuery(this).siblings('.a-browserItem').children('.a-browserItem__icon').addClass('--is-hovered');
      jQuery(this).siblings('.a-browserItem').children('.a-browserItem__text').addClass('--is-hovered');
      jQuery(this).siblings('.a-browserItem').children('.a-browserItem__text').children('.a-browserItem__text--title').addClass('--is-hovered');
    },
    function() {
      jQuery(this).children('.a-browserButton__link').removeClass('--is-hovered');
      jQuery(this).siblings('.a-browserItem').removeClass('--is-hovered');
      jQuery(this).siblings('.a-browserItem').children('.a-browserItem__icon').removeClass('--is-hovered');
      jQuery(this).siblings('.a-browserItem').children('.a-browserItem__text').removeClass('--is-hovered');
      jQuery(this).siblings('.a-browserItem').children('.a-browserItem__text').children('.a-browserItem__text--title').removeClass('--is-hovered');
    }
  );

  // Controls the toggling of item descriptions
  jQuery('.a-browserDescription__toggle').click(function() {
    jQuery(this).toggleClass('--is-toggled');
    jQuery(this).siblings('.a-browserDescription__body').slideToggle();
  });
  jQuery('.a-browserDescription__title').click(function() {
    jQuery(this).siblings('.a-browserDescription__toggle').toggleClass('--is-toggled');
    jQuery(this).siblings('.a-browserDescription__body').slideToggle();
  });

  // Controls the ability to submit the password form
  jQuery('.m-browserForm__checkbox').click(function() {
    if( jQuery(this).is(':checked') ){
      jQuery(this).siblings('.m-browserForm__button').removeClass('--inactive');
    }
    else {
      jQuery(this).siblings('.m-browserForm__button').addClass('--inactive');
    }
  });
});