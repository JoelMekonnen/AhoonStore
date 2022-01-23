package com.hfad.ahoonstore.Activity;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;

import com.android.volley.RequestQueue;
import com.hfad.ahoonstore.R;

public class MainActivity extends AppCompatActivity {
  public  AlertDialog.Builder myAlert;
  private  RequestQueue queue;
  SharedPreferences myPref;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        myPref = MainActivity.this.getSharedPreferences("mainPref", Context.MODE_PRIVATE);
        boolean isLogged = myPref.getBoolean("isLogged", false);
        System.out.println(isLogged);
        if(isLogged) {
            Intent mainIntent = new Intent(MainActivity.this, home_activity.class);
            startActivity(mainIntent);
            finish();
        } else {
            Intent Login = new Intent(MainActivity.this, login_activity.class);
            startActivity(Login);
            finish();
        }

    }

}