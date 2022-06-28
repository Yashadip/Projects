package ai.rnt.service;

import java.util.List;
import ai.rnt.model.Employee;

public interface EmployeeService {
	
	List<Employee> getAllEmployee();

	List<Employee> getEmployeeById(int employeeId);
	
	Employee saveEmployee(Employee employee);
	 
	Employee updateEmployee (Employee employee);

	void deleteEmployee(int empId);

	boolean logInEmployee(Employee employee);
}
