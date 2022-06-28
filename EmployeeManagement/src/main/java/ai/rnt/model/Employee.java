package ai.rnt.model;

public class Employee {
   private String firstName;
   private String lastName;
   private String email;
   private long mobileNumber;
   private String gender;
   private int employeeId;
   private String password;
   private String user;
      
   
public String getPassword() {
	return password;
}
public void setPassword(String password) {
	this.password = password;
}

public int getEmployeeId() {
	return employeeId;
}
public void setEmployeeId(int employeeId) {
	this.employeeId = employeeId;
}
public String getFirstName() {
	return firstName;
}
public void setFirstName(String firstName) {
	this.firstName = firstName;
}
public String getLastName() {
	return lastName;
}
public void setLastName(String lastName) {
	this.lastName = lastName;
}
public String getEmail() {
	return email;
}
public void setEmail(String email) {
	this.email = email;
}
public long getMobileNumber() {
	return mobileNumber;
}
public void setMobileNumber(long mobileNumber) {
	this.mobileNumber = mobileNumber;
}
public String getGender() {
	return gender;
}
public void setGender(String gender) {
	this.gender = gender;
}
public String getUser() {
	return user;
}
public void setUser(String user) {
	this.user = user;
}
  
}
