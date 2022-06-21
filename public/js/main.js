window.addEventListener("load", function(){
   //boton like
   $('.btn-like').click(function(){
    $(this).addClass('btn-dislike').removeClass('btn-like');
    $(this).attr('src','img/heart-red.png');
   })
});