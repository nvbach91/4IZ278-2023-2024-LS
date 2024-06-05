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
        console.log('alllikes: '+allLikes);
        console.log('allComments: '+allComments);
    })
    .catch((error) => {
        // This is where you handle errors.
    });

function checkSpot(Sid) {
    let spot_id;
    let like_id;
    spot_id = parseInt(Sid);

    /*CHECK LIKES*/
    document.querySelector(`#like-${spot_id}`).style.display = 'block';
    document.querySelector(`#unlike-${spot_id}`).style.display = 'none';

    likedSpots.forEach(showLikes);

    function showLikes(Lid) {
        like_id = parseInt(Lid);

        if (spot_id == like_id) {
            document.querySelector(`#like-${spot_id}`).style.display = 'none';
            document.querySelector(`#unlike-${spot_id}`).style.display = 'block';
            console.log('spot liked');
        }
    }

    /*CHECK COMMENTS*/
    let commentsOnSpot = [];
    let commentContainer = document.querySelector(`#comments-${spot_id}`)
    for (let i = 0; i < allComments.length; i++) {
        if (allComments[i][0]['spot_id'] == spot_id) {
            commentsOnSpot.push(allComments[i]);
        }
    }
    console.log("comments on spot " + spot_id + " " + commentsOnSpot);
    if(commentsOnSpot.length == 0){
        commentContainer.innerHTML +=
        `
            <p style="width: 100%;text-align:center;">
                Zatím žádné komentáře
            </p>
            `;
    }
    else{
        for (let i = 0; i < commentsOnSpot.length; i++) {
            if(commentsOnSpot[i][0]['user_id']==user_id){
                commentContainer.innerHTML +=
                `
                <div class="comment">
                    <div class="comment-bubble">
                        <p class="comment-author">${commentsOnSpot[i][0]['username']}</p><p class="comment-date">${commentsOnSpot[i][0]['date']}</p><br>
                        <p class="comment-text">${commentsOnSpot[i][0]['text']}</p><br>
                        <a class="comment-delete" href='./delete-comment.php?delete_comment_id=${commentsOnSpot[i][0]['comment_id']}\'>Odstranit komentář</a>
                    </div>
                </div>
                    `;
            }
            else{
                commentContainer.innerHTML +=
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