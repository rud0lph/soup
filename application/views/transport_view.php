<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<base href="<?php echo $this->config->item('base_url') ?>" />
<link rel="stylesheet" href="www/css/normalize.css" type="text/css" media="screen" />
<link rel="stylesheet" href="www/css/style.css" type="text/css" media="screen" />
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
                Vår transportansvarige kommer kontakta dig.
			</div>
		<?php }?>  
          
         <?php if($this->session->flashdata('message') == "failure"){?>
            <div class="alert alert-error">
				<strong>Något gick fel!</strong> 
                <br>
                Tyvärr gick det inte att göra en anmälan, testa igen. Om det inte går kontakta soppkokmalmo@gmail.com
			</div>
		<?php }?>  
        
        
       <div class="alert alert-info" alert-block>
        <strong>Här kan du anmäla dig om du kan hjälpa till och köra.</strong> Tänk på att bensin får du stå för själv om du kör egen bil.
        I dagsläget har vi inte resurser att stå för det. Fyll i namn, nummer, epost, om du har tillgång till bil, körkort och skriv gärna en kommentar om din tillgänglighet.
        Vi behöver hjälp både dagarna innan och under själva soppköksdagen.
        </div>
       
      
       <?php  if (validation_errors()) { ?>
		    <div class="alert alert-error">
		   <? echo validation_errors();?>
           	</div>
		 <?php  }?>
       
        <?=form_open();?> 
        <fieldset>
          <p>
              <input type="text" class="span3"  placeholder="Förnamn" name="firstname">
              <input type="text" class="span4"  placeholder="Efternamn" name="lastname">
            </p>
            <p> 
              <input type="text" class="span3"  placeholder="Telefon" name="phone">
              <input type="text" class="span4"  placeholder="Epost" name="email">
            </p>
          <p>
          <label class="checkbox">
                  <input type="checkbox" name="canDrive" value="1" <?php echo set_checkbox('canDrive', '1');?> >
                  Kan köra </label>
          <label class="checkbox">
                  <input type="checkbox" name="hasCar" value="1" <?php echo set_checkbox('hasCar', '1');?>>
                  Har tillgång till bil </label>
           
          </p>
          <p>
          <label>Kommentar:</label>
          <textarea rows="3" name="comment" class="span7"></textarea>
          </p>
         
          <p>
            <button type="submit" class="btn btn-primary" >Anmäl</button>
          </p>
        </fieldset>
        <?=form_close();?>
   		<?php if($records) {?>
		<div class="well" >
          <h2>Anmälda</h2>
          	<p>
					
         			<?php foreach($records as $row) : ?>
						<p><?php echo $row->firstname . " " . $row->lastname;  ?></p>
					<?php endforeach; ?>
					
						
           	</p>	
            <hr>
        </div>
		<?php }?><!-- end if records-->
        
        
      </section>
    </div>
  </div>
</div>
</body>
</html>