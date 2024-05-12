let allComments = [];

fetch("./comment-system.php")
    .then((response) => {
        if (!response.ok) { // Before parsing (i.e. decoding) the JSON data,
            // check for any errors.
            // In case of an error, throw.
            throw new Error("Something went wrong!");
        }

        return response.json(); // Parse the JSON data.
    })
    .then((data) => {
        // This is where you handle what to do with the response.
        allComments = data; // Will alert: 42
        console.log(allComments);
    })
    .catch((error) => {
        // This is where you handle errors.
    });

function commentsOnSpot(Sid) {
    let spot_id;
    let comment_id;

    spot_id = parseInt(Sid);

    allComments.forEach(showLikes);
}