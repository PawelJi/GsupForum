$(function(){
    var converter1 = Markdown.getSanitizingConverter();

    var editor = new Markdown.Editor(converter1);

    editor.run();
});