document.addEventListener("DOMContentLoaded", function (e) {
    if(post){
        $('.writeComment form').show();
        $('.leaveComment').hide();
    }
    $('.leaveComment').on("click", function(){
        $(this).fadeOut(200);
        $('.writeComment form').slideDown(200);
    });
    $('#nicknameInput').on("keyup", function(){
        if($(this).val().length < 3 || $(this).val().length > 50){
            $(this).css({'border-color':'#ff0000'});
            //alert("asd");
        }else{
            $(this).css({'border-color':'#fff'});
        }
    });
    $('#commentTextarea').on("keyup", function(){
        if($(this).val().length < 2){
            $(this).css({'border-color':'#ff0000'});
            //alert("asd");
        }else{
            $(this).css({'border-color':'#fff'});
        }
    });
    $('#emailInput').on("keyup", function(){
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if($(this).val().length > 0 && !re.test($(this).val())){
            $(this).css({'border-color':'#ff0000'});
        }else{
            $(this).css({'border-color':'#fff'});
        }
    });
});




function loadPostComments(page, postId, show, pages,isLogged) {
    $.ajax({
        url: "inc/getComments.php?page=" + page + "&id=" + postId + "&show=" + show,
        context: document.body
    }).error(function () {
        console.log("error");
    }).done(function (result) {
        result = JSON.parse(result);
        $('.comments').html("");
		if(result.length > 0){
		    result.forEach(function (row) {
				var date = new Date();
				date.setTime(parseInt(row.time) * 1000);
				date = date.getDate() + '.' + date.getMonth() + '.' + date.getFullYear() + ' ' + date.getHours() + ':' + date.getMinutes();
				var commentDiv = '<div id="comment'+row.id+'" class="comment">';
				if(isLogged == 1){
                    commentDiv +=  "<div class='removeButton'><a class='comment-remove' href='javascript:removeComment(" + row.id + ", " + row.postId +", " + page + ", " + show +", " + isLogged + ");'>b<span class='removeComment'>Remove comment</span></a></div>";
                }
                commentDiv +='<span class="comment-date">' + date + "</span></br>";
				commentDiv +='<span class="comment-name">'+row.name + "</span><br/>";
				commentDiv +='<span class="comment-text">'+ row.comment;
				commentDiv += "</span></div>";
				$('.comments').append(commentDiv);
			});
		}else{
			$('.comments').html('<span id="noComment">No comments.</span>');
		}
        var pagesDiv = '';
        for (var i = 1; i <= pages; i++) {
            if (page != i) {
                pagesDiv += '<a class="myButton" href="javascript: loadPostComments(' + i + ', ' + postId + ', ' + show + ', ' + pages + ', '+isLogged+')">' + i + '</a>';
            } else {
                pagesDiv += '<span class="myButton selected">' + i + '</span>';
            }
        }
        $('.pages').html(pagesDiv);
    });
}

function loadPosts(page, show, pages) {
    $.ajax({
        url: "inc/getPosts.php?page=" + page + "&show=" + show,
        context: document.body
    }).error(function () {
        console.log("error");
    }).done(function (result) {
        result = JSON.parse(result);
        $('.posts').html(" ");
        result.forEach(function (row) {
            var date = new Date();
            date.setTime(parseInt(row.time) * 1000);
            date = date.getDate() + '.' + date.getMonth() + '.' + date.getFullYear() + ' ' + date.getHours() + ':' + date.getMinutes();
            var title = row.title.length > 50 ? row.title.substr(0, 50) + "..." : row.title;
            var text = row.text.length > 300 ? row.text.substr(0, 300) + "..." : row.text;
            var postDiv = '<div class="post">';
            postDiv += '<div class="date clear" > ' + date + ' </div >';
            postDiv += '<h3 class="postTitle" ><a href = "post.php?id=' + row.id + '" >' + title + ' </a></h3>';
            postDiv += '<div class="postContent" > ' + text + ' </div >';
            postDiv += '<div class="tags" > Tags: ';
            row.tags.split(',').forEach(function (tag) {
                tag = tag.trim();
                postDiv += '<a class="tag" href="index.php?tag=' + tag + '">#' + tag + ' </a> ';
            });
            postDiv += '</div>';
            postDiv += '<div>Views: ' + row.views + '<span class="commentsCnt">Comments: ' + row.commentsCnt +'</span></div>';
            postDiv += "</div><br/>";
            $('.posts').append(postDiv);
        });
        var pagesDiv = '';
        for (var i = 1; i <= pages; i++) {
            if (page != i) {
                pagesDiv += '<a class="myButton" href="javascript: loadPosts(' + i + ',' + show + ',' + pages + ');">' + i + '</a>';
            } else {
                pagesDiv += '<span class="myButton selected">' + i + '</span>';
            }
        }
        $('.pages').html(pagesDiv);
    });
}

function removeComment(id, postId, page, show, isLogged) {
    $.post('inc/removeComment.php', {id: id, postId: postId}, function (e) {
        $("#comment" + id).hide(500);
		commentsCnt--;
		if(page * show - commentsCnt >= 10){
			page--;
		}
		var pages = Math.ceil(commentsCnt/show);
		setTimeout(function(){loadPostComments(page, postId, show, pages,isLogged);}, 500);
    }).fail(function(){
        alert("fail");
    });
}

var voted = 0;
function vote(postId,vote){
   if(voted == 0){
       $.ajax({
           url: "inc/vote.php?postId=" + postId + "&vote=" + vote
       }).done(function(result){
        if(result == "1"){
            if(vote == "up"){
                $('.voteUp').text(parseInt($('.voteUp').text()) + 1);
                $('.voteUp').attr("class","voteUp inActive");
                $('.voteDown').attr("class","voteDown inActive");
                positiveRating++;
            }else if(vote == "down"){
                $('.voteDown').text(parseInt($('.voteDown').text()) + 1);
                $('.voteUp').attr("class","voteUp inActive");
                $('.voteDown').attr("class","voteDown inActive");
                negativeRating++;
            }
            $('.rating .positive').width(positiveWidth = (positiveRating / (positiveRating + negativeRating) * 100) + "%");
            voted = 1;
        }
       }).error(function (){
           alert("Error");
       });
   }
}