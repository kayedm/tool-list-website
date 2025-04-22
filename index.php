<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add authorship metadata and link CSS and JS files -->
    <link rel="stylesheet" href="styles.css">
    <title>Main Page</title>
</head>

<body>
    <header>
        <nav>
            <a class=nav id=nav-home href="index.php">Home</a>
            <div class="nav-center">
            <button id="login" onclick="document.getElementById('id01').style.display='block'">Login</button>
            <button id="signup" onclick="document.getElementById('id02').style.display='block'">Sign up</button>
        </nav>
    </header>


    <p><strong>Login to start tracking tools !</strong></p>

    <!--  Login Form  -->
    <div id="id01" class="modal">
        <div class="modal-content">
            <span class="close" title="Close Modal"
                onclick="document.getElementById('id01').style.display='none'">&times;</span>
            <form id="loginform" class="modal-form" action="login.php" method="post" autocomplete="off">
                <h1>Login</h1>
                <hr>

                <div>
                    <label for="email"><b>Email</b></label>
                    <input id="email" type="text" placeholder="Enter Email" name="email" autocomplete="off">
                    <div class="error"></div>
                </div>

                <div>
                    <label for="password"><b>Password</b></label>
                    <input id="password" type="password" placeholder="Enter Password" name="password" autocomplete="off">
                    <div class="error"></div>
                </div>

                <div class="clearfix">
                    <button type="submit" class="loginbtn">Log in</button>
                </div>
            </form>
        </div>
    </div>

    <!--  Sign up Form  -->
    <div id="id02" class="modal">
        <div class="modal-content">
            <span class="close" title="Close Modal"
                onclick="document.getElementById('id02').style.display='none'">&times;</span>
            <form id="signupform" class="modal-form" action="signup.php" method="post">
                <h1>Sign Up</h1>
                <hr>

                <div>
                    <label for="signup-name"><b>Name</b></label>
                    <input id="signup-name" type="text" placeholder="Enter Name" name="name" autocomplete="off">
                    <div class="error"></div>
                </div>

                <div>
                    <label for="signup-email"><b>Email</b></label>
                    <input id="signup-email" type="text" placeholder="Enter Email" name="email" autocomplete="off">
                    <div class="error"></div>
                </div>

                <div>
                    <label for="signup-password"><b>Password</b></label>
                    <input id="signup-password" type="password" placeholder="Enter Password" name="password" autocomplete="off">
                    <div class="error"></div>
                </div>

                <div>
                    <label for="signup-password2"><b>Repeat Password</b></label>
                    <input id="signup-password2" type="password" placeholder="Repeat Password" name="password2" autocomplete="off">
                    <div class="error"></div>
                </div>

                <div id="tos">
                    <p> By creating an account you agree to our
                        <a href="#">Terms & Privacy</a>.
                    </p>
                </div>

                <div class="clearfix">
                    <button type="submit" class="signupbtn">Sign Up</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('id01');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('id02');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        window.addEventListener("DOMContentLoaded", () => {
            const darkModeSetting = localStorage.getItem("darkMode");
            if (darkModeSetting === "enabled") {
                document.body.classList.add("dark-mode");
            }
        });
        
    </script>

    <script src="js/script.js"></script>

</body>

</html>