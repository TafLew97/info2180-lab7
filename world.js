// JavaScript source code
"use struct";

function all_Chbox() {
    $("#controls").append($('<label></label>', {for: 'checkBox', text: 'All: '}));
    $("#controls").append($('<input />', {id: 'checkBox', type: 'checkbox', name: 'all', value: 'false'}));
}

function get_result(result) {
    $("#result").empty();
    $("#result").append(result);
}

function query_Php(par_Args) {
    var myURL = "world.php?country=" + par_Args[0] + "&all=" + par_Args[1];
    $.ajax({
        url: myURL,
        type: 'POST',
        success: function (result) {
            console.log("success calling");
            get_result(result);
        },
        error: function () {
            console.log("failed ajax calling: " + myURL);
        }
    });
}

$(document).ready(function () {
    console.log("Jquery ready.");

    var vals = [];

    all_Chbox();
    $("#checkBox").on('click', function () {
        switch ($("#checkBox").val()) {
            case 'true':
                $("#checkBox").val('false');
                break;
            case 'false':
                $("#checkBox").val('true');
                break;
        }
    });
    $("#lookup").on('click', function () {
        vals.push($("#country").val());
        vals.push($("#checkBox").val());
        console.log("vals[0]: " + vals[0] + " and vals[1]: " + vals[1]);
        query_Php(vals);
        vals.length = 0;
    });
});