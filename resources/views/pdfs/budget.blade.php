@include('pdfs.head', ['title' => 'Budget de la Formation'])

<body bgcolor="#fff">
    <section style="margin:20px 40px;">

        <div class="table mt-10">
            <div class="table-row">
                <div class="table-cell">
                    <h4
                        class="red text-center"
                        style="padding-bottom:30px;border-bottom: 2px solid #aaa"
                    >
                        XMD
                    </h4>


                    <h3 style="color:red;font-weight:bold;text-align:center;">
                        Rental Agreement
                    </h3>
                </div>
            </div>
        </div>
    </section>

    <section  style="margin:20px 40px;">
        <div class="mt-20">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr class="tr-section">
                        <td colspan="4">Renter</td>
                    </tr>
                    <tr>
                        <td class="td-title td-30">Name:</td>
                        <td colspan="3">{{ $user ? $user->name : '' }}</td>
                    </tr>
                    <tr>
                        <td class="td-title td-30">Address:</td>
                        <td colspan="3">{{ $user ? $user->address : '' }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-30">Driver's Licence Number:</td>
                        <td class="td-20">{{ $user ? $user->licence_number : '' }}</td>
                        <td class="td-title td-20">Expiry Date</td>
                        <td class="td-30">{{ $user ? $user->license_expiry_date_formatted : '' }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-30">Country of issue:</td>
                        <td class="td-20">{{ $user ? $user->license_issued_place : '' }}</td>
                        <td class="td-title td-20">Date of Birth</td>
                        <td class="td-30">{{ $user ? $user->dob_formatted : '' }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-30">Mobile Number:</td>
                        <td class="td-20">{{ $user ? $user->phone : '' }}</td>
                        <td class="td-title td-20">Email</td>
                        <td class="td-30">{{ $user ? $user->email : '' }}</td>
                    </tr>
                    {{-- End of Renter  --}}

                    <tr class="tr-section">
                        <td colspan="4">Additional Authorised Driver</td>
                    </tr>

                    <tr>
                        <td class="td-title td-30">Name:</td>
                        <td colspan="3">{{ $driver ? $driver->name : '' }}</td>
                    </tr></td>
                    </tr>
                    <tr>
                        <td class="td-title td-30">Address:</td>
                        <td colspan="3">{{ $driver ? $driver->address : '' }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-30">Driver's Licence Number:</td>
                        <td class="td-20">{{ $driver ? $driver->licence_number : '' }}</td>
                        <td class="td-title td-20">Expiry Date</td>
                        <td class="td-30">{{ $driver ? $driver->license_expiry_date_formatted : '' }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-30">Country of issue:</td>
                        <td class="td-20">{{ $driver ? $driver->license_issued_place : '' }}</td>
                        <td class="td-title td-20">Date of Birth</td>
                        <td class="td-30">{{ $driver ? $driver->dob_formatted : '' }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-30">Mobile Number:</td>
                        <td class="td-20">{{ $driver ? $driver->phone : '' }}</td>
                        <td class="td-title td-20">Email</td>
                        <td class="td-30">{{ $driver ? $driver->email : '' }}</td>
                    </tr>
                    {{-- End of driver  --}}


                    <tr class="tr-section">
                        <td colspan="4">Vehicle</td>
                    </tr>

                    <tr>
                        <td class="td-title td-30">Vehicle ID:</td>
                        <td colspan="3">{{ $car ? $car->stock_id : '' }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-30">Make:</td>
                        <td class="td-20">{{ $car ? $car->model->make->name : '' }}</td>
                        <td class="td-title td-20">Model:</td>
                        <td class="td-30">{{ $car ? $car->model->name : '' }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-30">Registration Number:</td>
                        <td colspan="3">{{ $car ? $car->registration_plate : '' }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-30">Odometer Reading @Check Out:</td>
                        <td class="td-20">{{ $pickup ? $pickup->mileage_out : '' }}</td>
                        <td class="td-title td-20">@Check In:</td>
                        <td class="td-30">{{ $pickup ? $pickup->mileage_in : '' }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-30">Is the tank full at start of Rental?</td>
                        <td colspan="3">
                            @if ($pickup)
                                {{ $pickup->is_tank_full ? 'Yes' : 'No' }}
                            @endif
                        </td>
                    </tr>
                    {{-- End of Vehicle  --}}


                    <tr class="tr-section">
                        <td colspan="4">Rental Period</td>
                    </tr>

                    <tr>
                        <td class="td-title td-30">Start Date</td>
                        <td class="td-20">{{ date('d/m/Y', strtotime($booking->date_in)) }}</td>
                        <td class="td-title td-20">Start Time</td>
                        <td class="td-30">{{ date('H:i', strtotime($booking->date_in)) }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-30">End Date</td>
                        <td class="td-20">{{ date('d/m/Y', strtotime($booking->date_out)) }}</td>
                        <td class="td-title td-20">End Time</td>
                        <td class="td-30">{{ date('H:i', strtotime($booking->date_out)) }}</td>
                    </tr>
                    {{-- End of Rental period  --}}


                    {{-- End of Rental charges  --}}

                    @if ($booking->price && $booking->price->use === 'city')
                        <tr class="tr-section">
                            <td colspan="4">Kilometre Limit per day and excess km charges</td>
                        </tr>
                        <tr>
                            <td class="td-title td-30">Free daily limit</td>
                            <td colspan="3">100 kilometres per day</td>
                        </tr>
                        <tr>
                            <td class="td-title td-30">Excess kilometres:</td>
                            <td colspan="3">25 cents per kilometre for more than the free daily 100 kilometre limit.</td>
                        </tr>
                    @endif
                    {{-- End of KM limits  --}}

                </tbody>
            </table>
        </div>
    </section>




    <div style="page-break-after: always;"></div>

            {{-- End of first page  --}}

    <section style="margin:20px 40px;">
        <div class="mt-20">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr class="tr-section">
                        <td colspan="4">Rental Charges</td>
                    </tr>

                    <tr>
                        <td class="td-title td-40" colspan="2">Days:</td>
                        <td class="td-40"><span style="float:right">per day</span>@ {{ $booking->rate_in_dollars ?? '$' }}</td>
                        <td class="td-20">{{ $booking->total_rental_in_dollars ?? '$' }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-40" colspan="2">Reduce Excess - Top Cover</td>
                        <td class="td-40">
                            <span style="float:right">per {{ $options->where('id', 1)->first()->is_daily ? 'day' : 'booking'}}</span>
                            @ {{ $booking->options->contains('id', 1) ? $booking->options->where('id', 1)->first()->rate_in_dollars : '$' }}
                        </td>
                        <td class="td-20">
                            {{ $booking->options->contains('id', 1) ? centsToDollars($booking->options->where('id', 1)->first()->pivot->total_price) : '$' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="td-title td-40" colspan="2">Child Seat</td>
                        <td class="td-40">
                            @if ($options->where('id', 2)->first())
                                <span style="float:right">per {{ $options->where('id', 2)->first()->is_daily ? 'day' : 'booking'}}</span>
                                @ {{ $booking->options->contains('id', 2) ? $options->where('id', 2)->first()->rate_in_dollars : '$' }}
                            @endif
                        </td>
                        <td class="td-20">{{ $booking->options->contains('id', 2) ? centsToDollars($booking->options->where('id', 2)->first()->pivot->total_price) : '$' }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-40" colspan="2">Extended Area of Use</td>
                        <td class="td-40">
                            @if ($options->where('id', 3)->first())
                                <span style="float:right">per {{ $options->where('id', 3)->first()->is_daily ? 'day' : 'booking'}}</span>
                                @ {{ $booking->options->contains('id', 3) ? $options->where('id', 3)->first()->rate_in_dollars : '$' }}
                            @endif
                        </td>
                        <td class="td-20">{{ $booking->options->contains('id', 3) ? $options->where('id', 3)->first()->rate_in_dollars : '$' }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-40" colspan="2">Unlimited Kms</td>
                        <td class="td-40">
                            @if ($options->where('id', 4)->first())
                                <span style="float:right">per {{ $options->where('id', 4)->first()->is_daily ? 'day' : 'booking'}}</span>
                                @ {{ $booking->options->contains('id', 4) ? $options->where('id', 4)->first()->rate_in_dollars : '$' }}
                            @endif
                        </td>
                        <td class="td-20">
                            {{ $booking->options->contains('id', 4) ? centsToDollars($booking->options->where('id', 4)->first()->pivot->total_price) : '$' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="td-title td-40" colspan="2">Additional Driver</td>
                        <td class="td-40">
                            @if ($options->where('id', 5)->first())
                                <span style="float:right">per {{ $options->where('id', 5)->first()->is_daily ? 'day' : 'booking'}}</span>
                                {{ $booking->options->contains('id', 5) ? '@ ' . $options->where('id', 5)->first()->rate_in_dollars : '@ $' }}
                            @endif
                        </td>
                        <td class="td-20">{{ $booking->options->contains('id', 5) ? $options->where('id', 5)->first()->rate_in_dollars : '$' }}</td>
                    </tr>

                    <tr>
                        <td class="td-title td-80" colspan="3"><strong>Total Rental Charges (including GST)</strong></td>
                        <td class="td-20"><strong>{{ $booking->total_in_dollars }}</strong> </td>
                    </tr>
                    {{-- End of Rental Charges  --}}


                    @if ($booking->extraOptions->count())
                        <tr class="tr-section">
                            <td colspan="4">Rental Extra Charge</td>
                        </tr>

                        <tr>
                            <td class="td-title td-40" colspan="2">Days:</td>
                            <td class="td-40"><span style="float:right">per day</span>@ {{ $booking->rate_in_dollars ?? '$' }}</td>
                            <td class="td-20">{{ $booking->total_rental_in_dollars ?? '$' }}</td>
                        </tr>
                        @foreach ($booking->extraOptions as $item)
                                <tr>
                                    <td class="td-title td-40" colspan="2">
                                        @if ($item->id == 1)
                                            Reduce Excess - Top Cover
                                        @endif
                                        @if ($item->id == 2)
                                            Child Seat
                                        @endif
                                        @if ($item->id == 3)
                                            Extended Area of Use
                                        @endif
                                        @if ($item->id == 4)
                                            Unlimited Kms
                                        @endif
                                        @if ($item->id == 5)
                                            Additional Driver
                                        @endif
                                    </td>
                                    <td class="td-40">
                                        <span style="float:right">per booking</span>
                                        {{ '@ $' . number_format($item->pivot->total_price / 100, 2) }}
                                    </td>
                                    <td class="td-20">
                                        {{ '$' . number_format($item->pivot->total_price / 100, 2) }}
                                    </td>
                                </tr>

                        @endforeach




                        <tr>
                            <td class="td-title td-80" colspan="3"><strong>Total Extra Rental Charges (including GST)</strong></td>
                            <td class="td-20 "> <b>{{  '$-' . number_format($totalExtraOptions / 100, 2) }}</b> </td>
                        </tr>
                        {{-- End of extraOptions  --}}
                    @endif

                    <tr class="tr-section">
                        <td colspan="4">Payment</td>
                    </tr>
                    <tr>
                        <td class="td-title" colspan="4">
                            At the Start of the Rental and before collecting the
                            Vehicle You must provide Your credit card for payment
                            of Your total estimated Rental Charges plus the Bond.
                        </td>
                    </tr>
                    <tr>
                        <td class="td-title" colspan="4">
                            The primary credit card holder must be present at
                            the Start of the Rental.
                        </td>
                    </tr>
                    {{-- End of Payment  --}}

                    <tr class="tr-section">
                        <td colspan="4">Damage Excess</td>
                    </tr>

                    <tr>
                        <td class="td-title td-70" colspan="2">Payable for Damage, Third Party Loss or theft of the Vehicle</td>
                        <td class="td-30" colspan="2"><span style="float:right;padding-right:0px;">(including GST)</span>
                            @if ($booking->options->contains('id', 1))
                                $2,000
                            @else
                                $4,000
                            @endif

                        </td>
                    </tr>

                    {{-- <tr>
                        <td class="td-title td-70" colspan="2">Damage Excess Waiver (reduces your Damage Excess to)</td>
                        <td class="td-30" colspan="2"><span style="float:right;padding-right:0px;">per ____ (including GST)</span>$ </td>
                    </tr> --}}
                    {{-- End of Damage Excess  --}}


                    <tr class="tr-section">
                        <td colspan="4">Bond</td>
                    </tr>

                    <tr>
                        <td class="td-title td-60" colspan="2">Bond amount</td>
                        <td class="td-40" colspan="2">
                            @if ($booking->bond_amount != NULL)
                                ${{ $booking->bond_amount }}
                            @else
                                $
                            @endif
                        </td>
                    </tr>
                    {{-- End of Damage Excess  --}}

                    <tr class="tr-section">
                        <td colspan="4">Credit Card Details</td>
                    </tr>

                    <tr>
                        <td class="td-title td-25">Credit Card Type</td>
                        <td colspan="3">
                            <span style="margin-left:20px;">
                                <input type="checkbox" name="" value=""> Visa
                            </span>
                            <span style="margin-left:20px;">
                                <input type="checkbox" name="" value=""> Master Card
                            </span>
                            <span style="margin-left:20px;">
                                Other:______________________________
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="td-title td-25">Name on the Card</td>
                        <td class="td-25"></td>
                        <td class="td-title td-25">Credit Card Number</td>
                        <td class="td-25"></td>
                    </tr>

                    <tr>
                        <td class="td-title td-25">Expiry Date</td>
                        <td class="td-25"></td>
                        <td class="td-title td-25">CCV Code</td>
                        <td class="td-25"></td>
                    </tr>
                    {{-- End of Credit Card Details  --}}
                </tbody>
            </table>

            <table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td class="td-section td-25 red">Pre-existing damage</td>
                        <td class="td-35">
                            <img src="{{ url('assets/images/car-parts.jpg') }}" width="230">
                        </td>
                        <td class="td-40" style="padding:0;margin:0;" valign="top">
                            <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>1.</td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    {{-- End of Pre-existing damage  --}}
                </tbody>
            </table>
        </div>
    </section>

    <div class="page-break"></div>



    {{-- Additional Payments  --}}
    @if ($items)
        <section style="margin:20px 40px;">
            <div class="mt-40">
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr class="tr-section">
                            <td class="bold greyer">
                                Additional Payments
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="">
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td class="bold greyer td-40">
                                Description
                            </td>
                            <td class="bold greyer td-20">
                                Quantity
                            </td>
                            <td class="bold greyer td-20">
                                Added
                            </td>
                            <td class="bold greyer td-20">
                                Amount
                            </td>
                        </tr>
                        @for ($i=0; $i<sizeof($items); $i++)
                            @for ($j=0; $j<sizeof($items[$i]); $j++)
                                <tr>
                                    <td class="grey td-40">
                                        {{ $items[$i][$j]['description'] }}
                                    </td>
                                    <td class="td-20">
                                        {{ $items[$i][$j]['quantity'] }}
                                    </td>
                                    <td class="td-20">
                                        {{ date('d/m/Y h:i', strtotime($items[$i][$j]['created_at'])) }}
                                    </td>
                                    <td class="td-20">
                                        {{ '$'.$items[$i][$j]['amount'] }}
                                    </td>
                                </tr>
                            @endfor
                        @endfor

                    </tbody>
                </table>
            </div>

            <div class="">
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td class="grey td-80 bold">Total Additional Payments</td>
                            <td class="td-20">{{ '$'.$total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    @endif


    {{-- Start of last page  --}}
    <section style="margin:20px 40px;">
        <div class="mt-40">
            <table width="100%" cellspacing="0" cellpadding="0" class="table-white">
                <tbody>
                    <tr>
                        <td class="bold greyer">
                            I have read and agree:
                            <br>(a) to pay the Rental Charges as shown in this Rental Agreement; and
                            <br>(b) to be bound by the Terms and Conditions.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            <table width="100%" cellspacing="0" cellpadding="0" class="table-white">
                <tbody>
                    <tr>
                        <td class="bold greyer td-30">
                            Renter's signature
                        </td>

                        @if ($booking->signature_url !== NULL)
                             <td class="grey td-70"
                                style="background-image:url({{ $booking->signature_url }});
                                background-repeat:no-repeat;background-position:center center;"
                            >
                                <br><br><br><br><br><br><br>
                            </td>
                        @endif

                        @if ($booking->signature_url === NULL)
                            <td class="grey td-70">
                                <br><br><br><br>
                            </td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            <table width="100%" cellspacing="0" cellpadding="0" class="table-white">
                <tbody>
                    <tr>
                        <td class="bold greyer td-30">
                            Date
                        </td>
                        @if ($pickup !== NULL)
                            <td class="grey td-70">
                                {{ date('d/m/Y', strtotime($pickup->created_at)) }}
                            </td>
                        @endif

                        @if ($pickup === NULL)
                            <td class="grey td-70">
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            <table width="100%" cellspacing="0" cellpadding="0" class="table-white">
                <tbody>
                    <tr>
                        <td class="bold greyer td-30">
                            Authorised driver signature
                        </td>

                        @if ($booking->driver_signature_url !== NULL)
                             <td class="grey td-70"
                                style="background-image:url({{$booking->driver_signature_url}});background-repeat:no-repeat;background-position:center center;">
                            <br><br><br><br><br><br><br></td>
                        @endif

                        @if ($booking->driver_signature_url === NULL)
                            <td class="grey td-70"><br><br><br><br></td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            <table width="100%" cellspacing="0" cellpadding="0" class="table-white">
                <tbody>
                    <tr>
                        <td class="bold greyer td-30">
                            Date
                        </td>
                        @if ($pickup !== NULL)
                            <td class="grey td-70">
                                {{ date('d/m/Y', strtotime($pickup->created_at)) }}
                            </td>
                        @endif

                        @if ($pickup === NULL)
                            <td class="grey td-70">
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</body>
