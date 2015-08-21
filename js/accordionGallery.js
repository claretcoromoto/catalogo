/*
 * Author: Lucas Forchino
 * WebSite: http://www.jqueryload.com
 * 
 * Important: Do NOT copy this example to be shown on your web site as a
 * "Gallery example".
 * You can use it for free in any others personals projects
 *
 */

$(document).ready(function(){
    $('.imgParts img').click(function(){
        var parts=20;
        $('#results').css('box-shadow','none');
        $('#results').html('');
        var img = $('<img>');
        var imageSrc=$(this).attr('src');
        img.attr('src',imageSrc);
        img.css('display','none');
        $('#results').append(img);

        var imageHeight=img.height();
        var imageWidth=img.width();
        $('#results').css('width',imageWidth);
        var partHeight=imageHeight/parts;

        for (var i=0;i<parts;i++)
            {
                var div = $('<div>');
                div.addClass('section');
                div.css({height:partHeight,width:imageWidth});
                div.css('background-image',"url("+imageSrc+")");
                var posV=i*partHeight *-1 ;
                div.css('background-position','0px'+' ' +posV +'px');

                var value=1500;
                if((i%2)>0)
                {value =-1500}
                div.css('margin-left',value);

                $('#results').append(div);
            }
        $('#results').find('div').each(function(){
            $(this).animate({'margin-left':0},'slow');
        });
        $('#results').find('div').animate({'margin-bottom':'0'},'slow',function(){
              $('#results').find('div').css('box-shadow','none');
              $('#results').css('box-shadow','1px 1px 5px black');
        });
    })
})
