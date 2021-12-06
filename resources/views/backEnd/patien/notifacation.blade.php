<!-- prescription notifaction -->
<div class="list-group-noti list-group-flush">
    <h5 class="ml-3 mr-3 pt-2 border-top"></h5>
    {{-- <a href="#" class="ml-3 mr-3 float-right">Read All</a> --}}
    {{--  auth()->user()->notifications()->whereNotNull('read_at')->get()  --}}
        @foreach(auth()->guard('patien')->user()->notifications as $notification)
            <div class="row col-12" >
                <div class="col-3">
                    <!-- Avatar -->
                    @if(!$patient->image)
                        <img alt="Image placeholder" src="{{ asset('uploads/default.png') }}"  class="avatar rounded-circle">
                    @else
                        <img alt="Image placeholder" src="{{ $patient->image }}" class="avatar rounded-circle">
                    @endif
                </div>
                <div class="col-lg-8">
                    <h6 class="text-gray-d">{{$notification->data['title']}}</h6>
                        <a href="{{ route('notifyRocata',$patient->id) }}" class="text-primary text-capitalize">{{$notification->data['rocata_prescrption']}}</a>
                    <div>
                        @foreach($notification->data['test_name'] as $test)
                            <a href="{{ route('notifyTest',$patient->id) }}" class="text-primary text-capitalize">{{ $test['test_name'] }}</a>
                        @endforeach
                    </div>
                    <div>
                        @foreach($notification->data['ray_name'] as $ray)
                            <a href="{{ route('notifyRay',$patient->id) }}"class="text-primary text-capitalize" >{{ $ray['ray_name'] }}</a>
                        @endforeach
                    </div>
                    <a href="{{ route('patient.readNotify',$patient->id) }}">ReadAll</a>
                </div>
                <hr class="ml-5 mr-auto" style="width:350px"/>

            </div>
        @endforeach
</div>
<!-- prescription notifaction -->
@if(auth('patien')->user()->childern)
    @foreach (auth('patien')->user()->childern as $child)
      @if($child->Vaccination)
      <!-- two month -->
      @if($child->CalcAgeMonth < 2)
          @if($child->Vaccination->at_birth == null)
              <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF" class="ml-2 mb-2">Go get your son vaccinated </p>
              @elseif(!in_array('BCG',$child->Vaccination->at_birth))
              <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF" class="ml-2 mb-2">Go get your son vaccinated <b>BCG</b></p>
              @elseif(!in_array('Hepatitis B',$child->Vaccination->at_birth))
              <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF" class="ml-2 mb-2">Go get your son vaccinated <b>Hepatitis B</b></p>
          @endif
      @endif
      <!-- two month -->
        <!-- two month -->
        @if($child->CalcAgeMonth == 2)
            @if($child->Vaccination->two_month == null)
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF" class="ml-2 mb-2">Go get your son vaccinated</p>
                @elseif(!in_array('IPV',$child->Vaccination->two_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF" class="ml-2 mb-2">Go get your son vaccinated <b>ipv</b></p>
                @elseif(!in_array('DTPw',$child->Vaccination->two_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF" class="ml-2 mb-2">Go get your son vaccinated <b>DTPw</b></p>
                @elseif(!in_array('Hepatitis B',$child->Vaccination->two_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF" class="ml-2 mb-2">Go get your son vaccinated <b>Hepatitis B</b></p>
                @elseif(!in_array('Hip',$child->Vaccination->two_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF" class="ml-2 mb-2">Go get your son vaccinated <b>Hip</b></p>
                @elseif(!in_array('PCV',$child->Vaccination->two_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF" class="ml-2 mb-2"> Go get your son vaccinated <b>PCV</b></p>
                @elseif(!in_array('Rota',$child->Vaccination->two_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF" class="ml-2 mb-2"> Go get your son vaccinated <b>Rota</b></p>
            @endif
        @endif
        <!-- two month -->
        <!-- four month -->
        @if($child->CalcAgeMonth == 4)
            @if($child->Vaccination->four_month == null)
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF" >Go get your son vaccinated</p>
                @elseif(!in_array('IPV',$child->Vaccination->four_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>ipv</b></p>
                @elseif(!in_array('DTPw',$child->Vaccination->four_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>DTPw</b></p>
                @elseif(!in_array('Hepatitis B',$child->Vaccination->four_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>Hepatitis B</b></p>
                @elseif(!in_array('Hip',$child->Vaccination->four_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>Hip</b></p>
                @elseif(!in_array('PCV',$child->Vaccination->four_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>PCV</b></p>
                @elseif(!in_array('Rota',$child->Vaccination->four_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>Rota</b> </p>
            @endif
        @endif
        <!-- four month -->
        <!-- six month -->
        @if($child->CalcAgeMonth == 6)
            @if($child->Vaccination->six_month == null)
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated</p>
                @elseif(!in_array('IPV',$child->Vaccination->six_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>ipv</b></p>
                @elseif(!in_array('DTPw',$child->Vaccination->six_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>DTPw</b></p>
                @elseif(!in_array('Hepatitis B',$child->Vaccination->six_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>Hepatitis B</b></p>
                @elseif(!in_array('Hip',$child->Vaccination->six_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>Hip</b></p>
                @elseif(!in_array('PCV',$child->Vaccination->six_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>PCV</b></p>
                @elseif(!in_array('OPV',$child->Vaccination->six_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>OPV</b></p>
            @endif
        @endif
        <!-- six month -->
        <!-- nine month -->
        @if($child->CalcAgeMonth == 9)
            @if($child->Vaccination->nine_month == null)
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated</p>
                @elseif(!in_array('IPV',$child->Vaccination->nine_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>ipv</b></p>
                @elseif(!in_array('DTPw',$child->Vaccination->nine_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>DTPw</b></p>
                @elseif(!in_array('Hepatitis B',$child->Vaccination->nine_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated  <b>Hepatitis B</b></p>
                @elseif(!in_array('Hip',$child->Vaccination->nine_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>Hip</b></p>
                @elseif(!in_array('PCV',$child->Vaccination->nine_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>PCV</b></p>
                @elseif(!in_array('OPV',$child->Vaccination->nine_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>OPV</b></p>
            @endif
        @endif
        <!-- nine month -->
        <!-- twelve month -->
        @if($child->CalcAgeYear == 1)
            @if($child->Vaccination->twelve_month == null)
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated</p>
                @elseif(!in_array('OPV',$child->Vaccination->twelve_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated ipv <b>OPV</b></p>
                @elseif(!in_array('MMR',$child->Vaccination->twelve_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>MMR</b></p>
                @elseif(!in_array('PCV',$child->Vaccination->twelve_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>PCV</b></p>
                @elseif(!in_array('MCV4',$child->Vaccination->twelve_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>MCV4</b></p>

            @endif
        @endif
        <!-- twelve month -->
        <!-- eightten month -->
        @if($child->CalcAgeMonth == 18)
            @if($child->Vaccination->eighteen_month == null)
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated eighteen_month  null</p>
                @elseif(!in_array('OPV',$child->Vaccination->eighteen_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b> OPV</b></p>
                @elseif(!in_array('DTap',$child->Vaccination->eighteen_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>DTap</b></p>
                @elseif(!in_array('Hip',$child->Vaccination->eighteen_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated  <b>Hip</b></p>
                @elseif(!in_array('MMr',$child->Vaccination->eighteen_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>MMR</b></p>
                @elseif(!in_array('Hepatitis A',$child->Vaccination->eighteen_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>Hepatitis A</b></p>
            @endif
        @endif
        <!-- eightten month -->
        <!-- twenty four month -->
        @if($child->CalcAgeYear == 2)
            @if($child->Vaccination->twenty_four_month == null)
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated</p>
                @elseif(!in_array('Hepatitis A',$child->Vaccination->twenty_four_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated ipv <b>Hepatitis A</b></p>
                @elseif(!in_array('DTap',$child->Vaccination->twenty_four_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>DTap</b></p>
                @elseif(!in_array('OPV',$child->Vaccination->twenty_four_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>OPV</b></p>
                @elseif(!in_array('DTap',$child->Vaccination->twenty_four_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>DTap</b></p>
                @elseif(!in_array('MMR',$child->Vaccination->twenty_four_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>MMR</b></p>
                @elseif(!in_array('Varicella',$child->Vaccination->twenty_four_month))
                <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF">Go get your son vaccinated <b>Varicella</b> </p>
            @endif
        @endif
        <!-- twenty four month -->
    @else
        <p style="padding:10px;margin:0 0 10px 0;background-color:#0faac9;color:#FFF" class="ml-2 mt-2">Your newborn baby is due for vaccination</p>
    @endif
    @endforeach
@endif
