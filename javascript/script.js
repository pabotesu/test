$sIndex = 0;
$arr = ["images/johoGO.png", "images/image1.gif", "images/image2.gif", "images/image3.gif"];
$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('.top').fadeIn()
        } else {
            $('.top').fadeOut()
        }
    });
    $('.top').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 700);
        return false;
    });
    $('#menu').click(function() {
        $("nav button.dropdown:not(:animated)").slideToggle(600)
    });
    $('.home').click(function() {
        window.location = "";
    });
    $('.login').click(function() {
        window.location = "index.html";
    });
    $('.mondai-mode').click(function() {
        window.location = "/mon-mode";
    });
    $('.login').click(function() {
        window.location = "/log/home.php";
    });
    $('.preload').fadeIn(2000);
    $slides = $("#pro-pic img");
    $("#nextInfo").click(function() {
        $sIndex++;
        slideshow();
        return false
    });
    $("#preInfo").click(function() {
        $sIndex--;
        slideshow();
        return false;
    });
    function slideshow() {
        $sIndex %= $arr.length;
        if($sIndex < 0){
            $sIndex = $arr.length -1;
        }
        $slides.hide().removeAttr("src").attr("src", $arr[$sIndex]).removeAttr("alt").attr("alt", $arr[$sIndex]).fadeIn("slow");
    }
});
