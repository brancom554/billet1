@extends('welcomePages.layouts.app')


@section('content')
<!-- banner section start here -->
<section class="banner-section style-3" style="background-image: url({{asset('welcome/images/banner/02.png')}}); background-color: #f2f2f2">
    <div class="banner-content-area">
        <div class="container container-1310">
            <div class="banner-content">
                <h1>Découvrer vos meilleurs événements</h1>
                <!-- <span>Find The Conference, Festival, Exhibition, Meetup, Seaker & Vanue</span> -->
            </div>
        </div>
    </div>
</section>
<!-- banner section ending here -->

<section class="feature-section-two mt-5">
    <div class="section-header wow fadeInDown" data-wow-duration="1s" data-wow-delay=".1s">
        <h2>Nos catégories d'événements !!!</h2>

    </div>
    <div class="container">
    <div class="row section-wrapper">
    
    <div class="feature-block-two col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
    <div class="inner-box">
    <div class="icon"><img src="{{asset('welcome/images/resource/feature-1.png')}}" alt=""></div>
    <h4><a href="{{route('eventsByCategory', $eventsCategories[0]->name)}}">{{$eventsCategories[0]->name}}</a></h4>
    <div class="text">Ex vim lorem homero. Te sit mutat graece deserunt ea has. Sumo</div>
    <div class="link-box"><a href="{{route('eventsByCategory', $eventsCategories[0]->name)}}">Voir les événements</a></div>
    </div>
    </div>
    
    <div class="feature-block-two col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
    <div class="inner-box">
    <div class="icon"><img src="{{asset('welcome/images/resource/feature-2.png')}}" alt=""></div>
    <h4><a href="{{route('eventsByCategory', $eventsCategories[1]->name)}}">{{$eventsCategories[1]->name}}</a></h4>
    <div class="text">Ex vim lorem homero. Te sit mutat graece deserunt ea has. Sumo</div>
    <div class="link-box"><a href="{{route('eventsByCategory', $eventsCategories[1]->name)}}">Voir les événements</a></div>
    </div>
    </div>
    
    <div class="feature-block-two col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
    <div class="inner-box">
    <div class="icon"><img src="{{asset('welcome/images/resource/feature-3.png')}}" alt=""></div>
    <h4><a href="{{route('eventsByCategory', $eventsCategories[2]->name)}}">{{$eventsCategories[2]->name}}</a></h4>
    <div class="text">Ex vim lorem homero. Te sit mutat graece deserunt ea has. Sumo</div>
    <div class="link-box"><a href="{{route('eventsByCategory', $eventsCategories[2]->name)}}">Voir les événements</a></div>
    </div>
    </div>

    <div class="feature-block-two col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
        <div class="inner-box">
        <div class="icon"><img src="{{asset('welcome/images/resource/feature-3.png')}}" alt=""></div>
        <h4><a href="{{route('eventsByCategory', $eventsCategories[3]->name)}}">{{$eventsCategories[3]->name}}</a></h4>
        <div class="text">Ex vim lorem homero. Te sit mutat graece deserunt ea has. Sumo</div>
        <div class="link-box"><a href="{{route('eventsByCategory', $eventsCategories[3]->name)}}">Voir les événements</a></div>
        </div>
        </div>

        <div class="feature-block-two col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
            <div class="inner-box">
            <div class="icon"><img src="{{asset('welcome/images/resource/feature-3.png')}}" alt=""></div>
            <h4><a href="{{route('eventsByCategory', $eventsCategories[4]->name)}}">{{$eventsCategories[4]->name}}</a></h4>
            <div class="text">Ex vim lorem homero. Te sit mutat graece deserunt ea has. Sumo</div>
            <div class="link-box"><a href="{{route('eventsByCategory', $eventsCategories[4]->name)}}">Voir les événements</a></div>
            </div>
            </div>

            <div class="feature-block-two col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
                <div class="inner-box">
                <div class="icon"><img src="{{asset('welcome/images/resource/feature-3.png')}}" alt=""></div>
                <h4><a href="{{route('eventsByCategory', $eventsCategories[5]->name)}}">{{$eventsCategories[5]->name}}</a></h4>
                <div class="text">Ex vim lorem homero. Te sit mutat graece deserunt ea has. Sumo</div>
                <div class="link-box"><a href="{{route('eventsByCategory', $eventsCategories[0]->name)}}">Voir les événements</a></div>
                </div>
                </div>

                <div class="feature-block-two col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
                    <div class="inner-box">
                    <div class="icon"><img src="{{asset('welcome/images/resource/feature-3.png')}}" alt=""></div>
                    <h4><a href="{{route('eventsByCategory', $eventsCategories[6]->name)}}">{{$eventsCategories[6]->name}}</a></h4>
                    <div class="text">Ex vim lorem homero. Te sit mutat graece deserunt ea has. Sumo</div>
                    <div class="link-box"><a href="{{route('eventsByCategory', $eventsCategories[6]->name)}}">Voir les événements</a></div>
                    </div>
                    </div>
    
    <div class="feature-block-two col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="1200ms">
    <div class="inner-box">
    <div class="icon"><img src="{{asset('welcome/images/resource/feature-4.png')}}" alt=""></div>
    <h4><a href="{{route('eventsByCategory', $eventsCategories[7]->name)}}">{{$eventsCategories[7]->name}}</a></h4>
    <div class="text">Ex vim lorem homero. Te sit mutat graece deserunt ea has. Sumo</div>
    <div class="link-box"><a href="{{route('eventsByCategory', $eventsCategories[7]->name)}}">Voir les événements</a></div>
    </div>
    </div>
    </div>
    </div>
    </section>


<!-- event schedule section start here -->
<section class="event-schedule style-3 padding-tb">
    <div class="container container-1310">
        <div class="section-header wow fadeInDown" data-wow-duration="1s" data-wow-delay=".1s">
            <h2>Les prochains événements</h2>
            <!-- <span>More then 200 upcoming exclusive events are comming in this year. You can join our event & get unlimited of happyness.</span> -->
        </div>
        <div class="section-wrapper">
            <div class="tabcontent">
                <ul>
                    @forelse ($events as $event)

                    @if ($event->start_date >= \Carbon\Carbon::now()->format('Y-m-d H:i:s') && $event->is_live == 1)
                    
                    <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".4s">
                        <div class="con-schedule">
                            <div class="con-schedule-thumb">
                                <img src="{{asset($event->image() ? $event->image()[0]['image_path'] : '')}}" alt="speaker">
                            </div>
                            <div class="con-schedule-content">
                                <h4>{{$event->title}}</h4>
                                <p>{{$event->description ?? $event->description}}</p>
                                <ul>
                                    <li>
                                        <div class="con-info-title">Time</div>
                                        <div class="con-info-text">{{$event->start_date->format('Y-m-d')}} at {{$event->start_date->format('H:i:s')}}</div>
                                    </li>
                                    <li>
                                        <div class="con-info-title">{{$event->venue_name}}</div>
                                        <div class="con-info-text">{{$event->location ?? $event->location}}</div>
                                    </li>
                                </ul>
                               
                            </div>
                        </div>
                        
                        <div class="con-ticket">
                            <img src="{{asset('welcome/images/speaker/ticket.png')}}" alt="meta-con">
                            <span class="con-t-text">Ticket From</span>
                            <span class="con-t-price">{{$event->ticket() ? $event->ticket()[0]['price'] : ''}}</span>
                            <a href="{{route('showEventPage', [$event->id, $event->title])}}" class="btn-defult">Réserver</a>
                            <a href="{{route('eventsDetails', $event->id)}}" class="btn-defult">Détails</a>
                        </div>
                    </li>
                    
                    @endif

                    @empty

                    <h4>Pas d'événement disponible</h4>

                    @endforelse
                    
                    
                </ul>
            </div>
              <ul class="pagination d-flex flex-wrap justify-content-center">
                <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s"><a href="#">1</a></li>
                <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s"><a href="#" class="active">2</a></li>
                <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s"><a href="#">3</a></li>
                <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s"><a href="#">4</a></li>
                <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s"><a href="#">5</a></li>
              </ul>	
        </div>
    </div>
</section>	
<!-- event schedule section ending here -->

<!-- blog section start here -->
<section class="blog-section padding-tb">
    <div class="container container-1310">
        <div class="section-header d-flex align-items-center flex-wrap wow fadeInDown" data-wow-duration="1s" data-wow-delay=".1s">
            <h2>Quelques événements passés</h2>
            <div class="blog-btn">
                <div class="blog-btn-prev blog-navy"></div>
                <div class="blog-btn-next blog-navy"></div>
            </div>
        </div>
        <div class="section-wrapper">
            <div class="blog-slider">
                <div class="swiper-wrapper">
                    @foreach ($events as $event)
                    @if ($event->end_date <= \Carbon\Carbon::now()->format('Y-m-d H:i:s') && $event->is_live == 1)
                    <div class="swiper-slide wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                        <div class="post-item">
                            <div class="post-item-inner">
                                <div class="post-thumb">
                                    <a href="{{route('eventsDetails', $event->id)}}"><img src="{{asset($event->image() ? $event->image()[0]['image_path'] : 'welcome/css/images/corporate.png')}}" style="object-fit:contain;
                                        width:410px;
                                        height:300px;" alt="blog"></a>
                                </div>
                                <div class="post-content">
                                    <span>{{$event->category}}</span>
                                    <h5><a href="#">{{$event->title}}</a></h5>
                                    <p>{{$event->description}}</p>
                                    <div class="meta-post">
                                        <span class="by"> Organisé par <a class="name" href="{{route('eventsDetails', $event->id)}}">{{$event->organiser->name}}</a><a class="date" href="{{route('eventsDetails', $event->id)}}"></a><img  src="{{$event->organiser->logo_path ? $event->organiser->logo_path : 'welcome/images/blog/meta.png'}}" class="organiser_image" alt="organizer"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                   
                </div>
            </div>
        </div>
    </div>
</section>
<!-- blog section ending here -->
@endsection