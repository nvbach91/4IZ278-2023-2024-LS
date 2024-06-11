let likedSpots = [];
let allLikes = [];
let spotComments = [];
let allUsers = [];

let user_id = null;
let user_username = null;

fetch("/../like/DownloadLike.php")
    .then((response) => {
        if (!response.ok) {
            throw new Error("Something went wrong!");
        }
        console.log(response);
        return response.json(); // Parse the JSON data.
    })
    .then((data) => {
        // This is where you handle what to do with the response.
        likedSpots = data[0];
        allLikes = data[1];
        //spotComments = data[2];

        user_id = data[2];
        user_username = data[3];
        console.log('alllikes: ' + allLikes);
        //console.log('spotComments: ' + spotComments);
    })
    .catch((error) => {
        // This is where you handle errors.
        console.log('error:' + error);
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

    fetch("/../comment/DownloadComment.php?spot_id=" + Sid)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Something went wrong!");
            }
            console.log(response);
            return response.json(); // Parse the JSON data.
        })
        .then((data) => {
            // This is where you handle what to do with the response.
            spotComments = data;
            console.log('spotComments: ' + spotComments);


            /*CHECK COMMENTS*/
            let commentContainer = document.querySelectorAll(`#comments-${spot_id}, #commentsM-${spot_id}`);

            for (let b = 0; b < commentContainer.length; b++) {

                if (spotComments.length == 0) {
                    commentContainer[b].innerHTML +=
                        `
            <p style="width: 100%;text-align:center;">
                Zatím žádné komentáře
            </p>
            `;
                }
                else {
                    for (let i = 0; i < spotComments.length; i++) {
                        if (spotComments[i]['user_id'] == user_id) {
                            commentContainer[b].innerHTML +=
                                `
                <div class="comment">
                    <div class="comment-bubble">
                        <p class="comment-author">${spotComments[i]['username']}</p><p class="comment-date">${spotComments[i]['date']}</p><br>
                        <p class="comment-text">${spotComments[i]['text']}</p><br>
                        <a class="comment-delete" href='/../comment/DeleteComment.php?delete_comment_id=${spotComments[i]['comment_id']}\'>Odstranit komentář</a>
                    </div>
                </div>
                    `;
                        }
                        else {
                            commentContainer[b].innerHTML +=
                                `
                    <div class="comment">
                        <div class="comment-bubble">
                            <p class="comment-author">${spotComments[i]['username']}</p><p class="comment-date">${spotComments[i]['date']}</p><br>
                            <p class="comment-text">${spotComments[i]['text']}</p>
                        </div>
                    </div>
                        `;
                        }
                    }
                }

                commentContainer[b].scrollTop = commentContainer[b].scrollHeight;
            }
        })
        .catch((error) => {
            // This is where you handle errors.
            console.log('error:' + error);
        });

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