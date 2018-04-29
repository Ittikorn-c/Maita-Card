@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-6" style="margin:0 auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Confirmation Success!!</h3>
                    </div>
                    <div class="card-body">
                        Now, your account is available. <br>
                        @if($user->role === "customer")
                        Let's collect points for your goal.
                        @elseif($user->role === "owner")
                        Let's create your shop and manage them.
                        @else
                        Let's work with a good time.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection