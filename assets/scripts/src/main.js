// Scripts for the MILO S3 browser
jQuery(document).ready(function() {
  // Applies preload changes
  jQuery('.m-fileList.--preload').addClass('--is-collapsed').slideToggle(0).removeClass('--preload');

  jQuery('.a-fileFolder').click(function() {
    jQuery(this).find('.a-fileFolder__icon').toggleClass('--is-hidden');
    jQuery(this).siblings('.m-fileList').toggleClass('--is-clicked').slideToggle();
  });

  jQuery('.a-browserItem').hover(
    function() {
      jQuery(this).children('.a-browserItem__icon').addClass('--is-hovered');
      jQuery(this).children('.a-browserItem__text').addClass('--is-hovered');
      jQuery(this).siblings('.a-browserButton').children('.a-browserButton__link').addClass('--is-hovered');
    },
    function() {
      jQuery(this).children('.a-browserItem__icon').removeClass('--is-hovered');
      jQuery(this).children('.a-browserItem__text').removeClass('--is-hovered');
      jQuery(this).siblings('.a-browserButton').children('.a-browserButton__link').removeClass('--is-hovered');
    }
  );

  jQuery('.a-browserButton').hover(
    function() {
      jQuery(this).children('.a-browserButton__link').addClass('--is-hovered');
      jQuery(this).siblings('.a-browserItem').addClass('--is-hovered');
      jQuery(this).siblings('.a-browserItem').children('.a-browserItem__icon').addClass('--is-hovered');
      jQuery(this).siblings('.a-browserItem').children('.a-browserItem__text').addClass('--is-hovered');
    },
    function() {
      jQuery(this).children('.a-browserButton__link').removeClass('--is-hovered');
      jQuery(this).siblings('.a-browserItem').removeClass('--is-hovered');
      jQuery(this).siblings('.a-browserItem').children('.a-browserItem__icon').removeClass('--is-hovered');
      jQuery(this).siblings('.a-browserItem').children('.a-browserItem__text').removeClass('--is-hovered');
    }
  );
});