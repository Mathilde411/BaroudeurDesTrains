function createRails(map, coordinates) {
    let rides = coordinates.rides;
    for (let ride in rides) {
        let rails = rides[ride]["points"];
        for (let i = 0; i < rails.length; i++) {
            let path = document.createElementNS('http://www.w3.org/2000/svg',"path");
            path.setAttribute("id",ride + "-" + i);
            path.setAttribute("fill","transparent");
            path.setAttribute("class",ride + " rail");

            let rail = rails[i];
            let plot = "M ";
            for (let j = 0; j < 4; j++) {
                if(j !== 0) {
                    plot += "L "
                }
                plot += rail[j][0] + " " + rail[j][1] + " ";
            }
            plot += "z";
            path.setAttribute('d', plot);
            map.appendChild(path);
        }
    }
}

function addIntercationWithRails(map) {
    let rails = map.getElementsByClassName("rail");
    for (let rail of rails) {
        rail.addEventListener("mouseover", function (event){
            let selectedRails = map.getElementsByClassName(rail.classList[0]);
            for (let selectedRail of selectedRails) {
                selectedRail.setAttribute("opacity", "0.8");
            }
        })
        rail.addEventListener("mouseout", function (event){
            let selectedRails = map.getElementsByClassName(rail.classList[0]);
            for (let selectedRail of selectedRails) {
                selectedRail.setAttribute("opacity", "1");
            }
        })
        rail.addEventListener("click", function (event){
            let selectedRails = map.getElementsByClassName(rail.classList[0]);
            for (let selectedRail of selectedRails) {
                selectedRail.setAttribute("fill", "red");
            }
        })
    }
}

function getActualPlayer(playersInfo) {
    for (let player in playersInfo) {
        if ("cards" in playersInfo[player]) {
            return player;
        }
    }
}

function displayDestinationGoal(map, coordinates, playersInfo) {
    const container = document.getElementById("destinations-container");
    let destinationList = playersInfo[getActualPlayer(playersInfo)]["destinations"];
    for (let destinaton in destinationList) {
        const destinationDiv = document.createElement("div");
        destinationDiv.setAttribute("id", destinationList[destinaton]);
        destinationDiv.setAttribute("class", "destination");
        destinationDiv.innerHTML = destinationList[destinaton];
        container.appendChild(destinationDiv)
    }

    let destinations = document.getElementsByClassName("destination");
    for (let destination of destinations) {
        destination.addEventListener("mouseover", function (event) {
            let destinationDetails = coordinates["destinations"][destination.id];
            let cities = destinationDetails["cities"];
            let path = "M ";
            for (let city of cities) {
                let pin = document.createElementNS('http://www.w3.org/2000/svg',"image");
                pin.setAttribute("href", window.baroudeurMap.pinPath);
                let x = coordinates["cities"][city][0];
                let y = coordinates["cities"][city][1];
                pin.setAttribute("x", x-140);
                pin.setAttribute("y", y-140);
                pin.setAttribute("class", "temporary-destination");
                path += x + " " + y + " L ";
                map.appendChild(pin);
            }
            let line = document.createElementNS('http://www.w3.org/2000/svg',"path");
            line.setAttribute("d", path);
            line.setAttribute("stroke", "darkred");
            line.setAttribute("stroke-dasharray", 20);
            line.setAttribute("stroke-width", 10);
            line.setAttribute("class", "temporary-destination");
            map.appendChild(line);
        });

        destination.addEventListener("mouseout", function (event) {
            let elementsToDelete = document.querySelectorAll(".temporary-destination");
            elementsToDelete.forEach(function (element) {
                element.parentNode.removeChild(element);
            });
        });
    }
}

function playerPositionSameScore(playersInfo, player) {
    let score = playersInfo[player]["points"] % 100;
    let playerPlace = 0;
    let numberOfPlayers = 0;
    let playerAlreadyIterated = false;
    for (let person in playersInfo) {
        if ((playersInfo[person]["points"] % 100) === score) {
            numberOfPlayers++;
            if (!playerAlreadyIterated) {
                playerPlace++;
                if (person === player) {
                    playerAlreadyIterated = true;
                }
            }
        }
    }
    return [playerPlace, numberOfPlayers];
}
function displayScores(playersInfo, map, coordinates) {
    for (let player in playersInfo) {
        let scorePath = document.createElementNS('http://www.w3.org/2000/svg',"path");
        scorePath.setAttribute("id", player["color"]);
        let scoreLocation = coordinates.points[(playersInfo[player]["points"] % 100)];
        let playerWithSameScore = playerPositionSameScore(playersInfo, player);
        let path = "M " + (scoreLocation[0]) + "," + (scoreLocation[1]);
        let radius = 30;
        switch (playerWithSameScore[0]) {
            case 1:
                path += " m -" + radius + ",0 a " + radius + "," + radius + " 0 1,0 " + (2*radius) + ",0 a " + radius + "," + radius + " 0 1,0 -" + (2*radius) + ",0";
                break;
            case 2:
                path += " m 0,-" + radius + " a " + radius + "," + radius + " 0 1,0 0," + (2*radius) + ""
                break;
            case 3:
                if (playerWithSameScore[1] === 3) {
                    path += " l " + (0.866*radius) + "," + (radius/2) + " a " + radius + "," + radius + " 0 0,1 -" + (2*0.866*radius) + ",0"
                }
                else {
                    path += " l " + radius + ",0 a " + radius + "," + radius + " 0 0,1 -" + radius + "," + radius + ""
                }
                break;
            case 4:
                path += " l 0," + radius + " a " + radius + "," + radius + " 0 0,1 -" + radius + ",-" + radius + ""
                break;
        }
        scorePath.setAttribute("d",path);
        scorePath.setAttribute("fill", playersInfo[player]["color"]);
        map.appendChild(scorePath);
    }
}

function displayRides(playerList, map) {
    for (let player in playerList) {
        let color = playerList[player]["color"];
        let rides = playerList[player]["rides"];
        for (let ride in rides) {
            let rails = map.getElementsByClassName(rides[ride]);
            for (let selectedRail of rails) {
                selectedRail.setAttribute("fill", color);
            }
        }
    }
}
window.addEventListener("load", (event) => {
    const coordinates = window.baroudeurMap.jsonData;
    const map = document.getElementById('map-svg');
    const playersInfo = window.baroudeurMap.playersInfo;

    createRails(map, coordinates);
    addIntercationWithRails(map)
    displayDestinationGoal(map, coordinates, playersInfo);
    displayScores(playersInfo, map, coordinates);
    displayRides(playersInfo, map);
});
