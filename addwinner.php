<?php
    session_start();
/*
    if (empty($_SESSION['user']))
    {
        header('Location: login2.php');
        exit;
    }
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <title>Add Winner | Winners Tracker</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <link href="jquery/datepicker/css/datepicker.css" type="text/css" rel="stylesheet">
    <link type="text/css" href="jquery/datatables/media/css/jquery.dataTables.css">
    <link type="text/css" href="jquery/validator/css/bootstrapValidator.css"/>

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/main.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="jquery/tablesorter/jquery.tablesorter.min.js"></script>
    <script src="jquery/datepicker/js/datepicker.js"></script>
    <script src="jquery/datatables/media/js/jquery.dataTables.js"></script>
    <script src="jquery/validator/js/bootstrapValidator.js"></script>
    <script src="jquery/datatables/media/js/dataTables.bootstrap.js"></script>


    <script>
        function send() 
        {
            $("#dateselected").append("\n" + $("#system-search").val());
        }
    </script>

    <script>
    window.setTimeout(function() {
     $(".alert").fadeTo(5000, 0).slideUp(500, function(){
          $(this).remove(); 
     });
        }, 1000);

    </script>

    
    

</head>

<body>

<?php
    $username = implode($_SESSION['user']);
?>
    
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Winners Tracker</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a data-toggle="tab" href="#addwinner"><span class=" glyphicon glyphicon-pencil"></span>Add Winner</a></li>
                <!--<li><a href="adminrecords.php"><span class="glyphicon glyphicon-list-alt"></span>Records</a></li>
                <li><a href="adminreports.php"><span class="glyphicon glyphicon-list"></span>Reports</a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                    class="glyphicon glyphicon-user"></span><?php echo $username?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>


        <div id="wrap">        
        <div class="container">
            <div class="span8 col-md-12"></div>
            <div class="tab-content">
                <br>
                    <?php
                    
                    if(isset($_POST['submit']))
                    {
                        
                        include("connect.php");

                        
                    //insert into database
                        $firstname = addslashes($_POST['firstname']);
                        $lastname = addslashes($_POST['lastname']);
                        $promotion = addslashes($_POST['promotion']);
                        $showname = addslashes($_POST['showname']);
                        $presenter = addslashes($_POST['presenter']);
                        $prize = addslashes($_POST['prize']);
                        $telephone = addslashes($_POST['telephone']);
                        $idnumber = addslashes($_POST['idnumber']);
                        $datecollected = addslashes($_POST['datecollected']);

                        $sql = $conn->prepare("INSERT INTO winnerslist (promodate, fname, lname, promotion, showname, presenter, prize, telephone, idno, datecollected) VALUES (NOW(), '$firstname', '$lastname', '$promotion', '$showname', '$presenter', '$prize', '$telephone', '$idnumber','$datecollected')");

                        $sql->execute();
                      
                          if (!$sql)
                          {
                              die('<div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Failure!</strong> Something went wrong. Please try again. 
                                </div>' . mysql_error($con));
                          }else{
                         
                          echo '<div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Success!</strong> The record has been entered.
                                </div>';
                                unset($_POST);
                                header("Refresh:6 url=addwinner.php");
                  
                        }
                    }
                    ?>


                <div class="col-md-12 tab-pane active" id="addwinner" style="display:" >
                    <br>

                    <legend>Enter Winner Details: <span><?php echo date("F j, Y  H:i:s"); ?></span></legend> 
                    
                    <form class="form form-inline" id="addwinner" action="" method="post" role="form">
                    
                        <div class="col-xs-12 col-sm-12 col-md-12 well well-sm">
                        
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="firstname">First Name</label>
                                    <input class="form-control" name="firstname" placeholder="First Name" type="text" required autofocus />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="lasttname">Last Name</label>
                                    <input class="form-control" name="lastname" placeholder="Last Name" type="text" required />
                                </div>
                                
                           
                                <div class="col-md-3 form-group">
                                    <label for="telephone">Telephone Number</label>
                                    <input class="form-control" name="telephone" placeholder="Telephone Number" type="text" required/>
                                </div>
                                <div class="col-md-3 form-group" style="visibility:hidden">
                                    <label for="idnumber">ID Number</label>
                                    <input class="form-control" name="idnumber" placeholder="ID Number" type="text" />
                                </div>
                                
                                
                            </div>

                            <div class ="row">
                                <div class="col-md-3 form-group">
                                    <label for="promotion">Promotion</label>
                                    <input class="form-control" name="promotion" placeholder="Promotion" type="text" required/>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="prize">Prize Won</label>
                                    <input class="form-control" name="prize" placeholder="Prize Won" type="text" required/>
                                </div>
                            
                                <div class="col-md-3 form-group">
                                    <label for="showname">Show</label>
                                    <input class="form-control" name="showname" placeholder="Show" type="text" required/>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="presenter">Presenter</label>
                                    <input class="form-control" name="presenter" value="<?php echo $username ?>" type="text" readonly/>
                                </div>
                            </div>
                            
                            <br>
                            <div class="row">
                                <div class=" form-group col-md-3">
                                    <button class="btn btn-md btn-primary btn-block" name="submit" type="submit">Submit</button>
                                </div>
                                <div class="col-md-3 form-group" style="visibility:hidden">
                                    <label for="datecollected">Date Collected</label>
                                    <input class="form-control" name="datecollected" placeholder="Date Collected" type="text" />
                                </div>
                            </div>
                        </div>

                    </form>     
                </div><!--#addwinner-->
            </div><!--tab-content-->
        </div><!--/.container-->
    </div><!--wrap-->


<!--<script type="text/javascript">
$(document).ready(function() {
    $('#addwinner').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            firstname: {
                validators: {
                    stringLength: {
                        max: 20,
                        message: 'The firstname must be less than 20 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z ]+$/,
                        message: 'The firstname can only consist of alphabetical characters'
                    }
                }
            },
            lastname: {
                validators: {
                    stringLength: {
                        max: 20,
                        message: 'The lastname must be less than 20 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z ]+$/,
                        message: 'The lastname can only consist of alphabetical characters'
                    }
                }
            },
            showname: {
                validators: {
                    regexp: {
                        regexp: /^[a-zA-Z ]+$/,
                        message: 'The show name can only consist of alphabetical characters'
                    }
                }
            },
            presenter: {
                validators: {
                    regexp: {
                        regexp: /^[a-zA-Z ]+$/,
                        message: 'The  presenter\'s name can only consist of alphabetical characters'
                    }
                }
            },
        }
    });
});
</script>-->


</html>

