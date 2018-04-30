@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>{{ $shop_name }} customers</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Age</th>
                            <th scope="col">Our Cards</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href='{{ url("/owner/report/customers/$shop_id/$customer->id") }}'>{{ $customer->fname . " " . $customer->lname }}</a></td>
                                <td>{{ $customer->gender }}</td>
                                <td>{{ $customer->age() }}</td>
                                <td>{{ $customer->shop_card->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection