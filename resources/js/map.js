function createRails(map, coordinates) {
    let rides = coordinates.rides;
    for (let ride in rides) {
        let rails = rides[ride]["points"];
        for (let i = 0; i < rails.length; i++) {
            let path = document.createElementNS('http://www.w3.org/2000/svg',"path");
            path.setAttribute("id",ride + "-" + i);
            path.setAttribute("fill","white");
            path.setAttribute("opacity", "0");
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

function getActualPlayer(playersInfo) {
    for (let player in playersInfo) {
        if ("cards" in playersInfo[player]) {
            return player;
        }
    }
}

function addIntercationWithRails(map, playersInfo, coordinates) {
    let rails = map.getElementsByClassName("rail");
    for (let rail of rails) {
        rail.addEventListener("mouseover", function (event){
            if (!rail.classList.contains("used") && getActualPlayer(playersInfo) === window.baroudeurMap.activePlayer) {
                this.style.cursor = 'pointer';
                let selectedRails = map.getElementsByClassName(rail.classList[0]);
                for (let selectedRail of selectedRails) {
                    selectedRail.setAttribute("opacity", "0.2");
                }
            }
        })
        rail.addEventListener("mouseout", function (event){
            if (!rail.classList.contains("used") && getActualPlayer(playersInfo) === window.baroudeurMap.activePlayer) {
                this.style.cursor = 'default';
                let selectedRails = map.getElementsByClassName(rail.classList[0]);
                for (let selectedRail of selectedRails) {
                    selectedRail.setAttribute("opacity", "0");
                }
            }
        })
        rail.addEventListener("click", function (event){
            if (!rail.classList.contains("used") && getActualPlayer(playersInfo) === window.baroudeurMap.activePlayer) {
                const popupMenu = document.getElementById('popup-menu');
                popupMenu.style.display = 'block';
                document.addEventListener('click', function(event) {
                    if (event.target.id === "close-popup" || (!popupMenu.contains(event.target) && !event.target.classList.contains('rail'))) {
                        popupMenu.style.display = 'none';
                        let selectedCards = popupMenu.getElementsByClassName("selected-card");
                        for (let i= 0; i<selectedCards.length; i++) {
                            selectedCards[i].classList.remove("selected-card");
                        }
                    }
                });

                let validateButton = document.getElementById("validate-popup");
                validateButton.addEventListener("click", function() {
                    let selectedCards = popupMenu.getElementsByClassName("selected-card");
                    let values = [];
                    for (let i= 0; i<selectedCards.length; i++) {
                        values.push(selectedCards[i].dataset.color);
                    }
                    let ride = coordinates["rides"][rail.id.split('-')[0]];
                    let color;
                    if ("color" in ride) {
                        color = ride["color"];
                    }
                    else {
                        color = "grey";
                    }
                    let size = ride["points"].length;

                })
            }
        })
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
                selectedRail.setAttribute("opacity", "1");
                selectedRail.classList.add("used")
            }
        }
    }
}

function displayCardsInHand(playersInfo, cards) {
    let cardsInHandContainer = document.getElementById("cards-in-hand");
    let popupMenu = document.getElementById("popup-menu");
    let cardsInHand = playersInfo[getActualPlayer(playersInfo)]["cards"];
    for (let card in cardsInHand) {
        const cardImage = document.createElement("img");
        cardImage.setAttribute("src", cards[cardsInHand[card]]);
        cardImage.height = 250;
        cardsInHandContainer.appendChild(cardImage);

        cardImage.setAttribute("data-color", cardsInHand[card]);
        cardImage.addEventListener("click", function () {
            if (cardImage.classList.contains("selected-card")) {
                cardImage.classList.remove("selected-card");
            }
            else {
                cardImage.classList.add("selected-card");
            }
        })
        popupMenu.insertBefore(cardImage, popupMenu.firstChild);
    }
}

function displayDrawPile(cards, drawPile) {
    let drawPileContainer = document.getElementById("draw-pile")
    for (let card in drawPile) {
        const cardImage = document.createElement("img");
        cardImage.setAttribute("src", cards[drawPile[card]]);
        drawPileContainer.appendChild(cardImage);
    }
    const cardImage = document.createElement("img");
    cardImage.setAttribute("src", cards["side"]);
    cardImage.width = 250;
    drawPileContainer.appendChild(cardImage);
}
window.addEventListener("load", (event) => {
    const coordinates = window.baroudeurMap.jsonData;
    const map = document.getElementById('map-svg');
    const playersInfo = window.baroudeurMap.playersInfo;
    const cards = window.baroudeurMap.cards;
    const drawPile = window.baroudeurMap.drawPile;

    createRails(map, coordinates);
    addIntercationWithRails(map, playersInfo, coordinates)
    displayDestinationGoal(map, coordinates, playersInfo);
    displayScores(playersInfo, map, coordinates);
    displayRides(playersInfo, map);
    displayCardsInHand(playersInfo, cards);
    displayDrawPile(cards, drawPile);
});
