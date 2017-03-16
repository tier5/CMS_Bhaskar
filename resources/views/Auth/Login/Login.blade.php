@extends('Auth.AuthMaster')

@section('content')
<!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Login</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                 
                  
                        
                    <form action="{{route('login')}}" method="POST">
                        {{csrf_field()}}
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" placeholder="Name" name="name" id="name" value="{{old('name')}}" required >
                                <p class="help-block text-danger" ></p>
                            </div>
                        </div>
                    
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                                <p class="help-block text-danger" ></p>
                            </div>
                        </div>
                        <br>
                        <div id="success">  
                        @if(Session::has('Invalid_User'))
                        <div class='alert alert-danger'>
                        <strong><center>{{Session::get('Invalid_User')}}</center></strong>
                        </div>
                        @endif
                        @if(Session::has('Validation_Required'))
                        <div class='alert alert-danger'>
                        <strong><center>{{Session::get('Validation_Required')}}</center></strong>
                        </div>
                        @endif
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                <center><button type="Submit" class="btn btn-primary btn-xl page-scroll" id="Submit">Log-In</button></center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection