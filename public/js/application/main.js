$(document).ready(function(){
    /* Main Menu */
    $('nav .active').children('ul.collapse').toggleClass('show');
    $('nav .hasSubmenu').children('a').click(function()
	{
        var menu = $(this).parent();
        var subMenu = menu.children('ul.collapse');
        menu.toggleClass('active');
        subMenu.toggleClass('show');
	});
    
    /* Zend Developer Tools Ajax Refresh */
    
    $(document).ajaxSuccess(function(event, request, settings){
        $('#zend-developer-toolbar-wrapper').html(request.responseJSON.toolbar);
    });
});