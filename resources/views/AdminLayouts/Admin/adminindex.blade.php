    @extends('AdminLayouts.master')

    @section('content')
    <script>
    $(document).ready(function(){

        setInterval(function(){ loadtable() },3000);
    });

    function loadtable()
    {
        $('#table').load(window.location + ' #table');
        $('#table2').load(window.location + ' #table2');
    }
    </script>

      <div class="row">
                   
                    <div class="col-lg-8">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-question-circle"></i>Unknown Visitorss</h3>
                            </div>
                            <div class="panel-body">
                                
                                <div class="row">
                    <div class="col-lg-6">
                        <h2>Visitors</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th>IP</th>
                                        <th>Browser Name</th>
                                        <th>Browser Platform</th>
                                        <th>Path</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Flag</th>
                                    </tr>
                                </thead>
                                <tbody>

                                   
                                    @if(isset($clients))
                                    @foreach($clients as $client)
                                    @if($client->status==1)
                                    @if($client->user_name==null)

                                    <tr class="danger">
                                        <td>{{$client->ip}}</td>
                                        <td>{{$client->browser_name}}</td>
                                        <td>{{$client->browser_platform}}</td>
                                        <td>{{$client->page}}</td>
                                        <td>{{$client->country}}</td>
                                        <td>{{$client->city}}</td>

                                        <td><img src="{{$client->flag_img}}"></td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                    </tr>
                                    @endif
                                    @endif
                                    @endforeach
                                    @endif
                    
                                        </tbody>
                                  </table>
                                
                                </div>
                            </div>
                    
                            </div>
                           
                                <div class="text-right">
                                    <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
 
 <div class="col-lg-4">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-users"></i> Known Visitors</h3>
                            </div>
                            <div class="panel-body">
                               

                                <div class="row">
                    <div class="col-lg-6">
                        <h2>Visitors</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table2">
                                <thead>
                                    <tr>
                                         
                                        <th>IP</th>
                                        <th>User Name</th>
                                        <th>Browser Name</th>
                                        <th>Browser Platform</th>
                                        <th>Path</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Flag</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    @if(isset($clients))
                                    @foreach($clients as $client)
                                    @if($client->status==1)
                                     @if($client->user_name!=null)
                                    <tr class="success">
                                        <td>{{$client->ip}}</td>
                                        <td>{{$client->user_name}}</td>
                                        <td>{{$client->browser_name}}</td>
                                        <td>{{$client->browser_platform}}</td>
                                        <td>{{$client->page}}</td>
                                        <td>{{$client->country}}</td>
                                        <td>{{$client->city}}</td>

                                        <td><img src="{{$client->flag_img}}"></td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                        <td><a href="{{route('adminchat',['id'=> $client->id ])}}"type="button" class="btn btn-sm btn-success">CHAT</button></a>
                                    </tr>
                                    @endif
                                      @endif
                                    @endforeach
                                    @endif
                                   
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>




                                <div class="text-right">
                                    <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

    

    @endsection