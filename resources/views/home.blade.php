@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Messanger</div>

                <div class="card-body" id="app">
					<Messanger :user="{{ auth()->user() }}"></Messanger>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
