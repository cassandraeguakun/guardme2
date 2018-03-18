@extends('app::layouts.pages.others')

@section('page')
    <section>
        <div class="block curve no-padding">
            <div data-velocity="-.2" style="background: url(/assets/img/security_lady_man.jpg) 50% 50% transparent;"
                 class="layer blackish parallax scrolly-invisible no-parallax uk-background-center-center uk-background-cover">
            </div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-header">
                            <span class="white"><span class="fg-site-blue">Guard</span><span class="fg-site-green">Me</span></span>
                            <h2>Post New Job</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block">
            <div class="container">
                @yield('new-job')
            </div>
        </div>
    </section>

    @include('app::partials.splashscreen')
@endsection

@push('styles')

@endpush

@push('scripts')
    <script src="/build/js/create-job.min.js"></script>
    <script>
        $('.ui.radio.checkbox')
            .checkbox()
        ;
        $('.ui.dropdown')
            .dropdown()
        ;


    </script>
@endpush