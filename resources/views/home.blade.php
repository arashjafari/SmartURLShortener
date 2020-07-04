@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Paste the URL to be shortened') }}</div>

                <div class="card-body"> 
                    <form action="{{ route('create') }}" method="POST" > 
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <div class="input-group"> 
                                    <label for="url" class="sr-only">{{ __('Enter the link here') }}</label>
                                    <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="Enter the link here" value="{{ old('url') }}" pattern="{{ '(http[s]?:\/\/)[^\s(["<,>]*\.[^\s[",><]*' }}" required>

                                    <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">{{ __('Shorten URL') }}</button>
                                    </div>
                                    @error('url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                              <label for="customUrl">Custom URL</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ config('app.url') }}/</span>
                                </div>
                                <input type="text" class="form-control @error('customUrl') is-invalid @enderror" id="customUrl" name="customUrl" value="{{ old('customUrl') }}"  maxlength="25" pattern="[A-Za-z\d\-]{3,}" title="Custom must be between 3 and 50 characters long. You can use letters, numbers & dashes">
                                @error('customUrl')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                              </div> 
                            </div>
                            <div class="col-md-3 mb-3">
                              <label for="totalUses">{{ __('Total Uses') }}</label>
                              <input type="number" class="form-control @error('totalUses') is-invalid @enderror" id="totalUses" name="totalUses" value="{{ old('totalUses') }}"  min="0" max="100000">
                              @error('totalUses')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                              <label for="expiredDate">Expired Date</label>
                              <input type="text" class="form-control @error('expiredDate') is-invalid @enderror" id="expiredDate" name="expiredDate" value="{{ old('expiredDate') }}"  placeholder="YYY/MM/DD HH:mm" pattern="\d{4}\/\d{2}\/\d{2} \d{2}:\d{2}" >
                              @error('expiredDate')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                        </div>

                        @if (session('shortLink'))
                            <div class="alert alert-success">
                                {{ session('shortLink') }}
                            </div>
                        @endif
 
                    </form> 

                </div> 
            </div> 
        </div>
    </div>
</div>
@endsection
