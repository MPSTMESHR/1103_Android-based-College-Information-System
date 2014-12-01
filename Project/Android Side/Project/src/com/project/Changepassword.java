package com.project;


import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class Changepassword extends Activity {
Button submit;
EditText etold1,etnew1,etnew2;
String o,n1,n2;
Bundle p;
String pass,sap;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.change_pass);
		etold1=(EditText)findViewById(R.id.editTold1);
		etnew1=(EditText)findViewById(R.id.editTold2);
		etnew2=(EditText)findViewById(R.id.editTnewpass);
		submit =(Button)findViewById(R.id.button1);
		
		Intent i = getIntent();
		pass = i.getStringExtra("pass");
		sap=i.getStringExtra("sap");
		Log.e("Password in changepassword activity", pass);
		Log.e("SAp in changepassword activity", sap);
		submit.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				o=etold1.getText().toString();
				
				n1=etnew1.getText().toString();
				n2=etnew2.getText().toString();
				if(o.equals(pass))
				{
					if(n1.equals(n2))
					{
						Intent in = new Intent(getApplicationContext(),Change_pass.class);
						in.putExtra("pass",n1);
						in.putExtra("sap", sap);
						startActivity(in);
					}
					else
					{
						Toast.makeText(getApplicationContext(),"New Passwords do not match", 1000).show();
					}
				}
				else
				{

					Toast.makeText(getApplicationContext(),"Passwords do not match with old password", 1000).show();
				}
			}
		});
		
	}
	

}
