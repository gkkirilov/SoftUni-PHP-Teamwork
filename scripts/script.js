document.addEventListener("DOMContentLoaded", function (e){

});

function loadPage(page,postId,show, pages){
    $('.comments').html("Loading...");
    $.ajax({
        url: "inc/getComments.php?page=" + page + "&id=" + postId + "&show=" + show,
        context: document.body
    }).error(function(){
        console.log("error");
    }).done(function(result) {
        result = JSON.parse(result);
        $('.comments').html("");
        result.forEach(function (row){
            var date = new Date();
            date.setTime(parseInt(row.time)*1000);
            date = date.getDate() + '.' + date.getMonth() + '.' + date.getFullYear() + ' ' + date.getHours() + ':' + date.getMinutes()    ;
            var commentDiv = '<div class="comment">';
            commentDiv += date + "</br>";
            commentDiv += row.name + "<br/>";
            commentDiv += row.comment;
            commentDiv += "</div><br/>";
            $('.comments').append(commentDiv);
        });
        var pagesDiv = '';
        for(var i = 1; i <= pages; i++){
            if(page != i){
                pagesDiv += '<a href="javascript: loadPage(' + i + ', ' + postId + ', ' + show + ', ' + pages + ')">' + i + '</a> | ';
            }else{
                pagesDiv += '<span>' + i +'</span> | ';
            }
        }
        $('.pages').html(pagesDiv);
    });
}