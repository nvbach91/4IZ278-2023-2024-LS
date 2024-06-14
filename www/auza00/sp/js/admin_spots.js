let spotsFinalAdmin = [];
fetch("/../spot/DownloadSpot.php")
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
        spotsFinalAdmin = data;
        console.log(spotsFinalAdmin);
        numRows = spotsFinalAdmin.length;
        document.getElementById("spots-numberA").innerHTML = 'Number of spots: '+numRows;
        console.log(numRows);

        let colour = 'light';

        for (let i = 0; i < numRows; i++) {
            document.getElementById("spots-listA").innerHTML +=
            `
                <div class="admin_spots_div">
                    <h2>${spotsFinalAdmin[i][3]} | spotID:${spotsFinalAdmin[i][0]}</h2>
                    <h3>by ${spotsFinalAdmin[i][2]} | userID:${spotsFinalAdmin[i][1]}</h3>
                    <p>date: ${spotsFinalAdmin[i][9]}</p>
                    <p>coordinates: ${spotsFinalAdmin[i][5]}, ${spotsFinalAdmin[i][6]}</p>
                    <p>category: ${spotsFinalAdmin[i][7]}</p>
                    <p>description: ${spotsFinalAdmin[i][4]}</p>
                    <img class="admin_spots_img" src="/../spot-img/${spotsFinalAdmin[i][8]}"/>
                </div>
            `;
        }
    })
    .catch((error) => {
        // This is where you handle errors.
        console.log(error);
    });
