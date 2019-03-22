function afterSendMessage() {
    $('#MarkdownEditor-formReply-reply').data()['oc.markdownEditor'].editor.setValue('');
    var scrollHeight = $('.messages-scroll').data()['oc.scrollbar'].$el.get(0).scrollHeight;
    $('.messages-scroll').scrollTop(scrollHeight);
    $('#MarkdownEditor-formReply-reply').data()['oc.markdownEditor'].editor.focus();
}