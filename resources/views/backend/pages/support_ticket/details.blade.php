@extends('backend.template.master')
@section('dynamic_title','Dashboard')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Support</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('ticket.index')}}" class="btn btn-sm btn-primary">Back</a>
                            @if(auth()->user()->user_type==0 && $support->current_status ==1)
                                <button value = "{{$support->id}}" class="ml-2 btn btn-sm btn-danger ticket_close_btn">Close This Ticket</button>
                            @endif
                            @if($support->current_status ==0)
                                <span class="text-danger">This Support is closed at {{\App\Http\CustomClass\OwnClass::DateTimeFormater($support->statuses[0]->created_at)}}</span>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="callout callout-info">
                                        <h5 class="text-muted">{{\App\Http\CustomClass\OwnClass::DateTimeFormater($support->created_at)}} By {{$support->creator->name}}</h5>
                                        <p>{{$support->issue_details}}</p>
                                    </div>
                                    @if(!$support->replies->isEmpty())
                                        @foreach($support->replies as $data)
                                            <div class="callout @if($data->creator->user_type == 0) text-right callout-success @else callout-info @endif">
                                                <h5 class="text-muted">{{\App\Http\CustomClass\OwnClass::DateTimeFormater($data->created_at)}} By {{$data->creator->name}}</h5>
                                                <p>{{$data->reply}}</p>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            @if($support->current_status ==1)
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{route('ticket.reply',$support->id)}}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="issue_details">Replay</label>
                                                <textarea id="reply" name="reply" class="form-control" rows="5" required></textarea>
                                                @if ($errors->has('reply'))
                                                    <small class="text-danger">{{ $errors->first('reply') }}</small>
                                                @endif
                                            </div>

                                            <button type="submit" class="btn btn-primary">Reply</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('.ticket_close_btn').click(function (){
                if (confirm('Are you sure you want to close this ticket?')) {
                    let ticketId = $(this).val();
                    $.ajax({
                        url: '{{ route("ticket.ticketClose") }}',
                        type: 'POST',
                        data: {
                            ticket_id: ticketId
                        },
                        success: function(response){
                            if(response.status==="success"){
                                toastr.success(response.message)
                                location.reload();
                            }
                            else{
                                toastr.error(response.message)
                                location.reload();
                            }

                        },
                        error: function(xhr) {
                            alert('Error closing ticket: ' + xhr.responseJSON.message);
                        }
                    });
                }
            })
        });
    </script>
@endpush

