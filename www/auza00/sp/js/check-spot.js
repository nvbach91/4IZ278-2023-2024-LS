let likedSpots = [];
let allLikes = [];
let spotComments = [];
let allUsers = [];

let user_id = null;
let user_username = null;

let liked = false;

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

            console.log('alllikes: ' + allLikes);

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
                    liked = true;
                }
            }
            let likes_number = countLikes(spot_id);
            console.log('likes_number a: '+likes_number);
            document.getElementById('number-likes-'+spot_id).innerHTML = likes_number;
            document.getElementById('number-likesM-'+spot_id).innerHTML = likes_number;

            let clickLike = document.getElementById('like-'+spot_id).getAttribute("onclick");
            let clickLikeSub = clickLike.substring(0,clickLike.indexOf("("));       
            document.getElementById('like-'+spot_id).setAttribute("onclick",clickLikeSub+'('+spot_id+','+likes_number+')');

            let clickUnLike = document.getElementById('unlike-'+spot_id).getAttribute("onclick");
            let clickUnLikeSub = clickUnLike.substring(0,clickUnLike.indexOf("("));       
            document.getElementById('unlike-'+spot_id).setAttribute("onclick",clickUnLikeSub+'('+spot_id+','+likes_number+')');

            let clickLikeM = document.getElementById('likeM-'+spot_id).getAttribute("onclick");
            let clickLikeMSub = clickLike.substring(0,clickLikeM.indexOf("("));       
            document.getElementById('likeM-'+spot_id).setAttribute("onclick",clickLikeMSub+'('+spot_id+','+likes_number+')');

            let clickUnLikeM = document.getElementById('unlikeM-'+spot_id).getAttribute("onclick");
            let clickUnLikeMSub = clickUnLike.substring(0,clickUnLikeM.indexOf("("));       
            document.getElementById('unlikeM-'+spot_id).setAttribute("onclick",clickUnLikeMSub+'('+spot_id+','+likes_number+')');
        })
        .catch((error) => {
            // This is where you handle errors.
            console.log('error:' + error);
        });



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
            let commentContainer = document.querySelectorAll(`#comments${spot_id}, #commentsM${spot_id}`);

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
                        let dateReadable = changeDate(spotComments[i]['date']);
                        if (spotComments[i]['user_id'] == user_id) {
                            commentContainer[b].innerHTML +=
                                `
                <div class="comment comment-${spotComments[i]['comment_id']}" id="comment-${spotComments[i]['comment_id']}">
                    <div class="comment-bubble">
                        <p class="comment-author">${spotComments[i]['username']}</p><p class="comment-date">${dateReadable}</p><br>
                        <p class="comment-text">${spotComments[i]['text']}</p><br>
                        <a class="comment-delete" href="" onclick="return deleteComment(${spotComments[i]['comment_id']});">Odstranit komentář</a>
                    </div>
                </div>
                    `;
                        }
                        else {
                            commentContainer[b].innerHTML +=
                                `
                    <div class="comment comment-${spotComments[i]['comment_id']}" id="comment-${spotComments[i]['comment_id']}">
                        <div class="comment-bubble">
                            <p class="comment-author">${spotComments[i]['username']}</p><p class="comment-date">${dateReadable}</p><br>
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

function checkMySpot(Sid) {
    let spot_id;
    spot_id = parseInt(Sid);

    return new Promise((resolve, reject) =>{
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
                //likedSpots = data[0];
                allLikes = data[1];

                console.log('alllikes: ' + allLikes);

                /*CHECK LIKES*/

                let likes_number = countLikes(spot_id);

                console.log('likes_number'+likes_number);
                //return likes_number;
                resolve(likes_number);
                //document.getElementById('number-likesL-'+spot_id).innerHTML = likes_number;
            })
            .catch((error) => {
                // This is where you handle errors.
                console.log('error:' + error);
            });        
    });


}

function countLikes(Sid) {
    let spot_id;
    let like_id;
    let thisSpot = [];

    spot_id = parseInt(Sid);
    allLikes.forEach(countLikes2);

    function countLikes2(Lid) {
        like_id = parseInt(Lid);
        if (spot_id == like_id) {
            thisSpot.push(spot_id);
        }
    }
    return thisSpot.length;
}

function changeDate(date){
    // Split the date and time parts
    let [datePart, timePart] = date.split(' ');

    // Extract year, month, and day from the date part
    let [year, month, day] = datePart.split('-');

    // Extract hour and minute from the time part
    //let [hour, minute] = timePart.split(':');

    // Format the date as desired
    let newDate = `${day}.${parseInt(month)}.${year}`;
    return newDate;
}