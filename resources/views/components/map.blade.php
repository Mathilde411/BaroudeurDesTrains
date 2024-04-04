<svg viewBox="0 0 2240 2918" id="map-svg">
    <image href="{{Vite::asset('resources/images/map.png')}}" x="0" y="0" height="2918" width="2240" />
</svg>

<div id="popup-menu" class="pop-up">
    <div class="end-btn popup-btns">
        <button id="close-popup" class="btn main close-popup">Fermer</button>
        <button id="validate-popup" class="btn main validate-popup">Valider</button>
    </div>
</div>

<div id="destinations-container">
    <p>Destinations à atteindre : </p>
</div>

<div id="cards-in-hand">
    <p>Cartes en main : </p>
</div>

<div id="draw-pile">
    <p>Pioche : </p>
</div>

@pushonce('scripts')
    <script>
        window.baroudeurMap = {};
        window.baroudeurMap.pinPath = '{{Vite::asset('resources/images/destination_pin.png')}}';
        window.baroudeurMap.jsonData = JSON.parse(`{!! file_get_contents(Vite::asset('resources/json/coordinates.json')) !!}`);
        window.baroudeurMap.drawPile = ["black", "black", "black", "red", "locom"];
        window.baroudeurMap.activePlayer = "player1";
        window.baroudeurMap.playersInfo = {
            "player1": {
                "points": 104,
                "color": "blue",
                "rides": ["plymouth_bristol", "douai_bruxelles", "nancy_dijon_2"],
                "cards": ["black", "black", "black", "red", "yellow", "locom", "yellow", "pink", "green", "blue", "orange", "white"],
                "destinations": ["orleans_nice", "limoges_milan", "barcelone_nice"]
            },
            "player2": {
                "points": 4,
                "color": "green",
                "rides": ["clermont_bordeaux", "nancy_dijon_1"]
            },
            "player3": {
                "points": 104,
                "color": "red",
                "rides": ["ajaccio_barcelone"]
            },
            "player4": {
                "points": 4,
                "color": "yellow",
                "rides": []
            }
        };
        window.baroudeurMap.cards = {};
        window.baroudeurMap.cards.black = '{{Vite::asset('resources/images/cards/black.png')}}';
        window.baroudeurMap.cards.blue = '{{Vite::asset('resources/images/cards/blue.png')}}';
        window.baroudeurMap.cards.green = '{{Vite::asset('resources/images/cards/green.png')}}';
        window.baroudeurMap.cards.locom = '{{Vite::asset('resources/images/cards/locom.png')}}';
        window.baroudeurMap.cards.orange = '{{Vite::asset('resources/images/cards/orange.png')}}';
        window.baroudeurMap.cards.pink = '{{Vite::asset('resources/images/cards/pink.png')}}';
        window.baroudeurMap.cards.red = '{{Vite::asset('resources/images/cards/red.png')}}';
        window.baroudeurMap.cards.white = '{{Vite::asset('resources/images/cards/white.png')}}';
        window.baroudeurMap.cards.yellow = '{{Vite::asset('resources/images/cards/yellow.png')}}';
        window.baroudeurMap.cards.side = '{{Vite::asset('resources/images/cards/side.jpg')}}';
    </script>
    @vite('resources/js/map.js')
@endpushonce

@pushonce('style')
    @vite('resources/css/map.scss')
@endpushonce
