<div class="col-xl-3 col-lg-4 col-md-6 col-sm-5 col-xs-auto mb-3">
    <div class="card rounded">
        <a href="{{ URL::to('item-' . $itemdata->slug) }}">
            <div class="card-image">
                <img src="{{ $itemdata['item_image']->image_url }}"
                    class="card-img-top border-0 rounded-0 rounded-top position-relative" alt="dishes">
            </div>
            <div class="card-body pb-0">
                <h5 class="item-card-title">
                    @if ($itemdata->item_type == 1)
                        <img src="{{ Helper::image_path('veg.svg') }}" alt="" class="{{session()->get('direction') == "rtl" ? 'ms-1' : 'me-1'}}">
                    @else
                        <img src="{{ Helper::image_path('nonveg.svg') }}" alt="" class="{{session()->get('direction') == "rtl" ? 'ms-1' : 'me-1'}}">
                    @endif
                    {{ $itemdata->item_name }}
                </h5>
                <div class="pb-2 cat-span border-bottom"><span>{{ $itemdata['category_info']->category_name }}</span></div>
            </div>
        </a>
        <div class="img-overlay set-fav-{{ $itemdata->id }}">
            @if(Auth::user() && Auth::user()->type == 2)

                @if ($itemdata->is_favorite == 1)
                    <a class="heart-icon btn btn-wishlist"
                         href="javascript:void(0)" onclick="managefavorite('{{ $itemdata->id }}',0,'{{ URL::to('/managefavorite') }}','{{request()->url()}}')" title="{{ trans('labels.remove_wishlist') }}">
                        <i class="fa-solid fa-bookmark fs-5"></i> </a>
                @else
                    <a class="heart-icon btn btn-wishlist"
                        href="javascript:void(0)" onclick="managefavorite('{{ $itemdata->id }}',1,'{{ URL::to('/managefavorite') }}','{{request()->url()}}')" title="{{ trans('labels.add_wishlist') }}">
                        <i class="fa-regular fa-bookmark fs-5"></i> </a>
                @endif
            @endif    
        </div>
        <div class="item-card-footer">
            <div class="d-flex justify-content-between align-items-center">
                @php
                    if ($itemdata->has_variation == 1) {
                        foreach ($itemdata['variation'] as $key => $value) {
                            $price = $value->product_price;
                            if ($key == 0) {
                                break;
                            }
                        }
                    } else {
                        $price = $itemdata->item_price;
                    }
                @endphp
                <span>{{ Helper::currency_format($price) }}</span>
                @if ($itemdata->is_cart == 1)
                        <div class="item-quantity">
                            <button type="button" class="btn btn-sm green_color fw-500" onclick="removefromcart('{{ URL::to('/cart') }}','{{ trans('messages.remove_cartitem_note') }}','{{ trans('labels.goto_cart') }}')">-</button>
                            <input class="green_color fw-500 item-total-qty-{{$itemdata->slug}}" type="text" value="{{ Helper::get_item_cart($itemdata->id) }}" disabled/>
                            @if ($itemdata->addons_id != '' || count($itemdata->variation) > 0)
                                <a class="btn btn-sm green_color fw-500" onclick="showitem('{{ $itemdata->slug }}','{{ URL::to('/show-item') }}')">+</a>
                            @else
                                <a class="btn btn-sm green_color fw-500" onclick="calladdtocart('{{ $itemdata->slug }}','{{ $itemdata->item_name }}','{{ $itemdata->item_type }}','{{ $itemdata['item_image']->image_name }}','{{ $itemdata->tax }}','{{ $itemdata->price }}','','','','','','{{ URL::to('addtocart') }}')">+</a>
                            @endif
                        </div>
                    @else
                        @if ($itemdata->addons_id != '' || count($itemdata->variation) > 0)
                            <a class="btn btn-sm border green_color fw-500"
                                onclick="showitem('{{ $itemdata->slug }}','{{ URL::to('/show-item')}}')">{{ trans('labels.add') }}</a>
                        @else
                            <a class="btn btn-sm border green_color fw-500"
                                onclick="calladdtocart('{{ $itemdata->slug }}','{{ $itemdata->item_name }}','{{ $itemdata->item_type }}','{{ $itemdata['item_image']->image_name }}','{{ $itemdata->tax }}','{{ $itemdata->price }}','','','','','','{{ URL::to('addtocart') }}')">{{ trans('labels.add') }}</a>
                        @endif
                    @endif
            </div>
        </div>
    </div>
</div>
