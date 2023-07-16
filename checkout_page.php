<?php

//fetch_item.php

include('config.php');

$query = "SELECT PARKINGID, TO_CHAR(RESERVATION_DATE, 'YYYY-MM-DD') AS RESERVATION_DATE FROM PARKING_LOTS LEFT JOIN RESERVATIONS USING(PARKINGID)";

$statement = $pdo->prepare($query);

if($statement->execute())
{
 $result = $statement->fetchAll();
 $output = '';
 foreach($result as $row)
 {
  $output .= '
  <div class="col-md-3" style="margin-top:12px;margin-bottom:12px;">  
            <div style="border:1px solid #ccc; border-radius:5px; padding:16px; height:300px;" align="center" id="product_'.$row["PARKINGID"].'">
             <h4 class="text-info">
                        <div class="checkbox">
                              <label><input type="checkbox" class="select_product" data-product_id="'.$row["PARKINGID"].'" </label>
                        </div>
                  </h4>
            </div>
        </div>
  ';
 }
 echo $output;
}

// Data from the database
$stmt = $pdo->prepare("SELECT PARKINGID, TO_CHAR(RESERVATION_DATE, 'YYYY-MM-DD') AS RESERVATION_DATE FROM PARKING_LOTS LEFT JOIN RESERVATIONS USING(PARKINGID)");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row) 
{
      $parkingLots[] = ['id' => $row['PARKINGID'], 'date' => $row['RESERVATION_DATE']];
}

// Get the current date
  $currentDate = date('Y-m-d');

// Display the parking lots
  foreach ($parkingLots as $lot) 
{
    $reserved = ($lot['date'] == $currentDate) ? 'reserved disabled' : 'available';
    $status = ($lot['date'] == $currentDate) ? 'Reserved' : 'Available';
    echo '<div class="parking-lot ' . $reserved . '" onclick="reserveParkingLot(' . $lot['id'] . ')">';
    echo '<span class="lot-number">' . $lot['id'] . '</span>';
    echo '<span class="lot-status">' . $status . '</span>';
    echo '</div>';
}

/*$output = '
<div class="col-md-3" style="margin-top:12px;">  
      <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:350px;" align="center">
            <img src="https://image.ibb.co/jSR5Mn/1.jpg" class="img-responsive"><br>
            <h4 class="text-info">Samsung J2 Pro</h4>
            <h4 class="text-danger">$ 100.00</h4>
            <input type="text" name="quantity" id="quantity1" class="form-control" value="1">
            <input type="hidden" name="hidden_name" id="name1" value="Samsung J2 Pro">
            <input type="hidden" name="hidden_price" id="price1" value="100.00">
            <input type="button" name="add_to_cart" id="1" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Add to Cart">
      </div>
</div>
            
            
            <div class="col-md-3" style="margin-top:12px;">  
            <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:350px;" align="center">
                  <img src="https://image.ibb.co/mt5zgn/3.jpg" class="img-responsive"><br>
                  <h4 class="text-info">Panasonic T44 Lite</h4>
                  <h4 class="text-danger">$ 125.00</h4>
                  <input type="text" name="quantity" id="quantity3" class="form-control" value="1">
                  <input type="hidden" name="hidden_name" id="name3" value="Panasonic T44 Lite">
                  <input type="hidden" name="hidden_price" id="price3" value="125.00">
                  <input type="button" name="add_to_cart" id="3" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Add to Cart">
            </div>
        </div>
            
            
            <div class="col-md-3" style="margin-top:12px;">  
            <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:350px;" align="center">
                  <img src="https://image.ibb.co/b57C1n/2.jpg" class="img-responsive"><br>
                  <h4 class="text-info">HP Notebook</h4>
                  <h4 class="text-danger">$ 299.00</h4>
                  <input type="text" name="quantity" id="quantity2" class="form-control" value="1">
                  <input type="hidden" name="hidden_name" id="name2" value="HP Notebook">
                  <input type="hidden" name="hidden_price" id="price2" value="299.00">
                  <input type="button" name="add_to_cart" id="2" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Add to Cart">
            </div>
        </div><div class="col-md-3" style="margin-top:12px;">  
            <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:350px;" align="center">
                  <img src="https://image.ibb.co/eDhqnS/4.jpg" class="img-responsive"><br>
                  <h4 class="text-info">Wrist Watch</h4>
                  <h4 class="text-danger">$ 85.00</h4>
                  <input type="text" name="quantity" id="quantity4" class="form-control" value="1">
                  <input type="hidden" name="hidden_name" id="name4" value="Wrist Watch">
                  <input type="hidden" name="hidden_price" id="price4" value="85.00">
                  <input type="button" name="add_to_cart" id="4" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Add to Cart">
            </div>
        </div>
';

echo $output;*/

?>