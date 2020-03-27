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
