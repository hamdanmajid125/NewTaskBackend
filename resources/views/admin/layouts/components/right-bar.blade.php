<div class="right-bar">
    <div id="sidebarRight">
        <div class="right-bar-inner">
            <div class="text-end position-relative">
                <a href="#" class="d-inline-block d-xl-none btn right-bar-btn waves-effect waves-circle btn btn-circle btn-danger btn-sm">
                <i class="mdi mdi-close"></i>
                </a>
            </div>
            <div class="right-bar-content">
                @php
                    $post= App\Models\Post::latest()->take(3)->get();
                @endphp
                <h2>Recent Posts</h1>
                @if (!$post->isEmpty())
                    @foreach ($post as $item)
                    <div class="box no-shadow box-bordered border-light">
                        <div class="box-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4>{{ $item->name }}</h4>
                                    
                                    <p class="text-dark">{{ $item->description }}</p>
                                    @foreach ($item->images as $image)
                                    <a data-fancybox="gallery"
                                        href="{{ asset($image->image) }}">
                                        <img class="img-fluid col-md-4"
                                            src="{{ asset($image->image) }}"
                                            alt="">
                                    </a>
                                @endforeach
                                </div>
                                <div class="p-10">
                                    <!-- <div id="chart-spark1"></div> -->
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    @endforeach
                @endif
               
               
               
            </div>
        </div>
    </div>
</div>