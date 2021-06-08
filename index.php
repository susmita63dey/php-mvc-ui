

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Shop</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-primary btnInsert" id="btnInsert" style="margin-bottom: 20px; margin-top: 20px;">Add Items</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Sl No</th>
				        <th>Item Name</th>
				        <th>Price</th>
				        <th>Action</th>
				      </tr>
				    </thead>
				    <tbody id="tblbody">
				      
				    </tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Modal Start -->
		<div class="modal" id="myModal">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title">Add New Items</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>
		      <div class="modal-body">
		        <div class="row">
		        	<div class="col-md-12">
		        		<div class="form-group">
		        			<label>Enter item name</label>
		        			<input type="text" name="name" class="form-control" id="name">
		        		</div>
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="col-md-12">
		        		<div class="form-group">
		        			<label>Enter item price</label>
		        			<input type="text" name="price" class="form-control" id="price">
		        		</div>
		        	</div>
		        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: left">Close</button>
		        <a href="#" class="btn btn-primary btnSave" id="btnSave" name="btnSave" style="float: right;">Save</a>
		      </div>
		    </div>
		  </div>
		</div>
	<!-- Modal End -->

	<!-- Modal Start -->
		<div class="modal" id="myModalEdit">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title">Edit Items</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>
		      <div class="modal-body">
		        <div class="row">
		        	<div class="col-md-12">
		        		<div class="form-group">
		        			<label>Enter item name</label>
		        			<input type="text" name="edit_name" class="form-control" id="edit_name">
		        		</div>
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="col-md-12">
		        		<div class="form-group">
		        			<label>Enter item price</label>
		        			<input type="text" name="edit_price" class="form-control" id="edit_price">
		        		</div>
		        	</div>
		        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: left">Close</button>
		        <a href="#" class="btn btn-primary btnUpdate" id="btnUpdate" name="btnUpdate" style="float: right;">Update</a>
		      </div>
		    </div>
		  </div>
		</div>
	<!-- Modal End -->


</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script type="text/javascript">
	$(document).ready(function(){
		$(document).on("click", "#btnInsert", function(){
			$('#myModal').modal('show'); 
		});

		$(document).on("click", "#btnSave", function(){
			if($("#name").val()==""){
	          alert("Name cannot be empty!");
	          $("#name").focus();
	          return false;
	        }else if($("#price").val()==""){
	          alert("Price cannot be empty!");
	          $("#price").focus();
	          return false;
	        }else{
	        	var name = $("#name").val();
	        	var price = $("#price").val();
	        	var action = 'insert_item';
	        	$.ajax({
		            url: "item/insert.php",
		            type: "POST",
		            dataType:'json',
		            data:{ "name":name, "price":price},
		            success: function(response){
		            	//alert(response);
		              //alert("Record added successfully!");
		              if(response.status == 'false')
		              {
		               alert("Could not insert");
		              }
		              else
		              {
		              	alert("Successfully Inserted");
		              }
		            },
		            complete:function(){
		              window.location="index.php";
		              // setTimeout(function() {
		              //   window.location.href = "creategrand.php";
		              // }, 3000);
		            }
		        });
	        }
		});

		$.ajax({
			url: "item/readData.php",
			method: "POST",
			dataType: "json",
			success: function(response){
				//alert(response);
				$("#tblbody").empty();
				var rows="";  
				if(response.length > 0){
					for(var i=0; i<response.length; i++){
						rows+='<tr>';
              			rows+='<td>'+parseInt(i+1)+'</td>';
              			rows+='<td>'+response[i].name+'</td>';
              			rows+='<td>'+response[i].price+'</td>';
              			rows+='<td><a href="#" class="btn btn-info btnEdit" id="btnEdit_'+response[i].item_id+'">Edit</a> <a href="#" class="btn btn-danger btnDel" id="btnDel_'+response[i].item_id+'">Delete</a></td>';
              			rows+='</tr>';
					}
				}
				$("#tblbody").append(rows);
			}
		});

		$(document).on("click", ".btnEdit", function(){
			$('#myModalEdit').modal('show'); 
			var key=$(this).attr("id").split("_");
			//alert(key[1]);
			$.ajax({
				url: "item/editData.php",
				method: "POST",
				dataType: "json",
				data: {"item_id": key[1]},
				success: function(response){
					//alert(response);
					$("#edit_name").val(response.name);
					$("#edit_price").val(response.price);
					$(".btnUpdate").attr("id","btnUpdate_"+response.item_id);
				},
				complete: function() {
					
				}
			});
		});

		$(document).on("click", ".btnUpdate", function(){
			var key=$(this).attr("id").split("_");
			//alert(key[1]);
			if($("#edit_name").val()==""){
	          alert("Name cannot be empty!");
	          $("#edit_name").focus();
	          return false;
	        }else if($("#edit_price").val()==""){
	          alert("Price cannot be empty!");
	          $("#edit_price").focus();
	          return false;
	        }else{
	        	var name = $("#edit_name").val();
	        	var price = $("#edit_price").val();
	        	//var action = 'update_item';
	        	$.ajax({
		            url: "item/updateData.php",
		            type: "POST",
		            dataType:'json',
		            data:{"item_id":key[1], "name":name, "price":price},
		            success: function(response){
		            	//alert(response);
		              //alert("Record added successfully!");
		              if(response.status == 'false')
		              {
		               alert("Could not update");
		              }
		              else
		              {
		              	alert("Successfully Updated");
		              }
		            },
		            complete:function(){
		              window.location="index.php";
		            }
		        });
	        }
		});
	});
</script>
</html>