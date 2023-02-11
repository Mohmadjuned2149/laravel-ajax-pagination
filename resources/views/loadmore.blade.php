<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Pagination with jQuery Ajax Request</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>
    @include('navbar')
    <div class="container" style="max-width: 700px;">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <span class="text-secondary">Laravel Pagination with jQuery Ajax Request</span>
        </div>
        @if (count($employee) > 0)
            <section class="posts">
                @include('load_posts_data')
                <button class="btn btn-dark float-right" id="load_more">Load More</button>
            </section>
        @else
            No data found
        @endif
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#records").change(function(e) {
                e.preventDefault();
                getData();
            });
            $(document).on('click', "a.page-link", function(e) {
                e.preventDefault();
                var page_no = $(this).attr("id");
                getData(page_no);
            })

            function getData(page) {
                var records_per_page = $("#records").val();
                var formData = {
                    page_no: page,
                    records_per_page: records_per_page,
                    "_token": "{{ csrf_token() }}",
                }
                $.ajax({
                    type: 'POST',
                    url: "{{ route('ajax.data') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        var html = ""
                        $.each(data.data, function(index, value) {
                            html += `<tr>
                        <th scope='row'>${value.id}</th>
                        <td>${value.firstname}</td>
                        <td>${value.lastname}</td>
                        <td>${value.email}</td>
                        <td>${value.dob}</td>
                      </tr>`
                        });
                        $("#table").html(html);
                    },
                    error: function(errors) {}
                });
            }

            
            var last_record = 10;
            $("#load_more").click(function(e) {
                e.preventDefault();
                 last_record += 10;

                 var formData = {
                    last_record:last_record,
                    "_token": "{{ csrf_token() }}"
                 }
                 console.log(formData)
                $.ajax({
                    type: 'POST',
                    url: "{{ route('load.more') }}",
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        var html = ""
                        $.each(data.data, function(index, value) {
                            html += `<tr>
                        <th scope='row'>${value.id}</th>
                        <td>${value.firstname}</td>
                        <td>${value.lastname}</td>
                        <td>${value.email}</td>
                        <td>${value.dob}</td>
                      </tr>`
                        });
                        $("#table").html(html);
                    },
                    error: function(errors) {}
                });

            });

            $("#search").on( "keyup",function(e) {
                e.preventDefault();
                //AJAX Setup
             
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var value = $(this).val();
                console.log(value)
                var formData = {
                    search: value,
                    "_token": "{{ csrf_token() }}",
                }
                $.ajax({
                    type: 'POST',
                    url: "{{ route('load.more') }}",
                    data: formData,
                    success: function(data) {
                        var html = ""
                        $.each(data.data, function(index, value) {
                            html += `<tr>
               <th scope='row'>${value.id}</th>
               <td>${value.firstname}</td>
               <td>${value.lastname}</td>
               <td>${value.email}</td>
               <td>${value.dob}</td>
               </tr>`
                        });
                        $("#table").html(html);
                    }
                });

            });

        });
    </script>
</body>

</html>
