    @extends('AdminLayouts.master')

    @section('content')
    

      <div class="row">
                   
                    <div class="col-lg-8">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-archive"></i>Chat-Logs</h3>
                            </div>
                            <div class="panel-body">
                                
                                <div class="row">
                    <div class="col-lg-6">
                        <h2>CLIENTS</h2>
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
                                    @if($client->id!=1)
                                    
                                    <tr class="default">
                                        <td>{{$client->ip}}</td>
                                        <td>{{$client->browser_name}}</td>
                                        <td>{{$client->browser_platform}}</td>
                                        <td>{{$client->page}}</td>
                                        <td>{{$client->country}}</td>
                                        <td>{{$client->city}}</td>

                                        <td><img src="{{$client->flag_img}}"></td>
                                        <td><a href="{{route('viewchatlogs',['id'=>$client->id])}}"type="button" class="btn btn-sm btn-warning">Chat Log</a></td>
                                    </tr>
                                 
                                    @endif
                                    @endforeach
                                    @endif
                    
                                        </tbody>
                                  </table>
                                <center>{{$clients->links()}}</center>
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