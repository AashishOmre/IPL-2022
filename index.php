<?php  
  //connecting variables
  $server = "localhost:3307";
  $username ="root";
  $password = "";
  $dbname="IPL-2022";
  
  $con=mysqli_connect($server,$username,$password,$dbname);
  
  if(!$con){
     die("Failed to connect :".mysqli_connect_error());
  }
  else{
      //  echo "Connection successfully established";
  }
  
  //alert msg for sucessful insertion
  $inserted=false;

  $sql=" SELECT* FROM `match_table`";
  $result1=mysqli_query($con,$sql); 
   
  if($_SERVER['REQUEST_METHOD']=='POST'){
    //  console.log(isset($_POST['editaddbtn']));
    if(isset($_POST['editaddbtn'])){
      //update the record1
      $matchid=$_POST['matchidedit'];
      $venue=$_POST['venueedit'];
      $t1=$_POST['t1edit'];
      $t2=$_POST['t2edit'];
      $k = $_POST['editaddbtn']; 
      $sql="UPDATE `match_table` SET `match_id` = '$matchid', `venue` = '$venue', `team1_id` = '$t1', `team2_id` = '$t2' WHERE `match_table`.`match_id` = $k;";

      // echo `editaddbtn.value`;

    
      $result=mysqli_query($con,$sql);
      if($result)  {
        // echo "done",$k ;
        header("Refresh:0");
      }
      else{
        echo "NOT done",$k ;
      }            

    }
    else{
   // echo $_SERVER['REQUEST_METHOD'];
    $match_id=$_POST['matchidadd'];
    $venue=$_POST['venueadd'];
    $t1=$_POST['t1add'];
    $t2=$_POST['t2add'];

     $sql="INSERT INTO `match_table` (`match_id`, `venue`, `team1_id`, `team2_id`) VALUES ('$match_id', '$venue', '$t1', '$t2');";
     $result=mysqli_query($con,$sql) ;  
     
     if($result){
      //echo "sucessfully established 1";
      $inserted=true;
      header("Refresh:0");
     }
     else{
     // echo "Not established !! 2"; 
     }
    }
  }

  
  ?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">



  <title>IPL-2022</title>
</head>

<body>

<!--add record model-->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModal">Add Record</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <form action="/ipl-2022/index.php" method="POST">
       
            <div class="form-group">
              <label for="email"></label>
              <input type="text" class="form-control" placeholder="Enter match id" id="matchidadd" name="matchidadd">
            </div>
            <div class="form-group">
              <label for="pwd"></label>
              <input type="text" class="form-control" placeholder="Enter venue" id="venueadd" name="venueadd">
            </div>
            <div class="form-group">
              <label for="pwd"></label>
              <input type="text" class="form-control" placeholder="Enter team 1 Id" id="t1add" name="t1add">
            </div>
            <div class="form-group">
              <label for="pwd"></label>
              <input type="text" class="form-control" placeholder="Enter team 2 Id" name="t2add" id="t2add">
              <label for=""></label>
            </div>
            <button type="submit" class="btn btn-primary my-2">Add record</button>
            </form>
        </div>
      </div>
    </div>
  </div>
  <!--Edit modal-->
  
  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModal">Edit Record</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <form action="/ipl-2022/index.php" method="POST">
        <input type="hidden" id="editaddbtn" name="editaddbtn">
            <div class="form-group">
              <label for="email"></label>
              <input type="text" class="form-control" placeholder="Enter match id" id="matchidedit" name="matchidedit">
            </div>
            <div class="form-group">
              <label for="pwd"></label>
              <input type="text" class="form-control" placeholder="Enter venue" id="venueedit" name="venueedit">
            </div>
            <div class="form-group">
              <label for="pwd"></label>
              <input type="text" class="form-control" placeholder="Enter team 1 Id" id="t1edit" name="t1edit">
            </div>
            <div class="form-group">
              <label for="pwd"></label>
              <input type="text" class="form-control" placeholder="Enter team 2 Id" name="t2edit" id="t2edit">
              <label for=""></label>
            </div>
            <button type="submit" class="btn btn-primary my-2">Update record</button>
            </form>
        </div>
      </div>
    </div>
  </div>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="navbar-brand" href="#">
       <img src="ipl-logo.jpg" alt="logo" width="36" height="28" style="border-radius:4px;">
        </a>
      </li>
      
        <li class="nav-item">
           <h4>IPL-2022</h4>
        </li> 
    </ul>   
    </div>
  </div>
</nav>

  <?php
        if($inserted){
          echo "<div class='alert alert-success' role='alert'>
          <strong>Sucess !!</strong>record has been inserted sucessfully
          </div>";
             }
       ?>

  <div class="container my-3">
    <table class="table table table-success table-striped " id="myTable">
      <thead class="thead-dark">
        <tr >
          <th scope="col">S.No</th>
          <th scope="col">Match ID</th>
          <th scope="col">Venue</th>
          <th scope="col">Team 1</th>
          <th scope="col">Team 2</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $count=0;
       while($rows=mysqli_fetch_assoc($result1)){
         $count++;
      ?>
        <tr>
          <td>
            <?php echo $count ?>
          </td>

          <td>
            <?php echo $rows['match_id']; ?>
          </td>
          <td>
            <?php echo $rows['venue']; ?>
          </td>
          <td>
            <?php echo $rows['team1_id'];?>
          </td>
          <td>
            <?php echo $rows['team2_id']; ?>
          </td>
          <td>
            <?php
          echo "<button class='edit btn btn-primary my-1 w-15 p-1' id=".$rows['match_id'].">Edit</button> <button class='btn btn-primary my-1w-15 p-1 '>Delete</button>";
           ?>
          </td>
        </tr>
        <?php
       }
    ?>
      </tbody>

    </table>
    <div>
          <button type="submit" class="btn btn-primary my-2" id="addbtn">Add record</button>
          <!-- Optional JavaScript; choose one of the two! -->

          <!-- Option 1: Bootstrap Bundle with Popper -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
          <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

          <script>
            $(document).ready(function () {
              $('#myTable').DataTable();
            });
          </script>

          <script>
            
            let edit = document.getElementsByClassName('edit');
            Array.from(edit).forEach((element) => {
              element.addEventListener('click', (element) => {
                // console.log('Edit', element.target.parentNode.parentNode);
                let tr = element.target.parentNode.parentNode;
                let srNo = tr.getElementsByTagName('td')[0].innerText;
                let match_id1 = tr.getElementsByTagName('td')[1].innerText;
                let venue = tr.getElementsByTagName('td')[2].innerText;
                let t1 = tr.getElementsByTagName('td')[3].innerText;
                let t2 = tr.getElementsByTagName('td')[4].innerText;
              
                
                matchidedit.value=match_id1;
                venueedit.value=venue;
                t1edit.value=t1;
                t2edit.value=t2;
                // console.log(srNo, match_id, venue, t1, t2);

                $('#editModal').modal('toggle');
                 console.log(element.target.id);
                 editaddbtn.value=element.target.id;
                
              })
            });

            let addbtn= document.querySelector('#addbtn');
               addbtn.addEventListener('click',function(){
                $('#addModal').modal('toggle');
               })


          </script>
          <!-- Option 2: Separate Popper and Bootstrap JS -->
          <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>