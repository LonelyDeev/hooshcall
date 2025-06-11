@extends('front.layouts.master')

@section('title', 'تماس با ما')

@section('content')
<div class="container py-5">
    <!-- اطلاعات تماس -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 10px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <div class="contact-info-item">
                                <i class="fas fa-map-marker-alt fa-3x text-primary mb-3"></i>
                                <h4 class="h5 mb-2">آدرس</h4>
                                <p class="text-muted mb-0">{{option('info_address')}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <div class="contact-info-item">
                                <i class="fas fa-phone fa-3x text-primary mb-3"></i>
                                <h4 class="h5 mb-2">تلفن تماس</h4>
                                <p class="text-muted mb-0">{{option('info_phone')}}</p>
                                <p class="text-muted mb-0">{{option('info_phone2')}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="contact-info-item">
                                <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                                <h4 class="h5 mb-2">ایمیل</h4>
                                <p class="text-muted mb-0">{{option('info_email')}}</p>
                                <p class="text-muted mb-0">{{option('info_email2')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- فرم تماس -->
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="h4 mb-0">فرم تماس با ما</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('front.contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">نام و نام خانوادگی <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">شماره تماس <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">ایمیل <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">پیام <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">ارسال پیام</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(option('info_google_map'))
    <!-- نقشه -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3237.1234567890123!2d51.12345678901234!3d35.12345678901234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzXCsDA3JzI0LjQiTiA1McKwMDcnMjQuNCJF!5e0!3m2!1sen!2s!4v1234567890123!5m2!1sen!2s"
                            width="100%"
                            height="450"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('styles')
<style>
.contact-info-item {
    padding: 2rem;
    height: 100%;
    transition: all 0.3s ease;
}
.contact-info-item:hover {
    transform: translateY(-5px);
}
.contact-info-item i {
    color: var(--bs-primary);
    margin-bottom: 1rem;
}
.form-label {
    font-weight: 500;
}
.btn-primary {
    padding: 0.75rem 2rem;
    font-weight: 500;
}
.text-primary{
    color: rgb(21, 167, 171) !important;
}
</style>
@endpush
@endsection