<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email Address</title>
</head>
<body>
    <div class="row">
    <div class="col-md-4 mx-auto shadow bg-white px-3 pt-3">
        <h4 class="text-center confirmation">Welcome to 10eXcess family! We're excited to have you as a new member of our community.</h4>
        <p class="text-dark message">To complete your registration and access all the features of our 10eXcess portal, please verify your email address by clicking the link below: </p>
        <p class="message ">You have received below enquiry from {{ucfirst($userData['full_name'])}}</p>
        <a class="message btn-primary btn" href="#">Verified</a>
        <p class="message">Thank you for joining us! If you have any questions or need assistance, feel free to contact our support team</p>
        <p class="text-center text-success url">Best regards: 10eXcess.com </p>
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
.btn-primary {
    border-color: #17a2b8;
    background-color: #17a2b8;
}
.btn {
    padding: 0.938rem 1.5rem;
    border-radius: 0.625rem;
    font-weight: 400;
    font-size: 1rem;
    text-decoration:none;
    color:aliceblue;
}
</style>