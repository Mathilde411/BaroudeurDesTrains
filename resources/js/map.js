const coordinates = JSON.parse(document.getElementById('json-data').dataset.json);
const map = document.getElementById('map-svg');
const rides = coordinates.rides

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

function displayDestinationGoal(cities) {
    let path = "M ";
    for (let city of cities) {
        let pin = document.createElementNS('http://www.w3.org/2000/svg',"image");
        pin.setAttribute("href", window.baroudeurMap.pinPath);
        let x = coordinates.cities[city][0];
        let y = coordinates.cities[city][1];
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
    console.log(path);
    map.appendChild(line);
}

window.addEventListener("load", (event) => {
    let destinations = document.getElementsByClassName("destination");
    for (let destination of destinations) {
        destination.addEventListener("mouseover", function (event) {
            let destinationDetails = coordinates.destinations[destination.id];
            displayDestinationGoal(destinationDetails["cities"]);
        });

        destination.addEventListener("mouseout", function (event) {
            let elementsToDelete = document.querySelectorAll(".temporary-destination");
            elementsToDelete.forEach(function (element) {
                element.parentNode.removeChild(element);
            });
        });
    }
});
