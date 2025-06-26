<?php
include('./layout/header.php');
include('./project-config.php');
?>
<div class="container table-responsive py-5">
    <h3 class="text-center my-3">Your Address : </h3>
    <div class="my-3">
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">+ Add New Address</button>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">NearBy</th>
                <th scope="col">House_No.</th>
                <th scope="col">Pin</th>
                <th scope="col">City</th>
                <th scope="col">District</th>
                <th scope="col">State</th>
                <th scope="col">Type</th>
                <th scope="col" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cus_id = $_SESSION['customer']['cus_id'];
            $select_query = mysqli_query($conn, "SELECT * FROM `address` WHERE cus_id=$cus_id");
            if (mysqli_num_rows($select_query)>0) {
                while($data = mysqli_fetch_assoc($select_query)){
                    ?>
                    <tr>
                        <td><?php echo $data['address_id']; ?></td>
                        <td><?php echo $data['nearby']; ?></td>
                        <td><?php echo $data['house_no']; ?></td>
                        <td><?php echo $data['pin']; ?></td>
                        <td><?php echo $data['city']; ?></td>
                        <td><?php echo $data['district']; ?></td>
                        <td><?php echo $data['state']; ?></td>
                        <td><?php echo $data['address_type']; ?></td>
                        <td>
                            <button class="btn btn-success btn-sm">update</button>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm">delete</button>
                        </td>
                    </tr>
                    <?php
                }
            }else{
                echo "<h4 class='text-danger'> No Address Found </h4>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Address Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- end Address Modal -->
<?php
include('./layout/footer.php');
?>