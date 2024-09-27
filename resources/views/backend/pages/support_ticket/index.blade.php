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
                            <a href="{{route('ticket.add')}}" class="btn btn-sm btn-primary">Add New</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Issue</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>...</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets  as $item)
                                        <tr>
                                            <td>{{$item?->creator?->name}}</td>
                                            <td>{{\Illuminate\Support\Str::limit($item?->issue_details,50)}}</td>
                                            <td>
                                                @if($item->current_status == 1)
                                                    <span class=" badge badge-success">Open</span>
                                                @else
                                                    <span class="badge badge-danger">Close</span>
                                                @endif

                                            </td>
                                            <td>{{\App\Http\CustomClass\OwnClass::DateTimeFormater($item?->created_at)}}</td>
                                            <td><a title="Details" href="{{route('ticket.details',$item->id)}}" class="btn btn-sm btn-info"> <span class="fa fa-eye"></span></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

    </script>
@endpush

