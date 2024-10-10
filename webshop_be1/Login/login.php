<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- link css -->
    <link rel="stylesheet" href="style.css">

    <!-- link icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" integrity="sha512-ZnR2wlLbSbr8/c9AgLg3jQPAattCUImNsae6NHYnS9KrIwRdcY9DxFotXhNAKIKbAXlRnujIqUWoXXwqyFOeIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <div class="form sign_in">
                <h3>Sign In</h3>
                <span>or use your account</span>

                <form action="../controller/sign-in.php" id="form_input" method="post">
                    <div class="type">
                        <input type="text" placeholder="username" name="username" id="username">

                    </div>
                    <div class="type">
                        <input type="password" placeholder="Password" name="password" id="password">

                    </div>

                    <div class="forgot">
                        <span>Forgot your password?</span>
                    </div>

                    <button class="btn bkg">Sign In</button>
                </form>
            </div>
    
            <div class="form sign_up">
                <h3>Sign Up</h3>
                <span>or use your email for register</span>

                <form action="../controller/sign-up.php" id="form_input" method="post">
                    <div class="type">

                        <input type="text" name="username" placeholder="Name" id="name">
                    </div>
                    <div class="type">
                        
                        <input type="email" name="email" placeholder="Email" id="email">
                    </div>
                    <div class="type">

                        <input type="password" name="password" placeholder="Password" id="password">
                    </div>

                    <button class="btn bkg">Sign Up</button>
                </form>
            </div>
        </div>

        <div class="overlay">
            <div class="page page_signIn">
                <h3>Welcome Back!</h3>
                <p>To keep with us please login with your personal info</p>

                <button class="btn btnSign-in">Sign Up <i class="bi bi-arrow-right"></i></button>
            </div>

            <div class="page page_signUp">
                <h3>Hello Friend!</h3>
                <p>Enter your personal details and start journey with us</p>

                <button class="btn btnSign-up">
                    <i class="bi bi-arrow-left"></i> Sign In</button>
            </div>
        </div>
    </div>
    

    <!-- link script -->
    <script src="script.js"></script>
</body>
</html>