@extends('backEnd.layoutes.mastar')
@section('title','Edit profile')
@section('css')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    function initMap() {
        var latitude = document.getElementById('latitude').getAttribute('value'),
            longitude = document.getElementById('longitude').getAttribute('value');
        const uluru = { lat: parseInt(latitude), lng: parseInt(longitude) };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 8,
            center: uluru,
            mapTypeId: "roadmap",
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
            position: uluru,
            map: map,
        });
        // search
        var input = document.getElementById('pac-input');
        {{-- $("#pac-input").val("أبحث هنا "); --}}
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });
        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }
            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];
            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(100, 100),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };
                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));
                $('#latitude').val(place.geometry.location.lat());
                $('#longitude').val(place.geometry.location.lng());
                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
    }
</script>
@stop
@section('content')
<!-- Sidenav -->
<div class="d-flex bg-page" id="wrapper">
    @include('backEnd.nurse.sidenav')
<div id="page-content-wrapper">
    <!-- Topnav -->
    <nav class="navbarp navbar-top navbar-expand navbar-dark p-2">
        <div class="container-fluid">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar links -->
            <button class="btn btn-primary d-lg-none ml-2" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
            <!-- Search form -->
            <ul class="navbar-nav align-items-center ml-md-auto">
              <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-bell fa-fw mr-lg-3 mt-lg-1" style="font-size: 15pt;"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                  <!-- Dropdown header -->
                  <div class="px-3 py-3">
                    <p class="text-muted m-0">You have <strong class="text-primary">13</strong> notifications.</p>
                  </div>
                  <!-- List group -->
                  <div class="list-group-noti list-group-flush">
                    <a href="#!" class="list-group-item list-group-item-action">
                      <div class="row align-items-center">
                        <div class="col-auto mb-3">
                          <!-- Avatar -->
                          <img alt="Image placeholder" src="imgs/team-1.jpg" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                          <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <h6 class="text-gray-d">John Snow</h6>
                            </div>
                            <div class="text-right text-muted">
                              <small class="text-primary">2 hrs ago</small>
                            </div>
                          </div>
                          <p class="">Lets meet at Starbucks at 11:30. Wdyt?</p>
                        </div>
                      </div>
                    </a>
                    <a href="#!" class="list-group-item list-group-item-action">
                      <div class="row align-items-center">
                        <div class="col-auto mb-3">
                          <!-- Avatar -->
                          <img alt="Image placeholder" src="imgs/team-1.jpg" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                          <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <h6 class="text-gray-d">John Snow</h6>
                            </div>
                            <div class="text-right text-muted">
                              <small class="text-primary">3 hrs ago</small>
                            </div>
                          </div>
                          <p class="">A new issue has been reported for Argon.</p>
                        </div>
                      </div>
                    </a>
                  </div>
                  <!-- View all -->
                  <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
                </div>
              </li>
            </ul>
            <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
              <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                      <img alt="Image placeholder" src="{{$nurse->image}}">
                    </span>
                    <div class="media-body ml-3 mr-3 d-lg-block">
                      <h6 class="mb-0 font-weight-bold text-white">{{$nurse->name}}</h6>
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <!-- informationContent -->
    <div class="container">
      @include('includes.alerts.success')
      <form action="{{route('nurse.update.profile',$nurse->id)}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <input type="hidden" id="latitude" name="latitude" value="{{ $nurse->latitude }}">
          <input type="hidden" id="longitude" name="longitude" value="{{ $nurse->longitude }}">
          <input type="hidden" name="id" value="{{$nurse->id}}">
          <input type="hidden" name="IdCode" value="{{$nurse->idCode}}">
          <input type="hidden" name="countryCode"value="{{$nurse->countryCode}}">
          <div class="avatar-wrapper mt-5">
              <img class="profile-pic" src="" name = "image"/>
              <div class="upload-button">
                  <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
              </div>
              <input class="file-upload @error('image') is-invalid @enderror" type="file" accept="image/*" name="image">
              @error('image')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          </div>
          <label class="col-12 text-center text-dark" style="margin-top:-50px"><i class="fa fa-camera mr-2"></i>Add Profile Pictrue</label>
          <div class="row col-lg-8 ml-auto mr-auto mt-5">
              <div class="col-lg-12 form-group">
                  <label class="h6 font-weight-bold">Nurse Name</label>
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$nurse->name}}" placeholder="Nurse Full Name"style="text-transform:capitalize">
                  @error('name')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
              </div>
              <div class="col-md-12 mb-xl-3">
                  <div class="form-group">
                      <label class="h6 font-weight-bold">Medical Description</label>
                      <textarea class="form-control @error('information') is-invalid @enderror" row = "4" cols="10" name="information" style="resize: none" placeholder="Medical Description">{{$nurse->information}}</textarea>
                      @error('information')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                  </div>
              </div>
              <div class="col-md-6 mb-xl-3">
                  <div class="form-group">
                      <label class="h6 font-weight-bold">Phone Number</label>
                      <input type="text" name="phoneNumber" class="form-control @error('phoneNumber') is-invalid @enderror" value="{{$nurse->phoneNumber}}" placeholder="Phone Number">
                          @error('phoneNumber')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                          @if (session('verifyMsg'))
                              <div class="alert alert-danger">
                                  {{ session('verifyMsg') }}
                              </div>
                          @endif
                  </div>
              </div>
              <div class="col-md-6 mb-xl-3">
                  <div class="form-group">
                      <label class="h6 font-weight-bold">Nationality</label>
                      <input value="{{$nurse->Nationality}}" type="text" name="Nationality" class="form-control @error('Nationality') is-invalid @enderror" placeholder="Nationality">
                      @error('Nationality')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                  </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <label class="h5 font-weight-bold">Address</label>
                    <input value="{{ $nurse->address }}" type="text" id="pac-input"class="form-control" name="address">
                    <div id="map" style="width:100%;height:400px"></div>
                </div>
            </div>
          </div>


          <div class="col-12 text-center mb-5 mt-5">
              <input type="submit" class="h4 col-7 btn btn-primary font-weight-400 mr-auto ml-auto">
          </div>
      </form>
  </div>
    @include('backEnd.layoutes.footer')
</div>
</div>
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYG5g2aJ9TjMlbYk7E_VuFYKSvHC1Ee6Y&callback=initMap&libraries=places&v=weekly"
  defer
></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
@stop

