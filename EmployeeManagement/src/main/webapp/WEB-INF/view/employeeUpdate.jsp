<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
pageEncoding="ISO-8859-1"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@ page isELIgnored ="false" %> 
<!DOCTYPE html>
<html lang="en">
   <head>  
      <meta charset = "utf-8">  
      <meta name = "viewport" content = "width = device-width, initial-scale = 1, shrink-to-fit = no">  
      <link rel = "stylesheet"   
         href = "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"  
         integrity = "sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"   
         crossorigin = "anonymous">         
      <title> Employee Update  </title>  
      <style>  
      body {  
      color: #bd2130;  
      }  
      .card {  
    position: relative;  
    display: -ms-flexbox;  
    display: flex;  
    -ms-flex-direction: column;  
    flex-direction: column;  
    min-width: 0;  
    word-wrap: break-word;  
    background-color: #f8f9fa;  
    background-clip: border-box;  
    border: 1px solid rgba(0,0,0,.125);  
    border-radius: .15rem;  
}  
      </style>  
   </head>  
   <body>  
<section class="vh-100" style="background-color: #c48fad;">  
  <div class="container h-100">  
    <div class="row d-flex justify-content-center align-items-center h-100">  
      <div class="col-xl-9">  
        <h1 class="text-white mb-4"> Employee Update Form </h1>  
        <div class="card" style="border-radius: 15px;"> 
        <form action="updateform" method="post">
          <c:forEach items="${employeeList}" var="e" varStatus="varStatus"> 
          <div class="card-body">  
          <div class="row align-items-center pt-4 pb-3">  
              <div class="col-md-3 ps-5">  
                <h6 class="mb-0"> Employee Id </h6>  
              </div>  
              <div class="col-md-9 pe-5">  
               <input type="text" name="dispId" value="${e.employeeId}" disabled="disabled"/>
		        <input type="hidden" name="employeeId" value="${e.employeeId}"/>
              </div>  
            </div> 
            <div class="row align-items-center pt-4 pb-3">  
              <div class="col-md-3 ps-5">  
                <h6 class="mb-0"> User Id </h6>  
              </div>  
              <div class="col-md-9 pe-5">  
               <input type="text" class="form-control form-control-lg" name="user" value="${e.user}" /> 
              </div>  
            </div> 
            <div class="row align-items-center pt-4 pb-3">  
              <div class="col-md-3 ps-5">  
                <h6 class="mb-0"> First name </h6>  
              </div>  
              <div class="col-md-9 pe-5">  
                <input type="text" class="form-control form-control-lg"  name="firstName" value="${e.firstName}"/>  
              </div>  
            </div> 
            <div class="row align-items-center pt-4 pb-3">  
              <div class="col-md-3 ps-5">  
                <h6 class="mb-0"> Last name </h6>  
              </div>  
              <div class="col-md-9 pe-5">  
                <input type="text" class="form-control form-control-lg"  name="lastName" value="${e.lastName}" />  
              </div>  
            </div> 
            <hr class="mx-n3">  
            <div class="row align-items-center py-3">  
              <div class="col-md-3 ps-5">  
                <h6 class="mb-0"> Email address </h6>  
              </div>  
              <div class="col-md-9 pe-5">  
                <input type="email" class="form-control form-control-lg" placeholder="dummy@example.com" name="email" value="${e.email}" />  
              </div>  
            </div>  
    <hr class="mx-n3">  
            <div class="row align-items-center py-3">  
              <div class="col-md-3 ps-5">  
                <h6 class="mb-0"> Phone Number</h6>  
              </div>  
              <div class="col-md-9 pe-5">  
                <input type="text" class="form-control form-control-lg" name="mobile" value="${e.mobileNumber}" />  
              </div>  
            </div>  
            <hr class="mx-n3">  
            <div class="row align-items-center pt-4 pb-3">  
              <div class="col-md-3 ps-5">  
                <h6 class="mb-0"> Gender </h6>  
              </div>  
              <div class="col-md-9 pe-5">  
                <input type="text" class="form-control form-control-lg" name="gender" value="${e.gender}"/>  
              </div>  
            </div>   
            <div class="row align-items-center pt-4 pb-3">  
              <div class="col-md-3 ps-5">  
                <h6 class="mb-0"> Password </h6>  
              </div>  
              <div class="col-md-9 pe-5">  
                <input type="password" class="form-control form-control-lg" name="password" value="${e.password}"/>  
              </div>  
            </div>   
             
            <hr class="mx-n3">  
            <div class="px-5 py-4">  
              <button type="submit" class="btn btn-primary btn-lg"> Update application </button>  
            </div>  
          </div> 
          </c:forEach>
          </form> 
        </div>  
      </div>  
    </div>  
  </div>  
</section>  
</body>  
</html>  