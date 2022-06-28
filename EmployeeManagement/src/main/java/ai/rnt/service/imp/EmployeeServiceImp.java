package ai.rnt.service.imp;

import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import ai.rnt.dao.EmployeeDao;
import ai.rnt.model.Employee;
import ai.rnt.service.EmployeeService;

@Service
public class EmployeeServiceImp implements EmployeeService {
		
	@Autowired
	EmployeeDao employeeDao;	

  public List<Employee> getAllEmployee() {
	
	return employeeDao.getAllEmployee();
			
}
	public List<Employee> getEmployeeById(int employeeId) {
		return employeeDao.getEmployeeById(employeeId);
	}
	
	public Employee  saveEmployee(Employee employee) {
		return employeeDao.saveEmployee(employee);
	}
	
	public Employee updateEmployee (Employee employee) {
		return employeeDao.updateEmployee(employee);
		
	}
	public void deleteEmployee(int empId) {
		 employeeDao.deleteEmployee(empId);
		
		}

    public boolean logInEmployee(Employee employee){ 
    	return employeeDao.logInEmployee(employee);
		  
		  }
		 
}
