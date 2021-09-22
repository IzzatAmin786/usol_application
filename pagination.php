<?php

include('config.php');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pagination</title>
	 <meta charset="UTF-8">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
	<div class="wrapper">
        <div class="container-fluid">

            <div class="row">
                 
                <div class="col-md-12">
    
                     
                    <div class="mt-5 mb-3 clearfix">
                        

                          <h2 class="pull-left">Employees Details</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a>
                    </div>
                    <form action="pagination.php" method="post">
                    <input type="text" name="searchParam">
                    <input type="submit" name="submit" value="Search">
                    
                    <a class="btn btn-primary" href="pagination.php" role="button">Home</a>

                    </form>
                    <?php
                    if (isset($_POST['searchParam'])) {

                           $searchq= $_POST['searchParam'];

                           $result_per_page=3;

$sql="SELECT * FROM employees WHERE name LIKE '%$searchq%' OR address LIKE '%$searchq%' OR salary Like '%$searchq%' OR  id  Like '%$searchq%'";
 
$result=mysqli_query($link,$sql);

$number_of_results=mysqli_num_rows($result);



      $number_of_pages=ceil($number_of_results/$result_per_page);
      
      //determine which Page number vistor currently on
     $page=1;
      
       //starting number to display on page

         $start_limit_from=($page-1)*$result_per_page;
       //  echo $start_limit_from;
         //retriving selected results from data base and display on page;


                         $query = "SELECT * FROM employees WHERE name LIKE '%$searchq%' OR address LIKE '%$searchq%' OR salary Like '%$searchq%' OR  id  Like '%$searchq%' LIMIT $start_limit_from, $result_per_page";
                             $result = mysqli_query($link, $query);
                             if ($result->num_rows > 0)
                                {
                                    echo "<table>";
                                    echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "  <th>#</th>";
                                    echo "<th>Name</th>";
                                    echo "<th>Address</th>";
                                    echo "<th>Salary</th>";
                                     echo "<th>action</th>";

                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($row = $result->fetch_assoc())
                                    {

                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['salary'] . "</td>";
                                         echo "<td>";
                echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                echo "</td>";

                                        echo "</tr>";

                                    }
                                    echo "</tbody>";
                                    echo "</table>";

                    }
                        if($page>1) {   
        echo "<button><a href='pagination.php?page=".($page-1)."&search=".$searchq."'>  Prev </a></button>"; 

}  

if($page<$number_of_pages) {   
        echo "<button> <a href='pagination.php?page=".($page+1)."&search=".$searchq."'>  next </a></button>";   
}
 
echo "<br/>page number is $page"; 
                


}
else if(isset($_GET['search'])){
$searchq= $_GET['search'];

                           $result_per_page=3;

$sql="SELECT * FROM employees WHERE name LIKE '%$searchq%' OR address LIKE '%$searchq%' OR salary Like '%$searchq%' OR  id  Like '%$searchq%'";
 
$result=mysqli_query($link,$sql);

$number_of_results=mysqli_num_rows($result);



      $number_of_pages=ceil($number_of_results/$result_per_page);
      
      //determine which Page number vistor currently on
      if (!isset($_GET['page'])) {
        $page=1;
      }
      else
      {
        $page=$_GET['page'];
      }
       //starting number to display on page

         $start_limit_from=($page-1)*$result_per_page;
       //  echo $start_limit_from;
         //retriving selected results from data base and display on page;


                         $query = "SELECT * FROM employees WHERE name LIKE '%$searchq%' OR address LIKE '%$searchq%' OR salary Like '%$searchq%' OR  id  Like '%$searchq%' LIMIT $start_limit_from, $result_per_page";
                             $result = mysqli_query($link, $query);
                             if ($result->num_rows > 0)
                                {
                                    echo "<table>";
                                    echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "  <th>#</th>";
                                    echo "<th>Name</th>";
                                    echo "<th>Address</th>";
                                    echo "<th>Salary</th>";
                                     echo "<th>action</th>";


                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($row = $result->fetch_assoc())
                                    {

                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['salary'] . "</td>";
                                         echo "<td>";
                echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                echo "</td>";

                                        echo "</tr>";

                                    }
                                    echo "</tbody>";
                                    echo "</table>";

                    }
                        if($page>1) {   
        echo "<button><a href='pagination.php?page=".($page-1)."&search=".$searchq."'>  Prev </a></button>"; 

}  

if($page<$number_of_pages) {   
        echo "<button> <a href='pagination.php?page=".($page+1)."&search=".$searchq."'>  next </a></button>";   
}
 
echo "<br/>page number is $page"; 
                

}
else{
                    

$result_per_page=3;

$sql="SELECT * FROM employees";
 
$result=mysqli_query($link,$sql);

$number_of_results=mysqli_num_rows($result);



      $number_of_pages=ceil($number_of_results/$result_per_page);
      
      //determine which Page number vistor currently on
      if (!isset($_GET['page'])) {
      	$page=1;
      }
      else
      {
      	$page=$_GET['page'];
      }
       //starting number to display on page

         $start_limit_from=($page-1)*$result_per_page;
       //  echo $start_limit_from;
         //retriving selected results from data base and display on page;
             
             $sql="SELECT * FROM employees LIMIT $start_limit_from, $result_per_page";
             
             $results=mysqli_query($link,$sql);
              echo "<table>";
        echo '<table class="table table-bordered table-striped">';
        echo "<thead>";
        echo "<tr>";
        echo "<th>#</th>";
        echo "<th>Name</th>";
        echo "<th>Address</th>";
        echo "<th>Salary</th>";
        echo "<th>action</th>";


        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

             while($row=mysqli_fetch_array($results)){

	       echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['salary'] . "</td>";
             echo "<td>";
                echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                echo "</td>";

            echo "</tr>";

             }
                echo "</tbody>";
        echo "</table>";

    if($page>1) {   
        echo "<button><a href='pagination.php?page=".($page-1)."'>  Prev </a></button>"; 

}  

if($page<$number_of_pages) {   
        echo "<button> <a href='pagination.php?page=".($page+1)."'>  next </a></button>";   
}
 
echo "<br/>page number is $page"; 
                

}
 ?>
</body>
</html>