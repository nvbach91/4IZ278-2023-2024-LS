let likedSpots = [];
let allLikes = [];
let allComments = [];
let allUsers = [];

let user_id = null;
let user_username = null;

fetch("./main-download.php")
    .then((response) => {
        if (!response.ok) {
            throw new Error("Something went wrong!");
        }
        return response.json(); // Parse the JSON data.
    })
    .then((data) => {
        // This is where you handle what to do with the response.
        likedSpots = data[0];
        allLikes = data[1];
        allComments = data[2];

        user_id = data[3];
        user_username = data[4];
        console.log('alllikes: ' + allLikes);
        console.log('allComments: ' + allComments);
    })
    .catch((error) => {
        // This is where you handle errors.
    });

function checkSpot(Sid) {
    let spot_id;
    let like_id;
    spot_id = parseInt(Sid);

    /*CHECK LIKES*/
    let likeContainer = document.querySelectorAll(`#like-${spot_id}, #likeM-${spot_id}`);
    for (let b = 0; b < likeContainer.length; b++) {
        likeContainer[b].style.display = 'block';
    }
    let unlikeContainer = document.querySelectorAll(`#unlike-${spot_id}, #unlikeM-${spot_id}`);
    for (let b = 0; b < unlikeContainer.length; b++) {
        unlikeContainer[b].style.display = 'none';
    }

    likedSpots.forEach(showLikes);

    function showLikes(Lid) {
        like_id = parseInt(Lid);

        if (spot_id == like_id) {
            for (let b = 0; b < likeContainer.length; b++) {
                likeContainer[b].style.display = 'none';
            }
            for (let b = 0; b < unlikeContainer.length; b++) {
                unlikeContainer[b].style.display = 'block';
            }
            console.log('spot liked');
        }
    }

    /*CHECK COMMENTS*/
    let commentsOnSpot = [];
    let commentContainer = document.querySelectorAll(`#comments-${spot_id}, #commentsM-${spot_id}`);

    for (let b = 0; b < commentContainer.length; b++) {


        for (let i = 0; i < allComments.length; i++) {
            if (allComments[i][0]['spot_id'] == spot_id) {
                commentsOnSpot.push(allComments[i]);
            }
        }
        console.log("comments on spot " + spot_id + " " + commentsOnSpot);
        if (commentsOnSpot.length == 0) {
            commentContainer[b].innerHTML +=
                `
            <p style="width: 100%;text-align:center;">
                Zatím žádné komentáře
            </p>
            `;
        }
        else {
            for (let i = 0; i < commentsOnSpot.length; i++) {
                date = commentsOnSpot[i][0]['date'];
                if (commentsOnSpot[i][0]['user_id'] == user_id) {
                    commentContainer[b].innerHTML +=
                        `
                <div class="comment">
                    <div class="comment-bubble">
                        <p class="comment-author">${commentsOnSpot[i][0]['username']}</p><p class="comment-date">${date}</p><br>
                        <p class="comment-text">${commentsOnSpot[i][0]['text']}</p><br>
                        <a class="comment-delete" href='./delete-comment.php?delete_comment_id=${commentsOnSpot[i][0]['comment_id']}\'>Odstranit komentář</a>
                    </div>
                </div>
                    `;
                }
                else {
                    commentContainer[b].innerHTML +=
                        `
                    <div class="comment">
                        <div class="comment-bubble">
                            <p class="comment-author">${commentsOnSpot[i][0]['username']}</p><p class="comment-date">${commentsOnSpot[i][0]['date']}</p><br>
                            <p class="comment-text">${commentsOnSpot[i][0]['text']}</p>
                        </div>
                    </div>
                        `;
                }
            }
        }

        commentContainer[b].scrollTop = commentContainer[b].scrollHeight;
    }

}

function countLikes(Sid) {
    let spot_id;
    let like_id;
    let thisSpot = [];

    spot_id = parseInt(Sid);
    allLikes.forEach(countLikes);

    function countLikes(Lid) {
        like_id = parseInt(Lid);
        if (spot_id == like_id) {
            thisSpot.push(spot_id);
        }
    }
    return thisSpot.length;
}