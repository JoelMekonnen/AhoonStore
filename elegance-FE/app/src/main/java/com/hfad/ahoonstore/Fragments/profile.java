package com.hfad.ahoonstore.Fragments;

import android.content.Context;
import android.content.SharedPreferences;
import android.net.Uri;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.RequestQueue;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.Volley;
import com.hfad.ahoonstore.Helper;
import com.android.volley.NoConnectionError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.toolbox.JsonObjectRequest;
import com.hfad.ahoonstore.R;
import com.squareup.picasso.Picasso;

import org.json.JSONObject;
import org.json.JSONArray;
import org.json.JSONException;
import org.w3c.dom.Text;

import java.util.HashMap;
import java.util.Map;


public class profile extends Fragment {
     SharedPreferences myPref;
     private RequestQueue queue;
     TextView name;
     TextView username;
     TextView email;
     TextView phone;
     ImageView img;
    public profile() {
        // Required empty public constructor
    }
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View myView = inflater.inflate(R.layout.fragment_profile, container, false);
         name = (TextView) myView.findViewById(R.id.name);
        username = (TextView)myView.findViewById(R.id.username);
        email = (TextView)myView.findViewById(R.id.email);
        phone = (TextView)myView.findViewById(R.id.phone_number);
        img = (ImageView)myView.findViewById(R.id.profileImage);
        myPref = this.getActivity().getSharedPreferences("mainPref", 0);
        queue = Volley.newRequestQueue(getActivity());
        String Token = myPref.getString("Token", "none");
        if(!Token.equals("none"))
        {
            JsonObjectRequest myRequest = new JsonObjectRequest(
                    Request.Method.GET,
                    Helper.getUser,
                    null,
                    new Response.Listener<JSONObject>() {
                        @Override
                        public void onResponse(JSONObject response) {
                            try {
                                setViewValues(response);
                            } catch(Exception e) {
                                e.printStackTrace();
                            }
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
        }
        return myView;
    }
    public void setViewValues(JSONObject obj) throws JSONException {
         JSONObject data = obj.getJSONObject("data");
         JSONObject user = data.getJSONObject("user");
         JSONObject profile = data.getJSONObject("profile");
         System.out.println();
         String imgUrl = Helper.ip + "/storage/profilePics/" + profile.getString("profile_pic");
         Picasso.get().load(imgUrl).into(img);
         name.setText(user.getString("name"));
         username.setText(user.getString("username"));
         email.setText(user.getString("email"));
         phone.setText(profile.getString("phone_number"));
    }
}