<?php 
  require_once "./phpfunkcije/db_funkcije.php"; 

  if(isset($_POST["create"])){
    try{
      writeAccountToDatabase();
    } catch(Exception $e){
      die($e); 
    }
  }
?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <link rel="stylesheet" href="css/signup.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
</head>
<body>
<?php include './subtabs/navigacija.php'; ?>

  <div class="signup-container">
    <div class="signup-box">
      <h1>Create Account</h1>
      <form action="#" method="post" name="register">
        <div class="input-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="input-group">
          <label for="repeatPassword">Repeat Password</label>
          <input type="password" id="repeatPassword" name="repeatPassword" required>
        </div>
        <div class="button-group">
          <button class="create" name="create" type="submit">Create Account</button>
        </div>
      </form>
      <div class="button-group">
        <button class="back" type="button" onclick="window.history.back()">Back</button>
      </div>
    </div>
  </div>

  <script>

    $(function(){

        $("form[name='register']").validate({

            rules:{

                username:{

                    required: true,

                    minlength: 6,

                    maxlength: 40

                },

                password:{

                    required: true,

                    minlength: 8,

                    maxlength: 128

                },

                repeatPassword:{

                    required: true,

                    equalTo: '#password'

                }

            },

            messages:{

                username:{

                    required: "**Username must not be empty",

                    minlength: "**Username must have min 6 and max 15 characters",

                    maxlength: "**Username must have min 6 and max 15 characters",

                },

                password:{

                    required: "**Password must not be empty",

                    minlength: "**Password must be 8 or more characters",

                    maxlength: "**Password must be less than 128 characters"

                },

                repeatPassword:{

                    required: "**Password must not be empty",

                    equalTo: "**Passwords have to be same",

                }

            },

            submitHandler: function(form){
                form.submit();
            }

        });

    });

</script>
</body>
</html>
