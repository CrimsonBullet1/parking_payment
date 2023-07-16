<?php

include('config.php');

$query = "SELECT PARKINGID, TO_CHAR(RESERVATION_DATE, 'YYYY-MM-DD') AS RESERVATION_DATE FROM PARKING_LOTS LEFT JOIN RESERVATIONS USING(PARKINGID)";

$statement = $pdo->prepare($query);

// Data from the database
$stmt = $pdo->prepare("SELECT PARKINGID, TO_CHAR(RESERVATION_DATE, 'YYYY-MM-DD') AS RESERVATION_DATE FROM PARKING_LOTS JOIN RESERVATIONS USING(PARKINGID)");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row) 
{
      $parkingLots[] = ['id' => $row['PARKINGID'], 'date' => $row['RESERVATION_DATE']];
}

// Get the current date
$currentDate = date('Y-m-d');

// Display the parking lots
echo '<div class="container text-center">';
foreach ($parkingLots as $lot) {
  $reserved = ($lot['date'] == $currentDate) ? 'reserved disabled' : 'available';
  $status = ($lot['date'] == $currentDate) ? 'Reserved' : 'Available';
  echo '<div class="parking-lot ' . $reserved . '">';
  echo '<span class="lot-number">' . $lot['id'] . '</span>';
  echo '<span class="lot-status">' . $status . '</span>';
  echo '</div>';
}
echo '</div>';
?>

<!DOCTYPE html>
<html>
<head>
  <title>PHP Ajax Shopping Cart by using Bootstrap Popover</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <!-- JavaScript function to reserve a parking lot -->
  <script>
    function reserveParkingLot(parkingId) {
      // Add your logic to handle the reservation here
      console.log("Reserving parking lot: " + parkingId);
      // Example: Send an AJAX request to reserve the parking lot
    }
  </script>

 
  <style>
    .popover {
      width: 100%;
      max-width: 800px;
    }
  </style>
</head>

<body class="bg-theme bg-theme1">
  <div class="container">
    <br />
    <h3 align="center">Payment Cart with Add Multiple Item into Cart</h3>
    <br />

    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">Cart Details</div>
          <div class="col-md-6" align="right">
            <button type="button">Clear</button>
          </div>
        </div>
      </div>
      <div class="panel-body" id="shopping_cart"></div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">Product List</div>
          <div class="col-md-6" align="right">
            <button type="button" name="add_to_cart" id="add_to_cart" class="btn btn-success btn-xs">Add to Cart</button>
          </div>
        </div>
      </div>
      <div class="panel-body" id="display_item"></div>
    </div>
  </div>
</body>
</html>

<style>
  .parking-lot {
    display: inline-block;
    width: 80px;
    height: 80px;
    margin: 10px;
    border-radius: 50%;
    font-family: Arial, sans-serif;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    cursor: pointer;
    position: relative;
  }

  .lot-number {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .lot-status {
    position: absolute;
    bottom: 18px;
    left: 0;
    right: 0;
    font-size: 11px;
  }

  .reserved {
    background-color: #FF5A5A;
    color: white;
  }

  .available {
    background-color: #67D66E;
    color: white;
  }
</style>
