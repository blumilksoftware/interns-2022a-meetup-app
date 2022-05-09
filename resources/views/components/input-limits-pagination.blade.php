<div class="flex gap-5">
    <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" onchange="window.location.href=this.options[this.selectedIndex].value;">>
        <option value="{{ route(Route::currentRouteName(), ['limit'=> 10 ]) }}">Limit: 10</option>
        <option value="{{ route(Route::currentRouteName(), ['limit'=> 30 ]) }}">Limit: 30</option>
        <option value="{{ route(Route::currentRouteName(), ['limit'=> 50 ]) }}">Limit: 50</option>
        <option value="{{ route(Route::currentRouteName(), ['limit'=> 100 ]) }}">Limit: 100</option>
    </select>
</div>
