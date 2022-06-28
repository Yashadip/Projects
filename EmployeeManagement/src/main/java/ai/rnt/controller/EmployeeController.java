package ai.rnt.controller;
import java.io.IOException;
import java.util.List;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.ModelAndView;
import ai.rnt.model.Employee;
import ai.rnt.service.EmployeeService;

   @Controller
   @RequestMapping("/")
   
   public class EmployeeController {   
       @Autowired
	   EmployeeService employeeService;
          
	   @GetMapping("/")
	   public ModelAndView getlogin() {
	   ModelAndView mv = new ModelAndView("employeeLogin");
	   return mv;
	   }
	    
	   @RequestMapping(value = "loginform", method = RequestMethod.POST)
	   
	   public ModelAndView userLogin(HttpServletRequest req , HttpServletResponse res) throws ServletException , IOException
	   {
		  String user = req.getParameter("user");
		  String pass = req.getParameter("password");  
		  
		   ModelAndView mv = new ModelAndView();
		   Employee employee = new Employee();
		   employee.setUser(user);
		   employee.setPassword(pass);
		      
		   boolean status = employeeService.logInEmployee(employee);
		   
			if (status==true) {
				
				HttpSession session = req.getSession();
				session.setAttribute("user", user);
				mv.setViewName("employeeView");	
				List<Employee> employees = employeeService.getAllEmployee();
				mv.addObject("employeeList",employees);
			} else {
				return new ModelAndView ("employeeLogin", "message" , "Invalid Password");
			}
			return mv;
		}
	   
	    
	   @RequestMapping(path="addnew")
	   public ModelAndView getAllEmployee3() {
	   ModelAndView mv = new ModelAndView("employeeNew");
	   return mv;
	   }
	   
		@RequestMapping(value = "logout")
		public ModelAndView logOut(HttpServletRequest request , HttpServletResponse response ){
			HttpSession session = request.getSession();  
		    session.removeAttribute("user");
			session.invalidate();
			return new ModelAndView("employeeLogin");
		}
	   
	   @RequestMapping (path="processform" , method= RequestMethod.POST)   
	   public ModelAndView insertEmployee(
			   @RequestParam("user") String user,
			   @RequestParam("firstName") String firstName,
			   @RequestParam("lastName") String lastName,	   
	           @RequestParam("email") String email ,
	           @RequestParam("gender") String gender ,
	           @RequestParam("mobile") String mobile,
	           @RequestParam("password") String password)  
	   {
		   
	   Employee employee = new Employee();
	   Long mobileno=Long.parseLong(mobile);
	   
	   employee.setUser(user);
	   employee.setFirstName(firstName);
	   employee.setLastName(lastName);
	   employee.setEmail(email);
	   employee.setGender(gender);
	   employee.setMobileNumber(mobileno);
	   employee.setPassword(password);
	   
	   employeeService.saveEmployee(employee);
	      
	   return new ModelAndView("redirect:/");
	   }   	   
	   @RequestMapping(value = "delete", method = RequestMethod.GET)
		public ModelAndView deleteEmployee(@RequestParam int empId) {
		   employeeService.deleteEmployee(empId);
		   ModelAndView mv = new ModelAndView();
		   List<Employee> employees = employeeService.getAllEmployee();
			mv.addObject("employeeList",employees);mv.setViewName("employeeView");
			mv.setViewName("employeeView");
			return mv;
	   }	   	   
	   @RequestMapping(value = "update" , method = RequestMethod.GET)
	   public ModelAndView getEmployeeById1 (@RequestParam int employeeId) {	 
		   ModelAndView mv = new ModelAndView("employeeUpdate");
		   List<Employee> employees = employeeService.getEmployeeById(employeeId);	
		   mv.addObject("employeeList",employees);
		   return mv;	   
		   }     
		@RequestMapping(value = "updateform", method = RequestMethod.POST)
		public ModelAndView updateEmp(
				   @RequestParam ("employeeId") int employeeId,
				   @RequestParam ("user") String user,
				   @RequestParam("firstName") String firstName,
				   @RequestParam("lastName") String lastName,	   
		           @RequestParam("email") String email ,
		           @RequestParam("gender") String gender ,
		           @RequestParam("password") String password ,
		           @RequestParam("mobile") String mobile) {
		
			Employee employee=new Employee();			
			Long mobileno=Long.parseLong(mobile);
		    employee.setEmployeeId(employeeId);
		    employee.setUser(user);
			employee.setFirstName(firstName);
			employee.setLastName(lastName);
			employee.setEmail(email);
			employee.setGender(gender);
			employee.setPassword(password);
			employee.setMobileNumber(mobileno);
			
			employee = employeeService.updateEmployee(employee);				 
			  ModelAndView mv = new ModelAndView();
			   List<Employee> employees = employeeService.getAllEmployee();
				mv.addObject("employeeList",employees);
				mv.setViewName("employeeView");
				return mv;	
			}		
	}
   