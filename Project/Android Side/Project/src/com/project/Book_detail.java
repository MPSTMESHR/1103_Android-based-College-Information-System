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
import android.content.Intent;
import android.graphics.Color;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class Book_detail extends Activity {
	Button loc;
	static string a;
//	private static final String url_details = "http://10.0.2.2/android_connect/book_detail.php";
	private static final String url_details = "http://collegeinfo.byethost7.com/android_connect/book_detail.php";
	private static final String TAG_SUCCESS = "success";
	private static final String TAG_BOOK = "product";

	private static final String TAG_PID = "pid";
	TextView tvname,tvcopies,tvacc;
	JSONArray products = null;
	JSONParser jsonParser = new JSONParser();

	static String id,branch,title,author;
	Bundle extras;
	private ProgressDialog pDialog;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.book_details);
		
		View someView = findViewById(R.id.book_details_xml);
    	View root = someView.getRootView();
		  root.setBackgroundColor(Color.WHITE);

		extras = getIntent().getExtras();
		id=extras.getString(TAG_PID).toString();
		branch=extras.getString("branch").toString();
		new GetProductDetails().execute();
		
		Log.d("Pid is  ", id);
		
	}
	class GetProductDetails extends AsyncTask<String, String, String> {

	
		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			pDialog = new ProgressDialog(Book_detail.this);
			pDialog.setMessage("Loading Book details. Please wait...");
			pDialog.setIndeterminate(false);
			pDialog.setCancelable(true);
			pDialog.show();
		}

		protected String doInBackground(String... params) {

					int success;
					try {
						// Building Parameters
						List<NameValuePair> params1 = new ArrayList<NameValuePair>();
						params1.add(new BasicNameValuePair("pid", id));
						params1.add(new BasicNameValuePair("branch", branch));
						Log.d("Neeche wala id id", id);
						JSONObject json = jsonParser.makeHttpRequest(
								url_details, "GET", params1);
						Log.d("Single Product Details", json.toString());
						success = json.getInt(TAG_SUCCESS);
						if (success == 1) {
							// successfully received  details
							JSONArray productObj = json
									.getJSONArray(TAG_BOOK); // JSON Array
							
							// get first  object from JSON Array
							 JSONObject product = productObj.getJSONObject(0);
							tvname = (TextView) findViewById(R.id.tvtitle);
							
							tvcopies = (TextView) findViewById(R.id.textCopies);
							final String a=product.getString("location");
							loc=(Button)findViewById(R.id.btnlocation);
							title=product.getString("title");
							author=product.getString("author");
							loc.setOnClickListener(new View.OnClickListener() {
								
								@Override
								public void onClick(View v) {
									// TODO Auto-generated method stub
									Intent in=new Intent(Book_detail.this,canvas_class.class);
									in.putExtra("search", a);
									in.putExtra("branch", branch);
									startActivity(in);
								}
							});
							Log.d("Title is ",product.getString("title"));

						}else{
						}
					} catch (JSONException e) {
						e.printStackTrace();
					}

			return null;
		}


		
		protected void onPostExecute(String file_url) {
			tvname.setText(title);
			tvcopies.setText(author);
			pDialog.dismiss();
		}
	}

}
