<!DOCTYPE HTML>
<html lang="en">
<head>
	 <meta charset="utf-8">
       <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name', 'Stock management system ') }}</title>
    <!-- Fonts -->
       <!--  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
         <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- latest AngularJS -->
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.9/angular-route.min.js"></script>
      
   
        <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-114/svg-assets-cache.js"></script>
        <scritp src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.js"> </scrit>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.7/angular-messages.min.js"> </script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.7/angular-aria.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.7/angular-route.min.js"></script>
    <!-- end links to suprot modals -->

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- parse Excel copied data script -->
        <script type="text/javascript" src="js/processExcel.js"></script>
           
          <!-- links added to suport angular modals  from https://material.angularjs.org/latest/demo/dialog -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.7/angular-animate.min.js"></script>

        
      <script src="js/controllers/mainController.js"></script> <!-- load our controller -->
      <script src="js/directives/dirPagination.js"></script> <!-- load our directives -->
      
       <script src="js/services/stockService.js"></script> <!-- load our service -->
       <script src="js/app.js"></script> <!-- load our application -->
      
      <!-- popeye modal modal AngularJS module -->
      <script src="../node_modules/angular-popeye/release/popeye.js"></script>  
       
       <!-- include ngAnimate -->
       <script src="../node_modules/angular/angular-animate.min.js"></script> 
       
        
        <script src="https://gitcdn.xyz/cdn/angular/bower-material/v1.1.19/angular-material.js"></script> 

      <!-- custom stylesheet -->
            <link rel="stylesheet" type="text/css" href="css/app.css">
          <!-- added from tutorialspoint modal example --> 
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <!-- <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script> -->
         <!-- end added from tutorialspoint modal example -->


 </head>
  <body>
     <div id="app" class="container">

     	@yield('content')

     </div>

   
  </body>
  </html>