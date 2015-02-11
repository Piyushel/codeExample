<h4 class='capsuleHeader'>Share your knowledge</h4>
<div class="suggestionBox dottedBottom">
    <span>Do you have any suggestion?</span>
    <?php
    require_once "./src/common/util/validation.php";
    $validation = new Validation;
    //	instanciate the validation class

    if ( ! empty ( $_POST ) &&  isset($_POST['suggestionBox'])) {
        //	name validation rules
        $validation->addField ( 'name', 'required', 'Name is required' );
        $validation->addField ( 'name', 'minLength[3]', 'Your name must contain at least 5 characters' );
        $validation->addField ( 'name', 'maxLength[80]', 'Your name must not contain more than 80 characters' );

        //	email validation rules
        $validation->addField ( 'email', 'required', 'Email is required' );
        $validation->addField ( 'email', 'validEmail', 'Please add a valid email' );

        //	message validation rules
        $validation->addField ( 'message', 'required', 'Please add some message' );
        $validation->addField ( 'message', 'minLength[10]', 'Your message must contain at least 10 characters' );
        $validation->addField ( 'message', 'maxLength[200]', 'Your message must not contain more than 200 characters' );

        //	execute the validation
        if ( $validation->execute () ) {
            //	success, send the email, save the data in the database etc.
            $connection = new connectDB();
            $insertedOn = date("Y-m-d h:i:s",time());
            $query ="INSERT INTO suggestions (name,email,suggestion,submittedOn)
                                VALUES ('$_POST[name]','$_POST[email]','$_POST[message]','$insertedOn')";
            $result = $connection->query($query);
            if ($result)
            {
                //echo("<p>save in DB atleast...</p>");
                // send main to support team in allatone
                $headers = "From: $_POST[email]";
                $subject = "Suggestion for allatone from $_POST[name]";
                $emailTo = "piyushel@allatone.info";
                $message = $_POST['message'];
                $message = str_replace("\n.", "\n..", $message);
                if(mail($emailTo, $subject , $message, $headers)){
                    echo "<div class=\"successMessage\">";
                    echo "Thanks for suggetion, we will get back to you.";
                    echo "</div>";
                } else {
                    echo("<p>Message delivery failed...</p>");
                }
            }
            $connection->close();
            $validation->emptyFieldValues();
            //	if we're here, the validation failed
        }
    }
    //Display the form..
    ?>
    <?php echo $validation->printFieldError('name') ?>
    <?php echo $validation->printFieldError ( 'email' ) ?>
    <?php echo $validation->printFieldError ( 'message' ) ?>
    <form name= "suggForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table class="suggestionBoxTable">
            <tr>
                <td><label><b>Name:</b><span class="required">*</span></label></td>
                <td>
                        <span class="textUI">
                            <input type="text" name="name" value="<?php echo $validation->getFieldValue('name')?>" size="10"/>
                        </span>
                </td>
            </tr>
            <tr>
                <td><label><b>Email:</b><span class="required">*</span></label></td>
                <td>
                        <span class="textUI">
                            <input type="text" name="email" value="<?php echo $validation->getFieldValue('email')?>" size="10"/>
                        </span>
                </td>
            </tr>
            <tr>
                <td><b>Message:</b><span class="required">*</span></td>
                <td style="float:left;">
                    <textarea name="message" rows="6" id="message"><?php echo $validation->getFieldValue('message')?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                        <span class="buttonUI">
                            <input type="submit" name="suggestionBox" value="submit"/>
                        </span>
                </td>
            </tr>
        </table>
    </form>
</div>
