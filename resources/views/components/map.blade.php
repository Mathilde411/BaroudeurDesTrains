<div id="json-data" data-json="{{file_get_contents(Vite::asset('resources/json/coordinates.json'))}}"></div>

<svg width="2240" height="2918" id="map-svg">
    <image href="{{Vite::asset('resources/images/map.png')}}" x="0" y="0" height="2918" width="2240" />
</svg>

@pushonce('scripts')
    @vite('resources/js/map.js')
@endpushonce
