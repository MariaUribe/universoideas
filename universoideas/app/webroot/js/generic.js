/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/* Inicio message plugin */

var myMessages = ['info-jq','warning-jq','error-jq','success-jq'];

$(document).ready(function(){
    // Show message
    for(var i=0;i<myMessages.length;i++) {
        showMessage(myMessages[i]);
    }

    // When message is clicked, hide it
    $('.message-jq').click(function(){		
        hideAllMessages();
        $(this).animate({top: -$(this).outerHeight()}, 500);
    });
    
    setTimeout(function(){hideAllMessages()},3000);
    
    /*$('form').each(function () {
        $(this).validate({
            rules: {
                "data[User][password]": {
                    required: true,
                    minlength: 5
                },
                password_confirm : {
                    required: true,
                    minlength: 5,
                    equalTo : "#password"
                }
            },
            messages: {
                "data[User][password]": {
                    required: "Campo requerido",
                    minlength: "La contraseña debe contener al menos 5 caracteres."
                },
                password_confirm: {
                    required: "Campo requerido",
                    minlength: "La contraseña debe contener al menos 5 caracteres.",
                    equalTo: "Las contraseñas no coinciden. Por favor, intente de nuevo."
                }
            }
        });
    }); */
});

function jssor_slider1_starter() {
    
    var _CaptionTransitions = [];
    _CaptionTransitions["transition_left"] = {$Duration:1500,x:0.6,$Easing:{$Left:$JssorEasing$.$EaseInOutExpo},$Opacity:2};
    
    var options = {
            $AutoPlay: true,
            $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$,
                $ChanceToShow: 2,
                $AutoCenter: 1
            },
            $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $ChanceToShow: 2,
                $AutoCenter: 2
            },
            $CaptionSliderOptions: {
                $Class: $JssorCaptionSlider$,
                $CaptionTransitions: _CaptionTransitions,
                $PlayInMode: 1,
                $PlayOutMode: 3,
                $Zoom: 1,
                $Rotate: 1,
                $Opacity: 2
            }
        };
        
    var jssor_slider1 = new $JssorSlider$('slider1_container', options);
    
    //responsive code begin
    //you can remove responsive code if you don't want the slider scales
    //while window resizes
    function ScaleSlider() {
        var parentWidth = $('#slider1_container').parent().width();
        if (parentWidth) {
            jssor_slider1.$ScaleWidth(parentWidth);
        }
        else
            window.setTimeout(ScaleSlider, 30);
    }
    //Scale slider after document ready
    ScaleSlider();

    //Scale slider while window load/resize/orientationchange.
    $(window).bind("load", ScaleSlider);
    $(window).bind("resize", ScaleSlider);
    $(window).bind("orientationchange", ScaleSlider);
    //responsive code end
}

function hideAllMessages() {
    var messagesHeights = new Array(); // this array will store height for each

    for (i=0; i<myMessages.length; i++) {
        messagesHeights[i] = $('.' + myMessages[i]).outerHeight(); // fill array
        $('.' + myMessages[i]).css('top', -messagesHeights[i]); //move element outside viewport	  
    }
}

function showMessage(type) {
    $('.'+ type +'-trigger').click(function(){
        hideAllMessages();				  
        $('.'+type).animate({top:"0"}, 500);
    });
}
/* Fin message plugin */

function selectMedia(value) {
    var article_id = $('#ArticleId').val();
    
    if(value=="img") {
        $('#related_img').css('display', 'block');
        $('#related_vid').css('display', 'none');
        $("#related_vid :input").val('');
        setInputOptional('.related_vid');
        if(article_id != null)
            setInputOptional('.related_img');
        else
            setInputRequired('.related_img');
        $('#ArticleMedia').val("imagen");
        
    } else if(value=="vid") {
        $('#related_img').css('display', 'none');
        $('#related_vid').css('display', 'block');
        $("#related_img :input").val('');
        setInputOptional('.related_img');
        setInputRequired('.related_vid');
        $('#ArticleMedia').val("video");
        
    } else {
        $('#related_img').css('display', 'none');
        $('#related_vid').css('display', 'none');
        $("#related_img :input").val('');
        $("#related_vid :input").val('');
        setInputOptional('.related_img');
        setInputOptional('.related_vid');
        $('#ArticleMedia').val("ninguno");
    }
}

function setInputRequired(selector) {
    $(selector).attr("required", "required");
}

function setInputOptional(selector) {
    $(selector).removeAttr("required");
}

function validateInputFile(element){
    var value = element.value.split(".");
    var ext = value[1];
    var arr_ext = new Array('jpg', 'jpeg', 'gif');
    
    var found = $.inArray(ext.toLowerCase(), arr_ext) > -1;
    
//    if(!found){
//        alert('Error!!!');
//    } else {
//        alert('Extension valida =)');
//    }
}

function loadMultimedia() {
    var imgId = $('#RelatedImageId').val();
    var vidId = $('#RelatedVideoId').val();
    
    if(imgId != null && imgId != "") {
        $('#radio_img').attr('checked', 'true');
        selectMedia($('#radio_img').val());
        setInputOptional('.related_img');
    } else if(vidId != null && vidId != "") {
        $('#radio_vid').attr('checked', 'true');
        selectMedia($('#radio_vid').val());
    } else {
        $('#radio_ninguno').attr('checked', 'true');
        selectMedia($('#radio_ninguno').val());
    }
}

function changePais(id) {
    var replacementDiv;

    if (document.getElementById("locationId").value == "")						
        document.getElementById("locationId").value=id;

    if (document.getElementById("selectDiv" + id)!= null){
        replacementDiv = document.getElementById("selectDiv" + id);
    }
    else{
        replacementDiv = document.getElementById("selectDivDef");
    }
    document.getElementById("Planilla").innerHTML = replacementDiv.innerHTML;
    showForm(false);			
}

function showForm(show){
    var globalDiv;

    if(show == true){
        if (document.getElementById("showDiv")!= null){
            globalDiv = document.getElementById("showDiv");
        }
        else{
            globalDiv = document.getElementById("selectDivDef");
        }
    } else {
        globalDiv = document.getElementById("selectDivDef");
    }
}

function setLocationForm(id){
    if (id==0){
        document.getElementById("locationId").value=document.userForm.countryId.value;				
    } else {
        document.getElementById("locationId").locationId.value=id;
    }					
}

function changePassword() {
    $('.new_pass').css('display', '');
}

function cancelChangePassword() {
    $('.new_pass').css('display', 'none');
    $('#btn-signup').removeAttr('disabled');
}

function changeAnswer() {
    $('.new_ans').css('display', '');
}

function cancelChangeAnswer() {
    $('.new_ans').css('display', 'none');
}

function setMenuSelected() {
    var page = $('#page_code').val();
    $('body').attr('id', page);
    
    $('#menu-top a').removeClass('menu-top-active');
    $('#' + page + '_menu').addClass('menu-top-active');
}

function displayMail() {
    $('#loginbox').hide();
    $('#forgotbox').show();
}

function cancelForgot() {
    $('#loginbox').show();
    $('#forgotbox').hide();
}