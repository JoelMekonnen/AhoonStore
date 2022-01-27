package com.hfad.ahoonstore.Activity;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.Volley;
import com.hfad.ahoonstore.Helper;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.toolbox.JsonObjectRequest;
import com.hfad.ahoonstore.R;

import org.json.JSONObject;

import java.util.HashMap;

public class login_activity extends AppCompatActivity {
    private  RequestQueue queue;
    SharedPreferences myPref;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        queue = Volley.newRequestQueue(login_activity.this);
        myPref = getSharedPreferences("mainPref", Context.MODE_PRIVATE);
        Button login = (Button)findViewById(R.id.LoginButton);
        Button signup = (Button)findViewById(R.id.submitButton);
        EditText username = (EditText)findViewById(R.id.username);
        EditText password = (EditText)findViewById(R.id.password);
        login.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v)
            {
                userLogin(v, username.getText().toString(), password.getText().toString());
            }
        });
        signup.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent signUpIntent = new Intent(login_activity.this, signup_activity.class);
                startActivity(signUpIntent);
                finish();
            }
        });
    }
    public void userLogin(View view, String username, String password)
    {
        String client_id  = "4";
        String client_secret = "SUBBY1Cht8ReE6RLtMsAZiRlluFPDfppliFNw4AD";
        String grant_type = "password";
        HashMap<String, String> myObject = new HashMap<String, String>();
        myObject.put("username", username);
        myObject.put("password", password);
        myObject.put("grant_type", grant_type);
        myObject.put("client_id", client_id);
        myObject.put("client_secret", client_secret);
        System.out.println(myObject);
        JsonObjectRequest myRequest = new JsonObjectRequest(
                Request.Method.POST,
                Helper.loginUrl,
                new JSONObject(myObject),
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            SharedPreferences.Editor editor = myPref.edit();
                            editor.putBoolean("isLogged", true);
                            System.out.println(response.getString("access_token"));
                            editor.putString("Token", response.getString("access_token"));
                            editor.apply();
                            Intent main = new Intent(login_activity.this, MainActivity.class);
                            startActivity(main);
                        } catch (Exception e) {
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(login_activity.this, error.toString(), Toast.LENGTH_SHORT).show();
                    }
                }
        );
        queue.add(myRequest);
    }
}