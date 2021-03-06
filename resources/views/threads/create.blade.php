@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Thread</div>

                <div class="card-body">
                    <form action="/threads" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="channel_id">Choose a Channel</label>
                            <select name="channel_id" id="channel_id" class="form-control" required>
                                <option value="">Choose one..</option>
                                    @foreach($channels as $channel)
                            <option value="{{$channel->id}}"{{old('channel_id')==$channel->id ? 'selected':''}}>{{ $channel->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" value="{{ old('title')}}" required>
                        </div>
                        <div class="form-group">
                            <textarea name="body" id="" cols="30" rows="5" class="form-control" required>{{old('body')}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Publish</button>

                        <div class="form-group">
                                @if(count($errors))
                                    <ul class="alert alert-danger">
                                        @foreach($errors as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                        </div>
                    </form>

                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
