@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard - Stats') }}
                    <a href="{{ Route('user.dashboard') }}">{{ __('Back') }}</a>
                </div>

                <div class="card-body"> 
                    
                @if(count($link->linkStats) == 0)
                    <div class="alert alert-info" role="alert">
                    {{ __('There is no information to display!') }}
                    </div>
                @else 
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('Date') }}</th>
                            <th scope="col">{{ __('IP') }}</th>
                            <th scope="col">{{ __('Type') }}</th>
                            <th scope="col">{{ __('Device') }}</th>
                            <th scope="col">{{ __('Platform') }}</th>
                            <th scope="col">{{ __('Browser') }}</th> 
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($link->linkStats as $item)
                        <tr>
                            <td>{{ $item->created_at }}</td> 
                            <td>{{ $item->ip }}</td> 
                            <td>
                                @if($item->is_robot == true)
                                Robot
                                @elseif($item->is_phone == true)
                                Phone
                                @elseif($item->is_desktop == true)
                                Desktop
                                @endif
                            </td>                               
                            <td>{{ $item->device_nmae }}</td>    
                            <td>{{ $item->platform_name }}</td>    
                            <td>{{ $item->browser_name }}</td> 
                            
                        </tr>
                        @endforeach 
                        </tbody>
                    </table>
 
                @endif
 

                </div> 
            </div> 
        </div>
    </div>
</div>
@endsection
