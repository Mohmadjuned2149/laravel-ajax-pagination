<div id="load" style="position: relative;">
    <!-- Example single danger button -->
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="th">#</th>
                <th scope="col" class="th">First name</th>
                <th scope="col" class="th">Last name</th>
                <th scope="col" class="th">Email</th>
                <th scope="col" class="th">DOB</th>
            </tr>
        </thead>
        <tbody id='table'>
            @foreach ($employee as $emplyees)
                <tr>
                    <th scope="row">{{ $emplyees->id }}</th>
                    <td>{{ $emplyees->firstname }}</td>
                    <td>{{ $emplyees->lastname }}</td>
                    <td>{{ $emplyees->email }}</td>
                    <td>{{ $emplyees->dob }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

