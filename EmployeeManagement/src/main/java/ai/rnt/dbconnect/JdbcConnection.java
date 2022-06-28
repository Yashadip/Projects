package ai.rnt.dbconnect;

import java.sql.Connection;
import java.sql.DriverManager;

public class JdbcConnection {
    public static Connection getConnection() {
    	Connection connection = null;
    	try {
    
    		Class.forName("com.mysql.cj.jdbc.Driver");
        	connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/employee_management","root","root");
    }
    	catch (Exception e) {
    		System.out.println(e);
    	}
		return connection;
    	
}
}
