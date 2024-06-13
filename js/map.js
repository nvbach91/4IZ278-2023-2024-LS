/*ADD MAP*/
const API_KEY_MAP = 'CkkzZYbeWORyINsjMDLb9OpXKxqoxc4GKppEpmUypdE';

const url2 = 'https://my-json-server.typicode.com/auzkya/map/places'

let latitude = 14.42076;
let longitude = 50.08804;

let places = { 'random': 'random' };
let points = {};

/*spots on map vars*/
let numRows = 0;
let numRowsRaining = 0;
let nextPoint;
let allPoints = [];
let allPointsRaining = [];
let markerAddedToMap;

let raining;
if(sessionStorage.getItem("raining") == 'null'){
    raining = false;    
}
else{
    raining = sessionStorage.getItem("raining");
}
/*if (raining == 'true'){
    document.body.style.filter= 'invert(1) hue-rotate(310deg)';
}*/
if(raining == 'true'){
    document.getElementById('icon-sun').style.display = 'block';
    document.getElementById('icon-rain').style.display = 'none';
}
else{
    document.getElementById('icon-sun').style.display = 'none';
    document.getElementById('icon-rain').style.display = 'block';
}

/*my spots vars*/
let myPoints = [];

const map = new maplibregl.Map({
    container: 'map',
    center: [latitude, longitude],
    zoom: 10,
    style: {
        'version': 8,
        'glyphs': './_fonts/{fontstack}/{range}.pbf',
        'sources': {
            'basic-tiles': {
                'type': 'raster',
                'url': `https://api.mapy.cz/v1/maptiles/basic/tiles.json?apikey=${API_KEY_MAP}`,
                'tileSize': 256,
            },
        },
        'layers': [{
            'id': 'tiles',
            'type': 'raster',
            'source': 'basic-tiles',
        }],
    },
});

let spotsFinal = [];
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
        spotsFinal = data;
        console.log(spotsFinal);
        numRows = spotsFinal.length;
        console.log(numRows);
    })
    .catch((error) => {
        // This is where you handle errors.
        console.log(error);
    });



map.loadImage(
    './img/joint5.png',
    (error, image) => {
        if (error) throw error;
        map.addImage('joint', image);
        map.loadImage(
            './img/mrak1.png',
            (error, image) => {
                if (error) throw error;
                map.addImage('smoke', image);
                map.loadImage(
                    './img/umbrella.png',
                    (error, image) => {
                        if (error) throw error;
                        map.addImage('joint_raining', image);

                        for (let i = 0; i < numRows; i++) {
                            let nextPoint = {
                                'type': 'Feature' + [i],
                                'geometry': {
                                    'type': 'Point',
                                    'coordinates': [spotsFinal[i][5], spotsFinal[i][6]]
                                },
                                'properties': {
                                    'spot_id': spotsFinal[i][0],
                                    'name': spotsFinal[i][3],
                                    'user_id': spotsFinal[i][1],
                                    'author': spotsFinal[i][2],
                                    'description': spotsFinal[i][4],
                                    'category': spotsFinal[i][7],
                                    //'likes': spotsFinal[i][7],
                                    'imageSRC': 'spot-img/' + spotsFinal[i][8],
                                    'image': spotsFinal[i][8],
                                    'date': changeDate(spotsFinal[i][9]),
                                }
                            }
                            allPoints.push(nextPoint);
                            if (spotsFinal[i][7].split(",")[4] == 'pristresek') {
                                let nextPoint2 = {
                                    'type': 'Feature' + [i],
                                    'geometry': {
                                        'type': 'Point',
                                        'coordinates': [spotsFinal[i][5], spotsFinal[i][6]]
                                    },
                                    'properties': {
                                        'spot_id': spotsFinal[i][0],
                                        'name': spotsFinal[i][3],
                                        'user_id': spotsFinal[i][1],
                                        'author': spotsFinal[i][2],
                                        'description': spotsFinal[i][4],
                                        'category': spotsFinal[i][7],
                                        //'likes': spotsFinal[i][7],
                                        'imageSRC': 'spot-img/' + spotsFinal[i][8],
                                        'image': spotsFinal[i][8],
                                        'date': changeDate(spotsFinal[i][9]),
                                    }
                                }
                                allPointsRaining.push(nextPoint2);
                            }
                        }
                        console.log('allPointsRaining: '+allPointsRaining);
                        numRowsRaining = allPointsRaining.length;
                        if (raining != 'true') {
                            document.getElementById("spots-number").innerHTML = numRows;   
                            map.addSource('point', {
                                'type': 'geojson',
                                'data': {
                                    'type': 'FeatureCollection',
                                    'features': allPoints,
                                },
                                'cluster': true,
                                'clusterMaxZoom': 14, // Max zoom to cluster points on
                                'clusterRadius': 70 // Radius of each cluster when clustering points (defaults to 50)
                            });
                            map.addLayer({
                                'id': 'clusters',
                                'type': 'symbol',
                                'source': 'point',
                                'filter': ['has', 'point_count'],
                                'layout': {
                                    'icon-image': 'smoke',
                                    'icon-size': 0.24,
                                    'icon-overlap': 'always',
                                    'icon-padding': 0,
                                    'icon-allow-overlap': true
                                }
                            });
                            map.addLayer({
                                'id': 'cluster-count',
                                'type': 'symbol',
                                'source': 'point',
                                'filter': ['has', 'point_count'],
                                'layout': {
                                    'text-field': '{point_count_abbreviated}',
                                    'text-font': ['Roboto_Black'],
                                    'text-size': 31,
                                    'icon-allow-overlap': true
                                },
                                'paint': {
                                    'text-color': '#7FAC55',
                                    'text-translate': [-4, 2],
                                },
                            });
                            map.addLayer({
                                'id': 'unclustered-points',
                                'type': 'symbol',
                                'source': 'point',
                                'filter': ['!', ['has', 'point_count']],
                                'layout': {
                                    'icon-image': 'joint',
                                    'icon-size': 0.12,
                                    'icon-allow-overlap': true
                                }
                            });
                        } else {
                            document.getElementById("spots-number").innerHTML = numRowsRaining;  
                            map.addSource('point', {
                                'type': 'geojson',
                                'data': {
                                    'type': 'FeatureCollection',
                                    'features': allPointsRaining,
                                },
                                'cluster': true,
                                'clusterMaxZoom': 14, // Max zoom to cluster points on
                                'clusterRadius': 70 // Radius of each cluster when clustering points (defaults to 50)
                            });
                            map.addLayer({
                                'id': 'clusters',
                                'type': 'symbol',
                                'source': 'point',
                                'filter': ['has', 'point_count'],
                                'layout': {
                                    'icon-image': 'smoke',
                                    'icon-size': 0.24,
                                    'icon-overlap': 'always',
                                    'icon-padding': 0,
                                    'icon-allow-overlap': true
                                }
                            });
                            map.addLayer({
                                'id': 'cluster-count',
                                'type': 'symbol',
                                'source': 'point',
                                'filter': ['has', 'point_count'],
                                'layout': {
                                    'text-field': '{point_count_abbreviated}',
                                    'text-font': ['Roboto_Black'],
                                    'text-size': 31,
                                    'icon-allow-overlap': true
                                },
                                'paint': {
                                    'text-color': '#7FAC55',
                                    'text-translate': [-4, 2],
                                },
                            });
                            map.addLayer({
                                'id': 'unclustered-points',
                                'type': 'symbol',
                                'source': 'point',
                                'filter': ['!', ['has', 'point_count']],
                                'layout': {
                                    'icon-image': 'joint_raining',
                                    'icon-size': 0.12,
                                    'icon-allow-overlap': true
                                }
                            });
                        }
                    }
                );
            })
    });

function flyToSpot(coordinates) {
    map.flyTo({
        //center: [e.features[0].geometry.coordinates[0], e.features[0].geometry.coordinates[1]+0.0015],
        center: [coordinates[0], coordinates[1]],
        zoom: 16
    });
    popupMySpots.style.display = 'none';
    popupMySpotsAll.style.display = 'none';
    mySpotsDiv.innerHTML = '';
    myPoints = [];
}

async function mySpots() {

    document.getElementById('popup5-nick').innerHTML = `${user_username} spoty`;
    if (raining != 'true') {
        for (let i = 0; i < numRows; i++) {
            if (allPoints[i].properties.user_id == user_id) {
                myPoints.push(allPoints[i]);
            }
        }
        if (myPoints.length == 0) {
            mySpotsDiv.innerHTML +=
                `
                    <p id='no-spots-message'>
                        Zatím si nevložil žádnej spot. Naprav to! Určitě znáš nějaký krásný místečko který tu ještě není:3
                    </p>
                `;
        }
        for (let i = 0; i < myPoints.length; i++) {
            let spot_id = myPoints[i].properties.spot_id;
            let coordinates = myPoints[i].geometry.coordinates.slice();
            let name = myPoints[i].properties.name;
            let date = myPoints[i].properties.date;
            let likes = await checkMySpot(spot_id);
            console.log('likes_numberb' + likes);

            mySpotsDiv.innerHTML +=
                `
                <div class='popup5-row'>
                    <div class='popup5-left' onclick="flyToSpot([${coordinates}])">
                        <p class='popup5-name'>${name}</p>
                        <p class='popup5-date'>${date}</p>                
                    </div>
                    <span class='popup5-like' onclick="flyToSpot([${coordinates}])">
                        <span class='popup5-like-text' id="number-likesL-${spot_id}">${likes}</span>
                        <i class="like-icon fa-solid fa-heart"></i>
                    </span>
                    <div class='popup5-delete'>
                        <a href='/../spot/DeleteSpot.php?delete_spot_id=${spot_id}\'><button class='button-delete'">
                            <i class='delete-icon fa-solid fa-xmark'></i>
                        </button></a>                        
                    </div>
                </div>
                `;
        }
    }
    else{
        for (let i = 0; i < numRowsRaining; i++) {
            if (allPointsRaining[i].properties.user_id == user_id) {
                myPoints.push(allPointsRaining[i]);
            }
        }
        if (myPoints.length == 0) {
            mySpotsDiv.innerHTML +=
                `
                    <p id='no-spots-message'>
                        Zatím si nevložil žádnej spot. Naprav to! Určitě znáš nějaký krásný místečko který tu ještě není:3
                    </p>
                `;
        }
        for (let i = 0; i < myPoints.length; i++) {
            let spot_id = myPoints[i].properties.spot_id;
            let coordinates = myPoints[i].geometry.coordinates.slice();
            let name = myPoints[i].properties.name;
            let date = myPoints[i].properties.date;
            let likes = await checkMySpot(spot_id);
            console.log('likes_numberb' + likes);

            mySpotsDiv.innerHTML +=
                `
                <div class='popup5-row'>
                    <div class='popup5-left' onclick="flyToSpot([${coordinates}])">
                        <p class='popup5-name'>${name}</p>
                        <p class='popup5-date'>${date}</p>                
                    </div>
                    <span class='popup5-like' onclick="flyToSpot([${coordinates}])">
                        <span class='popup5-like-text' id="number-likesL-${spot_id}">${likes}</span>
                        <i class="like-icon fa-solid fa-heart"></i>
                    </span>
                    <div class='popup5-delete'>
                        <a href='/../spot/DeleteSpot.php?delete_spot_id=${spot_id}\'><button class='button-delete'">
                            <i class='delete-icon fa-solid fa-xmark'></i>
                        </button></a>                        
                    </div>
                </div>
                `;
        }
    }

    //popupMySpots.style.display = 'block';
    //popupMySpotsAll.style.display = 'block';
}

let zoom = map.getZoom();

// Add geolocate control to the map.
map.addControl(
    new maplibregl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: true
    })
);

/*
We also require you to include our logo somewhere over the map.
We create our own map control implementing a documented interface,
that shows a clickable logo.
See https://maplibre.org/maplibre-gl-js-docs/api/markers/#icontrol
*/
class LogoControl {
    onAdd(map) {
        this._map = map;
        this._container = document.createElement('div');
        this._container.className = 'maplibregl-ctrl';
        this._container.innerHTML = "<a href='http://mapy.cz/' target='_blank'><img  width='80px' src='https://api.mapy.cz/img/api/logo.svg' ></a>";

        return this._container;
    }

    onRemove() {
        this._container.parentNode.removeChild(this._container);
        this._map = undefined;
    }
};
// finally we add our LogoControl to the map
map.addControl(new LogoControl(), 'bottom-left');


// inspect a cluster on click
map.on('click', 'clusters', (e) => {
    const features = map.queryRenderedFeatures(e.point, {
        layers: ['clusters']
    });
    const clusterId = features[0].properties.cluster_id;
    map.getSource('point').getClusterExpansionZoom(
        clusterId,
        (err, zoom) => {
            if (err) return;

            map.easeTo({
                center: features[0].geometry.coordinates,
                zoom
            });
        }
    );
});

let likedNow = false;

map.on('click', 'unclustered-points', (e) => {
    likedNow = false;

    let spot_id = e.features[0].properties.spot_id;
    let likes = null;
    checkSpot(spot_id);
    //likes = checkSpot(spot_id);
    //console.log('likes_number b: '+likes);

    let coordinates = e.features[0].geometry.coordinates.slice();
    let description = e.features[0].properties.description;
    let name = e.features[0].properties.name;
    let imageSRC = e.features[0].properties.imageSRC;
    let author = e.features[0].properties.author;

    console.log(coordinates);
    createCookie("longitude-for-form", coordinates[0], "1");
    createCookie("latitude-for-form", coordinates[1], "1");

    let vyhlidka = e.features[0].properties.category.split(",")[0];
    let rybnik = e.features[0].properties.category.split(",")[1];
    let ohniste = e.features[0].properties.category.split(",")[2];
    let zricenina = e.features[0].properties.category.split(",")[3];
    let pristresek = e.features[0].properties.category.split(",")[4];
    //let likes = e.features[0].properties.likes;
    let email = e.features[0].properties.email;
    let date = e.features[0].properties.date;

    //let likes = countLikes(spot_id);

    map.flyTo({
        //center: [e.features[0].geometry.coordinates[0], e.features[0].geometry.coordinates[1]+0.0015],
        center: [e.features[0].geometry.coordinates[0], e.features[0].geometry.coordinates[1]],
        zoom: 16
    });

    // Ensure that if the map is zoomed out such that multiple
    // copies of the feature are visible, the popup appears
    // over the copy being pointed to.
    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }

    const mobileDiv = document.getElementById('information-allM');
    mobileDiv.style.display = 'block';
    const popup2 = document.getElementById('popup-all2');
    popup2.style.display = 'block';
    if (markerAddedToMap == true) {
        removePoint();
    }
    mobileDiv.innerHTML =
        `
        <div class='information-M'>
            <div class="information-allM-L" id="spot-${spot_id}">
                <span class='spot-like-text' id="number-likesM-${spot_id}"></span>
                <a href='#' onclick="like(${spot_id}, ${likes});" id="likeM-${spot_id}"><i class="fa-regular fa-heart like-false like "></i></a>
                <a href='#' onclick="unlike(${spot_id}, ${likes});" id="unlikeM-${spot_id}"><i class="fa-solid fa-heart like-true like"></i></a>

                <h2>${name}</h2>
                <p class='author author-${author}'>${author} | ${date}</p>
                <div class='icons'>
                    <i class='fa-solid fa-mountain icon-${vyhlidka}' title='Vyhlídka'></i>
                    <i class='fa-solid fa-water icon-${rybnik}' title='U vody'></i>
                    <i class='fa-solid fa-fire icon-${ohniste}' title='Ohniště'></i>
                    <i class='fa-solid fa-chess-rook icon-${zricenina}' title='Zřícenina'></i>
                    <i class='fa-solid fa-umbrella icon-${pristresek}' title='Přístřešek'></i>
                </div>      
                <textarea class='description description-${description}_' readonly>${description}</textarea>      
            </div>
            <div class="information-allM-R">
                <img class='spot-image' src='${imageSRC}' alt></img>
            </div>
            <div class="comments-all">
                <h3>
                    Komentáře
                </h3>
                <div class="comments" id="commentsM${spot_id}">
                </div>
            </div>
            <form class="comments-form" id="comment-formM" onsubmit="return ajax_call_comment()">
                <input type="hidden" name="comment_spot_id" id="comment_spot_id" value="${spot_id}">
                <textarea id='komentM' name='koment' class='comment-form-text' placeholder='' required></textarea>
                <button type='submit' id="submit" class="button-send-comment"><i class="fa-solid fa-paper-plane comment-send"></i></button>
            </form>
        </div>
        `;

    new maplibregl.Popup()
        //.setLngLat([coordinates[0]+0.0005, coordinates[1]+0.002])
        .setLngLat(coordinates)
        .setHTML(`
        <div class='information-all'>
            <div class='information-al'>
                <div class="information-all-L" id="spot-${spot_id}">
                <span class='spot-like-text' id="number-likes-${spot_id}"></span>
                    <a href='#' onclick="like(${spot_id}, ${likes});" id="like-${spot_id}"><i class="fa-regular fa-heart like-false like "></i></a>
                    <a href='#' onclick="unlike(${spot_id}, ${likes});" id="unlike-${spot_id}"><i class="fa-solid fa-heart like-true like"></i></a>
    
                    <h2>${name}</h2>
                    <p class='author author-${author}'>${author} | ${date}</p>
                    <div class='icons'>
                        <i class='fa-solid fa-mountain icon-${vyhlidka}' title='Vyhlídka'></i>
                        <i class='fa-solid fa-water icon-${rybnik}' title='U vody'></i>
                        <i class='fa-solid fa-fire icon-${ohniste}' title='Ohniště'></i>
                        <i class='fa-solid fa-chess-rook icon-${zricenina}' title='Zřícenina'></i>
                        <i class='fa-solid fa-umbrella icon-${pristresek}' title='Přístřešek'></i>
                    </div>      
                    <textarea class='description description-${description}_' readonly>${description}</textarea>      
                </div>
                <div class="information-all-R">
                    <img class='spot-image' src='${imageSRC}' alt></img>
                </div>
            </div>
            <div class="comments-all">
                <h3>
                    Komentáře
                </h3>
                <div class="comments" id="comments${spot_id}">
     
                </div>
            </div>
            <form class="comments-form" id="comment-form" onsubmit="return ajax_call_comment()">
                <input type="hidden" name="comment_spot_id" id="comment_spot_id" value="${spot_id}">
                <textarea id='koment' name='koment' class='comment-form-text' placeholder='' required></textarea>
                <button type='submit' id="submit" class="button-send-comment"><i class="fa-solid fa-paper-plane comment-send"></i></button>
            </form>
        </div>
        `)
        .addTo(map);
});
function like(spot_id, likes_count) {
    console.log('liked: ' + liked);
    console.log('likedNow: ' + likedNow);
    if (user_id != null) {
        $.get("/../like/LikeSpot.php?like_spot_id=" + spot_id);
        let numberLikesContainer = document.querySelectorAll(`#number-likes-${spot_id}, #number-likesM-${spot_id}`);
        let likeContainer = document.querySelectorAll(`#like-${spot_id}, #likeM-${spot_id}`);
        let unlikeContainer = document.querySelectorAll(`#unlike-${spot_id}, #unlikeM-${spot_id}`);

        for (let b = 0; b < likeContainer.length; b++) {
            likeContainer[b].style.display = 'none';
        }
        for (let b = 0; b < unlikeContainer.length; b++) {
            unlikeContainer[b].style.display = 'block';
        }
        if (liked == false && likedNow == false) {
            for (let b = 0; b < numberLikesContainer.length; b++) {
                numberLikesContainer[b].innerHTML = likes_count + 1;
            }
            liked = true;
            likedNow = true;
        }
        else if (liked == false && likedNow == true) {
            for (let b = 0; b < numberLikesContainer.length; b++) {
                numberLikesContainer[b].innerHTML = likes_count;
            }
            liked = true;
            likedNow = false;
        }
        else {
            for (let b = 0; b < numberLikesContainer.length; b++) {
                numberLikesContainer[b].innerHTML = likes_count;
            }
            liked = false;
            likedNow = false;
        }
        console.log('liked');
    }
    else {
        window.location.href = "/../user/SignUp.php"; //uživatel se musí nejprve přihlásit
    }
}

function unlike(spot_id, likes_count) {
    console.log('liked: ' + liked);
    console.log('likedNow: ' + likedNow);
    if (user_id != null) {
        $.get("/../like/UnlikeSpot.php?unlike_spot_id=" + spot_id);
        let numberLikesContainer = document.querySelectorAll(`#number-likes-${spot_id}, #number-likesM-${spot_id}`);
        let likeContainer = document.querySelectorAll(`#like-${spot_id}, #likeM-${spot_id}`);
        let unlikeContainer = document.querySelectorAll(`#unlike-${spot_id}, #unlikeM-${spot_id}`);

        for (let b = 0; b < likeContainer.length; b++) {
            likeContainer[b].style.display = 'block';
        }
        for (let b = 0; b < unlikeContainer.length; b++) {
            unlikeContainer[b].style.display = 'none';
        }

        if (liked == true && likedNow == false) {
            for (let b = 0; b < numberLikesContainer.length; b++) {
                numberLikesContainer[b].innerHTML = likes_count - 1;
            }
            liked = false;
            likedNow = true;
        }
        else if (liked == true && likedNow == true) {
            for (let b = 0; b < numberLikesContainer.length; b++) {
                numberLikesContainer[b].innerHTML = likes_count;
            }
            liked = false;
            likedNow = false;
        }
        else {
            for (let b = 0; b < numberLikesContainer.length; b++) {
                numberLikesContainer[b].innerHTML = likes_count;
            }
            liked = true;
            likedNow = false;
        }
        console.log('unliked');
    }
    else {
        window.location.href = "/../user/SignUp.php"; //uživatel se musí nejprve přihlásit
    }
}

// Change the cursor to a pointer when the mouse is over the places layer.
map.on('mouseenter', 'unclustered-points', () => {
    map.getCanvas().style.cursor = 'pointer';
});

// Change it back to a pointer when it leaves.
map.on('mouseleave', 'unclustered-points', () => {
    map.getCanvas().style.cursor = '';
});

/*USER ADD POINT*/
const marker = new maplibregl.Marker({ draggable: false });
function addPoint() {
    marker.setLngLat(map.getCenter().toArray())
    marker.addTo(map);
    buttonAddAdd.style.display = 'none';
    buttonAddConfirm.style.display = 'inline-block';
    buttonAddCancel.style.display = 'block';
    markerAddedToMap = true;
}
function removePoint() {
    marker.remove();
    buttonAddAdd.style.display = 'inline-block';
    buttonAddConfirm.style.display = 'none';
    buttonAddCancel.style.display = 'none';
    //signin_button.style.display = 'none';
    markerAddedToMap = false;
}

map.on('move', () => {
    /*const mobileDiv = document.getElementById('information-allM');
    mobileDiv.style.display = 'none';*/
    marker.setLngLat(map.getCenter().toArray())
})

function onDragEnd() {
    let lngLat = marker.getLngLat();
    console.log(`Longitude: ${lngLat.lng}<br />Latitude: ${lngLat.lat}`)
}

$(document).ready(function () { // move to spot if user has recently added or commented
    if ((getCookie("longitude") != 'null' && getCookie("latitude") != 'null') && (getCookie("longitude") != undefined && getCookie("latitude") != undefined)) {
        map.flyTo({
            center: [getCookie("longitude"), getCookie("latitude")],
            zoom: 16
        });
    }
    createCookie("longitude", null, "1");
    createCookie("latitude", null, "1");
});