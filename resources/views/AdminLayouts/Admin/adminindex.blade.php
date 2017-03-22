    @extends('AdminLayouts.master')

    @section('content')
    <script>
    $(document).ready(function(){

        setInterval(function(){ loadtable() },3000);
    });

    function loadtable()
    {
        $('#table').load(window.location + ' #table');
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

                                    <tr class="active">
                                        <td>/index.html</td>
                                        <td>1265</td>
                                        <td>32.3%</td>
                                        <td>$321.33</td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                    </tr>
                                    <tr class="success">
                                        <td>/about.html</td>
                                        <td>261</td>
                                        <td>33.3%</td>
                                        <td>$234.12</td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                    </tr>
                                    @if(isset($clients))
                                    @foreach($clients as $client)
                                    @if($client->status==1)
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
                                    @endforeach
                                    @endif
                                    <tr class="warning">
                                    
                                        <td>/blog.html</td>
                                        <td>9516</td>
                                        <td>89.3%</td>
                                        <td>$1644.43</td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                    </tr>
                                    <tr>
                                        <td>/404.html</td>
                                        <td>23</td>
                                        <td>34.3%</td>
                                        <td>$23.52</td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                    </tr>
                                    <tr>
                                        <td>/services.html</td>
                                        <td>421</td>
                                        <td>60.3%</td>
                                        <td>$724.32</td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                    </tr>
                                    <tr>
                                        <td>/blog/post.html</td>
                                        <td>1233</td>
                                        <td>93.2%</td>
                                        <td>$126.34</td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                    </tr>
                                            
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
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Page</th>
                                        <th>Visits</th>
                                        <th>% New Visits</th>
                                        <th>Revenue</th>
                                        <th>Throw/Accept</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="active">
                                        <td>/index.html</td>
                                        <td>1265</td>
                                        <td>32.3%</td>
                                        <td>$321.33</td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                    </tr>
                                    <tr class="success">
                                        <td>/about.html</td>
                                        <td>261</td>
                                        <td>33.3%</td>
                                        <td>$234.12</td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                    </tr>
                                    <tr class="warning">
                                        <td>/sales.html</td>
                                        <td>665</td>
                                        <td>21.3%</td>
                                        <td>$16.34</td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                    </tr>
                                    <tr class="danger">
                                        <td>/blog.html</td>
                                        <td>9516</td>
                                        <td>89.3%</td>
                                        <td>$1644.43</td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                    </tr>
                                    <tr>
                                        <td>/404.html</td>
                                        <td>23</td>
                                        <td>34.3%</td>
                                        <td>$23.52</td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                    </tr>
                                    <tr>
                                        <td>/services.html</td>
                                        <td>421</td>
                                        <td>60.3%</td>
                                        <td>$724.32</td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                    </tr>
                                    <tr>
                                        <td>/blog/post.html</td>
                                        <td>1233</td>
                                        <td>93.2%</td>
                                        <td>$126.34</td>
                                        <td><button type="button" class="btn btn-sm btn-danger">Danger</button></td>
                                    </tr>
                                    
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