<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" />

	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>css/register.css">

    <title>Test PT K-24 Indonesia</title>
</head>
<body>
    <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">User Registration Form</h3>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="form-outline">
                                <input type="username" name="username" id="username" class="form-control form-control-lg" />
                                <label class="form-label" for="username">Username</label>
                            </div>
                            <small class="form-text text-danger"><?= form_error('username'); ?></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="password" name="password1" id="password1" class="form-control form-control-lg" />
                                <label class="form-label" for="password1">Password</label>
                            </div>
                            <small class="form-text text-danger"><?= form_error('password1'); ?></small>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <input type="password" name="password2" id="password2" class="form-control form-control-lg" />
                                <label class="form-label" for="password2">Confirm Password</label>
                            </div>
                            <small class="form-text text-danger"><?= form_error('password2'); ?></small>
                        </div>
                    </div>
                    <div class="mt-4 pt-2">
                        <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

    <script>
        // WRITE THE VALIDATION SCRIPT.
        function isNumber(evt) {
            var iKeyCode = (evt.which) ? evt.which : evt.keyCode
            if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
                return false;

            return true;
        }
    </script>
</body>
</html>

