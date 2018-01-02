//<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
$(document).ready(function(){
    //Sticky Nav (initial - prevents jump)
    $("#navBarWrapper").css("height", $("#navBar").height());
    $(window).scroll(function(){
        if ($(window).scrollTop() > $("#banner").height()) {
            $('#navBar').addClass('navBar-fixed');
        }
        else{
            $('#navBar').removeClass('navBar-fixed');
        }
    });

    //Fade-out for #LPLogo img (initial and on resize)
    var dist = $("#LPNHS").position().left - $("#LPLogo").position().left;
    if(dist>0){
        $("#LPLogo").css("opacity", (dist-180)/70);    
    }
    $(window).resize(function(){
        var dist = $("#LPNHS").position().left - $("#LPLogo").position().left;
        if(dist>0){
            $("#LPLogo").css("opacity", (dist-180)/70);    
        }
    });

    //Log in button
    $("#headerLoginButton").click(function () {
        window.location = "login.php";
    });
    //Log out button
    $("#headerLogoutButton").click(function () {
        window.location = "logout.php";
    });

    //Log In dropdown (initial-hidden)
    // $("#login").slideUp(1);
    // $("#loginSlider").click(function(){
    //     $("#login").css("visibility", "visible")
    //     .stop()
    //     .slideToggle(200);
    //});
});