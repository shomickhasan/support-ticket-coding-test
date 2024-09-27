@extends('backend.template.master')
@section('dynamic_title','Customer')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Customer</h1>
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
                            <a href="{{route('customer.add_edit')}}" class="btn btn-sm btn-primary">Add New</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>...</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $item)
                                        <tr>
                                            <td>{{$item?->name}}</td>
                                            <td>{{$item?->email}}</td>
                                            <td>
                                                <a href="{{route('customer.add_edit',$item->id)}}" class="btn btn-sm btn-warning"> <i class="fa fa-pen-square"></i></a>
                                            </td>
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

