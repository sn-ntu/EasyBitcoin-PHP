/** 
 * Automatically Generated - DO NOT EDIT 
 * Zcoin Faucet / v1.0.0 / 2018-05-30 
 */ 

!function(a){"use strict";a("form").submit(function(b){b.preventDefault();var c=a(this),d=a('button[type="submit"]',c),e=d.text();d.prop("type","button"),d.text("Sending ..."),a("#error_message").hide(),a.ajax({"type":"POST","url":c.attr("action"),"data":c.serialize(),"dataType":"json"}).done(function(b){a("#error_message").hide(),a("#success_message").text(b.message).show(),c.hide()}).fail(function(b,c){a("#success_message").hide(),a("#error_message").text(b.responseJSON.message).show(),d.text(e),d.prop("type","submit")})})}(jQuery);