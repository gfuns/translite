<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <meta name="apps" content="Xtratech Global Solution">
    <meta name="author" content="Xtratech Global Solution">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Sign In | TransLite</title>
    <link rel="stylesheet" href="assets/css/vendor.bundle.css?ver=20241116180">
    <link rel="stylesheet" href="assets/css/style.css?ver=20241116180">

    <style>
        body {
            background-image: url('images/authPattern.png');
            /* Replace with your image path */
            background-size: cover;
            /* Ensures the image covers the entire page */
            background-position: center;
            /* Centers the image */
            background-repeat: no-repeat;
            /* Prevents image repetition */
            min-height: 100vh
        }



        .page-ath-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .page-ath-content {
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 20px;
            max-width: 500px;
            /* Adjust as needed */
            width: 100%;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            /* Optional for better styling */
        }


        .customPageAthContent {
            background: #fff;
            width: 35%;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
        }

        @media (max-width: 575px) {
            .customPageAthContent {
                background: #fff;
                width: 100%;
                border: none;
                border-radius: 0px;
                min-height: 100vh
            }

            .page-ath-header{
                text-align: center;
            }
        }
    </style>

</head>

<body class="page-ath theme-modern page-ath-modern">

    <div class="page-ath-wrap">
        <div class="customPageAthContent">
            <div class="page-ath-header"><a href="/" class="page-ath-logo"><img class="page-ath-logo-img"
                        src="images/logos.png" alt="TransLite Logo"></a></div>

            <div class="page-ath-form">
                <h2 class="page-ath-heading"><small><strong>Welcome Back!</strong> <span
                            style="font-size: 15px; display:block">Enter your credentials to continue with TransLite!
                    </small></h2>

                <form class="login-form validate validate-modern" method="POST" action="{{ route('login') }}"
                    id="register">
                    @csrf
                    <div class="input-item">
                        <input type="email" placeholder="Your Email" class="input-bordered" name="email"
                            value=""data-msg-required="Required." data-msg-email="Enter valid email." required>
                    </div>
                    <div class="input-item">
                        <input type="password" placeholder="Password" class="input-bordered" name="password"
                            id="password" minlength="6" data-msg-required="Required."
                            data-msg-minlength="At least 6 chars." required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="input-item text-left">
                            <input class="input-checkbox input-checkbox-md" type="checkbox" name="remember"
                                id="remember-me">
                            <label for="remember-me">Remember Me</label>
                        </div>
                        <div>
                            <a href="/password/reset">Forgot password?</a>
                            <div class="gaps-2x"></div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </form>


                <div class="gaps-4x"></div>
                <div class="form-note">
                    Don't have an account? <a href="/register"> <strong>Sign Up Instead</strong></a>
                </div>
            </div>


        </div>

    </div>

    <script>
        var base_url = "https://app.tokenlite.net",
            csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            layouts_style = "modern";
    </script>
    <script src="assets/js/jquery.bundle.js?ver=20241116180"></script>
    <script src="assets/js/script.js?ver=20241116180"></script>
    <script type="text/javascript">
        jQuery(function() {
            var $frv = jQuery('.validate');
            if ($frv.length > 0) {
                $frv.validate({
                    errorClass: "input-bordered-error error"
                });
            }
        });
    </script>

</body>

</html>
