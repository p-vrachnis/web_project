/* SHOW/HIDE confirmation of deletion */
$(function () {
    $("#delete").click(function () {
        $("#del-conf").show();
    });
});

$(function () {
    $("#delete-neg").click(function () {
        $("#del-conf").hide();
    });
});

$(function () {
    $("#delete-conf").click(function () {
        $("#del-conf").hide();
    });
});

/* Check/Uncheck Radio Buttons */
$("input[type=radio]").data('checkedStatus', false);
$("input[type=radio]").on("click",function(){   
    if($(this).data('checkedStatus') == true)
    {
        this.checked = false;
        $(this).data('checkedStatus', false);
    }
    else
    {
         $(this).data('checkedStatus', true);
        this.checked = true;
    }
});

/* Select All */
$('#selectall').on("click", function() {
    if ($(this).is(':checked')) {
        $("input[type=radio]").prop('checked', true);
    } else {
        $("input[type=radio]").prop('checked', false);
    }
});

/* Export CheckBox Options */
$(document).ready(function(){
    $('.export').click(function() {
        $('.export').not(this).prop('checked', false);
    });
});

/* SHOW/HIDE export options */
$(function () {
    $("#export_btn").click(function () {
        $("#export_options").show();
        $("#export_btn").hide();
    });
});

$(function () {
    $("#cancel-export").click(function () {
        $("#export_options").hide();
        $("#export_btn").show();
    });
});

/* POST METHOD DELETE FORM */
$(document).ready(function(){
    $("#delete_form").submit(function(event){
        event.preventDefault();
        var submit = $("#delete-conf").val();

        $.post("querys.php", {
            delete: submit
        }, function(){
            location.reload()
            // Δεν γίνεται να κάνω load και τα 5 Chart μαζί με αυτην την εντολή!!
            //$('#year_activity_chart').load('#year_activity_chart');
        });
    });
});