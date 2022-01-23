package com.hfad.ahoonstore.Fragments;
import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import androidx.fragment.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.RequestQueue;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.Volley;
import com.hfad.ahoonstore.Helper;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.toolbox.JsonObjectRequest;
import com.hfad.ahoonstore.R;
import com.hfad.ahoonstore.Activity.login_activity;

import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class logout extends Fragment {
    SharedPreferences myPref;
    RequestQueue queue;
    public logout() {
        // Required empty public constructor
    }
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @SuppressLint("WrongConstant")
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        myPref = getActivity().getSharedPreferences("mainPref", Context.MODE_APPEND);
        queue = Volley.newRequestQueue(getActivity());
        String Token = myPref.getString("Token", "none");
        Boolean mybool = myPref.getBoolean("isLogged", false);
        SharedPreferences.Editor myEdit = myPref.edit();
        System.out.println(Token);
        System.out.println(mybool);
        JsonObjectRequest myRequest = new JsonObjectRequest(
                Request.Method.GET,
                Helper.logout,
                null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        myEdit.putString("Token", "");
                        myEdit.putBoolean("isLogged", false);
                        myEdit.putString("profile_id", "");
                        System.out.println(Token);
                        myEdit.apply();
                        Intent myIntent = new Intent(getActivity(), login_activity.class);
                        startActivity(myIntent);
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getActivity(), error.toString(), Toast.LENGTH_SHORT).show();
                    }
                }
        ){
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                HashMap<String, String> myHeaders = new HashMap<String, String>();
                myHeaders.put("Authorization", "Bearer " + Token);
                return myHeaders;
            }
        };
        queue.add(myRequest);
        return inflater.inflate(R.layout.fragment_logout, container, false);
    }
}