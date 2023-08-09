@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.refund_policy') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.refund_policy') }}</h1>
            </div>
        </div>
    </div>
    <section>
        <div class="container cms-section text-justify mb-5">
            @if (@$getrefundpolicy->refundpolicy_content != '')
                <div class="cms-section">
                    <p>
                        {!! $getrefundpolicy->refundpolicy_content !!}
                    </p>
                </div>
            @else
                @include('web.nodata')
            @endif
        </div>
    </section>
@endsection