@extends('user.layouts.main')
@section('title', 'Dashboard')
@section('content')
    @include('user.components.header')
    <main>
        <div class="main-section">
            <div class="container">
                <div class="main-section-data">
                    <div class="row">
                        <div class="col-lg-3">
                            @include('user.components.sidebar')
                        </div>
                        <div class="col-lg-9">
                            <div class="main-ws-sec">
                                <div class="posts-section">
                                    @if (Request::segment(2) != 'post-filter')
                                        <ul class="nav nav-pills nav-justified mb-3 tabs-my" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill"
                                                    href="#pills-home" role="tab" aria-controls="pills-home"
                                                    aria-selected="true">All Post</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                                    href="#pills-profile" role="tab" aria-controls="pills-profile"
                                                    aria-selected="false">My Post</a>
                                            </li>
                                        </ul>
                                    @else
                                        <div class="allpost">
                                            <a href="{{ route('user.dashboard') }}">All Posts</a>
                                        </div>
                                    @endif


                                    <div class="create-new-post">
                                        <div class="container">
                                            <form action="{{ route('post.store') }}" method="POST"
                                                enctype="multipart/form-data">

                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <div class="profile-section">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <img src="{{ asset(Auth::user()->image) }}"
                                                                        alt="" class="post-user-img">
                                                                    <div class="user-details">
                                                                        <p class="user-name">
                                                                            {{ ucwords(Auth::user()->name) }}</p>
                                                                        <span class="badge badge-pill badge-success">New
                                                                            Member</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="float-right">

                                                                        <span class="btn fileinput-button">
                                                                            + Add Files
                                                                            <input type="file" id="images-upload"
                                                                                name="images[]" accept="jpeg/png"
                                                                                multiple="multiple">
                                                                        </span>
                                                                    </div>


                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Job Title" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <select class="form-control" name="available" id="available"
                                                            required>
                                                            <option value="0">Select Availability</option>
                                                            @foreach ($available as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <select class="form-control" name="type" id="type" required>
                                                            <option value="0">Select Job Type</option>
                                                            @foreach ($jobs_type as $item)
                                                                <option value="{{ $item->id }}">{{ $item->job }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-control" name="country" id="country" required>
                                                            <option value="0">Select Country</option>
                                                            @foreach ($country as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="col-md-6" style="margin-bottom: 10px">
                                                        <input type="number" step="0.01" name="pay"
                                                            placeholder="Enter Pay Amount in ($)/hr" class="form-control">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <select name="tags[]" data-placeholder="Job Skills" multiple
                                                            class="form-control chosen-select" required>
                                                            @foreach ($tags as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <textarea name="description" class="form-control" placeholder="Job Description" id="post" cols="30"
                                                            rows="10"></textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="card white" style="display: none">
                                                            <div id="images"></div>
                                                            <div class="store"></div>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-12 text-center">
                                                        <button class="btn" type="submit" id="submit-post">
                                                            Post</button>

                                                    </div>


                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                    <hr id="seperator">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                            aria-labelledby="pills-home-tab">
                                            @if (!$post->isEmpty())
                                                @foreach ($post as $item)
                                                    <div class="posty">
                                                        <div class="post-bar">
                                                            <div class="post_topbar">
                                                                <div class="usy-dt">
                                                                  
                                                                    <img class="post-user-img"
                                                                        src="{{ asset($item->user->image) }}"
                                                                        alt="">
                                                                    <div class="usy-name">
                                                                        <h3>{{ $item->user->name }}</h3>
                                                                        <span><img src="{{ asset('images/clock.png') }}"
                                                                                alt="">{{ $item->updated_at->diffForHumans() }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="ed-opts">
                                                                    <a href="#" title=""
                                                                        class="ed-opts-open"><i
                                                                            class="la la-ellipsis-v"></i></a>
                                                                    <ul class="ed-options">
                                                                        <li><a href="#" title="">Edit Post</a>
                                                                        </li>
                                                                        <li><a href="#" title="">Unsaved</a>
                                                                        </li>
                                                                        <li><a href="#" title="">Unbid</a>
                                                                        </li>
                                                                        <li><a href="#" title="">Close</a>
                                                                        </li>
                                                                        <li><a href="#" title="">Hide</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="epi-sec">
                                                                <ul class="descp">
                                                                    <li><img src="{{ asset('images/icon8.png') }}"
                                                                            alt=""><span>{{ $item->job_types->job }}</span>
                                                                    </li>
                                                                    <li><img src="{{ asset('images/icon9.png') }}"
                                                                            alt=""><span>{{ $item->country->name }}</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="job_descp">
                                                                <h3>{{ $item->name }}</h3>
                                                                <ul class="job-dt">
                                                                    <li><a href="#"
                                                                            title="">{{ $item->availability->name }}</a>
                                                                    </li>
                                                                    <li><span>${{ $item->pay }} / hr</span></li>
                                                                </ul>
                                                                <p>{{ $item->description }}</p>
                                                                @if (!$item->images->isEmpty())
                                                                    <div class="images">
                                                                        @foreach ($item->images as $image)
                                                                            <a data-fancybox="gallery"
                                                                                href="{{ asset($image->image) }}">
                                                                                <img class="img-fluid col-md-4"
                                                                                    src="{{ asset($image->image) }}"
                                                                                    alt="">
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                                <ul class="skill-tags">
                                                                    @foreach ($item->tags as $skill)
                                                                        <li><a href="#"
                                                                                title="">{{ $skill->name }}</a>
                                                                        </li>
                                                                    @endforeach

                                                                </ul>
                                                            </div>
                                                            <div class="job-status-bar">
                                                                <ul class="like-com">
                                                                    <li>
                                                                        <a href="#" class="active"><i
                                                                                class="fas fa-heart"></i> Like</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="no-items">
                                                    <p>No Post Found</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                            aria-labelledby="pills-profile-tab">
                                            @if (!Auth::user()->posts->isEmpty())
                                                @foreach (Auth::user()->posts as $item)
                                                    <div class="post-bar ">

                                                        <div class="post_topbar">
                                                            <div class="usy-dt">
                                                                <img class="post-user-img"
                                                                    src="{{ asset($item->user->image) }}" alt="">
                                                                <div class="usy-name">
                                                                    <h3>{{ $item->name }}</h3>
                                                                    <span><img src="{{ asset('images/clock.png') }}"
                                                                            alt="">{{ $item->updated_at->diffForHumans() }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="ed-opts">
                                                                <a href="#" title="" class="ed-opts-open"><i
                                                                        class="la la-ellipsis-v"></i></a>
                                                                <ul class="ed-options">
                                                                    <li><a href="#" title="">Edit Post</a>
                                                                    </li>
                                                                    <li><a href="#" title="">Unsaved</a></li>
                                                                    <li><a href="#" title="">Unbid</a></li>
                                                                    <li><a href="#" title="">Close</a></li>
                                                                    <li><a href="#" title="">Hide</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="epi-sec">
                                                            <ul class="descp">
                                                                <li><img src="{{ asset('images/icon8.png') }}"
                                                                        alt=""><span>{{ $item->job_types->job }}</span>
                                                                </li>
                                                                <li><img src="{{ asset('images/icon9.png') }}"
                                                                        alt=""><span>{{ $item->country->name }}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="job_descp">
                                                            <h3>{{ $item->name }}</h3>
                                                            <ul class="job-dt">
                                                                <li><a href="#"
                                                                        title="">{{ $item->availability->name }}</a>
                                                                </li>
                                                                <li><span>${{ $item->pay }} / hr</span></li>
                                                            </ul>
                                                            <p>{{ $item->description }}</p>
                                                            @if (!$item->images->isEmpty())
                                                                <div class="images">
                                                                    @foreach ($item->images as $image)
                                                                        <a data-fancybox="gallery"
                                                                            href="{{ asset($image->image) }}">
                                                                            <img class="img-fluid col-md-4"
                                                                                src="{{ asset($image->image) }}"
                                                                                alt="">
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                            <ul class="skill-tags">
                                                                @foreach ($item->tags as $skill)
                                                                    <li><a href="#"
                                                                            title="">{{ $skill->name }}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <div class="job-status-bar">
                                                            <ul class="like-com">
                                                                <li>
                                                                    <a href="#" class="active"><i
                                                                            class="fas fa-heart"></i> Like</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="no-items">
                                                    <p>No Post Found</p>
                                                </div>
                                            @endif


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>

@endsection
@push('js')
    <script>
        $(document).ready(function() {

            $(".images.row a").fancybox();
        });
    </script>
    <script>
        function gphoto(input, ImagePreview) {
            var files = input.files;
            var filesArr = Array.prototype.slice.call(files);

            filesArr.forEach(function(f) {
                if (!f.type.match("image.*")) {
                    return;
                }
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(ImagePreview).css('margin-top', '4px');
                    $($.parseHTML('<img class="gphoto" width="75px" height="75px">')).attr('src', e.target
                        .result).appendTo(ImagePreview);
                    $($.parseHTML('<input type="hidden" name="photos[]">')).attr('value', e.target.result)
                        .appendTo($('.store'));
                };
                reader.readAsDataURL(f);
            });
        }

        $('#images-upload').change(function(e) {
            gphoto(this, '#images');
            $('.card.white').slideDown();
        });
    </script>
@endpush
@push('css')
    <style>
        .card.white {
            padding: 15px;
            border-radius: 30px;
            margin-top: 10px;
        }

        hr#seperator {
            background: #e44d3a;
            height: 1px;
        }

        .fileinput-button {
            position: relative;
            overflow: hidden;
            display: inline-block;
            background: #e44d3a;
            color: white;
            margin-top: 15px;
        }

        .fileinput-button input {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            height: 100%;
            opacity: 0;
            filter: alpha(opacity=0);
            font-size: 200px !important;
            direction: ltr;
            cursor: pointer;
        }

        /* Fixes for IE < 8 */
        @media screen\9 {
            .fileinput-button input {
                font-size: 150% !important;
            }
        }

        div#images img {
            margin-right: 10px;
        }
    </style>
@endpush
