<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<base href="<?php echo $this->config->item('base_url') ?>" />
<link rel="stylesheet" href="www/css/normalize.css" type="text/css" media="screen" />
<link rel="stylesheet" href="www/css/style.css" type="text/css" media="screen" />
<script src="www/js/jquery-1.9.1.js" type="text/javascript"></script>

<title>
<?=$title?>
</title>
</head>

<body>
  <div class="container-fluid">
  <div class="row-fluid">
  <div class="span12">
  <!-- create some empty space -->
  </div>
  </div>
  <div class="row-fluid">
    <div class="span2">
    <div class="row-fluid">
    	<div class="span12">
        </div>
        <div class="span12">
        </div>
        </div>
      <div class="row-fluid">
    	<div class="span12">	
      	<!--Sidebar content-->
      		<?php include 'includes/sidemenu.php';?>
  		</div>
        </div>
   
    </div>
    <div class="span6">
      <!--Body content--> 
      <section>
        
          <div class="page-header">
            <h1>
	            <?=$heading?>
	        </h1>
          </div>
        <?php if($this->session->flashdata('message') == "success"){?>
            <div class="alert alert-success">
				<strong>Tack för din anmälan!</strong> 
                <br>
                Du hittar ditt namn under Anmälda i tabellen längst ner på denna sida under det pass du bokat in dig på. 
                Vi ses på soppköket!
			</div>
		<?php }?>  
          
         <?php if($this->session->flashdata('message') == "failure"){?>
            <div class="alert alert-success">
				<strong>Något gick fel!</strong> 
                <br>
                Tyvärr gick det inte att göra en anmälan, testa igen. Om det inte går kontakta soppkokmalmo@gmail.com
			</div>
		<?php }?>   
          
        <div class="alert alert-info alert-block">
        <strong>Du kan bara anmäla dig till ETT pass av de nedan.</strong> Fyll i ditt namn, nummer och epost adress samt kryssa i om du har körkort, bil och 
möjlighet att köra.
        Pass 1 är mellan 11.00 - 14.15 och Pass 2 mellan 13.45 - 17.00<br>Tack!
        </div>
          
          <?php  if (validation_errors()) { ?>
		    <div class="alert alert-error">
		   <? echo validation_errors();?>
           	</div>
		 <?php  }?>
        
            <?=form_open('booking/index');?> <!--'booking->bookingModel->createBooking'-->
            <p>
              <input type="text" class="span3"  placeholder="Förnamn" name="firstname">
              <input type="text" class="span4"  placeholder="Efternamn" name="lastname">
            </p>
            <p> 
              <input type="text" class="span3"  placeholder="Telefon" name="phone">
              <input type="text" class="span4"  placeholder="Epost" name="email">
            </p>
            <p>
            <select id="shift" name="shift" class="span3">
              <option value="0">--- Välj pass ---</option>
              <option value="1">Pass 1</option>
              <option value="2">Pass 2</option>
            </select>
			<select id="section" name="section">
				<option id="defaultSection" value="0">-</option>
			</select>

            </p>
              <button type="submit" class="btn btn btn-primary">Anmäl</button>
            <?=form_close();?>
  
			<?php if($records) {?>
			<pre>
				<?php //print_r($records);?>
		    </pre>	
				
				
             	<div class="well" >
		          <h2>Anmälda</h2>
		          	<p>
						 <h4>Pass 1 (11.00 - 14.15)</h4>
						    <table class="table table-striped">
						     	<?php foreach($records as $row) : ?>
						           <?php if ($row->shiftId =="1"){?>
						                <tr>
											<td><?=$row->sectionName?></td>
						                	<td><?=$row->firstname?></td>
						                	<td><?=$row->lastname?></td>
						                </tr>
						           <?php } ?> <!-- end if-->
						        <?php endforeach; ?>
						      </table>
						      <hr>
						      <h4>Pass 2 (13.45 - 17.00)</h4>
						      <table class="table table-striped">
						      	<?php foreach($records as $row) : ?>
						           <?php if ($row->shiftId =="2"){?>
						                <tr>
											<td><?=$row->sectionName?></td>
						                	<td><?=$row->firstname?></td>
						                	<td><?=$row->lastname?></td>
						                </tr>
						           <?php } ?> <!-- end if-->
						        <?php endforeach; ?>
						        </table>


							
		           	</p>	
		            <hr>
		        </div>
				<?php }?> <!-- end if records-->
             
      </section>
    </div>
  </div>
</div>
</body>
</html>

<!-- JavaScript goes here -->
 <script type="text/javascript">
	$('#shift').change(function() {
		$('#section')
		    .empty()
		    .append('<option selected="selected" value="whatever">--- Välj sektion ---</option>')
		;
	    //Hämta ut vilket pass som är valt
		var selected = $('#shift').val();
		var form_data = {
				shift: selected	
			};
			
		$.ajax({
				url: "<?php echo site_url('booking/section'); ?>",
				type: 'POST',
				data: form_data,
				success: function(msg) {
					var obj = jQuery.parseJSON(msg);
				    if(obj){
						//$('#section').options.length = 1;//remove all destinations if any
						$.each(obj, function(key, value) {
					 	
							$('#section').append($('<option>', { 
					        	value: key,
					        	text : value 
					    	}));
					
						});	
					}
				}
			});
	});
	</script>