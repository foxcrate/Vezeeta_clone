@if($nurse->pRequests)
    @foreach($nurse->pRequests as $rq)
    <span id="patient_id" style="display:none">{{$rq->patient->id}}</span>
    <span id="request_id" style="display:none">{{$rq->id}}</span>
    <span id="chat_id" style="display:none">{{$rq->chat->id}}</span>
    <div id="notifation_container"class="container mb-2">
        <div class="row col-12">{{$rq->patient->firstName .' ' . $rq->patient->lastName}} </br></div>
        <div class="container row">
            <div class="col-6"><img class="rounded-circle" width ="60" src="{{url('uploads/patien/' . $rq->patient->image)}}"></div>
            <div class="col-12 mr-0">
                
                <form class="col-5" id="form_accept_request" action="" method="" style="display:inline-block">
                    {{ csrf_field() }}
                    <input type="hidden" name="nurse_id" value="{{$nurse->id}}">
                    <input type="hidden" name="request_id" value="{{$rq->id}}">
                    <input id="btn_accept_request" type="submit" value="Accept" class="col-12 m-2 btn btn-success">
                </form>    
                <form class="col-5" id="form_decline_request" action="" method="" style="display:inline-block">
                    {{ csrf_field() }}
                    <input type="hidden" name="nurse_id" value="{{$nurse->id}}">
                    <input type="hidden" name="request_id" value="{{$rq->id}}">
                    <input id="btn_decline_request" type="submit" {{$rq->is_accept == true ? 'disabled' : ''}} value="Decline" class="col-12 m-2 btn btn-danger">
                </form>       
            </div>
        </div>
    </div>
    @endforeach
@endif