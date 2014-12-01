package com.project;


import android.os.Bundle;
import android.app.Activity;
import android.content.Intent;
import android.graphics.Color;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;

public class Book_main extends Activity {
	Button submit;
	EditText search;
	Spinner spinner1;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.book_main);
	//	View someView = findViewById(R.id.book_main_xml);

		  // Find the root view
	//	  View root = someView.getRootView();

		  // Set the color
	//	  root.setBackgroundColor(Color.WHITE);
		submit=(Button)findViewById(R.id.Search);
		search=(EditText)findViewById(R.id.editsearch);
		spinner1=(Spinner)findViewById(R.id.spinner1);
		Log.d("Item Selected",String.valueOf(spinner1.getSelectedItem()) );
		submit.setOnClickListener(new View.OnClickListener() {
		
			@Override
			public void onClick(View arg0) {
				// TODO Auto-generated method stub
				Intent in =new Intent(Book_main.this,SearchActivity.class);
				in.putExtra("search",search.getText().toString());
				String a=String.valueOf(spinner1.getSelectedItem());
				if(a.contains("C.S"))
				{
					a="computer";
				}
				in.putExtra("branch", a);
				Log.d("Item Selected",String.valueOf(spinner1.getSelectedItem()) );
				startActivity(in);
			}
		});
		
	}

	

}
