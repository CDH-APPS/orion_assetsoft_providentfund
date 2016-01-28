<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CDH Asset Management Ltd | Fund Manager Portal </title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">


    <script src="js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#FFF;">
    
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
              <form action="/" method="post" id="new-user-form"> 
              	<img src="images/front_logo.png" width="199" height="90" >
                      

                           <h1>Login</h1>
                          <div class="clearfix"></div>

                            <br />

                             @if (Session::has('success_message'))
                            <div class="alert alert-success" style="padding-bottom:10px;" align="center">
                            <b>{{ Session::get('success_message')}}</b>
                            </div>
                            @endif

                            @if (Session::has('error_message'))
                                
                                <div class="alert alert-warning" style="padding-bottom:10px;" align="center">
                                <b>{{ Session::get('error_message')}}</b>
                                </div>
                            @endif
                       
                    
                      <div>
                            <input type="text" class="form-control" placeholder="Username" name="username" required/>
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Password" name="password" required/>
                            </div>
                            <div>
                                <input type="submit" class="btn btn-primary submit" value="Login">
                                <a class="reset_pass" href="#">Lost your password?</a>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">

                               
                            <div class="clearfix"></div>
                            <br />
                            <div>
                           

                              <p>©<?php echo date('Y'); ?> All Rights Reserved. CDH Asset Management | Orion Fund Manager</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
              </section>
                <!-- content -->
            </div>
          
        </div>
    </div>

</body>

</html>


 <script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("images/group.jpg", {speed: 2000});
    </script>