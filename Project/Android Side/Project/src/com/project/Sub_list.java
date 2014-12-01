package com.project;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.ListActivity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Color;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;

public class Sub_list extends ListActivity {
	private ProgressDialog pDialog;
	static  String sap,pass;
	@Override
	public void onBackPressed() {
		// TODO Auto-generated method stub
		super.onBackPressed();
		Intent in = new Intent(getApplicationContext(),MainActivity.class);
		in.putExtra("sap",sap);
		in.putExtra("pass", pass);
		startActivity(in);
	}

	// Creating JSON Parser object
	JSONParser jParser = new JSONParser();

	ArrayList<HashMap<String, String>> productsList;
	Bundle extras;
 
//	private static String url = "http://10.0.2.2/xyz/sub.php";
	private static String url = "http://collegeinfo.byethost7.com/xyz/sub.php";
	private static final String TAG_SUCCESS = "success";
	private static final String TAG_SUBJECTS = "slit";
	private static final String TAG_PID = "s_id";
	private static final String TAG_NAME = "s_name";
	// products JSONArray
	JSONArray products = null;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.result);
		
		extras = getIntent().getExtras();
	     sap = extras.getString("sap").toString();
	     pass=extras.getString("pass").toString();
	     Log.w("Sap is ", sap);
		// Hashmap for ListView
		productsList = new ArrayList<HashMap<String, String>>();

 		new LoadAllProducts().execute();

		 
		ListView lv = getListView();

		 
		lv.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View view,
					int position, long id) {
				// getting values from selected ListItem
				String pid = ((TextView) view.findViewById(R.id.pid)).getText()
						.toString();

				// Starting new `
				Intent in = new Intent(getApplicationContext(),
						Messages.class);
				// sending pid to next activity
				in.putExtra(TAG_PID, pid);
			
				
				// starting new activity and expecting some response back
				startActivity(in);
			}
		});
	
	}

 
	class LoadAllProducts extends AsyncTask<String, String, String> {

		 
		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			pDialog = new ProgressDialog(Sub_list.this);
			pDialog.setMessage("Loading Subject List. Please wait...");
			pDialog.setIndeterminate(false);
			pDialog.setCancelable(false);
			pDialog.show();
		}
 
		protected String doInBackground(String... args) {
			 
			List<NameValuePair> params = new ArrayList<NameValuePair>();
		 
			params.add(new BasicNameValuePair("sap", sap));
			JSONObject json = jParser.makeHttpRequest(url, "POST", params);
			
		 
			try {
				// Checking for SUCCESS TAG
				int success = json.getInt(TAG_SUCCESS);

				if (success == 1) {
					// products found
					// Getting Array of Products
					products = json.getJSONArray(TAG_SUBJECTS);

					// looping through All Products
					for (int i = 0; i < products.length(); i++) {
						JSONObject c = products.getJSONObject(i);

						// Storing each json item in variable
						String id = c.getString(TAG_PID);
						String name = c.getString(TAG_NAME);

						// creating new HashMap
						HashMap<String, String> map = new HashMap<String, String>();

						// adding each child node to HashMap key => value
						map.put(TAG_PID, id);
						map.put(TAG_NAME, name);

						// adding HashList to ArrayList
						productsList.add(map);
					}
				} else {
				}
			} catch (JSONException e) {
				e.printStackTrace();
			}

			return null;
		}

		 
		protected void onPostExecute(String file_url) {
			// dismiss the dialog after getting all products
			pDialog.dismiss();
			// updating UI from Background Thread
			runOnUiThread(new Runnable() {
				public void run() {
					/**
					 * Updating parsed JSON data into ListView
					 * */
					ListAdapter adapter = new SimpleAdapter(
							Sub_list.this, productsList,
							R.layout.list_item, new String[] { TAG_PID,
									TAG_NAME},
							new int[] { R.id.pid, R.id.name });
					// updating listview
					setListAdapter(adapter);
				}
			});

		}

	}
}