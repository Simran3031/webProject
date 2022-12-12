<?php

require('connection.php');

if(isset($_POST['update']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email'])) 
{
     // Sanitize user input to escape HTML entities and filter out dangerous characters.
 $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

// file_upload_path() - Safely build a path String that uses slashes appropriate for our OS.
    // Default upload path is an 'uploads' sub-folder in the current folder.
 function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') 
 {
     $current_folder = dirname(__FILE__);

       // Build an array of paths segment names to be joins using OS specific slashes.
     $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];

       // The DIRECTORY_SEPARATOR constant is OS specific.
     return join(DIRECTORY_SEPARATOR, $path_segments);
 }



    // file_is_an_image() - Checks the mime-type & extension of the uploaded file for "image-ness".
 function file_is_an_image($temporary_path, $new_path) {
    $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
    $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
    
    $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
    $actual_mime_type        = getimagesize($temporary_path)['mime'];
    
    $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
    $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
    
    
    return $file_extension_is_valid && $mime_type_is_valid;

}



if(isset($_FILES) && ($_FILES['image']['error'] === 0) && !isset($_POST['check']))
{

    $image_filename        = $_FILES['image']['name'];
    $temporary_image_path  = $_FILES['image']['tmp_name'];
    $new_image_path        = file_upload_path($image_filename);
    if (file_is_an_image($temporary_image_path, $new_image_path)) {
        move_uploaded_file($temporary_image_path, $new_image_path);

    }
    $query = "UPDATE users SET firstname = :firstname ,lastname = :lastname ,email = :email, profile_picture = :image_filename WHERE user_id = :user_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':firstname',$firstname);
    $statement->bindValue(':lastname',$lastname);
    $statement->bindValue(':image_filename',$image_filename);
    $statement->bindValue(':email',$email);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);

    $statement->execute();

    echo '<script>alert("Update successful");
    window.location.href="users.php";</script>';

}
elseif((!$_FILES['image']['name'] ) && !isset($_POST['check']))
{
    $query = "UPDATE users SET firstname = :firstname ,lastname = :lastname ,email = :email  WHERE user_id = :user_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':firstname',$firstname);
    $statement->bindValue(':lastname',$lastname);
    $statement->bindValue(':email',$email);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);

    $statement->execute();

    echo '<script>alert("Update successful");
    window.location.href="users.php";</script>';

}
// // elseif((!isset($_FILES) && !isset($_POST['check']) ))
// // {
// //     $query = "UPDATE users SET firstname = :firstname ,lastname = :lastname ,email = :email ,password = :password  WHERE user_id = :user_id";
// //     $statement = $db->prepare($query);
// //     $statement->bindValue(':firstname',$firstname);
// //     $statement->bindValue(':lastname',$lastname);
// //     $statement->bindValue(':email',$email);
// //     $statement->bindValue(':password',$password);
// //     $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);

// //     $statement->execute();

// //     echo '<script>alert("Update successful");
// //         window.location.href="update-profile.php";</script>';

// // }
elseif(isset($_POST['check']))
{
    $profile = null;
    $query = "UPDATE users SET firstname = :firstname ,lastname = :lastname  ,email = :email, profile_picture = null WHERE user_id = :user_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':firstname',$firstname);
    $statement->bindValue(':lastname',$lastname);
    $statement->bindValue(':email',$email);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);

    $statement->execute();

    echo '<script>alert("Update successful");
    window.location.href="users.php";</script>';
}


    //header("Location: login.php");
//exit();
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
elseif(isset($_POST["changePassword"])) 
{
   
    if(!isset($_POST['newPassword']) || empty($_POST['newPassword']))
    {
        echo '<script>alert("Please enter your new password");
        window.location.href="update-profile.php";</script>';
        exit(0);
    }
    elseif(!isset($_POST['renterPassword']) || empty($_POST['renterPassword']))
    {
        echo '<script>alert("Please re-enter your password");
        window.location.href="update-profile.php";</script>';
        exit(0);
    }
     elseif(!empty($_POST['newPassword']) &&  !empty($_POST['renterPassword']) )
    {
      
        $user_id = $_POST['user_id'];
        $newPassword = $_POST['newPassword'];
        $renterPassword = $_POST['renterPassword'];

        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();

        if($statement->rowCount() > 0)
        {


           //Fetch row.
            $user= $statement->fetch(PDO::FETCH_ASSOC);
                if($newPassword == $renterPassword)
                {
                    $options = array("cost"=>4);
                    $hash_default_salt = password_hash($newPassword,PASSWORD_DEFAULT,$options);

                    $query = "UPDATE users SET password = :hash_default_salt  WHERE user_id = :user_id";
                    $statement = $db->prepare($query);
                    $statement->bindValue(':hash_default_salt',$hash_default_salt);
                    $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);

                    $statement->execute();

                    echo '<script>alert("Password Updated");
                    window.location.href="users.php";</script>';
                   
                }
            
            else
            {
                     echo '<script>alert("Incorrect Password");
                    window.location.href="users.php";</script>';
            }


 
        }

    }
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

elseif(isset($_POST["delete"])) 
{
   
   $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);

    $query = "DELETE FROM users WHERE user_id = :user_id ";
    $statement = $db->prepare($query);

    $statement->bindValue(':user_id', $user_id);

    $statement->execute();

    echo '<script>alert("User Deleted");
                    window.location.href="users.php";</script>';
        exit;
}
?>