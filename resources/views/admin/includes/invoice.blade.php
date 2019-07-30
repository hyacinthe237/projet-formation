<div class="invoice">
    <div class="invoice-number">INVOICE No {{ $booking->number }}</div>
    <div class="invoice-date">{{ date('d M Y', strtotime($booking->created_at)) }}</div>

    <hr>

    <div class="profiles">
        <div class="row">
            <div class="col-sm-7">
                <div class="customer-profile">
                    <h5 class="dark bold">{{ config('site.name') }}</h5>
                    <ul class="list-unstyled">
                        <li>{{ $booking->location->address }}</li>
                        <li>{{ config('site.phone') }}</li>
                        <li>{{ config('mail.from.address') }}</li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="customer-profile">
                    <h5>Bill to</h5>
                    <h5 class="dark bold">{{ $booking->user->name }}</h5>
                    <ul class="list-unstyled">
                        <li>{{ $booking->user->phone }}</li>
                        <li>{{ $booking->user->email }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- End of profile  --}}


    <div class="summary">
        <div class="bold">
            SUMMARY
        </div>


        <div class="summary-items">
            <div class="summary-item no-border">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="text-left">
                            {{ $booking->car->toString() }} for {{ $booking->duration }}
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="text-right">
                            <span class="{{ $booking->coupon_id ? 'linethrough' : ''}}">
                                {{ $booking->total_rental_in_dollars ?? $booking->rate_in_dollars }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            @if ($booking->coupon_id)
                <div class="summary-item">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="text-right bold">
                                Coupon {{ $booking->coupon->name }}
                                @if ($booking->coupon->type == 'percentage')
                                    (- {{ $booking->coupon->value }}%)
                                @else
                                    (- ${{ $booking->coupon->value }})
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="text-right bold">
                                ${{ number_format($booking->getTotalRentalWithCoupon() / 100, 2) }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @foreach($booking->options as $option)
            <div class="summary-item">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="text-left">
                            {{ $option->name }}

                            @if ($option->type === 'quantity')
                                x {{ $option->pivot->quantity }}
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="text-right">
                            ${{ number_format($option->pivot->total_price / 100, 2) }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


            <div class="summary-item bold">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="text-left">
                            Amount paid
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="text-right">
                            @if ($booking->coupon)
                                ${{ number_format($booking->getTotalWithCoupon() / 100, 2) }}
                            @else
                                AUD {{ $booking->total_in_dollars }}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End of summary  --}}


    <hr>


    <div class="company text-center">
        Thank you for your business <br>
        ABN {{ config('site.abn') }}
    </div>

</div>
