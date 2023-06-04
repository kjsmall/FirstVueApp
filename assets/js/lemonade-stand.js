jQuery( document ).ready(function() {
    jQuery('.portfolio-element-wrapper .nav li a').on('click', function(){
    	jQuery('.portfolio-element-wrapper .row .col').removeClass('initial-hide');
	});
});