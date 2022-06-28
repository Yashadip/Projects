package ai.rnt.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

import org.springframework.stereotype.Repository;

import ai.rnt.dbconnect.JdbcConnection;
import ai.rnt.model.Employee;

@Repository
public class EmployeeDao {
		
	public List<Employee> getAllEmployee() {
        List<Employee> employees = new ArrayList<Employee>();
        Employee employee;
        Connection connection = null;
        try {
        	 connection = JdbcConnection.getConnection();
        	PreparedStatement prepareStatement = connection.prepareStatement("select * from employee");
        	ResultSet rs = prepareStatement.executeQuery();
        	while(rs.next()) {
        		employee = new Employee();
        		employee.setEmployeeId(rs.getInt("employee_id"));
        		employee.setFirstName(rs.getString("first_name"));
        		employee.setLastName(rs.getString("last_name"));
        		employee.setEmail(rs.getString("email"));
        		employee.setMobileNumber(rs.getLong("mobile"));
        		employee.setGender(rs.getString("gender"));
        		employee.setUser(rs.getString("user"));
        		employees.add(employee);
        	}
        	System.out.println(employees);
        }catch(Exception e) {
        	System.out.println(e);
        }finally {      	
        }     
		return employees;
	} 
		
	public Employee saveEmployee(Employee employee) {

		Employee employee1=new Employee();				
		employee1.setEmployeeId(employee.getEmployeeId());	
		employee1.setUser(employee.getUser());	
		employee1.setFirstName(employee.getFirstName());
		employee1.setLastName(employee.getLastName());
		employee1.setEmail(employee.getEmail());
		employee1.setMobileNumber(employee.getMobileNumber());
		employee1.setGender(employee.getGender());
		employee1.setPassword(employee.getPassword());
		Connection connection=null;		
		try {
			 connection = JdbcConnection.getConnection();
		PreparedStatement prepareStatement=connection.prepareStatement("Insert into employee values(?,?,?,?,?,?,?,?)");
		
		prepareStatement.setInt(1, employee1.getEmployeeId());
		prepareStatement.setString(2, employee1.getFirstName());		
		prepareStatement.setString(3, employee1.getLastName());	
		prepareStatement.setString(4, employee1.getEmail());	
		prepareStatement.setLong(5, employee1.getMobileNumber());	
		prepareStatement.setString(6, employee1.getGender());	
		prepareStatement.setString(7, employee1.getPassword());
		prepareStatement.setString(8, employee1.getUser());
		

		int r = prepareStatement.executeUpdate();
		if(r!=0)
		{System.out.println("employee added successfully");}

		} catch(Exception e) {
       e.printStackTrace();
		} finally {}
		return employee1;
		}
	
	public List<Employee> getEmployeeById(int employeeId) {
		 List<Employee> employees = new ArrayList<Employee>();
		 Employee employee = null ;
        
        Connection connection = null;
        try {
        	 connection = JdbcConnection.getConnection(); 	 
        	PreparedStatement prepareStatement = connection.prepareStatement("Select * from employee where employee_id= ?");
        	prepareStatement.setInt(1, employeeId);    	
        	ResultSet rs = prepareStatement.executeQuery();
        	if(rs.next()) {
        		employee = new Employee();     		
        	    employee.setEmployeeId(rs.getInt("employee_id"));      	
        		employee.setFirstName(rs.getString("first_name"));       		
        		employee.setLastName(rs.getString("last_name"));     		
        		employee.setEmail(rs.getString("email"));       		
        		employee.setMobileNumber(rs.getLong("mobile"));       		
        		employee.setGender(rs.getString("gender"));
        		employee.setPassword(rs.getString("password"));
        		employee.setUser(rs.getString("user"));
        		employees.add(employee);      		
        	}   	
        }catch(Exception e) {
        	System.out.println(e);
        }finally {      	
        }     
		return employees;
	}

	public Employee updateEmployee (Employee employee) {	
	        Connection connection = null;
	        Employee employee1=new Employee();					
			employee1.setEmployeeId(employee.getEmployeeId());	
			employee1.setFirstName(employee.getFirstName());
			employee1.setLastName(employee.getLastName());
			employee1.setEmail(employee.getEmail());
			employee1.setMobileNumber(employee.getMobileNumber());
			employee1.setUser(employee.getUser());
			employee1.setPassword(employee.getPassword());
			employee1.setGender(employee.getGender());
           
	        try {
				 connection = JdbcConnection.getConnection();
			PreparedStatement prepareStatement=connection.prepareStatement("Update employee set first_name=? ,last_name=? ,email=? ,mobile=? ,gender=? ,user =?,password=? Where employee_id=?");
			
			prepareStatement.setString(1, employee1.getFirstName());		
			prepareStatement.setString(2, employee1.getLastName());	
			prepareStatement.setString(3, employee1.getEmail());	
			prepareStatement.setLong(4, employee1.getMobileNumber());	
			prepareStatement.setString(5, employee1.getGender());
			prepareStatement.setString(6, employee1.getUser());
			prepareStatement.setString(7, employee1.getPassword());
			prepareStatement.setInt(8, employee1.getEmployeeId());

			int r = prepareStatement.executeUpdate();
			if(r!=0)
			{System.out.println("employee updated successfully");}

			}
	        
	   		 catch (Exception e)
	   		  {
	   		  e.printStackTrace();

	   		  }return employee;

	   		  }
		  
	  public void deleteEmployee(int empId) {
		  try {
		  Connection connection=null;
		  
		  connection=JdbcConnection.getConnection();
		  PreparedStatement preparedStatement=connection.prepareStatement("Delete  From employee WHERE employee_id = ?" );
		preparedStatement.setInt(1,empId);
		  preparedStatement.executeUpdate();
		  }
		  catch (Exception e)
		  {
		  e.printStackTrace();
		  }
		  }
			
	 public boolean logInEmployee(Employee employee) {
		    boolean status=false;  			
			Connection connection=null;				
			Employee employee1=new Employee();				
			employee1.setUser(employee.getUser());	
			employee1.setPassword(employee.getPassword());
			try {
				 connection = JdbcConnection.getConnection();
			PreparedStatement prepareStatement=connection.prepareStatement("select * from employee where user = ? and password = ?");	
			prepareStatement.setString(1, employee1.getUser());		
			prepareStatement.setString(2, employee1.getPassword());	 
        	ResultSet rs = prepareStatement.executeQuery();
        	status = rs.next();
        	
			}catch(Exception e){
			}  
			  
			return status;
	   		  
	 }
}

		
	

