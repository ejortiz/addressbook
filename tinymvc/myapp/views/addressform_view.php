<?php
/**
 * Created by PhpStorm.
 * User: eortiz17
 * Date: 9/24/16
 * Time: 6:31 PM
 */

?>


<??>
<h3 class="success"><?php if(!empty($success_message)){echo $success_message;} ?></h3>

<form action="" method="post">
    <div class="form-group">
        <label for="AddressLine1">Address Line 1</label>
        <input type="text" class="form-control" name="AddressLine1" value="<?php if(!empty($address)) {echo $address->addressLine1;} ?>">
    </div>
    <div class="form-group">
        <label for="AddressLine2">Address Line 2</label>
        <input type="text" class="form-control" name="AddressLine2" value="<?php if(!empty($address)) {echo $address->addressLine2;} ?>">
    </div>
    <div class="form-group">
        <label for="City">City</label>
        <input type="text" class="form-control" name="City" value="<?php if(!empty($address)) {echo $address->city;} ?>">
    </div>
    <div class="form-group">
        <label for="Region">State/Province/Region</label>
        <input type="text" class="form-control" name="Region" value="<?php if(!empty($address)) {echo $address->region;} ?>">
    </div>
    <div class="form-group">
        <label for="Zipcode">Zipcode</label>
        <input type="text" class="form-control" name="Zipcode" value="<?php if(!empty($address)) {echo $address->zipcode;} ?>">
    </div>
    <div class="form-group">
        <label for="Country">Country</label>
        <input type="text" class="form-control" name="Country" placeholder="United States of America" value="<?php if(!empty($address)) {echo $address->country;} ?>">
    </div>

    <input type="hidden" class="form-control" name="Id" value="<?php if(!empty($address)) {echo $address->id;} ?>">
    <input type="hidden" class="form-control" name="Country" value="<?php if(!empty($address)) {echo $address->country;} else{echo 'United States of America';} ?>">

    <button type="submit" class="btn btn-default">Save</button>
</form>
