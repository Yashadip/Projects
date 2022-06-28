<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
pageEncoding="ISO-8859-1"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@ page isELIgnored ="false" %>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<%
response.setHeader("Cache-Control","no-cache , no-store , must-reavalidation" );
    if(session.getAttribute("user")==null)
	response.sendRedirect("employeeLogin.jsp");
%>

  <h2 style="color:red;"  >Employee Details</h2>
  <h6 align="right">
   <a style="color:red;" href="logout"> Log Out </a> </h6>
                
      <br>    
  <table class="table table-bordered">
    <thead>
<tr style="color:lightblue;">
<th > Employee ID </th>
<th> User Id </th>
<th> First Name</th>
<th> Last Name</th>
<th> E-Mail</th>
<th> Mobile</th>
<th> Gender </th>
<th> Action </th>
<th> </th>
</tr>
<tbody><c:forEach items="${employeeList}" var="e" varStatus="varStatus">
<tr>
<td>${e.employeeId}</td>
<td>${e.user}</td>
<td>${e.firstName}</td>
<td>${e.lastName}</td>
<td>${e.email}</td>
<td>${e.mobileNumber}</td>
<td>${e.gender}</td>

<td><a style="color:red;" href="update?employeeId=${e.employeeId}">Edit</a></td>
        
<td>

<a style="color:red;" button onclick="myFunction()"  href="delete?empId=${e.employeeId}"> Delete </a>

<script>
function myFunction() {
  alert("Are you sure you want to delete");
}
</script>
</tr>
</c:forEach>
</tbody>

</table><br><br>
</body>
</html>