/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function selectMedia(option) {
    var value = option.value;
    
    if(value=="img") {
        $('#related_img').css('display', 'block');
        $('#related_vid').css('display', 'none');
        $("#related_vid :input").val('');
        setInputOptional('.related_vid');
        setInputRequired('.related_img');
        
    } else if(value=="vid") {
        $('#related_img').css('display', 'none');
        $('#related_vid').css('display', 'block');
        $("#related_img :input").val('');
        setInputOptional('.related_img');
        setInputRequired('.related_vid');
        
    } else {
        $('#related_img').css('display', 'none');
        $('#related_vid').css('display', 'none');
        $("#related_img :input").val('');
        $("#related_vid :input").val('');
        setInputOptional('.related_img');
        setInputOptional('.related_vid');
    }
}

function setInputRequired(selector) {
    $(selector).attr("required", "required");
}

function setInputOptional(selector) {
    $(selector).removeAttr("required");
}
