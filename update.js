$(document).ready(function(){
    /*    
    $.ajax({
        url: 'insert_receive.php',
        cache: false,
        dataType: 'html',
        type:'GET',
        data: { name: $(".table_option:first-child").val()},
        error: function(xhr) {
            alert('Ajax request fail');
        },
        success: function(response) {
            alert(response);
        }
    });
    */
    
    $(".table_option").click(function (){    
        $(".table_option").removeClass("selected_table");
        $(this).addClass("selected_table");
    });
    
});
