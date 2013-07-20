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
});  


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
