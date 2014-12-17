document.addEventListener("DOMContentLoaded", function (e) {

});

function loadPostComments(page, postId, show, pages) {
    $('.comments').html("Loading...");
    $.ajax({
        url: "inc/getComments.php?page=" + page + "&id=" + postId + "&show=" + show,
        context: document.body
    }).error(function () {
        console.log("error");
    }).done(function (result) {
        result = JSON.parse(result);
        $('.comments').html("");
        result.forEach(function (row) {
            var date = new Date();
            date.setTime(parseInt(row.time) * 1000);
            date = date.getDate() + '.' + date.getMonth() + '.' + date.getFullYear() + ' ' + date.getHours() + ':' + date.getMinutes();
            var commentDiv = '<div class="comment">';
            commentDiv += date + "</br>";
            commentDiv += row.name + "<br/>";
            commentDiv += row.comment;
            commentDiv += "</div><br/>";
            $('.comments').append(commentDiv);
        });
        var pagesDiv = '';
        for (var i = 1; i <= pages; i++) {
            if (page != i) {
                pagesDiv += '<a href="javascript: loadPostComments(' + i + ', ' + postId + ', ' + show + ', ' + pages + ')">' + i + '</a> | ';
            } else {
                pagesDiv += '<span>' + i + '</span> | ';
            }
        }
        $('.pages').html(pagesDiv);
    });
}

function loadPosts(page, show, pages) {
    $('.posts').html("Loading...");
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
            postDiv += '<div>Views: ' + row.views + '</div>';
            postDiv += "</div><br/>";
            $('.posts').append(postDiv);
        });
        var pagesDiv = '';
        for (var i = 1; i <= pages; i++) {
            if (page != i) {
                pagesDiv += '<a href="javascript: loadPosts(' + i + ',' + show + ',' + pages + ');">' + i + '</a> | ';
            } else {
                pagesDiv += '<span>' + i + '</span> | ';
            }
        }
        $('.pages').html(pagesDiv);
    });
}

function removeComment(id, postId) {
    $.post('inc/removeComment.php', {id: id, postId: postId}, function (e) {
        window.location = e;
    });
}