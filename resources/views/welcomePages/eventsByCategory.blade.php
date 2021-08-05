@extends('welcomePages.layouts.app')

@section('content')
<!-- event venues section start here  -->
<section class="event-venue padding-tb bg-ash">
    <div class="container container-1310">
        <div class="row my-15">

            @foreach ($events as $event)
            <div class="col-md-6">
                <div class="venue-item">
                    <div class="venue-thumb">
                        <a href="#"><img {{asset($event->image() ? $event->image()[0]['image_path'] : '')}} alt="venue"></a>
                    </div>
                    <div class="venue-content">
                        <a href="#"><h6>{{$event->title}}</h6></a>
                        <div class="meta-post">
                            {{-- <span class="by"> 
                                350 Reception 
                                <a href="#"><i class="fa fa-heart"></i> 2. k</a>
                                <span class="rating">
                                    <i class="fa  fa-star"></i>
                                    <i class="fa  fa-star"></i>
                                    <i class="fa  fa-star"></i>
                                    <i class="fa  fa-star"></i>
                                    <i class="fa  fa-star-half"></i>
                                </span> 
                            </span> --}}
                        </div>
                        <p>{{$event->description}}</p>
                        <div class="venue-location">
                            <p><i class="fa fa-home"></i>{{$event->location}}</p>
                            <p><a href="{{route('eventsDetails', $event->id)}}"><b>Voir plus ...</b></a></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="pagination-area  d-flex flex-wrap justify-content-center">
              <ul class="pagination  d-flex flex-wrap m-0">
                <li class="prev">
                  <a href="#"> <i class="fas fa-angle-double-left"></i> previous</a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#" class="active d-none d-md-block">2</a></li>
                <li><a href="#" class="d-none d-md-block">3</a></li>
                <li class="dot">....</li>
                <li><a href="#" class="d-none d-md-block">4</a></li>
                <li class="next">
                  <a href="#">next <i class="fas fa-angle-double-right"></i> </a>
                </li>
              </ul>
        </div>
    </div>
</section>
<!-- event venues section ending here  -->


@endsection