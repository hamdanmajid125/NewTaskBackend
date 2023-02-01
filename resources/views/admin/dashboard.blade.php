@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xxxl-3 col-lg-6 col-12">
                <div class="box">
                    <div class="box-body">
                        <div class="d-flex align-items-center">
                            <div class="box-icon">
                                <i class="icon-Image"></i>
                            </div>
                            <div>
                                <h2 class="my-0 font-weight-700">{{ App\Models\Post::count() }}</h2>
                                <p class="text-fade mb-0">Total Post</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xxxl-3 col-lg-6 col-12">
                <div class="box">
                    <div class="box-body">
                        <div class="d-flex align-items-center">
                            <div class="box-icon">
                                <i class="icon-Image"></i>
                            </div>
                            <div>
                                <h2 class="my-0 font-weight-700">{{ App\Models\Tag::count() }}</h2>
                                <p class="text-fade mb-0">Total Skills Tags</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-xxxl-4 col-lg-6 col-12">
                <div class="box">
                    <div class="box-body">
                        <div class="d-flex align-items-center">
                            <div class="box-icon">
                                <i class="icon-Image"></i>
                            </div>
                            <div>
                                <h2 class="my-0 font-weight-700">{{ App\Models\JobType::count() }}</h2>
                                <p class="text-fade mb-0">Total Jobs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </section>
@endsection




@push('css')
    <style>
        p {
            color: whitesmoke;
        }
    </style>
@endpush
