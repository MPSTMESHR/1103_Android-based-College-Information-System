package com.project;

import android.content.Context;
import android.content.Intent;

public final class CommonUtilities {
	
 
  //  static final String SERVER_URL = "http://10.0.2.2/practice/register.php"; 
     static final String SERVER_URL = "http://collegeinfo.byethost7.com/practice/register.php"; 

   
    static final String SENDER_ID = "1021847777513"; 

    static final String TAG = "GCM";

    static final String DISPLAY_MESSAGE_ACTION =
            "com.project.pushnotifications.DISPLAY_MESSAGE";

    static final String EXTRA_MESSAGE = "message";

    
    static void displayMessage(Context context, String message) {
        Intent intent = new Intent(DISPLAY_MESSAGE_ACTION);
        intent.putExtra(EXTRA_MESSAGE, message);
        context.sendBroadcast(intent);
    }
}
