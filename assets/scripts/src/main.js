// @codekit-prepend "../../../../milo-s3-browser/node_modules/dialog-polyfill/dialog-polyfill.js";

// Scripts for the MILO S3 browser
jQuery(document).ready(function() {
  // Process dialog elements
  const dialog = document.querySelectorAll('dialog');
  for( let e = 0; e < dialog.length; e++) {
    dialogPolyfill.registerDialog(dialog[e]);
  }

  // Applies preload changes
  jQuery('.m-fileList.--preload').addClass('--is-collapsed').slideToggle(0).removeClass('--preload');
  jQuery('.a-browserDescription__body').slideToggle(0).removeClass('--preload');

  // Login modal toggles
  jQuery('.o-browserLogin__link').click(function() {
    document.getElementById('milo-login-modal').showModal();
  });
  jQuery('.a-loginModal__close').click(function() {
    document.getElementById('milo-login-modal').close();
  });

  // Controls the opening and closing of the folder icon
  jQuery('.a-fileFolder').click(function() {
    jQuery(this).find('.a-fileFolder__icon').toggleClass('a-fileFolder__icon--hidden');
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