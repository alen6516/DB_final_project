$(document).ready(function () {
    $('#btn').click(function (){
        $.ajax({
            url: 'receive.php',
            cache: false,
            dataType: 'html',
            type:'POST',
            data: { name: $('#input').val()},
            error: function(xhr) {
                alert('Ajax request fail');
            },
            success: function(response) {
                $('#msg').html("");
                $('#msg').html(response);
            }
        });
    });
    /*
    $("#select").click(function(){
       $("#input").val("SELECT * FROM list WHRER 1") 
    });

    $("#delete").click(function(){
       $("#input").val("DELETE") 
    });

    $("#insert").click(function(){
       $("#input").val("INSERT INTO") 
    });

    $("#update").click(function(){
       $("#input").val("UPDATE") 
    });
    */
    $("#clear").click(function(){
        $("#msg").html("");
    });
    
    $(".hide_div").hide();
    /*
    function InsertContent(AreaID,Content) {
        var myArea = document.getElementById(AreaID);
 
        //IE
        if (document.selection)  
        {   
            myArea.focus();
            var mySelection =document.selection.createRange();
            mySelection.text = Content;
        }
        //FireFox
        else  
        {
            var myPrefix = myArea.value.substring(0, myArea.selectionStart);
            var mySuffix = myArea.value.substring(myArea.selectionEnd);
            myArea.value = myPrefix + Content + mySuffix;
        }   
    }
    */

    $("option").dblclick(function(){
        var myArea = document.getElementById("input");
        var Content = $(this).val();
        //alert(content);
        //IE
        if (document.selection)  
        {
            myArea.focus();
            var mySelection =document.selection.createRange();
            mySelection.text = Content;
        }
        //FireFox
        else  
        {
            var myPrefix = myArea.value.substring(0, myArea.selectionStart);
            var mySuffix = myArea.value.substring(myArea.selectionEnd);
            myArea.value = myPrefix + Content + mySuffix;
        } 
    
    });

    //點table時
    $(".table_option").click(function(){
        var show_div = '.'+$(this).val();
        //alert(show_div);
        $(".field_div").hide();
        $(show_div).show();

        var input_change_disable = show_div+' > input:disabled';
        //alert(input_change_disable);
        $(".field_div > input").attr("disabled",true);
        $(input_change_disable).attr("disabled",false);
    });

})
