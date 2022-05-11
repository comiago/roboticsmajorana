let isOpenMoreNav = false;
let moreNavOverlay = document.createElement('div');
moreNavOverlay.id = "more-nav-overlay";

let emailError = usernameError = passwordError = true;

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
                    $('.selectedThirdColumn').removeClass('selectedThirdColumn');
                    $(this).addClass('selectedThirdColumn');
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
        $('.selectedThirdColumn').removeClass('selectedThirdColumn');
        let focus = $(this).attr("focus");
        alert($focus);
        $.ajax({
            url: "dbh/resurces.php",
            method: "POST",
            data:{function:"getPage", page:focus},
            success:function(data){
                $(".content").html(data);
            },
        });
    })

    loadFirstMoreNav();

    /* DASHBOARD */
    $(".toggle").click(function() {
        $(".navigation").toggleClass("active");
        $(".main").toggleClass("active");
    });

    $(".navigation li").click(function() {
        if(!$(this).hasClass('siteTitle')){
            $(".clicked").removeClass("clicked");
            $(this).addClass("clicked");
        }
    });

    // REGISTRATION
    $('.txtField #email').change(function(){
        regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        email = $(this).val();
        if(regex.test(email)){
            console.log("valid email");
            emailError = false;
        } else {
            console.log("invalid email");
            emailError = true;
        }
        $.ajax({
            url: "dbh/administration.php",
            method: "POST",
            data:{function:"checkEmail", email:email},
            success:function(data){
                if (data > 0) {
                    console.log("Email already exists");
                    emailError = true;
                }
                else {
                    console.log("Email available");
                    emailError = false;
                }
            },
        });
    });

    $('.txtField #username').change(function(){
        username = $(this).val();
        $.ajax({
            url: "dbh/administration.php",
            method: "POST",
            data:{function:"checkUsername", username:username},
            success:function(data){
                if (data > 0) {
                    console.log("Username already exists");
                    usernameError = true;
                }
                else {
                    console.log("Username available");
                    usernameError = false;
                }
            }
        });
    });

    $('.txtField #confirmPassword').change(function(){
        password = $('.txtField #password').val();
        confirmPassword = $(this).val();
        if(password === confirmPassword){
            console.log("Password confirmed");
            passwordError = false;
        } else {
            console.log("Password doesen't match");
            passwordError = true;
        }
    });

    $('.form').submit(function(){
        event.preventDefault();
        if (!emailError && !usernameError && !passwordError) {
            console.log("Non ci sono errori");
            name = $('.txtField #name').val();
            surname = $('.txtField #surname').val();
            email = $('.txtField #email').val();
            username = $('.txtField #username').val();
            password = $('.txtField #password').val();
            role = $('.txtField #role').val();
            referent = $('.txtField #referent').val();
            $.ajax({
                url: "dbh/administration.php",
                method: "POST",
                data:{function:"register", name:name, surname:surname, email:email, username:username, password:password, role:role, referent:referent},
                success:function(data){
                    alert(data);
                    window.location.replace("/dashboard.php");
                }
            });
        }
        else {
            alert("Ci sono errori");
        }
    });

    // DASHBOARD RESURCES
    $('#pages').click(function(){
        $.ajax({
            url: "dbh/administration.php",
            method: "POST",
            data:{function:"getPages", page:focus},
            success:function(data){
                $(".main").html(data);
            },
        });
    });
});