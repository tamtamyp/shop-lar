<div class="wrap-banner style-twin-default">
    <div class="banner-item">
        @php
            $items = DB::table('setting')
                ->where('config_key', 'banner1')
                ->get();
            
        @endphp
        @foreach ($items as $item)
            <figure><img src="{{ url('templates/images') }}/{!! $item->config_value !!}" alt="" style="width:580px;
                    height:190px;"></figure>
        @endforeach
        
    </div>
    <div class="banner-item">
        @php
            $items = DB::table('setting')
                ->where('config_key', 'banner2')
                ->get();
            
        @endphp
        @foreach ($items as $item)
            <figure><img src="{{ url('templates/images') }}/{!! $item->config_value !!}" alt="" style="width:580px;
                    height:190px;"></figure>
        @endforeach
    </div>
</div>
