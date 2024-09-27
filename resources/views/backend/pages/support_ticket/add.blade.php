@extends('backend.template.master')
@section('dynamic_title','Dashboard')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Support</h1>
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
                            <a href="{{route('ticket.index')}}" class="btn btn-sm btn-primary">List Support</a>
                        </div>

                        <div class="card-body">
                            <form action="{{route('ticket.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="issue_details">Issue Details</label>
                                    <textarea id="issue_details" name="issue" class="form-control" rows="5" required></textarea>
                                    @if ($errors->has('issue'))
                                        <small class="text-danger">{{ $errors->first('issue_details') }}</small>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
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

