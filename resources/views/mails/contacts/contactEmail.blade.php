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
            <h4 class="text-center confirmation">{{$contactData['subject']}}</h4>
            <p class="text-dark message">To complete your registration and access all the features of our 10eXcess portal, please verify your email address by clicking the link below: </p>
            <p class="message ">You have received below enquiry from {{ucfirst($contactData['f_name'])}}</p>
            <p class="message">{{$contactData['message']}}</p>
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
