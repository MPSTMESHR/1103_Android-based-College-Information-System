package com.project;

import static com.project.CommonUtilities.SENDER_ID;
import static com.project.CommonUtilities.SERVER_URL;
import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.graphics.Color;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Toast;

public class Login extends Activity {
EditText uname,pass;
static String a,b;

AlertDialogManager alert = new AlertDialogManager();

// Internet detector
ConnectionDetector cd;


CheckBox cb1;
Button login;
SharedPreferences sharedPreferences;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.login);
		
		  View someView = findViewById(R.id.login_layout);

		  // Find the root view
		  View root = someView.getRootView();

		  // Set the color
		  root.setBackgroundColor(Color.WHITE);
		sharedPreferences = getSharedPreferences("login", Context.MODE_PRIVATE);
		uname=(EditText)findViewById(R.id.editTextSap);
		pass=(EditText)findViewById(R.id.editTextPass);
		cb1=(CheckBox)findViewById(R.id.checkBox1);
		
		login=(Button)findViewById(R.id.button1);
	      Boolean cb=false;
	      if(sharedPreferences.contains("cb"))
	      {
	    	  cb=sharedPreferences.getBoolean("cb", false);
	      }
	      if(sharedPreferences.contains("uname"))
	      {
	    	  uname.setText(sharedPreferences.getString("uname", ""));
	      }
	      if(sharedPreferences.contains("cb"))
	      {
	    	  pass.setText(sharedPreferences.getString("pass", ""));
	      }
	      if(cb==true)
	      {
	    	  Intent in =new Intent(getApplicationContext(),MainActivity.class);
	    	  a=uname.getText().toString();
	    	  b=pass.getText().toString();
	    	  in.putExtra("uname", a);
			  in.putExtra("pass", b);
	    	  startActivity(in);
	      }
		login.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				if(uname.getText().toString().trim().length()>0 && pass.getText().toString().trim().length()>0)
				{
					    a=uname.getText().toString();
					    b=pass.getText().toString();
					 
					if(cb1.isChecked())
					{
						   Boolean c=cb1.isChecked();
						   Editor editor = sharedPreferences.edit();
						   editor.putString("uname", a);
						   editor.putString("pass", b);
						   editor.putBoolean("cb",c );
						   editor.commit();
					}
					Intent in = new Intent(getApplicationContext(),Logging.class);
					in.putExtra("uname", a);
					in.putExtra("pass", b);
					startActivity(in);
				}
			}
		});
		
		
		cd = new ConnectionDetector(getApplicationContext());
		// Check if Internet present
				if (!cd.isConnectingToInternet()) {
					// Internet Connection is not present
					alert.showAlertDialog(getApplicationContext(),
							"Internet Connection Error",
							"Please connect to working Internet connection", false);
					// stop executing code by return
					return;
				}

				// Check if GCM configuration is set
				if (SERVER_URL == null || SENDER_ID == null || SERVER_URL.length() == 0
						|| SENDER_ID.length() == 0) {
					// GCM sernder id / server url is missing
					alert.showAlertDialog(getApplicationContext(), "Configuration Error!",
							"Please set your Server URL and GCM Sender ID", false);
					// stop executing code by return
					 return;
				}
		
				
		
	}
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		//getMenuInflater().inflate(R.menu.main, menu);
		
		getMenuInflater().inflate(R.menu.about_us, menu);
		return true;
	}
	 @Override
	    public boolean onOptionsItemSelected(MenuItem item)
	    {   
	        switch (item.getItemId())
	        {
	         case R.id.about:
	        	 Toast.makeText(getApplicationContext(), "This System is developed by Arushi Agarwal , Piyush Bhandari and Prashasya Choudhary",Toast.LENGTH_LONG).show();
	        	   break;
	        
	        }
			return true;
	    }	 

}