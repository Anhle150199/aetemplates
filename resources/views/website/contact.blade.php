@extends('layouts.website')
@section('title', 'Contact Page')
@push('css')
@endpush
<?php function timePost($time)
{
    return date('F d, Y', strtotime($time));
} ?>
@section('content')
    <div class="about-area2 gray-bg pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3">
                    <h2 class="contact-title">Get in Touch</h2>
                    @if ($errors->any())
                        {!! implode('', $errors->all('<small class="text-danger">:message</small><br/>')) !!}
                    @endif
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="{{ route('send-contact') }}" method="post"
                        id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter Message'" placeholder="Enter Message"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control error" name="name" id="name" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'"
                                        placeholder="Enter your name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="email" id="email" type="email"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'"
                                        placeholder="Enter email address" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'"
                                        placeholder="Enter Subject">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                        </div>
                    </form>
                </div>
                @include('layouts.navbars.slidebarWebsite')
            </div>
        </div>
    </div>
@endsection
