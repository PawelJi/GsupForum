$(function(){
    var converter1 = Markdown.getSanitizingConverter();

    var editor = new Markdown.Editor(converter1);

    editor.run();

    editor.hooks.set("insertImageDialog", function (callback) {
        setTimeout(function () {

            $('#modalInsertImage').modal("show");

            var prompt = "We have detected that you like cats. Do you want to insert an image of a cat?";
            if (confirm(prompt))
                callback("http://icanhascheezburger.files.wordpress.com/2007/06/schrodingers-lolcat1.jpg")
            else
                callback(null);
        }, 0);
        return true; // tell the editor that we'll take care of getting the image url
    });
});