<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel</title>

 <!-- Bootstrap Core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="/css/creative.min.css" rel="stylesheet">
    <link href="/css/agency.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>

</head>

<body id="page-top">
<script>
    $(document).ready(function(){

        $('#name').focus();

    });

</script>

   @include('Layout.header')

    @yield('content')        
 
<div class="chat-section  ">
        <div class="chat-head">
          Chat
          <button>-</button>
        </div>  
        <div class="chat-body" >
           <div class="chat-data" id="chat-data" >
              </div>
          <div class="bottom-part">
           
            <input type="hidden" id="user_id" value="4230">
            
              <div class="chat-info" id="info-chat" style="">
                  

                  <p>What is your name?</p>
                  <input type="text" placeholder="Please put your name" id="user_name">
                  <p>What is your email?</p>
                  <input type="text" placeholder="Please put your valid email" id="user_email" required>
                  <input type="submit" value="Let's Chat" onclick="register_chat_name()">
                </div>
                 
             
              
                
           
           
                <textarea id="send_message" style="display:none" onkeyup="send_chat(event)"></textarea>  
                
          </div>
        </div>  
      </div> 

   @include('Auth.Footer')
  
<!-- jQuery -->
    <script src="/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    

    <script src="/vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="/js/creative.min.js"></script>
   

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
</body>

</html>
