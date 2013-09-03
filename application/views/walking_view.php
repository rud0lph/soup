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
                <br>
                Du hittar ditt namn under Anmälda i tabellen längst ner på denna sida under den/de nattvandring(ar) du bokat in dig på. 
                Vi ses där!
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
        <strong>Du kan anmäla dig till en eller flera nattvandringar.</strong>
        Fyll i ditt namn, ditt telefonnummer och epost för varje vandring du anmäler dig till.
        Vi ses på Malmö Centralstation kl 20.00 varje nattvandringskväll. Vi skickar mail samma dag som nattvandringen är med
        kontaktuppgifter till de övriga som ska vandra den kvällen. Tack för din hjälp!
        </div>
       
      
       <?php  if (validation_errors()) { ?>
		    <div class="alert alert-error">
		   <? echo validation_errors();?>
           	</div>
		 <?php  }?>
       
        <?=form_open();?> <!--'walking/bookWalk'-->
        <fieldset>
          <p>
          <input type="text" class="span3" value="<?php echo set_value('firstname'); ?>" placeholder="Förnamn" name="firstname" >
          <input type="text" class="span3" value="<?php echo set_value('lastname'); ?>"  placeholder="Efternamn "name='lastname' >
          </p>
          <p>
          <input type="text" class="span3" value="<?php echo set_value('phone'); ?>" placeholder="Telefon" name='phone' >
          <input type="text" class="span3" value="<?php echo set_value('email'); ?>" placeholder="Epost" name='email' >
          </p>
          <p>
          	<select name="walk" class="span3">
              <option value="0">--- Välj Nattvandring ---</option>
              <option value="1">Laddas dynamiskt 1</option>
              <option value="2">Laddas dynamiskt 2</option>
              <option value="3">Laddas dynamiskt 3</option>
            </select>
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