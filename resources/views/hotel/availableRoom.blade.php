<div class="container">
    <h2>Reporting</h2>
    <p>Report of currently available rooms for each hotel</p>
    <table class="table">
        <thead>
            <tr>
                <th>Hotel ID</th>
                <th>Hotel Name</th>
                <Th>Total Available Room</Th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $d->id }}</td>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->room }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
