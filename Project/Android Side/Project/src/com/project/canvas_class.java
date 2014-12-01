package com.project;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;


import android.app.Activity;
import android.content.res.AssetManager;
import android.graphics.Bitmap;
import android.graphics.Canvas;
import android.graphics.Color;
import android.graphics.Paint;
import android.graphics.drawable.BitmapDrawable;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.TextView;

public class canvas_class extends Activity {
	ArrayList<Integer> xco2=new ArrayList<Integer>();
	ArrayList<Integer> yco2=new ArrayList<Integer>();
	ArrayList<Integer> xco=new ArrayList<Integer>();
	ArrayList<Integer> yco=new ArrayList<Integer>();
	String search,branch;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.map);
		View someView = findViewById(R.id.map);

		  // Find the root view
		  View root = someView.getRootView();

		  // Set the color
		  root.setBackgroundColor(Color.WHITE);
		Paint paint = new Paint();
	    Paint psearch=new Paint();
	    Paint ptext=new Paint();
	    psearch.setColor(Color.RED);
	    psearch.setTextSize(17);
	    ptext.setColor(Color.BLUE);
	    ptext.setTextSize( 17);
	    paint.setColor(Color.BLACK);
	    Bitmap bg = Bitmap.createBitmap(480, 800, Bitmap.Config.ARGB_8888); 
	    Canvas canvas = new Canvas(bg);  
	    AssetManager assetManager = getResources().getAssets();
		InputStream inputStream = null;
		Bundle extras;
		extras = getIntent().getExtras();
	     search = extras.getString("search").toString();
	     branch = extras.getString("branch").toString();
	     if(branch.equals("EXTC"))
	     {
	    	 String a;
	    	 a=search.trim();
	    	 a=a.replaceAll(" ","");
	    	 Log.w("a in extc branch is", a);
	    	 if(a.contains("HollNo7") || a.contains("HollNo8"))
	    	 {
	    		 Log.w("in extc if", "fds");
	    		 String split = a.substring(a.lastIndexOf("-"));
	    		 split=split.replaceAll("-", "");
	    		 search=split.trim();
	    		 Log.w("EXTC search trimmed is",search);
	    	 }
	    	 else 
	    	 {
	    		 TextView tv= new TextView(getApplicationContext());
	    		 tv.setText("Map not Available");
	    	 }
	     }
	     if(search.contains("C.S") || search.contains("I.T"))
	     {
	    	 String split = search.substring(search.lastIndexOf(" "));
	    	 search=split;
	    	search= search.trim();
	    	 Log.w("Spliited String", search);
	     }
	     Log.i("Branch is ", branch);
	     try {
			if(branch.equals("computer"))
			{
	        inputStream = assetManager.open("cs_map.csv");
			}
			if(branch.equals("Mechanical"))
			{
	        inputStream = assetManager.open("mechanical_data.csv");
			}
			if(branch.equals("EXTC"))
			{
	        inputStream = assetManager.open("extc_b_map.csv");
			}
			if(branch.equals("civil"))
			{
	        inputStream = assetManager.open("cs_map.csv");
			}
			if ( inputStream != null)
	            {
	            	BufferedReader reader = new BufferedReader(new InputStreamReader(inputStream));
	            	String line;
	            	while ((line = reader.readLine()) != null) 
	            	{
	                    String[] RowData = line.split(",");
	                  
						//  nae.add(RowData[1]);
	                  //  Log.d("x1,y1", RowData[0]+" "+RowData[1]);
	                    xco.add(Integer.parseInt(RowData[0]));
	                    yco.add(Integer.parseInt(RowData[1]));
	                   // name.add(RowData[2]);
	                 //   Log.d("x2,y2", RowData[2]+" "+RowData[3]);
	                   // nae2.add(RowData[3]);
	                    xco2.add(Integer.parseInt(RowData[2]));
	                    yco2.add(Integer.parseInt(RowData[3]));
	                   // name2.add(RowData[4]);
	                    if(RowData[4].equals("12345"))
	                    {
	                    	canvas.drawText(RowData[5], Integer.parseInt(RowData[2])+10, Integer.parseInt(RowData[3]), ptext);
	                    }
	                    for(int i=4;i<=9;i++)
	                    {
	                    	if(RowData[i].equals(search))
	                    	{
	                    		Log.w("in if", "in f");
	                    		if(Integer.parseInt(RowData[0])==100)
	                    		{
	                    			canvas.drawText(RowData[i], Integer.parseInt(RowData[0])-25,Integer.parseInt(RowData[1]), psearch);
	                    		}
	                    		if(Integer.parseInt(RowData[0])>100)
	                    		{
	                    			canvas.drawText(RowData[i], Integer.parseInt(RowData[0])+15,Integer.parseInt(RowData[1]), psearch);
	                    		}
	                    	}
	                    } 
	            	}
	            }
	        }
		
		catch (IOException e) 
		{
	            e.printStackTrace();
		}
		 for(int i=0;i< yco.size();i++)
	        {
			// Log.d("In for loop","In for loop");
	        	canvas.drawCircle(xco.get(i),yco.get(i), 2, paint);
	            canvas.drawLine(xco.get(i),yco.get(i),xco2.get(i), yco2.get(i), paint);             
	        }
		
	     
		 LinearLayout ll = (LinearLayout) findViewById(R.id.map); 
		 ll.setBackgroundDrawable(new BitmapDrawable(bg)); 
		 // ll.setBackgroundDrawable(new BitmapDrawable(bg));    
	}
	
	
}
