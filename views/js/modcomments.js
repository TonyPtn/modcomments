$(document).ready(function()
{
    //Check if comment posted value true
    if($('#modcomments-content-tab').attr('data-scroll') == 'true')
    {
        $('html, body').animate({
        scrollTop: $("#modcomments-content-tab").offset().top
    }, 2000);
    }
});
