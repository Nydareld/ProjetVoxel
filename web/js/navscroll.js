jQuery(document).ready(function() {
  var navpos = jQuery('#navbar1').offset();
  console.log(navpos.top);
  jQuery(window).bind('scroll', function() {
      if (jQuery(window).scrollTop() > navpos.top-40) {
          jQuery('#navbar1').addClass('navbar-fixed-top');
          jQuery('#bandeauCoReduit').removeClass('hidden');
          jQuery('#bandeauCo').addClass('hidden');
       }
       else {
           jQuery('#navbar1').removeClass('navbar-fixed-top');
           jQuery('#bandeauCo').removeClass('hidden');
           jQuery('#bandeauCoReduit').addClass('hidden');
       }
    });
});
