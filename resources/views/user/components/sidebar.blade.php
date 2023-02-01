    @php
        $max = App\Models\Post::max('pay');
        $min = App\Models\Post::min('pay');
        
    @endphp
    <form action="{{ route('post.filter') }}" action="GET">
        <div class="filter-secs">
            <div class="filter-heading">
                <h3>Filters</h3>
                <a href="#" title="">Clear all filters</a>
            </div>
            <div class="paddy">
                <div class="filter-dd">
                    <div class="filter-ttl">
                        <h3>Skills</h3>
                    </div>
                    <select name="skills[]" multiple class="form-control form-control-sm chosen-select"
                        data-placeholder="Search Skills">
                        @foreach ($tags as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-dd">
                    <div class="filter-ttl">
                        <h3>Availabilty</h3>
                    </div>
                    <ul class="avail-checks">
                        @foreach ($available as $item)
                            <li>
                                <input type="radio" value="{{ $item->id }}" name="available"
                                    id="{{ 'available' . $item->id }}">
                                <label for="{{ 'available' . $item->id }}">
                                    <span></span>
                                </label>
                                <small>{{ $item->name }}</small>
                            </li>
                        @endforeach


                    </ul>
                </div>
                <div class="filter-dd">
                    <div class="filter-ttl">
                        <h3>Job Type</h3>
                    </div>
                    <select class="form-control form-control-sm">
                        @foreach ($jobs_type as $item)
                            <option value="{{ $item->id }}">{{ $item->job }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-dd">
                    <div class="filter-ttl">
                        <h3>Pay Rate / Hr ($)</h3>
                    </div>
                    <div class="rg-slider">
                        <input id="max" name="max" type="hidden">
                        <input id="min" name="min" type="hidden">
                        <input class="rn-slider slider-input" name="pay" type="range"
                        min={{ $min }} max={{ $max }}>
                    </div>
                    <div class="rg-limit">
                        <h4>{{ $min }}</h4> 
                        <h4>{{ $max }}</h4>
                    </div>
                </div>
                <div class="filter-dd">
                    <div class="filter-ttl">
                        <h3>Countries</h3>
                    </div>
                    <select name="country" class="form-control form-control-sm">
                        @foreach ($country as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-block text-white" type="submit" 
                    style="background-color: #e44d3a;">Filter</button>
            </div>
        </div>
    </form>
@push('js')
<script>
    $('.slider-input').change(function(){
       var diff = Number('{{ $max }}') - Number('{{ $min }}');
       var max =  Number('{{ $min }}') + ((Number($('.pointer-label.low').text()) * diff) /100);
       var min =  Number('{{ $max }}') -  ((Number($('.pointer-label.high').text()) * diff) /100);
       $('#max').val(max)
       $('#min').val(min)


    })
    </script>    
@endpush