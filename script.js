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
            url: "/dbh/resurces.php",
            method: "POST",
            data:{function:"getParagraphs", chapter:chapter},
            success:function(data){
                $("#third-more-nav").html(data);
                $(".paragraph").click(function (){
                    let paragraph = $(this).attr("identifier");
                    $.ajax({
                        url: "/dbh/resurces.php",
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
            url: "/dbh/resurces.php",
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
            url: "/dbh/resurces.php",
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
            url: "/dbh/resurces.php",
            method: "POST",
            data:{function:"getPage", page:focus},
            success:function(data){
                $(".content").html(data);
            }
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

    $('#pages').click(function(){
        $.ajax({
            url: "/dbh/administration.php",
            method: "POST",
            data:{function:"getPages"},
            success:function(data){
                $(".main").html(data);
                $('.deletePage').click(function(){
                    page = $(this).parent().parent().attr('page');
                    check = confirm('Are you sure you want to delete the page?');
                    if(check){
                        $.ajax({
                            url: "/dbh/administration.php",
                            method: "POST",
                            data:{function:"deletePage", page:page},
                            success:function(data){
                                alert(data);
                                window.location.replace('/dashboard.php');
                            }
                        });
                    }
                });
            }
        });
    });

    $('#projects').click(function(){
        $.ajax({
            url: "/dbh/administration.php",
            method: "POST",
            data:{function:"getProjects"},
            success:function(data){
                $(".main").html(data);
                $('.deleteProject').click(function(){
                    project = $(this).parent().parent().attr('project');
                    check = confirm('Are you sure you want to delete the project?');
                    if(check){
                        $.ajax({
                            url: "/dbh/administration.php",
                            method: "POST",
                            data:{function:"deleteProject", project:project},
                            success:function(data){
                                alert(data);
                                window.location.replace('/dashboard.php');
                            }
                        });
                    }
                });
            }
        });
    });

    $('#chapters').click(function(){
        $.ajax({
            url: "/dbh/administration.php",
            method: "POST",
            data:{function:"getChapters"},
            success:function(data){
                $(".main").html(data);
                $('.deleteChapter').click(function(){
                    chapter = $(this).parent().parent().attr('chapter');
                    check = confirm('Are you sure you want to delete the chapter?');
                    if(check){
                        $.ajax({
                            url: "/dbh/administration.php",
                            method: "POST",
                            data:{function:"deleteChapter", chapter:chapter},
                            success:function(data){
                                alert(data);
                                window.location.replace('/dashboard.php');
                            }
                        });
                    }
                });
            }
        });
    });

    $('#savePage').click(function(){
        event.preventDefault();
        title = $('#title').val();
        style = $('#style').val();
        content = $('#content').val();
        status = $('#status').val();
        $.ajax({
            url: "/dbh/administration.php",
            method: "POST",
            data:{function:"savePage", title:title, style:style, content:content, status:status},
            success:function(data){
                alert(data);
                window.location.replace('/dashboard.php');
            }
        });
    });

    $('#updatePage').click(function(){
        event.preventDefault();
        page = $('#form').attr('page');
        title = $('#title').val();
        style = $('#style').val();
        content = $('#content').val();
        status = $('#status').val();
        $.ajax({
            url: "/dbh/administration.php",
            method: "POST",
            data:{function:"updatePage", page:page, title:title, style:style, content:content, status:status},
            success:function(data){
                alert(data);
                window.location.replace('/dashboard.php');
            }
        });
    });

    $('#saveProject').click(function(){
        event.preventDefault();
        title = $('#title').val();
        description = $('#description').val();
        status = $('#status').val();
        $.ajax({
            url: "/dbh/administration.php",
            method: "POST",
            data:{function:"saveProject", title:title, description:description, status:status},
            success:function(data){
                alert(data);
                window.location.replace('/dashboard.php');
            }
        });
    });

    $('#updateProject').click(function(){
        event.preventDefault();
        project = $('#form').attr('project');
        title = $('#title').val();
        description = $('#description').val();
        status = $('#status').val();
        $.ajax({
            url: "/dbh/administration.php",
            method: "POST",
            data:{function:"updateProject", project:project, title:title, description:description, status:status},
            success:function(data){
                alert(data);
                window.location.replace('/dashboard.php');
            }
        });
    });

    $('#saveChapter').click(function(){
        event.preventDefault();
        title = $('#title').val();
        description = $('#description').val();
        project = $('#project').val();
        status = $('#status').val();
        $.ajax({
            url: "/dbh/administration.php",
            method: "POST",
            data:{function:"saveChapter", title:title, description:description, project:project, status:status},
            success:function(data){
                alert(data);
                window.location.replace('/dashboard.php');
            }
        });
    });

    $('#updateChapter').click(function(){
        event.preventDefault();
        chapter = $('#form').attr('chapter');
        title = $('#title').val();
        description = $('#description').val();
        project = $('#project').val();
        status = $('#status').val();
        $.ajax({
            url: "/dbh/administration.php",
            method: "POST",
            data:{function:"updateChapter", chapter:chapter, title:title, description:description, project:project, status:status},
            success:function(data){
                alert(data);
                window.location.replace('/dashboard.php');
            }
        });
    });
});