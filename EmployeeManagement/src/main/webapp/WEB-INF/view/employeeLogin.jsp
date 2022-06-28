<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
pageEncoding="ISO-8859-1"%>
<%@ page isELIgnored ="false" %>
<!DOCTYPE html>
<html lang="en" >  
<head>  
  <meta charset="UTF-8">  
  <title> Employee LogIn 
 </title>  
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">  
</head>  
<style>  
html {   
    height: 100%;   
}  
body {   
    height: 100%;   
}  
.global-container {  
    height: 100%;  
    display: flex;  
    align-items: center;  
    justify-content: center;  
    background-color: #f5f5f5;  
}  
form {  
    padding-top: 10px;  
    font-size: 14px;  
    margin-top: 30px;  
}  
.card-title {   
font-weight: 300;  
 }  
.btn {  
    font-size: 14px;  
    margin-top: 20px;  
}  
.login-form {   
    width: 330px;  
    margin: 20px;  
}  
.sign-up {  
    text-align: center;  
    padding: 20px 0 0;  
}  
.alert {  
    margin-bottom: -30px;  
    font-size: 13px;  
    margin-top: 20px;  
}  
</style>  
<body>

<%-- <% response.setHeader("cache-control","no-cache , no-store ,must-revalidate");
response.setHeader("pragma","no-cache");
response.setDateHeader("Expires", 0);
if (session.getAttribute("user") == null){
%>

<c:redirect url= "/employeeLogin" >
</c:redirect>
<%
}
%>  --%>
<h1>${message}</h1> 
<h2>${msg}</h2>

<div class="pt-5">  
  <div class="global-container">  
    <div class="card login-form">  
    <div class="card-body">  
        <h3 class="card-title text-center"> Employee Login Form </h3>  
        <div class="card-text">  
           <form action="loginform" method="post">
                <div class="form-group">  
                    <label for="exampleInputEmail1"> Enter User Id</label>  
                    <input type="user" class="form-control form-control-sm" id="user" name="user" aria-describedby="user">  
                </div>  
                <div class="form-group">  
                    <label for="exampleInputPassword1">Enter Password </label>   
                    <input type="password" class="form-control form-control-sm" id="password" name="password">  
                </div>  
                <button type="submit" class="btn btn-primary btn-block"> Sign in </button>  
                  
                <div class="sign-up">  
                    Don't have an account? <a href="addnew"> Create One </a>  
                </div>  
            </form>  
        </div>  
    </div>  
</div>  
</div>  
</div>
</body>  
</html>  