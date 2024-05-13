<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two Factor Authentication Password</title>
</head>
<body>
    <div class="row">
    <div class="col-md-4 mx-auto shadow bg-white px-3 pt-3">
        <h4 class="text-center confirmation"> Confirmation Code For Two Factor Authentication </h4>
        <p class="text-dark message">We have received a request for the two factor authentication code if you did not make this request ,just ignore this email Otherwise  you can using the following code for two factor authentication. </p>
        <p class="message">You have received below enquiry from {{ucfirst($user['full_name'])}}</p>
        <p class="text-dark message">Your two factor authentication code: <strong>{{$user['random']}}<strong></p>
        <p class="text-center text-success url">Regards: 10eXcess.com </p>
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