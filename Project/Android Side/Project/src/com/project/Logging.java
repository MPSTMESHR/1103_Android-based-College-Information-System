package com.project;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;


import android.R.string;
import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

public class Logging extends Activity {
	Button loc;
	static string a;

//	private static final String url_product_detials = "http://10.0.2.2/collegeinformer/login_and.php";
	private static final String url_product_detials = "http://collegeinfo.byethost7.com/collegeInformer/login_and.php";
	
	private static final String TAG_SUCCESS = "success";
	private static final String tag_log = "res";
	static String result;

	TextView tvname,tvcopies,tvacc;
	JSONArray products = null;
	JSONParser jsonParser = new JSONParser();

	static String uname,password;
	Bundle extras;
	private ProgressDialog pDialog;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.result);
		
		

		extras = getIntent().getExtras();
		uname=extras.getString("uname").toString();
		password=extras.getString("pass").toString();
		new GetProductDetails().execute();
		
		
	}
	class GetProductDetails extends AsyncTask<String, String, String> {

		
		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			pDialog = new ProgressDialog(Logging.this);
			pDialog.setMessage("Logging in. Please wait...");
			pDialog.setIndeterminate(false);
			pDialog.setCancelable(true);
			pDialog.show();
		}

		protected String doInBackground(String... params) {

			
					int success;
					try {
						// Building Parameters
						List<NameValuePair> params1 = new ArrayList<NameValuePair>();
						params1.add(new BasicNameValuePair("sap", uname));
						params1.add(new BasicNameValuePair("password", password));
						JSONObject json = jsonParser.makeHttpRequest(
								url_product_detials, "POST", params1);

						Log.d("Single Product Details", json.toString());
						
						// json success tag
						success = json.getInt(TAG_SUCCESS);
						if (success == 1) {
							// successfully received  details
							JSONArray productObj = json
									.getJSONArray(tag_log); // JSON Array
							
							// get first product object from JSON Array
							 JSONObject product = productObj.getJSONObject(0);
							
							  result=product.getString("result");
						}else{
							// product with pid not found
						}
					} catch (JSONException e) {
						e.printStackTrace();
					}

			return null;
		}


		
		protected void onPostExecute(String file_url) {
			if(Integer.parseInt(result)==1)
			{
				Intent in = new Intent(getApplicationContext(),MainActivity.class);
				in.putExtra("sap", uname);
				in.putExtra("pass", password);
				startActivity(in);
				//tvname.setText("successfully logged in ");
			}
			else
			{
			    SharedPreferences  sharedpreferences = getSharedPreferences("login", Context.MODE_PRIVATE);

				Toast.makeText(getApplicationContext(), "Incorrect username and password",Toast.LENGTH_SHORT).show();
				Intent in = new Intent(getApplicationContext(),Login.class);
				Editor editor = sharedpreferences.edit();
				   editor.putString("uname", "");
				   editor.putString("pass", "");
				   editor.putBoolean("cb",false );
				   editor.commit();
				startActivity(in);
			}
			// dismiss the dialog once got all details
			pDialog.dismiss();
		}
	}

}
