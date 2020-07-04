@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Paste the URL to be shortened') }}</div>

                <div class="card-body"> 
                    <form action="" method="POST" > 
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <div class="input-group"> 
                                    <label for="q" class="sr-only">{{ __('Enter the link here') }}</label>
                                    <input type="text" class="form-control" id="q" name="q" placeholder="Enter the link here" pattern="{{ '(http[s]?:\/\/)[^\s(["<,>]*\.[^\s[",><]*' }}" required>

                                    <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">{{ __('Shorten URL') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                              <label for="customURL">Custom URL</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ config('app.url') }}/</span>
                                </div>
                                <input type="text" class="form-control" id="customURL" name="customURL" maxlength="25" pattern="[A-Za-z\d\-]{3,}" title="Custom must be between 3 and 50 characters long. You can use letters, numbers & dashes">
                              </div>
                              <div class="invalid-feedback">
                                {{ __('Please enter a valid custom URL.') }}
                              </div>
                            </div>
                            <div class="col-md-3 mb-3">
                              <label for="totalUses">{{ __('Total Uses') }}</label>
                              <input type="number" class="form-control" id="totalUses" name="totalUses" min="0" max="100000">
                              <div class="invalid-feedback">
                                {{ __('Please enter a valid total uses.') }}
                              </div>
                            </div>
                            <div class="col-md-4 mb-3">
                              <label for="expiredDate">Expired Date</label>
                              <input type="text" class="form-control" id="expiredDate" name="expiredDate" placeholder="YYY/MM/DD HH:mm" pattern="\d{4}\/\d{2}\/\d{2} \d{2}:\d{2}" >
                              <div class="invalid-feedback">
                                {{ __('Please enter a valid expired date.') }}
                              </div>
                            </div>
                        </div>

                    </form> 

                </div> 
            </div> 
        </div>
    </div>
</div>
@endsection
