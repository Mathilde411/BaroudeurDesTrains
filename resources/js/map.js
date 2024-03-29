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
