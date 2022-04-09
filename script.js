let isOpenMoreNav = false;

let moreNavOverlay = document.createElement('div');
moreNavOverlay.id = "more-nav-overlay";

$(document).ready(function(){
    function changeStatusBar(){
        isOpenMoreNav = !isOpenMoreNav;
        if(isOpenMoreNav){
            $('#up-arrow').toggle();
            $('#first-more-nav').css("animation", "firstMoreNavShow .3s forwards");
            $('#moreNav').css("animation", "openMoreNav .2s forwards");
        } else {
            $('#up-arrow').toggle();
            $('#moreNav').css("animation", "closeMoreNav .3s forwards");
            $('#moreNav').prepend(moreNavOverlay);
            $('#moreNav').on("animationend", () => {
                $("#first-more-nav").css("animation", "");
                $("#more-nav-overlay").remove();
            });
        }
    }

    function loadThirdMoreNav(){
        let chapter = $(".selectedSecondColumn").attr("identifier");
        $.ajax({
            url: "dbh/resurces.php",
            method: "POST",
            data:{function:"getParagraphs", chapter:chapter},
            success:function(data){
                $("#third-more-nav").html(data);
                $(".paragraph").click(function (){
                    let paragraph = $(this).attr("identifier");
                    $.ajax({
                        url: "dbh/resurces.php",
                        method: "POST",
                        data:{function:"getSections", paragraph:paragraph},
                        success:function(data){
                            $(".content").html(data);
                        }
                    });
                    $(".active").removeClass("active");
                    $("#dropdown").addClass("active");
                    changeStatusBar();
                });
            }
        });
    }

    function loadSecondMoreNav(){
        let project = $(".selectedFirstColumn").attr("identifier");
        $.ajax({
            url: "dbh/resurces.php",
            method: "POST",
            data:{function:"getChapters", project:project},
            success:function(data){
                $("#second-more-nav").html(data);
                loadThirdMoreNav();
                $('.second-col-element').click(function(){
                    $('.selectedSecondColumn').removeClass('selectedSecondColumn');
                    $(this).addClass('selectedSecondColumn');
                    loadThirdMoreNav();
                });
            }
        });
    }

    function loadFirstMoreNav(){
        $.ajax({
            url: "dbh/resurces.php",
            method: "POST",
            data:{function:"getProjects"},
            success:function(data){
                $("#first-more-nav").html(data);
                loadSecondMoreNav();
                $('.first-col-element').click(function (){
                    $('.selectedFirstColumn').removeClass('selectedFirstColumn');
                    $(this).addClass('selectedFirstColumn');
                    loadSecondMoreNav();
                });
            }
        });
    }

    $('#dropdown').click(function(){
        changeStatusBar();
    });

    $('.nav-left').click(function (){
        if(!$(this).attr("id")){
            $(".active").removeClass("active");
            $(this).addClass("active");
        }
        $focus = $(this).attr("focus")
        $.ajax({
            url: "pages/" + $focus,
            method: "POST",
            data:{function:""},
            success:function(data){
                $(".content").html(data);
            },
        });
    })

    loadFirstMoreNav();
});