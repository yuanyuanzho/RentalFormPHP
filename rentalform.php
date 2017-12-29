<!DOCTYPE html public "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> Car Rental Company</TITLE>
</HEAD>
<BODY>
    <?php
    $erroLength = count($erros);
    $successLength = count($successful);

    //validate pickup street address not be empty
    if(!empty($_POST['PICKUP_STREET_ADDRESS'])){
        $street = $_POST['PICKUP_STREET_ADDRESS'];
        $successful[] = 'You entered pickup street for car renting as '.$street;
    }else{
        $street = NULL;
        $erros[] = 'You forgot to enter pickup street for car renting!';
    }

    //validate pickup city
    if(!empty($_POST['PICKUP_CITY_NAME'])){
        $city = $_POST['PICKUP_CITY_NAME'];
        $successful[] = 'You entered pickup city for car renting as '. $city;
    }else{
        $city = NULL;
        $erros[] =  'You forgot to enter pickup city for car renting!';
    }

    //validate pickup state
    if(!empty($_POST['PICKUP_STATE'])){
        $state = $_POST['PICKUP_STATE'];
        $successful[] = 'You entered pickup state for car renting as '. $state;
    }else{
        $state = NULL;
        $erros[] =  'You forgot to enter pickup state for car renting!';
    }

    //validate pickup country
    if(!empty($_POST['PICKUP_COUNTRY_CODE'])){
        $country = $_POST['PICKUP_COUNTRY_CODE'];
        $successful[] = 'You entered pickup country for car renting as '.$country;
    }else{
        $country = NULL;
        $erros[] =  'You forgot enter pickup country for car renting!';
    }


    //pickup date
    $pickupMonth = $_POST['PICKUP_MONTH'];
    $pickupDay = $_POST['PICKUP_DAY'];
    $pickupYear = $_POST['PICKUP_YEAR'];
    $pickupHour = $_POST['PICKUP_HOUR'];
    $pickupMinute = $_POST['PICKUP_MINUTE'];
    $pickupAmPm = $_POST['PICKUP_AM_PM'];

    if($pickupAmPm == 'AM' && ($returnTime - $pickupTime) <= 0){
        $successful[] = 'You will pickup your car at '. $pickupYear.'-'.$pickupMonth.'-'.$pickupDay. ' '.$pickupHour. ':' .$pickupMinute. ' AM.';
        $pickupTime = mktime($pickupHour, $pickupMinute, 0, $pickupMonth, $pickupDay, $pickupYear);
    }else{
        $successful[] = 'You will pickup your car at '. $pickupYear.'-'.$pickupMonth.'-'.$pickupDay. ' '.$pickupHour. ':' .$pickupMinute. ' PM.';
        $pickupTime = mktime((12+$pickupHour), $pickupMinute, 0, $pickupMonth, $pickupDay, $pickupYear);
    }

    //return date
    $returnMonth = $_POST['RETURN_MONTH'];
    $returnDay = $_POST['RETURN_DAY'];
    $returnYear = $_POST['RETURN_YEAR'];
    $returnHour = $_POST['RETURN_HOUR'];
    $returnMinute = $_POST['RETURN_MINUTE'];
    $returnAmPm = $_POST['RETURN_AM_PM'];

    if($returnAmPm == 'AM' && ($returnTime - $pickupTime) <= 0){
        $successful[] = 'You will return your car at '. $returnYear.'-'.$returnMonth.'-'.$returnDay. ' '.$returnHour. ':' .$returnMinute. ' AM';
        $returnTime = mktime($returnHour, $returnMinute, 0, $returnMonth, $returnDay, $returnYear);
    }else{
        $successful[] = 'You will return your car at '. $returnYear.'-'.$returnMonth.'-'.$returnDay. ' '.$returnHour. ':' .$returnMinute. ' PM';
        $returnTime = mktime((12+$returnHour), $returnMinute, 0, $returnMonth, $returnDay, $returnYear);
    }

    if(($returnTime - $pickupTime) <= 0){
        $erros[] = 'Return date should be later than pickup date!';
    }

    //airline
    $airline = $_POST['AIRLINE_CODE'];
    $flight = $_POST['FLIGHT_NUMBER'];

    if(!empty($airline) && !empty($flight)){
        $successful[] = 'Your airline code is '.$airline;
        $successful[] = 'Your flight number is '.$flight;
    }else if(empty($airline) && empty($flight)){
        $successful[] = 'You did not select any airline and flight number.';
    } else{
        $erros[] = 'You have to select both airline code and flight number!';
    }

    //child seat
    $infantSeat = $_POST['CHILD_INFANT_SEAT'];
    $infantSeatQty = $_POST['CHILD_INFANT_SEAT_QUANTITY'];
    $safetySeat = $_POST['CHILD_SAFETY_SEAT'];
    $safetySeatQty = $_POST['CHILD_SAFETY_SEAT_QUANTITY'];
    $boosterSeat = $_POST['CHILD_BOOSTER_SEAT'];
    $boosterSeatQty = $_POST['CHILD_BOOSTER_SEAT_QUANTITY'];

    if(!empty($infantSeat) && !empty($infantSeatQty)){
        $successful[] = 'You selected '.$infantSeatQty. ' infant seat(s).';
    }else if(empty($infantSeat) && empty($infantSeatQty)){
        $successful[] = 'You did not select any Infant Seats.';
    } else{
        $erros[] = 'You have to select both Infant Seats and its Quantity';
    }

    if(!empty($safetySeat) && !empty($safetySeatQty)){
        $successful[] = 'You selected '.$safetySeatQty. ' safety seat(s)';
    }else if(empty($safetySeat) && empty($safetySeatQty)){
        $successful[] = 'You did not select any Safety Seats.';
    } else{
        $erros[] = 'You have to select both Safety Seats and its Quantity';
    }

    if(!empty($boosterSeat) && !empty($boosterSeatQty)){
        $successful[] = 'You selected '.$boosterSeatQty. ' booster seat(s)';
    }else if(empty($boosterSeat) && empty($boosterSeatQty)){
        $successful[] = 'You did not select any Booster Seats.';
    } else{
        $erros[] = 'You have to select both Booster Seats and its Quantity';
    }

   //validate car type
    if(!empty($_POST['CAR_GROUP_CODE'])){
        $car = $_POST['CAR_GROUP_CODE'];
        $successful[] = 'You entered pickup car type for car renting as '.$car;
    }else{
        $car = NULL;
        $erros[] =  'You forgot to enter car type for car renting!';
    }

    //loss damage
    $cdw = $_POST['CDW_ACCEPT'];
    if(!empty($cdw)){
        $successful[] = 'You selected Loss Damage Waiver(22.99 USD per day)';
    }

    //personal accident
    $pai = $_POST['PAI_ACCEPT'];
    if(!empty($pai)){
        $successful[] = 'You selected Personal Accident insurance (22.99 USD per day)';
    }

    //additional liability 
    $ali = $_POST['ALI_ACCEPT'];
    if(!empty($api)){
        $successful[] = 'Additional Liability Insurance (11.99 USD per day)';
    }

    //first name
    if(!empty($_POST['FIRST_NAME'])){
        $firstName = $_POST['FIRST_NAME'];
        $successful[] = 'You entered your first name for car renting is '.$firstName;
    }else{
        $firstName = NULL;
        $erros[] =  'Please enter your first name!';
    }

    //last name
    if(!empty($_POST['LAST_NAME'])){
        $lastName = $_POST['LAST_NAME'];
        $successful[]  = 'You entered your last name for car renting is '.$lastName;
    }else{
        $lastName = NULL;
        $erros[] =  'Please enter your last name!';
    }

    //email
    if(!empty($_POST['EMAIL_ADDRESS'])){
        $email = $_POST['EMAIL_ADDRESS'];
        $successful[] = 'You entered your email address for car renting is '.$email;
    }else{
        $email = NULL;
        $erros[] = 'Please enter your email address!';
    }

    echo '<h1>Welcome to Car Renting Company</h1>';
    $flag = true;
    $count = 0;
	foreach($erros as $value){
        if($flag == true){
            echo '<b><font color="red">Here is the List of the Errors on the information submitted:</font></b><br/><br/>';
        }
        echo '&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">'.$value.'</font><br>';
        $flag = false;
        $count++;
	}

    echo '<p><b>Here is all the information submitted you submitted for Renting the Car:</b></p>';
    foreach($successful as $value){
        echo '&nbsp;&nbsp;&nbsp;&nbsp;<font color="black">'.$value.'</font>';
        echo '<br>';
    }


    if($count != 0){
        echo '<p>You have <font color="red">'.$count.'</font> errors. Please go back and correct them.<br>';
        echo '<a href="rentalform.html">Go Back</a></p>';
    }

    ?>
</BODY>
</HTML>