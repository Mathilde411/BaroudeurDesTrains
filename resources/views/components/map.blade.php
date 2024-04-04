<svg width="2240" height="2918" id="map-svg">
    <image href="{{Vite::asset('resources/images/map.png')}}" x="0" y="0" height="2918" width="2240" />
</svg>

@pushonce('scripts')
    <script>
        window.baroudeurMap = {};
        window.baroudeurMap.pinPath = '{{Vite::asset('resources/images/destination_pin.png')}}';
        window.baroudeurMap.jsonData = JSON.parse(`{!! file_get_contents(resource_path('/json/coordinates.json')) !!}`);
        window.baroudeurMap.playersInfo = {
            "player1": {
                "points": 104,
                "color": "blue",
                "rides": ["plymouth_bristol", "douai_bruxelles", "nancy_dijon_2"]
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
        }
    </script>
    @vite('resources/js/map.js')
@endpushonce
