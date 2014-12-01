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

public class SearchActivity extends ListActivity {
	private ProgressDialog pDialog;

	JSONParser jParser = new JSONParser();

	ArrayList<HashMap<String, String>> productsList;
	Bundle extras;
	private static String url = "http://collegeinfo.byethost7.com/android_connect/search_book.php";

	//	private static String url = "http://10.0.2.2/android_connect/search_book.php";
	private static final String TAG_SUCCESS = "success";
	private static final String TAG_SEARCH = "products";
	private static final String TAG_PID = "pid";
	private static final String TAG_NAME = "name";
	static  String searchq,branch;
	JSONArray products = null;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.result);
		View someView = findViewById(R.id.result_xml);
		  View root = someView.getRootView();
		  root.setBackgroundColor(Color.WHITE);
		extras = getIntent().getExtras();
	     searchq = extras.getString("search").toString();
	     branch=extras.getString("branch").toString();
	     Log.w("Search querry is ", searchq);
		productsList = new ArrayList<HashMap<String, String>>();

		// Loading products in Background Thread
		new LoadAllProducts().execute();

		ListView lv = getListView();

		// on seleting single product
		// launching Edit Product Screen
		lv.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View view,
					int position, long id) {
				// getting values from selected ListItem
				String pid = ((TextView) view.findViewById(R.id.pid)).getText()
						.toString();

				// Starting new intent
				Intent in = new Intent(getApplicationContext(),
						Book_detail.class);
				// sending pid to next activity
				in.putExtra(TAG_PID, pid);
				in.putExtra("branch", branch);
			
				
				// starting new activity and expecting some response back
				startActivityForResult(in, 100);
			}
		});
	
	}

	 
	class LoadAllProducts extends AsyncTask<String, String, String> {
 
		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			pDialog = new ProgressDialog(SearchActivity.this);
			pDialog.setMessage("Loading Books. Please wait...");
			pDialog.setIndeterminate(false);
			pDialog.setCancelable(false);
			pDialog.show();
		}

		 
		protected String doInBackground(String... args) {
			// Building Parameters
			List<NameValuePair> params = new ArrayList<NameValuePair>();
			// getting JSON string from URL
			params.add(new BasicNameValuePair("query", searchq));
			params.add(new BasicNameValuePair("branch", branch));
		    JSONObject json = jParser.makeHttpRequest(url, "POST", params);
			
			// Check your log cat for JSON reponse
			Log.d("All Products: ", json.toString());

			try {
				// Checking for SUCCESS TAG
				int success = json.getInt(TAG_SUCCESS);

				if (success == 1) {
					// products found
					// Getting Array of Products
					products = json.getJSONArray(TAG_SEARCH);

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
					 
					ListAdapter adapter = new SimpleAdapter(
							SearchActivity.this, productsList,
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
