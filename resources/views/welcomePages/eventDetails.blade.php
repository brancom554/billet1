@extends('welcomePages.layouts.app')

@section('content')
<!-- page header section start here  -->
<div class="page-header-section post-title style-1" style="background-image: url({{asset('welcome/images/pageheader/pageheader.png')}})">
    <div class="overlay">
        <div class="page-header-content">
            <div class="container container-1310">
                <div class="page-header-content-inner">
                    <div class="page-title">
                        <span class="title-text">Evénements ....</span></span>
                    </div>
                    <!-- <ol class="breadcrumb">
                        <li>You Are Here : </li>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Conference Center</li>
                    </ol> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page header section ending here -->

<!-- event venues details section start here -->

@if ($event->is_live == 1)
<section class="event-venues-details style-1 padding-tb bg-ash">
    <div class="container container-1310">
        <div class="event-details-header">
            <div class="event-venue-slider">
                <div class="">
                    <div class="swiper-slide">
                        <div class="event-thumb">
                            <img src="{{asset($event->image() ? $event->image()[0]['image_path'] : '')}}" style="object-fit:contain;
                                        width:900px;
                                        height:700px;" alt="venue">
                        </div>
                    </div>
                    
                </div>
                <div class="event-title">
                    <p>{{$event->title}}</p>
                </div>
                <div class="event-pagination"></div>
            </div>
        </div>
        <div class="event-details-wraper no-gutters">
            <div class="col-xl-8 col-12">
                <div class="events-content">
                    <h3>{{$event->title}}</h3>
                    <p>{{$event->description}}</p>
                   
                </div>
            </div>
            <div class="col-xl-4 col-12">
                <div class="events-sidebar">
                    {{-- <div class="capacity">
                        <h5>Capacity</h5>
                        <ul>
                            <li><p>Theater</p>: <span>300</span></li>
                            <li><p>Reception <span>(indor only)</span></p>: <span>250</span></li>
                            <li><p>Reception <span>(indor only)</span></p>: <span>300</span></li>
                        </ul>
                    </div> --}}
                    <div class="venue-info">
                        <h5>Vanue Info</h5>
                        <ul>
                            <li>
                                <p>location</p>:<span>{{$event->location}}</span>
                            </li>
                            {{-- <li>
                                <p>Phone</p>:<span>+880 1234 567890</span>
                            </li>
                            <li>
                                <p>Fax</p>:<span>0021 345 67 89</span>
                            </li>
                            <li>
                                <p>Email</p>:<span>inco@yourmail.com</span>
                            </li> --}}
                            {{-- <li>
                                <p>Address</p>:<span>New Circuit Road, Gulshan Dhaka- 1105</span>
                            </li> --}}
                            {{-- <li>
                                <p>Share</p>
                                <div>
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li><li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                    </ul>
                                </div>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="event-venue-content text-center pb-5">
        
        <a href="#" class="btn-defult">Reserver</a>
    </div>
</section>
@else
    <h2 class="mt-5 pt-5 mb-5 pb-5">Cet événement n'existe pas</h2>
@endif

<!-- event venues details section ending here -->
@endsection