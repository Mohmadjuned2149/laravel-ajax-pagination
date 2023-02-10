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
            pagination()
            $("#records").change(function(e) {
                e.preventDefault();
                pagination();
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

            function pagination(){
                $.ajax({
                type: 'GET',
                url: "{{ route('total.records') }}",
                success: function(data) {
                    console.log(data.total)
                    var records_per_page = $("#records").val();
                    var pages = Math.ceil(data.total / records_per_page)
                    var html = `<nav aria-label='Page navigation example'><ul class='pagination'>`
                    for (i = 1; i <= pages; i++) {
                        html +=
                            `<li class='page-item' ><a class='page-link' href='#' id='${i}'>${i}</a></li>`
                    }
                    html += `</ul></nav>`
                    $('#pagination').html(html);
                },
                error: function(errors) {
                    console.log(errors)
                }
            });
            }

        });
    </script>
</body>

</html>
