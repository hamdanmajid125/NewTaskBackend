<script type="text/javascript" src="{{ asset('users/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('users/js/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('users/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('users/js/jquery.range-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('users/js/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('users/js/script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
 
<script>
    $(".chosen-select").chosen({
        no_results_text: "Oops, nothing found!"
    })
</script>
<script>
    @if (\Session::has('success'))
        swal("{{ Session::get('success') }}", "", "success", {
            timer: 3000,
        })
    @endif
</script>
