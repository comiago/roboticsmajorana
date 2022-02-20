$(document).ready(function(){
    $(".menuIcon").click(function(e){
        $(".menu").toggleClass('open');
        $(".menuIcon").toggleClass("change");
    });

    $(".dropdown").click(function(e){
        $(this).toggleClass('dropdownOpen');
    });
    // function loadPageDetails(id) {
    //     $.ajax({
    //         url: 'fetch.php',
    //         method: 'post',
    //         data:{id:id},
    //         success: function(data){
    //             $('.content').html(data);
    //         }
    //     });
        
    //     loadPageDetails(1);

    //     $()
    // }
});