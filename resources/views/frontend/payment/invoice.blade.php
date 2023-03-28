@extends('layouts.bare_base')
@push('css')
    <link rel="stylesheet" href="{{ asset('static/frontend/css/invoice.css') }}">
@endpush
@section('title')
    Invoice of {{ $order->order_id }}
@endsection
@section('main')
    <div class="container">
        <div class="col-md-12">
            <div class="invoice">
                <!-- begin invoice-company -->
                <div class="invoice-company text-inverse f-w-600 py-1">
                    <img class="float-left" src="{{ asset('static/frontend/images/greenbasket_light.png') }}" width="100"
                        alt="logo">

                    <span class="pull-right hidden-print float-right">
                        {{-- <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5"><i
                                class="fa fa-file t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF</a> --}}
                        <a href="javascript:;" onclick="window.print()" class="btn btn-md btn-white m-b-10 p-l-5">
                            <i class="icon icon-print t-plus-1 fa-fw fa-lg"></i> Print</a>
                    </span>
                    <p class="text-center"> Invoice: #{{ $order->order_id }}</p>
                </div>
                <!-- end invoice-company -->
                <!-- begin invoice-header -->
                <div class="invoice-header">
                    <div class="invoice-from">
                        <small>from</small>
                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse">{{ env('APP_NAME') }}</strong><br>
                            Street Address<br>
                            City, Zip Code<br>
                            Phone: (123) 456-7890<br>
                            Fax: (123) 456-7890
                        </address>
                    </div>
                    <div class="invoice-to">
                        <small>to</small>
                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse">{{ $order->first_name . ' ' . $order->sur_name }}</strong><br>
                            {{ isset($order->diff_address) ? $order->diff_address : $order->address }}<br>
                            {{ $order->district }}, {{ $order->post }}<br>
                            Phone: {{ $order->phone }}<br>
                        </address>
                    </div>
                    <div class="invoice-date">
                        <h4><b>#{{ $order->order_id }}<br></b></h4>
                        <div class="date text-inverse m-t-5">
                            {{ Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                        </div>
                        <div class="invoice-detail">
                            <span class="text-uppercase">{{ $order->payment_method }}</span><br>
                            <span
                                class="text-capitalize @if ($order->payment == 'pending') text-danger @else text-success @endif">{{ $order->payment }}</span><br><br>
                            @if ($order->payment == 'pending' and $order->payment_method != 'cod')
                                <button class="btn btn-primary btn-lg">Pay Now</button>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- end invoice-header -->
                <!-- begin invoice-content -->
                <div class="invoice-content">
                    <!-- begin table-responsive -->
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>PRODUCT DESCRIPTION</th>
                                    <th class="text-center" width="10%">TOTAL WEIGHT</th>
                                    <th class="text-center" width="10%">TOTAL QUANTITY</th>
                                    <th class="text-right text-center" width="20%">LINE <br>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->variations as $variation)
                                    <tr>
                                        <td>
                                            <span
                                                class="text-inverse">{{ $variation['name_' . app()->getLocale()] }}</span><br>
                                            <small>{{ $variation['desc_' . app()->getLocale()] }}</small>
                                        </td>
                                        <td class="text-center">{{ $variation->pivot->wt }} KG</td>
                                        <td class="text-center">{{ $variation->pivot->qty }} </td>
                                        <td class="text-right">
                                            ${{ $variation->price->price * $variation->pivot->qty }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                    <!-- begin invoice-price -->
                    <div class="invoice-price">
                        <div class="invoice-price-left">
                            <div class="invoice-price-row">
                                <div class="sub-price">
                                    <small>SUBTOTAL</small>
                                    <span class="text-inverse">${{ $order->sub_total }}</span>
                                </div>
                                <div class="sub-price">
                                    <i class="fa fa-plus text-muted"></i>
                                </div>
                                <div class="sub-price">
                                    <small>DELIVERY FEE</small>
                                    <span class="text-inverse">${{ $order->dl_total }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-price-right bg-primary">
                            <small>TOTAL</small> <span class="f-w-600 ">${{ $order->total }}</span>
                        </div>
                    </div>
                    <!-- end invoice-price -->
                </div>
                <!-- end invoice-content -->
                <!-- begin invoice-note -->
                <div class="invoice-note">
                    * Make all cheques payable to [Your Company Name]<br>
                    * Payment is due within 30 days<br>
                    * If you have any questions concerning this invoice, contact [Name, Phone Number, Email]
                </div>
                <!-- end invoice-note -->
                <!-- begin invoice-footer -->
                <div class="invoice-footer">
                    <p class="text-center m-b-5 f-w-600">
                        THANK YOU FOR YOUR BUSINESS
                    </p>
                    <p class="text-center">
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> matiasgallipoli.com</span>
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:016-18192302</span>
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> rtiemps@gmail.com</span>
                    </p>
                </div>
                <!-- end invoice-footer -->
            </div>
        </div>
    </div>
@endsection
