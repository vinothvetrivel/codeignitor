window.alert = function(message){
    var applicationName = 'Eatryt';
    var says        =   'says';
    var ok          =   'ok';
    var re          =   new RegExp(' ', 'g');
    var tempMessage =   message.replace(re,'_');
    tempMessage     =   tempMessage.toLowerCase();
    tempMessage     =   tempMessage.trim();

    /*if (typeof language[says] != 'undefined') {
        says  = language[says];
    }
    
    if (typeof language[tempMessage] != 'undefined') {
        message  = language[tempMessage];

    }

    if (typeof language[ok] != 'undefined') {
        ok  = language[ok];

    }*/

    $(document.createElement('div'))
        .attr({title: applicationName+' '+says+'..','class': 'alertJs'})
        .html(message)
        .dialog({
            dialogClass: "no-close",
            buttons: [{text:ok,click: function(){$(this).dialog('close');}}],
            close: function(){$(this).remove();},
            draggable: false,
            modal: true,
            resizable: false,
            position: { my: 'center', at:'center+0' }
        });
};