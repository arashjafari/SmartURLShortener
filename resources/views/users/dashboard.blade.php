@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body"> 
                    
                @if(count($data) == 0)
                    <div class="alert alert-info" role="alert">
                    {{ __('There is no information to display!') }}
                    </div>
                @else 
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('URL') }}</th>
                            <th scope="col">{{ __('Short') }}</th>
                            <th scope="col">{{ __('Expire date') }}</th>
                            <th scope="col">{{ __('Click limitation') }}</th>
                            <th scope="col">{{ __('Total clicks') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->url }}</td> 
                            <td>{{ config('app.url') }}/{{ $item->custom }}</td> 
                            <td>{{ $item->expire_at }}</td>  
                            <td>{{ is_null($item->total_uses) ? '~' : $item->used . '/' . $item->total_uses }}</td>                             
                            <td>{{ $item->used }}</td> 
                            <td>
                                <a href="{{ route('user.stats', ['id' => $item->id ]) }}">{{ __('Stats') }}</a>
                            </td>
                        </tr>
                        @endforeach 
                        </tbody>
                    </table>
 
                @endif

                {!! $data->links() !!}

                </div> 
            </div> 
        </div>
    </div>
</div>
@endsection
