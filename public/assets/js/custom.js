/*
=========================================
|                                       |
|           Scroll To Top               |
|                                       |
=========================================
*/ 
$('.scrollTop').click(function() {
    $("html, body").animate({scrollTop: 0});
});


$('.navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu ').click(function(e) {
    e.stopPropagation();
});

/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });    
}


/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
*/

function multiCheck(tb_var) {
    tb_var.on("change", ".chk-parent", function() {
        var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
        $(e).each(function() {
            a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
    }),
    tb_var.on("change", "tbody tr .new-control", function() {
        $(this).parents("tr").toggleClass("active")
    })
}

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });    
}

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$('.bs-tooltip').tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$('.bs-popover').popover();


/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

$('.t-dot').tooltip({
    template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
})


/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
  var sAgent = window.navigator.userAgent;
  var Idx = sAgent.indexOf("MSIE");

  // If IE, return version number.
  if (Idx > 0) 
    return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

  // If IE 11 then look for Updated user agent string.
  else if (!!navigator.userAgent.match(/Trident\/7\./)) 
    return 11;

  else
    return 0; //It is not IE
}
 
function ratingSelected(rating){  
    if(rating == 1){
        $('#rating1').addClass('active');
        $('#rating2').removeClass('active');
        $('#rating3').removeClass('active');
        $('#rating4').removeClass('active');
        $('#rating5').removeClass('active');
        $('#rating1').prop("checked", true);
        $('#rating2').prop('checked', false);
        $('#rating3').prop('checked', false);
        $('#rating4').prop('checked', false);
        $('#rating5').prop('checked', false);
    }else if(rating == 2){
        $('#rating1').addClass('active');
        $('#rating2').addClass('active');
        $('#rating3').removeClass('active');
        $('#rating4').removeClass('active');
        $('#rating5').removeClass('active');
        $('#rating1').prop('checked', true);
        $('#rating2').prop('checked', true);
        $('#rating3').prop('checked', false);
        $('#rating4').prop('checked', false);
        $('#rating5').prop('checked', false);
    }else if(rating == 3){
        $('#rating1').addClass('active');
        $('#rating2').addClass('active');
        $('#rating3').addClass('active');
        $('#rating4').removeClass('active');
        $('#rating5').removeClass('active');
        $('#rating1').prop('checked', true);
        $('#rating2').prop('checked', true);
        $('#rating3').prop('checked', true);
        $('#rating4').prop('checked', false);
        $('#rating5').prop('checked', false);
    }else if(rating == 4){
        $('#rating1').addClass('active');
        $('#rating2').addClass('active');
        $('#rating3').addClass('active');
        $('#rating4').addClass('active');
        $('#rating5').removeClass('active');
        $('#rating1').prop('checked', true);
        $('#rating2').prop('checked', true);
        $('#rating3').prop('checked', true);
        $('#rating4').prop('checked', true);
        $('#rating5').prop('checked', false);
    }else if(rating == 5){
        $('#rating1').addClass('active');
        $('#rating2').addClass('active');
        $('#rating3').addClass('active');
        $('#rating4').addClass('active');
        $('#rating5').addClass('active');
        $('#rating1').prop('checked', true);
        $('#rating2').prop('checked', true);
        $('#rating3').prop('checked', true);
        $('#rating4').prop('checked', true);
        $('#rating5').prop('checked', true);
    }
} 