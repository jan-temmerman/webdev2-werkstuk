<!DOCTYPE html>
<html>
<head>
    <title>Get Credits</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="stripe-token" content="{{ env('STRIPE_KEY') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/stripe-demo.css') }}">
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const creditRatio = {{env('CREDIT_RATIO')}};
    </script>
</head>
<body>
@include('partials.header')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Get credits</h3>
                        <div class="display-td" >
                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('user.post_payment') }}" method="post" id="payment-form">
                        <div class="form-group">
                            <label class="control-label" for="inpCredits">Amount of credits</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-gem"></i></span>
                                <input type="number" class="form-control" name="credits" id="inpCredits">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="inpCost">Price</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-euro-sign"></i></span>
                                <input type="text" class="form-control" name="cost" disabled id="inpCost">
                            </div>
                        </div>

                        @csrf
                        <div class="form-group">
                            <label for="card-element">
                                Credit/Debit Cardnumber
                            </label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>

                        <button class="btn btn-primary">
                            Confirm payment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.footer')
<script>
	let convertUrl = '{{ route('api.convert') }}';
</script>
<script src="{{ asset('js/stripe-demo.js') }}"></script>
</body>
</html>