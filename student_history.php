<?php
   include_once('config.php');
 ?>
<!DOCTYPE html>
<html>
    <head>
        
      <?php include_once('include/header.php');  ?>
      <title>Welcome To e-Leave System</title>
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('include/student_header.php');  ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
           
                   <?php include_once('include/studentmenu.php');  ?>
               

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                 <ol class="breadcrumb">
                        <li><a href="das.php"><i class="fa pull-right"></i> Profile </a></li>
                        <li class="active">Leave History</li>
                        
                    </ol>
               
                <!-- Main content -->
                <section class="wrapper content animated fadeInRight"> 
                 <form id="form_category" name="form_category" action="action.php" method="post" onSubmit="return checkChecked('form_category');">
                
				<div class="row">
                	<div class="col-sm-1">
						
                     </div>
                    
					<div class="col-sm-11">
						<a href="apply_student.php" class="btn btn-primary pull-right"><span class="fa fa-plus">&nbsp;Apply For Leave</span> </a>
                    </div>
                    
               </div>
               <!--message-->
           <?php 
					@session_start();
          $id=$_SESSION['username'];
					 echo $_SESSION['msg'];
                     echo $_SESSION['m'];
					  unset($_SESSION['msg']); 
                      unset($_SESSION['m']); ?>

           
                    <div class="row">
                        <div class="col-xs-12">                           
                            <div class="box">                               
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                 <th>No.</th>  
                                                                                         
                                                 <th>Leave Type</th><th>From Date</th><th>To date</th><th>Discription</th><th>Posting Date</th><th>Faculty Remark</th><th>Faculty Remark Date</th><th>Faculty Status</th><th>HOD Remark</th><th>HOD Remark Date</th><th>HOD Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
										 	$Srno=0;
										 	$que="select * from studentreg where userid='$id'";
                     $exe=mysqli_query($conn,$que);
                     $raw=mysqli_fetch_array($exe);
                     $use=$raw['id'];
                    
                    $query="select * from studentleave where empid='$use'";
                    $exe=mysqli_query($conn,$query);

                                            if ($exe->num_rows > 0)
											{
												while($row = $exe->fetch_assoc())
												{	
													$Srno++;
                          $stats=$row['statusfaculty'];
                           $stats1=$row['statushod'];
										 ?>
                                            <tr>
                                              <td style="width:50px"><?php echo $Srno; ?></td>       
                                                                          
                                              <td style="width:650px"><?php echo $row["leavetype"]; ?></td>                   
                                              <td style="width:650px"><?php echo $row['fromdate']; ?></td>       
                                              <td style="width:650px"><?php echo $row["todate"]; ?></td>
                                              <td style="width:650px"><?php echo $row["discription"]; ?></td>
                                              <td style="width:650px"><?php echo $row["applyeddate"]; ?></td>
                                             <td style="width:650px"><?php echo $row["facultyremark"]; ?></td>
                                             <td style="width:650px"><?php echo $row["facultyremarkdate"]; ?></td>
                                          <td>   <?php
if($stats=='pending'){
                                             ?>
                                                 <span style="color: blue">waiting for approval</span>
                                                 <?php } if($stats=='Approved')  { ?>
                                                <span style="color: green">Approved</span>
                                                 <?php } if($stats=='Rejectted')  { ?>
 <span style="color: red">Not Approved</span>
 <?php } ?>


                                             </td> 
                                             <td style="width:650px"><?php echo $row["hodremark"]; ?></td>
                                             <td style="width:650px"><?php echo $row["hodremarkdate"]; ?></td>
                                             <td> <?php
if($stats1=='pending'){
                                             ?>
                                                 <span style="color: blue">waiting for approval</span>
                                                 <?php } if($stats1=='Approved')  { ?>
                                                <span style="color: green">Approved</span>
                                                 <?php } if($stats1=='Rejectted')  { ?>
 <span style="color: red">Not Approved</span>
 <?php } ?>


                                             </td> 

                            
                                        </tr>
									 <?php }} ?>           
                                        </tbody>
                                        
                                        
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                   </form>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
<?php include_once('include/jscript.php'); ?>
        
<script type="text/javascript">
           $(function() {
                $("#example1").dataTable(
				{
					'iDisplayLength': 50
				});
                var checkAll = $('input.all');
    var checkboxes = $('input.check');

   // $('input').iCheck();

    checkAll.on('ifChecked ifUnchecked', function(event) {        
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });            
            });
        </script>
 <script>
function checkChecked(formname) {
    var anyBoxesChecked = false;
    $('#' + formname + ' input[type="checkbox"]').each(function() {
        if ($(this).is(":checked")) {
            anyBoxesChecked = true;
        }
    });
 
    if (anyBoxesChecked == false) {
      alert('Please select at least one checkbox');
      return false;
    } 
}
</script>
       

    </body>
</html>