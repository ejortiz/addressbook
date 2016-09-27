<?php
/**
 * Created by PhpStorm.
 * User: eortiz17
 * Date: 9/23/16
 * Time: 9:33 PM
 */




?>




<?php if(!isset($view_model) || empty($view_model) ): ?>
    Hm...no addresses were found!


<?php elseif(isset($view_model) && !empty($view_model)): ?>
    <h2>Addresses</h2>
    <table class = "table table-bordered table-striped">
        <thead>
        <tr>
            <th></th>
            <th>Address Line 1</th>
            <th>Address Line 2</th>
            <th>City</th>
            <th>State/Province/Region</th>
            <th>Zipcode</th>
            <th><strong>DELETE</strong></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach($view_model as $address): ?>
            <tr>
                <td><a href="/addresses/editaddress/<?=$address["Id"]?>">Edit</a></td>
                <td><?= $address['AddressLine1']?></td>
                <td><?= $address['AddressLine2']?></td>
                <td><?= $address['City']?></td>
                <td><?= $address['Region']?></td>
                <td><?= $address['Zipcode']?></td>
                <td>
                    <a href="/addresses/deleteaddress/<?=$address["Id"]?>">
                        <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                    </a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>


<?php endif;?>