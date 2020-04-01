/* SHOW/HIDE confirmation of deletion */
$(function () {
    $("#delete").click(function () {
        $("#del-conf").show();
        $("#delete").hide();
    });
});

$(function () {
    $("#delete-neg").click(function () {
        $("#del-conf").hide();
        $("#delete").show();
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

/* POST METHOD SHOW FORM */


/*********************************************************** */

// $(document).ready(function($){
//     $("#admin-data-analysis").submit(function(event){
//         event.preventDefault();

//         pass_data = [];

//         var f_month = $("#from-date-month").val();
//         var f_year = $("#from-date-year").val();
//         var u_month = $("#until-date-month").val();
//         var u_year = $("#until-date-year").val();
//         var f_day = $("#from-day").val();
//         var u_day = $("#until-day").val();
//         var f_hour = $("#from-hour").val();
//         var u_hour = $("#until-hour").val();

//         pass_data.push(f_month, f_year, u_month, u_year, f_day, u_day, f_hour, u_hour);


//         if(document.getElementById("selectall").checked ==true){
//             var activity = $("#selectall").val();
//             pass_data.push(activity);
//         }
//         if(document.getElementById("on_foot").checked ==true){
//             var activity1 = $("#on_foot").val();
//             pass_data.push(activity1);
//         }
//         if(document.getElementById("walking").checked ==true){
//             var activity2 = $("#walking").val();
//             pass_data.push(activity2);
//         }
//         if(document.getElementById("running").checked ==true){
//             var activity3 = $("#running").val();
//             pass_data.push(activity3);
//         }
//         if(document.getElementById("on_bicycle").checked ==true){
//             var activity4 = $("#on_bicycle").val();
//             pass_data.push(activity4);
//         }
//         if(document.getElementById("in_vehicle").checked ==true){
//             var activity5 = $("#in_vehicle").val();
//             pass_data.push(activity5);
//         }
//         if(document.getElementById("in_vehicle").checked ==true){
//             var activity6 = $("#in_rail_vehicle").val();
//             pass_data.push(activity6);
//         }
//         if(document.getElementById("in_road_vehicle").checked ==true){
//             var activity7 = $("#in_road_vehicle").val();
//             pass_data.push(activity7);
//         }
//         if(document.getElementById("still").checked ==true){
//             var activity8 = $("#still").val();
//             pass_data.push(activity8);
//         }
//         if(document.getElementById("tilting").checked ==true){
//             var activity9 = $("#tilting").val();
//             pass_data.push(activity9);
//         }
//         if(document.getElementById("unknown").checked ==true){
//             var activity10 = $("#unknown").val();
//             pass_data.push(activity10);
//         }
//         var submit = $("#show_btn").val();
//         pass_data.push(submit);
//         pass_data = JSON.stringify(pass_data);

//         $.post("querys.php", {
//             my: f_month
//         }, function(){
//             alert(pass_data);
//             location.reload()
//             // Δεν γίνεται να κάνω load με αυτην την εντολή!!
//             //$('../map/aheatmap.php #map').load('../map/aheatmap.php #map');

//         });
//     });
// });
