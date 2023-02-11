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
       url: "{{ route('infinite.load') }}",
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