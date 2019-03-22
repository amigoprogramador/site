$(document).ready(function () {
    $('#MarkdownEditor-formReply-reply').data()['oc.markdownEditor'].editor.focus();
    var scrollHeight = $('.messages-scroll').data()['oc.scrollbar'].$el.get(0).scrollHeight;
    $('.messages-scroll').scrollTop(scrollHeight);
});