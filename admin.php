<?php
    require_once "db.php";
    require_once "controller.php";
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location:index.php');
        die;
    }
    $invoices = fetchAllInvoice($conn);
    // print_r($invoices);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" />

</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="/">Adeyinka Esther Nig. LTD</a>

  <!-- Links -->
  <ul class="navbar-nav">
    
    <?php if($_SESSION['user'] === "manager" || $_SESSION['user'] === "superadmin"): ?>
    <li class="nav-item">
    <a href="invoice.php" class="nav-link">Invoice</a>
    </li>
    <?php endif; ?>
    
    
    <li class="nav-item active">
      <a class="nav-link" href="admin.php">Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
  </ul>
</nav>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                
                <div class="card">
                
                    <div class="card-header">
                        <h4 class="text-center text-success">All Invoice Issued</h4>
                    </div>
                    <div class="card-body">
                    
                    <?php if($invoices == null) : ?>
                    <h3 class="text-center">There is no Invoice issued Yet!</h3>
                    <?php else: ?>
                        <table class="table table-striped table-bordered" id="invoiceTable">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Plan</th>
                                <th>Plan Price</th>
                                <th>Approved By</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                            <?php foreach($invoices as $key=>$row) : ?>
                               
                                <tr>
                                    <td><?=($key+1) ;?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['phone']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?= $row['plan_name']; ?></td>
                                    <td><?= $row['plan_price']; ?></td>
                                    <td><?= $row['approve_by']; ?></td>
                                    <?php
                                        $date = date_create($row['created_at'])
                                    ?>
                                    <td><?= date_format($date,"Y/m/d"); ?></td>
                                </tr>
                            <?php endforeach; ?> 
                            </tbody>
                        </table>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
    <script src="js/invoice.js"></script>
    <script>
        $('#invoiceTable').DataTable()
    </script>
</body>
</html>