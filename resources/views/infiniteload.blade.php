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
            var page = 1;
            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() + 1 > $(document).height()) {
                    page++;
                    getData(page);
                }
            });

            function getData(page) {
                var formData = {
                    page: page,
                    "_token": "{{ csrf_token() }}",
                }
                $.ajax({
                    type: 'POST',
                    url: "{{ route('infinite.load') }}",
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
        });
    </script>
</body>

</html>
