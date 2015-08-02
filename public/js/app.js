$(function() {
    if ( $('TextArea').is( '#areacontent' ) )
    {
        tinymce.init({
            selector: "#areacontent"
        });
    }
});


var rusChars = new Array
('�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','\�','�','�','�',' ','\'','\"','\#','\$','\%','\&','\*','\,','\:','\;','\<','\>','\?','\[','\]','\^','\{','\}','\|','\!','\@','\(','\)','\-','\=','\+','\/','\\','\.','\�','\�','\�');
var transChars = new Array
('a','b','v','g','d','e','jo','zh','z','i','i','i','j','k','l','m','n','o','p','r','s','t','u','f','h','ch','c','sh','csh','e','ju','ja','y','','','-','','','','','','','','','','','','','','','','','','','','','','','','-','','','','','','n','c','r');
var from = "";
function convert2EN(in_vale, out_value)
{
    from = document.getElementById(in_vale).value;
    from = from.toLowerCase();
    var to = "";
    var len = from.length;
    var character, isRus;
    for(var i=0; i < len; i++)
    {
        character = from.charAt(i,1);
        isRus = false;
        for(var j=0; j < rusChars.length; j++)
        {
            if(character == rusChars[j])
            {
                isRus = true;
                break;
            }
        }
        to += (isRus) ? transChars[j] : character;
    }
    document.getElementById(out_value).value = to;
}