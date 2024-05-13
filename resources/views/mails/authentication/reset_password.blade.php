<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <div class="row">
    <div class="col-md-4 mx-auto shadow bg-white px-3 pt-3">
        <h4 class="text-center confirmation"> Confirmation Email For Password Reset </h4>
        <p class="text-dark message">We have received a request to reset your password if you didnot make this request ,just ignore this email Otherwise you can reset your using the following code.</p>
        <p class="message">You have received below enquiry from {{ucfirst($userData['full_name'])}}</p>
        <p class="text-dark message">Your reset password code: <strong>{{$userData['random']}}<strong></p>
        <p class="text-center text-success url">Regards: 10eXcess.com </p>
        <a class="text-center url"  href="http://localhost:8001/companies">Change Password</a>
    </div>
</div>

</body>
</html>



<style>
img{
    display: block;
    margin: auto;
}
.confirmation{
    color: brown;
    text-align: center
}
.url{
    color: green;
    text-align: center;
}
.message{
    text-align: center;
}
</style>