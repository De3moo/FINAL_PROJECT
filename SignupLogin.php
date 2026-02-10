<?php

include("Database.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = isset($_POST['email-signup']) ? $_POST['email-signup'] : '';
  $password = isset($_POST['password-signup']) ? $_POST['password-signup'] : '';
  $errors = array();
  
    
    // Database connection is now handled by Database.php

if (!empty($email) && !empty($password)) {

  // Check if email already exists
  $check_email_query = "SELECT COUNT(*) AS email_count FROM users WHERE email = ?";
  $stmt_check = $conn->prepare($check_email_query);
  $stmt_check->bind_param("s", $email);
  $stmt_check->execute();
  $result = $stmt_check->get_result(); // Get the result

  $row = $result->fetch_assoc(); // Fetch the first row

  if ($row['email_count'] > 0) {
    echo "<script>alert('Email already exist')</script>";

  } else {
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
          $stmt->bind_param("ss", $email, $password);

          // Execute the query
          if ($stmt->execute()) {
            echo "<script>alert('Sign up Successfully')</script>"; 
            header('Location:SignupLogin.php');
            
            //header("Location: SignupLogin.php"); // Redirect upon success
              
          } else {
              echo "Error creating account"; // Handle any errors
          } }

  $stmt_check->close(); // Close the prepared statement (check)
  $result->close(); // Close the result set
}
}



// ... existing code ...

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diaryhea</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="New.css">
   

</head>
<body ">
  
           


         <div id="header">
         <div class="container">
            <nav>
             
                <h1 class="text-white"> Diaryhea</h1>
                
                <ul id = "sidemenu">
                    <li><a href="#header">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <button class ="login" id="form-open">Login</button>
                    <i class="fas fa-times" onclick ="closemenu()"></i>
                </ul>
                <i class="fas fa-bars" onclick ="openmenu()"></i> 
                
            </nav>
            <div class="header-text">
            <h1>  Let the Words Pour Out, Unfiltered and Unapologetic <br> Where Your Thoughts Run Wild and Uncensored!</h1>
            </div>
         
         
         
            <!--Home-->
     <section class = "home">
       <div class = "form_container">
        <i class = "uil uil-times form_close"></i>
        
        <!--Login Form-->
   <div class="form login_form">
  <form action = "Connect.php" method="post">
    <h2>Login</h2>
    <div class="input_box">
      <input type="email" name="email-Login"  placeholder="Enter your email" required />
      <i class="uil uil-envelope-alt email"></i>
    </div>
    <div class="input_box">
      <input type="password"  name="password-Login"  placeholder="Enter your password" required />
      <i class="uil uil-lock password"></i>
      <i class="uil uil-eye-slash pw_hide"></i>
    </div>
    <button class= "button text-white" type ="submit" name="submit">Login</button>

   <div class = "login_signup">Don't have an account? <a href="#" id = "signup">Sign up</a></div>
   </form>
   </div> 
    
        <!--Signup form-->
     <div class="form signup_form">
    <form action="SignupLogin.php" method="post">
    <h2>Signup</h2>
    <div class="input_box">
      <input type="email" name="email-signup" class="form-control checking_email" placeholder="Enter your email" autofocus required />
      <i class="uil uil-envelope-alt email"></i>
      <small class ="error_email" style="color: red;"> </small>
    </div>
    

 
    <div class="input_box">
      <input type="password" name="password-signup" placeholder="Create password" required />
      <i class="uil uil-lock password"></i>
      <i class="uil uil-eye-slash pw_hide"></i>
    </div>
    <button class= "button text-white">Signup</button>

    <div class = "login_signup">Already have an account? <a href="#" id = "Login">Login</a></div>
    </form>
       </div>  

       </div>
       </section>


       <!--Scripts-->
     <script src ="New.js"></script>
     <script src ="sidemenu.js"></script>
     
         </div>
   </div> 


     <!--ABOUT SECTION-->
     <div id ="about">
      <div class = "container">
         <div class="row">
          <div class="about-col-1">
            <img src="Image/Daily journal.png">
          </div>
          <div class="about-col-2"> 
           <h1 class ="subtitle">About us</h1> 
          <p>Welcome to Diaryhea, a unique platform where the timeless art of journaling seamlessly merges 
            with the digital age. Our mission is to create a haven for individuals seeking a safe and inspiring 
            space to articulate their thoughts, emotions, and experiences through the transformative medium of electronic diaries. 
            n a world that increasingly revolves around technology, Diaryhea stands as a beacon, inviting users to explore the depths 
            of self-reflection and personal expression within the comfort of a virtual environment. We understand the importance of 
            fostering a sense of security, encouraging users to open up and share their innermost thoughts without fear of judgment. 
            By harnessing the power of cutting-edge technology, we aim to redefine the traditional concept of journaling, providing a 
            dynamic and interactive platform that empowers individuals on their journey of self-discovery. Whether documenting daily 
            musings, capturing significant life events, or simply engaging in a therapeutic release, Diaryhea is committed to being 
            the digital companion that nurtures personal growth and introspection. Join us in this exciting fusion of tradition and 
            innovation, where the possibilities for self-expression are limitless, and the electronic diary becomes a powerful tool for 
            connection, understanding, and self-discovery.</p>
          </div>
         </div>
      </div>
     </div>

             

</body>
</html>
