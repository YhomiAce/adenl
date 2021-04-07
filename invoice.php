<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location:index.php');
        die;
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Board</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
</head>
<body>
<nav class="navbar navbar-inverse ">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">Adeyinka Esther Nig. LTD</a>
    </div>
    <ul class="nav navbar-nav">
    <li class="active"><a href="invoice.php">Invoice</a></li>
        <?php if($_SESSION['user'] === "manager" || $_SESSION['user'] === "superadmin"): ?>
        <li>
        <a href="admin.php">Dashboard</a>
        </li>
        <?php endif; ?>
    <li><a href="logout.php">Logout</a></li>
    </ul>
   
  </div>
</nav>
    <div class="container mt-5">
        <div class="container content-invoice">
            <div id="errorMsg" class="text-danger"></div>
            <form action="#" id="invoice-form" method="post" class="invoice-form"> 
                <input type="hidden" name="approved_by" id="approved_by" value="<?= $_SESSION['user']; ?>">
                <input type="hidden" name="email1" id="email1" value="adeyinkamomduke@gmail.com">
                <input type="hidden" name="email2" id="email2" value="Adenl.dpu@gmail.com">
                <div class="load-animate animated fadeInUp">
                    <div class="row">
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <h2 class="title">Invoice System</h2>
                            
                        </div>		    		
                    </div>
                    <input id="currency" type="hidden" value="$">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <h3>From,</h3>
                            ADEYINKA ESTHER NIG. LTD. <br>
                            18, Adeleke Street, Off Tinuade, <br>
                            Off Allen Avenue, First Bank Bus-Stop, <br>
                            Ikeja,Lagos<br>
                        </div>      		
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
                            <h3>To,</h3>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" required name="name" id="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required class="form-control" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" required class="form-control" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <label for="package">Select Package</label>
                                <select name="package" id="package" required class="form-control">
                                    <option value="" disabled selected="selected">Select Package</option>
                                    <option value="Single Application">Single Application</option>
                                    <option value="Family Application">Family Application</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-bordered table-hover" id="invoiceItem">
                                <tr>
                                    <th>ID</th>
                                    <th>Package Name</th>
                                    <th>Price</th>
                                    <th>Amount In Words</th>
                                </tr>
                                <tr id="single_plan" style="display:none;">
                                    <td>1</td>
                                    <td>Single Plan</td>
                                    <td>#57,500.00</td>
                                    <td>
                                        <p>Fifty Seven Thousand, Five Hundred Naira Only</p>
                                    </td>
                                </tr>
                                <tr id="family_plan" style="display:none;">
                                    <td>1</td>
                                    <td>Family Plan</td>
                                    <td>#96,000.00</td>
                                    <td>Ninety Six Thousand Naira Only</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="approve">Approved</label>
                                <input type="checkbox" value="Yes" name="approve" id="approve" class="form-control-check">
                            </div>
                        </div>
                    </div> -->
                    <div class="row">	
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                           
                            <div class="form-group">
                                
                                <input data-loading-text="Saving Invoice..." type="submit" id="invoice_btn" name="invoice_btn" value="Approve" class="btn btn-success btn-block submit_btn invoice-save-btm">						
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>		      	
                </div>
            </form>			
        </div>
        </div>	
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/invoice.js"></script>
</body>
</html>
