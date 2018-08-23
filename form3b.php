
<!-- GRANT SCHORGL -->
<?php
//============== CONSTANTS =========== GRANT SCHORGL
	
				
	define('SINGLE14', 5156.00);
	define('SINGLE19',5377.00);
	define('DUEL14', 3211.00);	
	define('DUEL19',3432.00);
	define('SECONDFEE',26.54);
	define('FIRSTFEE',73.10);
	define('PRIVILEGEFEE',365.04);
	define('INSTATE', 284.40);
	define('OUTOFSTATE', 755.20);
	$PRIVLAGEFEE = '';
	$TUITION = '';
	$HOUSING = '';
	$NAME = '';
	$STATE = '';
	$error = '';
	
	$hourserror = false;
	$stateerror = false; 
	$housingerror = false;	
	$nameerror = false;	
	?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>HTML5 Template</title>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<style>
body{
background-color: #512888;
color: #FFFFFF;}
</style>
<body>
<?PHP
		
	 if(isset($_POST['submit'])) 
	{		
		//SET NAME 
		if (empty($_POST['name'])) 
		{
			$nameerror = true;
		}
		else  	
		{
			$NAME = $_POST['name'];
		}
		
		//detect and calculate college/campus fees
		$TOTALFEE = "";
		$HOURS = $_POST['hours'];
		if ($HOURS == 0) 	
		{
			$hourserror = true;
			}
		else 
		{	
			if ($HOURS >= 12) 	
				{$TOTALFEE += PRIVILEGEFEE;}
			else
			{
				$placeholder = '';
				$placeholder = $HOURS-1;
				$placeholder *= SECONDFEE;
				$placeholder += FIRSTFEE;
				$TOTALFEE += $placeholder;
			}
		}
				
		//detect in or out of state 		
		$TOTALSTATE = "";
		$STATE = '';
		if (isset($_POST['state']) && $_POST['state'] == "OutOfState" )
		{
			$TOTALSTATE = OUTOFSTATE * $HOURS;
		}
		elseif(isset($_POST['state']) && $_POST['state'] == "InState" )
		{
			$TOTALSTATE = INSTATE * $HOURS;
		}
		else 
		{
			$stateerror = true;
		}
			
		// calculate tuition
		$TUITION = $TOTALSTATE + $TOTALFEE;
			
		$HOUSING = '';
		if (!isset($_POST['housing']))
		{
			$housingerror = true;
		}
		else
		{	
			if (isset($_POST['housing']) && ($_POST['housing'] == "offcampus")) 
			{
				$HOUSING = 0;
			}
			elseif (isset($_POST['housing']) && ($_POST['housing'] == "single14")) 
			{
				$HOUSING = SINGLE14;
			}
			elseif (isset($_POST['housing']) && ($_POST['housing'] == "single19"))
			{
				$HOUSING = SINGLE19;
			}
			elseif (isset($_POST['housing']) && ($_POST['housing'] == "duel14"))
			{
				$HOUSING = DUEL14;
			}
			elseif (isset($_POST['housing']) && ($_POST['housing'] == "duel19"))
			{
				$HOUSING = DUEL19;
			}
			else 
			{
				$housingerror = true; 
			}
		}
		//validation
		
		if ($hourserror == true){
			echo "<p style='color:red;'>ERROR: you aren't taking any hours</p>";
		}
		else 
		{	
			echo $HOURS. 'no error';
		}
		if ($stateerror == true){
			echo "<p style='color:red;'>ERROR: select In-state or Out-of-state.</p>";
		}
		else 
		{
			echo $STATE;
			
		}
		
		if ($housingerror == true){
			echo "<p style='color:red;'>ERROR: please select housing and a meal plan for living</p>";
		}
		else 
		{
			echo $HOUSING;
		}
		if ($nameerror == true){
			echo "<p style='color:red;'>ERROR: Name is empty</p>";
		}
		else 
		{
			echo $NAME;
		}
		
	}

		if (isset($_POST['name']) && isset($_POST['hours']) && isset($_POST['state']) && isset($_POST['housing']))
		{
				echo "Welcome ". $NAME . '!';
				echo nl2br("\n");
				$TOTAL=$TOTALSTATE+$HOUSING+$TOTALFEE;
				echo nl2br("\n");
				echo 'Your cost of housing and meals: $'.number_format( $HOUSING,2).nl2br("\n");
				echo 'With ' . $HOURS . ' hours your class total is: $'.number_format( $TOTALSTATE,2).nl2br("\n");
				//echo 'Your dinning cost is $'.number_format( $MEALPLAN,2).nl2br("\n");
				echo 'Your fees are $';
				echo number_format($TOTALFEE,2);
				echo nl2br("\n");
				echo 'your class total is: $'.number_format( $TUITION,2).nl2br("\n");
				echo "Your total cost this semester is $".number_format($TOTAL,2).nl2br("\n");
		}
	
		else { ?>
	<form action="form3b.php" method="post">
		<fieldset><legend>Please fill out the form below to calculate your cost at KSU Salina</legend>
		<p><label>Name: <input type="text" name="name" size="20" maxlength="40" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"/></label></p>
		<p><label>How many hours are you taking?<select name="hours">
			<option value="0"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '0')) echo ' selected="selected"'; ?> >0 hour</option>
			<option value="1"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '1')) echo ' selected="selected"'; ?> >1 hour</option>
			<option value="2"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '2')) echo ' selected="selected"'; ?> >2 hours</option>
			<option value="3"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '3')) echo ' selected="selected"'; ?> >3 hours</option>
			<option value="4"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '4')) echo ' selected="selected"'; ?> >4 hours</option>
			<option value="5"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '5')) echo ' selected="selected"'; ?> >5 hours</option>
			<option value="6"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '6')) echo ' selected="selected"'; ?> >6 hours</option>
			<option value="7"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '7')) echo ' selected="selected"'; ?> >7 hours</option>
			<option value="8"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '8')) echo ' selected="selected"'; ?> >8 hours</option>
			<option value="9"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '9')) echo ' selected="selected"'; ?> >9 hours</option>
			<option value="10"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '10')) echo ' selected="selected"'; ?> >10 hours</option>
			<option value="11"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '11')) echo ' selected="selected"'; ?> >11 hours</option>
			<option value="12"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '12')) echo ' selected="selected"'; ?> >12 hours</option>
			<option value="13"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '13')) echo ' selected="selected"'; ?> >13 hours</option>
			<option value="14"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '14')) echo ' selected="selected"'; ?> >14 hours</option>
			<option value="15"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '15')) echo ' selected="selected"'; ?> >15 hours</option>
			<option value="16"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '16')) echo ' selected="selected"'; ?> >16 hours</option>
			<option value="17"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '17')) echo ' selected="selected"'; ?> >17 hours</option>
			<option value="18"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '18')) echo ' selected="selected"'; ?> >18 hours</option>
			<option value="19"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '19')) echo ' selected="selected"'; ?> >19 hours</option>
			<option value="20"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '20')) echo ' selected="selected"'; ?> >20 hours</option>
			<option value="21"<?php if (isset($_POST['hours']) && ($_POST['hours'] == '21')) echo ' selected="selected"'; ?> >21 hours</option>
		</select></label></p>

		<p><label>Instate or out of state student?<br>
			<input type="radio" name="state" value="InState" <?php if (isset($_POST['state']) && ($_POST['state'] == 'InState')) echo ' checked="checked"'; ?>/> Instate <br> 
			<input type="radio" name="state" value="OutOfState" <?php if (isset($_POST['state']) && ($_POST['state'] == 'OutOfState')) echo ' checked="checked"'; ?>/> Out of state</label><br></p>

		<p><label>Housing and Meal plan?<br>
			<input type="radio" name="housing" value="offcampus"<?php if (isset($_POST['housing']) && ($_POST['housing'] == 'offcampus')) echo ' checked="checked"'; ?> /> Off Campus<br></label>
			<input type="radio" name="housing" value="single14" <?php if (isset($_POST['housing']) && ($_POST['housing'] == 'single14')) echo ' checked="checked"'; ?>/> Single room with 14 meals per week.<br>
			<input type="radio" name="housing" value="single19" <?php if (isset($_POST['housing']) && ($_POST['housing'] == 'single19')) echo ' checked="checked"'; ?>/> Single room with 19 meals per week.<br>
			<input type="radio" name="housing" value="duel14" <?php if (isset($_POST['housing']) && ($_POST['housing'] == 'duel14')) echo ' checked="checked"'; ?>/> Double room with 14 meals per week.<br>
			<input type="radio" name="housing" value="duel19" <?php if (isset($_POST['housing']) && ($_POST['housing'] == 'duel19')) echo ' checked="checked"'; ?>/> Double room with 19 meals per week. <br></label></p>
			
		<input class="submit" type="submit" name="submit" value="Submit">
		</fieldset>
	</form>
		<?PHP } ?>
</body>
</html>





